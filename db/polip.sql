-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2025 at 07:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `polip`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_poli`
--

CREATE TABLE `daftar_poli` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `keluhan` text NOT NULL,
  `no_antrian` int(11) DEFAULT NULL,
  `status_periksa` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_poli`
--

INSERT INTO `daftar_poli` (`id`, `id_pasien`, `id_jadwal`, `keluhan`, `no_antrian`, `status_periksa`) VALUES
(1, 22, 4, 'yyy', 1, '1'),
(5, 17, 7, 'qqq', 2, '1'),
(6, 17, 6, 's', 1, '1'),
(7, 17, 6, 'c', 2, '1'),
(48, 23, 15, 'sakit', 1, '1'),
(49, 23, 7, 'sakit', 3, '0'),
(50, 23, 15, 'sakit', 2, '0'),
(51, 24, 16, 'sakit gigi', 1, '1'),
(52, 25, 16, 'sakit', 2, '0'),
(53, 25, 10, 'huhu', 1, '0'),
(54, 25, 17, 'sakit umum', 1, '1'),
(55, 25, 17, 'saiky', 2, '0'),
(56, 24, 18, 'sakit perut anak', 1, '0'),
(57, 24, 17, 'sakit', 3, '0'),
(58, 24, 18, 'sa', 2, '0'),
(59, 24, 19, 's', 1, '1'),
(60, 24, 19, 'c', 2, '0'),
(61, 26, 21, 'dalam1', 1, '0'),
(62, 26, 22, 'ddd', 1, '1'),
(63, 26, 22, '17', 2, '1'),
(64, 26, 22, '172', 3, '1'),
(65, 26, 22, '173', 4, '1'),
(66, 26, 22, 'a', 5, '0');

-- --------------------------------------------------------

--
-- Table structure for table `detail_periksa`
--

