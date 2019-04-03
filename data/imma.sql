-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 03, 2019 at 08:57 AM
-- Server version: 5.7.18
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imma`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL,
  `modified` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'Clothing', 'Category for anything related to fashion.', '2014-06-01 00:35:07', '2014-05-30 12:04:33'),
(2, 'Jewellery', 'Gadgets, drones and more.', '2014-06-01 00:35:07', '2014-05-30 12:04:33'),
(3, 'Footwear', 'Motor sports and more', '2014-06-01 00:35:07', '2014-05-30 12:04:54'),
(5, 'Bags', 'Movie products.', '0000-00-00 00:00:00', '2016-01-08 07:57:26'),
(6, 'Makeup', 'Kindle books, audio books and more.', '0000-00-00 00:00:00', '2016-01-08 07:57:47'),
(13, 'Belts', 'Drop into new winter gear.', '2016-01-09 02:24:24', '2016-01-08 19:54:24');

-- --------------------------------------------------------

--
-- Table structure for table `category_products`
--

CREATE TABLE `category_products` (
  `id` int(11) NOT NULL,
  `pid` varchar(255) NOT NULL,
  `productCategory` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productPrice` varchar(255) NOT NULL,
  `productColour` varchar(255) NOT NULL,
  `productDescription` varchar(255) NOT NULL,
  `productDiscount` varchar(255) NOT NULL,
  `productFee` varchar(255) NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `personelle` varchar(255) NOT NULL,
  `postDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_products`
--

