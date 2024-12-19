-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 02:11 PM
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
-- Database: `db_rumahsakit`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `id_dokter` varchar(50) NOT NULL,
  `nama_dokter` varchar(80) NOT NULL,
  `spesialis` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_dokter`
--

INSERT INTO `tb_dokter` (`id_dokter`, `nama_dokter`, `spesialis`, `alamat`, `no_telp`) VALUES
('87b93cea-e79f-40ef-91ae-581b9aef76b6', 'Dr. Putra Aditya P', 'Ortopedi', 'Baturraden', '082133102131'),
('8b68f179-5272-47fe-9dbc-23257687a479', 'Dr. Sekar Arum Rolla D', 'Jantung', 'Baturraden', '081212334212');

-- --------------------------------------------------------

--
-- Table structure for table `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id_obat` varchar(50) NOT NULL,
  `nama_obat` varchar(200) NOT NULL,
  `ket_obat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_obat`
--

INSERT INTO `tb_obat` (`id_obat`, `nama_obat`, `ket_obat`) VALUES
('6c427ce8-7dfa-4b36-8e6a-97eded3ea6bd', 'Antimo', 'Obat untuk mabok perjalanan'),
('bc135780-360e-4fef-b4a5-a24e46e9d99b', 'Bodrex', 'Obat untuk sakit kepala'),
('c6315d70-61b3-4405-8ceb-9130f78c95ab', 'Ultraflu', 'Obat untuk flu\r\n\r\n'),
('f9716678-5e68-4972-bfc9-50cde00cf9ca', 'Tolakangin', 'Obat untuk masuk angin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `id_pasien` varchar(50) NOT NULL,
  `nomor_identitas` varchar(30) NOT NULL,
  `nama_pasien` varchar(80) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pasien`
--

INSERT INTO `tb_pasien` (`id_pasien`, `nomor_identitas`, `nama_pasien`, `jenis_kelamin`, `alamat`, `no_telp`) VALUES
('0a65b8bd-f856-45e6-9d6c-faabbb480e92', '32423', 'Lorem', 'L', 'Maroko', '08578824'),
('5ec4fad2-973b-4c2c-b396-1087b6e5ebc4', '53453453', 'Yanto', 'L', 'Surabaya', '086312317'),
('708047b4-7357-4855-9252-37bafe5b6428', '2348243', 'Nina', 'P', 'Palembang', '086312312'),
('7238b5cd-3275-4c40-85da-acd3464d180b', '23423432', 'Hani', 'P', 'Gorontalo', '086312315'),
('7416d74b-5b2c-490e-b6d3-c5ef051ab358', '786312', 'Erni', 'P', 'Jayapura', '086312314'),
('84ce4f9d-301a-4405-b8e2-47e7f0107b89', '3453534', 'Wendi', 'L', 'Malang', '086312318'),
('8a3400f5-bf05-4596-8cd9-866107bb88a2', '4534534', 'Ridho', 'L', 'Padang', '086312313'),
('a52df2a7-49fc-4940-a970-d0e3e4ef4831', '1234234', 'Jamal', 'L', 'Mars', '086312312321'),
('c4e85f37-0a4d-414d-81aa-1fee0c667731', '12312389', 'Tomi', 'L', 'Madura', '086312316');

-- --------------------------------------------------------

--
-- Table structure for table `tb_poli`
--

