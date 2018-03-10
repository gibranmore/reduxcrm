-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 10, 2018 at 06:06 AM
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
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `prod_id` int(11) NOT NULL,
  `textDescription` varchar(100) DEFAULT NULL,
  `date_created` date NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `is_session_pack` tinyint(1) NOT NULL,
  `num_of_sessions` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`prod_id`, `textDescription`, `date_created`, `price`, `is_session_pack`, `num_of_sessions`) VALUES
(1, 'First-Time One Session', '2017-11-02', '30.00', 1, 1),
(2, 'One Session', '2017-11-02', '45.00', 1, 1),
(3, 'Trinity Pack (3 Sessions)', '2017-11-02', '120.00', 1, 3),
(5, 'Penta Pack (5 Sessions)', '2017-11-02', '175.00', 1, 5),
(10, 'Deca Pack (10 Sessions)', '2017-11-02', '300.00', 1, 10),
(11, 'Made Up Package Type with Any Number of Sessions', '2017-11-03', NULL, 1, NULL),
(15, 'Localized Cryo', '2017-12-23', '29.00', 1, 1),
(1000, 'REDUX Membership (30 Days, 1 session per day)', '2017-11-02', '375.00', 1, 1000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`prod_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
