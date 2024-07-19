<?php

require "../koneksi/config.php";

if (!isset($_GET['id_foto'])) {
    header("Location: ../login.php");
}

$id_foto = $_GET['id_foto'];
$sql = mysqli_query($conn, "DELETE FROM tbl_foto WHERE id_foto = '$id_foto'");

if ($sql) {
    echo "
    <script>alert('Data foto berhasil dihapus!');
    window.location.href = 'foto.php'</script>
    ";
} else {
    echo "
    <script>alert('Data foto berhasil dihapus!');
    window.location.href = 'foto.php'</script>
    ";
}