INSERT INTO `category_products` (`id`, `pid`, `productCategory`, `productName`, `productPrice`, `productColour`, `productDescription`, `productDiscount`, `productFee`, `productImage`, `personelle`, `postDate`) VALUES
(7, '2', 'Fashion', 'Shoe', '6000', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'p6 (copy).jpg', 'kk', '01:57 PM.'),
(8, '2', 'Fashion', 'Shirt', '5200', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pi.jpg', 'kk', '01:57 PM.'),
(9, '2', 'Fashion', 'Shoe', '5000', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pi2.jpg', 'kk', '01:57 PM.'),
(10, '2', 'Fashion', 'Shirt', '8000', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pi3.jpg', 'kk', '01:57 PM.'),
(11, '2', 'Fashion', 'Shoe', '6000', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pi4.jpg', 'kk', '01:57 PM.'),
(12, '2', 'Fashion', 'Shirt', '5200', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pic.jpg', 'kk', '01:57 PM.'),
(13, '2', 'Fashion', 'Shoe', '5000', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pic1.jpg', 'kk', '01:57 PM.'),
(14, '2', 'Fashion', 'Shirt', '8000', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pic2.jpg', 'kk', '01:57 PM.'),
(15, '2', 'Fashion', 'Shoe', '6000', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pic3.jpg', 'kk', '01:57 PM.'),
(16, '2', 'Fashion', 'Shirt', '5200', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pic4.jpg', 'kk', '01:57 PM.'),
(17, '2', 'Fashion', 'Shoe', '5000', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pic5.jpg', 'kk', '01:57 PM.'),
(18, '2', 'Fashion', 'Shirt', '8000', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pic6.jpg', 'kk', '08:09 PM.'),
(22, '2', 'Fashion', 'Shoe', '6000', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pi4.jpg', 'kk', '01:57 PM.'),
(23, '2', 'Fashion', 'Shirt', '5200', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pic.jpg', 'kk', '01:57 PM.'),
(24, '2', 'Fashion', 'Shoe', '5000', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pic1.jpg', 'kk', '01:57 PM.'),
(25, '2', 'Fashion', 'Shirt', '8000', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pic2.jpg', 'kk', '01:57 PM.'),
(26, '2', 'Fashion', 'Shoe', '6000', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pic3.jpg', 'kk', '01:57 PM.'),
(27, '2', 'Fashion', 'Shirt', '5200', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pic4.jpg', 'kk', '02:26 PM.'),
(28, '2', 'Fashion', 'Shoe', '5000', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pic5.jpg', 'kk', '01:57 PM.');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `checkoutCode` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productPrice` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `mode` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `checkoutCode`, `productName`, `productPrice`, `email`, `name`, `phone`, `mode`, `duration`) VALUES
(29, '2563', 'Shirt', '5200', 'kimatiadaniel@gmail.com', 'kimatia Dan', '254795511728', 'Road Transport', '2 Days'),
(30, '2885', 'Shoe', '6000', 'kimatiadaniel@gmail.com', 'kimatia Dan', '254795511728', 'Road Transport', '2 Days'),
(31, '6289', 'Shoe', '6000', 'ndangweimmaculate@gmail.com', 'Immaculate Ndangwe', '254790149200', 'Road Transport', '2 Days');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `logintype` varchar(11) NOT NULL DEFAULT '0',
  `lockvalue` varchar(255) NOT NULL DEFAULT '0',
  `verify` varchar(11) NOT NULL DEFAULT '0',
  `verifyCode` varchar(255) NOT NULL DEFAULT '0',
  `userDefault` varchar(255) NOT NULL DEFAULT 'kimatiadaniel@gmail.com'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `firstname`, `lastname`, `username`, `phonenumber`, `email`, `password`, `logintype`, `lockvalue`, `verify`, `verifyCode`, `userDefault`) VALUES
(33, 'kimatia', 'Dan', 'kims', '254795511728', 'kimatiadaniel@gmail.com', '$2y$10$OdESqJT1lhs0gw8/8ourYOmoEXc5FacqJUBSP/lKZnI3r01P6A9mG', '3', '0', '1', '8078', 'kimatiadaniel@gmail.com'),
(34, 'Willian', 'Juma', 'Cerey', '254716318513', 'williamjuma@gmail.com', '$2y$10$dUe31bjhHyukuT1sLKUhZe0N1AY31DqnkZB8IiLus6S3HF/CTyJ8W', '0', '1', '0', '3400', 'kimatiadaniel@gmail.com'),
(36, 'brian', 'villah', 'brianvillah', '254706180626', 'brianvillah@gmail.com', '$2y$10$OdESqJT1lhs0gw8/8ourYOmoEXc5FacqJUBSP/lKZnI3r01P6A9mG', '0', '0', '0', '3063', 'kimatiadaniel@gmail.com'),
(40, 'Kimatia', 'Joshua', 'Kims', '254710805424', 'arbetmanodans@gmail.com', '$2y$10$/QNxQu67jCbbq6or/5MgeeOuBR5q.FbYhZpzDj9qpyvpR/meQ3PsC', '0', '0', '0', '9475', 'kimatiadaniel@gmail.com'),
(43, 'Linda', 'Nyakasi', 'Liz', '254799025408', 'lindanyakasi@gmail.com', '$2y$10$Pt0QRUx/5i2IGSdAAebntu7Iq1h3QIYY1xNytYaMkqGOZ9EB7J0ry', '0', '0', '0', '3493', 'kimatiadaniel@gmail.com'),
(44, 'Mom', 'Mom', 'Mum', '254728368410', 'lindanyakasii@gmail.com', '$2y$10$Pt0QRUx/5i2IGSdAAebntu7Iq1h3QIYY1xNytYaMkqGOZ9EB7J0ry', '0', '0', '0', '3493', 'kimatiadaniel@gmail.com'),
(48, 'Telcom', 'joshua', 'kims', '254772773272', 'kimatiadaniell@gmail.com', '$2y$10$otWxfswDL4FrHsln5ROBMeD/9q7AH6yTUnUnAilJ9cWxwpMymuzmG', '0', '0', '1', '1511', 'kimatiadaniel@gmail.com'),
(50, 'Immaculate', 'Ndangwe', 'Imma', '254790149200', 'ndangweimmaculate@gmail.com', '$2y$10$nj16WAoDgJAnOtza9PLOOOj7AWkCHgjKPVrr8icM8PWKkR6XMq302', '3', '0', '1', '5832', 'kimatiadaniel@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_products`
--
ALTER TABLE `category_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `category_products`
--
ALTER TABLE `category_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
