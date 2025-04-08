<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = htmlspecialchars($_POST['user_id']); 
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);  
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = ($_POST['role']);

   
    try {
         include_once "dbh.inc.php";

        $query = "INSERT INTO users (user_id, name, email, password, role) VALUES (:user_id, :name, :email, :password, :role);";
        
        $stmt = $pdo -> prepare($query);

        $stmt -> bindParam(':user_id', $user_id);
        $stmt -> bindParam(':name', $name);
        $stmt -> bindParam(':email', $email);
        $stmt -> bindParam(':password', $password);
        $stmt -> bindParam(':role', $role);

        $stmt -> execute();

        $pdo = null;
        $stmt = null; 

        header('Location: ../home.php');

        die(); 
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header('Location: ../home.php');
    exit();

}