<?php
    require 'auth.php';

    require 'functions.php';

    // Konfigurasi Pagination
    $hal = halUser();

    // Tombol cari ditekan
    if(isset($_POST["search"])) {
        if(empty($_POST["keyword"])) {
            header("Location: ?halaman=1");
        } else {
            $hal = cari($_POST["keyword"]);
        }
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
                <li><a href="dashboard.php">Dashboard</a></li>

                <li class="menu-title">User</li>
                <li><a href="#">Manage User</a></li>

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
            <h1>Users List</h1>

            <a href="addUsers.php" class="btn">+ Add User</a>

            <form action="" method="post" class="form-cari search-form">
                <input type="text" name="keyword" size="40" autofocus placeholder="Cari smartphone..." autocomplete="off" id="keyword">
                <button type="button" name="search" id="tombol-cari">Cari</button>
            </form>


            <div id="container">
                <div class="pagination-wrapper">
                    <?php if(isset($_GET['keyword'])) : ?>
                        <?php if($hal['halamanAktif'] > 1) : ?>
                            <a href="#" class="pagination" data-halaman="<?= $hal['halamanAktif'] - 1 ?>">&laquo;</a>
                        <?php endif; ?>
                        <?php for($i = 1; $i <= $hal['jumlahHalaman']; $i++) : ?>
                            <?php if($i == $hal['halamanAktif']) : ?>
                                <a href="#" class="pagination active" data-halaman="<?= $i ?>"><?= $i ?></a>
                            <?php else : ?>
                                <a href="#" class="pagination" data-halaman="<?= $i ?>"><?= $i ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <?php if($hal['halamanAktif'] < $hal['jumlahHalaman']) : ?>
                            <a href="#" class="pagination" data-halaman="<?= $hal['halamanAktif'] + 1 ?>" ?>&raquo;</a>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if($hal['halamanAktif'] > 1) : ?>
                            <a href="?halaman=<?= $hal['halamanAktif'] - 1 ?>">&laquo;</a>
                        <?php endif; ?>
                        <?php for($i = 1; $i <= $hal['jumlahHalaman']; $i++) : ?>
                            <?php if($i == $hal['halamanAktif']) : ?>
                                <a href="?halaman=<?= $i ?>"><?= $i ?></a>
                            <?php else : ?>
                                <a href="?halaman=<?= $i ?>"><?= $i ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <?php if($hal['halamanAktif'] < $hal['jumlahHalaman']) : ?>
                            <a href="?halaman=<?= $hal['halamanAktif'] + 1 ?>">&raquo;</a>
                        <?php endif; ?>
                    <?php endif ?>
                </div>

                <table>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    <?php $i = 1 ?>
                    <?php foreach($hal["users"] as $users) : ?>
                        <tr>
                            <td><?= $i + $hal['awalData']?></td>
                            <td><?= $users["username"] ?></td>
                            <td class="aksi">
                                <a href="editUsers.php?id=<?= $users["id"] ?>">Edit</a> | 
                                <a href="deleteUsers.php?id=<?= $users["id"] ?>" onclick="return confirm('Confirm Delete?')">Delete</a>
                            </td>
                        </tr>
                    <?php $i ++ ?>
                    <?php endforeach; ?>

                </table>
            </div>
        </main>
    </div>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/script2.js"></script>

</body>
</html>