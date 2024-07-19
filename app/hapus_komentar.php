<?php

require "../koneksi/config.php";

if (!isset($_GET['id_komentar'])) {
    header("Location: ../login.php");
}

$id_komentar = $_GET['id_komentar'];
$sql = mysqli_query($conn, "DELETE FROM tbl_komentar WHERE id_komentar = '$id_komentar'");
header("Location: " . $_SERVER['HTTP_REFERER']);
