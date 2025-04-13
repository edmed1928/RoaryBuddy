<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  // Redirect to the login page if not logged in
  header("Location: login.php");
  exit();
}



?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8">
    <title>Create a Study Group</title>
    <link rel="icon" href="images/roarybuddylogo.png" type="image/png">
    <link rel="stylesheet" href="style.css" />
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



    <h1>Schedule a New Event</h1>
<form action="includes/studygroup_add_event.inc.php" method="POST">
<input type="hidden" name="group_id" value="<?php echo htmlspecialchars($_POST['group_id']); ?>">
<input type="text" name="event_name" placeholder="Event Name">
<input type="text" name="event_topic" placeholder="Short Topic Description">
<input type='datetime-local' name="event_time" placeholder="Event Time">
<button>Add</button>
</form>