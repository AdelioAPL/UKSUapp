-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2026 at 04:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uks_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengambilan`
--

CREATE TABLE `detail_pengambilan` (
  `id_detail` int(11) NOT NULL,
  `id_ambil` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pengambilan`
--

INSERT INTO `detail_pengambilan` (`id_detail`, `id_ambil`, `catatan`) VALUES
(3, 7, 'Siswa sakit'),
(4, 12, 'siswa sakit');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `stok`, `keterangan`, `gambar`) VALUES
(4, 'Paracetamol', 19, 'ENAK BANGET', 'WhatsApp Image 2026-04-13 at 1.03.20 PM.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `pengambilan`
--

CREATE TABLE `pengambilan` (
  `id_ambil` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` enum('menunggu','disetujui','ditolak') DEFAULT NULL,
  `id_obat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengambilan`
--

INSERT INTO `pengambilan` (`id_ambil`, `id_siswa`, `tanggal`, `status`, `id_obat`) VALUES
(10, 11, '2026-04-15', 'disetujui', 4),
(11, 3, '2026-04-16', 'ditolak', 5),
(12, 11, '2026-04-16', 'disetujui', 4);

-- --------------------------------------------------------

--
-- Table structure for table `request_obat`
--

CREATE TABLE `request_obat` (
  `id_request` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('menunggu','disetujui','ditolak') DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_obat`
--

INSERT INTO `request_obat` (`id_request`, `id_siswa`, `nama_obat`, `keterangan`, `status`, `tanggal`) VALUES
(13, 3, 'Paracetamol', 'Sakit kepala', 'disetujui', NULL),
(14, 11, 'Obat Batuk', 'Batuk terus', 'disetujui', NULL),
(15, 3, 'Vitamin C', 'Badan lemas', 'ditolak', NULL),
(16, 11, 'Paracetamol', 'sering sakit kepala', '', NULL),
(17, 11, 'Paracetamol', 'sering sakit kepala', 'disetujui', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_user`, `nama`, `kelas`) VALUES
(3, 4, 'Adelio Alvaro Putra Lesmana', 'X SIJA 2'),
(4, 5, 'M Fakhri Nur Zafran', 'X SIJA 1'),
(5, 6, 'M Muzakky Kurniawan', 'X TJAT 1'),
(6, 7, 'Azfar Hafiz', 'X TJAT 1'),
(7, 8, 'Adama Brahmanta Setiawan', 'X TJAT 6'),
(8, 9, 'Danendra Brahmanta Setiawan', 'X TJAT 6'),
(9, 10, 'Fabiyan Brahmana Setiawan', 'X TJAT 6'),
(10, 11, 'Rifqi Brahmana Setiawan', 'X TJAT 6'),
(11, 12, 'M Kevin Irwansyah', 'X SIJA 2'),
(12, 13, '-', 'X TJAT 4'),
(13, 14, 'Joshua Maximilian W', 'X TJAT 3');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('admin','siswa') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin123', 'admin'),
(4, 'kennn', '1234', 'siswa'),
(5, 'kkkraken', '1234', 'siswa'),
(6, 'kky', '1234', 'siswa'),
(7, 'Azfr', '1234', 'siswa'),
(8, 'kenn', '1234', 'siswa'),
(9, 'nendrul', '1234', 'siswa'),
(10, 'Fabiyan', '1234', 'siswa'),
(11, 'fredi', '1234', 'siswa'),
(12, 'iji', '1234', 'siswa'),
(13, 'raka', '1234', 'siswa'),
(14, 'josh', '1234', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pengambilan`
--
ALTER TABLE `detail_pengambilan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `pengambilan`
--
ALTER TABLE `pengambilan`
  ADD PRIMARY KEY (`id_ambil`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `request_obat`
--
ALTER TABLE `request_obat`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pengambilan`
--
ALTER TABLE `detail_pengambilan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengambilan`
--
ALTER TABLE `pengambilan`
  MODIFY `id_ambil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `request_obat`
--
ALTER TABLE `request_obat`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengambilan`
--
ALTER TABLE `pengambilan`
  ADD CONSTRAINT `pengambilan_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `request_obat`
--
ALTER TABLE `request_obat`
  ADD CONSTRAINT `request_obat_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
