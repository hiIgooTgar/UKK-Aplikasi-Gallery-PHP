-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Sep 2024 pada 16.03
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_gallery`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_album`
--

CREATE TABLE `tbl_album` (
  `id_album` int(11) NOT NULL,
  `nama_album` varchar(128) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `id_users` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_album`
--

INSERT INTO `tbl_album` (`id_album`, `nama_album`, `deskripsi`, `tgl_dibuat`, `id_users`) VALUES
(1, 'Album 1', 'test', '2024-01-03', 5),
(3, 'Album 2', 'Album 2', '2024-01-04', 5),
(4, 'Album 3', 'Album 3', '2024-01-04', 5),
(5, 'Album Indra', 'Tentang kehidupan', '2024-01-05', 8),
(6, 'Album Indra 2', 'Album Indra 2', '2024-01-05', 8),
(7, 'Album femas', 'Album femas', '2024-01-05', 7),
(8, 'Album De', 'Album De', '2024-01-05', 7),
(9, 'Album 4', 'Album 4', '2024-01-08', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_foto`
--

CREATE TABLE `tbl_foto` (
  `id_foto` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_unggah` date NOT NULL,
  `foto_album` varchar(255) NOT NULL,
  `kategori` enum('Animal','Anime','Horror','Sport','News','Game') NOT NULL,
  `id_album` int(32) NOT NULL,
  `id_users` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_foto`
--

INSERT INTO `tbl_foto` (`id_foto`, `judul`, `deskripsi`, `tgl_unggah`, `foto_album`, `kategori`, `id_album`, `id_users`) VALUES
(13, 'Event Javanesee', 'Event jejepangan adalah event yang menghadirkan berbagai macam aspek budaya populer Jepang, mulai dari anime, manga, cosplay, musik, hingga makanan. Event ini tentunya menarik banyak penggemar dari berbagai kalangan dan usia', '2024-01-04', '6597728f74083.jpg', 'Anime', 5, 8),
(14, 'Tikus Besar / Wirog', 'Wirok atau tikus wirok (Bandicota bengalensis) adalah jenis tikus besar berasal dari anak-benua India. Pada saat ini sudah menyebar di Pakistan hingga Myanmar, Sri Lanka, Pulau Pinang dan Jawa. Wirok terdiri dari lima anak-jenis, dua di antaranya B. b. bengalensis, B.b. kok, B.b. gracilis, B.b. wardi, dan B.b. varius.', '2024-01-05', '65977cc4e7e7d.jpg', 'Animal', 3, 5),
(15, 'Kapibara', 'Kapibara terlihat seperti marmut raksasa; kapibara jantan mempunyai berat 35 sampai 65 kg dan kapibara betina beratnya 36 sampai 66 kg. Tubuh kapibara relatif besar, tetapi cenderung pendek dan gemuk. Panjangnya 105 sampai 135 cm, sementara tingginya 51 sampai 61 cm dari bahu.', '2024-01-05', '6597a0aa4b36e.jpg', 'Animal', 8, 7),
(16, 'Rajawali', 'Burung rajawali totol merupakan salah satu spesies burung pemangsa dari keluarga Accipitridae dan genus Clanga. disebut dengan sebutan elang bintik ini memiliki nama ilmiah yang disebut dengan clanga clanga atau Greader Spotted Eagle.Termasuk salah satu jenis burung yang dapat dijumpai di Indonesia tapi bukan penetap melainkan burung migrasi.', '2024-01-08', '659b87585d8e4.jpg', 'Animal', 1, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_komentar`
--

CREATE TABLE `tbl_komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_foto` int(32) NOT NULL,
  `id_users` int(32) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tgl_komentar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_komentar`
--

INSERT INTO `tbl_komentar` (`id_komentar`, `id_foto`, `id_users`, `isi_komentar`, `tgl_komentar`) VALUES
(2, 16, 9, 'yabai', '2024-07-19 11:23:54'),
(3, 16, 9, 'yabai', '2024-07-19 11:24:03'),
(5, 16, 5, 'aaa', '2024-07-19 11:37:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_like_foto`
--

CREATE TABLE `tbl_like_foto` (
  `id_like` int(11) NOT NULL,
  `id_foto` int(32) NOT NULL,
  `id_users` int(32) NOT NULL,
  `tgl_like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_like_foto`
--

INSERT INTO `tbl_like_foto` (`id_like`, `id_foto`, `id_users`, `tgl_like`) VALUES
(1, 15, 5, '2024-01-08'),
(2, 13, 5, '2024-01-08'),
(3, 14, 5, '2024-01-08'),
(4, 15, 7, '2024-01-08'),
(5, 14, 7, '2024-01-08'),
(6, 13, 7, '2024-01-08'),
(8, 16, 7, '2024-01-08'),
(12, 16, 5, '2024-07-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_users`
--

INSERT INTO `tbl_users` (`id_users`, `username`, `password`, `email`, `nama_lengkap`, `alamat`) VALUES
(5, 'seva', '$2y$10$2owfx2JST42.3TYqyRZ0uOsVJvvezwATOD/u.DDfaWXlZ8DYujM16', 'seva@gmail.com', 'Seva Manuel Peter', 'Jompo'),
(6, 'aa', '$2y$10$9rnxRETszrsuXRqjVWw19O2zFnnAFc77ROyJmGS/Nm0w82XvJ/XaW', 'aa@gmail.com', 'aa', 'aa'),
(7, 'femas', '$2y$10$bT6rAS0gDBmrBVv8IzcOP.BcA6BPNiE92/ac7DAf227Vae32R37Gy', 'femas@gmail.com', 'Femas Andreas De Santoso', 'Blater'),
(8, 'indra', '$2y$10$RsvZoj83ovujwYDSW2qhrOf0SMkTbgPZC9NyFyttWibcsWRYBHkdm', 'indra@gmail.com', 'Indra Bhakti Darmawan', 'Karangkemiri'),
(9, 'yabai', '$2y$10$uV3gv1Mwwb95S3YMxaIbM.mhFI.3b2K7MB/WYep4GS1kO8EQtqPGO', 'yabai@yahoo.com', 'yabai', 'yabai');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_album`
--
ALTER TABLE `tbl_album`
  ADD PRIMARY KEY (`id_album`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeks untuk tabel `tbl_foto`
--
ALTER TABLE `tbl_foto`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `tbl_foto_ibfk_2` (`id_album`);

--
-- Indeks untuk tabel `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `tbl_komentar_ibfk_2` (`id_foto`);

--
-- Indeks untuk tabel `tbl_like_foto`
--
ALTER TABLE `tbl_like_foto`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `tbl_like_foto_ibfk_2` (`id_foto`);

--
-- Indeks untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_album`
--
ALTER TABLE `tbl_album`
  MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_foto`
--
ALTER TABLE `tbl_foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_like_foto`
--
ALTER TABLE `tbl_like_foto`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_album`
--
ALTER TABLE `tbl_album`
  ADD CONSTRAINT `tbl_album_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tbl_users` (`id_users`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_foto`
--
ALTER TABLE `tbl_foto`
  ADD CONSTRAINT `tbl_foto_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tbl_users` (`id_users`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_foto_ibfk_2` FOREIGN KEY (`id_album`) REFERENCES `tbl_album` (`id_album`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  ADD CONSTRAINT `tbl_komentar_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tbl_users` (`id_users`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_komentar_ibfk_2` FOREIGN KEY (`id_foto`) REFERENCES `tbl_foto` (`id_foto`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_like_foto`
--
ALTER TABLE `tbl_like_foto`
  ADD CONSTRAINT `tbl_like_foto_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tbl_users` (`id_users`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_like_foto_ibfk_2` FOREIGN KEY (`id_foto`) REFERENCES `tbl_foto` (`id_foto`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
