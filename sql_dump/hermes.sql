-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2014 at 04:57 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hermes`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminsettings`
--

CREATE TABLE IF NOT EXISTS `adminsettings` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminsettings`
--

INSERT INTO `adminsettings` (`username`, `password`) VALUES
('admin', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `transitholder`
--

CREATE TABLE IF NOT EXISTS `transitholder` (
  `h_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(10) DEFAULT NULL,
  `b_id` int(10) DEFAULT NULL,
  `waypoint` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`h_id`),
  KEY `transitHolder_fk1` (`s_id`),
  KEY `transitHolder_fk2` (`b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transitholder_timings`
--

CREATE TABLE IF NOT EXISTS `transitholder_timings` (
  `t_id` int(11) NOT NULL,
  `time` time NOT NULL,
  KEY `t_id` (`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transitlocation`
--

CREATE TABLE IF NOT EXISTS `transitlocation` (
  `s_id` int(10) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`s_id`),
  UNIQUE KEY `s_name` (`s_name`),
  KEY `s_name_2` (`s_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `transitlocation`
--

INSERT INTO `transitlocation` (`s_id`, `s_name`) VALUES
(10, 'Alkapuri\r'),
(21, 'Amberpet\r'),
(2, 'Annojiguda\r'),
(6, 'Boduppal\r'),
(5, 'Depot\r'),
(17, 'ECIL\r'),
(1, 'Ghatkesar\r'),
(12, 'Habsiguda\r'),
(22, 'Koti\r'),
(11, 'L.B.Nagar\r'),
(19, 'Lalaguda\r'),
(18, 'Malkajgiri\r'),
(4, 'Medipally\r'),
(24, 'Musheerabad'),
(16, 'Nagaram\r'),
(9, 'Nagole\r'),
(3, 'Narapally\r'),
(20, 'Ramanthapur\r'),
(23, 'RTCXroads\r'),
(14, 'Secunderabad\r'),
(15, 'SNIST\r'),
(13, 'Tarnaka\r'),
(7, 'Uppal\r'),
(8, 'UppalXRoad\r');

-- --------------------------------------------------------

--
-- Table structure for table `transitlocation_neighbors`
--

CREATE TABLE IF NOT EXISTS `transitlocation_neighbors` (
  `s_id` int(10) DEFAULT NULL,
  `n_id` int(10) DEFAULT NULL,
  `n_time` int(11) DEFAULT NULL,
  `n_distance` float(10,2) DEFAULT NULL,
  KEY `transitLocation_neighbors_fk1` (`s_id`),
  KEY `transitLocation_neighbors_fk2` (`n_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transitlocation_neighbors`
--

INSERT INTO `transitlocation_neighbors` (`s_id`, `n_id`, `n_time`, `n_distance`) VALUES
(1, 2, 2, 5.00),
(1, 15, 3, 6.00),
(15, 1, 3, 6.00),
(15, 16, 4, 10.00),
(16, 15, 4, 10.00),
(16, 17, 3, 15.00),
(17, 12, 7, 20.00),
(17, 18, 2, 10.00),
(17, 16, 3, 15.00),
(18, 17, 2, 10.00),
(18, 19, 3, 10.00),
(19, 18, 3, 10.00),
(19, 14, 5, 15.00),
(2, 1, 2, 5.00),
(2, 3, 3, 6.00),
(3, 4, 1, 5.00),
(3, 2, 3, 6.00),
(4, 5, 1, 5.00),
(4, 3, 1, 5.00),
(5, 6, 1, 5.00),
(5, 4, 1, 5.00),
(6, 7, 1, 5.00),
(6, 5, 1, 5.00),
(7, 8, 2, 15.00),
(7, 6, 1, 5.00),
(8, 9, 2, 15.00),
(8, 20, 2, 5.00),
(8, 12, 3, 10.00),
(20, 21, 2, 15.00),
(20, 8, 2, 5.00),
(21, 20, 2, 15.00),
(21, 22, 5, 20.00),
(9, 8, 2, 15.00),
(9, 10, 2, 5.00),
(10, 9, 2, 5.00),
(10, 11, 2, 3.00),
(11, 22, 10, 20.00),
(11, 10, 2, 3.00),
(22, 21, 5, 20.00),
(22, 11, 10, 20.00),
(22, 23, 7, 15.00),
(12, 8, 3, 10.00),
(12, 13, 3, 5.00),
(12, 17, 7, 20.00),
(13, 12, 3, 5.00),
(13, 14, 2, 10.00),
(23, 22, 7, 15.00),
(14, 19, 5, 15.00),
(14, 13, 2, 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `transitlocation_specialnodes`
--

CREATE TABLE IF NOT EXISTS `transitlocation_specialnodes` (
  `s_id` int(10) DEFAULT NULL,
  `ss_id` int(10) DEFAULT NULL,
  KEY `transitLocation_specialnodes_fk1` (`s_id`),
  KEY `transitLocation_specialnodes_fk2` (`ss_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transitlocation_specialnodes`
--

INSERT INTO `transitlocation_specialnodes` (`s_id`, `ss_id`) VALUES
(1, 17),
(8, 11),
(8, 22),
(9, 8),
(10, 8),
(11, 8),
(12, 8),
(12, 14),
(13, 8),
(18, 17),
(19, 17),
(20, 8),
(21, 8),
(22, 11),
(23, 22);

-- --------------------------------------------------------

--
-- Table structure for table `transitprovider`
--

CREATE TABLE IF NOT EXISTS `transitprovider` (
  `b_id` int(10) NOT NULL AUTO_INCREMENT,
  `b_name` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`b_id`),
  UNIQUE KEY `b_name` (`b_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transitprovider_timings`
--

CREATE TABLE IF NOT EXISTS `transitprovider_timings` (
  `b_id` int(10) DEFAULT NULL,
  `startStop` int(11) NOT NULL,
  `endStop` int(11) NOT NULL,
  `startTime` time DEFAULT NULL,
  KEY `transitProvider_timings_fk1` (`b_id`),
  KEY `transitprovider_timings_ibfk_1` (`startStop`),
  KEY `endStop` (`endStop`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transitholder`
--
ALTER TABLE `transitholder`
  ADD CONSTRAINT `transitHolder_fk1` FOREIGN KEY (`s_id`) REFERENCES `transitlocation` (`s_id`),
  ADD CONSTRAINT `transitHolder_fk2` FOREIGN KEY (`b_id`) REFERENCES `transitprovider` (`b_id`);

--
-- Constraints for table `transitholder_timings`
--
ALTER TABLE `transitholder_timings`
  ADD CONSTRAINT `transitholder_timings_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `transitholder` (`h_id`);

--
-- Constraints for table `transitlocation_neighbors`
--
ALTER TABLE `transitlocation_neighbors`
  ADD CONSTRAINT `transitLocation_neighbors_fk1` FOREIGN KEY (`s_id`) REFERENCES `transitlocation` (`s_id`),
  ADD CONSTRAINT `transitLocation_neighbors_fk2` FOREIGN KEY (`n_id`) REFERENCES `transitlocation` (`s_id`);

--
-- Constraints for table `transitlocation_specialnodes`
--
ALTER TABLE `transitlocation_specialnodes`
  ADD CONSTRAINT `transitLocation_specialnodes_fk1` FOREIGN KEY (`s_id`) REFERENCES `transitlocation` (`s_id`),
  ADD CONSTRAINT `transitLocation_specialnodes_fk2` FOREIGN KEY (`ss_id`) REFERENCES `transitlocation` (`s_id`);

--
-- Constraints for table `transitprovider_timings`
--
ALTER TABLE `transitprovider_timings`
  ADD CONSTRAINT `transitProvider_timings_fk1` FOREIGN KEY (`b_id`) REFERENCES `transitprovider` (`b_id`),
  ADD CONSTRAINT `transitprovider_timings_ibfk_1` FOREIGN KEY (`startStop`) REFERENCES `transitlocation` (`s_id`),
  ADD CONSTRAINT `transitprovider_timings_ibfk_2` FOREIGN KEY (`endStop`) REFERENCES `transitlocation` (`s_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
