
<!DOCTYPE html>
 

<html lang="en">
 

<head>
 

    <meta charset="UTF-8">
 

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 

    <title>Sign Up - RoaryBuddy</title>
 

    <link rel="stylesheet" href="style.css">
 

</head>
 

<body>
 

    <div class="signup-container">
 

        <h2>Sign Up for RoaryBuddy</h2>
 

        <form action="includes/formhandler_signup.inc.php" method="POST">
 

            <label for="name">Full Name:</label>
 

            <input type="text" id="name" name="name" required>
 


 

            <label for="email">Email:</label>
 

            <input type="email" id="email" name="email" required>
 

            
 

            <label for="password">Password:</label>
 

            <input type="password" id="password" name="password" required>
 


 

            <button type="submit">Sign Up</button>
 

        </form>
 

        <p>Already have an account? <a href="login.php">Login here</a></p>
 

    </div>
 

</body>
 

</html>