CREATE TABLE `tb_poli` (
  `id_poli` varchar(50) NOT NULL,
  `nama_poli` varchar(50) NOT NULL,
  `gedung` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_poli`
--

INSERT INTO `tb_poli` (`id_poli`, `nama_poli`, `gedung`) VALUES
('1874c82a-3aba-4d5f-b15c-77d3f4cbd895', 'Poli E', 'S.25'),
('7337e716-1ab2-4500-b28e-0ec9bbb344b0', 'Poli B', 'S.22'),
('76443667-5b9c-49e8-b0be-0f5fbf125d86', 'Poli A', 'S.12'),
('cbd90cd6-b654-4234-81ea-4dee1c689e86', 'Poli D', 'S.24'),
('fc902d73-4cbd-45e5-9e04-0e38645e021b', 'Poli C', 'S.23');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rekammedis`
--

CREATE TABLE `tb_rekammedis` (
  `id_rm` varchar(50) NOT NULL,
  `id_pasien` varchar(50) NOT NULL,
  `keluhan` text NOT NULL,
  `id_dokter` varchar(50) NOT NULL,
  `diagnosa` text NOT NULL,
  `id_poli` varchar(50) NOT NULL,
  `tgl_periksa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rekammedis`
--

INSERT INTO `tb_rekammedis` (`id_rm`, `id_pasien`, `keluhan`, `id_dokter`, `diagnosa`, `id_poli`, `tgl_periksa`) VALUES
('0df795cb-6480-4676-bfa8-1a52a1f6bb8c', '5ec4fad2-973b-4c2c-b396-1087b6e5ebc4', 'Badan panas', '87b93cea-e79f-40ef-91ae-581b9aef76b6', 'Masuk angin', 'cbd90cd6-b654-4234-81ea-4dee1c689e86', '2024-12-14'),
('ba14f082-a111-4d7d-96fb-a90ceceecb8d', '84ce4f9d-301a-4405-b8e2-47e7f0107b89', '<p><strong>sakit kepala sebelah</strong></p>\r\n', '87b93cea-e79f-40ef-91ae-581b9aef76b6', 'Migren', 'cbd90cd6-b654-4234-81ea-4dee1c689e86', '2024-12-14'),
('d47cad7d-15bc-43d9-b38a-5c2bd7ee2458', '708047b4-7357-4855-9252-37bafe5b6428', '<p><em><strong>sakit kepala</strong></em></p>\r\n', '87b93cea-e79f-40ef-91ae-581b9aef76b6', 'Berpikir berlebihan', 'cbd90cd6-b654-4234-81ea-4dee1c689e86', '2024-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rm_obat`
--

CREATE TABLE `tb_rm_obat` (
  `id` int(11) NOT NULL,
  `id_rm` varchar(50) NOT NULL,
  `id_obat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rm_obat`
--

INSERT INTO `tb_rm_obat` (`id`, `id_rm`, `id_obat`) VALUES
(3, '0df795cb-6480-4676-bfa8-1a52a1f6bb8c', '6c427ce8-7dfa-4b36-8e6a-97eded3ea6bd'),
(4, '0df795cb-6480-4676-bfa8-1a52a1f6bb8c', 'f9716678-5e68-4972-bfc9-50cde00cf9ca'),
(9, 'd47cad7d-15bc-43d9-b38a-5c2bd7ee2458', 'bc135780-360e-4fef-b4a5-a24e46e9d99b'),
(10, 'd47cad7d-15bc-43d9-b38a-5c2bd7ee2458', 'f9716678-5e68-4972-bfc9-50cde00cf9ca'),
(11, 'ba14f082-a111-4d7d-96fb-a90ceceecb8d', '6c427ce8-7dfa-4b36-8e6a-97eded3ea6bd'),
(12, 'ba14f082-a111-4d7d-96fb-a90ceceecb8d', 'bc135780-360e-4fef-b4a5-a24e46e9d99b');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(50) NOT NULL,
  `nama_user` varchar(80) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
('5741d2b3-b450-11ef-813c-277cf96a2783', 'Putra Aditya Priyono', 'admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `tb_poli`
--
ALTER TABLE `tb_poli`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indexes for table `tb_rekammedis`
--
ALTER TABLE `tb_rekammedis`
  ADD PRIMARY KEY (`id_rm`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `tb_rm_obat`
--
ALTER TABLE `tb_rm_obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rm` (`id_rm`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rm_obat`
--
ALTER TABLE `tb_rm_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rekammedis`
--
ALTER TABLE `tb_rekammedis`
  ADD CONSTRAINT `tb_rekammedis_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `tb_pasien` (`id_pasien`),
  ADD CONSTRAINT `tb_rekammedis_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `tb_dokter` (`id_dokter`),
  ADD CONSTRAINT `tb_rekammedis_ibfk_3` FOREIGN KEY (`id_poli`) REFERENCES `tb_poli` (`id_poli`);

--
-- Constraints for table `tb_rm_obat`
--
ALTER TABLE `tb_rm_obat`
  ADD CONSTRAINT `tb_rm_obat_ibfk_1` FOREIGN KEY (`id_rm`) REFERENCES `tb_rekammedis` (`id_rm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_rm_obat_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `tb_obat` (`id_obat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
