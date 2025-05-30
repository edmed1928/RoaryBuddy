<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  // Redirect to the login page if not logged in
  header("Location: login.php");
  exit();
}

$username = $_SESSION['username'];  // Get the username from session
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Roary Buddy</title>
    <link rel="icon" href="images/roarybuddylogo.png" type="image/png">
    <link rel="stylesheet" href="style.css"/>
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
            <span class="navbar__username">👋 Hello, <?= htmlspecialchars($username) ?></span>
          </li>
          <li class="navbar__btn">
            <a href="logout.php" class="loginButton">Logout</a>
          </li>
        </ul>
      </div>
    </nav>


<style>
 .dashboard__container {
    display: inline;

    img{
      width: 200px;
      height: 200px;
      transition: transform 0.2s; /* Animation */
      &:hover {
        transform: scale(1.1); /* Scale up the image on hover */
      }
    }
  
  }
  .dashboard__menu {
    display: flex;
    justify-content: center;
    list-style-type: none;
    padding: 10px;
  }
  .dashboard__item {
    margin: 50px;
   
  }
  .dashboard__sub{
    list-style-type: none;
    display: inline;
    margin: 50px;
    height: 50px; 
  }
  
</style>

    <!-- Dashboard Menu -->
<div class="dashboard__container">
  <ul class="dashboard__menu" >
    <li class="dashboard__item"> 
    <a href="studygroups.php"><img src="images/discuss.png"></a>
    <ul>
    <li class="dashboard__sub">View Groups</li>
    </ul>
    </li>
    <li class="dashboard__item"> 
    <a href="schedulemanager.php"><img src="images/daily-task.png"></a>
    <ul>
    <li class="dashboard__sub">View Schedule</li>
    </ul>
    </li>
  </ul>
</div>
<script src="app.js"></script>
  </body>
</html>