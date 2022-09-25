-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2014 at 04:45 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fees_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

CREATE TABLE IF NOT EXISTS `blood_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `blood_group`
--

INSERT INTO `blood_group` (`id`, `name`) VALUES
(1, 'O+ve'),
(2, 'O-ve'),
(3, 'AB+ve'),
(4, 'AB-ve'),
(5, 'B+ve'),
(6, 'B-ve');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`) VALUES
(1, 'PreKG'),
(2, 'Prep1'),
(3, 'Prep2'),
(4, '1st'),
(5, '2nd'),
(6, '3rd'),
(7, '4th'),
(8, '5th'),
(9, '6th'),
(10, '7th'),
(11, '8th'),
(12, '9th'),
(13, '10th');

-- --------------------------------------------------------

--
-- Table structure for table `community`
--

CREATE TABLE IF NOT EXISTS `community` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `community`
--

INSERT INTO `community` (`id`, `name`) VALUES
(1, 'OBC'),
(2, 'BC'),
(3, 'SC'),
(4, 'ST');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE IF NOT EXISTS `discount` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `discount` double NOT NULL,
  `mode` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `name`, `discount`, `mode`) VALUES
(1, 'Scholarship', 50, 0),
(2, 'study', 450, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fees_catagory`
--

CREATE TABLE IF NOT EXISTS `fees_catagory` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `fees_catagory`
--

INSERT INTO `fees_catagory` (`id`, `name`) VALUES
(1, 'BusFees'),
(2, 'TutionFees'),
(3, 'SchoolFees'),
(4, 'ExamFees'),
(5, 'ComputerFees');

-- --------------------------------------------------------

--
-- Table structure for table `fees_category_assign`
--

CREATE TABLE IF NOT EXISTS `fees_category_assign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorydes` varchar(50) NOT NULL,
  `feescategoryid` bigint(20) NOT NULL,
  `classids` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `monthids` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `fees_category_assign`
--

INSERT INTO `fees_category_assign` (`id`, `categorydes`, `feescategoryid`, `classids`, `amount`, `monthids`) VALUES
(1, 'Computerfees', 5, '1,2', '500', '1,2,3,4'),
(2, 'Examfees', 4, '1,2,3,4,5,6', '1000', '4,6,8,11'),
(3, 'Schoolfees', 3, '1,2', '2000', '5,7,9'),
(4, 'Tution Fees', 2, '4,5,6', '2000', '3,4,5'),
(5, 'Bus fees', 1, '1,2,3', '3000', '1,3,6,8');

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

CREATE TABLE IF NOT EXISTS `fine` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `days` bigint(20) NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fine`
--

INSERT INTO `fine` (`id`, `name`, `days`, `amount`) VALUES
(1, 'Latepay', 10, 10),
(2, 'after20days', 20, 50);

-- --------------------------------------------------------

--
-- Table structure for table `month`
--

CREATE TABLE IF NOT EXISTS `month` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `month`
--

INSERT INTO `month` (`id`, `name`) VALUES
(1, 'January'),
(2, 'Febrauary'),
(3, 'March'),
(4, 'April'),
(5, 'May'),
(6, 'June'),
(7, 'July'),
(8, 'August'),
(9, 'September'),
(10, 'October'),
(11, 'November'),
(12, 'December');

-- --------------------------------------------------------

--
-- Table structure for table `nationality`
--

CREATE TABLE IF NOT EXISTS `nationality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `nationality`
--

INSERT INTO `nationality` (`id`, `name`) VALUES
(1, 'Indian'),
(2, 'Srilankan'),
(3, 'Pakistani'),
(4, 'Singapore'),
(5, 'Nepal');

-- --------------------------------------------------------

--
-- Table structure for table `payment_log`
--

CREATE TABLE IF NOT EXISTS `payment_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) NOT NULL,
  `feescategory_id` bigint(20) NOT NULL,
  `month_id` bigint(20) NOT NULL,
  `amounttobepaid` double NOT NULL,
  `paidamount` double NOT NULL,
  `datetime` datetime NOT NULL,
  `scholarshipamount` double NOT NULL,
  `fineamount` double NOT NULL,
  `finepaid` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_log2`
--

CREATE TABLE IF NOT EXISTS `payment_log2` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) NOT NULL,
  `fees_catagoryids` varchar(50) NOT NULL,
  `month_ids` varchar(60) NOT NULL,
  `feesmonth_ids` varchar(250) NOT NULL,
  `amountpaidmonth_ids` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `payment_log2`
--

INSERT INTO `payment_log2` (`id`, `student_id`, `fees_catagoryids`, `month_ids`, `feesmonth_ids`, `amountpaidmonth_ids`, `amount`) VALUES
(1, 1, '1,1,2,3', '1,1,2,3', '1$3,1$3,2$3,3$3', '300$1,200$2,300$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,', '300,200,300,,,,,,,,,,');

-- --------------------------------------------------------

--
-- Table structure for table `payment_mode`
--

CREATE TABLE IF NOT EXISTS `payment_mode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payment_mode`
--

INSERT INTO `payment_mode` (`id`, `name`) VALUES
(1, 'Online'),
(2, 'Check');

-- --------------------------------------------------------

--
-- Table structure for table `religion`
--

CREATE TABLE IF NOT EXISTS `religion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `religion`
--

