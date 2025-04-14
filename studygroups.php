

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

      <table class="studentgroup__table">
        <thead>
          <tr>
            <th>Group Number</th>
            <th>Group Name</th>
            <th>Created By</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php include "includes/groupviewer.inc.php"; ?>
          <?php if (!empty($study_groups)): ?>
            <?php foreach ($study_groups as $study_group): ?>
              <tr>
                <td><?php echo htmlspecialchars($study_group['group_id']); ?></td>
                <td><?php echo htmlspecialchars($study_group['group_name']); ?></td>
                <td><?php echo htmlspecialchars($study_group['created_by']); ?></td>
                <td>
                <div class="buttons">
            <?php if (!$study_group['is_member']): ?>
            <form action="includes/studygroup_join.inc.php" method="POST">
              <input type="hidden" name="group_id" value="<?php echo htmlspecialchars($study_group['group_id']); ?>">
              <button type="submit" class="action_btn Join">Join</button>
            </form>
          <?php endif; ?>

          <?php if ($study_group['is_member']): ?>
            <form action="studygroup_view.php" method="GET">
              <input type="hidden" name="group_id" value="<?php echo htmlspecialchars($study_group['group_id']); ?>">
              <button type="submit" class="action_btn View">View</button>
            </form>   
              
            <?php endif; ?>
                </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="3">No groups found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
      <div class="button-wrapper">
      <a href="studygroup_create.php"><button class="studygroupButton">Create Study Group</button></a>
      </div>
  
      <script src="app.js"></script>
  </body>
</html>