-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 24, 2021 at 02:01 PM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `File-Store`
--

-- --------------------------------------------------------

--
-- Table structure for table `Config`
--

CREATE TABLE `Config` (
  `name` varchar(50) NOT NULL,
  `key_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Config`
--

INSERT INTO `Config` (`name`, `key_name`, `value`) VALUES
('پسوندهای مجاز', 'allowed_file_types', 'jpg, gif'),
('مدت زمان نگه‌داری فایل‌های کاربران مهمان', 'life_time', '86300'),
('حداکثر حجم مجاز آپلود فایل', 'max_size', '10');

-- --------------------------------------------------------

--
-- Table structure for table `Files`
--

CREATE TABLE `Files` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `extension` varchar(50) NOT NULL,
  `size` float NOT NULL,
  `path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `url` text NOT NULL,
  `price` float NOT NULL,
  `downloads` int NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_private` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Files`
--

INSERT INTO `Files` (`id`, `username`, `name`, `type`, `extension`, `size`, `path`, `url`, `price`, `downloads`, `is_verified`, `is_private`) VALUES
(1, 'john', 'Make Them Cry! (CS_GO Wallpaper).jpeg', 'image/jpeg', 'jpeg', 0.172155, '/home/sajjad/M54/File-Store/public/uploads/john/Make Them Cry! (CS_GO Wallpaper).jpeg', 'http://127.0.0.1:5500/uploads/john/Make Them Cry! (CS_GO Wallpaper).jpeg', 0, 0, 0, 0),
(9, 'john', 'profile.png', 'image/png', 'png', 0.208782, '/home/sajjad/M54/File-Store/public/uploads/john/profile.png', 'http://localhost:5500/uploads/john/profile.png', 0, 0, 0, 0),
(10, 'john', 'profile_1.png', 'image/png', 'png', 0.208782, '/home/sajjad/M54/File-Store/public/uploads/john/profile_1.png', 'http://localhost:5500/uploads/john/profile.png', 0, 0, 0, 0),
(11, 'ehsanmody', 'photo_2021-08-09_22-24-01.jpg', 'image/jpeg', 'jpg', 0.17335, '/home/sajjad/M54/File-Store/public/uploads/ehsanmody/photo_2021-08-09_22-24-01.jpg', 'http://127.0.0.1:5500/uploads/ehsanmody/photo_2021-08-09_22-24-01.jpg', 0, 0, 0, 0),
(12, 'john', 'profile_2.png', 'image/png', 'png', 0.0111351, '/home/sajjad/M54/File-Store/public/uploads/john/profile_2.png', 'http://127.0.0.1:5500/uploads/john/profile_2.png', 0, 0, 0, 0),
(13, 'john', 'profile_3.png', 'image/png', 'png', 0.0111351, '/home/sajjad/M54/File-Store/public/uploads/john/profile_3.png', 'http://127.0.0.1:5500/uploads/john/profile_3.png', 0, 0, 0, 0),
(18, 'mostafasadeghifar', 'header-bg.jpg', 'image/jpeg', 'jpg', 0.185094, '/home/sajjad/M54/File-Store/public/uploads/mostafasadeghifar/header-bg.jpg', 'http://127.0.0.1:5500/uploads/mostafasadeghifar/header-bg.jpg', 0, 0, 0, 0),
(26, 'admin', 'profile.png', 'image/png', 'png', 0.0111351, '/home/sajjad/M54/File-Store/public/uploads/admin/profile.png', 'http://127.0.0.1:8080/uploads/admin/profile.png', 0, 0, 0, 0),
(27, 'ehsanmody', 'image.png', 'image/png', 'png', 0.0829697, '/home/sajjad/M54/File-Store/public/uploads/ehsanmody/image.png', 'http://127.0.0.1:8080/uploads/ehsanmody/image.png', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Trades`
--

CREATE TABLE `Trades` (
  `id` int NOT NULL,
  `file_id` int NOT NULL,
  `buyer_id` int NOT NULL,
  `seller_id` int NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` int NOT NULL DEFAULT '1',
  `credit` float NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `num_files` int NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `name`, `username`, `email`, `type`, `credit`, `is_active`, `num_files`, `password`) VALUES
(1, 'سجاد شهرابی', 'admin', 'msajjad.shahrabi@gmail.com', 1, 0, 1, 0, '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(2, 'ehsan', 'ehsanmody', 'ehsanmody@gmail.com', 1, 0, 1, 0, '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(3, 'mostafasadeghifar', 'mostafasadeghifar', 'mostafasadeghifar@gmail.com', 2, 0, 0, 0, '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(4, 'John', 'john', 'john@john.john', 3, 0, 0, 0, '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(5, 'ali', 'ali', 'ali@gmail.com', 1, 0, 1, 0, '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(19, 'ramin', 'ramin', 'ramin@gmail.com', 3, 0, 0, 0, '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(20, 'Nima', 'Nima', 'nima@gmail.com', 3, 0, 1, 0, '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(21, 'arsha', 'arsha', 'arsha@gmail.com', 3, 0, 1, 0, '7c4a8d09ca3762af61e59520943dc26494f8941b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Config`
--
ALTER TABLE `Config`
  ADD PRIMARY KEY (`key_name`);

--
-- Indexes for table `Files`
--
ALTER TABLE `Files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Files_ibfk_1` (`username`);

--
-- Indexes for table `Trades`
--
ALTER TABLE `Trades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_id` (`file_id`),
  ADD KEY `buyer_id` (`buyer_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Files`
--
ALTER TABLE `Files`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `Trades`
--
ALTER TABLE `Trades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Trades`
--
ALTER TABLE `Trades`
  ADD CONSTRAINT `Trades_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `Files` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `Trades_ibfk_2` FOREIGN KEY (`buyer_id`) REFERENCES `Users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `Trades_ibfk_3` FOREIGN KEY (`seller_id`) REFERENCES `Users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
