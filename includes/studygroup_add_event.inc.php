<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    include_once 'dbh.inc.php';

    
    $group_id = $_POST['group_id'];
    $event_name = $_POST['event_name'];
    $event_topic = $_POST['event_topic'];
    $event_time = $_POST['event_time'];
    $created_by = $_SESSION['user_id']; 

        try {
           

            // Insert the session into the `sessions` table
            $query = "INSERT INTO sessions (group_id, session_topic, session_time) VALUES (:group_id, :session_topic, :session_time)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':group_id', $group_id, PDO::PARAM_INT);
            $stmt->bindParam(':session_topic', $event_topic, PDO::PARAM_STR);
            $stmt->bindParam(':session_time', $event_time, PDO::PARAM_STR);
            $stmt->execute();

            // Get the session_id of the newly created session
            $session_id = $pdo->lastInsertId();

          
            $query = "INSERT INTO schedule (event_name, event_description, group_id, session_id, event_time, created_by) 
                               VALUES (:event_name, :event_description, :group_id, :session_id, :event_time, :created_by)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':event_name', $event_name, PDO::PARAM_STR);
            $stmt->bindParam(':event_description', $event_topic, PDO::PARAM_STR);
            $stmt->bindParam(':group_id', $group_id, PDO::PARAM_INT);
            $stmt->bindParam(':session_id', $session_id, PDO::PARAM_INT);
            $stmt->bindParam(':event_time', $event_time, PDO::PARAM_STR);
            $stmt->bindParam(':created_by', $created_by, PDO::PARAM_INT);
            $stmt->execute();

            $pdo = null;
            $stmt = null; 
           
            header("Location: ../studygroup_view.php?group_id=$group_id");
            exit();
        } catch (PDOException $e) {
         die("Error: Query Failed " . $e->getMessage());
        }
    } else {
        // Redirect back with an error message if required fields are missing
        header("Location: ../studygroup_add_event.php");
        exit();
    }
 

?>