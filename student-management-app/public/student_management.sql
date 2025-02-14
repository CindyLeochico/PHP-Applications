-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2025 at 10:25 PM
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
-- Database: `student_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`) VALUES
(1, 'cindy leochico2', 'dakisleochico@gmail.com2'),
(2, 'cindy leochico', 'dakisleochico@gmail.com'),
(3, 'aaa', 'dakisleochico@gmail.com3'),
(4, 'cindy dakis11', 'dakisleochico@gmail.com22'),
(6, 'cindy leochico', 'dakisleochico@gmail.com11');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`) VALUES
(5, 'admin', 'dakisleochico@gmail.com', '$2y$10$i.aV6wvgNWXv2JAvaDVK5eoi.p5CmRhZnAkgb1geoEzg3P6kLSiaO'),
(6, 'cindz1', 'dakisleochico@gmail.com1', '$2y$10$lsje35YjFdmiasZjPatNmObHjxXRpAX1DJHN7Q9Nw7z8o1PocscSm'),
(7, 'admin22', 'dakisleochico@gmail.com22', '$2y$10$047x67iQn1PQ59qT.cKHl.pM5OWk0VU8NAhNk7M/ZIg.0T7hMMUMi'),
(8, 'test', 'test@gmail.com', '$2y$10$E33e.dfYkAQobo9T.lzYxOrLcoBDb25.mMZMBqV2iEDYU2xca/HDK'),
(9, 'CindyLeochico', 'cindyleochico@gmail.com', '$2y$10$wFeQ70xo318fvPulwW5QN.IazYbBgxJAz7tDSya4nz8rqLhg44lpO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
