<?php
    require 'functions.php';

    require 'auth.php';
    
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
        <h1>Dashboard</h1>
        <p>Welcome to dashboard <?= $_SESSION['username']; ?></p>
    </main>
</div>

</body>
</html>