<?php
$group_id = (int) $_GET['group_id'];


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Roary Buddy</title>
    <link rel="icon" href="images/roarybuddylogo.png" type="image/png">
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="dashboard.css"/>
   
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

    
    <?php include "includes/scheduleviewer.inc.php"; 

    ?>

   

    <form action="studygroup_add_event.php" method="POST">
        <input type="hidden" name="group_id" value="<?php echo htmlspecialchars($_GET['group_id']); ?>">
        <div class="button-wrapper">
        <button class="studygroupButton" type="submit">Schedule a New Event</button>
        </div>
    </form>
    

    <?php if (!empty($scheduled_events)): ?>
        <table class="studentgroup__table">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Description</th>
                    <th>Event Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($scheduled_events as $event): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($event['event_name']); ?></td>
                        <td><?php echo htmlspecialchars($event['event_description']); ?></td>
                        <td><?php echo htmlspecialchars($event['event_time']); ?></td>
                        <td>
                            <form action="messaging/chat_room.php" method="GET">
                                <input type="hidden" name="session_id" value="<?php echo htmlspecialchars($event['session_id']); ?>">
                                <button type="submit" class="action_btn">Go to Chat Room</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No scheduled events for this group.</p>
    <?php endif; ?>
          
  
      <script src="app.js"></script>
 </body>
</html>