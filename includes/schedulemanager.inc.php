<?php
    

include_once "includes/dbh.inc.php";

try {
 
    $stmt = $pdo->query("SELECT schedule_id, event_name, group_id, event_time, created_by FROM schedule;");
  
    $schedule = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>


