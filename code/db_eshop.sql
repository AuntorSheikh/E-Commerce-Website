-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2020 at 09:54 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cse311`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`) VALUES
(9, 'alex'),
(10, 'freeland'),
(11, 'sailor'),
(12, 'tajjim');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `ssid` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `ssid`, `product_id`, `product_name`, `product_price`, `quantity`, `product_image`) VALUES
(229, '1p4mcjue4qibf7tt78i42ohq0a', 1, 'product 1', 20, 1, 'product5.jpg'),
(230, 'smfa143fgmg3jc0so72negta0q', 1, 'product 1', 20, 1, 'product5.jpg'),
(238, '1hng4rqm3bm5oine96fq0eht5b', 1, 'product 1', 20, 1, 'product5.jpg'),
(239, '1hng4rqm3bm5oine96fq0eht5b', 2, 'product 2', 1455, 1, 'product4.jpg'),
(240, '1hng4rqm3bm5oine96fq0eht5b', 4, 'product 4', 1, 1, 'product2.jpg'),
(241, 'l0tc7c0sksbpla11ilm4h216lo', 1, 'product 1', 20, 1, 'product5.jpg'),
(242, 'st7uhq46ms609fqa5m91a95lf7', 1, 'product 1', 20, 1, 'product5.jpg'),
(243, 'st7uhq46ms609fqa5m91a95lf7', 3, 'product 3', 3, 1, 'product3.jpg'),
(247, 'kvhbvgcadjnbtt80p10llk0jso', 1, 'product 1', 20, 1, 'product5.jpg'),
(250, 'uvj1tukp5a5jk5j15kc3it39mk', 1, 'product 1', 20, 4, 'product5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`) VALUES
(9, 'cloth'),
(10, 'shirt'),
(11, 'Mask'),
(12, 'vaccine');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(100) NOT NULL,
  `cus_email` varchar(255) NOT NULL,
  `cus_pass` varchar(255) NOT NULL,
  `cus_country` varchar(255) NOT NULL,
  `cus_state` varchar(100) NOT NULL,
  `cus_address` varchar(100) NOT NULL,
  `cus_phone` varchar(100) NOT NULL,
  `cus_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`cus_id`, `cus_name`, `cus_email`, `cus_pass`, `cus_country`, `cus_state`, `cus_address`, `cus_phone`, `cus_code`) VALUES
(7, 'auntor Khan', 'auntor@gmail.com', '123456', 'bd', 'city', 'dsgf cfbgd', '01834920142', '1229'),
(8, 'saikot', 'ami@gmail.com', '123456', 'ete', 'hrfghrf', 'thrdg', '3464', '3553'),
(9, 'saikot', 'kazi@gmail.com', '123456', 'ete', 'hrfghrf', 'thrdg', '3464', '3553');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_cart`
--

CREATE TABLE `tbl_customer_cart` (
  `cus_cart_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer_cart`
--

INSERT INTO `tbl_customer_cart` (`cus_cart_id`, `cus_id`, `product_id`, `product_name`, `quantity`, `product_image`, `product_price`) VALUES
(77, 8, 1, 'product 1', 2, 'product5.jpg', 20.00),
(78, 8, 1, 'product 1', 1, 'product5.jpg', 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_des` text NOT NULL,
  `stock` int(11) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `cat_id`, `product_name`, `brand_id`, `product_des`, `stock`, `product_image`, `product_price`, `product_type`) VALUES
(1, 1, 'product 1', 1, 'rtygte ret ert', 5, 'product5.jpg', 20, 0),
(2, 1, 'product 2', 1, 'rtygte ret ert', 5, 'product4.jpg', 1455, 0),
(3, 1, 'product 3', 1, 'rtygte ret ert', 5, 'product3.jpg', 3, 0),
(4, 1, 'product 4', 1, 'rtygte ret ert', 5, 'product2.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `trash_box`
--

CREATE TABLE `trash_box` (
  `trash_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `tbl_customer_cart`
--
ALTER TABLE `tbl_customer_cart`
  ADD PRIMARY KEY (`cus_cart_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `trash_box`
--
ALTER TABLE `trash_box`
  ADD PRIMARY KEY (`trash_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_customer_cart`
--
ALTER TABLE `tbl_customer_cart`
  MODIFY `cus_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trash_box`
--
ALTER TABLE `trash_box`
  MODIFY `trash_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
