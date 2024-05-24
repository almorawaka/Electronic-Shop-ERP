-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 24, 2024 at 08:15 AM
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
-- Database: `electronicsshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `availablestock`
--

DROP TABLE IF EXISTS `availablestock`;
CREATE TABLE IF NOT EXISTS `availablestock` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `quantity` int DEFAULT '0',
  `unit_price` decimal(10,2) DEFAULT NULL,
  `supplier_id` int DEFAULT NULL,
  `reorder_level` int DEFAULT NULL,
  `reorder_quantity` int DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_of_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_restock_date` date DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `supplier_id` (`supplier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `availablestock`
--

INSERT INTO `availablestock` (`product_id`, `product_name`, `category`, `quantity`, `unit_price`, `supplier_id`, `reorder_level`, `reorder_quantity`, `description`, `date_of_entry`, `last_restock_date`) VALUES
(1, 'NBR O rings', 'O Rings', 20, 30.00, 1, NULL, NULL, 'ID 6x2.65 mm O rings', '2024-05-17 18:30:00', NULL),
(2, 'NBR O rings', 'O Rings', 20, 30.00, 1, NULL, NULL, 'ID 7x2.65 mm O rings', '2024-05-18 17:50:29', NULL),
(3, 'NBR O rings', 'O Rings', 20, 30.00, 1, NULL, NULL, 'ID 8x2.65mm O Rings', '2024-05-18 17:50:29', NULL),
(4, 'NBR O rings', 'O Rings', 20, 30.00, 1, NULL, NULL, 'ID 9x2.65mm O Rings', '2024-05-18 17:50:29', NULL),
(5, 'NBR O rings', 'O Rings', 20, 30.00, 1, NULL, NULL, 'ID 10x2.65mm O Rings', '2024-05-18 17:50:29', NULL),
(6, 'NBR O rings', 'O Rings', 10, 30.00, 1, NULL, NULL, 'ID 11.2x2.65mm O Rings', '2024-05-18 17:50:29', NULL),
(7, 'NBR O rings', 'O Rings', 10, 30.00, 1, NULL, NULL, 'ID 12.5x2.65mm O Rings', '2024-05-18 17:50:29', NULL),
(8, 'NBR O rings', 'O Rings', 10, 30.00, 1, NULL, NULL, 'ID 13.2x2.65mm O Rings', '2024-05-18 17:50:29', NULL),
(9, 'NBR O rings', 'O Rings', 10, 30.00, 1, NULL, NULL, 'ID 15x2.65mm O Rings', '2024-05-18 17:50:29', NULL),
(10, 'NBR O rings', 'O Rings', 10, 30.00, 1, NULL, NULL, 'ID 16x2.65mm O Rings', '2024-05-18 17:50:29', NULL),
(11, 'NBR O rings', 'O Rings', 5, 30.00, 1, NULL, NULL, 'ID 18x2.65mm O Rings', '2024-05-18 17:50:29', NULL),
(12, 'NBR O rings', 'O Rings', 5, 30.00, 1, NULL, NULL, 'ID 20x2.65mm O Rings', '2024-05-18 17:50:29', NULL),
(13, 'NBR O rings', 'O Rings', 5, 30.00, 1, NULL, NULL, 'ID 21.2x2.65mm O Rings', '2024-05-18 17:50:29', NULL),
(14, 'NBR O rings', 'O Rings', 5, 30.00, 1, NULL, NULL, 'ID 22.4x2.65mm O Rings', '2024-05-18 17:50:29', NULL),
(15, 'NBR O rings', 'O Rings', 5, 30.00, 1, NULL, NULL, 'ID 22.4x2.65mm O Rings', '2024-05-18 17:50:29', NULL),
(16, 'NBR O rings', 'O Rings', 5, 30.00, 1, NULL, NULL, 'ID 25x2.65mm O Rings', '2024-05-18 17:50:29', NULL),
(17, 'NBR O rings', 'O Rings', 5, 30.00, 1, NULL, NULL, 'ID 22.4x2.65mm O Rings', '2024-05-18 17:50:29', NULL),
(18, 'Screwdriver Kit', 'Hand Tools (screwdrivers, pliers) ', 1, 2000.00, 1, NULL, NULL, 'Mini Screwdriver Set 25 pcs', '2024-05-18 17:50:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_number` int DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `contact_number`, `address`, `registration_date`) VALUES
(1, 'Asanka Lakmal Morawaka', 'almorawaka@gmail.com', 718278524, 'No 379/6/2,, Mahara Nugegoda\r\nKadawatha', '2024-05-08 14:37:53');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplier_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `contact_name` varchar(25) DEFAULT NULL,
  `contact_email` varchar(30) DEFAULT NULL,
  `contact_phone` varchar(12) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `name`, `contact_name`, `contact_email`, `contact_phone`, `address`) VALUES
(1, 'AliExpress', 'AliEx', '', '', 'China');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(25) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'Asanka', '$2y$10$nUY2KGv4rxn80Gbhn8R.OuclT3x4TDL1K/nqyIBmlnKafJMIP9SqC', 'almorawaka@gmail.com'),
(2, 'lakmal', '$2y$10$wP3jCFsPHC7iUcJFYHz.HeOxcPKkKcHgkNtCh4m9m2tKX1Kdd45pa', 'lakmal@gmail.com'),
(3, 'dinuth', '$2y$10$0LF0KyqGQ7r63iu/Vj5bpemyAzNw84qFaStpSdYCoyQY28D6sIM5y', 'dinuth@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
