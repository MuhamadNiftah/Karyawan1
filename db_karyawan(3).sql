-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2025 at 06:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_karyawan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(10, 'Niftah', '$2y$10$Goqqi4qUdBtbgxlfTJzshuE8nCMNnx8tifIa4d9RyXi31cVYjAKU6', 'admin'),
(11, 'atnonnio', '$2y$10$ea7gr9L9UdMai2ArMWtbEeOEwMMP6ZFbMGSrDFZTWXHFuKgO6Jy5m', 'admin'),
(12, 'ucok', '$2y$10$llO.LhJVmeUkc2hHrjDj8.5MbiJ1e0pUwhbit5.wHWzdJNLABaWGS', 'admin'),
(13, 'atar', '$2y$10$Ym0gRLWoTdAwxtctnOG2OeFttaRRmdDFGfKa2.Z1oRb103v4pcA/6', 'admin'),
(14, 'ujang', '$2y$10$sz.RUG8JGOAcq1ckkbJ8rOR2m.4sEF92Bv45N1s9ct5ljN/HAXNxu', 'user'),
(15, 'osep', '$2y$10$Hm40sC1fwudjQTGHuI8OmusbiniG/KdPwWm2JvXdsJAeRlmkVOHLK', 'admin'),
(16, 'ada', '$2y$10$C1t9R4/32VqbL0EYMFYgzOp7sKAquAR4aIyCp512MWNtgx9bg69Wq', 'admin'),
(17, 'aji', '$2y$10$/bsep15RVr9oX043jmxCwOYnKTf3VScTSl4vVY0GEUbfmCAMJYpuC', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id` int(11) NOT NULL,
  `kode_id` int(11) DEFAULT NULL,
  `nama_pegawai` varchar(100) DEFAULT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `divisi` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `alasan` varchar(100) DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `mulai_cuti` date DEFAULT NULL,
  `berakhir_cuti` date DEFAULT NULL,
  `alamat_cuti` text DEFAULT NULL,
  `pertimbangan_atasan` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'Menunggu Approval'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id`, `kode_id`, `nama_pegawai`, `nik`, `divisi`, `jabatan`, `telepon`, `alasan`, `tanggal_pengajuan`, `durasi`, `mulai_cuti`, `berakhir_cuti`, `alamat_cuti`, `pertimbangan_atasan`, `catatan`, `id_karyawan`, `status`) VALUES
(9, NULL, 'Trisa Fitri Widiawaty', '1842002', 'Legal & Compliance', 'Legal & Compliance', '82217953225', 'Cuti Melahirkan', '2025-07-07', 1, '2025-07-08', '2025-07-07', 'asd', 'asd', 'asd', 1, 'Menunggu Approval'),
(10, NULL, 'Dian Ade Putra', '21041502', 'SETTLEMENT', 'SETTLEMENT', '81770555855', 'Cuti Melahirkan', '2025-07-07', 1, '2025-07-07', '2025-07-07', 'jl ada', 'okwe', 'iya', 11, 'Menunggu Approval'),
(11, NULL, 'Endah Nisa Fauziawati', '1811007', 'Tax', 'Tax', '81221617507', 'Cuti Melahirkan', '2025-07-11', 2, '2025-07-11', '2025-07-12', 'jl aku', 'oke', 'siap', 7, 'Menunggu Approval'),
(42, 1, 'Trisa Fitri Widiawaty', '1842002', 'Legal & Compliance', 'Legal & Compliance', '82217953225', 'Cuti Menikah', '2222-02-22', 2, '2222-02-22', '2222-02-22', 'jl aku', 'oke', 'baik', 1, 'Menunggu Approval'),
(43, 1, 'Trisa Fitri Widiawaty', '1842002', 'Legal & Compliance', 'Legal & Compliance', '82217953225', 'Cuti Menikah', '1111-11-11', 1, '1111-11-11', '2222-02-22', 'oaksokaoskas', 'saksajksak', 'sakjkahskahs', 1, 'Menunggu Approval'),
(44, 2, 'Adithia Sandria', '1842003', 'UKK', 'UKK', '82125760978', 'Cuti Menikah', '1111-11-11', 1, '2222-02-22', '2222-02-22', 'jl ada', 'oke', 'mantap', 2, 'Menunggu Approval'),
(45, 4, 'Diny Nurani', '20081001', 'HRD', 'HRD', '85871603363', 'Cuti Menikah', '1111-11-11', 1, '1111-11-11', '0000-00-00', 'jl aku', 'oke', 'mantap', 4, 'Menunggu Approval');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `no_id` int(11) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `gender` enum('L','P') DEFAULT NULL,
  `ttl` varchar(50) DEFAULT NULL,
  `divisi` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `no_id`, `nik`, `nama`, `gender`, `ttl`, `divisi`, `jabatan`, `telp`) VALUES
