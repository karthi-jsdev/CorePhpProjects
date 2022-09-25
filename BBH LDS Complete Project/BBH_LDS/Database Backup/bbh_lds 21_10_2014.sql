-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2014 at 07:22 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bbh_lds`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `groupid`, `name`) VALUES
(1, 1, 'General Medicine'),
(2, 1, 'General Surgery'),
(3, 1, 'OBG'),
(4, 1, 'ORTHOPEDICS'),
(5, 1, 'ANAESTHESIA'),
(6, 1, 'EMERGENCY MEDICINE'),
(7, 1, 'Dental'),
(8, 1, 'Ophthal'),
(9, 1, 'Paediatrics');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE IF NOT EXISTS `designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `name`) VALUES
(1, 'DNB TRAINEE'),
(2, 'Consultant'),
(3, 'Registrar');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`) VALUES
(1, 'Consultant'),
(2, 'Registrar'),
(3, 'DNB Residents'),
(4, 'Intern'),
(5, 'JMOs');

-- --------------------------------------------------------

--
-- Table structure for table `leave`
--

CREATE TABLE IF NOT EXISTS `leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `comments` text NOT NULL,
  `half` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE IF NOT EXISTS `qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `qualification`
--

INSERT INTO `qualification` (`id`, `name`) VALUES
(1, 'PHD'),
(2, 'Mphil'),
(3, 'MBBS'),
(4, 'DNB'),
(5, 'Fellowship'),
(6, 'MD'),
(7, 'MS'),
(8, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `resource_update`
--

CREATE TABLE IF NOT EXISTS `resource_update` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titleid` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `groupid` int(11) NOT NULL,
  `departmentid` int(11) NOT NULL,
  `designationid` int(11) NOT NULL,
  `qualification` text NOT NULL,
  `specialization` bigint(20) NOT NULL,
  `status` varchar(25) NOT NULL,
  `days` text,
  `starttime` text,
  `endtime` text,
  `joiningdate` date NOT NULL,
  `leavingdate` varchar(25) NOT NULL,
  `photo` blob NOT NULL,
  `kmc` varchar(50) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `mail1` varchar(50) NOT NULL,
  `mail2` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `reason` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`,`departmentid`,`designationid`),
  KEY `departmentid` (`departmentid`),
  KEY `designationid` (`designationid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `resource_update`
--

INSERT INTO `resource_update` (`id`, `titleid`, `name`, `groupid`, `departmentid`, `designationid`, `qualification`, `specialization`, `status`, `days`, `starttime`, `endtime`, `joiningdate`, `leavingdate`, `photo`, `kmc`, `mobile`, `mail1`, `mail2`, `dob`, `sex`, `reason`) VALUES
(1, 1, 'TEST', 1, 5, 2, 'MBBS', 1, 'Fulltime', '', ',,,,,,,', ',,,,,,,', '2014-10-21', '', '', '12345678941', 9965948423, 'adf@gmail.com', 'adf@gmail.com', '2014-10-21', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE IF NOT EXISTS `specialization` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`id`, `name`) VALUES
(1, 'Child Specialist');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE IF NOT EXISTS `title` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`id`, `name`) VALUES
(1, 'Dr'),
(2, 'Prof');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `phonenumber` bigint(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `userroleid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userroleid` (`userroleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `phonenumber`, `username`, `password`, `userroleid`) VALUES
(1, 'pentamine', 'pentamine', 1234567891, 'pentamine', '0101@pentamine', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE IF NOT EXISTS `userrole` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `userrole`
--

INSERT INTO `userrole` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Supervisor'),
(3, 'Technician'),
(4, 'User'),
(5, 'Super Admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`groupid`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `resource_update`
--
ALTER TABLE `resource_update`
  ADD CONSTRAINT `resource_update_ibfk_3` FOREIGN KEY (`designationid`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `resource_update_ibfk_1` FOREIGN KEY (`groupid`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `resource_update_ibfk_2` FOREIGN KEY (`departmentid`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`userroleid`) REFERENCES `userrole` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
