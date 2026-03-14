-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2025 at 12:56 AM
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
-- Database: `lostfound_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$SE7gfDioQ/gYfPDDy2ipXuyk2CHFXbrbjmUpVHDotA2kOBP369bjC');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` enum('lost','found') NOT NULL,
  `location` varchar(255) NOT NULL,
  `date_reported` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `time_reported` time NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('pending','verified','selesai') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `title`, `description`, `type`, `location`, `date_reported`, `created_at`, `time_reported`, `contact_info`, `image`, `status`) VALUES
(8, 'Kunci Motor', 'Kunci motor dengan satu gantungan berwarna merah dan dua berwarna putih.', 'lost', 'Dekat foodcourt', '2025-06-21', '2025-06-22 19:28:34', '16:30:00', '082134869919', '1750613314_62678b891de10.jpg', 'verified'),
(9, 'Kunci Motor Ganci Biru', 'Kunci motor dengan gantungan kunci warna biru.', 'found', 'Masjid Masmuja', '2025-06-22', '2025-06-22 23:10:19', '19:08:00', '083455631254', '1750626619_WhatsApp Image 2025-06-23 at 04.05.59.jpeg', 'verified'),
(10, 'Kacamata', 'Kacamata hitam dengan warna orange.', 'found', 'UKS FMIPA', '2025-06-23', '2025-06-22 23:11:43', '08:11:00', '082156869919', '1750626703_WhatsApp Image 2025-06-23 at 04.06.44.jpeg', 'verified'),
(11, 'Mouse Hitam Kecil', 'Mouse hitam kecil ditemukan di IDB lantai 3.', 'found', 'IDB lantai 3', '2025-06-22', '2025-06-22 23:14:25', '16:26:00', '082126962319', '1750626865_WhatsApp Image 2025-06-23 at 04.05.19.jpeg', 'pending'),
(12, 'Botol Tupperware Hitam Merah', 'Botol Tupperware hitam merah hilang di FBSB gedung auditorium.', 'lost', 'FBSB Gedung Auditorium', '2025-06-21', '2025-06-22 23:15:46', '15:16:00', '083144863319', '1750626946_WhatsApp Image 2025-06-23 at 04.05.42.jpeg', 'selesai'),
(13, 'TWS Hitam Xiaomi', 'TWS hitam xiaomi hilang di dekat foodcourt pukul 5 tgl 22.', 'lost', 'Foodcourt UNY', '2025-06-22', '2025-06-22 23:17:21', '17:32:00', '082576869919', '1750627041_WhatsApp Image 2025-06-23 at 04.07.09.jpeg', 'verified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
