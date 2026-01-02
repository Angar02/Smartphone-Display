<?php
    require '../functions.php';
    $keyword        = $_GET['keyword'];
    $hal            = cariUsers($keyword);
?>

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
        <?php foreach($hal["username"] as $users) : ?>
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