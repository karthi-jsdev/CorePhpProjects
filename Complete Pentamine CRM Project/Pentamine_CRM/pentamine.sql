-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 08, 2014 at 06:44 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pentamine`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignee`
--

CREATE TABLE IF NOT EXISTS `assignee` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `slno` int(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `assignee`
--

INSERT INTO `assignee` (`id`, `slno`, `name`) VALUES
(1, 1, 'Manjunath'),
(2, 2, 'Sankar'),
(9, 3, 'Prathik'),
(10, 4, 'rajesh'),
(11, 5, 'fh'),
(12, 6, 'asdfasdfa'),
(13, 7, 'asdfasf');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ptcid` varchar(50) NOT NULL,
  `cname` varchar(30) NOT NULL,
  `caddress` text NOT NULL,
  `cemail` varchar(30) NOT NULL,
  `cnum1` varchar(300) NOT NULL,
  `cnum2` varchar(300) NOT NULL,
  `cpname1` varchar(30) NOT NULL,
  `cppos1` text NOT NULL,
  `cpnum1` varchar(30) NOT NULL,
  `cpemail1` text NOT NULL,
  `cpname2` varchar(30) NOT NULL,
  `cppos2` text NOT NULL,
  `cpnum2` varchar(50) NOT NULL,
  `reference` varchar(30) NOT NULL,
  `cdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `ptcid`, `cname`, `caddress`, `cemail`, `cnum1`, `cnum2`, `cpname1`, `cppos1`, `cpnum1`, `cpemail1`, `cpname2`, `cppos2`, `cpnum2`, `reference`, `cdate`) VALUES
(1, 'PTCID-001', 'adsfasdfafasdddd', 'fasdfasdfasdf', 'abcd@gmail.co.in', '444444444444444', '5555555555555555', 'aaaaaaaaaaaaaaa', 'sssssssssssssss', '56666666666666', 'abcd@gmail.com', 'adsfasdf', 'adfasfasdf', '9999999999999', ',.mk.,mnm,nmm,.', '2013-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ptclid` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `cdate` datetime NOT NULL,
  `fdate` date NOT NULL,
  `status_id` int(30) NOT NULL,
  `amount` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `enable` tinyint(4) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `ptclid`, `comment`, `cdate`, `fdate`, `status_id`, `amount`, `tax`, `total`, `enable`, `quantity`) VALUES
(1, 'PTLID-00050', 'fgjghj', '2014-01-03 12:15:13', '2014-01-15', 1, 1, 5.5, 1, 0, '1'),
(2, 'PTLID-00032', 'hgj', '2014-01-03 12:15:36', '2014-01-16', 2, 1, 5.5, 1, 1, '1'),
(3, 'PTLID-00036', 'ojkljk', '2014-01-03 12:16:12', '2014-01-11', 3, 1, 5.5, 1, 1, '1'),
(4, 'PTLID-00037', 'khjk', '2014-01-03 12:16:50', '2014-01-11', 4, 1, 5.5, 1, 1, '1'),
(5, 'PTLID-00019', 'hgjghj', '2014-01-03 12:17:17', '2014-01-17', 5, 1, 5.5, 1, 1, '345'),
(6, 'PTLID-00049', 'gfhfg', '2014-01-03 12:17:47', '2014-01-24', 6, 1, 5.5, 1, 0, '1'),
(7, 'PTLID-00043', 'jghjg', '2014-01-03 12:18:24', '2014-01-31', 9, 1, 5.5, 1, 1, '1'),
(8, 'PTLID-00021', 'gjghj', '2014-01-03 01:14:45', '2014-01-08', 7, 12, 5.5, 12.66, 1, '12'),
(9, 'PTLID-00028', 'yutyu', '2013-12-25 11:22:03', '2014-01-02', 7, 13, 12.36, 14.61, 1, '12'),
(10, 'PTLID-00049', 'tyrtytr', '2014-01-06 11:23:55', '2014-01-02', 7, 12, 12.36, 13.48, 1, '12'),
(11, 'PTLID-00050', 'tyry', '2014-01-06 11:32:22', '2014-01-15', 7, 1, 5.5, 1, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `empid` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `pnum` bigint(20) NOT NULL,
  `pemail` varchar(100) NOT NULL,
  `cemail` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `anniversary` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `empid`, `name`, `address`, `pnum`, `pemail`, `cemail`, `date`, `qualification`, `dob`, `anniversary`) VALUES
