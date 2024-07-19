<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>

<body>
    <?php
    require "koneksi/config.php";
    session_start();

    if (!isset($_SESSION['id_users'])) {
    ?>
        <nav class="navbar">
            <div class="logo">
                <a href="">UKK</a>
            </div>
            <div class="nav-list">
                <a href="registrasi.php">Get Starter</a>
                <a href="login.php">Login</a>
            </div>
        </nav>
    <?php
    } else {
    ?>
        <nav class="navbar">
            <div class="logo">
                <a href="">UKK</a>
            </div>
            <div class="nav-list">
                <a href="index.php">Home</a>
                <a href="app/foto.php">Foto Saya</a>
                <a href="logout.php">Logout</a>
            </div>
        </nav>

        <section class="welcome">
            <main class="content">
                <h1>Selamat Datang, <span><?= $_SESSION['nama_lengkap'] ?></span></h1>
                <h2>Di website UKK | Menyimpan foto kesukaan anda!</h2>
            </main>
        </section>

    <?php } ?>

    <section class="foto-container">
        <div class="title">
            <h1>Semua Foto</h1>
        </div>
        <div class="row-foto">
            <?php
            $sqlAll = mysqli_query($conn, "SELECT tbl_foto.*, tbl_users.nama_lengkap FROM tbl_foto 
            INNER JOIN tbl_users ON tbl_foto.id_users = tbl_users.id_users ORDER BY tgl_unggah DESC ");
            $cek_foto = mysqli_num_rows($sqlAll);
            if ($cek_foto == 0) {
                echo "<h2 class='kt-kosong'>Foto tidak ada yang upload!</h2>";
            } else {
                while ($dataFoto = mysqli_fetch_array($sqlAll)) {

            ?>
                    <div class="box-foto">
                        <div class="content-img">
                            <img src="./public/<?= $dataFoto['foto_album'] ?>" alt="<?= $dataFoto['judul'] ?>">
                        </div>
                        <div class="content">
                            <h5><?= $dataFoto['nama_lengkap'] ?></h5>
                            <div class="like-komen">
                                <a href="app/like_foto.php?id_foto=<?= $dataFoto['id_foto'] ?>">Like :
                                    <?php
                                    $id_foto = $dataFoto['id_foto'];
                                    $sqlLike = mysqli_query($conn, "SELECT * FROM tbl_like_foto WHERE id_foto = '$id_foto'");
                                    echo mysqli_num_rows($sqlLike);
                                    ?>
                                </a>
                                <a href="app/komentar.php?id_foto=<?= $dataFoto['id_foto'] ?>">Komentar :
                                    <?php
                                    $id_foto = $dataFoto['id_foto'];
                                    $sqlKomentar = mysqli_query($conn, "SELECT * FROM tbl_komentar WHERE id_foto = '$id_foto'");
                                    echo mysqli_num_rows($sqlKomentar);
                                    ?>
                                </a>
                            </div>
                            <h4><?= $dataFoto['judul'] ?></h4>
                            <p><?= $dataFoto['deskripsi'] ?></p>
                            <div class="date">
                                <p><?= $dataFoto['tgl_unggah'] ?></p>
                            </div>
                        </div>
                    </div>

            <?php
                }
            }
            ?>
        </div>
    </section>

    <footer>
        <p>UKK | MyGallery By <span class="nama">Igo Tegar Prambudhy</span> | &copy;
            <span id="tahun_cp">
                <script>
                    document.write(new Date().getFullYear());
                </script>
            </span>
        </p>
    </footer>
</body>

</html>