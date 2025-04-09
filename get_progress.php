<?php
require 'db.php';

$user_id = $_GET['user_id'];

$sql = "SELECT * FROM Progress WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$progress = array();
while ($row = $result->fetch_assoc()) {
    $progress[] = $row;
}

header('Content-Type: application/json');
echo json_encode($progress);

$conn->close();
?>