(1, 1, '1842002', 'Trisa Fitri Widiawaty', 'P', '16 Maret 1994', 'Legal & Compliance', 'Legal & Compliance', '82217953225'),
(2, 2, '1842003', 'Adithia Sandria', 'L', '24 Agustus 1995', 'UKK', 'UKK', '82125760978'),
(3, 3, '21120601', 'Andrie Indriana, S.S', 'L', '14 Desember 1976', 'Legal & Compliance', 'Legal & Compliance', '81809289889'),
(4, 4, '20081001', 'Diny Nurani', 'P', '14 Juni 1995', 'HRD', 'HRD', '85871603363'),
(5, 5, '1811001', 'Annisa Prinayanti', 'P', '30 Mei 1996', 'Finance', 'Finance', '859138000000'),
(6, 6, '1811004', 'Shely Nurcahyawati', 'P', '28-Nov-95', 'Finance', 'Finance', '87832990113'),
(7, 7, '1811007', 'Endah Nisa Fauziawati', 'P', '4 Maret 1997', 'Tax', 'Tax', '81221617507'),
(8, 8, '1812001', 'Selvia Rizky Efriyani', 'P', '12 Mei 1992', 'CSO', 'CSO', '8979116008'),
(9, 9, '1813002', 'Maryadi Pribowo', 'L', '19 Mei 1972', 'CSO', 'CSO', '8122174419'),
(10, 10, '21041501', 'Mirza Setiawan', 'L', '31 Mei 1991', 'CSO', 'CSO', '81221602806'),
(11, 11, '21041502', 'Dian Ade Putra', 'L', '20 Juni 1988', 'SETTLEMENT', 'SETTLEMENT', '81770555855'),
(12, 12, '21102501', 'Rully Agusta Prautama', 'L', '25 Agustus 1988', 'SETTLEMENT', 'SETTLEMENT', '81931337583'),
(13, 13, '1833003', 'Syamsu Ramdan', 'L', '21-Apr-90', 'Trainer', 'Trainer', '81222760526'),
(14, 14, '20010901', 'Widiansyah M. Kahfi', 'L', '01-Nov-99', 'Trainer', 'Trainer', '82113848248'),
(15, 15, '20112501', 'Vinsensius Sonny G', 'L', '20 Juli 1993', 'Trainer', 'Trainer', '82217788929'),
(16, 16, '1822003', 'Yayan Supriatna', 'L', '9 Desember 1997', 'IT', 'IT', '85798112370'),
(17, 17, '1831002', 'Anang Suherna', 'L', '07-Nov-75', 'G.A Operasional', 'G.A Operasional', '81312854524'),
(18, 18, '1831003', 'Supriyadi', 'L', '', 'G.A Listrik', 'G.A Listrik', '85221317140'),
(19, 19, '21022301', 'Atang Kurniawan', 'L', '09-Sep-79', 'Driver', 'Driver', '85711458748'),
(20, 20, '1831019', 'Puji Sunanto', 'L', '01 Januari 1976', 'Driver', 'Driver', '81288503606'),
(21, 21, '1831018', 'Krishandi Permadi Adi Karya', 'L', '10-Sep-91', 'Driver', 'Driver', '8999661506'),
(22, 22, '21090301', 'Hilaria Indriyane', 'P', '02 Desember 2001', 'Receptionist', 'Receptionist', '89651580580'),
(23, 23, '1831022', 'Riki Saeful', 'L', '13-Sep-88', 'Office Boy', 'Office Boy', '83843052103'),
(24, 24, '', 'LIA NURULITA', 'P', '', 'RBP', 'Business Dev', ''),
(25, 25, '', 'Andrie Melandi', 'L', '', 'RBP', 'Business Dev', ''),
(26, 26, '', 'Cenliyani', 'P', '', 'HBD', 'Business Dev', ''),
(27, 27, '', 'Dina Nurpitriani', 'P', '', 'BM', 'Business Dev', ''),
(28, 28, '', 'Sri Mulyati', 'P', '', 'BM', 'Business Dev', ''),
(29, 29, '', 'Dandi Rahmadan', 'L', '', 'ABM', 'Business Dev', ''),
(30, 30, '', 'Natasha Frianka', 'P', '', 'ABM', 'Business Dev', ''),
(31, 31, '', 'Relizi Maulana Sopha', 'L', '', 'ABM', 'Business Dev', ''),
(32, 32, '', 'Muchamad Iqbal Noerfalaq', 'L', '', 'ABM', 'Business Dev', ''),
(33, 33, '', 'MELINA NUR\'AJIZAH', 'P', '', 'ABM', 'Business Dev', ''),
(34, 34, '', 'Aden Fikriansyah', 'L', '', 'ABM', 'Business Dev', ''),
(35, 35, '', 'Fendi Rahmadan', 'L', '', 'ABM', 'Business Dev', '');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_cuti`
--

CREATE TABLE `pengajuan_cuti` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `divisi` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `alasan` text DEFAULT NULL,
  `jumlah_hari` int(11) DEFAULT NULL,
  `mulai` date DEFAULT NULL,
  `sampai` date DEFAULT NULL,
  `alamat_cuti` text DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Menunggu Approval',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_karyawan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_cuti`
