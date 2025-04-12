

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Roary Buddy</title>
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


    
          <?php include "includes/scheduleviewer.inc.php"; ?>
          <?php if (!empty($scheduled_events)): ?>
    <table class="studentgroup__table">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Description</th>
                <th>Event Time</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($scheduled_events as $event): ?>
                <tr>
                    <td><?php echo htmlspecialchars($event['event_name']); ?></td>
                    <td><?php echo htmlspecialchars($event['event_description']); ?></td>
                    <td><?php echo htmlspecialchars($event['event_time']); ?></td>
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