
<!DOCTYPE html>
 

<html lang="en">
 

<head>
 

    <meta charset="UTF-8">
 

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 

    <title>Login - RoaryBuddy</title>
 

    <link rel="stylesheet" href="style.css">
 

</head>
 

<body>
 

    <div class="login-container">
 

        <h2>Login to RoaryBuddy</h2>
 

        <form action="includes/formhandler_login.inc.php" method="POST">
 

            <label for="email">Email:</label>
 

            <input type="email" id="email" name="email" required>
 

            
 

            <label for="password">Password:</label>
 

            <input type="password" id="password" name="password" required>
 

            
 

            <button type="submit">Login</button>
 

        </form>
 

        <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
 

    </div>
 

</body>
 

</html>