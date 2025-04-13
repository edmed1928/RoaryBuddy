<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    echo "Please login to access the website.";
    exit();
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/roarybuddylogo.png" type="image/png">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="dashboard.css"/>
    <title>Schedule Manager</title>

</head>
<body>

   <!-- Navigation Bar -->
   <nav class="navbar">
      <div class="navbar__container">
       <div class="navbar__brand">
        <a href="home.php">
          <img src="images/roarybuddylogo.png" id="navbar__logo">
          <img src="images/roarybuddytext.png" id="appTitle">
        </a>
        </div>
        <div class="navbar__toggle" id="mobile-menu">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </div>
        <ul class="navbar__menu">
          <li class="navbar__item">
            <a href="dashboard.php" class="navbar__links">Dashboard</a>
          </li>
        </ul>
      </div>
    </nav>




    <h2>Scheduled Events</h2>

    <?php include "includes/schedulemanager.inc.php"; ?>


    <table class="studentgroup__table">
        <thead>
            <tr>
                <th>Event Number</th>
                <th>Event Name</th>
                <th>Group Number</th>
                <th>Time</th>
                <th>Event Owner</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($schedule)): ?>
                <?php foreach ($schedule as $schedule): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($schedule['schedule_id']); ?></td>
                        <td><?php echo htmlspecialchars($schedule['event_name']); ?></td>
                        <td><?php echo htmlspecialchars($schedule['group_id']); ?></td>
                        <td><?php echo htmlspecialchars($schedule['event_time']); ?></td>
                        <td><?php echo htmlspecialchars($schedule['created_by']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No events scheduled yet.</td>
                </tr>
            <?php endif; ?>
        </tbody>    
 
    </table>
    <br><br>      

           

</body>
</html>