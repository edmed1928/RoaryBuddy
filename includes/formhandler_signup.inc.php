<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and fetch form inputs
    $name = htmlspecialchars($_POST['name']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // securely hash password
    $role = $_POST['role']; // assumed already validated from select field

    try {
        // Include database handler
        include_once "dbh.inc.php"; // this should define $pdo (PDO connection)

        // Insert query (no need to manually insert user_id, it's auto_increment)
        $query = "INSERT INTO users (username, name, email, password, role) 
                  VALUES (:username, :name, :email, :password, :role)";

        $stmt = $pdo->prepare($query);

        // Bind values
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);

        $stmt->execute();

        // Cleanup
        $pdo = null;
        $stmt = null;

        // Redirect on success
        header('Location: ../login.php');
        exit();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    // Redirect if accessed without POST
    header('Location: ../home.php');
    exit();
}