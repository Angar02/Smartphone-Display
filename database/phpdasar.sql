-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2026 at 11:10 AM
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
-- Database: `phpdasar`
--

-- --------------------------------------------------------

--
-- Table structure for table `smartphones`
--

CREATE TABLE `smartphones` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `os` varchar(100) NOT NULL,
  `chip` varchar(50) NOT NULL,
  `camera` varchar(50) NOT NULL,
  `battery` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `smartphones`
--

INSERT INTO `smartphones` (`id`, `name`, `os`, `chip`, `camera`, `battery`, `image`) VALUES
(1, 'Samsung Galaxy Z Trifold', 'Android 16, One UI 8', 'Snapdragon 8 Elite (3 nm)', '200 MP', 'Samsung Galaxy Z Trifold', '69489bd6e0210.jpg'),
(2, 'Xiaomi Poco F8', 'Android 16, HyperOS 3', 'Snapdragon 8 Elite Gen 5 (3 nm)', '50 MP', '6500 mAh', 'xiaomi-poco-f8-ultra.jpg'),
(3, 'Samsung Galaxy A56', 'Android 15, up to 6 major Android upgrades, One UI 7', 'Exynos 1580 (4 nm)', '50 MP', '5000 mAh', 'samsung-galaxy-a56.jpg'),
(4, 'Apple iPhone 17 Pro Max', 'iOS 26, upgradable to iOS 26.1', 'Apple A19 Pro (3 nm)', '48 MP', '5088 mAh', 'apple-iphone-17-pro-max.jpg'),
(5, 'OnePlus 15', 'Android 16, OxygenOS 16 (Global), ColorOS 16 (China)', 'Snapdragon 8 Elite Gen 5 (3 nm)', '50 MP', '7300 mAh', 'oneplus-15.jpg'),
(20, 'vivo S50', 'Android 16, OriginOS 6', 'Snapdragon 8s Gen 3 (4 nm)', '50 MP', '6500 mAh', '693dfe3f6a9af.jpg'),
(21, 'Xiaomi Redmi 15', 'Android 15, HyperOS 2.2', 'Snapdragon 6s Gen 3 (6 nm)', '50 MP', '7000 mAh', '693dfe360699c.jpg'),
(22, 'Xiaomi 17 Pro Max', 'Android 16, HyperOS 3', 'Snapdragon 8 Elite Gen 5', '50 MP', '7500 mAh', '6942adcd1f100.jpg'),
(23, 'Xiaomi Poco X7 Pro', 'Android 15, HyperOS 2', 'Dimensity 8400 Ultra', '50 MP', '6000 mAh', '6942ae0d5a528.jpg'),
(27, '', 'asfasfd', 'asfasf', 'asfasf', 'safsafas', '6948a6c901271.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'anang', '$2y$10$lJlybQu0MCO2UKyhD1vlTuj9kXWsAF/oAh8O3qOnP/fzMRNHDxGjq'),
(3, 'admin', '$2y$10$QCfZ06vQObCKwf0SopffjukASrN84/Uo4Pog5U.pkumbn.A4aaida'),
(4, 'abc', '$2y$10$o/luJbGAghWLs/04qzt2OeorO42jWR7r0GK2DIHCuWUX.Ep2nzXNG'),
(5, 'bcd', '$2y$10$m4DDpPTT.COrGvOgYpUlfe8i5INsfngyaH4ItoGyMePv.5.0XHXd6'),
(9, 'firaun', '$2y$10$ld9wg0koModpIIO7pq0SZOONxg2yhN4u1jJAzNvmwZDxWtpDpP.1i');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `smartphones`
--
ALTER TABLE `smartphones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `smartphones`
--
ALTER TABLE `smartphones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
