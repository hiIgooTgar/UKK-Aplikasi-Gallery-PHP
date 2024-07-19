-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 08:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

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
-- Table structure for table `tbl_album`
--

CREATE TABLE `tbl_album` (
  `id_album` int(11) NOT NULL,
  `nama_album` varchar(128) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `id_users` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_album`
--

INSERT INTO `tbl_album` (`id_album`, `nama_album`, `deskripsi`, `tgl_dibuat`, `id_users`) VALUES
(1, 'Album 1', 'test', '2024-01-03', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_foto`
--

CREATE TABLE `tbl_foto` (
  `id_foto` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_unggah` date NOT NULL,
  `lokasi_foto` varchar(255) NOT NULL,
  `id_album` int(32) NOT NULL,
  `id_users` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_foto`
--

INSERT INTO `tbl_foto` (`id_foto`, `judul`, `deskripsi`, `tgl_unggah`, `lokasi_foto`, `id_album`, `id_users`) VALUES
(2, 'Ucok Sitanggang', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum aperiam omnis dolor veniam saepe alias autem sunt deserunt, quas vitae?\r\n', '2024-01-03', 'onepiece.jpg', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_komentar`
--

CREATE TABLE `tbl_komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_foto` int(32) NOT NULL,
  `id_users` int(32) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tgl_komentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_like_foto`
--

CREATE TABLE `tbl_like_foto` (
  `id_like` int(11) NOT NULL,
  `id_foto` int(32) NOT NULL,
  `id_users` int(32) NOT NULL,
  `tgl_like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
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
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id_users`, `username`, `password`, `email`, `nama_lengkap`, `alamat`) VALUES
(5, 'seva', '$2y$10$2owfx2JST42.3TYqyRZ0uOsVJvvezwATOD/u.DDfaWXlZ8DYujM16', 'seva@gmail.com', 'Seva Manuel Peter', 'Jompo'),
(6, 'aa', '$2y$10$9rnxRETszrsuXRqjVWw19O2zFnnAFc77ROyJmGS/Nm0w82XvJ/XaW', 'aa@gmail.com', 'aa', 'aa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_album`
--
ALTER TABLE `tbl_album`
  ADD PRIMARY KEY (`id_album`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `tbl_foto`
--
ALTER TABLE `tbl_foto`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `tbl_foto_ibfk_2` (`id_album`);

--
-- Indexes for table `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `tbl_komentar_ibfk_2` (`id_foto`);

--
-- Indexes for table `tbl_like_foto`
--
ALTER TABLE `tbl_like_foto`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `tbl_like_foto_ibfk_2` (`id_foto`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_album`
--
ALTER TABLE `tbl_album`
  MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_foto`
--
ALTER TABLE `tbl_foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_like_foto`
--
ALTER TABLE `tbl_like_foto`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_album`
--
ALTER TABLE `tbl_album`
  ADD CONSTRAINT `tbl_album_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tbl_users` (`id_users`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_foto`
--
ALTER TABLE `tbl_foto`
  ADD CONSTRAINT `tbl_foto_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tbl_users` (`id_users`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_foto_ibfk_2` FOREIGN KEY (`id_album`) REFERENCES `tbl_album` (`id_album`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  ADD CONSTRAINT `tbl_komentar_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tbl_users` (`id_users`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_komentar_ibfk_2` FOREIGN KEY (`id_foto`) REFERENCES `tbl_foto` (`id_foto`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_like_foto`
--
ALTER TABLE `tbl_like_foto`
  ADD CONSTRAINT `tbl_like_foto_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tbl_users` (`id_users`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_like_foto_ibfk_2` FOREIGN KEY (`id_foto`) REFERENCES `tbl_foto` (`id_foto`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
