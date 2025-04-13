<?php
session_start();
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
    $filename = basename($file['name']);
    $target = $upload_dir . $filename;

    // Simple validation: limit file size and type if needed
    if ($file['size'] < 10 * 1024 * 1024) { // 10 MB max
        if (move_uploaded_file($file['tmp_name'], $target)) {
            echo "File uploaded successfully.";
        } else {
            echo "Upload failed.";
        }
    } else {
        echo "File too large.";
    }
}
?>

