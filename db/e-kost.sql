-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2023 at 10:40 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-kost`
--

-- --------------------------------------------------------

--
-- Table structure for table `denah`
--

CREATE TABLE `denah` (
  `id_denah` int(11) NOT NULL,
  `judul_denah` varchar(250) NOT NULL,
  `image_denah` varchar(250) NOT NULL,
  `deskripsi_denah` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `denah`
--

INSERT INTO `denah` (`id_denah`, `judul_denah`, `image_denah`, `deskripsi_denah`) VALUES
(1, 'Pemilik Kos', '1689618218_fddd4da808170e2d4b20.jpg', 'Pemilik Kos'),
(2, 'Halaman Depan Kos', '1689618238_02d8916f705a23aba2fa.jpg', 'Halaman Depan Kos'),
(3, 'Parkiran', '1689618274_5ffd07e52ec0ee3f31c1.jpg', 'Parkiran'),
(4, 'Gym', '1689618292_58ba0567e03a9afd54e3.jpg', 'Gym'),
(5, 'Gym 2', '1689618320_524b1fbea2b6c1c00ae6.jpg', 'Gym 2');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `judul_fasilitas` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `judul_fasilitas`) VALUES
(1, 'AC'),
(7, 'Dapur Dalam'),
(8, 'Dapur Luar'),
(3, 'Gym'),
(4, 'Parkiran'),
(5, 'Toilet Dalam'),
(6, 'Toilet Luar'),
(2, 'TV');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `id_tipe_kamar` int(11) NOT NULL,
  `nomor_kamar` varchar(250) NOT NULL,
  `status_kamar` varchar(100) NOT NULL,
  `lantai_kamar` int(10) NOT NULL,
  `keterangan_kamar` text NOT NULL,
  `harga_kamar` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `id_tipe_kamar`, `nomor_kamar`, `status_kamar`, `lantai_kamar`, `keterangan_kamar`, `harga_kamar`) VALUES
(1, 1, '1', 'Tidak Tersedia', 1, '', 150000),
(2, 1, '2', 'Tersedia', 1, '', 150000),
(3, 1, '3', 'Tersedia', 1, '', 150000),
(4, 2, '4', 'Tersedia', 2, '', 100000),
(5, 2, '5', 'Tersedia', 2, '', 100000),
(6, 2, '6', 'Tersedia', 2, '', 100000),
(7, 3, '7', 'Tersedia', 3, '', 50000),
(8, 2, '8', 'Tersedia', 3, '', 100000),
(9, 1, '9', 'Tersedia', 3, '', 150000);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama_karyawan` varchar(250) NOT NULL,
  `nik_karyawan` varchar(250) NOT NULL,
  `jk_karyawan` varchar(250) NOT NULL,
  `no_telp_karyawan` varchar(13) NOT NULL,
  `alamat_karyawan` varchar(250) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama_karyawan`, `nik_karyawan`, `jk_karyawan`, `no_telp_karyawan`, `alamat_karyawan`, `id_user`) VALUES
(1, 'ujang', '12345678784', 'Laki-laki', '0123456789', 'bali', 3);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-04-16-084521', 'App\\Database\\Migrations\\User', 'default', 'App', 1689414671, 1),
(2, '2023-04-16-084533', 'App\\Database\\Migrations\\Penghuni', 'default', 'App', 1689414671, 1),
(3, '2023-04-16-084542', 'App\\Database\\Migrations\\Karyawan', 'default', 'App', 1689414672, 1),
(4, '2023-04-16-084549', 'App\\Database\\Migrations\\Fasilitas', 'default', 'App', 1689414672, 1),
(5, '2023-04-16-084556', 'App\\Database\\Migrations\\Kamar', 'default', 'App', 1689414672, 1),
(6, '2023-04-16-084639', 'App\\Database\\Migrations\\Penyewaan', 'default', 'App', 1689414672, 1),
(7, '2023-04-24-063805', 'App\\Database\\Migrations\\PenyewaanDetail', 'default', 'App', 1689414672, 1),
(8, '2023-06-14-051508', 'App\\Database\\Migrations\\Tiket', 'default', 'App', 1689414672, 1),
(9, '2023-06-14-051555', 'App\\Database\\Migrations\\TiketDetail', 'default', 'App', 1689414672, 1),
(10, '2023-06-14-093650', 'App\\Database\\Migrations\\TipeKamar', 'default', 'App', 1689414672, 1),
(11, '2023-06-14-095617', 'App\\Database\\Migrations\\TipeKamarFasilitas', 'default', 'App', 1689414672, 1),
(12, '2023-06-14-095622', 'App\\Database\\Migrations\\TipeKamarGambar', 'default', 'App', 1689414672, 1),
(13, '2023-07-05-081016', 'App\\Database\\Migrations\\Denah', 'default', 'App', 1689414672, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penghuni`
--

