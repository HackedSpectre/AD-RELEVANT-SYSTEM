-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2025 at 11:25 AM
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
-- Database: `ad_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(5, 'admin', 'admin123'),
(7, 'param', 'param123');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `link_url` varchar(255) NOT NULL DEFAULT '#'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `description`, `image_url`, `keywords`, `link_url`) VALUES
(1, 'iPhone sale', 'Get any iPhone at lowest price. Visit our store now', 'https://m.media-amazon.com/images/G/31/img24/Wireless/Madhav/jupiter24/Iphone/Contest/D159171979_1242_01.gif', 'iphone, phone, apple', 'https://www.amazon.in/b?ie=UTF8&node=80692548031'),
(4, 'Black Friday Sale', 'Grab the best opportunity on Black Friday. Best deals on smatphones', 'https://m-cdn.phonearena.com/images/hub/114-wide-two_1200/Black-Friday-phone-deals-2024-Highlights-of-the-event.webp?1733754740', 'smartphone, mobile, phone', 'https://www.flipkart.com/mobile-phones-store?fm=neo%2Fmerchandising&iid=M_b5c8a714-7766-409d-be8f-980b71528f00_1_372UD5BXDFYS_MC.ZRQ4DKH28K8J&otracker=hp_rich_navigation_2_1.navigationCard.RICH_NAVIGATION_Mobiles_ZRQ4DKH28K8J&otracker1=hp_rich_navigation_'),
(5, 'Summer sale', 'Buy branded clothes at ease at your door step with us at lowest price', 'https://as1.ftcdn.net/jpg/02/11/28/00/1000_F_211280049_g8nsjnEXE2383rW14OQ64Rg2WPANojKK.jpg', 'fashion, cloth, clothes, saree, shirt, pant', 'https://www.meesho.com/'),
(6, 'Black Friday sale', 'Buy clothes at 50-80% discount at our website.', 'https://as2.ftcdn.net/v2/jpg/10/09/04/61/1000_F_1009046152_rO0HKbpRPPp3jyR628sUgolVty4zMdNV.jpg', 'fashion, cloth, clothes, saree, shirt, pant', 'https://www.myntra.com/');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`id`, `session_id`, `activity`, `timestamp`) VALUES
(191, '6qpmnjfj8o450sbcjjdtp0nigm', 'shirt', '2025-04-12 08:43:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
