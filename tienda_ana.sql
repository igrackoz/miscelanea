-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 23, 2024 at 12:52 AM
-- Server version: 5.6.24-log
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tienda_ana`
--

-- --------------------------------------------------------

--
-- Table structure for table `cashiers`
--

DROP TABLE IF EXISTS `cashiers`;
CREATE TABLE IF NOT EXISTS `cashiers` (
  `cashier_id` int(11) NOT NULL AUTO_INCREMENT,
  `cashier_name` int(11) NOT NULL,
  `cashier_password` int(11) NOT NULL,
  PRIMARY KEY (`cashier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(10) NOT NULL AUTO_INCREMENT,
  `client_firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_adress1` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_adress2` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_district` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_state` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_postal_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_comments` longblob NOT NULL,
  `client_credit` tinyint(1) NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

DROP TABLE IF EXISTS `credits`;
CREATE TABLE IF NOT EXISTS `credits` (
  `credit_id` int(11) NOT NULL AUTO_INCREMENT,
  `credit_record` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_movement` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_amount` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_current_balance` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cashier_id` int(10) NOT NULL,
  PRIMARY KEY (`credit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` int(10) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_image` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_enabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `department_image`, `department_enabled`) VALUES
(1, 'Despensa', 'despensa_optimized.png', 1),
(2, 'Jugos y Bebidas', 'bebidas_optimized.png', 1),
(3, 'lácteos y huevo', 'lacteos_optimized.png', 1),
(4, 'carnes procesadas', 'carnes_optimized.png', 1),
(5, 'Frituras y Botanas', 'botanas_optimized.png', 1),
(6, 'Galletas y Dulces', 'galletas_optimized.png', 1),
(7, 'Pan Dulce', '', 0),
(8, 'Pan y Tortillas', 'pan_tortillas_optimized.png', 1),
(9, 'Frutas y verduras', '', 0),
(10, 'Higiene Personal', 'higiene_optimized.png', 1),
(11, 'Limpieza del Hogar', 'limpieza_optimized.png', 1),
(12, 'Desechables y Consumibles', 'desechables_optimized.png', 1),
(13, 'Mascotas', 'mascotas_optimized.png', 1),
(14, 'Temporada', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `movements`
--

DROP TABLE IF EXISTS `movements`;
CREATE TABLE IF NOT EXISTS `movements` (
  `movement_id` int(10) NOT NULL AUTO_INCREMENT,
  `movement_date` datetime NOT NULL,
  `movement_description` int(11) NOT NULL,
  `movement_name` int(11) NOT NULL,
  `movement_type` int(11) NOT NULL,
  `movement_was` int(11) NOT NULL,
  `movement_quantity` int(11) NOT NULL,
  `movement_are` int(11) NOT NULL,
  `cashier_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`movement_id`),
  KEY `cashier_id` (`cashier_id`,`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_register` date NOT NULL,
  `product_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_cost` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_wholesale` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_image` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_stock` int(10) DEFAULT NULL,
  `product_minimun` int(10) DEFAULT NULL,
  `product_maximum` int(10) DEFAULT NULL,
  `product_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_available` tinyint(1) NOT NULL,
  `department_id` int(10) NOT NULL,
  `segment_id` int(10) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `department_id` (`department_id`,`segment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_register`, `product_code`, `product_description`, `product_cost`, `product_price`, `product_wholesale`, `product_image`, `product_stock`, `product_minimun`, `product_maximum`, `product_type`, `product_available`, `department_id`, `segment_id`) VALUES
(3, '2024-12-06', '7501020569353', 'Jamón Americano de Pavo y Cerdo NutriDeli 250gr', '24.60', '30.00', '', 'NDJAPC250G.webp', 2, 0, 0, 'unidad', 1, 4, 1),
(4, '2024-12-06', '7501020569346', 'Salchicha de Pavo Nutrideli 250gr', '19.00', '23.00', '', 'NDSP250G.webp', 0, 0, 0, 'unidad', 0, 4, 1),
(5, '2024-12-13', '7501020565911', 'Leche Deslactosada Tetrapack Lala 1L', '27.20', '33.00', NULL, 'LLDC1L.png', 1, 1, 3, 'unidad', 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `segments`
--

DROP TABLE IF EXISTS `segments`;
CREATE TABLE IF NOT EXISTS `segments` (
  `segment_id` int(10) NOT NULL AUTO_INCREMENT,
  `segment_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(10) NOT NULL,
  PRIMARY KEY (`segment_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `segments`
--

INSERT INTO `segments` (`segment_id`, `segment_name`, `department_id`) VALUES
(1, 'carnes procesadas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `ticket_id` int(10) NOT NULL AUTO_INCREMENT,
  `ticket_date` datetime NOT NULL,
  `ticket_payment_method` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_exact_change` tinyint(1) DEFAULT NULL,
  `ticket_payment` decimal(10,0) NOT NULL,
  `ticket_total` decimal(10,0) NOT NULL,
  `ticket_commission` decimal(10,0) DEFAULT NULL,
  `ticket_subtotal` decimal(10,0) NOT NULL,
  `ticket_change` decimal(10,0) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`ticket_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_products`
--

DROP TABLE IF EXISTS `ticket_products`;
CREATE TABLE IF NOT EXISTS `ticket_products` (
  `ticket_product_id` int(10) NOT NULL AUTO_INCREMENT,
  `ticket_product_price` decimal(10,0) NOT NULL,
  `ticket_product_quantity` int(2) NOT NULL,
  `product_id` int(10) NOT NULL,
  `ticket_id` int(10) NOT NULL,
  PRIMARY KEY (`ticket_product_id`),
  KEY `product_id` (`product_id`,`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_street` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_num_ext` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_color_picker` int(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_street`, `user_num_ext`, `user_phone`, `user_email`, `user_password`, `user_color_picker`) VALUES
(2, 'hector armando', 'ortega', 'asdf', '1234', '55523782349', 'igrackoz@gmail.com', '$2y$10$Ky5vYO.J9umdIl9QNXKIEOU0ZU9gTipHAGUrXrZUvIZgT.J7Pnuoq', 266),
(3, 'Ernesto fabian', 'Villanueva', 'manzano', '5678', '', 'asdf@outlook.com', '$2y$10$j6HzCp5YoAdER2.DRqziYe6uov65DCyZyy8NYjoi/HsD/7nbJNtca', 216);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