CREATE TABLE `penghuni` (
  `id_penghuni` int(11) NOT NULL,
  `nama_penghuni` varchar(250) NOT NULL,
  `tgl_lahir_penghuni` date NOT NULL,
  `tempat_lahir_penghuni` varchar(250) NOT NULL,
  `nik_penghuni` varchar(250) NOT NULL,
  `jk_penghuni` varchar(250) NOT NULL,
  `no_telp_penghuni` varchar(13) NOT NULL,
  `alamat_penghuni` varchar(250) NOT NULL,
  `foto_ktp` varchar(250) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `penghuni`
--

INSERT INTO `penghuni` (`id_penghuni`, `nama_penghuni`, `tgl_lahir_penghuni`, `tempat_lahir_penghuni`, `nik_penghuni`, `jk_penghuni`, `no_telp_penghuni`, `alamat_penghuni`, `foto_ktp`, `id_user`) VALUES
(1, 'little', '2020-08-10', 'bogor', '111111111', 'Laki-laki', '1234567890', 'bogor', '1689618624_49a42daeabc043f2ae1f.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id_penyewaan` int(11) NOT NULL,
  `tgl_penyewaan` date NOT NULL,
  `id_penghuni` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `lama_penyewaan` int(100) NOT NULL,
  `last_payment` double NOT NULL,
  `payment_period` int(100) NOT NULL,
  `payment_method` enum('C','M') NOT NULL,
  `last_transaction_time` datetime NOT NULL,
  `last_transaction_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `penyewaan`
--

INSERT INTO `penyewaan` (`id_penyewaan`, `tgl_penyewaan`, `id_penghuni`, `id_kamar`, `lama_penyewaan`, `last_payment`, `payment_period`, `payment_method`, `last_transaction_time`, `last_transaction_status`) VALUES
(1, '2023-07-18', 1, 1, 4, 150000, 1, 'M', '2023-07-18 04:31:32', 'settlement');

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan_detail`
--

CREATE TABLE `penyewaan_detail` (
  `id_penyewaan_detail` int(11) NOT NULL,
  `id_penyewaan` int(11) NOT NULL,
  `no_invoice` char(20) NOT NULL,
  `payment` double NOT NULL,
  `order_id` char(20) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `payment_method` enum('C','M') NOT NULL,
  `transaction_time` datetime NOT NULL,
  `transaction_status` varchar(50) NOT NULL,
  `va_number` char(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `denda` double DEFAULT NULL,
  `periode` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `penyewaan_detail`
--

INSERT INTO `penyewaan_detail` (`id_penyewaan_detail`, `id_penyewaan`, `no_invoice`, `payment`, `order_id`, `payment_type`, `payment_method`, `transaction_time`, `transaction_status`, `va_number`, `bank`, `denda`, `periode`) VALUES
(1, 1, '1807230001', 150000, '947688280', 'bank_transfer', 'M', '2023-07-18 04:31:32', 'settlement', '9886469029234653', 'bni', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` int(11) NOT NULL,
  `id_penghuni` int(11) DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `judul_tiket` varchar(250) NOT NULL,
  `tgl_tiket` date NOT NULL,
  `status_tiket` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tiket_detail`
--

CREATE TABLE `tiket_detail` (
  `id_tiket_detail` int(11) NOT NULL,
  `id_tiket` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `tgl_pesan` date NOT NULL,
  `pesan` text NOT NULL,
  `gambar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipe_kamar`
--

CREATE TABLE `tipe_kamar` (
  `id_tipe_kamar` int(11) NOT NULL,
  `judul_tipe_kamar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tipe_kamar`
--

INSERT INTO `tipe_kamar` (`id_tipe_kamar`, `judul_tipe_kamar`) VALUES
(1, 'Tipe 1'),
(2, 'Tipe 2'),
(3, 'Tipe 3');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_kamar_fasilitas`
--

CREATE TABLE `tipe_kamar_fasilitas` (
  `id_tipe_kamar_fasilitas` int(11) NOT NULL,
  `id_tipe_kamar` int(11) NOT NULL,
  `id_fasilitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tipe_kamar_fasilitas`
--

INSERT INTO `tipe_kamar_fasilitas` (`id_tipe_kamar_fasilitas`, `id_tipe_kamar`, `id_fasilitas`) VALUES
(5, 2, 7),
(6, 2, 3),
(7, 2, 4),
(8, 2, 5),
(9, 1, 1),
(10, 1, 7),
(11, 1, 3),
(12, 1, 4),
(13, 1, 5),
(14, 3, 3),
(15, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_kamar_gambar`
--

CREATE TABLE `tipe_kamar_gambar` (
  `id_tipe_kamar_gambar` int(11) NOT NULL,
  `id_tipe_kamar` int(11) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tipe_kamar_gambar`
--

INSERT INTO `tipe_kamar_gambar` (`id_tipe_kamar_gambar`, `id_tipe_kamar`, `image`) VALUES
(1, 1, '1689617767_3c03f58706a1c39eff48.jpg'),
(2, 1, '1689617767_a33c588416a8255b53a3.jpg'),
(3, 1, '1689617767_f66c3e1ca472ca7d3289.jpg'),
(4, 1, '1689617767_6387c4df0f7ba50ffe43.jpg'),
(5, 1, '1689617767_38e1d582b282285a8c02.jpg'),
(6, 1, '1689617767_35d14be03c5131514d4a.jpg'),
(7, 2, '1689617829_e24d27480ebe34a8fc26.jpg'),
(8, 2, '1689617829_8899e6d99a20d8032494.jpg'),
(9, 2, '1689617829_cf0909bfb54b153cdaac.jpg'),
(10, 2, '1689617829_0a8f787b0ee85e2c9564.jpg'),
(11, 3, '1689617977_b0f6fbfc24325dcc7c84.jpg'),
(12, 3, '1689617977_c7f1c44d651348336ada.jpg'),
(13, 3, '1689617977_ed70318a64261898d5eb.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', 'rikoriyana12@gmail.com', '$2y$10$fUyBimf0BdUBNpkkfpJcYehv593jeCfrbeX2hqFMIz5l8OgiAqYsG', 'admin'),
(2, 'little', 'little@gmail.com', '$2y$10$76kQIi.nSNRBKH1qhNiHeusk4sRDm.edAivjQpd30zbm.VuW1HCyW', 'penghuni'),
(3, 'ujang', 'ujang@gmail.com', '$2y$10$UdoEBYNrYdaphmTGQxGneelMqvJT2FXWBUZUte6k6weipqRDlQOGS', 'karyawan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `denah`
--
ALTER TABLE `denah`
  ADD PRIMARY KEY (`id_denah`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`),
  ADD UNIQUE KEY `judul_fasilitas` (`judul_fasilitas`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`),
  ADD KEY `kamar_id_tipe_kamar_foreign` (`id_tipe_kamar`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD UNIQUE KEY `nik_karyawan` (`nik_karyawan`),
  ADD UNIQUE KEY `no_telp_karyawan` (`no_telp_karyawan`),
  ADD KEY `karyawan_id_user_foreign` (`id_user`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penghuni`
--
ALTER TABLE `penghuni`
  ADD PRIMARY KEY (`id_penghuni`),
  ADD UNIQUE KEY `nik_penghuni` (`nik_penghuni`),
  ADD UNIQUE KEY `no_telp_penghuni` (`no_telp_penghuni`),
  ADD KEY `penghuni_id_user_foreign` (`id_user`);

--
-- Indexes for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id_penyewaan`),
  ADD KEY `penyewaan_id_penghuni_foreign` (`id_penghuni`),
  ADD KEY `penyewaan_id_kamar_foreign` (`id_kamar`);

--
-- Indexes for table `penyewaan_detail`
--
ALTER TABLE `penyewaan_detail`
  ADD PRIMARY KEY (`id_penyewaan_detail`),
  ADD KEY `penyewaan_detail_id_penyewaan_foreign` (`id_penyewaan`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`),
  ADD KEY `tiket_id_penghuni_foreign` (`id_penghuni`),
  ADD KEY `tiket_id_karyawan_foreign` (`id_karyawan`);

--
-- Indexes for table `tiket_detail`
--
ALTER TABLE `tiket_detail`
  ADD PRIMARY KEY (`id_tiket_detail`),
  ADD KEY `tiket_detail_id_tiket_foreign` (`id_tiket`);

--
-- Indexes for table `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  ADD PRIMARY KEY (`id_tipe_kamar`);

--
-- Indexes for table `tipe_kamar_fasilitas`
--
ALTER TABLE `tipe_kamar_fasilitas`
  ADD PRIMARY KEY (`id_tipe_kamar_fasilitas`),
  ADD KEY `tipe_kamar_fasilitas_id_tipe_kamar_foreign` (`id_tipe_kamar`),
  ADD KEY `tipe_kamar_fasilitas_id_fasilitas_foreign` (`id_fasilitas`);

--
-- Indexes for table `tipe_kamar_gambar`
--
ALTER TABLE `tipe_kamar_gambar`
  ADD PRIMARY KEY (`id_tipe_kamar_gambar`),
  ADD KEY `tipe_kamar_gambar_id_tipe_kamar_foreign` (`id_tipe_kamar`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `denah`
--
ALTER TABLE `denah`
  MODIFY `id_denah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `penghuni`
--
ALTER TABLE `penghuni`
  MODIFY `id_penghuni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `id_penyewaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penyewaan_detail`
--
ALTER TABLE `penyewaan_detail`
  MODIFY `id_penyewaan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tiket_detail`
--
ALTER TABLE `tiket_detail`
  MODIFY `id_tiket_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  MODIFY `id_tipe_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipe_kamar_fasilitas`
--
ALTER TABLE `tipe_kamar_fasilitas`
  MODIFY `id_tipe_kamar_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tipe_kamar_gambar`
--
ALTER TABLE `tipe_kamar_gambar`
  MODIFY `id_tipe_kamar_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_id_tipe_kamar_foreign` FOREIGN KEY (`id_tipe_kamar`) REFERENCES `tipe_kamar` (`id_tipe_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penghuni`
--
ALTER TABLE `penghuni`
  ADD CONSTRAINT `penghuni_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD CONSTRAINT `penyewaan_id_kamar_foreign` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penyewaan_id_penghuni_foreign` FOREIGN KEY (`id_penghuni`) REFERENCES `penghuni` (`id_penghuni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penyewaan_detail`
--
ALTER TABLE `penyewaan_detail`
  ADD CONSTRAINT `penyewaan_detail_id_penyewaan_foreign` FOREIGN KEY (`id_penyewaan`) REFERENCES `penyewaan` (`id_penyewaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tiket_id_penghuni_foreign` FOREIGN KEY (`id_penghuni`) REFERENCES `penghuni` (`id_penghuni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tiket_detail`
--
ALTER TABLE `tiket_detail`
  ADD CONSTRAINT `tiket_detail_id_tiket_foreign` FOREIGN KEY (`id_tiket`) REFERENCES `tiket` (`id_tiket`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tipe_kamar_fasilitas`
--
ALTER TABLE `tipe_kamar_fasilitas`
  ADD CONSTRAINT `tipe_kamar_fasilitas_id_fasilitas_foreign` FOREIGN KEY (`id_fasilitas`) REFERENCES `fasilitas` (`id_fasilitas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tipe_kamar_fasilitas_id_tipe_kamar_foreign` FOREIGN KEY (`id_tipe_kamar`) REFERENCES `tipe_kamar` (`id_tipe_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tipe_kamar_gambar`
--
ALTER TABLE `tipe_kamar_gambar`
  ADD CONSTRAINT `tipe_kamar_gambar_id_tipe_kamar_foreign` FOREIGN KEY (`id_tipe_kamar`) REFERENCES `tipe_kamar` (`id_tipe_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
