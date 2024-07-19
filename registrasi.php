<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi | UKK</title>
    <link rel="stylesheet" href="assets/css/login_registrasi.css">
    <link rel="stylesheet" href="assets/css/form.css">
</head>

<body>
    <div class="registrasi-container">
        <div class="row-registrasi">
            <div class="title">
                <h1>Registrasi</h1>
                <h3>Membuat akun registrasi UKK anda!</h3>
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" required autocomplete="off">
                </div>
                <button type="submit" name="registrasi" class="btn-dark">Registrasi</button>
                <p class="links">Sudah punya akun? <a href="./login.php">Login</a> sekarang!</p>
            </form>
        </div>
    </div>
</body>

</html>

<?php

require "koneksi/config.php";

if (isset($_POST['registrasi'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
    $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
    $email = htmlspecialchars($_POST['email']);
    $alamat = htmlspecialchars($_POST['alamat']);

    $cek_registrasi = mysqli_query($conn, "SELECT * FROM tbl_users WHERE username = '$username'");
    if (mysqli_num_rows($cek_registrasi) > 0) {
        echo "
        <script>alert('Username sudah terdata! Harap yang lain');
        document.location.href = 'registrasi.php'</script>
        ";
    } else {
        $sql = mysqli_query($conn, "INSERT INTO tbl_users(id_users, username, password, nama_lengkap, email, alamat) VALUES('', '$username', '$password', '$nama_lengkap', '$email', '$alamat')");
        if ($sql) {
            echo "
            <script>alert('Registrasi berhasil!');
            document.location.href = 'login.php'</script>
            ";
        } else {
            echo "
            <script>alert('Registrasi gagal!');
            document.location.href = 'registrasi.php'</script>
            ";
        }
    }
}

?>