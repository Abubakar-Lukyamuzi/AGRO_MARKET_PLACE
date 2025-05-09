-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 06, 2024 at 01:06 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agro_market_place`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`) VALUES
(1, 'abubah', 'lahuslcamz@gmail.com', '$2y$10$Od4QMrzdpSPcl1y4BgEIVOFMp80Shy59KyM54HICjnwaWFl53K7J2'),
(2, 'tron', 'tyx@gmail.com', '$2y$10$1.hf/l1ySDLe2JnOmsJuIOqVK3HQDJD7.fgQKnnDYiFWw/Q93.wwi'),
(3, 'Musumba Abby', 'abby@gmail.com', '$2y$10$BARHR39toZHdDue6PtqMbuopmJpIfcDq/3//XLFeux0a9Plht/yhm'),
(4, 'Kelvin Nsamba', 'kelly@gmail.com', '$2y$10$TG4YkT2BtpzfwVOe0J5lw.HQ4GIBM.m2JTcnPE7GDr6ayzqNxssF.'),
(5, 'Chris Hemsworth', 'chris@gmail.com', '$2y$10$7Zh0u2On76R3DAwBLUBnjez/xcYwSyVhjkRRcsIbrSKBSW3vJFYE2'),
(6, 'Baby Shark', 'shark@gmail.com', '$2y$10$/vw3kYi6eILxgPqDGeaZnu6XW.TT8x7GOb.m3Z5vcaMGXk1Q5pgNW'),
(7, 'Ziinat Hussein', 'zh@gmail.com', '$2y$10$D.hoW0o3i56SkqH6G5eD/eZ1h27aOV3PYVMCP/PpQcuZSvz8DUq.u'),
(8, 'Bilal Abdul', 'bilal@gmail.com', '$2y$10$ox21hSIFqFxUtkDV8/txZOgRBAJz1qT2.iFh2eD7xhuzrTKdjAj6m');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
