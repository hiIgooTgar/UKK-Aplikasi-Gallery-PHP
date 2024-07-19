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
    <title>Album Saya | UKK</title>
    <link rel="stylesheet" href="../assets/css/album.css">
    <link rel="stylesheet" href="../assets/css/form.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
</head>

<body>
    <?php require "../template/navbar.php" ?>

    <div class="album-container">
        <div class="title">
            <h1>Album Saya</h1>
            <a class="btn-white" href="foto.php">Kembali</a>
        </div>
        <div class="row-album">
            <div class="left-album">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama_album">Nama Album</label>
                        <input type="text" name="nama_album" id="nama_album" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea required name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
                    </div>
                    <button type="submit" name="tambahAlbum" class="btn-dark">Kirim</button>
                </form>
            </div>
            <div class="right-album">
                <table>
                    <tr>
                        <th>No</th>
                        <th>Nama Album</th>
                        <th>Tanggal Dibuat</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $a = 1;
                    $id_users = $_SESSION['id_users'];
                    $sqlAlbum = mysqli_query($conn, "SELECT * FROM tbl_album WHERE id_users = '$id_users'");
                    $cek_data = mysqli_num_rows($sqlAlbum);
                    if ($cek_data == 0) {
                        echo "<td colspan='5' style='padding: 10px; text-align: center;'><h3>Data album masih kosong!</h3></td>";
                    }
                    while ($dataAlbum = mysqli_fetch_array($sqlAlbum)) {
                    ?>
                        <tr>
                            <td><?= $a++ ?></td>
                            <td><?= $dataAlbum['nama_album'] ?></td>
                            <td><?= date('d F Y', strtotime($dataAlbum['tgl_dibuat'])) ?></td>
                            <td><?= $dataAlbum['deskripsi'] ?></td>
                            <td>
                                <div class="badge">
                                    <a href="ubah_album.php?id_album=<?= $dataAlbum['id_album'] ?>">Ubah</a>
                                    <a href="hapus_album.php?id_album=<?= $dataAlbum['id_album'] ?>" onclick="return confirm('Data album ingin dihapus?');">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['tambahAlbum'])) {
    $nama_album = htmlspecialchars($_POST['nama_album']);
    $tgl_dibuat = date("Y-m-d");
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $id_users = $_SESSION['id_users'];

    $cek_album = mysqli_query($conn, "SELECT * FROM tbl_album WHERE nama_album = '$nama_album' AND id_users = '$id_users'");
    if (mysqli_num_rows($cek_album) > 0) {
        echo "
        <script>alert('Nama album sudah terdaftar');
        document.location.href = 'album.php'</script>
        ";
    } else {
        $sql = mysqli_query($conn, "INSERT INTO tbl_album(id_album, nama_album, tgl_dibuat, deskripsi, id_users) VALUES('', '$nama_album', '$tgl_dibuat', '$deskripsi', '$id_users')");
        if ($sql) {
            echo "
            <script>alert('Data album berhasil ditambahkan!');
            document.location.href = 'album.php'</script>
            ";
        } else {
            echo "
            <script>alert('Data album gagal ditambahkan!');
            document.location.href = 'album.php'</script>
            ";
        }
    }
}

?>