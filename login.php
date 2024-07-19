<?php

require "koneksi/config.php";

session_start();
if (!empty($_SESSION['login'])) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | UKK</title>
    <link rel="stylesheet" href="assets/css/login_registrasi.css">
    <link rel="stylesheet" href="assets/css/form.css">
</head>

<body>
    <div class="login-container">
        <div class="row-login">
            <div class="title">
                <h1>Login</h1>
                <h3>Selamat datang di UKK</h3>
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
                <button type="submit" name="login" class="btn-dark">Login</button>
                <div class="links">
                    <p>Belum punya akun? <a href="registrasi.php">Registrasi</a> sekarang!</p>
                    <a href="lupa_password.php">Lupa Password?</a>
                </div>
                <p>Kembali ke <a href="index.php">Home</a></p>
            </form>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $cek_login = mysqli_query($conn, "SELECT * FROM tbl_users WHERE username = '$username'");
    if (mysqli_num_rows($cek_login) > 0) {
        $data = mysqli_fetch_array($cek_login);
        if (password_verify($password, $data['password'])) {
            $_SESSION['login'] = 1;
            $_SESSION['username'] = $data['username'];
            $_SESSION['password'] = $data['password'];
            $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['alamat'] = $data['alamat'];
            $_SESSION['id_users'] = $data['id_users'];
            header("Location: index.php");
        } else {
            echo "
            <script>alert('Password salah!');
            document.location.href = 'login.php'</script>
            ";
        }
    } else {
        echo "
        <script>alert('Username atau Password salah!');
        document.location.href = 'login.php'</script>
        ";
    }
}

?>