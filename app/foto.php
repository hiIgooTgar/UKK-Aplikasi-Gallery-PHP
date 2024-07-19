<?php

require "../koneksi/config.php";
session_start();

if (!isset($_SESSION['id_users'])) {
    header("Location: ../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/foto.css">
    <link rel="stylesheet" href="../assets/css/form.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
</head>

<body>
    <?php require "../template/navbar.php" ?>

    <div class="foto-container">
        <div class="title">
            <h1>Foto saya</h1>
            <div class="btn">
                <a class="btn-white" href="album.php">Tambah Album</a>
                <p class="btn-white" onclick="showModal()">Tambah Foto</p>
            </div>
        </div>
        <div class="row-foto">
            <?php
            $id_users = $_SESSION['id_users'];
            $sqlFoto = mysqli_query($conn, "SELECT * FROm tbl_foto WHERE id_users = '$id_users'");
            $cek_foto = mysqli_num_rows($sqlFoto);
            if ($cek_foto == 0) {
                echo "<h1 class='kt-kosong'>Data foto masih kosong!</h1>";
            } else {
                while ($dataFoto = mysqli_fetch_assoc($sqlFoto)) {
            ?>
                    <div class="box-foto">
                        <div class="content-img">
                            <div class="overlay">
                                <a href="ubah_foto.php?id_foto=<?= $dataFoto['id_foto'] ?>">Ubah</a>
                                <a href="hapus_foto.php?id_foto=<?= $dataFoto['id_foto'] ?>" onclick="return confirm('Apakah yakin dihapus?');">Hapus</a>
                            </div>
                            <img src="../public/<?= $dataFoto['foto_album'] ?>" alt="<?= $dataFoto['judul'] ?>">
                        </div>
                        <div class="content">
                            <h4><?= $dataFoto['judul'] ?></h4>
                            <p><?= $dataFoto['deskripsi'] ?></p>
                            <div class="date">
                                <p><?= $dataFoto['tgl_unggah'] ?></p>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>


    <div class="modal-foto" id="modalFoto">
        <main class="content">
            <div class="title">
                <h1>Tambah Foto</h1>
                <button type="button" onclick="hideModal()">&times;</button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" id="judul" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="id_album">Nama Album</label>
                    <select name="id_album" id="id_album" required>
                        <?php
                        $id_users = $_SESSION['id_users'];
                        $sqlAlbum = mysqli_query($conn, "SELECT * FROm tbl_album WHERE id_users = '$id_users'");
                        while ($dataAlbum = mysqli_fetch_assoc($sqlAlbum)) {
                        ?>
                            <option value="<?= $dataAlbum['id_album'] ?>"><?= $dataAlbum['nama_album'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="foto_album">Foto Album</label>
                    <input type="file" name="foto_album" id="foto_album">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" required cols="30" rows="10"></textarea>
                </div>
                <button type="submit" name="tambahFoto" class="btn-dark">Unggah</button>
            </form>
        </main>
    </div>


    <script>
        const modalFoto = document.getElementById("modalFoto");

        function showModal() {
            modalFoto.style.display = 'flex';
        }

        function hideModal() {
            modalFoto.style.display = 'none';
        }
    </script>
</body>

</html>

<?php

if (isset($_POST['tambahFoto'])) {
    $judul = htmlspecialchars($_POST['judul']);
    $id_album = htmlspecialchars($_POST['id_album']);
    $tgl_unggah = date("Y-m-d H:i:s");
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $id_users = $_SESSION['id_users'];

    $foto_album = uploadFoto();
    if (!$foto_album) {
        return false;
    } else {
        $sql = mysqli_query($conn, "INSERT INTO tbl_foto(id_foto, judul, id_album, tgl_unggah, deskripsi, id_users, foto_album) 
        VALUES('', '$judul', '$id_album', '$tgl_unggah', '$deskripsi', '$id_users', '$foto_album')");

        if ($sql) {
            echo "
            <script>alert('Data foto berhasil diunggah');
            window.location.href = 'foto.php'</script>
            ";
        } else {
            echo "
            <script>alert('Data foto gagal diunggah');
            window.location.href = 'foto.php'</script>
            ";
        }
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