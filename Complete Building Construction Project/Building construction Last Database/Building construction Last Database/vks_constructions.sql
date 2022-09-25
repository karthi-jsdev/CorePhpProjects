-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 30, 2014 at 06:13 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vks_constructions`
--

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

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `vendor_code`, `client_name`, `phone`, `address`, `date_time`) VALUES
(6, '0007', 'M S ABI Showatech LTD', '8987545623', 'DIVISION OF LIGHT ALLOY PRODUCT LTD, PULIVALAM - 631102', '2014-06-23 19:25:26'),
(7, '001', 'test', '080-5555566/081-89963258/', '123 main st', '2014-07-11 11:15:47'),
(6, '0007', 'M S ABI Showatech LTD', '8987545623', 'DIVISION OF LIGHT ALLOY PRODUCT LTD, PULIVALAM - 631102', '2014-06-23 19:25:26'),
(7, '001', 'test', '080-5555566/081-89963258/', '123 main st', '2014-07-11 11:15:47'),
(6, '0007', 'M S ABI Showatech LTD', '8987545623', 'DIVISION OF LIGHT ALLOY PRODUCT LTD, PULIVALAM - 631102', '2014-06-23 19:25:26'),
(7, '001', 'test', '080-5555566/081-89963258/', '123 main st', '2014-07-11 11:15:47'),
(6, '0007', 'M S ABI Showatech LTD', '8987545623', 'DIVISION OF LIGHT ALLOY PRODUCT LTD, PULIVALAM - 631102', '2014-06-23 19:25:26'),
(7, '001', 'test', '080-5555566/081-89963258/', '123 main st', '2014-07-11 11:15:47'),
(6, '0007', 'M S ABI Showatech LTD', '8987545623', 'DIVISION OF LIGHT ALLOY PRODUCT LTD, PULIVALAM - 631102', '2014-06-23 19:25:26'),
(7, '001', 'test', '080-5555566/081-89963258/', '123 main st', '2014-07-11 11:15:47'),
(6, '0007', 'M S ABI Showatech LTD', '8987545623', 'DIVISION OF LIGHT ALLOY PRODUCT LTD, PULIVALAM - 631102', '2014-06-23 19:25:26'),
(7, '001', 'test', '080-5555566/081-89963258/', '123 main st', '2014-07-11 11:15:47'),
(6, '0007', 'M S ABI Showatech LTD', '8987545623', 'DIVISION OF LIGHT ALLOY PRODUCT LTD, PULIVALAM - 631102', '2014-06-23 19:25:26'),
(7, '001', 'test', '080-5555566/081-89963258/', '123 main st', '2014-07-11 11:15:47'),
(6, '0007', 'M S ABI Showatech LTD', '8987545623', 'DIVISION OF LIGHT ALLOY PRODUCT LTD, PULIVALAM - 631102', '2014-06-23 19:25:26'),
(7, '001', 'test', '080-5555566/081-89963258/', '123 main st', '2014-07-11 11:15:47'),
(6, '0007', 'M S ABI Showatech LTD', '8987545623', 'DIVISION OF LIGHT ALLOY PRODUCT LTD, PULIVALAM - 631102', '2014-06-23 19:25:26'),
(7, '001', 'test', '080-5555566/081-89963258/', '123 main st', '2014-07-11 11:15:47'),
(6, '0007', 'M S ABI Showatech LTD', '8987545623', 'DIVISION OF LIGHT ALLOY PRODUCT LTD, PULIVALAM - 631102', '2014-06-23 19:25:26'),
(7, '001', 'test', '080-5555566/081-89963258/', '123 main st', '2014-07-11 11:15:47'),
(6, '0007', 'M S ABI Showatech LTD', '8987545623', 'DIVISION OF LIGHT ALLOY PRODUCT LTD, PULIVALAM - 631102', '2014-06-23 19:25:26'),
(7, '001', 'test', '080-5555566/081-89963258/', '123 main st', '2014-07-11 11:15:47'),
(6, '0007', 'M S ABI Showatech LTD', '8987545623', 'DIVISION OF LIGHT ALLOY PRODUCT LTD, PULIVALAM - 631102', '2014-06-23 19:25:26'),
(7, '001', 'test', '080-5555566/081-89963258/', '123 main st', '2014-07-11 11:15:47'),
(6, '0007', 'M S ABI Showatech LTD', '8987545623', 'DIVISION OF LIGHT ALLOY PRODUCT LTD, PULIVALAM - 631102', '2014-06-23 19:25:26'),
(7, '001', 'test', '080-5555566/081-89963258/', '123 main st', '2014-07-11 11:15:47'),
(6, '0007', 'M S ABI Showatech LTD', '8987545623', 'DIVISION OF LIGHT ALLOY PRODUCT LTD, PULIVALAM - 631102', '2014-06-23 19:25:26'),
(7, '001', 'test', '080-5555566/081-89963258/', '123 main st', '2014-07-11 11:15:47');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `company_information`
--

INSERT INTO `company_information` (`id`, `company_name`, `company_slogan`, `address`, `contact_name`, `designation`, `phone`, `email`, `service_taxno`, `pan_no`, `tin_no`) VALUES
(1, 'ABI SHOWATECH LIMITED', 'A DIVISION OF LIGHT ALLOY', 'PULIVALAM', 'RAM', 'MANAGER', '8987545623', 'ram@lap.com', 'QWE123', 'WER432', '12345'),
(2, 'dsfsf', 'sdgdfgdf', 'sdfsdgfdg', 'sdgfsdg', 'dsdgdfg', '080-6678889/99', 'sdfs@asds.co', '343', 'fdf3', '23354'),
(4, 'ABI SHOWATECH LIMITED', 'A DIVISION OF LIGHT ALLOY', 'PULIVALAM', 'RAM', 'MANAGER', '8987545623', 'ram@lap.com', 'QWE123', 'WER432', '12345'),
(5, 'dsfsf', 'sdgdfgdf', 'sdfsdgfdg', 'sdgfsdg', 'dsdgdfg', '080-6678889/99', 'sdfs@asds.co', '343', 'fdf3', '23354'),
(6, 'ABI SHOWATECH LIMITED', 'A DIVISION OF LIGHT ALLOY', 'PULIVALAM', 'RAM', 'MANAGER', '8987545623', 'ram@lap.com', 'QWE123', 'WER432', '12345'),
(7, 'dsfsf', 'sdgdfgdf', 'sdfsdgfdg', 'sdgfsdg', 'dsdgdfg', '080-6678889/99', 'sdfs@asds.co', '343', 'fdf3', '23354');

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

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`id`, `quotation_no`, `client_id`, `subject`, `quotation_date`) VALUES
(1, '10000002', 1, 'BILL FOR TOILET BUILDING (SURAI PROJECT)', '2014-06-09'),
(2, '10000003', 2, 'New Building', '2014-06-13'),
(3, '10000004', 3, 'Rest Room', '2014-06-14'),
(4, '10000005', 4, 'CONSTRUCTION OF 33KV TRANSFORMER YARD', '2014-06-16'),
(5, '10000006', 4, 'sderyaeryaser', '2014-06-20'),
(6, '10000007', 4, 'testtest', '2014-06-20'),
(7, '10000008', 4, 'sdafasdf', '2014-06-20'),
(8, '10000009', 4, 'awersfdsf', '2014-06-20'),
(9, '10000010', 4, 'aaa', '2014-06-21'),
(10, '10000011', 4, 'New building', '2014-06-21'),
(11, '10000012', 3, 'New building const', '2014-06-21'),
(12, '10000013', 4, 'test', '2014-06-21'),
(13, '10000014', 5, 'Office Construction', '2014-06-21'),
(14, '10000015', 5, 'Office Construction', '2014-06-21'),
(15, '10000016', 5, 'Office Contruction', '2014-06-23'),
(16, '10000017', 5, 'New Office Construction', '2014-06-23'),
(17, '10000018', 5, 'aaa', '2014-06-23'),
(18, '10000019', 6, 'COOLING TANK', '2014-06-23'),
(19, '10000020', 6, 'new', '2014-06-24'),
(20, '10000021', 7, 'fghfhgf', '2014-07-11'),
(21, '10000022', 6, 'testing', '2014-07-11'),
(22, '10000023', 6, 'asdfasdf', '2014-08-06'),
(23, '10000024', 6, 'asdfasdfads', '2014-08-06'),
(24, '10000025', 6, 'xcvsdfgf', '2014-08-06'),
(1, '10000002', 1, 'BILL FOR TOILET BUILDING (SURAI PROJECT)', '2014-06-09'),
(2, '10000003', 2, 'New Building', '2014-06-13'),
(3, '10000004', 3, 'Rest Room', '2014-06-14'),
(4, '10000005', 4, 'CONSTRUCTION OF 33KV TRANSFORMER YARD', '2014-06-16'),
(5, '10000006', 4, 'sderyaeryaser', '2014-06-20'),
(6, '10000007', 4, 'testtest', '2014-06-20'),
(7, '10000008', 4, 'sdafasdf', '2014-06-20'),
(8, '10000009', 4, 'awersfdsf', '2014-06-20'),
(9, '10000010', 4, 'aaa', '2014-06-21'),
(10, '10000011', 4, 'New building', '2014-06-21'),
(11, '10000012', 3, 'New building const', '2014-06-21'),
(12, '10000013', 4, 'test', '2014-06-21'),
(13, '10000014', 5, 'Office Construction', '2014-06-21'),
(14, '10000015', 5, 'Office Construction', '2014-06-21'),
(15, '10000016', 5, 'Office Contruction', '2014-06-23'),
(16, '10000017', 5, 'New Office Construction', '2014-06-23'),
(17, '10000018', 5, 'aaa', '2014-06-23'),
(18, '10000019', 6, 'COOLING TANK', '2014-06-23'),
(19, '10000020', 6, 'new', '2014-06-24'),
(20, '10000021', 7, 'fghfhgf', '2014-07-11'),
(21, '10000022', 6, 'testing', '2014-07-11'),
(22, '10000023', 6, 'asdfasdf', '2014-08-06'),
(23, '10000024', 6, 'asdfasdfads', '2014-08-06'),
(24, '10000025', 6, 'xcvsdfgf', '2014-08-06'),
(1, '10000002', 1, 'BILL FOR TOILET BUILDING (SURAI PROJECT)', '2014-06-09'),
(2, '10000003', 2, 'New Building', '2014-06-13'),
(3, '10000004', 3, 'Rest Room', '2014-06-14'),
(4, '10000005', 4, 'CONSTRUCTION OF 33KV TRANSFORMER YARD', '2014-06-16'),
(5, '10000006', 4, 'sderyaeryaser', '2014-06-20'),
(6, '10000007', 4, 'testtest', '2014-06-20'),
(7, '10000008', 4, 'sdafasdf', '2014-06-20'),
(8, '10000009', 4, 'awersfdsf', '2014-06-20'),
(9, '10000010', 4, 'aaa', '2014-06-21'),
(10, '10000011', 4, 'New building', '2014-06-21'),
(11, '10000012', 3, 'New building const', '2014-06-21'),
(12, '10000013', 4, 'test', '2014-06-21'),
(13, '10000014', 5, 'Office Construction', '2014-06-21'),
(14, '10000015', 5, 'Office Construction', '2014-06-21'),
(15, '10000016', 5, 'Office Contruction', '2014-06-23'),
(16, '10000017', 5, 'New Office Construction', '2014-06-23'),
(17, '10000018', 5, 'aaa', '2014-06-23'),
(18, '10000019', 6, 'COOLING TANK', '2014-06-23'),
(19, '10000020', 6, 'new', '2014-06-24'),
(20, '10000021', 7, 'fghfhgf', '2014-07-11'),
(21, '10000022', 6, 'testing', '2014-07-11'),
(22, '10000023', 6, 'asdfasdf', '2014-08-06'),
(23, '10000024', 6, 'asdfasdfads', '2014-08-06'),
(24, '10000025', 6, 'xcvsdfgf', '2014-08-06');

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

--
-- Dumping data for table `quotation_work`
--

INSERT INTO `quotation_work` (`id`, `quotation_id`, `code`, `description`, `quantity`, `unit_id`, `rate_per_unit`, `amount`) VALUES
(1, 1, '', 'Earth work excavation in all soils except rock upto depth of 1.5m level', 42, 1, 180, 7526.0124),
(2, 1, '', 'PCC 1:4:8 using 40mm aggregate in foundation wall alround', 6, 1, 2400, 13988.88),
(3, 1, '', 'PCC 1:4:8 40mm aggregate in leveling course under floor', 4, 1, 2900, 12645.943),
(4, 1, '', 'RCC 1:1.5:3 concrete using aggregate in foundation base excluding necessary formworks steelreinforce', 7, 1, 5900, 39081.6),
(5, 1, '', 'Do do same as above but in columns infoundation and basement', 1, 1, 5900, 5930.09),
(6, 1, '', 'Do do same as abobe but in plinth beam wall alround', 2, 1, 5900, 13940.12175),
(8, 2, '', 'Earth work excavation', 0, 1, 100, 0),
(9, 3, '', 'EWC', 62500, 1, 1500, 93750000),
(10, 3, '', 'PLINTH BEAM', 0, 2, 5000, 0),
(11, 12, 'EWX', 'Earth Work Excavation', 1250, 1, 10, 12500),
(12, 12, 'test001', 'Work Description', 9150625, 1, 55, 503284375),
(13, 13, 'ewx', 'Earth Work Excavation', 0, 1, 5, 0),
(14, 14, 'ewx', 'Earth Work Excavation', 3125, 1, 50, 156250),
(15, 16, 'ew1', 'Earth work excavation upto 1.5m', 9, 1, 150, 1300.5),
(16, 18, 'ew', 'Earth Work Excavation', 14, 6, 225, 3164.0625),
(17, 18, 'RS', 'Supply and filling sands', 1, 6, 1500, 937.5),
(18, 20, 'hjkhjkh', 'ghjghjg', 610500, 6, 67676, 41316198000),
(19, 21, 'testingwork', 'testingwork', 4500000, 7, 1200, 5400000000),
(20, 23, 'RS', 'Supply and filling sands', 0, 7, 500, 0),
(21, 24, 'RS', 'Supply and filling sands', 6250000, 6, 50, 312500000),
(1, 1, '', 'Earth work excavation in all soils except rock upto depth of 1.5m level', 42, 1, 180, 7526.0124),
(2, 1, '', 'PCC 1:4:8 using 40mm aggregate in foundation wall alround', 6, 1, 2400, 13988.88),
(3, 1, '', 'PCC 1:4:8 40mm aggregate in leveling course under floor', 4, 1, 2900, 12645.943),
(4, 1, '', 'RCC 1:1.5:3 concrete using aggregate in foundation base excluding necessary formworks steelreinforce', 7, 1, 5900, 39081.6),
(5, 1, '', 'Do do same as above but in columns infoundation and basement', 1, 1, 5900, 5930.09),
(6, 1, '', 'Do do same as abobe but in plinth beam wall alround', 2, 1, 5900, 13940.12175),
(8, 2, '', 'Earth work excavation', 0, 1, 100, 0),
(9, 3, '', 'EWC', 62500, 1, 1500, 93750000),
(10, 3, '', 'PLINTH BEAM', 0, 2, 5000, 0),
(11, 12, 'EWX', 'Earth Work Excavation', 1250, 1, 10, 12500),
(12, 12, 'test001', 'Work Description', 9150625, 1, 55, 503284375),
(13, 13, 'ewx', 'Earth Work Excavation', 0, 1, 5, 0),
(14, 14, 'ewx', 'Earth Work Excavation', 3125, 1, 50, 156250),
(15, 16, 'ew1', 'Earth work excavation upto 1.5m', 9, 1, 150, 1300.5),
(16, 18, 'ew', 'Earth Work Excavation', 14, 6, 225, 3164.0625),
(17, 18, 'RS', 'Supply and filling sands', 1, 6, 1500, 937.5),
(18, 20, 'hjkhjkh', 'ghjghjg', 610500, 6, 67676, 41316198000),
(19, 21, 'testingwork', 'testingwork', 4500000, 7, 1200, 5400000000),
(20, 23, 'RS', 'Supply and filling sands', 0, 7, 500, 0),
(21, 24, 'RS', 'Supply and filling sands', 6250000, 6, 50, 312500000),
(1, 1, '', 'Earth work excavation in all soils except rock upto depth of 1.5m level', 42, 1, 180, 7526.0124),
(2, 1, '', 'PCC 1:4:8 using 40mm aggregate in foundation wall alround', 6, 1, 2400, 13988.88),
(3, 1, '', 'PCC 1:4:8 40mm aggregate in leveling course under floor', 4, 1, 2900, 12645.943),
(4, 1, '', 'RCC 1:1.5:3 concrete using aggregate in foundation base excluding necessary formworks steelreinforce', 7, 1, 5900, 39081.6),
(5, 1, '', 'Do do same as above but in columns infoundation and basement', 1, 1, 5900, 5930.09),
(6, 1, '', 'Do do same as abobe but in plinth beam wall alround', 2, 1, 5900, 13940.12175),
(8, 2, '', 'Earth work excavation', 0, 1, 100, 0),
(9, 3, '', 'EWC', 62500, 1, 1500, 93750000),
(10, 3, '', 'PLINTH BEAM', 0, 2, 5000, 0),
(11, 12, 'EWX', 'Earth Work Excavation', 1250, 1, 10, 12500),
(12, 12, 'test001', 'Work Description', 9150625, 1, 55, 503284375),
(13, 13, 'ewx', 'Earth Work Excavation', 0, 1, 5, 0),
(14, 14, 'ewx', 'Earth Work Excavation', 3125, 1, 50, 156250),
(15, 16, 'ew1', 'Earth work excavation upto 1.5m', 9, 1, 150, 1300.5),
(16, 18, 'ew', 'Earth Work Excavation', 14, 6, 225, 3164.0625),
(17, 18, 'RS', 'Supply and filling sands', 1, 6, 1500, 937.5),
(18, 20, 'hjkhjkh', 'ghjghjg', 610500, 6, 67676, 41316198000),
(19, 21, 'testingwork', 'testingwork', 4500000, 7, 1200, 5400000000),
(20, 23, 'RS', 'Supply and filling sands', 0, 7, 500, 0),
(21, 24, 'RS', 'Supply and filling sands', 6250000, 6, 50, 312500000);

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

--
-- Dumping data for table `quotation_work_division`
--

INSERT INTO `quotation_work_division` (`id`, `quotation_work_id`, `code`, `subworkname`, `quantity`, `length`, `breath`, `depth`, `area`) VALUES
(1, 1, '', 'RCC Coloumn', 10, '1.50', '1.50', '1.50', '33.75'),
(2, 1, '', 'Plinth beam', 1, '29.21', '0.430', '0.60', '7.53618'),
(3, 1, '', 'steps', 2, '1.50', '0.70', '0.250', '0.525'),
(4, 2, '', 'foundation', 10, '1.50', '1.50', '0.100', '2.25'),
(5, 2, '', 'wall alround', 1, '29.21', '0.43', '0.100', '1.25603'),
(6, 2, '', 'Toilet internal walls', 1, '9.065', '0.430', '0.100', '0.389795'),
(7, 2, '', 'Toilet internal walls', 7, '1.250', '0.430', '0.430', '1.617875'),
(8, 2, '', 'Steps', 2, '1.50', '0.70', '0.150', '0.315'),
(9, 3, '', 'under floor', 1, '9.605', '4.54', '0.100', '4.36067'),
(10, 4, '', 'Foundation', 10, '1.20', '1.20', '0.230', '3.312'),
(11, 4, '', 'Foundation', 10, '1.20', '1.20', '0.230', '3.312'),
(12, 5, '', 'Foundation', 10, '0.23', '0.23', '1.60', '0.8464'),
(13, 5, '', 'Deduct Plinth', 10, '0.23', '0.23', '0.3', '0.1587'),
(14, 6, '', 'alround', 1, '1.25', '0.23', '0.15', '0.043125'),
(15, 6, '', 'alround', 7, '9.605', '0.23', '0.150', '2.3196075'),
(16, 9, '', 'PCC', 10, '20', '20', '10', '40000'),
(17, 9, '', 'PCC', 5, '15', '15', '10', '11250'),
(18, 9, '', 'PCC', 5, '15', '15', '10', '11250'),
(19, 11, 'pcc1', 'pcc one', 10, '5', '5', '5', '1250'),
(20, 12, 'test001', 'Sub_Work Description', 55, '55', '55', '55', '9150625'),
(21, 14, 'pcc1', 'pcc one', 10, '5', '5', '5', '1250'),
(22, 14, 'pcc2', 'pcc two', 15, '5', '5', '5', '1875'),
(23, 15, 'Pcc1', 'Quarry dust concrete', 3, '1.7', '1.7', '1', '8.67'),
(24, 16, 'Column', 'Sump Column', 5, '2.5', '2.5', '0.45', '14.0625'),
(25, 17, 'Column', 'Sump Column', 2, '2.5', '2.5', '0.05', '0.625'),
(26, 18, 'gfgfghh', 'jhjhhjjj', 555, '10', '11', '10', '610500'),
(27, 19, 'testing subwork', 'testing subwork', 4500, '10', '10', '10', '4500000'),
(28, 21, 'Column', 'Sump Column', 50, '50', '50', '50', '6250000'),
(1, 1, '', 'RCC Coloumn', 10, '1.50', '1.50', '1.50', '33.75'),
(2, 1, '', 'Plinth beam', 1, '29.21', '0.430', '0.60', '7.53618'),
(3, 1, '', 'steps', 2, '1.50', '0.70', '0.250', '0.525'),
(4, 2, '', 'foundation', 10, '1.50', '1.50', '0.100', '2.25'),
(5, 2, '', 'wall alround', 1, '29.21', '0.43', '0.100', '1.25603'),
(6, 2, '', 'Toilet internal walls', 1, '9.065', '0.430', '0.100', '0.389795'),
(7, 2, '', 'Toilet internal walls', 7, '1.250', '0.430', '0.430', '1.617875'),
(8, 2, '', 'Steps', 2, '1.50', '0.70', '0.150', '0.315'),
(9, 3, '', 'under floor', 1, '9.605', '4.54', '0.100', '4.36067'),
(10, 4, '', 'Foundation', 10, '1.20', '1.20', '0.230', '3.312'),
(11, 4, '', 'Foundation', 10, '1.20', '1.20', '0.230', '3.312'),
(12, 5, '', 'Foundation', 10, '0.23', '0.23', '1.60', '0.8464'),
(13, 5, '', 'Deduct Plinth', 10, '0.23', '0.23', '0.3', '0.1587'),
(14, 6, '', 'alround', 1, '1.25', '0.23', '0.15', '0.043125'),
(15, 6, '', 'alround', 7, '9.605', '0.23', '0.150', '2.3196075'),
(16, 9, '', 'PCC', 10, '20', '20', '10', '40000'),
(17, 9, '', 'PCC', 5, '15', '15', '10', '11250'),
(18, 9, '', 'PCC', 5, '15', '15', '10', '11250'),
(19, 11, 'pcc1', 'pcc one', 10, '5', '5', '5', '1250'),
(20, 12, 'test001', 'Sub_Work Description', 55, '55', '55', '55', '9150625'),
(21, 14, 'pcc1', 'pcc one', 10, '5', '5', '5', '1250'),
(22, 14, 'pcc2', 'pcc two', 15, '5', '5', '5', '1875'),
(23, 15, 'Pcc1', 'Quarry dust concrete', 3, '1.7', '1.7', '1', '8.67'),
(24, 16, 'Column', 'Sump Column', 5, '2.5', '2.5', '0.45', '14.0625'),
(25, 17, 'Column', 'Sump Column', 2, '2.5', '2.5', '0.05', '0.625'),
(26, 18, 'gfgfghh', 'jhjhhjjj', 555, '10', '11', '10', '610500'),
(27, 19, 'testing subwork', 'testing subwork', 4500, '10', '10', '10', '4500000'),
(28, 21, 'Column', 'Sump Column', 50, '50', '50', '50', '6250000'),
(1, 1, '', 'RCC Coloumn', 10, '1.50', '1.50', '1.50', '33.75'),
(2, 1, '', 'Plinth beam', 1, '29.21', '0.430', '0.60', '7.53618'),
(3, 1, '', 'steps', 2, '1.50', '0.70', '0.250', '0.525'),
(4, 2, '', 'foundation', 10, '1.50', '1.50', '0.100', '2.25'),
(5, 2, '', 'wall alround', 1, '29.21', '0.43', '0.100', '1.25603'),
(6, 2, '', 'Toilet internal walls', 1, '9.065', '0.430', '0.100', '0.389795'),
(7, 2, '', 'Toilet internal walls', 7, '1.250', '0.430', '0.430', '1.617875'),
(8, 2, '', 'Steps', 2, '1.50', '0.70', '0.150', '0.315'),
(9, 3, '', 'under floor', 1, '9.605', '4.54', '0.100', '4.36067'),
(10, 4, '', 'Foundation', 10, '1.20', '1.20', '0.230', '3.312'),
(11, 4, '', 'Foundation', 10, '1.20', '1.20', '0.230', '3.312'),
(12, 5, '', 'Foundation', 10, '0.23', '0.23', '1.60', '0.8464'),
(13, 5, '', 'Deduct Plinth', 10, '0.23', '0.23', '0.3', '0.1587'),
(14, 6, '', 'alround', 1, '1.25', '0.23', '0.15', '0.043125'),
(15, 6, '', 'alround', 7, '9.605', '0.23', '0.150', '2.3196075'),
(16, 9, '', 'PCC', 10, '20', '20', '10', '40000'),
(17, 9, '', 'PCC', 5, '15', '15', '10', '11250'),
(18, 9, '', 'PCC', 5, '15', '15', '10', '11250'),
(19, 11, 'pcc1', 'pcc one', 10, '5', '5', '5', '1250'),
(20, 12, 'test001', 'Sub_Work Description', 55, '55', '55', '55', '9150625'),
(21, 14, 'pcc1', 'pcc one', 10, '5', '5', '5', '1250'),
(22, 14, 'pcc2', 'pcc two', 15, '5', '5', '5', '1875'),
(23, 15, 'Pcc1', 'Quarry dust concrete', 3, '1.7', '1.7', '1', '8.67'),
(24, 16, 'Column', 'Sump Column', 5, '2.5', '2.5', '0.45', '14.0625'),
(25, 17, 'Column', 'Sump Column', 2, '2.5', '2.5', '0.05', '0.625'),
(26, 18, 'gfgfghh', 'jhjhhjjj', 555, '10', '11', '10', '610500'),
(27, 19, 'testing subwork', 'testing subwork', 4500, '10', '10', '10', '4500000'),
(28, 21, 'Column', 'Sump Column', 50, '50', '50', '50', '6250000');

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
(4, 'Status Updated'),
(1, 'Accept'),
(2, 'Reject'),
(3, 'Pending'),
(4, 'Status Updated'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `status_comments`
--

INSERT INTO `status_comments` (`id`, `quotation_id`, `comments`, `status_id`) VALUES
(1, 14, 'Under Process', 1),
(2, 20, 'ghjghj', 1),
(1, 14, 'Under Process', 1),
(2, 20, 'ghjghj', 1),
(1, 14, 'Under Process', 1),
(2, 20, 'ghjghj', 1);

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

--
-- Dumping data for table `sub_work`
--

INSERT INTO `sub_work` (`id`, `code`, `description`) VALUES
(1, 'Column', 'Sump Column'),
(6, 'Column', 'Sump Column');

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

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `type`, `percent`, `description`) VALUES
(5, 'VAT', 4.5, 'Value Added Tax'),
(6, 'test', 50, 'vghgghjg');

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

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `name`, `value`) VALUES
(6, 'CUM', 10),
(7, 'test', 20);

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

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `phone_number`, `user_name`, `password`, `user_role_id`) VALUES
(1, 'admin', 'admin', '1234567891', 'admin', 'admin', 1),
(2, 'pentamine', 'pentamine', '1234567891', 'pentamine', 'admin', 2),
(3, 'test', 'test', '080-56896325', 'test', 'test', 2);

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
-- Dumping data for table `work`
--

INSERT INTO `work` (`id`, `code`, `description`) VALUES
(7, 'EW', 'Earth Work Excavation'),
(8, 'RS', 'Supply and filling sands');

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
