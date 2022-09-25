-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 06, 2014 at 05:03 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vks_constructions`
--
CREATE DATABASE IF NOT EXISTS `vks_constructions` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `vks_constructions`;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendor_code` varchar(15) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `address` varchar(75) NOT NULL,
  `date_time` datetime NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `company_information`
--

CREATE TABLE IF NOT EXISTS `company_information` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(75) NOT NULL,
  `company_slogan` varchar(25) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact_name` varchar(20) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `service_taxno` varchar(25) NOT NULL,
  `pan_no` varchar(15) NOT NULL,
  `tin_no` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE IF NOT EXISTS `quotation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `quotation_no` varchar(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `quotation_date` date NOT NULL,
  KEY `client_id` (`client_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_work`
--

CREATE TABLE IF NOT EXISTS `quotation_work` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `quotation_id` bigint(20) NOT NULL,
  `code` varchar(25) NOT NULL,
  `description` varchar(100) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `unit_id` bigint(20) NOT NULL,
  `rate_per_unit` bigint(20) NOT NULL,
  `amount` double NOT NULL,
  KEY `id` (`id`),
  KEY `quotation_id` (`quotation_id`),
  KEY `unit_id` (`unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_work_division`
--

CREATE TABLE IF NOT EXISTS `quotation_work_division` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `quotation_work_id` bigint(20) NOT NULL,
  `code` varchar(25) NOT NULL,
  `subworkname` varchar(75) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `length` varchar(10) NOT NULL,
  `breath` varchar(10) NOT NULL,
  `depth` varchar(10) NOT NULL,
  `area` varchar(50) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `status_comments`
--

CREATE TABLE IF NOT EXISTS `status_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `quotation_id` bigint(20) NOT NULL,
  `comments` varchar(250) NOT NULL,
  `status_id` bigint(20) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `sub_work`
--

CREATE TABLE IF NOT EXISTS `sub_work` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(25) NOT NULL,
  `description` varchar(750) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE IF NOT EXISTS `tax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `percent` float NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE IF NOT EXISTS `unit` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `value` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone_number` varchar(25) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_role_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_role_id` (`user_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE IF NOT EXISTS `work` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(25) NOT NULL,
  `description` varchar(750) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
