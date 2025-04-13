<?php
require 'db.php';
$session_id = $_GET['session_id'] ?? 0;

// First load regular messages
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
    $message_text = $row['message_text'];
    
    // Check if this is a file notification
    if (strpos($message_text, "shared a file:") === 0) {
        $file_name = substr($message_text, 15); // Extract filename
        
        // Find file details in files table
        $file_stmt = $conn->prepare("
            SELECT file_url 
            FROM files 
            WHERE session_id = ? AND file_name = ? 
            ORDER BY uploaded_at DESC 
            LIMIT 1
        ");
        $file_stmt->bind_param("is", $session_id, $file_name);
        $file_stmt->execute();
        $file_result = $file_stmt->get_result();
        
        if ($file_row = $file_result->fetch_assoc()) {
            // Create download link
            $file_url = "uploads/" . $file_row['file_url'];
            echo "<div class='message file-message'><strong>{$row['name']}</strong> shared a file: ";
            echo "<a href='{$file_url}' target='_blank'>{$file_name}</a>";
            echo "<br><small>{$row['sent_at']}</small></div>";
        } else {
            // If file record not found, show regular text
            echo "<div class='message'><strong>{$row['name']}</strong>: " . htmlspecialchars($message_text);
            echo "<br><small>{$row['sent_at']}</small></div>";
        }
    } else {
        // Regular message
        echo "<div class='message'><strong>{$row['name']}</strong>: " . htmlspecialchars($message_text);
        echo "<br><small>{$row['sent_at']}</small></div>";
    }
}
?>