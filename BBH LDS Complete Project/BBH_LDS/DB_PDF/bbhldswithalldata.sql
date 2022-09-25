-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2014 at 07:20 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=275 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `groupid`, `name`) VALUES
(1, 1, 'ANAESTHESIA'),
(2, 2, 'ANAESTHESIA'),
(3, 3, 'ANAESTHESIA'),
(4, 4, 'ANAESTHESIA'),
(5, 5, 'ANAESTHESIA'),
(6, 6, 'ANAESTHESIA'),
(7, 7, 'ANAESTHESIA'),
(8, 8, 'ANAESTHESIA'),
(9, 9, 'ANAESTHESIA'),
(10, 10, 'ANAESTHESIA'),
(11, 11, 'ANAESTHESIA'),
(12, 1, 'EMERGENCY'),
(13, 2, 'EMERGENCY'),
(14, 3, 'EMERGENCY'),
(15, 4, 'EMERGENCY'),
(16, 5, 'EMERGENCY'),
(17, 6, 'EMERGENCY'),
(18, 7, 'EMERGENCY'),
(19, 8, 'EMERGENCY'),
(20, 9, 'EMERGENCY'),
(21, 10, 'EMERGENCY'),
(22, 11, 'EMERGENCY'),
(23, 1, 'COMMUNITY'),
(24, 2, 'COMMUNITY'),
(25, 3, 'COMMUNITY'),
(26, 4, 'COMMUNITY'),
(27, 5, 'COMMUNITY'),
(28, 6, 'COMMUNITY'),
(29, 7, 'COMMUNITY'),
(30, 8, 'COMMUNITY'),
(31, 9, 'COMMUNITY'),
(32, 10, 'COMMUNITY'),
(33, 11, 'COMMUNITY'),
(34, 1, 'DENTAL'),
(35, 2, 'DENTAL'),
(36, 3, 'DENTAL'),
(37, 4, 'DENTAL'),
(38, 5, 'DENTAL'),
(39, 6, 'DENTAL'),
(40, 7, 'DENTAL'),
(41, 8, 'DENTAL'),
(42, 9, 'DENTAL'),
(43, 10, 'DENTAL'),
(44, 11, 'DENTAL'),
(45, 1, 'DERMATOLOGY'),
(46, 2, 'DERMATOLOGY'),
(47, 3, 'DERMATOLOGY'),
(48, 4, 'DERMATOLOGY'),
(49, 5, 'DERMATOLOGY'),
(50, 6, 'DERMATOLOGY'),
(51, 7, 'DERMATOLOGY'),
(52, 8, 'DERMATOLOGY'),
(53, 9, 'DERMATOLOGY'),
(54, 10, 'DERMATOLOGY'),
(55, 11, 'DERMATOLOGY'),
(56, 1, 'ENT'),
(57, 2, 'ENT'),
(58, 3, 'ENT'),
(59, 4, 'ENT'),
(60, 5, 'ENT'),
(61, 6, 'ENT'),
(62, 7, 'ENT'),
(63, 8, 'ENT'),
(64, 9, 'ENT'),
(65, 10, 'ENT'),
(66, 11, 'ENT'),
(67, 1, 'PALLATATIVE'),
(68, 2, 'PALLATATIVE'),
(69, 3, 'PALLATATIVE'),
(70, 4, 'PALLATATIVE'),
(71, 5, 'PALLATATIVE'),
(72, 6, 'PALLATATIVE'),
(73, 7, 'PALLATATIVE'),
(74, 8, 'PALLATATIVE'),
(75, 9, 'PALLATATIVE'),
(76, 10, 'PALLATATIVE'),
(77, 11, 'PALLATATIVE'),
(78, 1, 'PATHOLOGY'),
(79, 2, 'PATHOLOGY'),
(80, 3, 'PATHOLOGY'),
(81, 4, 'PATHOLOGY'),
(82, 5, 'PATHOLOGY'),
(83, 6, 'PATHOLOGY'),
(84, 7, 'PATHOLOGY'),
(85, 8, 'PATHOLOGY'),
(86, 9, 'PATHOLOGY'),
(87, 10, 'PATHOLOGY'),
(88, 11, 'PATHOLOGY'),
(89, 1, 'MICROBIOLOGY'),
(90, 2, 'MICROBIOLOGY'),
(91, 3, 'MICROBIOLOGY'),
(92, 4, 'MICROBIOLOGY'),
(93, 5, 'MICROBIOLOGY'),
(94, 6, 'MICROBIOLOGY'),
(95, 7, 'MICROBIOLOGY'),
(96, 8, 'MICROBIOLOGY'),
(97, 9, 'MICROBIOLOGY'),
(98, 10, 'MICROBIOLOGY'),
(99, 11, 'MICROBIOLOGY'),
(100, 1, 'MEDICINE'),
(101, 2, 'MEDICINE'),
(102, 3, 'MEDICINE'),
(103, 4, 'MEDICINE'),
(104, 5, 'MEDICINE'),
(105, 6, 'MEDICINE'),
(106, 7, 'MEDICINE'),
(107, 8, 'MEDICINE'),
(108, 9, 'MEDICINE'),
(109, 10, 'MEDICINE'),
(110, 11, 'MEDICINE'),
(111, 1, 'OBG'),
(112, 2, 'OBG'),
(113, 3, 'OBG'),
(114, 4, 'OBG'),
(115, 5, 'OBG'),
(116, 6, 'OBG'),
(117, 7, 'OBG'),
(118, 8, 'OBG'),
(119, 9, 'OBG'),
(120, 10, 'OBG'),
(121, 11, 'OBG'),
(122, 1, 'RADIO THERAPY'),
(123, 2, 'RADIO THERAPY'),
(124, 3, 'RADIO THERAPY'),
(125, 4, 'RADIO THERAPY'),
(126, 5, 'RADIO THERAPY'),
(127, 6, 'RADIO THERAPY'),
(128, 7, 'RADIO THERAPY'),
(129, 8, 'RADIO THERAPY'),
(130, 9, 'RADIO THERAPY'),
(131, 10, 'RADIO THERAPY'),
(132, 11, 'RADIO THERAPY'),
(133, 1, 'RADIATION ONCOLOGY'),
(134, 2, 'RADIATION ONCOLOGY'),
(135, 3, 'RADIATION ONCOLOGY'),
(136, 4, 'RADIATION ONCOLOGY'),
(137, 5, 'RADIATION ONCOLOGY'),
(138, 6, 'RADIATION ONCOLOGY'),
(139, 7, 'RADIATION ONCOLOGY'),
(140, 8, 'RADIATION ONCOLOGY'),
(141, 9, 'RADIATION ONCOLOGY'),
(142, 10, 'RADIATION ONCOLOGY'),
(143, 11, 'RADIATION ONCOLOGY'),
(144, 1, 'OPHTHAL'),
(145, 2, 'OPHTHAL'),
(146, 3, 'OPHTHAL'),
(147, 4, 'OPHTHAL'),
(148, 5, 'OPHTHAL'),
(149, 6, 'OPHTHAL'),
(150, 7, 'OPHTHAL'),
(151, 8, 'OPHTHAL'),
(152, 9, 'OPHTHAL'),
(153, 10, 'OPHTHAL'),
(154, 11, 'OPHTHAL'),
(155, 1, 'ORTHOPEDICS'),
(156, 2, 'ORTHOPEDICS'),
(157, 3, 'ORTHOPEDICS'),
(158, 4, 'ORTHOPEDICS'),
(159, 5, 'ORTHOPEDICS'),
(160, 6, 'ORTHOPEDICS'),
(161, 7, 'ORTHOPEDICS'),
(162, 8, 'ORTHOPEDICS'),
(163, 9, 'ORTHOPEDICS'),
(164, 10, 'ORTHOPEDICS'),
(165, 11, 'ORTHOPEDICS'),
(166, 1, 'PAEDIATRICS'),
(167, 2, 'PAEDIATRICS'),
(168, 3, 'PAEDIATRICS'),
(169, 4, 'PAEDIATRICS'),
(170, 5, 'PAEDIATRICS'),
(171, 6, 'PAEDIATRICS'),
(172, 7, 'PAEDIATRICS'),
(173, 8, 'PAEDIATRICS'),
(174, 9, 'PAEDIATRICS'),
(175, 10, 'PAEDIATRICS'),
(176, 11, 'PAEDIATRICS'),
(177, 1, 'PSYCHIATRY'),
(178, 2, 'PSYCHIATRY'),
(179, 3, 'PSYCHIATRY'),
(180, 4, 'PSYCHIATRY'),
(181, 5, 'PSYCHIATRY'),
(182, 6, 'PSYCHIATRY'),
(183, 7, 'PSYCHIATRY'),
(184, 8, 'PSYCHIATRY'),
(185, 9, 'PSYCHIATRY'),
(186, 10, 'PSYCHIATRY'),
(187, 11, 'PSYCHIATRY'),
(188, 1, 'RADIOLOGY'),
(189, 2, 'RADIOLOGY'),
(190, 3, 'RADIOLOGY'),
(191, 4, 'RADIOLOGY'),
(192, 5, 'RADIOLOGY'),
(193, 6, 'RADIOLOGY'),
(194, 7, 'RADIOLOGY'),
(195, 8, 'RADIOLOGY'),
(196, 9, 'RADIOLOGY'),
(197, 10, 'RADIOLOGY'),
(198, 11, 'RADIOLOGY'),
(199, 1, 'RMU'),
(200, 2, 'RMU'),
(201, 3, 'RMU'),
(202, 4, 'RMU'),
(203, 5, 'RMU'),
(204, 6, 'RMU'),
(205, 7, 'RMU'),
(206, 8, 'RMU'),
(207, 9, 'RMU'),
(208, 10, 'RMU'),
(209, 11, 'RMU'),
(210, 1, 'SURGERY'),
(211, 2, 'SURGERY'),
(212, 3, 'SURGERY'),
(213, 4, 'SURGERY'),
(214, 5, 'SURGERY'),
(215, 6, 'SURGERY'),
(216, 7, 'SURGERY'),
(217, 8, 'SURGERY'),
(218, 9, 'SURGERY'),
(219, 10, 'SURGERY'),
(220, 11, 'SURGERY'),
(221, 1, 'PLASTIC SURGERY'),
(222, 2, 'PLASTIC SURGERY'),
(223, 3, 'PLASTIC SURGERY'),
(224, 4, 'PLASTIC SURGERY'),
(225, 5, 'PLASTIC SURGERY'),
(226, 6, 'PLASTIC SURGERY'),
(227, 7, 'PLASTIC SURGERY'),
(228, 8, 'PLASTIC SURGERY'),
(229, 9, 'PLASTIC SURGERY'),
(230, 10, 'PLASTIC SURGERY'),
(231, 11, 'PLASTIC SURGERY'),
(232, 1, 'PREVENTIVE & WELLNESS'),
(233, 2, 'PREVENTIVE & WELLNESS'),
(234, 3, 'PREVENTIVE & WELLNESS'),
(235, 4, 'PREVENTIVE & WELLNESS'),
(236, 5, 'PREVENTIVE & WELLNESS'),
(237, 6, 'PREVENTIVE & WELLNESS'),
(238, 7, 'PREVENTIVE & WELLNESS'),
(239, 8, 'PREVENTIVE & WELLNESS'),
(240, 9, 'PREVENTIVE & WELLNESS'),
(241, 10, 'PREVENTIVE & WELLNESS'),
(242, 11, 'PREVENTIVE & WELLNESS'),
(243, 1, 'FAMILY MED'),
(244, 2, 'FAMILY MED'),
(245, 3, 'FAMILY MED'),
(246, 4, 'FAMILY MED'),
(247, 5, 'FAMILY MED'),
(248, 6, 'FAMILY MED'),
(249, 7, 'FAMILY MED'),
(250, 8, 'FAMILY MED'),
(251, 9, 'FAMILY MED'),
(252, 10, 'FAMILY MED'),
(253, 11, 'FAMILY MED'),
(254, 10, 'CARDIOLOGY'),
(255, 10, 'ENDOCRINOLOGY/PHYSICIAN '),
(256, 10, 'GASTROENTEROLOGY'),
(257, 10, 'GYNAE ONCOLOGY'),
(258, 10, 'HAND SURGEON '),
(259, 10, 'MEDICO LEGAL CASES'),
(260, 10, 'NEPHROLOGY'),
(261, 10, 'NEURO SURGERY'),
(262, 10, 'NEUROLOGY'),
(263, 10, 'ORAL & MAXILLOFACIAL SURGERY'),
(264, 10, 'ORTHODONTICS'),
(265, 10, 'PAEDIATRIC CARDIOLOGY'),
(266, 10, 'PAEDIATRIC OPHTHALMOLOGIST'),
(267, 10, 'PAEDIATRIC SURGEON'),
(268, 10, 'PEDIATRIC CARDIOLOGIST'),
(269, 10, 'PEDODONTICS'),
(270, 10, 'PULMONOLGY'),
(271, 10, 'RETINA?SPECIALIST? - Ophthalmology? ?'),
(272, 10, 'RETRO VIRAL CLINIC'),
(273, 10, 'SURGICAL GASTROENTEROLOGY'),
(274, 10, 'VASCULAR  SURGERY');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE IF NOT EXISTS `designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `name`) VALUES
(1, 'CONSULTANT'),
(2, 'REGISTRAR'),
(3, 'SR. MEDICAL OFFICER'),
(4, 'MEDICAL OFFICER'),
(5, 'JMO'),
(6, 'DENTAL OFFICER I'),
(7, 'INTERN'),
(8, 'JR. MEDICAL OFFICER'),
(9, 'Jr. CONSULTANT'),
(10, 'DNB POST MBBS'),
(11, 'DNB RESIDENT');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`) VALUES
(1, 'CONSULTANT'),
(2, 'REGISTRAR'),
(3, 'SR. MEDICAL OFFICER'),
(4, 'MEDICAL OFFICER'),
(5, 'JMO'),
(6, 'INTERN'),
(7, 'Jr. CONSULTANT'),
(8, 'JR. MEDICAL OFFICER'),
(9, 'DNB POST MBBS'),
(10, 'VISITING CONSULTANT'),
(11, 'DNB RESIDENT');

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
  `leavetypeid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `leavetype`
--

CREATE TABLE IF NOT EXISTS `leavetype` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE IF NOT EXISTS `qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `qualification`
--

