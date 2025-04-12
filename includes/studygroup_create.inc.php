<?php
   session_start();
   
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       if (isset($_SESSION['user_id'])) {
           echo "<script>console.log('User ID in session: " . $_SESSION['user_id'] . "');</script>";
       } else {
           echo "<script>console.log('User ID is not set in session.');</script>";
       }
   

    $group_name = ($_POST['group_name']);  
    $created_by = ($_SESSION['user_id']);
   
    try {
         include_once "dbh.inc.php";
     

        $query = "INSERT INTO study_group (group_name, created_by) VALUES (:group_name, :created_by);";
        
        $stmt = $pdo -> prepare($query);

        $stmt -> bindParam(':group_name', $group_name);
        $stmt -> bindParam(':created_by', $created_by, PDO::PARAM_INT);

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