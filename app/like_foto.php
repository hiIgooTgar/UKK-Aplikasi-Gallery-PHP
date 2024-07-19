<?php

require "../koneksi/config.php";

session_start();

if (!isset($_GET['id_foto'])) {
    header("Location: ../login.php");
}

if (!isset($_SESSION['id_users'])) {
    echo "
    <script>alert('Anda harus login dahulu!');
    window.location.href = '../login.php'</script>
    ";
} else {
    $id_foto = $_GET['id_foto'];
    $id_users = $_SESSION['id_users'];

    $sql = mysqli_query($conn, "SELECT * FROM tbl_like_foto WHERE id_foto = '$id_foto' AND id_users = '$id_users'");
    if (mysqli_num_rows($sql) == 1) {
        $unlike = mysqli_query($conn, "DELETE FROM tbl_like_foto WHERE id_foto = '$id_foto' AND id_users = '$id_users'");
        header("Location: ../index.php");
    } else {
        $tgl_like = date("Y-m-d");
        $like = mysqli_query($conn, "INSERT INTO tbl_like_foto(id_like, id_foto, id_users, tgl_like) VALUES('', '$id_foto', '$id_users', '$tgl_like')");
        header("Location: ../index.php");
    }
}
