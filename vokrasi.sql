-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2022 at 12:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vokrasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `kampus`
--

CREATE TABLE `kampus` (
  `id_perguruan` int(11) NOT NULL,
  `kode_perguruan` varchar(120) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `daerah` varchar(120) NOT NULL,
  `link` varchar(120) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kampus`
--

INSERT INTO `kampus` (`id_perguruan`, `kode_perguruan`, `nama`, `daerah`, `link`, `gambar`) VALUES
(1, 'Univ', 'IPB University', 'Bogor, Jawa Barat', 'https://sv.ipb.ac.id/', 'IPB.png'),
(4, 'Poltek', 'Universitas Brawijaya', 'Malang, Jawa Timur', 'https://vokasi.ub.ac.id/', 'UB.png'),
(7, 'Univ', 'Universitas Indonesia', 'Jakarta, DKI Jakarta', 'https://www.ui.ac.id/', 'UI2.png');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `angkatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `angkatan`) VALUES
(1, 'J0303202111', 'Bambang', '2019'),
(2, 'J0303202011', 'Ridwan', '2020'),
(3, 'J0303202134', 'Kamil', '2020'),
(4, 'J0303202014', 'Bagus', '2019'),
(5, 'J0303202131', 'Surya', '2021');

-- --------------------------------------------------------

--
-- Table structure for table `perguruan`
--

CREATE TABLE `perguruan` (
  `id_perguruan` int(11) NOT NULL,
  `kode_perguruan` varchar(10) NOT NULL,
  `nama_perguruan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perguruan`
--

INSERT INTO `perguruan` (`id_perguruan`, `kode_perguruan`, `nama_perguruan`) VALUES
(1, 'Univ', 'Universitas'),
(2, 'Poltek', 'Politeknik');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `nim` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `nim`, `password`, `role_id`, `date_created`) VALUES
(1, 'Fanny Febrian', '1', '$2y$10$bbeeElfC4H5cGKBPQRkTmOX/gclpRTbcW6dMctd43./c/t3AwxS0m', 1, 1),
(2, 'Kamil Amrullah', '2', '$2y$10$CdwtOyUlrflLqmkSLxTa.OzvkFZIaEtLeVLpFJLP4wfIxExWTgJEW', 2, 1665560307),
(5, 'Tegar Rosaka', '3', '123', 1, 1),
(8, 'Admin', '0', '$2y$10$DwEv5G0.dfiBMTDOkH2Q9u.H1OLrKXLBMjw3cQazqD5YK4z.rptl.', 1, 1668118396);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kampus`
--
ALTER TABLE `kampus`
  ADD PRIMARY KEY (`id_perguruan`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perguruan`
--
ALTER TABLE `perguruan`
  ADD PRIMARY KEY (`id_perguruan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kampus`
--
ALTER TABLE `kampus`
  MODIFY `id_perguruan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `perguruan`
--
ALTER TABLE `perguruan`
  MODIFY `id_perguruan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
