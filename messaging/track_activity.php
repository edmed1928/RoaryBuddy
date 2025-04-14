<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    exit();
}

$session_id = isset($_GET['session_id']) ? (int)$_GET['session_id'] : 0;
if (!$session_id) exit();

$filename = 'active_users.json';
$users = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];

$now = time();
$threshold = 120; // 2 minutes
$user_id = $_SESSION['user_id'];
$name = $_SESSION['username']; // ✅ Use the username key

// Remove inactive users
foreach ($users as $key => $user) {
    if (($now - $user['timestamp']) > $threshold) {
        unset($users[$key]);
    }
}

// Update current user
$users[$user_id] = [
    'name' => $name,
    'timestamp' => $now,
    'session_id' => $session_id
];

file_put_contents($filename, json_encode($users));
?>
