-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 19, 2013 at 10:44 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `assignee`
--

INSERT INTO `assignee` (`id`, `slno`, `name`) VALUES
(1, 1, 'Manjunath'),
(2, 2, 'Sankar'),
(9, 3, 'Prathik'),
(10, 4, 'rajesh');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `Categoryname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `Categoryname`) VALUES
(1, 'Zeboba'),
(2, 'Powermetrics');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `ptcid`, `cname`, `caddress`, `cemail`, `cnum1`, `cnum2`, `cpname1`, `cppos1`, `cpnum1`, `cpemail1`, `cpname2`, `cppos2`, `cpnum2`, `reference`, `cdate`) VALUES
(1, 'PTCID-001', 'hello', 'bangalore', 'aaaaa@gmail.com', '1111111111111111111', '222222222222222', 'abcdaa', 'aaaaaaaaaaaaaa', '69999999999999999', 'abcd@gmail.com', '', '', '', '', '2013-12-05'),
(2, 'PTCID-002', 'google', 'bangalroe', 'abcd@hmil.com', '8888888888888888', '8888888888888888', 'ppppppppppppppp', 'pppppppppppppppp', '9999999999999999', 'ppppp@hmail.com', '', '', '', '', '2013-12-05'),
(3, 'PTCID-003', 'sfgsdgsdfg', 'sdfgsdfgfsdgsdfgfsdg', 'a@gmail.com', '11111111111111111', '11111111111111111111111111111111', 'aaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaa', '2222222222222', 'a@gmail.com', '', '', '', '', '2013-12-09'),
(4, 'PTCID-004', 'padadaad', 'adlkadka', 'kkadka@gmail.com', '0982327323', '0240200240', 'MASDSDSD', 'DSDL', '0234356663', 'DFS', '', '', '', '', '2013-12-11'),
(5, 'PTCID-005', 'AKDADPKA', 'KADLALDADADADASDJA', 'ADADADK@GMIAL.COM', '1325545661', '1555555523', 'DFSFSFS', 'ASDSAFSF', '5555555555', '', '', '', '', '', '2013-12-11'),
(6, 'PTCID-006', 'padadad1111', 'asasdskkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkasddddddddassssssssssssssssssssseeeeeeeeeeeeeeee mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmiqwioqqqqqqqqqqqqqqqq', 'ajdadj@adadh.com', '987456985412111', '5825536635', 'dfjksfshfshfh', 'jakdakdhahk', '566646776111211', 'sdssfjk@AHDASJA1.COM', '', '', '', '', '2013-12-11'),
(7, 'PTCID-007', 'AKDADKQWRQE', 'KADADAD,ADDADKAADDKAL;;LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLCASDCCCCCCCDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', '123@GMIAL.COM', '131232234234', 'JFSFSFSF', 'FSFSFS', 'FSFS', 'DGDGDGDDDD', '', '', '', '', '', '2013-12-11'),
(8, 'PTCID-008', 'ETETRTER', 'ETERTETETERTER', '1W@SFSFFFFSFS.COM', '122222222222222', 'SSFSFSFSFS', 'SFSFFSF', 'FSFSFS', 'SFSSFSFSFSF', 'SFSFSF', 'TRETET', 'RTERTER', 'GF', 'ERTRE', '2013-12-11'),
(9, 'PTCID-009', 'WERER', 'EETE', 'ETET@GMAIL.COM', '555456951212', '23W1222``', 'EETTRTE', 'FETRET', '23121222222222', 'FKRFTER@GMAIL.COM', '', '', '', '', '2013-12-11');

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
  `quantity` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=162 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `ptclid`, `comment`, `cdate`, `fdate`, `status_id`, `amount`, `tax`, `total`, `enable`, `quantity`) VALUES
(1, 'PTLID-0001', 'dfg sdfg dfsg dsfg dg dfg sdfg dfsg sdfg sdfg sdfg gfhjkyu eetyu rtu 6yu e e<br>', '2013-12-02 09:30:08', '2013-12-02', 1, 5000, 14.5, 5725, 0, ''),
(2, 'PTLID-0002', '&nbsp;tgsergt trgh erthetyhetyu ryiui<br>', '2013-12-02 09:30:28', '2013-12-02', 2, 50000, 14.5, 57250, 1, ''),
(3, 'PTLID-0003', 'astr ywe tyty ty <br>', '2013-12-02 09:30:51', '2013-12-02', 3, 50000, 14.5, 57250, 0, ''),
(4, 'PTLID-0004', 'at serty rsy ttyhj j yj rjfyhj fjyui r jyk yk khm ddfgyuki ukyu ri tru tyyj yerytr tr ty uuirty yyedru reu jityu yjuyur ruyukuy urtuyuiryi ewerty tu yu tyjurj jkr8irt u ytiyui eu tyirue yuju yj yi kj mnh,oyom r7ur rui r <br>', '2013-12-02 09:31:35', '2013-12-03', 4, 500, 14.5, 572.5, 0, ''),
(5, 'PTLID-0005', 'a draert yert asert sert es tert y<br>', '2013-12-02 09:31:57', '2013-12-03', 5, 60000, 14.5, 68700, 1, ''),
(6, 'PTLID-0006', '4t we45 tery rery eryu tryu tru<br>', '2013-12-02 09:32:22', '2013-12-03', 6, 5000, 14.5, 5725, 1, ''),
(7, 'PTLID-0007', 'dfg s dg sdf sfgsdfg yui utyury ru r<br>', '2013-12-02 09:32:45', '2013-12-03', 7, 50000, 14.5, 57250, 0, ''),
(8, 'PTLID-0008', 'rwe twtrw ertwe rt ery ty wry e trey e <br>', '2013-12-02 09:33:10', '2013-12-03', 8, 5000, 14.5, 5725, 1, ''),
(9, 'PTLID-0009', 'w terter t ert wy fjuiyu uko tui iu uilu <br>', '2013-12-02 09:33:34', '2013-12-03', 9, 50000, 14.5, 57250, 0, ''),
(10, 'PTLID-00012', ',l[mk [<br>', '2013-12-02 09:49:20', '2013-12-08', 0, 0, 0, 0, 0, ''),
(11, 'PTLID-00012', 'hjiop', '2013-12-02 09:49:25', '2013-12-24', 0, 0, 0, 0, 0, ''),
(12, 'PTLID-00012', 'asdcfawefasdf saf aas sf s<br>', '2013-12-02 11:23:49', '2013-12-19', 4, 0, 0, 0, 1, ''),
(13, 'PTLID-00017', 'gcfj ghi gj fgj <br>', '2013-12-03 09:37:11', '0000-00-00', 0, 0, 0, 0, 0, ''),
(14, 'PTLID-00017', 'gfh dfhcgfh gdf hdfh fd<br>', '2013-12-03 09:37:25', '2013-12-23', 2, 5000, 12.36, 5618, 0, ''),
(15, 'PTLID-00017', 'gfh th tdhf <br>', '2013-12-03 09:37:43', '2013-12-23', 3, 5000, 14.5, 5725, 0, ''),
(16, 'PTLID-00018', '345345', '2013-12-03 11:22:24', '2013-12-11', 1, 345, 5.5, 363.975, 0, ''),
(17, 'PTLID-00020', 'weghsdvg <br>', '2013-12-03 05:17:12', '2013-12-03', 5, 55555555555, 14.5, 63611111110.475, 0, ''),
(18, 'PTLID-0009', 'gbhgfbg gf hf h fgh gh jhgfhj hjh <br>', '2013-12-03 05:18:26', '2013-12-20', 6, 66666, 14.5, 76332.57, 0, ''),
(19, 'PTLID-0009', 'dghdf fgh df gh gh dh df<br>', '2013-12-03 05:18:42', '2013-12-18', 4, 66666, 0, 76332.57, 0, ''),
(20, 'PTLID-00019', 'SDFSG SDFG SD GDFSG SDFGDG SDFG DFY DF SGSDFG SDFG SDFG SDFG <br>', '2013-12-04 10:36:13', '2013-12-17', 1, 555555, 12.36, 624221.598, 0, ''),
(21, 'PTLID-00019', 'SADF ASDF ASDF ASDF ASDF ASF ASGFAS DFGSDFG FDGSDF DFG SDGSDFG SDF GDSFG SDRG SDFGSDF GSDBDF <br>', '2013-12-04 10:36:31', '2013-12-17', 1, 56555, 12.36, 63545.198, 0, ''),
(22, 'PTLID-00019', 'SADF ASDF ASDF ASDF ASDF ASF ASGFAS DFGSDFG FDGSDF DFG SDGSDFG SDF GDSFG SDRG SDFGSDF GSDBDF <br>', '2013-12-04 10:36:36', '2013-12-17', 1, 56555, 12.36, 63545.198, 0, ''),
(23, 'PTLID-00019', 'SADF ASDF ASDF ASDF ASDF ASF ASGFAS DFGSDFG FDGSDF DFG SDGSDFG SDF GDSFG SDRG SDFGSDF GSDBDF <br>', '2013-12-04 10:36:37', '2013-12-17', 1, 56555, 12.36, 63545.198, 0, ''),
(24, 'PTLID-0003', 'EAWTR EWT TYESRT WERTR7, D HJJK, HJLTH SYN DY DT<br>', '2013-12-04 10:37:20', '2013-12-23', 1, 6000, 14.5, 6870, 0, ''),
(25, 'PTLID-0004', '&nbsp;WTRYRY ERTY RH GFT HGFDH <br>', '2013-12-04 10:37:52', '2013-12-17', 1, 56000, 14.5, 64120, 0, ''),
(26, 'PTLID-0009', 'FDSG DG DFG DFSG FSDH GHSG <br>', '2013-12-04 10:38:46', '2013-12-23', 8, 5555, 14.5, 6360.475, 1, ''),
(27, 'PTLID-00021', 'kl;km<br>', '2013-12-04 12:29:42', '2013-12-11', 3, 89, 5.5, 93.895, 0, ''),
(28, 'PTLID-00021', 'okpikojio', '2013-12-04 12:30:49', '2013-12-11', 1, 89, 0, 93.895, 0, ''),
(29, 'PTLID-00021', 'p[opop', '2013-12-04 12:31:07', '2013-12-11', 2, 89, 0, 93.895, 0, ''),
(30, 'PTLID-00017', 'jioijo', '2013-12-04 02:33:00', '2013-12-10', 4, 789, 12.36, 886.5204, 0, ''),
(31, 'PTLID-00017', 'tyutyu', '2013-12-04 02:37:03', '2013-12-03', 4, 456, 12.36, 512.3616, 0, ''),
(32, 'PTLID-0001', 'rtytrytry', '2013-12-04 04:28:36', '2013-12-02', 2, 5000, 0, 5725, 0, ''),
(33, 'PTLID-0001', 'rtytrytry', '2013-12-04 04:29:32', '2013-12-02', 2, 5000, 0, 5725, 0, ''),
(34, 'PTLID-0001', 'uyioio', '2013-12-04 04:29:51', '2013-12-02', 4, 5000, 0, 5725, 0, ''),
(35, 'PTLID-0001', 'uyioio', '2013-12-04 04:30:43', '2013-12-02', 4, 5000, 0, 5725, 0, ''),
(36, 'PTLID-0001', 'uyioio', '2013-12-04 04:32:25', '2013-12-02', 4, 5000, 0, 5725, 0, ''),
(37, 'PTLID-0001', 'uyioio', '2013-12-04 04:35:46', '2013-12-02', 4, 5000, 0, 5725, 1, ''),
(38, 'PTLID-00020', 'gsdfgsdfgsdf', '2013-12-04 05:17:24', '2013-12-03', 1, 500, 14.5, 572.5, 0, ''),
(39, 'PTLID-00021', 'dfgdfgdfg', '2013-12-04 05:50:45', '2013-12-11', 4, 89, 12.36, 100.0004, 0, ''),
(40, 'PTLID-00020', 'asdfa sfssd afa <br>', '2013-12-05 04:20:09', '2013-12-09', 3, 52, 12.36, 58.4272, 0, ''),
(41, 'PTLID-00010', 'fgsdf gsdg sdg sdg sdgf sgfs g<br>', '2013-12-05 04:20:59', '0000-00-00', 0, 0, 0, 0, 1, ''),
(42, 'PTLID-00021', 'sdf asfasd fasd fghs&nbsp; g<br>', '2013-12-05 04:54:27', '2013-12-17', 6, 896666, 14.5, 1026682.57, 0, ''),
(43, 'PTLID-00021', 'sdf asdfdghsh dfgf sdgsdfgsdfgjkdfg dfgkj shdfhgjksdfg fg dfhgjkdk dfghjksdf sgkdfkg hjklsg sdfgl shdj hgsld fhgjsdfh gjk sdfgkl hdfgj ghsfjkd sdf asdfdghsh dfgf sdgsdfgsdfgjkdfg dfgkj shdfhgjksdfg fg dfhgjkdk \r\ndfghjksdf sgkdfkg hjklsg sdfgl shdj hgsld fhgjsdfh gjk sdfgkl hdfgj \r\nghsfjkd kldgsfdgldfkgsdfghsdf asdfdghsh dfgf sdgsdfgsdfgjkdfg dfgkj shdfhgjksdfg fg dfhgjkdk \r\ndfghjksdf sgkdfkg hjklsg sdfgl shdj hgsld fhgjsdfh gjk sdfgkl hdfgj \r\nghsfjkd kldgsfdgldfkgsdfghsdf asdfdghsh dfgf sdgsdfgsdfgjkdfg dfgkj shdfhgjksdfg fg dfhgjkdk \r\ndfghjksdf sgkdfkg hjklsg sdfgl shdj hgsld fhgjsdfh gjk sdfgkl hdfgj \r\nghsfjkd kldgsfdgldfkgsdfghsdf asdfdghsh dfgf sdgsdfgsdfgjkdfg dfgkj shdfhgjksdfg fg dfhgjkdk \r\ndfghjksdf sgkdfkg hjklsg sdfgl shdj hgsld fhgjsdfh gjk sdfgkl hdfgj \r\nghsfjkd kldgsfdgldfkgsdfghsdf asdfdghsh dfgf sdgsdfgsdfgjkdfg dfgkj shdfhgjksdfg fg dfhgjkdk \r\ndfghjksdf sgkdfkg hjklsg sdfgl shdj hgsld fhgjsdfh gjk sdfgkl hdfgj \r\nghsfjkd kldgsfdgldfkgsdfghsdf asdfdghsh dfgf sdgsdfgsdfgjkdfg dfgkj shdfhgjksdfg fg dfhgjkdk \r\ndfghjksdf sgkdfkg hjklsg sdfgl shdj hgsld fhgjsdfh gjk sdfgkl hdfgj \r\nghsfjkd kldgsfdgldfkgsdfghsdf asdfdghsh dfgf sdgsdfgsdfgjkdfg dfgkj shdfhgjksdfg fg dfhgjkdk \r\ndfghjksdf sgkdfkg hjklsg sdfgl shdj hgsld fhgjsdfh gjk sdfgkl hdfgj \r\nghsfjkd kldgsfdgldfkgsdfghsdf asdfdghsh dfgf sdgsdfgsdfgjkdfg dfgkj shdfhgjksdfg fg dfhgjkdk \r\ndfghjksdf sgkdfkg hjklsg sdfgl shdj hgsld fhgjsdfh gjk sdfgkl hdfgj \r\nghsfjkd kldgsfdgldfkgsdfghsdf asdfdghsh dfgf sdgsdfgsdfgjkdfg dfgkj shdfhgjksdfg fg dfhgjkdk \r\ndfghjksdf sgkdfkg hjklsg sdfgl shdj hgsld fhgjsdfh gjk sdfgkl hdfgj \r\nghsfjkd kldgsfdgldfkgsdfghsdf asdfdghsh dfgf sdgsdfgsdfgjkdfg dfgkj shdfhgjksdfg fg dfhgjkdk \r\ndfghjksdf sgkdfkg hjklsg sdfgl shdj hgsld fhgjsdfh gjk sdfgkl hdfgj \r\nghsfjkd kldgsfdgldfkgsdfghsdf asdfdghsh dfgf sdgsdfgsdfgjkdfg dfgkj shdfhgjksdfg fg dfhgjkdk \r\ndfghjksdf sgkdfkg hjklsg sdfgl shdj hgsld fhgjsdfh gjk sdfgkl hdfgj \r\nghsfjkd kldgsfdgldfkgsdfghsdf asdfdghsh dfgf sdgsdfgsdfgjkdfg dfgkj shdfhgjksdfg fg dfhgjkdk \r\ndfghjksdf sgkdfkg hjklsg sdfgl shdj hgsld fhgjsdfh gjk sdfgkl hdfgj \r\nghsfjkd kldgsfdgldfkgsdfghsdf asdfdghsh dfgf sdgsdfgsdfgjkdfg dfgkj shdfhgjksdfg fg dfhgjkdk \r\ndfghjksdf sgkdfkg hjklsg sdfgl shdj hgsld fhgjsdfh gjk sdfgkl hdfgj \r\nghsfjkd kldgsfdgldfkgsdfghsdf asdfdghsh dfgf sdgsdfgsdfgjkdfg dfgkj shdfhgjksdfg fg dfhgjkdk \r\ndfghjksdf sgkdfkg hjklsg sdfgl shdj hgsld fhgjsdfh gjk sdfgkl hdfgj \r\nghsfjkd kldgsfdgldfkgsdfghsdf asdfdghsh dfgf sdgsdfgsdfgjkdfg dfgkj shdfhgjksdfg fg dfhgjkdk \r\ndfghjksdf sgkdfkg hjklsg sdfgl shdj hgsld fhgjsdfh gjk sdfgkl hdfgj \r\nghsfjkd kldgsfdgldfkgsdfghkldgsfdgldfkgsdfgh<br>', '2013-12-05 04:54:52', '2013-12-17', 6, 8966665666, 12.36, 10074945542.3176, 0, ''),
(44, 'PTLID-00021', 'gf dhgfh dfh gfhdfh d gfdhggfhj fghj gfj<br>', '2013-12-05 05:05:45', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(45, 'PTLID-00021', 'ghjkgkghkgkghjkhjkjkkjgkhjk', '2013-12-05 05:10:34', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(46, 'PTLID-00021', '<br>', '2013-12-05 05:15:55', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(47, 'PTLID-00021', 'dghd fh fdh <br>', '2013-12-05 05:16:15', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(48, 'PTLID-00021', 'adsfasfasdfa', '2013-12-05 05:18:07', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(49, 'PTLID-00021', 'zxcvzxcvvzcvzxcvzxcvzxcvzxcvzxcvzxvczxvzxv', '2013-12-05 05:20:17', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(50, 'PTLID-00021', 'zxcvzxcvvzcvzxcvzxcvzxcvzxcvzxcvzxvczxvzxv', '2013-12-05 05:21:50', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(51, 'PTLID-00021', 'zxcvzxcvvzcvzxcvzxcvzxcvzxcvzxcvzxvczxvzxv', '2013-12-05 05:21:51', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(52, 'PTLID-00021', 'zxcvzxcvvzcvzxcvzxcvzxcvzxcvzxcvzxvczxvzxv', '2013-12-05 05:21:52', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(53, 'PTLID-00021', 'zxcvzxcvvzcvzxcvzxcvzxcvzxcvzxcvzxvczxvzxv', '2013-12-05 05:21:53', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(54, 'PTLID-00021', 'zxcvzxcvvzcvzxcvzxcvzxcvzxcvzxcvzxvczxvzxv', '2013-12-05 05:21:53', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(55, 'PTLID-00021', 'zxcvzxcvvzcvzxcvzxcvzxcvzxcvzxcvzxvczxvzxv', '2013-12-05 05:21:54', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(56, 'PTLID-00021', 'zxcvzxcvvzcvzxcvzxcvzxcvzxcvzxcvzxvczxvzxv', '2013-12-05 05:22:09', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(57, 'PTLID-00021', 'zxcvzxcvvzcvzxcvzxcvzxcvzxcvzxcvzxvczxvzxv', '2013-12-05 05:22:11', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(58, 'PTLID-00021', 'zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc zxcvxzvxcvzxcvzxcvzxc zxcvc xcxzvc xc vzxcv xxcv zv xcvxzcvzxvxzcvklzxcjvzxcvnjzxckvzxc ', '2013-12-05 05:23:31', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(59, 'PTLID-00021', 'sfdgsdfgs d gdf gsdfg dfg sg sd', '2013-12-05 05:23:39', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(60, 'PTLID-00021', '<br>', '2013-12-05 05:24:47', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(61, 'PTLID-00021', 'fd gsdfg ds<br>', '2013-12-05 05:24:56', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(62, 'PTLID-00021', 'asdf asdf asdf asdf adfas', '2013-12-05 05:25:32', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(63, 'PTLID-00021', 'xcvxzcvxczvxckv zxcjkvkxchhkzxchvj\r\n\r\n\r\nzxcvgn zxhjvbnjzxcvkz\r\n\r\n\r\nzxcvjkzxghvjxbvmczx\r\nzxcvjkzxchvkhzjxcv', '2013-12-05 05:26:03', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(64, 'PTLID-00021', '	xcvxzcvxczvxckv zxcjkvkxchhkzxchvj zxcvgn zxhjvbnjzxcvkz zxcvjkzxghvjxbvmczx zxcvjkzxchvkhzjxcv\r\n\r\n\r\n\r\n\r\n\r\n	xcvxzcvxczvxckv zxcjkvkxchhkzxchvj zxcvgn zxhjvbnjzxcvkz zxcvjkzxghvjxbvmczx zxcvjkzxchvkhzjxcv\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n	xcvxzcvxczvxckv zxcjkvkxchhkzxchvj zxcvgn zxhjvbnjzxcvkz zxcvjkzxghvjxbvmczx zxcvjkzxchvkhzjxcv', '2013-12-05 05:26:21', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(65, 'PTLID-00021', 'xcvxzcvxczvxckv\r\nzxcjkvkxchhkzxchvj\r\nzxcvgn\r\nzxhjvbnjzxcvkz\r\nzxcvjkzxghvjxbvmczx\r\nzxcvjkzxchvkhzjxcv<br><br><br><br>xcvxzcvxczvxckv\r\nzxcjkvkxchhkzxchvj\r\nzxcvgn\r\nzxhjvbnjzxcvkz\r\nzxcvjkzxghvjxbvmczx\r\nzxcvjkzxchvkhzjxcv\r\n\r\n\r\n\r\n\r\n\r\n	<br><br><br><br><br>xcvxzcvxczvxckv\r\nzxcjkvkxchhkzxchvj\r\nzxcvgn\r\nzxhjvbnjzxcvkz\r\nzxcvjkzxghvjxbvmczx\r\nzxcvjkzxchvkhzjxcv\r\n\r\n\r\n\r\n\r\n\r\n	<br>', '2013-12-05 05:32:22', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(66, 'PTLID-00021', 'sdfgsdgfsdfgsdg', '2013-12-05 05:34:33', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(67, 'PTLID-00021', 'sdfgsdgsdgsdgsdfgsdggs', '2013-12-05 05:34:41', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(68, 'PTLID-00021', '			', '2013-12-05 05:43:03', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(69, 'PTLID-00021', '						<script language="javascript1.2">\r\n							generate_wysiwyg("comment")\r\n						</script>', '2013-12-05 05:43:04', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(70, 'PTLID-00021', '						<script language="javascript1.2">\r\n							generate_wysiwyg("comment")\r\n						</script>', '2013-12-05 05:43:05', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(71, 'PTLID-00021', 'rf sdfg fsgfs<br>', '2013-12-05 05:43:32', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(72, 'PTLID-00021', 'sdfgsdfgsd', '2013-12-05 05:45:01', '2013-12-17', 6, 8966665666, 0, 10074945542.3176, 0, ''),
(73, 'PTLID-00021', 'dfgsdgdfg', '2013-12-05 05:47:22', '0000-00-00', 0, 0, 0, 0, 0, ''),
(74, 'PTLID-00021', 'sgfsgsd', '2013-12-05 05:47:26', '0000-00-00', 0, 0, 0, 0, 0, ''),
(75, 'PTLID-00021', 'sdfgsgdgfsg', '2013-12-05 05:47:30', '0000-00-00', 0, 0, 0, 0, 0, ''),
(76, 'PTLID-00021', 'fgsgsgsgsfgssfgsdfgsdfgfsdgfgfgfsgdsgsdfgsdfgsdfgsfdgsdfgsgsdgdfsgfdgdfgdfgdf', '2013-12-05 05:47:41', '0000-00-00', 0, 0, 0, 0, 0, ''),
(77, 'PTLID-00021', 'sdgfsgfsdgsgfsdfgsgfsdfgsdfgdf', '2013-12-05 05:47:59', '0000-00-00', 0, 0, 0, 0, 0, ''),
(78, 'PTLID-00021', 'fdgsdfgsdfgsdfgsdfgsdfgsdfgdfgdfgfdgfdgsdfgsdfgsdfgsdfgsdfgsdfgdfgdfgfdgfdgsdfgsdfgsdfgsdfgsdfgsdfgdfgdfgfdgfdgsdfgsdfgsdfgsdfgsdfgsdfgdfgdfgfdgfdgsdfgsdfgsdfgsdfgsdfgsdfgdfgdfgfdgfdgsdfgsdfgsdfgsdfgsdfgsdfgdfgdfgfdg', '2013-12-05 05:48:09', '0000-00-00', 0, 0, 0, 0, 0, ''),
(79, 'PTLID-00021', 'gfs dgfsdgsdfgf sgfs gdf <br>', '2013-12-05 05:55:30', '0000-00-00', 0, 0, 0, 0, 0, ''),
(80, 'PTLID-00021', 'dfgsdfgdfgsdgdfgsdfgsdf', '2013-12-05 05:58:26', '0000-00-00', 0, 0, 0, 0, 0, ''),
(81, 'PTLID-00021', 'dfgsdfgdfgsdgdfgsdfgsdf', '2013-12-05 05:58:35', '0000-00-00', 0, 0, 0, 0, 0, ''),
(82, 'PTLID-00021', 'dfgsdfgdfgsdgdfgsdfgsdf', '2013-12-05 05:58:36', '0000-00-00', 0, 0, 0, 0, 0, ''),
(83, 'PTLID-00021', 'dfgsdfgdfgsdgdfgsdfgsdf', '2013-12-05 05:58:38', '0000-00-00', 0, 0, 0, 0, 0, ''),
(84, 'PTLID-00021', 'dfgsdfgdfgsdg', '2013-12-05 06:02:22', '0000-00-00', 0, 0, 0, 0, 0, ''),
(85, 'PTLID-00021', 'dfgsdgsdf gsdfgsdfgsdfgfdg<br>', '2013-12-05 06:14:37', '0000-00-00', 0, 0, 0, 0, 0, ''),
(86, 'PTLID-00021', 'sdfgsdgfsdgsdfgsdf sdfg sdgf sdg sdg <br>', '2013-12-05 06:15:36', '0000-00-00', 0, 0, 0, 0, 0, ''),
(87, 'PTLID-00021', 'sertst s<br>', '2013-12-05 06:16:41', '0000-00-00', 0, 0, 0, 0, 0, ''),
(88, 'PTLID-00021', 'fgndn', '2013-12-05 06:18:33', '0000-00-00', 0, 0, 0, 0, 0, ''),
(89, 'PTLID-00021', '<br>', '2013-12-05 06:20:20', '0000-00-00', 0, 0, 0, 0, 0, ''),
(90, 'PTLID-00021', 'ghgfhghdh', '2013-12-05 06:20:32', '0000-00-00', 0, 0, 0, 0, 0, ''),
(91, 'PTLID-00021', 'ghgfhghdh', '2013-12-05 06:21:35', '0000-00-00', 0, 0, 0, 0, 0, ''),
(92, 'PTLID-00021', 'dfsg df<br>', '2013-12-05 06:21:47', '0000-00-00', 0, 0, 0, 0, 0, ''),
(93, 'PTLID-00021', 'dfsg df<br>', '2013-12-05 06:23:45', '0000-00-00', 0, 0, 0, 0, 0, ''),
(94, 'PTLID-00021', 'dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg dfgtsdf gdfsg dfsg sdfg fdsg ', '2013-12-05 06:30:57', '0000-00-00', 0, 0, 0, 0, 0, ''),
(95, 'PTLID-00011', 'hjkhjkhjk', '2013-12-05 06:43:19', '2013-12-04', 1, 546, 5.5, 576.03, 0, ''),
(96, 'PTLID-00011', 'uytutyutyu', '2013-12-05 06:45:20', '2013-12-04', 4, 546, 14.5, 625.17, 0, ''),
(97, 'PTLID-00011', 'fghgfhg', '2013-12-05 06:45:56', '2013-12-04', 4, 546, 0, 625.17, 0, ''),
(98, 'PTLID-0003', 'zsdfg sf sdfg sdg sdg&nbsp; <br>', '2013-12-05 07:15:49', '2013-12-16', 5, 5555, 12.36, 6241.598, 1, ''),
(99, 'PTLID-00017', 'try rteytryeryrey <br>', '2013-12-05 07:16:09', '2013-12-03', 4, 456, 0, 512.3616, 1, ''),
(100, 'PTLID-0004', 'ftrh gf hgf hdfhdf<br>', '2013-12-07 04:16:32', '2013-12-17', 3, 555555555, 14.5, 636111110.475, 1, ''),
(101, 'PTLID-00020', 'gfdvadfsf', '2013-12-07 06:57:55', '2013-12-17', 2, 8888888888, 14.5, 10177777776.76, 0, ''),
(102, 'PTLID-00020', 'cvxbccvbxcvbxcvbxcvbxcvbcv', '2013-12-07 06:58:08', '2013-12-16', 6, 55555555555, 14.5, 63611111110.475, 0, ''),
(103, 'PTLID-00019', 'sdfgsdgsdfgdfgdfggsdfgdfg', '2013-12-07 06:58:31', '2013-12-10', 2, 8888888, 12.36, 9987554.5568, 0, ''),
(104, 'PTLID-00019', 'xfh gfh dghf h fdh gdfgh df<br>', '2013-12-09 09:56:23', '2013-12-12', 8, 55555555555, 12.36, 62422222221.598, 0, ''),
(105, 'PTLID-00020', 'qwer', '2013-12-09 10:22:37', '0000-00-00', 0, 0, 0, 0, 0, ''),
(106, 'PTLID-00020', 'asdfasdfasdfasdf', '2013-12-09 10:23:33', '2013-12-19', 9, 555555, 14.5, 636110.475, 1, ''),
(107, 'PTLID-00021', 't4bgtbtbgtbrvvf<br><br>fgn fvnbgfngh<br>', '2013-12-09 11:48:45', '0000-00-00', 3, 0, 0, 0, 0, ''),
(108, 'PTLID-00021', '&nbsp;zxcvcxv zxvxzvzxc&nbsp; ghdj gj gfhj fjjfgj fjgf<br>dfgdh<br><br><br><br><br>rtehdgdgd<br>', '2013-12-09 11:49:04', '0000-00-00', 3, 0, 0, 0, 0, ''),
(109, 'PTLID-00011', 'trdghsdfgsdfg', '2013-12-09 06:21:51', '2013-12-04', 7, 546, 0, 625.17, 0, ''),
(110, 'PTLID-00024', 'dfsgsfgsdf g dfsg sdfg <br><br><br><br>sdfgfsdgdfgsdfgsdfgsdfg<br><br>', '2013-12-09 07:16:58', '2013-12-17', 8, 55555555555, 12.36, 62422222221.598, 0, ''),
(111, 'PTLID-00026', 'dfxghxfgxc', '2013-12-10 10:08:50', '2013-12-09', 7, 66666, 12.36, 74905.9176, 0, ''),
(112, 'PTLID-00021', 'dtrydryhdfh', '2013-12-10 11:00:06', '2013-12-28', 7, 55555, 12.36, 62421.598, 0, ''),
(113, 'PTLID-00021', 'vbgvcxbcxvxbxcxcv xcv xcb xcvb <br>', '2013-12-10 03:34:11', '2013-12-31', 0, 5.555555555555555e18, 12.36, 6.242222222222222e18, 1, ''),
(114, 'PTLID-00026', 'sgfdgdgfsg', '2013-12-10 06:27:33', '2013-12-21', 0, 555555555, 14.5, 636111110.475, 0, ''),
(115, 'PTLID-00022', 'fxhgfhgfh', '2013-12-10 06:29:22', '2013-12-18', 0, 222222222, 14.5, 254444444.19, 0, ''),
(116, 'PTLID-00011', 'ggfhdhd', '2013-12-10 06:34:43', '2013-12-17', 0, 5465, 12.36, 6140.474, 1, ''),
(117, 'PTLID-00028', '[SSSSSSSSSSSSSSSFWSFSFKSFMSDFDSFSFSFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFSFSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKLSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSDDDDDDDDDDDDDDDDDDDDDDDDDFFFFFFFFFFFFFFFFFFFFFFFFFFFFFMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM', '2013-12-11 12:01:43', '2013-12-11', 0, 213131, 5.5, 224853.205, 0, ''),
(118, 'PTLID-00028', 'DASDASDSFSFSDSFS', '2013-12-11 01:09:48', '2013-12-11', 0, 213131, 0, 224853.205, 0, ''),
(119, 'PTLID-00022', 'QWERWERERWERWE', '2013-12-11 01:10:51', '2013-12-18', 0, 222222222, 0, 254444444.19, 1, ''),
(120, 'PTLID-00029', 'ADADASRASDFWFSF', '2013-12-11 01:12:34', '2013-12-11', 0, 312, 5.5, 329.16, 0, ''),
(121, 'PTLID-00028', '<img src="http://localhost/serviceprojects/Pentamine_CRM/icons/paste.gif" border="0" unselectable="on" title="Paste" id="Paste" class="button" width="20" height="20"><img src="http://localhost/serviceprojects/Pentamine_CRM/icons/cut.gif" border="0" unselectable="on" title="Cut" id="Cut" class="button" width="20" height="20"><img src="http://localhost/serviceprojects/Pentamine_CRM/icons/copy.gif" border="0" unselectable="on" title="Copy" id="Copy" class="button" width="20" height="20">', '2013-12-11 01:35:41', '2013-12-11', 0, 213131, 0, 224853.205, 0, ''),
(122, 'PTLID-00024', 'gyftyffjyt', '2013-12-12 02:17:17', '2013-12-19', 7, 55555555555, 14.5, 63611111110.475, 1, ''),
(123, 'PTLID-00029', 'dtrghddgh', '2013-12-12 06:08:59', '2013-12-11', 3, 312, 14.5, 357.24, 0, ''),
(124, 'PTLID-0007', 'jiolkl;kl', '2013-12-12 06:34:10', '2013-12-24', 7, 5555555, 12.36, 6242221.598, 1, ''),
(125, 'PTLID-00019', 'srwer', '2013-12-12 06:48:43', '2013-12-12', 7, 55555555555, 0, 62422222221.598, 1, ''),
(126, 'PTLID-00028', 'sadfasdfs', '2013-12-12 06:55:00', '2013-12-11', 4, 213131, 0, 224853.205, 0, ''),
(127, 'PTLID-00028', 'kl;j;/jlk/kjl/', '2013-12-13 09:44:34', '2013-12-11', 4, 213131, 0, 224853.205, 0, ''),
(128, 'PTLID-00026', 'sdfvgsdvgsdfvg', '2013-12-13 10:39:26', '2013-12-21', 4, 555555555, 12.36, 624222221.598, 1, ''),
(129, 'PTLID-00028', 'yfuhyjkgm', '2013-12-13 10:43:53', '2013-12-11', 4, 213131, 5.5, 224853.205, 1, ''),
(130, 'PTLID-00018', 'gfhd', '2013-12-13 10:56:36', '2013-12-23', 8, 34555, 14.5, 39565.475, 1, ''),
(131, 'PTLID-00029', 'tyhgfrbfrb', '2013-12-13 04:22:35', '2013-12-11', 3, 312, 14.5, 357.24, 0, ''),
(132, 'PTLID-00029', 'edcedc', '2013-12-13 04:22:41', '2013-12-11', 3, 312, 14.5, 357.24, 0, ''),
(133, 'PTLID-00029', 'edcedc dcdece<br>', '2013-12-13 04:22:54', '2013-12-11', 3, 312, 14.5, 357.24, 0, ''),
(134, 'PTLID-00029', 'edcedc dcdece<br>', '2013-12-13 04:23:34', '2013-12-11', 3, 312, 14.5, 357.24, 0, ''),
(135, 'PTLID-00029', 'v cfvffggzgfdfrzfe<br>', '2013-12-13 04:24:27', '2013-12-11', 3, 312, 14.5, 357.24, 0, ''),
(136, 'PTLID-00029', 'tet<br>ddddd<br>', '2013-12-13 04:24:56', '2013-12-10', 3, 312, 14.5, 357.24, 0, ''),
(137, 'PTLID-00029', '&amp;nbsp;bvb fbfb bfb fbf&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;nhgnxtnhgxcnhx&lt;br&gt;&lt;br&gt;jhyfjhhyfh nfhnhg&lt;br&gt;', '2013-12-13 04:25:27', '2013-12-10', 3, 312, 14.5, 357.24, 0, ''),
(138, 'PTLID-00029', 'cnhghdhdgt<br><br><br>bngfh xd xgfghxf<br>nhtnhcfthcc<br><br><br><br>htnnhtnhh<br>juyjmy<br><br>jymj<br>', '2013-12-13 04:25:50', '2013-12-10', 3, 312, 14.5, 357.24, 0, ''),
(139, 'PTLID-00027', 'dsffgsdfg d g sdgs dfgsdfg sdfg<br>', '2013-12-13 05:09:37', '2013-12-17', 8, 54555, 14.5, 62465.475, 0, ''),
(140, 'PTLID-00027', 'dsffgsdfg d g sdgs dfgsdfg sdfg<br>', '2013-12-13 05:10:34', '2013-12-17', 8, 54555, 14.5, 62465.475, 0, ''),
(141, 'PTLID-00027', 'dsffgsdfg d g sdgs dfgsdfg sdfg<br>', '2013-12-13 05:10:35', '2013-12-17', 8, 54555, 14.5, 62465.475, 0, ''),
(142, 'PTLID-00027', 'dsffgsdfg d g sdgs dfgsdfg sdfg<br>', '2013-12-13 05:11:04', '2013-12-17', 8, 54555, 14.5, 62465.475, 0, ''),
(143, 'PTLID-00027', 'dsffgsdfg d g sdgs dfgsdfg sdfg<br>', '2013-12-13 05:11:21', '2013-12-17', 8, 54555, 14.5, 62465.475, 0, ''),
(144, 'PTLID-00027', 'dsffgsdfg d g sdgs dfgsdfg sdfg<br>', '2013-12-13 05:11:22', '2013-12-17', 8, 54555, 14.5, 62465.475, 0, ''),
(145, 'PTLID-00027', 'dsffgsdfg d g sdgs dfgsdfg sdfg<br>', '2013-12-13 05:11:24', '2013-12-17', 8, 54555, 14.5, 62465.475, 0, ''),
(146, 'PTLID-00027', 'dsffgsdfg d g sdgs dfgsdfg sdfg<br>', '2013-12-13 05:11:51', '2013-12-17', 8, 54555, 14.5, 62465.475, 0, ''),
(147, 'PTLID-00027', 'dsffgsdfg d g sdgs dfgsdfg sdfg<br>', '2013-12-13 05:12:01', '2013-12-17', 8, 54555, 14.5, 62465.475, 0, ''),
(148, 'PTLID-00027', 'dsffgsdfg d g sdgs dfgsdfg sdfg<br>', '2013-12-13 05:13:00', '2013-12-17', 8, 54555, 14.5, 62465.475, 0, ''),
(149, 'PTLID-00027', 'dsffgsdfg d g sdgs dfgsdfg sdfg<br>', '2013-12-13 05:13:13', '2013-12-17', 8, 54555, 14.5, 62465.475, 0, ''),
(150, 'PTLID-00027', 'dsffgsdfg d g sdgs dfgsdfg sdfg<br>', '2013-12-13 05:13:42', '2013-12-17', 8, 54555, 14.5, 62465.475, 0, ''),
(151, 'PTLID-00027', 'dsffgsdfg d g sdgs dfgsdfg sdfg<br>', '2013-12-13 05:13:51', '2013-12-17', 8, 54555, 14.5, 62465.475, 0, ''),
(152, 'PTLID-00027', 'sdffgsdgdsfg', '2013-12-13 05:20:52', '2013-12-12', 2, 54555222, 14.5, 62465729.19, 0, '50000'),
(153, 'PTLID-00027', 'gfjgfhjgfjfgjgfj', '2013-12-13 05:21:56', '2013-12-09', 3, 545552, 12.36, 612982.2272, 1, '50'),
(154, 'PTLID-00029', 'ertgsdfgdg fadusoi ui<br>gfhfgh<br><br>gf<br>h<br>gf<br>', '2013-12-16 12:22:08', '2013-12-10', 3, 312, 14.5, 357.24, 0, ''),
(155, 'PTLID-00029', 'drty u<br><br><br><br><br><br><br>julohjbl<br><br>ertse tert<br>', '2013-12-16 12:33:07', '2013-12-10', 3, 312, 14.5, 357.24, 0, ''),
(156, 'PTLID-00029', 'sdfgsdg<br><br><br><br><br>fjkhjhgf<br><br><br><br>', '2013-12-16 12:46:50', '2013-12-27', 7, 31255, 14.5, 35786.975, 0, '5855'),
(157, 'PTLID-00029', 'sgdfg sdgfsdg dsfgsdf fg sg<br>', '2013-12-16 12:47:18', '2013-12-21', 3, 312, 14.5, 357.24, 0, '585500'),
(158, 'PTLID-00029', 'f dgl; jkadgf g<br><br><br>&nbsp;sdfg;lsd fkg;ksdfgmsdf g<br><br><br>&nbsp;sdfgl;sdigl;sdgs<br>slkg jklsdfg<br><br>sfd ljsgi fsgns fdg fs<br>', '2013-12-16 12:47:46', '2013-12-12', 1, 3125, 12.36, 3511.25, 0, '5555'),
(159, 'PTLID-00029', 'xc xz zxc zx zx z<br>', '2013-12-17 05:50:12', '2013-12-18', 4, 3125, 5.5, 3296.875, 0, '5555666'),
(160, 'PTLID-00029', 'sdfgsdfgsdfgdfsg', '2013-12-17 05:51:14', '2013-12-24', 6, 312555, 14.5, 357875.475, 0, '55'),
(161, 'PTLID-00029', 'sdfvsdgsd', '2013-12-17 05:53:11', '2013-12-24', 6, 312555, 14.5, 357875.475, 1, '55');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `empid`, `name`, `address`, `pnum`, `pemail`, `cemail`, `date`, `qualification`) VALUES
(1, 'PTEID-001', '', '', 0, '', '', '0000-00-00', ''),
(2, 'PTEID-002', '', '', 0, '', '', '0000-00-00', ''),
(3, 'PTEID-003', 'hjk', 'hjk', 78678, 'kjhk', 'hjkhj', '2013-12-02', 'hjk'),
(4, 'PTEID-004', 'hjkjkljkl', 'hjkkjljkl', 78678678678, 'kjhkjkljkl', 'hjkhjjkljkl', '2013-12-04', 'hjkjkljkl');

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
(1, 'PTFID-0001', '12/09/2013', 'Waterbill', '12', 'this is for \r\nthe purpose \r\n\r\nof testing', 'Cash', 'ack', 'inflow', '2013-12-02 12:42:47PM'),
(2, 'PTFID-0002', '12/11/2013', 'Salary', '20000', 'DGDGDFGDFG', 'Cash', 'GDGDG', 'inflow', '2013-12-11 03:30:43PM'),
(3, 'PTFID-0003', '12/11/2013', 'Salary', '32442', 'DGDGD', 'Cheque', 'DGDGD', 'outflow', '2013-12-11 03:31:07PM'),
(4, 'PTFID-0004', '12/17/2013', 'Waterbill', '8888888888', 'asdfasfasfasdfasf', 'Cheque', 'ACK', 'inflow', '2013-12-13 04:13:37PM'),
(5, 'PTFID-0005', '12/13/2013', 'Salary', '77', 'asdfasfs', 'InternetBanking', 'ghjghj', 'outflow', '2013-12-13 04:13:54PM'),
(6, 'PTFID-0006', '12/13/2013', 'Waterbill', '666666', '', 'Cheque', 'ach', 'outflow', '2013-12-13 04:21:21PM'),
(7, 'PTFID-0007', '12/13/2013', 'Salary', '44444', 'sdfsvgsdfvdfsvsdv&lt;br&gt;&lt;br&gt;sdfvsdfvsdfvsdvf&lt;br&gt;', 'Cash', '4444', 'outflow', '2013-12-13 04:21:37PM'),
(8, 'PTFID-0008', '12/13/2013', 'Waterbill', '4444', '', 'Cheque', 'sadfsd', 'outflow', '2013-12-13 04:21:54PM');

-- --------------------------------------------------------

--
-- Table structure for table `finance_description`
--

CREATE TABLE IF NOT EXISTS `finance_description` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `slno` int(255) NOT NULL,
  `description_name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `finance_description`
