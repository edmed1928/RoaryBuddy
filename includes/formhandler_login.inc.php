<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input to prevent XSS attacks
    $email = htmlspecialchars($_POST['email']); 
    $password = htmlspecialchars($_POST['password']);

    try {
        include_once "dbh.inc.php";

        // Prepare SQL query to fetch user based on the email
        $stmt = $pdo->prepare("SELECT user_id, username, password, role FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $db_password = $user['password'];
            $userid = $user['user_id'];
            $username = $user['username'];  // Get the username from the database
            $user_role = $user['role'];

            // Verify the password against the hash stored in the database
            if (password_verify($password, $db_password)) {
                // Start the session and store user data
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $userid;
                $_SESSION['role'] = $user_role;
                $_SESSION['username'] = $username;  // Store the username in the session

                // Redirect to dashboard
                header("Location: ../dashboard.php");
                exit();
            } else {
                // General error message
                echo "Invalid login credentials. Please try again.";
            }
        } else {
            // General error message
            echo "Invalid login credentials. Please try again.";
        }
    } catch (PDOException $e) {
        // Handle query failure gracefully
        die("Error: " . $e->getMessage());
    }
} else {
    // Redirect to home page if the form was not submitted with POST
    header('Location: ../home.php');
    exit();
}

?>