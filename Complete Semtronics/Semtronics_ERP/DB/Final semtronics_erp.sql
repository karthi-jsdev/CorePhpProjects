-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2014 at 12:30 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `semtronics_erp`
--
CREATE DATABASE IF NOT EXISTS `semtronics_erp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `semtronics_erp`;

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE IF NOT EXISTS `batch` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `number` varchar(20) NOT NULL,
  `rawmaterialid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rawmaterialid` (`rawmaterialid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `number`, `rawmaterialid`) VALUES
(9, '1', 8),
(10, '2', 7),
(11, 'b003', 7),
(12, 'bbb333', 9),
(13, 'bb33', 8);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `prefix` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `prefix`) VALUES
(6, 'raw1', '001'),
(7, 'raw2', '002'),
(8, 'raw3', '003');

-- --------------------------------------------------------

--
-- Table structure for table `clientcategory`
--

CREATE TABLE IF NOT EXISTS `clientcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientcategory` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `clientcategory`
--

INSERT INTO `clientcategory` (`id`, `clientcategory`) VALUES
(2, 'client1'),
(3, 'client2'),
(4, 'client3');

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE IF NOT EXISTS `couriers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `couriers` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`id`, `couriers`) VALUES
(2, 'courierw'),
(3, 'COURIERTR'),
(4, 'cccccccccc');

-- --------------------------------------------------------

--
-- Table structure for table `creditperiod`
--

CREATE TABLE IF NOT EXISTS `creditperiod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `period` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `creditperiod`
--

INSERT INTO `creditperiod` (`id`, `period`) VALUES
(4, 15),
(5, 25),
(6, 40);

-- --------------------------------------------------------

--
-- Table structure for table `industry_category`
--

