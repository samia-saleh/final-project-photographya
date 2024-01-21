-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2024 at 01:49 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phtographya`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoris`
--

CREATE TABLE `categoris` (
  `id` int NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categoris`
--

INSERT INTO `categoris` (`id`, `name`) VALUES
(1, 'طبيعه'),
(2, 'بورتريه'),
(3, 'اشخاص');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'المكلا'),
(2, 'الشحر'),
(3, 'الغيل');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `name` varchar(500) NOT NULL,
  `categoryid` int NOT NULL,
  `ownerid` int NOT NULL,
  `viewnumber` int NOT NULL,
  `downloadenumber` int NOT NULL,
  `tags` text NOT NULL,
  `title` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_NotAvailable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `categoryid`, `ownerid`, `viewnumber`, `downloadenumber`, `tags`, `title`, `is_NotAvailable`) VALUES
(5, '659e9380d4f0d.jpg', 1, 1, 221, 44, 'ورد طبيعه ', NULL, 0),
(6, '659e9380d515f.jpg', 1, 1, 257, 7, 'ورد طبيعه ', NULL, 0),
(7, '659e9380d5321.jpg', 1, 1, 88, 5, 'ورد طبيعه ', NULL, 0),
(8, '659e9380d5585.jpg', 1, 1, 12, 0, 'ورد طبيعه ', NULL, 0),
(9, '659e93bb217d0.jpg', 3, 3, 1, 0, 'اشخاص', NULL, 0),
(10, '659e93bb21a00.jpg', 3, 3, 58, 0, 'اشخاص', NULL, 0),
(11, '659e93bb25761.jpg', 3, 3, 113, 2, 'اشخاص', 'مباني', 0),
(12, '659e93bb25a1c.jpg', 3, 3, 1, 0, 'اشخاص', NULL, 0),
(13, '659ee0c674cf7.jpg', 3, 1, 1, 0, 'ورد طبيعه ', NULL, 0),
(14, '659ee0c67908a.jpg', 3, 1, 77, 0, 'ورد طبيعه ', NULL, 0),
(15, '659ee0c67938c.jpg', 3, 1, 35, 3, 'ورد طبيعه ', NULL, 0),
(16, '659fc5fdec984.jpg', 1, 1, 1, 0, 'فواكه طازج', 'فراوله', 0),
(17, '65a0226c67ac4.jpg', 1, 1, 3, 0, 'ورد بنفسجي طبيعه تصوير', 'وردة بنفسجية', 0),
(18, '65a14977111c1.jpg', 1, 1, 1, 0, 'طبيعه قمر شلال سماء فراشه شجر', 'منظر طبيعي', 0),
(19, '65a1497711628.jpg', 1, 1, 4, 0, 'طبيعه قمر شلال سماء فراشه شجر', 'منظر طبيعي', 0),
(20, '65a1497711a45.jpg', 1, 1, 17, 0, 'طبيعه قمر شلال سماء فراشه شجر', 'منظر طبيعي', 0);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int NOT NULL,
  `imageId` int NOT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `imageId`, `userId`) VALUES
(63, 1, 5),
(64, 1, 5),
(82, 5, 1),
(83, 9, 1),
(85, 10, 3),
(86, 8, 1),
(90, 10, 1),
(96, 7, 2),
(98, 15, 2),
(139, 15, 1),
(143, 7, 14),
(170, 14, 3),
(171, 14, 5),
(176, 14, 1),
(182, 14, 8),
(183, 7, 8),
(185, 6, 8),
(186, 7, 16),
(187, 7, 1),
(188, 11, 1),
(189, 13, 1),
(190, 7, 11),
(191, 7, 3),
(194, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `photographer_fields`
--

CREATE TABLE `photographer_fields` (
  `id` int NOT NULL,
  `phtographer_id` int NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `photographer_fields`
--

INSERT INTO `photographer_fields` (`id`, `phtographer_id`, `category_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 3),
(4, 3, 3),
(5, 4, 1),
(6, 5, 2),
(7, 5, 3),
(8, 6, 2),
(9, 7, 2),
(10, 8, 2),
(11, 16, 2);

