<?php
    require 'auth.php';
    require 'functions.php';

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
            <li><a href="dashboard.php">Dashboard</a></li>

            <li class="menu-title">User</li>
            <li><a href="users.php">Manage User</a></li>

            <li class="menu-title">Smartphones</li>
            <li><a href="smartphones.php">Manage Smartphone</a></li>

            <li class="menu-title">Other</li>
            <li><a href="#">Print</a></li>

            <li class="menu-title"><hr></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </aside>

    <!-- Content -->
    <main class="content">
        <div class="print-container">
            <h1 class="print-title">Print Center</h1>
            <p class="print-subtitle">Select the data you want to print</p>

            <div class="print-grid">

                <!-- Print Smartphone -->
                <div class="print-card">
                    <div class="print-icon">📱</div>
                    <h3>Data Smartphone</h3>
                    <p>Print all saved smartphones data</p>
                    <a href="printSmartphones.php" target="_blank" class="btn-print">
                        Print Smartphone
                    </a>
                </div>

                <!-- Print User -->
                <div class="print-card">
                    <div class="print-icon">👤</div>
                    <h3>Data User</h3>
                    <p>Print all registered users</p>
                    <a href="printUsers.php" target="_blank" class="btn-print secondary">
                        Print User
                    </a>
                </div>

            </div>
        </div>

    </main>
</div>

</body>
</html>