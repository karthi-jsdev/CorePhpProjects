-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 19, 2014 at 09:53 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `bbh_maintenance`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `id` bigint(20) NOT NULL auto_increment,
  `complaintid` bigint(20) NOT NULL,
  `comments` text NOT NULL,
  `statusid` bigint(20) NOT NULL,
  `priorityid` bigint(20) NOT NULL,
  `zoneid` bigint(20) default NULL,
  `addedby` bigint(20) NOT NULL,
  `addedat` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `complaintid` (`complaintid`),
  KEY `addedby` (`addedby`),
  KEY `statusid` (`statusid`),
  KEY `priorityid` (`priorityid`),
  KEY `zoneid` (`zoneid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `audit`
--


-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `id` bigint(20) NOT NULL auto_increment,
  `ticketno` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `remarks` text NOT NULL,
  `complainttypeid` int(11) default NULL,
  `zoneid` bigint(20) default NULL,
  `assignedto` bigint(20) NOT NULL,
  `sourceid` bigint(20) NOT NULL,
  `departmentid` bigint(20) NOT NULL,
  `groupid` bigint(20) NOT NULL,
  `subgroupid` bigint(20) default NULL,
  `priorityid` bigint(20) NOT NULL,
  `statusid` bigint(20) NOT NULL,
  `reasonforhold` text NOT NULL,
  `createdby` bigint(20) NOT NULL,
  `createdat` datetime NOT NULL,
  `updatedby` bigint(20) NOT NULL,
  `updatedat` datetime NOT NULL,
  PRIMARY KEY  (`id`),
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
  KEY `subgroupid` (`subgroupid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `complaint`
--


-- --------------------------------------------------------

--
-- Table structure for table `complainttype`
--

CREATE TABLE `complainttype` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(10) NOT NULL,
  `groupid` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `complainttype`
--


-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `defaultadmin` bigint(20) NOT NULL,
  `admins` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `defaultadmin` (`defaultadmin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `group`
--


-- --------------------------------------------------------

--
-- Table structure for table `partdetails`
--

CREATE TABLE `partdetails` (
  `id` bigint(20) NOT NULL auto_increment,
  `complaintid` bigint(20) NOT NULL,
  `partname` varchar(20) NOT NULL,
  `procuredfrom` bigint(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `bycash` tinyint(1) NOT NULL,
  `addedby` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `complaintid` (`complaintid`),
  KEY `procuredfrom` (`procuredfrom`),
  KEY `addedby` (`addedby`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `partdetails`
--


-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE `priority` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`id`, `name`) VALUES
(1, 'ASAP'),
(2, 'High'),
(3, 'Medium'),
(4, 'Low');

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `id` bigint(20) NOT NULL auto_increment,
  `complaintid` bigint(20) NOT NULL,
  `skill` bigint(20) NOT NULL,
  `standard` bigint(20) NOT NULL,
  `courtesy` bigint(20) NOT NULL,
  `timeliness` bigint(20) NOT NULL,
  `addedby` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `complaintid` (`complaintid`),
  KEY `skill` (`skill`),
  KEY `standard` (`standard`),
  KEY `courtesy` (`courtesy`),
  KEY `timeliness` (`timeliness`),
  KEY `addedby` (`addedby`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `remarks`
--


-- --------------------------------------------------------

--
-- Table structure for table `remarkstype`
--

CREATE TABLE `remarkstype` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `remarkstype`
--

INSERT INTO `remarkstype` (`id`, `name`) VALUES
(1, 'Very Good'),
(2, 'Good'),
(3, 'Average'),
(4, 'Low'),
(5, 'Very Low');

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE `source` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`id`, `name`) VALUES
(1, 'Hospital'),
(2, 'Campus-Hosteller'),
(3, 'Campus-Residence'),
(4, 'Nursing School');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Open'),
(2, 'In Progress'),
(3, 'In Process'),
(4, 'On Hold'),
(5, 'Resolved'),
(6, 'Reopen'),
(7, 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `name`) VALUES
(1, 'Maintenance'),
(2, 'Stores');

-- --------------------------------------------------------

--
-- Table structure for table `subgroup`
--

CREATE TABLE `subgroup` (
  `id` bigint(20) NOT NULL auto_increment,
  `groupid` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `users` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `subgroup`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL auto_increment,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `phonenumber` bigint(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `userroleid` bigint(20) NOT NULL,
  `departmentid` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `userroleid` (`userroleid`),
  KEY `departmentid` (`departmentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `phonenumber`, `username`, `password`, `userroleid`, `departmentid`) VALUES
(1, 'Pentamine', 'Admin', 9886910836, 'pentamineadmin', '0101@BBHMAINTENANCE', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE `userrole` (
  `id` bigint(20) NOT NULL auto_increment,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
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

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE `zone` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `zone`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `audit_ibfk_1` FOREIGN KEY (`complaintid`) REFERENCES `complaint` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `audit_ibfk_2` FOREIGN KEY (`addedby`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `audit_ibfk_3` FOREIGN KEY (`statusid`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `audit_ibfk_4` FOREIGN KEY (`priorityid`) REFERENCES `priority` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `audit_ibfk_5` FOREIGN KEY (`zoneid`) REFERENCES `zone` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_ibfk_13` FOREIGN KEY (`subgroupid`) REFERENCES `subgroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_ibfk_10` FOREIGN KEY (`groupid`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_ibfk_11` FOREIGN KEY (`complainttypeid`) REFERENCES `complainttype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_ibfk_12` FOREIGN KEY (`departmentid`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_ibfk_2` FOREIGN KEY (`assignedto`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_ibfk_3` FOREIGN KEY (`sourceid`) REFERENCES `source` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_ibfk_5` FOREIGN KEY (`priorityid`) REFERENCES `priority` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_ibfk_6` FOREIGN KEY (`statusid`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_ibfk_7` FOREIGN KEY (`createdby`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_ibfk_8` FOREIGN KEY (`updatedby`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_ibfk_9` FOREIGN KEY (`zoneid`) REFERENCES `zone` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complainttype`
--
ALTER TABLE `complainttype`
  ADD CONSTRAINT `complainttype_ibfk_1` FOREIGN KEY (`groupid`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`defaultadmin`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `partdetails`
--
ALTER TABLE `partdetails`
  ADD CONSTRAINT `partdetails_ibfk_1` FOREIGN KEY (`complaintid`) REFERENCES `complaint` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partdetails_ibfk_2` FOREIGN KEY (`procuredfrom`) REFERENCES `store` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partdetails_ibfk_3` FOREIGN KEY (`addedby`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `remarks`
--
ALTER TABLE `remarks`
  ADD CONSTRAINT `remarks_ibfk_1` FOREIGN KEY (`complaintid`) REFERENCES `complaint` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `remarks_ibfk_2` FOREIGN KEY (`skill`) REFERENCES `remarkstype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `remarks_ibfk_3` FOREIGN KEY (`standard`) REFERENCES `remarkstype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `remarks_ibfk_4` FOREIGN KEY (`courtesy`) REFERENCES `remarkstype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `remarks_ibfk_5` FOREIGN KEY (`timeliness`) REFERENCES `remarkstype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `remarks_ibfk_6` FOREIGN KEY (`addedby`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subgroup`
--
ALTER TABLE `subgroup`
  ADD CONSTRAINT `subgroup_ibfk_1` FOREIGN KEY (`groupid`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userroleid`) REFERENCES `userrole` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`departmentid`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
