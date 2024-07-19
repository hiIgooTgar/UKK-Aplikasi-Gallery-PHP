<?php

require "../koneksi/config.php";

session_start();
if (!isset($_SESSION['id_users'])) {
    header("Location: ../login.php");
}

if (!isset($_GET['id_foto'])) {
    header("Location: ../login.php");
}

$id_foto = $_GET['id_foto'];
$ubahFoto = mysqli_query($conn, "SELECT tbl_foto.*, tbl_users.nama_lengkap FROM tbl_foto
INNER JOIN tbl_users ON tbl_foto.id_users = tbl_users.id_users
WHERE id_foto = '$id_foto'");
$dataFoto = mysqli_fetch_array($ubahFoto);

if (mysqli_num_rows($ubahFoto) < 1) {
    die("Data tidak ditemukan!");
}

if (isset($_POST['komentar'])) {
    $id_foto = htmlspecialchars($_POST['id_foto']);
    $id_users = $_SESSION['id_users'];
    $tgl_komentar = date("Y-m-d H:i:s");
    $isi_komentar = htmlspecialchars($_POST['isi_komentar']);

    $sqlKomentar = mysqli_query($conn, "INSERT INTO tbl_komentar(id_komentar, id_foto, id_users, tgl_komentar, isi_komentar)
     VALUES('', '$id_foto', '$id_users', '$tgl_komentar', '$isi_komentar')");
    header("Location: " . $_SERVER['PHP_SELF'] . "?id_foto=" . $id_foto);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/komentar.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/form.css">
</head>

<body>
    <?php require "../template/navbar.php" ?>
    <div class="komentar-container">
        <div class="title">
            <a href="../index.php" class="btn-white">Kembali</a>
        </div>
        <div class="row-komentar">
            <div class="left-komentar">
                <h2>Detail Foto</h2>
                <div class="detail-foto">
                    <img src="../public/<?= $dataFoto['foto_album'] ?>" alt="<?= $dataFoto['judul'] ?>">
                </div>
                <div class="form-detail">
                    <h4>Judul</h4>
                    <p><?= $dataFoto['judul'] ?></p>
                </div>
                <div class="form-detail">
                    <h4>Nama Pengunggah</h4>
                    <p><?= $dataFoto['nama_lengkap'] ?></p>
                </div>
                <div class="form-detail">
                    <h4>Tanggal Unggah</h4>
                    <p><?= date('d F Y | h:i:s A', strtotime($dataFoto['tgl_unggah'])) ?></p>
                </div>
                <div class="form-detail">
                    <h4>Deskripsi</h4>
                    <p><?= $dataFoto['deskripsi'] ?></p>
                </div>
            </div>
            <div class="right-komentar">
                <h2>Komentar</h2>
                <form action="" method="post">
                    <input type="hidden" name="id_foto" value="<?= $dataFoto['id_foto'] ?>">

                    <div class="form-group">
                        <label for="isi_komentar">Isi Komentar</label>
                        <textarea name="isi_komentar" id="isi_komentar" required cols="30" rows="10"></textarea>
                    </div>
                    <button type="submit" name="komentar" class="btn-dark">Komen</button>
                </form>

                <div class="card-komentar">
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM tbl_komentar WHERE id_foto = '$id_foto' ORDER BY tgl_komentar DESC");
                    $cek_komen = mysqli_num_rows($sql);
                    if ($cek_komen == 0) {
                        echo "<center><h3>Isi Komentar Kosong!</h3></center>";
                    }
                    while ($dataKomentar = mysqli_fetch_assoc($sql)) {
                        $nama_users = mysqli_fetch_array(mysqli_query($conn, "SELECT nama_lengkap FROM tbl_users WHERE id_users = {$dataKomentar['id_users']}"))['nama_lengkap'];
                    ?>
                        <div class="profile">
                            <div class="img"></div>
                            <div class="users">
                                <h5><?= $nama_users ?> | <?= date("d F Y h:i:s A", strtotime($dataKomentar['tgl_komentar'])) ?></h5>
                                <p><?= $dataKomentar['isi_komentar'] ?>
                                    <?php if ($dataKomentar['id_users'] == $_SESSION['id_users']) { ?>
                                        <a onclick="return confirm('Komentar ini ingin dihapus?')" href="hapus_komentar.php?id_komentar=<?= $dataKomentar['id_komentar'] ?>" class="hapus_komentar">Hapus</a>
                                    <?php } ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>