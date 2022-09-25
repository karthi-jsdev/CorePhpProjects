-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 30, 2014 at 06:08 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `school_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

CREATE TABLE IF NOT EXISTS `blood_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `busroute`
--

CREATE TABLE IF NOT EXISTS `busroute` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `timings` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `cast`
--

CREATE TABLE IF NOT EXISTS `cast` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `community`
--

CREATE TABLE IF NOT EXISTS `community` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE IF NOT EXISTS `designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary_assignment`
--

CREATE TABLE IF NOT EXISTS `employee_salary_assignment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) NOT NULL,
  `basic_pay` double NOT NULL,
  `da` double NOT NULL,
  `hra` double NOT NULL,
  `cca` double NOT NULL,
  `ma` double NOT NULL,
  `lop` double NOT NULL,
  `datetime` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `approvestatus` bigint(20) NOT NULL,
  `month` bigint(20) NOT NULL,
  `year` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fees_assignment`
--

CREATE TABLE IF NOT EXISTS `fees_assignment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `categoryid` bigint(20) NOT NULL,
  `particularid` bigint(20) NOT NULL,
  `classid` bigint(20) NOT NULL,
  `total` double NOT NULL,
  `mode` tinyint(4) NOT NULL,
  `term` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryid` (`categoryid`),
  KEY `particularid` (`particularid`),
  KEY `classid` (`classid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fees_catagory`
--

CREATE TABLE IF NOT EXISTS `fees_catagory` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `fees_particulars`
--

CREATE TABLE IF NOT EXISTS `fees_particulars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `categoryid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryid` (`categoryid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `miscellaneous`
--

CREATE TABLE IF NOT EXISTS `miscellaneous` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `month`
--

CREATE TABLE IF NOT EXISTS `month` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `nationality`
--

CREATE TABLE IF NOT EXISTS `nationality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `occupation`
--

CREATE TABLE IF NOT EXISTS `occupation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
  `section_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_mode`
--

CREATE TABLE IF NOT EXISTS `payment_mode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE IF NOT EXISTS `qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `relation`
--

CREATE TABLE IF NOT EXISTS `relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `religion`
--

CREATE TABLE IF NOT EXISTS `religion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `salary_assignment`
--

CREATE TABLE IF NOT EXISTS `salary_assignment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) NOT NULL,
  `department_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `basic_pay` double NOT NULL,
  `da` double NOT NULL,
  `hra` double NOT NULL,
  `cca` double NOT NULL,
  `ma` double NOT NULL,
  `lop` double NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  KEY `grade_id` (`grade_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salary_particulars`
--

CREATE TABLE IF NOT EXISTS `salary_particulars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `particular` varchar(25) NOT NULL,
  `isdeduction` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_admission`
--

CREATE TABLE IF NOT EXISTS `staff_admission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `grade_id` bigint(20) NOT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_details`
--

CREATE TABLE IF NOT EXISTS `staff_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `emp_no` varchar(20) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_ids` varchar(100) NOT NULL,
  `is_class_teacher` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_grade`
--

CREATE TABLE IF NOT EXISTS `staff_grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_salary_assignment`
--

CREATE TABLE IF NOT EXISTS `staff_salary_assignment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `basic_pay` double NOT NULL,
  `da` double NOT NULL,
  `hra` double NOT NULL,
  `cca` double NOT NULL,
  `ma` double NOT NULL,
  `lop` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  KEY `grade_id` (`grade_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
  `region_id` int(11) NOT NULL,
  `father_name` varchar(25) NOT NULL,
  `father_occupation_id` int(11) DEFAULT NULL,
  `mother_name` varchar(25) NOT NULL,
  `mother_occupation_id` int(11) DEFAULT NULL,
  `annual_income` double NOT NULL,
  `address` varchar(150) NOT NULL,
  `contact_person` varchar(25) NOT NULL,
  `relation_id` int(11) DEFAULT NULL,
  `contact_no` varchar(10) NOT NULL,
  `email_id` varchar(70) NOT NULL,
  `user_img` blob,
  `prev_school_name` varchar(30) DEFAULT NULL,
  `prev_school_address` varchar(150) DEFAULT NULL,
  `prev_school_medium` varchar(25) DEFAULT NULL,
  `prev_studied_std` varchar(25) DEFAULT NULL,
  `promoted` varchar(25) DEFAULT NULL,
  `busroute_id` bigint(20) DEFAULT NULL,
  `fees_catagoryids` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  KEY `blood_group_id` (`blood_group_id`),
  KEY `nationality_id` (`nationality_id`),
  KEY `cast_id` (`cast_id`),
  KEY `subcast_id` (`subcast_id`),
  KEY `region_id` (`region_id`),
  KEY `father_occupation_id` (`father_occupation_id`),
  KEY `mother_occupation_id` (`mother_occupation_id`),
  KEY `relation_id` (`relation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

CREATE TABLE IF NOT EXISTS `student_fees` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) NOT NULL,
  `terms` varchar(250) NOT NULL,
  `payment_mode` tinyint(4) NOT NULL,
  `payment_done` double NOT NULL,
  `payment_date` datetime NOT NULL,
  `total_amount` double NOT NULL,
  `amount_pending` double NOT NULL,
  `fees_category_id` bigint(20) NOT NULL,
  `discount_id` bigint(20) NOT NULL,
  `fine` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE IF NOT EXISTS `term` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(15) NOT NULL,
  `modules` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

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
