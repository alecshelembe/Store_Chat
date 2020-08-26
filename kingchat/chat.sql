-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2020 at 07:24 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `client_code` varchar(200) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `store_user` varchar(200) NOT NULL DEFAULT '0',
  `m1` varchar(200) NOT NULL DEFAULT '',
  `m2` varchar(200) NOT NULL DEFAULT '',
  `m3` varchar(200) NOT NULL DEFAULT '',
  `m4` varchar(200) NOT NULL DEFAULT '',
  `m5` varchar(200) NOT NULL DEFAULT '',
  `m6` varchar(200) NOT NULL DEFAULT '',
  `m7` varchar(200) NOT NULL DEFAULT '',
  `m8` varchar(200) NOT NULL DEFAULT '',
  `m9` varchar(200) NOT NULL DEFAULT '',
  `m10` varchar(200) NOT NULL DEFAULT '',
  `m11` varchar(200) NOT NULL DEFAULT '',
  `m12` varchar(200) NOT NULL DEFAULT '',
  `m13` varchar(200) NOT NULL DEFAULT '',
  `m14` varchar(200) NOT NULL DEFAULT '',
  `m15` varchar(200) NOT NULL DEFAULT '',
  `m16` varchar(200) NOT NULL DEFAULT '',
  `m17` varchar(200) NOT NULL DEFAULT '',
  `m18` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sign_in`
--

CREATE TABLE `sign_in` (
  `user` varchar(200) NOT NULL,
  `security_key` varchar(200) NOT NULL,
  `account_state` varchar(200) NOT NULL DEFAULT '1',
  `online` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sign_in`
--

INSERT INTO `sign_in` (`user`, `security_key`, `account_state`, `online`) VALUES
('test', 'test', '1', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`client_code`);

--
-- Indexes for table `sign_in`
--
ALTER TABLE `sign_in`
  ADD PRIMARY KEY (`user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