--

INSERT INTO `pengajuan_cuti` (`id`, `nama`, `nik`, `divisi`, `jabatan`, `alasan`, `jumlah_hari`, `mulai`, `sampai`, `alamat_cuti`, `telepon`, `status`, `created_at`, `id_karyawan`) VALUES
(27, 'asep', '111223', 'IT', 'Staff', 'Males', 2, '0000-00-00', '2025-07-15', 'jl ada', '1233121', 'Ditolak', '2025-07-04 08:46:28', NULL),
(28, 'Ujang', '12345678', 'IT', 'Staff', 'malas', 2, '0000-00-00', '2025-07-15', 'jl ada', '1233121', 'Disetujui', '2025-07-04 08:48:25', NULL),
(29, 'iis', '12345678', 'IT', 'Staff', 'malas', 2, '0000-00-00', '2025-07-15', '2423', '1233121', 'Disetujui', '2025-07-04 09:33:47', NULL),
(30, 'ibrahim', '12345678', 'IT', 'Staff', 'sakit', 2, '0000-00-00', '2025-07-15', 'garuda', '1233121', 'Disetujui', '2025-07-04 09:38:52', NULL),
(31, 'abang', '12345678', 'IT', 'Staff', 'males', 2, '0000-00-00', '2025-07-15', '1331231', '1233121', 'Disetujui', '2025-07-05 02:01:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `device` varchar(100) DEFAULT NULL,
  `masalah` text DEFAULT NULL,
  `prioritas` varchar(50) DEFAULT NULL,
  `dampak` varchar(100) DEFAULT NULL,
  `status` enum('Masuk','Proses','Selesai') DEFAULT 'Masuk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `tanggal`, `nama_user`, `lokasi`, `device`, `masalah`, `prioritas`, `dampak`, `status`) VALUES
(2, '2025-07-31', 'user', '12', 'pc', 'error', 'High', 'Major', 'Proses'),
(5, '2025-07-09', 'anton', 'andir', 'Laptop', 'error', 'High', 'Medium', 'Proses'),
(6, '2025-07-24', 'mulya', '188', 'pc', 'lemot', 'Urgent', 'Major', 'Proses'),
(15, '2025-07-09', 'abang', 'D', 'pc', 'error', 'High', 'Major', 'Proses'),
(17, '2025-07-17', 'toto', 'D', 'pc', 'nasn', 'High', 'Major', 'Proses'),
(19, '2025-07-25', 'arkan', '188', 'pc', 'rusak', 'Urgent', 'Major', 'Proses');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `no_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `id_karyawan`, `no_id`) VALUES
(1, 'ucok', '$2y$10$O4ecfyivDzWcRbb2DTPwruuJ2bBJkx7S/BaNHEQMmtetx6/7YJwNC', 'IT Support', NULL, NULL),
(2, 'atar', '$2y$10$2ZMWilfLNtXrtVgsnwxC9.mEXjTVQwfjoTPjmA6tWqN094cICx4km', 'IT Support', NULL, NULL),
(3, 'admin', '$2y$10$0CXB.BV2fc6Vfw2uaToiRu8p6lkhMtqxoI1Fh8tBpb8aZ4BjM2jWW', 'admin', NULL, NULL),
(4, 'ooo', '$2y$10$yjHMx.qvzLzuEwYouftnNOOmTfOhmOzrgnYJO0L/1iMCDjCwPgfSO', 'Manager', NULL, NULL),
(5, 'yyyy', '$2y$10$/VyHsjlPqX8CWo0LMAsey.9zUqYEICLvW8rAlcOSOz5SxwI6nrm0u', 'IT Support', NULL, NULL),
(6, 'ppp', '$2y$10$EGFM0o7rSpCMiMTzkTisfuxfir0MhKMly1/ewVbc731N.WEszDNxC', 'user', NULL, NULL),
(8, 'ibrahim', '$2y$10$1i6tprCzdiDGB1w3jw3k5uTmxwLhSv0e6mBFThWVjdEbIAj3PRz0S', 'user', NULL, NULL),
(9, 'ardi', '$2y$10$.trBxnU.XDg7hb5mWdbBbeQb1fc5quXYfpiV5ZhkyVZ6VY2kI1PBK', 'admin', NULL, NULL),
(10, 'beben', '$2y$10$yYltn.F6ONQVM/UihjJKWeluEhxadYqTONLGHzWy/f3BsB74j2Ynq', 'user', NULL, NULL),
(11, 'jajang', '$2y$10$IrO4kPHfKbJL.WZvANxotuhuwKTaPBwlMSHnMWQrY2ULvJ3VCWp/2', 'user', NULL, NULL),
(12, 'papong', '$2y$10$YBd0i7YqHC7zxAF9a1i.euAwO.l1TFCo30.Zq3jWCmPndSj6oUwdG', 'admin', NULL, NULL),
(13, 'Niftah', '$2y$10$TwYf2g4nNr52PkTskC0Jj.cEB44XpLAbSlef9Hr517Zl.rBDMXeQ6', 'user', NULL, NULL),
(14, 'andi', '$2y$10$Oaj2fFOdGmvem5SxlpxPwOAesLnf9TZ5prygPCapoU9R64CYbPEs2', 'user', NULL, NULL),
(15, 'caca', '$2y$10$t5nXJ0EK8Ob0dlS6PA7RnextaKhf8V3WNeYQgUmZLXmGENBf95bku', 'it support', NULL, NULL),
(16, 'dadang', '$2y$10$FYiSLumD5EQgf6tgTCvvaeOsWxOsRu2D8kfjB4WOw/bAsJUEDyvKa', 'IT Support', NULL, NULL),
(17, 'didimax', '$2y$10$haPNkf2GKAj8MjpgYvKr9.HNQGhf4e7frJCLQDfGOZtNVCO1TBPRu', 'user', NULL, NULL),
(18, 'Yayan', '$2y$10$4yigVOOl5gwSedvbiRo3DOQH0pSDY2coacoJ3LENTYr5BJvmg1gEa', 'IT Support', NULL, NULL),
(19, 'papoy', '$2y$10$BUuU4kwklQRjDhdoCm9Dg.9A3JGW6rof8SxUAuSsBJ2.FqNarquy6', 'user', NULL, NULL),
(20, 'noval', '$2y$10$whCH/QjCL/V0.mLi9BjN4eQ9bYNs/o24pjnYFQJk5osj7GtGA.37G', 'user', NULL, NULL),
(22, 'Niftah1', '$2y$10$tJ5u8lUvMP/vj1n7RpowOuvPxwXVXLPBW3lhxnH2P1v1/JOKI0bj2', 'IT Support', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_cuti`
--
ALTER TABLE `pengajuan_cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pengajuan_cuti`
--
ALTER TABLE `pengajuan_cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
