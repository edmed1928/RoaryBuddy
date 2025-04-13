<?php
require 'db.php';

$session_id = $_GET['session_id'] ?? 0;

$stmt = $conn->prepare("
    SELECT m.message_text, m.sent_at, u.name 
    FROM messages m 
    JOIN users u ON m.sender_id = u.user_id 
    WHERE m.session_id = ? 
    ORDER BY m.sent_at ASC
");
$stmt->bind_param("i", $session_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<div class='message'><strong>{$row['name']}</strong>: " . htmlspecialchars($row['message_text']) . "<br><small>{$row['sent_at']}</small></div>";
}
?>