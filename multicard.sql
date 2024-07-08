-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8111
-- Generation Time: Jul 05, 2024 at 04:53 AM
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
-- Database: `multicard`
--

-- --------------------------------------------------------

--
-- Table structure for table `logcard`
--

CREATE TABLE `logcard` (
  `id` int(11) NOT NULL,
  `uidrfid` varchar(50) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nama_tempat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `logcard`
--

INSERT INTO `logcard` (`id`, `uidrfid`, `waktu`, `nama_tempat`) VALUES
(47, '2162113', '2024-06-27 21:06:06', 'Kelas'),
(71, '2162113', '2024-07-05 09:25:08', 'Perpustakaan'),
(74, '2162113', '2024-07-05 09:31:23', 'Parkir'),
(78, '1151996652', '2024-07-05 09:43:32', 'Kelas'),
(79, '1151996652', '2024-07-05 09:44:17', 'Parkir'),
(80, '1151996652', '2024-07-05 09:47:29', 'Kelas'),
(81, '1151996652', '2024-07-05 09:48:36', 'Kelas');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `time_regist` datetime DEFAULT current_timestamp(),
  `uidrfid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `pass`, `time_regist`, `uidrfid`) VALUES
(20, 'putri', '997af0fb6c844069db0e17d37b90e4e44314c5a84c2187f35ca4e45f82e66d59', '2024-06-27 20:27:51', '2162113'),
(21, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '2024-06-29 18:55:06', '993313822'),
(23, 'rahma', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '2024-07-05 09:43:16', '1151996652');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logcard`
--
ALTER TABLE `logcard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `uidrfid` (`uidrfid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logcard`
--
ALTER TABLE `logcard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
