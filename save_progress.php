<?php
require 'db.php';

$user_id = $_POST['user_id'];
$session_id = $_POST['session_id'];
$task_description = $_POST['task_description'];
$status = $_POST['status'];


$sql_check = "SELECT * FROM progress WHERE user_id=? AND session_id=?";
$stmt = $conn->prepare($sql_check);
$stmt->bind_param("ii", $user_id, $session_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    
    $sql = "UPDATE progress SET status=?, task_description=?, last_updated=NOW()
            WHERE user_id=? AND session_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $status, $task_description, $user_id, $session_id);
} else {
    // Insert
    $sql = "INSERT INTO progress (user_id, session_id, task_description, status)
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $user_id, $session_id, $task_description, $status);
}

if ($stmt->execute()) {
    echo "Progress saved successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
