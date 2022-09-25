-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2014 at 02:32 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `blood_group`
--

INSERT INTO `blood_group` (`id`, `name`) VALUES
(10, 'o+ve');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`) VALUES
(19, '10th');

-- --------------------------------------------------------

--
-- Table structure for table `community`
--

CREATE TABLE IF NOT EXISTS `community` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `community`
--

INSERT INTO `community` (`id`, `name`) VALUES
(8, 'SC'),
(9, 'OBC');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE IF NOT EXISTS `discount` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `discount` double NOT NULL,
  `categoryid` bigint(20) NOT NULL,
  `studentcategoryid` bigint(20) NOT NULL,
  `mode` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `fees_catagory`
--

CREATE TABLE IF NOT EXISTS `fees_catagory` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `nationality`
--

CREATE TABLE IF NOT EXISTS `nationality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `nationality`
--

INSERT INTO `nationality` (`id`, `name`) VALUES
(6, 'Indian'),
(7, 'Srilankan');

-- --------------------------------------------------------

--
-- Table structure for table `payment_mode`
--

CREATE TABLE IF NOT EXISTS `payment_mode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `religion`
--

CREATE TABLE IF NOT EXISTS `religion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `religion`
--

INSERT INTO `religion` (`id`, `name`) VALUES
(6, 'muslim'),
(7, 'Hindu');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`, `classid`) VALUES
(33, 'A', 19);

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
  `payment_type_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  KEY `blood_group_id` (`blood_group_id`),
  KEY `nationality_id` (`nationality_id`),
  KEY `cast_id` (`cast_id`),
  KEY `subcast_id` (`subcast_id`),
  KEY `region_id` (`religion_id`),
  KEY `father_occupation_id` (`father_occupation`),
  KEY `mother_occupation_id` (`mother_occupation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `student_admission`
--

INSERT INTO `student_admission` (`id`, `admission_no`, `admission_date`, `first_name`, `last_name`, `gender`, `dob`, `birth_place`, `section_id`, `blood_group_id`, `mother_tongue`, `nationality_id`, `cast_id`, `subcast_id`, `religion_id`, `father_name`, `father_occupation`, `mother_name`, `mother_occupation`, `annual_income`, `residenceaddress`, `officeaddress`, `contact_person`, `contact_no`, `email_id`, `user_img`, `payment_type_id`) VALUES
(29, '1234', '2014-09-26', 'asdf', 'asdf', 1, '2014-09-26', NULL, 33, 10, 'asdf', 6, 9, 3, 7, 'adf', 'adsf', 'adsf', 'asdf', 2345, '', '', 'adf', '43r543', 'karthi.cser@gmail.com', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subcast`
--

CREATE TABLE IF NOT EXISTS `subcast` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `castid` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `subcast`
--

INSERT INTO `subcast` (`id`, `name`, `castid`) VALUES
(3, 'aaaaa', '9');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(15) NOT NULL,
  `modules` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`, `modules`) VALUES
(9, 'superadmin', ''),
(10, 'admin', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
