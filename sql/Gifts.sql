-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 10, 2018 at 06:03 AM
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
-- Table structure for table `Gifts`
--

CREATE TABLE `Gifts` (
  `gid` int(11) NOT NULL,
  `oo_id` int(11) DEFAULT NULL,
  `from_name` varchar(30) NOT NULL,
  `recipient_email` varchar(30) NOT NULL,
  `pid` int(11) NOT NULL,
  `datepurchased` date NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `Gifts`
--
ALTER TABLE `Gifts`
  ADD PRIMARY KEY (`gid`),
  ADD UNIQUE KEY `gid` (`gid`),
  ADD KEY `oo_id` (`oo_id`),
  ADD KEY `pid` (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Gifts`
--
ALTER TABLE `Gifts`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Gifts`
--
ALTER TABLE `Gifts`
  ADD CONSTRAINT `gifts_ibfk_1` FOREIGN KEY (`oo_id`) REFERENCES `Online_Orders` (`oo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gifts_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `Packages` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
