-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 30, 2014 at 05:24 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bbh_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE IF NOT EXISTS `assets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `divisionid` bigint(20) NOT NULL,
  `departmentid` bigint(20) NOT NULL,
  `locationid` bigint(20) DEFAULT NULL,
  `itemid` bigint(20) NOT NULL,
  `itemname` varchar(20) NOT NULL,
  `itemdescription` varchar(20) NOT NULL,
  `connectiontype` int(11) NOT NULL,
  `purchasedat` date NOT NULL,
  `warrantydate` date NOT NULL,
  `amcperiod` varchar(20) NOT NULL,
  `condemned` tinyint(1) NOT NULL,
  `standby` tinyint(4) NOT NULL,
  `softwareids` varchar(250) NOT NULL,
  `ipaddress` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `divisionid` (`divisionid`),
  KEY `departmentid` (`departmentid`),
  KEY `locationid` (`locationid`),
  KEY `systemid` (`itemid`),
  KEY `softwareids` (`softwareids`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=967 ;

-- --------------------------------------------------------

--
-- Table structure for table `assetstatus`
--

CREATE TABLE IF NOT EXISTS `assetstatus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `assetid` bigint(20) NOT NULL,
  `assetdescription` varchar(300) NOT NULL,
  `statusid` bigint(20) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assetid` (`assetid`),
  KEY `statusid` (`statusid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `assets_inventory`
--