(1, 'PTEID-001', 'GU77UHY6', 'TYU', 5675, 'GHJ', 'GHJ', '2013-12-24', 'GHJU', '2013-12-03', '2013-12-09'),
(2, 'PTEID-002', 'karthik', 'TYU', 5675, 'GHJ', 'GHJ', '2013-12-24', 'GHJU', '2013-12-03', '2013-12-09'),
(3, 'PTEID-003', 'GU77UHY6', 'TYU', 5675, 'GHJ', 'GHJ', '2013-12-24', 'GHJU', '2013-12-03', '2013-12-09'),
(4, 'PTEID-004', 'try', '56756', 345, '65757', '56756', '2013-12-24', '567566', '2013-12-14', '2013-12-12'),
(5, 'PTEID-005', 'asdfasdfa', 'adsfasfa', 6666666666666666, 'adfasf@gmail.com', 'sdfafasf', '2013-12-26', 'be', '2013-12-27', '2014-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `financemodule`
--

CREATE TABLE IF NOT EXISTS `financemodule` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `PTFID` varchar(255) NOT NULL,
  `Date` varchar(300) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Amount` varchar(255) NOT NULL,
  `Details` varchar(300) NOT NULL,
  `Mode` varchar(300) NOT NULL,
  `Detailsofpayment` varchar(300) NOT NULL,
  `Paymentdetails` varchar(300) NOT NULL,
  `DateTime` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `financemodule`
--

INSERT INTO `financemodule` (`id`, `PTFID`, `Date`, `Description`, `Amount`, `Details`, `Mode`, `Detailsofpayment`, `Paymentdetails`, `DateTime`) VALUES
(1, 'PTFID-0001', '12/02/2013', 'Rent', '12', 'asfsfasf', 'Cash', 'ack', 'outflow', '2013-12-02 03:17:01PM'),
(2, 'PTFID-0002', '12/02/2013', 'Rent', '12132', 'for the\r\npurpose\r\nof testing  \r\nCRM of \r\npentamine\r\n\r\nteset', 'Cash', 'ack', 'inflow', '2013-12-02 03:17:22PM'),
(3, 'PTFID-0003', '12/02/2013', 'Rent', '123', 'sdfdf\r\nasfd\r\nrtert    hhn h y', 'Cash', 'sss', 'outflow', '2013-12-02 03:41:39PM'),
(4, 'PTFID-0004', '12/11/2013', 'Rent', '123', 'f&nbsp; bdfd', 'Cash', 'ack', 'outflow', '2013-12-11 10:25:52AM'),
(5, 'PTFID-0005', '12/21/2013', 'Rent', '56546', 'dfgdfgdfg', 'Cash', 'ACK', 'outflow', '2013-12-21 10:49:54AM'),
(6, 'PTFID-0006', '12/21/2013', 'Rent', '345', 'dfgdfgdfg<br>dfg<br>df<br>g<br>dfg<br><br>dfgfnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn<br>', 'Cash', 'ACK', 'outflow', '2013-12-21 10:50:18AM'),
(7, 'PTFID-0007', '12/21/2013', 'Rent', '546456', 'tdfgggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', 'Cheque', 'ACKdfgggggg', 'outflow', '2013-12-21 11:07:22AM'),
(8, 'PTFID-0008', '12/21/2013', 'Waterbill', '55555555555', 'uuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu', 'Cash', 'ACKdfgggggggg', 'outflow', '2013-12-21 11:08:52AM');

-- --------------------------------------------------------

--
-- Table structure for table `finance_description`
--

CREATE TABLE IF NOT EXISTS `finance_description` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `slno` int(255) NOT NULL,
  `description_name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `finance_description`
--

INSERT INTO `finance_description` (`id`, `slno`, `description_name`) VALUES
(1, 1, 'Rent'),
(2, 2, 'Waterbill'),
(3, 3, 'Salary'),
(7, 4, 'Electricity');

-- --------------------------------------------------------

--
-- Table structure for table `finance_modeofpayment`
--

CREATE TABLE IF NOT EXISTS `finance_modeofpayment` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `slno` int(255) NOT NULL,
  `modeofpayment` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `finance_modeofpayment`
--

INSERT INTO `finance_modeofpayment` (`id`, `slno`, `modeofpayment`) VALUES
(1, 1, 'Cash'),
(2, 2, 'Cheque'),
(3, 3, 'InternetBanking'),
(4, 4, 'Credit card');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_item`
--

CREATE TABLE IF NOT EXISTS `inventory_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `PTIID` varchar(255) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `rackno` varchar(255) NOT NULL,
  `partno` varchar(255) NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `itemspecification` varchar(255) NOT NULL,
  `productlist` varchar(255) NOT NULL,
  `vendors` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `inventory_item`
--

INSERT INTO `inventory_item` (`id`, `PTIID`, `itemname`, `rackno`, `partno`, `companyname`, `itemspecification`, `productlist`, `vendors`) VALUES
(1, 'PTIID-0001', 'd', 'd', 'd', 'micro', 'd', 'Zeboba', 'ss'),
(2, 'PTIID-0002', 'd', 'dd', 'dd', 'texas instruments', 'dd', 'Zeboba,Geotracer', 'ss,yudtid'),
(3, 'PTIID-0003', 'd', 'd', 'd', 'micro', 'dfsdf', 'Geotracer,Powermetrics', 'c,ertyer'),
(4, 'PTIID-0004', 'd', 'd', 'd', 'texas instruments', 'd', 'Zeboba', 'ss,yudtid,c,ertyer'),
(5, 'PTIID-0005', 'd', 'd', 'd', 'texas instruments', 'd', 'Zeboba', 'ss'),
(6, 'PTIID-0006', 'qwdqwe', 'a21', 'sdf', 'micro', 'qqwe <br>dffdeqweqwe', 'Zeboba,Geotracer', 'yudtid,fsdf'),
(7, 'PTIID-0007', 'mhgjhjkh', '5555555555555', '555555555555555', 'texas instruments', 'jhghjdhskfjhjksdhfdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', 'Zeboba', 'ss'),
(8, 'PTIID-0008', 'mhgjhjkh', '55555555', '55555555555', 'texas instruments', 'sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', 'Zeboba,Customer Relationship Manageme', 'ss,nhghjgjhg');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_itemcompanymaster`
--

CREATE TABLE IF NOT EXISTS `inventory_itemcompanymaster` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `companyname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `inventory_itemcompanymaster`
--

INSERT INTO `inventory_itemcompanymaster` (`id`, `companyname`) VALUES
(1, 'texas instruments'),
(19, 'micro'),
(20, 'sdfsfsfsdfsfsdf'),
(21, 'dfsdfdfss'),
(22, 'fsfsdfsdfsd');

-- --------------------------------------------------------

--
-- Table structure for table `lead`
--

CREATE TABLE IF NOT EXISTS `lead` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ptclid` varchar(30) NOT NULL,
  `cname` varchar(30) NOT NULL,
  `ldesc` text NOT NULL,
  `ldate` varchar(30) NOT NULL,
  `ptype` varchar(30) NOT NULL,
  `pstype` varchar(50) NOT NULL,
  `assign` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `lead`
--

INSERT INTO `lead` (`id`, `ptclid`, `cname`, `ldesc`, `ldate`, `ptype`, `pstype`, `assign`) VALUES
(7, 'PTLID-0007', 'Select', '', '2013-12-20', 'Select', 'Select', 'Select'),
(8, 'PTLID-0008', 'Select', '', '2013-12-20', 'Select', 'Select', 'Select'),
(9, 'PTLID-0009', 'Select', '', '2013-12-20', 'Select', 'Select', 'Select'),
(10, 'PTLID-00010', 'Select', '', '2013-12-20', 'Select', 'Select', 'Select'),
(11, 'PTLID-00011', 'Select', '', '2013-12-20', 'Select', 'Select', 'Select'),
(18, 'PTLID-00018', 'PTCID-004', 'tuyu', '2013-12-21', '2', '2', '1'),
(19, 'PTLID-00019', 'PTCID-004', 'tuyu', '2013-12-21', '2', '2', '1'),
(20, 'PTLID-00020', 'PTCID-004', 'tuyu', '2013-12-21', '2', '2', '1'),
(21, 'PTLID-00021', 'PTCID-004', 'tuyu', '2013-12-21', '2', '2', '1'),
(22, 'PTLID-00022', 'PTCID-004', 'tuyu', '2013-12-21', '2', '2', '1'),
(23, 'PTLID-00023', 'PTCID-004', 'tuyu', '2013-12-21', '2', '2', '1'),
(24, 'PTLID-00024', 'PTCID-004', 'tuyu', '2013-12-21', '2', '2', '1'),
(25, 'PTLID-00025', 'PTCID-004', 'tuyu', '2013-12-21', '2', '2', '1'),
(26, 'PTLID-00026', 'PTCID-004', 'rtytry', '2013-12-21', '2', '2', '1'),
(27, 'PTLID-00027', 'PTCID-004', 'rtytry', '2013-12-21', '2', '2', '1'),
(28, 'PTLID-00028', 'PTCID-004', 'rtytry', '2013-12-21', '2', '2', '1'),
(29, 'PTLID-00029', 'PTCID-004', 'rtytry', '2013-12-21', '2', '2', '1'),
(30, 'PTLID-00030', 'PTCID-004', 'rtytry', '2013-12-21', '2', '2', '1'),
(31, 'PTLID-00031', 'PTCID-001', 'rtytryppppppppppppppppppppppppp', '2013-12-21', '3', '3', '4'),
(35, 'PTLID-00032', 'PTCID-0013', '&lt;br&gt;cbncvbvnoooooooooooooooodecwdpppppppppppppppppppppppppppp&lt;br&gt;', '2013-12-26', '2', '2', '4'),
(36, 'PTLID-00036', 'PTCID-0013', 'sdfgsdfgsdfgsdfgsdfgsdfgsdfgsdf', '2013-12-26', '4', '4', '4'),
(37, 'PTLID-00037', 'PTCID-005', 'sdfgsdfgdsfgsdfgsd', '2013-12-26', '3', '3', '4'),
(38, 'PTLID-00038', 'PTCID-005', 'sdfgsdfgdsfgsdfgsd', '2013-12-26', '3', '3', '4'),
(39, 'PTLID-00039', 'PTCID-005', 'sdfgsdfgdsfgsdfgsd', '2013-12-26', '3', '3', '4'),
(40, 'PTLID-00040', 'PTCID-005', 'sdfgsdfgdsfgsdfgsd', '2013-12-26', '3', '3', '4'),
(41, 'PTLID-00041', 'PTCID-005', 'sdfgsdfgdsfgsdfgsd', '2013-12-26', '3', '3', '4'),
(42, 'PTLID-00042', 'PTCID-005', 'sdfgsdfgdsfgsdfgsd', '2013-12-26', '3', '3', '4'),
(43, 'PTLID-00043', 'PTCID-005', 'sdfgsdfgdsfgsdfgsd', '2013-12-26', '3', '3', '4'),
(44, 'PTLID-00044', 'PTCID-005', 'sdfgsdfgdsfgsdfgsd', '2013-12-26', '3', '3', '4'),
(45, 'PTLID-00045', 'PTCID-005', 'sdfgsdfgdsfgsdfgsd', '2013-12-26', '3', '3', '4'),
(46, 'PTLID-00046', 'PTCID-005', 'sdfgsdfgdsfgsdfgsd', '2013-12-26', '3', '3', '4'),
(47, 'PTLID-00047', 'PTCID-005', 'sdfgsdfgdsfgsdfgsd', '2013-12-26', '3', '3', '4'),
(48, 'PTLID-00048', 'PTCID-005', 'sdfgsdfgdsfgsdfgsd', '2013-12-26', '3', '3', '4'),
(49, 'PTLID-00049', 'PTCID-005', 'sdfgsdfgdsfgsdfgsdsdgfsdfgdfgsdf', '2013-12-26', '4', '4', '2'),
(50, 'PTLID-00050', 'PTCID-001', 'dghddghdhdkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', '2013-12-31', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE IF NOT EXISTS `leaves` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `empid` varchar(50) NOT NULL,
  `empname` varchar(50) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `days` bigint(50) NOT NULL,
  `c_number` bigint(50) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `approved` varchar(50) NOT NULL,
  `leavestatus` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `empid`, `empname`, `fromdate`, `todate`, `days`, `c_number`, `reason`, `approved`, `leavestatus`) VALUES
(1, '', 'karthik', '2013-12-11', '2013-12-04', 7, 345, '			fbvgfg												', 'Select', 'approved'),
(2, '', 'karthik', '2013-12-11', '2013-12-04', 7, 345, '			fbvgfg												', 'Select', 'approved'),
(3, '', 'karthik', '2013-12-30', '2013-12-31', 1, 0, '					SDFGFSDGSDFG', '', 'Pending'),
(4, '', 'karthik', '2013-12-30', '2013-12-31', 1, 0, '					SDFGFSDGSDFG', '', 'Pending'),
(5, '', 'karthik', '2013-12-30', '2013-12-31', 1, 0, '					SDFGFSDGSDFG', '', 'Pending'),
(6, '', 'karthik', '2013-12-30', '2013-12-31', 1, 0, '					SDFGFSDGSDFG', '', 'Pending'),
(7, '', 'karthik', '2013-12-30', '2013-12-31', 1, 0, '					SDFGFSDGSDFG', '', 'Pending'),
(8, '', 'karthik', '2013-12-30', '2013-12-31', 1, 0, '					SDFGFSDGSDFG', '', 'Pending'),
(9, '', 'karthik', '2013-12-30', '2013-12-31', 1, 0, '					SDFGFSDGSDFG', '', 'Pending'),
(10, '', 'karthik', '2013-12-30', '2013-12-31', 1, 0, '					SDFGFSDGSDFG', '', 'Pending'),
(11, '', 'karthik', '2013-12-18', '2013-12-26', 8, 777777777777, '					ghjfghjfghj', '2', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `productsubtype`
--

CREATE TABLE IF NOT EXISTS `productsubtype` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `slno` bigint(20) NOT NULL,
  `type` varchar(30) NOT NULL,
  `type_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `productsubtype`
--

INSERT INTO `productsubtype` (`id`, `slno`, `type`, `type_id`) VALUES
(1, 1, 'zeboba', 1),
(2, 2, 'Geotracer', 2),
(3, 3, 'Powermetrics', 3),
(4, 4, 'ServiceProducts', 4),
(5, 5, 'cc', 5);

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

CREATE TABLE IF NOT EXISTS `producttype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slno` int(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`id`, `slno`, `type`) VALUES
(1, 1, 'Zeboba'),
(2, 2, 'Geotracer'),
(3, 3, 'Powermetrics'),
(6, 4, 'Service Product'),
(7, 5, 'Customer Relationship Manageme');

-- --------------------------------------------------------

--
-- Table structure for table `recurring`
--

CREATE TABLE IF NOT EXISTS `recurring` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `recurring_id` varchar(20) NOT NULL,
  `recurring_createdate` date NOT NULL,
  `recurring_client` varchar(50) NOT NULL,
  `recurring_product` varchar(50) NOT NULL,
  `recurring_subproduct` varchar(50) NOT NULL,
  `recurring_description` varchar(50) NOT NULL,
  `recurring_amount` varchar(50) NOT NULL,
  `recurring_frequency` text NOT NULL,
  `recurring_alertdate` varchar(50) NOT NULL,
  `recurring_status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `recurring`
--

INSERT INTO `recurring` (`id`, `recurring_id`, `recurring_createdate`, `recurring_client`, `recurring_product`, `recurring_subproduct`, `recurring_description`, `recurring_amount`, `recurring_frequency`, `recurring_alertdate`, `recurring_status`) VALUES
(1, 'PTRID-001', '2014-01-03', 'PTCID-001', '1', '1', 'dsafsd', '5000.25', '2-Month', '19', 'Enable'),
(2, 'PTRID-002', '2014-01-03', 'PTCID-001', '2', '2', 'safsf', '5000', '1-Month', '2', 'Enable'),
(3, 'PTRID-003', '2014-01-03', 'PTCID-001', '2', '2', 'ghjkghj', '60000', '1-Month', '2', 'Disable'),
(4, 'PTRID-004', '2014-01-03', 'PTCID-001', '3', '3', 'hello', '100', '6-Month', '3', 'Enable'),
(5, 'PTRID-005', '2014-01-03', 'PTCID-001', '1', '1', '231e', '100,300', '4-Month', '3', 'Enable'),
(6, 'PTRID-006', '2014-01-03', 'PTCID-001', '2', '2', 'ghj', '12000,72000', '2-Month', '1', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `PTRID` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `subproduct` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `updatedby` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`id`, `PTRID`, `product`, `subproduct`, `description`, `date`, `updatedby`) VALUES
(1, 'PTRID-0001', 'Zeboba', 'Geotracer', 'fgdgdfgfdddddddddddddddddddddddddd', '2013-12-10 07:40:57PM', 'admin'),
(2, 'PTRID-0002', 'Geotracer', 'zeboba', 'gfdfffffffffffffffffffffffffffff', '2013-12-10 07:41:16PM', 'admin'),
(3, 'PTRID-0003', 'other', 'zeboba', 'sdfsdfcddsdjkljhdf', '2013-12-11 10:30:34AM', 'admin'),
(4, 'PTRID-0004', 'Geotracer', 'Geotracer', 'kuxhgjkxcfhgkjdfhkgdfg<br>dfg<br>df<br><br>gd<br>fg<br>', '2013-12-21 10:53:24AM', 'admin'),
(5, 'PTRID-0005', 'Geotracer', 'Geotracer', 'trrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', '2013-12-21 11:27:18AM', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `slno` bigint(30) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `slno`, `status`) VALUES
(1, 1, 'Prospecting'),
(2, 2, 'Analysis'),
(3, 3, 'Presentation'),
(4, 4, 'Proposal'),
(5, 5, 'Negotiation'),
(6, 6, 'Final Review'),
(7, 7, 'Closed/Won'),
(8, 8, 'Closed/Lost'),
(9, 9, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` bigint(50) NOT NULL AUTO_INCREMENT,
  `taskid` varchar(50) NOT NULL,
  `taskdate` date NOT NULL,
  `tdesc` text NOT NULL,
  `tdate` date NOT NULL,
  `assignee` varchar(50) NOT NULL,
  `tstatus` varchar(50) NOT NULL,
  `ptclid` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `taskid`, `taskdate`, `tdesc`, `tdate`, `assignee`, `tstatus`, `ptclid`, `status`) VALUES
