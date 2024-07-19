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
$ubahFoto = mysqli_query($conn, "SELECT tbl_foto.*, tbl_album.nama_album FROM tbl_foto
INNER JOIN tbl_album ON tbl_foto.id_album = tbl_album.id_album
WHERE id_foto = '$id_foto'");
$dataFoto = mysqli_fetch_array($ubahFoto);

if (mysqli_num_rows($ubahFoto) < 1) {
    die("Data tidak ditemukan!");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/foto.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/form.css">
</head>

<body>
    <?php require "../template/navbar.php" ?>
    <div class="foto_ubah-container">
        <div class="title">
            <a href="foto.php" class="btn-white">Kembali</a>
        </div>
        <div class="row-foto_ubah">
            <div class="left-foto_ubah">
                <h2>Detail Foto</h2>
                <div class="detail-foto">
                    <img src="../public/<?= $dataFoto['foto_album'] ?>" alt="<?= $dataFoto['judul'] ?>">
                </div>
                <div class="form-detail">
                    <h4>Judul</h4>
                    <p><?= $dataFoto['judul'] ?></p>
                </div>
                <div class="form-detail">
                    <h4>Nama Album</h4>
                    <p><?= $dataFoto['nama_album'] ?></p>
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
            <div class="right-foto_ubah">
                <h2>Ubah Foto</h2>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_foto" value="<?= $dataFoto['id_foto'] ?>">
                    <input type="hidden" name="foto_lama" value="<?= $dataFoto['foto_album'] ?>">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" value="<?= $dataFoto['judul'] ?>" name="judul" id="judul" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="id_album">Nama Album</label>
                        <select name="id_album" id="id_album" required>
                            <?php
                            $id_users = $_SESSION['id_users'];
                            $sqlAlbum = mysqli_query($conn, "SELECT * FROm tbl_album WHERE id_users = '$id_users'");
                            while ($dataAlbum = mysqli_fetch_assoc($sqlAlbum)) {
                                $selected = ($dataFoto['id_album'] == $dataAlbum['id_album']) ? "selected" : "";
                            ?>
                                <option value="<?= $dataAlbum['id_album'] ?>" <?= $selected ?>><?= $dataAlbum['nama_album'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="foto_album">Foto Album</label>
                        <input type="file" name="foto_album" id="foto_album">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" required cols="30" rows="10"><?= $dataFoto['deskripsi'] ?></textarea>
                    </div>
                    <button type="submit" name="ubahFoto" class="btn-dark">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['ubahFoto'])) {
    $id_foto = htmlspecialchars($_POST['id_foto']);
    $judul = htmlspecialchars($_POST['judul']);
    $id_album = htmlspecialchars($_POST['id_album']);
    $tgl_unggah = date("Y-m-d H:i:s");
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $foto_lama = htmlspecialchars($_POST['foto_lama']);
    $id_users = $_SESSION['id_users'];

    if ($_FILES['foto_album']['error'] == 4) {
        $foto_album = $foto_lama;
    } else {
        $foto_album = uploadFoto();
    }

    $sql = mysqli_query($conn, "UPDATE tbl_foto SET judul = '$judul', id_album = '$id_album', tgl_unggah = '$tgl_unggah', deskripsi = '$deskripsi',
    id_users = '$id_users', foto_album = '$foto_album' WHERE id_foto = '$id_foto'");

    if ($sql) {
        echo "
        <script>alert('Data foto berhasil diubah!');
        window.location.href = 'foto.php'</script>
        ";
    } else {
        echo "
        <script>alert('Data foto gagal diubah!');
        window.location.href = 'foto.php'</script>
        ";
    }
}

function uploadFoto()
{
    $namaFile = $_FILES['foto_album']['name'];
    $ukuranFoto = $_FILES['foto_album']['size'];
    $error = $_FILES['foto_album']['error'];
    $tmpFile = $_FILES['foto_album']['tmp_name'];

    if ($error === 4) {
        echo "
        <script>alert('Anda belom upload foto! Harap diupload');
        window.location.href = 'foto.php'</script>
        ";

        return false;
    }

    $ekstensiFotoValid = ['jpg', 'jpeg', 'png', 'gif', 'avif', 'webp'];
    $ekstensiFoto = explode(".", $namaFile);
    $ekstensiFoto = strtolower(end($ekstensiFoto));

    if (!in_array($ekstensiFoto, $ekstensiFotoValid)) {
        echo "
        <script>alert('Yang anda upload bukan foto! dan tidak termasuk ke Ekstensi kami');
        window.location.href = 'foto.php'</script>
        ";

        return false;
    }

    if ($ukuranFoto > 1000000) {
        echo "
        <script>alert('Yang anda upload terlalu besar! MAX 1Mb');
        window.location.href = 'foto.php'</script>
        ";

        return false;
    }

    $namaFileBaru = "IMG_" . uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiFoto;

    move_uploaded_file($tmpFile, "../public/" . $namaFileBaru);
    return $namaFileBaru;
}


?>