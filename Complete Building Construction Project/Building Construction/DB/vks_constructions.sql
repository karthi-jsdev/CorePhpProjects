-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2014 at 10:06 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `vendor_code`, `client_name`, `phone`, `address`, `date_time`) VALUES
(1, 'D03225', 'ABI KANDIGAI', '04172-260375', '(A Division of ABI — Showa Tech India Ltd)\r\nPULIVALAM.', '2014-06-09 12:00:50');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company_information`
--

INSERT INTO `company_information` (`id`, `company_name`, `company_slogan`, `address`, `contact_name`, `designation`, `phone`, `email`, `service_taxno`, `pan_no`, `tin_no`) VALUES
(1, 'VKS CONSTRUCTIONS', 'Engineers & Contractors', 'No.145/1,POST Office Street,\r\nSholinghur-631102', 'V.k.Sampath', 'Licenced Building Su', '9900320715', 'karthi.cser@gmail.com', 'BABPS378285D001', 'BABP537828', '53245324542');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`id`, `quotation_no`, `client_id`, `subject`, `quotation_date`) VALUES
(1, '10000002', 1, 'BILL FOR TOILET BUILDING (SURAI PROJECT)', '2014-06-09');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_work`
--

CREATE TABLE IF NOT EXISTS `quotation_work` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `quotation_id` bigint(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `unit_id` bigint(20) NOT NULL,
  `rate_per_unit` bigint(20) NOT NULL,
  `amount` double NOT NULL,
  KEY `id` (`id`),
  KEY `quotation_id` (`quotation_id`),
  KEY `unit_id` (`unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `quotation_work`
--

INSERT INTO `quotation_work` (`id`, `code`, `quotation_id`, `description`, `quantity`, `unit_id`, `rate_per_unit`, `amount`) VALUES
(1, '', 1, 'Earth work excavation in all soils except rock upto depth of 1.5m level', 42, 1, 180, 7526.0124),
(2, '', 1, 'PCC 1:4:8 using 40mm aggregate in foundation wall alround', 6, 1, 2400, 13988.88),
(3, '', 1, 'PCC 1:4:8 40mm aggregate in leveling course under floor', 4, 1, 2900, 12645.943),
(4, '', 1, 'RCC 1:1.5:3 concrete using aggregate in foundation base excluding necessary formworks steelreinforce', 7, 1, 5900, 39081.6),
(5, '', 1, 'Do do same as above but in columns infoundation and basement', 1, 1, 5900, 5930.09),
(6, '', 1, 'Do do same as abobe but in plinth beam wall alround', 2, 1, 5900, 13940.12175);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_work_division`
--

CREATE TABLE IF NOT EXISTS `quotation_work_division` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subcode` varchar(50) NOT NULL,
  `quotation_work_id` bigint(20) NOT NULL,
  `subworkname` varchar(75) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `length` varchar(10) NOT NULL,
  `breath` varchar(10) NOT NULL,
  `depth` varchar(10) NOT NULL,
  `area` varchar(50) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `quotation_work_division`
--

INSERT INTO `quotation_work_division` (`id`, `subcode`, `quotation_work_id`, `subworkname`, `quantity`, `length`, `breath`, `depth`, `area`) VALUES
(1, '', 1, 'RCC Coloumn', 10, '1.50', '1.50', '1.50', '33.75'),
(2, '', 1, 'Plinth beam', 1, '29.21', '0.430', '0.60', '7.53618'),
(3, '', 1, 'steps', 2, '1.50', '0.70', '0.250', '0.525'),
(4, '', 2, 'foundation', 10, '1.50', '1.50', '0.100', '2.25'),
(5, '', 2, 'wall alround', 1, '29.21', '0.43', '0.100', '1.25603'),
(6, '', 2, 'Toilet internal walls', 1, '9.065', '0.430', '0.100', '0.389795'),
(7, '', 2, 'Toilet internal walls', 7, '1.250', '0.430', '0.430', '1.617875'),
(8, '', 2, 'Steps', 2, '1.50', '0.70', '0.150', '0.315'),
(9, '', 3, 'under floor', 1, '9.605', '4.54', '0.100', '4.36067'),
(10, '', 4, 'Foundation', 10, '1.20', '1.20', '0.230', '3.312'),
(11, '', 4, 'Foundation', 10, '1.20', '1.20', '0.230', '3.312'),
(12, '', 5, 'Foundation', 10, '0.23', '0.23', '1.60', '0.8464'),
(13, '', 5, 'Deduct Plinth', 10, '0.23', '0.23', '0.3', '0.1587'),
(14, '', 6, 'alround', 1, '1.25', '0.23', '0.15', '0.043125'),
(15, '', 6, 'alround', 7, '9.605', '0.23', '0.150', '2.3196075');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Accept'),
(2, 'Reject'),
(3, 'Pending'),
(4, 'Status Updated');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `type`, `percent`, `description`) VALUES
(1, 'Service Tax', 12, 'Service Tax'),
(2, 'Cess', 2, 'Cess'),
(3, 'Hec', 1, 'Hec');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE IF NOT EXISTS `unit` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `value` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `name`, `value`) VALUES
(1, 'CUM', 10),
(2, 'EACH', 1),
(3, 'RMT', 500),
(4, 'NO', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `phone_number`, `user_name`, `password`, `user_role_id`) VALUES
(1, 'admin', 'admin', '1234567891', 'admin', 'admin', 1),
(2, 'pentamine', 'pentamine', '1234567891', 'pentamine', 'admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'superadmin');

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
