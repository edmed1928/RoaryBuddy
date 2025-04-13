<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - RoaryBuddy</title>
<link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="images/logintext.png" alt="Login" class="login-image">
        </div>
        
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