CREATE TABLE `detail_periksa` (
  `id` int(11) NOT NULL,
  `id_periksa` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_periksa`
--

INSERT INTO `detail_periksa` (`id`, `id_periksa`, `id_obat`) VALUES
(3, 1, 4),
(4, 1, 6),
(5, 2, 4),
(6, 2, 5),
(7, 3, 3),
(8, 3, 4),
(9, 4, 3),
(10, 5, 3),
(11, 5, 4),
(12, 6, 4),
(13, 7, 4),
(30, 8, 4),
(31, 8, 5),
(32, 9, 4),
(33, 10, 5),
(34, 11, 6),
(37, 12, 6);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(40) DEFAULT NULL,
  `id_poli` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('dokter') NOT NULL DEFAULT 'dokter'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `nama`, `alamat`, `no_hp`, `id_poli`, `password`, `role`) VALUES
(31, 'Dr Doni', 'Semarang', '082345125789', 1, '8faebdd7d240eeb6a103aac133c962f8', 'dokter'),
(32, 'Dr Jennie', 'Jakarta', '082345121245', 1, '202cb962ac59075b964b07152d234b70', 'dokter'),
(33, 'Dr Sani', 'Kudus', '085687098135', 1, '202cb962ac59075b964b07152d234b70', 'dokter'),
(34, 'Dr Dona', 'Surabayaa', '08745634786544', 1, '202cb962ac59075b964b07152d234b70', 'dokter'),
(35, 'Dr Sanu', 'Semarang', '081234565434', 1, '202cb962ac59075b964b07152d234b70', 'dokter'),
(41, 'Dr Salsa', 'smg', '0987654356', 6, 'c20ad4d76fe97759aa27a0c99bff6710', 'dokter'),
(42, 'Dr Rani', 'smg', '0987654', 1, '202cb962ac59075b964b07152d234b70', 'dokter'),
(43, 'Dr Jeno', 'semarang', '081390652365', 6, '202cb962ac59075b964b07152d234b70', 'dokter'),
(44, 'Dr Jiso', 'weleri', '0987654567', 5, '202cb962ac59075b964b07152d234b70', 'dokter'),
(45, 'Dr Heni', 'smg', '09876543256', 8, '202cb962ac59075b964b07152d234b70', 'dokter'),
(46, 'Dr Zaki', 'smg', '0987654345', 12, '202cb962ac59075b964b07152d234b70', 'dokter'),
(47, 'yani', 'smg', '098765432', 12, '202cb962ac59075b964b07152d234b70', 'dokter'),
(48, 'dody', 'smgg', '081390512028', 12, '202cb962ac59075b964b07152d234b70', 'dokter');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_periksa`
--

CREATE TABLE `jadwal_periksa` (
  `id` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` char(1) DEFAULT '2',
  `aktif` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_periksa`
--

INSERT INTO `jadwal_periksa` (`id`, `id_dokter`, `hari`, `jam_mulai`, `jam_selesai`, `status`, `aktif`) VALUES
(1, 35, 'Senin', '09:00:00', '10:00:00', '2', '2'),
(2, 35, 'Selasa', '10:00:00', '11:00:00', '2', '1'),
(3, 35, 'Rabu', '11:02:00', '12:02:00', '2', '2'),
(4, 41, 'Senin', '13:21:00', '14:21:00', '2', '1'),
(5, 41, 'Selasa', '14:21:00', '16:21:00', '2', '2'),
(6, 34, 'Selasa', '14:13:00', '15:13:00', '2', '2'),
(7, 33, 'Senin', '11:25:00', '12:25:00', '2', '1'),
(8, 33, 'Senin', '17:26:00', '19:26:00', '2', '2'),
(9, 34, 'Senin', '19:01:00', '21:01:00', '2', '2'),
(10, 34, 'Selasa', '19:39:00', '20:39:00', '2', '1'),
(11, 34, 'Rabu', '20:00:00', '21:00:00', '2', '2'),
(12, 34, 'Kamis', '22:00:00', '23:00:00', '2', '2'),
(13, 34, 'Sabtu', '11:01:00', '22:02:00', '2', '2'),
(14, 34, 'Sabtu', '07:59:00', '08:59:00', '2', '2'),
(15, 32, 'Senin', '07:00:00', '09:00:00', '2', '1'),
(16, 43, 'Senin', '08:00:00', '09:00:00', '2', '1'),
(17, 44, 'Senin', '07:00:00', '08:00:00', '2', '1'),
(18, 45, 'Senin', '20:00:00', '21:00:00', '2', '1'),
(19, 46, 'Senin', '10:00:00', '11:00:00', '2', '1'),
(20, 46, 'Selasa', '10:00:00', '11:00:00', '2', '2'),
(21, 47, 'Senin', '07:00:00', '08:00:00', '2', '1'),
(22, 48, 'Senin', '08:00:00', '09:00:00', '2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `kemasan` varchar(35) DEFAULT NULL,
  `harga` int(10) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `kemasan`, `harga`) VALUES
(3, 'Analgesik', 'Kapsul', 20000),
(4, 'Paracetamol', 'tablet', 30000),
(5, 'Intunal', 'Kapsul', 5000),
(6, 'Imboost', 'Kapsul', 50000),
(7, 'Tolak Angin', 'Cair', 5000),
(8, 'Analsik', 'Tablet', 50000),
(10, 'Hot Cream', 'Salep', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_ktp` varchar(16) DEFAULT NULL,
  `no_hp` varchar(40) DEFAULT NULL,
  `no_rm` char(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('pasien') NOT NULL DEFAULT 'pasien'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama`, `alamat`, `no_ktp`, `no_hp`, `no_rm`, `password`, `role`) VALUES
(12, 'Lisa', 'Semarang', '3356789756745358', '081354678965', '202412-001', 'dfeacdebdd52607b78a0eca093c2ed7a', 'pasien'),
(13, 'Danu', 'Surabaya', '3345678543256786', '085643678909', '202412-002', '144723897ce729680f972c492f4c2666', 'pasien'),
(14, 'Claudia', 'Surabaya', '3345671234123453', '081234231232', '202412-003', 'bb07c989b57c25fd7e53395c3e118185', 'pasien'),
(16, 'Danu', 'Semarang', '3321456745378909', '087656765789', '202412-004', '202cb962ac59075b964b07152d234b70', 'pasien'),
(17, 'Rama', 'Jepara', '3345213458795467', '084521232410', '202412-005', '202cb962ac59075b964b07152d234b70', 'pasien'),
(21, 'roni', 'Jepara', '0987654567894352', '098765464679', '202412-006', '202cb962ac59075b964b07152d234b70', 'pasien'),
(22, 'jane', 'smg', '0874567856341213', '09876543574', '202412-007', '202cb962ac59075b964b07152d234b70', 'pasien'),
(23, 'Doni', 'semarang', '0982345674523457', '09873578535', '202412-008', '202cb962ac59075b964b07152d234b70', 'pasien'),
(24, 'bila', 'smg', '0987454678923452', '09762435684', '202501-001', '202cb962ac59075b964b07152d234b70', 'pasien'),
(25, 'lili', 'smg', '0987656789034567', '09876543567', '202501-002', '202cb962ac59075b964b07152d234b70', 'pasien'),
(26, 'yani', 'smg', '09876543456', '986765', '202501-003', '202cb962ac59075b964b07152d234b70', 'pasien');

-- --------------------------------------------------------

--
-- Table structure for table `periksa`
--

CREATE TABLE `periksa` (
  `id` int(11) NOT NULL,
  `id_daftar_poli` int(11) NOT NULL,
  `tgl_periksa` date NOT NULL,
  `catatan` text NOT NULL,
  `biaya_periksa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periksa`
--

INSERT INTO `periksa` (`id`, `id_daftar_poli`, `tgl_periksa`, `catatan`, `biaya_periksa`) VALUES
(1, 1, '2024-12-27', 'sakit', 230000),
(2, 5, '2024-12-27', 'yang pinter', 185000),
(3, 6, '2024-12-27', 'ssss', 200000),
(4, 7, '2024-12-27', 'vvvvv', 170000),
(5, 48, '2024-12-27', 'minum obat', 200000),
(6, 51, '2025-01-03', 'minum obat', 180000),
(7, 54, '2025-01-04', 'sa', 180000),
(8, 59, '2025-01-04', 'sv', 185000),
(9, 62, '2025-01-16', 'bt', 180000),
(10, 63, '2025-01-17', '17', 155000),
(11, 64, '2025-01-17', '172', 200000),
(12, 65, '2025-01-17', 'sssdddddddff', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id` int(11) NOT NULL,
  `nama_poli` varchar(25) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id`, `nama_poli`, `keterangan`) VALUES
(1, 'Poli Tenggorokan', 'Menangani gangguan organ Telinga, Hidung, dan Tenggorokan'),
(5, 'Poli Umum', 'Melayani pasien dengan keluhan umum '),
(6, 'Poli Gigi', 'Melayani medis yang berkaitan dengan kesehatan gigi dan mulut'),
(7, 'Poli Anak', 'Melayani perawatan kesehatan anak-anak, mulai dari bayi hingga remaja'),
(8, 'Poli Kandungan', 'Melayani kesehatan wanita terutama kehamilan'),
(12, 'Poli Dalam', 'sakit bagian dalam pemeriksaan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `password`, `role`) VALUES
(17, 'admin', '$2y$10$gkO8W.IoB1nY.ggFIX3Lx.sIdzVZYAj3AlLq3tFp9Ygksvpiq1jZm', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_periksa` (`id_periksa`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_daftar_poli` (`id_daftar_poli`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD CONSTRAINT `daftar_poli_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`),
  ADD CONSTRAINT `daftar_poli_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_periksa` (`id`);

--
-- Constraints for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD CONSTRAINT `detail_periksa_ibfk_1` FOREIGN KEY (`id_periksa`) REFERENCES `periksa` (`id`),
  ADD CONSTRAINT `detail_periksa_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`);

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id`);

--
-- Constraints for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD CONSTRAINT `jadwal_periksa_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`);

--
-- Constraints for table `periksa`
--
ALTER TABLE `periksa`
  ADD CONSTRAINT `periksa_ibfk_1` FOREIGN KEY (`id_daftar_poli`) REFERENCES `daftar_poli` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
