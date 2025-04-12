<?php


session_start();


include_once "dbh.inc.php";


$study_groups = [];

try {
    $query = "SELECT sg.group_id, sg.group_name, sg.created_by, 
                     (SELECT COUNT(*) FROM user_studygroup usg WHERE usg.group_id = sg.group_id AND usg.user_id = :user_id) AS is_member
              FROM study_group sg";
    $stmt = $pdo->prepare($query);

    
    $user_id = $_SESSION['user_id'];
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);


    $stmt->execute();

  
    $study_groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching study groups: " . $e->getMessage());
}
?>