--

INSERT INTO `finance_description` (`id`, `slno`, `description_name`) VALUES
(1, 1, 'Rent'),
(2, 2, 'Waterbill'),
(3, 3, 'Salary'),
(4, 4, 'Electricity');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `lead`
--

INSERT INTO `lead` (`id`, `ptclid`, `cname`, `ldesc`, `ldate`, `ptype`, `pstype`, `assign`) VALUES
(4, 'PTLID-0004', 'PTCID-0021', ' etyet e ert yery eh b h yetyey', '2013-12-02', '3', '3', '9'),
(5, 'PTLID-0005', 'PTCID-0021', 'ye tryery r ey er tye jyj  etryw ywe wytwby wtywrtywerytr ywy yy trwy wywey ', '2013-12-02', '3', '3', '4'),
(6, 'PTLID-0006', 'PTCID-003', 'w ertwetwert wert wert ret wet wer twaer t sw', '2013-12-02', '4', '4', '2'),
(7, 'PTLID-0007', 'PTCID-0018', ' wtrrweterw wty ery rty wy trykhj ghj mj  tryu jyurjk rtnftm rty yu jj', '2013-12-02', '2', '2', '2'),
(8, 'PTLID-0008', 'PTCID-006', ' tyyu rjy jn  ngfhngfn gn fgn gf nfuyjf  f jh fgj ffhj fhj f', '2013-12-02', '1', '1', '2'),
(9, 'PTLID-0009', 'PTCID-0010', 'tr yuteh tyhr dhj f gfj ghj gkhl gjkl fn,jugykf g hukg ', '2013-12-02', '1', '1', '9'),
(10, 'PTLID-00010', 'PTCID-006', ' tyyu rjy jn  ngfhngfn gn fgn gf nfuyjf  f jh fgj ffhj fhj f', '2013-12-02', '1', '1', '2'),
(16, 'PTLID-00011', 'PTCID-001', 'sdfasdfasd', '2013-12-02', '1', '1', '1'),
(17, 'PTLID-00017', 'PTCID-002', 'asdfsdafa', '2013-12-02', '1', '1', '2'),
(18, 'PTLID-00018', 'PTCID-004', 'SDVZDFVZ', '2013-12-02', '4', '4', '2'),
(19, 'PTLID-00019', 'PTCID-006', 'SDFGDFG SDFG DG ', '2013-12-02', '4', '4', '3'),
(20, 'PTLID-00020', 'PTCID-003', 'rty', '2013-12-02', '2', '2', '1'),
(21, 'PTLID-00021', 'PTCID-001', 'y6gt5vft5g5bvrvrvfr vr', '2013-12-09', '1', '1', '1'),
(22, 'PTLID-00022', 'PTCID-001', 'rthdfhfdh', '2013-12-09', '3', '3', '2'),
(23, 'PTLID-00023', 'PTCID-001', 'hdfgfh', '2013-12-09', '3', '3', '4'),
(24, 'PTLID-00024', 'PTCID-001', 'retetretw', '2013-12-09', '3', '3', '4'),
(25, 'PTLID-00025', 'PTCID-001', 'dhdfghh', '2013-12-09', '3', '3', '4'),
(26, 'PTLID-00026', 'PTCID-001', 'dghgdfhfd', '2013-12-09', '2', '2', '4'),
(27, 'PTLID-00027', 'PTCID-004', 'FSDSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSRRRRRRRRRRRRRREV RRRRRRRRRRRRRRRRRRRRRRRRRWSSSSSSSSSSSSSSSSSSSSS', '2013-12-11', '1', '1', '3'),
(28, 'PTLID-00028', 'PTCID-008', 'EWWWWWWWWWWWWWWWWWWWWWWWWWWE222222222222222222222222222222222222222222224444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444EREEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE', '2013-12-11', '1', '1', '1'),
(29, 'PTLID-00029', 'PTCID-009', 'ASFSFFSS', '2013-12-11', '1', '1', '2');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `productsubtype`
--

