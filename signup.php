<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - RoaryBuddy</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="signup-container">
        <div class="signup-header">
            <img src="images/signuptext.png" alt="Sign Up" class="signup-image">
        </div>
        <form action="includes/formhandler_signup.inc.php" method="POST">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>
           
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
           
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="role">Are you registering as a student or admin?</label>
      <select id="role" name="role">
        <option value="student">Student</option>
        <option value="admin">Admin</option>
      </select>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>