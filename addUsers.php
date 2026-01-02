<?php
    session_start();

    if(!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    };

    require 'functions.php';

    // Cek apakah tombol submit sudah ditekan atau belum
    if( isset($_POST["submit"]) ) {
        // Cek apakah data berhasil ditambahkan atau tidak
        if(tambahUser($_POST) > 0) {
            echo "
                <script>
                    alert('Successfully added new user');
                    document.location.href = 'users.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Failed to add new user');
                    document.location.href = 'users.php';
                </script>
            ";
        };
    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

<audio id="clickSound" src="misc/hidup-jokowi.mp3" preload="auto"></audio>
<script>
  function playClickSound() {
    const audio = document.getElementById("clickSound");
    // Ensure the audio is reset to the beginning if clicked rapidly
    audio.currentTime = 0; 
    audio.play();
  }
</script>

<div class="dashboard">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2 class="logo" onclick="playClickSound()">ADMIN</h2>
        <ul class="menu">
            <li class="menu-title">Home</li>
            <li><a href="#">Dashboard</a></li>

            <li class="menu-title">User</li>
            <li><a href="users.php">Manage User</a></li>

            <li class="menu-title">Smartphones</li>
            <li><a href="smartphones.php">Manage Smartphone</a></li>

            <li class="menu-title">Other</li>
            <li><a href="print.php">Print</a></li>

            <li class="menu-title"><hr></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </aside>

    <!-- Content -->
    <main class="content">
        
        <div class="form-container">
            <h2 class="form-title">Add User</h2>

            <form method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>

                <div class="form-actions">
                    <button class="btn-submit" name="submit">Save</button>
                    <a href="users.php" class="btn-back">Back</a>
                </div>
            </form>
        </div>
    </main>
</div>

</body>
</html>