CREATE TABLE IF NOT EXISTS `assets_inventory` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `make_id` bigint(20) NOT NULL,
  `model_id` bigint(20) NOT NULL,
  `equipment_idname` bigint(20) NOT NULL,
  `serialnumber` varchar(50) NOT NULL,
  `equipmentid` varchar(50) NOT NULL,
  `installdate` date NOT NULL,
  `warrantyperiod` date NOT NULL,
  `warranty_comments` varchar(70) NOT NULL,
  `unitcost` double NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `acceptdate` date NOT NULL,
  `equipmentsupplier` varchar(50) NOT NULL,
  `contactpersonno` bigint(20) NOT NULL,
  `critical_equipment` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `make_id` (`make_id`),
  KEY `model_id` (`model_id`),
  KEY `equipment_idname` (`equipment_idname`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=855 ;

-- --------------------------------------------------------

--
-- Table structure for table `assets_inventory_status`
--

CREATE TABLE IF NOT EXISTS `assets_inventory_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `assetinventory_id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `inspectby` bigint(20) NOT NULL,
  `fault` varchar(70) NOT NULL,
  `costinvolved` double NOT NULL,
  `remark` varchar(100) NOT NULL,
  `complaintid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE IF NOT EXISTS `audit` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `complaintid` bigint(20) NOT NULL,
  `comments` text NOT NULL,
  `statusid` bigint(20) NOT NULL,
  `priorityid` bigint(20) NOT NULL,
  `zoneid` bigint(20) DEFAULT NULL,
  `addedby` bigint(20) NOT NULL,
  `addedat` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `complaintid` (`complaintid`),
  KEY `addedby` (`addedby`),
  KEY `statusid` (`statusid`),
  KEY `priorityid` (`priorityid`),
  KEY `zoneid` (`zoneid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31384 ;

-- --------------------------------------------------------

--
-- Table structure for table `biomedical_equipment`
--

CREATE TABLE IF NOT EXISTS `biomedical_equipment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `make_id` bigint(20) NOT NULL,
  `model_id` bigint(20) NOT NULL,
  `equipment` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=249 ;

-- --------------------------------------------------------

--
-- Table structure for table `biomedical_make`
--

CREATE TABLE IF NOT EXISTS `biomedical_make` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `make` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=221 ;

-- --------------------------------------------------------

--
-- Table structure for table `biomedical_model`
--

CREATE TABLE IF NOT EXISTS `biomedical_model` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `make_id` bigint(20) NOT NULL,
  `model` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=274 ;

-- --------------------------------------------------------

--
-- Table structure for table `breakdowncategory`
--

CREATE TABLE IF NOT EXISTS `breakdowncategory` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `breakdowncategory` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE IF NOT EXISTS `complaint` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ticketno` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `remarks` text NOT NULL,
  `complainttypeid` int(11) DEFAULT NULL,
  `zoneid` bigint(20) DEFAULT NULL,
  `assignedto` bigint(20) NOT NULL,
  `sourceid` bigint(20) NOT NULL,
  `departmentid` bigint(20) NOT NULL,
  `locationid` bigint(20) DEFAULT NULL,
  `groupid` bigint(20) NOT NULL,
  `subgroupid` bigint(20) DEFAULT NULL,
  `priorityid` bigint(20) NOT NULL,
  `statusid` bigint(20) NOT NULL,
  `holdcategoryid` bigint(20) DEFAULT NULL,
  `itemid` bigint(20) DEFAULT NULL,
  `reasonforhold` text NOT NULL,
  `createdby` bigint(20) NOT NULL,
  `createdat` datetime NOT NULL,
  `updatedby` bigint(20) NOT NULL,
  `updatedat` datetime NOT NULL,
  `filename` text NOT NULL,
  `bio_startdate` datetime DEFAULT NULL,
  `bio_enddate` datetime DEFAULT NULL,
  `bio_remark` varchar(100) DEFAULT NULL,
  `breakdowncategory` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assignedto` (`assignedto`),
  KEY `sourceid` (`sourceid`),
  KEY `priorityid` (`priorityid`),
  KEY `statusid` (`statusid`),
  KEY `updatedby` (`updatedby`),
  KEY `createdby` (`createdby`),
  KEY `zoneid` (`zoneid`),
  KEY `groupid` (`groupid`),
  KEY `complainttypeid` (`complainttypeid`),
  KEY `departmentid` (`departmentid`),
  KEY `subgroupid` (`subgroupid`),
  KEY `holdcategoryid` (`holdcategoryid`),
  KEY `itemid` (`itemid`),
  KEY `locationid` (`locationid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9543 ;

-- --------------------------------------------------------

--
-- Table structure for table `complainttype`
--

CREATE TABLE IF NOT EXISTS `complainttype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `groupid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `divisionid` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `extension` varchar(50) NOT NULL,
  `biomedical_department` tinyint(4) NOT NULL,
  `1` bigint(20) DEFAULT NULL,
  `2` bigint(20) DEFAULT NULL,
  `3` bigint(20) DEFAULT NULL,
  `4` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `divisionid` (`divisionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=135 ;

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE IF NOT EXISTS `division` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `defaultadmin` bigint(20) NOT NULL,
  `admins` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `defaultadmin` (`defaultadmin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `holdcategory`
--

CREATE TABLE IF NOT EXISTS `holdcategory` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `departmentid` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `groupid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `divisionid` (`departmentid`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=367 ;

-- --------------------------------------------------------

--
-- Table structure for table `partdetails`
--

CREATE TABLE IF NOT EXISTS `partdetails` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `complaintid` bigint(20) NOT NULL,
  `partname` varchar(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `procuredfrom` bigint(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `bycash` tinyint(1) NOT NULL,
  `addedby` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `complaintid` (`complaintid`),
  KEY `procuredfrom` (`procuredfrom`),
  KEY `addedby` (`addedby`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4708 ;

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE IF NOT EXISTS `priority` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE IF NOT EXISTS `remarks` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `complaintid` bigint(20) NOT NULL,
  `skill` bigint(20) NOT NULL,
  `standard` bigint(20) NOT NULL,
  `courtesy` bigint(20) NOT NULL,
  `timeliness` bigint(20) NOT NULL,
  `addedby` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `complaintid` (`complaintid`),
  KEY `skill` (`skill`),
  KEY `standard` (`standard`),
  KEY `courtesy` (`courtesy`),
  KEY `timeliness` (`timeliness`),
  KEY `addedby` (`addedby`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3718 ;

-- --------------------------------------------------------

--
-- Table structure for table `remarkstype`
--

CREATE TABLE IF NOT EXISTS `remarkstype` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `softwares`
--

CREATE TABLE IF NOT EXISTS `softwares` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE IF NOT EXISTS `source` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE IF NOT EXISTS `store` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `subgroup`
--

CREATE TABLE IF NOT EXISTS `subgroup` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `groupid` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `users` text NOT NULL,
  `complainttype` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

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
  `departmentid` bigint(20) NOT NULL,
  `groupid` bigint(20) DEFAULT NULL,
  `deptadmin` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userroleid` (`userroleid`),
  KEY `departmentid` (`departmentid`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=417 ;

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE IF NOT EXISTS `userrole` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE IF NOT EXISTS `zone` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `assets_ibfk_6` FOREIGN KEY (`divisionid`) REFERENCES `division` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `assets_ibfk_7` FOREIGN KEY (`departmentid`) REFERENCES `department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `assets_ibfk_8` FOREIGN KEY (`locationid`) REFERENCES `location` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `assets_ibfk_9` FOREIGN KEY (`itemid`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `assetstatus`
--
ALTER TABLE `assetstatus`
  ADD CONSTRAINT `assetstatus_ibfk_3` FOREIGN KEY (`assetid`) REFERENCES `assets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `assetstatus_ibfk_4` FOREIGN KEY (`statusid`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `audit_ibfk_10` FOREIGN KEY (`addedby`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `audit_ibfk_6` FOREIGN KEY (`complaintid`) REFERENCES `complaint` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `audit_ibfk_7` FOREIGN KEY (`statusid`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `audit_ibfk_8` FOREIGN KEY (`priorityid`) REFERENCES `priority` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `audit_ibfk_9` FOREIGN KEY (`zoneid`) REFERENCES `zone` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_ibfk_16` FOREIGN KEY (`zoneid`) REFERENCES `zone` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `complaint_ibfk_17` FOREIGN KEY (`assignedto`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `complaint_ibfk_18` FOREIGN KEY (`sourceid`) REFERENCES `source` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `complaint_ibfk_19` FOREIGN KEY (`departmentid`) REFERENCES `department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `complaint_ibfk_20` FOREIGN KEY (`locationid`) REFERENCES `location` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `complaint_ibfk_21` FOREIGN KEY (`groupid`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `complaint_ibfk_23` FOREIGN KEY (`priorityid`) REFERENCES `priority` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `complaint_ibfk_24` FOREIGN KEY (`statusid`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `complaint_ibfk_25` FOREIGN KEY (`holdcategoryid`) REFERENCES `holdcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `complaint_ibfk_26` FOREIGN KEY (`createdby`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `complaint_ibfk_27` FOREIGN KEY (`updatedby`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `complainttype`
--
ALTER TABLE `complainttype`
  ADD CONSTRAINT `complainttype_ibfk_2` FOREIGN KEY (`groupid`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_2` FOREIGN KEY (`divisionid`) REFERENCES `division` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_2` FOREIGN KEY (`defaultadmin`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_3` FOREIGN KEY (`departmentid`) REFERENCES `department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `location_ibfk_4` FOREIGN KEY (`groupid`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `partdetails`
--
ALTER TABLE `partdetails`
  ADD CONSTRAINT `partdetails_ibfk_4` FOREIGN KEY (`complaintid`) REFERENCES `complaint` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `partdetails_ibfk_5` FOREIGN KEY (`procuredfrom`) REFERENCES `store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `partdetails_ibfk_6` FOREIGN KEY (`addedby`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `remarks`
--
ALTER TABLE `remarks`
  ADD CONSTRAINT `remarks_ibfk_10` FOREIGN KEY (`courtesy`) REFERENCES `remarkstype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `remarks_ibfk_11` FOREIGN KEY (`timeliness`) REFERENCES `remarkstype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `remarks_ibfk_12` FOREIGN KEY (`addedby`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `remarks_ibfk_7` FOREIGN KEY (`complaintid`) REFERENCES `complaint` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `remarks_ibfk_8` FOREIGN KEY (`skill`) REFERENCES `remarkstype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `remarks_ibfk_9` FOREIGN KEY (`standard`) REFERENCES `remarkstype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subgroup`
--
ALTER TABLE `subgroup`
  ADD CONSTRAINT `subgroup_ibfk_2` FOREIGN KEY (`groupid`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`userroleid`) REFERENCES `userrole` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_ibfk_5` FOREIGN KEY (`departmentid`) REFERENCES `department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
