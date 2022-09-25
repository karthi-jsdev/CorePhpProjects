-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 30, 2014 at 05:29 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chiramith_ppc_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactname` varchar(25) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createdate` date NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `totalorderquantity` int(25) NOT NULL,
  `plannedquantity` int(11) NOT NULL,
  `machine_id` int(11) NOT NULL,
  `productionhours` int(11) NOT NULL,
  `settingdays` int(25) NOT NULL,
  `tentative_date` date NOT NULL,
  `tentative_enddate` date NOT NULL,
  `reason` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  KEY `machine_id` (`machine_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=206 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subsection_id` int(11) NOT NULL,
  `location_reference_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  KEY `subsection_id` (`subsection_id`),
  KEY `location_reference_id` (`location_reference_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=238 ;

-- --------------------------------------------------------

--
-- Table structure for table `location_reference`
--

CREATE TABLE IF NOT EXISTS `location_reference` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(10) NOT NULL,
  `subsectionid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subsectionid` (`subsectionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=991 ;

-- --------------------------------------------------------

--
-- Table structure for table `machine`
--

CREATE TABLE IF NOT EXISTS `machine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `machine_number` varchar(10) NOT NULL,
  `machine_type_id` int(11) NOT NULL,
  `machine_make_id` int(11) NOT NULL,
  `machine_specification_id` int(11) NOT NULL,
  `machine_turningtools_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `machine_type_id` (`machine_type_id`),
  KEY `machine_make_id` (`machine_make_id`),
  KEY `machine_specification_id` (`machine_specification_id`),
  KEY `machine_turningtools_id` (`machine_turningtools_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=219 ;

-- --------------------------------------------------------

--
-- Table structure for table `machine_assignment`
--

CREATE TABLE IF NOT EXISTS `machine_assignment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `machine_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `machine_id` (`machine_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=232 ;

-- --------------------------------------------------------

--
-- Table structure for table `machine_daily_status`
--

CREATE TABLE IF NOT EXISTS `machine_daily_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- Table structure for table `machine_make`
--

CREATE TABLE IF NOT EXISTS `machine_make` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `makeid` varchar(15) NOT NULL,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `machine_specification`
--

CREATE TABLE IF NOT EXISTS `machine_specification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `specificationid` varchar(15) NOT NULL,
  `specification` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Table structure for table `machine_turningtools`
--

CREATE TABLE IF NOT EXISTS `machine_turningtools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `turningtool` varchar(10) NOT NULL,
  `turningtool_id` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `machine_type`
--

CREATE TABLE IF NOT EXISTS `machine_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` varchar(15) NOT NULL,
  `type` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drawing_number` varchar(150) NOT NULL,
  `description` varchar(50) NOT NULL,
  `material_type` varchar(20) NOT NULL,
  `material_size` varchar(20) NOT NULL,
  `grade` varchar(20) NOT NULL,
  `numberofpieces` double NOT NULL,
  `outputperhour` int(11) NOT NULL,
  `settingdays` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=139 ;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `subsection`
--

CREATE TABLE IF NOT EXISTS `subsection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `sectionid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sectionid` (`sectionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `userrole_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userrole_id` (`userrole_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `userhistory`
--

CREATE TABLE IF NOT EXISTS `userhistory` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) NOT NULL,
  `logintime` datetime NOT NULL,
  `logouttime` datetime NOT NULL,
  `duration` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=254 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_ibfk_3` FOREIGN KEY (`machine_id`) REFERENCES `machine` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `location_ibfk_2` FOREIGN KEY (`subsection_id`) REFERENCES `subsection` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `location_ibfk_3` FOREIGN KEY (`location_reference_id`) REFERENCES `location_reference` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `location_reference`
--
ALTER TABLE `location_reference`
  ADD CONSTRAINT `location_reference_ibfk_1` FOREIGN KEY (`subsectionid`) REFERENCES `subsection` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `machine`
--
ALTER TABLE `machine`
  ADD CONSTRAINT `machine_ibfk_1` FOREIGN KEY (`machine_type_id`) REFERENCES `machine_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `machine_ibfk_2` FOREIGN KEY (`machine_make_id`) REFERENCES `machine_make` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `machine_ibfk_3` FOREIGN KEY (`machine_specification_id`) REFERENCES `machine_specification` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `machine_ibfk_4` FOREIGN KEY (`machine_turningtools_id`) REFERENCES `machine_turningtools` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `machine_assignment`
--
ALTER TABLE `machine_assignment`
  ADD CONSTRAINT `machine_assignment_ibfk_1` FOREIGN KEY (`machine_id`) REFERENCES `machine` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `machine_assignment_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subsection`
--
ALTER TABLE `subsection`
  ADD CONSTRAINT `subsection_ibfk_1` FOREIGN KEY (`sectionid`) REFERENCES `section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userrole_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