CREATE TABLE IF NOT EXISTS `industry_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `industry_category`
--

INSERT INTO `industry_category` (`id`, `name`) VALUES
(2, 'INDUSTRY'),
(3, 'INDUSTRIERS'),
(4, 'iidddd');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendorid` bigint(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `invoicedate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vendorid` (`vendorid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `vendorid`, `number`, `invoicedate`) VALUES
(10, 5, '11', '2014-04-29 00:00:00'),
(11, 5, '1', '2014-04-29 00:00:00'),
(12, 7, '11', '2014-04-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `issuance`
--

CREATE TABLE IF NOT EXISTS `issuance` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `number` varchar(20) NOT NULL,
  `issueddate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE IF NOT EXISTS `leads` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `address` varchar(250) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `contact_person1` varchar(25) NOT NULL,
  `designation1` varchar(25) NOT NULL,
  `email_id1` varchar(100) NOT NULL,
  `contact_no1` varchar(15) NOT NULL,
  `contact_person2` varchar(25) NOT NULL,
  `designation2` varchar(25) NOT NULL,
  `email_id2` varchar(100) NOT NULL,
  `contact_no2` varchar(15) NOT NULL,
  `vendor_category_id` int(20) NOT NULL,
  `reference_id` bigint(20) NOT NULL,
  `reference_group_id` bigint(20) NOT NULL,
  `industry_category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor_category_id` (`vendor_category_id`),
  KEY `industry_category_id` (`industry_category_id`),
  KEY `reference_id` (`reference_id`),
  KEY `reference_group_id` (`reference_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`) VALUES
(5, 'bombay'),
(6, 'bangalore'),
(7, 'chennai');

-- --------------------------------------------------------

--
-- Table structure for table `oppurtunities`
--

CREATE TABLE IF NOT EXISTS `oppurtunities` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lead_id` bigint(20) NOT NULL,
  `description` varchar(250) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `others` varchar(200) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `contact_person` varchar(25) NOT NULL,
  `designation` varchar(25) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `company` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lead_id` (`lead_id`),
  KEY `product_category_id` (`product_category_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `oppurtunities_comments`
--

CREATE TABLE IF NOT EXISTS `oppurtunities_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `comments` varchar(350) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `oppurtunity_status`
--

CREATE TABLE IF NOT EXISTS `oppurtunity_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) NOT NULL,
  `enable` tinyint(4) NOT NULL,
  `sortorder` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `oppurtunity_status`
--

INSERT INTO `oppurtunity_status` (`id`, `status`, `enable`, `sortorder`) VALUES
(2, 'status', 1, 11),
(3, 'statusss', 1, 22),
(4, 'statusssss', 0, 444);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `description` varchar(50) NOT NULL,
  `watt` int(11) NOT NULL,
  `inputvoltage` int(11) NOT NULL,
  `outputvoltage` int(11) NOT NULL,
  `outputcurrent` int(11) NOT NULL,
  `efficiency` int(11) NOT NULL,
  `l` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `h` int(11) NOT NULL,
  `packquantity` int(11) NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `description`, `watt`, `inputvoltage`, `outputvoltage`, `outputcurrent`, `efficiency`, `l`, `b`, `h`, `packquantity`, `remarks`) VALUES
(9, '001000', 'testtest', 1, 1, 1, 1, 1, 1, 1, 1, 1, 'testtest'),
(10, '002000', 'testtess', 2, 2, 2, 2, 2, 2, 2, 2, 2, 'testtest'),
(11, '003000', 'testtest', 3, 3, 3, 3, 3, 3, 3, 3, 3, 'testtest'),
(12, '003001', 'testtest4', 4, 4, 4, 4, 4, 4, 4, 4, 4, 'tetsttesttes'),
(13, '001001', 'tttttttttttt', 2, 2, 2, 22, 2, 2, 2, 2, 2, 'ttttttttttttt'),
(14, '002001', 'eeeee', 3, 3, 3, 3, 3, 3, 3, 3, 3, 'eeeeeee');

-- --------------------------------------------------------

--
-- Table structure for table `productbom`
--

CREATE TABLE IF NOT EXISTS `productbom` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `productid` bigint(20) NOT NULL,
  `rawmaterialid` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `reference` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productid` (`productid`),
  KEY `rawmaterialid` (`rawmaterialid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `productbom`
--

INSERT INTO `productbom` (`id`, `productid`, `rawmaterialid`, `quantity`, `reference`) VALUES
(11, 9, 7, 1, '1'),
(12, 10, 8, 2, '2'),
(13, 11, 9, 3, '3'),
(14, 9, 7, 4, '4'),
(15, 10, 8, 5, '5'),
(17, 11, 9, 6, '6'),
(18, 12, 7, 2, '2'),
(19, 12, 9, 2, '2'),
(20, 12, 8, 2, '2');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productcategory` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `productcategory`) VALUES
(2, 'products'),
(3, 'productsss'),
(4, 'productssseee');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `prefix` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `name`, `prefix`) VALUES
(5, 'driver1', '001'),
(6, 'driver2', '002'),
(7, 'driver3', '003');

-- --------------------------------------------------------

--
-- Table structure for table `rawmaterial`
--

CREATE TABLE IF NOT EXISTS `rawmaterial` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `materialcode` varchar(20) NOT NULL,
  `categorynumber` varchar(10) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `partnumber` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `tax` varchar(25) NOT NULL,
  `minquantity` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryid` (`categoryid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `rawmaterial`
--

INSERT INTO `rawmaterial` (`id`, `materialcode`, `categorynumber`, `categoryid`, `partnumber`, `description`, `tax`, `minquantity`) VALUES
(7, 'MS', '001', 6, '11111111', 'testtest', '14', 2),
(8, 'Brass', '002', 7, '22222222', 'testtest', '14', 3),
(9, 'ferros', '003', 8, '3333333333', 'testtest', '15', 4);

-- --------------------------------------------------------

--
-- Table structure for table `rawmaterialassignment`
--

CREATE TABLE IF NOT EXISTS `rawmaterialassignment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendorid` bigint(20) NOT NULL,
  `rawmaterialid` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vendorid` (`vendorid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rawmaterialassignment`
--

INSERT INTO `rawmaterialassignment` (`id`, `vendorid`, `rawmaterialid`) VALUES
(2, 7, '9.8'),
(3, 6, '9.8.7'),
(4, 5, '8.7');

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE IF NOT EXISTS `reference` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `reference` varchar(20) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reference`
--

INSERT INTO `reference` (`id`, `reference`, `mobile`, `address`) VALUES
(2, 'reference', 1111111111, 'testtest'),
(3, 'referenceq', 2222222222, 'teststestset'),
(4, 'referessa', 3333333333, 'testtest');

-- --------------------------------------------------------

--
-- Table structure for table `reference_group`
--

CREATE TABLE IF NOT EXISTS `reference_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `reference_group`
--

INSERT INTO `reference_group` (`id`, `name`) VALUES
(2, 'ref2'),
(3, 'ref4');

-- --------------------------------------------------------

--
-- Table structure for table `salesorder_status`
--

CREATE TABLE IF NOT EXISTS `salesorder_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_status` varchar(20) NOT NULL,
  `enabled` tinyint(4) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `salesorder_status`
--

INSERT INTO `salesorder_status` (`id`, `sales_status`, `enabled`, `sort_order`) VALUES
(4, 'aaa', 1, 3333),
(5, 'ww', 1, 1234);

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE IF NOT EXISTS `sales_order` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `oppurtunity_id` bigint(20) NOT NULL,
  `po_number` varchar(15) NOT NULL,
  `approved_by` bigint(20) NOT NULL,
  `status_id` int(11) NOT NULL,
  `comments` varchar(250) NOT NULL,
  `shipping_address` varchar(200) NOT NULL,
  `billing_address` varchar(200) NOT NULL,
  `courier_by_id` int(11) NOT NULL,
  `is_self_pay` tinyint(4) NOT NULL,
  `is_customer_pay` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `oppurtunity_id` (`oppurtunity_id`),
  KEY `courier_by_id` (`courier_by_id`),
  KEY `approved_by` (`approved_by`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `samples`
--

CREATE TABLE IF NOT EXISTS `samples` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lead_id` bigint(20) NOT NULL,
  `oppurtunity_id` bigint(20) NOT NULL,
  `specification` varchar(250) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `company` varchar(50) NOT NULL,
  `contact_person` varchar(25) NOT NULL,
  `designation` varchar(25) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `assigned_to` varchar(25) NOT NULL,
  `sample_prize` double NOT NULL,
  `no_of_samples` bigint(20) NOT NULL,
  `follow_up` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lead_id` (`lead_id`),
  KEY `oppurtunity_id` (`oppurtunity_id`),
  KEY `product_category_id` (`product_category_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `batchid` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitprice` float NOT NULL,
  `amount` float NOT NULL,
  `taxid` int(11) NOT NULL,
  `taxamount` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `batchid` (`batchid`),
  KEY `taxid` (`taxid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `batchid`, `quantity`, `unitprice`, `amount`, `taxid`, `taxamount`) VALUES
(11, 9, 1, 1, 1, 13, 0.0454545),
(12, 10, 2, 2, 4, 14, 0.121212),
(13, 11, 1, 1, 1, 13, 0.0454545),
(14, 12, 23, 23, 529, 14, 16.0303),
(15, 13, 112, 1, 112, 15, 2.03636);

-- --------------------------------------------------------

--
-- Table structure for table `stockinventory`
--

CREATE TABLE IF NOT EXISTS `stockinventory` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `invoiceid` bigint(20) NOT NULL,
  `batchid` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitprice` float NOT NULL,
  `amount` float NOT NULL,
  `taxid` int(11) NOT NULL,
  `taxamount` float NOT NULL,
  `locationid` bigint(20) NOT NULL,
  `inspection` tinyint(4) NOT NULL,
  `inspectionquantity` bigint(20) NOT NULL,
  `inspectedby` bigint(20) NOT NULL,
  `datetime` datetime NOT NULL,
  `status` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoiceid` (`invoiceid`),
  KEY `batchid` (`batchid`),
  KEY `taxid` (`taxid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `stockinventory`
--

INSERT INTO `stockinventory` (`id`, `invoiceid`, `batchid`, `quantity`, `unitprice`, `amount`, `taxid`, `taxamount`, `locationid`, `inspection`, `inspectionquantity`, `inspectedby`, `datetime`, `status`) VALUES
(11, 10, 9, 1, 1, 1, 13, 0.0454545, 6, 0, 0, 0, '0000-00-00 00:00:00', ''),
(12, 10, 10, 2, 2, 4, 14, 0.121212, 5, 0, 0, 0, '0000-00-00 00:00:00', ''),
(13, 11, 11, 1, 1, 1, 13, 0.0454545, 7, 0, 0, 0, '0000-00-00 00:00:00', ''),
(14, 12, 12, 23, 23, 529, 14, 16.0303, 7, 0, 0, 0, '0000-00-00 00:00:00', ''),
(15, 12, 13, 112, 1, 112, 15, 2.03636, 5, 0, 0, 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `stockissuance`
--

CREATE TABLE IF NOT EXISTS `stockissuance` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `issuanceid` bigint(20) NOT NULL,
  `batchid` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitprice` float NOT NULL,
  `amount` float NOT NULL,
  `taxid` int(11) NOT NULL,
  `taxamount` float NOT NULL,
  `issuedto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `batchid` (`batchid`),
  KEY `taxid` (`taxid`),
  KEY `issuanceid` (`issuanceid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE IF NOT EXISTS `tax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `percent` float NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `type`, `percent`, `description`) VALUES
(13, 'TYPE1', 22, 'test'),
(14, 'TYPE2', 33, 'testtest'),
(15, 'TYPE3', 55, 'testtest');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `firstname`, `lastname`, `phone`, `userrole_id`) VALUES
(1, 'pentamine', '0101@pentamine', 'Pentamine', 'Pentamine', '9886910836', 1),
(2, 'admin', 'admin', 'admin', 'admin', '1234567891', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Super Admin'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendorid` varchar(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phonenumber` bigint(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contactperson` varchar(30) NOT NULL,
  `categoryid` varchar(20) NOT NULL,
  `creditlimit` bigint(20) NOT NULL,
  `creditperiodid` int(11) NOT NULL,
  `leadtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryid` (`categoryid`),
  KEY `creditperiodid` (`creditperiodid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `vendorid`, `name`, `address`, `phonenumber`, `email`, `contactperson`, `categoryid`, `creditlimit`, `creditperiodid`, `leadtime`) VALUES
(5, 'VIN0001', 'IBM', 'ssssss', 11111111111111, 'aced@gmai.com', 'test', '5.6.7', 44, 4, 4),
(6, 'VIN0002', 'TCS', 'uuuuuuuuuu', 22222222222222222, 'adcde@gmsil.com', 'etest', '6.7', 4, 4, 2),
(7, 'VIN0003', 'cts', 'sssssssssss', 33333333333333, 'aaaa@gmsail.com', 'testtest', '5.6', 45, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `vendorcategory`
--

CREATE TABLE IF NOT EXISTS `vendorcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `vendorcategory`
--

INSERT INTO `vendorcategory` (`id`, `name`) VALUES
(5, 'vendor 1'),
(6, 'vendor2'),
(7, 'vendor3');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batch`
--
ALTER TABLE `batch`
  ADD CONSTRAINT `batch_ibfk_2` FOREIGN KEY (`rawmaterialid`) REFERENCES `rawmaterial` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`vendorid`) REFERENCES `vendor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `leads`
--
ALTER TABLE `leads`
  ADD CONSTRAINT `leads_ibfk_4` FOREIGN KEY (`industry_category_id`) REFERENCES `industry_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `leads_ibfk_1` FOREIGN KEY (`reference_group_id`) REFERENCES `reference_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `leads_ibfk_2` FOREIGN KEY (`vendor_category_id`) REFERENCES `vendorcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `leads_ibfk_3` FOREIGN KEY (`reference_id`) REFERENCES `reference` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `oppurtunities`
--
ALTER TABLE `oppurtunities`
  ADD CONSTRAINT `oppurtunities_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `oppurtunities_ibfk_1` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `oppurtunities_ibfk_2` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `oppurtunities_comments`
--
ALTER TABLE `oppurtunities_comments`
  ADD CONSTRAINT `oppurtunities_comments_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `salesorder_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `productbom`
--
ALTER TABLE `productbom`
  ADD CONSTRAINT `productbom_ibfk_3` FOREIGN KEY (`productid`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productbom_ibfk_4` FOREIGN KEY (`rawmaterialid`) REFERENCES `rawmaterial` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rawmaterial`
--
ALTER TABLE `rawmaterial`
  ADD CONSTRAINT `rawmaterial_ibfk_2` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD CONSTRAINT `sales_order_ibfk_4` FOREIGN KEY (`approved_by`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sales_order_ibfk_1` FOREIGN KEY (`oppurtunity_id`) REFERENCES `oppurtunities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sales_order_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `salesorder_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sales_order_ibfk_3` FOREIGN KEY (`courier_by_id`) REFERENCES `couriers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `samples`
--
ALTER TABLE `samples`
  ADD CONSTRAINT `samples_ibfk_4` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `samples_ibfk_1` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `samples_ibfk_2` FOREIGN KEY (`oppurtunity_id`) REFERENCES `oppurtunities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `samples_ibfk_3` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_4` FOREIGN KEY (`batchid`) REFERENCES `batch` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stock_ibfk_5` FOREIGN KEY (`taxid`) REFERENCES `tax` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stockinventory`
--
ALTER TABLE `stockinventory`
  ADD CONSTRAINT `stockinventory_ibfk_5` FOREIGN KEY (`invoiceid`) REFERENCES `invoice` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stockinventory_ibfk_6` FOREIGN KEY (`batchid`) REFERENCES `batch` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stockinventory_ibfk_7` FOREIGN KEY (`taxid`) REFERENCES `tax` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stockissuance`
--
ALTER TABLE `stockissuance`
  ADD CONSTRAINT `stockissuance_ibfk_5` FOREIGN KEY (`issuanceid`) REFERENCES `issuance` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stockissuance_ibfk_6` FOREIGN KEY (`batchid`) REFERENCES `batch` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stockissuance_ibfk_7` FOREIGN KEY (`taxid`) REFERENCES `tax` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`userrole_id`) REFERENCES `user_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `vendor_ibfk_3` FOREIGN KEY (`creditperiodid`) REFERENCES `creditperiod` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
