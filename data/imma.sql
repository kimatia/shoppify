-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2019 at 08:06 AM
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
(27, '2', 'Fashion', 'Shirt', '5200', 'kkjk', 'kjkj', 'kjkk', 'kjkj', 'pic4.jpg', 'kk', '01:57 PM.'),
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
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `checkoutCode`, `productName`, `productPrice`, `email`) VALUES
(28, '5127', 'Shirt', '5200', 'kimatiadaniel@gmail.com');

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
  `verifyCode` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `firstname`, `lastname`, `username`, `phonenumber`, `email`, `password`, `logintype`, `lockvalue`, `verify`, `verifyCode`) VALUES
(33, 'kimatia', 'Dan', 'kims', '2357677', 'kimatiadaniel@gmail.com', '$2y$10$OdESqJT1lhs0gw8/8ourYOmoEXc5FacqJUBSP/lKZnI3r01P6A9mG', '3', '0', '1', '3800'),
(34, 'DAVID ', 'KAGURU', 'davy', '2233455', 'kagurudavy@gmail.com', '$2y$10$dUe31bjhHyukuT1sLKUhZe0N1AY31DqnkZB8IiLus6S3HF/CTyJ8W', '0', '1', '0', '3400'),
(35, 'brian', 'villa', 'brio', '12455', 'brian@gmail.com', '$2y$10$Se5v6vCaO.bv2mPEi1voiO06ksyzd4U4pM72ZstPkOIbzv8tJ/bfS', '0', '0', '0', '6644'),
(36, 'brian', 'villah', 'brianvillah', '0706180626', 'brianvillah@gmail.com', '$2y$10$OdESqJT1lhs0gw8/8ourYOmoEXc5FacqJUBSP/lKZnI3r01P6A9mG', '0', '0', '0', '3063'),
(37, 'Ndangwe', 'Immaculate', 'Imma', '0790149200', 'ndangweimmaculate@gmail.com', '$2y$10$.7WlBbpkUTEPrdIGQWmtKuZRq7DIUiHd9w3myNQA0xxDlaVB..C0G', '0', '0', '0', '0'),
(38, 'kbnbkhbhhb', 'khbhhk', 'kbkkh', '5441214', 'admin@admin.com', '$2y$10$CiwR7mQ1Mzv3IukKSg2qOukupt1W1v93IaNrJeeXYzFq6W5L9A7pC', '0', '0', '1', '1401'),
(40, 'uiuiiu', 'iyhyhyuj', 'jhhjhj', '0710805424', 'hhhhh@gmail.com', '$2y$10$/QNxQu67jCbbq6or/5MgeeOuBR5q.FbYhZpzDj9qpyvpR/meQ3PsC', '0', '0', '0', '9475');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
