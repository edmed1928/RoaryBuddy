<?php
$session_id = isset($_GET['session_id']) ? (int)$_GET['session_id'] : 0;
if (!$session_id) {
    echo json_encode([]);
    exit();
}

$filename = 'active_users.json';
$users = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];

$now = time();
$threshold = 120;

$online_users = [];
foreach ($users as $user) {
    if (($now - $user['timestamp']) <= $threshold && $user['session_id'] == $session_id) {
        $online_users[] = $user['name'];
    }
}

echo json_encode($online_users);
?>
