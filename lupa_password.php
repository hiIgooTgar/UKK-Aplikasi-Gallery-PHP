<?php
require "./koneksi/config.php";

$gagal = '';

if (isset($_POST['reset_password'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);

    $query = mysqli_query($conn, "SELECT * FROM tbl_users WHERE username = '$username' AND email = '$email'");
    if (mysqli_num_rows($query) == 1) {
        $new_code = generateRandomPassword();
        $hash_decrypt = password_hash($new_code, PASSWORD_DEFAULT);
        $update_query = "UPDATE tbl_users SET password = '$hash_decrypt' WHERE username = '$username'";
        mysqli_query($conn, $update_query);
    } else {
        $gagal = "Username atau email tidak valid.";
    }
}

function generateRandomPassword($length = 6)
{
    $characters = '0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="assets/css/login_registrasi.css">
    <link rel="stylesheet" href="assets/css/form.css">
</head>

<body>
    <div class="login-container">
        <div class="row-login">
            <div class="title">
                <h1>Lupa Password</h2>
            </div>
            <form method="post" action="">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" autocomplete="off" required>
                </div>
                <br>
                <div class="links">
                    <button type="submit" class="btn-dark" name="reset_password">Reset Password</button>
                    <a href="./login.php">Kembali Login</a>
                </div>
                <?php if (isset($_POST['reset_password']) && isset($new_code)) { ?>
                    <p><?= "Password terbaru anda : " . "<b>$new_code</b>" ?></p>
                <?php } else {  ?>
                    <p><?= $gagal ?></p>
                <?php } ?>
            </form>
        </div>
    </div>
</body>

</html>