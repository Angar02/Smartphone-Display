<?php
session_start();

require 'functions.php';

if(isset($_POST["register"])) {
    if(register($_POST) > 0) {
        echo "
            <script>
                alert('Register Success');
                window.location.href='login.php';
            </script>";
    } else {
        echo mysqli_error($db);
    };
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
    <link rel="stylesheet" href="css/templatemo-prism-flux.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <!-- Navigation Header -->
    <header class="header" id="header">
        <nav class="nav-container">
            
            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php" class="nav-link">Home</a></li>
            </ul>
            
            <div class="menu-toggle" id="menuToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>

    <div class="login-card">
        <h2 class="login-title">REGISTER</h2>

        <form action="" method="post">
            <div class="form-group">
                <label for="username">USERNAME</label>
                <input type="text" name="username" id="username" placeholder="Enter username">
            </div>

            <div class="form-group">
                <label for="password">PASSWORD</label>
                <input type="password" name="password" id="password" placeholder="Enter password">
            </div>

            <div class="form-group">
                <label for="confirm_password">CONFIRM PASSWORD</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password">
            </div>

            <button class="login-btn" type="submit" name="register">LOGIN</button>

            <div class="register-link">
                <span>have an account?</span>
                <a href="login.php">Login here</a>
            </div>
        </form>

        <div class="login-footer">
        </div>
    </div>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>