-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 16, 2014 at 01:53 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `locval`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `building_classes`
--

CREATE TABLE IF NOT EXISTS `building_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `building_class_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `census_block`
--

CREATE TABLE IF NOT EXISTS `census_block` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `census_tract_id` bigint(20) NOT NULL,
  `census_block` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `census_tract_id` (`census_tract_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `census_tract`
--

CREATE TABLE IF NOT EXISTS `census_tract` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `city_id` bigint(20) NOT NULL,
  `census_tract` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=200 ;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `county_id` bigint(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `county_id` (`county_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `county`
--

CREATE TABLE IF NOT EXISTS `county` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `easement`
--

CREATE TABLE IF NOT EXISTS `easement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `easement_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `metro_market`
--

CREATE TABLE IF NOT EXISTS `metro_market` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `county_id` bigint(20) NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `metro_market_name` varchar(30) NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `county_id` (`county_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `metro_market_id` bigint(20) NOT NULL,
  `zipcode_id` bigint(20) NOT NULL,
  `zip4_id` bigint(20) DEFAULT NULL,
  `census_tract_id` bigint(20) DEFAULT NULL,
  `census_block_id` bigint(20) DEFAULT NULL,
  `building_class_id` int(11) DEFAULT NULL,
  `easement_id` int(11) DEFAULT NULL,
  `address` text NOT NULL,
  `residential_units` int(11) NOT NULL,
  `commercial_units` int(11) NOT NULL,
  `land_area` int(11) NOT NULL,
  `building_area` int(11) NOT NULL,
  `year_built` int(11) NOT NULL,
  `sale_price` float NOT NULL,
  `sale_date` datetime NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `metro_market_id` (`metro_market_id`),
  KEY `zipcode_id` (`zipcode_id`),
  KEY `building_class_id` (`building_class_id`),
  KEY `easement_id` (`easement_id`),
  KEY `zip4_id` (`zip4_id`),
  KEY `census_tract_id` (`census_tract_id`),
  KEY `census_block_id` (`census_block_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=401 ;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_code` varchar(2) NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `zip4`
--

CREATE TABLE IF NOT EXISTS `zip4` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `zipcode_id` bigint(20) NOT NULL,
  `zip4` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `zipcode_id` (`zipcode_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23995 ;

-- --------------------------------------------------------

--
-- Table structure for table `zipcode`
--

CREATE TABLE IF NOT EXISTS `zipcode` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `city_id` bigint(20) NOT NULL,
  `zipcode` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23740 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `census_block`
--
ALTER TABLE `census_block`
  ADD CONSTRAINT `census_block_ibfk_1` FOREIGN KEY (`census_tract_id`) REFERENCES `census_tract` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `census_tract`
--
ALTER TABLE `census_tract`
  ADD CONSTRAINT `census_tract_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`county_id`) REFERENCES `county` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `county`
--
ALTER TABLE `county`
  ADD CONSTRAINT `county_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `metro_market`
--
ALTER TABLE `metro_market`
  ADD CONSTRAINT `metro_market_ibfk_1` FOREIGN KEY (`county_id`) REFERENCES `county` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `metro_market_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`metro_market_id`) REFERENCES `metro_market` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`zipcode_id`) REFERENCES `zipcode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`building_class_id`) REFERENCES `building_classes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_ibfk_4` FOREIGN KEY (`easement_id`) REFERENCES `easement` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_ibfk_5` FOREIGN KEY (`census_tract_id`) REFERENCES `census_tract` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_ibfk_6` FOREIGN KEY (`census_block_id`) REFERENCES `census_block` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_ibfk_7` FOREIGN KEY (`zip4_id`) REFERENCES `zip4` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `zip4`
--
ALTER TABLE `zip4`
  ADD CONSTRAINT `zip4_ibfk_1` FOREIGN KEY (`zipcode_id`) REFERENCES `zipcode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zipcode`
--
ALTER TABLE `zipcode`
  ADD CONSTRAINT `zipcode_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