INSERT INTO `productsubtype` (`id`, `slno`, `type`, `type_id`) VALUES
(1, 1, 'zeboba', 1),
(2, 2, 'Geotracer', 2),
(3, 3, 'Powermetrics', 3),
(4, 4, 'ServiceProducts', 4),
(5, 5, 'ZEB', 1),
(6, 6, '', 0);

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
(7, 4, 'Service Product');

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
  `recurring_frequency` text NOT NULL,
  `recurring_alertdate` varchar(50) NOT NULL,
  `recurring_status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `recurring`
--

INSERT INTO `recurring` (`id`, `recurring_id`, `recurring_createdate`, `recurring_client`, `recurring_product`, `recurring_subproduct`, `recurring_description`, `recurring_frequency`, `recurring_alertdate`, `recurring_status`) VALUES
(2, 'PTRID-001', '2013-12-07', 'PTCID-001', '1', '1', 'dfs gsdg dfgdf', '2-Month', '2', 'Enable'),
(3, 'PTRID-003', '2013-12-07', 'PTCID-002', '2', '2', 'sdfg dsgdfg sdfgsd', '4-Month', '4', 'Disable'),
(4, 'PTRID-004', '2013-12-09', 'PTCID-001', 'Select', 'Select', '', 'Select', 'Select', 'Select'),
(5, 'PTRID-005', '2013-12-09', 'PTCID-002', '4', '4', 'sdfgsdgsdfgdfsgsdfgdg', '9-Month', '9', 'Enable'),
(6, 'PTRID-006', '2013-12-10', 'PTCID-001', '3', 'Select', 'zxcvzxcv', '5-Month', '6', 'Enable'),
(7, 'PTRID-007', '2013-12-11', 'Select', 'Select', 'Select', '', 'Select', 'Select', 'Select'),
(8, 'PTRID-008', '2013-12-11', 'Select', 'Select', 'Select', '', 'Select', 'Select', 'Select'),
(9, 'PTRID-009', '2013-12-11', 'Select', 'Select', 'Select', '', 'Select', 'Select', 'Select'),
(10, 'PTRID-0010', '2013-12-11', 'PTCID-008', '1', '5', 'DMDG,DGJDFGNDGD', '3-Month', '4', 'Enable'),
(11, 'PTRID-0011', '2013-12-12', 'Select', 'Select', 'Select', '', '2-Month', '6', 'Enable'),
(12, 'PTRID-0012', '2013-12-12', 'Select', 'Select', 'Select', '', 'Select', 'Select', 'Select'),
(13, 'PTRID-0013', '2013-12-12', 'Select', 'Select', 'Select', '', 'Select', 'Select', 'Select'),
(14, 'PTRID-0014', '2013-12-12', 'Select', 'Select', 'Select', '', 'Select', 'Select', 'Select'),
(15, 'PTRID-0015', '2013-12-12', 'Select', 'Select', 'Select', '', '4-Month', '10', 'Enable'),
(16, 'PTRID-0016', '2013-12-12', 'PTCID-001', '3', '3', 'huiugkhrtyujruru', '4-Month', '7', 'Enable');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `taskid`, `taskdate`, `tdesc`, `tdate`, `assignee`, `tstatus`, `ptclid`) VALUES
(1, 'PTTKID-001', '2013-12-16', 'fsdg sfdg dfsg fdgdsfgdfsg sfdgsdfg sdfg sdfg&lt;br&gt;', '2013-12-18', 'Manjunath', '3', 'PTLID-00010'),
(2, 'PTTKID-002', '2013-12-16', 'fdg sdfgdffsdfgsdf gsdfg sdfgdfsg fsdgdfsg sgfd gsfgsdfgsdfgfsdg &lt;br&gt;', '2013-12-19', 'Manjunath', '3', 'PTLID-0004'),
(3, 'PTTKID-003', '2013-12-16', 'df gsdfg sfdg sdfgsdfg &lt;br&gt;', '2013-12-25', '9', 'Closed', 'PTLID-00023'),
(4, 'PTTKID-004', '2013-12-16', 'dsfg sdgsdfg&lt;br&gt;', '2013-12-16', 'Sankar', '4', 'PTLID-0006'),
(5, 'PTTKID-005', '2013-12-16', 'dfg sdg sdfgsdfg sdf&lt;br&gt;', '2013-12-09', 'Sankar', 'Closed', 'PTLID-00019'),
(6, 'PTTKID-006', '2013-12-17', 'asdfasfas fasdf asdf asd asd&lt;br&gt;', '2013-12-18', 'Sankar', '3', 'PTLID-0007');

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
  `tassignee` bigint(20) NOT NULL,
  `tleads` varchar(50) NOT NULL,
  `enable` bigint(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `taskcomments`
--

INSERT INTO `taskcomments` (`id`, `tskid`, `tcomments`, `tdate`, `tstatus`, `tassignee`, `tleads`, `enable`) VALUES
(1, 'PTTKID-001', 'FGDH FGH D FG<br>', '2013-12-18', 'Open', 1, '', 0),
(2, 'PTTKID-002', 'DGH DGH DGHGDF<br>', '2013-12-18', 'Open', 9, '', 0),
(3, 'PTTKID-003', 'DFGHFH DHG GGFHGDH DFHDFH D<br>', '2013-12-18', 'Open', 2, '', 0),
(4, 'PTTKID-004', 'DGH DGHD GFHDGGDF HG<br>', '2013-12-18', 'Open', 9, '', 0),
(5, 'PTTKID-005', 'DGH H DHD HGH<br>', '2013-12-18', 'Open', 9, '', 0),
(6, 'PTTKID-006', 'SDF SAF AF AF DASF<br>', '2013-12-25', 'Inprogress', 2, '', 0),
(7, 'PTTKID-007', 'ASDF ADSF ASDFAS FASF<br>', '2013-12-25', 'Inprogress', 9, '', 1),
(8, 'PTTKID-008', 'ASDF ASDF ADSF ASDF ADSF&nbsp; ASDF <br>', '2013-12-25', 'Inprogress', 2, '', 1),
(9, 'PTTKID-009', 'ASDF SAFASFSADF ASDF <br>', '2013-12-25', 'Inprogress', 9, '', 1),
(10, 'PTTKID-0010', 'ASD FASF ASDFA SDF ASFASFASF ASDF&nbsp; ASDF SDAFASDF<br>', '2013-12-25', 'Inprogress', 9, '', 1),
(11, 'PTTKID-0011', 'XZCVXZVXZVXZV', '2014-01-02', 'Reopened', 1, '', 1),
(12, 'PTTKID-0012', 'ZXCV ZXVZ XVZX ZXC<br>', '2014-01-02', 'Reopened', 1, '', 1),
(13, 'PTTKID-0013', 'VXCVXCV XZCV XZCV <br>', '2014-01-02', 'Reopened', 2, '', 1),
(14, 'PTTKID-0014', 'CVZVZXCV ZXV ZX VZXC <br>', '2014-01-03', 'Reopened', 9, '', 1),
(15, 'PTTKID-0015', 'ZXCV ZXVZXCV ZXVCZXV<br>', '2014-01-08', 'Reopened', 2, '', 1),
(16, 'PTTKID-0016', 'ZXCV ZVZ XV ZXCV<br>', '2014-01-08', 'Reopened', 2, '', 1),
(17, 'PTTKID-0031', 'dfgh dfh dfghdghdf<br>', '2013-12-10', 'Inprogress', 2, '', 1),
(18, 'PTTKID-001', 'dgh d gfdh<br>', '2013-12-18', 'Reopened', 1, '', 0),
(19, 'PTTKID-002', 'gfh&nbsp; sdfgsdfg<br>', '2013-12-18', 'Reopened', 2, '', 0),
(20, 'PTTKID-003', 'sdfg sdg sdfg sdfgsdfgsdfgsdfg<br>', '2013-12-19', 'Reopened', 2, '', 0),
(21, 'PTTKID-004', 'sdfg sdf gsdfg sdfg sdf gsdfg<br>', '2014-01-15', 'Reopened', 1, '', 1),
(22, 'PTTKID-005', 'sdf gsdfg fdsgdfg sdf<br>', '2013-12-28', 'Reopened', 2, '', 0),
(23, 'PTTKID-006', 'asd faf asdfasdf sadf asdf asdf<br>', '2013-12-11', 'Reopened', 10, '', 0),
(24, 'PTTKID-002', 'fzbdfbb sdf hsdffd gsdf gs<br>', '2013-12-20', 'Closed', 2, '', 1),
(25, 'PTTKID-001', 'dfgsd gsdf<br>', '2013-12-18', 'Closed', 1, '', 1),
(26, 'PTTKID-003', '&nbsp;rgsdrg dfg fgssfg s<br>', '2013-12-19', 'Closed', 2, '', 0),
(27, 'PTTKID-006', 'sfdsg sdgsdg ds g sd<br>', '2013-12-10', 'Closed', 1, '', 1),
(28, 'PTTKID-005', 'dfgsdf fg sdgf dsg dsfg sdfg sdfg sdfg dsgsdfg sdfg fsdg s<br><br><br>&nbsp;rthsfghsghgfhshg<br>r ea gsgdfgf<br>	ry rye tyr<br>bndf ghnd<br>', '2013-12-26', 'Closed', 0, '', 0),
(29, 'PTTKID-005', 'fg dh dfgh dh dfgh gfh dfgh dfg ghdfh dfghdf&nbsp; fgh d dgfh fhdgnhdgf hgdh dfgdfg gf hdh dh dhg ddh dfh dn<br><br>tgh dghgf<br><br>erg xdfghf <br><br>f sdfgsdf g<br>', '2013-12-18', 'Closed', 0, '', 0),
(30, 'PTTKID-005', 'sgf sfgdg sg fdgsdfgfsdg sdgsdgsg sgs dg&nbsp; sdgfsgsdfgsdfg<br>', '2013-12-18', 'Open', 0, '', 0),
(31, 'PTTKID-005', 'sdf gsf sdgf sdg sgf sg sg sgs&nbsp; fgsg fsdgf sgf sdg sdfgsdfg sdgfsdg fsdfg sdg<br>', '2013-12-24', 'Closed', 0, '', 1),
(32, 'PTTKID-003', '&nbsp;fasffsda fasdf asf asdf<br>', '2013-12-18', 'Open', 10, '', 0),
(33, 'PTTKID-003', 'asdf asdf asdf<br>', '2013-12-19', 'Closed', 9, '', 1);

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
(3, 'karthik', '123', 123, 'user', 'Prathik', '1,2,3,', 'Team Lead,Developer,'),
(4, 'guru', '123', 123, 'user', 'rajesh', '1,2,3,', 'Team Lead,Developer,Tester,'),
(5, 'shakthi', '123', 123, 'admin', 'Sankar', '1,2,3,4,', 'Team Lead,Developer,Tester,');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `PTVID`, `Vendorname`, `Phonenumber`, `Email`, `Category`, `Address`, `Description`) VALUES
(1, 'PTVID-0001', 'ss', '8795462130', 'yuva@panaceasys.com', 'Zeboba', 'for the purpose of testing\r\nthese things were \r\nincluded in this\r\ndocument', 'for the purpose of testing\r\nthese things were \r\nincluded in this\r\ndocumentfor the purpose of testing\r\nthese things were \r\nincluded in this\r\ndocument'),
(2, 'PTVID-0002', 'yudtid', '9789453677', 'yuva@panaceasys.com', 'Zeboba', 'for the purpose of testingthese things were included in this documentfor the purpose of testing\r\nthese things were ', 'yueri7r]\r\nsdryayu\r\naeyeaeu');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`id`, `work_id`, `client`, `lead`, `tdate`, `developer`, `tester`, `description`, `projectleads`, `priority`) VALUES
(1, 'PTWKID-001', 'PTCID-001', 'PTLID-00024', '2013-12-24', '', '', 'huiugkh', '', 'Medium'),
(2, 'PTWKID-002', 'PTCID-006', 'PTLID-00019', '2013-12-02', '', '', 'as', '', 'Medium'),
(3, 'PTWKID-003', 'PTCID-003', 'PTLID-0006', '2013-12-25', '', '', 'yukljkkjl', '', 'Low');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `workstatus`
--

INSERT INTO `workstatus` (`id`, `work_id`, `description`, `status`, `updatestatus`) VALUES
(1, 'WRKID-0002', ' dfsdgsdfgg', 'Open', 'Phase Completion'),
(2, 'WRKID-0002', ' sgsdfg', 'Improgress', 'Phase Completion'),
(3, 'WRKID-0002', ' fxghd', 'Improgress', 'Invoice'),
(4, 'WRKID-0002', ' dnhfgh dhdfh', 'Open', 'Phase Completion'),
(5, 'WRKID-0002', ' djfhfdhfh', 'Open', 'Phase Completion'),
(6, 'WRKID-0002', '  ghj h gfj hhfj', 'Improgress', 'Invoice'),
(7, 'WRKID-0001', ' utyr u r', 'Open', 'Phase Completion'),
(8, 'WRKID-0001', ' etyt tetrhentytytim m t', 'Open', 'Invoice'),
(9, 'WRKID-0001', ' uit ityityityi ', 'Hold', 'Progress Update'),
(10, 'WRKID-0001', ' yuiyui ututyuiyuiu', 'Improgress', 'Progress Update'),
(11, 'WRKID-0002', ' ', 'Select', 'Select'),
(12, 'WRKID-0002', ' fsg dgsdfg s', 'Open', 'Phase Completion'),
(13, 'WRKID-0002', ' ngfh', 'Improgress', 'Phase Completion'),
(14, 'WRKID-0002', ' dfg fsdgdfgf', 'Open', 'Invoice'),
(15, 'WRKID-0002', ' ', 'Improgress', 'Progress Update'),
(16, 'WRKID-0002', ' ', 'Improgress', 'Invoice'),
(17, 'WRKID-0002', ' asdfasfasdf', 'Open', 'Invoice'),
(18, 'WRKID-0002', ' dfvgsdfg dfgdg', 'Open', 'Phase Completion'),
(19, 'WRKID-0003', ' fdgsdgs', 'Open', 'Phase Completion'),
(20, 'WRKID-0003', ' sdfgsdgsdfgsdgsdfg', 'Improgress', 'Invoice'),
(21, '', ' sdgsdfgfsdgsdf', 'Resolved', 'Progress Update'),
(22, 'WRKID-0003', ' sdfgsdfgdf', 'Resolved', 'Invoice'),
(23, 'WRKID-0003', ' sdfgsdgsdfg', 'Improgress', 'Progress Update'),
(24, 'WRKID-0003', ' sdfgsdgsdfg', 'Improgress', 'Progress Update'),
(25, 'WRKID-0003', ' sdfgsdgsdfg', 'Improgress', 'Progress Update'),
(26, 'WRKID-0003', ' sdfgsdgsdfg', 'Improgress', 'Progress Update'),
(27, 'WRKID-0003', ' sdfgsdgsdfg', 'Improgress', 'Progress Update'),
(28, 'WRKID-0003', ' asdfuasyfuaf', 'Improgress', 'Invoice'),
(29, 'WRKID-0003', ' sadfsafasdf', 'Closed', 'Requirement Update'),
(30, 'WRKID-0003', ' asdfasfasdfas', 'Select', 'Select'),
(31, 'WRKID-0003', ' ', 'Select', 'Select'),
(32, 'WRKID-0003', ' ', 'Select', 'Select'),
(33, 'WRKID-0005', ' trghbfb', 'Open', 'Phase Completion'),
(34, 'WRKID-0007', '  dsfsd dsgdfg sdfg s', 'Open', 'Phase Completion'),
(35, 'WRKID-0002', ' sdfgdfgg', 'Improgress', 'Invoice'),
(36, 'WRKID-0007', ' ryr ty e', 'Improgress', 'Phase Completion'),
(37, 'WRKID-0007', ' sdfasfsaf', 'Improgress', 'Invoice'),
(38, '', ' fgch', 'Open', 'Invoice'),
(39, '', ' dfghdfh', 'Hold', 'Requirement Update'),
(40, 'WRKID-0007', ' sdfga sdf', 'Improgress', 'Phase Completion'),
(41, 'WRKID-0001', ' wertweterwtwer', 'Resolved', 'Requirement Update'),
(42, 'WRKID-0001', ' wertweterwtwer', 'Resolved', 'Requirement Update'),
(43, 'WRKID-0008', ' thjtyjr', 'Resolved', 'Requirement Update'),
(44, 'WRKID-0008', ' gtvgf', 'Hold', 'Invoice'),
(45, 'WRKID-0008', ' f4rf4fr4f4', 'Improgress', 'Progress Update'),
(46, 'WRKID-0008', ' ecdc', 'Improgress', 'Invoice'),
(47, 'WRKID-00011', ' sdfgsdg', 'Hold', 'Invoice'),
(48, 'WRKID-00011', ' sdfgsdgsdfg', 'Resolved', 'Progress Update'),
(49, 'WRKID-0003', ' dfsgdfg', 'Resolved', 'Invoice'),
(50, 'WRKID-00012', ' asdfasfasfasf', 'Hold', 'Progress Update'),
(51, 'WRKID-00012', ' adasdadfsfasfad', 'Resolved', 'Select'),
(52, 'WRKID-00011', ' ', 'Closed', 'Select'),
(53, 'WRKID-00010', ' fgnhgh', 'Closed', 'Phase Completion'),
(54, 'WRKID-00019', ' ', 'Select', 'Select'),
(55, 'WRKID-00019', ' ', 'Select', 'Select'),
(56, 'WRKID-00019', ' ', 'Select', 'Select'),
(57, 'WRKID-00019', ' ', 'Select', 'Select'),
(58, 'WRKID-00019', ' XDZZCZCZ', 'Open', 'Progress Update'),
(59, 'WRKID-00022', ' ghjhghj', 'Open', 'Phase Completion'),
(60, 'WRKID-0003', ' ', 'Select', 'Select'),
(61, 'WRKID-00019', ' ', 'Select', 'Select'),
(62, 'WRKID-00019', ' ', 'Select', 'Select'),
(63, 'WRKID-00019', ' ', 'Select', 'Select'),
(64, 'PTWKID-001', ' tfjufhjf', 'Inprogress', 'Phase Completion'),
(65, 'PTWKID-001', ' ', 'Closed', 'Progress Update'),
(66, 'PTWKID-002', ' sdfgsg', 'Closed', 'Requirement Update'),
(67, 'PTWKID-001', ' sdfgsfsg', 'Closed', 'Requirement Update'),
(68, 'PTWKID-002', ' sfgsgsdgsg', 'Closed', 'Progress Update'),
(69, 'PTWKID-001', ' ghjh', 'Closed', 'Requirement Update'),
(70, 'PTWKID-003', ' ', 'Select', 'Select'),
(71, 'PTWKID-003', ' ', 'Select', 'Select');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
