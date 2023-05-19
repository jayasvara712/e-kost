-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 04:01 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

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
(7, 'Area Parkir'),
(5, 'Dapur Bersama'),
(2, 'Kamar Mandi Dalam'),
(3, 'Kamar Mandi Luar'),
(6, 'Laundry'),
(9, 'Listrik'),
(12, 'TV'),
(8, 'Wifi');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `nomor_kamar` varchar(250) NOT NULL,
  `status_kamar` varchar(100) NOT NULL,
  `keterangan_kamar` text NOT NULL,
  `harga_kamar` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `nomor_kamar`, `status_kamar`, `keterangan_kamar`, `harga_kamar`) VALUES
(29, '01', 'Tersedia', '-', 150000),
(30, '02', 'Tersedia', '-', 1500000),
(33, '03', 'Tersedia', '-', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `kamar_detail`
--

CREATE TABLE `kamar_detail` (
  `id_kamar_detail` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_fasilitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kamar_detail`
--

INSERT INTO `kamar_detail` (`id_kamar_detail`, `id_kamar`, `id_fasilitas`) VALUES
(90, 29, 1),
(91, 29, 7),
(92, 29, 5),
(93, 30, 1),
(94, 30, 5),
(98, 33, 5),
(99, 33, 3);

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
(2, 'Ujang', '123456', 'Laki-laki', '1234567891', 'Ujang', 11);

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
(16, '2023-04-16-084521', 'App\\Database\\Migrations\\User', 'default', 'App', 1682318945, 1),
(17, '2023-04-16-084533', 'App\\Database\\Migrations\\Penghuni', 'default', 'App', 1682318945, 1),
(18, '2023-04-16-084542', 'App\\Database\\Migrations\\Karyawan', 'default', 'App', 1682318945, 1),
(19, '2023-04-16-084549', 'App\\Database\\Migrations\\Fasilitas', 'default', 'App', 1682318945, 1),
(20, '2023-04-16-084556', 'App\\Database\\Migrations\\Kamar', 'default', 'App', 1682318945, 1),
(21, '2023-04-16-084639', 'App\\Database\\Migrations\\Penyewaan', 'default', 'App', 1682318945, 1),
(22, '2023-04-22-071732', 'App\\Database\\Migrations\\KamarDetail', 'default', 'App', 1682318945, 1),
(23, '2023-04-24-063805', 'App\\Database\\Migrations\\DetailPenyewaan', 'default', 'App', 1682318945, 1);

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
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `penghuni`
--

INSERT INTO `penghuni` (`id_penghuni`, `nama_penghuni`, `tgl_lahir_penghuni`, `tempat_lahir_penghuni`, `nik_penghuni`, `jk_penghuni`, `no_telp_penghuni`, `alamat_penghuni`, `id_user`) VALUES
(13, 'jaya', '2023-05-14', 'Bogor', '12312312312312312', 'Laki-laki', '12345678910', 'Bogor', 17),
(14, 'I Komang Mertadana Swastika Yasa', '2000-03-19', 'Denpasar', '510305190300001', 'Laki-laki', '0896 3583 160', 'Jalan By Pass Ngurah Rai No 17 Nusa Dua', 18);

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
(28, '2023-05-14', 13, 33, 2, 200000, 1, 'M', '2023-05-14 19:01:43', 'cancel'),
(29, '2023-05-14', 13, 33, 3, 200000, 3, 'M', '2023-05-16 19:18:20', 'settlement'),
(71, '2023-05-17', 14, 33, 1, 200000, 1, 'M', '2023-05-16 23:49:08', 'pending'),
(72, '2023-05-17', 14, 30, 1, 1500000, 1, 'M', '2023-05-16 23:50:10', 'pending');

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
  `bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `penyewaan_detail`
--

INSERT INTO `penyewaan_detail` (`id_penyewaan_detail`, `id_penyewaan`, `no_invoice`, `payment`, `order_id`, `payment_type`, `payment_method`, `transaction_time`, `transaction_status`, `va_number`, `bank`) VALUES
(24, 28, '1405230003', 200000, '953769059', 'bank_transfer', 'M', '2023-05-14 19:01:43', 'cancel', '9886469096673568', 'bni'),
(26, 29, '1405230005', 200000, '397639604', 'bank_transfer', 'M', '2023-05-14 19:33:47', 'settlement', '9886469015996420', 'bni'),
(27, 29, '1405230006', 200000, '1128133055', 'bank_transfer', 'M', '2023-05-14 19:37:19', 'expire', '9886469075836145', 'bni'),
(42, 29, '1605230001', 200000, '1098970045', 'bank_transfer', 'M', '2023-05-16 19:17:49', 'settlement', '9886469059060737', 'bni'),
(43, 29, '1605230001', 200000, '835368554', 'bank_transfer', 'M', '2023-05-16 19:18:20', 'settlement', '9886469038252116', 'bni'),
(45, 71, '1705230002', 200000, '839241434', 'bank_transfer', 'M', '2023-05-16 23:49:08', 'pending', '64690421317', 'bca'),
(46, 72, '1705230003', 1500000, '2141193238', 'bank_transfer', 'M', '2023-05-16 23:50:10', 'pending', '64690082703', 'bca');

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
(4, 'admin', 'admin@gmail.com', '$2y$10$8Fg0MpL2Xa5obYh3b7WGie6WTOuRdgkX9xMv2aAxc5p2McED5T0Z6', 'admin'),
(11, 'ujang', 'ujang@gmail.com', '$2y$10$NMTnpPqzdpN62N51BEJ6V.dRJyyWE5/GjHVuIUNUZ0OeHOuKZ834y', 'karyawan'),
(17, 'littlejay', 'jayasvara712@gmail.com', '$2y$10$M.voyKNrX94mTEmCDDa45.2lr2/AGehbu0cfPkX.UAgph7Bmy/WV2', 'penghuni'),
(18, 'mangana19', 'mertadana572@gmail.com', '$2y$10$2wbRWJMlG996JDdmf5V3bukX91gqvWVTxm/ZS1mIXqEwb1qQqK1pa', 'penghuni'),
(19, 'koko1', 'sndjkabasjkdb@gmail.com', '$2y$10$UCjdxYFa9A7hNzlEZTvaGuXADSEL3vWfYnWBSp/w36rjlbO5uNmMq', 'penghuni'),
(20, 'koko12', 'kokoko@gmail.com', '$2y$10$twS3C1xtv5zSggQxHvr1Wu5B5aLtpntYOm2ONMiBbH1LccnFQNmHe', 'penghuni');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `kamar_detail`
--
ALTER TABLE `kamar_detail`
  ADD PRIMARY KEY (`id_kamar_detail`);

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
  ADD KEY `detail_penyewaan_id_penyewaan_foreign` (`id_penyewaan`);

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
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `kamar_detail`
--
ALTER TABLE `kamar_detail`
  MODIFY `id_kamar_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `penghuni`
--
ALTER TABLE `penghuni`
  MODIFY `id_penghuni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `id_penyewaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `penyewaan_detail`
--
ALTER TABLE `penyewaan_detail`
  MODIFY `id_penyewaan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `detail_penyewaan_id_penyewaan_foreign` FOREIGN KEY (`id_penyewaan`) REFERENCES `penyewaan` (`id_penyewaan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
