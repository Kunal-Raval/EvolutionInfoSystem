-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 02:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internship`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `c_name`, `created_date`, `status`) VALUES
(1, 'Balls', '2023-05-19', 0),
(2, 'Bats', '2023-05-19', 0),
(3, 'Other Cricket Equipment', '2023-05-19', 0),
(4, 'Cricket Gloves', '2023-05-19', 0),
(5, 'Cricket Helmet', '2023-05-19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_sku` varchar(255) NOT NULL,
  `p_details` varchar(1000) NOT NULL,
  `p_quantity` int(11) NOT NULL,
  `p_price` varchar(10) NOT NULL,
  `img` varchar(500) NOT NULL,
  `p_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`pid`, `cid`, `p_name`, `p_sku`, `p_details`, `p_quantity`, `p_price`, `img`, `p_status`) VALUES
(1, 2, 'Blade Bat', 'BAT001', 'High-quality blade bat for professional players.', 10, '199.99', '', 0),
(2, 2, 'Junior Bat', 'BAT002', 'Lightweight bat designed for junior players.', 10, '199.99', '', 0),
(3, 2, 'Junior Willow Bat', 'BAT003', 'Willow bat suitable for junior players.', 10, '199.99', '', 0),
(4, 2, 'Kashmir Willow Bat', 'BAT004', 'Bat made from Kashmir willow for recreational players.', 10, '199.99', '', 0),
(5, 2, 'Lightweight Bat', 'BAT005', 'Ultra-lightweight bat for effortless batting.', 10, '199.99', '', 0),
(6, 2, 'Powerplay Bat', 'BAT006', 'Powerful bat for aggressive stroke play.', 10, '199.99', '', 0),
(7, 2, 'Senior Bat', 'BAT007', 'Bat suitable for senior players.', 10, '199.99', '', 0),
(8, 2, 'Senior Willow Bat', 'BAT008', 'Willow bat for senior players.', 10, '199.99', '', 0),
(9, 2, 'Short Handle Bat', 'BAT009', 'Bat with a shorter handle for enhanced control.', 10, '199.99', '', 0),
(10, 2, 'Training Bat', 'BAT010', 'Bat specifically designed for training purposes.', 10, '199.99', '', 0),
(11, 2, 'Willow Bat', 'BAT011', 'Finest Blade', 10, '199.99', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role_table`
--

CREATE TABLE `role_table` (
  `roleid` int(11) NOT NULL,
  `rolename` varchar(255) NOT NULL,
  `context` varchar(1000) NOT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_table`
--

INSERT INTO `role_table` (`roleid`, `rolename`, `context`, `status`) VALUES
(1, 'SUPER ADMIN', 'ALL', 0),
(2, 'SUB-ADMIN', 'Home, Product, Contact', 0),
(3, 'USERS', 'Product, Contact', 0),
(4, 'GUEST', 'Product', 0),
(5, 'GUEST1', 'Product', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `roleid` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phn` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `roleid`, `name`, `email`, `phn`, `password`, `status`) VALUES
(1, 1, 'Kunal Raval', 'kunalcraval@gmail.com', '7990827719', '123456', 0),
(2, 3, 'Tony Stark', 'tony@gmail.com', '895647123', '123456', 0),
(4, 2, 'Thanos', 'thanos@gmail.com', '4568923105', '123456', 0),
(5, 5, 'Kunal1', 'kunalcrava1l@gmail.com', '4578120021', '132456', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `c_name` (`c_name`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `p_name` (`p_name`),
  ADD UNIQUE KEY `p_sku` (`p_sku`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `role_table`
--
ALTER TABLE `role_table`
  ADD PRIMARY KEY (`roleid`),
  ADD UNIQUE KEY `rolename` (`rolename`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phn` (`phn`),
  ADD KEY `role_table` (`roleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role_table`
--
ALTER TABLE `role_table`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `cid` FOREIGN KEY (`cid`) REFERENCES `category` (`cid`),
  ADD CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `category` (`cid`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role_table` FOREIGN KEY (`roleid`) REFERENCES `role_table` (`roleid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
