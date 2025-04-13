<?php
session_start();
require 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Make sure session_id is set and is valid
$session_id = isset($_GET['session_id']) ? (int)$_GET['session_id'] : 0;

if (!$session_id) {
    echo "Session ID is required.";
    exit();
}

// Get users in the session group
$users_in_session = [];  // Initialize with empty array to prevent null issues
$stmt = $conn->prepare("
    SELECT u.name FROM users u
    JOIN user_studygroup usg ON u.user_id = usg.user_id
    JOIN sessions s ON s.group_id = usg.group_id
    WHERE s.session_id = ?
");

if ($stmt) {
    $stmt->bind_param("i", $session_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $users_in_session = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Handle query preparation error
    echo "Error preparing database query: " . $conn->error;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Session Chat Room</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../style.css"/>
    <style>
        #chat-box { border: 1px solid #ccc; height: 300px; overflow-y: scroll; padding: 10px; }
        .message { margin-bottom: 10px; }
        #file-upload-area { margin: 10px 0; }
        .file-preview { display: inline-block; margin-right: 10px; }
        .file-message { background-color: #f0f7ff; padding: 8px; border-radius: 5px; }
        .file-message a { font-weight: bold; color: #0066cc; }
    </style>
</head>
<body>
 
<!-- Navigation Bar -->
 <nav class="navbar">
      <div class="navbar__container">
       <div class="navbar__brand">
        <a href="../dashboard.php">
          <img src="../images/roarybuddylogo.png" id="navbar__logo">
          <img src="../images/roarybuddytext.png" id="appTitle">
        </a>
        </div>
        <div class="navbar__toggle" id="mobile-menu">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </div>
        <ul class="navbar__menu">
          <li class="navbar__item">
            <a href="../dashboard.php" class="navbar__links">Dashboard</a>
          </li>
        </ul>
      </div>
    </nav>
    <h2>Chat Room - Session <?= htmlspecialchars($session_id) ?></h2>
    <p><strong>Participants:</strong> <?= implode(', ', array_column($users_in_session, 'name')) ?></p>
    <div id="chat-box"></div>
   
    <!-- Message input form -->
    <form id="chat-form">
        <input type="text" id="message" placeholder="Type your message..." required>
        <input type="submit" value="Send">
    </form>
   
    <!-- File upload form -->
    <div id="file-upload-area">
        <form id="file-form" enctype="multipart/form-data">
            <input type="file" id="shared_file" name="shared_file">
            <button type="submit">Upload File</button>
        </form>
        <div id="upload-status"></div>
    </div>
   
    <script>
        function loadMessages() {
            $.get('load_message.php?session_id=<?= $session_id ?>', function(data) {
                $('#chat-box').html(data);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            });
        }
       
        // Text message submission
        $('#chat-form').on('submit', function(e) {
            e.preventDefault();
            const message = $('#message').val();
            $.post('send_message.php', {
                message,
                session_id: <?= $session_id ?>,
            }, function() {
                $('#message').val('');
                loadMessages();
            });
        });
       
        // File upload submission
        $('#file-form').on('submit', function(e) {
            e.preventDefault();
            const fileInput = $('#shared_file')[0];
           
            if (fileInput.files.length > 0) {
                const formData = new FormData();
                formData.append('shared_file', fileInput.files[0]);
                formData.append('session_id', <?= $session_id ?>);
               
                $.ajax({
                    url: 'upload_file.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#upload-status').html(response);
                        // Reset file input
                        $('#shared_file').val('');
                        // Reload messages to include the new file notification
                        loadMessages();
                    }
                });
            }
        });
       
        setInterval(loadMessages, 2000); // refresh messages every 2 sec
        loadMessages();
    </script>
</body>
</html>