(1, 'PTTKID-001', '2013-12-31', 'dfsgsdfgsdfgsdfgsdfgsfgsdfgsdfgdsfg[pppppppppppppppppp', '2013-12-31', '2', 'Closed', 'PTLID-0007', 'Closed'),
(2, 'PTTKID-002', '2013-12-31', 'zxcbvxcbxcvb', '2013-12-30', '2', 'Inprogress', 'PTLID-00025', 'Inprogress'),
(3, 'PTTKID-003', '2014-01-02', 'fghddgdfhf', '2014-01-01', '1', '', 'PTLID-00027', 'Open'),
(4, 'PTTKID-004', '2014-01-02', 'xfbgcvb cvbn&lt;br&gt;', '2014-01-01', '2', '', 'PTLID-00025', 'Open'),
(5, 'PTTKID-005', '2014-01-02', 'jknh,nm,', '2013-12-30', '1', '', 'PTLID-00027', 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `taskcomments`
--

CREATE TABLE IF NOT EXISTS `taskcomments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tskid` varchar(50) NOT NULL,
  `tcomments` text NOT NULL,
  `tdate` date NOT NULL,
  `tstatus` varchar(50) NOT NULL,
  `tassignee` varchar(20) NOT NULL,
  `tleads` varchar(50) NOT NULL,
  `enable` bigint(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `taskcomments`
--

INSERT INTO `taskcomments` (`id`, `tskid`, `tcomments`, `tdate`, `tstatus`, `tassignee`, `tleads`, `enable`) VALUES
(1, 'PTTKID-001', 'xcvbcbcxvbx', '2013-12-31', 'Reopened', '9', '', 0),
(2, 'PTTKID-002', 'gbvcbxcvbcvbxcvbcv', '2013-12-30', 'Inprogress', '2', '', 1),
(3, 'PTTKID-001', 'hjilk', '2013-12-31', 'Closed', '2', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `taskstatus`
--

CREATE TABLE IF NOT EXISTS `taskstatus` (
  `id` bigint(20) NOT NULL,
  `slno` bigint(20) NOT NULL,
  `tstatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taskstatus`
--

INSERT INTO `taskstatus` (`id`, `slno`, `tstatus`) VALUES
(1, 1, 'Open'),
(2, 2, 'Inprogress'),
(3, 3, 'Closed'),
(4, 4, 'Reopened');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `role` varchar(20) NOT NULL,
  `assignee` varchar(50) NOT NULL,
  `product` varchar(20) NOT NULL,
  `category` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `contact`, `role`, `assignee`, `product`, `category`) VALUES
(2, 'admin', 'admin', 123123123, 'admin', 'Prathik', '1,2,3,4,', 'Team Lead,Developer,Tester,'),
(3, 'karthik', '123', 123, 'user', 'Prathik', '1,3,', 'Team Lead,Developer,'),
(4, 'guru', '123', 123, 'user', 'Manjunath', '1,2,5,', 'Team Lead,Developer,'),
(5, 'sakthi', '123', 123, 'user', 'rajesh', '1,4,', 'Team Lead,Developer,');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `PTVID` varchar(255) NOT NULL,
  `Vendorname` varchar(255) NOT NULL,
  `Phonenumber` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `PTVID`, `Vendorname`, `Phonenumber`, `Email`, `Category`, `Address`, `Description`) VALUES
(1, 'PTVID-0001', 'ss', '8795462130', 'yuva@panaceasys.com', 'Zeboba', 'for the purpose of testing\r\nthese things were \r\nincluded in this\r\ndocument', 'for the purpose of testing\r\nthese things were \r\nincluded in this\r\ndocumentfor the purpose of testing\r\nthese things were \r\nincluded in this\r\ndocument'),
(2, 'PTVID-0002', 'yudtid', '9789453677', 'yuva@panaceasys.com', 'Zeboba', 'for the purpose of testingthese things were included in this \r\ndocumentfor the purpose of testing\r\nthese things were ', 'yueri7r]\r\nsdryayu\r\naeyeaeu'),
(3, 'PTVID-0003', 'sdfg dsfgfd ', '9999999999', 'abcd@gamil.com', 'Powermetrics', 'gfdh d gfh ', 'dfg dfsg sdfg sdfg sdf'),
(4, 'PTVID-0004', 'sdfg dsfgfd ', '9999999999', 'abcd@gamil.com', 'Zeboba', 'gfdh d gfh ', 'dfg dfsg \r\nsdfg'),
(5, 'PTVID-0005', 'fsdf', '8795462130', 'gururaj220391@gmail.com', 'Zeboba', 'fd', 'fdgfddff'),
(6, 'PTVID-0006', 'nhghjgjhg', '6545646546', 'abc@panaceasys.com', 'Zeboba', 'mjhghjsdjkfhjk<br>gdf<br>g<br>df<br>gd<br>fg<br>', 'dgfd<br>fg<br>df<br>g<br>df<br>g<br>dfgggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg<br>');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_category`
--

CREATE TABLE IF NOT EXISTS `vendor_category` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `Categoryname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `vendor_category`
--

INSERT INTO `vendor_category` (`id`, `Categoryname`) VALUES
(1, 'Zeboba'),
(2, 'Powermetrics'),
(5, 'dfasdfsdfsddfsdf'),
(6, 'fsdfsdfsdfyuuiuioiosa');

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE IF NOT EXISTS `work` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `work_id` varchar(50) NOT NULL,
  `client` varchar(50) NOT NULL,
  `lead` varchar(50) NOT NULL,
  `tdate` date NOT NULL,
  `developer` text NOT NULL,
  `tester` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `projectleads` varchar(50) NOT NULL,
  `priority` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`id`, `work_id`, `client`, `lead`, `tdate`, `developer`, `tester`, `description`, `projectleads`, `priority`) VALUES
(1, 'PTWKID-001', 'PTCID-001', 'PTLID-0001', '2013-12-02', 'Manjunath,', 'Manjunath,', 'fghfg', 'Manjunath', 'Low'),
(2, 'PTWKID-002', 'PTCID-004', 'PTLID-00020', '2013-12-10', 'Sankar,Prathik,', 'Sankar,', 'hgjgjgfjghj', 'Prathik', 'Low'),
(3, 'PTWKID-003', 'PTCID-001', 'PTLID-00031', '2013-12-27', 'Sankar,Prathik,', 'Sankar,Prathik,', 'sdfgsdgsdfgkkkkkkkkkkkkkkkkkkk', 'Prathik', 'Medium'),
(4, 'PTWKID-004', 'PTCID-001', 'PTLID-00050', '2014-01-08', 'Manjunath,', 'Manjunath,', 'jkhjk', 'Manjunath', 'Medium');

-- --------------------------------------------------------

--
-- Table structure for table `workstatus`
--

CREATE TABLE IF NOT EXISTS `workstatus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `work_id` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `updatestatus` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `workstatus`
--

INSERT INTO `workstatus` (`id`, `work_id`, `description`, `status`, `updatestatus`) VALUES
(1, 'WRKID-0001', ' dhgh', 'Improgress', 'Invoice'),
(2, 'WRKID-0002', ' dgodgdldphdldh', 'Improgress', 'Phase Completion'),
(3, 'PTWKID-0012', ' fdhgf', 'Open', 'Invoice'),
(4, 'PTWKID-0012', ' hjk', 'Inprogress', 'Phase Completion'),
(5, 'PTWKID-003', 'fdgd', 'Inprogress', 'Invoice');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
