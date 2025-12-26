.<?php
require 'auth.php';
require 'functions.php';

// Ambil data di URL
$id = $_GET["id"];

// Query data smartphones berdasarkan id
$phone = query("SELECT * FROM smartphones WHERE id = $id")[0];

// Cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
    // Cek apakah data berhasil diubah atau tidak
    if( ubah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diubah');
                document.location.href = 'smartphones.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal diubah');
                document.location.href = 'smartphones.php';
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
            <h2 class="form-title">Edit Smartphone</h2>

            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $phone['id']; ?>">
                <input type="hidden" name="oldImage" value="<?= $phone["image"] ?>">

                <div class="form-group">
                    <label>Smartphone Name</label>
                    <input type="text" name="name" value="<?= $phone['name']; ?>" required>
                </div>

                <div class="form-group">
                    <label>OS</label>
                    <input type="text" name="os" value="<?= $phone['os']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Chipset</label>
                    <input type="text" name="chip" value="<?= $phone['chip']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Camera</label>
                    <input type="text" name="camera" value="<?= $phone['camera']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Battery</label>
                    <input type="text" name="battery" value="<?= $phone['battery']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" value="<?= $phone['image']; ?>">
                </div>

                <div class="form-actions">
                    <button class="btn-submit" name="submit">Update</button>
                    <a href="smartphones.php" class="btn-back">Back</a>
                </div>
            </form>
        </div>
    </main>
</div>

</body>
</html>