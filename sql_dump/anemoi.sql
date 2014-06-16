-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2014 at 04:44 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `anemoi`
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
('srikanth', 'illumi016');

-- --------------------------------------------------------

--
-- Table structure for table `transitholder`
--

CREATE TABLE IF NOT EXISTS `transitholder` (
  `s_id` int(10) DEFAULT NULL,
  `b_id` int(10) DEFAULT NULL,
  KEY `transitHolder_fk1` (`s_id`),
  KEY `transitHolder_fk2` (`b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transitlocation`
--

CREATE TABLE IF NOT EXISTS `transitlocation` (
  `s_id` int(10) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`s_id`),
  UNIQUE KEY `s_name` (`s_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transitlocation_neighbors`
--

CREATE TABLE IF NOT EXISTS `transitlocation_neighbors` (
  `s_id` int(10) DEFAULT NULL,
  `n_id` int(10) DEFAULT NULL,
  `n_time` time DEFAULT NULL,
  `n_distance` float(10,2) DEFAULT NULL,
  KEY `transitLocation_neighbors_fk1` (`s_id`),
  KEY `transitLocation_neighbors_fk2` (`n_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `startTime` time DEFAULT NULL,
  KEY `transitProvider_timings_fk1` (`b_id`)
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
  ADD CONSTRAINT `transitProvider_timings_fk1` FOREIGN KEY (`b_id`) REFERENCES `transitprovider` (`b_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
