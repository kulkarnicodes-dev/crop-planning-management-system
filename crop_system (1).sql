-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2025 at 04:36 AM
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
-- Database: `crop_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(4, 'admin', '$2y$10$qC/3ZRtuxjmYtO51ig9J5.Jzv5cGZLE1D21rdZfsVBQCjrXqAYkRK');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Yash Kulkarni', 'yashkulkarni051@gmail.com', 'yash', '2025-02-26 05:00:13'),
(2, 'om', 'shree@gmail.com', 'best website i have see', '2025-02-26 05:05:11'),
(3, 'om palvi', 'om@gmail.com', 'best website ', '2025-02-26 09:56:44'),
(4, 'Yash Kulkarni', 'shree@gmail.com', 'dghfhgcvchgyftt', '2025-03-08 06:23:22');

-- --------------------------------------------------------

--
-- Table structure for table `crop_info`
--

CREATE TABLE `crop_info` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `crop` varchar(100) NOT NULL,
  `demand` enum('low','medium','high') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop_info`
--

INSERT INTO `crop_info` (`id`, `name`, `latitude`, `longitude`, `crop`, `demand`) VALUES
(1, 'Wheat (Aurangabad)', 19.8762000, 75.3433000, 'Wheat', 'high'),
(2, 'Rice (Nagpur)', 21.1458000, 79.0882000, 'Rice', 'medium'),
(3, 'Jowar (Solapur)', 17.6599000, 75.9064000, 'Jowar', 'low'),
(4, 'Bajra (Nashik)', 20.0000000, 73.7800000, 'Bajra', 'medium'),
(5, 'Cotton (Amravati)', 20.9374000, 77.7796000, 'Cotton', 'high'),
(6, 'Tur (Akola)', 20.7096000, 77.0020000, 'Tur', 'high'),
(7, 'Moong (Beed)', 18.9881000, 75.7600000, 'Moong', 'high'),
(8, 'Urad (Yavatmal)', 20.3888000, 78.1205000, 'Urad', 'low'),
(9, 'Gram (Parbhani)', 19.2683000, 76.7716000, 'Gram', 'medium'),
(10, 'Turmeric (Satara)', 17.6868000, 74.0034000, 'Turmeric', 'high'),
(11, 'Grapes (Nashik)', 20.0056000, 73.7798000, 'Grapes', 'high'),
(12, 'Onion (Nashik)', 19.9975000, 73.7898000, 'Onion', 'high');

-- --------------------------------------------------------

--
-- Table structure for table `crop_planning`
--

CREATE TABLE `crop_planning` (
  `id` int(11) NOT NULL,
  `crop_name` varchar(255) NOT NULL,
  `planting_date` date NOT NULL,
  `harvest_date` date NOT NULL,
  `market_price` decimal(10,2) NOT NULL,
  `stock_available` decimal(10,2) NOT NULL,
  `location` varchar(255) NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop_planning`
--

INSERT INTO `crop_planning` (`id`, `crop_name`, `planting_date`, `harvest_date`, `market_price`, `stock_available`, `location`, `latitude`, `longitude`) VALUES
(1, 'Wheat', '2025-06-01', '2025-11-01', 25.00, 100.00, 'Aurangabad', 19.8762000, 75.3433000),
(2, 'Rice', '2025-07-01', '2025-12-01', 30.00, 120.00, 'Nagpur', 21.1458000, 79.0882000),
(3, 'Jowar', '2025-06-15', '2025-10-30', 20.00, 90.00, 'Solapur', 17.6599000, 75.9064000),
(4, 'Bajra', '2025-07-10', '2025-11-20', 22.00, 80.00, 'Nashik', 20.0000000, 73.7800000),
(5, 'Cotton', '2025-04-01', '2025-09-30', 50.00, 200.00, 'Amravati', 20.9374000, 77.7796000),
(6, 'Tur', '2025-06-05', '2025-11-25', 40.00, 150.00, 'Akola', 20.7096000, 77.0020000),
(7, 'Moong', '2025-06-20', '2025-09-30', 35.00, 110.00, 'Beed', 18.9881000, 75.7600000),
(8, 'Urad', '2025-07-05', '2025-10-10', 38.00, 95.00, 'Yavatmal', 20.3888000, 78.1205000),
(9, 'Gram', '2025-06-15', '2025-10-25', 28.00, 85.00, 'Parbhani', 19.2683000, 76.7716000),
(10, 'Turmeric', '2025-06-01', '2025-12-15', 60.00, 130.00, 'Satara', 17.6868000, 74.0034000),
(11, 'Grapes', '2025-02-01', '2025-05-30', 70.00, 250.00, 'Nashik', 20.0056000, 73.7798000),
(12, 'Onion', '2025-03-01', '2025-07-15', 18.00, 300.00, 'Nashik', 19.9975000, 73.7898000),
(13, 'Moong', '2025-03-07', '2025-07-01', 38.00, 10.00, 'Lat: 20.0278016, Lng: 73.8197504', 20.0278016, 73.8197504),
(14, 'onion', '2024-08-22', '2025-01-04', 200.00, 100.00, 'Lat: 20.0046687, Lng: 73.8039467', 20.0046687, 73.8039467),
(15, 'Jawara', '2025-03-08', '2025-05-31', 30.00, 20.00, 'Lat: 20.0015872, Lng: 73.7968128', 20.0015872, 73.7968128),
(16, 'onion', '2025-03-08', '2025-06-28', 20.00, 10.00, 'Lat: 20.0046758, Lng: 73.8038854', 20.0046758, 73.8038854),
(17, 'Wheat', '2025-03-14', '2025-03-25', 30.00, 300.00, 'Lat: 19.98848, Lng: 73.7869824', 19.9884800, 73.7869824);

-- --------------------------------------------------------

--
-- Table structure for table `yash`
--

CREATE TABLE `yash` (
  `id` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `yash`
--

INSERT INTO `yash` (`id`, `fullName`, `email`, `mobile`, `password`) VALUES
(1, 'shree', 'shree@gmail.com', 'shree', '$2y$10$84Zj9xmlaNq2jalYxa8V6.yoQArHbgRERtj1o8S74C7Gt9x/t6ITm'),
(2, 'Neha Mulay', 'Mule12@gmail.com', '1234567890', '$2y$10$Ll2hAHIFddngTJrrRTOf4eSorr/c6ULRcVBNVRPCAKn679QNmfbPy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crop_info`
--
ALTER TABLE `crop_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crop_planning`
--
ALTER TABLE `crop_planning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yash`
--
ALTER TABLE `yash`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `crop_info`
--
ALTER TABLE `crop_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `crop_planning`
--
ALTER TABLE `crop_planning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `yash`
--
ALTER TABLE `yash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
