<?php

require "../koneksi/config.php";

if (!isset($_GET['id_album'])) {
    header("Location: ../login.php");
}

$id_album = $_GET['id_album'];
$sql = mysqli_query($conn, "DELETE FROM tbl_album WHERE id_album = '$id_album'");

if ($sql) {
    echo "
    <script>alert('Data album berhasil dihapus!');
    document.location.href = 'album.php'</script>
    ";
} else {
    echo "
    <script>alert('Data album gagal dihapus!');
    document.location.href = 'album.php'</script>
    ";
}
