-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2014 at 12:31 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `school_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

CREATE TABLE `blood_group` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `blood_group`
--


-- --------------------------------------------------------

--
-- Table structure for table `cast`
--

CREATE TABLE `cast` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cast`
--


-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `class`
--


-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `department`
--


-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `designation`
--


-- --------------------------------------------------------

--
-- Table structure for table `nationality`
--

CREATE TABLE `nationality` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `nationality`
--


-- --------------------------------------------------------

--
-- Table structure for table `occupation`
--

CREATE TABLE `occupation` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `occupation`
--


-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE `qualification` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `qualification`
--


-- --------------------------------------------------------

--
-- Table structure for table `relation`
--

CREATE TABLE `relation` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `relation`
--


-- --------------------------------------------------------

--
-- Table structure for table `religion`
--

CREATE TABLE `religion` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `religion`
--


-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(25) NOT NULL,
  `classid` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `section`
--


-- --------------------------------------------------------

--
-- Table structure for table `staff_admission`
--

CREATE TABLE `staff_admission` (
  `id` int(11) NOT NULL auto_increment,
  `employee_no` varchar(15) NOT NULL,
  `joined_date` date NOT NULL,
  `name_prefix` varchar(5) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `qualification_id` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `user_img` blob NOT NULL,
  `father_or_husband_name` varchar(25) NOT NULL,
  `mother_or_wife_name` varchar(25) NOT NULL,
  `marital_status` tinyint(4) NOT NULL,
  `blood_group_id` int(11) NOT NULL,
  `nationality_id` int(11) NOT NULL,
  `religion_id` int(11) NOT NULL,
  `community` varchar(200) NOT NULL,
  `last_institutution_worked` varchar(25) NOT NULL,
  `last_institution_address` varchar(200) NOT NULL,
  `major_subjects_taught_id` int(11) NOT NULL,
  `salary` double NOT NULL,
  `total_experience` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `staff_admission`
--


-- --------------------------------------------------------

--
-- Table structure for table `staff_details`
--

CREATE TABLE `staff_details` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(25) NOT NULL,
  `emp_no` varchar(20) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_ids` varchar(100) NOT NULL,
  `is_class_teacher` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `staff_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `student_admission`
--

CREATE TABLE `student_admission` (
  `id` bigint(20) NOT NULL auto_increment,
  `admission_no` varchar(25) NOT NULL,
  `admission_date` date NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `dob` date NOT NULL,
  `birth_place` varchar(25) NOT NULL,
  `section_id` int(11) NOT NULL,
  `blood_group_id` int(11) NOT NULL,
  `mother_tongue` varchar(20) NOT NULL,
  `nationality_id` int(11) NOT NULL,
  `cast_id` int(11) NOT NULL,
  `subcast_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `father_name` varchar(25) NOT NULL,
  `father_occupation_id` int(11) NOT NULL,
  `mother_name` varchar(25) NOT NULL,
  `mother_occupation_id` int(11) NOT NULL,
  `annual_income` double NOT NULL,
  `address` varchar(150) NOT NULL,
  `contact_person` varchar(25) NOT NULL,
  `relation_id` int(11) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `email_id` varchar(70) NOT NULL,
  `user_img` blob NOT NULL,
  `prev_school_name` varchar(30) NOT NULL,
  `prev_school_address` varchar(150) NOT NULL,
  `prev_school_medium` varchar(25) NOT NULL,
  `prev_studied_std` varchar(25) NOT NULL,
  `promoted` varchar(25) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `section_id` (`section_id`),
  KEY `blood_group_id` (`blood_group_id`),
  KEY `nationality_id` (`nationality_id`),
  KEY `cast_id` (`cast_id`),
  KEY `subcast_id` (`subcast_id`),
  KEY `region_id` (`region_id`),
  KEY `father_occupation_id` (`father_occupation_id`),
  KEY `mother_occupation_id` (`mother_occupation_id`),
  KEY `relation_id` (`relation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `student_admission`
--


-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

CREATE TABLE `student_fees` (
  `id` bigint(20) NOT NULL auto_increment,
  `admission_no` varchar(15) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `term` varchar(250) NOT NULL,
  `payment_mode` varchar(25) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_done` double NOT NULL,
  `amount_to_pay` double NOT NULL,
  `amount_pending` double NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `student_fees`
--


-- --------------------------------------------------------

--
-- Table structure for table `subcast`
--

CREATE TABLE `subcast` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(15) NOT NULL,
  `castid` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `subcast`
--


-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(20) NOT NULL auto_increment,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `subject`
--


-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `term`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `userrole_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `userrole_id` (`userrole_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `firstname`, `lastname`, `phone`, `userrole_id`) VALUES
(1, 'pentamine', '0101@pentamine', 'Pentamine', 'Pentamine', '9886910836', 1),
(2, 'admin', 'admin', 'Admin', 'Admin', '7845627277', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL auto_increment,
  `role` varchar(15) NOT NULL,
  `modules` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`, `modules`) VALUES
(1, 'Super Admin', ''),
(2, 'Admin', ''),
(3, 'User', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userrole_id`) REFERENCES `user_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
