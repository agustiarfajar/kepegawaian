-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2022 at 09:53 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kel3-if6_if-6_kepegawaian`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `countBagian` ()   
BEGIN
  SELECT COUNT(*) as jml_bagian FROM bagian;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `countKaryawan` ()   
BEGIN
  SELECT COUNT(*) as jml_karyawan FROM karyawan;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `countL` ()   
BEGIN 
SELECT COUNT(jk) as jk_l FROM karyawan WHERE jk='L'; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `countLembur` ()   
BEGIN 
  SELECT COUNT(*) as jml_lembur FROM lembur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `countP` ()   
BEGIN 
  SELECT COUNT(jk) as jk_p FROM karyawan WHERE jk='P'; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `countUser` ()   
BEGIN
  SELECT COUNT(*) as jml_user FROM user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getFKDataLembur` ()   
BEGIN
  SELECT l.kode_lembur, k.kode_karyawan, l.tanggal, l.keterangan, u.kode_user
  FROM lembur l JOIN karyawan k ON l.kode_karyawan = k.kode_karyawan
  JOIN user u ON l.kode_user = u.kode_user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getListBagian` ()   
BEGIN
  SELECT * FROM bagian ORDER BY kode_bagian;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kodeBagian` ()   
BEGIN
  SELECT MAX(kode_bagian) as kodeTerbesar FROM bagian;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kodeKaryawan` ()   
BEGIN
  SELECT MAX(kode_karyawan) as kodeTerbesar FROM karyawan;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kodeLembur` ()   
BEGIN
  SELECT MAX(kode_lembur) as kodeTerbesar FROM lembur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kodeUser` ()   
BEGIN 
  SELECT MAX(kode_user) as kodeTerbesar FROM user; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `noSlipOtomatis` ()   
BEGIN
  SELECT MAX(no_slip) as kodeTerbesar FROM penggajian;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bagian`
--

CREATE TABLE `bagian` (
  `kode_bagian` varchar(8) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `gaji_pokok` double NOT NULL,
  `tunjangan_bagian` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`kode_bagian`, `nama`, `gaji_pokok`, `tunjangan_bagian`) VALUES
('B0001', 'Staff', 1000000, 50000),
('B0002', 'Manager', 3000000, 200000),
('B0003', 'Supervisor', 2000000, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `kode_karyawan` varchar(8) NOT NULL,
  `nik` char(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kode_bagian` varchar(8) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `status_kawin` enum('kawin','belum_kawin') NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`kode_karyawan`, `nik`, `nama`, `kode_bagian`, `jk`, `alamat`, `no_telp`, `tanggal_lahir`, `status_kawin`, `tanggal_masuk`) VALUES
('K0001', '10120201', 'Muhammad Upin', 'B0001', 'L', 'Bandung', '081273849506', '1989-07-13', 'belum_kawin', '2022-07-03'),
('K0002', '10120202', 'Muhammad Ipin', 'B0002', 'L', 'Bandung', '081234567890', '1989-07-13', 'kawin', '2022-07-03'),
('K0003', '12345678', 'Siti Syantique', 'B0002', 'P', 'Bandung', '081239462718', '1990-08-12', 'belum_kawin', '2022-06-03'),
('K0004', '17293625', 'Tina Tun', 'B0002', 'P', 'Bandung', '081294629503', '1995-08-06', 'belum_kawin', '2022-08-03'),
('K0005', '17293647', 'Syahrini', 'B0003', 'P', 'Bandung', '081294620384', '1989-12-17', 'kawin', '2022-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `lembur`
--

CREATE TABLE `lembur` (
  `kode_lembur` varchar(8) NOT NULL,
  `kode_karyawan` varchar(8) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `kode_user` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lembur`
--

INSERT INTO `lembur` (`kode_lembur`, `kode_karyawan`, `tanggal`, `keterangan`, `kode_user`) VALUES
('L0001', 'K0001', '2022-07-31', 'Lembur Laporan Keuangan', 'US001'),
('L0002', 'K0001', '2022-08-20', 'Lembur gan', 'US001'),
('L0003', 'K0003', '2022-08-21', 'Kerja keras bagai quda', 'US001'),
('L0004', 'K0004', '2022-08-24', 'Lembur', 'US001'),
('L0005', 'K0005', '2022-08-31', 'Lembur ceu', 'US001');

-- --------------------------------------------------------

--
-- Table structure for table `penggajian`
--

CREATE TABLE `penggajian` (
  `no_slip` varchar(11) NOT NULL,
  `periode_gaji` date NOT NULL,
  `tanggal` date NOT NULL,
  `kode_karyawan` varchar(8) NOT NULL,
  `gaji_pokok` double NOT NULL,
  `tunjangan_bagian` double NOT NULL,
  `total_lembur` int(3) NOT NULL,
  `total_gaji` double NOT NULL,
  `kode_user` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penggajian`
--

INSERT INTO `penggajian` (`no_slip`, `periode_gaji`, `tanggal`, `kode_karyawan`, `gaji_pokok`, `tunjangan_bagian`, `total_lembur`, `total_gaji`, `kode_user`) VALUES
('INV/0001', '2022-08-01', '2022-08-31', 'K0001', 1000000, 50000, 2, 1150000, 'US002'),
('INV/0002', '2022-08-03', '2022-08-31', 'K0003', 2000000, 100000, 0, 2100000, 'US002'),
('INV/0003', '2022-08-18', '2022-08-31', 'K0004', 3000000, 200000, 1, 3250000, 'US002'),
('INV/0004', '2022-08-03', '2022-08-31', 'K0005', 2000000, 100000, 1, 2150000, 'US002'),
('INV/0005', '2022-08-03', '2022-08-03', 'K0002', 3000000, 200000, 0, 3200000, 'US002');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `kode_user` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `level` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kode_user`, `nama`, `no_telp`, `username`, `pass`, `level`) VALUES
('US001', 'Ujang', '087793919231', 'ujang', '*A2A002F8BE91B2C1AC4F3D1F108F6D7D5ED5A918', '2'),
('US002', 'Justin', '089612345678', 'justin', '*418F5110126E965257925334DE2CECD97AE332B5', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`kode_bagian`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`kode_karyawan`),
  ADD KEY `kode_bagian` (`kode_bagian`);

--
-- Indexes for table `lembur`
--
ALTER TABLE `lembur`
  ADD PRIMARY KEY (`kode_lembur`),
  ADD KEY `kode_karyawan` (`kode_karyawan`),
  ADD KEY `kode_user` (`kode_user`);

--
-- Indexes for table `penggajian`
--
ALTER TABLE `penggajian`
  ADD PRIMARY KEY (`no_slip`),
  ADD KEY `kode_karyawan` (`kode_karyawan`),
  ADD KEY `kode_user` (`kode_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kode_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan1_ibfk_1` FOREIGN KEY (`kode_bagian`) REFERENCES `bagian` (`kode_bagian`);

--
-- Constraints for table `lembur`
--
ALTER TABLE `lembur`
  ADD CONSTRAINT `lembur1_ibfk_1` FOREIGN KEY (`kode_karyawan`) REFERENCES `karyawan` (`kode_karyawan`),
  ADD CONSTRAINT `user1` FOREIGN KEY (`kode_user`) REFERENCES `user` (`kode_user`);

--
-- Constraints for table `penggajian`
--
ALTER TABLE `penggajian`
  ADD CONSTRAINT `karyawan2` FOREIGN KEY (`kode_karyawan`) REFERENCES `karyawan` (`kode_karyawan`),
  ADD CONSTRAINT `user2` FOREIGN KEY (`kode_user`) REFERENCES `user` (`kode_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
