-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 14, 2014 at 12:57 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `semtronics_erp`
--
CREATE TABLE `productbom_versioning` (
  `id` bigint(20) NOT NULL auto_increment,
  `productcategory_id` bigint(20) NOT NULL,
  `productsubcategory_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `reference` bigint(20) NOT NULL,
  `comments` varchar(50) NOT NULL,
  `versions` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------
--
-- Table structure for table `kitting`
--
CREATE TABLE `kitting` (
  `id` int(11) NOT NULL auto_increment,
  `kittingname` varchar(30) NOT NULL,
  `productcode` varchar(20) NOT NULL,
  `rawmeterialcode` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `reference` int(11) NOT NULL,
  `partnumber` varchar(35) NOT NULL,
  `unitcost` float NOT NULL,
  `total` float NOT NULL,
  `stock` int(11) NOT NULL,
  `kittingquantity` int(11) NOT NULL,
  `totalprice` int(11) NOT NULL,
  `vendorname` varchar(35) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
--
-- Table structure for table `approver`
--

CREATE TABLE IF NOT EXISTS `approver` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `module` varchar(25) NOT NULL,
  `approver` varchar(25) NOT NULL,
  `user` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `prefix` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clientcategory`
--

CREATE TABLE IF NOT EXISTS `clientcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientcategory` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE IF NOT EXISTS `couriers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `couriers` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `creditperiod`
--

CREATE TABLE IF NOT EXISTS `creditperiod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `period` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `industry_category`
--

CREATE TABLE IF NOT EXISTS `industry_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inhouse_categories`
--

CREATE TABLE IF NOT EXISTS `inhouse_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inhouse_status`
--

CREATE TABLE IF NOT EXISTS `inhouse_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `internal_po`
--

CREATE TABLE IF NOT EXISTS `internal_po` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inhouse_categoryid` int(11) NOT NULL,
  `requirement_specification` varchar(100) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `cost` bigint(20) NOT NULL,
  `user` varchar(11) NOT NULL,
  `inhouse_statusid` int(11) DEFAULT NULL,
  `approval` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inhouse_categoryid` (`inhouse_categoryid`),
  KEY `status` (`inhouse_statusid`),
  KEY `inhouse_statusid` (`inhouse_statusid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `client_category_id` int(20) NOT NULL,
  `reference_id` bigint(20) NOT NULL,
  `reference_group_id` bigint(20) NOT NULL,
  `industry_category_id` int(11) NOT NULL,
  `add_to_account` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_category_id` (`client_category_id`),
  KEY `industry_category_id` (`industry_category_id`),
  KEY `reference_id` (`reference_id`),
  KEY `reference_group_id` (`reference_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Table structure for table `leadscomments`
--

CREATE TABLE IF NOT EXISTS `leadscomments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `leadid` bigint(20) NOT NULL,
  `commentsdate` datetime NOT NULL,
  `comments` varchar(50) NOT NULL,
  `followupdate` date NOT NULL,
  `updatedby` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `oppurtunities`
--

CREATE TABLE IF NOT EXISTS `oppurtunities` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lead_id` bigint(20) NOT NULL,
  `description` varchar(250) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_subcategory_id` int(11) NOT NULL,
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
  KEY `product_id` (`product_id`),
  KEY `product_subcategory_id` (`product_subcategory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `oppurtunities_comments`
--

CREATE TABLE IF NOT EXISTS `oppurtunities_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) NOT NULL,
  `oppurtunities_id` bigint(20) NOT NULL,
  `amount` double NOT NULL,
  `comments` varchar(350) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status_id` (`status_id`),
  KEY `oppurtunities_id` (`oppurtunities_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subcategory_id` int(11) NOT NULL,
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
  PRIMARY KEY (`id`),
  KEY `subcategory_id` (`subcategory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `productbom`
--

CREATE TABLE IF NOT EXISTS `productbom` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `productcategory_id` bigint(20) NOT NULL,
  `productsubcategory_id` bigint(20) NOT NULL,
  `productid` bigint(20) NOT NULL,
  `rawmaterialid` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `reference` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productid` (`productid`),
  KEY `rawmaterialid` (`rawmaterialid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productcategory` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_subcategory`
--

CREATE TABLE IF NOT EXISTS `product_subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `prefix` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reference_group`
--

CREATE TABLE IF NOT EXISTS `reference_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `saleorder_comments`
--

CREATE TABLE IF NOT EXISTS `saleorder_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `comment_date` datetime NOT NULL,
  `status_id` bigint(20) NOT NULL,
  `comments` text NOT NULL,
  `updatedby` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status_id` (`status_id`,`updatedby`),
  KEY `updatedby` (`updatedby`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE IF NOT EXISTS `sales_order` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lead_id` bigint(20) NOT NULL,
  `oppurtunity_id` bigint(20) NOT NULL,
  `po_number` varchar(15) NOT NULL,
  `approved_id` bigint(20) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `comments` varchar(250) NOT NULL,
  `shipping_address` varchar(200) NOT NULL,
  `billing_address` varchar(200) NOT NULL,
  `courier_by_id` int(11) NOT NULL,
  `is_self_or_customer_pay` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `oppurtunity_id` (`oppurtunity_id`),
  KEY `courier_by_id` (`courier_by_id`),
  KEY `status_id` (`status_id`),
  KEY `approved_id` (`approved_id`),
  KEY `lead_id` (`lead_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_approval`
--

CREATE TABLE IF NOT EXISTS `sales_order_approval` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sales_order_id` bigint(20) NOT NULL,
  `approved_by` bigint(20) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_order_id` (`sales_order_id`),
  KEY `approved_by` (`approved_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `product_subcategory_id` int(11) NOT NULL,
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
  KEY `product_id` (`product_id`),
  KEY `product_subcategory_id` (`product_subcategory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendorid` varchar(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phonenumber` bigint(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contactperson` varchar(30) NOT NULL,
  `categoryid` varchar(20) NOT NULL,
  `creditlimit` bigint(20) NOT NULL,
  `creditperiodid` int(11) NOT NULL,
  `leadtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryid` (`categoryid`),
  KEY `creditperiodid` (`creditperiodid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendorcategory`
--

CREATE TABLE IF NOT EXISTS `vendorcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approver`
--
ALTER TABLE `approver`
  ADD CONSTRAINT `approver_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `batch`
--
ALTER TABLE `batch`
  ADD CONSTRAINT `batch_ibfk_2` FOREIGN KEY (`rawmaterialid`) REFERENCES `rawmaterial` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `internal_po`
--
ALTER TABLE `internal_po`
  ADD CONSTRAINT `internal_po_ibfk_1` FOREIGN KEY (`inhouse_categoryid`) REFERENCES `inhouse_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `internal_po_ibfk_2` FOREIGN KEY (`inhouse_statusid`) REFERENCES `inhouse_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`vendorid`) REFERENCES `vendor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `leads`
--
ALTER TABLE `leads`
  ADD CONSTRAINT `leads_ibfk_1` FOREIGN KEY (`reference_group_id`) REFERENCES `reference_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `leads_ibfk_2` FOREIGN KEY (`client_category_id`) REFERENCES `clientcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `leads_ibfk_3` FOREIGN KEY (`reference_id`) REFERENCES `reference` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `leads_ibfk_4` FOREIGN KEY (`industry_category_id`) REFERENCES `industry_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `oppurtunities`
--
ALTER TABLE `oppurtunities`
  ADD CONSTRAINT `oppurtunities_ibfk_1` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `oppurtunities_ibfk_2` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `oppurtunities_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `oppurtunities_ibfk_4` FOREIGN KEY (`product_subcategory_id`) REFERENCES `product_subcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `oppurtunities_comments`
--
ALTER TABLE `oppurtunities_comments`
  ADD CONSTRAINT `oppurtunities_comments_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `oppurtunity_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `oppurtunities_comments_ibfk_2` FOREIGN KEY (`oppurtunities_id`) REFERENCES `oppurtunities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`subcategory_id`) REFERENCES `product_subcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `productbom`
--
ALTER TABLE `productbom`
  ADD CONSTRAINT `productbom_ibfk_4` FOREIGN KEY (`rawmaterialid`) REFERENCES `rawmaterial` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productbom_ibfk_5` FOREIGN KEY (`productid`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_subcategory`
--
ALTER TABLE `product_subcategory`
  ADD CONSTRAINT `product_subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rawmaterial`
--
ALTER TABLE `rawmaterial`
  ADD CONSTRAINT `rawmaterial_ibfk_2` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rawmaterialassignment`
--
ALTER TABLE `rawmaterialassignment`
  ADD CONSTRAINT `rawmaterialassignment_ibfk_1` FOREIGN KEY (`vendorid`) REFERENCES `vendor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `saleorder_comments`
--
ALTER TABLE `saleorder_comments`
  ADD CONSTRAINT `saleorder_comments_ibfk_1` FOREIGN KEY (`updatedby`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD CONSTRAINT `sales_order_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `salesorder_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sales_order_ibfk_3` FOREIGN KEY (`courier_by_id`) REFERENCES `couriers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sales_order_ibfk_4` FOREIGN KEY (`approved_id`) REFERENCES `sales_order_approval` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sales_order_ibfk_5` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sales_order_ibfk_6` FOREIGN KEY (`oppurtunity_id`) REFERENCES `oppurtunities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sales_order_approval`
--
ALTER TABLE `sales_order_approval`
  ADD CONSTRAINT `sales_order_approval_ibfk_1` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sales_order_approval_ibfk_2` FOREIGN KEY (`approved_by`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `samples`
--
ALTER TABLE `samples`
  ADD CONSTRAINT `samples_ibfk_1` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `samples_ibfk_2` FOREIGN KEY (`oppurtunity_id`) REFERENCES `oppurtunities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `samples_ibfk_3` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `samples_ibfk_4` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `samples_ibfk_5` FOREIGN KEY (`product_subcategory_id`) REFERENCES `product` (`subcategory_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
