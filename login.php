<?php
session_start();
require 'functions.php';

if (!isset($_SESSION['login']) && isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id  = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($db, "SELECT username FROM users WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    if ($row && hash('sha256', $row['username']) === $key) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $row['username'];
    }   
}

if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];

            // REMEMBER ME OPSIONAL
            if (isset($_POST['remember'])) {
                setcookie('id', $row['id'], time() + 60 * 60 * 24 * 7, '/');
                setcookie('key', hash('sha256', $row['username']), time() + 60 * 60 * 24 * 7, '/');
            }

            header("Location: dashboard.php");
            exit;
        }
    }

    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
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
        <h2 class="login-title">SYSTEM LOGIN</h2>

        <?php if(isset($error)) : ?>
            <div class="alert alert-error">
                <span class="alert-icon">⚠</span>
                <span class="alert-text">Username or Password is Wrong</span>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group">
                <label for="username">USERNAME</label>
                <input type="text" name="username" id="username" placeholder="Enter username">
            </div>

            <div class="form-group">
                <label for="password">PASSWORD</label>
                <input type="password" name="password" id="password" placeholder="Enter password">
            </div>

            <div class="remember-me">
                <label>
                    <input type="checkbox" name="remember" id="remember">
                    <span class="checkmark" for="remember"></span>
                    Remember me
                </label>
            </div>

            <button class="login-btn" type="submit" name="login">LOGIN</button>

            <div class="register-link">
                <span>Didn't have any account?</span>
                <a href="register.php">Register now</a>
            </div>
        </form>

        <div class="login-footer">
        </div>
    </div>
</body>
</html>