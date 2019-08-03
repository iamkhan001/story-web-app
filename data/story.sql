-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 03, 2019 at 09:20 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `story`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `role` enum('user','admin','','') NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `delete_date` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `role`, `username`, `password`, `name`, `email`, `phone`, `create_date`, `update_date`, `delete_date`, `status`) VALUES
(1, 'admin', 'admin', 'admin', 'Mi Robotic', '', '', '2019-08-02 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'user', 'school', 'school', 'primary school', '', '', '2019-08-02 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, 'user', 'imran', 'imran', '', 'impathan007@gmail.com', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 'user', 'imran', 'imran', 'Imran khan', 'impathan007@gmail.com', '8999315879', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, 'user', 'imran khan', 'ikp', 'imran', 'iampathn@gmail.com', '8999315879', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(6, 'user', 'imran123', 'imran', 'imran', 'imran@gmail.com', 'imran', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(7, 'user', 'imran234', 'ikp', 'imran khan', 'imran@gmail.com', '8999315879', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `robot_id` int(11) NOT NULL,
  `location_1` varchar(50) NOT NULL,
  `location_2` varchar(50) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `go_home` tinyint(1) NOT NULL,
  `action` varchar(50) NOT NULL,
  `lang` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`id`, `owner_id`, `robot_id`, `location_1`, `location_2`, `time_start`, `time_end`, `go_home`, `action`, `lang`, `status`) VALUES
(1, 1, 1, 'Home', 'Bed Room', '11:00:00', '12:00:00', 1, 'sing', 'English', 1);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `language` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `code`) VALUES
(1, 'English', 'en-us'),
(3, 'Chinese', 'zho'),
(4, 'Cantonese', 'yue'),
(5, 'Mandarin', 'cmn'),
(6, 'Minnan', 'nan');

-- --------------------------------------------------------

--
-- Table structure for table `robot`
--

CREATE TABLE `robot` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `sr_no` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `robot`
--

INSERT INTO `robot` (`id`, `owner_id`, `sr_no`, `name`, `created_date`, `delete_date`, `status`) VALUES
(1, 1, 'SRN123', 'snow', '0000-00-00 00:00:00', NULL, 1),
(3, 1, '123', 'snow', '0000-00-00 00:00:00', NULL, 1),
(4, 1, 'asd', 'asd', '0000-00-00 00:00:00', NULL, 1),
(5, 1, 'rr', 'rr', '0000-00-00 00:00:00', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `robot`
--
ALTER TABLE `robot`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `action`
--
ALTER TABLE `action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `robot`
--
ALTER TABLE `robot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
