<?php
// Koneksi ke database
$db = mysqli_connect("localhost","root", "", "phpdasar");

function query($query) {
    global $db;
    $result = mysqli_query($db, $query);
    $phones = [];
    while( $phone = mysqli_fetch_assoc($result) ) {
        $phones[] = $phone;
    };
    return $phones;
};

function tambah($data) {
    global $db;
    // Ambil data dari tiap elemen form
    $name       = htmlspecialchars($data["name"]);
    $os         = htmlspecialchars($data["os"]);
    $chip       = htmlspecialchars($data["chip"]);
    $camera     = htmlspecialchars($data["camera"]);
    $battery    = htmlspecialchars($data["battery"]);

    // Upload gambar
    $image      = upload();
    if (!$image) {
        return false;
    }

    // Query insert data
    $query = "INSERT INTO smartphones
                VALUES
                ('', '$name', '$os', '$chip', '$camera', '$battery', '$image')
                ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function tambahUser($data) {
    global $db;
    // Ambil data dari tiap elemen form
    $username       = htmlspecialchars($data["username"]);
    $pass         = htmlspecialchars($data["password"]);

    // Query insert data
    $query =    "INSERT INTO users
                VALUES
                ('', '$username', '$pass')
                ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function upload() {
    $fileName   = $_FILES['image']['name'];
    $fileSize   = $_FILES['image']['size'];
    $error      = $_FILES['image']['error'];
    $tmpName    = $_FILES['image']['tmp_name'];

    // Cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
            alert('Tolong pilih gambar yang akan diunggah')
        </script>";
        return false;
    };

    // Cek apakah yang diupload adalah gambar
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = strtolower(end(explode('.', $fileName)));
    if(!in_array($imageExtension, $validImageExtension)) {
        echo "<script>
            alert('Jenis file tidak sesuai, tolong ganti gambar yang akan diupload')
        </script>";
        return false;
    }

    // Cek jika ukurannya terlalu besar
    if ($fileSize > 1000000) {
        echo "<script>
            alert('Ukuran gambar terlalu besar')
        </script>";
        return false;
    }

    // Generate nama gambar baru
    $fileNewName = uniqid();
    $fileNewName .= '.';
    $fileNewName .= $imageExtension;

    // Lolos pengecekan gambar siap diupload
    move_uploaded_file($tmpName, 'img/' . $fileNewName);

    return $fileNewName;
}

function hapus($id) {
    global $db;
    mysqli_query($db, "DELETE FROM smartphones WHERE id = $id");
    return mysqli_affected_rows($db);
}

function hapusUsers($id) {
    global $db;
    mysqli_query($db, "DELETE FROM users WHERE id = $id");
    return mysqli_affected_rows($db);
}

function ubah($data) {
    global $db;
    // Ambil data dari tiap elemen form
    $id         = $data["id"];
    $name       = htmlspecialchars($data["name"]);
    $os         = htmlspecialchars($data["os"]);
    $chip       = htmlspecialchars($data["chip"]);
    $camera     = htmlspecialchars($data["camera"]);
    $battery    = htmlspecialchars($data["battery"]);
    $image      = htmlspecialchars($data["image"]);
    $oldImage   = htmlspecialchars($data["oldImage"]);

    // Cek apakah user pilih gambar baru atau tidak
    if ($_FILES["image"]["error"] === 4) {
        $image = $oldImage;
    } else {
        $image = upload();
    }

    // Query insert data
    $query = "UPDATE smartphones SET
                name = '$name',
                os = '$os',
                chip = '$chip',
                camera = '$camera',
                battery = '$battery',
                image = '$image'
                WHERE id = $id";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
};

function ubahUser($data) {
    global $db;
    // Ambil data dari tiap elemen form
    $id         = $data["id"];
    $username   = htmlspecialchars($data["username"]);

    // Query insert data
    $query = "UPDATE users SET
                username = '$username'
                WHERE id = $id";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
};

function cari($keyword) {
    $jumlahDataPerHalaman = 5;
    $jumlahData = count(query("SELECT * FROM smartphones WHERE
                name LIKE '%$keyword%' OR
                os LIKE '%$keyword%' OR
                chip LIKE '%$keyword%' OR
                camera LIKE '%$keyword%' OR
                battery LIKE '%$keyword%'"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $phones = query("SELECT * FROM smartphones
                WHERE
                name LIKE '%$keyword%' OR
                os LIKE '%$keyword%' OR
                chip LIKE '%$keyword%' OR
                camera LIKE '%$keyword%' OR
                battery LIKE '%$keyword%' 
                LIMIT $awalData, $jumlahDataPerHalaman");
    
    $hal['jumlahHalaman']   = $jumlahHalaman;
    $hal['halamanAktif']    = $halamanAktif;
    $hal['phones']          = $phones;
    $hal['awalData']        = $awalData;
    $hal['keyword']         = $keyword;

    return $hal;  
}

function cariUsers($keyword) {
    $jumlahDataPerHalaman = 5;
    $jumlahData = count(query("SELECT * FROM users WHERE
                username LIKE '%$keyword%'"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $users = query("SELECT * FROM users
                WHERE
                username LIKE '%$keyword%' 
                LIMIT $awalData, $jumlahDataPerHalaman");
    
    $hal['jumlahHalaman']   = $jumlahHalaman;
    $hal['halamanAktif']    = $halamanAktif;
    $hal['username']           = $users;
    $hal['awalData']        = $awalData;
    $hal['keyword']         = $keyword;

    return $hal;  
}

function register($data) {
    global $db;
    $username   = strtolower(stripslashes($data["username"]));
    $password   = mysqli_real_escape_string($db, $data["password"]);
    $confirm_password  = mysqli_real_escape_string($db, $data["confirm_password"]);

    // Cek username sudah ada atau belum
    $copy = mysqli_query($db, "SELECT username FROM users WHERE username = '$username'");
    if(mysqli_fetch_assoc($copy)) {
        echo "<script>
                alert('Username already used');
            </script>";
        return false;
    };

    // Cek konfirmasi password
    if ($password !== $confirm_password) {
        echo "<script>
                alert('Password does not match');
            </script>";
        return false;
    };

    // Enkripsi Password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan user baru ke database
    mysqli_query($db, "INSERT INTO users VALUE('', '$username', '$password')");

    return mysqli_affected_rows($db);
}

function hal() {
    $jumlahDataPerHalaman = 5;
    $jumlahData = count(query("SELECT * FROM smartphones"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $phones = query("SELECT * FROM smartphones LIMIT $awalData, $jumlahDataPerHalaman");
    
    $hal['jumlahHalaman']   = $jumlahHalaman;
    $hal['halamanAktif']    = $halamanAktif;
    $hal['phones']          = $phones;
    $hal['awalData']        = $awalData;

    return $hal;
}

function halUser() {
    $jumlahDataPerHalaman = 5;
    $jumlahData = count(query("SELECT * FROM users"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $users = query("SELECT * FROM users LIMIT $awalData, $jumlahDataPerHalaman");
    
    $hal['jumlahHalaman']   = $jumlahHalaman;
    $hal['halamanAktif']    = $halamanAktif;
    $hal['users']           = $users;
    $hal['awalData']        = $awalData;

    return $hal;
}
?>