INSERT INTO `qualification` (`id`, `name`) VALUES
(1, 'M.B.B.S');

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
  `specialization` bigint(20) DEFAULT NULL,
  `status` varchar(25) NOT NULL,
  `days` text,
  `starttime` text,
  `endtime` text,
  `joiningdate` date DEFAULT NULL,
  `leavingdate` varchar(25) DEFAULT NULL,
  `photo` blob NOT NULL,
  `kmc` varchar(50) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `mail1` varchar(50) NOT NULL,
  `mail2` varchar(50) NOT NULL,
  `dob` date DEFAULT NULL,
  `sex` tinyint(4) NOT NULL,
  `reason` varchar(20) NOT NULL,
  `resign` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`,`departmentid`,`designationid`),
  KEY `departmentid` (`departmentid`),
  KEY `designationid` (`designationid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=239 ;

--
-- Dumping data for table `resource_update`
--

INSERT INTO `resource_update` (`id`, `titleid`, `name`, `groupid`, `departmentid`, `designationid`, `qualification`, `specialization`, `status`, `days`, `starttime`, `endtime`, `joiningdate`, `leavingdate`, `photo`, `kmc`, `mobile`, `mail1`, `mail2`, `dob`, `sex`, `reason`, `resign`) VALUES
(1, 1, 'JAYASHREE DHARESHWAR.', 1, 1, 1, '', 0, 'Fulltime', '', '', '', '2007-07-09', '', '', '26913', 9538589274, '', 'jayashree_dhareshwar@yahoo.co.in', '1964-07-13', 0, '', 0),
(2, 1, 'CHAKRAVARTHY JOEL.J.', 1, 1, 1, '', 0, 'Fulltime', '', '', '', '2013-06-06', '', '', '88744', 8105612902, '', 'joelchakravarthy@gmail.com', '1975-10-19', 0, '', 0),
(3, 1, 'PUSHPALATHA  D. S. D', 1, 1, 1, '', 0, 'Fulltime', '', '', '', '2011-06-01', '', '', '92208', 9480332021, '', 'bettari.lingaswamy@ge.com', '1977-05-28', 0, '', 0),
(4, 1, 'PRIYA P. ', 1, 1, 1, '', 0, 'Fulltime', '', '', '', '2012-03-21', '', '', '88749', 9902806990, '', 'drpriyagdoc@gmail.com', '1979-11-22', 0, '', 0),
(5, 1, 'KANNERIL VARGHESE ZACHARIAH ', 1, 1, 1, '', 0, 'Fulltime', '', '', '', '2012-05-11', '', '', '101234', 9972867627, 'anesthesia@bbh.org.in', 'varghesezach@gmail.com', '1965-11-03', 0, '', 0),
(6, 1, 'MITA EUNICE SARKAR ', 1, 1, 1, '', 0, 'Fulltime', '', '', '', '2013-06-20', '', '', '79859', 9663512138, '', 'mitasarkar7@yahoo.com', '1984-10-07', 0, '', 0),
(7, 1, 'REENA.R.KADNI.', 1, 1, 1, '', 0, 'Fulltime', '', '', '', '2014-04-22', '', '', '63835', 8197201890, '', 'docreena1@rediffmail.com', '1978-02-26', 0, '', 0),
(8, 1, 'ROLLY  MALHOTRA. ', 1, 1, 1, '', 0, 'Fulltime', '', '', '', '2013-10-01', '', '', '106003', 9611301206, '', 'rolly.kakkar@gmail.com', NULL, 0, '', 0),
(9, 1, 'DEEPTY PARIHAR (MAJ) ', 1, 12, 1, '', 0, 'Fulltime', '', '', '', '2013-09-18', '', '', '106322', 9845347755, 'emergency@bbh.org.in', 'majdeepty@rediffmail.com', '1972-04-06', 0, '', 0),
(10, 1, 'RAMYA R. ', 2, 13, 2, '', 0, 'Fulltime', '', '', '', '2013-07-05', '', '', '93427', 0, '', 'drramyar3086@gmail.com', '1986-07-30', 0, '', 0),
(11, 1, 'MOHAMMED MASOOD IQBAL ', 3, 14, 3, '', 0, 'Fulltime', '', '', '', '2013-08-02', '', '', '16920', 0, '', 'iqbal_1986@yahoo.com', '1951-04-08', 0, '', 0),
(12, 1, 'ARUNA MAHANTAPPA HALLUR DR.', 4, 15, 4, '', 0, 'Fulltime', '', '', '', '2013-09-16', '', '', '23381', 9481631787, '', 'vgnadgouda@yahoo.co.in', '1983-06-16', 0, '', 0),
(13, 1, 'GIFT  NORMAN ', 1, 23, 1, '', 0, 'Fulltime', '', '', '', '2009-10-01', '', '', '87962', 0, 'normangift@gmail.com', 'normangift@gmail.com', '1955-07-14', 0, '', 0),
(14, 1, 'SRINIVASULU.D.', 1, 23, 1, '', 0, 'Fulltime', '', '', '', '2011-04-01', '', '', '39505', 0, '', 'lukeshobhna@yahoo.co.in', '1969-12-31', 0, '', 0),
(15, 1, 'RANJITA DEV RAVINDRAN ', 5, 27, 5, '', 0, 'Fulltime', '', '', '', '2011-02-25', '', '', '19219', 0, '', 'vijay.ranjita@gmail.com', NULL, 0, '', 0),
(16, 1, 'CAROLIN ELIZABETH GEORGE ', 1, 23, 1, '', 0, 'Fulltime', '', '', '', '2012-08-16', '', '', '102587', 0, '', 'carolinelizabethj@gmail.com', NULL, 0, '', 0),
(17, 1, 'LEEBARK RAJA ', 1, 23, 1, '', 0, 'Fulltime', '', '', '', '2009-04-16', '', '', '89612', 9611770181, '', 'leeberk2005@gmail.com', NULL, 0, '', 0),
(18, 1, 'ROHIT.S. MAMADAPUR ', 1, 23, 1, '', 0, 'Fulltime', '', '', '', '2014-09-10', '', '', '69414', 9742878217, '', 'rohitmamadapur@gmail.com', '1980-02-17', 0, '', 0),
(19, 1, 'PHILCY PHILIP  ', 1, 34, 6, '', 0, 'Fulltime', '', '', '', '2001-08-22', '', '', '7149-A', 0, 'dental@bbh.org.in', 'philcyphilp@gmail.com', '1976-02-27', 0, '', 0),
(20, 1, 'ABEY VERGHESE CHACKO  ', 1, 34, 6, '', 0, 'Fulltime', '', '', '', '2002-04-01', '', '', '8261-A', 0, '', 'abeyvchacko@gmail.com', '1976-12-06', 0, '', 0),
(21, 1, 'BILCY PHILIP ', 1, 34, 6, '', 0, 'Fulltime', '', '', '', '2012-11-06', '', '', '31319-A', 0, '', 'sam4bil@gmail.com', '1976-04-19', 0, '', 0),
(22, 1, 'NAMRATA SAHU ', 6, 39, 7, '', 0, 'Fulltime', '', '', '', '2012-11-26', '', '', '29895-A', 0, '', 'namrita@gmail.com', '1987-09-25', 0, '', 0),
(23, 1, 'SAJEEV R. ', 6, 39, 7, '', 0, 'Fulltime', '', '', '', '2013-07-22', '', '', '31907A', 0, '', '', '1990-05-07', 0, '', 0),
(24, 1, 'BHANUMATHI N. ', 1, 45, 1, '', 0, 'Fulltime', '', '', '', '2013-06-05', '', '', '71133', 0, '', 'bhanuterma@gmail.com', '1981-08-11', 0, '', 0),
(25, 1, 'CAROL Z  MASCARENHAS .', 1, 45, 1, '', 0, 'Fulltime', '', '', '', '2013-09-10', '', '', '51635', 0, 'derm@bbh.org.in', 'carolinefern@yahoo.com', '1975-08-08', 0, '', 0),
(26, 1, 'JYOTHI NIRMALA KUMARI ', 2, 46, 2, '', 0, 'Fulltime', '', '', '', '2013-11-18', '', '', '102571', 8147283231, '', 'jyonirmala@gmail.com', NULL, 0, '', 0),
(27, 1, 'ANITA MARIET THOMAS ', 1, 56, 1, '', 0, 'Fulltime', '', '', '', '1995-01-15', '', '', '33364', 0, '', 'anipious@gmail.com', '1964-02-16', 0, '', 0),
(28, 1, 'BRINDA A POOJARY ', 1, 56, 1, '', 0, 'Fulltime', '', '', '', '2007-08-01', '', '', '33831', 0, '', 'brindapoojari@yahoo.com', '1969-01-16', 0, '', 0),
(29, 1, 'BADARI DATTA.H.C.', 1, 56, 1, '', 0, 'Fulltime', '', '', '', '2009-07-01', '', '', '50193', 0, '', 'badari_datta@yahoo.co.in', '1975-05-21', 0, '', 0),
(30, 1, 'WARWANTKAR UNMESH VYANKTESHRAO ', 1, 56, 1, '', 0, 'Fulltime', '', '', '', '2012-12-19', '', '', '100578', 0, '', 'unmesh284@rediffmail.com', '1984-04-02', 0, '', 0),
(31, 1, 'MANJULA B. V. ', 1, 56, 1, '', 0, 'Fulltime', '', '', '', '2013-04-24', '', '', '59088', 0, '', 'manjula_doc@rediffmail.com', '1978-02-01', 0, '', 0),
(32, 1, 'MOLLURU BHASKAR REDDY. ', 1, 56, 1, '', 0, 'Fulltime', '', '', '', '2013-11-21', '', '', '48443', 9901611145, 'ent@bbh.org.in', 'docmalluru@gmail.com', NULL, 0, '', 0),
(33, 1, 'AMY SIEW AI MEI ', 1, 67, 1, '', 0, 'Fulltime', '', '', '', '2013-04-02', '', '', '44339', 0, '', 'amy_raichur@hotmail.com', '1969-11-07', 0, '', 0),
(34, 1, 'SHINY INFANTA BOSCO J. ', 2, 68, 2, '', 0, 'Fulltime', '', '', '', '2013-09-16', '', '', '89504', 9164002770, '', 'bosco.shiny@gmail.com', '1986-01-02', 0, '', 0),
(35, 1, 'NEENA JOHN JOSEPH  ', 1, 78, 1, '', 0, 'Fulltime', '', '', '', '2004-03-22', '', '', '74924', 0, 'pathology@bbh.org.in', 'neenajohndr2010@gmail.com', '1972-02-08', 0, '', 0),
(36, 1, 'SINDHULINA CHANDRASINGH .', 1, 89, 1, '', 0, 'Fulltime', '', '', '', '2006-08-01', '', '', '72971', 0, 'sindhu@bbh.org.in', 'sindhulina@gmail.com', '1971-11-17', 0, '', 0),
(37, 1, 'SUNI AUGUSTINE ', 1, 78, 1, '', 0, 'Fulltime', '', '', '', '2011-10-01', '', '', '89795', 0, '', 'drsunipraveen@yahoo.co.in', '1979-05-04', 0, '', 0),
(38, 1, 'KETAKI P. MANNUR ', 1, 78, 1, '', 0, 'Fulltime', '', '', '', '2013-07-01', '', '', '74436', 0, '', 'praket22@gmail.com', '1982-06-15', 0, '', 0),
(39, 1, 'NAIR SREEJA BALACHANDRAN.', 1, 89, 1, '', 0, 'Fulltime', '', '', '', '2013-08-20', '', '', '92435', 0, '', 'drsreejanair@gmail.com', '1977-01-21', 0, '', 0),
(40, 1, 'SHIRLEY JAMES ', 1, 100, 1, '', 0, 'Fulltime', '', '', '', '1989-03-15', '', '', '62754', 0, '', 'sjbaptist2002@yahoo.co.in', '1960-05-16', 0, '', 0),
(41, 1, 'JACOB MATHEWS VAHANEYIL  ', 1, 100, 1, '', 0, 'Fulltime', '', '', '', '2002-10-07', '', '', '33921', 0, '', 'drjacobsaro@yahoo.com', '1968-06-10', 0, '', 0),
(42, 1, 'SPURGEON  ', 1, 100, 1, '', 0, 'Fulltime', '', '', '', '2004-06-01', '', '', '96900', 0, '', 'spurgdr@yahoo.co.in', '1974-03-23', 0, '', 0),
(43, 1, 'GIRISH.T.S    ', 1, 100, 1, '', 0, 'Fulltime', '', '', '', '2005-06-08', '', '', '50078', 9845654511, '', 'girisht1@yahoo.co.in', '1973-01-06', 0, '', 0),
(44, 1, 'INDU.K.NAIR.', 1, 100, 1, '', 0, 'Fulltime', '', '', '', '2009-09-01', '', '', '87125', 9449052700, 'medicalhod@bbh.org.in', 'indudeep@yahoo.com', '1969-01-27', 0, '', 0),
(45, 1, 'KINGSLY ROBERT GV', 1, 100, 1, '', 0, 'Fulltime', '', '', '', '2012-04-01', '', '', '97938', 0, 'kingsly@bbh.org.in', 'krgdurai@gmail.com', '1979-05-31', 0, '', 0),
(46, 1, 'INDIRA MENON ', 1, 100, 1, '', 0, 'Fulltime', '', '', '', '2012-07-01', '', '', '100950', 9901744844, '', 'indiramenon@hotmail.co.uk', '1962-01-05', 0, '', 0),
(47, 1, 'PANKAJA RAMESH ', 1, 100, 1, '', 0, 'Fulltime', '', '', '', '2013-05-05', '', '', '46532', 0, '', 'pankajaramesh2002@yahoo.co.in', '1973-02-19', 0, '', 0),
(48, 1, 'REKHA SUBHASH CHANDRA SHENOY.', 8, 107, 8, '', 0, 'Fulltime', '', '', '', '2013-08-02', '', '', '17073', 0, '', 'rekhashenoy_21@rediffmail.com', '1954-02-10', 0, '', 0),
(49, 1, 'JUSTY ANTONY CHIRAMAL ', 1, 100, 1, '', 0, 'Fulltime', '', '', '', '2013-08-01', '', '', '88911', 0, '', 'justyantony@yahoo.com', '1981-09-05', 0, '', 0),
(50, 1, 'DOMINIC GERARD  BENJAMIN', 1, 100, 1, '', 0, 'Fulltime', '', '', '', '2013-09-02', '', '', '38643', 9742651044, '', 'bdom25@yahoo.co.in', '1969-02-25', 0, '', 0),
(51, 1, 'DEEPA DAS . ', 1, 100, 1, '', 0, 'Fulltime', '', '', '', '2013-10-24', '', '', '102808', 8605002063, '', 'deeya1964@yahoo.co.in', NULL, 0, '', 0),
(52, 1, 'MOHANBABU K.N.. ', 4, 103, 4, '', 0, 'Fulltime', '', '', '', '2014-01-03', '', '', '91217', 9986298456, '', 'mohanbabukn@yahoo.com', NULL, 0, '', 0),
(53, 1, 'BLESSON JOHN.', 4, 103, 4, '', 0, 'Fulltime', '', '', '', '2014-07-29', '', '', '', 0, '', '', NULL, 0, '', 0),
(54, 1, 'RINI SURESH BABU. ', 4, 103, 4, '', 0, 'Fulltime', '', '', '', '2014-03-03', '', '', '98547', 9880160641, '', 'rini.babu@gmail.com', '1989-08-31', 0, '', 0),
(55, 1, 'REKHA .C. ', 4, 103, 4, '', 0, 'Fulltime', '', '', '', '2014-03-05', '', '', '99066', 9986298456, '', 'rekhachengalraj@gmail.com', '1989-09-27', 0, '', 0),
(56, 1, 'BHARGAVI .S.J.. ', 7, 106, 9, '', 0, 'Fulltime', '', '', '', '2014-05-01', '', '', '69171', 9035565129, '', 'bhargavidatta@yahoo.co.in', '1980-03-09', 0, '', 0),
(57, 1, 'ANSARI NAHID RANA', 4, 103, 4, '', 0, 'Fulltime', '', '', '', '2014-11-10', '', '', '105955', 7795806505, '', 'nahidzaki@rediffmail.com', '1975-03-03', 0, '', 0),
(58, 1, 'SUNIL CHRISTOPHER.T.', 1, 100, 1, '', 0, 'Fulltime', '', '', '', '2014-09-10', '', '', '60108', 9008001636, '', 'neel0062004@yahoo.co.in', '1977-03-06', 0, '', 0),
(59, 1, 'PADMAJA  P  ', 1, 111, 1, '', 0, 'Fulltime', '', '', '', '2002-03-25', '', '', '38909', 0, '', 'docpadmaja@hotmail.com ', '1963-07-01', 0, '', 0),
(60, 1, 'NALINI ARUN KUMAR.', 1, 111, 1, '', 0, 'Fulltime', '', '', '', '2008-04-01', '', '', '44344', 0, '', 'mcnalini2000@gmail.com', '1972-08-19', 0, '', 0),
(61, 1, 'SATHYAVANI.C.', 1, 111, 1, '', 0, 'Fulltime', '', '', '', '2010-07-01', '', '', '56979', 0, '', 'drsathyac@yahoo.co.in', '1976-09-08', 0, '', 0),
(62, 1, 'RAJNISH SAMAL ', 1, 111, 1, '', 0, 'Fulltime', '', '', '', '2011-04-20', '', '', '89725', 0, '', 'rajnishsamal@yahoo.com', '1972-06-12', 0, '', 0),
(63, 1, 'RAVI N. PATIL ', 9, 119, 10, '', 0, 'Fulltime', '', '', '', '2013-03-01', '', '', '64651', 0, '', 'ravi2varsha@yahoo.co.in', '1978-09-13', 0, '', 0),
(64, 1, 'SUKANYA ', 1, 111, 1, '', 0, 'Fulltime', '', '', '', '2013-07-17', '', '', '22524', 9538167952, 'gynehod@bbh.org.in', 'sukanya_kanchan@yahoo.co.in', '1959-05-20', 0, '', 0),
(65, 1, 'PADMALATHA. V.V. ', 1, 111, 1, '', 0, 'Fulltime', '', '', '', '2013-10-21', '', '', '53725', 9880338616, '', 'padmalathavv@gmail.com', NULL, 0, '', 0),
(66, 1, 'SARAH LALRAMMAWII FANAI', 2, 112, 2, '', 0, 'Fulltime', '', '', '', '2014-02-15', '', '', '106036', 8399063678, '', 'sarah.teri@gmail.com', '1982-05-20', 0, '', 0),
(67, 1, 'SARO JACOB.', 1, 122, 1, '', 0, 'Fulltime', '', '', '', '2008-06-01', '', '', '89587', 0, '', 'drjacobsaro@yahoo.co.in', '1974-01-04', 0, '', 0),
(68, 1, 'BALU GEORGE.', 2, 123, 2, '', 0, 'Fulltime', '', '', '', '2014-11-17', '', '', '81526', 9629044534, '', 'drbalugeorge@yahoo.com', '1983-09-28', 0, '', 0),
(69, 1, 'DIPIKA JAYACHANDER .', 10, 142, 0, '', 0, 'Fulltime', '', '', '', '2014-08-01', '', '', '90561', 7760841894, '', 'dipika87@gmail.com', '1987-06-20', 0, '', 0),
(70, 1, 'PHILIP THOMAS  ', 1, 144, 2, '', 0, 'Fulltime', '', '', '', '2003-07-21', '', '', '41004', 0, 'philip@bbh.org.in', 'drphilipt@yahoo.co.uk', '1971-04-04', 0, '', 0),
(71, 1, 'REENA KUMARI ', 1, 144, 1, '', 0, 'Fulltime', '', '', '', '2006-09-20', '', '', '53582', 0, '', 'dr_rikvsi28@yahoo.com', '1975-12-28', 0, '', 0),
(72, 1, 'JUDE HANS SIMMONS.', 1, 144, 1, '', 0, 'Fulltime', '', '', '', '2010-11-01', '', '', '88728', 0, '', 'judesim@gmail.com', '1975-03-31', 0, '', 0),
(73, 1, 'VISHNUVANDHANA   ', 1, 144, 1, '', 0, 'Fulltime', '', '', '', '2014-09-11', '', '', '53462', 9964369274, '', 'drvishnuvandhana@yahoo.in', '1976-05-02', 0, '', 0),
(74, 1, 'ALEXANDER THOMAS ', 1, 155, 1, '', 0, 'Fulltime', '', '', '', '1994-07-18', '', '', '18836', 0, '', 'alexglory11@gmail.com', '1954-10-25', 0, '', 0),
(75, 1, 'NIRANJAN M. ', 1, 155, 1, '', 0, 'Fulltime', '', '', '', '2004-01-01', '', '', '39278', 0, 'orthohod@bbh.org.in', 'onsnir@yahoo.co.in', '1971-01-28', 0, '', 0),
(76, 1, 'SANTOSH ANGADI HIREMATH ', 1, 155, 1, '', 0, 'Fulltime', '', '', '', '2012-12-03', '', '', '69021', 0, '', 'drsantoshca@hotmail.com', '1980-10-17', 0, '', 0),
(77, 1, 'NAVEEN S. SHETTY. ', 1, 155, 1, '', 0, 'Fulltime', '', '', '', '2014-03-03', '', '', '74553', 9869827680, '', 'adinaveenshetty@gmail.com', '1982-07-07', 0, '', 0),
(78, 1, 'V.R. VASUKI.', 1, 155, 1, '', 0, 'Fulltime', '', '', '', '2014-04-21', '', '', '31796', 9663123634, '', 'orthovasu45@gmail.com', '1968-01-05', 0, '', 0),
(79, 1, 'SHYAMASUNDAR  L.G.', 1, 155, 1, '', 0, 'Fulltime', '', '', '', '2014-05-05', '', '', '62838', 8197202452, '', 'sam_2262@rediffmail.com', '1978-09-13', 0, '', 0),
(80, 1, 'VIJAY.H.D.KAMATH.', 1, 155, 1, '', 0, 'Fulltime', '', '', '', '2014-06-16', '', '', '51377', 7406376767, '', 'dockamath@gmail.com', '1974-06-23', 0, '', 0),
(81, 1, 'MADHUKESH.R.', 2, 156, 1, '', 0, 'Fulltime', '', '', '', '2014-08-18', '', '', '87231', 9902584154, '', 'madhukesh07@gmail.com', '1987-01-17', 0, '', 0),
(82, 1, 'SRINADH POTHARAJU', 2, 156, 1, '', 0, 'Fulltime', '', '', '', '2014-08-21', '', '', '', 9916160925, '', 'psrinadh@gmail.com', '1985-06-22', 0, '', 0),
(83, 1, 'MADHURI .M. ', 1, 166, 2, '', 0, 'Fulltime', '', '', '', '2014-08-10', '', '', '48341', 0, '', 'madhuri.maganthi@gmail.com', '1974-07-08', 0, '', 0),
(84, 1, 'RACHEL RANITHA P. ', 1, 166, 2, '', 0, 'Fulltime', '', '', '', '2012-03-01', '', '', '96901', 0, '', 'drrachelranitha@yahoo.co.in', '1975-09-12', 0, '', 0),
(85, 1, 'SUMAN RATH ', 1, 166, 1, '', 0, 'Fulltime', '', '', '', '2012-10-01', '', '', '97877', 0, 'paediatrichod@bbh.org.in', 'sumanrath@rediffmail.com', '1971-10-11', 0, '', 0),
(86, 1, 'GAYATRI NATRAJ ', 1, 166, 1, '', 0, 'Fulltime', '', '', '', '2013-07-05', '', '', '57809', 0, '', 'docroshni@yahoo.com', '1977-04-13', 0, '', 0),
(87, 1, 'PRIYA SHIVALLI ', 1, 166, 1, '', 0, 'Fulltime', '', '', '', '2013-08-19', '', '', '55864', 9980018376, '', 'priyashivalli@yahoo.co.in', '1976-03-18', 0, '', 0),
(88, 1, 'DIVYA.S', 1, 166, 1, '', 0, 'Fulltime', '', '', '', '2013-05-22', '', '', '', 9901031178, '', 'docdivyask@gmail.com', '1982-04-09', 0, '', 0),
(89, 1, 'LAKSHMI K. S.', 1, 166, 1, '', 0, 'Fulltime', '', '', '', '2013-08-17', '', '', '59107', 0, '', 'drlakshmiks@yahoo.com', '1977-10-22', 0, '', 0),
(90, 1, 'DARILIN DKHAR ', 2, 178, 1, '', 0, 'Fulltime', '', '', '', '2012-06-15', '', '', '102699', 0, 'psychiatry@bbh.org.in', 'darilindkhar@gmail.com', '1977-03-31', 0, '', 0),
(91, 1, 'ASHA THOMAS  ', 1, 188, 1, '', 0, 'Fulltime', '', '', '', '2000-07-12', '', '', '65350', 0, 'ashathomas@bbh.org.in', 'ashathomas@bbh.org.in', '1969-12-15', 0, '', 0),
(92, 1, 'ALFRED INBARAJ ', 1, 188, 2, '', 0, 'Fulltime', '', '', '', '2006-04-07', '', '', '101481', 0, '', 'alfredcmc_bbh@yahoo.co.in', '1981-05-27', 0, '', 0),
(93, 1, 'KORULA GEORGE ', 1, 199, 1, '', 0, 'Fulltime', '', '', '', '2011-08-18', '', '', '14206', 0, '', 'gkorula@gmail.com', '1951-05-19', 0, '', 0),
(94, 1, 'ANNE MARIE KONGARI??', 1, 199, 1, '', 0, 'Fulltime', '', '', '', '2014-06-16', '', '', '54836', 7406476767, '', 'annekamath@gmail.com', '1974-02-21', 0, '', 0),
(95, 1, 'NAVEEN THOMAS ', 1, 210, 1, '', 0, 'Fulltime', '', '', '', '1988-03-01', '', '', '65349', 0, 'naveenthomas@bbh.org.in', 'drnaveenthomas@gmail.com', '1964-10-27', 0, '', 0),
(96, 1, 'SRINIVAS ', 1, 210, 1, '', 0, 'Fulltime', '', '', '', '2005-08-01', '', '', '30012', 9448687175, 'srinivas@bbh.org.in', 'srini_doc@yahoo.com', '1966-10-13', 0, '', 0),
(97, 1, 'ANIL KUMAR N. ', 1, 210, 1, '', 0, 'Fulltime', '', '', '', '2010-02-10', '', '', '36007', 9964235099, 'surgicalhod@bbh.org.in', 'ak_ekbote@yahoo.com ', '1969-06-20', 0, '', 0),
(98, 1, 'VENKATA NARASIMHAN.N.S', 1, 210, 1, '', 0, 'Fulltime', '', '', '', '2011-02-05', '', '', '60577', 0, '', 'docvenkat77@gmail.com', '1977-03-13', 0, '', 0),
(99, 1, 'FREDERICK VIJAYAKUMAR JOB ', 1, 210, 1, '', 0, 'Fulltime', '', '', '', '2012-09-01', '', '', '19642', 9900840004, '', 'frederickjob@hotmail.com', '1952-08-30', 0, '', 0),
(100, 1, 'VISHNUVARDHANA  G.V', 1, 210, 1, '', 0, 'Fulltime', '', '', '', '2013-06-05', '', '', '56885', 9632970600, '', '', '1976-05-20', 0, '', 0),
(101, 1, 'A.L.D.M.K. SARMA', 1, 210, 1, '', 0, 'Fulltime', '', '', '', '2013-09-24', '', '', '', 8095268300, '', 'draldmk@gmail.com', NULL, 0, '', 0),
(102, 1, 'BHARGAV R CHIKKALA', 1, 210, 1, '', 0, 'Fulltime', '', '', '', '2013-09-30', '', '', '', 9966623443, '', 'bhargav.chikkala@gmail.com', NULL, 0, '', 0),
(103, 1, 'BALAJI. ', 1, 210, 1, '', 0, 'Fulltime', '', '', '', '2013-09-26', '', '', '56734', 9448398017, '', 'dr_balajibs@yahoo.co.in', '1976-11-20', 0, '', 0),
(104, 1, 'RAJENDRA GUJJALANAVAR. ', 1, 221, 1, '', 0, 'Fulltime', '', '', '', '2014-01-22', '', '', '64488', 9986447732, '', 'rsgujjalanavar@yahoo.co.in', '1978-07-09', 0, '', 0),
(105, 1, 'GAYATRI BINDU ', 2, 211, 1, '', 0, 'Fulltime', '', '', '', '2013-11-05', '', '', '89690', 9902250986, '', 'rao_bindu@hotmail.com', NULL, 0, '', 0),
(106, 1, 'AMRUTHA . ', 4, 213, 1, '', 0, 'Fulltime', '', '', '', '2014-03-20', '', '', '101757', 8553910037, '', 'ammu.ishu31@gmail.com', '1990-04-24', 0, '', 0),
(107, 1, 'POONAM ARYA.', 1, 210, 2, '', 0, 'Fulltime', '', '', '', '2014-06-16', '', '', '53176', 9886199086, '', 'dr.pa312@gmail.com', '1974-12-03', 0, '', 0),
(108, 1, 'TANVEER HUSAIN USTAD.', 1, 210, 4, '', 0, 'Fulltime', '', '', '', '2014-06-21', '', '', '67748**', 9916334546, '', 'dr.tanveer.ustad@gmail.com', NULL, 0, '', 0),
(109, 1, 'MAHALAKSHMI V. ', 1, 232, 1, '', 0, 'Fulltime', '', '', '', '2013-05-15', '', '', '62282', 0, 'healthplan@bbh.org.in', 'drvmahalakshmi@yahoo.co.in', '1978-06-19', 0, '', 0),
(110, 1, 'LEELA RANI KANDIMALLA ', 11, 11, 1, '', 0, 'Fulltime', '', '', '', '2011-08-12', '', '', '', 0, '', 'lee.kandimalla@gmail.com', '1979-03-04', 0, '', 0),
(111, 1, 'NITIN AGRAWAL ', 11, 11, 1, '', 0, 'Fulltime', '', '', '', '2011-09-09', '', '', '', 0, '', 'drnitinllrmstar@gmail.com', '1979-02-03', 0, '', 0),
(112, 1, 'RAKSHITH PRASAD B. ', 11, 11, 11, '', 0, 'Fulltime', '', '', '', '2012-10-30', '', '', '92353', 0, '', 'rakshithprasad@gmail.com', '1987-08-05', 0, '', 0),
(113, 1, 'SMRITI SINHA ', 11, 11, 11, '', 0, 'Fulltime', '', '', '', '2013-02-20', '', '', '57520', 0, '', 'smritii576@gmail.com', '1982-12-28', 0, '', 0),
(114, 1, 'RAMYA . D.M ', 11, 11, 11, '', 0, 'Fulltime', '', '', '', '2013-10-03', '', '', '88480', 9844685790, '', 'ramyaraju558@gmail.com', NULL, 0, '', 0),
(115, 1, 'KOUSER BI. C ', 11, 11, 11, '', 0, 'Fulltime', '', '', '', '2013-10-17', '', '', '95914', 0, '', 'kouser17@gmail.com', NULL, 0, '', 0),
(116, 1, 'SHARMISHTHA SHUKLA. ', 11, 11, 11, '', 0, 'Fulltime', '', '', '', '2014-08-25', '', '', '85323', 0, '', 'getshamy@gmail.com', '1984-08-01', 0, '', 0),
(117, 1, 'MADDALA  SURYA KUMAR.', 11, 11, 11, '', 0, 'Fulltime', '', '', '', '2014-10-03', '', '', 'APMC/FMR/80341', 7382791784, '', '', NULL, 0, '', 0),
(118, 1, 'YAGNA VEENA ', 11, 66, 11, '', 0, 'Fulltime', '', '', '', '2011-08-16', '', '', '101560', 0, '', 'yveena_omc@yahoo.co.in', '1982-11-07', 0, '', 0),
(119, 1, 'PAWALE PRIYANKA RAMESH ', 11, 66, 11, '', 0, 'Fulltime', '', '', '', '2012-08-11', '', '', '101188', 0, '', 'drpriyanka2711@gmail.com', '1986-11-27', 0, '', 0),
(120, 1, 'AMBIKA ', 11, 66, 11, '', 0, 'Fulltime', '', '', '', '2012-08-17', '', '', '73841', 0, '', '', NULL, 0, '', 0),
(121, 1, 'ARUN A. ', 11, 66, 11, '', 0, 'Fulltime', '', '', '', '2013-09-30', '', '', '83432', 9886790667, '', 'drarunanandan@gmail.com', '1985-02-04', 0, '', 0),
(122, 1, 'CHINTA KAVYA.', 11, 66, 11, '', 0, 'Fulltime', '', '', '', '2013-10-17', '', '', '72473', 9989608634, '', 'kavyachinta05@gmail.com', '1987-11-17', 0, '', 0),
(123, 1, 'SUBIN THOMAS C. ', 11, 66, 11, '', 0, 'Fulltime', '', '', '', '2014-09-02', '', '', '37434', 9008355375, '', 'dr.subinthomasc@gmail.com', '1983-09-01', 0, '', 0),
(124, 1, 'N.KEERTHI REDDY.', 11, 66, 11, '', 0, 'Fulltime', '', '', '', '2014-10-04', '', '', '072866', 9703195675, '', 'keerthireddyn07@gmail.com', '1987-05-07', 0, '', 0),
(125, 1, 'DHANYA RAMADAS ', 11, 253, 11, '', 0, 'Fulltime', '', '', '', '2011-08-20', '', '', '77633', 0, '', 'aanya_rain@yahoo.com', '1983-04-10', 0, '', 0),
(126, 1, 'ANJU VICTOR  ', 11, 253, 11, '', 0, 'Fulltime', '', '', '', '2012-04-11', '', '', '96025', 0, '', 'anjuvictor@gmail.com', '1984-12-26', 0, '', 0),
(127, 1, 'ASHA ELIZABETH MATHEW ', 11, 253, 11, '', 0, 'Fulltime', '', '', '', '2012-04-16', '', '', '96026', 0, '', 'ashamat27@gmail.com', '1983-08-27', 0, '', 0),
(128, 1, 'SHAHEEN CHOWDHURY', 11, 253, 11, '', 0, 'Fulltime', '', '', '', '2012-04-20', '', '', '83748', 0, '', 'shaheenchowdhury@rediffmail.com', '1984-12-30', 0, '', 0),
(129, 1, 'VENKATA RAMANA GURRAM ', 11, 253, 11, '', 0, 'Fulltime', '', '', '', '2012-04-20', '', '', '106410', 0, '', 'ramana323@gmail.com', '1987-07-29', 0, '', 0),
(130, 1, 'PRIYA S. ', 11, 253, 11, '', 0, 'Fulltime', '', '', '', '2013-08-10', '', '', '106357', 9986067421, '', 'special.priya@gmail.com', '1985-05-18', 0, '', 0),
(131, 1, 'ANURUP KUMAR ', 11, 253, 11, '', 0, 'Fulltime', '', '', '', '2013-08-12', '', '', '', 9535783967, '', 'clementina13@gmail.com', '1983-08-13', 0, '', 0),
(132, 1, 'KANNAMPARAMBIL SREEDA ', 11, 253, 11, '', 0, 'Fulltime', '', '', '', '2013-10-17', '', '', 'MCI/11-40204', 9633039845, '', 'sreedak@gmail.com', '1984-12-24', 0, '', 0),
(133, 1, 'SHILPA K ', 11, 253, 11, '', 0, 'Fulltime', '', '', '', '2013-10-17', '', '', '98940', 9986073633, '', 'shilpagowda2009@gmail.com', '1989-11-17', 0, '', 0),
(135, 1, 'SHIJI PADMAN', 11, 253, 11, '', 0, 'Fulltime', '', '', '', '2014-04-05', '', '', '106486', 9742396685, '', 'shiji.acme@gmail.com', '1983-11-09', 0, '', 0),
(136, 1, 'TWINKLE BEHL ', 11, 253, 11, '', 0, 'Fulltime', '', '', '', '2014-05-07', '', '', '95839', 8861711528, '', 'allthatjazznme@gmail.com', '1986-02-24', 0, '', 0),
(137, 1, 'ARNAB SARKAR . ', 11, 253, 11, '', 0, 'Fulltime', '', '', '', '2014-05-07', '', '', 'MCI/12-46857', 9739321812, '', 'neusci4@gmail.com', '1984-01-01', 0, '', 0),
(138, 1, 'RAHUL.G.R.', 11, 253, 11, '', 0, 'Fulltime', '', '', '', '2014-05-10', '', '', '070042', 9741307080, '', 'rampure.rahul@gmail.com', '1985-11-13', 0, '', 0),
(139, 1, 'BADDAM SHEBA CHARLES ', 11, 110, 11, '', 0, 'Fulltime', '', '', '', '2011-10-08', '', '', '', 0, '', 'bsc.gmc@gmail.com', '1986-06-30', 0, '', 0),
(140, 1, 'LIMA ABHAY ARYA ', 11, 110, 11, '', 0, 'Fulltime', '', '', '', '2011-08-08', '', '', '', 0, '', 'aryalima@rediffmail.com', '1986-08-29', 0, '', 0),
(141, 1, 'SHRADDHA DATTARAM MORE ', 11, 110, 11, '', 0, 'Fulltime', '', '', '', '2012-03-29', '', '', '101189', 0, '', 'dr.shraddhamore@gmail.com', '1985-10-21', 0, '', 0),
(142, 1, 'NAGARJUNA KAPIL KOLLURU ', 11, 110, 11, '', 0, 'Fulltime', '', '', '', '2012-10-10', '', '', '106740', 0, '', 'kolluru.nani@gmail.com', '1986-02-02', 0, '', 0),
(143, 1, 'UMASHANKAR THATAVARTHI ', 11, 110, 11, '', 0, 'Fulltime', '', '', '', '2012-10-10', '', '', '', 0, '', 'uma_1016@yahoo.com', '1982-11-23', 0, '', 0),
(144, 1, 'JAGADESWARA REDDY KANALA ', 11, 110, 11, '', 0, 'Fulltime', '', '', '', '2012-10-10', '', '', '', 0, '', 'kanala_reddy2004@yahoo.com', '1985-08-15', 0, '', 0),
(145, 1, 'PONAGANTI NISHANTH. ', 11, 110, 11, '', 0, 'Fulltime', '', '', '', '2013-10-12', '', '', 'MCI/11-40824', 988012519, '', 'naninishanth@gmail.com', '1988-06-10', 0, '', 0),
(146, 1, 'VAIBHAV MANDAVA. ', 11, 110, 11, '', 0, 'Fulltime', '', '', '', '2013-10-12', '', '', '', 9591281415, '', 'mandavavaibhav@gmail.com', '1987-08-29', 0, '', 0),
(147, 1, 'GORAKH BHAGYASHREE VIJAY ', 11, 110, 11, '', 0, 'Fulltime', '', '', '', '2013-11-18', '', '', '2013/04/0962', 8983058198, '', 'drbvg17994@yahoo.in', '1989-04-09', 0, '', 0),
(148, 1, 'DANDAMUDI KIRAN KUMAR', 11, 110, 11, '', 0, 'Fulltime', '', '', '', '2014-09-30', '', '', '', 9505445442, '', 'kirandandamudi@hotamail.com', '1988-11-25', 0, '', 0),
(149, 1, 'VIJAY RAMPALLY', 11, 110, 11, '', 0, 'Fulltime', '', '', '', '2014-10-07', '', '', '', 9705648334, '', 'vijay.rampally@gmail.com', '1988-06-13', 0, '', 0),
(150, 1, 'PHANIRAJ KISHORE KOKKIRALA', 11, 110, 11, '', 0, 'Fulltime', '', '', '', '2014-10-20', '', '', 'APMC/FMR/80466', 0, '', '', NULL, 0, '', 0),
(151, 1, 'PRANAVI NAGENDLA ', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2011-04-21', '', '', '100921', 0, '', 'pranavireddy_n@yahoo.co.in', '1982-08-12', 0, '', 0),
(152, 1, 'NIVEDITA RESHME ', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2011-04-25', '', '', '86728', 0, '', 'nivedita.reshme@gmail.com', '1985-12-06', 0, '', 0),
(153, 1, 'YASHODA.R', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2012-03-22', '', '', '77609', 0, '', 'dryashodar@gmail.com', '1982-02-07', 0, '', 0),
(154, 1, 'VARSHA PATIL ', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2012-03-23', '', '', '77629', 0, '', 'drshivsambargi@gmail.com', '1984-04-29', 0, '', 0),
(155, 1, 'SUMA S. MONI ', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2012-04-05', '', '', '91911', 0, '', 'suma.moni22@gmail.com', '1987-07-22', 0, '', 0),
(156, 1, 'ANURADHA VILAS MAHAJAN', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2012-06-23', '', '', '101185', 0, '', 'anu8611@yahoo.co.in', '1986-05-11', 0, '', 0),
(157, 1, 'RAMA  V. ', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2013-02-25', '', '', '83538', 0, '', 'v.venigalla28@gmail.com', '1985-09-28', 0, '', 0),
(158, 1, 'BRAGANZA VEENA ', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2013-02-25', '', '', '57639', 0, '', 'vnabraganza@gmail.com', '1972-01-28', 0, '', 0),
(159, 1, 'KRUSHI MOGADALI ', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2013-05-22', '', '', '', 0, '', 'krushi.mogadali@gmail.com', '1988-03-05', 0, '', 0),
(160, 1, 'SUSHMA S. R.', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2013-08-08', '', '', '97893', 9443318874, '', 'sushma.88s@gmail.com', '1988-09-15', 0, '', 0),
(161, 1, 'SHRIDHARADDI. ', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2013-08-09', '', '', '', 9019733433, '', 'shridhar.raddil@gmail.com', NULL, 0, '', 0),
(162, 1, 'JAYSHRI.DN', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2013-10-03', '', '', '', 9900266031, '', 'not available', NULL, 0, '', 0),
(163, 1, 'DIVYA .S .', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2014-02-10', '', '', '', 0, '', 'doctordivyaupadhya@gmail.com', '1985-11-27', 0, '', 0),
(164, 1, 'SUMAN SHIVANAGOUDA PATIL.', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2014-02-10', '', '', '', 0, '', 'sumidoc4u@gmail.com', '1984-08-07', 0, '', 0),
(165, 1, 'PRIYANKA RANI. ', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2014-02-12', '', '', '', 0, '', 'drpriyanka.smart@gmail.com', '1983-04-30', 0, '', 0),
(166, 1, 'HARIKA MATHI. ', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2014-04-01', '', '', '', 8985362129, '', 'harika.mathi', '1990-06-24', 0, '', 0),
(167, 1, 'DIVYA K. ', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2014-04-01', '', '', '', 9902227962, '', 'divs.cutie13@gmail.com', '1989-10-13', 0, '', 0),
(168, 1, 'RITUPARNA BERA', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2014-04-03', '', '', '65776', 7848823194, '', 'rituparnaisbera@gmail.com', NULL, 0, '', 0),
(169, 1, 'KALPANA REDDY', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2013-10-14', '', '', 'APMC/FMR/80489', 0, '', '', NULL, 0, '', 0),
(170, 1, 'VELANGANI BHAVYA SWETHA.R.', 11, 121, 11, '', 0, 'Fulltime', '', '', '', '2014-06-20', '', '', '', 9492347498, '', 'bhavyaswetha@yahoo.co.in', '1990-04-17', 0, '', 0),
(171, 1, 'KETAN VEKHANDE', 11, 165, 11, '', 0, 'Fulltime', '', '', '', '2012-06-23', '', '', '97863', 0, '', 'ketan.vekhande@gmail.com', '1986-04-08', 0, '', 0),
(172, 1, 'SUNIL BALIGA.B.', 11, 165, 11, '', 0, 'Fulltime', '', '', '', '2012-08-16', '', '', '83385', 0, '', 'sunilbaligab@gmail.com', '1985-11-15', 0, '', 0),
(173, 1, 'DUBEY VINOD KUMAR.', 11, 165, 11, '', 0, 'Fulltime', '', '', '', '2013-08-09', '', '', '2012/07/2088', 0, '', 'vinoddubey195@gmail.com', '1987-02-24', 0, '', 0),
(174, 1, 'ABHIJIT JAWALI A. ', 11, 165, 11, '', 0, 'Fulltime', '', '', '', '2013-09-30', '', '', '84630', 7259150804, '', 'abhijitjawalileo@gmail.com', NULL, 0, '', 0),
(175, 1, 'ABHILASH K.G.', 11, 165, 11, '', 0, 'Fulltime', '', '', '', '2014-02-12', '', '', '', 0, '', 'drabhilashkg@gmail.com', '1980-03-13', 0, '', 0),
(176, 1, 'MADHUSUDHAN .N.C. ', 11, 165, 11, '', 0, 'Fulltime', '', '', '', '2014-04-04', '', '', '', 8105866978, '', 'ncmadhu88@gmail.com', '1988-11-03', 0, '', 0),
(177, 1, 'PAULSON C MATHEW. ', 11, 165, 11, '', 0, 'Fulltime', '', '', '', '2014-04-22', '', '', '47226', 9495460705, '', 'paulsoncmathew@gmail.com', '1987-10-26', 0, '', 0),
(178, 1, 'SARDA PRAVIN MURLIDHAR.', 11, 165, 11, '', 0, 'Fulltime', '', '', '', '2014-04-23', '', '', '', 9552792495, '', 'sardapravin20@yahoo.co.in', '1985-06-26', 0, '', 0),
(179, 1, 'VINAY S.', 11, 176, 11, '', 0, 'Fulltime', '', '', '', '2011-08-04', '', '', '', 0, '', 'drvinaymails@gmail.com', '1984-03-09', 0, '', 0),
(180, 1, 'BHAVYA S.O ', 11, 176, 11, '', 0, 'Fulltime', '', '', '', '2012-03-24', '', '', '79875', 0, '', 'doc_bhavya@yahoo.co.in', '1985-01-01', 0, '', 0),
(181, 1, 'PRASHANTKUMAR SARANADAGOUDA .', 11, 176, 11, '', 0, 'Fulltime', '', '', '', '2012-03-24', '', '', '77106', 0, '', 'dr.prashanthss@gmail.com', '1984-01-26', 0, '', 0),
(182, 1, 'SUJITH K. R. ', 11, 176, 11, '', 0, 'Fulltime', '', '', '', '2012-04-05', '', '', '89009', 0, '', 'dr.sujithkr@live.com', '1986-08-29', 0, '', 0),
(183, 1, 'ABHAY SHIVPURI ', 11, 176, 11, '', 0, 'Fulltime', '', '', '', '2012-06-30', '', '', '97559', 0, '', 'abhay_shivpuri@yahoo.com', '1986-08-12', 0, '', 0),
(184, 1, 'CHARANTHEJA GURIJALA ', 11, 176, 11, '', 0, 'Fulltime', '', '', '', '2013-08-08', '', '', '102635', 0, '', 'drcharanthejreddy@gmail.com', '1987-06-23', 0, '', 0),
(185, 1, 'RITU', 11, 176, 11, '', 0, 'Fulltime', '', '', '', '2013-08-09', '', '', '', 0, '', 'zoomingaries@gmail.com', '1986-09-18', 0, '', 0),
(186, 1, 'SOUMYA .S.', 11, 176, 11, '', 0, 'Fulltime', '', '', '', '2013-10-03', '', '', '37335', 0, '', 'drsoumyasarin@gmail.com', NULL, 0, '', 0),
(187, 1, 'KIRAN RAJ . H. ', 11, 176, 11, '', 0, 'Fulltime', '', '', '', '2013-10-04', '', '', '73682', 0, '', 'krajh999@gmail.com', NULL, 0, '', 0),
(188, 1, 'DEEPA A.G. ', 11, 176, 11, '', 0, 'Fulltime', '', '', '', '2014-03-06', '', '', '', 8139980424, '', 'dpagabbur@gmail.com', '1986-02-19', 0, '', 0),
(189, 1, 'HYDER ALI', 11, 176, 11, '', 0, 'Fulltime', '', '', '', '2014-03-06', '', '', '87414', 9740808742, '', 'hyderalim99@gmail.com', '2986-01-02', 0, '', 0),
(190, 1, 'RAVI KUMAR .KOLLA . ', 11, 176, 11, '', 0, 'Fulltime', '', '', '', '2014-03-31', '', '', '', 9550624610, '', 'kollaravikumar.mbbs@gmail.com', '1987-07-01', 0, '', 0),
(191, 1, 'K. VENKATA AJHITH REDDY', 11, 176, 11, '', 0, 'Fulltime', '', '', '', '2014-03-31', '', '', 'APMC/FMR/81214', 7382081646, '', ' ajithreddy3008@gmail.com', '1988-08-30', 0, '', 0),
(192, 1, 'ASHWINI P.S.', 11, 176, 11, '', 0, 'Fulltime', '', '', '', '2014-03-31', '', '', '', 9482661780, '', 'psdrashwini@gmail.com', '1988-04-12', 0, '', 0),
(193, 1, 'SHAMINA PUTHUKUDIYIL', 11, 176, 11, '', 0, 'Fulltime', '', '', '', '2014-08-29', '', '', '88165', 7204703637, '', 'shemina4656@gmail.com', '1986-04-19', 0, '', 0),
(194, 1, 'AMIT MOHAN MANDHARE ', 11, 220, 11, '', 0, 'Fulltime', '', '', '', '2011-08-09', '', '', '', 0, '', 'amitm62@rediffmail.com', '1983-11-26', 0, '', 0),
(195, 1, 'DEEKSHA KAPOOR ', 11, 220, 11, '', 0, 'Fulltime', '', '', '', '2011-08-06', '', '', '', 0, '', 'dr.deeksha.kapoor@gmail.com', '1985-07-10', 0, '', 0),
(196, 1, 'SUDHAKAR KALPAGIRI ', 11, 220, 11, '', 0, 'Fulltime', '', '', '', '2012-11-02', '', '', '106739', 0, '', 'sudhakark3@gmail.com', '1983-02-04', 0, '', 0),
(197, 1, 'MULGIR SHIVAJI DNYANOBA ', 11, 220, 11, '', 0, 'Fulltime', '', '', '', '2013-08-10', '', '', 'MCI/11/40241', 0, '', 'shivaji.mulgir77@gmail.com', '1986-05-06', 0, '', 0),
(198, 1, 'KEERTHI RAJ ', 11, 220, 11, '', 0, 'Fulltime', '', '', '', '2013-10-12', '', '', '100482', 9844312953, '', 'drkeerthiraj@outlook.com', '1990-04-09', 0, '', 0),
(199, 1, 'ASHWITHA SHENOY. ', 11, 220, 11, '', 0, 'Fulltime', '', '', '', '2013-10-10', '', '', '98019', 9901689460, '', 'shenoy.ashwitha@gmail.com', '1989-12-04', 0, '', 0),
(200, 1, 'ROHIT.R.HEGDE.', 11, 220, 11, '', 0, 'Fulltime', '', '', '', '2014-10-01', '', '', '95404', 9696234307, '', 'rohitrhegde@gmail.com', '1988-05-01', 0, '', 0),
(201, 1, 'B.PENCHALA PRASAD.', 11, 220, 11, '', 0, 'Fulltime', '', '', '', '2014-10-04', '', '', '071982', 7760845767, '', 'prasadbadabagni@gmail.com', '1987-05-05', 0, '', 0),
(202, 1, 'T.VISHNU KUMAR.', 11, 220, 11, '', 0, 'Fulltime', '', '', '', '2014-10-01', '', '', 'APMC/FMR/76461', 9030575960, '', 'tummavishnu@gmail.com', '1987-01-17', 0, '', 0),
(203, 1, 'PARTH HASMUKHLAL LALCHETA.', 11, 220, 11, '', 0, 'Fulltime', '', '', '', '2014-10-03', '', '', '', 9426154999, '', 'phlalcheta@yahoo.com', '1990-08-24', 0, '', 0),
(204, 1, 'Charit Bhograj ', 10, 254, 1, '', 1, 'Visiting', '1$2$3$4$5$6', '14:00,14:00,14:00,14:00,14:00,14:00,,', '16:00,16:00,16:00,16:00,16:00,16:00,,', NULL, '', '', '', 9663375833, '', '', NULL, 0, '', 1),
(205, 1, 'Hiremath', 10, 254, 1, '', 1, 'Visiting', '1$2$3$4$5$6', '14:00,14:00,14:00,14:00,14:00,14:00,,', '16:00,16:00,16:00,16:00,16:00,16:00,,', NULL, '', '', '', 9916383620, '', '', NULL, 0, '', 1),
(206, 1, 'K. J. Shetty', 10, 255, 1, '', 2, 'Visiting', '1$2$3$4$5$6', '08:00,08:00,08:00,08:00,08:00,08:00,,', '10:30,10:30,10:30,10:30,10:30,10:30,,', NULL, '', '', '', 9880144200, '', '', NULL, 0, '', 1),
(207, 1, 'Anand Dothilal', 10, 256, 1, '', 3, 'Visiting', '1$2$3$5$6', '10:00,10:00,10:00,,10:00,10:00,10:00,', '11:30,11:30,11:30,,11:30,11:30,11:30,', NULL, '', '', '', 9731247079, '', '', NULL, 0, '', 1),
(208, 1, 'Somashekhar S. P.', 10, 257, 1, '', 4, 'Visiting', '', ',,,,,,,', ',,,,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(209, 1, 'Bharth K. Kadadi', 10, 258, 1, '', 0, 'Visiting', '4', ',,,14:00,,,,', ',,,16:00,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(210, 1, 'Prakash P. N.', 10, 259, 1, '', 6, 'Visiting', '2$5', ',,,,,,,', ',,,,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(211, 1, 'Chacko Korula Jacob', 10, 260, 1, '', 7, 'Visiting', '1$2$3$4$5', '10:00,10:00,10:00,10:00,10:00,,,', '15:00,15:00,15:00,15:00,15:00,,,', NULL, '', '', '', 9535236019, '', '', NULL, 0, '', 1),
(212, 1, 'Venkatarajamanraju', 10, 260, 1, '', 7, 'Visiting', '', ',,,,,,,', ',,,,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(213, 1, 'Krishna Prasad', 10, 261, 1, '', 8, 'Visiting', '1$2$3$4$5$6', '09:00,09:00,09:00,09:00,09:00,09:00,,', '11:00,11:00,11:00,11:00,11:00,11:00,,', NULL, '', '', '', 9686333992, '', '', NULL, 0, '', 1),
(214, 1, 'Sharan Srinivas ', 10, 261, 1, '', 8, 'Visiting', '2$5', ',17:00,,,17:00,,,', ',18:30,,,18:30,,,', NULL, '', '', '', 9845254274, '', '', NULL, 0, '', 1),
(215, 1, 'Deepika Kenkere', 10, 263, 1, '', 10, 'Visiting', '', ',,,,,,,', ',,,,,,,', NULL, '', '', '', 9845546746, '', '', NULL, 1, '', 1),
(216, 1, 'Usha M. K.', 10, 265, 1, '', 24, 'Visiting', '4', ',,,16:30,,,,', ',,,18:30,,,,', NULL, '', '', '', 0, '', '', NULL, 1, '', 1),
(217, 1, 'Anupama Zeena Sequeira', 10, 186, 1, '', 16, 'Visiting', '1$2$3$4$5', '08:00,08:00,08:00,08:00,08:00,,,', '13:00,13:00,13:00,13:00,13:00,,,', NULL, '', '', '', 0, '', '', NULL, 1, '', 1),
(218, 1, 'Jyothi Narayana', 10, 131, 1, '', 18, 'Visiting', '1$2$3$5$6', '09:00,09:00,09:00,,09:00,09:00,,', '12:00,12:00,12:00,,12:00,12:00,,', NULL, '', '', '', 0, '', '', NULL, 1, '', 1),
(219, 1, 'Glory Alexander', 10, 272, 1, '', 21, 'Visiting', '6', ',,,,,14:00,,', ',,,,,16:00,,', NULL, '', '', '', 0, '', '', NULL, 1, '', 1),
(220, 1, '(Lt.Col) Dr. R. Vardarajulu', 10, 262, 1, '', 7, 'Visiting', '2$5', ',12:00,,,12:00,,,', ',13:00,,,13:00,,,', NULL, '', '', '', 9880101778, '', '', NULL, 0, '', 1),
(221, 1, 'Satish Hegde', 10, 263, 1, '', 10, 'Visiting', '', ',,,,,,,', ',,,,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(222, 1, 'Chetak Shetty', 10, 264, 1, '', 11, 'Visiting', '4', ',,,16:30,,,,', ',,,18:30,,,,', NULL, '', '', '', 9986004717, '', '', NULL, 0, '', 1),
(223, 1, 'Manjunath K. P.', 10, 266, 1, '', 12, 'Visiting', '1', '15:00,,,,,,,', '16:30,,,,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(224, 1, 'Ashok Rijhwani', 10, 267, 1, '', 13, 'Visiting', '', ',,,,,,,', ',,,,,,,', NULL, '', '', '', 9880593053, '', '', NULL, 0, '', 1),
(225, 1, 'Narendra Babu', 10, 267, 1, '', 13, 'Visiting', '', ',,,,,,,', ',,,,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(226, 1, 'Robert Charles', 10, 267, 1, '', 13, 'Visiting', '', ',,,,,,,', ',,,,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(227, 1, 'Satheesh  S.', 10, 268, 1, '', 14, 'Visiting', '1', '09:00,,,,,,,', '12:00,,,,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(228, 1, 'Praveen Prasanna', 10, 269, 1, '', 15, 'Visiting', '1', '16:30,,,,,,,', '19:00,,,,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(229, 1, 'Hirennappa B. Udnur', 10, 270, 1, '', 17, 'Visiting', '1$3$5', '14:00,,14:00,,14:00,,,', '16:00,,16:00,,16:00,,,', NULL, '', '', '', 9379246563, '', '', NULL, 0, '', 1),
(230, 1, 'Murali Subramanian', 10, 131, 1, '', 19, 'Visiting', '1$3$4$5', '09:00,,09:00,09:00,09:00,,,', '10:00,,10:00,10:00,10:00,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(231, 1, 'Rajeev A. G.', 10, 131, 1, '', 18, 'Visiting', '1$2$3$4$5$6', ',,,,,,,', ',,,,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(232, 1, 'Ajay P.', 10, 131, 1, '', 18, 'Visiting', '1$2$3$4$5', ',,,,,,,', ',,,,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(233, 1, 'Anil Kumar M. R.', 10, 131, 1, '', 18, 'Visiting', '1$2$3$4$5$6', ',,,,,,,', ',,,,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(234, 1, 'Santosh D.', 10, 131, 1, '', 18, 'Visiting', '1$3$4$6', ',,,,,,,', ',,,,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(235, 1, 'Manoj Bhajantri', 10, 271, 1, '', 20, 'Visiting', '4', ',,,14:30,,,,', ',,,16:30,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(236, 1, 'Sanjay Govil', 10, 273, 1, '', 22, 'Visiting', '', ',,,,,,,', ',,,,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(237, 1, 'Vishnu  Motikan', 10, 274, 1, '', 23, 'Visiting', '5', ',,,,14:00,,,', ',,,,16:00,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1),
(238, 1, 'Anoop T.', 10, 274, 1, '', 23, 'Visiting', '2$4', ',15:00,,15:00,,,,', ',17:00,,17:00,,,,', NULL, '', '', '', 0, '', '', NULL, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE IF NOT EXISTS `specialization` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`id`, `name`) VALUES
(1, 'Cardiology'),
(2, 'ENDOCRINOLOGY/PHYSICIAN '),
(3, 'GASTROENTEROLOGY'),
(4, 'GYNAE ONCOLOGY'),
(5, 'HAND SURGEON '),
(6, 'MEDICO LEGAL CASES'),
(7, 'NEPHROLOGY'),
(8, 'Neuro-Surgery'),
(9, 'Neurology'),
(10, 'ORAL & MAXILLOFACIAL SURGERY'),
(11, 'ORTHODONTICS'),
(12, 'PAEDIATRIC OPHTHALMOLOGIST'),
(13, 'PAEDIATRIC SURGEON'),
(14, 'PEDIATRIC CARDIOLOGIST'),
(15, 'PEDODONTICS'),
(16, 'PSYCHIATRY'),
(17, 'PULMONOLGY'),
(18, 'Oncology -Radiation'),
(19, 'Oncology -Medical'),
(20, 'RETINA?SPECIALIST? - Ophthalmology? ?'),
(21, 'RETRO VIRAL CLINIC'),
(22, 'SURGICAL GASTROENTEROLOGY'),
(23, 'VASCULAR  SURGERY'),
(24, 'PAEDIATRIC CARDIOLOGY');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE IF NOT EXISTS `title` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`id`, `name`) VALUES
(1, 'DR');

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
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`userroleid`) REFERENCES `userrole` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
