<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$session_id = $_GET['session_id'] ?? null;
if (!$session_id) {
    echo "Session ID is required.";
    exit();
}

// Get users in the session group
$stmt = $conn->prepare("
    SELECT u.name FROM users u 
    JOIN user_studygroup usg ON u.user_id = usg.user_id 
    JOIN sessions s ON s.group_id = usg.group_id 
    WHERE s.session_id = ?
");
$stmt->bind_param("i", $session_id);
$stmt->execute();
$result = $stmt->get_result();
$users_in_session = $result->fetch_all(MYSQLI_ASSOC);
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

    <form id="chat-form">
        <input type="text" id="message" placeholder="Type your message..." required>
        <input type="submit" value="Send">
    </form>

    <script>
        function loadMessages() {
            $.get('load_message.php?session_id=<?= $session_id ?>', function(data) {
                $('#chat-box').html(data);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            });
        }

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

        setInterval(loadMessages, 2000); // refresh messages every 2 sec
        loadMessages();
    </script>
</body>
</html>
