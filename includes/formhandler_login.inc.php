<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']); 
    $password = htmlspecialchars($_POST['password']);
   
    try {
        include_once "dbh.inc.php";

        // Uses the $pdo object from dbh.inc.php
        $stmt = $pdo->prepare("SELECT user_id, password, role FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $db_password = $user['password'];
            $userid = $user['user_id'];
            $user_role = $user['role'];


            if (password_verify($password, $db_password)) {
                // Start the session and store user details in session variables
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $userid;
                $_SESSION['role'] = $user_role; // Store the user's role in the session

                header("Location: ../dashboard.php");
                exit();
            } else {
                echo "Invalid username or password.";
            }
        } else {
            echo "Invalid username or password.";
        }
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header('Location: ../home.php');
    exit();
}


