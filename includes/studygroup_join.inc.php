<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_id'])) {
        echo "<script>console.log('User ID in session: " . $_SESSION['user_id'] . "');</script>";
    } else {
        echo "<script>console.log('User ID is not set in session.');</script>";
    }

    $user_id = $_SESSION['user_id'];
    $group_id = ($_POST['group_id']); 
    $studygroup_role = ($_POST['studygroup_role']);
    
  

   
    try {
         include_once "dbh.inc.php";
       

        $query = "INSERT INTO user_studygroup (user_id, group_id, studygroup_role) 
                  VALUES (:user_id, :group_id, :studygroup_role);";
        
        $stmt = $pdo -> prepare($query);

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':group_id', $group_id, PDO::PARAM_INT);
        $stmt->bindParam(':studygroup_role', $studygroup_role);

        $stmt -> execute();

        $pdo = null;
        $stmt = null; 

        header('Location: ../studygroups.php');

        die(); 
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header('Location: ../studygroups.php');
    exit();

}