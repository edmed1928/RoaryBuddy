<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    exit("Not authorized.");
}

$user_id = $_SESSION['user_id'];
$message = trim($_POST['message']);
$session_id = $_POST['session_id'];

if ($message && $session_id) {
    $stmt = $conn->prepare("INSERT INTO messages (session_id, sender_id, message_text) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $session_id, $user_id, $message);
    $stmt->execute();
}
?>