-- --------------------------------------------------------

--
-- Table structure for table `photographer_followers`
--

CREATE TABLE `photographer_followers` (
  `id` int NOT NULL,
  `phtographer_id` int NOT NULL,
  `user_Id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `photographer_followers`
--

INSERT INTO `photographer_followers` (`id`, `phtographer_id`, `user_Id`) VALUES
(11, 1, 2),
(65, 1, 11),
(66, 3, 11),
(67, 2, 11),
(69, 2, 1),
(70, 3, 2),
(85, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int NOT NULL,
  `description` text NOT NULL,
  `image_id` int NOT NULL,
  `reporter_id` int NOT NULL,
  `type` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `description`, `image_id`, `reporter_id`, `type`) VALUES
(1, '                      kjb', 7, 3, 'انتهاك حقوق الطبع والنشر أو مشكلة الخصوصية'),
(2, 'jhg', 7, 1, 'انتهاك حقوق الطبع والنشر أو مشكلة الخصوصية'),
(3, 'DAD', 6, 2, 'انتهاك حقوق الطبع والنشر أو مشكلة الخصوصية'),
(4, '                      نتنتى', 7, 1, ' انتهاك حقوق الطبع والنشر أو مشكلة الخصوصية '),
(5, '                      rfyj', 7, 1, ' انتهاك حقوق الطبع والنشر أو مشكلة الخصوصية '),
(6, '                      bkj', 5, 1, ' انتهاك حقوق الطبع والنشر أو مشكلة الخصوصية'),
(7, '                      jkh', 6, 1, ' محتوى غير مرغوب فيه أو علامة مائيه ');

-- --------------------------------------------------------

--
-- Table structure for table `saved_images`
--

CREATE TABLE `saved_images` (
  `id` int NOT NULL,
  `imageId` int NOT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `saved_images`
--

INSERT INTO `saved_images` (`id`, `imageId`, `userId`) VALUES
(1, 4, 2),
(2, 4, 2),
(3, 4, 2),
(4, 4, 2),
(5, 4, 2),
(6, 4, 2),
(7, 4, 2),
(8, 4, 2),
(9, 4, 2),
(10, 4, 2),
(11, 4, 2),
(12, 4, 2),
(112, 4, 1),
(149, 4, 6),
(154, 5, 2),
(158, 5, 6),
(180, 15, 2),
(183, 7, 2),
(186, 7, 8),
(188, 16, 1),
(191, 17, 1),
(192, 15, 1),
(193, 18, 1),
(194, 20, 1),
(198, 10, 1),
(200, 11, 1),
(203, 7, 3),
(204, 12, 3),
(205, 10, 3),
(208, 6, 8),
(209, 5, 1),
(210, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `scope`
--

CREATE TABLE `scope` (
  `id` int NOT NULL,
  `cityId` int NOT NULL,
  `photographerId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `scope`
--

INSERT INTO `scope` (`id`, `cityId`, `photographerId`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 2),
(4, 1, 3),
(5, 1, 4),
(6, 2, 5),
(7, 3, 5),
(8, 2, 6),
(9, 3, 7),
(10, 2, 8),
(11, 3, 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  `cover` varchar(500) DEFAULT NULL,
  `bio` varchar(500) DEFAULT NULL,
  `role` enum('admin','photographer','seeker','مصور','باحث') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(500) NOT NULL,
  `is_locked` tinyint(1) NOT NULL,
  `facebook` varchar(500) DEFAULT NULL,
  `instagram` varchar(500) DEFAULT NULL,
  `whatsapp` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `cover`, `bio`, `role`, `address`, `is_locked`, `facebook`, `instagram`, `whatsapp`) VALUES
(1, 'ساميه صالح', 'salehsamia89@gmail.com', '123', '65a99ddc3c838.jpg', '65a6579bbbfba.jpg', '      hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 'photographer', 'الديس', 0, 'https://www.instagram.com/samia_saleh99', 'https://www.instagram.com/samia_saleh99', 'https://www.instagram.com/samia_saleh99'),
(2, 'يوسف صالح', 'sgfd@sfsf.com', 'hh', '65a92acfcee72.jpg', '65a92956bacea.jpg', '      ', 'photographer', 'sd', 0, NULL, NULL, NULL),
(3, 'فاطمه محمد', 'fatima@gmail.com', '456', '65a797bbe4acc.jpg', '65a797cdc680f.jpg', 'مصور ', 'photographer', 'الديس', 0, NULL, NULL, NULL),
(5, 'نور بدر', 'noor@gmail.com', '123', '65a6217141f00.jpg', NULL, '                    kjas', 'photographer', 'الديس', 0, 'نئتءؤ', 'ئتء', 'https://www.instagram.com/fmaa2'),
(6, 'mn', 'salehsamia869@gmail.com', ',jb', '65a6217141f00.jpg', NULL, '                    nmb', 'photographer', 'mnb', 1, ',kn', 'https://www.instagram.com/fmaa2', 'mn'),
(7, 'jb', 'salehsamia@gmail.com', '123', '65a6217141f00.jpg', NULL, '                    jb', 'photographer', 'kjg', 0, 'https://www.facebook.com/fmaa', 'https://www.instagram.com/fmaa2', 'https://wa.me/qr/U6XBQH7FZCLHN1'),
(8, 'Jill Wellington', 'salehsamia8@gmail.com', '123', '65a79894bb11a.jpg', '65a5947002eaa.jpg', '      jbsd', 'photographer', 'ds', 0, 'https://www.facebook.com/fmaa', 'https://www.instagram.com/fmaa2', 'https://wa.me/qr/U6XBQH7FZCLHN1'),
(9, 'سسس', 'fat@gmail.com', '123', '128-1280406_user-icon-png', NULL, NULL, 'باحث', 'الديس', 0, NULL, NULL, NULL),
(10, 'سام', 'at@gmail.com', '123', '65a62e92ad1e2.jpg', NULL, NULL, 'باحث', 'الديس', 0, NULL, NULL, NULL),
(11, 'ساميه', 'salehsam@gmail.com', '123', '128-1280406_user-icon-png', NULL, NULL, 'باحث', 'ds', 0, NULL, NULL, NULL),
(12, 'kj', 'salehsam@gmail.c', '123', '128-1280406_user-icon-png', NULL, NULL, 'باحث', 'ds', 0, NULL, NULL, NULL),
(13, 'kjال', 'salehsam@gmail.ckk', 'jg', '65a6217141f00.jpg', NULL, NULL, 'باحث', 'ds', 0, NULL, NULL, NULL),
(14, 'عفاف', 'salhsam@gmail.ckk', 'سي', '65a6217141f00.jpg', '65a636112d6b4.jpg', NULL, 'باحث', 'ds', 0, NULL, NULL, NULL),
(15, 'samia', 'samia@hotmail.com', '123', NULL, NULL, NULL, 'admin', 'mukalla', 0, NULL, NULL, NULL),
(16, 'سامي', 'sami@gmail.com', '123', '65a6217141f00.jpg', NULL, '                    نىشسبؤ', 'مصور', 'kjg', 0, 'https://www.facebook.com/fmaa', 'https://www.instagram.com/fmaa2', 'https://wa.me/qr/U6XBQH7FZCLHN1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoris`
--
ALTER TABLE `categoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photographer_fields`
--
ALTER TABLE `photographer_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photographer_followers`
--
ALTER TABLE `photographer_followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_images`
--
ALTER TABLE `saved_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scope`
--
ALTER TABLE `scope`
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
-- AUTO_INCREMENT for table `categoris`
--
ALTER TABLE `categoris`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `photographer_fields`
--
ALTER TABLE `photographer_fields`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `photographer_followers`
--
ALTER TABLE `photographer_followers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `saved_images`
--
ALTER TABLE `saved_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `scope`
--
ALTER TABLE `scope`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
