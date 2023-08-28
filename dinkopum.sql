-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 28, 2023 at 04:55 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dinkopum`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukti`
--

CREATE TABLE `bukti` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `file` text COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int NOT NULL,
  `jabatan` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `iki` text COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `jabatan`, `iki`) VALUES
(1690791633, 'Kepala dinas', ''),
(1690795177, 'bendahara', ''),
(1690802229, 'sekretaris', ''),
(1690823466, 'kepala bidang humas', ''),
(1691135248, 'Kepala Bidang Kelembagaan dan Pengawasan Koperasi', ''),
(1691135269, 'Kepala Bidang Pemberdayaan Usaha Mikro', ''),
(1691135308, 'Kepala Bidang Pemberdayaan dan Pengembangan Kopera', '');

-- --------------------------------------------------------

--
-- Table structure for table `kinerja`
--

CREATE TABLE `kinerja` (
  `id` int NOT NULL,
  `id_bukti` int NOT NULL,
  `id_user` int NOT NULL,
  `no` char(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `sasaran` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `indikator` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `ktahunan_target` varchar(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `ktribulan_target` varchar(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `anggaran_target` char(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `ktahunan_realisasi` varchar(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `ktribulan_realisasi` varchar(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `anggaran_realisasi` char(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` enum('ditinjau','ditolak','diterima') COLLATE utf8mb4_swedish_ci NOT NULL,
  `tahun` datetime NOT NULL,
  `bulan` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `nama`) VALUES
(1, 'Admin'),
(2, 'pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `sub_kinerja`
--

CREATE TABLE `sub_kinerja` (
  `id` int NOT NULL,
  `no` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `nm_program` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `id_kinerja` int NOT NULL,
  `id_user` int NOT NULL,
  `indikator` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `target_thn` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `target_bln` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `target_nilai` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `realisasi_thn` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `realisasi_bln` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `realisasi_nilai` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `h_thn` varchar(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `h_bln` varchar(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `h_nilai` varchar(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `id_bukti` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` enum('diterima','ditolak','ditinjau') COLLATE utf8mb4_swedish_ci NOT NULL,
  `bulan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nip` varchar(40) COLLATE utf8mb4_swedish_ci NOT NULL,
  `password` varchar(35) COLLATE utf8mb4_swedish_ci NOT NULL,
  `photo` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `id_level` int NOT NULL,
  `id_jabatan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `nip`, `password`, `photo`, `alamat`, `id_level`, `id_jabatan`) VALUES
(1, 'Admin', '12345', '1b3231655cebb7a1f783eddf27d254ca', '', '', 1, 0),
(1691134890, 'FAHRUDIN WIDODO, S.H., M.M', '196412191990031004', '827ccb0eea8a706c4c34a16891f84e7b', '', 'jombang', 2, 1690791633),
(1691135107, 'Sri Surjati, SS., M. Skom', '197001131997032003', '?|???plL4?h??N{', '', 'jombang', 2, 1690802229),
(1691135470, 'MUFATTICHATUL MA\'RUFAH, SH', '197209121999012001', '827ccb0eea8a706c4c34a16891f84e7b', '', 'jombang', 2, 1691135308);

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi`
--

CREATE TABLE `verifikasi` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `bukti` text COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukti`
--
ALTER TABLE `bukti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kinerja`
--
ALTER TABLE `kinerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_kinerja`
--
ALTER TABLE `sub_kinerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NIP` (`nip`);

--
-- Indexes for table `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
