<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in by verifying session variable
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Video Chat</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<h2>Welcome to the Video Chat</h2>

<body class="dashboard-container">
<div class="dashboard-header">
    <h2>Welcome to the Video Chat</h2>
    <a href="dashboard.php">← Back to Dashboard</a>
</div>

<div class="video-chat-wrapper">
    <!-- Video element to show user's own camera feed -->
    <video id="localVideo" autoplay muted></video>
    <!-- Video element to show the other participant's video stream -->
    <video id="remoteVideo" autoplay></video>
</div>

<!-- Add File Sharing UI -->
<div class="file-sharing-section">
    <form action="upload_file.php" method="post" enctype="multipart/form-data">
        <label for="shared_file">Share a File:</label>
        <input type="file" name="shared_file" id="shared_file" required>
        <button type="submit">Upload</button>
    </form>

    <h3>Shared Files:</h3>
    <ul>
        <?php
        $files = glob("uploads/*");
        foreach ($files as $file) {
            $name = basename($file);
            echo "<li><a href='$file' download>$name</a></li>";
        }
        ?>
    </ul>
</div>

</body>


<script>
    // Get references to the video elements on the page
    const localVideo = document.getElementById('localVideo');
    const remoteVideo = document.getElementById('remoteVideo');

    // Request access to the user's camera and microphone
    navigator.mediaDevices.getUserMedia({ video: true, audio: true })
        .then(stream => {
            // Set the local video to show the user's own webcam feed
            localVideo.srcObject = stream;

            // For now, just mirror the same video to the remote section for testing
            // In real application, this would be replaced with another user's video stream using WebRTC
            remoteVideo.srcObject = stream;
        })
        .catch(error => {
            // Handle any errors that occur when accessing media devices
            console.error("Error accessing media devices.", error);
        });
</script>
</body>
</html>
