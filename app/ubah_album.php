<?php

require "../koneksi/config.php";

session_start();
if (!isset($_SESSION['id_users'])) {
    header("Location: ../login.php");
}

if (!isset($_GET['id_album'])) {
    header("Location: ../login.php");
}

$id_album = $_GET['id_album'];
$ubahAlbum = mysqli_query($conn, "SELECT * FROM tbl_album WHERE id_album = '$id_album'");
$dataAlbum = mysqli_fetch_array($ubahAlbum);

if (mysqli_num_rows($ubahAlbum) < 1) {
    die("Data tidak ditemukan!");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/album.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/form.css">
</head>

<body>
    <?php require "../template/navbar.php" ?>
    <div class="album_ubah-container">
        <div class="title">
            <a href="album.php" class="btn-white">Kembali</a>
        </div>
        <div class="row-album_ubah">
            <div class="left-album_ubah">
                <h2>Detail Album</h2>
                <div class="form-detail">
                    <h4>Nama Album</h4>
                    <p><?= $dataAlbum['nama_album'] ?></p>
                </div>
                <div class="form-detail">
                    <h4>Tanggal Dibuat</h4>
                    <p><?= date('d F Y', strtotime($dataAlbum['tgl_dibuat'])) ?></p>
                </div>
                <div class="form-detail">
                    <h4>Deskripsi</h4>
                    <p><?= $dataAlbum['deskripsi'] ?></p>
                </div>
            </div>
            <div class="right-album_ubah">
                <h2>Ubah Album</h2>
                <form action="" method="post">
                    <input type="hidden" name="id_album" value="<?= $dataAlbum['id_album'] ?>">
                    <div class="form-group">
                        <label for="nama_album">Nama Album</label>
                        <input type="text" value="<?= $dataAlbum['nama_album'] ?>" name="nama_album" id="nama_album" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"><?= $dataAlbum['deskripsi'] ?></textarea>
                    </div>
                    <button type="submit" name="ubahAlbum" class="btn-dark">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['ubahAlbum'])) {
    $id_album = htmlspecialchars($_POST['id_album']);
    $nama_album = htmlspecialchars($_POST['nama_album']);
    $tgl_dibuat = date("Y-m-d");
    $id_users = $_SESSION['id_users'];
    $deskripsi = htmlspecialchars($_POST['deskripsi']);

    $update = mysqli_query($conn, "UPDATE tbl_album SET nama_album = '$nama_album', tgl_dibuat = '$tgl_dibuat', id_users = '$id_users', deskripsi = '$deskripsi' WHERE id_album = '$id_album'");
    if ($update) {
        echo "
        <script>alert('Data album berhasil diubah!');
        document.location.href = 'album.php'</script>
        ";
    } else {
        echo "
        <script>alert('Data album gagal diubah!');
        document.location.href = 'album.php'</script>
        ";
    }
}

?>