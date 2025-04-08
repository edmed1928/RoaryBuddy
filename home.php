<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Roary Buddy</title>
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
            <a href="home.php" class="navbar__links">Home</a>
          </li>
          <li class="navbar__btn">
            <a href="#" class="loginButton">Login</a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
      <div class="hero__content">
        <h1>Welcome to <img src="images/roarybuddytext.png"></h1>
        <a href="#" class="loginButton">Get Started</a>
      </div>
    </section>

    <!-- Add this right before the closing body tag -->
<div id="loginModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Login</h2>
    <form id="loginForm" action="login_process.php" method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="loginButton">Login</button>
      <p>Don't have an account? <a href="register.php">Sign up</a></p>
    </form>
  </div>
</div>

    <script src="app.js"></script>
  </body>
</html>