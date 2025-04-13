<?php

session_start();


include_once "dbh.inc.php";


$scheduled_events = [];

try {
   
    $query = "SELECT sg.group_id, sg.group_name, sc.event_name, sc.event_description, sc.event_time, sc.session_id
              FROM study_group sg
              JOIN schedule sc ON sg.group_id = sc.group_id
              WHERE sg.group_id = :group_id
              ORDER BY sc.event_time ASC";
    $stmt = $pdo->prepare($query);


    
    $group_id = $_GET['group_id']; 
    $stmt->bindParam(':group_id', $group_id, PDO::PARAM_INT);
    

    $stmt->execute();

   
    $scheduled_events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching scheduled events: " . $e->getMessage());
}
?>