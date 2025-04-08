<?php
$host = "localhost";
$db = "chat_app";
$user = "root";
$pass = ""; // replace with your password

$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

// Handle new message submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['username']) && !empty($_POST['message'])) {
    $stmt = $conn->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
    $stmt->execute([$_POST['username'], $_POST['message']]);
}

// Fetch all messages
$messages = $conn->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 50")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP Chat</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .chat-box { border: 1px solid #ccc; padding: 10px; max-height: 400px; overflow-y: scroll; background: #f9f9f9; }
        .message { margin-bottom: 10px; }
        .timestamp { font-size: 0.8em; color: gray; }
    </style>
</head>
<body>
    <h2>PHP + SQL Chat</h2>
    <div class="chat-box">
        <?php foreach (array_reverse($messages) as $msg): ?>
            <div class="message">
                <strong><?= htmlspecialchars($msg['username']) ?>:</strong>
                <?= nl2br(htmlspecialchars($msg['message'])) ?>
                <div class="timestamp"><?= $msg['created_at'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <form method="POST" style="margin-top: 20px;">
        <input type="text" name="username" placeholder="Your name" required />
        <br><br>
        <textarea name="message" placeholder="Your message" required></textarea>
        <br><br>
        <button type="submit">Send</button>
    </form>

    <p><a href="index.php">Refresh</a> to see new messages.</p>
</body>
</html>
s