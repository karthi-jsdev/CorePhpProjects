-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 28, 2014 at 05:23 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `number`, `rawmaterialid`) VALUES
(1, '5', 1),
(2, 'b003', 1),
(3, '222', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `prefix` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `prefix`) VALUES
(1, 'test', 'test'),
(2, 'test1', 'test1'),
(3, 'test2', 'test2'),
(4, 'test3', 'test3'),
(5, 'test4', 'test4');

-- --------------------------------------------------------

--
-- Table structure for table `creditperiod`
--

CREATE TABLE IF NOT EXISTS `creditperiod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `period` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `creditperiod`
--

INSERT INTO `creditperiod` (`id`, `period`) VALUES
(1, 5),
(2, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `vendorid`, `number`, `invoicedate`) VALUES
(2, 1, '1', '2014-03-03 00:00:00'),
(3, 2, '123', '2014-04-28 00:00:00'),
(4, 2, '232', '2014-04-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `issuance`
--

CREATE TABLE IF NOT EXISTS `issuance` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `number` varchar(20) NOT NULL,
  `issueddate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`) VALUES
(1, 'bombay'),
(2, 'delhi'),
(3, 'chennai'),
(4, 'bangalore');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `description`, `watt`, `inputvoltage`, `outputvoltage`, `outputcurrent`, `efficiency`, `l`, `b`, `h`, `packquantity`, `remarks`) VALUES
(1, '330000', '55', 55, 555, 55, 55, 555, 555, 555, 555, 555, 'testtest'),
(2, '330001', 'test', 5, 5, 5, 5, 43, 4, 4, 3, 43, 'geotrrcds'),
(3, '220000', '4', 4, 4, 4, 4, 4, 4, 4, 4, 4, 'power'),
(4, '110000', '7', 7, 7, 7, 7, 7, 7, 7, 7, 7, 'cloud'),
(5, '440000', '6', 6, 6, 6, 6, 6, 6, 6, 6, 6, 'cloud'),
(6, '440001', '1', 1, 1, 1, 1, 1, 1, 1, 1, 1, 'zeboba'),
(7, '330002', 'asd', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'vg'),
(8, '330003', 'fgh', 1, 1, 1, 1, 1, 1, 1, 1, 10, 'sdfsdf');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `productbom`
--

INSERT INTO `productbom` (`id`, `productid`, `rawmaterialid`, `quantity`, `reference`) VALUES
(1, 1, 1, 5555, '5555'),
(2, 2, 1, 555, '555'),
(3, 2, 1, 777, '777'),
(4, 3, 2, 666, '6666'),
(5, 3, 2, 777, '7777'),
(6, 3, 2, 5555555, '55555555555'),
(7, 3, 3, 666, '666'),
(8, 3, 3, 777, '777'),
(9, 4, 4, 888, '888'),
(10, 5, 5, 44, '444');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `prefix` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `name`, `prefix`) VALUES
(1, 'Geotracer', '330'),
(2, 'powermatrics', '220'),
(3, 'Cloudlogger', '110'),
(4, 'zeboba', '440');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `rawmaterial`
--

INSERT INTO `rawmaterial` (`id`, `materialcode`, `categorynumber`, `categoryid`, `partnumber`, `description`, `tax`, `minquantity`) VALUES
(1, 'ss', '1526', 1, 'test', 'testtesttest', '', 1),
(2, 'Brass', '001', 1, 'brasss', 'brasss', '', 1000),
(3, 'stainlesss', '002', 2, 'stainless', 'stainless', '7', 10200),
(4, 'copper', '003', 3, '003', 'copper', '', 0),
(5, 'ferros', '004', 4, '004', 'ferros', '', 0),
(6, 'manganese', '005', 5, 'manganese', 'manganese', '7', 58000);

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
(2, 4, '6.1.4'),
(3, 5, '3'),
(4, 2, '1.5.4');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `batchid`, `quantity`, `unitprice`, `amount`, `taxid`, `taxamount`) VALUES
(3, 1, 12, 12, 1, 6, 1),
(4, 2, 11, 11, 121, 6, 0.000001815),
(5, 3, 12321, 1, 12321, 6, 0.000184815);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `stockinventory`
--

INSERT INTO `stockinventory` (`id`, `invoiceid`, `batchid`, `quantity`, `unitprice`, `amount`, `taxid`, `taxamount`, `locationid`, `inspection`, `inspectionquantity`, `inspectedby`, `datetime`, `status`) VALUES
(3, 2, 1, 1, 12, 1, 6, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', ''),
(4, 3, 2, 11, 11, 121, 6, 0.000001815, 4, 0, 0, 0, '0000-00-00 00:00:00', ''),
(5, 4, 3, 12321, 1, 12321, 6, 0.000184815, 4, 0, 0, 0, '0000-00-00 00:00:00', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE IF NOT EXISTS `tax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `percent` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `type`, `percent`) VALUES
(6, 'qqqqqqqq', 66666700),
(7, 'yyyyyy', 88888),
(8, 'ooo', 99999),
(9, 'ccccc', 88888900);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Super Admin'),
(2, 'Admin');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `vendorid`, `name`, `address`, `phonenumber`, `email`, `contactperson`, `categoryid`, `creditlimit`, `creditperiodid`, `leadtime`) VALUES
(1, '1', 'TVS', 'SHOLINGHUR', 1234567890, 'abc@gmial.com', 'test', '1', 100, 1, 100),
(2, 'VIN0002', 'ozwalt', 'bangalore', 1234567898, 'abcd@ymail.com', 'kishore', '1', 123, 2, 415455),
(3, 'VIN0003', 'tata', 'bombay', 1234567898, 'acds@gmail.com', 'rajesh', '2', 123, 1, 0),
(4, 'VIN0004', 'mahindra', 'delhi', 1234567891, 'abcd@ymail.com', 'nanda', '3', 123, 1, 0),
(5, 'VIN0005', 'umesh', 'chennai', 1234567891, 'abcd@ymail.com', 'umesh', '1.2.3.4', 123, 2, 0),
(6, 'VIN0006', 'ggg', 'gg', 55555, 'gdfg@fgh.ygjyh', 'gggg', '2.3.4', 0, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `vendorcategory`
--

CREATE TABLE IF NOT EXISTS `vendorcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `vendorcategory`
--

INSERT INTO `vendorcategory` (`id`, `name`) VALUES
(1, 'Through Hole'),
(2, 'SMD'),
(3, 'Connectors'),
(4, 'Wires');

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
-- Constraints for table `rawmaterialassignment`
--
ALTER TABLE `rawmaterialassignment`
  ADD CONSTRAINT `rawmaterialassignment_ibfk_2` FOREIGN KEY (`vendorid`) REFERENCES `vendor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
