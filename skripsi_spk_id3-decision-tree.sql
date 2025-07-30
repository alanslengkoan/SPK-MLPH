-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2025 at 02:51 PM
-- Server version: 5.7.25
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_spk_id3-decision-tree`
--

-- --------------------------------------------------------

--
-- Table structure for table `dataset`
--

CREATE TABLE `dataset` (
  `id` int(11) NOT NULL,
  `age` varchar(20) DEFAULT NULL,
  `income` varchar(20) DEFAULT NULL,
  `student` varchar(10) DEFAULT NULL,
  `loan` varchar(20) DEFAULT NULL,
  `class` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dataset`
--

INSERT INTO `dataset` (`id`, `age`, `income`, `student`, `loan`, `class`) VALUES
(1, 'Muda', 'Tinggi', 'Tidak', 'Macet', 'Tidak Beli'),
(2, 'Muda', 'Tinggi', 'Tidak', 'Lancar', 'Tidak Beli'),
(3, 'Tengah Baya', 'Tinggi', 'Tidak', 'Macet', 'Beli'),
(4, 'Tua', 'Sedang', 'Tidak', 'Macet', 'Beli'),
(5, 'Tua', 'Rendah', 'Ya', 'Macet', 'Beli'),
(6, 'Tua', 'Rendah', 'Ya', 'Lancar', 'Tidak Beli'),
(7, 'Tengah Baya', 'Rendah', 'Ya', 'Lancar', 'Beli'),
(8, 'Muda', 'Sedang', 'Tidak', 'Macet', 'Tidak Beli'),
(9, 'Muda', 'Rendah', 'Tidak', 'Macet', 'Beli'),
(10, 'Tua', 'Sedang', 'Ya', 'Macet', 'Beli'),
(11, 'Muda', 'Sedang', 'Ya', 'Lancar', 'Beli'),
(12, 'Tengah Baya', 'Sedang', 'Tidak', 'Lancar', 'Beli'),
(13, 'Tengah Baya', 'Tinggi', 'Ya', 'Macet', 'Beli'),
(14, 'Tua', 'Sedang', 'Tidak', 'Lancar', 'Tidak Beli');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataset`
--
ALTER TABLE `dataset`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dataset`
--
ALTER TABLE `dataset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
