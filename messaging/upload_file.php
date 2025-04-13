<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized.");
}

// Make sure the uploads directory exists
$upload_dir = "uploads/";
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['shared_file'])) {
    $file = $_FILES['shared_file'];
    $session_id = $_POST['session_id'] ?? null;
    
    if (!$session_id) {
        echo "Session ID is required.";
        exit();
    }
    
    $filename = basename($file['name']);
    $target_filename = time() . '_' . $filename; // Add timestamp to prevent overwriting
    $target_path = $upload_dir . $target_filename;
    
    // Simple validation: limit file size and type if needed
    if ($file['size'] < 10 * 1024 * 1024) { // 10 MB max
        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            // Insert into files table
            $user_id = $_SESSION['user_id'];
            
            $stmt = $conn->prepare("INSERT INTO files (session_id, uploaded_by, file_name, file_url) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiss", $session_id, $user_id, $filename, $target_filename);
            
            if ($stmt->execute()) {
                // Also add a message about the file
                $file_notification = "shared a file: " . $filename;
                
                $msg_stmt = $conn->prepare("INSERT INTO messages (session_id, sender_id, message_text) VALUES (?, ?, ?)");
                $msg_stmt->bind_param("iis", $session_id, $user_id, $file_notification);
                $msg_stmt->execute();
                
                echo "File uploaded successfully.";
            } else {
                echo "File uploaded but record not saved: " . $stmt->error;
            }
        } else {
            echo "Upload failed.";
        }
    } else {
        echo "File too large.";
    }
}
?>