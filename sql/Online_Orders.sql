-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 10, 2018 at 06:04 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reduxtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `Online_Orders`
--

CREATE TABLE `Online_Orders` (
  `oo_id` int(11) NOT NULL,
  `confirmCode` varchar(6) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `stripe_custid` varchar(30) NOT NULL,
  `cust_id` int(9) DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `numOfProds` mediumint(9) NOT NULL,
  `includes_gift` tinyint(1) NOT NULL,
  `zipcode` int(6) NOT NULL,
  `chargeAmount` decimal(10,2) NOT NULL,
  `email` varchar(30) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `Online_Orders`
--
ALTER TABLE `Online_Orders`
  ADD PRIMARY KEY (`oo_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `stripe_custid` (`stripe_custid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Online_Orders`
--
ALTER TABLE `Online_Orders`
  MODIFY `oo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Online_Orders`
--
ALTER TABLE `Online_Orders`
  ADD CONSTRAINT `online_orders_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `Customers` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