INSERT INTO `religion` (`id`, `name`) VALUES
(1, 'Hindu'),
(2, 'Muslim'),
(3, 'Christian');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `classid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `classid` (`classid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`, `classid`) VALUES
(1, 'A', 1),
(2, 'A', 2),
(3, 'B', 2),
(4, 'A', 3),
(5, 'B', 3),
(6, 'A', 4),
(7, 'B', 4),
(8, 'C', 4),
(9, 'A', 5),
(10, 'B', 5),
(11, 'C', 5),
(12, 'A', 6),
(13, 'B', 6),
(14, 'C', 6),
(15, 'A', 7),
(16, 'B', 7),
(17, 'C', 7),
(18, 'A', 8),
(19, 'B', 8),
(20, 'C', 8),
(21, 'A', 9),
(22, 'B', 9),
(23, 'C', 9),
(24, 'A', 10),
(25, 'B', 10),
(26, 'C', 10),
(27, 'A', 11),
(28, 'B', 11),
(29, 'C', 11),
(30, 'A', 12),
(31, 'B', 12),
(32, 'C', 12),
(33, 'A', 13),
(34, 'B', 13),
(35, 'C', 13);

-- --------------------------------------------------------

--
-- Table structure for table `student_admission`
--

CREATE TABLE IF NOT EXISTS `student_admission` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `admission_no` varchar(25) NOT NULL,
  `admission_date` date NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `dob` date NOT NULL,
  `birth_place` varchar(25) DEFAULT NULL,
  `section_id` int(11) NOT NULL,
  `blood_group_id` int(11) NOT NULL,
  `mother_tongue` varchar(20) DEFAULT NULL,
  `nationality_id` int(11) NOT NULL,
  `cast_id` int(11) DEFAULT NULL,
  `subcast_id` int(11) DEFAULT NULL,
  `religion_id` int(11) NOT NULL,
  `father_name` varchar(25) NOT NULL,
  `father_occupation` varchar(11) DEFAULT NULL,
  `mother_name` varchar(25) NOT NULL,
  `mother_occupation` varchar(11) DEFAULT NULL,
  `annual_income` double NOT NULL,
  `residenceaddress` varchar(150) NOT NULL,
  `officeaddress` varchar(150) NOT NULL,
  `contact_person` varchar(25) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `email_id` varchar(70) NOT NULL,
  `user_img` blob,
  `fees_catagoryids` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  KEY `blood_group_id` (`blood_group_id`),
  KEY `nationality_id` (`nationality_id`),
  KEY `cast_id` (`cast_id`),
  KEY `subcast_id` (`subcast_id`),
  KEY `region_id` (`religion_id`),
  KEY `father_occupation_id` (`father_occupation`),
  KEY `mother_occupation_id` (`mother_occupation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subcast`
--

CREATE TABLE IF NOT EXISTS `subcast` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `castid` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `subcast`
--

INSERT INTO `subcast` (`id`, `name`, `castid`) VALUES
(1, 'Agamudiyar', '2'),
(2, 'Mudaliar', '2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `userrole_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userrole_id` (`userrole_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `firstname`, `lastname`, `phone`, `userrole_id`) VALUES
(1, 'pentamine', '0101@pentamine', 'pentamine', 'pentamine', '1234567891', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(15) NOT NULL,
  `modules` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
