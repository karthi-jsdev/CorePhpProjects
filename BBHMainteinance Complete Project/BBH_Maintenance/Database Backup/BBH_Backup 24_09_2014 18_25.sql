DROP TABLE assets;

CREATE TABLE `assets` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO assets VALUES("1","1","94","37","5","computer","computer","1","2014-08-01","2014-08-31","1 Year","1","1","6.9.10.27.26.14","124.21.23");
INSERT INTO assets VALUES("2","4","16","180","1","asdfasdf","asdf","2","2014-08-01","2014-11-30","1 Year","1","1","17.8.6.9.10.27.26.14","23452345");



DROP TABLE assets_inventory;

CREATE TABLE `assets_inventory` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `make_id` bigint(20) NOT NULL,
  `model_id` bigint(20) NOT NULL,
  `equipment_idname` bigint(20) NOT NULL,
  `serialnumber` varchar(50) NOT NULL,
  `equipmentid` bigint(20) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE assets_inventory_status;

CREATE TABLE `assets_inventory_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `assetinventory_id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `inspectby` bigint(20) NOT NULL,
  `fault` varchar(70) NOT NULL,
  `costinvolved` double NOT NULL,
  `remark` varchar(100) NOT NULL,
  `complaintid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO assets_inventory_status VALUES("1","0","2014-09-16","45","asdfasfasdf","8888","asdfasdfasdf","3921");



DROP TABLE assetstatus;

CREATE TABLE `assetstatus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `assetid` bigint(20) NOT NULL,
  `assetdescription` varchar(300) NOT NULL,
  `statusid` bigint(20) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assetid` (`assetid`),
  KEY `statusid` (`statusid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE audit;

CREATE TABLE `audit` (
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
  KEY `zoneid` (`zoneid`),
  CONSTRAINT `audit_ibfk_10` FOREIGN KEY (`addedby`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `audit_ibfk_6` FOREIGN KEY (`complaintid`) REFERENCES `complaint` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `audit_ibfk_7` FOREIGN KEY (`statusid`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `audit_ibfk_8` FOREIGN KEY (`priorityid`) REFERENCES `priority` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `audit_ibfk_9` FOREIGN KEY (`zoneid`) REFERENCES `zone` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO audit VALUES("1","3920","New ticket created by Pentamine","1","3","","45","2014-09-24 16:49:17");
INSERT INTO audit VALUES("2","3920","asdfasdfasdfasdf","5","3","","45","2014-09-24 16:49:39");
INSERT INTO audit VALUES("3","3921","New ticket created by Pentamine","1","3","","45","2014-09-24 16:50:11");
INSERT INTO audit VALUES("4","3921","asdfasdfasdf","7","3","","45","2014-09-24 16:51:00");
INSERT INTO audit VALUES("5","3914","asdfasdfasdfasdf","5","3","","45","2014-09-24 16:52:03");
INSERT INTO audit VALUES("6","3922","New ticket created by Pentamine","1","3","","45","2014-09-24 16:52:15");
INSERT INTO audit VALUES("7","3915","This Issue is Not Related to MIS Creating New Issue Maintenance-0002724 Where Maintenance  moved by Pentamine","7","3","","45","2014-09-24 16:52:15");
INSERT INTO audit VALUES("8","3923","New ticket created by Pentamine","1","3","","45","2014-09-24 16:52:33");
INSERT INTO audit VALUES("9","3922","This Issue is Not Related to Maintenance Creating New Issue MIS-0001124 Where MIS  moved by Pentamine","7","3","","45","2014-09-24 16:52:33");
INSERT INTO audit VALUES("10","3924","New ticket created by Pentamine","1","3","","45","2014-09-24 16:55:41");



DROP TABLE biomedical_equipment;

CREATE TABLE `biomedical_equipment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `make_id` bigint(20) NOT NULL,
  `model_id` bigint(20) NOT NULL,
  `equipment` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=490 DEFAULT CHARSET=latin1;

INSERT INTO biomedical_equipment VALUES("1","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("2","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("3","125","3","DEFIBRILLATOR");
INSERT INTO biomedical_equipment VALUES("4","144","4","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("5","38","6","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("6","62","7","ECG MACHINE");
INSERT INTO biomedical_equipment VALUES("7","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("8","144","4","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("9","134","8","ECG MACHINE");
INSERT INTO biomedical_equipment VALUES("10","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("11","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("12","125","9","ECG MACHINE");
INSERT INTO biomedical_equipment VALUES("13","125","3","DEFIBRILLATOR");
INSERT INTO biomedical_equipment VALUES("14","104","10","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("15","125","11","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("16","28","5","DEFIBRILLATOR");
INSERT INTO biomedical_equipment VALUES("17","38","6","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("18","38","6","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("19","62","7","ECG MACHINE");
INSERT INTO biomedical_equipment VALUES("20","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("21","144","4","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("22","134","8","ECG MACHINE");
INSERT INTO biomedical_equipment VALUES("23","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("24","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("25","125","9","ECG MACHINE");
INSERT INTO biomedical_equipment VALUES("26","125","3","DEFIBRILLATOR");
INSERT INTO biomedical_equipment VALUES("27","104","10","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("28","125","11","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("29","104","10","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("30","62","12","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("31","125","11","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("32","62","13","TREAD MILL");
INSERT INTO biomedical_equipment VALUES("33","125","14","ECHO MACHINE");
INSERT INTO biomedical_equipment VALUES("34","125","9","ECG MACHINE");
INSERT INTO biomedical_equipment VALUES("35","125","16","DEFIBRILLATOR");
INSERT INTO biomedical_equipment VALUES("36","37","17","IABP MACHINE");
INSERT INTO biomedical_equipment VALUES("37","62","18","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("38","62","19","CATHLAB MACHINE");
INSERT INTO biomedical_equipment VALUES("39","44","20","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("40","101","21","COAGULATION ANALYZER");
INSERT INTO biomedical_equipment VALUES("41","106","22","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("42","16","23","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("43","81","24","DOME LIGHT");
INSERT INTO biomedical_equipment VALUES("44","99","25","PRESSURE INJECTOR");
INSERT INTO biomedical_equipment VALUES("45","101","26","PACE MAKER");
INSERT INTO biomedical_equipment VALUES("46","125","9","ECG MACHINE");
INSERT INTO biomedical_equipment VALUES("47","125","3","DEFIBRILLATOR");
INSERT INTO biomedical_equipment VALUES("48","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("49","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("50","53","27","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("51","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("52","24","28","ELIZA WASHER");
INSERT INTO biomedical_equipment VALUES("53","19","29","FLOW CYTOMETER");
INSERT INTO biomedical_equipment VALUES("54","23","30","AUTOMATED IMMUNO ANALYSER");
INSERT INTO biomedical_equipment VALUES("55","23","31","MICRO BACTERIAL CULTURE SYSTEM");
INSERT INTO biomedical_equipment VALUES("56","52","32","BIOSAFETY CABINET");
INSERT INTO biomedical_equipment VALUES("57","52","276","BIOSAFETY CABINET");
INSERT INTO biomedical_equipment VALUES("58","127","33","CENTRIFUGE");
INSERT INTO biomedical_equipment VALUES("59","127","33","CENTRIFUGE");
INSERT INTO biomedical_equipment VALUES("60","155","34","ELECTROLYTE ANALYZER");
INSERT INTO biomedical_equipment VALUES("61","24","35","ELIZA READER");
INSERT INTO biomedical_equipment VALUES("62","117","36","MICROSCOPE");
INSERT INTO biomedical_equipment VALUES("63","88","37","MICROTOME");
INSERT INTO biomedical_equipment VALUES("64","137","38","CYTOSPIN");
INSERT INTO biomedical_equipment VALUES("65","165","39","SLIDE WARMER");
INSERT INTO biomedical_equipment VALUES("66","127","40","CYCLO MIXER");
INSERT INTO biomedical_equipment VALUES("67","127","33","CENTRIFUGE");
INSERT INTO biomedical_equipment VALUES("68","85","277","DIGITAL PHOTO COLORIMETER");
INSERT INTO biomedical_equipment VALUES("69","127","33","CENTRIFUGE");
INSERT INTO biomedical_equipment VALUES("70","108","271","LAMINAR AIR FLOW");
INSERT INTO biomedical_equipment VALUES("71","127","33","CENTRIFUGE");
INSERT INTO biomedical_equipment VALUES("72","71","278","DRY BATH");
INSERT INTO biomedical_equipment VALUES("73","117","42","MICROSCOPE");
INSERT INTO biomedical_equipment VALUES("74","94","280","MICROSCOPE");
INSERT INTO biomedical_equipment VALUES("75","117","42","MICROSCOPE");
INSERT INTO biomedical_equipment VALUES("76","117","42","MICROSCOPE");
INSERT INTO biomedical_equipment VALUES("77","113","43","MICROSCOPE");
INSERT INTO biomedical_equipment VALUES("78","165","39","TISSUE PROCESSOR ");
INSERT INTO biomedical_equipment VALUES("79","21","44","BLOOD CELL COUNTER");
INSERT INTO biomedical_equipment VALUES("80","146","45","COAGULATION ANALYZER");
INSERT INTO biomedical_equipment VALUES("81","108","279","BIOSAFETY CABINET");
INSERT INTO biomedical_equipment VALUES("82","108","279","INCUBATOR");
INSERT INTO biomedical_equipment VALUES("83","25","281","CENTRIFUGE");
INSERT INTO biomedical_equipment VALUES("84","152","46","PLATELET AIGTATOR");
INSERT INTO biomedical_equipment VALUES("85","152","47","BLOOD COLLECTION MONITOR");
INSERT INTO biomedical_equipment VALUES("86","127","282","BLOOD COLLECTION MONITOR");
INSERT INTO biomedical_equipment VALUES("87","152","48","TEST TUBE SEALER");
INSERT INTO biomedical_equipment VALUES("88","67","49","REFRIGERATED CENTRIFUGE");
INSERT INTO biomedical_equipment VALUES("89","152","48","TEST TUBE SEALER");
INSERT INTO biomedical_equipment VALUES("90","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("91","166","50","RADIANT WARMER");
INSERT INTO biomedical_equipment VALUES("92","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("93","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("94","78","51","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("95","125","3","DEFIBRILLATOR");
INSERT INTO biomedical_equipment VALUES("96","16","23","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("97","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("98","111","52","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("99","16","53","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("100","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("101","16","53","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("102","125","54","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("103","125","54","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("104","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("105","16","53","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("106","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("107","166","55","RADIANT WARMER");
INSERT INTO biomedical_equipment VALUES("108","1","283","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("109","166","56","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("110","16","23","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("111","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("112","134","57","SPO2, NIBP MONITOR");
INSERT INTO biomedical_equipment VALUES("113","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("114","60","58","DIALYSIS MACHINE");
INSERT INTO biomedical_equipment VALUES("115","125","3","DEFIBRILLATOR");
INSERT INTO biomedical_equipment VALUES("116","60","59","DIALYSIS MACHINE");
INSERT INTO biomedical_equipment VALUES("117","60","58","DIALYSIS MACHINE");
INSERT INTO biomedical_equipment VALUES("118","60","59","DIALYSIS MACHINE");
INSERT INTO biomedical_equipment VALUES("119","60","58","DIALYSIS MACHINE");
INSERT INTO biomedical_equipment VALUES("120","38","6","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("121","60","59","DIALYSIS MACHINE");
INSERT INTO biomedical_equipment VALUES("123","53","60","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("124","16","23","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("125","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("126","16","23","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("127","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("128","16","23","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("129","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("130","16","23","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("131","125","54","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("132","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("133","125","54","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("134","53","61","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("135","62","62","PHOTOTHERAPY");
INSERT INTO biomedical_equipment VALUES("136","62","63","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("137","62","64","BUBBLE CPAP");
INSERT INTO biomedical_equipment VALUES("138","125","54","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("139","86","65","BREAST PUMP");
INSERT INTO biomedical_equipment VALUES("140","166","284","RADIANT WARMER ");
INSERT INTO biomedical_equipment VALUES("141","123","66","BABY INCUBATOR");
INSERT INTO biomedical_equipment VALUES("142","44","67","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("143","123","66","BABY INCUBATOR");
INSERT INTO biomedical_equipment VALUES("144","57","68","BUBBLE CPAP");
INSERT INTO biomedical_equipment VALUES("145","150","69","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("146","134","70","SPO2, NIBP MONITOR");
INSERT INTO biomedical_equipment VALUES("147","16","53","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("148","166","284","RADIANT WARMER");
INSERT INTO biomedical_equipment VALUES("149","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("150","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("151","166","71","RADIANT WARMER ");
INSERT INTO biomedical_equipment VALUES("152","16","53","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("153","153","80","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("154","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("155","166","55","RADIANT WARMER");
INSERT INTO biomedical_equipment VALUES("156","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("157","20","73","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("158","166","71","RADIANT WARMER");
INSERT INTO biomedical_equipment VALUES("159","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("160","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("161","153","74","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("162","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("163","166","284","RADIANT WARMER ");
INSERT INTO biomedical_equipment VALUES("164","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("165","166","284","RADIANT WARMER");
INSERT INTO biomedical_equipment VALUES("166","166","71","RADIANT WARMER");
INSERT INTO biomedical_equipment VALUES("167","82","75","ECG MONITOR");
INSERT INTO biomedical_equipment VALUES("168","57","76","NEO PUFF");
INSERT INTO biomedical_equipment VALUES("169","98","285","RADIANT WARMER ");
INSERT INTO biomedical_equipment VALUES("170","16","53","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("171","126","77","TRANSPORT INCUBATOR");
INSERT INTO biomedical_equipment VALUES("172","16","53","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("173","166","50","RADIANT WARMER");
INSERT INTO biomedical_equipment VALUES("174","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("175","16","53","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("176","166","78","PHOTOTHERAPY");
INSERT INTO biomedical_equipment VALUES("177","126","286","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("178","149","79","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("179","153","80","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("180","121","81","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("181","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("182","125","82","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("183","111","52","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("184","62","83","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("185","111","52","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("186","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("187","111","52","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("188","121","81","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("189","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("190","111","52","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("191","44","85","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("192","142","86","ULTRASOUND");
INSERT INTO biomedical_equipment VALUES("193","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("194","16","87","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("195","6","88","VENTILATOR");
INSERT INTO biomedical_equipment VALUES("196","70","89","ECG MACHINE");
INSERT INTO biomedical_equipment VALUES("197","101","90","DEFIBRILLATOR");
INSERT INTO biomedical_equipment VALUES("198","38","6","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("199","166","50","RADIANT WARMER");
INSERT INTO biomedical_equipment VALUES("200","62","91","FETAL MONITOR");
INSERT INTO biomedical_equipment VALUES("201","125","92","FETAL MONITOR");
INSERT INTO biomedical_equipment VALUES("202","125","93","FETAL MONITOR");
INSERT INTO biomedical_equipment VALUES("203","166","71","RADIANT WARMER");
INSERT INTO biomedical_equipment VALUES("204","143","94","FETAL MONITOR");
INSERT INTO biomedical_equipment VALUES("205","97","95","VACCUM DELIVERY SYSTEM");
INSERT INTO biomedical_equipment VALUES("206","166","96","RADIANT WARMER");
INSERT INTO biomedical_equipment VALUES("207","103","97","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("208","62","91","FETAL MONITOR");
INSERT INTO biomedical_equipment VALUES("209","143","98","FETAL MONITOR");
INSERT INTO biomedical_equipment VALUES("210","62","91","FETAL MONITOR");
INSERT INTO biomedical_equipment VALUES("211","103","97","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("212","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("213","125","99","ULTRASOUND");
INSERT INTO biomedical_equipment VALUES("214","53","61","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("215","2","288","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("216","76","289","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("217","166","50","RADIANT WARMER");
INSERT INTO biomedical_equipment VALUES("218","143","94","FETAL MONITOR");
INSERT INTO biomedical_equipment VALUES("219","97","95","VACCUM DELIVERY SYSTEM");
INSERT INTO biomedical_equipment VALUES("220","166","96","RADIANT WARMER");
INSERT INTO biomedical_equipment VALUES("221","103","97","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("222","62","91","FETAL MONITOR");
INSERT INTO biomedical_equipment VALUES("223","143","98","FETAL MONITOR");
INSERT INTO biomedical_equipment VALUES("224","62","91","FETAL MONITOR");
INSERT INTO biomedical_equipment VALUES("225","103","97","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("226","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("227","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("228","125","99","ULTRASOUND");
INSERT INTO biomedical_equipment VALUES("229","53","61","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("230","2","288","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("231","76","289","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("232","166","50","RADIANT WARMER");
INSERT INTO biomedical_equipment VALUES("233","166","56","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("234","38","6","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("235","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("236","16","53","INFUSION PUMP");
INSERT INTO biomedical_equipment VALUES("237","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("238","166","56","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("239","125","101","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("240","127","33","CENTRIFUGE");
INSERT INTO biomedical_equipment VALUES("241","17","102","CO2 ANALYZER");
INSERT INTO biomedical_equipment VALUES("242","87","103","CO2 INCUBATOR");
INSERT INTO biomedical_equipment VALUES("243","29","104","LABEL PRINTER");
INSERT INTO biomedical_equipment VALUES("244","156","290","LAMINAR AIR FLOW");
INSERT INTO biomedical_equipment VALUES("245","52","105","BIOSAFETY CABINET");
INSERT INTO biomedical_equipment VALUES("246","65","106","LIGHT SOURCE");
INSERT INTO biomedical_equipment VALUES("247","114","291","MICROSCOPE WITH RI MANUPULATOR");
INSERT INTO biomedical_equipment VALUES("248","33","107","DOME LIGHT");
INSERT INTO biomedical_equipment VALUES("249","33","108","OPERATING TABLE");
INSERT INTO biomedical_equipment VALUES("250","113","109","PHASE MICROSCOPE");
INSERT INTO biomedical_equipment VALUES("251","120","292","PLANNER");
INSERT INTO biomedical_equipment VALUES("252","82","110","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("253","113","111","STEREO MICROSCOPE");
INSERT INTO biomedical_equipment VALUES("254","132","293","SUCTION PUMP");
INSERT INTO biomedical_equipment VALUES("255","34","112","TEST TUBE HEATER");
INSERT INTO biomedical_equipment VALUES("256","130","113","TEST TUBE HEATER");
INSERT INTO biomedical_equipment VALUES("257","113","114","WARMING STAGE");
INSERT INTO biomedical_equipment VALUES("258","64","115","DOPPLER AMI");
INSERT INTO biomedical_equipment VALUES("259","3","116","ANESTHESIA WORKSTATION");
INSERT INTO biomedical_equipment VALUES("260","36","117","ANESTHESIA WORKSTATION");
INSERT INTO biomedical_equipment VALUES("261","163","118","ANESTHESIA WORKSTATION");
INSERT INTO biomedical_equipment VALUES("262","163","118","ANESTHESIA WORKSTATION");
INSERT INTO biomedical_equipment VALUES("263","38","119","ANESTHESIA WORKSTATION");
INSERT INTO biomedical_equipment VALUES("264","12","120","ANESTHESIA VENTILATOR");
INSERT INTO biomedical_equipment VALUES("265","9","121","ANESTHESIA WORKSTATION");
INSERT INTO biomedical_equipment VALUES("266","27","122"," BOYLES MACHINE");
INSERT INTO biomedical_equipment VALUES("267","170","294","ANESTHESIA WORKSTATION");
INSERT INTO biomedical_equipment VALUES("268","107","123","ASPIRATOR");
INSERT INTO biomedical_equipment VALUES("269","82","124","CAUTERY MACHINE");
INSERT INTO biomedical_equipment VALUES("270","15","125","CAUTERY MACHINE");
INSERT INTO biomedical_equipment VALUES("271","158","126","CAUTERY MACHINE");
INSERT INTO biomedical_equipment VALUES("272","51","127","CAUTERY MACHINE");
INSERT INTO biomedical_equipment VALUES("273","51","127","CAUTERY MACHINE");
INSERT INTO biomedical_equipment VALUES("274","164","129","CAUTERY MACHINE");
INSERT INTO biomedical_equipment VALUES("275","82","130","CAUTERY MACHINE");
INSERT INTO biomedical_equipment VALUES("276","118","295","CAUTERY MACHINE");
INSERT INTO biomedical_equipment VALUES("277","125","3","DEFIBRILLATOR");
INSERT INTO biomedical_equipment VALUES("278","82","110","ECG, SPO2 MONITOR");
INSERT INTO biomedical_equipment VALUES("279","54","133","HARMONIC SCALPEL");
INSERT INTO biomedical_equipment VALUES("280","96","296","HEART LUNG MACHINE");
INSERT INTO biomedical_equipment VALUES("281","26","134","HYSTEROSCOPY   SUCTION PUMP");
INSERT INTO biomedical_equipment VALUES("282","162","135","INSUFFLATOR");
INSERT INTO biomedical_equipment VALUES("283","48","136","INSUFFLATOR");
INSERT INTO biomedical_equipment VALUES("284","79","138","INTUBATION FIBROSCOPE");
INSERT INTO biomedical_equipment VALUES("285","93","139","LIGHT SOURCE");
INSERT INTO biomedical_equipment VALUES("286","117","140","LIGHT SOURCE");
INSERT INTO biomedical_equipment VALUES("287","160","141","LIGHT SOURCE");
INSERT INTO biomedical_equipment VALUES("288","160","141","LIGHT SOURCE");
INSERT INTO biomedical_equipment VALUES("289","100","142","MICRODEBRIDER");
INSERT INTO biomedical_equipment VALUES("290","129","143","MORCILLAOTR");
INSERT INTO biomedical_equipment VALUES("291","82","144","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("292","134","145","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("293","125","146","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("294","125","147","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("295","125","148","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("296","82","149","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("297","88","150","OPERATING MICROSCOPE");
INSERT INTO biomedical_equipment VALUES("298","107","151","OPERATING MICROSCOPE");
INSERT INTO biomedical_equipment VALUES("299","31","152","OPERATING MICROSCOPE");
INSERT INTO biomedical_equipment VALUES("300","31","153","OPERATING MICROSCOPE");
INSERT INTO biomedical_equipment VALUES("301","95","154","DOME LIGHT");
INSERT INTO biomedical_equipment VALUES("302","56","298","DOME LIGHT");
INSERT INTO biomedical_equipment VALUES("303","43","299","DOME LIGHT");
INSERT INTO biomedical_equipment VALUES("304","124","300","DOME LIGHT");
INSERT INTO biomedical_equipment VALUES("305","145","301","OPERATING TABLE");
INSERT INTO biomedical_equipment VALUES("306","22","155","OPERATING TABLE");
INSERT INTO biomedical_equipment VALUES("307","33","156","OPERATING TABLE");
INSERT INTO biomedical_equipment VALUES("308","33","108","OPERATING TABLE");
INSERT INTO biomedical_equipment VALUES("309","13","158","OPERATING TABLE");
INSERT INTO biomedical_equipment VALUES("310","145","301","OPERATING TABLE");
INSERT INTO biomedical_equipment VALUES("311","8","159","PHACO MACHINE");
INSERT INTO biomedical_equipment VALUES("312","101","160","NEURO DRILL");
INSERT INTO biomedical_equipment VALUES("313","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("314","105","302","PULSELITH");
INSERT INTO biomedical_equipment VALUES("315","18","161","WARMING UNIT");
INSERT INTO biomedical_equipment VALUES("316","166","162","RADIANT WARMER");
INSERT INTO biomedical_equipment VALUES("317","166","96","RADIANT WARMER ");
INSERT INTO biomedical_equipment VALUES("318","77","303","SHAVER");
INSERT INTO biomedical_equipment VALUES("319","152","72","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("320","45","304","TOURNICATE");
INSERT INTO biomedical_equipment VALUES("321","42","305","TOURNICATE");
INSERT INTO biomedical_equipment VALUES("322","158","163","VESSEL SEALER");
INSERT INTO biomedical_equipment VALUES("323","119","306","VIDEO CAMERA PROCESSOR");
INSERT INTO biomedical_equipment VALUES("324","140","307","ORTHO DRILL");
INSERT INTO biomedical_equipment VALUES("325","53","61","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("326","59","164","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("327","18","165","WARMING UNIT");
INSERT INTO biomedical_equipment VALUES("328","56","298","DOME LIGHT");
INSERT INTO biomedical_equipment VALUES("329","147","166","LAPAROSCOPY VIDEO UNIT (LIGHT SOURCE)");
INSERT INTO biomedical_equipment VALUES("330","147","167","LAPAROSCOPY VIDEO UNIT (PROCESSOR UNIT)");
INSERT INTO biomedical_equipment VALUES("331","147","168","LAPAROSCOPY VIDEO UNIT (HD LCD MONITOR)");
INSERT INTO biomedical_equipment VALUES("332","147","309","LAPAROSCOPY VIDEO UNIT (SLAVE MONITOR)");
INSERT INTO biomedical_equipment VALUES("333","117","170","LAPAROSCOPY VIDEO UNIT (LIGHT SOURCE)");
INSERT INTO biomedical_equipment VALUES("334","117","170","LAPAROSCOPY VIDEO UNIT (PROCESSOR UNIT)");
INSERT INTO biomedical_equipment VALUES("335","117","171","LAPAROSCOPY VIDEO UNIT (HD LCD MONITOR)");
INSERT INTO biomedical_equipment VALUES("336","117","310","LAPAROSCOPY VIDEO UNIT (SLAVE MONITOR)");
INSERT INTO biomedical_equipment VALUES("337","79","172","LAPAROSCOPY VIDEO UNIT (LIGHT SOURCE)");
INSERT INTO biomedical_equipment VALUES("338","157","311","LAPAROSCOPY VIDEO UNIT (MONITOR)");
INSERT INTO biomedical_equipment VALUES("339","79","173","LAPAROSCOPY VIDEO UNIT (PROCESSOR UNIT)");
INSERT INTO biomedical_equipment VALUES("340","147","174","SHAVER");
INSERT INTO biomedical_equipment VALUES("341","39","175","ORTHO DRILL");
INSERT INTO biomedical_equipment VALUES("342","102","312","ORTHO DRILL");
INSERT INTO biomedical_equipment VALUES("343","148","176","ORTHO DRILL");
INSERT INTO biomedical_equipment VALUES("344","140","307","MAN MAN DRILL(ORTHO)");
INSERT INTO biomedical_equipment VALUES("345","140","307","MAN MAN DRILL (CARDIAC)");
INSERT INTO biomedical_equipment VALUES("346","96","177","HEATER COOLER UNIT");
INSERT INTO biomedical_equipment VALUES("347","125","146","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("348","66","178","HEAD LIGHT");
INSERT INTO biomedical_equipment VALUES("349","66","179","HEAD LIGHT");
INSERT INTO biomedical_equipment VALUES("350","101","21","COAGULATION ANALYZER");
INSERT INTO biomedical_equipment VALUES("351","75","180","TOURNICATE");
INSERT INTO biomedical_equipment VALUES("352","125","181","AGM");
INSERT INTO biomedical_equipment VALUES("353","141","182","PNEUMATIC SYSTEM");
INSERT INTO biomedical_equipment VALUES("354","11","183","DIGITAL SPEECH AUDIOMETER");
INSERT INTO biomedical_equipment VALUES("355","11","184","IMPEDANCE AUDIOMETER");
INSERT INTO biomedical_equipment VALUES("356","136","314","ENT WORK STATION");
INSERT INTO biomedical_equipment VALUES("357","49","315","VIDEO SCOPY SYSTEM");
INSERT INTO biomedical_equipment VALUES("358","108","279","NASOPHARYNGO SCOPE");
INSERT INTO biomedical_equipment VALUES("359","136","314","LIGHT SOURCE");
INSERT INTO biomedical_equipment VALUES("360","133","185","MICROSCOPE");
INSERT INTO biomedical_equipment VALUES("361","131","186","ENG");
INSERT INTO biomedical_equipment VALUES("362","108","279","LIGHT SOURCE");
INSERT INTO biomedical_equipment VALUES("363","136","314","LIGHT SOURCE");
INSERT INTO biomedical_equipment VALUES("364","122","187","OAE");
INSERT INTO biomedical_equipment VALUES("365","131","188","EEG MACHINE");
INSERT INTO biomedical_equipment VALUES("366","131","189","EMG");
INSERT INTO biomedical_equipment VALUES("367","63","190","FETAL MONITOR");
INSERT INTO biomedical_equipment VALUES("368","30","191","PFT MACHINE");
INSERT INTO biomedical_equipment VALUES("369","53","27","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("370","125","3","DEFIBRILlATOR");
INSERT INTO biomedical_equipment VALUES("371","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("372","125","9","ECG MACHINE");
INSERT INTO biomedical_equipment VALUES("373","166","317","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("374","108","279","POP CUTTER");
INSERT INTO biomedical_equipment VALUES("375","90","193","SHORTWAVE DIATHERMY");
INSERT INTO biomedical_equipment VALUES("376","90","194","EMS");
INSERT INTO biomedical_equipment VALUES("377","90","195","TENNS MACHINE");
INSERT INTO biomedical_equipment VALUES("378","90","196","IFT MACHINE");
INSERT INTO biomedical_equipment VALUES("379","91","197","TRACTION MACHINE");
INSERT INTO biomedical_equipment VALUES("380","161","198","HAND TUTOR");
INSERT INTO biomedical_equipment VALUES("381","135","199","BIO FEEDBACK ");
INSERT INTO biomedical_equipment VALUES("382","110","200","NEURO FEEDBACK");
INSERT INTO biomedical_equipment VALUES("383","92","201","ULTRASOUND");
INSERT INTO biomedical_equipment VALUES("384","72","202","HYDROCOLLATOR");
INSERT INTO biomedical_equipment VALUES("385","90","194","EMS");
INSERT INTO biomedical_equipment VALUES("386","73","318","WAX BATH");
INSERT INTO biomedical_equipment VALUES("387","108","279","TRACTION MACHINE");
INSERT INTO biomedical_equipment VALUES("388","90","196","IFT MACHINE");
INSERT INTO biomedical_equipment VALUES("389","108","279","HYDRO MASSAGE");
INSERT INTO biomedical_equipment VALUES("390","46","203","SHORTWAVE DIATHERMY");
INSERT INTO biomedical_equipment VALUES("391","90","204","SHORTWAVE DIATHERMY");
INSERT INTO biomedical_equipment VALUES("392","108","279","CPM MACHINE");
INSERT INTO biomedical_equipment VALUES("393","151","205","TRACTION MACHINE");
INSERT INTO biomedical_equipment VALUES("394","151","206","ULTRASOUND");
INSERT INTO biomedical_equipment VALUES("395","151","207","IFT MACHINE");
INSERT INTO biomedical_equipment VALUES("396","151","208","TENNS MACHINE");
INSERT INTO biomedical_equipment VALUES("397","151","206","ULTRASOUND");
INSERT INTO biomedical_equipment VALUES("398","66","209","INDIRECT OPTHALMOSCOPE");
INSERT INTO biomedical_equipment VALUES("399","112","210","AUTO REFRACTOMETER");
INSERT INTO biomedical_equipment VALUES("400","116","211","A-SCAN");
INSERT INTO biomedical_equipment VALUES("401","31","212","HUMPHREY FIELD ANALYZER");
INSERT INTO biomedical_equipment VALUES("402","108","279","KERTOMETER");
INSERT INTO biomedical_equipment VALUES("403","31","213","SLIT LAMP");
INSERT INTO biomedical_equipment VALUES("404","31","214","YAG LASER");
INSERT INTO biomedical_equipment VALUES("405","31","215","GREEN LASER");
INSERT INTO biomedical_equipment VALUES("406","14","216","UROFLOWMETRY");
INSERT INTO biomedical_equipment VALUES("407","41","217","VASCULAR DOPPLER");
INSERT INTO biomedical_equipment VALUES("408","41","218","NEUROPATHY ANALYZER");
INSERT INTO biomedical_equipment VALUES("409","41","219","PLANTAR PRESSURE MEASUREMENT");
INSERT INTO biomedical_equipment VALUES("410","69","319","DOME LIGHT");
INSERT INTO biomedical_equipment VALUES("411","169","220","AUTOMATED EXTERNAL DEFIBRILLATOR");
INSERT INTO biomedical_equipment VALUES("412","50","221","ALCOHOL DETECTOR");
INSERT INTO biomedical_equipment VALUES("413","125","3","DEFIBRILLATOR");
INSERT INTO biomedical_equipment VALUES("414","125","222","ECG MACHINE");
INSERT INTO biomedical_equipment VALUES("415","134","8","ECG MACHINE");
INSERT INTO biomedical_equipment VALUES("416","82","225","ECG MONITOR");
INSERT INTO biomedical_equipment VALUES("417","82","226","ECG MONITOR");
INSERT INTO biomedical_equipment VALUES("418","125","227","MULTIPARA MONITOR");
INSERT INTO biomedical_equipment VALUES("419","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("420","108","279","RADIANT WARMER");
INSERT INTO biomedical_equipment VALUES("421","16","320","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("422","53","228","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("423","128","229","TRANSPORT VENTILATOR");
INSERT INTO biomedical_equipment VALUES("424","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("425","134","230","DEFIBRILLATOR");
INSERT INTO biomedical_equipment VALUES("426","62","231","MAMOGRAPHY");
INSERT INTO biomedical_equipment VALUES("427","62","232","ULTRASOUND");
INSERT INTO biomedical_equipment VALUES("428","89","233","PRESSURE INJECTOR");
INSERT INTO biomedical_equipment VALUES("429","134","8","ECG MACHINE");
INSERT INTO biomedical_equipment VALUES("430","4","234","CR MACHINE");
INSERT INTO biomedical_equipment VALUES("431","154","235","ULTRASOUND");
INSERT INTO biomedical_equipment VALUES("432","139","240","MOBILE X-RAY");
INSERT INTO biomedical_equipment VALUES("433","4","234","CR MACHINE");
INSERT INTO biomedical_equipment VALUES("434","35","237","OPG MACHINE");
INSERT INTO biomedical_equipment VALUES("435","138","238"," X RAY MACHINE");
INSERT INTO biomedical_equipment VALUES("436","32","239","C-ARM");
INSERT INTO biomedical_equipment VALUES("437","139","240","CT SCAN MACHINE");
INSERT INTO biomedical_equipment VALUES("438","134","8","ECG MACHINE");
INSERT INTO biomedical_equipment VALUES("439","62","241","MOBILE X-RAY");
INSERT INTO biomedical_equipment VALUES("440","4","242","CR PRINTER");
INSERT INTO biomedical_equipment VALUES("441","62","243","ULTRASOUND");
INSERT INTO biomedical_equipment VALUES("442","62","244"," X RAY MACHINE");
INSERT INTO biomedical_equipment VALUES("443","168","245","C-ARM");
INSERT INTO biomedical_equipment VALUES("444","68","246","BONE DENSITOMETER");
INSERT INTO biomedical_equipment VALUES("445","47","247","LINEAR ACCELERATOR");
INSERT INTO biomedical_equipment VALUES("446","80","321","WATER BATH");
INSERT INTO biomedical_equipment VALUES("447","80","321","ALLOY DISPENSER");
INSERT INTO biomedical_equipment VALUES("448","108","279","RFA-BLUE PHANTOM");
INSERT INTO biomedical_equipment VALUES("449","74","322","ELECTROMETER");
INSERT INTO biomedical_equipment VALUES("450","58","248","SURVEY METER");
INSERT INTO biomedical_equipment VALUES("451","108","249","LAMINAR AIR FLOW");
INSERT INTO biomedical_equipment VALUES("452","62","250","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("453","59","164","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("454","117","252","VIDEO GASTROSCOPE");
INSERT INTO biomedical_equipment VALUES("455","117","253","VIDEO BRONCHOSCOPE 1");
INSERT INTO biomedical_equipment VALUES("456","158","254","CAUTERY MACHINE");
INSERT INTO biomedical_equipment VALUES("457","134","255","SPO2  NIBP MONITOR");
INSERT INTO biomedical_equipment VALUES("458","117","256","VIDEO SYSTEM CENTRE");
INSERT INTO biomedical_equipment VALUES("459","117","140","LIGHT SOURCE");
INSERT INTO biomedical_equipment VALUES("460","117","257","VIDEO SYSTEM CENTRE");
INSERT INTO biomedical_equipment VALUES("461","117","258","VIDEO COLONOSCOPE");
INSERT INTO biomedical_equipment VALUES("462","117","259","VIDEO COLONOSCOPE");
INSERT INTO biomedical_equipment VALUES("463","117","260","VIDEO GASTROSCOPE ");
INSERT INTO biomedical_equipment VALUES("464","117","261","VIDEO ERCP ");
INSERT INTO biomedical_equipment VALUES("465","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("466","159","262","COMBINED UV THERAPHY");
INSERT INTO biomedical_equipment VALUES("467","40","263","RADIO SURGERY UNIT");
INSERT INTO biomedical_equipment VALUES("468","159","264","UV PUVATHERAPHY UNIT");
INSERT INTO biomedical_equipment VALUES("469","40","265","RADIO SURGERY UNIT");
INSERT INTO biomedical_equipment VALUES("470","58","266","ELECTRICAL SAFTY ANALYZER");
INSERT INTO biomedical_equipment VALUES("471","28","323","ECG STIMULATOR");
INSERT INTO biomedical_equipment VALUES("472","7","267","DENTAL CHAIR  WITH SCALAR");
INSERT INTO biomedical_equipment VALUES("473","5","324","DENTAL CHAIR  WITH SCALAR");
INSERT INTO biomedical_equipment VALUES("474","38","1","PULSE OXIMETER");
INSERT INTO biomedical_equipment VALUES("475","125","268","ECG MACHINE");
INSERT INTO biomedical_equipment VALUES("476","10","269","ULTRASOUND");
INSERT INTO biomedical_equipment VALUES("477","108","279","ELECTRONIC WEIGHING SCALE");
INSERT INTO biomedical_equipment VALUES("478","62","270","ULTRASOUND");
INSERT INTO biomedical_equipment VALUES("479","62","91","FETAL MONITOR");
INSERT INTO biomedical_equipment VALUES("480","108","271","COLPOSCOPE");
INSERT INTO biomedical_equipment VALUES("481","28","272","ECG MACHINE");
INSERT INTO biomedical_equipment VALUES("482","108","279","CHEMISTRY ANALYZER");
INSERT INTO biomedical_equipment VALUES("483","127","273","CENTRIFUGE");
INSERT INTO biomedical_equipment VALUES("484","83","328","MICROSCOPE");
INSERT INTO biomedical_equipment VALUES("485","57","274","HIGH FLOW OXYGEN");
INSERT INTO biomedical_equipment VALUES("486","57","329","NERVE STIMULATOR");
INSERT INTO biomedical_equipment VALUES("487","16","2","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("488","59","164","SYRINGE PUMP");
INSERT INTO biomedical_equipment VALUES("489","115","275","ECT MACHINE");



DROP TABLE biomedical_make;

CREATE TABLE `biomedical_make` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `make` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=latin1;

INSERT INTO biomedical_make VALUES("1","NEWPORT SKANRAY");
INSERT INTO biomedical_make VALUES("2","ACS-C-15");
INSERT INTO biomedical_make VALUES("3","AEONMED");
INSERT INTO biomedical_make VALUES("4","AGFA");
INSERT INTO biomedical_make VALUES("5","AIDEC");
INSERT INTO biomedical_make VALUES("6","AIR LIQUID");
INSERT INTO biomedical_make VALUES("7","AIREL");
INSERT INTO biomedical_make VALUES("8","ALKON LABORATORIES");
INSERT INTO biomedical_make VALUES("9","ALLIED MEDICAL");
INSERT INTO biomedical_make VALUES("10","ALOKA");
INSERT INTO biomedical_make VALUES("11","ALPS");
INSERT INTO biomedical_make VALUES("12","ANAVENT");
INSERT INTO biomedical_make VALUES("13","APPASWAMY");
INSERT INTO biomedical_make VALUES("14","ARK MEDITECH");
INSERT INTO biomedical_make VALUES("15","ARTHERX");
INSERT INTO biomedical_make VALUES("16","B BRAUN");
INSERT INTO biomedical_make VALUES("17","BACHRACH");
INSERT INTO biomedical_make VALUES("18","BAIR HUGGER");
INSERT INTO biomedical_make VALUES("19","BD");
INSERT INTO biomedical_make VALUES("20","BEAR CUB");
INSERT INTO biomedical_make VALUES("21","BECKMAN COULTER");
INSERT INTO biomedical_make VALUES("22","BET MEDICALS");
INSERT INTO biomedical_make VALUES("23","BIO MERIEUX");
INSERT INTO biomedical_make VALUES("24","BIO-RAD");
INSERT INTO biomedical_make VALUES("25","BL");
INSERT INTO biomedical_make VALUES("26","BOIMED ELECTRONICS");
INSERT INTO biomedical_make VALUES("27","BOYLE TECH");
INSERT INTO biomedical_make VALUES("28","BPL");
INSERT INTO biomedical_make VALUES("29","BRADY");
INSERT INTO biomedical_make VALUES("30","BUTTERFLY");
INSERT INTO biomedical_make VALUES("31","CARL ZEISS");
INSERT INTO biomedical_make VALUES("32","COMED MEDICAL");
INSERT INTO biomedical_make VALUES("33","CONFIDENT");
INSERT INTO biomedical_make VALUES("34","COOK");
INSERT INTO biomedical_make VALUES("35","CYPHER");
INSERT INTO biomedical_make VALUES("36","DAMECA");
INSERT INTO biomedical_make VALUES("37","DATASCOPE");
INSERT INTO biomedical_make VALUES("38","DATEX OHMEDA");
INSERT INTO biomedical_make VALUES("39","DE SOUTTER");
INSERT INTO biomedical_make VALUES("40","DERMAINDIA");
INSERT INTO biomedical_make VALUES("41","DIABETIC FOOT CARE");
INSERT INTO biomedical_make VALUES("42","DIAMOND");
INSERT INTO biomedical_make VALUES("43","DOMELUX");
INSERT INTO biomedical_make VALUES("44","DRAGER");
INSERT INTO biomedical_make VALUES("45","ELECTROCARE SYSTEMS");
INSERT INTO biomedical_make VALUES("46","ELECTROWAVE");
INSERT INTO biomedical_make VALUES("47","ELEKTA");
INSERT INTO biomedical_make VALUES("48","ENDO TECH");
INSERT INTO biomedical_make VALUES("49","ENDOIGI");
INSERT INTO biomedical_make VALUES("50","ENVITECH");
INSERT INTO biomedical_make VALUES("51","ERBE");
INSERT INTO biomedical_make VALUES("52","ESCO");
INSERT INTO biomedical_make VALUES("53","ESSAE");
INSERT INTO biomedical_make VALUES("54","ETHICON ENDO");
INSERT INTO biomedical_make VALUES("55","EXPLORE X");
INSERT INTO biomedical_make VALUES("56","FAMED");
INSERT INTO biomedical_make VALUES("57","FISHER & PAYKEL");
INSERT INTO biomedical_make VALUES("58","FLUKE");
INSERT INTO biomedical_make VALUES("59","FRESENIUS");
INSERT INTO biomedical_make VALUES("60","FRESENIUS MEDICAL");
INSERT INTO biomedical_make VALUES("62","GE");
INSERT INTO biomedical_make VALUES("63","GE-COROMETRICS");
INSERT INTO biomedical_make VALUES("64","HAL");
INSERT INTO biomedical_make VALUES("65","HALOGEN");
INSERT INTO biomedical_make VALUES("66","HEINE");
INSERT INTO biomedical_make VALUES("67","HETTICH");
INSERT INTO biomedical_make VALUES("68","HOLOGIC");
INSERT INTO biomedical_make VALUES("69","HOSPITECH");
INSERT INTO biomedical_make VALUES("70","HP");
INSERT INTO biomedical_make VALUES("71","HYCEL");
INSERT INTO biomedical_make VALUES("72","HYDROCOLLATOR");
INSERT INTO biomedical_make VALUES("73","HYTHERMEO");
INSERT INTO biomedical_make VALUES("74","IBA");
INSERT INTO biomedical_make VALUES("75","INOR");
INSERT INTO biomedical_make VALUES("76","INTELLIGENT");
INSERT INTO biomedical_make VALUES("77","INTRA ARC");
INSERT INTO biomedical_make VALUES("78","K.TAKAOKA");
INSERT INTO biomedical_make VALUES("79","KARL STORZ");
INSERT INTO biomedical_make VALUES("80","KAVYA BIOMEDICAL EQUIPMENTS");
INSERT INTO biomedical_make VALUES("81","KENEX");
INSERT INTO biomedical_make VALUES("82","L&T");
INSERT INTO biomedical_make VALUES("83","LABMED");
INSERT INTO biomedical_make VALUES("84","LABOMED");
INSERT INTO biomedical_make VALUES("85","LABTRONICS");
INSERT INTO biomedical_make VALUES("86","LACTINA");
INSERT INTO biomedical_make VALUES("87","LEEC");
INSERT INTO biomedical_make VALUES("88","LEICA");
INSERT INTO biomedical_make VALUES("89","LIEBEL-FLARSHEIM");
INSERT INTO biomedical_make VALUES("90","LIFE LINE");
INSERT INTO biomedical_make VALUES("91","LIFE TRACE FIVE");
INSERT INTO biomedical_make VALUES("92","LIFESONIC");
INSERT INTO biomedical_make VALUES("93","LUXTEC");
INSERT INTO biomedical_make VALUES("94","LYNX");
INSERT INTO biomedical_make VALUES("95","MACFLAVE");
INSERT INTO biomedical_make VALUES("96","MAQUET");
INSERT INTO biomedical_make VALUES("97","MEDELA");
INSERT INTO biomedical_make VALUES("98","MEDITRIN");
INSERT INTO biomedical_make VALUES("99","MEDRAD");
INSERT INTO biomedical_make VALUES("100","MEDTRONIC");
INSERT INTO biomedical_make VALUES("101","MEDTRONICS");
INSERT INTO biomedical_make VALUES("102","MICRO AIR");
INSERT INTO biomedical_make VALUES("103","MICRO INFUSION");
INSERT INTO biomedical_make VALUES("104","MICRO INFUSION PUMP");
INSERT INTO biomedical_make VALUES("105","MICROPROCESSOR CONTROLLED");
INSERT INTO biomedical_make VALUES("106","MINDRAY");
INSERT INTO biomedical_make VALUES("107","MOLLER WEDEL");
INSERT INTO biomedical_make VALUES("108","NA");
INSERT INTO biomedical_make VALUES("109","NEEKA");
INSERT INTO biomedical_make VALUES("110","NEURO");
INSERT INTO biomedical_make VALUES("111","NEWPORT");
INSERT INTO biomedical_make VALUES("112","NIDEK");
INSERT INTO biomedical_make VALUES("113","NIKON");
INSERT INTO biomedical_make VALUES("114","NIKON RESEARCH INSTRUMENT");
INSERT INTO biomedical_make VALUES("115","NIVIQURE");
INSERT INTO biomedical_make VALUES("116","OCUSCAN");
INSERT INTO biomedical_make VALUES("117","OLYMPUS");
INSERT INTO biomedical_make VALUES("118","OPHAL CAUTERY");
INSERT INTO biomedical_make VALUES("119","OPTO");
INSERT INTO biomedical_make VALUES("120","ORIGIO");
INSERT INTO biomedical_make VALUES("121","ORION");
INSERT INTO biomedical_make VALUES("122","OTODYNAMICS");
INSERT INTO biomedical_make VALUES("123","PHANEM");
INSERT INTO biomedical_make VALUES("124","PHILILUX");
INSERT INTO biomedical_make VALUES("125","PHILIPS");
INSERT INTO biomedical_make VALUES("126","PHOENIX");
INSERT INTO biomedical_make VALUES("127","REMI");
INSERT INTO biomedical_make VALUES("128","RESMED");
INSERT INTO biomedical_make VALUES("129","RICHARD WOLF");
INSERT INTO biomedical_make VALUES("130","RIVOTEK");
INSERT INTO biomedical_make VALUES("131","RMS");
INSERT INTO biomedical_make VALUES("132","ROCKET CRAFT PUMP");
INSERT INTO biomedical_make VALUES("133","SANMA MEDINEERS");
INSERT INTO biomedical_make VALUES("134","SCHILLER");
INSERT INTO biomedical_make VALUES("135","SEMG");
INSERT INTO biomedical_make VALUES("136","SERWELL MAKE");
INSERT INTO biomedical_make VALUES("137","SHADON");
INSERT INTO biomedical_make VALUES("138","SHIMADZU");
INSERT INTO biomedical_make VALUES("139","SIEMENS");
INSERT INTO biomedical_make VALUES("140","SIS");
INSERT INTO biomedical_make VALUES("141","SNG");
INSERT INTO biomedical_make VALUES("142","SONACITE");
INSERT INTO biomedical_make VALUES("143","SONICAID");
INSERT INTO biomedical_make VALUES("144","SPACE LAB");
INSERT INTO biomedical_make VALUES("145","STAAN");
INSERT INTO biomedical_make VALUES("146","STAGO");
INSERT INTO biomedical_make VALUES("147","STRYKER");
INSERT INTO biomedical_make VALUES("148","SYNTHES");
INSERT INTO biomedical_make VALUES("149","TAEMA");
INSERT INTO biomedical_make VALUES("150","TAKOKA");
INSERT INTO biomedical_make VALUES("151","TECHNOMED ELECTRONICS");
INSERT INTO biomedical_make VALUES("152","TERUMO PENPOL");
INSERT INTO biomedical_make VALUES("153","TERUMO PENPOL LTD");
INSERT INTO biomedical_make VALUES("154","TOSHIBA");
INSERT INTO biomedical_make VALUES("155","TRANSAASIA");
INSERT INTO biomedical_make VALUES("156","TRIVECTOR");
INSERT INTO biomedical_make VALUES("157","TV");
INSERT INTO biomedical_make VALUES("158","VALLEY LAB");
INSERT INTO biomedical_make VALUES("159","V-CARE MEDICAL");
INSERT INTO biomedical_make VALUES("160","VMS");
INSERT INTO biomedical_make VALUES("161","VOLANT TECHNOLOGY");
INSERT INTO biomedical_make VALUES("162","WECK ENDOSCPE");
INSERT INTO biomedical_make VALUES("163","WIPRO GE HEALTH CARE");
INSERT INTO biomedical_make VALUES("164","XCEL LANCE MEDICAL TECH");
INSERT INTO biomedical_make VALUES("165","YORCO");
INSERT INTO biomedical_make VALUES("166","ZEAL MEDICAL");
INSERT INTO biomedical_make VALUES("167","ZEAL MEDICALS");
INSERT INTO biomedical_make VALUES("168","ZIEHM IMAGING");
INSERT INTO biomedical_make VALUES("169","ZOLL");
INSERT INTO biomedical_make VALUES("170","GE, DATEX ");



DROP TABLE biomedical_model;

CREATE TABLE `biomedical_model` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `make_id` bigint(20) NOT NULL,
  `model` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=330 DEFAULT CHARSET=latin1;

INSERT INTO biomedical_model VALUES("1","38","3800");
INSERT INTO biomedical_model VALUES("2","16","PERFUSOR COMPACT");
INSERT INTO biomedical_model VALUES("3","125","HEART START XL");
INSERT INTO biomedical_model VALUES("4","144","ELANCE 93300");
INSERT INTO biomedical_model VALUES("5","28","DF2509");
INSERT INTO biomedical_model VALUES("6","38","TRUSAT");
INSERT INTO biomedical_model VALUES("7","62","MAC- 1200");
INSERT INTO biomedical_model VALUES("8","134","AT 2 PLUS");
INSERT INTO biomedical_model VALUES("9","125","PAGE WRITTER TRIM 1");
INSERT INTO biomedical_model VALUES("10","104","INECTOMAT 120");
INSERT INTO biomedical_model VALUES("11","125","INTELLIVUE MP5");
INSERT INTO biomedical_model VALUES("12","62","CHMEDA 3800");
INSERT INTO biomedical_model VALUES("13","62","MAC 55000");
INSERT INTO biomedical_model VALUES("14","125","HD 15");
INSERT INTO biomedical_model VALUES("15","125","PAGE WRITER TRIM 1");
INSERT INTO biomedical_model VALUES("16","125","SMART BIPHASIC");
INSERT INTO biomedical_model VALUES("17","37","CS-100");
INSERT INTO biomedical_model VALUES("18","62","B 650");
INSERT INTO biomedical_model VALUES("19","62","INNOVA 2100 OPTIMA");
INSERT INTO biomedical_model VALUES("20","44","EVITA 4");
INSERT INTO biomedical_model VALUES("21","101","ACT PLUS");
INSERT INTO biomedical_model VALUES("22","106","BENE VIEW T8");
INSERT INTO biomedical_model VALUES("23","16","INFUSOMAT");
INSERT INTO biomedical_model VALUES("24","81","MACH 130");
INSERT INTO biomedical_model VALUES("25","99","MARK V PROVIS");
INSERT INTO biomedical_model VALUES("26","101","5318");
INSERT INTO biomedical_model VALUES("27","53","DS215");
INSERT INTO biomedical_model VALUES("28","24","PW 40");
INSERT INTO biomedical_model VALUES("29","19","FACS COUNT");
INSERT INTO biomedical_model VALUES("30","23","VIDAS PC BLUE");
INSERT INTO biomedical_model VALUES("31","23","BACT ALERT 3D60");
INSERT INTO biomedical_model VALUES("32","52","AC2-451");
INSERT INTO biomedical_model VALUES("33","127","R-8C");
INSERT INTO biomedical_model VALUES("34","155","NA/K/CL");
INSERT INTO biomedical_model VALUES("35","24","680");
INSERT INTO biomedical_model VALUES("36","117","CH20 BIMF200");
INSERT INTO biomedical_model VALUES("37","88","MICROTOME");
INSERT INTO biomedical_model VALUES("38","137","CYTOSPIN 4");
INSERT INTO biomedical_model VALUES("39","165","NA");
INSERT INTO biomedical_model VALUES("40","127","CM101");
INSERT INTO biomedical_model VALUES("41","84","VISION 2000");
INSERT INTO biomedical_model VALUES("42","117","CH20I");
INSERT INTO biomedical_model VALUES("43","113","ECLIPSE E200");
INSERT INTO biomedical_model VALUES("44","21","ACT 5 DIFF AL");
INSERT INTO biomedical_model VALUES("45","146","START");
INSERT INTO biomedical_model VALUES("46","152","PI200");
INSERT INTO biomedical_model VALUES("47","152","D601");
INSERT INTO biomedical_model VALUES("48","152","TUBE SEALER XS1010");
INSERT INTO biomedical_model VALUES("49","67","ROTANTA 460 R");
INSERT INTO biomedical_model VALUES("50","166","RHW/003B");
INSERT INTO biomedical_model VALUES("51","78","SMART");
INSERT INTO biomedical_model VALUES("52","111","E360");
INSERT INTO biomedical_model VALUES("53","16","INFUSOMAT P");
INSERT INTO biomedical_model VALUES("54","125","MP5");
INSERT INTO biomedical_model VALUES("55","166","RHW2004B");
INSERT INTO biomedical_model VALUES("56","166","WS1001C");
INSERT INTO biomedical_model VALUES("57","134","SAMILESH PLUS");
INSERT INTO biomedical_model VALUES("58","60","4008S");
INSERT INTO biomedical_model VALUES("59","60","4008S OCM");
INSERT INTO biomedical_model VALUES("60","53","DS-415");
INSERT INTO biomedical_model VALUES("61","53","BS250");
INSERT INTO biomedical_model VALUES("62","62","LED PHOTOTHERAPY");
INSERT INTO biomedical_model VALUES("63","62","SLE 5000");
INSERT INTO biomedical_model VALUES("64","62","MR586");
INSERT INTO biomedical_model VALUES("65","86","LACTINA");
INSERT INTO biomedical_model VALUES("66","123","1186C");
INSERT INTO biomedical_model VALUES("67","44","BABY LOG 8000");
INSERT INTO biomedical_model VALUES("68","57","MR 850");
INSERT INTO biomedical_model VALUES("69","150","ATLANTA");
INSERT INTO biomedical_model VALUES("70","134","TRUSCOPE MINI");
INSERT INTO biomedical_model VALUES("71","166","RHW1002A");
INSERT INTO biomedical_model VALUES("72","152","TE-331");
INSERT INTO biomedical_model VALUES("73","20","7SOPSU");
INSERT INTO biomedical_model VALUES("74","153","TE-112");
INSERT INTO biomedical_model VALUES("75","82","71421");
INSERT INTO biomedical_model VALUES("76","57","NEP PUFF");
INSERT INTO biomedical_model VALUES("77","126","T-INC-101");
INSERT INTO biomedical_model VALUES("78","166","PT4005");
INSERT INTO biomedical_model VALUES("79","149","HORUS");
INSERT INTO biomedical_model VALUES("80","153","331");
INSERT INTO biomedical_model VALUES("81","121","1000");
INSERT INTO biomedical_model VALUES("82","125","MP 20");
INSERT INTO biomedical_model VALUES("83","62","Engstrom Carestation");
INSERT INTO biomedical_model VALUES("84","111","E 360");
INSERT INTO biomedical_model VALUES("85","44","EVITA 4 Edition");
INSERT INTO biomedical_model VALUES("86","142","M-TURBO");
INSERT INTO biomedical_model VALUES("87","16","BT-37 WITH TRIGOR REGULATOR");
INSERT INTO biomedical_model VALUES("88","6","EXTEND XT");
INSERT INTO biomedical_model VALUES("89","70","PAGE WITER M1772A");
INSERT INTO biomedical_model VALUES("90","101","LIFEPAK 20");
INSERT INTO biomedical_model VALUES("91","62","COROMETRICS 172");
INSERT INTO biomedical_model VALUES("92","125","AVALON FM20");
INSERT INTO biomedical_model VALUES("93","125","AVALON FM21");
INSERT INTO biomedical_model VALUES("94","143","TEAM DUO");
INSERT INTO biomedical_model VALUES("95","97","BASIC 30");
INSERT INTO biomedical_model VALUES("96","166","RHW1102A");
INSERT INTO biomedical_model VALUES("97","103","W2-50C6T");
INSERT INTO biomedical_model VALUES("98","143","TEAM");
INSERT INTO biomedical_model VALUES("99","125","HD3");
INSERT INTO biomedical_model VALUES("100","52","BS-250");
INSERT INTO biomedical_model VALUES("101","125","SURE SIGN VM4");
INSERT INTO biomedical_model VALUES("102","17","IEQ CHECK");
INSERT INTO biomedical_model VALUES("103","87","T190S");
INSERT INTO biomedical_model VALUES("104","29","BMP71");
INSERT INTO biomedical_model VALUES("105","52","ACB-4AI");
INSERT INTO biomedical_model VALUES("106","65","HK-300");
INSERT INTO biomedical_model VALUES("107","33","CME-14");
INSERT INTO biomedical_model VALUES("108","33","CME-11");
INSERT INTO biomedical_model VALUES("109","113","ELLIPSE E 200");
INSERT INTO biomedical_model VALUES("110","82","STELLAR");
INSERT INTO biomedical_model VALUES("111","113","SMZ1000");
INSERT INTO biomedical_model VALUES("112","34","K-FTH-1012");
INSERT INTO biomedical_model VALUES("113","130","RIVOTEK");
INSERT INTO biomedical_model VALUES("114","113","MATS-U4020WF");
INSERT INTO biomedical_model VALUES("115","64","DOPPLER2");
INSERT INTO biomedical_model VALUES("116","3","AEN 7200B");
INSERT INTO biomedical_model VALUES("117","36","SIESTA I WHISPA");
INSERT INTO biomedical_model VALUES("118","163","AESPIRE 7900");
INSERT INTO biomedical_model VALUES("119","38"," BOYLES TECH");
INSERT INTO biomedical_model VALUES("120","12","100");
INSERT INTO biomedical_model VALUES("121","9","JUPITER-500");
INSERT INTO biomedical_model VALUES("122","27","BOYLE BASIC");
INSERT INTO biomedical_model VALUES("123","107","FS2-23");
INSERT INTO biomedical_model VALUES("124","82","MAESTRO");
INSERT INTO biomedical_model VALUES("125","15","AR-9600");
INSERT INTO biomedical_model VALUES("126","158","FORCE FX8CS");
INSERT INTO biomedical_model VALUES("127","51","VIO 200S");
INSERT INTO biomedical_model VALUES("128","51","VIO 300S");
INSERT INTO biomedical_model VALUES("129","164","SHALYA EASY");
INSERT INTO biomedical_model VALUES("130","82","T400");
INSERT INTO biomedical_model VALUES("131","82","MAESTRO PLUS");
INSERT INTO biomedical_model VALUES("132","125","HEARTSTART XL");
INSERT INTO biomedical_model VALUES("133","54","GEN 04");
INSERT INTO biomedical_model VALUES("134","26","ROLLA MULTI");
INSERT INTO biomedical_model VALUES("135","162","LIVANTEC");
INSERT INTO biomedical_model VALUES("136","48","ENCO2-30L");
INSERT INTO biomedical_model VALUES("137","116","UH1-2");
INSERT INTO biomedical_model VALUES("138","79","11302BD");
INSERT INTO biomedical_model VALUES("139","93","9000300XSP");
INSERT INTO biomedical_model VALUES("140","117","CLK-4");
INSERT INTO biomedical_model VALUES("141","160","STA");
INSERT INTO biomedical_model VALUES("142","100","1897102");
INSERT INTO biomedical_model VALUES("143","129","MORCE PLUS 2307");
INSERT INTO biomedical_model VALUES("144","82","STAR PLUS 200");
INSERT INTO biomedical_model VALUES("145","134","TRUSCOPE-2");
INSERT INTO biomedical_model VALUES("146","125","INTELLIVUE MP 20");
INSERT INTO biomedical_model VALUES("147","125","INTELLIVUE MP 40");
INSERT INTO biomedical_model VALUES("148","125","GOLDWAY");
INSERT INTO biomedical_model VALUES("149","82","STAR PLUS");
INSERT INTO biomedical_model VALUES("150","88","M 320");
INSERT INTO biomedical_model VALUES("151","107","H1-R700");
INSERT INTO biomedical_model VALUES("152","31","OPM1 FR PRO");
INSERT INTO biomedical_model VALUES("153","31","OPMI FR");
INSERT INTO biomedical_model VALUES("154","95","LED 550");
INSERT INTO biomedical_model VALUES("155","22","5600S");
INSERT INTO biomedical_model VALUES("156","33","CME-11S");
INSERT INTO biomedical_model VALUES("157","33","CME 11");
INSERT INTO biomedical_model VALUES("158","13","AAOT1");
INSERT INTO biomedical_model VALUES("159","8","20000 LEGACY");
INSERT INTO biomedical_model VALUES("160","101","PM-700");
INSERT INTO biomedical_model VALUES("161","18","505");
INSERT INTO biomedical_model VALUES("162","166","RHW2104B");
INSERT INTO biomedical_model VALUES("163","158","LIGASURE-8");
INSERT INTO biomedical_model VALUES("164","59","INJECTOMAT AGILIA");
INSERT INTO biomedical_model VALUES("165","18","775");
INSERT INTO biomedical_model VALUES("166","147","X8000");
INSERT INTO biomedical_model VALUES("167","147","1288 HD");
INSERT INTO biomedical_model VALUES("168","147","HD LCD");
INSERT INTO biomedical_model VALUES("169","117","VISERA ELITE      CLV-S190");
INSERT INTO biomedical_model VALUES("170","117","VISERA ELITE      OTV -SI90");
INSERT INTO biomedical_model VALUES("171","117","OEV 261H");
INSERT INTO biomedical_model VALUES("172","79","TELECAM SL PAL");
INSERT INTO biomedical_model VALUES("173","79","XENONNOVA");
INSERT INTO biomedical_model VALUES("174","147","CORE");
INSERT INTO biomedical_model VALUES("175","39","MPZ-450");
INSERT INTO biomedical_model VALUES("176","148","511.701");
INSERT INTO biomedical_model VALUES("177","96","HCU 30");
INSERT INTO biomedical_model VALUES("178","66","MPACK HLL");
INSERT INTO biomedical_model VALUES("179","66","ACCUBOX 11-L");
INSERT INTO biomedical_model VALUES("180","75","308");
INSERT INTO biomedical_model VALUES("181","125","INTELLIVUE G5");
INSERT INTO biomedical_model VALUES("182","141","SWISSLOG");
INSERT INTO biomedical_model VALUES("183","11","AD-2100");
INSERT INTO biomedical_model VALUES("184","11","AT-235");
INSERT INTO biomedical_model VALUES("185","133","ENT-L");
INSERT INTO biomedical_model VALUES("186","131","104002");
INSERT INTO biomedical_model VALUES("187","122","OTOPORT LITE");
INSERT INTO biomedical_model VALUES("188","131","8S32");
INSERT INTO biomedical_model VALUES("189","131","EMG-MAKER2");
INSERT INTO biomedical_model VALUES("190","63","171");
INSERT INTO biomedical_model VALUES("191","30","2AN100");
INSERT INTO biomedical_model VALUES("192","167","MULTIWEIGH");
INSERT INTO biomedical_model VALUES("193","90","LIFE WAVE-300");
INSERT INTO biomedical_model VALUES("194","90","LIFE LINE DT");
INSERT INTO biomedical_model VALUES("195","90","LIFE TENS 3");
INSERT INTO biomedical_model VALUES("196","90","LIFEMED PLUS");
INSERT INTO biomedical_model VALUES("197","91","LIFE TRACE FIVE ");
INSERT INTO biomedical_model VALUES("198","161","HT 100");
INSERT INTO biomedical_model VALUES("199","135","MYO PLUS");
INSERT INTO biomedical_model VALUES("200","110","SA 7500");
INSERT INTO biomedical_model VALUES("201","92","LIFESONIC");
INSERT INTO biomedical_model VALUES("202","72","SS2");
INSERT INTO biomedical_model VALUES("203","46","300");
INSERT INTO biomedical_model VALUES("204","90","LIFE WAVE-450");
INSERT INTO biomedical_model VALUES("205","151","AUTO TRAC-100");
INSERT INTO biomedical_model VALUES("206","151","ELECTROSON 709");
INSERT INTO biomedical_model VALUES("207","151","VECTROSTIM 100");
INSERT INTO biomedical_model VALUES("208","151","ACU TENS-4");
INSERT INTO biomedical_model VALUES("209","66","SIGMA 150K");
INSERT INTO biomedical_model VALUES("210","112","AR-310A");
INSERT INTO biomedical_model VALUES("211","116","ALCON");
INSERT INTO biomedical_model VALUES("212","31","740i");
INSERT INTO biomedical_model VALUES("213","31","SL115 CLASSIC");
INSERT INTO biomedical_model VALUES("214","31","VISULAR YAG III");
INSERT INTO biomedical_model VALUES("215","31","VISULAR 532S");
INSERT INTO biomedical_model VALUES("216","14","URO-010");
INSERT INTO biomedical_model VALUES("217","41","VERSALAB-LE");
INSERT INTO biomedical_model VALUES("218","41","VIBROTHERM-DX");
INSERT INTO biomedical_model VALUES("219","41","PODIASCAN");
INSERT INTO biomedical_model VALUES("220","169","AEDPRO");
INSERT INTO biomedical_model VALUES("221","50","ALCOMED 6040");
INSERT INTO biomedical_model VALUES("222","125","T20");
INSERT INTO biomedical_model VALUES("223","134","AT-2PLUS");
INSERT INTO biomedical_model VALUES("224","82","MICROMON N 71424");
INSERT INTO biomedical_model VALUES("225","82","MICROMON");
INSERT INTO biomedical_model VALUES("226","82","MICROMON N");
INSERT INTO biomedical_model VALUES("227","125","VM4");
INSERT INTO biomedical_model VALUES("228","53","COMBO");
INSERT INTO biomedical_model VALUES("229","128","ELISEE");
INSERT INTO biomedical_model VALUES("230","134","DEFIGARD 400");
INSERT INTO biomedical_model VALUES("231","62","SENOGRAPHE 600 T");
INSERT INTO biomedical_model VALUES("232","62","LOGIQ 5 PRO");
INSERT INTO biomedical_model VALUES("233","89","CT-ADV-9000");
INSERT INTO biomedical_model VALUES("234","4","CR35,CR NX SERVER");
INSERT INTO biomedical_model VALUES("235","154","XAVIO ADV PLUS");
INSERT INTO biomedical_model VALUES("236","138","MULTIMOBILE 2.5");
INSERT INTO biomedical_model VALUES("237","35","AUTO 3 ECM");
INSERT INTO biomedical_model VALUES("238","138","FLEXAVISION RF");
INSERT INTO biomedical_model VALUES("239","32","KMC 950");
INSERT INTO biomedical_model VALUES("240","139","SOMATON SPIRIT");
INSERT INTO biomedical_model VALUES("241","62","GENIUS 60");
INSERT INTO biomedical_model VALUES("242","4","DRYSTAR");
INSERT INTO biomedical_model VALUES("243","62","VOLUSON S8");
INSERT INTO biomedical_model VALUES("244","62","DR-F");
INSERT INTO biomedical_model VALUES("245","168","ZEIHM 8000");
INSERT INTO biomedical_model VALUES("246","68","DISCOVERY-A");
INSERT INTO biomedical_model VALUES("247","47","ELEKTA SYNERGY PLATFORM");
INSERT INTO biomedical_model VALUES("248","58","451P-RYR");
INSERT INTO biomedical_model VALUES("249","108","LAFD 2");
INSERT INTO biomedical_model VALUES("250","62","OHMEDA TRUSAT");
INSERT INTO biomedical_model VALUES("251","59","NJECTOMAT AGILIA");
INSERT INTO biomedical_model VALUES("252","117","Q-145-GIF");
INSERT INTO biomedical_model VALUES("253","117","BF-IT150");
INSERT INTO biomedical_model VALUES("254","158","FORCE FX");
INSERT INTO biomedical_model VALUES("255","134","TRUSCOPE");
INSERT INTO biomedical_model VALUES("256","117","CV 70");
INSERT INTO biomedical_model VALUES("257","117","CLV-160");
INSERT INTO biomedical_model VALUES("258","117","CF-Q160AL");
INSERT INTO biomedical_model VALUES("259","117","CF-V70L");
INSERT INTO biomedical_model VALUES("260","117","GIF V70");
INSERT INTO biomedical_model VALUES("261","117","TJF-V70");
INSERT INTO biomedical_model VALUES("262","159","SURYA 12+12 A&B");
INSERT INTO biomedical_model VALUES("263","40","MEGA SURG");
INSERT INTO biomedical_model VALUES("264","159","MLU16AND");
INSERT INTO biomedical_model VALUES("265","40","DERMAPEEL");
INSERT INTO biomedical_model VALUES("266","58","ESA620");
INSERT INTO biomedical_model VALUES("267","7","K2");
INSERT INTO biomedical_model VALUES("268","125","TC 20");
INSERT INTO biomedical_model VALUES("269","10","PROSOUND ALPHA");
INSERT INTO biomedical_model VALUES("270","62","VOLUSON S6");
INSERT INTO biomedical_model VALUES("271","108","COLPRO222DX-OZ VIEW");
INSERT INTO biomedical_model VALUES("272","28","AT-301");
INSERT INTO biomedical_model VALUES("273","127","4C");
INSERT INTO biomedical_model VALUES("274","57","AIRVO-2");
INSERT INTO biomedical_model VALUES("275","115","NIVIQURE-VR");
INSERT INTO biomedical_model VALUES("276","52","AC2-351");
INSERT INTO biomedical_model VALUES("277","85","NA");
INSERT INTO biomedical_model VALUES("278","71","NA");
INSERT INTO biomedical_model VALUES("279","108","NA");
INSERT INTO biomedical_model VALUES("280","94","NA");
INSERT INTO biomedical_model VALUES("281","25","NA");
INSERT INTO biomedical_model VALUES("282","127","NA");
INSERT INTO biomedical_model VALUES("283","1","E360");
INSERT INTO biomedical_model VALUES("284","166","NA");
INSERT INTO biomedical_model VALUES("285","98","NA");
INSERT INTO biomedical_model VALUES("286","126","NA");
INSERT INTO biomedical_model VALUES("287","62","Engstrom Carestation");
INSERT INTO biomedical_model VALUES("288","2","NA");
INSERT INTO biomedical_model VALUES("289","76","NA");
INSERT INTO biomedical_model VALUES("290","156","NA");
INSERT INTO biomedical_model VALUES("291","114","NA");
INSERT INTO biomedical_model VALUES("292","120","BT-37 WITH TRIGOR REGULATOR");
INSERT INTO biomedical_model VALUES("293","132","NA");
INSERT INTO biomedical_model VALUES("294","170","AESPIRE 7900");
INSERT INTO biomedical_model VALUES("295","118","NA");
INSERT INTO biomedical_model VALUES("296","96","NA");
INSERT INTO biomedical_model VALUES("297","117","UH1-2");
INSERT INTO biomedical_model VALUES("298","56","NA");
INSERT INTO biomedical_model VALUES("299","43","NA");
INSERT INTO biomedical_model VALUES("300","124","NA");
INSERT INTO biomedical_model VALUES("301","145","NA");
INSERT INTO biomedical_model VALUES("302","105","NA");
INSERT INTO biomedical_model VALUES("303","77","LIVANTEC");
INSERT INTO biomedical_model VALUES("304","45","NA");
INSERT INTO biomedical_model VALUES("305","42","NA");
INSERT INTO biomedical_model VALUES("306","119","NA");
INSERT INTO biomedical_model VALUES("307","140","NA");
INSERT INTO biomedical_model VALUES("308","146","NA");
INSERT INTO biomedical_model VALUES("309","147","NA");
INSERT INTO biomedical_model VALUES("310","117","NA");
INSERT INTO biomedical_model VALUES("311","157","NA");
INSERT INTO biomedical_model VALUES("312","102","NA");
INSERT INTO biomedical_model VALUES("314","136","NA");
INSERT INTO biomedical_model VALUES("315","49","NA");
INSERT INTO biomedical_model VALUES("317","166","MULTIWEIGH");
INSERT INTO biomedical_model VALUES("318","73","NA");
INSERT INTO biomedical_model VALUES("319","69","NA");
INSERT INTO biomedical_model VALUES("320","16","NA");
INSERT INTO biomedical_model VALUES("321","80","NA");
INSERT INTO biomedical_model VALUES("322","74","NA");
INSERT INTO biomedical_model VALUES("323","28","NA");
INSERT INTO biomedical_model VALUES("324","5","NA");
INSERT INTO biomedical_model VALUES("325","109","NA");
INSERT INTO biomedical_model VALUES("326","33","NA");
INSERT INTO biomedical_model VALUES("327","55","NA");
INSERT INTO biomedical_model VALUES("328","83","NA");
INSERT INTO biomedical_model VALUES("329","57","NA");



DROP TABLE complaint;

CREATE TABLE `complaint` (
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
  `bio_remark` varchar(70) DEFAULT NULL,
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
  KEY `locationid` (`locationid`),
  CONSTRAINT `complaint_ibfk_16` FOREIGN KEY (`zoneid`) REFERENCES `zone` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `complaint_ibfk_17` FOREIGN KEY (`assignedto`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `complaint_ibfk_18` FOREIGN KEY (`sourceid`) REFERENCES `source` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `complaint_ibfk_19` FOREIGN KEY (`departmentid`) REFERENCES `department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `complaint_ibfk_20` FOREIGN KEY (`locationid`) REFERENCES `location` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `complaint_ibfk_21` FOREIGN KEY (`groupid`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `complaint_ibfk_22` FOREIGN KEY (`subgroupid`) REFERENCES `subgroup` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `complaint_ibfk_23` FOREIGN KEY (`priorityid`) REFERENCES `priority` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `complaint_ibfk_24` FOREIGN KEY (`statusid`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `complaint_ibfk_25` FOREIGN KEY (`holdcategoryid`) REFERENCES `holdcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `complaint_ibfk_26` FOREIGN KEY (`createdby`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `complaint_ibfk_27` FOREIGN KEY (`updatedby`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3925 DEFAULT CHARSET=latin1;

INSERT INTO complaint VALUES("9","Maintenance-0000006","bed no 4 and 6 small tube light near the bed is not working ","regarding bed no 6 tube light already informed on saturday but work not done","5","","22","1","53","","2","5","3","5","","","","85","2014-03-24 08:28:25","16","2014-03-25 09:01:53","","","","");
INSERT INTO complaint VALUES("10","MIS-0000004","CT SCAN RECEPTION CANON PRINTER NOT WORKING ","CT SCAN RECEPTION CANON PRINTER NOT WORKING ","2","","5","1","91","","1","2","3","7","","1","","70","2014-03-24 09:35:22","5","2014-03-24 10:01:23","","","","");
INSERT INTO complaint VALUES("11","MIS-0000005","sage accpac is not working . system name bbh-lab-03","no error is showing ","2","","5","1","17","32","1","2","3","7","","1","","113","2014-03-24 10:35:15","5","2014-03-24 11:06:14","","","","");
INSERT INTO complaint VALUES("12","MIS-0000006","CRP -07 system is very slow. ","very urgent","2","","5","1","40","12","1","2","3","7","","1","","65","2014-03-24 11:17:23","65","2014-05-23 12:18:11","","","","");
INSERT INTO complaint VALUES("13","MIS-0000007","BUS-04 keyboard wire bitten by rat","Medium priority","2","","5","1","40","12","1","2","3","7","","1","","65","2014-03-24 11:19:12","65","2014-05-23 12:18:34","","","","");
INSERT INTO complaint VALUES("14","Maintenance-0000007","Back Office - Telephone ext 505 not working","Very urgent","8","","39","1","40","","2","8","3","7","","","","65","2014-03-24 11:19:53","65","2014-03-28 01:15:30","","","","");
INSERT INTO complaint VALUES("15","Maintenance-0000008","Electric heater is not working","Electric heater is not working","7","","33","1","54","","2","7","3","5","","","","114","2014-03-24 11:39:19","16","2014-03-25 09:51:58","","","","");
INSERT INTO complaint VALUES("16","MIS-0000008","Respected Madam,
INSERT INTO complaint VALUES("17","MIS-0000009","Pt name - manoj kumar
INSERT INTO complaint VALUES("18","MIS-0000010","Pt name Abinbiju 
INSERT INTO complaint VALUES("19","MIS-0000011","Pt name Abinbiju 
INSERT INTO complaint VALUES("20","MIS-0000012","New LH 780 to be interfaced ","ASAP ","2","","8","1","17","26","1","2","3","7","","630","","69","2014-03-24 14:04:02","69","2014-03-25 13:58:07","","","","");
INSERT INTO complaint VALUES("21","MIS-0000013","New LH 780 to be interfaced. ","Old LH 780 is interfaced with HIS , this needs to be removed and configured with new LH780 ","2","","8","1","17","27","1","2","3","7","","1","","9","2014-03-24 14:14:43","9","2014-03-25 07:32:29","","","","");
INSERT INTO complaint VALUES("22","MIS-0000014"," Wifi no network","Not working in medical library from yesterday","2","","5","1","25","","1","2","3","5","","1","","115","2014-03-24 14:19:47","5","2014-03-24 14:43:16","","","","");
INSERT INTO complaint VALUES("23","Maintenance-0000009","o2 cylinder empty","o2 cylinder changed","5","","22","1","53","","2","5","3","5","","","","85","2014-03-24 14:21:59","16","2014-03-25 09:05:16","","","","");
INSERT INTO complaint VALUES("24","MIS-0000015","Pt name - manoj kumar hsp no - aa234762
INSERT INTO complaint VALUES("25","MIS-0000016","aa250949, GANGADHARAPPA PATIENT IS IN ICU,
INSERT INTO complaint VALUES("26","MIS-0000017","GRN and Transfer Entry is not able to done in ACCpac","Error Message is Account entry header exists ","3","","9","1","28","","1","3","3","7","","","","117","2014-03-24 15:46:38","117","2014-03-24 16:06:06","","","","");
INSERT INTO complaint VALUES("27","MIS-0000018","out look express not able to open","urgent","3","","9","1","93","","1","3","3","7","","","urgent","79","2014-03-25 07:20:29","79","2014-03-25 07:31:30","","","","");
INSERT INTO complaint VALUES("28","Maintenance-0000010","both o2 cylinder empty","send urgent","5","","22","1","53","","2","5","3","5","","","","85","2014-03-25 07:25:47","16","2014-03-25 09:02:36","","","","");
INSERT INTO complaint VALUES("29","Maintenance-0000011","B-ROOM","TUBELIGHT IS NOT WORKING","5","","22","1","64","","2","5","3","7","","","","110","2014-03-25 07:36:04","110","2014-04-10 12:58:30","","","","");
INSERT INTO complaint VALUES("30","Maintenance-0000012","J-ROOM AND I-ROOM DISABLED TOILET","FLUSH WATER IS NOT COMING ","6","","32","1","64","","2","6","3","7","","","","110","2014-03-25 07:38:47","110","2014-04-10 12:58:04","","","","");
INSERT INTO complaint VALUES("31","Maintenance-0000013","NURSING STATION","WHEEL CHAIR TO BE REPAIRED","7","","33","1","64","","2","7","3","7","","","","110","2014-03-25 07:39:49","110","2014-04-10 12:57:30","","","","");
INSERT INTO complaint VALUES("32","MIS-0000019","Computer to be shifted from CMO to Administration 1 cabin","Urgent","2","","112","1","20","40","1","2","3","7","","1","","9","2014-03-25 07:39:53","9","2014-03-25 12:26:04","","","","");
INSERT INTO complaint VALUES("33","MIS-0000020","W4 CABIN COMPUTERS ARE NOT WORKING","N-COMPUTING SYSTEMS ARE NOT CONNECTING","3","","8","1","42","","1","3","3","7","","","","118","2014-03-25 07:42:09","118","2014-03-25 10:37:18","","","","");
INSERT INTO complaint VALUES("34","Maintenance-0000014","A-ROOM","GEYZER NOT WORKING","5","","22","1","64","","2","5","3","7","","","","110","2014-03-25 07:44:36","110","2014-04-10 12:57:03","","","","");
INSERT INTO complaint VALUES("35","MIS-0000021","Preparation of Certificates - BLS / PALS","Preparation of Certificates - BLS / PALS","3","","8","1","30","","1","3","3","7","","","","135","2014-03-25 08:21:31","135","2014-03-27 08:07:15","","","","");
INSERT INTO complaint VALUES("36","Maintenance-0000015","I-ROOM BED NO:9
INSERT INTO complaint VALUES("37","Maintenance-0000016","NURSING STATION","WHEEL CHAIR TO BE REPAIRED","7","","33","1","64","","2","7","3","7","","","","110","2014-03-25 08:26:30","110","2014-04-10 12:56:02","","","","");
INSERT INTO complaint VALUES("38","MIS-0000022","Shifting of computer","Work done","2","","112","1","94","","1","2","3","7","","1","","136","2014-03-25 09:03:40","136","2014-03-31 09:13:35","","","","");
INSERT INTO complaint VALUES("39","Maintenance-0000017","Annexe Tube light not working","Urgent ","5","","22","1","81","","2","5","3","7","","","","16","2014-03-25 09:10:20","16","2014-04-01 15:48:24","","","","");
INSERT INTO complaint VALUES("40","Maintenance-0000018","Phone not working","Phone not working","8","","39","1","81","","2","8","3","7","","","","16","2014-03-25 09:10:56","16","2014-04-01 15:50:41","","","","");
INSERT INTO complaint VALUES("41","Maintenance-0000019","Mobile suction Apparatus &  18 no Sterile stands to be fixed","Mobile suction Apparatus &  18 no Sterile stands to be fixed","7","","28","1","81","","2","7","3","7","2","","Due to Motor problem it will be delay","16","2014-03-25 09:11:52","16","2014-06-17 12:21:21","","","","");
INSERT INTO complaint VALUES("42","MIS-0000023","W4 CABIN ONE RIGHT SIDE N-COMPUTING SYSTEM NOT WORKING","N-COMPUTING SYSTEM ERROR","3","","8","1","42","","1","3","3","7","","","","118","2014-03-25 09:23:25","118","2014-03-25 10:36:09","","","","");
INSERT INTO complaint VALUES("43","Maintenance-0000020","o2 cylinder flow meter is broken","o2 flow meter to be fixed","7","","33","1","53","","2","7","3","5","","","","85","2014-03-25 09:29:48","16","2014-03-25 09:51:22","","","","");
INSERT INTO complaint VALUES("44","Maintenance-0000021","1. 1505 bathroom cupboard lock & key to be fixed
INSERT INTO complaint VALUES("45","MIS-0000024","Printer not working","Printer not working","2","","5","1","16","36","1","2","3","7","","630","","132","2014-03-25 09:55:55","132","2014-04-08 11:03:15","","","","");
INSERT INTO complaint VALUES("46","Maintenance-0000022","XRAY View box to be fixed in NICU","PLS COME FAST","9","","23","1","55","","2","9","3","5","","","","73","2014-03-25 09:59:40","16","2014-03-25 16:01:19","","","","");
INSERT INTO complaint VALUES("47","MIS-0000025"," new monitor connection","new monitor connection","2","","5","1","18","7","1","2","3","7","","630","","64","2014-03-25 10:06:11","64","2014-03-25 14:30:32","","","","");
INSERT INTO complaint VALUES("48","Maintenance-0000023","New locks to be fixed psychiatric room A,B & Utility room  ","New locks to be fixed psychiatric room A,B & Utility room  ","9","","23","1","62","","2","9","3","7","","","","16","2014-03-25 10:13:06","16","2014-04-01 15:46:49","","","","");
INSERT INTO complaint VALUES("49","Maintenance-0000024","Wheel chair break & wheels to be fixed","Wheel chair break & wheels to be fixed","7","","33","1","81","","2","7","3","7","","","","16","2014-03-25 10:15:33","16","2014-04-01 15:50:25","","","","");
INSERT INTO complaint VALUES("50","Maintenance-0000025","E room & J room & F room patient cot side rails to be fixed","E room & J room & F room patient cot side rails to be fixed","7","","33","1","60","","2","7","3","7","","","","16","2014-03-25 10:18:58","16","2014-04-01 15:50:33","","","","");
INSERT INTO complaint VALUES("51","Maintenance-0000026","Nurses room locker broken","Nurses room locker broken","9","","23","1","60","","2","9","3","7","","","","16","2014-03-25 10:19:29","16","2014-04-01 15:50:12","","","","");
INSERT INTO complaint VALUES("52","Maintenance-0000027","All photo therapy tube lights to be changed ","All photo therapy tube lights to be changed","7","","33","1","60","","2","7","3","7","","","","16","2014-03-25 10:20:51","16","2014-04-01 15:50:04","","","","");
INSERT INTO complaint VALUES("53","Maintenance-0000028","J room hand rub stand to be fixed","J room hand rub stand to be fixed","9","","23","1","60","","2","9","3","7","","","","16","2014-03-25 10:21:18","16","2014-04-01 15:49:55","","","","");
INSERT INTO complaint VALUES("54","Maintenance-0000029","NURSES STATION","WHEEL CHAIR TO BE REPAIRED","7","","33","1","64","","2","7","3","7","","","","110","2014-03-25 10:24:06","110","2014-04-10 12:54:38","","","","");
INSERT INTO complaint VALUES("55","Maintenance-0000030","MALE SIDE AND TREATMENT ROOM","NEW STERILIUM STAND TO BE FIXED","9","","23","1","64","","2","9","3","7","","","","110","2014-03-25 10:24:54","110","2014-04-10 12:53:52","","","","");
INSERT INTO complaint VALUES("56","Maintenance-0000031","Emergency Exit board to  be removed & fixed opposite wall","Urgent","9","","37","1","71","","2","9","3","5","","","","72","2014-03-25 10:28:00","227","2014-03-29 09:27:29","","","","");
INSERT INTO complaint VALUES("57","Maintenance-0000032","door stopper to be fix","door stopper to be fix","9","","23","1","54","","2","9","3","5","","","","114","2014-03-25 10:33:00","16","2014-03-25 16:00:45","","","","");
INSERT INTO complaint VALUES("58","MIS-0000026"," the mouse is not functioning properly in the nursing educators room.","1. i am not able to select the desired sentence while typing. Its delaying in responding to the click. ","2","","5","1","45","","1","2","3","5","","630","","93","2014-03-25 10:43:54","5","2014-03-25 11:51:15","","","","");
INSERT INTO complaint VALUES("59","MIS-0000027","Outlook express spelling check language need to be changed ","Change of language is not accepting ","3","","8","1","26","","1","3","3","7","","","Cheacking","76","2014-03-25 10:58:55","76","2014-03-25 13:50:42","","","","");
INSERT INTO complaint VALUES("60","MIS-0000028","bbh-mnt-01 Computer network not working ","Rectify soon ","2","","5","1","2","","1","2","3","7","","630","","16","2014-03-25 11:01:00","16","2014-03-25 12:42:25","","","","");
INSERT INTO complaint VALUES("61","MIS-0000029","In outlook express Adress need to be updated in PICU& NICU.","n outlook express Adress need to be updated in PICU& NICU.","2","","5","1","54","","1","2","3","5","","630","","114","2014-03-25 11:20:20","5","2014-03-25 16:48:06","","","","");
INSERT INTO complaint VALUES("62","MIS-0000030","Address not working properly ","the drop down on the address bar not working ","2","","5","1","94","37","1","2","3","5","","630","","147","2014-03-25 11:24:25","5","2014-03-25 11:50:19","","","","");
INSERT INTO complaint VALUES("63","Maintenance-0000033","Student hostel 2nd building 2nd floor entrance door beside plaster has come out & also sajja in other room corner is broken","attend soon","12","","386","2","2","","2","12","3","2","2","","complaint given to Mr Alfred because it is civil work","16","2014-03-25 11:37:53","227","2014-05-14 08:51:49","","","","");
INSERT INTO complaint VALUES("64","MIS-0000031","Zimbra desktop not opening.","To take backup of Old mails.","2","","5","1","69","","1","2","3","7","","630","","35","2014-03-25 11:41:00","35","2014-03-25 15:13:34","","","","");
INSERT INTO complaint VALUES("65","MIS-0000032","key board is not working , the system is too slow and strucks. in system -02","kindly do the needful","2","","112","1","50","","1","2","3","7","","630","","126","2014-03-25 11:56:45","126","2014-03-26 11:15:21","","","","");
INSERT INTO complaint VALUES("66","Maintenance-0000034","Keyboard tray & chair arm rest needs to be fixed properly","as soon as possible","9","","23","1","26","","2","9","3","7","","","","76","2014-03-25 11:58:58","76","2014-03-27 23:28:50","","","","");
INSERT INTO complaint VALUES("67","Maintenance-0000035","nitrogen & tripple gas cylinder to be filled                        
INSERT INTO complaint VALUES("68","Maintenance-0000036","Cup board ","locker to be fixed","9","","23","1","59","","2","9","3","5","","","","116","2014-03-25 12:18:25","16","2014-03-25 16:00:10","","","","");
INSERT INTO complaint VALUES("69","Maintenance-0000037","Wooden cupboards to be shifted from the Server Room to the MIS Work Area.","New location and other details are discussed with Mr.Vimal.","9","","37","1","3","","2","9","3","7","2","","Mr.Vimal is on leave today as soon he comes we will inform him to attend this complaint","9","2014-03-25 12:24:47","9","2014-04-15 08:37:27","","","","");
INSERT INTO complaint VALUES("70","Maintenance-0000038","Wodden box with Glass covering to be done for the Attendance machine","The details are discussed and shown to Mr.Vimal","9","","37","1","3","","2","9","3","5","2","","Mr.Vimal is on leave today as soon he comes we will inform him to attend this complaint","9","2014-03-25 12:28:13","37","2014-06-12 11:59:33","","","","");
INSERT INTO complaint VALUES("71","Maintenance-0000039","Trolley leaver to be fixed properly.","As soon as possible.","7","","33","1","62","","2","7","3","5","","","","107","2014-03-25 12:32:25","16","2014-03-25 13:26:39","","","","");
INSERT INTO complaint VALUES("72","Maintenance-0000040","high risk labour room cupboard locker to be repaired","Attend soon","9","","23","1","59","","2","9","3","7","","","","16","2014-03-25 12:54:25","16","2014-04-01 15:47:00","","","","");
INSERT INTO complaint VALUES("73","Maintenance-0000041","DR Room AC not working","DR Room AC not working","10","","39","1","90","","2","10","3","7","","","","16","2014-03-25 13:20:17","16","2014-04-01 15:49:20","","","","");
INSERT INTO complaint VALUES("74","Maintenance-0000042","New white board has to be fix on the wall","New white board has to be fix on the wall","9","","23","1","23","","2","9","3","5","","","","80","2014-03-25 13:22:25","16","2014-03-25 15:59:58","","","","");
INSERT INTO complaint VALUES("75","MIS-0000033","Request for Photograph","Photographs has to be taken on 26.03.2014, 8.15am at pharmacy store inauguration.Kindly requesting you to assign Mr.Udhay for the same.
INSERT INTO complaint VALUES("76","Maintenance-0000043","O2 cylinder to be filled","Complaint received on 24/3/14 10:30pm","7","","29","1","54","","2","7","3","7","","","","16","2014-03-25 13:37:19","16","2014-04-01 15:49:09","","","","");
INSERT INTO complaint VALUES("77","Maintenance-0000044","O2 cylinder to be filled","complaint received on 24/03/14","7","","29","1","64","","2","7","3","7","","","","16","2014-03-25 13:38:15","16","2014-04-01 15:48:50","","","","");
INSERT INTO complaint VALUES("78","Maintenance-0000045","Balken frame to be shift","Complaint received on 24/03/2014 9pm","5","","23","1","62","","2","5","3","7","","","","16","2014-03-25 13:39:08","16","2014-04-01 15:48:58","","","","");
INSERT INTO complaint VALUES("79","Maintenance-0000046","Nurses station tube light not working ","Complaint received on 24/03/2014 6pm","5","","22","1","49","","2","5","3","7","","","","16","2014-03-25 13:39:57","16","2014-04-01 15:48:38","","","","");
INSERT INTO complaint VALUES("80","Maintenance-0000047","2nd floor consultation room light not working & AC leaking ","come & rectify soon","5","","22","1","51","","2","5","3","7","","","","16","2014-03-25 13:43:27","16","2014-04-01 15:48:00","","","","");
INSERT INTO complaint VALUES("81","Maintenance-0000048","E room & pantry & G E toilet light not working ","E room & pantry & G E toilet light not working ","5","","22","1","63","","2","5","3","7","","","","16","2014-03-25 13:44:33","16","2014-04-01 15:46:41","","","","");
INSERT INTO complaint VALUES("82","Maintenance-0000049","E room commode side water leaking ","come & rectify soon","6","","31","1","63","","2","6","3","7","","","","16","2014-03-25 13:45:24","16","2014-04-01 15:47:09","","","","");
INSERT INTO complaint VALUES("83","Maintenance-0000050","HDU bed -1 to 4 suction to be repair & e-1,c-7,o2 to be fixed & i-1 suction not working ","come & check soon","7","","33","1","63","","2","7","3","7","","","","16","2014-03-25 13:46:31","16","2014-04-01 15:47:50","","","","");
INSERT INTO complaint VALUES("84","MIS-0000034","Few results are not being interfaced.Checked with Ms Pavithra (Technician )","ASAP ","3","","9","1","17","26","1","3","3","7","2","","Mr.Lijish from IDMsys will come and check the settings by tomorrow(26th March 2014)","69","2014-03-25 14:00:01","69","2014-04-09 13:17:31","","","","");
INSERT INTO complaint VALUES("85","Maintenance-0000051","Autoclave  not working ","ASAP ","5","","23","1","17","","2","5","3","7","","","","69","2014-03-25 14:01:04","69","2014-04-09 13:15:39","","","","");
INSERT INTO complaint VALUES("86","Maintenance-0000052","HDU E-ROOM","DOOR TO BE REPAIRED (EMERGENCY)","9","","23","1","64","","2","9","3","7","","","","110","2014-03-25 14:38:11","110","2014-04-10 12:53:03","","","","");
INSERT INTO complaint VALUES("87","Maintenance-0000053","plumber  will rectify","plumber  will rectify","6","","31","1","50","","2","6","3","7","","","","16","2014-03-25 15:39:17","16","2014-04-01 15:48:15","","","","");
INSERT INTO complaint VALUES("88","Maintenance-0000054","Ladies toilet under repair for three weeks still not rectified. Next  to second floor Lab 
INSERT INTO complaint VALUES("89","Maintenance-0000055","High risk labour room  enterance  door making sound.","door making noice","9","","23","1","59","","2","9","3","5","","","","116","2014-03-26 07:14:41","16","2014-03-26 07:58:24","","","","");
INSERT INTO complaint VALUES("90","MIS-0000035","AC Members on Website & Intranet to be updated.","Revised profiles are mailed as reference","3","","8","1","94","37","1","3","3","7","","","","137","2014-03-26 07:58:15","137","2014-04-01 14:45:16","","","","");
INSERT INTO complaint VALUES("91","Maintenance-0000056","One of the Ceiling fan complaint  to be replaced or repaired","Making huge noise ","5","","24","1","28","","2","5","3","5","","","","117","2014-03-26 08:00:06","16","2014-03-26 11:28:46","","","","");
INSERT INTO complaint VALUES("92","Maintenance-0000057","Tube light not working ","Send soon","5","","24","1","56","","2","5","3","7","","","","16","2014-03-26 08:01:24","16","2014-04-01 15:45:50","","","","");
INSERT INTO complaint VALUES("93","Maintenance-0000058","All the window mesh needs to be checked and most of the sliding window are not able to slide,needs to repaired. ","as early as possible.","9","","37","1","62","","2","9","3","3","2","","Outsource to be done due to major work","106","2014-03-26 08:04:48","37","2014-05-06 09:07:12","","","","");
INSERT INTO complaint VALUES("94","MIS-0000036","Ms office documents","dear uday, 
INSERT INTO complaint VALUES("95","Maintenance-0000059","Bathroom Geezer is not working","Bathroom Geezer is not working","6","","32","1","54","","2","6","3","5","","","","114","2014-03-26 08:49:35","16","2014-03-26 15:26:48","","","","");
INSERT INTO complaint VALUES("96","MIS-0000037","Patient Name : Uma Shree MRD No AA251099, unable to enter reports of HIV and HBsAg Test showing under pending analysis","Unable to enter reports in Accpacc","3","","6","1","17","27","1","3","3","7","","","","113","2014-03-26 08:51:33","113","2014-03-26 11:08:07","","","","");
INSERT INTO complaint VALUES("97","MIS-0000038","NURSING STATION-2","CPU IS NOT WORKING (EMERGENCY)","2","","5","1","64","22","1","2","3","7","","913","","110","2014-03-26 08:52:03","110","2014-04-10 12:52:09","","","","");
INSERT INTO complaint VALUES("98","Maintenance-0000060","MALE SIDE AND TREATMENT ROOM","NEW STERILIUM STAND TO BE FIXED ","9","","23","1","64","","2","9","3","7","","","","110","2014-03-26 08:53:30","110","2014-04-10 12:51:37","","","","");
INSERT INTO complaint VALUES("99","Maintenance-0000061","1.Nurses rest room cuboard to be changed and to have a hanger to keep the bags
INSERT INTO complaint VALUES("100","Maintenance-0000062","ladies Staff hostel Ms Vimala complained Flush is not working Room 15","Come soon","6","","31","2","2","","2","6","3","7","","","","16","2014-03-26 08:58:11","16","2014-04-01 15:43:58","","","","");
INSERT INTO complaint VALUES("101","Maintenance-0000063","Room \"F\" bathroom water is leaking from the tap.","retrify this as soon as possible","6","","32","1","65","","2","6","3","7","","","","84","2014-03-26 08:58:50","84","2014-04-21 10:20:49","","","","");
INSERT INTO complaint VALUES("102","Maintenance-0000064","room no 1515 bathroom flush not working, water leakage and cold water tap not proper there is a less flow of water.","please rectify immediately.","6","","32","1","49","","2","6","3","5","","","","97","2014-03-26 08:59:12","16","2014-03-26 11:08:48","","","","");
INSERT INTO complaint VALUES("103","Maintenance-0000065","1516 bathroom light not working","come soon","5","","24","1","49","","2","5","3","7","","","","16","2014-03-26 09:03:55","16","2014-04-01 15:45:42","","","","");
INSERT INTO complaint VALUES("104","MIS-0000039","system not working","urgent","2","","5","1","47","","1","2","3","7","","698","","149","2014-03-26 09:21:20","149","2014-03-26 22:18:54","","","","");
INSERT INTO complaint VALUES("105","MIS-0000040","Cadre report in the new HRMS
INSERT INTO complaint VALUES("106","Maintenance-0000066","2 wooden Chairs has been given for the rewiring (Repair) ","Given 3 weeks back, still not recieved","9","","37","1","30","","2","9","3","7","","","","148","2014-03-26 09:45:55","148","2014-06-05 09:17:37","","","","");
INSERT INTO complaint VALUES("107","Maintenance-0000067","Student Hostel 1st & 2nd floor washing area bathroom blocked ","come soon","6","","32","2","2","","2","6","3","7","","","","16","2014-03-26 10:01:24","16","2014-04-01 15:46:28","","","","");
INSERT INTO complaint VALUES("108","Maintenance-0000068","Ladies Toilet in the second floor near lab lobby is under repair and being locked  for more than two weeks.","Ladies Toilet in the second floor near lab lobby is under repair and being locked  for more than two weeks.","6","","32","1","17","","2","6","3","7","2","","major blockage in this toilet hence given to outsource waiting for approval ","113","2014-03-26 10:11:42","113","2014-05-08 14:08:23","","","","");
INSERT INTO complaint VALUES("109","MIS-0000041","C4,C9 Bed side","plug point to be fixed properly.","","","123","1","62","","1","3","3","7","","","null","107","2014-03-26 10:26:27","107","2014-03-26 10:26:27","","","","");
INSERT INTO complaint VALUES("110","MIS-0000042","bbh-mnt-01 network not working ","rectify soon","2","","5","1","2","","1","2","3","7","5","779","checking","16","2014-03-26 10:27:59","16","2014-04-01 15:46:00","","","","");
INSERT INTO complaint VALUES("111","MIS-0000043","D1,B1,E1 Bed side","Call Bell panel to be fixed.","","","123","1","62","","1","2","3","7","","","null","107","2014-03-26 10:29:36","107","2014-03-26 10:29:36","","","","");
INSERT INTO complaint VALUES("112","Maintenance-0000069","C4,C9 Bed side","plug point to be fixed properly.","5","","24","1","62","","2","5","3","5","","","","107","2014-03-26 10:29:51","16","2014-03-26 11:16:12","","","","");
INSERT INTO complaint VALUES("113","MIS-0000044","C4,C5,C8 Bed side.","Painting to be done.","","","123","1","62","","1","3","3","7","","","null","107","2014-03-26 10:31:18","107","2014-03-26 10:31:18","","","","");
INSERT INTO complaint VALUES("114","MIS-0000045","D4,B1,B2, Bed side.","Name Board to be fixed.","","","123","1","62","","1","3","3","7","","","null","107","2014-03-26 10:33:02","107","2014-03-26 10:33:02","","","","");
INSERT INTO complaint VALUES("115","Maintenance-0000070","D1,B1,E1 Bed side","Call Bell panel to be fixed.","8","","39","1","62","","2","8","3","5","","","","107","2014-03-26 10:34:44","16","2014-03-26 11:16:25","","","","");
INSERT INTO complaint VALUES("116","Maintenance-0000071","D4,B1,B2, Bed side.","Name Board to be fixed.","9","","23","1","62","","2","9","3","5","","","","107","2014-03-26 10:35:08","16","2014-03-27 08:12:15","","","","");
INSERT INTO complaint VALUES("117","Maintenance-0000072","C4,C5,C8 Bed side.","Painting to be done.","5","","21","1","62","","2","5","3","5","","","","107","2014-03-26 10:35:19","16","2014-03-26 11:18:01","","","","");
INSERT INTO complaint VALUES("118","MIS-0000046","D1,D4,Bed side.","Calling bell is not working.& Semi-side not coming sound.","","","123","1","62","","1","2","3","7","","","null","107","2014-03-26 10:35:37","107","2014-03-26 10:35:37","","","","");
INSERT INTO complaint VALUES("119","MIS-0000047","C4,E1&B1, Bed side.","O2 is leaking.","","","123","1","62","","1","3","3","7","","","null","107","2014-03-26 10:37:09","107","2014-03-26 10:37:09","","","","");
INSERT INTO complaint VALUES("120","MIS-0000048","D1 to C7 Bed.","Balkan prime to be fixed. ","","","123","1","62","","1","2","3","7","","","null","107","2014-03-26 10:39:06","107","2014-03-26 10:39:06","","","","");
INSERT INTO complaint VALUES("121","Maintenance-0000073","C4,C9 Bed side.","Plug point to be fixed properly.","5","","24","1","62","","2","5","3","5","","","","107","2014-03-26 10:45:48","16","2014-03-26 15:13:34","","","","");
INSERT INTO complaint VALUES("122","Maintenance-0000074","D1,B1,E1 Bed side.","Call bell panel to be fixed.","8","","39","1","62","","2","8","3","5","","","","107","2014-03-26 10:52:10","16","2014-03-26 11:25:11","","","","");
INSERT INTO complaint VALUES("123","Maintenance-0000075","C4,C5,C8 bed side.","Painting to be done.","5","","21","1","62","","2","5","3","3","6","","outsource to be done","107","2014-03-26 10:53:55","227","2014-05-06 09:54:11","","","","");
INSERT INTO complaint VALUES("124","Maintenance-0000076","D1,D4 Bed side.","Calling bell is not working.","8","","39","1","62","","2","8","3","5","","","","107","2014-03-26 10:56:34","16","2014-03-26 11:22:23","","","","");
INSERT INTO complaint VALUES("125","Maintenance-0000077","C4,E1,&B1.Bed side.","O2 wall mount is not working leaking. ","7","","33","1","62","","2","7","3","5","","","","107","2014-03-26 10:59:11","16","2014-03-26 15:13:15","","","","");
INSERT INTO complaint VALUES("126","Maintenance-0000078","D1&C7","Balkan prime to be fixed.","7","","33","1","62","","2","7","3","5","","","","107","2014-03-26 11:02:20","16","2014-03-26 11:38:17","","","","");
INSERT INTO complaint VALUES("127","Maintenance-0000079","Student Hostel 1st buldg flush not working","come soon","6","","31","2","2","","2","6","3","7","","","","16","2014-03-26 11:07:36","16","2014-04-01 15:38:26","","","","");
INSERT INTO complaint VALUES("128","Maintenance-0000080","O2 trolley empty","O2 trolley empty","7","","29","1","54","","2","7","3","7","","","","16","2014-03-26 11:46:38","16","2014-04-01 15:45:25","","","","");
INSERT INTO complaint VALUES("129","Maintenance-0000081","O2 cylinder to be filled","complaint received on 25/03/2014 10.45pm","7","","29","1","53","","2","7","3","7","","","","16","2014-03-26 11:47:18","16","2014-04-01 15:45:15","","","","");
INSERT INTO complaint VALUES("130","Maintenance-0000082","H room suction not working","complaint received on 25/03/14 @10.20pm ","7","","29","1","63","","2","7","3","7","","","","16","2014-03-26 11:48:48","16","2014-04-01 15:45:06","","","","");
INSERT INTO complaint VALUES("131","Maintenance-0000083","AC to be checked ","come soon","10","","39","1","108","","2","10","3","7","","","","16","2014-03-26 11:49:33","16","2014-04-01 15:44:57","","","","");
INSERT INTO complaint VALUES("132","Maintenance-0000084","cupboard key to be repair","come soon","9","","23","1","98","","2","9","3","7","","","","16","2014-03-26 11:50:11","16","2014-04-01 15:44:35","","","","");
INSERT INTO complaint VALUES("133","Maintenance-0000085","Store room","Cupboard loch to be fixed. ","9","","23","1","61","","2","9","3","5","","","","105","2014-03-26 11:55:55","16","2014-03-27 08:11:57","","","","");
INSERT INTO complaint VALUES("134","Maintenance-0000086","We need the services of Mr. Uday to take photographs on Sunday, 30 March 2014 from 2:45 p.m. to 4:30 p.m.
INSERT INTO complaint VALUES("135","Maintenance-0000087","Need plumber to DJ halli to give a estimate for wash basin,tap & outlet pipe ","Contact Mr.Suresh","6","","32","1","101","","2","6","3","7","","","","16","2014-03-26 12:07:22","16","2014-04-01 15:40:07","","","","");
INSERT INTO complaint VALUES("136","MIS-0000049","We need the services of Mr. Uday to take photographs on Sunday, 30 March 2014 from 2:45 p.m. to 4:30 p.m.
INSERT INTO complaint VALUES("137","MIS-0000050","printer ","Not working","2","","112","1","60","","1","2","3","5","","896","","103","2014-03-26 12:09:19","112","2014-03-26 20:38:25","","","","");
INSERT INTO complaint VALUES("138","Maintenance-0000088","Sterile room geyser not working","rectify soon","6","","31","1","58","","2","6","3","7","","","","16","2014-03-26 12:15:33","16","2014-04-01 15:44:15","","","","");
INSERT INTO complaint VALUES("139","Maintenance-0000089","1)Entrance door stoppers to be fixed.
INSERT INTO complaint VALUES("140","Maintenance-0000090","D1,D4,Bed side.","Calling bell is not working.& Semi-side not coming sound.","8","","39","1","62","","2","8","3","5","","","","107","2014-03-26 14:13:04","16","2014-03-26 15:12:04","","","","");
INSERT INTO complaint VALUES("141","MIS-0000051","Please transfer the computer of Dr. Naveen Thomas to Admin","Treat on top priority","2","","5","1","109","","1","2","3","7","","0","","151","2014-03-26 14:14:10","151","2014-03-26 14:17:47","","","","");
INSERT INTO complaint VALUES("142","MIS-0000052","Systems in library is not working . It is getting on & off","Urgent since students otherwise has to go outside to use the net for the study purpose  which is not possible. Kindly do it urgently. ","2","","112","4","24","","1","2","3","7","5","940","checking","153","2014-03-26 14:20:07","153","2014-04-11 16:00:47","","","","");
INSERT INTO complaint VALUES("143","Maintenance-0000091","Creche sink is blocked.","Creche sink is blocked.","","","3","1","54","","2","6","3","7","","","null","114","2014-03-26 14:36:49","114","2014-03-26 14:36:49","","","","");
INSERT INTO complaint VALUES("144","MIS-0000053","Creche sink is blocked.","Creche sink is blocked.","","","123","1","54","","1","","3","7","","","null","114","2014-03-26 14:37:39","45","2014-03-26 14:37:39","","","","");
INSERT INTO complaint VALUES("145","Maintenance-0000092","Creche sink is blocked.","Creche sink is blocked.","6","","31","1","54","","2","6","3","5","","","","114","2014-03-26 14:38:49","16","2014-03-26 15:49:56","","","","");
INSERT INTO complaint VALUES("146","MIS-0000054","internet id cannot be opened","not working","3","","112","1","53","","1","3","3","5","","","","119","2014-03-26 15:00:51","112","2014-03-26 15:14:47","","","","");
INSERT INTO complaint VALUES("147","Maintenance-0000093","Procedure room TV not working ","Come soon","8","","39","1","76","","2","8","3","7","","","","16","2014-03-26 15:06:38","16","2014-04-01 15:44:26","","","","");
INSERT INTO complaint VALUES("148","Maintenance-0000094","Duplicate key require 2no","urgent require","9","","23","1","98","","2","9","3","7","","","","16","2014-03-26 15:09:14","16","2014-04-01 15:38:42","","","","");
INSERT INTO complaint VALUES("149","Maintenance-0000095","kitchen Gas pipe line to be painted","make it soon","7","","26","1","68","","2","7","3","7","6","","outsource to be done ","16","2014-03-26 15:11:01","16","2014-04-28 14:14:55","","","","");
INSERT INTO complaint VALUES("150","Maintenance-0000096","C4,E1&B1, Bed side.","O2 is leaking.","7","","33","1","62","","2","7","3","5","","","","107","2014-03-26 15:11:58","16","2014-03-26 15:12:49","","","","");
INSERT INTO complaint VALUES("151","MIS-0000055","ms word is not opening","MS word is not opening","2","","5","1","59","","1","2","3","5","","921","","116","2014-03-26 16:41:22","5","2014-03-28 01:43:45","","","","");
INSERT INTO complaint VALUES("152","Maintenance-0000097","The bushes of many of the waiting chair sets in the common area are missing or broken. Arrange to replace them.","We are in the process of replacing some of the older chairs. Ask the carpenter to meet me or Mr. Solomon
INSERT INTO complaint VALUES("153","MIS-0000056","System in Room P6 was not getting connected to the network.","Please attend to it if not done already.","2","","112","1","79","","1","2","3","7","","0","","88","2014-03-27 06:56:21","88","2014-04-04 09:40:37","","","","");
INSERT INTO complaint VALUES("154","Maintenance-0000098","Room no:1520 sink is blocked","please rectify immediately","6","","30","1","49","","2","6","3","5","","","","71","2014-03-27 07:11:10","16","2014-03-26 20:46:34","","","","");
INSERT INTO complaint VALUES("155","Maintenance-0000099","D1 to C7 Bed.","Balkan prime to be fixed. ","7","","33","1","62","","2","7","3","5","","","","107","2014-03-27 07:17:34","16","2014-03-27 08:16:13","","","","");
INSERT INTO complaint VALUES("156","MIS-0000057","shift one printer to w1 from ip billing ","shift one printer to w1 from ip billing
INSERT INTO complaint VALUES("157","Maintenance-0000100","Bed No \"F\" Wall suction to be repaired urgently ","very urgent","7","","33","1","65","","2","7","3","7","","","","84","2014-03-27 07:20:09","84","2014-04-21 10:19:43","","","","");
INSERT INTO complaint VALUES("158","MIS-0000058","system is very slow and monitor is not working","system is very slow and monitor is not working","2","","5","1","16","19","1","2","3","7","","736","","132","2014-03-27 07:42:01","132","2014-04-08 11:02:35","","","","");
INSERT INTO complaint VALUES("159","Maintenance-0000101","Notice Board to be fixed.","very urgent","9","","23","1","65","","2","9","3","7","","","","84","2014-03-27 07:43:30","84","2014-04-21 10:19:28","","","","");
INSERT INTO complaint VALUES("160","MIS-0000059","Tally is showing Error and not opening","Urgent","3","","6","1","41","","1","3","3","5","","","","63","2014-03-27 07:44:25","6","2014-03-26 19:41:25","","","","");
INSERT INTO complaint VALUES("161","Maintenance-0000102","table nail to be fix","can u do ","9","","23","1","72","","2","9","3","5","","","","72","2014-03-27 07:51:09","16","2014-03-26 20:46:17","","","","");
INSERT INTO complaint VALUES("162","Maintenance-0000103","Sand to be taken out from the R O Plant","As early as possible","7","","26","1","56","","2","7","3","5","","","","120","2014-03-27 08:06:40","26","2014-04-16 08:48:24","","","","");
INSERT INTO complaint VALUES("163","MIS-0000060","Please make another certificate -
INSERT INTO complaint VALUES("164","Maintenance-0000104","commode chair to be repainted ","kindly do the needful a soon as possible ","9","","37","1","50","","2","9","3","7","2","","Please send chair to maintenance for painting","126","2014-03-27 08:20:31","126","2014-04-03 16:16:36","","","","");
INSERT INTO complaint VALUES("165","Maintenance-0000105","Wing 6 gets toilet commode door broken","urgent","9","","23","1","47","","2","9","3","7","","","","16","2014-03-27 08:34:12","16","2014-04-01 15:40:18","","","","");
INSERT INTO complaint VALUES("166","Maintenance-0000106","COPD handicap toilet commode water pressure is low to be checked ","do it soon","6","","30","1","47","","2","6","3","7","","","","16","2014-03-27 08:35:09","16","2014-04-01 15:43:49","","","","");
INSERT INTO complaint VALUES("167","Maintenance-0000107","COMPUTER  TABLES  KEY BOARD  STAND BROKEN  .  ","NEEDS TO  BE  REPAIRED  AND FIXED","9","","23","1","37","","2","9","3","5","","","","150","2014-03-27 08:40:29","16","2014-03-26 20:47:05","","","","");
INSERT INTO complaint VALUES("168","Maintenance-0000108","o2 cylender empty.","o2 cylender empty.","5","","25","1","81","","2","5","3","5","","","","99","2014-03-26 20:25:41","16","2014-03-26 20:33:09","","","","");
INSERT INTO complaint VALUES("169","Maintenance-0000109","O2 cylinder to be filled ","26-03-2014 11pm","7","","29","1","63","","2","7","3","7","","","","16","2014-03-26 20:50:15","16","2014-04-01 15:41:06","","","","");
INSERT INTO complaint VALUES("170","Maintenance-0000110","O2 cylinder to be filled ","26-03-2014 11pm","7","","29","1","65","","2","7","3","7","","","","16","2014-03-26 20:51:02","16","2014-04-01 15:40:59","","","","");
INSERT INTO complaint VALUES("171","MIS-0000061","laptop checking","laptop checking","2","","5","1","109","","1","2","3","7","","0","","152","2014-03-26 20:57:59","152","2014-03-28 21:27:01","","","","");
INSERT INTO complaint VALUES("172","Maintenance-0000111","Toilet light not working ","26-03-2014 10.15pm","7","","29","1","62","","2","7","3","7","","","","16","2014-03-26 21:00:49","16","2014-04-01 15:40:49","","","","");
INSERT INTO complaint VALUES("173","MIS-0000062","Request to prepare Plastic Surgery poster designing","the content and visuals has been already mailed to Mr.Uday","3","","8","1","34","","1","3","3","5","2","","Need Photos for the posters","173","2014-03-26 21:01:43","8","2014-05-01 11:16:37","","","","");
INSERT INTO complaint VALUES("174","Maintenance-0000112","Notice board to be fixed","26-03-2014 1pm","9","","23","1","68","","2","9","3","7","","","","16","2014-03-26 21:10:03","16","2014-04-01 15:40:36","","","","");
INSERT INTO complaint VALUES("175","Maintenance-0000113","O2 cylinder to be filled ","26-03-2014 3pm","5","","23","1","64","","2","5","3","7","","","","16","2014-03-26 21:10:30","16","2014-04-01 15:40:27","","","","");
INSERT INTO complaint VALUES("176","MIS-0000063","printers not working","printers not working","2","","5","1","16","17","1","2","3","7","","738","","132","2014-03-26 21:29:33","132","2014-04-08 11:01:24","","","","");
INSERT INTO complaint VALUES("177","MIS-0000064","unable to print pdf document","unable to print pdf document","3","","5","1","78","","1","3","3","7","","","","197","2014-03-26 21:46:28","197","2014-03-28 00:52:34","","","","");
INSERT INTO complaint VALUES("178","Maintenance-0000114","AC is not working in the OT Library Room,
INSERT INTO complaint VALUES("179","MIS-0000065","patient name and hospital number is showing different. Patient Adm no is adm000000092540, and hospital no is 304607 patient name is saraswathi. but name is showing Govind raj.S","saraswathi name is not there for that hospital no.","3","","9","1","53","","1","3","3","5","","","","119","2014-03-26 22:36:41","123","2014-03-26 22:51:16","","","","");
INSERT INTO complaint VALUES("180","Maintenance-0000115","High risk labour room Enterance door making sound"," Enterance door making sound","9","","23","1","59","","2","9","3","5","","","","116","2014-03-26 22:47:27","16","2014-03-28 19:09:00","","","","");
INSERT INTO complaint VALUES("181","MIS-0000066","NURSES STATION1","system not able to open","2","","5","1","64","21","1","2","3","7","","905","","108","2014-03-27 23:03:08","108","2014-04-29 08:55:01","","","","");
INSERT INTO complaint VALUES("182","Maintenance-0000116","canteen fan not working","come soon","5","","23","1","68","","2","5","3","7","","","","16","2014-03-27 23:04:48","16","2014-04-01 15:38:52","","","","");
INSERT INTO complaint VALUES("183","Maintenance-0000117","HDU BED NO E-5","BALCAN FRAME TO BE FIXED","7","","33","1","64","","2","7","3","7","","","","108","2014-03-27 23:05:45","108","2014-04-29 08:54:16","","","","");
INSERT INTO complaint VALUES("184","MIS-0000067","Hsp no aa115147
INSERT INTO complaint VALUES("185","Maintenance-0000118","Birthing room Door handle to be fixed","Door handle to be fixed","9","","23","1","59","","2","9","3","5","","","","116","2014-03-27 23:19:36","16","2014-03-28 21:13:45","","","","");
INSERT INTO complaint VALUES("186","MIS-0000068","request for mouse pad","i need one mouse pad ","2","","9","1","26","","1","2","3","7","","0","","76","2014-03-27 23:32:20","76","2014-03-28 20:05:06","","","","");
INSERT INTO complaint VALUES("187","MIS-0000069","Installation of  software for  Dr. Philip Thomas Laptop","Please treat this on top priority","2","","5","1","109","","1","2","3","5","","0","","151","2014-03-27 23:57:40","5","2014-03-28 02:13:36","","","","");
INSERT INTO complaint VALUES("188","Maintenance-0000119","Ceiling fan which is near entrance to be fixed for 8th bed.","As early as possible","5","","23","1","56","","2","5","3","5","","","","120","2014-03-28 00:06:06","16","2014-03-28 01:44:36","","","","");
INSERT INTO complaint VALUES("189","Maintenance-0000120","Staff toilet blocked.","urgent ","6","","31","1","71","","2","6","3","5","","","","77","2014-03-28 00:09:23","16","2014-03-28 01:43:35","","","","");
INSERT INTO complaint VALUES("190","Maintenance-0000121","Ladies staff hostel 1st floor room no 4 fan not working ","informed by kalyani","5","","23","2","2","","2","5","3","7","","","","16","2014-03-28 00:25:14","16","2014-04-01 15:37:49","","","","");
INSERT INTO complaint VALUES("191","MIS-0000070","sticker setting to be change ","sticker setting to be change ","2","","112","1","16","19","1","2","3","7","","736","","132","2014-03-28 00:26:46","132","2014-04-08 11:01:07","","","","");
INSERT INTO complaint VALUES("192","Maintenance-0000122","five steel chairs broken in Multipurpose hall and their arms to be fixed .","urgent","7","","28","4","107","","2","7","3","7","6","","informed to send chair to maintenance for repair","153","2014-03-28 00:27:15","153","2014-06-05 09:42:29","","","","");
INSERT INTO complaint VALUES("193","MIS-0000071","There is a nwe born baby hospno AA251596name is B/O subhashini.j we need semi bnt bed.","As soon as possible.
INSERT INTO complaint VALUES("194","MIS-0000072","CRP-05    Mouse and keyboard not working","Very urgent","2","","5","1","40","12","1","2","3","7","","702","","65","2014-03-28 01:12:45","65","2014-03-28 18:50:37","","","","");
INSERT INTO complaint VALUES("195","Maintenance-0000123","utility room wood coming out to be fixed.","as soon as possible ","9","","23","1","63","","2","9","3","7","","","","87","2014-03-28 01:44:03","87","2014-04-07 15:40:07","","","","");
INSERT INTO complaint VALUES("196","Maintenance-0000124","key board stand to be fixed","key board stand to be fixed","9","","37","1","59","","2","9","3","4","1","","sliding channel no stock non stock raised ","116","2014-03-28 02:28:37","37","2014-05-06 09:09:13","","","","");
INSERT INTO complaint VALUES("197","Maintenance-0000125","TV AND CALL BELL IS NOT WORKING","CLEAR IT AS SOON AS POSSIBLE","8","","39","1","50","","2","8","3","7","","","","184","2014-03-28 03:14:29","184","2014-04-06 13:51:29","","","","");
INSERT INTO complaint VALUES("198","MIS-0000073","This is For Software Test","This is For Software Test","3","","6","3","28","","1","3","3","5","4","0","This is not a complaint today\'s","45","2014-03-28 04:12:21","6","2014-06-05 08:27:05","20140401122430_dhl1.JPG#20140401124453_suryaleaveletter.docx#","","","");
INSERT INTO complaint VALUES("199","Maintenance-0000126","HDU E-5","SUCTION APPARATUS IS NOT WORKING","7","","33","1","64","","2","7","3","7","","","","110","2014-03-28 17:53:44","110","2014-04-10 12:50:46","","","","");
INSERT INTO complaint VALUES("200","Maintenance-0000127","side drill broken , need to fix for trolley.","side drill broken , need to fix for trolley.","7","","33","1","81","","2","7","3","5","","","","99","2014-03-28 18:05:00","16","2014-03-28 21:16:30","","","","");
INSERT INTO complaint VALUES("201","MIS-0000074","Not able to take print out from Sr.Vedaleena system i.e. Nsg-02","Not able to take print out from Sr.Vedaleena system i.e. Nsg-02","2","","112","1","45","","1","2","3","5","","765","","92","2014-03-28 18:05:46","112","2014-03-28 18:33:39","","","","");
INSERT INTO complaint VALUES("202","Maintenance-0000128","NURSES STATION","OYGEN CYLINDER IS EMPTY","5","","25","1","64","","2","5","3","7","","","","110","2014-03-28 18:09:58","110","2014-04-10 12:49:59","","","","");
INSERT INTO complaint VALUES("203","MIS-0000075","System name BUS-08 is not working. Power is coming but system is not booting","Urgent","2","","112","1","41","","1","2","3","5","","717","","63","2014-03-28 18:09:58","112","2014-03-28 18:32:33","","","","");
INSERT INTO complaint VALUES("204","MIS-0000076","copy rate list file from pen drive to phebe share folder","copy rate list file from pen drive to phebe share folder","2","","6","1","42","","1","2","3","5","","653","","118","2014-03-28 18:10:32","6","2014-03-28 20:50:15","","","","");
INSERT INTO complaint VALUES("205","Maintenance-0000129","I-ROOM BED NO:8 AND MALE SIDE H-ROOM BED NO:6","SIDE RAILS IS NOT WORKING","7","","33","1","64","","2","7","3","7","","","","110","2014-03-28 18:11:27","110","2014-04-10 12:48:56","","","","");
INSERT INTO complaint VALUES("206","Maintenance-0000130","HDU SINK","SINK IS BLOCKED","6","","32","1","64","","2","6","3","7","","","","110","2014-03-28 18:12:18","110","2014-04-10 12:48:09","","","","");
INSERT INTO complaint VALUES("207","MIS-0000077","In Rem-02 system if i want to take reports like service tax report, op bill reg, it shows as Database connector error please do the rectification as soon as possible.","In Rem-02 system if i want to take reports like service tax report, op bill reg, it shows as Database connector error please do the rectification as soon as possible.","3","","6","1","42","","1","3","3","7","","","","223","2014-03-28 18:20:26","223","2014-03-28 20:33:26","","","","");
INSERT INTO complaint VALUES("208","Maintenance-0000131","O2 cylinder empty","please send urgently","5","","25","1","53","","2","5","3","5","","","","119","2014-03-28 18:39:48","16","2014-03-28 20:40:09","","","","");
INSERT INTO complaint VALUES("209","Maintenance-0000132","nursing station  cupboard is broken","need to be urgent","9","","23","1","60","","2","9","3","5","","","","103","2014-03-28 18:44:40","16","2014-03-28 21:02:02","","","","");
INSERT INTO complaint VALUES("210","Maintenance-0000133","EPABX room 2 tube llight not working","electrician will come & rectify","5","","25","1","2","","2","5","3","7","","","","16","2014-03-28 18:54:51","16","2014-04-01 15:39:14","","","","");
INSERT INTO complaint VALUES("211","Maintenance-0000134","Table drawer screw to be fixed  
INSERT INTO complaint VALUES("212","MIS-0000078","Unable to switch on the computer interfaced for LH 780","Urgent ","2","","5","1","17","26","1","2","3","7","","817","","69","2014-03-28 19:10:10","69","2014-04-09 13:16:51","","","","");
INSERT INTO complaint VALUES("213","MIS-0000079","Principals internet connection is not working","urgent","2","","112","4","107","","1","2","3","7","","939","","153","2014-03-28 19:11:27","153","2014-03-28 22:39:49","","","","");
INSERT INTO complaint VALUES("214","Maintenance-0000135","Wing-VI Male General Toilet cupboard is broken","as soon as possible ","9","","23","1","65","","2","9","3","7","","","","84","2014-03-28 19:29:05","84","2014-04-21 10:19:04","","","","");
INSERT INTO complaint VALUES("215","Maintenance-0000136","Cup-board locking problem","cup-board locking problem","9","","23","1","45","","2","9","3","5","","","","92","2014-03-28 19:47:47","16","2014-03-28 21:14:17","","","","");
INSERT INTO complaint VALUES("216","MIS-0000080","W-3 (IPB-06)OP BILL VERIFICATION NOT OPENING","W-3 (IPB-06)OP BILL VERIFICATION NOT OPENING","3","","5","1","42","","1","3","3","5","","","","118","2014-03-28 19:59:28","5","2014-03-28 21:01:21","","","","");
INSERT INTO complaint VALUES("217","MIS-0000081","pt admitted on 26/3/14 , but in the system it showing 
INSERT INTO complaint VALUES("218","MIS-0000082","H.no-282209, Chinnappa pt was admitted on 26/3/14,but in the system it is wrong DOA on-25/3/14,
INSERT INTO complaint VALUES("219","Maintenance-0000137","1.2 sinks block
INSERT INTO complaint VALUES("220","Maintenance-0000138","ladies toilet commode to be fixed","come soon","6","","32","2","65","","2","6","3","7","","","","16","2014-03-28 21:12:34","16","2014-04-01 15:38:17","","","","");
INSERT INTO complaint VALUES("221","Maintenance-0000139","phone stand to be fixed","come soon","9","","23","1","70","","2","9","3","7","","","","16","2014-03-28 21:15:48","16","2014-04-01 15:38:07","","","","");
INSERT INTO complaint VALUES("222","Maintenance-0000140","Wheel  to be fixed properly","rectify soon","7","","33","1","58","","2","7","3","7","","","","16","2014-03-28 21:17:54","16","2014-04-01 15:37:57","","","","");
INSERT INTO complaint VALUES("223","Maintenance-0000141","MLE SIDE TOILET","COMMODE IS BLOCKED","6","","32","1","64","","2","6","3","7","","","","110","2014-03-28 21:52:01","110","2014-04-10 12:47:43","","","","");
INSERT INTO complaint VALUES("224","Maintenance-0000142","Cub board to be fixed in PICU to keep Hazardous materials","Urgent
INSERT INTO complaint VALUES("225","MIS-0000083","zimbra desktop installation","zimbra desktop installation","2","","5","1","98","","1","2","3","7","","0","","152","2014-03-28 21:52:50","152","2014-03-28 21:54:41","","","","");
INSERT INTO complaint VALUES("226","Maintenance-0000143","Cub board to be fixed in NICU to keep Hazardous materials","Urgent","9","","37","1","55","","2","9","3","3","6","","outsource to be done due to new requirement","73","2014-03-28 21:55:10","37","2014-05-06 09:09:54","","","","");
INSERT INTO complaint VALUES("227","MIS-0000084","BUSSINESS DEVELOPMENT OFFICE, SYSTEM PROBLEM.","TO RECTIFY SYSTEM PROBLEM","2","","5","1","91","","1","2","3","7","","0","","70","2014-03-28 22:14:40","70","2014-03-28 22:16:14","","","","");
INSERT INTO complaint VALUES("228","Maintenance-0000144","from w- 4 b-1 bed balgone frame to be transfer to
INSERT INTO complaint VALUES("229","Maintenance-0000145","trolley  wheel is not moving ","oil to be put for the wheels","7","","33","1","53","","2","7","3","5","","","","119","2014-03-28 22:57:44","16","2014-03-28 16:15:55","","","","");
INSERT INTO complaint VALUES("230","Maintenance-0000146","Ortho sterip instrument 2no to be repair","do it soon","7","","26","1","58","","2","7","3","5","6","","outsource given","124","2014-03-28 22:59:41","26","2014-05-05 09:10:34","","","","");
INSERT INTO complaint VALUES("231","Maintenance-0000147","washing galli trap blocked ","come soon","6","","32","1","68","","2","6","3","7","","","","16","2014-03-28 13:40:57","16","2014-04-01 15:39:42","","","","");
INSERT INTO complaint VALUES("232","MIS-0000085","inventory is not opening in my password kindly do the needful
INSERT INTO complaint VALUES("233","MIS-0000086","system has became slow ","DO it soon plz","2","","5","1","58","13","1","2","3","5","","885","","124","2014-03-28 14:29:38","5","2014-03-28 14:32:30","","","","");
INSERT INTO complaint VALUES("234","Maintenance-0000148","Commode water is very dirty","commode water is very dirty","6","","32","1","59","","2","6","3","5","","","","116","2014-03-28 14:43:33","16","2014-03-28 16:16:45","","","","");
INSERT INTO complaint VALUES("235","Maintenance-0000149","Nurse call bell system is not working. ","Kindly do rectify it at the earliest. Thank you.","8","","33","1","52","","2","8","3","7","","","","128","2014-03-28 15:27:32","128","2014-04-10 08:48:20","","","","");
INSERT INTO complaint VALUES("236","Maintenance-0000150","INSTALLATION OF NEW GAS STOVE IN WASHING ROOM","URGENT","7","","28","1","17","","2","7","3","7","","","","113","2014-03-28 15:31:38","113","2014-04-01 16:15:14","","","","");
INSERT INTO complaint VALUES("237","Maintenance-0000151","Incubator temp.is high inside .","Urgent ","7","","26","1","17","","2","7","3","7","","","","69","2014-03-28 16:03:21","69","2014-06-11 09:54:51","","","","");
INSERT INTO complaint VALUES("238","MIS-0000087","pacs images are not working","pacs images are not working","2","","5","1","92","","1","2","3","7","","0","","228","2014-03-28 16:08:05","228","2014-03-28 16:40:30","","","","");
INSERT INTO complaint VALUES("239","Maintenance-0000152","\"B\" Room Bathroom door is making noise and even TV is not working","very urgent","9","","37","1","65","","2","9","3","7","","","","84","2014-03-28 16:33:15","84","2014-04-21 10:18:50","","","","");
INSERT INTO complaint VALUES("240","Maintenance-0000153","hanging wires to be fixed in CT scan entrance","make it soon","11","","26","1","2","","2","11","3","7","","","","16","2014-03-28 16:42:47","16","2014-04-01 15:39:24","","","","");
INSERT INTO complaint VALUES("241","Maintenance-0000154","TV cable not working","rectify soon","8","","34","1","50","","2","8","3","7","","","","16","2014-03-29 08:32:09","16","2014-04-01 15:37:37","","","","");
INSERT INTO complaint VALUES("242","Maintenance-0000155","There is some loose connection in the mike system and not working properly& today farewell programme  is fixed at 10 am","urgent","8","","33","4","107","","2","8","3","7","","","","153","2014-03-29 08:42:40","153","2014-04-11 16:00:13","","","","");
INSERT INTO complaint VALUES("243","Maintenance-0000156","CUPBOARDS LOCKS  IN THE LINEN STORE TO BE REPAIRED. ","URGENT.","9","","37","1","84","","2","9","3","5","","","","149","2014-03-29 08:53:23","37","2014-03-29 12:05:05","","","","");
INSERT INTO complaint VALUES("244","Maintenance-0000157","bed side commod leg is rusted and broken","it is to be repaired and painted","7","","28","1","53","","2","7","3","5","","","","119","2014-03-29 09:08:23","227","2014-04-04 13:31:34","","","","");
INSERT INTO complaint VALUES("245","MIS-0000088","systems are very slow","systems are very slow","3","","5","1","16","19","1","3","3","7","","","","132","2014-03-29 09:22:45","132","2014-03-29 09:39:53","","","","");
INSERT INTO complaint VALUES("246","MIS-0000089","system not working","urgent     ","2","","5","1","16","35","1","2","3","7","","742","","132","2014-03-29 09:40:29","132","2014-03-29 09:41:32","","","","");
INSERT INTO complaint VALUES("247","Maintenance-0000158","TUBE LIGHT IN REGISTRATION COUNTER IS NOT WORKING PROPERLY (FLICKERING)","PLEASE ATTEND AT EARLIEST.","5","","22","1","110","","2","5","3","5","","","","224","2014-03-29 09:43:03","22","2014-03-29 12:30:55","","","","");
INSERT INTO complaint VALUES("248","Maintenance-0000159","O2 cylinder to be filled","attend soon ","5","","23","1","54","","2","5","3","7","","","","227","2014-03-29 09:55:10","227","2014-04-01 15:53:56","","","","");
INSERT INTO complaint VALUES("249","Maintenance-0000160","Suction apparatus leaking","technician will rectify","7","","29","1","52","","2","7","3","7","","","","227","2014-03-29 09:56:10","227","2014-04-01 15:53:46","","","","");
INSERT INTO complaint VALUES("250","Maintenance-0000161","O2 cylinder to be filled","attend soon","7","","29","1","81","","2","7","3","7","","","","227","2014-03-29 09:56:53","227","2014-04-01 15:53:37","","","","");
INSERT INTO complaint VALUES("251","Maintenance-0000162","O2 cylinder to be filled","attend soon","7","","29","1","63","","2","7","3","7","","","","227","2014-03-29 09:57:47","227","2014-04-01 15:53:19","","","","");
INSERT INTO complaint VALUES("252","Maintenance-0000163","O2 cylinder to be filled","attend soon","7","","29","1","50","","2","7","3","7","","","","227","2014-03-29 09:58:32","227","2014-04-01 15:53:11","","","","");
INSERT INTO complaint VALUES("253","Maintenance-0000164","electrician will rectify","attend soon","5","","24","1","49","","2","5","3","7","","","","227","2014-03-29 09:59:37","227","2014-04-01 15:52:57","","","","");
INSERT INTO complaint VALUES("254","Maintenance-0000165","PICU PRINTER TO BE CHECKED","PICU PRINTER TO BE CHECKED","8","","33","1","54","","2","8","3","5","","","","114","2014-03-29 09:59:57","227","2014-04-01 15:33:29","","","","");
INSERT INTO complaint VALUES("255","MIS-0000090","system is hanging","system is hanging","3","","5","1","16","19","1","3","3","7","","","","132","2014-03-29 10:01:36","132","2014-04-07 15:46:09","","","","");
INSERT INTO complaint VALUES("256","MIS-0000091","printer is not working","printer is not working","2","","112","1","16","19","1","2","3","7","","739","","132","2014-03-29 10:02:22","132","2014-04-08 10:59:52","","","","");
INSERT INTO complaint VALUES("257","Maintenance-0000166","Need to fix new fan in MRD storing area","Need to fix new fan in MRD storing area","5","","22","1","16","","2","5","3","7","","","","132","2014-03-29 10:03:34","132","2014-04-08 10:59:33","","","","");
INSERT INTO complaint VALUES("258","Maintenance-0000167","student hostel 1st floor bathroom & sinks are blocked","plumber will rectify","6","","31","2","2","","2","6","3","7","","","","227","2014-03-29 10:09:57","227","2014-04-01 15:52:40","","","","");
INSERT INTO complaint VALUES("259","Maintenance-0000168","Wheel chair handle is removed to be fixed","very urgent","7","","28","1","65","","2","7","3","7","","","","84","2014-03-29 10:10:02","84","2014-04-21 10:18:27","","","","");
INSERT INTO complaint VALUES("260","Maintenance-0000169","patient bed cot is moving contiunously, since if it is locked also ","very urgent","7","","28","1","65","","2","7","3","2","1","","wheels non stock raised ","84","2014-03-29 10:11:29","28","2014-06-12 11:23:30","","","","");
INSERT INTO complaint VALUES("261","Maintenance-0000170","OT auto clave room exhuast fan has to be repair","attend soon","5","","25","1","58","","2","5","3","7","","","","227","2014-03-29 10:12:34","227","2014-04-01 15:52:30","","","","");
INSERT INTO complaint VALUES("262","Maintenance-0000171","O2 cylinder to be filled","attend soon ","7","","27","1","50","","2","7","3","7","","","","227","2014-03-29 10:13:14","227","2014-04-01 15:52:19","","","","");
INSERT INTO complaint VALUES("263","Maintenance-0000172","O2 cylinder to be filled","attend soon","7","","27","1","60","","2","7","3","7","","","","227","2014-03-29 10:14:26","227","2014-04-01 15:51:51","","","","");
INSERT INTO complaint VALUES("264","Maintenance-0000173","Hand dryer not working","to be rectified immediately","5","","22","1","53","","2","5","3","5","","","","119","2014-03-29 10:16:28","22","2014-04-03 16:41:19","","","","");
INSERT INTO complaint VALUES("265","Maintenance-0000174","Central OPD Mens toilet mirror is broken.","Needs replacement.","9","","37","1","37","","2","9","3","5","","","","150","2014-03-29 10:21:30","37","2014-03-29 12:05:28","","","","");
INSERT INTO complaint VALUES("266","Maintenance-0000175","O2 cylinder to be filled","28/03/2014   11:40pm","7","","27","1","62","","2","7","3","7","","","","225","2014-03-29 10:21:31","225","2014-04-29 12:13:03","","","","");
INSERT INTO complaint VALUES("267","Maintenance-0000176","O2 cylinder to be filled","28/03/2014  11:30pm","7","","27","1","65","","2","7","3","7","","","","225","2014-03-29 10:22:48","225","2014-04-29 12:12:57","","","","");
INSERT INTO complaint VALUES("268","Maintenance-0000177","O2 cylinder to be filled","28/03/2014 11:15pm","7","","27","1","49","","2","7","3","7","","","","225","2014-03-29 10:23:49","225","2014-04-29 12:12:52","","","","");
INSERT INTO complaint VALUES("269","Maintenance-0000178","O2 cylinder to be filled","28/03/2014 11:20pm","7","","27","1","54","","2","7","3","7","","","","225","2014-03-29 10:24:43","225","2014-04-29 12:12:43","","","","");
INSERT INTO complaint VALUES("270","Maintenance-0000179","O2 cylinder to be filled","28/03/2014","7","","27","1","53","","2","7","3","7","","","","225","2014-03-29 10:25:24","225","2014-04-29 12:12:38","","","","");
INSERT INTO complaint VALUES("271","MIS-0000092","PICU Printer is not working.","PICU Printer is not working.","3","","5","1","54","","1","3","3","5","","","","114","2014-03-29 10:30:46","5","2014-03-29 10:52:32","","","","");
INSERT INTO complaint VALUES("272","Maintenance-0000180","wheel chair handle serew to be fix.","as soon possiple.","7","","28","1","63","","2","7","3","7","","","","87","2014-03-29 10:32:10","87","2014-04-07 15:39:49","","","","");
INSERT INTO complaint VALUES("273","MIS-0000093","system is very slow , pl look into this problem today 
INSERT INTO complaint VALUES("274","Maintenance-0000181","HDU E-1","TUBELIGHT IS NOT WORKING","5","","22","1","64","","2","5","3","7","","","","110","2014-03-29 10:41:57","110","2014-04-10 12:47:14","","","","");
INSERT INTO complaint VALUES("275","Maintenance-0000182","HDU DOOR","HANDLE TO BE FIXED AND DOOR TO BE REPAIRED","9","","37","1","64","","2","9","3","7","","","","110","2014-03-29 10:42:56","110","2014-04-10 12:46:39","","","","");
INSERT INTO complaint VALUES("276","Maintenance-0000183","NURSES STATION-1","TILES TO BE FIXED","12","","386","1","64","","2","12","3","5","6","","outsource to be done","110","2014-03-29 10:43:52","227","2014-05-28 15:30:40","","","","");
INSERT INTO complaint VALUES("277","MIS-0000094","PICU PRINTER TO BE CHECKED","PICU PRINTER TO BE CHECKED","2","","5","1","54","","1","2","3","5","","888","","114","2014-03-29 10:45:24","5","2014-03-29 12:30:35","","","","");
INSERT INTO complaint VALUES("278","Maintenance-0000184","Lock require for back side door in 1st floor","needed urgent","9","","37","1","68","","2","9","3","7","","","","16","2014-03-29 11:08:49","16","2014-04-10 13:31:53","","","","");
INSERT INTO complaint VALUES("279","Maintenance-0000185","Fire extinguisher calibration to be done","due is over","11","","21","1","68","","2","11","3","7","6","","AMC renewal to be done for current ","16","2014-03-29 11:10:12","16","2014-05-10 08:54:53","","","","");
INSERT INTO complaint VALUES("280","Maintenance-0000186","Sink blocked ","attend soon","6","","30","1","78","","2","6","3","5","6","","Major work hence it will delay","16","2014-03-29 11:13:00","30","2014-06-19 12:53:43","","","","");
INSERT INTO complaint VALUES("281","Maintenance-0000187","water not coming in all the bathrooms","rectify soon","6","","30","1","52","","2","6","3","7","","","","16","2014-03-29 11:16:54","16","2014-04-01 15:37:17","","","","");
INSERT INTO complaint VALUES("282","MIS-0000095","op-bill verification not comming(ipb-04)","op-bill verification not comming(ipb-04)","3","","6","1","42","","1","3","3","5","","","","118","2014-03-29 11:52:56","6","2014-03-29 13:59:50","","","","");
INSERT INTO complaint VALUES("283","Maintenance-0000188","o2 cylinder empty","o2 cylinder empty","5","","22","1","54","","2","5","3","5","","","","114","2014-03-29 12:12:15","22","2014-04-01 15:58:46","","","","");
INSERT INTO complaint VALUES("284","Maintenance-0000189","Room HDU bed d-3 suction to be fix.","as soon as possible.","7","","28","1","63","","2","7","3","7","","","","87","2014-03-29 12:15:14","87","2014-04-07 15:39:31","","","","");
INSERT INTO complaint VALUES("285","Maintenance-0000190","patients complaining of room ‘J’ toilet door making some noise kindly rectify the problem.","kindly do the needful.
INSERT INTO complaint VALUES("286","Maintenance-0000191","CAUTION BOARD TO BE FIXED ","CAUTION BOARD TO BE FIXED ","9","","37","1","14","","2","9","3","5","","","","70","2014-03-29 12:32:18","227","2014-04-01 09:30:55","","","","");
INSERT INTO complaint VALUES("287","MIS-0000096","Mohammed farhan AA228202 they got medicines for 2days in credit .then informed mrd staff grace to change in system . But still child getting medicines in credit please do need full work","Mohammed farhan AA228202 they got medicines for 2days in credit .then informed mrd staff grace to change in system . But still child getting medicines in credit please do need full work","3","","6","5","54","","1","3","3","5","","","","114","2014-03-29 12:49:43","6","2014-03-31 08:52:45","","","","");
INSERT INTO complaint VALUES("288","Maintenance-0000192","NEW, Required an over head cabinet and wooden ledge at the out patient pharmacy","please make the above requirement from the available material.","9","","37","1","18","","2","9","3","7","","","","64","2014-03-29 12:50:09","64","2014-04-17 10:16:21","","","","");
INSERT INTO complaint VALUES("289","Maintenance-0000193","REMOVE BALKEN FRAME FROM E5 BED FROM HDU","AS TO BE REMOVE","7","","27","1","64","24","2","7","3","7","","","","110","2014-03-29 14:37:53","110","2014-04-10 12:46:08","","","","");
INSERT INTO complaint VALUES("290","Maintenance-0000194","O2 EMPTY","O2 EMPTY","11","","27","1","54","","2","11","3","5","","","","114","2014-03-29 19:56:57","227","2014-04-01 08:31:51","","","","");
INSERT INTO complaint VALUES("291","Maintenance-0000195","02CYLINDER EMPTY","O2CYLINDER EMPTY","11","","27","1","54","","2","11","3","5","","","","114","2014-03-29 22:36:06","227","2014-04-01 08:32:04","","","","");
INSERT INTO complaint VALUES("292","Maintenance-0000196","Oxygen cylinder is empty.","Please fill it at the earliest.","7","","27","1","81","","2","7","3","7","","","","128","2014-03-30 09:15:10","128","2014-04-10 08:47:58","","","","");
INSERT INTO complaint VALUES("293","Maintenance-0000197","O2 cylinder to be filled","attend soon","5","","23","1","65","","2","5","3","7","","","","225","2014-03-31 08:38:45","225","2014-04-29 12:12:32","","","","");
INSERT INTO complaint VALUES("294","Maintenance-0000198","Light is not working & smoke is coming in cleaning area","attend soon","5","","23","1","58","","2","5","3","7","","","","225","2014-03-31 08:40:46","225","2014-04-29 12:12:14","","","","");
INSERT INTO complaint VALUES("295","Maintenance-0000199","I-room toilet light is not working","29/03/2014","5","","25","1","61","","2","5","3","7","","","","225","2014-03-31 08:42:29","225","2014-04-29 12:12:04","","","","");
INSERT INTO complaint VALUES("296","Maintenance-0000200","NEED TO CHECK O2 CYLENDER..SOME SCRUE CAME.","NEED TO CHECK O2 CYLENDER..SOME SCRUE CAME.","7","","29","1","81","","2","7","3","5","","","","99","2014-03-31 08:42:56","227","2014-04-01 09:26:04","","","","");
INSERT INTO complaint VALUES("297","Maintenance-0000201","grinder to be weilding","attend soon","7","","26","1","68","","2","7","3","7","","","","225","2014-03-31 08:44:57","225","2014-04-29 12:11:53","","","","");
INSERT INTO complaint VALUES("298","Maintenance-0000202","G room Roof light is blinking ","as soon as possible","5","","24","1","65","","2","5","3","7","","","","84","2014-03-31 08:48:38","84","2014-04-21 10:17:08","","","","");
INSERT INTO complaint VALUES("299","Maintenance-0000203","G ROOM  SWITCH BOARD IS BROKEN AND
INSERT INTO complaint VALUES("300","MIS-0000097"," wing-one 03 system is not working","need to be urgent","2","","5","1","60","","1","2","3","5","","894","","103","2014-03-31 08:56:56","5","2014-03-31 09:35:33","","","","");
INSERT INTO complaint VALUES("301","Maintenance-0000204","patient cot side rails to be fixe","need to be urgent","9","","37","1","60","","2","9","3","5","","","","103","2014-03-31 08:59:17","227","2014-03-31 11:51:30","","","","");
INSERT INTO complaint VALUES("302","MIS-0000098","CRP-06 (Mrs.Cynthia) - Print option for OP Pharmacy bills.","Had sent mail 1 month back - Medium","3","","9","1","40","11","1","3","3","7","","","","65","2014-03-31 09:01:17","65","2014-04-01 10:52:38","","","","");
INSERT INTO complaint VALUES("303","MIS-0000099","saving option for Non-Medical Expenses in provisional bill - AccPac","high priority","3","","6","1","40","12","1","3","3","5","5","","Provide MRD no of any patient , for whom you want to save non medical expenses","65","2014-03-31 09:04:34","6","2014-04-22 08:38:30","","","","");
INSERT INTO complaint VALUES("304","MIS-0000100","system not working, mouse not working","please rectify imediately","2","","5","1","49","","1","2","3","5","","918","","97","2014-03-31 09:06:15","5","2014-03-31 09:35:46","","","","");
INSERT INTO complaint VALUES("305","Maintenance-0000205","nursing station cupboard is broken","need to be urgent","9","","37","1","60","","2","9","3","5","","","","103","2014-03-31 09:10:30","227","2014-04-01 09:29:48","","","","");
INSERT INTO complaint VALUES("306","Maintenance-0000206","O2 cylinder to be filled","attend soon","5","","25","1","23","","2","5","3","7","","","","225","2014-03-31 09:39:23","225","2014-04-29 12:12:22","","","","");
INSERT INTO complaint VALUES("307","MIS-0000101","wing-one 01 system space bar is not working","need to be urgent","3","","5","1","60","","1","3","3","5","","","","103","2014-03-31 09:50:00","5","2014-03-31 14:18:50","","","","");
INSERT INTO complaint VALUES("308","Maintenance-0000207","birthing room  T.V. IS not working","T.V  is not working","8","","34","1","59","","2","8","3","5","","","","116","2014-03-31 10:05:22","227","2014-03-31 11:53:57","","","","");
INSERT INTO complaint VALUES("309","Maintenance-0000208","High risk labor room cup board locker to be fixed","locker to be fixed","9","","37","1","59","","2","9","3","5","","","","116","2014-03-31 10:06:27","227","2014-04-01 09:30:33","","","","");
INSERT INTO complaint VALUES("310","Maintenance-0000209","tubelight not working","argent","5","","23","1","72","","2","5","3","5","","","","219","2014-03-31 10:13:27","227","2014-03-31 11:53:12","","","","");
INSERT INTO complaint VALUES("311","MIS-0000102","system not working","02 system not working","3","","5","1","61","","1","3","3","5","","","","105","2014-03-31 10:24:25","5","2014-03-31 10:55:55","","","","");
INSERT INTO complaint VALUES("312","MIS-0000103","outlook express is missing on the desktop","outlook express is missing on the desktop","3","","5","1","23","","1","3","3","5","","","","80","2014-03-31 10:33:20","5","2014-03-31 10:55:39","","","","");
INSERT INTO complaint VALUES("313","MIS-0000104","computer not working.","kindly do the needful urgently.","3","","5","1","79","","1","3","3","7","","","","216","2014-03-31 11:16:03","216","2014-03-31 11:17:43","","","","");
INSERT INTO complaint VALUES("314","Maintenance-0000210","Staff ladies toilet hand wash sink water is leakage","attend soon","6","","31","1","47","","2","6","3","7","","","","227","2014-03-31 11:21:40","227","2014-04-01 15:51:41","","","","");
INSERT INTO complaint VALUES("315","Maintenance-0000211","Toilet ","D-room toilet commode  sheet broken","6","","31","1","61","","2","6","3","5","","","","105","2014-03-31 11:45:55","227","2014-03-31 15:06:48","","","","");
INSERT INTO complaint VALUES("316","MIS-0000105","Computer not working
INSERT INTO complaint VALUES("317","Maintenance-0000212","J-ROOM","FLUSH IS NOT WORKING","6","","30","1","64","","2","6","3","7","","","","110","2014-03-31 12:47:45","110","2014-04-10 12:45:11","","","","");
INSERT INTO complaint VALUES("318","Maintenance-0000213","Ladies staff hostel 1 tube light  & 1st floor fan repaired","attend soon","5","","22","2","2","","2","5","3","7","","","","227","2014-03-31 13:37:15","227","2014-04-01 15:34:06","","","","");
INSERT INTO complaint VALUES("319","MIS-0000106","CRP-02 not working","High Priority","2","","5","1","40","11","1","2","3","7","","700","","65","2014-03-31 13:58:37","65","2014-04-01 10:46:36","","","","");
INSERT INTO complaint VALUES("320","Maintenance-0000214","Ladies hostel 3rd building . door closing & opening not properly","attend soon","9","","37","2","2","","2","9","3","7","","","","225","2014-03-31 15:02:09","225","2014-04-29 12:11:36","","","","");
INSERT INTO complaint VALUES("321","Maintenance-0000215","refrigerator thermometer showing high temperature 17.5"," refrigerator is present in PC OPD - PC ROOM NO 6 (Paed room ).","7","","26","1","102","","2","7","3","5","","","","97","2014-03-31 15:08:24","227","2014-03-31 16:14:58","","","","");
INSERT INTO complaint VALUES("322","MIS-0000107","Re-installation of system.","Urgent","2","","5","1","17","25","1","2","3","7","","822","","69","2014-03-31 15:19:12","69","2014-04-09 13:15:54","","","","");
INSERT INTO complaint VALUES("323","MIS-0000108","C D ram to be fixed in the CPU desk . ","Urgent ","2","","5","1","80","","1","2","3","7","","0","","72","2014-03-31 15:54:14","72","2014-04-01 09:31:08","","","","");
INSERT INTO complaint VALUES("324","Maintenance-0000216","NURSES STATION ","PA SYSTEM IS NOT WORKING","5","","21","1","64","","2","5","3","7","","","","110","2014-03-31 16:18:04","110","2014-04-10 12:44:45","","","","");
INSERT INTO complaint VALUES("325","Maintenance-0000217","Need electrical extension board","attend soon","5","","24","1","58","","2","5","3","7","","","","225","2014-03-31 16:29:19","225","2014-04-29 12:11:24","","","","");
INSERT INTO complaint VALUES("326","MIS-0000109","Kindly change the file into pdf","pls send to dr. spurgeon","3","","8","1","94","37","1","3","3","7","","","","136","2014-03-31 16:47:03","136","2014-04-03 09:16:11","","","","");
INSERT INTO complaint VALUES("327","Maintenance-0000218","TOILET FLUSH IS NOT WORKING IN F ROOM AND F3 FAN IS NOT FIXED","BOTH THE COMPLAINT IS CLEARED","6","","31","1","61","","2","6","3","5","","","","105","2014-03-31 17:49:17","227","2014-04-01 08:32:31","","","","");
INSERT INTO complaint VALUES("328","Maintenance-0000219","room no 1507-1 bed lamp bulb is broken","kindly fix it as soon as possible.","7","","27","1","49","","2","7","3","5","","","","97","2014-03-31 20:04:48","227","2014-04-01 08:33:31","","","","");
INSERT INTO complaint VALUES("329","MIS-0000110","Not able to send mail. says the size has exceeded the servers limit and also that the server is not functioning.and connection is lost.","kindly do the needful.","3","","5","1","46","","1","3","3","5","","","","258","2014-04-01 08:29:14","5","2014-04-01 08:34:51","","","","");
INSERT INTO complaint VALUES("330","MIS-0000111","pcw-01 system not working always it gets hanged in between.","please rectify immediately.","2","","112","1","49","","1","2","3","5","","918","","97","2014-04-01 08:30:07","112","2014-04-01 08:59:49","","","","");
INSERT INTO complaint VALUES("331","Maintenance-0000220","OUR BBH AMBULANCE O2 CYLENDER IS EMPTY.","OUR BBH AMBULANCE O2 CYLENDER IS EMPTY.","11","","27","1","81","","2","11","3","5","","","","99","2014-04-01 08:32:24","227","2014-04-01 08:33:48","","","","");
INSERT INTO complaint VALUES("332","Maintenance-0000221","Wing6 - Gents toilet western toilet commode to be repaired. ","urgent.","6","","32","1","47","","2","6","3","5","","","","149","2014-04-01 08:48:20","16","2014-04-01 11:16:24","","","","");
INSERT INTO complaint VALUES("333","Maintenance-0000222","wing 6 lobby - gents toilet cupboard door to be repairedd.","Very urgent.","9","","37","1","47","","2","9","3","5","","","","149","2014-04-01 08:49:39","227","2014-04-01 09:29:14","","","","");
INSERT INTO complaint VALUES("334","Maintenance-0000223","Fridge thermometer is not working","Urgent","7","","28","1","54","","2","7","3","5","","","","73","2014-04-01 08:53:17","28","2014-04-02 10:52:28","","","","");
INSERT INTO complaint VALUES("335","Maintenance-0000224","FAN SWITCH LOOSE AND NOT WORKING","ARGENT","5","","24","1","72","","2","5","3","5","","","","219","2014-04-01 09:11:17","24","2014-04-01 15:57:06","","","","");
INSERT INTO complaint VALUES("336","Maintenance-0000225","tube light is not working","to be replace ","5","","24","1","110","","2","5","3","5","","","","214","2014-04-01 09:11:56","24","2014-04-01 15:57:42","","","","");
INSERT INTO complaint VALUES("337","MIS-0000112","desk top file every thing is to be replace ( outlook express, savior, statistics........","please do the need full ","2","","5","1","71","","1","2","3","5","","0","","214","2014-04-01 09:13:49","5","2014-04-01 09:26:45","","","","");
INSERT INTO complaint VALUES("338","Maintenance-0000226","TABLE NAIL TO BE FIX .WHITE BOARD NAIL TO BE  FIX","ARGENT","9","","37","1","72","","2","9","3","5","","","","219","2014-04-01 09:24:33","227","2014-04-02 11:10:49","","","","");
INSERT INTO complaint VALUES("339","Maintenance-0000227","LPG Gas line /  stove not working.
INSERT INTO complaint VALUES("340","Maintenance-0000228","Nut on the chair handle is loose","Kindly attend at the earliest","7","","28","1","78","","2","7","3","5","","","","261","2014-04-01 09:47:50","28","2014-04-01 12:07:55","","","","");
INSERT INTO complaint VALUES("341","Maintenance-0000229","o2 cylinder empty to be change now. ","as soon as possible.","7","","29","1","63","","2","7","3","7","","","","87","2014-04-01 09:53:42","87","2014-04-07 15:39:14","","","","");
INSERT INTO complaint VALUES("342","MIS-0000113","Admin front computer is not working.","not working","2","","5","1","94","","1","2","3","7","4","0","smps has send for repair","136","2014-04-01 10:00:29","136","2014-04-03 09:17:56","","","","");
INSERT INTO complaint VALUES("343","MIS-0000114","printer","printer is not working","2","","112","1","60","","1","2","3","5","","894","","103","2014-04-01 10:00:46","112","2014-04-01 10:09:55","","","","");
INSERT INTO complaint VALUES("344","Maintenance-0000230","cupboard","nursing station cupboard is broken","9","","37","1","60","","2","9","3","5","","","","103","2014-04-01 10:01:41","37","2014-04-01 12:54:26","","","","");
INSERT INTO complaint VALUES("345","Maintenance-0000231","Pharmacy Store sink blocked","Kindly requesting you to send personnel to attend the blockage in the sink.
INSERT INTO complaint VALUES("346","Maintenance-0000232","HDU  E ROOM","DOOR TO BE REPAIRED EMERGENCY","9","","37","1","64","","2","9","3","3","9","","outsource to be done","110","2014-04-01 10:22:19","37","2014-06-12 12:00:30","","","","");
INSERT INTO complaint VALUES("347","Maintenance-0000233","In Histopathology telephone is working.","if outside calls comes ringing sound won\'t hear so please check it know.","8","","33","1","17","","2","8","3","7","","","","113","2014-04-01 10:22:30","113","2014-04-01 16:18:01","","","","");
INSERT INTO complaint VALUES("348","Maintenance-0000234","HDU E ROOM","TOILET COMMODE CLAMP TO BE FIXED","6","","32","1","64","24","2","6","3","7","","","","110","2014-04-01 10:23:27","110","2014-04-10 12:44:14","","","","");
INSERT INTO complaint VALUES("349","Maintenance-0000235","kindly fix one fan in nurses station ","as soon as possible ,pleses","5","","24","1","62","","2","5","3","5","","","","106","2014-04-01 10:23:49","24","2014-04-02 13:52:17","","","","");
INSERT INTO complaint VALUES("350","MIS-0000115","Could u please help me with details of pt.dhananjaya ,hos.no.AA240832,adm.on 14.01.14.I want know the total expenses incurred on the pharmacy bill.They have paid for few med and availed some on credit.","patient is still in the ward.There are few issues with the family.This information will help us decide on the concession .
INSERT INTO complaint VALUES("351","MIS-0000116","Could u please help me with details of pt.dhananjaya ,hos.no.AA240832,adm.on 14.01.14.I want know the total expenses incurred on the pharmacy bill.They have paid for few med and availed some on credit.","patient is still in the ward.There are few issues with the family.This information will help us decide on the concession .
INSERT INTO complaint VALUES("352","Maintenance-0000236","need to paint all bedside patient box(cupboards).","need to paint all bedside patient box(cupboards).","9","","37","1","81","","2","9","3","3","2","","User not sent boxes for painting","99","2014-04-01 11:07:46","37","2014-05-06 09:10:59","","","","");
INSERT INTO complaint VALUES("353","Maintenance-0000237","kindly arrange the duplicate keys for patient rooms /patient lockers and general store  things cupboard , ","kindly do the needful.","9","","37","1","50","","2","9","3","5","","","","182","2014-04-01 11:13:06","37","2014-04-09 08:49:16","","","","");
INSERT INTO complaint VALUES("354","Maintenance-0000238","ladies toilet blocked ","attend soon","6","","32","1","65","","2","6","3","7","","","","16","2014-04-01 11:17:50","16","2014-04-01 15:37:01","","","","");
INSERT INTO complaint VALUES("355","Maintenance-0000239","canteen over head tank cover to be replace","replace soon","6","","32","1","2","","2","6","3","7","","","","16","2014-04-01 11:23:34","16","2014-04-01 15:36:27","","","","");
INSERT INTO complaint VALUES("356","Maintenance-0000240","bed raiser not working need to fix properly.","bed raiser not working need to fix properly.","7","","28","1","81","","2","7","3","5","","","","99","2014-04-01 11:39:19","28","2014-04-01 12:07:44","","","","");
INSERT INTO complaint VALUES("357","MIS-0000117","Papers are getting stuck in the printer","high priority","2","","112","1","40","12","1","2","3","7","","702","","65","2014-04-01 11:44:40","65","2014-04-03 09:43:03","","","","");
INSERT INTO complaint VALUES("358","MIS-0000118","ENT DOCTOR ROOM COMPUTER NOT WORKING","URGENT","2","","112","1","76","","1","2","3","5","","860","","206","2014-04-01 11:46:34","112","2014-04-01 12:39:39","","","","");
INSERT INTO complaint VALUES("359","Maintenance-0000241","D-1 bed side","Food end to be fixed.","7","","28","1","61","","2","7","3","5","6","","welding to be done by outsource","107","2014-04-01 11:49:15","227","2014-04-07 12:08:03","","","","");
INSERT INTO complaint VALUES("360","Maintenance-0000242","To,
INSERT INTO complaint VALUES("361","Maintenance-0000243","Door Stopper needs  to be fixed in the  Academic Centre Office room ","rectify soon","9","","37","1","105","","2","9","3","7","","","","16","2014-04-01 12:41:20","16","2014-04-01 15:36:38","","","","");
INSERT INTO complaint VALUES("362","Maintenance-0000244","Rooms  B-4,B-5,F-4, calling bell is not working to be check.","kindly do the needful. ","8","","33","1","63","","2","8","3","7","6","","After AMC taken vendor will rectify the problem due to major work","87","2014-04-01 12:45:11","87","2014-05-22 11:51:44","","","","");
INSERT INTO complaint VALUES("363","MIS-0000119","Kindly burn 13 Communication DVDs, ","Dr. Badari\'s request","3","","5","1","94","","1","3","3","7","5","","                                          ","136","2014-04-01 12:47:08","136","2014-04-19 10:24:38","","","","");
INSERT INTO complaint VALUES("364","MIS-0000120","outlook express inbox is not opening.  ","kidnly do the need full","2","","5","1","52","","1","2","3","5","","886","","154","2014-04-01 12:49:41","5","2014-04-01 12:50:52","","","","");
INSERT INTO complaint VALUES("365","MIS-0000121","Door Stopper needs  to be fixed in the  Academic Centre Office room ","rectify soon","","","123","1","105","","1","","3","7","","","","16","2014-04-01 12:55:37","37","2014-04-01 12:55:37","","","","");
INSERT INTO complaint VALUES("366","Maintenance-0000245","Door Stopper needs  to be fixed in the  Academic Centre Office room ","rectify soon","9","","37","1","105","","2","9","3","7","","","","16","2014-04-01 13:06:14","16","2014-04-10 13:31:44","","","","");
INSERT INTO complaint VALUES("367","Maintenance-0000246","suction not working & light not working","rectify soon","7","","27","1","49","","2","7","3","7","","","","16","2014-04-01 13:08:12","16","2014-04-01 15:36:13","","","","");
INSERT INTO complaint VALUES("368","Maintenance-0000247","o2 cylinder to be replaced ","replace soon","7","","27","1","81","","2","7","3","7","","","","16","2014-04-01 13:08:50","16","2014-04-01 15:35:59","","","","");
INSERT INTO complaint VALUES("369","Maintenance-0000248","o2 cylinder to be replace","replace soon","7","","27","1","50","","2","7","3","7","","","","16","2014-04-01 13:09:22","16","2014-04-01 15:35:31","","","","");
INSERT INTO complaint VALUES("370","Maintenance-0000249","o2 cylinder to be replace","01-04-2014 6.25am","7","","27","1","50","","2","7","3","7","","","","16","2014-04-01 13:09:58","16","2014-04-01 15:35:40","","","","");
INSERT INTO complaint VALUES("371","Maintenance-0000250","store room light not working","01-04-2014 6.30am","7","","27","1","61","","2","7","3","7","","","","16","2014-04-01 13:11:13","16","2014-04-01 15:35:18","","","","");
INSERT INTO complaint VALUES("372","Maintenance-0000251","O2 cylinder to be replace","31-03-2014 10.pm","7","","27","1","81","","2","7","3","7","","","","16","2014-04-01 13:11:53","16","2014-04-01 15:35:48","","","","");
INSERT INTO complaint VALUES("373","Maintenance-0000252","o2 cylinder to be replace","31-03-2014 8.25pm","7","","29","1","81","","2","7","3","7","","","","16","2014-04-01 13:12:33","16","2014-04-01 15:34:46","","","","");
INSERT INTO complaint VALUES("374","Maintenance-0000253","This is 2nd reminder Delivery cots to be painted
INSERT INTO complaint VALUES("375","MIS-0000122","in deluxe system -01 is hanged ,unable to operate","kindly do the needful","2","","112","1","50","","1","2","3","7","","916","","126","2014-04-01 13:30:21","126","2014-04-01 16:10:05","","","","");
INSERT INTO complaint VALUES("376","MIS-0000123","unable to indent store items ","unable to indent store items","3","","6","1","59","51","1","3","3","5","","","","116","2014-04-01 13:37:06","6","2014-04-01 16:53:40","","","","");
INSERT INTO complaint VALUES("377","Maintenance-0000254","Weighing scale .","Weighing scale is not working","11","","28","1","62","","2","11","3","5","","","","107","2014-04-01 14:01:09","227","2014-04-01 14:34:03","","","","");
INSERT INTO complaint VALUES("378","Maintenance-0000255","wooden chair ","wooden chair which was sent for repair on 19th april ,did not received yet . kindly do the needful. 
INSERT INTO complaint VALUES("379","Maintenance-0000256","o2 cylender is empty.....","o2 cylender is empty.....","5","","22","1","81","","2","5","3","5","","","","99","2014-04-01 14:48:05","22","2014-04-01 15:58:56","","","","");
INSERT INTO complaint VALUES("380","Maintenance-0000257","Soap dispenser to be fixed","attend soon","9","","37","1","68","","2","9","3","7","","","","16","2014-04-01 14:59:42","16","2014-04-10 13:31:36","","","","");
INSERT INTO complaint VALUES("381","Maintenance-0000258","f1 wall mounted fan ","making noise.","5","","24","1","61","","2","5","3","5","","","","104","2014-04-01 15:05:51","24","2014-04-02 15:45:17","","","","");
INSERT INTO complaint VALUES("382","MIS-0000124","Outlook express in library system is not opening","urgent","2","","112","4","107","","1","2","3","7","","942","","153","2014-04-01 15:06:20","153","2014-04-11 15:59:28","","","","");
INSERT INTO complaint VALUES("383","Maintenance-0000259","table leg broken ","to be fix table leg ","9","","37","1","74","","2","9","3","5","","","","214","2014-04-01 15:11:08","227","2014-04-02 11:11:30","","","","");
INSERT INTO complaint VALUES("384","Maintenance-0000260","Qtrs Dr Girish house chamber blocked ","rectify soon","6","","30","1","2","","2","6","3","7","","","","16","2014-04-01 15:17:05","16","2014-04-10 13:31:28","","","","");
INSERT INTO complaint VALUES("385","Maintenance-0000261","Qtrs Dr.Girish house switch not working","rectify soon","5","","24","3","2","","2","5","3","7","","","","16","2014-04-01 15:17:34","16","2014-04-10 13:31:19","","","","");
INSERT INTO complaint VALUES("386","MIS-0000125","Rectification of false GRN entry and transfer","on the basis of Financial Year Accounting2013 - 14.","3","","9","1","29","","1","3","3","7","5","","required date in GRN to be given ie exact date of GRNdate (please check the invoice date and decide the grndate in these transactions)
INSERT INTO complaint VALUES("387","MIS-0000126","W4 IP BILLING PRINTER NOT WORKING","W4 IP BILLING PRINTER NOT WORKING","2","","112","1","42","","1","2","3","5","","658","","118","2014-04-01 15:33:12","112","2014-04-01 15:56:47","","","","");
INSERT INTO complaint VALUES("388","MIS-0000127","Unable to enter the report of cross match.
INSERT INTO complaint VALUES("389","MIS-0000128","N Computing for PMS 02 is not connecting","Please send your personnel to rectify the same.
INSERT INTO complaint VALUES("390","Maintenance-0000262","O2 cylinder to be filled","attend soon","7","","29","1","65","","2","7","3","7","","","","225","2014-04-02 08:27:21","225","2014-04-29 12:09:30","","","","");
INSERT INTO complaint VALUES("391","Maintenance-0000263","Tube light not working","attend soon","7","","29","1","18","","2","7","3","7","","","","225","2014-04-02 08:28:47","225","2014-04-29 12:11:10","","","","");
INSERT INTO complaint VALUES("392","Maintenance-0000264","CO2 cylinder to be changed","attend soon","7","","29","1","58","","2","7","3","7","","","","225","2014-04-02 08:29:56","225","2014-04-29 12:11:01","","","","");
INSERT INTO complaint VALUES("393","Maintenance-0000265","O2 cylinder to be changed","attend soon","7","","29","1","81","","2","7","3","7","","","","225","2014-04-02 08:31:30","225","2014-04-29 12:09:23","","","","");
INSERT INTO complaint VALUES("394","Maintenance-0000266","I-room bathroom bulb not working","attend soon","7","","27","1","60","","2","7","3","7","","","","225","2014-04-02 08:32:29","225","2014-04-29 12:10:50","","","","");
INSERT INTO complaint VALUES("395","Maintenance-0000267","O2 cylinder to be changed","attend soon","7","","27","1","81","","2","7","3","7","","","","225","2014-04-02 08:33:28","225","2014-04-29 12:09:40","","","","");
INSERT INTO complaint VALUES("396","MIS-0000129","Sage Accpac  MC TRANSACTION is not opening in Nesabah ID & Shankarnag ID","Please send your personnel to rectify the same","3","","6","1","38","","1","3","3","7","5","","Mail sent for Userwise permission for sub store on 27th march.Users who ","78","2014-04-02 08:37:38","78","2014-04-12 09:17:22","","","","");
INSERT INTO complaint VALUES("397","Maintenance-0000268"," Request for new exhaust fan & fire extinguisher ","Please provide a new exhaust fan & fire extinguisher to the additional storage space in front of pharmacy store
INSERT INTO complaint VALUES("398","Maintenance-0000269","D-5 Bed side","Fan is not working.","5","","25","1","62","","2","5","3","5","","","","107","2014-04-02 09:14:57","25","2014-04-02 16:45:10","","","","");
INSERT INTO complaint VALUES("399","Maintenance-0000270","2nd floor lab  AC water is leaking in  the corridor.","Urgent ","10","","26","1","17","","2","10","3","7","","","","69","2014-04-02 09:18:12","69","2014-04-09 13:13:32","","","","");
INSERT INTO complaint VALUES("400","MIS-0000130","Patient name Ms swarna AA244480 .Unable to enter RPR  report . Dated 29th march .","urgent ","3","","6","1","17","31","1","3","3","7","","","","69","2014-04-02 09:27:59","69","2014-04-09 13:12:29","","","","");
INSERT INTO complaint VALUES("401","MIS-0000131","MALE SIDE G AND H ROOM","MOUSE IS NOT WORKING","2","","5","1","64","22","1","2","3","7","","0","","110","2014-04-02 09:38:21","110","2014-04-10 12:43:46","","","","");
INSERT INTO complaint VALUES("402","Maintenance-0000271","NURSES STATION ","OXYGEN CYLINDER IS EMPTY","5","","24","1","64","","2","5","3","7","","","","110","2014-04-02 09:39:08","110","2014-04-10 12:43:06","","","","");
INSERT INTO complaint VALUES("403","Maintenance-0000272","Rm no 3208 t v not working,no channels found ."," kindly do the needful","8","","33","1","50","","2","8","3","5","","","","182","2014-04-02 09:54:56","33","2014-04-02 16:51:39","","","","");
INSERT INTO complaint VALUES("404","Maintenance-0000273","PLEASE MAKE SURE REGARDING COMMODE CHAIR REPAINTING IS POSSIBLE TODAY OR NOT , AS WE HAVE ONLY SINGLE CHAIR ,AND PATIENT NOT SATISFYING WITHOUT  CLEANLINESS . ","KINDLY DO THE NEEDFUL AS SOON AS POSSIBLE. ","9","","37","1","50","","2","9","3","5","","","","126","2014-04-02 10:01:10","37","2014-04-04 08:53:54","","","","");
INSERT INTO complaint VALUES("405","MIS-0000132","System is not booting,
INSERT INTO complaint VALUES("406","MIS-0000133","unable to access saviour","ASAP unable to access saviour","3","","8","1","17","30","1","3","3","7","","","","69","2014-04-02 10:36:02","69","2014-04-04 14:57:54","","","","");
INSERT INTO complaint VALUES("407","Maintenance-0000274","Student Hostel BSc 1st floor  aquagard to be repair & bathroom blocked ","rectify soon","6","","31","1","2","","2","6","3","7","6","","Bathroom block cleared & Aquagard part gave complaint to KENT Abdul","16","2014-04-02 10:43:00","16","2014-04-10 13:31:10","","","","");
INSERT INTO complaint VALUES("408","MIS-0000134","intra mail - Mrs.Gunaseeli Jayapal","not valid.","2","","5","1","61","","1","2","3","5","","898","","104","2014-04-02 10:44:47","5","2014-04-02 11:03:16","","","","");
INSERT INTO complaint VALUES("409","MIS-0000135","ipb-08 printer not working (billing department)","ipb-08 printer not working (billing department)","2","","112","1","42","","1","2","3","5","","661","","118","2014-04-02 10:44:57","112","2014-04-02 11:27:43","","","","");
INSERT INTO complaint VALUES("410","Maintenance-0000275","Rats are coming through the wiring box. Request to close the open wiring box hole. Rats are biting computer cables","As soon as possible","5","","25","1","41","","2","5","3","5","","","","63","2014-04-02 10:45:27","25","2014-04-02 16:46:06","","","","");
INSERT INTO complaint VALUES("411","MIS-0000136","system is very due to report opening","system is very due to report opening","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-02 10:47:16","132","2014-04-08 10:58:44","","","","");
INSERT INTO complaint VALUES("412","MIS-0000137","Computer not starting","It is already attended by MIS and it has started working.","3","","112","5","34","","1","3","3","7","","","","173","2014-04-02 10:51:38","173","2014-04-09 11:26:11","","","","");
INSERT INTO complaint VALUES("413","MIS-0000138","ipb-04 billing & op at a time not working
INSERT INTO complaint VALUES("414","Maintenance-0000276","o2 cylinder to be changed","the o2 is not enough to take patient to CT","5","","25","1","53","","2","5","3","5","","","","119","2014-04-02 10:57:51","25","2014-04-02 16:45:56","","","","");
INSERT INTO complaint VALUES("415","Maintenance-0000277","Maintenance rest room tap to be replace","replace soon","6","","32","1","2","","2","6","3","7","","","","16","2014-04-02 11:05:25","16","2014-04-10 13:30:53","","","","");
INSERT INTO complaint VALUES("416","Maintenance-0000278","MALE SIDE G-ROOM","TREATING DOCTOR BOARD TO BE REPAIRED","9","","37","1","64","","2","9","3","7","","","","110","2014-04-02 11:10:29","110","2014-04-10 12:59:02","","","","");
INSERT INTO complaint VALUES("417","MIS-0000139","Hi,
INSERT INTO complaint VALUES("418","Maintenance-0000279","PC - OPD patient waiting area  female toilet inside light not working","PC - opd --lobby ","5","2","25","1","102","","2","5","3","5","","","","97","2014-04-02 11:22:36","25","2014-04-02 16:46:33","","","","");
INSERT INTO complaint VALUES("419","MIS-0000140","ACCPACK I CONE NOT IN THE DESKTOP
INSERT INTO complaint VALUES("420","Maintenance-0000280","BABY BATH ROOM  TAP IS BROKEN","NEED TO BE URGENT","6","","32","1","60","","2","6","3","5","","","","103","2014-04-02 11:34:21","32","2014-04-02 15:31:26","","","","");
INSERT INTO complaint VALUES("421","Maintenance-0000281","Tailoring machine connection to be checked.","urgent","7","","28","1","84","","2","7","3","5","","","","149","2014-04-02 11:49:44","28","2014-04-02 16:50:01","","","","");
INSERT INTO complaint VALUES("422","MIS-0000141","printer is not working","do it as per as possible","3","","5","1","58","","1","3","3","5","","","","124","2014-04-02 12:04:44","5","2014-04-02 12:14:19","","","","");
INSERT INTO complaint VALUES("423","Maintenance-0000282","Need to fix new fan in MRD main counter","Need to fix new fan in MRD main counter","5","","24","1","16","","2","5","3","7","","","","132","2014-04-02 12:14:59","132","2014-04-08 10:58:22","","","","");
INSERT INTO complaint VALUES("424","Maintenance-0000283","auto calve room exhaust fan is not working   ","do it as per as possible ","5","","24","1","58","","2","5","3","5","","","","124","2014-04-02 12:24:09","24","2014-04-02 16:48:22","","","","");
INSERT INTO complaint VALUES("425","MIS-0000142","To connect the system","Urgent","2","","112","1","17","25","1","2","3","5","","810","","257","2014-04-02 12:24:33","112","2014-04-02 12:34:24","","","","");
INSERT INTO complaint VALUES("426","MIS-0000143","PC Transaction is not opening","Kindly send the presonnel to rectify the same, here by attaching the PMS screen shoot.
INSERT INTO complaint VALUES("427","Maintenance-0000284","oxygen cylinder empty","kindly rectify","5","","24","1","52","","2","5","3","5","","","","157","2014-04-02 12:25:54","24","2014-04-02 13:52:48","","","","");
INSERT INTO complaint VALUES("428","Maintenance-0000285","CLASS ROOM","NEW  WALL  CLOCK  TO  BE FIXED","9","","37","1","64","","2","9","3","7","","","","110","2014-04-02 12:35:41","110","2014-04-10 12:40:52","","","","");
INSERT INTO complaint VALUES("429","Maintenance-0000286","I-ROOM DISABLED TOILET","TAP IS LEAKING","6","","30","1","64","","2","6","3","7","","","","110","2014-04-02 12:36:25","110","2014-04-10 12:40:12","","","","");
INSERT INTO complaint VALUES("430","Maintenance-0000287","Please make arrangement for a CCTV Camera in nursing institute multipurpose hall as we have the university exam from 04/04/2014 to 19/04/2014.","arrange ","8","","33","4","107","","2","8","3","7","","","","16","2014-04-02 13:01:18","16","2014-04-10 13:30:45","","","","");
INSERT INTO complaint VALUES("431","Maintenance-0000288","give place to keep CO2 cylinder and oxygen cylinder","do it soon","11","","21","1","58","","2","11","3","5","","","","124","2014-04-02 13:10:17","227","2014-04-02 13:49:27","","","","");
INSERT INTO complaint VALUES("432","Maintenance-0000289","male general toilet cuboard is broken","as soon as possible","9","","37","1","65","","2","9","3","7","","","","84","2014-04-02 13:22:05","84","2014-04-21 10:15:34","","","","");
INSERT INTO complaint VALUES("433","Maintenance-0000290","F-3 Fan","Not working.","5","","24","1","61","","2","5","3","5","","","","104","2014-04-02 13:48:29","24","2014-04-02 16:47:22","","","","");
INSERT INTO complaint VALUES("434","Maintenance-0000291","2no O2 cylinder to be filled","replace soon","5","","24","1","81","","2","5","3","7","","","","16","2014-04-02 13:53:38","16","2014-04-10 13:30:36","","","","");
INSERT INTO complaint VALUES("435","MIS-0000144","Emp. No. D0023 Devanahalli Staff  is showing error message while processing Salary cannot process salary.  ","its urgent, kindly do the needful   ","3","","6","1","30","","1","3","3","5","","","","226","2014-04-02 13:56:17","6","2014-04-02 14:26:10","20140402135617_hrms error.bmp","","","");
INSERT INTO complaint VALUES("436","MIS-0000145","To fix new bar codes","ASAP ","2","","112","1","17","30","1","2","3","7","","820","","69","2014-04-02 14:11:45","69","2014-04-09 13:13:08","","","","");
INSERT INTO complaint VALUES("437","MIS-0000146","User id Gloryden .  we cant entry  the inventory check the sage accpac  general stores & pharmacy store things ","its urgent.................","3","","6","1","71","","1","3","3","5","6","","Mention the location codes  also. which sub store this id belongs to be mentioned","72","2014-04-02 14:14:37","6","2014-04-02 15:42:45","","","","");
INSERT INTO complaint VALUES("438","Maintenance-0000292","Dear sis ,
INSERT INTO complaint VALUES("439","Maintenance-0000293","Microwave is not working in Creche.","Microwave is not working in Creche. It is very Emergency.","5","","21","1","54","","2","5","3","5","6","","outsource to be done","114","2014-04-02 14:45:28","227","2014-04-07 12:07:10","","","","");
INSERT INTO complaint VALUES("440","Maintenance-0000294","RADIATION INDICATION BOX FOR DEXA ROOM.","RADIATION INDICATION BOX FOR DEXA ROOM.","9","","37","1","90","","2","9","3","5","6","","outsource to be done","70","2014-04-02 15:05:57","37","2014-05-06 09:12:44","","","","");
INSERT INTO complaint VALUES("441","Maintenance-0000295","D2 CALLING BELL IS NOT WORKING","NEED TO BE URGENT","8","","33","1","60","","2","8","3","5","","","","103","2014-04-02 15:13:21","33","2014-04-03 09:28:40","","","","");
INSERT INTO complaint VALUES("442","Maintenance-0000296"," Refrigerator  freezer  to be fixed
INSERT INTO complaint VALUES("443","Maintenance-0000297","NURSING STATION  CUP BOARD IS BROKEN","NURSING STATION  CUP BOARD IS BROKEN","9","","37","1","60","","2","9","3","5","","","","103","2014-04-02 15:14:34","37","2014-04-03 09:34:42","","","","");
INSERT INTO complaint VALUES("444","Maintenance-0000298","NICU  Nurses Station Slab side wall broken","As  early  as possible","9","","37","1","55","","2","9","3","5","","","","82","2014-04-02 15:25:27","37","2014-04-03 09:32:13","","","","");
INSERT INTO complaint VALUES("445","MIS-0000147","Internet connection","Kindly do the needful as early as possible","2","","112","1","101","","1","2","3","5","","796","","146","2014-04-02 16:21:09","112","2014-04-02 16:30:53","","","","");
INSERT INTO complaint VALUES("446","Maintenance-0000299","O2 cylinder is empty","attend soon","7","","27","1","62","","2","7","3","7","","","replaced O2 cylinder","225","2014-04-03 08:26:29","225","2014-04-29 12:09:18","","","","");
INSERT INTO complaint VALUES("447","Maintenance-0000300","O2 cylinder to be filled","attend soon","7","","27","1","53","","2","7","3","7","","","","225","2014-04-03 08:27:20","225","2014-04-29 12:09:12","","","","");
INSERT INTO complaint VALUES("448","Maintenance-0000301","O2 cylinder is empty","attend soon","7","","27","1","50","","2","7","3","7","","","","225","2014-04-03 08:28:11","225","2014-04-29 12:09:04","","","","");
INSERT INTO complaint VALUES("449","Maintenance-0000302","Door key broken","attend soon","9","","37","1","79","","2","9","3","7","","","","225","2014-04-03 08:32:12","225","2014-04-29 12:10:36","","","","");
INSERT INTO complaint VALUES("450","MIS-0000148","Net not working, yesterday (02.04.2014)","Net not working, yesterday (02.04.2014)","2","","112","1","25","","1","2","3","7","","938","","152","2014-04-03 08:35:02","152","2014-04-03 11:58:03","","","","");
INSERT INTO complaint VALUES("451","Maintenance-0000303","cry o can empty  ","to fill ","7","","26","1","75","","2","7","3","5","","","","207","2014-04-03 08:45:55","26","2014-04-03 16:49:15","","","","");
INSERT INTO complaint VALUES("452","Maintenance-0000304","Suction is not working.","Suction is not working.","7","","28","1","81","","2","7","3","5","","","","99","2014-04-03 08:50:42","28","2014-04-03 12:10:14","","","","");
INSERT INTO complaint VALUES("453","Maintenance-0000305","Cupboard door is not locking & opening ","carpenter will rectify","9","","37","2","2","","2","9","3","7","","","","225","2014-04-03 08:55:20","225","2014-04-29 12:10:26","","","","");
INSERT INTO complaint VALUES("454","Maintenance-0000306","Trolley side rails broken","attend soon","7","","28","1","74","","2","7","3","7","","","","225","2014-04-03 09:10:08","225","2014-04-29 12:10:16","","","","");
INSERT INTO complaint VALUES("455","Maintenance-0000307","OT AC\'S ARE NOT COLLING ","DO IT SOON","10","","26","1","58","","2","10","3","7","","","","124","2014-04-03 09:10:47","124","2014-04-09 08:48:57","","","","");
INSERT INTO complaint VALUES("456","MIS-0000149","Dr.suman\'s room mouse in not working","kindly do the needful.","2","","5","1","79","","1","2","3","5","","855","","216","2014-04-03 09:12:59","5","2014-04-03 09:47:01","","","","");
INSERT INTO complaint VALUES("457","Maintenance-0000308","old mats hanging in the garden of peadiatric opd kindly take it away.","as early as possible.","11","","21","1","79","","2","11","3","5","","","","216","2014-04-03 09:17:35","227","2014-04-03 09:27:52","","","","");
INSERT INTO complaint VALUES("458","Maintenance-0000309","weighing scale trolly nail not fixed properly.","kindly do the needful as early as possible 
INSERT INTO complaint VALUES("459","Maintenance-0000310","car parking debris to be cleaned ","clean soon","11","","21","1","2","","2","11","3","7","","","","16","2014-04-03 09:39:01","16","2014-04-10 13:30:28","","","","");
INSERT INTO complaint VALUES("460","Maintenance-0000311","old tires to be removed","remove it","11","","21","1","2","","2","11","3","7","","","","16","2014-04-03 09:39:28","16","2014-04-10 13:30:20","","","","");
INSERT INTO complaint VALUES("461","Maintenance-0000312","creche 15A switch burnt","replace switch","11","","21","1","2","","2","11","3","7","","","","16","2014-04-03 09:40:05","16","2014-04-10 13:30:11","","","","");
INSERT INTO complaint VALUES("462","Maintenance-0000313","In deluxe pantry there is continuous water leakage in sink ,attenders are not satisfied. ","kindly do the needful as soon as possible.","6","","32","1","50","","2","6","3","7","","","","126","2014-04-03 09:44:55","126","2014-04-03 15:55:23","","","","");
INSERT INTO complaint VALUES("463","Maintenance-0000314","Staff Hostel old carom board to be shifted & door frame to be changed","rectify soon","9","","37","1","2","","2","9","3","7","6","","carom board shifted & the door problem to be rectified by outsource ","16","2014-04-03 09:45:13","16","2014-06-17 12:21:11","","","","");
INSERT INTO complaint VALUES("464","Maintenance-0000315","Staff hostel annexe toilet door to be changed","replace soon","9","","37","2","2","","2","9","3","3","6","","outsource to be done","16","2014-04-03 09:45:40","37","2014-05-06 09:43:05","","","","");
INSERT INTO complaint VALUES("465","Maintenance-0000316","in room 3204 continuous water leakage and patient attender needs fast clearance. ","please kindly do the needful","6","","32","1","50","","2","6","3","7","","","","126","2014-04-03 09:49:13","126","2014-04-03 15:53:32","","","","");
INSERT INTO complaint VALUES("466","MIS-0000150","kindly arrange consumption entry source location general main store to be activate. ","as soon as possible.","3","","6","1","63","","1","3","3","7","","","","87","2014-04-03 09:55:01","87","2014-04-07 15:38:49","","","","");
INSERT INTO complaint VALUES("467","MIS-0000151","system is very hanging & slow","system is very hanging & slow","2","","5","1","16","19","1","2","3","7","","736","","132","2014-04-03 09:57:36","132","2014-04-08 10:57:47","","","","");
INSERT INTO complaint VALUES("468","MIS-0000152","kindly arrange transfer statement source location general main store to be check.","as soon as possible.","3","","6","1","63","","1","3","3","7","","","","87","2014-04-03 10:00:36","87","2014-04-07 15:39:02","","","","");
INSERT INTO complaint VALUES("469","Maintenance-0000317","Need Ceiling fan / table fan to our nurses room","Kindly do the needful","5","","22","1","101","","2","5","3","5","","","","146","2014-04-03 10:10:23","22","2014-04-03 16:41:55","","","","");
INSERT INTO complaint VALUES("470","Maintenance-0000318","B-2 bed side.","Fan is not working.","5","","22","1","62","","2","5","3","5","","","","107","2014-04-03 10:18:49","22","2014-04-03 16:41:29","","","","");
INSERT INTO complaint VALUES("471","Maintenance-0000319","E,A,B &Entrance A&b room side.","stopper to be fixed.","9","","37","1","62","","2","9","3","5","","","","107","2014-04-03 10:21:41","37","2014-04-04 09:15:47","","","","");
INSERT INTO complaint VALUES("472","Maintenance-0000320","In our purchase Corridor wall Water leakage to be arrested
INSERT INTO complaint VALUES("473","Maintenance-0000321","A&B entrance door leach to be fixed. ","C- room side disinfected stand to be fixed.","9","","37","1","62","","2","9","3","5","","","","107","2014-04-03 10:25:40","37","2014-04-04 09:15:34","","","","");
INSERT INTO complaint VALUES("474","MIS-0000153","w4 ip billing cabin one computer not working","w4 ip billing cabin one computer not working","3","","112","1","42","","1","3","3","5","","","","118","2014-04-03 10:28:27","112","2014-04-03 13:26:01","","","","");
INSERT INTO complaint VALUES("475","MIS-0000154","need to connect printer to BBH-BME-02.bbh.com","to be connected for documentation purpose
INSERT INTO complaint VALUES("476","MIS-0000155","GUNASEELI.
INSERT INTO complaint VALUES("477","Maintenance-0000322","F Room ","F-2 Fan not working ","5","","22","1","61","","2","5","3","5","","","","105","2014-04-03 11:37:33","22","2014-04-03 16:43:43","","","","");
INSERT INTO complaint VALUES("478","MIS-0000156","Internet explorer not connecting ","ASAP.Internet explorer not connecting ","3","","5","1","17","31","1","3","3","7","","","","69","2014-04-03 11:41:49","69","2014-04-09 13:12:46","","","","");
INSERT INTO complaint VALUES("479","Maintenance-0000323","Kent Purifier not working in the Guest House (Hostel).","Urgent ","6","","32","2","113","","2","6","3","7","","","","69","2014-04-03 11:44:57","69","2014-04-09 13:12:01","","","","");
INSERT INTO complaint VALUES("480","MIS-0000157","crp-06. Not able to take OP pharmacy re-prints","High Priority","3","","6","1","40","11","1","3","3","7","","","","313","2014-04-03 11:50:21","313","2014-04-30 08:46:09","","","","");
INSERT INTO complaint VALUES("481","MIS-0000158","Computer mouse is not working.","Please do it at the earliest.  Thank you","2","","112","1","52","","1","2","3","7","","886","","128","2014-04-03 11:53:55","128","2014-04-03 13:13:03","","","","");
INSERT INTO complaint VALUES("482","MIS-0000159","Wi-Fi not working, please rectify (03.04.2014)","Wi-Fi not working, please rectify (03.04.2014)","2","","5","1","25","","1","2","3","7","","938","","152","2014-04-03 11:59:11","152","2014-04-10 11:44:17","","","","");
INSERT INTO complaint VALUES("483","MIS-0000160","sticker printer is not working ","sticker printer is not working ","2","","112","1","16","36","1","2","3","7","","739","","132","2014-04-03 12:06:44","132","2014-04-08 10:57:13","","","","");
INSERT INTO complaint VALUES("484","Maintenance-0000324","MALE GENERAL WARD TOILET","SINK IS BLOCKED","6","","30","1","64","","2","6","3","7","","","","110","2014-04-03 12:10:12","110","2014-04-10 12:39:19","","","","");
INSERT INTO complaint VALUES("485","MIS-0000161","BBH-WG5-03 SYSTEM","SAGE ACCPAC GEN STORES CONSUMPTION ENTRY LOCATION CODE IS NOT COMING","2","","6","1","64","21","1","2","3","7","","0","","110","2014-04-03 12:12:02","110","2014-04-10 12:34:49","","","","");
INSERT INTO complaint VALUES("486","MIS-0000162","In emergency annex system is not working.","In emergency annex system is not working.","3","","5","1","81","","1","3","3","5","","","","99","2014-04-03 12:22:23","5","2014-04-03 12:29:05","","","","");
INSERT INTO complaint VALUES("487","MIS-0000163","pcw-01 system not working, mouse also not working","please rectify immediately","2","","112","1","49","","1","2","3","5","","918","","97","2014-04-03 12:39:13","112","2014-04-03 12:47:54","","","","");
INSERT INTO complaint VALUES("488","MIS-0000164","Reports entered in wrong patient ID .Please delete all reports from Pt name Mr Shreekantha   Hos No aa250733. ","Urgent ","3","","6","1","17","30","1","3","3","7","5","","There are Three OP orders placed for Lab services for this particular patient.
INSERT INTO complaint VALUES("489","MIS-0000165","system is hanging","system is hanging","2","","5","1","16","18","1","2","3","7","","733","","132","2014-04-03 12:53:21","132","2014-04-08 10:56:55","","","","");
INSERT INTO complaint VALUES("490","MIS-0000166","mozilla firefox not opening ","ASAP.                                      ","3","","5","1","17","30","1","3","3","7","","","","69","2014-04-03 12:54:54","69","2014-04-09 13:15:10","","","","");
INSERT INTO complaint VALUES("491","Maintenance-0000325","Nurse call bell is not repaired yet.","Please do it at the earliest.  Thank you.","8","","33","1","52","","2","8","3","7","","","","128","2014-04-03 13:10:44","128","2014-04-10 08:47:29","","","","");
INSERT INTO complaint VALUES("492","Maintenance-0000326","Front door at lab 2nd floor  is not closing correctly.
INSERT INTO complaint VALUES("493","Maintenance-0000327","Integrated medicine tube light not working","attend soon","5","","22","1","2","","2","5","3","7","","","","16","2014-04-03 14:56:07","16","2014-04-10 13:30:03","","","","");
INSERT INTO complaint VALUES("494","Maintenance-0000328","1. Mosquito mesh of the main entrance door damaged.  
INSERT INTO complaint VALUES("495","Maintenance-0000329","please kindly rectify the same room 3204, as in sink  water leakage  is still continuous  even though plumber attended in the morning .  ","kindly do the needful as soon as possible.","6","","30","1","50","","2","6","3","5","","","","126","2014-04-03 16:02:23","30","2014-04-04 08:56:30","","","","");
INSERT INTO complaint VALUES("496","MIS-0000167","Dear sister, 
INSERT INTO complaint VALUES("497","Maintenance-0000330","ROOM NO 1507 (1) TUBE LIGHT NOT WORKING ","PLEASE DO CHECK ASAP.","7","","29","1","49","","2","7","3","5","","","","97","2014-04-03 16:23:05","29","2014-04-04 08:57:01","","","","");
INSERT INTO complaint VALUES("498","Maintenance-0000331","nurses station - 2 slab wood serew  coming out to be fix and bed C-3,C-9,E-4,E-5 pt loock serew to be fix.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-04-03 17:20:04","87","2014-05-12 09:28:48","","","","");
INSERT INTO complaint VALUES("499","Maintenance-0000332","Rooms D-2,D2,D-4,E-10, Calling bell is not working to be check.","as soon as possible.","8","","33","1","63","","2","8","3","7","6","","waiting for AMC renewal ","87","2014-04-03 17:21:56","87","2014-05-22 11:52:21","","","","");
INSERT INTO complaint VALUES("500","MIS-0000168","bbh-wg4-02 computer key board is not working to be check.","as soon as  possible.","2","","5","1","63","","1","2","3","7","","902","","87","2014-04-03 17:40:35","87","2014-04-07 15:38:32","","","","");
INSERT INTO complaint VALUES("501","Maintenance-0000333","o2 cylinder empty","o2 cylinder to be refilled","7","","27","1","53","","2","7","3","5","","","","119","2014-04-03 23:07:08","227","2014-04-04 08:47:28","","","","");
INSERT INTO complaint VALUES("502","Maintenance-0000334","Fans and lights are not working","it appears that the MCB is tripped.","5","","24","1","89","","2","5","3","7","","","","88","2014-04-04 08:32:54","88","2014-04-04 09:39:51","","","","");
INSERT INTO complaint VALUES("503","Maintenance-0000335","O2 cylinder to be filled","attend soon","7","","29","1","93","","2","7","3","7","","","","225","2014-04-04 08:33:02","225","2014-04-29 12:08:57","","","","");
INSERT INTO complaint VALUES("504","Maintenance-0000336","o2 cylinder to be filled ","04/04/2014 6am","7","","27","1","54","","2","7","3","7","","","","225","2014-04-04 08:35:21","225","2014-04-29 12:08:49","","","","");
INSERT INTO complaint VALUES("505","Maintenance-0000337","balken frame to be shift","attend soon","7","","28","1","62","","2","7","3","7","","","","16","2014-04-04 08:44:08","16","2014-04-10 13:29:51","","","","");
INSERT INTO complaint VALUES("506","Maintenance-0000338","o2 cylinder to be filled ","03/04/2014 9:45am","7","","27","1","81","","2","7","3","7","","","","16","2014-04-04 08:44:48","16","2014-04-10 13:29:41","","","","");
INSERT INTO complaint VALUES("507","Maintenance-0000339","NURSING STATION","OXYGEN CYLINDER IS EMPTY","5","","24","1","64","","2","5","3","7","","","","110","2014-04-04 08:48:22","110","2014-04-10 12:34:01","","","","");
INSERT INTO complaint VALUES("508","Maintenance-0000340","back office - ext 505 not working","high priority","8","","33","1","40","","2","8","3","7","","","","65","2014-04-04 08:51:14","65","2014-04-07 13:32:52","","","","");
INSERT INTO complaint VALUES("509","Maintenance-0000341"," patient bathroom water is blocked. ","to be rectify immediately","6","","31","1","53","","2","6","3","5","","","","119","2014-04-04 09:14:43","31","2014-04-05 10:04:10","","","","");
INSERT INTO complaint VALUES("510","Maintenance-0000342","1.flesh stand broken in emergency annex toilet.
INSERT INTO complaint VALUES("511","Maintenance-0000343","medicaal air leaking in b 12","to be repaired immediately","7","","28","1","53","","2","7","3","5","","","","119","2014-04-04 09:24:01","28","2014-04-04 09:53:30","","","","");
INSERT INTO complaint VALUES("512","Maintenance-0000344","high risk labour room fan cup broken","fan cup broken","5","","23","1","59","","2","5","3","5","","","","116","2014-04-04 09:27:35","227","2014-04-04 11:40:26","","","","");
INSERT INTO complaint VALUES("513","Maintenance-0000345","high risk labour room nurses calling bell to be fixed.","nurses calling bell to be fixed","8","","34","1","59","","2","8","3","5","","","","116","2014-04-04 09:28:35","34","2014-04-05 10:17:24","","","","");
INSERT INTO complaint VALUES("514","Maintenance-0000346","birthing room -ldpr    light is not working","light is not working","5","","23","1","59","","2","5","3","5","","","","116","2014-04-04 09:29:23","227","2014-04-04 11:41:07","","","","");
INSERT INTO complaint VALUES("515","Maintenance-0000347","birthing room window mesh & window glass frame to be fixed.","window glass to be fixed","9","","37","1","59","","2","9","3","5","","","","116","2014-04-04 09:32:38","37","2014-04-05 10:08:37","","","","");
INSERT INTO complaint VALUES("516","Maintenance-0000348","The western closet in the PC OPD gent\'s toilet seems to be blocked. ","Araange to fix it at the earliest.","6","","32","1","102","","2","6","3","7","6","","major work main line blocked ","88","2014-04-04 09:42:59","88","2014-05-16 16:34:29","","","","");
INSERT INTO complaint VALUES("517","Maintenance-0000349","DOOR KNOB IS BROKEN","EMERGENCY ","9","","37","1","112","","2","9","3","5","","","","217","2014-04-04 09:44:09","37","2014-04-05 10:08:54","","","","");
INSERT INTO complaint VALUES("518","Maintenance-0000350","AQUA GUARD","not working.","6","","31","1","61","","2","6","3","5","","","","104","2014-04-04 09:46:12","31","2014-04-04 10:31:44","","","","");
INSERT INTO complaint VALUES("519","Maintenance-0000351","Next to Jacob mathew house Dr bhargav house fan not working 7760833484","attend soon","5","","23","3","2","","2","5","3","7","","","","16","2014-04-04 09:56:34","16","2014-04-10 13:29:32","","","","");
INSERT INTO complaint VALUES("520","Maintenance-0000352","TUBE LIGHT NOT WORKING IN X-RAY DR ROOM","TUBE LIGHT NOT WORKING IN X-RAY DR ROOM","5","","23","1","90","","2","5","3","5","","","","70","2014-04-04 10:02:57","227","2014-04-04 11:39:57","","","","");
INSERT INTO complaint VALUES("521","MIS-0000169","Network problem","Internet is not working ","2","","112","1","26","","1","2","3","7","","752","","76","2014-04-04 10:15:43","76","2014-04-08 12:08:53","","","","");
INSERT INTO complaint VALUES("522","Maintenance-0000353","Gents toilet in Central OPD Tap repair, PC-opd Sink blocked.","URGENT","6","","32","1","47","","2","6","3","5","","","","149","2014-04-04 10:22:17","32","2014-04-04 10:32:09","","","","");
INSERT INTO complaint VALUES("523","MIS-0000170","CT scan short cut is not working in scan 3 computer","This short cut is required for us to report CT scans from this computer.","2","","112","1","14","","1","2","3","5","","878","","228","2014-04-04 10:27:53","112","2014-04-04 11:07:57","","","","");
INSERT INTO complaint VALUES("524","Maintenance-0000354","Fan not working","rectify soon","5","","24","1","101","","2","5","3","7","","","","16","2014-04-04 10:28:58","16","2014-04-10 13:29:11","","","","");
INSERT INTO complaint VALUES("525","Maintenance-0000355","O2 cylinder is empty","kindly do the needful","5","","23","1","52","","2","5","3","5","","","","159","2014-04-04 10:58:39","227","2014-04-04 11:41:28","","","","");
INSERT INTO complaint VALUES("526","MIS-0000171","Outlook express not opening in the library system","urgent","2","","8","4","24","","1","2","3","7","","0","","153","2014-04-04 11:02:20","153","2014-04-11 15:58:05","","","","");
INSERT INTO complaint VALUES("527","Maintenance-0000356","C- room, utility room side.","last toilet is blocked.","6","","31","1","62","","2","6","3","5","","","","107","2014-04-04 11:05:57","31","2014-04-05 10:03:58","","","","");
INSERT INTO complaint VALUES("528","Maintenance-0000357","E-room to C13 bed.","Balkan prime  to be fixed.","7","","28","1","62","","2","7","3","5","","","","107","2014-04-04 11:08:22","28","2014-04-05 10:02:13","","","","");
INSERT INTO complaint VALUES("529","MIS-0000172","please upgrade phm-05 to windows 2007","delete windows 2003
INSERT INTO complaint VALUES("530","Maintenance-0000358","Corporate front office
INSERT INTO complaint VALUES("531","MIS-0000173","Icons not showing on Accpacc.","urgent ","3","","112","1","17","29","1","3","3","7","","","","69","2014-04-04 11:29:38","69","2014-04-09 13:06:00","","","","");
INSERT INTO complaint VALUES("532","Maintenance-0000359","Qtrs Court view Dr Alfred house hall & bathroom light not working","rectify soon","5","","24","3","2","","2","5","3","7","","","","16","2014-04-04 11:46:14","16","2014-04-10 13:29:02","","","","");
INSERT INTO complaint VALUES("533","Maintenance-0000360","Networking not working.","Histopathology","8","","33","1","17","","2","8","3","7","","","","113","2014-04-04 11:55:50","113","2014-04-05 19:06:07","","","","");
INSERT INTO complaint VALUES("534","Maintenance-0000361","chair to be fixed and the wire to be changed ","please fix the issue and a  cost of polish is needed","9","","37","1","18","","2","9","3","7","","","","64","2014-04-04 12:18:15","64","2014-05-06 11:38:23","","","","");
INSERT INTO complaint VALUES("535","MIS-0000174","ccu-2 system is not working","please kindly do the needful","2","","112","1","52","","1","2","3","5","","887","","154","2014-04-04 12:19:02","112","2014-04-04 12:40:02","","","","");
INSERT INTO complaint VALUES("536","Maintenance-0000362","nail to be fixed in toilet to hang bedpan.","nail to be fixed in toilet to hang bedpan.","9","","37","1","81","","2","9","3","5","","","","99","2014-04-04 12:35:47","37","2014-04-05 10:12:21","","","","");
INSERT INTO complaint VALUES("537","Maintenance-0000363","ROOM NO 1511 COT BALK EN FRAME TO BE FIXED","PLEASE COME AND FIX IMMEDIATELY.","7","","28","1","49","","2","7","3","5","","","","249","2014-04-04 12:59:08","28","2014-04-05 10:02:01","","","","");
INSERT INTO complaint VALUES("538","Maintenance-0000364","In nurses station.","Fan to be fixed.","5","","23","1","62","","2","5","3","5","","","","107","2014-04-04 12:59:47","227","2014-04-04 13:21:26","","","","");
INSERT INTO complaint VALUES("539","Maintenance-0000365","Mens hostel  
INSERT INTO complaint VALUES("540","Maintenance-0000366","Mens Hostel  first floor flush and water geezer  is not working","rectify soon","6","","31","1","2","","2","6","3","7","","","","16","2014-04-04 13:16:21","16","2014-04-10 13:28:47","","","","");
INSERT INTO complaint VALUES("541","Maintenance-0000367","C-ROOM BED NO:2","PATIENT CALLING BELL TO BE REPAIRED 
INSERT INTO complaint VALUES("542","Maintenance-0000368","\"B\" Room AC is not working ","very urgent","10","","26","1","65","","2","10","3","7","","","","84","2014-04-04 13:46:34","84","2014-04-21 10:15:53","","","","");
INSERT INTO complaint VALUES("543","Maintenance-0000369","Sink blocked.","Sink blocked.","6","","32","1","81","","2","6","3","5","","","","99","2014-04-04 14:18:20","227","2014-04-04 15:19:29","","","","");
INSERT INTO complaint VALUES("544","Maintenance-0000370","Rooms C-7.O2 connector to be fix and room A-3, I-2, suction connector to be fix.","as soon as possible.","7","","28","1","63","","2","7","3","7","","","","87","2014-04-04 14:29:32","87","2014-04-07 15:38:17","","","","");
INSERT INTO complaint VALUES("545","Maintenance-0000371","Ladies toilet 2 tube light not working","electrician will rectify","5","","24","1","102","","2","5","3","7","","","","225","2014-04-04 14:33:50","225","2014-04-29 12:10:06","","","","");
INSERT INTO complaint VALUES("546","Maintenance-0000372","Tube light not working. ","req. replacement of the tube light.  One end black ","5","","23","1","95","","2","5","3","7","","","","259","2014-04-04 14:35:57","259","2014-06-06 12:39:53","","","","");
INSERT INTO complaint VALUES("547","Maintenance-0000373","SIGN BOARD TO BE FIXED FOR X-RAY, DEXA, AND CT SCAN","SIGN BOARD TO BE FIXED FOR X-RAY, DEXA, AND CT SCAN","9","","37","1","90","","2","9","3","5","","","","70","2014-04-04 14:38:27","37","2014-04-05 10:13:56","","","","");
INSERT INTO complaint VALUES("548","Maintenance-0000374","Qtrs Dr. Rajnish house sink blocked ","block remove soon","6","","30","1","2","","2","6","3","7","","","","16","2014-04-04 14:48:49","16","2014-04-10 13:28:36","","","","");
INSERT INTO complaint VALUES("549","MIS-0000175","1. B.B.H connect that call management it is not able to open. 
INSERT INTO complaint VALUES("550","Maintenance-0000375","1. Gyne OPD class room fan is not working. 
INSERT INTO complaint VALUES("551","MIS-0000176","IP bill no 111856/02.04.2014
INSERT INTO complaint VALUES("552","Maintenance-0000376","3212-call bell not working","do the needful","8","","33","1","50","","2","8","3","5","","","","189","2014-04-04 15:07:10","227","2014-04-04 15:24:34","","","","");
INSERT INTO complaint VALUES("553","Maintenance-0000377","Soap Dispencer to be placed in Gents toilet- Lab downstairs, NearIP billing,central opd
INSERT INTO complaint VALUES("554","Maintenance-0000378","Staff Bath Room is blocked ","urgent send somebody to do that ","6","","32","1","71","","2","6","3","5","","","","72","2014-04-04 15:11:22","32","2014-04-05 10:04:47","","","","");
INSERT INTO complaint VALUES("555","Maintenance-0000379","wheel chair.","pedal to be fixed.","7","","28","1","62","","2","7","3","5","","","","107","2014-04-04 15:16:26","28","2014-04-08 12:35:11","","","","");
INSERT INTO complaint VALUES("556","Maintenance-0000380","TELEPHONE NOT WORKING.","URGENT.","8","","33","1","73","","2","8","3","5","","","","211","2014-04-04 15:37:10","227","2014-04-04 16:25:15","","","","");
INSERT INTO complaint VALUES("557","MIS-0000177","WING-1 SOFTER IS NOT WORKING","MAKE IT FAST","3","","9","1","60","","1","3","3","5","5","","let us know the system name, which software?","264","2014-04-04 16:49:07","123","2014-04-08 11:20:52","","","","");
INSERT INTO complaint VALUES("558","MIS-0000178","TAT cannot be captured for the month of march","showing defect & failure to take data.","3","","6","1","17","30","1","3","3","7","","","","69","2014-04-04 16:51:31","69","2014-04-07 16:50:52","20140407134046_mltatdetail.pdf#20140407134046_mltatsummaryfor march2014.pdf#","","","");
INSERT INTO complaint VALUES("559","Maintenance-0000381","Qtrs C Dr. Alfred house health faucet to be fixed","replace soon","6","","30","3","2","","2","6","3","7","","","","16","2014-04-04 17:17:01","16","2014-04-10 13:28:28","","","","");
INSERT INTO complaint VALUES("560","Maintenance-0000382","O2 CYLINDER GOT EMPTY","O2 CYLINDER GOT EMPTY","6","","30","1","54","","2","6","3","5","","","","114","2014-04-04 19:22:28","227","2014-04-05 07:52:15","","","","");
INSERT INTO complaint VALUES("561","Maintenance-0000383","O2 cylinder is empty","04/04/2014   10:00pm","6","","30","1","102","","2","6","3","7","","","","225","2014-04-05 08:09:24","225","2014-04-29 12:08:36","","","","");
INSERT INTO complaint VALUES("562","MIS-0000179","accpac is not working in system bbhpms03.","kindly send the personnel to rectify the same.","3","","112","1","38","","1","3","3","7","","","","78","2014-04-05 08:27:11","78","2014-04-12 09:15:41","","","","");
INSERT INTO complaint VALUES("563","MIS-0000180","Keyboard is not working","Kindly do the needful","2","","112","1","101","","1","2","3","5","","795","","146","2014-04-05 08:28:06","112","2014-04-05 09:00:57","","","","");
INSERT INTO complaint VALUES("564","Maintenance-0000384","wall suction is not working.","wall suction is not working.","7","","28","1","81","","2","7","3","5","","","","99","2014-04-05 08:44:07","28","2014-04-05 10:01:45","","","","");
INSERT INTO complaint VALUES("565","MIS-0000181","system is hanging","system is hanging","3","","9","1","16","19","1","3","3","7","","","","132","2014-04-05 09:01:30","132","2014-04-08 10:56:37","","","","");
INSERT INTO complaint VALUES("566","Maintenance-0000385","AC is leaking.  ","Needs urgent repair","10","","26","1","59","","2","10","3","5","","","","100","2014-04-05 09:02:02","26","2014-04-05 10:00:48","","","","");
INSERT INTO complaint VALUES("567","MIS-0000182","Purchase  one of the system Aaccpac application not respoding","System ID BBH-PUR-02
INSERT INTO complaint VALUES("568","Maintenance-0000386","Drawer broken to be repair","come soon","9","","37","1","90","","2","9","3","7","","","","16","2014-04-05 09:24:34","16","2014-04-10 13:28:17","","","","");
INSERT INTO complaint VALUES("569","Maintenance-0000387","oxygen trolley needs cylinder","please we need immediately...","5","","22","1","49","","2","5","3","5","","","","97","2014-04-05 09:25:10","22","2014-04-05 12:37:31","","","","");
INSERT INTO complaint VALUES("570","Maintenance-0000388","WASHING AREA FOR DISABLED","SINK IS BLOCKED","6","","32","1","64","","2","6","3","7","","","","110","2014-04-05 09:39:53","110","2014-04-09 13:09:38","","","","");
INSERT INTO complaint VALUES("571","Maintenance-0000389","O2 cylinder to be filled","04/04/2014 10:30pm","5","","25","1","50","","2","5","3","7","","","","225","2014-04-05 09:46:45","225","2014-04-29 12:08:24","","","","");
INSERT INTO complaint VALUES("572","Maintenance-0000390","O2 cylinder is empty","04/04/2014 8:55pm","6","","30","1","81","","2","6","3","7","","","","225","2014-04-05 09:47:32","225","2014-04-29 12:08:18","","","","");
INSERT INTO complaint VALUES("573","Maintenance-0000391","broken door of the drawer","attend soon","9","","37","1","90","","2","9","3","7","","","","225","2014-04-05 09:53:10","225","2014-04-29 12:09:57","","","","");
INSERT INTO complaint VALUES("574","Maintenance-0000392","Networking  is not working.","Histopath","8","","33","1","17","","2","8","3","7","","","","113","2014-04-05 10:07:07","113","2014-04-05 19:05:47","","","","");
INSERT INTO complaint VALUES("575","MIS-0000183","Rv metropolis April-2014 Excel sheet is not opening. ","In Histopathology. 
INSERT INTO complaint VALUES("576","MIS-0000184","ADM-13 - Accpac","not able to get the transfer statement","3","","6","1","94","","1","3","3","7","","","","136","2014-04-05 10:18:37","136","2014-04-19 10:24:08","","","","");
INSERT INTO complaint VALUES("577","MIS-0000185","Window glass is not opening properly","as early as possible","","","123","1","54","","1","2","3","7","","","null","73","2014-04-05 10:46:33","73","2014-04-05 10:46:33","","","","");
INSERT INTO complaint VALUES("578","Maintenance-0000393","3 Seat chair to be repaired ","rectify soon ","7","","28","1","102","","2","7","3","7","","","","16","2014-04-05 10:46:52","16","2014-04-09 10:30:12","","","","");
INSERT INTO complaint VALUES("579","Maintenance-0000394","Window glass is not opening properly","as early as possible","9","","37","1","54","","2","9","3","5","","","","73","2014-04-05 10:47:40","227","2014-04-05 10:48:58","","","","");
INSERT INTO complaint VALUES("580","Maintenance-0000395","suction not working ","rectify soon","7","","28","1","78","","2","7","3","7","","","","16","2014-04-05 10:48:07","16","2014-04-09 10:29:35","","","","");
INSERT INTO complaint VALUES("581","Maintenance-0000396","window glass is not opening properly","as early as possible","9","","37","1","54","","2","9","3","5","","","","73","2014-04-05 10:48:33","37","2014-04-07 16:42:36","","","","");
INSERT INTO complaint VALUES("582","Maintenance-0000397","splints needed 100 nos for NICU","URGENT","9","","37","1","55","","2","9","3","5","","","","73","2014-04-05 10:49:52","37","2014-04-07 16:42:22","","","","");
INSERT INTO complaint VALUES("583","Maintenance-0000398","Rooms F-1,F-2,B-1,C-1,C-2,C-3, E-4 ,E-8 Fan making noise,& D-1,D-2,selling tub light is not working to be check. ","as soon as possible.","5","","24","1","63","","2","5","3","7","","","","87","2014-04-05 10:54:35","87","2014-04-07 15:37:58","","","","");
INSERT INTO complaint VALUES("584","Maintenance-0000399","Room  \'C\' Toilet hand wash sink water leakage to be check. ","as soon as possible.","6","","32","1","63","","2","6","3","7","","","","87","2014-04-05 10:58:41","87","2014-04-07 15:36:57","","","","");
INSERT INTO complaint VALUES("585","Maintenance-0000400","heater is not working to be check.","as soon as possible.","7","","28","1","63","","2","7","3","7","","","","87","2014-04-05 10:59:56","87","2014-04-07 15:34:57","","","","");
INSERT INTO complaint VALUES("586","MIS-0000186","out look express is not opening please do the need full doctor is asking to check the inbox .","urgent","3","","112","1","76","","1","3","3","5","","","","206","2014-04-05 11:40:14","112","2014-04-05 11:50:08","","","","");
INSERT INTO complaint VALUES("587","Maintenance-0000401","nursing station  first cup board is broken
INSERT INTO complaint VALUES("588","Maintenance-0000402","I-ROOM TOILET","EXHAUST FAN IS NOT WORKING","7","","29","1","64","","2","7","3","7","","","","110","2014-04-05 12:31:57","110","2014-04-09 13:08:57","","","","");
INSERT INTO complaint VALUES("589","Maintenance-0000403","RT backside board light to be fixed","replace bulb soon","5","","24","1","23","","2","5","3","7","","","","16","2014-04-05 12:38:28","16","2014-04-09 10:29:24","","","","");
INSERT INTO complaint VALUES("590","Maintenance-0000404","PLUMBING IN WING 5 SEMI","WATER IS NOT COMING IN C ROOM","6","","31","1","64","","2","6","3","5","","","","325","2014-04-05 15:20:22","227","2014-04-07 09:22:27","","","","");
INSERT INTO complaint VALUES("591","Maintenance-0000405","lab 2 nd floor Clinical path tube light is blinking ","tube light not working","5","","23","1","17","","2","5","3","7","","","","113","2014-04-05 19:05:21","113","2014-04-08 16:35:11","","","","");
INSERT INTO complaint VALUES("592","Maintenance-0000406","staff rest room toilet flush leaking","please rectify","6","","31","1","53","","2","6","3","5","","","","119","2014-04-06 05:23:27","227","2014-04-07 09:23:03","","","","");
INSERT INTO complaint VALUES("593","Maintenance-0000407","3216 bathroom bulb to be replaced","3216bathroom bulb to be replaced","5","","23","1","50","","2","5","3","7","","","","177","2014-04-06 10:43:02","177","2014-04-08 13:28:56","","","","");
INSERT INTO complaint VALUES("594","Maintenance-0000408","leaking problem","bath room flush leacking","6","","31","1","64","","2","6","3","5","","","","325","2014-04-06 20:36:25","227","2014-04-07 09:24:41","","","","");
INSERT INTO complaint VALUES("595","Maintenance-0000409","water is not coming","w c room bath room flush is not working ","6","","31","1","64","24","2","6","3","5","","","","325","2014-04-06 20:42:13","227","2014-04-07 09:20:26","","","","");
INSERT INTO complaint VALUES("596","Maintenance-0000410","Washing area light is not working.","needs urgent.","5","","23","1","59","","2","5","3","5","","","","116","2014-04-07 07:58:27","227","2014-04-07 09:28:37","","","","");
INSERT INTO complaint VALUES("597","Maintenance-0000411","Community lab is locked, not able to open. Kinldy   do the needful.","Urgent","9","","37","4","107","","2","9","3","7","","","","265","2014-04-07 08:08:54","265","2014-04-11 15:49:23","","","","");
INSERT INTO complaint VALUES("598","Maintenance-0000412","C,J,K-ROOM TOILET","FLUSH IS NOT WORKING","6","","31","1","64","","2","6","3","5","","","","319","2014-04-07 08:16:50","227","2014-04-07 09:21:15","","","","");
INSERT INTO complaint VALUES("599","Maintenance-0000413","I-ROOM TOILET","EXHAUST FAN IS NOT WORKING","5","","24","1","64","","2","5","3","5","","","","319","2014-04-07 08:17:36","227","2014-04-07 12:06:38","","","","");
INSERT INTO complaint VALUES("600","Maintenance-0000414","MALE SIDE G-ROOM BED NO-1","SIDE RAILS IS NOT WORKING","7","","29","1","64","","2","7","3","7","","","","110","2014-04-07 08:26:22","110","2014-04-09 13:07:48","","","","");
INSERT INTO complaint VALUES("601","Maintenance-0000415","MALE SIDE TOILET","CUBOARD TO BE FIXED","9","","37","1","64","","2","9","3","3","6","","outsource to be done ","110","2014-04-07 08:27:18","37","2014-05-06 09:48:27","","","","");
INSERT INTO complaint VALUES("602","MIS-0000187","system 02 ","system 02 is not working","3","","112","1","61","","1","3","3","5","","","","105","2014-04-07 08:39:18","112","2014-04-07 08:55:33","","","","");
INSERT INTO complaint VALUES("603","Maintenance-0000416","O2 cylinder to be filled","05/04/2014 11:30pm","5","","22","1","65","","2","5","3","7","","","","225","2014-04-07 08:53:56","225","2014-04-29 12:08:11","","","","");
INSERT INTO complaint VALUES("604","Maintenance-0000417","IN X-RAY CR ROOM, FLOOR TILES 3-4 HAS BEEN DAMAGED, IT HAS TO BE FIXED. ","IN X-RAY CR ROOM, FLOOR TILES 3-4 HAS BEEN DAMAGED, IT HAS TO BE FIXED. PLEASE DO THE NEEDFUL AT THE EARLIEST.","12","","386","1","90","","2","12","3","5","6","","civil work out source to be done","70","2014-04-07 08:54:32","227","2014-05-28 15:30:30","","","","");
INSERT INTO complaint VALUES("605","Maintenance-0000418","O2 cylinder to be filled","07/04/2014 6:15am","5","","25","1","63","","2","5","3","7","","","","225","2014-04-07 08:55:00","225","2014-04-29 12:08:03","","","","");
INSERT INTO complaint VALUES("606","Maintenance-0000419","Tube light not working","03/04/2014 3:00pm","5","","22","1","2","","2","5","3","7","","","","225","2014-04-07 09:00:43","225","2014-04-29 12:07:55","","","","");
INSERT INTO complaint VALUES("607","Maintenance-0000420","Waiting area chairs broken","Pls do the needful asap","7","","28","1","102","","2","7","3","5","","","","96","2014-04-07 09:23:25","28","2014-04-07 11:51:07","","","","");
INSERT INTO complaint VALUES("608","MIS-0000188","computer not working","Urgent","2","","112","1","105","","1","2","3","5","","0","","291","2014-04-07 09:23:32","112","2014-04-07 09:26:59","","","","");
INSERT INTO complaint VALUES("609","Maintenance-0000421","SPW & Psychiatric above cameras not working ","rectify soon","8","","33","1","70","","2","8","3","7","","","","16","2014-04-07 09:32:56","16","2014-04-09 10:29:12","","","","");
INSERT INTO complaint VALUES("610","Maintenance-0000422","Call bell system is not working, though they came and checked it is still the same now.","Can u please rectify it at the earliest.
INSERT INTO complaint VALUES("611","MIS-0000189","To Connect computer and Printer","Urgent","2","","112","1","105","","1","2","3","7","","0","","291","2014-04-07 09:37:50","291","2014-04-07 15:42:57","","","","");
INSERT INTO complaint VALUES("612","Maintenance-0000423","student hostel 2nd buldg 2nd floor sink & bathrooms blocked ","come soon","6","","31","2","2","","2","6","3","7","","","","16","2014-04-07 10:05:07","16","2014-04-09 10:16:52","","","","");
INSERT INTO complaint VALUES("613","MIS-0000190","Request: Kindly put the poster send as attachment for all BBH desktop background as screen saver for this week, for the up coming 1st ever workshop of its kind at BBH.","Request: Kindly put the poster send as attachment for all BBH desktop background as screen saver for this week, for the up coming 1st ever workshop of its kind at BBH.","3","","8","1","81","","1","3","3","5","","","","99","2014-04-07 10:11:50","8","2014-04-07 11:16:44","20140407101150_Emergency Poster.pdf","","","");
INSERT INTO complaint VALUES("614","Maintenance-0000424","X-RAY 700 ROOM DOOR NOT ABLE TO CLOSE PROPERLY. ITS BROKEN, TO BE FIXED.","X-RAY 700 ROOM DOOR NOT ABLE TO CLOSE PROPERLY. ITS BROKEN, TO BE FIXED.","9","","37","1","90","","2","9","3","5","6","","Its led door hence outsource to be done ","70","2014-04-07 10:18:39","37","2014-05-06 09:48:44","","","","");
INSERT INTO complaint VALUES("615","Maintenance-0000425","TOKEN PRINT IS NOT COMING, UNABLE TO ISSUE TOKEN TO PATIENTS. ","TOKEN PRINT IS NOT COMING, UNABLE TO ISSUE TOKEN TO PATIENTS.","8","","34","1","90","","2","8","3","5","","","","70","2014-04-07 10:31:34","227","2014-04-07 10:58:51","","","","");
INSERT INTO complaint VALUES("616","Maintenance-0000426","To fix broken cupboard hinges","kindly repair at the earliest","9","","37","5","78","","2","9","3","5","","","","261","2014-04-07 10:31:36","37","2014-04-08 10:14:05","","","","");
INSERT INTO complaint VALUES("617","MIS-0000191","patient name Eshwaraiya   AA223996. unable to take print out thought it is validated. only for HBA1C ","Urgent  Patient waiting for report ","3","","6","1","17","27","1","3","3","7","","","","69","2014-04-07 10:49:33","69","2014-04-09 13:10:20","20140407111026_mllabreportaa223996.pdf#","","","");
INSERT INTO complaint VALUES("618","Maintenance-0000427","Fan regulator broken, need to fix new one.","Fan regulator broken, need to fix new one.","5","","24","1","81","","2","5","3","5","","","","99","2014-04-07 11:03:11","24","2014-04-07 16:34:20","","","","");
INSERT INTO complaint VALUES("619","Maintenance-0000428","IN X-RAY BOTH THE SYNC NOT WORKING, ITS BLOCKED. ","IN X-RAY BOTH THE SYNC NOT WORKING, ITS BLOCKED. TO BE DONE IMMEDIATELY.","6","","32","1","90","","2","6","3","5","","","","70","2014-04-07 11:10:54","31","2014-04-07 16:38:57","","","","");
INSERT INTO complaint VALUES("620","Maintenance-0000429","O2 cylinder.","O2 flow meter is broken.","7","","28","1","62","","2","7","3","5","","","","107","2014-04-07 11:27:24","28","2014-04-07 16:38:29","","","","");
INSERT INTO complaint VALUES("621","Maintenance-0000430","LDPR Washing Area is blocked","needs urgent","6","","32","1","59","","2","6","3","5","","","","116","2014-04-07 11:30:15","31","2014-04-07 16:39:14","","","","");
INSERT INTO complaint VALUES("622","MIS-0000192","System 2 is not working due to some loose connection..","Please rectify it at the earliest. Thank you.","2","","112","1","52","","1","2","3","7","","887","","128","2014-04-07 11:31:58","128","2014-04-10 08:48:45","","","","");
INSERT INTO complaint VALUES("623","Maintenance-0000431","Ext 505 not working complaint raised on 4/4/14 not yet rectified","high priority","8","","33","1","40","","2","8","3","7","","","","65","2014-04-07 11:34:11","65","2014-04-07 13:31:45","","","","");
INSERT INTO complaint VALUES("624","Maintenance-0000432","tube light not working","rectify soon","5","","23","1","19","","2","5","3","7","","","","16","2014-04-07 11:34:19","16","2014-04-07 16:47:01","","","","");
INSERT INTO complaint VALUES("625","Maintenance-0000433","tube light not working","rectify soon","5","","23","1","72","","2","5","3","7","","","","16","2014-04-07 11:34:49","16","2014-04-07 16:46:50","","","","");
INSERT INTO complaint VALUES("626","Maintenance-0000434","To fix the spot lamp inside the doctor cabin","Kindly to the needful asap","5","","22","1","33","","2","5","3","7","","","","96","2014-04-07 11:36:55","96","2014-04-11 09:01:05","","","","");
INSERT INTO complaint VALUES("627","MIS-0000193","In strong room Internet connection is not activated","Urgent","2","","8","1","105","","1","2","3","5","2","0","Please inform us after complication of LAN connection.... ","291","2014-04-07 11:44:54","8","2014-04-16 11:20:29","","","","");
INSERT INTO complaint VALUES("628","MIS-0000194","CRP-05 In AccPac Idmsys MB forms, transaction.
INSERT INTO complaint VALUES("629","Maintenance-0000435","A-6 CEILING FAN","NOT WORKING","5","","23","1","61","","2","5","3","5","","","","104","2014-04-07 11:58:52","23","2014-04-07 16:37:02","","","","");
INSERT INTO complaint VALUES("630","Maintenance-0000436","tube light not working","rectify soon","5","","23","1","59","","2","5","3","7","","","","16","2014-04-07 12:09:14","16","2014-04-07 16:46:40","","","","");
INSERT INTO complaint VALUES("631","Maintenance-0000437","exhaust fan not working","rectify soon","5","","23","1","17","","2","5","3","7","","","","16","2014-04-07 12:09:51","16","2014-04-07 16:46:32","","","","");
INSERT INTO complaint VALUES("632","MIS-0000195","exhaust fan not working","rectify soon","","","123","1","17","","1","","3","7","","","","16","2014-04-07 12:11:47","227","2014-04-07 12:11:47","","","","");
INSERT INTO complaint VALUES("633","Maintenance-0000438","mens hostel tap broken","rectify soon","6","","31","1","2","","2","6","3","7","","","","16","2014-04-07 12:23:37","16","2014-04-07 16:46:18","","","","");
INSERT INTO complaint VALUES("634","Maintenance-0000439","We need network point (plug point board)for new computer connection.","We need network point (plug point board)for new computer connection.","5","","23","1","81","","2","5","3","5","","","","99","2014-04-07 12:43:45","227","2014-04-07 12:52:15","","","","");
INSERT INTO complaint VALUES("635","Maintenance-0000440","exhaust fan not working","rectify soon","5","","24","1","17","","2","5","3","7","","","","16","2014-04-07 12:47:58","16","2014-04-07 16:46:05","","","","");
INSERT INTO complaint VALUES("636","MIS-0000196","Printer Problem - bbh-adm-07","Printer Problem - bbh-adm-07","2","","5","1","94","","1","2","3","7","","637","","136","2014-04-07 12:49:25","136","2014-04-19 10:32:43","","","","");
INSERT INTO complaint VALUES("637","MIS-0000197","printer not working","please rectify as soon as possible , we have to take PFT print out","2","","112","1","102","","1","2","3","5","","0","","97","2014-04-07 12:52:52","112","2014-04-07 13:36:46","","","","");
INSERT INTO complaint VALUES("638","MIS-0000198","Kindly update the new charges for Health plan w.e.f april\'14  in the BBH website","Find the charges attached , do the needful asap","3","","8","1","33","","1","3","3","5","2","","web content has been sent back for update... once it is received it will be updated in website(bbh.org.in)","96","2014-04-07 13:19:58","8","2014-04-08 09:12:15","20140407131958_ApprovedPackages frm apr - 20.03.13 - new.xls","","","");
INSERT INTO complaint VALUES("639","MIS-0000199","Not able to get the transfer statement in Accpac. Adm-013","complaint number -0000184 not rectified.","3","","6","1","94","","1","3","3","7","","","","136","2014-04-07 14:16:09","136","2014-04-19 10:23:51","","","","");
INSERT INTO complaint VALUES("640","Maintenance-0000441","phone is not working in admission room","phone is not working in admission room","8","","34","1","16","","2","8","3","7","","","","132","2014-04-07 14:33:41","132","2014-04-08 10:56:08","","","","");
INSERT INTO complaint VALUES("641","Maintenance-0000442","ent door handle needs repair (ladies toilet) and central o.pd all 3 doors makes crecking noise.","urgent","9","","37","1","47","","2","9","3","5","","","","149","2014-04-07 14:39:03","37","2014-04-07 16:40:16","","","","");
INSERT INTO complaint VALUES("642","Maintenance-0000443","LDPR   PHONE IS NOT WORKING ","NEEDS URGENT","8","","34","1","59","","2","8","3","5","","","","116","2014-04-07 15:03:38","227","2014-04-07 15:29:07","","","","");
INSERT INTO complaint VALUES("643","MIS-0000200","Patient name- Clara
INSERT INTO complaint VALUES("644","Maintenance-0000444","S.OPD.PHONE.NO.314 NOT WORKING","ARGENT","8","","34","1","72","","2","8","3","5","","","","219","2014-04-07 15:23:56","227","2014-04-07 15:28:33","","","","");
INSERT INTO complaint VALUES("645","MIS-0000201","printer is not working","printer is not working","2","","112","1","16","19","1","2","3","7","","735","","132","2014-04-07 15:42:19","132","2014-04-07 15:45:09","","","","");
INSERT INTO complaint VALUES("646","Maintenance-0000445","patient complain aqua grad water coming very slow 
INSERT INTO complaint VALUES("647","MIS-0000202","kindly arranged call management user name and password , this staff.
INSERT INTO complaint VALUES("648","MIS-0000203","Vidas not inter faced.GTT interface not working for 75 grams.
INSERT INTO complaint VALUES("649","Maintenance-0000446","Fridge temperature is machine is not working","needs urgent.","7","","27","1","59","","2","7","3","5","","","","275","2014-04-07 16:02:14","27","2014-04-07 16:37:38","","","","");
INSERT INTO complaint VALUES("650","Maintenance-0000447","Fridge temperature machine is not working","needs urgent","7","","27","1","59","","2","7","3","5","","","","116","2014-04-07 16:06:36","27","2014-04-07 16:37:48","","","","");
INSERT INTO complaint VALUES("651","Maintenance-0000448","Room No.3207 TV is not working","Kindly do the needfull","8","","33","1","50","","2","8","3","7","","","","179","2014-04-07 16:08:32","179","2014-04-16 11:47:19","","","","");
INSERT INTO complaint VALUES("652","MIS-0000204","Aerobic culure order was placed for patient code AA234955 on 04.04.14 but we are not able to enter the result because the page is blank.","Urgent","3","","6","1","17","28","1","3","1","7","","","","302","2014-04-07 16:26:29","302","2014-05-16 07:47:33","","","","");
INSERT INTO complaint VALUES("653","MIS-0000205","Barcode not working .","Urgent ","3","","5","1","17","27","1","3","3","7","","","","69","2014-04-07 16:41:13","69","2014-04-09 13:04:48","","","","");
INSERT INTO complaint VALUES("654","MIS-0000206","Dr.Rajnish \'s Laptop to be restored","Dr.Rajnish \'s Laptop to be restored","3","","5","1","73","","1","3","3","5","","","","123","2014-04-07 16:45:16","5","2014-04-07 16:46:24","","","","");
INSERT INTO complaint VALUES("655","Maintenance-0000449","mens hostel switch to be replace","replace soon","7","","27","2","2","","2","7","3","7","","","","16","2014-04-07 16:47:29","16","2014-04-09 10:16:38","","","","");
INSERT INTO complaint VALUES("656","MIS-0000207","amendment report cannot be taken for kpi for march","ASAP........................","3","","6","1","17","30","1","3","3","7","5","","let  me know the report path","69","2014-04-07 16:50:07","69","2014-04-10 15:30:35","20140409084752_mlamendedtestsfor march2014.pdf#","","","");
INSERT INTO complaint VALUES("657","Maintenance-0000450","BED 5  Cot  Side rails to be fixed.","BED 5  Cot  Side rails to be fixed.","7","","28","1","54","","2","7","3","5","","","","114","2014-04-07 20:00:30","28","2014-04-08 08:58:42","","","","");
INSERT INTO complaint VALUES("658","Maintenance-0000451","room no 1511 Balken frame to be removed","please come as soon as possible, we have to receive new patient.","7","","28","1","49","","2","7","3","5","","","","97","2014-04-08 07:46:38","28","2014-04-08 08:58:32","","","","");
INSERT INTO complaint VALUES("659","MIS-0000208","computer is not working in classroom - 2, front of library","Urgent doctor is waiting","3","","112","1","105","","1","3","3","5","","","","291","2014-04-08 08:16:48","112","2014-04-08 08:25:33","","","","");
INSERT INTO complaint VALUES("660","MIS-0000209","System Name : BUS 06
INSERT INTO complaint VALUES("661","Maintenance-0000452","O2 cylinder is empty","07/04/2014    11:40pm","5","","25","1","60","","2","5","3","7","","","","225","2014-04-08 08:42:37","225","2014-04-29 12:07:45","","","","");
INSERT INTO complaint VALUES("662","MIS-0000210","cash counter-03 printer not working","cash counter-03 printer not working","2","","112","1","44","","1","2","3","5","","0","","118","2014-04-08 08:43:58","112","2014-04-08 08:47:02","","","","");
INSERT INTO complaint VALUES("663","Maintenance-0000453","O2 cylinder to be filled","07/04/2014   11:05pm","5","","25","1","81","","2","5","3","7","","","","225","2014-04-08 08:44:59","225","2014-04-29 12:07:32","","","","");
INSERT INTO complaint VALUES("664","Maintenance-0000454","O2 cylinder to be filled","07/04/2014   11:30pm","5","","25","1","61","","2","5","3","7","","","","225","2014-04-08 08:46:01","225","2014-04-29 12:06:52","","","","");
INSERT INTO complaint VALUES("665","Maintenance-0000455","wing-1 I-room calling bell not working","need to be urgent","8","","34","1","60","","2","8","3","5","","","","264","2014-04-08 08:57:43","34","2014-04-08 16:34:32","","","","");
INSERT INTO complaint VALUES("666","Maintenance-0000456","utility room side.","tap is leaking.","6","","31","1","61","","2","6","3","5","","","","107","2014-04-08 09:08:03","31","2014-04-08 10:38:01","","","","");
INSERT INTO complaint VALUES("667","Maintenance-0000457","pt attender stool to be repaint. 5 nos ","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-04-08 09:14:06","87","2014-04-11 12:51:20","","","","");
INSERT INTO complaint VALUES("668","Maintenance-0000458","PATIENT TROLLY
INSERT INTO complaint VALUES("669","MIS-0000211","unable to receive mail on Zimbra.","ASAP ","3","","8","1","17","30","1","3","3","7","6","","In which computer please give the details...","69","2014-04-08 09:25:24","69","2014-04-09 13:04:02","","","","");
INSERT INTO complaint VALUES("670","MIS-0000212","Printer not responding or hanging after printing every page","Tried restarting but to no avail","2","","112","1","94","37","1","2","3","7","","630","","137","2014-04-08 09:49:33","137","2014-04-08 15:00:38","","","","");
INSERT INTO complaint VALUES("671","MIS-0000213","We are not able to save in the provisional bills.","All the three patient we had updated and saved the Room rent in the provisional bill but once it is closed and reopened it is not getting saved","3","","9","1","40","12","1","3","3","5","2","","This issue has been explained in the previous ticket while closing.Always provisional bills are new. The issue we found on non medical services i.e. while saving the provisional bill only for the Lab services  there is a instability of insured \'YES\' or \'NO\' option.This has been informed to Ms.IdMsys and the solution is expecting in the next customization.","65","2014-04-08 09:56:36","123","2014-05-29 10:04:38","20140408095636_MIS problem.pdf","","","");
INSERT INTO complaint VALUES("672","Maintenance-0000459","F ROOM WINDOW MESH [ REMAINDER]","TO BE REPAIRED.","9","","37","1","61","","2","9","3","5","","","","104","2014-04-08 10:29:45","37","2014-04-09 08:47:46","","","","");
INSERT INTO complaint VALUES("673","MIS-0000214","computer from pediatric opd room no 5 not working.","pl. do the needful.","3","","5","1","79","","1","3","3","5","","","","216","2014-04-08 10:36:49","5","2014-04-08 10:41:28","","","","");
INSERT INTO complaint VALUES("674","Maintenance-0000460","Centrifuge not working .800684 is centrifuge number  .","ASAP.....................","7","","26","1","17","","2","7","3","5","","","","300","2014-04-08 10:45:15","26","2014-04-15 12:39:10","","","","");
INSERT INTO complaint VALUES("675","Maintenance-0000461","token machine need to be fix","token machine need to be fix","9","","37","1","16","","2","9","3","7","","","","132","2014-04-08 10:55:05","132","2014-04-10 11:31:39","","","","");
INSERT INTO complaint VALUES("676","MIS-0000215","the printer is not working although its in and all cables are connected it says to check the connection. Kindly do the needful as soon as possible. thank you.","thank you ","2","","8","1","46","","1","2","3","5","","0","","258","2014-04-08 10:55:33","8","2014-04-08 11:19:36","","","","");
INSERT INTO complaint VALUES("677","Maintenance-0000462","WALL MOUNTED FAN TO BE FIXED IN X-RAY RECEPTION","WALL MOUNTED FAN TO BE FIXED IN X-RAY RECEPTION, DO THE NEEDFUL.","5","","22","1","90","","2","5","3","5","","","","70","2014-04-08 11:03:52","22","2014-04-08 16:28:58","","","","");
INSERT INTO complaint VALUES("678","Maintenance-0000463","Qtrs Crest view Dr deeksha house sink blocked 9741361410","attend soon","6","","31","1","2","","2","6","3","7","","","","16","2014-04-08 11:13:01","16","2014-04-09 10:16:30","","","","");
INSERT INTO complaint VALUES("679","Maintenance-0000464","Ladies staff hostel room#9 fan not working","rectify soon","5","","22","2","2","","2","5","3","7","","","","16","2014-04-08 11:13:29","16","2014-04-09 10:16:21","","","","");
INSERT INTO complaint VALUES("680","MIS-0000216","COMPUTER NO 2 IS NOT WORKING ","COMPUTER NO 2 IS NOT WORKING","3","","8","1","50","","1","3","3","7","","","","177","2014-04-08 11:20:31","177","2014-04-08 13:30:58","","","","");
INSERT INTO complaint VALUES("681","Maintenance-0000465","high dusting in peadiatric opd to be done.","as early as possible.
INSERT INTO complaint VALUES("682","Maintenance-0000466","plug point to be fixed in class room","rectify soon","5","","23","1","27","","2","5","3","7","","","","16","2014-04-08 11:44:51","16","2014-04-09 10:16:12","","","","");
INSERT INTO complaint VALUES("683","MIS-0000217","1 file got deleted from share folder","MSDS excel work book got deleted from kavya share folder. 
INSERT INTO complaint VALUES("684","Maintenance-0000467","Television not working in room no 1512","please come immediately..","8","","34","1","49","","2","8","3","5","","","","97","2014-04-08 12:12:14","34","2014-04-08 16:34:12","","","","");
INSERT INTO complaint VALUES("685","Maintenance-0000468","pc opd ladies toilet block","urgent","6","","31","1","47","","2","6","3","5","6","","major work main line blocked Outsource to be done","149","2014-04-08 12:27:31","31","2014-04-08 16:32:15","","","","");
INSERT INTO complaint VALUES("686","Maintenance-0000469","I-ROOM BED NO:3","SIDE RAILS TO BE FIXED","7","","28","1","64","","2","7","3","7","","","","110","2014-04-08 12:35:50","110","2014-04-09 13:07:03","","","","");
INSERT INTO complaint VALUES("687","Maintenance-0000470","WASHING AREA FOR DISABLED","SINK IS BLOCKED","6","","31","1","64","","2","6","3","7","","","","110","2014-04-08 12:36:29","110","2014-04-09 13:04:29","","","","");
INSERT INTO complaint VALUES("688","MIS-0000218","PC cash counter - printer not working","PC cash counter - printer not working","2","","112","1","44","","1","2","3","5","","0","","118","2014-04-08 12:44:11","112","2014-04-08 14:09:09","","","","");
INSERT INTO complaint VALUES("689","Maintenance-0000471","Again telephone is not working. So please check sir.","In Histopathology","8","","33","1","17","","2","8","3","7","6","","Complaint repeating due to instrument problem, Instrument no stock, non stock raised on 04/12/2013 non stock no:-53	
INSERT INTO complaint VALUES("690","Maintenance-0000472","MALE SIDE TOILET","FLUSH WATER IS NOT COMING","6","","32","1","64","","2","6","3","7","","","","110","2014-04-08 13:22:13","110","2014-04-09 12:50:29","","","","");
INSERT INTO complaint VALUES("691","Maintenance-0000473","MALE SIDE TOILET","EXHAUST FAN IS NOT WORKING","5","","22","1","64","","2","5","3","7","","","","110","2014-04-08 13:23:17","110","2014-04-09 12:49:55","","","","");
INSERT INTO complaint VALUES("692","Maintenance-0000474"," no water supply  in patient room 3202","do the needful","6","","32","1","50","","2","6","3","5","","","","177","2014-04-08 13:27:13","32","2014-04-08 15:53:22","","","","");
INSERT INTO complaint VALUES("693","Maintenance-0000475","Patient cot ,side rails to be repaired.[BED NO-5}","please kindly do the needful","7","","27","1","52","","2","7","3","5","","","","154","2014-04-08 13:27:42","27","2014-04-08 16:31:11","","","","");
INSERT INTO complaint VALUES("694","MIS-0000219","system is very slow","system is very slow","3","","5","1","16","19","1","3","3","7","","","","132","2014-04-08 14:09:24","132","2014-04-08 16:28:20","","","","");
INSERT INTO complaint VALUES("695","MIS-0000220","system is not working","system is not working","2","","112","1","16","35","1","2","3","7","","0","","132","2014-04-08 14:18:38","132","2014-04-08 16:26:48","","","","");
INSERT INTO complaint VALUES("696","MIS-0000221","sumitha ,veldurac for this ids inventory location not working","very urgent","3","","6","1","73","","1","3","3","5","","","","210","2014-04-08 14:34:07","6","2014-04-08 16:09:24","","","","");
INSERT INTO complaint VALUES("697","MIS-0000222","Request Photos of the Hospital -Hen Coop, NABL & NABH Certificates, Cath Lab & RMU Scan Room, Community Health Camp, Palliative  Care Outdoor,Education-ALHS,Nursing,Med School,QCI-DL Shah Awards & Certificates, Mentored Hospitals K C General & Jayanagar,DDRC Photos, Balasurakha unit, ","Healthcare Radius Photo requirement -Word document attached","3","","8","1","94","37","1","3","3","7","","","","137","2014-04-08 15:14:25","137","2014-06-10 15:52:01","20140408151425_BBH Healthcare 10 Things about BBH_030414 edited GN.docx20140603105850_5.jpg#","","","");
INSERT INTO complaint VALUES("698","Maintenance-0000476","Ambulance switch board to be replaced","Ambulance switch board to be replaced","7","","27","1","99","","2","7","3","5","","","","350","2014-04-08 16:18:16","27","2014-04-10 16:47:42","","","","");
INSERT INTO complaint VALUES("699","MIS-0000223","Lazar printer is taken by lokesh in the month nov-2013 still not return & we need condmenation report for monitor","Lazar printer is taken by lokesh in the month nov-2013 still not return & we need condmenation report for monitor","2","","112","1","16","19","1","2","3","7","6","0","................................","132","2014-04-08 16:33:46","132","2014-05-16 10:44:15","","","","");
INSERT INTO complaint VALUES("700","MIS-0000224","Pt name kannan.s 
INSERT INTO complaint VALUES("701","Maintenance-0000477","GYM pedaling cycle seat locking system not working ","repair it soon","7","","27","1","70","","2","7","3","7","6","","","16","2014-04-08 17:07:37","16","2014-04-09 10:16:03","","","","");
INSERT INTO complaint VALUES("702","Maintenance-0000478","DNB student hostel bunker cot to be dismantled ","complaint given by Mal ( med Sec )","7","","27","1","2","","2","7","3","7","","","","16","2014-04-08 17:08:21","16","2014-04-09 10:15:51","","","","");
INSERT INTO complaint VALUES("703","Maintenance-0000479","Toilet door is broken","kindly rectify & do the needful","9","","37","1","93","","2","9","3","7","","","","79","2014-04-09 07:45:55","79","2014-04-09 09:54:20","","","","");
INSERT INTO complaint VALUES("704","MIS-0000225","Kinldy upload the  application form in the website.","Urgent ","2","","8","4","107","","1","2","3","7","","0","","265","2014-04-09 07:47:06","265","2014-04-11 15:48:41","","","","");
INSERT INTO complaint VALUES("705","Maintenance-0000480","O2 cylinder to be filled","O2 cylinder to be filled","5","","25","1","81","","2","5","3","7","","","","225","2014-04-09 07:48:48","225","2014-04-29 12:06:44","","","","");
INSERT INTO complaint VALUES("706","Maintenance-0000481","Please ignore the first mail 
INSERT INTO complaint VALUES("707","Maintenance-0000482","door stop cock to be fixed","urgent","9","","37","1","54","","2","9","3","5","","","","73","2014-04-09 08:11:52","37","2014-04-09 15:45:11","","","","");
INSERT INTO complaint VALUES("708","MIS-0000226","PRINTER NOT WORKING.","PRINTER NOT WORKING.","2","","112","1","81","","1","2","3","5","","915","","99","2014-04-09 08:17:10","112","2014-04-09 08:25:09","","","","");
INSERT INTO complaint VALUES("709","MIS-0000227","crp-08 , keyboard keys are not working.","High priority","2","","112","1","40","11","1","2","3","7","","706","","313","2014-04-09 08:20:56","313","2014-04-30 08:44:01","","","","");
INSERT INTO complaint VALUES("710","Maintenance-0000483","IN ROOM 3202 HOT WATER TAP KEYS ARE NOT WORKING ,A S THERE IS CONTINUOUS NON STOP WATER FLOW  , THE SOUND IS INCONVENIENCE TO THE PATIENT  ","KINDLY DO THE NEEDFUL AS SOON AS POSSIBLE. ","6","","31","1","50","","2","6","3","5","","","","126","2014-04-09 08:23:16","31","2014-04-09 15:34:20","","","","");
INSERT INTO complaint VALUES("711","MIS-0000228","ULTRASOUND SCAN ROOM ,ROOM- NO-10 RECEPTION COMPUTER NOT WORKING. IMMEDIATE ACTION TO BE TAKEN. ","ULTRASOUND SCAN ROOM ,ROOM- NO-10 RECEPTION COMPUTER NOT WORKING. IMMEDIATE ACTION TO BE TAKEN.","2","","112","1","104","","1","2","3","5","","0","","70","2014-04-09 08:26:22","112","2014-04-09 09:07:09","","","","");
INSERT INTO complaint VALUES("712","Maintenance-0000484","K-ROOM TOILET","EXHAUST FAN IS NOT WORKING","5","","24","1","64","","2","5","3","7","","","","110","2014-04-09 08:28:08","110","2014-04-09 12:48:51","","","","");
INSERT INTO complaint VALUES("713","Maintenance-0000485","KINDLY ISSUE THE SERVICE   CERTIFICATE   OR CALIBRATION CERTIFICATE OF FRIDGE AND ITS MONITOR  FOR NABH AUDIT ","KINDLY  ISSUE AS SOON AS POSSIBLE. ","7","","26","1","50","","2","7","3","5","","","","126","2014-04-09 08:29:02","26","2014-04-16 08:48:03","","","","");
INSERT INTO complaint VALUES("714","MIS-0000229","printer not working","come ASAP.","2","","112","1","49","","1","2","3","5","","918","","97","2014-04-09 08:33:03","112","2014-04-09 09:02:03","","","","");
INSERT INTO complaint VALUES("715","Maintenance-0000486","IN ROOM 3203 THE CEILING FAN   RUNS VERY SLOW ,SINCE THE REGULATOR IS NOT IN WORKING CONDITION ","PLEASE RECTIFY .","5","","24","1","50","","2","5","3","7","","","","126","2014-04-09 08:36:21","126","2014-04-09 16:14:10","","","","");
INSERT INTO complaint VALUES("716","Maintenance-0000487","UTILITY ROOM","SINK IS BLOCKED","6","","31","1","64","","2","6","3","7","","","","110","2014-04-09 08:39:49","110","2014-04-10 12:32:37","","","","");
INSERT INTO complaint VALUES("717","Maintenance-0000488","This is to inform that OT needs Ortho wooden table big -(2nos)","do it soon","9","","37","1","58","","2","9","3","5","6","","its new requirement hence it will be delayed due to outsource to be done","124","2014-04-09 08:47:11","37","2014-06-12 10:27:12","","","","");
INSERT INTO complaint VALUES("718","MIS-0000230","sumitha   inventory  please do authorization access it ican\'t enter any inventory kindly do needful","very urgent","3","","6","1","73","","1","3","3","5","","","","210","2014-04-09 08:49:19","6","2014-04-09 08:57:18","","","","");
INSERT INTO complaint VALUES("719","Maintenance-0000489","1.Water leaking from tap, need to repair.
INSERT INTO complaint VALUES("720","MIS-0000231","To  go with Director (CEO) to Missionaries of Charity, Yelahanka","9.30 a.m.","2","","8","1","94","37","1","2","3","7","","0","","136","2014-04-09 09:21:58","136","2014-04-19 10:31:51","","","","");
INSERT INTO complaint VALUES("721","MIS-0000232","In outlook express incoming mails are not receiving. Last mail received was on 04.04.2014","urgent","3","","5","4","24","","1","3","3","7","6","","checking","153","2014-04-09 09:32:26","153","2014-04-19 09:34:01","","","","");
INSERT INTO complaint VALUES("722","Maintenance-0000490","SUCTION BOTTLE ON AND OFF BUTTON IS BROKEN AND FOR SUCTION BOTTLE WALL FIXING SCROO CAME OUT","TO BE CHECKED IMMEDIATELY","7","","28","1","53","","2","7","3","5","","","","119","2014-04-09 10:00:55","28","2014-04-09 12:03:16","","","","");
INSERT INTO complaint VALUES("723","MIS-0000233","SAGE ACC PACK IS NOT OPENING PLEASE DO THE NEEDFUL  BECAUSE TODAY WE HAVE TO INDENT THE THINGS ","URGENT ","3","","5","1","71","","1","3","3","5","","","","72","2014-04-09 10:02:28","5","2014-04-09 10:08:21","","","","");
INSERT INTO complaint VALUES("724","Maintenance-0000491","wall clock to be remove &  fixed in the corridor  near injection room ","urgent ","9","","37","1","71","","2","9","3","5","","","","72","2014-04-09 10:04:27","37","2014-04-09 15:45:46","","","","");
INSERT INTO complaint VALUES("725","Maintenance-0000492","Sink blocked to be removed","come soon","6","","31","1","78","","2","6","3","7","6","","major work main line blocked ","16","2014-04-09 10:15:40","16","2014-04-14 13:07:29","","","","");
INSERT INTO complaint VALUES("726","Maintenance-0000493","o2 cylender meter not working.","o2 cylender meter not working.","7","","29","1","81","","2","7","3","5","","","","99","2014-04-09 10:22:02","29","2014-04-09 15:38:43","","","","");
INSERT INTO complaint VALUES("727","Maintenance-0000494","O2 cylinder empty","to be changed immediately","5","","22","1","53","","2","5","3","5","","","","139","2014-04-09 10:33:21","22","2014-04-09 14:58:18","","","","");
INSERT INTO complaint VALUES("728","Maintenance-0000495","spot light not working & tube light fused","very urgent","5","","24","1","73","","2","5","3","5","","","","210","2014-04-09 10:39:39","24","2014-04-09 14:57:59","","","","");
INSERT INTO complaint VALUES("729","Maintenance-0000496","Please send a plumber to fix the leaking at the dietary kitchen,back area main kitchen.","very urgent","6","","31","1","68","","2","6","3","7","1","","Spindle no stock non stock raised on 18/01/2014 NS no 61
INSERT INTO complaint VALUES("730","Maintenance-0000497","sidelining door bush to replace ","urgent ","9","","37","1","75","","2","9","3","5","","","","207","2014-04-09 10:58:25","37","2014-04-09 15:45:57","","","","");
INSERT INTO complaint VALUES("731","Maintenance-0000498","lab ground floor opd ladies toliet water is not draning out","it is urgent","6","","31","1","17","","2","6","3","7","","","","113","2014-04-09 11:10:56","113","2014-04-15 09:21:09","","","","");
INSERT INTO complaint VALUES("732","Maintenance-0000499","1.KAMOD BROKEN NEED TO FIX PROPERLY (ER).
INSERT INTO complaint VALUES("733","Maintenance-0000500","wash basin pipe to be changed","urgent","6","","31","1","114","","2","6","3","5","","","","73","2014-04-09 11:36:00","31","2014-04-09 15:26:13","","","","");
INSERT INTO complaint VALUES("734","MIS-0000234","To transfer some photos to Mr.Naveen Balakrishna\'s system from the desktop of K.R.Seshadri\'s system.","Mr.Uday to attend at his earliest.
INSERT INTO complaint VALUES("735","Maintenance-0000501","NURSES STATION
INSERT INTO complaint VALUES("736","Maintenance-0000502","Partion door needs to be repaired in Classroom 1 (Academic Centre) opposite to Medical library","Kindly do at the earliest as we an Audit from Malaysian Medical Council","9","","37","1","105","","2","9","3","5","","","","290","2014-04-09 11:54:19","37","2014-04-09 16:34:07","","","","");
INSERT INTO complaint VALUES("737","Maintenance-0000503","ASAP 	ticket no. Maintenance-0000328 	1. Mosquito mesh of the main entrance door damaged. 2. Photo flame to be shifted to a different location 3. Two big and one small curtain roads to be fixed 2 in the new GH and One int he old GH 4. Contact Indane for substitution of faulty Gas regulator. 	Guest House 	carpentry 	2014-04-03 15:51:32 	In Progress","Reminder ticket non 0000328","9","","37","3","113","","2","9","3","7","","","","259","2014-04-09 12:02:51","259","2014-06-06 12:39:26","","","","");
INSERT INTO complaint VALUES("738","MIS-0000235","internet working","urgent","2","","5","1","27","10","1","2","3","5","","924","","260","2014-04-09 12:09:27","5","2014-04-09 12:10:01","","","","");
INSERT INTO complaint VALUES("739","Maintenance-0000504","MIS Department main door is not able to Lock.","MIS Department main door is not able to Lock.
INSERT INTO complaint VALUES("740","MIS-0000236","*MEMORY FULL IN PACS
INSERT INTO complaint VALUES("741","MIS-0000237","mouse not working ","urgent ","2","","112","1","29","","1","2","3","5","","694","","347","2014-04-09 12:36:54","112","2014-04-09 12:37:36","","","","");
INSERT INTO complaint VALUES("742","MIS-0000238","in wing -4 unused computer monitor (Old ) kindly take back to MIS department. 
INSERT INTO complaint VALUES("743","MIS-0000239","ipb-08, please update the system","ipb-08, please update the system","3","","5","1","42","","1","3","3","5","","","","118","2014-04-09 13:18:22","5","2014-04-09 14:08:20","","","","");
INSERT INTO complaint VALUES("744","Maintenance-0000505","In lab OPD the computers are not connected to the UPS . Every time there is a power failure the system gets off. ","Very very urgent ","7","","29","1","17","","2","7","3","7","","","","69","2014-04-09 13:19:21","69","2014-04-10 15:29:49","","","","");
INSERT INTO complaint VALUES("745","MIS-0000240","not able to get the transfer statement in Accpac","complaint no 0000184, 0000199 not yet rectified.","3","","6","1","94","","1","3","3","7","","","","136","2014-04-09 14:00:05","136","2014-04-19 10:23:22","","","","");
INSERT INTO complaint VALUES("746","MIS-0000241","IBIN, Invitation Design","IBIN, Invitation Design","3","","8","1","94","","1","3","3","7","","","","136","2014-04-09 14:14:43","136","2014-04-19 11:00:39","","","","");
INSERT INTO complaint VALUES("747","MIS-0000242","Printer suddenly got off","In histopathology","2","","112","1","17","","1","2","3","7","","811","","113","2014-04-09 14:40:48","113","2014-04-15 09:21:50","","","","");
INSERT INTO complaint VALUES("748","Maintenance-0000506","O2 cylinder to be filled ","replace soon","5","","23","1","50","","2","5","3","7","","","","16","2014-04-09 14:59:05","16","2014-04-10 13:28:08","","","","");
INSERT INTO complaint VALUES("749","Maintenance-0000507","Hanging mats from pediatric O.P.D.not changed since long time.measurement taken 2 to 3 times old hanging mats are lying down in the garden. please do the needful.","kindly do the needful.
INSERT INTO complaint VALUES("750","MIS-0000243","IN X-RAY RECEPTION, MOUSE NOT WORKING, SYSTEM IS ALSO HANGED. PLS FIX IT","IN X-RAY RECEPTION, MOUSE NOT WORKING, SYSTEM IS ALSO HANGED. PLS FIX IT","2","","5","1","90","","1","2","3","5","","0","","70","2014-04-09 16:27:44","5","2014-04-09 16:31:32","","","","");
INSERT INTO complaint VALUES("751","Maintenance-0000508","auditorium doom light not working","electrician will come & rectify","5","","24","3","2","","2","5","3","7","","","","225","2014-04-09 16:31:46","225","2014-04-29 12:06:06","","","","");
INSERT INTO complaint VALUES("752","Maintenance-0000509","18 no Sterile stands to be fixed","fix it soon","9","","37","1","81","","2","9","3","7","","","","16","2014-04-09 17:07:56","16","2014-04-15 09:23:37","","","","");
INSERT INTO complaint VALUES("753","Maintenance-0000510","NURSES CHANGING ROOM SINK BLOCKED","PLEASE DO THE NEEDFUL","6","","32","1","50","","2","6","3","7","","","","181","2014-04-09 17:11:38","181","2014-04-10 17:48:20","","","","");
INSERT INTO complaint VALUES("754","MIS-0000244","Canon Printer is not working","In Lab OPD.","2","","5","1","17","","1","2","3","7","","822","","113","2014-04-09 17:35:47","113","2014-04-15 09:21:42","","","","");
INSERT INTO complaint VALUES("755","Maintenance-0000511","Telephone is not working","in Lab OPD","8","","33","1","17","","2","8","3","7","","","","113","2014-04-09 18:47:35","113","2014-04-15 09:21:33","","","","");
INSERT INTO complaint VALUES("756","Maintenance-0000512","3202 AC LEAKING","PLEASE DO THE NEEDFUL","10","","26","1","50","","2","10","3","7","","","","181","2014-04-09 19:04:56","181","2014-04-10 19:20:45","","","","");
INSERT INTO complaint VALUES("757","Maintenance-0000513","This is your kind information that  chemotherapy unit, their is leak from ceiling.
INSERT INTO complaint VALUES("758","Maintenance-0000514","G ROOM BATHROOM IS BLOCKED WATER IS COMING OUT OF THE ROOM","VERY URGENT","6","","31","1","65","","2","6","3","7","","","","84","2014-04-10 08:17:00","84","2014-04-21 10:15:08","","","","");
INSERT INTO complaint VALUES("759","Maintenance-0000515","Suction apparatus not working","attend soon","5","","25","1","63","","2","5","3","7","","","","225","2014-04-10 08:22:49","225","2014-04-29 12:05:58","","","","");
INSERT INTO complaint VALUES("760","Maintenance-0000516","O2 cylinder is empty","attend soon","5","","25","1","65","","2","5","3","7","","","","225","2014-04-10 08:23:49","225","2014-04-29 12:05:51","","","","");
INSERT INTO complaint VALUES("761","Maintenance-0000517","WHEEL CHAIR PEDAL BROKEN, NEED TO FIX PROPERLY.","WHEEL CHAIR PEDAL BROKEN, NEED TO FIX PROPERLY.","7","","29","1","81","","2","7","3","5","","","","99","2014-04-10 08:25:15","29","2014-04-10 16:47:56","","","","");
INSERT INTO complaint VALUES("762","MIS-0000245","need to fix printer & system","need to fix printer & system","","","123","1","16","17","1","2","3","7","","","null","112","2014-04-10 08:26:29","112","2014-04-10 08:26:29","","","","");
INSERT INTO complaint VALUES("763","Maintenance-0000518","need to fix printer & system","need to fix printer & system","7","","26","1","16","17","2","7","3","7","","","","112","2014-04-10 08:30:27","112","2014-04-17 11:52:17","","","","");
INSERT INTO complaint VALUES("764","MIS-0000246","need to fix printer & system","need to fix printer & system","2","","112","1","16","17","1","2","3","7","","0","","112","2014-04-10 08:31:17","112","2014-04-10 09:59:29","","","","");
INSERT INTO complaint VALUES("765","MIS-0000247","Thermal printer not working.","ASAP............................","2","","112","1","17","34","1","2","3","7","","820","","69","2014-04-10 08:32:23","69","2014-04-10 09:58:37","","","","");
INSERT INTO complaint VALUES("766","Maintenance-0000519","O2 cylinder is empty","attend soon","5","","25","1","54","","2","5","3","7","","","","227","2014-04-10 08:37:43","227","2014-04-11 13:31:17","","","","");
INSERT INTO complaint VALUES("767","Maintenance-0000520","O2 cylinder is empty","09/04/2014  11:45pm","5","","25","1","81","","2","5","3","7","","","","227","2014-04-10 08:38:46","227","2014-04-11 13:31:05","","","","");
INSERT INTO complaint VALUES("768","Maintenance-0000521","There is leakage of water in front of the cardiology OPD and as well inside the CCU near Bed #4.","Can u please rectify it at the earliest.....","6","","30","1","52","","2","6","3","7","","","","128","2014-04-10 08:45:14","128","2014-04-22 16:01:07","","","","");
INSERT INTO complaint VALUES("769","Maintenance-0000522","Extn 396 out going is not working ","                    ","8","","33","1","26","","2","8","3","7","","","","76","2014-04-10 08:45:36","76","2014-04-25 15:27:16","","","","");
INSERT INTO complaint VALUES("770","Maintenance-0000523","1 computer ups point  is not working ","its urgent ","5","","24","1","26","","2","5","3","7","","","","76","2014-04-10 08:47:34","76","2014-04-25 15:28:06","","","","");
INSERT INTO complaint VALUES("771","Maintenance-0000524","tap is leaking","v.urgent","6","","30","1","55","","2","6","3","5","","","","73","2014-04-10 08:49:56","30","2014-04-10 11:27:17","","","","");
INSERT INTO complaint VALUES("772","MIS-0000248","Hos No AA253503.Rita Rani   CBC report unable to  validate ","Urgent ...............","3","","9","1","17","26","1","3","3","7","","","","69","2014-04-10 08:55:19","69","2014-04-10 10:07:54","","","","");
INSERT INTO complaint VALUES("773","Maintenance-0000525","need to fix keyboard stand & rain water inside the MRD main counten kindly take action","need to fix keyboard stand & rain water inside the MRD main counten kindly take action","9","","37","1","16","","2","9","3","7","","","","132","2014-04-10 08:59:35","132","2014-04-16 15:57:40","","","","");
INSERT INTO complaint VALUES("774","Maintenance-0000526","female changing room side dress hanging stand supporting wood is broken","do it soon","9","","37","1","58","","2","9","3","7","","","","124","2014-04-10 09:10:04","124","2014-04-10 15:21:42","","","","");
INSERT INTO complaint VALUES("775","Maintenance-0000527","After the rain there is a leakage in NICU walls 2 to 3 places.","very urgent","6","","30","1","55","","2","6","3","5","","","","73","2014-04-10 09:11:59","30","2014-04-16 15:50:47","","","","");
INSERT INTO complaint VALUES("776","Maintenance-0000528","water is leaking on roof near new OT side sluice room ","do it soon","6","","30","1","58","","2","6","3","5","6","","Major worki","124","2014-04-10 09:12:17","30","2014-05-08 12:35:30","","","","");
INSERT INTO complaint VALUES("777","MIS-0000249","Unable to view muster Roll of  last year  April 2013 to March 2014 ","very urgent ","3","","6","1","71","","1","3","3","5","","","","77","2014-04-10 09:14:11","6","2014-04-10 13:04:33","","","","");
INSERT INTO complaint VALUES("778","Maintenance-0000529","need repair the power box in the mrd main counter","need repair the power box in the mrd main counter","5","","23","1","16","","2","5","3","7","","","","132","2014-04-10 09:21:16","132","2014-04-16 10:29:26","","","","");
INSERT INTO complaint VALUES("779","Maintenance-0000530","there is water leakage in room 3202 and 3220 
INSERT INTO complaint VALUES("780","Maintenance-0000531","Sterillium stand to be fixed","stand to be fixed","9","","37","1","59","","2","9","3","5","","","","116","2014-04-10 09:47:36","37","2014-04-10 16:35:39","","","","");
INSERT INTO complaint VALUES("781","MIS-0000250","patient name   Ms Annapurna Kuragund   29 yrs  Hos.No AA253502 Dated 10/04/2014 Unable to enter the report for urine routine.","ASAP...................","3","","9","1","17","29","1","3","3","5","","","","69","2014-04-10 09:55:52","9","2014-04-10 12:21:58","","","","");
INSERT INTO complaint VALUES("782","MIS-0000251","system not working","system not working","2","","112","1","74","","1","2","3","5","","838","","214","2014-04-10 09:57:01","112","2014-04-10 09:58:06","","","","");
INSERT INTO complaint VALUES("783","MIS-0000252","Printer cartridge to be re cycle ","urgent","2","","5","1","76","","1","2","3","5","","859","","206","2014-04-10 09:58:53","5","2014-04-10 10:05:36","","","","");
INSERT INTO complaint VALUES("784","Maintenance-0000532","HDU DOOR AND TOILET DOOR","DOOR HANDLE TO BE REPAIRED","9","","37","1","64","","2","9","3","7","","","","110","2014-04-10 10:05:46","110","2014-04-15 13:36:27","","","","");
INSERT INTO complaint VALUES("785","MIS-0000253","System no Working","System no Working","2","","112","1","39","","1","2","3","5","","725","","349","2014-04-10 10:06:52","112","2014-04-10 10:08:04","","","","");
INSERT INTO complaint VALUES("786","Maintenance-0000533","Heavy water  seepage on the wall of purchase department corridor near the store entrance ","to be arrested immediately.","11","","21","1","29","","2","11","3","5","6","","Outsource person water proofing to be done ","117","2014-04-10 10:12:30","227","2014-05-06 09:55:27","","","","");
INSERT INTO complaint VALUES("787","Maintenance-0000534","One Tube light replacement in Office area.","Urgent","5","","22","1","68","","2","5","3","5","","","","266","2014-04-10 10:18:25","22","2014-04-10 11:46:00","","","","");
INSERT INTO complaint VALUES("788","Maintenance-0000535","suction apparatus is not working.","urgent","7","","28","1","54","","2","7","3","5","","","","73","2014-04-10 10:21:36","28","2014-04-10 16:48:15","","","","");
INSERT INTO complaint VALUES("789","Maintenance-0000536","ROOM NO;3216, SINK IS BLOCKED","RECTIFY AS SOON AS POSSIBLE","6","","31","1","50","","2","6","3","7","","","","184","2014-04-10 10:21:56","184","2014-04-25 17:28:22","","","","");
INSERT INTO complaint VALUES("790","Maintenance-0000537","staff toilet (ladies) - toilet blocked.","very urgent","6","","31","1","47","","2","6","3","5","","","","149","2014-04-10 10:28:24","31","2014-04-10 12:48:48","","","","");
INSERT INTO complaint VALUES("791","Maintenance-0000538"," Tree house repair.","Required to replace 6 no. of 2.5 ft height 4 inch
INSERT INTO complaint VALUES("792","MIS-0000254"," GUNASHEELI -INTRAMAIL","NOT WORKING.","3","","5","1","61","","1","3","3","5","","","","104","2014-04-10 10:48:36","5","2014-04-10 11:20:00","","","","");
INSERT INTO complaint VALUES("793","MIS-0000255","Accpac very Slow","In histopathology. Lab 2nd Floor","3","","5","1","17","","1","3","3","7","","","","113","2014-04-10 11:23:54","113","2014-04-15 09:21:24","","","","");
INSERT INTO complaint VALUES("794","Maintenance-0000539","fan is not working in the main MRD counter","fan is not working in the main MRD counter","5","","24","1","16","","2","5","3","7","","","","132","2014-04-10 11:30:44","132","2014-04-16 10:28:47","","","","");
INSERT INTO complaint VALUES("795","MIS-0000256","Library 4 systems performance is very slow.","Library 4 systems performance is very slow.","3","","112","1","25","","1","3","3","5","6","","lokesh is formatting all 4 system","152","2014-04-10 11:43:12","112","2014-05-29 10:11:17","","","","");
INSERT INTO complaint VALUES("796","Maintenance-0000540","Library Plug points are not working.","Library Plug points are not working.","5","","23","1","25","","2","5","3","7","","","","152","2014-04-10 11:45:31","152","2014-04-17 12:53:30","","","","");
INSERT INTO complaint VALUES("797","Maintenance-0000541","This is to request for additional exhaust fans in the PICU.","fix it soon","5","","24","1","54","","2","5","3","7","6","","its new requirement it will be delayed","16","2014-04-10 12:33:54","16","2014-04-11 11:00:55","","","","");
INSERT INTO complaint VALUES("798","MIS-0000257","CRP-05, CRP-10, CRP-11 Lab result entry is not working","high priority","3","","6","1","40","12","1","3","3","7","","","","65","2014-04-10 12:35:33","65","2014-04-11 15:56:33","","","","");
INSERT INTO complaint VALUES("799","MIS-0000258","system is hanging","system is hanging","3","","9","1","16","19","1","3","3","7","","","","132","2014-04-10 12:40:58","132","2014-04-16 10:28:06","","","","");
INSERT INTO complaint VALUES("800","Maintenance-0000542","corridoor pillor door it\'s not closing properly.","very urgently","9","","37","1","73","","2","9","3","5","","","","211","2014-04-10 13:14:56","37","2014-04-10 16:33:56","","","","");
INSERT INTO complaint VALUES("801","MIS-0000259","Please reset my password for Sage Accpac user ID: david ","I need it now to raise intent store items for our dept and corporate patients view ( to meet them)","3","","6","1","34","","1","3","3","7","","","","173","2014-04-10 14:02:46","173","2014-05-05 13:59:11","","","","");
INSERT INTO complaint VALUES("802","Maintenance-0000543","IN CT SCAN EXHAUST FAN IS NOT WORKING.","IN CT SCAN EXHAUST FAN IS NOT WORKING. PLS DO THE NEEDFUL","5","","23","1","91","","2","5","3","5","","","","70","2014-04-10 14:27:17","23","2014-04-10 16:46:05","","","","");
INSERT INTO complaint VALUES("803","Maintenance-0000544","OPG ROOM TAP BLOCKAGE","OPG ROOM TAP BLOCKAGE","6","","32","1","90","","2","6","3","5","","","","70","2014-04-10 14:28:15","31","2014-04-10 16:48:34","","","","");
INSERT INTO complaint VALUES("804","MIS-0000260","Costing statement to be updated in Ninan & Ranjit\'s system","Costing statement to be updated in Ninan & Ranjit\'s system","3","","6","1","41","","1","3","3","5","","","","267","2014-04-10 14:58:03","6","2014-04-11 15:22:09","","","","");
INSERT INTO complaint VALUES("805","Maintenance-0000545","kindly come and check the earthing in ot-3 ,
INSERT INTO complaint VALUES("806","MIS-0000261","system is very slow","system is very slow","3","","9","1","16","19","1","3","3","7","","","","132","2014-04-10 15:24:07","132","2014-04-16 10:27:18","","","","");
INSERT INTO complaint VALUES("807","MIS-0000262","Patient name Deepa  617379  CBC /ESR .Unable to validate ","URGENT ","3","","6","1","17","26","1","3","3","5","","","","69","2014-04-10 15:28:06","6","2014-04-10 15:47:52","","","","");
INSERT INTO complaint VALUES("808","Maintenance-0000546","Boards to be FIXED.","Central OPD @ Perimeter wall.","9","","37","1","37","131","2","9","3","5","","","","150","2014-04-10 15:34:43","37","2014-04-11 16:07:38","","","","");
INSERT INTO complaint VALUES("809","MIS-0000263","system is not working","system is not working","3","","5","1","16","18","1","3","3","7","","","","132","2014-04-10 15:48:51","132","2014-04-16 10:26:18","","","","");
INSERT INTO complaint VALUES("810","Maintenance-0000547","E- room","calling bell is not working.","8","","33","1","62","","2","8","3","5","","","","107","2014-04-10 15:55:00","33","2014-04-10 16:50:00","","","","");
INSERT INTO complaint VALUES("811","Maintenance-0000548","birthing room light is blinking","needs urgent.","5","","22","1","59","","2","5","3","5","","","","116","2014-04-10 15:58:24","24","2014-04-10 16:39:28","","","","");
INSERT INTO complaint VALUES("812","Maintenance-0000549","switch board not working","attend soon","5","","24","1","96","","2","5","3","7","","","","225","2014-04-10 15:58:41","225","2014-04-29 12:05:39","","","","");
INSERT INTO complaint VALUES("813","Maintenance-0000550","3205 bathroom light not working","please do the needful","5","","24","1","50","","2","5","3","7","","","","181","2014-04-10 16:37:39","181","2014-04-21 12:32:07","","","","");
INSERT INTO complaint VALUES("814","Maintenance-0000551","3213 room is leaking please remove tv","please do the needful","8","","33","1","50","","2","8","3","5","","","","178","2014-04-10 20:02:53","33","2014-04-11 16:08:12","","","","");
INSERT INTO complaint VALUES("815","Maintenance-0000552","Boards  to  be  fixed  on the perimeter wall  Urgently","New boards","9","","37","1","37","131","2","9","3","5","","","","150","2014-04-11 08:08:38","37","2014-04-11 08:50:38","","","","");
INSERT INTO complaint VALUES("816","MIS-0000264","Barcode and Printer is not working","Urgent","2","","112","1","17","25","1","2","3","5","","822","","257","2014-04-11 08:18:22","112","2014-04-11 08:31:04","","","","");
INSERT INTO complaint VALUES("817","Maintenance-0000553","O2 cylinder to be filled","10/04/2014  10:30pm","5","","25","1","52","","2","5","3","7","","","","225","2014-04-11 08:45:18","225","2014-04-29 12:05:32","","","","");
INSERT INTO complaint VALUES("818","MIS-0000265","NSO-01 
INSERT INTO complaint VALUES("819","Maintenance-0000554","O2 cylinder to be filled","10/04/2014   10:30 pm","5","","25","1","62","","2","5","3","7","","","","225","2014-04-11 08:46:00","225","2014-04-29 12:05:23","","","","");
INSERT INTO complaint VALUES("820","Maintenance-0000555","O2 cylinder to be filled","10/04/2014  11:00 pm","5","","25","1","50","","2","5","3","7","","","","225","2014-04-11 08:47:00","225","2014-04-29 12:05:16","","","","");
INSERT INTO complaint VALUES("821","Maintenance-0000556","Changing the location of the switch board for the spot lamp purpose inside the Drs cabin ","Do the needful asap ","5","","24","1","33","","2","5","3","5","","","","96","2014-04-11 08:59:27","24","2014-04-11 13:22:47","","","","");
INSERT INTO complaint VALUES("822","Maintenance-0000557","TUBE LIGHT NOT WORKING...","RECTIFY ASAP.","5","","24","1","49","239","2","5","3","5","","","","97","2014-04-11 08:59:55","24","2014-04-11 13:22:32","","","","");
INSERT INTO complaint VALUES("823","Maintenance-0000558","COT FOOT END TO BE FIXED AND SIDE RAILS TO BE FIX PROPERLY.","IMMEDIATELY NEEDED","7","","29","1","49","238","2","7","3","5","6","","outsource to be done due to side rails problem, user already taken approval work yet to start ","97","2014-04-11 09:01:35","29","2014-04-14 16:07:09","","","","");
INSERT INTO complaint VALUES("824","MIS-0000266","Patient Name : Mercy Magdalene
INSERT INTO complaint VALUES("825","Maintenance-0000559","AC is in on but it\'s not colling ","do it as per as possible ","10","","26","1","58","194","2","10","3","5","","","","124","2014-04-11 09:10:16","26","2014-04-11 16:02:19","","","","");
INSERT INTO complaint VALUES("826","Maintenance-0000560","wall fan is not working please do the rectification 
INSERT INTO complaint VALUES("827","Maintenance-0000561","Rest room ligt is not working","need to be urgent","5","","24","1","60","282","2","5","3","5","","","","103","2014-04-11 09:43:04","24","2014-04-11 13:22:57","","","","");
INSERT INTO complaint VALUES("828","MIS-0000267","sage Accpac has become slow","do it soon","3","","5","1","58","13","1","3","3","5","","","","124","2014-04-11 09:55:57","5","2014-04-11 10:00:27","","","","");
INSERT INTO complaint VALUES("829","MIS-0000268","mouse not working properly, so please change mouse.","mouse not working properly, so please change mouse.","2","","5","1","81","","1","2","3","5","","914","","99","2014-04-11 09:56:32","5","2014-04-11 10:05:18","","","","");
INSERT INTO complaint VALUES("830","MIS-0000269","Patient Name : Banu priya Gujjar
INSERT INTO complaint VALUES("831","Maintenance-0000562","Unsterilized area tap to be repair","received a call slip  ","6","","31","1","57","","2","6","3","7","","","","16","2014-04-11 11:00:39","16","2014-04-14 13:07:19","","","","");
INSERT INTO complaint VALUES("832","MIS-0000270","LH 780 Not interfaced .","Urgent ","3","","5","1","17","26","1","3","3","5","","","","69","2014-04-11 11:03:41","69","2014-04-11 11:39:54","","","","");
INSERT INTO complaint VALUES("833","Maintenance-0000563","hinge to be changed","urgent","9","","37","1","55","","2","9","3","5","","","","73","2014-04-11 11:05:59","37","2014-04-11 16:07:26","","","","");
INSERT INTO complaint VALUES("834","MIS-0000271","Patient name  Mr Raju.A Hos No 549583 Ordered on 10/04/2014. Unable to enter reports .","Urgent ","3","","9","1","17","26","1","3","3","5","","","","69","2014-04-11 11:06:31","9","2014-04-11 12:14:55","","","","");
INSERT INTO complaint VALUES("835","MIS-0000272","outlook express is not working","urgent","3","","112","1","55","","1","3","3","5","","","","73","2014-04-11 11:06:42","112","2014-04-11 11:51:44","","","","");
INSERT INTO complaint VALUES("836","Maintenance-0000564","power is not there in few areas like multipurpose hall, toilet , corridor etc.","urgent","5","","23","4","24","","2","5","3","7","","","","153","2014-04-11 11:22:38","153","2014-04-11 15:57:17","","","","");
INSERT INTO complaint VALUES("837","MIS-0000273","system is very slow","system is very slow","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-11 11:36:32","132","2014-04-15 10:45:25","","","","");
INSERT INTO complaint VALUES("838","MIS-0000274","Patient name Dada peer    AA253573  All biochemistry showing as pending analysis .ordered on 10th April
INSERT INTO complaint VALUES("839","Maintenance-0000565","phone  not working ","phone  not working ","8","","34","1","74","","2","8","3","5","","","","214","2014-04-11 11:39:22","34","2014-04-11 16:08:43","","","","");
INSERT INTO complaint VALUES("840","Maintenance-0000566","x-ray  view  box   not  working 
INSERT INTO complaint VALUES("841","Maintenance-0000567","One wire which is connected to computer is in the middle of  the NICU floor which is dangerous and causing inconvenience.","very very urgent","12","","386","1","55","","2","12","3","2","6","","outsource to be done ","73","2014-04-11 11:57:03","227","2014-05-14 08:49:39","","","","");
INSERT INTO complaint VALUES("842","Maintenance-0000568","birthing room ac remote is not working","needs urgent","7","","26","1","59","","2","7","3","5","","","","116","2014-04-11 11:58:52","26","2014-04-11 16:02:02","","","","");
INSERT INTO complaint VALUES("843","Maintenance-0000569","birthing room fan is making sound","fan is making sound","5","","23","1","59","","2","5","3","5","","","","116","2014-04-11 11:59:43","23","2014-04-11 13:22:05","","","","");
INSERT INTO complaint VALUES("844","MIS-0000275","key board not working","key board not working","2","","112","1","58","13","1","2","3","5","","885","","131","2014-04-11 12:04:04","112","2014-04-11 12:19:03","","","","");
INSERT INTO complaint VALUES("845","Maintenance-0000570","pt attender stool to be re painted 5 nos ,and to be fix push. total 10 push.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-04-11 12:10:19","87","2014-04-14 14:10:16","","","","");
INSERT INTO complaint VALUES("846","Maintenance-0000571","EXC- CHAIR DR.SANTHOSH "," WHEEL TO BE CHANGE ","7","","27","1","74","187","2","7","3","5","","","","214","2014-04-11 12:14:01","27","2014-04-11 16:02:44","","","","");
INSERT INTO complaint VALUES("847","MIS-0000276","Mozilla Firefox is not working ( it is showing has connection has timed out)","do it soon","3","","112","1","58","13","1","3","3","5","","","","124","2014-04-11 12:33:10","112","2014-04-11 13:00:28","","","","");
INSERT INTO complaint VALUES("848","Maintenance-0000572","Room F-1,F-3,F-4,E-10,E-6,B-4 B-5, calling bell is not working to be check.","as soon as possible.","8","","33","1","63","","2","8","3","7","6","","its major work some problem in the Main panel board hence waiting new AMC vendor to rectify","87","2014-04-11 12:47:02","87","2014-05-22 11:51:17","","","","");
INSERT INTO complaint VALUES("849","MIS-0000277","please post PRN NUMBER(AA210071, SHILPA)","please post PRN NUMBER(AA210071, SHILPA)","3","","9","1","42","","1","3","3","5","","","","118","2014-04-11 12:48:55","9","2014-04-11 12:50:31","","","","");
INSERT INTO complaint VALUES("850","Maintenance-0000573","Room \'F\' EL.Tub light & \'G\' room toilet mirror tub light is not working to be check.  ","as soon as possible.","5","","23","1","63","","2","5","3","7","","","","87","2014-04-11 12:50:06","87","2014-04-14 14:10:35","","","","");
INSERT INTO complaint VALUES("851","Maintenance-0000574","LDPR -  AC making sound","needs urgent","10","","26","1","59","","2","10","3","5","","","","116","2014-04-11 12:51:10","26","2014-04-11 16:01:48","","","","");
INSERT INTO complaint VALUES("852","MIS-0000278","pass word is not working ( jisha emp.05808)","urgent","3","","6","1","54","","1","3","3","5","","","","73","2014-04-11 12:52:08","6","2014-04-11 13:25:44","","","","");
INSERT INTO complaint VALUES("853","Maintenance-0000575","Rooms B-4,C-9,C-8,C-3, Pt safety lock wood serew to be fix .","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-04-11 12:54:32","87","2014-04-14 14:09:41","","","","");
INSERT INTO complaint VALUES("854","Maintenance-0000576","2 o2 cylenders empty.","2 o2 cylenders empty.","5","","23","1","81","","2","5","3","5","","","","99","2014-04-11 13:08:15","23","2014-04-11 15:59:17","","","","");
INSERT INTO complaint VALUES("855","MIS-0000279","Please change sage accpac user id of information center from sudha to solomon ","thanks","3","","6","1","37","","1","3","3","5","","","","150","2014-04-11 13:16:19","6","2014-04-11 13:39:11","","","","");
INSERT INTO complaint VALUES("856","Maintenance-0000577","tap water is leaking ","to be checked immediately","6","","31","1","53","129","2","6","3","5","","","","119","2014-04-11 14:28:10","31","2014-04-11 16:05:57","","","","");
INSERT INTO complaint VALUES("857","MIS-0000280","monitor is not working","monitor is not working","3","","5","1","16","19","1","3","3","7","","","","132","2014-04-11 14:33:05","132","2014-04-16 10:25:27","","","","");
INSERT INTO complaint VALUES("858","MIS-0000281","pulmo room printer not working some loose connection with the plug","please come immediately patient is waiting for PFT reports","2","","5","1","102","","1","2","3","5","","0","","97","2014-04-11 14:47:15","5","2014-04-11 15:04:34","","","","");
INSERT INTO complaint VALUES("859","Maintenance-0000578","D-ROOM BED NO:1&2","TUBELIGHT IS NOT WORKING","5","","23","1","64","","2","5","3","7","","","","110","2014-04-11 14:48:46","110","2014-04-15 13:35:58","","","","");
INSERT INTO complaint VALUES("860","Maintenance-0000579","C-ROOM BED NO:2","PATIENT CALLING BELL TO BE FIXED","8","","34","1","64","","2","8","3","7","","","","110","2014-04-11 14:49:46","110","2014-04-15 13:35:16","","","","");
INSERT INTO complaint VALUES("861","MIS-0000282","accpac is not working and helen login is not 
INSERT INTO complaint VALUES("862","MIS-0000283","Mouse Not Working","Mouse Not Working","2","","112","1","73","","1","2","3","5","","844","","211","2014-04-11 15:28:51","112","2014-04-11 15:56:17","","","","");
INSERT INTO complaint VALUES("863","MIS-0000284","access to open the Pharmacy Purchase order entry and other records to  verify the po\'s and stock statements
INSERT INTO complaint VALUES("864","Maintenance-0000580","door to be painted,handle to be fixed.  Already this was informed in person to Mr. Vinod on 02.4.14 ","URGENT","5","","21","1","47","105","2","5","3","3","6","","outsource to be done ","149","2014-04-11 15:29:29","227","2014-05-06 09:55:54","","","","");
INSERT INTO complaint VALUES("865","MIS-0000285","CRP-13 not working","high priority","2","","5","1","40","12","1","2","3","7","","0","","65","2014-04-11 15:56:04","65","2014-04-17 12:59:17","","","","");
INSERT INTO complaint VALUES("866","Maintenance-0000581","WATER BLOCKED IN SINK","KINDLY DO THE NEEDFUL","6","","31","1","50","86","2","6","3","7","","","","178","2014-04-11 16:33:10","178","2014-04-13 10:26:17","","","","");
INSERT INTO complaint VALUES("867","MIS-0000286","Patient Name : Emmanuel Uthup
INSERT INTO complaint VALUES("868","MIS-0000287","Antivirus installation in Admin  laptop 2 -compaq prisario V3000","currently installed with antivirus free version. ","3","","5","1","94","","1","3","3","7","6","","1 laptop checked","259","2014-04-12 08:34:03","259","2014-06-06 12:38:21","","","","");
INSERT INTO complaint VALUES("869","Maintenance-0000582","SPOT LIGHT IS NOT WORKING.","VERY URGENT.","5","","23","1","73","","2","5","3","5","","","","211","2014-04-12 08:48:07","23","2014-04-15 12:36:54","","","","");
INSERT INTO complaint VALUES("870","Maintenance-0000583","icu grill gate fan not working","11/04/2014 11am","5","","24","1","70","265","2","5","3","7","","","","16","2014-04-12 08:56:00","16","2014-04-14 13:07:04","","","","");
INSERT INTO complaint VALUES("871","Maintenance-0000584","ldpr  tap  water is leaking","water leaking","6","","31","1","59","","2","6","3","5","","","","116","2014-04-12 09:00:42","31","2014-04-12 13:02:34","","","","");
INSERT INTO complaint VALUES("872","Maintenance-0000585","Mens hostel Telephone not working","rectify soon","8","","33","2","2","161","2","8","3","5","","","","33","2014-04-12 09:07:59","33","2014-04-16 08:12:44","","","","");
INSERT INTO complaint VALUES("873","Maintenance-0000586","electronic weighing scale","not showing correct readings.","7","","26","1","61","","2","7","3","5","","","","104","2014-04-12 09:17:13","227","2014-04-12 09:24:02","","","","");
INSERT INTO complaint VALUES("874","Maintenance-0000587","Tube light not glowing.","please change the tube light.","5","","24","1","38","","2","5","3","7","","","","78","2014-04-12 09:25:57","78","2014-04-23 15:42:37","","","","");
INSERT INTO complaint VALUES("875","MIS-0000288","MONITOR WAS NOT WORKING","MONITOR WAS NOT WORKING","2","","112","1","44","361","1","2","3","7","","0","","358","2014-04-12 09:48:19","358","2014-04-12 10:33:27","","","","");
INSERT INTO complaint VALUES("876","MIS-0000289","1. AEC currently is not interfaced.
INSERT INTO complaint VALUES("877","Maintenance-0000588","4 nails to be fixed in Paediatric off","as early as possible","9","","37","1","22","","2","9","3","5","","","","73","2014-04-12 10:32:46","37","2014-04-12 13:03:28","","","","");
INSERT INTO complaint VALUES("878","MIS-0000290","system is very slow ","system is very slow ","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-12 10:37:33","132","2014-04-16 15:54:39","","","","");
INSERT INTO complaint VALUES("879","MIS-0000291","SYSTEM IS GETTING HANG","SYSTEM IS GETTING HANG","3","","5","1","44","361","1","3","3","5","","","","358","2014-04-12 10:37:55","5","2014-04-12 11:05:03","","","","");
INSERT INTO complaint VALUES("880","MIS-0000292","system is hanging ","system is hanging ","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-12 10:45:17","132","2014-04-16 15:58:13","","","","");
INSERT INTO complaint VALUES("881","Maintenance-0000589","o2 cylender need to check.","o2 cylender need to check.","7","","29","1","81","","2","7","3","5","","","","99","2014-04-12 10:50:26","29","2014-04-12 12:42:58","","","","");
INSERT INTO complaint VALUES("882","Maintenance-0000590","SUCTION APPARATUS NOT WORKING","URGENT","7","","29","1","76","101","2","7","3","5","","","","206","2014-04-12 10:50:31","29","2014-04-12 12:42:49","","","","");
INSERT INTO complaint VALUES("883","MIS-0000293","software not responding","software not responding","3","","6","1","42","","1","3","3","5","","","","118","2014-04-12 11:00:02","61","2014-04-12 12:31:36","","","","");
INSERT INTO complaint VALUES("884","MIS-0000294","Internet is not Accessible in MIS-May12.bbh.org.in","kindly rectify as soon as possible 
INSERT INTO complaint VALUES("885","MIS-0000295","system dead slow in all counter today sat,
INSERT INTO complaint VALUES("886","MIS-0000296","Kindly make a soft copy for a printable version of bala jagruti-pt info booklet","The material is in POFF share folder.","3","","8","1","79","","1","3","3","5","","","","339","2014-04-12 11:39:35","8","2014-04-14 11:19:46","","","","");
INSERT INTO complaint VALUES("887","MIS-0000297","All our system are not working properly its getting hanged often. Kindly look into it immediately","Urgent","3","","6","1","17","25","1","3","3","5","","","","257","2014-04-12 11:44:04","6","2014-04-12 12:34:53","","","","");
INSERT INTO complaint VALUES("888","MIS-0000298","Patient Name : kshipra
INSERT INTO complaint VALUES("889","MIS-0000299","Patient name Ms Latha   AA144351  Kindly check ","Urgent ","3","","6","1","17","26","1","3","3","5","5","","What is the issue???","69","2014-04-12 11:54:12","6","2014-04-14 08:22:32","","","","");
INSERT INTO complaint VALUES("890","MIS-0000300","mouse is not working in system -01","kindly do the needful ","2","","112","1","50","","1","2","3","5","","916","","126","2014-04-12 12:04:40","112","2014-04-12 12:14:27","","","","");
INSERT INTO complaint VALUES("891","Maintenance-0000591","O2 FLOWMETER IS GIVEN TO  MAINTENANCE  ON 08/04/2014, IT IS NOT YET RETURNED BACK ","KINDLY DO THE NEEDFUL .","","","227","1","50","","2","11","3","7","","","null","126","2014-04-12 12:08:34","126","2014-04-12 12:08:34","","","","");
INSERT INTO complaint VALUES("892","Maintenance-0000592","Flow meter air ball not coming down.when we close the valve. ","Flow meter air ball not coming down.when we close the valve.","","","227","1","81","","2","7","3","7","","","null","99","2014-04-12 12:10:19","99","2014-04-12 12:10:19","","","","");
INSERT INTO complaint VALUES("893","MIS-0000301","barcode is not working properly. Kindly come to lab opd.","Urgent","2","","112","1","17","25","1","2","3","5","","0","","257","2014-04-12 12:27:04","112","2014-04-12 12:42:23","","","","");
INSERT INTO complaint VALUES("894","MIS-0000302","Flow meter air ball not coming down.when we close the valve. ","Flow meter air ball not coming down.when we close the valve.","","","123","1","81","","1","","3","7","","","null","99","2014-04-12 12:32:49","61","2014-04-12 12:32:49","","","","");
INSERT INTO complaint VALUES("895","MIS-0000303","O2 FLOWMETER IS GIVEN TO  MAINTENANCE  ON 08/04/2014, IT IS NOT YET RETURNED BACK ","KINDLY DO THE NEEDFUL .","","","123","1","50","","1","","3","7","","","null","126","2014-04-12 12:33:00","61","2014-04-12 12:33:00","","","","");
INSERT INTO complaint VALUES("896","Maintenance-0000593","O2 FLOWMETER IS GIVEN TO  MAINTENANCE  ON 08/04/2014, IT IS NOT YET RETURNED BACK ","KINDLY DO THE NEEDFUL .","7","","28","1","50","","2","7","3","5","6","","Informed Vendor to come rectify the flow meter ","126","2014-04-12 12:33:09","227","2014-04-21 13:43:31","","","","");
INSERT INTO complaint VALUES("897","Maintenance-0000594","Flow meter air ball not coming down.when we close the valve. ","Flow meter air ball not coming down.when we close the valve.","7","","29","1","81","","2","7","3","5","","","","99","2014-04-12 12:33:43","29","2014-04-12 12:42:35","","","","");
INSERT INTO complaint VALUES("898","MIS-0000304","CT Scan room computer is very slow, please look into the same, as per the instruction from Dr.Philip.
INSERT INTO complaint VALUES("899","Maintenance-0000595","TV IS NOT WORKING.","RECTIFY THE PROBLEM AS  SOON AS POSSIBLE.","8","","33","1","50","74","2","8","3","5","","","","178","2014-04-13 13:08:32","33","2014-04-14 15:52:38","","","","");
INSERT INTO complaint VALUES("900","Maintenance-0000596","Bed side locker ","Bed side locker  not working","9","","37","1","61","","2","9","3","5","","","","105","2014-04-14 07:49:44","37","2014-04-14 16:33:22","","","","");
INSERT INTO complaint VALUES("901","Maintenance-0000597","IN 3214 AC IS NOT WORKING  AND EVEN RECTIFY THE SERVICE EVEN FOR OTHER 15 AC ","KINDLY DO THE NEEDFUL FOR PATIENT SATISFACTION .","10","","26","1","50","","2","10","3","5","","","","126","2014-04-14 08:18:26","26","2014-04-14 16:04:30","","","","");
INSERT INTO complaint VALUES("902","Maintenance-0000598","NICU  entrance door is not closing properly","urgent","9","","37","1","55","","2","9","3","5","","","","73","2014-04-14 08:21:09","37","2014-04-14 16:33:10","","","","");
INSERT INTO complaint VALUES("903","Maintenance-0000599","IN DELUXE ROOMS WATER LEAKAGE FROM SEEPAGE - 3202,3213, 3220. ","KINDLY DO THE NEEDFUL  AS SOON AS POSSIBLE  ","11","","21","1","50","","2","11","3","5","","","","126","2014-04-14 08:21:21","227","2014-05-06 10:03:50","","","","");
INSERT INTO complaint VALUES("904","Maintenance-0000600","tiles to be fixed in the entrance","urgent","12","","386","1","55","","2","12","3","5","6","","civil work hence outsource to be done","73","2014-04-14 08:21:52","227","2014-05-28 15:28:11","","","","");
INSERT INTO complaint VALUES("905","Maintenance-0000601","KINDLY REMOVE THE BALKAN FRAME FROM DELUXE ROOM 3214.","KINDLY DO THE NEEDFUL FOR PATIENT ADMISSION ","7","","29","1","50","","2","7","3","5","","","","126","2014-04-14 08:23:21","29","2014-04-14 16:05:35","","","","");
INSERT INTO complaint VALUES("906","Maintenance-0000602","NURSES STATION-1","TILES TO BE FIXED","12","","386","1","64","","2","12","3","5","6","","Civil work outsource to be done","110","2014-04-14 08:41:47","227","2014-05-28 15:28:01","","","","");
INSERT INTO complaint VALUES("907","MIS-0000305","current visit is not opening system-MRD-12","current visit is not opening system-MRD-12","3","","8","1","16","35","1","3","3","7","","","","132","2014-04-14 08:44:39","132","2014-04-16 15:59:06","","","","");
INSERT INTO complaint VALUES("908","MIS-0000306","Out patient reports are not opening
INSERT INTO complaint VALUES("909","MIS-0000307","system is hanging","system is hanging","3","","9","1","16","19","1","3","3","7","","","","132","2014-04-14 08:59:16","132","2014-04-16 15:59:25","","","","");
INSERT INTO complaint VALUES("910","Maintenance-0000603","OT-6 sluice room roof leaking","OT-6 sluice room roof leaking","12","","386","1","58","197","2","12","3","2","6","","Civil work to be done","122","2014-04-14 09:08:12","227","2014-05-14 08:48:59","","","","");
INSERT INTO complaint VALUES("911","Maintenance-0000604","room no 1504  near wash basin water leaking.","please come ASAP","6","","32","1","49","225","2","6","3","5","","","","97","2014-04-14 09:12:54","32","2014-04-14 16:03:55","","","","");
INSERT INTO complaint VALUES("912","MIS-0000308","scan room reception system not working","scan room reception system not working","2","","112","1","104","","1","2","3","5","","0","","70","2014-04-14 09:13:23","112","2014-04-14 09:23:29","","","","");
INSERT INTO complaint VALUES("913","Maintenance-0000605","IN X-RAY ROLLING CHAIR WHEELS BROKEN, PLS RECTIFY","IN X-RAY ROLLING CHAIR WHEELS BROKEN, PLS RECTIFY","7","","27","1","90","","2","7","3","5","","","","70","2014-04-14 09:14:59","27","2014-05-05 09:18:43","","","","");
INSERT INTO complaint VALUES("914","Maintenance-0000606","Roof leaking  is  arrested but  the roof has temporally covered with wooden piece .","need to remove the wooden piece & finish the work.","12","","386","1","58","196","2","12","3","2","6","","Civil work to be done ","122","2014-04-14 09:17:08","227","2014-05-14 08:48:39","","","","");
INSERT INTO complaint VALUES("915","MIS-0000309","SCAN ROOM RECEPTION SYSTEM ,MY COMPUTER DICOMS NOT PRESENT. IMMEDIATELY RECTIFY ","SCAN ROOM RECEPTION SYSTEM ,MY COMPUTER DICOMS NOT PRESENT. IMMEDIATELY RECTIFY ","2","","112","1","104","","1","2","3","5","","0","","70","2014-04-14 09:19:54","112","2014-04-14 09:21:38","","","","");
INSERT INTO complaint VALUES("916","Maintenance-0000607","Phone is not working","Phone is not working","8","","33","1","45","","2","8","3","5","","","","127","2014-04-14 09:24:02","33","2014-04-14 15:52:48","","","","");
INSERT INTO complaint VALUES("917","Maintenance-0000608","the  sliding aluminum door has been removed & kept aside ","need to fix the door","9","","37","1","58","189","2","9","3","5","","","","122","2014-04-14 09:29:23","37","2014-04-15 13:43:18","","","","");
INSERT INTO complaint VALUES("918","Maintenance-0000609","need to fix one chain hook for storing the Carbon dioxide","storing system for  Carbon dioxide","9","","37","1","58","198","2","9","3","5","","","","122","2014-04-14 09:34:03","37","2014-05-06 09:49:17","","","","");
INSERT INTO complaint VALUES("919","MIS-0000310","TEAM VIEWER ACCESS TO BE GIVEN TO COLUMBIA ASIA IT PERSON. ","TEAM VIEWER ACCESS TO BE GIVEN TO COLUMBIA ASIA IT PERSON. ","3","","5","1","104","","1","3","3","5","","","","70","2014-04-14 09:55:25","5","2014-04-14 10:57:58","","","","");
INSERT INTO complaint VALUES("920","MIS-0000311","system is not starting","system is not starting","2","","5","1","23","","1","2","3","5","","0","","80","2014-04-14 10:08:44","5","2014-04-15 13:06:02","","","","");
INSERT INTO complaint VALUES("921","MIS-0000312","Unable to enter HCV report  AA253254","showing underprocess but when we open show pending analysis","3","","9","1","17","30","1","3","3","7","","","","300","2014-04-14 10:09:17","300","2014-05-09 10:02:07","","","","");
INSERT INTO complaint VALUES("922","MIS-0000313","Unable to enter report for TSH AA253364","Showing under process but when tried to enter show pending analysis.","3","","9","1","17","27","1","3","3","7","","","","300","2014-04-14 10:10:48","300","2014-05-09 10:02:30","","","","");
INSERT INTO complaint VALUES("923","Maintenance-0000610","15Amp Power plug to provided in the MIS server room.","urgent and checked the same by a mnt person.","5","","22","1","3","168","2","5","3","7","","","","9","2014-04-14 10:17:19","9","2014-04-15 08:36:16","","","","");
INSERT INTO complaint VALUES("924","MIS-0000314","SAGE ACCPAC IS NOT NOT WORKING ","DO IT SOON","3","","112","1","58","13","1","3","3","5","","","","124","2014-04-14 10:46:43","112","2014-04-14 14:26:50","","","","");
INSERT INTO complaint VALUES("925","Maintenance-0000611","washing machine belt to be replace","replace soon","7","","29","1","84","157","2","7","3","7","","","","16","2014-04-14 10:51:49","16","2014-04-15 09:23:27","","","","");
INSERT INTO complaint VALUES("926","MIS-0000315","can not see patient\'s list in the computer of ped.-5 room.","kindly do the needful.","3","","5","1","79","","1","3","3","5","","","","216","2014-04-14 11:02:02","5","2014-04-14 11:11:24","","","","");
INSERT INTO complaint VALUES("927","MIS-0000316","system is hanging","system is hanging","3","","9","1","16","19","1","3","3","7","","","","132","2014-04-14 11:08:30","132","2014-04-16 15:59:41","","","","");
INSERT INTO complaint VALUES("928","Maintenance-0000612","Toilet Blocked","Toilet Blocked","6","","32","2","45","","2","6","3","5","","","","127","2014-04-14 11:20:00","32","2014-04-14 16:03:36","","","","");
INSERT INTO complaint VALUES("929","MIS-0000317","Respected, sir/madam, I have just tried sending a mail to multiple recipients but i received a mail back saying that it is undelivered due to one recipients ID not accepting it, Kindly do the needful as it is mandatory to send this mail as soon as possible.
INSERT INTO complaint VALUES("930","MIS-0000318","NURSES STATION-1","MOUSE IS NOT WORKING","2","","5","1","64","23","1","2","3","7","","0","","110","2014-04-14 12:18:37","110","2014-04-15 13:34:44","","","","");
INSERT INTO complaint VALUES("931","Maintenance-0000613","MALE SIDE","WINDOW TO BE REPAIRED","9","","37","1","64","335","2","9","3","7","","","","110","2014-04-14 12:19:20","110","2014-04-15 13:34:21","","","","");
INSERT INTO complaint VALUES("932","Maintenance-0000614","Tube light is not working to be replace room No. M6 ","do the Needful","5","","24","1","71","","2","5","3","5","","","","72","2014-04-14 12:42:17","24","2014-04-14 16:08:16","","","","");
INSERT INTO complaint VALUES("933","Maintenance-0000615","Door stopper to be fixed. ","do the needful","9","","37","1","77","","2","9","3","5","","","","212","2014-04-14 12:43:27","37","2014-04-14 16:32:45","","","","");
INSERT INTO complaint VALUES("934","MIS-0000319","system is hanging","system is hanging","3","","9","1","16","19","1","3","3","7","","","","132","2014-04-14 12:47:07","132","2014-04-16 15:59:55","","","","");
INSERT INTO complaint VALUES("935","MIS-0000320","Please create an email id for Dr. Reddy who is the acting HOD of ENT w.e.f. 15.04.2014.
INSERT INTO complaint VALUES("936","Maintenance-0000616","phone is not working 
INSERT INTO complaint VALUES("937","Maintenance-0000617","Chargeable torches not working 3 no","Mr Nijalingapa gave complaint","7","","29","1","70","","2","7","3","7","6","","Chargers put for charging to observe the fault","16","2014-04-14 13:06:55","16","2014-04-29 13:06:41","","","","");
INSERT INTO complaint VALUES("938","Maintenance-0000618","NURSES STATION","PA SYSTEM IS NOT WORKING","8","","34","1","64","","2","8","3","7","","","","110","2014-04-14 13:27:08","110","2014-04-15 13:32:57","","","","");
INSERT INTO complaint VALUES("939","Maintenance-0000619","J-ROOM","PATIENT CALLING BELL IS NOT WORKING","8","","34","1","64","","2","8","3","7","","","","110","2014-04-14 13:27:58","110","2014-04-15 13:32:24","","","","");
INSERT INTO complaint VALUES("940","Maintenance-0000620","Room linen room selling Tub light is not working and C-2 ,Fan making noise to be check.","as soon as possible.","5","","23","1","63","","2","5","3","7","","","","87","2014-04-14 14:08:45","87","2014-04-16 10:14:39","","","","");
INSERT INTO complaint VALUES("941","Maintenance-0000621","O2 cylinder empty","To be refilled","5","","25","1","53","","2","5","3","5","","","","119","2014-04-14 14:23:47","227","2014-04-14 15:21:17","","","","");
INSERT INTO complaint VALUES("942","Maintenance-0000622","AUDIO SPEAKERS ARE NOT AUDIBLE IN OT ","DO IT SOON","8","","33","1","58","","2","8","3","5","","","","124","2014-04-14 15:17:44","33","2014-04-14 15:53:03","","","","");
INSERT INTO complaint VALUES("943","Maintenance-0000623","pt attender stool to be repaint. 5 nos with push to be fix.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-04-14 15:33:14","87","2014-04-22 15:35:08","","","","");
INSERT INTO complaint VALUES("944","MIS-0000321","Internet and printer is not working in medical school","Urgernt","2","","112","1","105","","1","2","3","5","6","0","no one was there at 4:30","291","2014-04-14 16:02:47","112","2014-04-15 08:58:38","","","","");
INSERT INTO complaint VALUES("945","Maintenance-0000624","Near Guest House Street light not working ","rectify soon","5","","24","3","2","159","2","5","3","7","","","","16","2014-04-14 16:11:20","16","2014-04-15 09:23:14","","","","");
INSERT INTO complaint VALUES("946","Maintenance-0000625","Behind Dr Anil Qtrs Street light not working","rectify soon","5","","25","3","2","161","2","5","3","7","","","","16","2014-04-14 16:11:43","16","2014-04-15 09:23:06","","","","");
INSERT INTO complaint VALUES("947","Maintenance-0000626","In front of IMB Qtrs Street light not working ","rectify soon","5","","24","3","2","161","2","5","3","7","","","","16","2014-04-14 16:12:14","16","2014-04-15 09:22:57","","","","");
INSERT INTO complaint VALUES("948","Maintenance-0000627","Behind Stuthi Auditorium street light not working ","rectify soon","5","","23","3","2","161","2","5","3","7","","","","16","2014-04-14 16:13:02","16","2014-04-15 09:22:44","","","","");
INSERT INTO complaint VALUES("949","Maintenance-0000628","Near Campus gate street light not working ","rectify soon","5","","25","3","2","161","2","5","3","7","","","","16","2014-04-14 16:13:40","16","2014-04-15 09:22:33","","","","");
INSERT INTO complaint VALUES("950","Maintenance-0000629","Pump house tube light not working ","rectify soon","5","","24","3","2","161","2","5","3","7","","","","16","2014-04-14 16:13:57","16","2014-04-15 09:22:23","","","","");
INSERT INTO complaint VALUES("951","Maintenance-0000630","Classroom & library no power supply to be checked ","rectify soon","5","","24","4","2","161","2","5","3","7","","","","16","2014-04-14 16:14:32","16","2014-04-15 09:22:12","","","","");
INSERT INTO complaint VALUES("952","Maintenance-0000631","Campus Near Dr Alex house street light not working ","rectify soon","5","","24","3","2","161","2","5","3","7","","","","16","2014-04-14 16:15:37","16","2014-04-15 09:22:04","","","","");
INSERT INTO complaint VALUES("953","Maintenance-0000632","One room no power supply","rectify soon","5","","24","3","113","","2","5","3","7","","","","16","2014-04-14 16:16:44","16","2014-04-15 09:21:54","","","","");
INSERT INTO complaint VALUES("954","Maintenance-0000633"," ups connector switch is not working please do needful work "," ups connector switch is not working please do needful work ","5","","23","1","54","221","2","5","3","5","","","","114","2014-04-14 16:51:33","29","2014-04-15 12:33:20","","","","");
INSERT INTO complaint VALUES("955","Maintenance-0000634","Doom light not working","Doom light not working","5","","23","1","58","192","2","5","3","5","","","","122","2014-04-15 07:52:58","227","2014-04-15 08:28:19","","","","");
INSERT INTO complaint VALUES("956","MIS-0000322","IP address defect","IP address defect","2","","112","1","51","","1","2","3","5","","872","","317","2014-04-15 08:17:13","112","2014-04-15 08:21:42","","","","");
INSERT INTO complaint VALUES("957","Maintenance-0000635","Tube lights in the CCU are not working.","Please do it at the earliest.","5","","22","3","52","","2","5","3","7","","","","128","2014-04-15 08:22:57","128","2014-04-22 15:59:07","","","","");
INSERT INTO complaint VALUES("958","MIS-0000323","In transcription room system 1 keyboard is having some problem so pls rectify the problem","its urgent ","2","","5","1","17","34","1","2","3","7","","0","","113","2014-04-15 08:39:23","113","2014-04-16 09:11:33","","","","");
INSERT INTO complaint VALUES("959","Maintenance-0000636","One Patient Bench is broken in front of Dermatology OPD","its urgent","9","","37","1","75","","2","9","3","5","","","","72","2014-04-15 08:46:21","37","2014-04-15 14:14:42","","","","");
INSERT INTO complaint VALUES("960","Maintenance-0000637","\"F\" room roof light is blenking ","very urgent","5","","23","1","65","353","2","5","3","7","","","","84","2014-04-15 08:47:23","84","2014-04-21 10:14:48","","","","");
INSERT INTO complaint VALUES("961","MIS-0000324","Shift the monitor from 30A medical opd counter to cash counter 4 near emergency (new monitor is to cashcouter4 & which already using in 4 that should be shift to 30A medical opd counter ) because
INSERT INTO complaint VALUES("962","Maintenance-0000638","C12 bed side.","O2 is leaking.","7","","29","1","62","","2","7","3","5","","","","107","2014-04-15 09:14:37","29","2014-04-15 12:33:02","","","","");
INSERT INTO complaint VALUES("963","MIS-0000325","Accpac is not working so pls rectify it soon","itsurgent","3","","5","1","17","27","1","3","3","7","","","","113","2014-04-15 09:20:34","113","2014-04-16 09:11:15","","","","");
INSERT INTO complaint VALUES("964","Maintenance-0000639","wash basin is leaking ","very urgent","6","","32","1","57","","2","6","3","5","","","","73","2014-04-15 09:22:44","227","2014-04-15 12:42:58","","","","");
INSERT INTO complaint VALUES("965","Maintenance-0000640","Dr.Venkat  Narasimhan name board to be removed in central opd.","Contact Person. Sagar","9","","37","1","37","131","2","9","3","5","","","","150","2014-04-15 09:23:05","37","2014-04-15 12:31:16","","","","");
INSERT INTO complaint VALUES("966","Maintenance-0000641","O2 cylinder to be filled","14/04/2014  11:30pm","7","","28","1","52","","2","7","3","7","","","","225","2014-04-15 09:26:36","225","2014-04-29 12:05:07","","","","");
INSERT INTO complaint VALUES("967","Maintenance-0000642","O2 cylinder to be filled","14/04/2014 11:30pm","7","","28","1","53","","2","7","3","7","","","","225","2014-04-15 09:27:28","225","2014-04-29 12:04:58","","","","");
INSERT INTO complaint VALUES("968","Maintenance-0000643","O2 cylinder to be filled","14/04/2014 11:45pm","7","","28","1","63","","2","7","3","7","","","","225","2014-04-15 09:28:11","225","2014-04-29 12:04:50","","","","");
INSERT INTO complaint VALUES("969","Maintenance-0000644","Cu-board Door to be fixed 3 doors is not fixed please do the need full ","urgent","9","","37","1","71","","2","9","3","5","","","","72","2014-04-15 09:28:17","37","2014-04-15 12:31:00","","","","");
INSERT INTO complaint VALUES("970","Maintenance-0000645","O2 cylinder to be filled","14/04/2014 10:20pm","7","","28","1","81","","2","7","3","7","","","","225","2014-04-15 09:30:06","225","2014-04-29 12:01:42","","","","");
INSERT INTO complaint VALUES("971","Maintenance-0000646","O2 cylinder to be filled","14/04/2014  11:20pm","7","","28","1","54","","2","7","3","7","","","","225","2014-04-15 09:31:50","227","2014-04-15 11:18:36","","","","");
INSERT INTO complaint VALUES("972","MIS-0000326","Patient name: Indu Jha, MRD No: AA248200. Test name: LH. Not able to enter the report. It shows under process when we open it is pending analysis.","ASAP.","3","","9","1","17","30","1","3","3","5","","","","292","2014-04-15 09:32:50","9","2014-04-15 10:02:03","","","","");
INSERT INTO complaint VALUES("973","MIS-0000327","System is very slow and gets hanged often.","Urgent","2","","112","1","17","25","1","2","3","5","","0","","257","2014-04-15 09:35:05","112","2014-04-16 08:09:17","","","","");
INSERT INTO complaint VALUES("974","MIS-0000328","Patient name: Sahana, MRD no: AA251054.
INSERT INTO complaint VALUES("975","Maintenance-0000647","cupboard screw is broken","cannot close the door","9","","37","1","53","","2","9","3","5","","","","119","2014-04-15 09:45:14","37","2014-04-15 12:30:24","","","","");
INSERT INTO complaint VALUES("976","MIS-0000329","Blood bank ELISA is attached to Histopathology printer which is not giving prints now","Blood bank ELISA is attached to Histopathology printer which is not giving prints now","2","","5","1","17","31","1","2","3","7","","0","","300","2014-04-15 09:51:33","300","2014-05-09 10:01:25","","","","");
INSERT INTO complaint VALUES("977","Maintenance-0000648","kindly issue the calibration certificate for fridge temperature and even to its monitor for NABH  audit . Already requisition is send on 09/04/2014 , but  found no response . ","Kindly do the needful as soon as possible for smooth NABH  audit. ","7","","26","1","50","","2","7","3","5","","","","126","2014-04-15 10:02:14","26","2014-04-16 08:47:31","","","","");
INSERT INTO complaint VALUES("978","Maintenance-0000649","SAFETY BELT TO BE FIXED FOR  
INSERT INTO complaint VALUES("979","Maintenance-0000650","pediatric O.P.D. garden gate door became loose.","kindly do the needful as early as possible.","9","","37","1","79","","2","9","3","5","","","","216","2014-04-15 10:19:03","29","2014-04-15 14:39:03","","","","");
INSERT INTO complaint VALUES("980","Maintenance-0000651","cryo can to fill ","urgent","7","","26","1","75","","2","7","3","5","","","","207","2014-04-15 10:23:01","26","2014-04-16 08:45:23","","","","");
INSERT INTO complaint VALUES("981","Maintenance-0000652"," Electrical Extension Board with 5 amps malty socket 3 nos, indicater one and  4 mtrs cable with 5 amps plug for projector use ","Non availability , Urgent need for  projector use 
INSERT INTO complaint VALUES("982","Maintenance-0000653","cupboard ","utility room cupboard is broken","9","","37","1","60","287","2","9","3","5","","","","103","2014-04-15 10:29:44","37","2014-04-15 12:30:08","","","","");
INSERT INTO complaint VALUES("983","Maintenance-0000654","G-3 CALLING BELL IS NOT WORKING","NEED TO BE URGENT","8","","33","1","60","","2","8","3","5","","","","103","2014-04-15 10:30:41","33","2014-04-15 12:45:27","","","","");
INSERT INTO complaint VALUES("984","MIS-0000330","pediatric O.P.D. room 5 computer not working.{calling system}.","kindly do the needful.","3","","9","1","79","","1","3","3","5","","","","216","2014-04-15 10:34:04","9","2014-04-16 11:18:01","","","","");
INSERT INTO complaint VALUES("985","MIS-0000331","BBH-MNT-01 computer network not working ( Lan )","recify soon","2","","112","1","2","","1","2","3","7","","779","","227","2014-04-15 10:54:21","227","2014-04-15 11:18:12","","","","");
INSERT INTO complaint VALUES("986","MIS-0000332","NURSE EDUCATOR ROOM 2nd floor","while giving print out (in delux printer) theres a shaded border appearing in all the print sheets.","2","","112","1","45","","1","2","3","7","","0","","93","2014-04-15 11:16:35","93","2014-05-02 08:39:37","","","","");
INSERT INTO complaint VALUES("987","Maintenance-0000655","pc opd zinc blocked","piease come ","6","","32","1","102","","2","6","3","5","","","","246","2014-04-15 11:17:55","32","2014-04-15 12:44:07","","","","");
INSERT INTO complaint VALUES("988","MIS-0000333","NICU -02 computer power cord is not working","very urgent","2","","112","1","55","","1","2","3","5","","0","","73","2014-04-15 11:34:38","112","2014-04-15 12:00:42","","","","");
INSERT INTO complaint VALUES("989","MIS-0000334","MAIL ID NOT AVAILABLE,PLEASE CREATE ID FOR GOPD,","VERY URGENT,","3","","8","1","73","","1","3","3","5","","","","211","2014-04-15 11:35:33","8","2014-04-15 13:33:19","","","","");
INSERT INTO complaint VALUES("990","MIS-0000335","Please provide acession for LIS 100,101,102,103,104,105 for Shyla & Graise","ASAP.","3","","9","1","17","30","1","3","3","5","","","","292","2014-04-15 11:48:52","9","2014-04-15 12:58:46","","","","");
INSERT INTO complaint VALUES("991","Maintenance-0000656","Please provide additional 15 amp and 5 amp electrical point from UPS line
INSERT INTO complaint VALUES("992","MIS-0000336","BBH Lab Send out test","is not opening mail.","3","","5","1","17","32","1","3","3","7","","","","113","2014-04-15 13:15:19","113","2014-04-16 09:10:56","","","","");
INSERT INTO complaint VALUES("993","Maintenance-0000657","B-ROOM AND I-ROOM","DOOR TO BE REPAIRED","9","","37","1","64","","2","9","3","7","","","","110","2014-04-15 13:31:26","110","2014-04-17 12:54:04","","","","");
INSERT INTO complaint VALUES("994","MIS-0000337","1. crp-02 - system is very slow & hanging
INSERT INTO complaint VALUES("995","Maintenance-0000658","ext 552 lines are not clearly audible","high priority","8","","33","1","40","63","2","8","3","7","","","","65","2014-04-15 14:14:12","65","2014-04-16 08:26:38","","","","");
INSERT INTO complaint VALUES("996","MIS-0000338","printer is not working ","printer is not working ","2","","5","1","16","35","1","2","3","7","","741","","132","2014-04-15 14:20:04","132","2014-04-16 16:00:08","","","","");
INSERT INTO complaint VALUES("997","MIS-0000339","CRP-09 - system is very slow and getting hanged frequently","high priority","3","","5","1","40","12","1","3","3","7","","","","65","2014-04-15 14:35:04","65","2014-04-17 12:58:29","","","","");
INSERT INTO complaint VALUES("998","Maintenance-0000659","staff ladies toilet - sink and toilet blocked. ","urgent ","6","","31","1","47","118","2","6","3","5","","","","149","2014-04-15 14:47:33","31","2014-04-16 15:48:12","","","","");
INSERT INTO complaint VALUES("999","Maintenance-0000660","NURSES STATION","OXYGEN CYLINDER 2 NO\'S IS EMPTY","5","","23","1","64","","2","5","3","7","","","","110","2014-04-15 15:03:54","110","2014-04-17 12:53:32","","","","");
INSERT INTO complaint VALUES("1000","Maintenance-0000661","Phone not working ","Phone not working ","8","","33","1","2","161","2","8","3","7","","","","16","2014-04-15 15:21:02","16","2014-04-16 12:41:04","20140415152149_400123_575138425846158_76136749_n.jpg#","","","");
INSERT INTO complaint VALUES("1001","MIS-0000340","This is for your kind requisition  that WIFI connection which was been removed for the construction progress to be return & re fix as soon as possible . . ","Kindly do the needful for patient satisfactory","2","","9","1","50","","1","2","3","5","1","0","wi-fi router to be purchased.Due to the leaking the existing router got damaged.Kindly raise the non stock.","126","2014-04-15 16:01:12","123","2014-05-29 10:05:35","","","","");
INSERT INTO complaint VALUES("1002","Maintenance-0000662","Near Lift new tube light to be fixed  ","Near Lift new tube light to be fixed ","5","","23","1","68","93","2","5","3","7","","","","16","2014-04-15 16:30:38","16","2014-04-16 12:40:55","","","","");
INSERT INTO complaint VALUES("1003","Maintenance-0000663","Washing area entrance tube light to be shift","rectify soon","5","","23","1","68","93","2","5","3","7","","","","16","2014-04-15 16:31:15","16","2014-04-16 12:40:45","","","","");
INSERT INTO complaint VALUES("1004","Maintenance-0000664","Washing area tube light not working ","rectify soon","5","","23","1","68","96","2","5","3","7","","","","16","2014-04-15 16:32:55","16","2014-04-16 12:40:36","","","","");
INSERT INTO complaint VALUES("1005","Maintenance-0000665","oxygen cylinder is empty ","to be changed.","7","","28","1","58","198","2","7","3","5","","","","130","2014-04-15 22:58:12","28","2014-04-16 07:51:11","","","","");
INSERT INTO complaint VALUES("1006","Maintenance-0000666","oxygen flow meter  leaking  please do needful work","oxygen flow meter  leaking please do needful work","7","","29","1","54","221","2","7","3","5","","","","114","2014-04-16 07:55:00","29","2014-04-16 09:02:56","","","","");
INSERT INTO complaint VALUES("1007","Maintenance-0000667","SCREEN HANGER IS FALLEN TO BE FIXED ","VERY URGENT","9","","37","1","65","347","2","9","3","7","","","","84","2014-04-16 07:59:10","84","2014-04-21 10:12:32","","","","");
INSERT INTO complaint VALUES("1008","Maintenance-0000668","ladies staff toilet sink and toilet block not cleared.urgent action required as the water on the floor.","very urgent.","6","","30","1","47","118","2","6","3","5","","","","149","2014-04-16 08:03:23","30","2014-04-16 12:15:02","","","","");
INSERT INTO complaint VALUES("1009","Maintenance-0000669","suction bottle not working in bed no 12","pressure is not coming","7","","29","1","53","","2","7","3","5","","","","119","2014-04-16 08:03:31","29","2014-04-16 09:02:45","","","","");
INSERT INTO complaint VALUES("1010","MIS-0000341","CRP-03 is not getting updated","high priority","2","","112","1","40","12","1","2","3","7","","701","","65","2014-04-16 08:25:20","65","2014-04-17 12:58:13","","","","");
INSERT INTO complaint VALUES("1011","MIS-0000342","print not able to take in proper format","print not able to take in proper format","2","","112","1","51","","1","2","3","5","","872","","317","2014-04-16 08:25:57","112","2014-04-16 08:49:17","","","","");
INSERT INTO complaint VALUES("1012","Maintenance-0000670","O2 cylinder to be filled","15/04/2014","7","","28","1","81","","2","7","3","7","","","","225","2014-04-16 08:28:19","225","2014-04-29 12:01:25","","","","");
INSERT INTO complaint VALUES("1013","Maintenance-0000671","O2 cylinder to be filled","15/04/2014","7","","28","1","64","","2","7","3","7","","","","225","2014-04-16 08:29:09","225","2014-04-29 12:01:09","","","","");
INSERT INTO complaint VALUES("1014","Maintenance-0000672","D-ROOM","CARDIAC TABLE TO BE REPAIRED","7","","29","4","64","","2","7","3","7","","","","110","2014-04-16 08:30:06","110","2014-04-17 12:53:00","","","","");
INSERT INTO complaint VALUES("1015","Maintenance-0000673","Washing area is blocked","15/04/2014  10:15pm","7","","28","1","49","","2","7","3","7","","","","225","2014-04-16 08:30:26","225","2014-04-29 12:00:48","","","","");
INSERT INTO complaint VALUES("1016","MIS-0000343","system is hanging","system is hanging","3","","9","1","16","19","1","3","3","7","","","","132","2014-04-16 08:59:44","132","2014-04-16 16:00:24","","","","");
INSERT INTO complaint VALUES("1017","Maintenance-0000674","dvt pump plug is not working, and one screw is broken","to be checked immediately","5","","23","1","53","","2","5","3","5","","","","119","2014-04-16 09:07:20","23","2014-04-16 16:19:34","","","","");
INSERT INTO complaint VALUES("1018","Maintenance-0000675","F-2 wall mounted fan.","making noise.","5","","22","1","61","","2","5","3","5","","","","104","2014-04-16 09:21:33","22","2014-04-16 16:18:21","","","","");
INSERT INTO complaint VALUES("1019","MIS-0000344","Cannot print online news articles on BBH coverage ","Tried opening different websites but to no avail","3","","8","1","94","37","1","3","3","7","","","","137","2014-04-16 09:28:08","137","2014-04-21 11:50:29","","","","");
INSERT INTO complaint VALUES("1020","Maintenance-0000676","painting to be done for  the following items 
INSERT INTO complaint VALUES("1021","MIS-0000345","kindly look common share folder is not there this system bbh- wg4-01bbh.com to be check.","as soon as possible.","2","","112","1","63","","1","2","3","7","","901","","87","2014-04-16 10:14:05","87","2014-04-22 15:35:28","","","","");
INSERT INTO complaint VALUES("1022","Maintenance-0000677","O2 cylinder is empty","attend soon","5","","23","1","81","","2","5","3","7","","","","225","2014-04-16 10:17:36","225","2014-04-29 12:00:29","","","","");
INSERT INTO complaint VALUES("1023","MIS-0000346","ENT ROOM NO E4 COMPUTER NOT WORKING","URGENT","3","","5","1","76","","1","3","3","5","","","","206","2014-04-16 10:23:38","5","2014-04-16 10:56:36","","","","");
INSERT INTO complaint VALUES("1024","MIS-0000347","system need to fix it","system need to fix it","2","","5","1","16","19","1","2","3","7","","0","","132","2014-04-16 10:24:58","132","2014-04-16 16:00:38","","","","");
INSERT INTO complaint VALUES("1025","Maintenance-0000678","UTILITY ROOM","LAUNDRY BOX DOOR TO BE REPAIRED","9","","37","1","64","338","2","9","3","7","","","","110","2014-04-16 10:30:37","110","2014-04-17 12:52:32","","","","");
INSERT INTO complaint VALUES("1026","MIS-0000348","computer is not working room no p5,p7 paediatric opd","pls come  and do  the emargency","3","","5","1","79","","1","3","3","5","","","","216","2014-04-16 10:40:46","5","2014-04-16 10:57:38","","","","");
INSERT INTO complaint VALUES("1027","Maintenance-0000679","ldpr - AC  water is leaking","needs urgent","7","","26","1","59","","2","7","3","5","","","","116","2014-04-16 11:12:49","26","2014-04-16 12:21:16","","","","");
INSERT INTO complaint VALUES("1028","Maintenance-0000680","OT-2  vaccum suction not coming","attend soon","7","","27","1","58","","2","7","3","7","","","","225","2014-04-16 11:15:04","225","2014-04-29 12:00:16","","","","");
INSERT INTO complaint VALUES("1029","Maintenance-0000681","1. glass door is not closing properly.
INSERT INTO complaint VALUES("1030","Maintenance-0000682","utility room sink is blocked.","kindly rectrify as soon as possible. ","6","","30","1","65","354","2","6","3","5","","","","235","2014-04-16 11:47:14","30","2014-04-16 15:49:57","","","","");
INSERT INTO complaint VALUES("1031","Maintenance-0000683","fan is not working","need to be urgent","5","","24","1","60","282","2","5","3","5","","","","103","2014-04-16 12:31:04","24","2014-04-16 16:17:48","","","","");
INSERT INTO complaint VALUES("1032","MIS-0000349","There is no Mozila fire in CSSD System","very urgent","3","","5","1","57","","1","3","3","5","","","","73","2014-04-16 12:31:05","5","2014-04-16 12:39:34","","","","");
INSERT INTO complaint VALUES("1033","Maintenance-0000684","Gas pipe leaking to be checked ","Gas pipe leaking to be checked ","7","","29","1","68","93","2","7","3","7","","","","16","2014-04-16 12:40:27","16","2014-04-21 08:46:46","","","","");
INSERT INTO complaint VALUES("1034","MIS-0000350","Printer Cartridge To be Fixed ","Urgent","2","","5","1","71","","1","2","3","5","","845","","72","2014-04-16 12:52:26","5","2014-04-16 12:59:38","","","","");
INSERT INTO complaint VALUES("1035","Maintenance-0000685","IP pharmacy UPS not working","attend soon","5","","23","1","18","","2","5","3","7","","","","225","2014-04-16 12:55:18","225","2014-04-29 11:59:56","","","","");
INSERT INTO complaint VALUES("1036","MIS-0000351","crp-11 ACCPAC not working","High priority","3","","5","1","40","12","1","3","3","7","","","","313","2014-04-16 12:59:51","313","2014-04-30 08:40:51","","","","");
INSERT INTO complaint VALUES("1037","MIS-0000352","crp-06 - OP pharmacy credit bill description to be changed from OUTPATIENT PHARMACY CASH RECEIPT to OUTPATIENT PHARMACY CREDIT RECEIPT
INSERT INTO complaint VALUES("1038","Maintenance-0000686","In er annex water leaking from sink pipe, so kindly change the pipe.","In er annex water leaking from sink pipe, so kindly change the pipe.","6","","32","1","81","","2","6","3","5","","","","99","2014-04-16 13:35:05","32","2014-04-16 16:22:34","","","","");
INSERT INTO complaint VALUES("1039","MIS-0000353","Barcode printer is not working.","Urgent.","2","","112","1","17","25","1","2","3","5","","0","","257","2014-04-16 13:38:38","112","2014-04-16 14:09:11","","","","");
INSERT INTO complaint VALUES("1040","Maintenance-0000687","TO INSTALL MESH WITH WOODEN SLITS ON THE DOOR (NEURO 2) FOR VENTILATION.","NEGOTIATION OVER AND APPROVED BY AC.","9","","37","1","110","","2","9","3","5","","","","224","2014-04-16 13:44:35","37","2014-04-16 16:31:48","","","","");
INSERT INTO complaint VALUES("1041","Maintenance-0000688","16-4-2014-  i will send for  painting 
INSERT INTO complaint VALUES("1042","Maintenance-0000689","WHEEL CHAIR FOOT STAND IS BROKEN ","VERY URGENT","7","","29","1","65","","2","7","3","7","","","","84","2014-04-16 14:02:08","84","2014-04-21 10:14:15","","","","");
INSERT INTO complaint VALUES("1043","Maintenance-0000690","Tube lights   are not working in 1st floor  B.Sc students hostel.","Urgent","5","","22","4","107","","2","5","3","7","","","","265","2014-04-16 14:02:14","265","2014-04-17 12:07:07","","","","");
INSERT INTO complaint VALUES("1044","Maintenance-0000691","A1, A2, B1, C1, C3, C8,Bed side.","wheals are not lacked properly.","7","","29","1","62","","2","7","3","3","6","","Quotation Under progress","107","2014-04-16 14:08:31","29","2014-06-12 11:39:16","","","","");
INSERT INTO complaint VALUES("1045","Maintenance-0000692","WATER LEAKAGE FROM DUCT,  NEAR ROOM 03211","KINDLY  RECTIFY AS SOON AS POSSIBLE. ","6","","31","1","50","","2","6","3","5","","","","126","2014-04-16 14:45:03","31","2014-04-16 15:48:03","","","","");
INSERT INTO complaint VALUES("1046","MIS-0000354","crp-08 - bill no 112823/16.04.14 mother insurance when entered is getting saved but not appearing on the final bill.","Immediately-high priority","3","","9","1","40","11","1","3","3","7","","","","313","2014-04-16 14:47:44","313","2014-04-30 08:37:51","","","","");
INSERT INTO complaint VALUES("1047","Maintenance-0000693","Computer power supply is not coming please do the needful.
INSERT INTO complaint VALUES("1048","Maintenance-0000694","PC- ward isolation nurses station opp wall cupboard from that water leakage .","please come immediately....","11","","21","1","49","242","2","11","3","5","","","","97","2014-04-16 15:21:19","227","2014-05-06 10:05:33","","","","");
INSERT INTO complaint VALUES("1049","Maintenance-0000695","G1 AND F3 CALLING BELL IS NOT WORKING ","VERY URGENT ","8","","34","1","65","351","2","8","3","7","","","","84","2014-04-16 15:53:03","84","2014-04-21 10:13:58","","","","");
INSERT INTO complaint VALUES("1050","MIS-0000355","There is one schedule in OBG Office computer, which should be  sent to Medical school, ","urgent","3","","6","1","105","","1","3","3","5","","","","291","2014-04-16 16:16:42","6","2014-04-17 08:07:39","","","","");
INSERT INTO complaint VALUES("1051","MIS-0000356","Barcode Zebra is not working ","Lab OPD","2","","5","1","17","","1","2","3","5","","822","","257","2014-04-16 16:58:17","5","2014-04-16 18:03:13","","","","");
INSERT INTO complaint VALUES("1052","Maintenance-0000696","CLASS ROOM","FAN TO BE REPAIRED","5","","24","1","64","346","2","5","3","7","","","","110","2014-04-17 08:16:13","110","2014-04-24 12:58:35","","","","");
INSERT INTO complaint VALUES("1053","Maintenance-0000697","A-ROOM TOILET","HOOK TO BE FIXED ","9","","37","1","64","","2","9","3","7","","","","110","2014-04-17 08:16:59","110","2014-04-24 12:58:12","","","","");
INSERT INTO complaint VALUES("1054","MIS-0000357","system PM -04 not working.","system PHM-04 not working","3","","112","1","18","7","1","3","3","7","","","","64","2014-04-17 08:18:49","64","2014-04-17 10:14:57","","","","");
INSERT INTO complaint VALUES("1055","Maintenance-0000698","
INSERT INTO complaint VALUES("1056","Maintenance-0000699","wash basin leaking","urgent","6","","32","1","47","108","2","6","3","5","","","","149","2014-04-17 08:43:05","32","2014-04-17 15:14:41","","","","");
INSERT INTO complaint VALUES("1057","Maintenance-0000700","UTILITY ROOM","GEYZER IS NOT WORKING","5","","24","1","64","338","2","5","3","7","","","","110","2014-04-17 08:56:06","110","2014-04-24 12:57:41","","","","");
INSERT INTO complaint VALUES("1058","Maintenance-0000701","LINEN ROOM","GODREJ CUBOARD TO BE REPAIRED","9","","37","1","64","","2","9","3","7","","","","110","2014-04-17 08:56:52","110","2014-04-24 12:57:01","","","","");
INSERT INTO complaint VALUES("1059","MIS-0000358","Our new computer has come please send person and fix it.","Our new computer has come please send person and fix it.","3","","5","1","81","","1","3","3","5","6","","there is no network point ","99","2014-04-17 09:02:55","5","2014-04-17 16:57:40","","","","");
INSERT INTO complaint VALUES("1060","Maintenance-0000702","NEAR OT -1 ALUIMINIUM DOOR ITS NOT WORKING 
INSERT INTO complaint VALUES("1061","Maintenance-0000703","TUBE LIGHT IS BLINKING ","DO IT SOON ","5","","24","1","58","196","2","5","3","5","","","","122","2014-04-17 09:09:18","24","2014-04-17 16:12:05","","","","");
INSERT INTO complaint VALUES("1062","MIS-0000359","crp-08 - Computer is not starting","High priority","2","","112","1","40","11","1","2","3","7","","706","","313","2014-04-17 09:09:58","313","2014-04-30 08:37:25","","","","");
INSERT INTO complaint VALUES("1063","Maintenance-0000704","room no 1514 wash basin tap not working, tap nob is very tight.","please come ASAP.","6","","32","1","49","","2","6","3","5","","","","97","2014-04-17 09:51:06","32","2014-04-17 15:13:10","","","","");
INSERT INTO complaint VALUES("1064","Maintenance-0000705","Nurses Station Cupboard not able to work.","please come immediately","9","","37","1","49","242","2","9","3","5","","","","97","2014-04-17 09:52:50","37","2014-04-17 16:06:11","","","","");
INSERT INTO complaint VALUES("1065","Maintenance-0000706","We need network point for new computer connection.","We need network point for new computer connection.","5","","24","1","81","","2","5","3","5","6","","Its New requirement outsource to be done ","99","2014-04-17 09:58:34","24","2014-05-05 09:20:24","","","","");
INSERT INTO complaint VALUES("1066","Maintenance-0000707","B -ROOM","NEED PAINTING [ LEAK IN THE WALL].","11","","21","1","61","","2","11","3","3","9","","Work order issued work to be done by outsource ","104","2014-04-17 11:09:08","21","2014-06-12 12:03:03","","","","");
INSERT INTO complaint VALUES("1067","MIS-0000360","SYSTEM IS HANGING","SYSTEM IS HANGING","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-17 11:15:14","132","2014-05-06 14:50:31","","","","");
INSERT INTO complaint VALUES("1068","Maintenance-0000708","Bed no F-4 patient calling to e repaired","rctify this very urgent","8","","34","1","65","353","2","8","3","7","","","","84","2014-04-17 11:25:16","84","2014-04-21 10:11:50","","","","");
INSERT INTO complaint VALUES("1069","Maintenance-0000709","Students Hostel Telephone is not working ","urgent","8","","33","4","107","","2","8","3","7","","","","265","2014-04-17 11:54:24","265","2014-05-06 08:59:52","","","","");
INSERT INTO complaint VALUES("1070","MIS-0000361","Kindly install new ms-office 2007 in system prs-02 ","plssssssssss kindly do the needful
INSERT INTO complaint VALUES("1071","MIS-0000362","Library Printer not working","Library Printer not working","3","","5","1","25","","1","3","3","7","","","","152","2014-04-17 12:52:34","152","2014-05-12 10:22:06","","","","");
INSERT INTO complaint VALUES("1072","Maintenance-0000710","The land line phone has to be  shift from  Dr. Saro  room to other room","The land line phone has to be  shift from  Dr. Saro  room to other room","8","","34","1","23","248","2","8","3","5","","","","80","2014-04-17 13:00:50","34","2014-04-17 16:20:21","","","","");
INSERT INTO complaint VALUES("1073","MIS-0000363","The computer system has to shift from Dr. Saro room to other room","The computer system has to shift from Dr. Saro room to other room","2","","5","1","23","","1","2","3","5","","0","","80","2014-04-17 13:03:59","5","2014-04-17 13:29:21","","","","");
INSERT INTO complaint VALUES("1074","MIS-0000364","CRP-07 to clean up the outlook message.","high priority","3","","5","1","40","12","1","3","3","7","","","","65","2014-04-17 13:16:05","65","2014-04-23 09:48:19","","","","");
INSERT INTO complaint VALUES("1075","MIS-0000365","Transcription room system 1 keyboard is not working pls rectify it soon","its urgent","2","","5","1","17","34","1","2","1","7","4","0","keyboard has to be purchase 
INSERT INTO complaint VALUES("1076","Maintenance-0000711","water is not coming from the taps in Multipurpose hall baptism tank","urgent","6","","31","4","107","","2","6","3","7","","","","153","2014-04-17 13:43:26","153","2014-04-19 09:32:44","","","","");
INSERT INTO complaint VALUES("1077","Maintenance-0000712","A-TOILET FLUSH.","NOT WORKING.","6","","31","1","61","","2","6","3","5","","","","104","2014-04-17 14:32:24","31","2014-04-17 15:15:39","","","","");
INSERT INTO complaint VALUES("1078","MIS-0000366","In the Printer paper is stocked  ","its urgent 
INSERT INTO complaint VALUES("1079","Maintenance-0000713","A-9 BEDSIDE LOCKER.","TO BE FIXED.","9","","37","1","61","","2","9","3","5","","","","104","2014-04-17 14:52:48","37","2014-04-17 16:05:48","","","","");
INSERT INTO complaint VALUES("1080","Maintenance-0000714","oxygen cylinder is empty","very urgent","5","","22","1","55","","2","5","3","5","","","","73","2014-04-17 15:10:50","22","2014-04-17 16:23:22","","","","");
INSERT INTO complaint VALUES("1081","Maintenance-0000715"," 1.CPM  EQUIPMENT NOT WORKING FOR LAST 3 MONTHS
INSERT INTO complaint VALUES("1082","Maintenance-0000716","In bathroom,WATER IS FLOWING not able to close.","please clear it immediately","6","","31","1","63","319","2","6","3","7","","","","87","2014-04-17 22:41:50","87","2014-04-22 15:34:53","","","","");
INSERT INTO complaint VALUES("1083","Maintenance-0000717","C-9 suction apparatus is not working.","do it as soon as possible.","7","","27","1","63","319","2","7","3","7","","","","87","2014-04-17 22:45:34","87","2014-04-22 15:34:04","","","","");
INSERT INTO complaint VALUES("1084","Maintenance-0000718","wall switch board is totally come out ,has to be changed","to be rectified as soon as possible","5","","25","1","58","193","2","5","3","5","","","","130","2014-04-18 08:03:32","25","2014-04-22 16:39:55","","","","");
INSERT INTO complaint VALUES("1085","Maintenance-0000719","SEMI D ROOM SUCTION APPARATUS IS NOTE WORKING","SUCTION APPARATUS IS NOT WORKING","7","","29","1","64","332","2","7","3","5","","","","325","2014-04-18 21:56:02","227","2014-04-19 08:17:56","","","","");
INSERT INTO complaint VALUES("1086","MIS-0000367","FROM CASH COUNTER-4. PRINTER IS NOT WORKING","FROM CASH COUNTER-4. PRINTER IS NOT WORKING","2","","8","1","44","","1","2","3","5","","0","","358","2014-04-19 07:46:08","8","2014-04-19 08:19:24","","","","");
INSERT INTO complaint VALUES("1087","Maintenance-0000720","AC IS MAKING SOUND","NEEDS URGENT","7","","26","1","59","","2","7","3","5","","","","116","2014-04-19 07:59:46","26","2014-04-19 12:26:24","","","","");
INSERT INTO complaint VALUES("1088","Maintenance-0000721","Ghoose neck  spot light is not working.","needs urgent","5","","24","1","59","","2","5","3","5","","","","116","2014-04-19 08:54:32","24","2014-04-19 12:30:43","","","","");
INSERT INTO complaint VALUES("1089","Maintenance-0000722","To change the  tube lights of single surface phototheraphy  ,as its due date  is today 19/04/2014","kindly do the need ful as soon as possible . ","7","","27","1","50","","2","7","3","5","","","","126","2014-04-19 08:56:47","27","2014-04-22 11:44:53","","","","");
INSERT INTO complaint VALUES("1090","Maintenance-0000723","room no 1514 wash basin blocked","pls come immediately.","6","","30","1","49","234","2","6","3","5","","","","97","2014-04-19 09:05:31","30","2014-04-19 12:31:30","","","","");
INSERT INTO complaint VALUES("1091","MIS-0000368","System is not working keyboard mouse also not working","In transcription.","3","","5","1","17","34","1","3","3","5","6","","                                       ","257","2014-04-19 09:12:51","5","2014-04-21 10:24:12","","","","");
INSERT INTO complaint VALUES("1092","MIS-0000369","Internet not working","Kindly look into the same.  thank you.","3","","8","1","94","","1","3","3","7","","","","136","2014-04-19 09:13:12","136","2014-04-19 10:22:28","","","","");
INSERT INTO complaint VALUES("1093","Maintenance-0000724","door handle is not working","urgent","9","","37","1","57","67","2","9","3","5","","","","363","2014-04-19 09:29:12","37","2014-04-21 16:55:12","","","","");
INSERT INTO complaint VALUES("1094","Maintenance-0000725","NURSES STATION ","OXYGEN CYLINDER OXYGEN IS NOT FLOWING","7","","26","1","64","","2","7","3","7","","","","110","2014-04-19 09:44:49","110","2014-04-24 12:55:55","","","","");
INSERT INTO complaint VALUES("1095","Maintenance-0000726","NURSES STATION -2","KEYBOARD TABLE TO BE FIXED","9","","37","1","64","","2","9","3","7","","","","110","2014-04-19 09:45:48","110","2014-04-24 12:55:12","","","","");
INSERT INTO complaint VALUES("1096","MIS-0000370","Attached mail is not opening","Attached mail is not opening","3","","5","1","23","","1","3","3","5","","","","80","2014-04-19 09:52:39","5","2014-04-19 10:55:57","","","","");
INSERT INTO complaint VALUES("1097","Maintenance-0000727","inside OT -6 AC  window wooden sides to be fixed ","DO IT SOON","9","","37","1","58","194","2","9","3","5","","","","124","2014-04-19 10:07:26","37","2014-04-21 16:54:43","","","","");
INSERT INTO complaint VALUES("1098","Maintenance-0000728","Plate-late agitator there is no power supply","Urgent","5","","25","1","17","142","2","5","3","7","","","","113","2014-04-19 10:25:35","113","2014-04-19 17:01:41","","","","");
INSERT INTO complaint VALUES("1099","MIS-0000371","system is not working","system is not working","3","","5","1","17","31","1","3","3","7","","","","113","2014-04-19 10:36:16","113","2014-04-19 17:01:23","","","","");
INSERT INTO complaint VALUES("1100","Maintenance-0000729","o2 cylender empty.","o2 cylender empty.","5","","25","1","81","","2","5","3","5","","","","99","2014-04-19 10:41:04","25","2014-04-19 12:28:51","","","","");
INSERT INTO complaint VALUES("1101","MIS-0000372","system is hanging & very slow","system is hanging & very slow","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-19 10:44:57","132","2014-05-06 14:50:05","","","","");
INSERT INTO complaint VALUES("1102","Maintenance-0000730","cupboard  lock is broken to be replaced.","urgent","9","","37","1","71","164","2","9","3","5","","","","72","2014-04-19 10:50:21","37","2014-04-21 16:54:24","","","","");
INSERT INTO complaint VALUES("1103","MIS-0000373","not working ","not working ","2","","5","1","74","","1","2","3","5","","0","","214","2014-04-19 10:54:56","5","2014-04-19 12:08:05","","","","");
INSERT INTO complaint VALUES("1104","MIS-0000374","system is hanging ","system is hanging ","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-19 10:58:22","132","2014-05-06 14:49:43","","","","");
INSERT INTO complaint VALUES("1105","Maintenance-0000731","tube light not working ","tube light not working ","5","","25","1","74","185","2","5","3","5","","","","214","2014-04-19 10:58:52","25","2014-04-21 16:48:30","","","","");
INSERT INTO complaint VALUES("1106","MIS-0000375","system is hanging","system is hanging","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-19 11:30:43","132","2014-05-06 14:49:28","","","","");
INSERT INTO complaint VALUES("1107","Maintenance-0000732","Ghoose neck  light  screw to be fixed.
INSERT INTO complaint VALUES("1108","MIS-0000376","UNABLE TO ENTER MEDICINES","VERY URGENT","3","","6","1","55","","1","3","3","5","","","","73","2014-04-19 11:33:28","6","2014-04-19 12:02:27","","","","");
INSERT INTO complaint VALUES("1109","MIS-0000377","closing time system hanging","closing time system hanging","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-19 11:46:59","132","2014-05-06 14:49:08","","","","");
INSERT INTO complaint VALUES("1110","Maintenance-0000733","from w- 4 F-1 bed bulgon frame to be transfer to w-3 c-4 bed to be change.","as soon as possible.","7","","29","1","63","","2","7","3","7","","","","87","2014-04-19 11:52:50","87","2014-04-22 15:34:19","","","","");
INSERT INTO complaint VALUES("1111","Maintenance-0000734","wheel chair broken to be check.","as soon as possible.","7","","29","1","63","","2","7","3","7","6","","Outsource welding to be done hence pending","87","2014-04-19 11:53:43","87","2014-04-30 11:05:13","","","","");
INSERT INTO complaint VALUES("1112","MIS-0000378","printer not working","printer not working","2","","112","1","18","8","1","2","3","7","","0","","64","2014-04-19 12:03:44","64","2014-04-21 07:43:40","","","","");
INSERT INTO complaint VALUES("1113","MIS-0000379","every sat happening same ","every sat happening same ","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-19 12:10:31","132","2014-05-06 14:48:49","","","","");
INSERT INTO complaint VALUES("1114","Maintenance-0000735","fan is not  working","need to be changed","5","","24","1","60","291","2","5","3","5","","","","103","2014-04-19 12:11:56","24","2014-04-19 12:50:32","","","","");
INSERT INTO complaint VALUES("1115","Maintenance-0000736","FLUSH STAND BROKEN,NEED TO FIX.","FLUSH STAND BROKEN,NEED TO FIX.","6","","30","1","81","","2","6","3","5","","","","99","2014-04-19 12:16:29","30","2014-04-19 12:31:19","","","","");
INSERT INTO complaint VALUES("1116","Maintenance-0000737","DOOR HANDLE NEED TO FIX IN ER ANNEX COUNCILING ROOM.","DOOR HANDLE NEED TO FIX IN ER ANNEX COUNCILING ROOM.","9","","37","1","81","","2","9","3","5","","","","99","2014-04-19 12:17:43","37","2014-04-22 16:52:51","","","","");
INSERT INTO complaint VALUES("1117","Maintenance-0000738","Qtrs Dr Rachel house Kitchen sink blocked ","Qtrs Dr Rachel house Kitchen sink blocked ","6","","30","3","2","161","2","6","3","7","","","","227","2014-04-19 12:32:16","227","2014-04-21 08:45:15","","","","");
INSERT INTO complaint VALUES("1118","MIS-0000380","PRINTER IS NOT WORKING","RECTIFY IMMEDIATELY","3","","5","1","49","","1","3","3","5","","","","97","2014-04-19 13:10:18","5","2014-04-19 13:12:05","","","","");
INSERT INTO complaint VALUES("1119","Maintenance-0000739","toilet flush is not working","very urgent","6","","31","1","65","350","2","6","3","5","","","","233","2014-04-19 16:14:35","227","2014-04-21 08:07:09","","","","");
INSERT INTO complaint VALUES("1120","Maintenance-0000740","toilet flush is not working","very urgent","6","","32","1","65","349","2","6","3","5","","","","233","2014-04-20 08:40:49","32","2014-04-21 10:35:54","","","","");
INSERT INTO complaint VALUES("1121","Maintenance-0000741","GLASS DOOR BROKEN","TO BE CHECKED IMMEDIATELY","9","","37","1","53","","2","9","3","5","4","","Glass no stock ","119","2014-04-20 12:32:52","227","2014-04-26 10:04:29","","","","");
INSERT INTO complaint VALUES("1122","Maintenance-0000742","MALE SIDE TOILET","TAP IS LEAKING","6","","32","1","64","331","2","6","3","7","","","","110","2014-04-21 08:33:16","110","2014-04-24 12:54:29","","","","");
INSERT INTO complaint VALUES("1123","Maintenance-0000743","WASHING AREA FOR DISABLED","SINK IS BLOCKED","6","","32","1","64","","2","6","3","7","","","","110","2014-04-21 08:33:52","110","2014-04-24 12:53:47","","","","");
INSERT INTO complaint VALUES("1124","Maintenance-0000744","I-ROOM BED NO:4 AND J-ROOM BED NO:1","PATIENT CALLING BELL TO BE FIXED","8","","33","1","64","336","2","8","3","7","","","","110","2014-04-21 08:34:42","110","2014-04-24 12:53:21","","","","");
INSERT INTO complaint VALUES("1125","Maintenance-0000745","D room flush not working","D room flush not working","5","","24","1","64","337","2","5","3","7","","","","16","2014-04-21 08:46:35","16","2014-04-22 08:22:53","","","","");
INSERT INTO complaint VALUES("1126","MIS-0000381","Patient Name : Lily Roy
INSERT INTO complaint VALUES("1127","MIS-0000382","computer printer is not working ","kindly do the needful","2","","112","1","93","","1","2","3","7","","882","","79","2014-04-21 08:52:21","79","2014-04-24 09:07:47","","","","");
INSERT INTO complaint VALUES("1128","MIS-0000383","To install new photocopier machine in library","very urgent since university exams are starting tomorrow","2","","112","4","24","","1","2","3","7","","0","","153","2014-04-21 08:54:13","153","2014-04-21 12:28:48","","","","");
INSERT INTO complaint VALUES("1129","MIS-0000384","Paper is stack in the printer do the needful","urgent","2","","112","1","71","","1","2","3","5","","845","","72","2014-04-21 09:04:34","112","2014-04-21 09:25:29","","","","");
INSERT INTO complaint VALUES("1130","Maintenance-0000746","1.Wheel chair wheel need to check & repair.
INSERT INTO complaint VALUES("1131","Maintenance-0000747","NURSES BOARD TO BE FIXED ","VERY URGENT","9","","37","1","65","","2","9","3","7","","","","84","2014-04-21 09:18:10","84","2014-04-22 15:36:46","","","","");
INSERT INTO complaint VALUES("1132","Maintenance-0000748","gents toilet flesh not working","urgent","6","","31","1","47","106","2","6","3","5","","","","149","2014-04-21 09:19:26","31","2014-04-21 10:37:00","","","","");
INSERT INTO complaint VALUES("1133","MIS-0000385","system is hanging","system is hanging","3","","5","1","16","19","1","3","3","7","","","","132","2014-04-21 09:19:52","132","2014-05-06 14:48:28","","","","");
INSERT INTO complaint VALUES("1134","MIS-0000386","Please change the Keyboard and mouse as it is not working.","Urgent.
INSERT INTO complaint VALUES("1135","Maintenance-0000749","flush is leaking in nurses changing room","urgent","6","","32","1","54","","2","6","3","5","","","","73","2014-04-21 09:34:18","32","2014-04-25 14:10:24","","","","");
INSERT INTO complaint VALUES("1136","Maintenance-0000750","cupboard has been broken","urgent","9","","37","1","47","106","2","9","3","5","","","","149","2014-04-21 09:46:20","37","2014-04-21 16:53:13","","","","");
INSERT INTO complaint VALUES("1137","Maintenance-0000751","cupboard has been broaken","urgent","9","","37","1","47","105","2","9","3","5","","","","149","2014-04-21 09:51:55","37","2014-04-21 16:52:11","","","","");
INSERT INTO complaint VALUES("1138","MIS-0000387","BBH email ids are not working:
INSERT INTO complaint VALUES("1139","MIS-0000388","HRMS is not working in prs-07","Pls kindly Format the system and re-install the HRMS software","3","","5","1","30","","1","3","3","5","6","","windows reinsatllation","241","2014-04-21 10:29:17","5","2014-04-25 12:33:03","","","","");
INSERT INTO complaint VALUES("1140","Maintenance-0000752","Room No. M-7 not able to lock ","do the needful","9","","37","1","71","166","2","9","3","5","","","","72","2014-04-21 11:02:20","37","2014-04-21 16:52:45","","","","");
INSERT INTO complaint VALUES("1141","Maintenance-0000753","RO plant (Millipore ) water is leaking ","Urgent .........","6","","32","1","17","136","2","6","3","7","","","","69","2014-04-21 11:23:19","69","2014-04-23 14:11:02","","","","");
INSERT INTO complaint VALUES("1142","MIS-0000389","Mnt-01 computer network not working","Kindly do the needful at the earliest.","2","","112","1","2","","1","2","3","5","","0","","17","2014-04-21 11:52:08","112","2014-04-21 12:32:06","","","","");
INSERT INTO complaint VALUES("1143","MIS-0000390","QCI DL-Shah Award Certificate copy to be made","QCI DL-Shah Certificate copy to be framed and displayed ASAP","3","","8","1","94","37","1","3","3","7","","","","137","2014-04-21 11:53:38","137","2014-04-22 09:48:19","20140421124513_IMG_7980a.jpg#","","","");
INSERT INTO complaint VALUES("1144","Maintenance-0000754","DOCTORS ROOM","CUBOARD LOCK TO BE OPENED","9","","37","1","64","341","2","9","3","7","","","","110","2014-04-21 12:17:33","110","2014-04-23 11:11:42","","","","");
INSERT INTO complaint VALUES("1145","Maintenance-0000755","SWITCH BOARD PLUG PIN TO FIX","PLEASE DO THE NEEDFUL","5","","23","1","50","83","2","5","3","7","","","","181","2014-04-21 12:35:05","181","2014-04-22 13:55:29","","","","");
INSERT INTO complaint VALUES("1146","Maintenance-0000756","OT switch board is not working , switch board we are sending to maintenance ","do it soon","5","","24","1","58","","2","5","3","5","","","","124","2014-04-21 12:40:29","24","2014-04-21 16:47:00","","","","");
INSERT INTO complaint VALUES("1147","MIS-0000391","system is hanging","system is hanging","3","","5","1","16","19","1","3","3","7","","","","132","2014-04-21 12:44:36","132","2014-05-06 14:46:58","","","","");
INSERT INTO complaint VALUES("1148","MIS-0000392","need to recover file","not able to open a excel file","3","","8","1","94","","1","3","3","5","","","","136","2014-04-21 12:51:42","8","2014-04-21 13:32:55","","","","");
INSERT INTO complaint VALUES("1149","Maintenance-0000757","LAND LINE TELEPHONE NOT WORKING","LAND LINE TELEPHONE NOT WORKING","8","","34","1","44","58","2","8","3","7","","","","348","2014-04-21 13:33:23","348","2014-05-16 09:35:53","","","","");
INSERT INTO complaint VALUES("1150","Maintenance-0000758","bath room is not working in 3205,3296","piease do needful","5","","24","1","50","74","2","5","3","5","","","","125","2014-04-21 13:39:30","227","2014-04-21 13:43:47","","","","");
INSERT INTO complaint VALUES("1151","Maintenance-0000759","toilet bulb is not working in3205,3206","piease do the needful","5","","25","1","50","","2","5","3","5","","","","125","2014-04-21 13:41:09","25","2014-04-21 15:59:30","","","","");
INSERT INTO complaint VALUES("1152","MIS-0000393","pulmonolgy room printer is not working","please come ","2","","112","1","102","","1","2","3","5","","0","","246","2014-04-21 13:42:35","112","2014-04-21 14:27:49","","","","");
INSERT INTO complaint VALUES("1153","Maintenance-0000760","Ac not working. water leaking inside","Ac not working. water leaking inside","10","","26","1","38","219","2","10","3","7","","","","78","2014-04-21 14:08:28","78","2014-04-23 15:39:33","","","","");
INSERT INTO complaint VALUES("1154","Maintenance-0000761","canteen washing area taps are leaking","attend soon","6","","30","1","68","","2","6","3","7","","","","225","2014-04-21 14:14:21","225","2014-04-29 11:59:37","","","","");
INSERT INTO complaint VALUES("1155","Maintenance-0000762","need to fix 3m hand rub stand near all bed side in er & er annex.","need to fix 3m hand rub stand near all bed side in er & er annex.","9","","37","1","81","","2","9","3","5","","","","99","2014-04-21 14:23:04","37","2014-04-22 16:52:23","","","","");
INSERT INTO complaint VALUES("1156","MIS-0000394","Correction in PDT dental broucher.","Corrections done","3","","8","1","78","","1","3","3","5","","","","197","2014-04-21 14:38:38","8","2014-04-21 16:23:26","","","","");
INSERT INTO complaint VALUES("1157","MIS-0000395","system is con tunelessly hanging  ","do it soon ","2","","112","1","58","13","1","2","3","5","","885","","124","2014-04-21 15:03:18","112","2014-04-21 15:24:27","","","","");
INSERT INTO complaint VALUES("1158","MIS-0000396","Patient No. AA090745
INSERT INTO complaint VALUES("1159","MIS-0000397","ABL 800 flex interfacing problem","Urgent","3","","8","1","17","27","1","3","3","5","","","","257","2014-04-21 15:34:33","8","2014-04-21 16:33:46","","","","");
INSERT INTO complaint VALUES("1160","Maintenance-0000763","cots side rails to be fixed","urgent","7","","29","1","56","","2","7","3","5","","","","73","2014-04-21 15:41:40","29","2014-04-24 12:28:22","","","","");
INSERT INTO complaint VALUES("1161","Maintenance-0000764","Birthing room wall fan is not working","needs urgent","5","","23","1","59","","2","5","3","5","","","","116","2014-04-21 16:17:41","23","2014-04-21 16:47:53","","","","");
INSERT INTO complaint VALUES("1162","Maintenance-0000765","I will  send for  painting again 
INSERT INTO complaint VALUES("1163","Maintenance-0000766","ldpr cup board door mirror broken","needs urgent","9","","37","1","59","","2","9","3","5","","","","116","2014-04-22 08:19:59","37","2014-04-22 16:51:00","","","","");
INSERT INTO complaint VALUES("1164","Maintenance-0000767","patient  cots side rails to be fixed for  7cots.","Received by mail ","7","","27","1","60","289","2","7","3","3","6","","F-4 cot fixed & rest side rails missing hence New requirement & quotation to be taken by outsource ","16","2014-04-22 08:21:55","27","2014-06-05 15:29:28","","","","");
INSERT INTO complaint VALUES("1165","Maintenance-0000768","Tube light not working ","replace it soon","5","","23","1","78","","2","5","3","7","","","","16","2014-04-22 08:22:39","16","2014-04-22 14:27:59","","","","");
INSERT INTO complaint VALUES("1166","Maintenance-0000769","Pest o flash not working ","to be repaired soon","5","","23","1","68","96","2","5","3","7","","","","16","2014-04-22 08:27:14","16","2014-04-22 14:27:51","","","","");
INSERT INTO complaint VALUES("1167","Maintenance-0000770","There is a sink pipe breakage.","Pls rectify it at the earliest as it is emergency. There are cases at 9 a.m.","6","","32","1","52","62","2","6","1","7","","","","128","2014-04-22 08:30:06","128","2014-05-12 09:06:13","","","","");
INSERT INTO complaint VALUES("1168","Maintenance-0000771","Room no 1515 bathroom shower not working, even there is cold water flow..","please come and check immediately.","6","","31","1","49","235","2","6","3","5","","","","97","2014-04-22 08:56:00","31","2014-04-22 16:48:40","","","","");
INSERT INTO complaint VALUES("1169","Maintenance-0000772","room no 1512 suction tube and tip to be measured and fix , all rooms to be checked.","please do come ASAP","7","","27","1","49","233","2","7","3","5","4","","Suction hose no stock non stock raised  NS no:41 Dt:18/10/2013","97","2014-04-22 08:58:48","27","2014-04-29 12:20:01","","","","");
INSERT INTO complaint VALUES("1170","MIS-0000398","NURSES STATION - 1","MOUSE IS NOT WORKING LOOSE CONNECTION","2","","112","1","64","21","1","2","3","7","","0","","110","2014-04-22 09:06:14","110","2014-04-23 11:11:10","","","","");
INSERT INTO complaint VALUES("1171","MIS-0000399","system is very slow","system is very slow","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-22 09:09:08","132","2014-05-06 14:46:42","","","","");
INSERT INTO complaint VALUES("1172","MIS-0000400","My computer folder","which is in desktop not opening.","2","","112","1","17","32","1","2","3","7","","0","","113","2014-04-22 09:14:25","113","2014-04-25 11:16:09","","","","");
INSERT INTO complaint VALUES("1173","Maintenance-0000773","Autoclave machine pressure  gauze not working Started at 7.45am,pressure not yet come till 9.30am","VERY URGENT","7","","26","1","57","65","2","7","3","5","","","","83","2014-04-22 09:26:47","26","2014-04-22 16:40:28","","","","");
INSERT INTO complaint VALUES("1174","Maintenance-0000774","Cash counter no power supply ","to be checked ","5","","24","1","68","96","2","5","3","7","","","","16","2014-04-22 10:01:06","16","2014-04-28 14:14:47","","","","");
INSERT INTO complaint VALUES("1175","Maintenance-0000775","PA System is Not Working. ","Urgent ","8","","33","1","71","165","2","8","3","5","","","","72","2014-04-22 10:05:58","33","2014-04-22 16:55:24","","","","");
INSERT INTO complaint VALUES("1176","Maintenance-0000776","Height scale screw is come out to be replace ","Urgent ","9","","37","1","71","","2","9","3","5","","","","72","2014-04-22 10:08:19","37","2014-04-23 16:44:51","","","","");
INSERT INTO complaint VALUES("1177","Maintenance-0000777","AC not working. Water leaking.","AC not working. Water leaking","10","","26","1","18","216","2","10","3","7","","","","64","2014-04-22 10:20:25","64","2014-04-24 12:27:58","","","","");
INSERT INTO complaint VALUES("1178","MIS-0000401","Computer in ENT-1 not working","URGENT","2","","5","1","76","","1","2","3","5","","0","","206","2014-04-22 10:24:52","5","2014-04-22 10:53:38","","","","");
INSERT INTO complaint VALUES("1179","MIS-0000402","Computer in ENT-1 not working","URGENT","3","","5","1","76","","1","3","3","5","","","","206","2014-04-22 10:25:34","5","2014-04-22 10:54:26","","","","");
INSERT INTO complaint VALUES("1180","Maintenance-0000778","suction not working in B-3","to be checked immediately","7","","27","1","53","","2","7","3","5","","","","119","2014-04-22 10:31:13","27","2014-04-22 11:43:49","","","","");
INSERT INTO complaint VALUES("1181","Maintenance-0000779","room no 1510 Balkan frame to be fixed","fix ASAP","7","","27","1","49","231","2","7","3","5","","","","97","2014-04-22 10:45:01","27","2014-04-22 11:43:38","","","","");
INSERT INTO complaint VALUES("1182","Maintenance-0000780","cupboard door has broken in central OPD ladies toilet","urgent","9","","37","1","47","111","2","9","3","5","","","","149","2014-04-22 10:48:11","37","2014-04-22 16:50:43","","","","");
INSERT INTO complaint VALUES("1183","Maintenance-0000781","PATIENT TROLLEY SCREW IS BROKEN TO BE FIXED ","VERY URGENT ","7","","27","1","65","","2","7","3","7","","","","84","2014-04-22 10:53:25","84","2014-04-25 13:36:46","","","","");
INSERT INTO complaint VALUES("1184","Maintenance-0000782","Front Office door is not working properly
INSERT INTO complaint VALUES("1185","Maintenance-0000783","phone is not working in near M-5 Extension No.  350","urgent ","8","","33","1","71","","2","8","3","5","","","","72","2014-04-22 11:07:42","33","2014-04-22 16:55:59","","","","");
INSERT INTO complaint VALUES("1186","Maintenance-0000784","LAND LINE TELEPHONE NOT WORKING CLEARLY ","YESTERDAY ALSO INFORM","8","","33","1","44","58","2","8","3","7","","","","348","2014-04-22 11:07:52","348","2014-04-30 13:15:40","","","","");
INSERT INTO complaint VALUES("1187","Maintenance-0000785","WHEEL CHAIR FOOT STAND IS REMOVED TO BE FIXED ","VERY URGENT ","7","","27","1","65","","2","7","3","7","","","","84","2014-04-22 11:09:45","84","2014-04-25 13:38:09","","","","");
INSERT INTO complaint VALUES("1188","MIS-0000403","scan reports seems to be blur ","as soon as posible","2","","5","1","14","","1","2","3","5","","0","","70","2014-04-22 11:17:22","5","2014-04-22 11:39:21","","","","");
INSERT INTO complaint VALUES("1189","Maintenance-0000786","CEILING FAN TO BE FIXED IN C-8","AS EARLY AS POSSIBLE","5","","24","1","62","309","2","5","3","5","","","","106","2014-04-22 11:22:49","24","2014-04-22 16:38:38","","","","");
INSERT INTO complaint VALUES("1190","Maintenance-0000787","CALL BELL PANEL TO BE FIXED IN E-1","IT IS BROKEN","8","","33","1","62","311","2","8","3","5","","","","106","2014-04-22 11:24:46","33","2014-04-22 16:56:10","","","","");
INSERT INTO complaint VALUES("1191","MIS-0000404","system is slow","system is slow","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-22 11:35:52","132","2014-05-06 14:46:28","","","","");
INSERT INTO complaint VALUES("1192","Maintenance-0000788","Tube light has to be changed.","Please change the tube light.","5","","24","1","98","","2","5","3","5","","","","151","2014-04-22 12:04:17","24","2014-04-22 16:38:19","","","","");
INSERT INTO complaint VALUES("1193","MIS-0000405","key board is not working
INSERT INTO complaint VALUES("1194","Maintenance-0000789","cardiac table nut is broken","urgent","7","","27","1","60","","2","7","3","5","","","","103","2014-04-22 12:18:50","27","2014-04-29 12:20:13","","","","");
INSERT INTO complaint VALUES("1195","Maintenance-0000790","calling bell is not working ","need to be urgent","8","","33","1","60","281","2","8","3","5","","","","103","2014-04-22 12:19:39","33","2014-04-23 16:32:40","","","","");
INSERT INTO complaint VALUES("1196","Maintenance-0000791","deluxe room 3207 & 3208 AC not   working .
INSERT INTO complaint VALUES("1197","Maintenance-0000792","deluxe room 3211 ,3214 ,3212 TV NOT WORKING . ","KINDLY DO THE NEEDFUL AS SOON AS POSSIBLE. ","8","","33","1","50","","2","8","3","5","","","","126","2014-04-22 12:25:08","33","2014-04-22 16:56:33","","","","");
INSERT INTO complaint VALUES("1198","Maintenance-0000793","WATER LEAKING FROM SINK PIPE.","WATER LEAKING FROM SINK PIPE.","6","","31","1","81","","2","6","3","5","4","","Foot operated valve no stock non stock raised NS no: 32 Dt: 19/09/2013","99","2014-04-22 12:35:15","31","2014-05-05 08:59:27","","","","");
INSERT INTO complaint VALUES("1199","Maintenance-0000794","Medical Library standing fan is loose.","Medical Library standing fan is loose.","5","","23","1","25","","2","5","3","7","","","","152","2014-04-22 12:40:34","152","2014-04-23 12:59:06","","","","");
INSERT INTO complaint VALUES("1200","Maintenance-0000795","COMPUTER RACK","COMPUTER RACK TO BE FIXED.","9","","37","1","61","306","2","9","3","3","4","","Computer keyboard channel no stock non stock raised NS no:80 Dt:04/04/2014","104","2014-04-22 13:07:44","37","2014-04-22 16:50:11","","","","");
INSERT INTO complaint VALUES("1201","Maintenance-0000796","Two ceiling fans in library under repair","urgent","5","","23","4","107","","2","5","3","5","6","","fan winding to be done","153","2014-04-22 13:24:03","23","2014-06-09 09:04:00","","","","");
INSERT INTO complaint VALUES("1202","MIS-0000406","system is very slow","system is very slow","3","","6","1","16","18","1","3","3","7","","","","132","2014-04-22 13:30:29","132","2014-05-06 14:46:13","","","","");
INSERT INTO complaint VALUES("1203","Maintenance-0000797","o2 cylinder needed full","old one is not enough to shift a patient to CT","5","","23","1","53","","2","5","3","5","","","","119","2014-04-22 13:47:41","23","2014-04-22 16:39:06","","","","");
INSERT INTO complaint VALUES("1204","MIS-0000407","crp-08 system too slow & getting hanged very often,not able to send insurance bills for approval","high priority","3","","5","1","40","11","1","3","3","7","","","","313","2014-04-22 13:51:51","313","2014-04-30 08:32:59","","","","");
INSERT INTO complaint VALUES("1205","Maintenance-0000798","Refilling of liquid nitrogen in cryo can (25L)","Refilling of liquid nitrogen in cryo can (25L)","7","","26","1","51","261","2","7","3","5","","","","314","2014-04-22 13:54:34","26","2014-05-05 09:10:55","","","","");
INSERT INTO complaint VALUES("1206","MIS-0000408","Nurses Station ","All the systems are slow not able to open the Sage Accpac","3","","5","1","64","21","1","3","3","7","","","","110","2014-04-22 14:01:20","110","2014-04-23 11:10:41","","","","");
INSERT INTO complaint VALUES("1207","Maintenance-0000799","Coffee day phone not working","please rectify soon","8","","33","1","68","96","2","8","3","7","6","","Wiring to be done hence it will be delayed ","16","2014-04-22 14:27:41","16","2014-05-19 15:25:42","","","","");
INSERT INTO complaint VALUES("1208","Maintenance-0000800","3206 Exhaust fan not working","please rectify soon","5","","24","1","50","75","2","5","3","7","","","","16","2014-04-22 14:28:32","16","2014-04-28 14:14:37","","","","");
INSERT INTO complaint VALUES("1209","MIS-0000409","queue number is jumping ","queue number is jumping ","3","","6","1","16","35","1","3","3","7","","","","132","2014-04-22 14:52:33","132","2014-05-06 14:45:58","","","","");
INSERT INTO complaint VALUES("1210","MIS-0000410","Tally is not working, showing error","Urgent","3","","6","1","41","","1","3","3","5","6","","","63","2014-04-22 15:21:33","6","2014-04-29 16:16:12","","","","");
INSERT INTO complaint VALUES("1211","Maintenance-0000801","F1 FAN","NOT WORKING.","5","","24","1","61","","2","5","3","5","","","","104","2014-04-22 15:28:07","24","2014-05-05 09:20:45","","","","");
INSERT INTO complaint VALUES("1212","Maintenance-0000802","F ONE SUCTION APPARATES IS NOT WORKING","VERY URGENT","7","","27","1","65","353","2","7","3","5","","","","233","2014-04-22 15:31:52","27","2014-04-22 16:41:04","","","","");
INSERT INTO complaint VALUES("1213","Maintenance-0000803","\"E\" ROOM BATHROOM TOILET IS LEAKING, WASHER TO BE FIXED. WATER FLOW IS MORE.","VERY URGENT ","6","","31","1","63","","2","6","3","7","","","","87","2014-04-22 15:33:28","87","2014-04-28 16:27:48","","","","");
INSERT INTO complaint VALUES("1214","Maintenance-0000804","High risk labour room nurses calling bell switch board is broken","needs urgent","8","","33","1","59","","2","8","3","5","","","","116","2014-04-22 15:50:43","33","2014-04-22 16:57:26","","","","");
INSERT INTO complaint VALUES("1215","MIS-0000411","SYSTEM IS HANGING","SYSTEM IS HANGING","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-22 15:53:51","132","2014-05-06 14:45:00","","","","");
INSERT INTO complaint VALUES("1216","MIS-0000412","NURSES STATION","PRINTER IS NOT WORKING (EMERGENCY)","3","","5","1","64","","1","3","3","7","","","","110","2014-04-22 15:57:50","110","2014-04-23 11:09:42","","","","");
INSERT INTO complaint VALUES("1217","MIS-0000413","In er annex system is very slow & hanging , so kindly check it asap.","In er annex system is very slow & hanging , so kindly check it asap.","3","","5","1","81","","1","3","3","5","","","","99","2014-04-22 16:31:28","5","2014-04-22 16:34:35","","","","");
INSERT INTO complaint VALUES("1218","Maintenance-0000805","Pantry room sink to be repaired","22/04/2014.11:00pm","5","","22","1","50","","2","5","3","7","","","","225","2014-04-23 08:23:15","225","2014-04-29 11:59:03","","","","");
INSERT INTO complaint VALUES("1219","MIS-0000414","Savior attendance  - missing and Re verification report is showing error message ( permission denied)","kindly do the needful","3","","6","1","30","","1","3","3","5","","","","226","2014-04-23 09:02:06","6","2014-04-23 09:20:49","20140423090206_savior Miss punch error.bmp","","","");
INSERT INTO complaint VALUES("1220","Maintenance-0000806","deluxe room 3204 door makes more sound and shuts harshly.","kindly do the needful as soon as possible. ","9","","37","1","50","","2","9","3","5","","","","126","2014-04-23 09:13:57","37","2014-04-23 16:43:12","","","","");
INSERT INTO complaint VALUES("1221","Maintenance-0000807","deluxe room 3204 geyser is not working ","please kindly rectify for patient satisfaction . ","5","","23","1","50","","2","5","3","5","","","","126","2014-04-23 09:16:24","23","2014-04-23 10:38:04","","","","");
INSERT INTO complaint VALUES("1222","MIS-0000415","CRP-03  in HRMS for the new employees with Empl No. 05970 the leave are not updated. When checked with Xavier in his system the leaves are displayed","high priority","3","","6","1","40","12","1","3","3","7","","","","65","2014-04-23 09:47:47","65","2014-04-29 09:04:13","","","","");
INSERT INTO complaint VALUES("1223","MIS-0000416","system is very slow","system is very slow","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-23 09:51:27","132","2014-05-06 14:44:43","","","","");
INSERT INTO complaint VALUES("1224","Maintenance-0000808","One Tile broken in Nurses station","urgent","12","","386","1","63","","2","12","3","7","6","","tiles broken hence it will be delay","87","2014-04-23 10:27:15","87","2014-06-12 12:14:43","","","","");
INSERT INTO complaint VALUES("1225","Maintenance-0000809","High Risk labour room trolly mattress zip to be fixed","needs urgent","9","","37","1","59","","2","9","3","5","","","","116","2014-04-23 11:39:35","227","2014-04-23 12:12:18","","","","");
INSERT INTO complaint VALUES("1226","Maintenance-0000810","High dusting around the operation theater(OUTSIDE WINDOWS)","High priority","9","","37","1","58","","2","9","3","5","","","","122","2014-04-23 11:41:19","227","2014-04-23 12:12:52","","","","");
INSERT INTO complaint VALUES("1227","Maintenance-0000811","All the room PA System Mike is Problem check . Do the needful ","Its Urgent ","8","","33","1","71","","2","8","3","5","","","","72","2014-04-23 12:14:53","33","2014-04-23 16:32:23","","","","");
INSERT INTO complaint VALUES("1228","Maintenance-0000812","wall plywood its come out to be  stick in front of the M-6 ","Urgent ","9","","37","1","71","","2","9","3","4","6","","POP wall cannot repaired","72","2014-04-23 12:16:53","37","2014-05-06 09:50:51","","","","");
INSERT INTO complaint VALUES("1229","MIS-0000417","To design certificate for CME  ","Soft copy sent to Mr.Uday mail ID","3","","8","1","34","","1","3","3","7","","","","173","2014-04-23 12:31:47","173","2014-04-24 08:39:45","20140423123147_certificate.doc20140423153023_CME Certificate.pdf#20140423153023_CME Certificate.jpg#","","","");
INSERT INTO complaint VALUES("1230","Maintenance-0000813","Library Telephone is not working","Library Telephone is not working","8","","33","1","25","","2","8","3","7","","","","152","2014-04-23 13:01:47","152","2014-04-25 09:30:36","","","","");
INSERT INTO complaint VALUES("1231","MIS-0000418","No internet connection","Please do the needful as soon as possible.","3","","5","1","66","","1","3","3","5","","","","366","2014-04-23 13:07:58","5","2014-04-23 14:00:37","","","","");
INSERT INTO complaint VALUES("1232","MIS-0000419","System not working ","Urgent ","2","","5","1","17","29","1","2","3","5","","0","","69","2014-04-23 14:10:01","5","2014-04-23 14:26:39","","","","");
INSERT INTO complaint VALUES("1233","Maintenance-0000814","tube light to be replaced","tube light to be replaced","5","","23","1","16","177","2","5","3","7","","","","132","2014-04-23 14:13:00","132","2014-05-06 14:44:30","","","","");
INSERT INTO complaint VALUES("1234","MIS-0000420","printer is not working","printer is not working","2","","112","1","16","17","1","2","3","7","","0","","132","2014-04-23 14:16:41","132","2014-05-06 14:44:13","","","","");
INSERT INTO complaint VALUES("1235","MIS-0000421","Helen.G password is not printing","Helen.G password is not printing","3","","6","1","16","19","1","3","3","7","5","","Issue is not clear.","132","2014-04-23 14:17:28","132","2014-06-09 10:45:57","","","","");
INSERT INTO complaint VALUES("1236","Maintenance-0000815","6 chairs repair","6 chairs repair","9","","37","1","16","177","2","9","3","5","","","","132","2014-04-23 14:20:26","227","2014-06-05 12:44:39","","","","");
INSERT INTO complaint VALUES("1237","MIS-0000422","In system -01 it is unable to enter the general stores option in source location to take the consumption entry of monthly statement , as it is not possible in the ID of sis jackuline  & mrs. komala ","kindly do the needful  as soon as possible . 
INSERT INTO complaint VALUES("1238","Maintenance-0000816","2 fans not working at male chatram ","urgent","5","","23","1","47","","2","5","3","5","","","","149","2014-04-23 14:48:46","23","2014-04-23 16:34:46","","","","");
INSERT INTO complaint VALUES("1239","Maintenance-0000817","door handle broken in PC OPD gents toilet","urgent","9","","37","1","47","110","2","9","3","5","","","","149","2014-04-23 14:51:34","37","2014-04-24 09:49:57","","","","");
INSERT INTO complaint VALUES("1240","Maintenance-0000818","\"I\" room Bathroom flush water is flowing","urgent","6","","30","1","63","323","2","6","3","7","","","","87","2014-04-23 16:05:31","87","2014-04-28 16:28:21","","","","");
INSERT INTO complaint VALUES("1241","Maintenance-0000819","O2 cylinder to be replaced","22/04/2014","7","","28","1","53","","2","7","3","7","","","","225","2014-04-23 16:11:13","225","2014-04-29 11:58:21","","","","");
INSERT INTO complaint VALUES("1242","MIS-0000423","Canon Printer is not working","it is very urgent for the reports.","3","","5","1","17","25","1","3","3","5","","","","257","2014-04-23 17:37:28","5","2014-04-23 17:42:32","","","","");
INSERT INTO complaint VALUES("1243","Maintenance-0000820","suction is not working in B-10","to be checked immidiately","7","","29","1","53","","2","7","3","5","","","","119","2014-04-24 08:04:05","227","2014-04-24 08:07:48","","","","");
INSERT INTO complaint VALUES("1244","MIS-0000424","CRP-11 Printer -HP Laser Jet 1020 not working","high priority","2","","112","1","40","12","1","2","3","7","5","709","Have to inform in my office ","65","2014-04-24 08:08:12","65","2014-04-29 09:03:47","","","","");
INSERT INTO complaint VALUES("1245","Maintenance-0000821","in deluxe room 3206 bath room light is not working , its blinking , patient is uncomfortable.","kindly rectify as soon as possible for patient satisfaction ","5","","25","1","50","","2","5","3","5","","","","126","2014-04-24 08:08:14","25","2014-04-24 09:22:43","","","","");
INSERT INTO complaint VALUES("1246","MIS-0000425","system not started","system not started","2","","112","1","39","","1","2","3","5","","722","","349","2014-04-24 08:09:17","112","2014-04-24 08:12:20","","","","");
INSERT INTO complaint VALUES("1247","Maintenance-0000822","CRP-05 Keyboard tray (desk) broken","high priority","9","","37","1","40","63","2","9","2","7","","","","65","2014-04-24 08:10:54","65","2014-04-29 08:59:08","","","","");
INSERT INTO complaint VALUES("1248","Maintenance-0000823","Phone not working","Rectify Soon","8","","33","1","70","270","2","8","3","7","","","","16","2014-04-24 08:32:19","16","2014-04-28 14:14:26","","","","");
INSERT INTO complaint VALUES("1249","Maintenance-0000824","FAN NOT WORKING  ENT3","URGENT","5","","24","1","76","","2","5","3","5","","","","206","2014-04-24 08:36:52","24","2014-04-24 11:15:58","","","","");
INSERT INTO complaint VALUES("1250","Maintenance-0000825","wall mount fan is making sound while in use","needs to be rectified","5","","24","1","62","307","2","5","3","5","","","","106","2014-04-24 09:15:35","24","2014-04-24 11:15:08","","","","");
INSERT INTO complaint VALUES("1251","Maintenance-0000826","need one 100 ml of white paint & one 100 ml of black paint","to label our  ward equipments","9","","37","1","62","316","2","9","3","5","","","","106","2014-04-24 09:18:09","37","2014-04-25 17:02:28","","","","");
INSERT INTO complaint VALUES("1252","Maintenance-0000827","In Lab OPD  ladies toilet exhaust fan is not working.","Urgent","5","","24","1","17","","2","5","3","5","","","","257","2014-04-24 09:41:01","24","2014-04-24 11:14:56","","","","");
INSERT INTO complaint VALUES("1253","Maintenance-0000828","Revolving chair is not working.","Revolving chair is not working.","7","","29","1","39","","2","7","3","5","6","","Chair received today outsource person has to repair","349","2014-04-24 09:59:50","29","2014-05-05 09:12:27","","","","");
INSERT INTO complaint VALUES("1254","MIS-0000426","mouse not working","mouse not working","2","","5","1","49","","1","2","3","5","","0","","97","2014-04-24 10:15:24","5","2014-04-24 10:23:37","","","","");
INSERT INTO complaint VALUES("1255","Maintenance-0000829","Kent water purifier not working for the last 4 days","Please repair it immediately","6","","32","1","98","","2","6","3","7","6","","Company person has to service the machine","151","2014-04-24 10:33:24","16","2014-04-28 14:15:27","","","","");
INSERT INTO complaint VALUES("1256","Maintenance-0000830","MALE SIDE H-ROOM","WINDOW TO BE REPAIRED (EMERGENCY)","9","","37","1","64","335","2","9","3","7","","","","110","2014-04-24 10:38:18","16","2014-04-28 14:15:17","","","","");
INSERT INTO complaint VALUES("1257","Maintenance-0000831","PC Isolation nurses room no 1514 towel stand broken and in corridor nail has to be fixed.","please come immediately..","9","","37","1","49","242","2","9","3","7","","","","97","2014-04-24 10:49:58","16","2014-04-28 14:15:08","","","","");
INSERT INTO complaint VALUES("1258","Maintenance-0000832","room no 1517 bathroom flush not working","please do ASAP","6","","32","1","49","237","2","6","3","7","","","","97","2014-04-24 10:51:00","16","2014-04-28 14:14:15","","","","");
INSERT INTO complaint VALUES("1259","Maintenance-0000833","wheelchair","wheel broke& wheels very loose","7","","29","1","81","","2","7","3","7","","","","98","2014-04-24 10:53:09","16","2014-04-28 14:14:04","","","","");
INSERT INTO complaint VALUES("1260","Maintenance-0000834","High risk labour room  toilet sink water is leaking   &
INSERT INTO complaint VALUES("1261","Maintenance-0000835","flesh is not working in PC OPD gents toilet","urgent","6","","32","1","47","110","2","6","3","7","","","","149","2014-04-24 11:10:30","16","2014-04-28 14:13:47","20140424115546_2014-04-24 11.40.10.jpg#","","","");
INSERT INTO complaint VALUES("1262","MIS-0000427","hrms software is not working in opt-03","do it soon ","3","","6","1","58","13","1","3","3","5","","","","124","2014-04-24 11:19:43","6","2014-04-24 11:38:06","","","","");
INSERT INTO complaint VALUES("1263","MIS-0000428","PRINTER NOT WORKING
INSERT INTO complaint VALUES("1264","MIS-0000429","pediatric opd  room no. 5 room computer not working.
INSERT INTO complaint VALUES("1265","Maintenance-0000836","Calibration of the fridge thermometer to be done.","urgent","7","","26","1","54","","2","7","3","5","6","","Outsource to be done ","73","2014-04-24 11:33:04","26","2014-06-12 11:55:27","","","","");
INSERT INTO complaint VALUES("1266","Maintenance-0000837","calibration to be done for room temperature thermometer.","urgent","7","","26","1","54","","2","7","3","2","6","","Outsource to be done ","73","2014-04-24 11:37:13","26","2014-06-12 11:37:13","","","","");
INSERT INTO complaint VALUES("1267","Maintenance-0000838","small tubelight near b-7 not working","to be changed","5","","24","1","53","","2","5","3","7","","","","119","2014-04-24 11:41:35","16","2014-04-28 14:13:39","","","","");
INSERT INTO complaint VALUES("1268","MIS-0000430","RV Metropolis January and February  Folder ","Not Opening.","3","","5","1","17","32","1","3","3","7","","","","113","2014-04-24 11:51:31","113","2014-04-25 11:15:57","","","","");
INSERT INTO complaint VALUES("1269","MIS-0000431","RV Metropolis January and February Folder ","Is Not Opening ","3","","5","1","17","32","1","3","3","7","","","","113","2014-04-24 12:06:09","113","2014-04-25 11:15:44","","","","");
INSERT INTO complaint VALUES("1270","Maintenance-0000839","1. Locking system is not working in I floor staff toilet
INSERT INTO complaint VALUES("1271","Maintenance-0000840","Shifting of ceiling fan and tube light","Inter changing the location","5","","25","1","18","216","2","5","3","5","6","","Outsource to be done hence forwarded to Project Kumar ","64","2014-04-24 12:26:47","227","2014-06-10 15:21:23","","","","");
INSERT INTO complaint VALUES("1272","Maintenance-0000841","Overall internal painting of OP Pharmacy.","Walls, ceilings to be painted with excisting paint.
INSERT INTO complaint VALUES("1273","Maintenance-0000842","NURSES STATION","OXYGEN CYLINDER FLOW METER TO BE FIXED","7","","29","1","64","","2","7","3","7","","","","110","2014-04-24 12:42:06","16","2014-04-28 14:13:22","","","","");
INSERT INTO complaint VALUES("1274","Maintenance-0000843","\"E\" 1 calling bell is not working... ","very urgent","8","","33","1","65","352","2","8","3","7","","","","84","2014-04-24 13:23:10","84","2014-04-25 13:36:27","","","","");
INSERT INTO complaint VALUES("1275","MIS-0000432","system is hanging","system is hanging","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-24 13:44:42","132","2014-05-06 14:43:58","","","","");
INSERT INTO complaint VALUES("1276","Maintenance-0000844","Wall mounted wooden ledge","wooden ledge to be provided with existing material.","9","","37","1","18","216","2","9","3","5","6","","Its major work hence delayed ","64","2014-04-24 13:45:42","227","2014-06-05 12:45:12","","","","");
INSERT INTO complaint VALUES("1277","Maintenance-0000845","female chatrams toilet seat cover is broken","urgent","6","","32","1","47","118","2","6","3","7","","","","149","2014-04-24 14:43:22","16","2014-04-28 14:13:14","","","","");
INSERT INTO complaint VALUES("1278","Maintenance-0000846","WOODEN CHAIR","BROKEN","9","","37","1","81","","2","9","3","7","","","","98","2014-04-24 14:52:36","16","2014-04-28 14:13:04","","","","");
INSERT INTO complaint VALUES("1279","MIS-0000433","Patient Name : Lokesh
INSERT INTO complaint VALUES("1280","MIS-0000434","REQUESTING  FOR A STAND BY PRINTER","                        ","2","","5","1","92","","1","2","3","5","","0","","70","2014-04-24 15:30:59","5","2014-04-24 15:32:15","","","","");
INSERT INTO complaint VALUES("1281","MIS-0000435","system hanging","system hanging","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-24 15:55:02","132","2014-05-06 14:43:43","","","","");
INSERT INTO complaint VALUES("1282","Maintenance-0000847","ot-2  LNT cautery machine table switch board is not working ","do it as per as possible ","7","","28","1","58","190","2","7","3","7","","","","131","2014-04-24 16:05:01","16","2014-04-28 14:12:56","","","","");
INSERT INTO complaint VALUES("1283","Maintenance-0000848","1. Boiler Thermax 400kg.
INSERT INTO complaint VALUES("1284","Maintenance-0000849","OXYGEN CYLINDER IS EMPTY","VERY URGENT","6","","30","1","65","358","2","6","3","7","","","","233","2014-04-24 17:22:09","16","2014-04-28 14:12:46","","","","");
INSERT INTO complaint VALUES("1285","Maintenance-0000850","ROOM  LOCK TO BE FIXED","AS SOON AS POSSIBLE
INSERT INTO complaint VALUES("1286","Maintenance-0000851","3220- ROOM - TV  TO BE FIXED","THANK YOU.","8","","33","1","50","89","2","8","3","7","","","","125","2014-04-25 07:36:12","16","2014-04-28 14:12:29","","","","");
INSERT INTO complaint VALUES("1287","Maintenance-0000852","FAN not working EMERGENCY","Regulator not working","5","","25","1","81","","2","5","3","7","","","","98","2014-04-25 07:56:32","16","2014-04-28 14:12:09","","","","");
INSERT INTO complaint VALUES("1288","Maintenance-0000853","TAP LEAKING","BED NO 9-10 WATER LEAKING.","6","","32","1","81","","2","6","2","7","","","","98","2014-04-25 08:00:21","16","2014-04-28 14:12:02","","","","");
INSERT INTO complaint VALUES("1289","MIS-0000436","Sage accpac user id : RUTHE 
INSERT INTO complaint VALUES("1290","Maintenance-0000854","lab 2nd floor gents toilet flesh out water leaking.","urgent","6","","32","1","47","108","2","6","3","7","","","","149","2014-04-25 08:47:20","16","2014-04-28 14:11:54","","","","");
INSERT INTO complaint VALUES("1291","Maintenance-0000855","2305,3211-HOT WATER IS NOT COMING","PLS DO THE NEEDFUL","6","","32","1","50","80","2","6","3","7","","","","125","2014-04-25 08:48:16","16","2014-04-28 14:11:44","","","","");
INSERT INTO complaint VALUES("1292","MIS-0000437","accpac is not working in opt-03 ","do it as per has possible ","2","","112","1","58","13","1","2","3","5","","0","","124","2014-04-25 09:10:29","112","2014-04-25 11:16:11","","","","");
INSERT INTO complaint VALUES("1293","Maintenance-0000856","MALE SIDE TOILET ","TOILET ROOM HANDLE TO BE FIXED","9","","37","1","64","331","2","9","3","7","","","","110","2014-04-25 09:14:33","16","2014-04-28 14:11:36","","","","");
INSERT INTO complaint VALUES("1294","Maintenance-0000857","NURSES ROOM","SINK IS LEAKING ","6","","32","1","64","339","2","6","3","7","","","","110","2014-04-25 09:15:21","16","2014-04-28 14:11:28","","","","");
INSERT INTO complaint VALUES("1295","Maintenance-0000858","NOTICE BOARD IS BROKEN TO BE FIXED ","VEYR URGENT","9","","37","1","65","","2","9","3","7","","","","84","2014-04-25 09:15:32","16","2014-04-28 14:11:19","","","","");
INSERT INTO complaint VALUES("1296","Maintenance-0000859","suction is not working.","suction is not working.","7","","29","1","81","","2","7","3","7","","","","99","2014-04-25 09:22:39","16","2014-04-28 14:11:11","","","","");
INSERT INTO complaint VALUES("1297","MIS-0000438","Library System Net is not working","Library System Net is not working","2","","112","1","25","","1","2","3","7","","0","","152","2014-04-25 09:30:07","152","2014-05-12 10:19:54","","","","");
INSERT INTO complaint VALUES("1298","Maintenance-0000860","B-room side.","Tube light is not working.","5","","25","1","62","","2","5","3","7","","","","107","2014-04-25 09:37:51","16","2014-04-28 14:11:00","","","","");
INSERT INTO complaint VALUES("1299","Maintenance-0000861","corridor nail to be fixed ","please come ASAP","9","","37","1","49","242","2","9","3","7","","","","97","2014-04-25 09:43:21","16","2014-04-28 14:10:01","","","","");
INSERT INTO complaint VALUES("1300","Maintenance-0000862","room no 1512 bedside tube light  not working, room no 1518 bedside bulb not working","please come ASAP","5","","25","1","49","233","2","5","3","7","","","","97","2014-04-25 09:45:59","16","2014-04-28 14:09:53","","","","");
INSERT INTO complaint VALUES("1301","Maintenance-0000863","switch board is broken","need to be urgent","5","","25","1","60","277","2","5","3","7","","","","103","2014-04-25 10:05:11","16","2014-04-28 14:09:46","","","","");
INSERT INTO complaint VALUES("1302","Maintenance-0000864","Library system net is not working, but MIS informed that connection from CT Scan Room is not working. Please rectify the switch board.","Library system net is not working, but MIS informed that connection from CT Scan Room is not working. Please rectify the switch board.","5","","25","1","25","","2","5","3","7","","","","152","2014-04-25 10:07:57","16","2014-04-28 14:09:37","","","","");
INSERT INTO complaint VALUES("1303","Maintenance-0000865","cardiac table nut is broken  and patient cupboard nut is broken","need to be urgent","9","","37","1","60","277","2","9","3","7","","","","103","2014-04-25 10:09:34","16","2014-04-28 14:09:28","","","","");
INSERT INTO complaint VALUES("1304","MIS-0000439","PEADIATRIC OPD ROOM NO. 5 COMPUTER NOT WORKING .","URGENTLY DO THE NEEDFUL.
INSERT INTO complaint VALUES("1305","MIS-0000440"," COUNTER SYSTEM IS NOT SWITCHING ON","................","2","","112","1","104","","1","2","3","5","","0","","70","2014-04-25 10:35:36","112","2014-04-25 10:44:53","","","","");
INSERT INTO complaint VALUES("1306","MIS-0000441","PRINTER NOT WORKING","KINDLY DO THE NEEDFUL","2","","5","1","30","","1","2","3","5","","0","","226","2014-04-25 10:45:56","5","2014-04-25 11:00:55","","","","");
INSERT INTO complaint VALUES("1307","Maintenance-0000866","Room no 1506 pantry room near the exhaust fan water leaking, water flows towards corridor .","please come immediately","6","","32","1","49","227","2","6","3","7","","","","97","2014-04-25 11:10:23","16","2014-04-28 14:09:04","","","","");
INSERT INTO complaint VALUES("1308","MIS-0000442","Pt name mala bhargava hsp no ref000034430
INSERT INTO complaint VALUES("1309","Maintenance-0000867","bathroom light not burning","bathroom light not burning","5","","25","1","61","297","2","5","3","7","","","","104","2014-04-25 11:17:08","16","2014-04-28 14:08:54","","","","");
INSERT INTO complaint VALUES("1310","MIS-0000443","HRMS is not opening","HRMS is not opening","3","","6","1","39","","1","3","3","5","","","","349","2014-04-25 11:40:03","6","2014-04-25 11:49:31","","","","");
INSERT INTO complaint VALUES("1311","Maintenance-0000868","PATIENT ROOM CALL BELL  IS NOT WORKING","AS SOON AS POSIBLE","8","","33","1","50","81","2","8","2","7","","","","125","2014-04-25 11:54:06","16","2014-04-28 14:08:44","","","","");
INSERT INTO complaint VALUES("1312","Maintenance-0000869","Wooden Cupboard lock to be repair ","Wooden Cupboard lock to be repair ","9","","37","1","97","","2","9","3","7","","","","16","2014-04-25 11:57:33","16","2014-04-28 14:08:34","","","","");
INSERT INTO complaint VALUES("1313","MIS-0000444","Internet connection not available in Projects  MNT 02 system. Kindly do the needful","Please look in to it","3","","5","1","66","","1","3","3","5","","","","366","2014-04-25 12:07:12","5","2014-04-25 12:30:21","","","","");
INSERT INTO complaint VALUES("1314","MIS-0000445","HRMS is not working after restarting 
INSERT INTO complaint VALUES("1315","MIS-0000446","Mr. Uday is requested to make a video of the D.L. Shah Award function. Thank you.","Thank you.","3","","8","1","94","","1","3","3","7","","","","136","2014-04-25 12:23:00","136","2014-05-13 09:32:21","","","","");
INSERT INTO complaint VALUES("1316","Maintenance-0000870","Tube light [small ] not working","very urgent","5","","23","1","57","67","2","5","3","7","","","","83","2014-04-25 12:35:06","16","2014-04-28 14:06:41","","","","");
INSERT INTO complaint VALUES("1317","MIS-0000447","Printer not working","Printer not working","2","","5","1","115","","1","2","3","5","","698","","149","2014-04-25 12:43:43","5","2014-04-25 12:49:49","","","","");
INSERT INTO complaint VALUES("1318","MIS-0000448","er annex system(computer) not working properly, its hanging and very slow.","er annex system(computer) not working properly, its hanging and very slow.","3","","5","1","81","","1","3","3","5","","","","99","2014-04-25 13:02:35","5","2014-04-25 13:16:12","","","","");
INSERT INTO complaint VALUES("1319","MIS-0000449","Accpac is not opening ","In histopathology","3","","5","1","17","32","1","3","3","7","","","","113","2014-04-25 13:11:04","113","2014-04-28 17:56:56","","","","");
INSERT INTO complaint VALUES("1320","Maintenance-0000871","WING-6 ENTRANCE FEMALE GENERAL TOILET FLUSH IS NOT WORKING ","URGENT","6","","30","1","65","359","2","6","3","7","","","","84","2014-04-25 13:17:27","16","2014-04-28 14:06:31","","","","");
INSERT INTO complaint VALUES("1321","Maintenance-0000872","Sink blocked ","Complaint given to William when is gone to attend other complaint ","6","","30","1","64","343","2","6","3","7","","","","16","2014-04-25 14:12:36","16","2014-04-28 14:06:23","","","","");
INSERT INTO complaint VALUES("1322","Maintenance-0000873","3211 Water pipe broken ","pipe broken seen by plumber & raised a complaint ","6","","30","1","50","79","2","6","3","7","","","","16","2014-04-25 14:13:57","16","2014-04-28 14:06:14","","","","");
INSERT INTO complaint VALUES("1323","Maintenance-0000874","Patient trolly .","Side rad to be fixed.","7","","29","1","62","","2","7","3","5","6","","Welding to be done it will be delayed ","107","2014-04-25 14:38:48","29","2014-04-29 12:15:59","","","","");
INSERT INTO complaint VALUES("1324","Maintenance-0000875","commode seat [plastic] broken,flush broken","please come immedeatly","6","","30","1","49","229","2","6","3","7","","","","246","2014-04-25 14:45:29","16","2014-04-28 14:06:02","","","","");
INSERT INTO complaint VALUES("1325","MIS-0000450","In the system inside blinking ","Urgent ","2","","112","1","76","","1","2","3","5","","0","","72","2014-04-25 14:46:40","112","2014-04-25 14:57:42","","","","");
INSERT INTO complaint VALUES("1326","Maintenance-0000876","Tube light is not  working.","urgent","5","","23","1","57","67","2","5","3","7","","","","362","2014-04-25 14:59:20","16","2014-04-28 14:05:53","","","","");
INSERT INTO complaint VALUES("1327","MIS-0000451","video recording & DVD writing","Communication workshop for NABH assessors ","2","","8","1","26","","1","2","3","7","","0","","76","2014-04-25 15:26:43","76","2014-04-28 11:58:02","","","","");
INSERT INTO complaint VALUES("1328","Maintenance-0000877","Need to check peadiatric trolly sidedrill.its not fixing properly.","Need to check peadiatric trolly sidedrill.its not fixing properly.","7","","29","1","81","","2","7","3","7","6","","Welding to be done it will be delayed 
INSERT INTO complaint VALUES("1329","MIS-0000452","NURSES STATION 1","PRINTER IS NOT WORKING","2","","112","1","64","23","1","2","3","7","","0","","110","2014-04-25 15:51:11","110","2014-05-16 11:43:12","","","","");
INSERT INTO complaint VALUES("1330","MIS-0000453","CME certificate : to remove \"Dr\" in the third line. Only the first line should contain Dr.","thank you","3","","8","1","34","","1","3","3","7","","","","173","2014-04-26 08:20:02","173","2014-05-05 14:00:00","20140426091229_CME Certificate.pdf#20140426091229_CME Certificate.jpg#","","","");
INSERT INTO complaint VALUES("1331","Maintenance-0000878","AC not working & mobile charger burnt","AC not working & mobile charger burnt","5","","24","1","50","89","2","5","3","7","","","","16","2014-04-26 08:21:25","16","2014-04-28 14:05:23","","","","");
INSERT INTO complaint VALUES("1332","Maintenance-0000879","AC LEAK IN DR ","AS SOON AS POSSIBLE","10","","26","1","14","243","2","10","3","7","","","","70","2014-04-26 08:21:31","16","2014-04-28 14:05:13","","","","");
INSERT INTO complaint VALUES("1333","Maintenance-0000880","Door lock to be opened ","Door lock to be opened ","9","","37","1","90","","2","9","3","7","","","","16","2014-04-26 08:22:46","16","2014-04-28 14:05:04","","","","");
INSERT INTO complaint VALUES("1334","Maintenance-0000881","baby cradle ","wheel is broken","7","","29","1","60","","2","7","3","5","","","","103","2014-04-26 08:49:21","29","2014-04-29 12:16:26","","","","");
INSERT INTO complaint VALUES("1335","Maintenance-0000882","G Room switch board is broken","need to be urgent","5","","23","1","60","","2","5","3","7","","","","103","2014-04-26 08:50:55","16","2014-04-28 14:04:43","","","","");
INSERT INTO complaint VALUES("1336","MIS-0000454","pediatric O.P.D.  mail unable to read. ","kindly do the needful.","3","","5","1","79","","1","3","3","5","","","","216","2014-04-26 08:51:15","5","2014-04-26 09:15:52","","","","");
INSERT INTO complaint VALUES("1337","Maintenance-0000883","tube light not working ","tube light not working complaint raised by self ","5","","23","1","47","105","2","5","3","7","","","","16","2014-04-26 09:16:45","16","2014-04-28 14:04:35","","","","");
INSERT INTO complaint VALUES("1338","Maintenance-0000884","Qtrs Dr Naveen thomas house curtain rod to be fixed ","Complained by Asha thomas on telephone","9","","37","1","2","161","2","9","3","7","","","","16","2014-04-26 09:17:55","16","2014-04-28 14:03:03","","","","");
INSERT INTO complaint VALUES("1339","Maintenance-0000885","soup dish stand ","broken","9","","37","1","82","","2","9","3","7","","","","98","2014-04-26 09:21:28","16","2014-04-28 14:04:27","","","","");
INSERT INTO complaint VALUES("1340","Maintenance-0000886","In deluxe room 3212 call bell is not working from past three weeks , which is already  informed to Mr . M anohar ","Kindly do the needful as soon as possible for patient satisfaction ","8","","33","1","50","","2","8","3","5","6","","New Wiring to be done by Outsource person ","126","2014-04-26 09:29:16","33","2014-05-15 12:47:27","","","","");
INSERT INTO complaint VALUES("1341","Maintenance-0000887","A-1 Bed Side & Nurses station.","fan is not working.","5","","23","1","62","","2","5","3","7","","","","107","2014-04-26 09:31:03","107","2014-04-28 08:53:06","","","","");
INSERT INTO complaint VALUES("1342","Maintenance-0000888","MIS opposite corridor tube light not working","attend soon","5","","23","1","2","","2","5","3","7","","","","225","2014-04-26 09:44:58","16","2014-04-28 14:04:12","","","","");
INSERT INTO complaint VALUES("1343","MIS-0000455","Barcode is not working properly.
INSERT INTO complaint VALUES("1344","Maintenance-0000889","Washing Area for dISABLED","SINK IS BLOCKED","6","","32","1","63","","2","6","3","7","","","","110","2014-04-26 11:04:05","16","2014-04-28 08:48:50","","","","");
INSERT INTO complaint VALUES("1345","MIS-0000456","printer not working(billing)","printer not working(billing)","3","","5","1","42","","1","3","3","5","","","","118","2014-04-26 11:10:04","5","2014-04-26 11:16:54","","","","");
INSERT INTO complaint VALUES("1346","MIS-0000457","very slow ","very slow ","3","","5","1","16","19","1","3","3","7","","","","132","2014-04-26 11:17:29","132","2014-05-06 14:43:25","","","","");
INSERT INTO complaint VALUES("1347","MIS-0000458","urgent printer is not working","urgent printer is not working","2","","5","1","16","19","1","2","3","7","","0","","132","2014-04-26 11:19:38","132","2014-05-06 14:43:03","","","","");
INSERT INTO complaint VALUES("1348","MIS-0000459","There is an problem in entering data in Old HRMS for the Employee 04199 - Kalyani ","Superspeciality Contribution must be changed to ESI ","3","","6","1","30","","1","3","3","7","","","","148","2014-04-26 12:06:26","148","2014-04-29 15:10:10","","","","");
INSERT INTO complaint VALUES("1349","MIS-0000460","systems hanging","will increase waiting area","3","","5","1","18","7","1","3","3","7","","","","64","2014-04-26 12:54:16","64","2014-04-26 13:05:39","","","","");
INSERT INTO complaint VALUES("1350","MIS-0000461","Accpac is not opening","in histopathology","3","","5","1","17","32","1","3","3","7","","","","113","2014-04-26 12:57:50","113","2014-04-28 17:55:28","","","","");
INSERT INTO complaint VALUES("1351","Maintenance-0000890","PANTRY ROOM","SWITCH BOARD TO BE REPAIRED","5","","23","1","64","344","2","5","3","7","","","","110","2014-04-26 13:00:39","110","2014-05-16 11:42:54","","","","");
INSERT INTO complaint VALUES("1352","MIS-0000462","ip and op","slow and hanging","3","","5","1","18","","1","3","3","7","","","","64","2014-04-26 13:08:27","64","2014-04-29 10:48:46","","","","");
INSERT INTO complaint VALUES("1353","MIS-0000463","Printer is not working","Please repair it immeditely","2","","112","1","98","","1","2","3","5","","0","","151","2014-04-26 15:51:09","112","2014-04-28 09:35:39","","","","");
INSERT INTO complaint VALUES("1354","Maintenance-0000891","Toilet Hand flush is broken","Kindly do the needful","6","","31","1","93","","2","6","3","7","","","","79","2014-04-28 07:37:08","16","2014-04-28 14:04:02","","","","");
INSERT INTO complaint VALUES("1355","MIS-0000464","Barcode and printer is not printing. ","Urgent.","2","","112","1","17","25","1","2","3","5","","0","","257","2014-04-28 07:54:50","112","2014-04-28 09:33:01","","","","");
INSERT INTO complaint VALUES("1356","Maintenance-0000892","Smoke dectector is showing RED in colour.
INSERT INTO complaint VALUES("1357","Maintenance-0000893","Nebulizer not working","we have sent to bio medical.","7","","26","1","49","242","2","7","3","7","","","","97","2014-04-28 08:00:11","16","2014-04-28 08:48:36","","","","");
INSERT INTO complaint VALUES("1358","Maintenance-0000894","SPOT LIGHT NOT WORKING","VERY URGENT","5","","25","1","73","","2","5","3","5","","","","210","2014-04-28 08:13:19","25","2014-04-28 16:16:07","","","","");
INSERT INTO complaint VALUES("1359","Maintenance-0000895","R-1519 bathroom bulb to be changed","attend soon","5","","24","1","49","","2","5","3","7","","","","225","2014-04-28 08:22:34","16","2014-04-28 08:48:25","","","","");
INSERT INTO complaint VALUES("1360","Maintenance-0000896","O2 cylinder to be filled","attend soon","5","","24","1","52","","2","5","3","7","","","","225","2014-04-28 08:23:36","16","2014-04-28 08:48:13","","","","");
INSERT INTO complaint VALUES("1361","Maintenance-0000897","O2 cylinder to be filled","attend soon","5","","24","1","54","","2","5","3","7","","","","225","2014-04-28 08:24:19","16","2014-04-28 08:47:52","","","","");
INSERT INTO complaint VALUES("1362","Maintenance-0000898","Tube light not working at ortho opd corridor","needs  replacement","5","","23","1","89","","2","5","3","5","","","","150","2014-04-28 08:25:17","23","2014-04-28 16:10:38","","","","");
INSERT INTO complaint VALUES("1363","Maintenance-0000899","security ramp side 2nos light not working","attend soon","7","","28","1","2","","2","7","3","7","","","","225","2014-04-28 08:29:43","16","2014-04-28 08:47:38","","","","");
INSERT INTO complaint VALUES("1364","Maintenance-0000900","Nurses station rest room bulb not working","attend soon","7","","28","1","61","","2","7","3","7","","","","225","2014-04-28 08:31:53","16","2014-04-28 08:47:18","","","","");
INSERT INTO complaint VALUES("1365","MIS-0000465","Userid: RUTHE, I am not able to authorize any indents as its showing an error. Please rectify.
INSERT INTO complaint VALUES("1366","Maintenance-0000901","Tube light not working ","Tube light not working informed by GR Sagar","5","","25","1","17","153","2","5","3","7","","","","16","2014-04-28 08:46:53","16","2014-04-29 11:12:07","","","","");
INSERT INTO complaint VALUES("1367","Maintenance-0000902","Sound Amplifier wire to be fixed","Sound Amplifier wire to be fixed","8","","33","1","78","","2","8","3","7","","","","261","2014-04-28 08:50:09","16","2014-04-28 14:03:52","","","","");
INSERT INTO complaint VALUES("1368","Maintenance-0000903","F- room","Sink tap top cap to be fixed.","6","","30","1","61","","2","6","3","7","","","","107","2014-04-28 08:58:33","16","2014-04-28 14:03:44","","","","");
INSERT INTO complaint VALUES("1369","Maintenance-0000904","B-ROOM","TAP TO B REPAIRED","6","","30","1","64","","2","6","3","7","","","","110","2014-04-28 08:58:42","16","2014-04-28 14:03:36","","","","");
INSERT INTO complaint VALUES("1370","Maintenance-0000905","C-room ","Calling bell is broken.","8","","33","1","61","","2","8","3","7","","","","107","2014-04-28 08:59:42","16","2014-04-28 14:03:28","","","","");
INSERT INTO complaint VALUES("1371","Maintenance-0000906","A-7 bed side.Locker wooden  board to be fixed.","E- room side one syn age board to be fixed. ","9","","37","1","61","","2","9","3","5","","","","107","2014-04-28 09:01:52","37","2014-04-28 16:21:41","","","","");
INSERT INTO complaint VALUES("1372","Maintenance-0000907","water leakage in duct near  nursing station (duct -04)","kindly rectify as soon as possible.","6","","30","1","50","","2","6","3","7","","","","126","2014-04-28 09:30:54","16","2014-04-28 14:03:21","","","","");
INSERT INTO complaint VALUES("1373","Maintenance-0000908","pt attender stool to be repaint. 5 nos with push to be fix,and food stool.2nos to be repaint with push. ","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-04-28 10:18:43","87","2014-04-30 11:03:19","","","","");
INSERT INTO complaint VALUES("1374","MIS-0000466","unable to save returns bill","Please check this in Mrs Suneetha\' s id","3","","6","1","18","","1","3","3","7","","","","64","2014-04-28 10:19:13","64","2014-05-05 11:50:49","","","","");
INSERT INTO complaint VALUES("1375","MIS-0000467","monitor not switching on","last counter to take returns","2","","112","1","18","7","1","2","3","7","","0","","64","2014-04-28 10:21:08","64","2014-04-28 11:49:40","","","","");
INSERT INTO complaint VALUES("1376","MIS-0000468","please reopen Suneetha pharmacist ID","Transferred from DEVANAHALLI","3","","6","1","18","7","1","3","3","7","","","","64","2014-04-28 10:22:19","64","2014-04-28 11:48:17","","","","");
INSERT INTO complaint VALUES("1377","Maintenance-0000909","patient shifting trolley side rails are not proper its very tight to pull","we are sending the trolley to maintenance please do ASAP.","7","","28","1","49","242","2","7","3","5","","","","97","2014-04-28 10:26:07","28","2014-04-30 16:06:33","","","","");
INSERT INTO complaint VALUES("1378","MIS-0000469","sysem hanging","sysem hanging","3","","5","1","16","19","1","3","3","7","6","","checking","132","2014-04-28 10:27:48","132","2014-05-06 14:42:33","","","","");
INSERT INTO complaint VALUES("1379","MIS-0000470","1. Syestem no MNT  - 02 & MNT - 03 not able to receive intra mail & also problem in internet connection since saturday (26-04-2014).
INSERT INTO complaint VALUES("1380","Maintenance-0000910","mike not working {room no. p2}","kindly do the needful.","8","","33","1","79","","2","8","3","5","","","","216","2014-04-28 11:00:46","33","2014-04-28 16:28:09","","","","");
INSERT INTO complaint VALUES("1381","Maintenance-0000911","Suction not working","Complained by duty sis on call","7","","28","1","75","","2","7","3","7","","","","16","2014-04-28 11:06:59","16","2014-04-29 11:11:59","","","","");
INSERT INTO complaint VALUES("1382","Maintenance-0000912","Qtrs Dr Alex House cupboard screw to be fixed ","complained by servant ","9","","37","1","2","161","2","9","3","7","","","","16","2014-04-28 11:17:07","16","2014-04-29 11:11:52","","","","");
INSERT INTO complaint VALUES("1383","MIS-0000471","NURSING STATION","MOUSE IS NOT WORKING LOOSE CONNECTION","3","","5","1","64","","1","3","3","7","6","","mouse not working","110","2014-04-28 11:20:18","110","2014-05-16 11:42:15","","","","");
INSERT INTO complaint VALUES("1384","Maintenance-0000913","TOILET BLOCK","VERY URGENT","6","","31","1","73","102","2","6","3","7","","","","210","2014-04-28 11:35:20","16","2014-04-28 14:03:12","","","","");
INSERT INTO complaint VALUES("1385","Maintenance-0000914","Improper water flow from the tap in the Airel chair dental cubicle","Kindly attend at the earliest","6","","31","1","78","","2","6","3","5","6","","Major work Outsource to be done ","261","2014-04-28 11:42:39","31","2014-06-05 15:35:12","","","","");
INSERT INTO complaint VALUES("1386","MIS-0000472","PHM -06 monitor to be set.","PHM -06 monitor to be set.","2","","112","1","18","7","1","2","3","7","","803","","64","2014-04-28 11:46:25","64","2014-04-29 10:47:11","","","","");
INSERT INTO complaint VALUES("1387","MIS-0000473","Patient name: Sushantadhar, MRD no: 553752 
INSERT INTO complaint VALUES("1388","MIS-0000474","Patient name: Sashikala, Mrd no.aa040718
INSERT INTO complaint VALUES("1389","MIS-0000475","lx300+ - ","need to install  new printer in medical records ","2","","5","1","16","19","1","2","3","5","6","0","                     ","129","2014-04-28 12:06:41","5","2014-04-28 16:26:01","","","","");
INSERT INTO complaint VALUES("1390","Maintenance-0000915","TEMPERATURE IS LESS","TEMPERATURE IS LESS","10","","26","1","52","61","2","10","3","5","","","","156","2014-04-28 12:09:04","26","2014-04-28 16:26:38","","","","");
INSERT INTO complaint VALUES("1391","Maintenance-0000916","-HDU ,room \'A\' door handle screw has come out to be fixed.
INSERT INTO complaint VALUES("1392","Maintenance-0000917","switch board is broken","need to be urgent","5","","25","1","60","281","2","5","3","5","1","","3M plate no stock non stock to be raised","103","2014-04-28 12:29:24","227","2014-06-11 08:43:18","","","","");
INSERT INTO complaint VALUES("1393","Maintenance-0000918","REST ROOM COMMODE IS BROKEN ","URGENT","6","","31","1","60","277","2","6","3","5","","","","103","2014-04-28 12:39:58","31","2014-04-28 15:39:09","","","","");
INSERT INTO complaint VALUES("1394","MIS-0000476","mouse not working.","mouse not working.","2","","112","1","81","","1","2","3","5","","914","","99","2014-04-28 12:50:12","112","2014-04-28 13:00:55","","","","");
INSERT INTO complaint VALUES("1395","Maintenance-0000919","AQUAGUARD   SWITCH IS BROKEN","NEED TO BE URGENT","5","","25","1","60","285","2","5","3","5","6","","Out source work Informed to company","103","2014-04-28 12:58:03","227","2014-05-14 08:47:15","","","","");
INSERT INTO complaint VALUES("1396","Maintenance-0000920","light not working.","urgent","5","","25","1","47","108","2","5","3","5","","","","149","2014-04-28 13:12:02","25","2014-04-28 16:13:16","","","","");
INSERT INTO complaint VALUES("1397","Maintenance-0000921","In Bio-medical waste room light and fan not working ","urgent","5","","25","1","47","","2","5","3","5","","","","149","2014-04-28 13:15:28","25","2014-04-28 16:12:41","","","","");
INSERT INTO complaint VALUES("1398","Maintenance-0000922","no cooling is present in the ot","to be checked","10","","26","1","58","191","2","10","3","5","","","","130","2014-04-28 13:59:52","26","2014-04-28 16:26:24","","","","");
INSERT INTO complaint VALUES("1399","Maintenance-0000923","Computers not working","Computers not working","7","","27","4","107","","2","7","3","7","","","","16","2014-04-28 14:02:54","16","2014-04-29 11:11:41","","","","");
INSERT INTO complaint VALUES("1400","Maintenance-0000924","fan regulater is not working properly to be changed","make it fast","5","","25","1","60","278","2","5","3","5","","","","264","2014-04-28 14:43:34","25","2014-04-28 16:11:42","","","","");
INSERT INTO complaint VALUES("1401","Maintenance-0000925","LDPR - FLUSH OUT IS BLOCKED","NEEDS URGENT","6","","31","1","59","","2","6","3","5","","","","116","2014-04-28 14:50:27","31","2014-04-28 15:38:48","","","","");
INSERT INTO complaint VALUES("1402","Maintenance-0000926","deluxe  lobby  TV is not working","attenders all  are complaining please do the needful ","8","","34","1","50","","2","8","3","5","","","","125","2014-04-28 14:57:38","34","2014-04-28 16:24:25","","","","");
INSERT INTO complaint VALUES("1403","Maintenance-0000927","room A bed -2 and door side switch board screw coming out and room G toilet mirror tub light is not working to check.","as soon as possible.","5","","22","1","63","","2","5","3","7","","","","87","2014-04-28 16:31:13","87","2014-04-30 11:04:05","","","","");
INSERT INTO complaint VALUES("1404","Maintenance-0000928","steam machine is not working to be check.","as soon as possible.","7","","29","1","63","","2","7","3","7","","","","87","2014-04-28 16:32:05","87","2014-04-30 11:06:24","","","","");
INSERT INTO complaint VALUES("1405","Maintenance-0000929","class room Bathroom  water black to be  check. ","as soon as possible.","6","","32","1","63","","2","6","3","7","","","","87","2014-04-28 16:35:41","87","2014-04-30 11:04:28","","","","");
INSERT INTO complaint VALUES("1406","Maintenance-0000930","kindly look this patients complaining of room ‘J’ toilet door making some noise kindly rectify the problem. ","as soon as possible.","9","","37","1","63","","2","9","3","3","9","","cannot be repair outsource to be done ","87","2014-04-28 16:39:45","227","2014-06-19 11:09:42","","","","");
INSERT INTO complaint VALUES("1407","MIS-0000477","Internet not available from 5am.","Need Help ASAP from MIS","3","","6","1","91","","1","3","3","5","","","","364","2014-04-29 08:13:22","6","2014-04-29 08:18:50","","","","");
INSERT INTO complaint VALUES("1408","Maintenance-0000931","Serology fridge not working from night .","Urgent .......","7","","26","1","17","137","2","7","3","5","","","","69","2014-04-29 08:25:06","26","2014-04-29 16:19:29","","","","");
INSERT INTO complaint VALUES("1409","MIS-0000478","mails not working ","as soon as possible ","3","","6","1","29","","1","3","3","5","","","","356","2014-04-29 08:38:33","6","2014-04-29 08:56:47","","","","");
INSERT INTO complaint VALUES("1410","MIS-0000479","System Name Bus 06, ","G/L transaction not opening","3","","6","1","41","","1","3","3","5","","","","361","2014-04-29 08:41:43","6","2014-05-17 08:57:11","","","","");
INSERT INTO complaint VALUES("1411","Maintenance-0000932","canteen light not working","attend soon","5","","22","1","68","","2","5","3","7","","","","225","2014-04-29 08:43:36","225","2014-04-29 11:58:03","","","","");
INSERT INTO complaint VALUES("1412","Maintenance-0000933","O2 cylinder to be filled","attend soon","5","","24","1","63","","2","5","3","7","","","","225","2014-04-29 08:44:20","225","2014-04-29 11:57:41","","","","");
INSERT INTO complaint VALUES("1413","Maintenance-0000934","O2 cylinder isempty","attend soon","5","","24","1","64","","2","5","3","7","","","","225","2014-04-29 08:45:19","225","2014-04-29 11:57:18","","","","");
INSERT INTO complaint VALUES("1414","Maintenance-0000935","HDU E-1","SIDE RAILS TO BE REPAIRED","7","","29","1","64","","2","7","3","7","","","","110","2014-04-29 08:45:46","110","2014-05-16 11:41:49","","","","");
INSERT INTO complaint VALUES("1415","Maintenance-0000936","A-ROOM BED NO:1","PATIENT CALLING BELL IS NOT WORKING","8","","34","1","64","","2","8","3","7","","","","110","2014-04-29 08:46:18","110","2014-05-16 11:41:30","","","","");
INSERT INTO complaint VALUES("1416","MIS-0000480","my system is not coming on, send your person immediately","my system is not coming on, send your person immediately","2","","112","1","25","","1","2","3","7","","0","","152","2014-04-29 08:51:16","152","2014-05-01 08:48:56","","","","");
INSERT INTO complaint VALUES("1417","Maintenance-0000937","UPS NOT WORKING .","URGENT
INSERT INTO complaint VALUES("1418","MIS-0000481","CRP-03 outlook is not working 
INSERT INTO complaint VALUES("1419","Maintenance-0000938","chair wheel repair","chair wheel repair","7","","29","1","41","54","2","7","3","5","","","","361","2014-04-29 09:02:11","29","2014-05-01 11:01:29","","","","");
INSERT INTO complaint VALUES("1420","Maintenance-0000939","D-4 bed side.","Tube light is not working.","5","","23","1","62","","2","5","3","5","","","","107","2014-04-29 09:14:04","23","2014-04-29 16:17:53","","","","");
INSERT INTO complaint VALUES("1421","MIS-0000482","Accpac application is not working in wing 4 System no IPB03 please check & do the needful. 
INSERT INTO complaint VALUES("1422","MIS-0000483","system haniging","system haniging","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-29 09:40:30","132","2014-05-06 14:39:14","","","","");
INSERT INTO complaint VALUES("1423","Maintenance-0000940","room no 1518, 1517, 1512, 1509 doors are noisy while opening and not able to lock properly. all rooms doors are also to be checked.","please do the needful...","9","","37","1","49","238","2","9","3","5","","","","97","2014-04-29 09:59:58","37","2014-04-29 16:26:17","","","","");
INSERT INTO complaint VALUES("1424","Maintenance-0000941","shower not working no flow of water.","please do ASAP","6","","31","1","49","238","2","6","3","5","","","","97","2014-04-29 10:04:13","31","2014-04-29 16:16:12","","","","");
INSERT INTO complaint VALUES("1425","Maintenance-0000942","sink is blocked","need to be urgent","6","","30","1","60","","2","6","3","5","","","","103","2014-04-29 10:05:15","30","2014-04-29 12:23:12","","","","");
INSERT INTO complaint VALUES("1426","Maintenance-0000943","sink is blocked","urgent","6","","30","1","60","278","2","6","3","5","","","","103","2014-04-29 10:09:33","30","2014-04-29 12:23:40","","","","");
INSERT INTO complaint VALUES("1427","Maintenance-0000944","computer key board stand to be repair","computer key board stand to be repair","9","","37","1","42","133","2","9","3","5","","","","118","2014-04-29 10:21:50","37","2014-04-29 16:25:29","","","","");
INSERT INTO complaint VALUES("1428","Maintenance-0000945","Wall suction is not working","urgent","7","","27","1","54","","2","7","3","5","","","","73","2014-04-29 10:22:19","27","2014-04-29 12:13:54","","","","");
INSERT INTO complaint VALUES("1429","MIS-0000484","One Mouse required","will be replaced once the non- stock is recd.","2","","5","1","18","7","1","2","3","7","","0","","64","2014-04-29 10:23:03","64","2014-04-29 13:58:36","","","","");
INSERT INTO complaint VALUES("1430","Maintenance-0000946","Qtrs M-5 ( Dr Joel )Carpentry work to be done ","Qtrs M-5 ( Dr Joel )Carpentry work to be done ","9","","37","3","2","161","2","9","3","7","","","","16","2014-04-29 10:23:07","16","2014-05-10 08:54:31","","","","");
INSERT INTO complaint VALUES("1431","Maintenance-0000947","Qtrs M-5 ( Dr Joel )Plumbing work to be done ","Qtrs M-5 ( Dr Joel )Plumbing work to be done ","6","","31","3","2","161","2","6","3","7","","","","16","2014-04-29 10:23:45","16","2014-05-10 08:54:23","","","","");
INSERT INTO complaint VALUES("1432","MIS-0000485","ipb -09 accpac not working","ipb -09 accpac not working","3","","5","1","42","","1","3","3","5","","","","118","2014-04-29 10:25:20","5","2014-04-29 10:30:17","","","","");
INSERT INTO complaint VALUES("1433","Maintenance-0000948","AC IS NOT WORKING IN CARDIAC OPD.KINDLY DO THE NEEDFULL","AC IS NOT WORKING IN CARDIAC OPD.KINDLY DO THE NEEDFULL","10","","26","1","52","61","2","10","3","5","","","","156","2014-04-29 10:27:11","26","2014-04-29 16:19:10","","","","");
INSERT INTO complaint VALUES("1434","Maintenance-0000949","The chairs are loosened ","Kindly to the needful asap.","7","","29","1","102","","2","7","3","5","","","","96","2014-04-29 10:46:31","29","2014-06-09 07:57:59","","","","");
INSERT INTO complaint VALUES("1435","MIS-0000486","MALE SIDE","SAGE ACCPAC IS NOT OPENING","3","","5","1","64","","1","3","3","7","","","","110","2014-04-29 11:00:30","110","2014-05-16 11:41:12","","","","");
INSERT INTO complaint VALUES("1436","MIS-0000487","NURSES STATION","LAB REPORTS ARE NOT APPEARING","3","","6","1","64","","1","3","3","5","5","","Kindly provide MRD NO of the patients whose report is not able to view in the accpac","110","2014-04-29 11:01:07","6","2014-05-01 08:17:57","","","","");
INSERT INTO complaint VALUES("1437","Maintenance-0000950","Qtrs C-1 Sis Floora house bathroom blocked ","Qtrs C-1 Sis Floora house bathroom blocked ","6","","31","3","2","161","2","6","3","7","","","","16","2014-04-29 11:10:23","16","2014-04-29 13:06:28","","","","");
INSERT INTO complaint VALUES("1438","Maintenance-0000951","Qtrs C-1 Sis Floora house fan not working","Qtrs C-1 Sis Floora house fan not working","5","","23","3","2","161","2","5","3","7","","","","16","2014-04-29 11:10:47","16","2014-05-10 08:54:15","","","","");
INSERT INTO complaint VALUES("1439","Maintenance-0000952","Qtrs C-1 Sis Floora house phone not working","Qtrs C-1 Sis Floora house phone not working","8","","34","3","2","161","2","8","3","7","","","","16","2014-04-29 11:11:07","16","2014-05-10 08:54:03","","","","");
INSERT INTO complaint VALUES("1440","Maintenance-0000953","Height scale to be fixed in  chemotherapy unit  "," Kindly to the needful.","9","","37","1","93","","2","9","3","7","","","","79","2014-04-29 11:15:59","79","2014-05-02 08:06:23","","","","");
INSERT INTO complaint VALUES("1441","MIS-0000488","system , s getting slow","system , s getting slow","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-29 11:22:25","132","2014-05-06 14:38:55","","","","");
INSERT INTO complaint VALUES("1442","MIS-0000489","first system not working","urgent since university exams going on","3","","112","4","24","","1","3","3","7","","","","153","2014-04-29 11:27:40","153","2014-05-01 14:22:48","","","","");
INSERT INTO complaint VALUES("1443","MIS-0000490","hrms software is not working (opt-03)","do as per as possible ","3","","6","1","58","13","1","3","3","5","","","","124","2014-04-29 11:30:45","6","2014-04-29 11:48:09","","","","");
INSERT INTO complaint VALUES("1444","MIS-0000491","system,s hanging","system,s hanging","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-29 11:33:00","132","2014-05-06 14:38:28","","","","");
INSERT INTO complaint VALUES("1445","Maintenance-0000954","Gas cylinder regulator to be fixed","complaint given by Guest house cook","7","","29","3","113","","2","7","3","7","","","","16","2014-04-29 11:33:39","16","2014-04-29 13:06:14","","","","");
INSERT INTO complaint VALUES("1446","MIS-0000492","all opd system ,s hanging","all opd system ,s hanging","3","","6","1","16","19","1","3","3","7","","","","132","2014-04-29 11:34:09","132","2014-05-06 14:38:07","","","","");
INSERT INTO complaint VALUES("1447","Maintenance-0000955","Fan&Tube light is not working ROOM NO.M- 2","Very urgent","5","","25","1","71","","2","5","3","5","","","","204","2014-04-29 11:40:48","25","2014-04-29 16:22:01","","","","");
INSERT INTO complaint VALUES("1448","MIS-0000493","accpac is not working its contunelessly hanging ","so it soon","3","","5","1","58","13","1","3","3","5","","","","124","2014-04-29 11:53:10","5","2014-04-29 12:18:24","","","","");
INSERT INTO complaint VALUES("1449","MIS-0000494","crp-02 system is too slow and hanging for almost 1/2 hr and not able to send for insurance approvals","High priority","3","","5","1","40","","1","3","3","7","","","","313","2014-04-29 12:36:47","313","2014-04-30 08:31:21","","","","");
INSERT INTO complaint VALUES("1450","MIS-0000495","Mouse Right click ","Is not working","2","","5","1","17","32","1","2","3","7","","0","","113","2014-04-29 12:39:57","113","2014-05-03 16:48:23","","","","");
INSERT INTO complaint VALUES("1451","Maintenance-0000956","MALE GENERAL TOILET FLUSH WATER IS FLOWING CONTINOUSLY ","VERY URGENT","6","","32","1","65","357","2","6","3","7","","","","84","2014-04-29 12:55:58","84","2014-05-09 09:41:09","","","","");
INSERT INTO complaint VALUES("1452","MIS-0000496","user ID SUNEETH . Not  able to save bill / returns","Not able to save bill / returns.","3","","6","1","18","7","1","3","3","7","","","","64","2014-04-29 13:57:31","64","2014-05-05 11:50:26","","","","");
INSERT INTO complaint VALUES("1453","Maintenance-0000957","AC WINDOWS HAS TO FIXED PROPERLY ","DO IT AS PER AS POSSIBLE ","9","","37","1","58","194","2","9","3","5","6","","Wooden beading to purchased from outside ","124","2014-04-29 14:06:08","227","2014-06-05 12:45:28","","","","");
INSERT INTO complaint VALUES("1454","Maintenance-0000958","suction machine is not working","suction machine is not working","7","","29","1","58","193","2","7","3","5","6","","Outsource to be done ","131","2014-04-29 14:30:11","29","2014-06-09 07:56:46","","","","");
INSERT INTO complaint VALUES("1455","Maintenance-0000959","2 foot stool bush has to be fix in scan room","2 foot stool bush has to be fix in scan room","9","","37","1","51","259","2","9","3","5","","","","317","2014-04-29 14:49:45","37","2014-06-12 10:40:45","","","","");
INSERT INTO complaint VALUES("1456","Maintenance-0000960","2 foot stool bush has to be fix in scan room","2 foot stool bush has to be fix in scan room","9","","37","1","51","259","2","9","3","5","","","","317","2014-04-29 14:50:01","227","2014-04-29 15:11:58","","","","");
INSERT INTO complaint VALUES("1457","MIS-0000497","MALE SIDE","MOUSE IS NOT WORKING","2","","112","1","64","22","1","2","3","7","","0","","110","2014-04-29 15:02:12","110","2014-05-16 11:40:25","","","","");
INSERT INTO complaint VALUES("1458","Maintenance-0000961","DOCTORS ROOM","FLUSH TO BE REPAIRED","6","","32","1","64","341","2","6","3","7","","","","110","2014-04-29 15:02:41","110","2014-05-16 11:40:06","","","","");
INSERT INTO complaint VALUES("1459","Maintenance-0000962","Fixation a Wall Mounted Fan to HR ","Fix an old /  extra Wall Mounted Fan to HR","5","","22","1","30","","2","5","3","7","","","","148","2014-04-29 15:04:49","148","2014-06-05 09:17:00","","","","");
INSERT INTO complaint VALUES("1460","Maintenance-0000963","D&C room side.","Water seepage through the ceiling .","12","","386","1","62","","2","12","3","5","6","","Dayanand & William had gone & checked found painting to be done ","107","2014-04-29 15:18:11","227","2014-06-21 11:31:48","","","","");
INSERT INTO complaint VALUES("1461","Maintenance-0000964","o2 cylender empty.","o2 cylender empty.","5","","22","1","81","","2","5","3","5","","","","99","2014-04-29 15:22:08","22","2014-04-29 16:08:18","","","","");
INSERT INTO complaint VALUES("1462","Maintenance-0000965","Utility room sink water is flowing continously","urgent","6","","31","1","65","354","2","6","3","7","","","","84","2014-04-29 15:30:05","84","2014-05-09 09:40:48","","","","");
INSERT INTO complaint VALUES("1463","Maintenance-0000966","R-3208,TV not working","attend soon","8","","34","1","50","","2","8","3","7","","","","225","2014-04-29 15:35:55","225","2014-04-30 08:22:58","","","","");
INSERT INTO complaint VALUES("1464","Maintenance-0000967","Sink tap leaking to be fixed","Complaint given Madhi ( cook ) ","6","","30","1","113","","2","6","3","7","","","","16","2014-04-29 15:50:13","16","2014-05-10 08:53:31","","","","");
INSERT INTO complaint VALUES("1465","Maintenance-0000968","Ventilator plug point to be fixed","complaint by on call","5","","23","1","53","","2","5","3","7","","","","16","2014-04-29 16:14:53","16","2014-05-10 08:53:19","","","","");
INSERT INTO complaint VALUES("1466","Maintenance-0000969","fan regulator is not working and fan is also not working","make it fast","5","","22","1","60","278","2","5","3","5","","","","264","2014-04-29 19:52:33","227","2014-04-30 08:11:51","","","","");
INSERT INTO complaint VALUES("1467","Maintenance-0000970","deluxe pantry sink is blocked","rectify as soon as possible","6","","31","1","50","","2","6","3","5","","","","184","2014-04-30 07:51:18","31","2014-04-30 15:41:29","","","","");
INSERT INTO complaint VALUES("1468","Maintenance-0000971","FACS count UPS is not working properly","Showing fluctuation","7","","29","1","17","137","2","7","3","7","","","","300","2014-04-30 08:09:03","300","2014-05-09 10:00:08","","","","");
INSERT INTO complaint VALUES("1469","MIS-0000498","Printer is not working","High priority","2","","112","1","40","11","1","2","3","7","","0","","313","2014-04-30 08:17:57","313","2014-05-07 12:26:09","","","","");
INSERT INTO complaint VALUES("1470","Maintenance-0000972","O2 cylinder is empty","attend soon ","5","","24","1","81","","2","5","3","7","","","","225","2014-04-30 08:23:45","225","2014-05-14 13:42:27","","","","");
INSERT INTO complaint VALUES("1471","Maintenance-0000973","emergency ambulance O2 cylinder is empty","attend soon","5","","24","1","81","","2","5","3","7","","","","225","2014-04-30 08:24:54","225","2014-05-14 13:42:08","","","","");
INSERT INTO complaint VALUES("1472","MIS-0000499","\"D\" ROOM CALLING BELL IS RINGING CONTINOUSLY","VERY URGENT ","","","123","1","65","","1","2","3","7","","","null","84","2014-04-30 09:22:47","84","2014-04-30 09:22:47","","","","");
INSERT INTO complaint VALUES("1473","MIS-0000500","MONITOR NOT WORKING REM-02","MONITOR NOT WORKING REM-02","2","","5","1","43","","1","2","3","5","","0","","223","2014-04-30 09:32:35","5","2014-04-30 10:08:57","","","","");
INSERT INTO complaint VALUES("1474","Maintenance-0000974","C-ROOM","STERILIUM STAND NAIL TO BE FIXED","9","","37","1","64","","2","9","3","7","","","","110","2014-04-30 09:32:57","110","2014-05-16 11:39:52","","","","");
INSERT INTO complaint VALUES("1475","Maintenance-0000975","HDU E-ROOM","SIDE RAILS TO BE FIXED","7","","28","1","64","","2","7","3","7","","","","110","2014-04-30 09:33:44","110","2014-05-16 11:39:34","","","","");
INSERT INTO complaint VALUES("1476","Maintenance-0000976","NURSING STATION","WHEEL CHAIR TO BE REPAIRED","7","","29","1","64","","2","7","3","7","","","","110","2014-04-30 09:34:20","110","2014-05-16 11:39:05","","","","");
INSERT INTO complaint VALUES("1477","Maintenance-0000977","deluxe patient trolley belt to fix , as it is cut.","kindly do the needful as soon as possible for emergency need.","7","","28","1","50","","2","7","3","5","1","","Safety belt no stock non stock raised on 22/06/2014 NS no : 3994","126","2014-04-30 09:51:01","28","2014-05-05 09:08:07","","","","");
INSERT INTO complaint VALUES("1478","Maintenance-0000978","\"D\" ROOM CALLING BELL IS RINGING CONTINOUSLY","VERY URGENT ","8","","34","1","65","","2","8","3","7","","","","84","2014-04-30 09:55:36","84","2014-05-09 09:40:04","","","","");
INSERT INTO complaint VALUES("1479","MIS-0000501","In accpac is not opening","to generate.","3","","6","1","17","32","1","3","3","7","","","","113","2014-04-30 09:57:12","113","2014-05-03 16:48:06","","","","");
INSERT INTO complaint VALUES("1480","Maintenance-0000979","Tube light is not working ","its urgent ","5","","25","1","74","","2","5","3","5","","","","72","2014-04-30 09:59:47","25","2014-04-30 11:50:05","","","","");
INSERT INTO complaint VALUES("1481","MIS-0000502","crp-03 not able to send mails to gmail or yahoo","high priority","3","","8","1","40","12","1","3","3","7","","","","65","2014-04-30 09:59:48","65","2014-05-05 08:07:37","","","","");
INSERT INTO complaint VALUES("1482","Maintenance-0000980","MIKE NOT WORKING PROPERLY.","URGENTLY DO THE NEEDFUL.","8","","34","1","79","","2","8","3","5","","","","216","2014-04-30 10:39:34","34","2014-04-30 15:39:18","","","","");
INSERT INTO complaint VALUES("1483","Maintenance-0000981","water leaking","very urgent","6","","30","1","76","100","2","6","3","5","","","","206","2014-04-30 10:42:19","30","2014-04-30 11:53:32","","","","");
INSERT INTO complaint VALUES("1484","Maintenance-0000982"," burning smell is coming.","Kindly come its very urgent.","5","","25","1","71","","2","5","3","5","","","","72","2014-04-30 10:52:55","25","2014-04-30 16:09:14","","","","");
INSERT INTO complaint VALUES("1485","Maintenance-0000983","Lab 2nd floor sink blocked","attend soon","6","","30","1","17","","2","6","3","7","","","","225","2014-04-30 11:10:23","225","2014-05-14 13:41:46","","","","");
INSERT INTO complaint VALUES("1486","Maintenance-0000984","wall tile broken in ot-1,5,4 &ot-5 sluice room ","need to attend urgently","12","","386","1","58","189","2","12","3","5","","","","122","2014-04-30 11:21:55","227","2014-05-28 15:30:09","","","","");
INSERT INTO complaint VALUES("1487","Maintenance-0000985","WATER LEEKING","WATER LEEKING","6","","31","1","58","206","2","6","3","5","","","","122","2014-04-30 11:23:57","31","2014-04-30 15:40:37","","","","");
INSERT INTO complaint VALUES("1488","Maintenance-0000986","ot-6 flooring epoxy flooring crack","urgent ","12","","386","1","58","194","2","12","3","2","","","","122","2014-04-30 11:24:50","227","2014-04-30 11:45:07","","","","");
INSERT INTO complaint VALUES("1489","MIS-0000503","Zimbra not working since past 2 hours.","Tried using web-mail yet external mail can\'t be sent","3","","8","1","94","37","1","3","3","7","","","","137","2014-04-30 11:32:50","137","2014-05-13 08:09:03","","","","");
INSERT INTO complaint VALUES("1490","Maintenance-0000987","PEDIATRIC OPD CASH COUNTER DRAWER NOT GETTING CLOSED PROPERLY\'. ","KINDLY DO THE NEEDFUL.
INSERT INTO complaint VALUES("1491","MIS-0000504","IN ER SYSTEM NOT WORKING PROPERLY.","IN ER SYSTEM NOT WORKING PROPERLY.","3","","6","1","81","","1","3","3","5","","","","99","2014-04-30 11:42:07","6","2014-05-01 11:19:34","","","","");
INSERT INTO complaint VALUES("1492","Maintenance-0000988","O2 CYLENDER EMPTY.","O2 CYLENDER EMPTY.","5","","23","1","81","","2","5","3","5","","","","99","2014-04-30 12:13:44","23","2014-04-30 15:37:34","","","","");
INSERT INTO complaint VALUES("1493","Maintenance-0000989","light is not working in 2nd floor gents toilet","urgent","5","","23","1","47","108","2","5","3","5","","","","149","2014-04-30 12:20:28","23","2014-04-30 16:04:45","","","","");
INSERT INTO complaint VALUES("1494","Maintenance-0000990","nurses station draw wood screw coming out to be fixed.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-04-30 12:57:10","87","2014-05-03 11:50:30","","","","");
INSERT INTO complaint VALUES("1495","Maintenance-0000991","cardiac table screw to be fixed 1 nos.","as soon as possible.","7","","28","1","63","","2","7","3","7","","","","87","2014-04-30 12:58:22","87","2014-05-03 11:50:51","","","","");
INSERT INTO complaint VALUES("1496","Maintenance-0000992","pt attender stool to be repaint. 5 nos with push to be fix.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-04-30 13:00:20","87","2014-05-15 14:42:57","","","","");
INSERT INTO complaint VALUES("1497","Maintenance-0000993","CHAIR IS NOT ","CHAIR IS NOT ","7","","28","1","44","57","2","7","3","7","","","","348","2014-04-30 13:17:46","348","2014-05-16 09:35:18","","","","");
INSERT INTO complaint VALUES("1498","Maintenance-0000994","trolley wheel is broken ","attend soon","7","","28","1","81","","2","7","3","7","","","","225","2014-04-30 13:36:42","225","2014-05-14 13:41:16","","","","");
INSERT INTO complaint VALUES("1499","Maintenance-0000995","NURSES STATION KEYPAD WOODEN PLATE TO BE FIXED ","VERY URGENT","9","","37","1","65","","2","9","3","7","","","","84","2014-04-30 13:49:35","84","2014-05-09 09:41:55","","","","");
INSERT INTO complaint VALUES("1500","Maintenance-0000996","Leaking compressor pipe of the aidec dental chair
INSERT INTO complaint VALUES("1501","MIS-0000505","Troponin I report cannot be entered into the system Patient name Chandrashekar ,MRD no AA223917","Showing under processes but entering showing pending analysis.","3","","6","1","17","27","1","3","3","5","","","","292","2014-04-30 14:49:16","6","2014-04-30 16:57:42","","","","");
INSERT INTO complaint VALUES("1502","Maintenance-0000997","Light to be fix (dressing  table Lamb)","Light to be fix (dressing  table Lamb)","5","","25","3","74","","2","5","3","5","6","","Major work to be done ( Carpentry work ) ","214","2014-04-30 14:52:12","25","2014-05-05 09:16:38","","","","");
INSERT INTO complaint VALUES("1503","MIS-0000506","pt name sitamahalaxmi hosp no AA256118
INSERT INTO complaint VALUES("1504","Maintenance-0000998","Painting to be done and walls that are chipped off to be repaired. ","Please ensure this maintenance issue is done ASAP.","12","","386","1","30","","2","12","3","2","","","","62","2014-04-30 15:17:44","227","2014-04-30 15:30:48","","","","");
INSERT INTO complaint VALUES("1505","MIS-0000507","printer not working.","printer not working","2","","5","1","18","8","1","2","3","7","","0","","64","2014-04-30 15:45:11","64","2014-05-05 11:49:40","","","","");
INSERT INTO complaint VALUES("1506","Maintenance-0000999","L,FLUSH HANDLE IS BROKEN.","PLEASE COME IMMEDIATLY.","6","","30","1","49","230","2","6","3","5","","","","244","2014-04-30 15:56:02","31","2014-04-30 16:03:53","","","","");
INSERT INTO complaint VALUES("1507","Maintenance-0001000","AC is leaking ","HIGH Priority","10","","26","1","3","169","2","10","3","5","","","","8","2014-04-30 16:00:14","26","2014-04-30 16:13:45","","","","");
INSERT INTO complaint VALUES("1508","Maintenance-0001001","trolly wheel broken...","trolly wheel broken...","7","","28","1","81","","2","7","3","5","","","","99","2014-04-30 16:04:43","227","2014-04-30 16:14:17","","","","");
INSERT INTO complaint VALUES("1509","Maintenance-0001002","B       : Rods should be plain & shaking 
INSERT INTO complaint VALUES("1510","MIS-0000508","printer not working","printer not working","2","","5","1","18","8","1","2","3","7","","0","","64","2014-04-30 16:37:21","64","2014-05-05 11:49:16","","","","");
INSERT INTO complaint VALUES("1511","MIS-0000509","AA256118 - SitaMahalakshmi.
INSERT INTO complaint VALUES("1512","Maintenance-0001003","repair of curtain frame in academic center","as soon as possible","9","","37","1","105","","2","9","3","5","","","","291","2014-05-01 07:55:43","37","2014-05-01 15:50:13","","","","");
INSERT INTO complaint VALUES("1513","Maintenance-0001004","K-ROOM","PATIENT CALLING BELL NOT ABLE TO OFF","8","","34","1","64","","2","8","3","7","","","","110","2014-05-01 08:03:50","110","2014-05-16 11:38:41","","","","");
INSERT INTO complaint VALUES("1514","Maintenance-0001005","D-ROOM","WALL SUCTION APPARATUS TO BE REPAIRED","7","","29","1","64","","2","7","3","7","","","","110","2014-05-01 08:04:31","110","2014-05-16 11:37:59","","","","");
INSERT INTO complaint VALUES("1515","Maintenance-0001006","WASHING AREA FOR DISABLED","SINK IS BLOCKED","6","","31","1","64","","2","6","3","7","","","","110","2014-05-01 08:04:56","110","2014-05-16 11:37:42","","","","");
INSERT INTO complaint VALUES("1516","MIS-0000510","CRP-03      The connection to the server has failed. Account: \'mail.bbh.org.in\', Server: \'mail.bbh.org.in\', Protocol: POP3, Port: 995, Secure(SSL): Yes, Socket Error: 10051, Error Number: 0x800CCC0E","high priority","3","","8","1","40","","1","3","3","7","","","","65","2014-05-01 08:35:41","65","2014-05-05 08:07:01","","","","");
INSERT INTO complaint VALUES("1517","Maintenance-0001007","UTILITY ROOM","SINK IS BLOCKED","6","","30","1","64","","2","6","3","7","","","","110","2014-05-01 08:39:15","110","2014-05-16 11:37:28","","","","");
INSERT INTO complaint VALUES("1518","MIS-0000511","Outlook express not working (to receive & send), in Medical School, ALHS & Library","Outlook express not working (to receive & send), in Medical School, ALHS & Library","3","","5","1","25","","1","3","3","7","","","","152","2014-05-01 08:59:36","152","2014-05-12 10:20:57","","","","");
INSERT INTO complaint VALUES("1519","MIS-0000512","Please connect the printer accordingly
INSERT INTO complaint VALUES("1520","Maintenance-0001008","room no 1515(1) cot side rails are loose not fixed properly. ","please come immediately.","7","","28","1","49","235","2","7","3","5","","","","97","2014-05-01 09:21:27","28","2014-05-01 11:13:35","","","","");
INSERT INTO complaint VALUES("1521","MIS-0000513","data damaged","Tally not working","3","","6","1","41","","1","3","3","5","","","","361","2014-05-01 09:30:38","6","2014-05-01 10:21:24","","","","");
INSERT INTO complaint VALUES("1522","Maintenance-0001009","O2 cylinder is empty","attend soon","5","","24","1","64","","2","5","3","7","","","","225","2014-05-01 09:44:29","225","2014-05-14 13:40:59","","","","");
INSERT INTO complaint VALUES("1523","Maintenance-0001010","O2 cylinder is empty","attend soon","5","","24","1","52","","2","5","3","7","","","","225","2014-05-01 09:46:09","225","2014-05-14 13:40:33","","","","");
INSERT INTO complaint VALUES("1524","Maintenance-0001011","change one of the Tube light ","immdly.. totaly dark on that area","5","","25","1","28","","2","5","3","5","","","","117","2014-05-01 09:47:14","25","2014-05-01 12:49:10","","","","");
INSERT INTO complaint VALUES("1525","Maintenance-0001012","O2 cylinder is empty","attend soon","5","","24","1","54","","2","5","3","7","","","","225","2014-05-01 09:47:33","225","2014-05-14 13:40:14","","","","");
INSERT INTO complaint VALUES("1526","MIS-0000514","accpac is not working ","do it soon","3","","5","1","58","13","1","3","3","5","","","","124","2014-05-01 09:50:30","5","2014-05-01 12:23:03","","","","");
INSERT INTO complaint VALUES("1527","MIS-0000515","Accpac is not working in W-4 5 N-COMPUTING SYSTEM.","Accpac is not working in W-4 5 N-COMPUTING SYSTEM.","3","","5","1","42","","1","3","3","5","","","","370","2014-05-01 10:03:34","5","2014-05-01 10:34:36","","","","");
INSERT INTO complaint VALUES("1528","Maintenance-0001013"," Door to be repaired","Door to be repaired","9","","37","1","52","61","2","9","3","5","","","","155","2014-05-01 10:22:15","37","2014-05-01 15:49:53","","","","");
INSERT INTO complaint VALUES("1529","MIS-0000516","online prescription printout quantity column  coming in second sheet","prescription printout should be in single sheet.","2","","5","1","18","7","1","2","3","7","","0","","64","2014-05-01 10:22:41","64","2014-05-05 14:18:04","","","","");
INSERT INTO complaint VALUES("1530","MIS-0000517","In M/p Items- Item location details option to be given to all staffs.","anugeo, beenas, gigi, gopal, joy, kumard,Najma, Newton,Pratush,Renu, Denny,Spriya,Sridhar,Esha,Tanya, Thara, vasanthk and Arunaks.","3","","9","1","18","7","1","3","3","7","","","","64","2014-05-01 10:29:49","64","2014-05-06 11:36:10","","","","");
INSERT INTO complaint VALUES("1531","Maintenance-0001014","Commode seat cover needs repair ","Urgent","6","","31","3","113","","2","6","3","7","","","","259","2014-05-01 10:33:36","259","2014-06-06 12:37:15","","","","");
INSERT INTO complaint VALUES("1532","Maintenance-0001015","Washing Machine not working.","Urgent","7","","28","3","113","","2","7","3","5","6","","Quotation approval under progres","259","2014-05-01 10:34:38","28","2014-06-07 13:17:15","","","","");
INSERT INTO complaint VALUES("1533","MIS-0000518","AA217424- Bharathi.M.P","same problem that in order list it is not generating. To type for FNAC report.","3","","6","1","17","32","1","3","3","7","6","","While placing the order section was Histopathology in the lab master. and before the sample collection section changed to Cytopathology in the lab master. Thus same order contains two different section is not allowing the result entry. 
INSERT INTO complaint VALUES("1534","Maintenance-0001016","labour room AC is not working","needs urgent because exams are going","7","","26","1","59","","2","7","3","5","","","","116","2014-05-01 10:39:40","26","2014-05-01 15:47:52","","","","");
INSERT INTO complaint VALUES("1535","MIS-0000519","1.System dit-03 is not functioning.
INSERT INTO complaint VALUES("1536","Maintenance-0001017","PHONE NOT-WORKING","URGENT","8","","34","1","72","275","2","8","3","5","","","","219","2014-05-01 12:24:30","34","2014-05-02 08:38:34","","","","");
INSERT INTO complaint VALUES("1537","Maintenance-0001018","IN ROOM 3203 CONTINUOUS WATER LEAKAGE  IN SINK PIPE .
INSERT INTO complaint VALUES("1538","Maintenance-0001019","AC is Not Working","High Priority","7","","26","1","3","168","2","7","2","7","","","","6","2014-05-01 13:15:00","6","2014-05-02 08:04:46","","","","");
INSERT INTO complaint VALUES("1539","Maintenance-0001020","tube light not working ","attend soon","5","","23","1","94","","2","5","3","7","","","","225","2014-05-01 14:00:10","225","2014-05-14 13:39:45","","","","");
INSERT INTO complaint VALUES("1540","Maintenance-0001021","Rooms G,H,I,J, Toilet flush is not working and water is not coming to be check. ","as soon as possible.","6","","31","1","63","","2","6","3","7","","","","87","2014-05-01 14:31:25","87","2014-05-03 11:49:35","","","","");
INSERT INTO complaint VALUES("1541","Maintenance-0001022","High Risk Labour Room door making sound.","needs urgent ","9","","37","1","59","","2","9","3","5","","","","116","2014-05-01 14:43:01","37","2014-05-01 15:49:35","","","","");
INSERT INTO complaint VALUES("1542","Maintenance-0001023","AC not working. ","As Soon as possilbe","10","","26","1","17","135","2","10","3","5","","","","292","2014-05-01 14:43:25","26","2014-05-01 15:47:14","","","","");
INSERT INTO complaint VALUES("1543","Maintenance-0001024","Cupboard lock is not working in the students hostel","urgent ","9","","37","4","107","","2","9","3","7","","","","265","2014-05-01 15:05:42","265","2014-05-06 08:59:13","","","","");
INSERT INTO complaint VALUES("1544","Maintenance-0001025","wall mount flow meter is not working","as early as possible","7","","28","1","62","309","2","7","3","5","","","","107","2014-05-01 15:15:52","28","2014-05-01 15:52:07","","","","");
INSERT INTO complaint VALUES("1545","Maintenance-0001026","ENT 3 TUBE LIGHT NOT WORKING","URGENT","5","","23","1","76","","2","5","3","5","","","","206","2014-05-01 15:16:27","23","2014-05-01 16:18:59","","","","");
INSERT INTO complaint VALUES("1546","Maintenance-0001027","ENT 2 SUCTION APPARATUS NOT WORKING","URGENT","7","","28","1","76","","2","7","3","5","","","","206","2014-05-01 15:20:27","28","2014-05-01 15:51:43","","","","");
INSERT INTO complaint VALUES("1547","Maintenance-0001028","full wing 5 ","flush water is not coming","6","","32","1","64","331","2","6","3","5","","","","330","2014-05-01 16:26:29","32","2014-05-02 16:11:39","","","","");
INSERT INTO complaint VALUES("1548","MIS-0000520","internet not working in medical school","Urgent","2","","112","1","105","","1","2","3","5","","0","","291","2014-05-02 07:58:44","112","2014-05-02 08:19:12","","","","");
INSERT INTO complaint VALUES("1549","MIS-0000521","monitor & Keyboard is not working
INSERT INTO complaint VALUES("1550","MIS-0000522","computer printer is not working ","kindly do the needful","2","","112","1","93","","1","2","3","5","","882","","79","2014-05-02 08:10:41","112","2014-05-02 08:24:19","","","","");
INSERT INTO complaint VALUES("1551","Maintenance-0001029","E3 COT HAS NO SIDE-RAIL.
INSERT INTO complaint VALUES("1552","Maintenance-0001030","patient cot side rails to be repaired
INSERT INTO complaint VALUES("1553","Maintenance-0001031","G-1 Patient cot side rails to be repaired","as soon as possible","7","","28","1","65","351","2","7","3","7","","","","84","2014-05-02 08:35:30","84","2014-05-09 10:34:49","","","","");
INSERT INTO complaint VALUES("1554","Maintenance-0001032","acquvagard to be repaired ","very urgent","6","","30","1","65","355","2","6","3","7","","","","84","2014-05-02 08:39:42","84","2014-05-09 09:43:36","","","","");
INSERT INTO complaint VALUES("1555","MIS-0000523","certificate correction","hospital auxiliary certificate to be corrected","3","","8","1","45","","1","3","3","5","","","","93","2014-05-02 08:48:29","8","2014-05-05 15:05:05","","","","");
INSERT INTO complaint VALUES("1556","Maintenance-0001033","trolley wheel broken","nut to be fixed","7","","29","1","53","","2","7","3","5","","","","119","2014-05-02 08:48:40","29","2014-05-02 16:12:59","","","","");
INSERT INTO complaint VALUES("1557","Maintenance-0001034","photo therapy tubes to  be changed","urgent","7","","27","1","55","","2","7","3","5","","","","83","2014-05-02 08:51:47","27","2014-05-02 16:24:28","","","","");
INSERT INTO complaint VALUES("1558","Maintenance-0001035","in deluxe room 3215 smoke detector cap to replace ,as it is removed. ","kindly do the needful as soon as possible .","8","","34","1","50","","2","8","3","5","","","","126","2014-05-02 09:03:48","34","2014-05-02 16:06:17","","","","");
INSERT INTO complaint VALUES("1559","MIS-0000524","system is hanging ","system is hanging ","3","","6","1","16","19","1","3","3","7","","","","132","2014-05-02 09:04:37","132","2014-05-06 14:42:14","","","","");
INSERT INTO complaint VALUES("1560","MIS-0000525","system is hanging","system is hanging","3","","6","1","16","19","1","3","3","7","","","","132","2014-05-02 09:21:40","132","2014-05-06 14:41:53","","","","");
INSERT INTO complaint VALUES("1561","Maintenance-0001036","High risk labour room key board stand to fixed","needs urgent","9","","37","1","59","154","2","9","3","5","","","","116","2014-05-02 09:23:36","37","2014-05-02 16:20:08","","","","");
INSERT INTO complaint VALUES("1562","MIS-0000526","new GL to be CREATED for pharmacist, Under pharmacy module","A. RASHMI ","3","","6","1","18","","1","3","3","7","","","","64","2014-05-02 09:28:52","64","2014-05-05 14:17:30","","","","");
INSERT INTO complaint VALUES("1563","Maintenance-0001037"," sliding aluminium window pane ","at the out patient  pharmacy  counter to be fixed /or replaced by a new one ","9","","37","1","18","","2","9","3","7","","","","64","2014-05-02 09:31:46","64","2014-05-05 11:54:23","","","","");
INSERT INTO complaint VALUES("1564","Maintenance-0001038","Electrical points to be checked in class room - 3","Urgent","5","","25","1","105","","2","5","3","5","","","","291","2014-05-02 10:18:05","25","2014-05-02 16:15:05","","","","");
INSERT INTO complaint VALUES("1565","Maintenance-0001039","Room Injection Emergency trolly draw is not working to be check.( crash cot)
INSERT INTO complaint VALUES("1566","Maintenance-0001040","mike from pediatric opd  not working.","urgently do the needful.","8","","33","1","79","","2","8","3","5","","","","216","2014-05-02 10:24:46","33","2014-05-02 16:08:16","","","","");
INSERT INTO complaint VALUES("1567","Maintenance-0001041","Door lock not working","Door lock not working","9","","37","1","74","188","2","9","3","5","","","","214","2014-05-02 10:30:52","37","2014-05-02 16:18:43","","","","");
INSERT INTO complaint VALUES("1568","MIS-0000527","crp-02 system hanging","High priority","3","","6","1","40","11","1","3","3","7","","","","313","2014-05-02 10:36:44","313","2014-05-07 12:25:27","","","","");
INSERT INTO complaint VALUES("1569","Maintenance-0001042","Phone is not working","Very urgent please","8","","33","1","111","","2","8","3","5","","","","204","2014-05-02 10:39:46","33","2014-05-02 16:08:35","","","","");
INSERT INTO complaint VALUES("1570","MIS-0000528","Dongle /Pen drive is not accessing in bbh/sal/02","dongle is not accessing","2","","5","1","39","","1","2","3","5","","0","","361","2014-05-02 10:51:06","5","2014-05-02 16:58:31","","","","");
INSERT INTO complaint VALUES("1571","Maintenance-0001043","RNTCP Room AC not working.","ASAP.","10","","26","1","17","152","2","10","3","5","","","","292","2014-05-02 11:08:22","26","2014-05-02 12:09:28","","","","");
INSERT INTO complaint VALUES("1572","Maintenance-0001044","square light is hanging and to be fixed","emergency","5","","25","1","56","","2","5","3","5","","","","192","2014-05-02 11:08:33","25","2014-05-02 16:14:22","","","","");
INSERT INTO complaint VALUES("1573","Maintenance-0001045","IN DELUXE ROOM  3208 AC IS NOT WORKING  ","KINDLY RECTIFY AS SOON AS POSSIBLE FOR PATIENT ADMISSION .","7","","26","1","50","","2","7","3","5","","","","126","2014-05-02 11:13:03","26","2014-05-02 12:09:07","","","","");
INSERT INTO complaint VALUES("1574","Maintenance-0001046","Pantry room sink is blocked","attend soon","5","","24","1","50","","2","5","3","7","","","","225","2014-05-02 11:22:55","225","2014-05-14 13:38:57","","","","");
INSERT INTO complaint VALUES("1575","Maintenance-0001047","Toilet door unable to open","attend soon","5","","24","1","63","","2","5","3","7","","","","225","2014-05-02 11:23:56","225","2014-05-14 13:38:37","","","","");
INSERT INTO complaint VALUES("1576","Maintenance-0001048","AC LEAKING IN CT CONSOLE ROOM","AS SOON AS POSSIBLE","10","","26","1","14","246","2","10","3","5","","","","70","2014-05-02 11:42:47","26","2014-05-02 16:12:19","","","","");
INSERT INTO complaint VALUES("1577","Maintenance-0001049","Men\'s hostel 1st floor sink blocked & tap water leaking","attend soon","6","","30","2","2","","2","6","3","7","","","","225","2014-05-02 11:48:37","225","2014-05-14 13:38:14","","","","");
INSERT INTO complaint VALUES("1578","MIS-0000529","GL Authorization for SUNEETH.","GL  Authorization for SUNEETH","3","","6","1","18","7","1","3","3","7","","","","64","2014-05-02 11:51:59","64","2014-05-05 11:48:28","","","","");
INSERT INTO complaint VALUES("1579","Maintenance-0001050","got blocked","water is blocked in the washing area sink","6","","30","1","17","141","2","6","3","7","","","","300","2014-05-02 12:03:12","300","2014-05-09 09:59:41","","","","");
INSERT INTO complaint VALUES("1580","Maintenance-0001051","o2 cylinder empty","work done","7","","28","1","53","","2","7","3","5","","","","119","2014-05-02 12:10:32","28","2014-05-02 12:46:15","","","","");
INSERT INTO complaint VALUES("1581","MIS-0000530","system hanging, and very slow process","system hanging, and very slow process","3","","6","1","16","19","1","3","3","7","","","","132","2014-05-02 12:47:55","132","2014-05-06 14:41:38","","","","");
INSERT INTO complaint VALUES("1582","MIS-0000531","computer is not working in class room 2 in front of library","urgent","2","","112","1","105","","1","2","3","5","","0","","291","2014-05-02 13:58:45","112","2014-05-02 14:14:58","","","","");
INSERT INTO complaint VALUES("1583","MIS-0000532","Epson printer not working","High Priority","2","","112","1","40","11","1","2","3","7","","0","","313","2014-05-02 14:12:11","313","2014-05-17 12:43:09","","","","");
INSERT INTO complaint VALUES("1584","MIS-0000533","crp-06 on OP pharmacy credit bills, company name, Net Sponsered amount & Net Patient Amount is not appearing","High Priority","3","","6","1","40","11","1","3","3","7","","","","313","2014-05-02 14:37:51","313","2014-05-07 12:24:09","","","","");
INSERT INTO complaint VALUES("1585","Maintenance-0001052","staff toilet flush is not working","not working","6","","32","1","62","315","2","6","3","5","","","","106","2014-05-02 15:03:10","32","2014-05-02 16:22:50","","","","");
INSERT INTO complaint VALUES("1586","Maintenance-0001053","hooks for drying the bed pan and urinal to be fixed in the toilet and utility room.","
INSERT INTO complaint VALUES("1587","MIS-0000534","Update ms office to ms office 2007","urgent","3","","5","1","43","","1","3","3","5","","","","223","2014-05-02 15:09:18","5","2014-05-02 15:14:43","","","","");
INSERT INTO complaint VALUES("1588","Maintenance-0001054","tube lite not switching on","it will be difficult to bill in the counter","5","","22","1","18","216","2","5","3","7","","","","64","2014-05-02 16:35:33","64","2014-05-05 11:53:24","","","","");
INSERT INTO complaint VALUES("1589","Maintenance-0001055","Plug top to be replaced ","complaint given by Vijay kumar S.Ex","5","","22","1","70","272","2","5","3","7","","","","16","2014-05-03 08:08:13","16","2014-05-10 08:53:09","","","","");
INSERT INTO complaint VALUES("1590","Maintenance-0001056","Staff Hostel Bulb not working ","evening duty Arokiadas got complaint","5","","22","2","2","161","2","5","3","7","","","","16","2014-05-03 08:09:17","16","2014-05-10 08:53:02","","","","");
INSERT INTO complaint VALUES("1591","Maintenance-0001057","Exhaust fan not working ","Complaint taken @ evening duty Arokiadas","5","","22","1","71","","2","5","3","7","","","","16","2014-05-03 08:10:44","16","2014-05-10 08:52:54","","","","");
INSERT INTO complaint VALUES("1592","Maintenance-0001058","Fan not working ","complaint taken @ evening duty arokiadas 01-05-2014","5","","22","1","16","175","2","5","3","7","","","","16","2014-05-03 08:11:44","16","2014-05-10 08:52:45","","","","");
INSERT INTO complaint VALUES("1593","Maintenance-0001059","AC not working ","Complaint taken @ evening duty Arokiadas 01-05-2014","5","","22","1","17","136","2","5","3","7","","","","16","2014-05-03 08:12:36","16","2014-05-10 08:52:36","","","","");
INSERT INTO complaint VALUES("1594","Maintenance-0001060","Lift not working ","Complaint taken @ evening duty Arokiadas 02-05-2014","5","","24","1","70","274","2","5","3","7","","","","16","2014-05-03 08:13:34","16","2014-05-10 08:52:29","","","","");
INSERT INTO complaint VALUES("1595","Maintenance-0001061","Class room 3 switch not working ","Complaint taken @ evening duty Arokiadas 02-05-2014","5","","22","1","106","","2","5","3","7","","","","16","2014-05-03 08:16:40","16","2014-05-10 08:52:22","","","","");
INSERT INTO complaint VALUES("1596","Maintenance-0001062","Pantry room drainage blocked to be cleared ","Complaint on 01-05-2014 Night duty","5","","24","1","50","","2","5","3","7","","","","16","2014-05-03 08:18:33","16","2014-05-10 08:52:15","","","","");
INSERT INTO complaint VALUES("1597","Maintenance-0001063","O2 cylinder to be replaced ","Complaint on 01-05-2014 night duty","5","","24","1","81","","2","5","3","7","","","","16","2014-05-03 08:19:18","16","2014-05-10 08:52:06","","","","");
INSERT INTO complaint VALUES("1598","Maintenance-0001064","Patient Trolley O2 cylinder to be replaced ","Complaint on 01-05-2014 night duty","5","","24","1","81","","2","5","3","7","","","","16","2014-05-03 08:20:09","16","2014-05-10 08:51:57","","","","");
INSERT INTO complaint VALUES("1599","Maintenance-0001065","Toilet locked to be opened ","complaint on 01-05-2014 night duty","5","","24","1","63","323","2","5","3","7","","","","16","2014-05-03 08:21:08","16","2014-05-10 08:51:44","","","","");
INSERT INTO complaint VALUES("1600","Maintenance-0001066","SOPD corridor wall mount fell down","complaint by security on 01-05-2014 night duty","5","","24","1","70","265","2","5","3","7","","","","16","2014-05-03 08:22:44","16","2014-05-10 08:51:33","","","","");
INSERT INTO complaint VALUES("1601","Maintenance-0001067","cub-board latch broken","very urgent","9","","37","1","73","","2","9","3","5","","","","210","2014-05-03 08:23:33","37","2014-05-05 14:36:48","","","","");
INSERT INTO complaint VALUES("1602","Maintenance-0001068","EPABX reset to be done","complaint on 02-05-2014 night duty ","5","","23","1","37","132","2","5","3","7","","","","16","2014-05-03 08:23:58","16","2014-05-10 08:51:23","","","","");
INSERT INTO complaint VALUES("1603","Maintenance-0001069","O2 cylinder to be replaced","complaint on 02-05-2014 night duty","5","","23","1","81","","2","5","3","7","","","","16","2014-05-03 08:24:34","16","2014-05-10 08:51:15","","","","");
INSERT INTO complaint VALUES("1604","Maintenance-0001070","O2 cylinder to be replaced","complaint on 02-05-2014 night duty","5","","23","1","53","","2","5","3","7","","","","16","2014-05-03 08:25:01","16","2014-05-10 08:51:08","","","","");
INSERT INTO complaint VALUES("1605","Maintenance-0001071","Bed 7 Ventilator machine not working ","complaint on 02-05-2014 night duty ","5","","23","1","55","","2","5","3","7","","","","16","2014-05-03 08:26:41","16","2014-05-10 08:51:00","","","","");
INSERT INTO complaint VALUES("1606","Maintenance-0001072","BED 9 SELF SEALING VALVE LEAKAGE ","complaint on 02-05-2014 night duty ","7","","29","1","61","292","2","7","3","7","","","","16","2014-05-03 08:28:59","16","2014-05-10 08:50:52","","","","");
INSERT INTO complaint VALUES("1607","Maintenance-0001073"," Patient cot E-2 to be repaired , with the break cot is moving","urgent","7","","28","1","65","352","2","7","3","5","1","","Wheels no stock non stock raised ( Steel Craft ) ","84","2014-05-03 08:29:33","28","2014-05-07 12:21:21","","","","");
INSERT INTO complaint VALUES("1608","Maintenance-0001074","High risk labour room tap is leaking","needs urgent","6","","31","1","59","","2","6","3","5","","","","116","2014-05-03 08:40:25","31","2014-05-03 12:11:01","","","","");
INSERT INTO complaint VALUES("1609","Maintenance-0001075","AC is not working","There is no enough cooling","10","","26","1","3","168","2","10","3","7","","","","6","2014-05-03 09:11:20","6","2014-05-06 08:24:48","","","","");
INSERT INTO complaint VALUES("1610","MIS-0000535","system is hanging","system is hanging","3","","9","1","16","19","1","3","3","7","","","","132","2014-05-03 09:45:08","132","2014-05-06 14:41:23","","","","");
INSERT INTO complaint VALUES("1611","Maintenance-0001076","fan from peadiatric opd room no. 7 not working.","kindly do the needful.","5","","25","1","79","","2","5","3","5","","","","216","2014-05-03 09:49:37","25","2014-05-05 09:17:21","","","","");
INSERT INTO complaint VALUES("1612","Maintenance-0001077","Project office Fan oscillation not working ","Complaint given by Sampath sir","5","","25","1","2","","2","5","3","7","6","","Oscillation problem hence outsource to be done ","16","2014-05-03 09:52:19","16","2014-06-17 12:21:01","","","","");
INSERT INTO complaint VALUES("1613","MIS-0000536","system is hanging","system is hanging","3","","5","1","16","19","1","3","3","7","","","","132","2014-05-03 10:03:04","132","2014-05-06 14:40:54","","","","");
INSERT INTO complaint VALUES("1614","MIS-0000537","error is showing in current visit -record already is existing","error is showing in current visit -record already is existing","3","","5","1","16","19","1","3","3","7","","","","132","2014-05-03 10:07:48","132","2014-05-06 14:40:38","","","","");
INSERT INTO complaint VALUES("1615","MIS-0000538","Plastic Surgery Poster designing - photographs sent from Dr.Rajendra mail id to Mr.Uday mail ID. Please incorporate","Plastic Surgery Poster designing - photographs sent from Dr.Rajendra mail id to Mr.Uday mail ID. Please incorporate","3","","8","1","34","","1","3","3","7","","","","173","2014-05-03 11:30:20","173","2014-05-13 14:35:03","20140512111604_Plastic Surgery poster.pdf#","","","");
INSERT INTO complaint VALUES("1616","MIS-0000539","SYSTEM IS HANGING OFTEN","SYSTEM IS HANGING OFTEN","3","","5","1","16","19","1","3","3","7","","","","132","2014-05-03 11:33:41","132","2014-05-06 14:40:19","","","","");
INSERT INTO complaint VALUES("1617","Maintenance-0001078","Room \'C\' bed - 5 calling bell is not working to be check.","as soon as possible.","8","","33","1","63","","2","8","3","7","","","","87","2014-05-03 11:48:27","87","2014-05-15 14:42:36","","","","");
INSERT INTO complaint VALUES("1618","MIS-0000540","Internet is not working in medical school","Urgent","2","","112","1","105","","1","2","3","5","6","0","Internet Cable has damaged ","291","2014-05-03 11:49:49","112","2014-05-06 15:34:49","","","","");
INSERT INTO complaint VALUES("1619","Maintenance-0001079","G-2 Bed fan to be repaired ","vry urgent","5","","25","1","65","351","2","5","3","7","","","","84","2014-05-03 11:57:48","84","2014-05-09 09:44:27","","","","");
INSERT INTO complaint VALUES("1620","Maintenance-0001080","NURSES STATION","OXYGEN CYLINDER IS EMPTY","7","","28","1","64","","2","7","3","7","","","","110","2014-05-03 12:04:51","110","2014-05-16 11:37:09","","","","");
INSERT INTO complaint VALUES("1621","Maintenance-0001081","MALE SIDE TOILET","FLUSH TO BE REPAIRED
INSERT INTO complaint VALUES("1622","Maintenance-0001082","O2 cylinder is empty","attend soon","5","","23","1","81","","2","5","3","7","","","","225","2014-05-05 07:42:04","225","2014-05-14 13:37:35","","","","");
INSERT INTO complaint VALUES("1623","Maintenance-0001083","O2 cylinder is empty","attend soon","5","","23","1","55","","2","5","3","7","","","","225","2014-05-05 07:42:38","225","2014-05-14 13:37:11","","","","");
INSERT INTO complaint VALUES("1624","Maintenance-0001084","GYEASER IS NOT WORKING","GYEASER IS NOT WORKING","5","","22","1","52","","2","5","3","5","","","","156","2014-05-05 07:44:49","22","2014-05-05 15:03:35","","","","");
INSERT INTO complaint VALUES("1625","MIS-0000541","CRP-06","Repeated complaints about mouse not working","2","","112","1","40","12","1","2","3","7","6","0","Working Fine","65","2014-05-05 08:08:43","65","2014-05-06 12:51:24","","","","");
INSERT INTO complaint VALUES("1626","Maintenance-0001085","MALE SIDE H-ROOM","SIDE RAILS TO BE REPAIRED","7","","27","1","64","","2","7","3","7","6","","Welding to be done by outsource ","110","2014-05-05 08:46:03","110","2014-05-16 11:36:38","","","","");
INSERT INTO complaint VALUES("1627","Maintenance-0001086","NURSES STATION -2","KEYBOARD TABLE TO BE FIXED","9","","37","1","64","","2","9","3","7","","","","110","2014-05-05 08:46:39","110","2014-05-16 11:36:04","","","","");
INSERT INTO complaint VALUES("1628","MIS-0000542","System not working ","its very urgent ","2","","112","1","75","","1","2","3","5","","0","","72","2014-05-05 08:47:31","112","2014-05-05 09:07:21","","","","");
INSERT INTO complaint VALUES("1629","Maintenance-0001087","hand rub lanza guard stand  fixe","urgent","9","","37","1","60","","2","9","3","5","","","","103","2014-05-05 08:50:14","37","2014-05-05 14:37:37","","","","");
INSERT INTO complaint VALUES("1630","MIS-0000543","W1 (IP BILLING) PRINT NOT COMMING","W1 (IP BILLING) PRINT NOT COMMING","2","","112","1","42","","1","2","3","5","","0","","118","2014-05-05 08:53:00","112","2014-05-05 09:24:36","","","","");
INSERT INTO complaint VALUES("1631","Maintenance-0001088","Access control machine is not working","Access control machine is not working","5","","22","1","52","61","2","5","3","5","","","","156","2014-05-05 09:08:43","22","2014-05-05 15:05:11","","","","");
INSERT INTO complaint VALUES("1632","Maintenance-0001089","ac is leaking","kindly  rectify","7","","26","1","50","83","2","7","3","5","","","","177","2014-05-05 09:10:26","26","2014-05-05 14:34:16","","","","");
INSERT INTO complaint VALUES("1633","Maintenance-0001090","AC water is leaking.","needs urgent","7","","26","1","59","","2","7","3","5","","","","116","2014-05-05 09:13:23","26","2014-05-05 14:33:50","","","","");
INSERT INTO complaint VALUES("1634","Maintenance-0001091","E- 2 bed side.","Fan to be fixed.","5","","22","1","61","","2","5","3","5","","","","105","2014-05-05 09:18:50","22","2014-05-06 16:25:19","","","","");
INSERT INTO complaint VALUES("1635","MIS-0000544","system is hanging","system is hanging","3","","5","1","16","19","1","3","3","7","","","","132","2014-05-05 09:24:05","132","2014-05-06 14:40:02","","","","");
INSERT INTO complaint VALUES("1636","Maintenance-0001092","I-ROOM TOILET","SINK IS BLOCKED","6","","32","1","64","","2","6","3","7","","","","110","2014-05-05 09:31:59","110","2014-05-16 11:35:19","","","","");
INSERT INTO complaint VALUES("1637","MIS-0000545","printer is not working","printer is not working","2","","5","1","16","19","1","2","3","7","","0","","132","2014-05-05 09:40:03","132","2014-05-06 14:39:45","","","","");
INSERT INTO complaint VALUES("1638","MIS-0000546","Trainee Salary cannot be processed in the old HRMS ","Do the needful 
INSERT INTO complaint VALUES("1639","Maintenance-0001093","pt attender stool to be repaint. 5 nos with push to be fix.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-05-05 09:58:02","87","2014-05-12 09:28:22","","","","");
INSERT INTO complaint VALUES("1640","Maintenance-0001094","bulb not working","urgent","5","","22","1","72","","2","5","3","5","","","","219","2014-05-05 10:03:32","22","2014-05-05 15:04:17","","","","");
INSERT INTO complaint VALUES("1641","Maintenance-0001095","dressing room sink water is coming out","urgent","6","","32","1","72","","2","6","3","5","","","","219","2014-05-05 10:08:27","32","2014-05-05 10:53:18","","","","");
INSERT INTO complaint VALUES("1642","Maintenance-0001096","Trolley wheels to be repair","urgent","7","","27","1","115","","2","7","3","5","6","","Welding to be done by outsource ","149","2014-05-05 10:14:16","27","2014-05-06 16:36:22","","","","");
INSERT INTO complaint VALUES("1643","Maintenance-0001097","loose electrical wiring in the class room 1 above CT scan room needs to be rectified","needs to be done at the earliest due ro NABH audit","5","","22","1","105","","2","5","3","5","","","","290","2014-05-05 10:21:01","22","2014-05-05 15:03:59","","","","");
INSERT INTO complaint VALUES("1644","Maintenance-0001098","The loose telephone wire needs beading to be done in classroom 1 above CT scan room.","needs to be done at the earliest due to NABH audit ","5","","22","1","105","","2","5","3","5","","","","290","2014-05-05 10:31:24","22","2014-05-05 15:03:53","","","","");
INSERT INTO complaint VALUES("1645","Maintenance-0001099","The fire extinguisher at the Academic Centre  is overdue for service.","Kindly do at the earliest due to NABH audit","11","","21","1","105","","2","11","3","5","","","","290","2014-05-05 10:35:26","21","2014-06-12 12:12:36","","","","");
INSERT INTO complaint VALUES("1646","Maintenance-0001100","Male doctors room- Flush overflowing","Please rectify it immediately ","6","","32","1","98","","2","6","3","5","","","","151","2014-05-05 10:36:32","32","2014-05-05 14:31:50","","","","");
INSERT INTO complaint VALUES("1647","Maintenance-0001101","water cooler needs to  be refixed in Academic Centre near Class room 2 (opp to library)","needs to be done at the earliest due to NABH audit","6","","32","1","105","","2","6","3","2","","","","290","2014-05-05 10:37:53","32","2014-06-19 12:45:31","","","","");
INSERT INTO complaint VALUES("1648","Maintenance-0001102","Painting work needs to be done in the Academic center (internal and external) ","kindly do at the earliest due to NABH audit ","11","","21","1","105","","2","11","3","2","","","","290","2014-05-05 10:40:42","21","2014-06-12 12:13:02","","","","");
INSERT INTO complaint VALUES("1649","Maintenance-0001103","Water filter in the men\'s hostel is not working","Water filter in the men\'s hostel is not working. Kindly attend to it.","6","","32","2","27","212","2","6","3","5","6","","Our plumber checked but unable to find fault hence Informed to Eureka Forbes vendor to rectiy","261","2014-05-05 10:54:50","32","2014-05-17 12:48:43","","","","");
INSERT INTO complaint VALUES("1650","Maintenance-0001104","CHAIR NEAR  CASUALTY BROKEN","NEEDS  TO BE REPAIRED","7","","29","1","37","131","2","7","3","5","","","","150","2014-05-05 11:09:46","29","2014-05-17 10:46:34","","","","");
INSERT INTO complaint VALUES("1651","Maintenance-0001105","wall o2 flow meter not working.","wall o2 flow meter not working.","7","","27","1","81","","2","7","3","5","","","","99","2014-05-05 11:14:56","27","2014-05-05 14:35:47","","","","");
INSERT INTO complaint VALUES("1652","Maintenance-0001106","cryocan empty to refill ","urgent ","7","","26","1","75","","2","7","3","5","","","","207","2014-05-05 11:25:28","26","2014-05-13 16:14:58","","","","");
INSERT INTO complaint VALUES("1653","MIS-0000547","PRINTER NOT WORKING","PRINTER NOT WORKING","3","","5","1","25","","1","3","3","7","","","","152","2014-05-05 11:57:56","152","2014-05-12 10:20:27","","","","");
INSERT INTO complaint VALUES("1654","Maintenance-0001107","Computer is not working because of power problem ","its urgent 
INSERT INTO complaint VALUES("1655","Maintenance-0001108","Kindly measure the wooden  trolley with extension board in labour room.","needs urgently","9","","37","1","59","","2","9","3","5","","","","116","2014-05-05 12:42:32","37","2014-05-05 14:36:34","","","","");
INSERT INTO complaint VALUES("1656","MIS-0000548","Barcode is not working in lab opd","Urgent","2","","112","1","17","25","1","2","3","5","","0","","257","2014-05-05 12:48:23","112","2014-05-05 13:07:32","","","","");
INSERT INTO complaint VALUES("1657","MIS-0000549","To reduce kb of an International patient\'s photo to inform FRRO office. The photo send to uday@bbh.org.in  mail ID","To reduce kb of an International patient\'s photo to inform FRRO office. The photo send to uday@bbh.org.in  mail ID","3","","8","1","34","","1","3","3","7","","","","173","2014-05-05 13:08:06","173","2014-05-05 14:00:39","","","","");
INSERT INTO complaint VALUES("1658","Maintenance-0001109","bed no. 8 fan is not working","To be done urgently","5","","25","1","53","","2","5","3","5","","","","85","2014-05-05 13:32:26","25","2014-05-06 10:59:16","","","","");
INSERT INTO complaint VALUES("1659","Maintenance-0001110","Qtrs Dr Joel house ( M-5 ) Curtain rods to be fixed ","Qtrs Dr Joel house ( M-5 ) Curtain rods to be fixed ","9","","37","3","2","161","2","9","3","7","","","","16","2014-05-05 13:40:07","16","2014-05-10 08:50:45","","","","");
INSERT INTO complaint VALUES("1660","Maintenance-0001111","DOOR CLOSURE FOR A C CUBICLE in out patient pharmacy","needed as the door is being opened regularly","9","","37","1","18","216","2","9","3","7","","","","64","2014-05-05 14:15:12","64","2014-05-06 11:35:03","","","","");
INSERT INTO complaint VALUES("1661","Maintenance-0001112","TELEPHONE NOT WORKING ","TELEPHONE NOT WORKING  THIS IS 3RD TIME INFORM","8","","33","1","44","58","2","8","3","7","","","","348","2014-05-05 14:36:42","348","2014-05-16 09:34:42","","","","");
INSERT INTO complaint VALUES("1662","Maintenance-0001113","Phone not working","land-line gets disconnected when the phone is lifted or moved. ","8","","33","1","31","","2","8","3","5","","","","262","2014-05-05 14:41:01","33","2014-05-06 10:57:20","","","","");
INSERT INTO complaint VALUES("1663","Maintenance-0001114","Nails to be fixed in the wall(CRECHE)."," Nails to be fixed in the wall.(CRECHE).","9","","37","1","114","","2","9","3","5","","","","114","2014-05-05 14:55:53","37","2014-05-06 11:24:05","","","","");
INSERT INTO complaint VALUES("1664","Maintenance-0001115","C-13 bedside.","O2 flow meter to be fixed.","7","","27","1","62","","2","7","3","5","","","","107","2014-05-05 14:58:13","27","2014-05-06 10:59:51","","","","");
INSERT INTO complaint VALUES("1665","Maintenance-0001116","lab opd there is no power supply so pls rectify it sooon","its urgent","5","","25","1","17","","2","5","3","7","","","","113","2014-05-05 15:51:05","113","2014-05-08 14:08:12","","","","");
INSERT INTO complaint VALUES("1666","MIS-0000550","Pts name Manjula hos num aa230594
INSERT INTO complaint VALUES("1667","Maintenance-0001117","Crest View II Floor - DNB Residents hostel
INSERT INTO complaint VALUES("1668","Maintenance-0001118","wall mounted fan not rotating.","please come immediatly","5","","25","1","102","","2","5","3","5","6","","Oscillation problem hence outsource to be done ","246","2014-05-05 16:57:18","25","2014-06-12 10:25:32","","","","");
INSERT INTO complaint VALUES("1669","Maintenance-0001119","digital weighing scale is not working","please come immediatly","7","","26","1","102","","2","7","3","5","","","","246","2014-05-05 16:59:16","227","2014-05-06 08:45:49","","","","");
INSERT INTO complaint VALUES("1670","Maintenance-0001120","soap solution container to be removed","please come immediatly","9","","37","1","102","","2","9","3","5","","","","246","2014-05-05 17:04:50","37","2014-05-06 11:23:28","","","","");
INSERT INTO complaint VALUES("1671","Maintenance-0001121","Water flow very less in the last  tap.","The tap was repaired many times earlier but the complaint still persists. I","6","","32","1","78","","2","6","3","3","9","","Major work (Tile Chipping work to be done)  hence outsource to be done ","197","2014-05-05 17:55:23","32","2014-06-19 12:46:55","","","","");
INSERT INTO complaint VALUES("1672","Maintenance-0001122","X-RAY TOKEN PRINTER IS NOT WORKING.","X-RAY TOKEN PRINTER IS NOT WORKING.","7","","29","1","90","","2","7","3","5","","","","70","2014-05-06 08:26:45","29","2014-05-06 16:32:07","","","","");
INSERT INTO complaint VALUES("1673","Maintenance-0001123","birthing room & labour room -B switch board to be fixed.","needs urgents","7","","28","1","59","","2","7","3","5","","","","116","2014-05-06 08:34:43","28","2014-05-06 16:29:12","","","","");
INSERT INTO complaint VALUES("1674","Maintenance-0001124","patient cupboard is broken","urgent","9","","37","1","60","284","2","9","3","5","","","","103","2014-05-06 08:45:16","37","2014-05-06 11:26:45","","","","");
INSERT INTO complaint VALUES("1675","Maintenance-0001125","Cross cycling thread to be fixed & Grease to be applied to all the equipments","Cross cycling thread to be fixed & Grease to be applied to all the equipments","7","","29","1","70","272","2","7","3","7","","","","16","2014-05-06 08:49:08","16","2014-05-10 08:50:37","","","","");
INSERT INTO complaint VALUES("1676","MIS-0000551","Patient name-Francis Jayaraj, MRD no-AA245990
INSERT INTO complaint VALUES("1677","Maintenance-0001126","Kindly fix  Kent water purifier in the new students hostel.","Urgent","6","","32","4","107","","2","6","3","7","","","","265","2014-05-06 08:56:28","265","2014-05-08 14:59:50","","","","");
INSERT INTO complaint VALUES("1678","Maintenance-0001127","Kindly  fix  sink in the nursing school ground floor. ","urgent","6","","32","4","107","","2","6","3","7","","","","265","2014-05-06 08:58:08","265","2014-05-08 15:00:02","","","","");
INSERT INTO complaint VALUES("1679","Maintenance-0001128","window door to be fix ","window door to be fix ","9","","37","1","74","188","2","9","3","5","","","","214","2014-05-06 09:00:36","37","2014-05-06 11:26:08","","","","");
INSERT INTO complaint VALUES("1680","Maintenance-0001129","room no 1508 (2) bedside locker handle broken not able to open.","please come immediately.","9","","37","1","49","229","2","9","3","5","","","","97","2014-05-06 09:13:32","37","2014-05-06 11:22:37","","","","");
INSERT INTO complaint VALUES("1681","Maintenance-0001130","spot light is not working to be check.","as soon as possible.","7","","28","1","63","","2","7","3","7","","","","87","2014-05-06 09:15:14","87","2014-05-07 15:56:53","","","","");
INSERT INTO complaint VALUES("1682","MIS-0000552","pl. connect printers
INSERT INTO complaint VALUES("1683","MIS-0000553","printer problem ","urgent","2","","5","1","115","","1","2","3","5","","698","","149","2014-05-06 09:25:19","5","2014-05-06 09:30:08","","","","");
INSERT INTO complaint VALUES("1684","Maintenance-0001131","Nursing educator room light is flickering continuously since yesterday ","Nursing educators room (2nd floor next to delux) light is defective, it flickers continously from yesterday. kindly fix it as early as possible","7","","28","1","45","","2","7","3","5","","","","93","2014-05-06 09:43:12","28","2014-05-06 13:29:04","","","","");
INSERT INTO complaint VALUES("1685","Maintenance-0001132","Narcotic Drug Locker to be fixed with pat lock   ","Urgent Please","9","","37","1","108","","2","9","3","5","","","","133","2014-05-06 09:55:41","37","2014-05-06 16:39:50","","","","");
INSERT INTO complaint VALUES("1686","MIS-0000554","Kindly change the department name in the registration slip of Neurology to Neuro surgery for Dr.Krishnaprasad.","Pls do the needful asap.","3","","9","1","16","19","1","3","3","5","","","","96","2014-05-06 10:12:19","9","2014-05-06 14:56:58","","","","");
INSERT INTO complaint VALUES("1687","Maintenance-0001133","Door  and cupboard (No. 7) locks  are not working in the B.Sc Hostel.","Urgent ","9","","37","4","107","","2","9","3","7","","","","265","2014-05-06 10:39:00","265","2014-06-24 15:26:49","","","","");
INSERT INTO complaint VALUES("1688","Maintenance-0001134","Door handle is broken in  old Students Hostel ","Urgent","9","","37","4","107","","2","9","3","7","","","","265","2014-05-06 10:40:08","265","2014-05-08 14:59:26","","","","");
INSERT INTO complaint VALUES("1689","Maintenance-0001135","Geyser is not working in old students Hostel","Urgent","6","","30","4","107","","2","6","3","7","","","","265","2014-05-06 10:43:42","265","2014-05-08 14:58:19","","","","");
INSERT INTO complaint VALUES("1690","MIS-0000555"," MAM, AA256774 PATIENT NAME SHABEEN TAJ WAS NOT POSTED,PLS CHECK THE NUMBER"," MAM, AA256774 PATIENT NAME SHABEEN TAJ WAS NOT POSTED,PLS CHECK THE NUMBER","3","","6","1","42","","1","3","3","5","","","","373","2014-05-06 10:45:16","6","2014-05-06 11:06:23","","","","");
INSERT INTO complaint VALUES("1691","Maintenance-0001136","Mobile phone not working 9448496601 please repair it soon","Complaint received from Manohar","8","","33","1","70","","2","8","3","7","","","","227","2014-05-06 10:55:14","227","2014-05-28 15:11:20","","","","");
INSERT INTO complaint VALUES("1692","Maintenance-0001137","sink is blocked","to be done urgently","6","","30","1","53","","2","6","3","5","","","","85","2014-05-06 11:00:52","30","2014-05-06 16:42:22","","","","");
INSERT INTO complaint VALUES("1693","Maintenance-0001138","Need manpower to transport books (boxes) from Director\'s office to Ladies Staff Hostel. ","thank you","11","","21","1","94","","2","11","3","7","","","","136","2014-05-06 11:03:01","136","2014-05-13 09:30:11","","","","");
INSERT INTO complaint VALUES("1694","Maintenance-0001139","room no 1519 tubelight not working","rectify immediately.","7","","28","1","49","242","2","7","3","5","","","","95","2014-05-06 11:25:21","28","2014-05-06 16:29:30","","","","");
INSERT INTO complaint VALUES("1695","Maintenance-0001140","patient shifting  trolley not proper while moving noisy, sound like bell.  ","please rectify immediately","7","","29","1","49","242","2","7","3","5","","","","95","2014-05-06 11:29:31","29","2014-05-06 16:32:50","","","","");
INSERT INTO complaint VALUES("1696","Maintenance-0001141","room no 1507 bathroom shower not working..","please do ASAP.","6","","32","1","49","228","2","6","3","5","","","","95","2014-05-06 11:30:59","32","2014-05-06 13:30:25","","","","");
INSERT INTO complaint VALUES("1697","Maintenance-0001142","room no 1518 hot water tap not working, ","please come ASAP","6","","32","1","49","238","2","6","3","5","","","","97","2014-05-06 11:38:30","32","2014-05-06 13:30:03","","","","");
INSERT INTO complaint VALUES("1698","MIS-0000556","1. Keyboard of Dit- 02 not functioning properly.
INSERT INTO complaint VALUES("1699","MIS-0000557","CRP-06 - mouse not working","high priority","3","","5","1","40","11","1","3","3","7","","","","65","2014-05-06 11:45:49","65","2014-05-07 14:50:38","","","","");
INSERT INTO complaint VALUES("1700","Maintenance-0001143","B- 1 bed side."," calling bell panel to be fixed.","8","","34","1","62","","2","8","3","5","","","","107","2014-05-06 11:54:42","34","2014-05-06 16:27:46","","","","");
INSERT INTO complaint VALUES("1701","Maintenance-0001144","OBG Office flush not working","Please repair it immediately ","6","","30","1","98","","2","6","3","5","","","","151","2014-05-06 12:38:56","30","2014-05-06 16:41:15","","","","");
INSERT INTO complaint VALUES("1702","Maintenance-0001145","Medicine Office keyboard table broken ","Please fix the issue immediately ","9","","37","1","98","","2","9","3","5","","","","151","2014-05-06 12:40:32","37","2014-05-06 16:38:40","","","","");
INSERT INTO complaint VALUES("1703","MIS-0000558","In the bill, pharmacy items tax is hidden. Can we have the bill where the total amount is linked instead of MRP. 
INSERT INTO complaint VALUES("1704","Maintenance-0001146","cupboard handle tobe fixed","broken","9","","37","1","62","315","2","9","3","5","","","","106","2014-05-06 12:52:10","37","2014-05-06 16:39:16","","","","");
INSERT INTO complaint VALUES("1705","Maintenance-0001147","staff gents toilet has blocked near IP billing","urgent","6","","30","1","47","105","2","6","3","5","","","","149","2014-05-06 13:11:10","30","2014-05-06 16:40:53","","","","");
INSERT INTO complaint VALUES("1706","Maintenance-0001148","door handle to be fixed","entrance  to psychiatric room","9","","37","1","62","307","2","9","3","5","","","","106","2014-05-06 13:13:29","37","2014-05-06 16:39:00","","","","");
INSERT INTO complaint VALUES("1707","Maintenance-0001149","A sink to be fixed near scan room (no: 10) aqua guard .","The water gets spilled allover the area being unsafe for the patients, attenders & staff. Kindly do the needful immediately","6","","31","1","104","","2","6","3","7","6","","Its a new requirement from user hence it will be delayed ","96","2014-05-06 13:37:39","96","2014-05-13 15:02:21","","","","");
INSERT INTO complaint VALUES("1708","MIS-0000559","Create common share folder in HKP-01 system","Urgent","3","","5","1","46","","1","3","3","5","","","","149","2014-05-06 13:38:20","5","2014-05-06 13:55:14","","","","");
INSERT INTO complaint VALUES("1709","Maintenance-0001150","The exhaust fan in the ladies toilet at central opd is making lot of noise","Do the needful immediately","5","","25","1","89","","2","5","3","5","","","","96","2014-05-06 13:39:59","25","2014-05-31 08:29:06","","","","");
INSERT INTO complaint VALUES("1710","Maintenance-0001151","The tile in the central opd ladies toilet is broken.","Do the needful asap","12","","386","1","89","","2","12","3","5","","","","96","2014-05-06 13:41:11","227","2014-05-28 15:29:54","","","","");
INSERT INTO complaint VALUES("1711","Maintenance-0001152","Rooms A-1,B-4,B-5,C-1,C-5,C-9,E-10,F-1,F-3,F-4,  D-2,D-4,Calling bell is not working to be check.","as soon as possible.","8","","33","1","63","","2","8","3","7","","","","87","2014-05-06 14:06:23","87","2014-05-22 11:50:30","","","","");
INSERT INTO complaint VALUES("1712","Maintenance-0001153","Room B-5,E-6, cot side rail broken to be fixed. ","as soon as possible.","7","","29","1","63","","2","7","3","7","","","","87","2014-05-06 14:10:06","87","2014-05-07 15:55:42","","","","");
INSERT INTO complaint VALUES("1713","Maintenance-0001154","Room E Toilet commode to be fixed and water leaking to be check.   ","as soon as possible.","6","","31","1","63","","2","6","3","7","","","","87","2014-05-06 14:13:13","87","2014-05-15 14:40:58","","","","");
INSERT INTO complaint VALUES("1714","Maintenance-0001155","Room A-3 socket broken and room G toilet mirror tub light is not working to be check.","as soon as possible.","5","","25","1","63","","2","5","3","7","","","","87","2014-05-06 14:18:45","87","2014-05-07 15:54:54","","","","");
INSERT INTO complaint VALUES("1715","Maintenance-0001156","Room A,door handle to be fixed and b-3 window screw and c-9 pt lock screw and class room notes board screw to be fixed.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-05-06 14:24:48","87","2014-05-07 15:54:28","","","","");
INSERT INTO complaint VALUES("1716","Maintenance-0001157","O2 cylinder is empty","attend soon","7","","27","1","53","","2","7","3","7","","","","225","2014-05-06 14:26:19","225","2014-05-14 13:36:44","","","","");
INSERT INTO complaint VALUES("1717","Maintenance-0001158","Sound not coming for music","Amplifier issue. Checked by MIS. Siad it was amplifier issue","8","","34","1","78","","2","8","3","5","","","","261","2014-05-06 14:48:33","34","2014-05-06 16:27:26","","","","");
INSERT INTO complaint VALUES("1718","MIS-0000560","X-RAY RECEPTION MOUSE RIGHT CLICK NOT WORKING. PLS RECTIFY","X-RAY RECEPTION MOUSE RIGHT CLICK NOT WORKING. PLS RECTIFY","2","","112","1","90","","1","2","3","5","","0","","70","2014-05-06 15:33:57","112","2014-05-06 15:39:03","","","","");
INSERT INTO complaint VALUES("1719","Maintenance-0001159","\"E\" ROOM AND NURSES ROOM BATHROOM SINK IS BLOCKED","URGENT","6","","31","1","65","352","2","6","3","7","","","","84","2014-05-06 16:18:43","84","2014-05-09 09:42:32","","","","");
INSERT INTO complaint VALUES("1720","Maintenance-0001160","O2 CYLINDER EMPTY","TO BE FILLED","5","","25","1","53","129","2","5","3","5","","","","119","2014-05-06 17:00:02","227","2014-05-07 08:45:16","","","","");
INSERT INTO complaint VALUES("1721","Maintenance-0001161","Notice board to be make ","Notice board to be make ","9","","37","1","74","184","2","9","3","5","","","","214","2014-05-07 08:29:20","37","2014-05-08 12:28:41","","","","");
INSERT INTO complaint VALUES("1722","Maintenance-0001162","tube light flickering","plz do the needful.","5","","22","1","49","224","2","5","3","5","","","","95","2014-05-07 08:39:15","22","2014-05-08 15:43:46","","","","");
INSERT INTO complaint VALUES("1723","Maintenance-0001163","Height scale fall down to be replaced  ","Its urgent ","9","","37","1","71","","2","9","3","5","","","","72","2014-05-07 08:43:01","37","2014-05-08 12:29:08","","","","");
INSERT INTO complaint VALUES("1724","MIS-0000561","While printing squeaking sound is heard from the Laserjet printer. Please check, it is urgent.  ","While printing squeaking sound is heard from the Laserjet printer. Please check, it is urgent.  ","2","","5","1","42","","1","2","3","5","5","0","catriage problem","74","2014-05-07 08:47:02","5","2014-05-09 16:38:23","","","","");
INSERT INTO complaint VALUES("1725","Maintenance-0001164","MRD  GLASS DOOR ENTRANCE DOOR  LOCK TO BE REPLACED","NEW LOCK  TO BE FIXED","9","","37","1","37","131","2","9","3","5","","","","150","2014-05-07 09:00:35","37","2014-05-08 12:29:26","","","","");
INSERT INTO complaint VALUES("1726","MIS-0000562","W1 PRINTER NOT WORKING (PRINT NOT COMMING)","W1 PRINTER NOT WORKING (PRINT NOT COMMING)","3","","5","1","42","","1","3","3","5","","","","118","2014-05-07 09:00:59","5","2014-05-07 10:49:02","","","","");
INSERT INTO complaint VALUES("1727","MIS-0000563","W1 IP BILLING PRINTER NOT WORKING","W1 IP BILLING PRINTER NOT WORKING","2","","5","1","42","","1","2","3","5","","0","","369","2014-05-07 09:01:07","5","2014-05-07 10:49:17","","","","");
INSERT INTO complaint VALUES("1728","Maintenance-0001165","wheel chair\'s wheel is detached.","plz fix it immediately .","7","","28","1","49","223","2","7","3","5","","","","95","2014-05-07 09:05:06","28","2014-05-07 12:22:22","","","","");
INSERT INTO complaint VALUES("1729","Maintenance-0001166","bed no 1 oxygen pressure is more","rectify it immediately","7","","28","1","53","","2","7","3","5","","","","85","2014-05-07 09:12:39","28","2014-05-07 10:20:26","","","","");
INSERT INTO complaint VALUES("1730","Maintenance-0001167","\"F\" ROOM AND \"G\" WATER FLOW IS SLOW","URGENT","6","","30","1","65","353","2","6","3","7","","","","84","2014-05-07 09:13:21","84","2014-05-09 09:42:17","","","","");
INSERT INTO complaint VALUES("1731","Maintenance-0001168","wall screening has to be put","wall screening has to be put","9","","37","1","52","61","2","9","3","5","","","","156","2014-05-07 09:30:24","37","2014-05-08 12:29:47","","","","");
INSERT INTO complaint VALUES("1732","MIS-0000564","Tally is not opening. When we are trying to open it is hanging","Urgent","3","","6","1","41","","1","3","3","5","","","","63","2014-05-07 09:41:07","6","2014-05-07 09:50:25","","","","");
INSERT INTO complaint VALUES("1733","Maintenance-0001169","Drug Cupboard wooden door not closing, need pat lock to be fixed    ","Urgent for NABH requirement  ","9","","37","1","108","","2","9","3","5","","","","133","2014-05-07 09:53:52","37","2014-05-08 12:30:15","","","","");
INSERT INTO complaint VALUES("1734","MIS-0000565","printer setting  need to change","printer setting  need to change","2","","112","1","16","19","1","2","3","7","","0","","132","2014-05-07 09:59:09","132","2014-05-08 11:05:43","","","","");
INSERT INTO complaint VALUES("1735","Maintenance-0001170","Door to be repair","Manohar gave complaint ","9","","37","1","70","271","2","9","3","7","","","","16","2014-05-07 10:23:39","16","2014-05-10 08:50:28","","","","");
INSERT INTO complaint VALUES("1736","MIS-0000566","On Mr. shashank ID (shashank ) ould not able to Modify/Edit  in Purchase requisition ","Please do activate ","3","","6","1","28","","1","3","3","7","","","","117","2014-05-07 10:48:45","117","2014-06-04 09:00:15","","","","");
INSERT INTO complaint VALUES("1737","Maintenance-0001171","seepage  in the male changing room side to the passage","non complaints from quality office audit","12","","386","1","58","201","2","12","3","5","","","","122","2014-05-07 11:02:07","227","2014-05-28 15:29:39","","","","");
INSERT INTO complaint VALUES("1738","Maintenance-0001172","OT-6 sluice room pipe line is disconnected","urgent","6","","32","1","58","197","2","6","3","5","","","","122","2014-05-07 11:03:14","32","2014-05-08 12:22:22","","","","");
INSERT INTO complaint VALUES("1739","Maintenance-0001173","SINK IS BLOCKED.","SINK IS BLOCKED","6","","32","1","61","303","2","6","3","5","6","","Outsource to be done ","104","2014-05-07 11:11:39","32","2014-05-08 12:22:39","","","","");
INSERT INTO complaint VALUES("1740","Maintenance-0001174","exhaust fan is not working.","urgent.","5","","22","1","73","102","2","5","3","5","","","","211","2014-05-07 11:15:16","22","2014-05-08 12:08:20","","","","");
INSERT INTO complaint VALUES("1741","Maintenance-0001175","BIG AUTO CLAVE  IS NOT WORKING","URGENT","7","","27","1","58","200","2","7","3","5","6","","Outsource to be done ","122","2014-05-07 11:39:25","27","2014-06-05 15:28:42","","","","");
INSERT INTO complaint VALUES("1742","Maintenance-0001176","pc opd toilet blocked","please come immediatly","6","","32","1","102","","2","6","3","5","","","","246","2014-05-07 12:01:42","32","2014-05-08 12:22:58","","","","");
INSERT INTO complaint VALUES("1743","MIS-0000567","Epson printer is not printing properly","High priority","2","","112","1","40","11","1","2","3","7","","0","","313","2014-05-07 12:22:37","313","2014-05-17 12:42:01","","","","");
INSERT INTO complaint VALUES("1744","Maintenance-0001177","AC is leaking in PACS room",".....","10","","26","1","104","","2","10","3","5","","","","70","2014-05-07 12:44:52","26","2014-05-08 12:24:11","","","","");
INSERT INTO complaint VALUES("1745","Maintenance-0001178","transcription wodden door is come out in lab 2 nd floor so pls rectifi it soon","its urgent","9","","37","1","17","147","2","9","3","7","","","","113","2014-05-07 14:11:01","113","2014-05-08 14:07:51","","","","");
INSERT INTO complaint VALUES("1746","Maintenance-0001179","CRP-05   Key board tray broken","high priority","9","","37","1","40","63","2","9","3","7","","","","65","2014-05-07 14:52:31","65","2014-05-10 08:23:30","","","","");
INSERT INTO complaint VALUES("1747","Maintenance-0001180","x-ray view box line to be fix","x-ray view box line to be fix","5","","25","1","74","186","2","5","3","5","","","","214","2014-05-07 15:15:02","25","2014-05-08 12:25:13","","","","");
INSERT INTO complaint VALUES("1748","MIS-0000568","Nurses station - 2 printer is not working to be check.","as soon as possible.","2","","5","1","63","","1","2","3","7","","0","","87","2014-05-07 15:48:20","87","2014-05-15 14:40:31","","","","");
INSERT INTO complaint VALUES("1749","Maintenance-0001181","room H bed- 1 cot wood screw coming out and nurses station - 2 drawer screw coming out to  be fix.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-05-07 15:50:41","87","2014-05-09 14:53:42","","","","");
INSERT INTO complaint VALUES("1750","Maintenance-0001182","room E bed -3, bed - 7 switch is not working to be check.","as soon as possible.","5","","25","1","63","","2","5","3","7","","","","87","2014-05-07 15:52:24","87","2014-05-09 14:54:04","","","","");
INSERT INTO complaint VALUES("1751","Maintenance-0001183","pt wheel chair broken to be check.","as early as possible.","7","","28","1","63","","2","7","3","5","","","","87","2014-05-07 15:57:58","28","2014-05-08 12:19:01","","","","");
INSERT INTO complaint VALUES("1752","Maintenance-0001184","urinal sink is blocked in staff gents toilet near IP billing.","urgent","6","","31","1","47","105","2","6","3","5","","","","149","2014-05-07 16:03:56","31","2014-05-08 12:18:14","","","","");
INSERT INTO complaint VALUES("1753","Maintenance-0001185","Aquaguard to be repaired","very urgent","6","","32","1","65","","2","6","3","7","","","","84","2014-05-08 07:49:00","84","2014-05-09 09:44:03","","","","");
INSERT INTO complaint VALUES("1754","Maintenance-0001186","ROOM NO 1504 OXYGEN LEAKING FROM O2 FLOW METER","PLEASE COME IMMEDIATELY","7","","27","1","49","225","2","7","3","5","","","","97","2014-05-08 07:56:37","27","2014-05-08 12:26:35","","","","");
INSERT INTO complaint VALUES("1755","Maintenance-0001187","ALL THE ROOMS CALL BELL NOT WORKING ","PLEASE RECTIFY IMMEDIATELY.","8","","34","1","49","242","2","8","3","5","","","","97","2014-05-08 07:57:25","34","2014-05-08 15:38:45","","","","");
INSERT INTO complaint VALUES("1756","MIS-0000569","Printer is not working","urgent","2","","112","1","60","","1","2","3","5","","0","","145","2014-05-08 08:15:28","112","2014-05-08 08:29:41","","","","");
INSERT INTO complaint VALUES("1757","Maintenance-0001188","tube light not working in the linen room","urgent","5","","22","1","115","","2","5","3","5","","","","149","2014-05-08 08:26:12","22","2014-05-08 15:43:36","","","","");
INSERT INTO complaint VALUES("1758","Maintenance-0001189","POP  roof is leaking inside the ccu.","POP  roof is leaking inside the ccu.","12","","386","1","52","61","2","12","3","5","6","","Roof leaking to be done by outsource ","156","2014-05-08 08:28:39","227","2014-06-21 11:31:22","","","","");
INSERT INTO complaint VALUES("1759","Maintenance-0001190","CCU patient toilet hand supporter has loose connection","CCU patient toilet hand supporter has loose connection","9","","37","1","52","61","2","9","3","5","","","","156","2014-05-08 08:30:50","37","2014-05-08 12:27:51","","","","");
INSERT INTO complaint VALUES("1760","Maintenance-0001191","TUBE LIGHT IS NOT WORKING ","IT IS BLINKING SO KINDLY CHANGE ASAP","5","","22","1","30","","2","5","3","7","","","","148","2014-05-08 09:42:02","148","2014-06-05 09:15:59","","","","");
INSERT INTO complaint VALUES("1761","MIS-0000570","Nurses station - 2 printer is not working to be check.","as soon as possible.","2","","5","1","63","","1","2","3","7","","0","","87","2014-05-08 09:56:14","87","2014-05-08 11:50:04","","","","");
INSERT INTO complaint VALUES("1762","MIS-0000571","Brother Printer is not working.","It is rather urgent because the person who refills the cartridge is here right now.  thank you   ","2","","5","1","94","","1","2","3","7","","0","","136","2014-05-08 10:22:10","136","2014-05-13 09:31:31","","","","");
INSERT INTO complaint VALUES("1763","MIS-0000572","Mother insurance wrongly entered twice , it has to be deleted
INSERT INTO complaint VALUES("1764","MIS-0000573","system slow EHR not working ","system slow EHR not working ","3","","5","1","74","","1","3","3","5","","","","214","2014-05-08 10:38:24","5","2014-05-08 11:54:26","","","","");
INSERT INTO complaint VALUES("1765","MIS-0000574","IPB-07 ACCPAC NOT OPENING","IPB-07 ACCPAC NOT OPENING","3","","5","1","42","","1","3","3","5","","","","118","2014-05-08 10:58:38","5","2014-05-08 11:01:53","","","","");
INSERT INTO complaint VALUES("1766","MIS-0000575","sagacpac  is not working","sageacpac  is not working","2","","112","1","64","","1","2","3","5","","0","","108","2014-05-08 11:03:21","112","2014-05-08 11:04:19","","","","");
INSERT INTO complaint VALUES("1767","Maintenance-0001192","door stand need to fix","door stand need to fix","9","","37","1","16","176","2","9","3","7","","","","132","2014-05-08 11:04:42","132","2014-05-16 10:43:24","","","","");
INSERT INTO complaint VALUES("1768","Maintenance-0001193","fan is repair","fan is repair","5","","22","1","16","177","2","5","3","7","","","","132","2014-05-08 11:05:20","132","2014-05-16 10:42:56","","","","");
INSERT INTO complaint VALUES("1769","Maintenance-0001194","oxygen cylinder 2 nos","empty","7","","28","1","81","","2","7","3","5","","","","98","2014-05-08 11:05:22","28","2014-05-08 12:19:43","","","","");
INSERT INTO complaint VALUES("1770","Maintenance-0001195"," J ROOM  WALL OXYGEN IS LEAKING","J ROOM WALL OXYGEN IS LEAKING","7","","28","1","64","","2","7","3","5","","","","109","2014-05-08 11:07:22","28","2014-05-08 12:19:19","","","","");
INSERT INTO complaint VALUES("1771","Maintenance-0001196","Phone not working","Phone not working","8","","33","1","70","269","2","8","3","7","6","","","227","2014-05-08 11:17:17","227","2014-05-28 15:11:10","","","","");
INSERT INTO complaint VALUES("1772","Maintenance-0001197","room i shower to be fixed.","as soon as possible.","6","","30","1","63","","2","6","3","7","","","","87","2014-05-08 11:46:23","87","2014-05-09 14:53:13","","","","");
INSERT INTO complaint VALUES("1773","MIS-0000576","Nurses station - 2 printer is not working to be check.","as soon as possible.","2","","112","1","63","","1","2","3","7","","901","","87","2014-05-08 11:50:30","87","2014-06-19 10:25:34","","","","");
INSERT INTO complaint VALUES("1774","Maintenance-0001198","Drainage pip line broken","Drainage pip line broken","6","","32","1","84","","2","6","3","7","","","","16","2014-05-08 12:36:20","16","2014-05-10 08:50:21","","","","");
INSERT INTO complaint VALUES("1775","Maintenance-0001199","D room hand flush to be fixed ","D room hand flush to be fixed ","6","","32","1","64","","2","6","3","7","","","","16","2014-05-08 12:37:07","16","2014-05-10 08:50:05","","","","");
INSERT INTO complaint VALUES("1776","Maintenance-0001200","CCU PLUG BOARD IS NOT WORKING","CCU PLUG BOARD IS NOT WORKING","5","","25","1","52","62","2","5","3","5","","","","156","2014-05-08 12:43:48","25","2014-05-08 17:46:41","","","","");
INSERT INTO complaint VALUES("1777","Maintenance-0001201","There is a leakage in the wall. Kindly do the needful","Very Very Urgent","12","","386","1","55","","2","12","3","3","6","","Due to PC 3rd floor construction in progress hence its leaking","73","2014-05-08 13:41:40","227","2014-05-14 08:45:55","","","","");
INSERT INTO complaint VALUES("1778","MIS-0000577","PRINTER NOT WORKING","PRINTER NOT WORKING","2","","5","1","44","361","1","2","3","7","","0","","348","2014-05-08 14:04:16","348","2014-05-16 09:33:21","","","","");
INSERT INTO complaint VALUES("1779","Maintenance-0001202","METALDOOR OF BLOOD BANK IS NOT WORKING SO PLS RECTIFY IT SOON","ITS URGENT","9","","37","1","17","142","2","9","3","7","","","","113","2014-05-08 14:05:37","113","2014-05-13 17:16:59","","","","");
INSERT INTO complaint VALUES("1780","Maintenance-0001203","Curtain clamp has broken in the old students hostel ","urgent ","9","","37","4","107","","2","9","3","7","","","","265","2014-05-08 15:00:57","265","2014-05-26 10:10:54","","","","");
INSERT INTO complaint VALUES("1781","Maintenance-0001204","UPS connection to be connected to CSSD computer system ","Urgent","7","","28","1","57","","2","7","3","3","6","","Battery to be replace in the UPS hence brought to maintenance","121","2014-05-08 15:27:04","28","2014-05-09 11:16:45","","","","");
INSERT INTO complaint VALUES("1782","Maintenance-0001205","nurses station phone not working not able to hear properly.","please come ASAP","8","","33","1","49","242","2","8","3","5","","","","97","2014-05-08 15:29:28","33","2014-05-10 13:06:36","","","","");
INSERT INTO complaint VALUES("1783","Maintenance-0001206","Projector not working in ct scan to be checked  ","rectify soon","8","","33","1","30","","2","8","3","7","","","","16","2014-05-08 15:32:21","16","2014-05-10 08:50:13","","","","");
INSERT INTO complaint VALUES("1784","Maintenance-0001207","TV not working ","TV not working ","8","","33","1","56","","2","8","3","7","","","","16","2014-05-08 15:32:58","16","2014-05-10 08:49:55","","","","");
INSERT INTO complaint VALUES("1785","Maintenance-0001208","PA system to be arranged in Auditorium at 4 pm to 5.30pm","PA system to be arranged in Auditorium at 4 pm to 5.30pm","8","","33","1","94","","2","8","3","7","","","","16","2014-05-08 15:33:32","16","2014-05-10 08:49:45","","","","");
INSERT INTO complaint VALUES("1786","Maintenance-0001209","white board fallen","needs to be fixed","9","","37","1","81","","2","9","3","5","","","","98","2014-05-08 15:41:24","227","2014-05-08 17:48:07","","","","");
INSERT INTO complaint VALUES("1787","Maintenance-0001210","Dryer coil to be replaced","repair","7","","28","1","84","158","2","7","3","5","","","","351","2014-05-08 15:49:23","28","2014-05-09 11:17:12","","","","");
INSERT INTO complaint VALUES("1788","MIS-0000578","EPSON PRINTER NOT WORKING","HIGH PRIORITY","2","","112","1","40","11","1","2","3","7","","0","","313","2014-05-08 16:11:48","313","2014-05-17 12:40:35","","","","");
INSERT INTO complaint VALUES("1789","Maintenance-0001211","geaser is not working to be check. ","as soon as possible,","6","","30","1","63","324","2","6","3","7","","","","87","2014-05-08 16:28:53","87","2014-05-15 14:38:44","","","","");
INSERT INTO complaint VALUES("1790","MIS-0000579","printer","is not working.","2","","112","1","61","","1","2","3","5","","0","","107","2014-05-09 07:51:14","112","2014-05-09 08:21:02","","","","");
INSERT INTO complaint VALUES("1791","Maintenance-0001212","AC to be checked . No cooling in the server room.","AC to be checked . No cooling in the server room.","10","","26","1","3","168","2","10","3","7","","","","6","2014-05-09 08:14:23","6","2014-05-12 11:43:53","","","","");
INSERT INTO complaint VALUES("1792","MIS-0000580","CRP-11 unable to switch on the system","high priority","2","","112","1","40","12","1","2","3","7","","0","","65","2014-05-09 08:20:24","65","2014-05-09 10:12:00","","","","");
INSERT INTO complaint VALUES("1793","Maintenance-0001213","splint needed for NICU (50 Nos)","urgent","9","","37","1","55","","2","9","3","5","","","","73","2014-05-09 08:30:24","37","2014-05-09 10:40:56","","","","");
INSERT INTO complaint VALUES("1794","Maintenance-0001214","In staff room.","cupboard latch to be fixed. ","9","","37","1","62","","2","9","3","5","","","","107","2014-05-09 08:43:29","37","2014-05-09 10:41:35","","","","");
INSERT INTO complaint VALUES("1795","Maintenance-0001215","There is water seepage inside the Cath lab.","Kindly do it at the earliest as there are cases today.","12","","386","1","52","62","2","12","3","2","","","","128","2014-05-09 08:51:31","227","2014-05-14 08:57:02","","","","");
INSERT INTO complaint VALUES("1796","Maintenance-0001216","Brand new refrigerator not functioning ","No cooling. Only light is coming","7","","28","1","78","","2","7","3","5","","","","261","2014-05-09 08:58:23","28","2014-05-09 10:37:18","","","","");
INSERT INTO complaint VALUES("1797","MIS-0000581","moniter problem","kindly do the needful","2","","112","1","101","","1","2","3","7","","0","","387","2014-05-09 09:00:49","387","2014-06-13 11:13:03","","","","");
INSERT INTO complaint VALUES("1798","Maintenance-0001217","Bed no.11 wall suction apparatus not working
INSERT INTO complaint VALUES("1799","Maintenance-0001218","w-  III carder.","Three sited chair to be fixed.","9","","37","1","62","","2","9","3","5","","","","107","2014-05-09 09:19:07","37","2014-05-09 10:41:51","","","","");
INSERT INTO complaint VALUES("1800","MIS-0000582","male side","ip billing is not opening in w-5 male side system","3","","112","1","64","","1","3","3","5","","","","372","2014-05-09 09:34:59","112","2014-05-09 10:18:48","","","","");
INSERT INTO complaint VALUES("1801","Maintenance-0001219","UTILITY ROOM","LAUNDRY BOX TO  BE REPAIRED","9","","37","1","64","","2","9","3","7","","","","110","2014-05-09 09:35:55","110","2014-05-16 11:34:59","","","","");
INSERT INTO complaint VALUES("1802","Maintenance-0001220","I-ROOM TOILET","CUBOARD TO BE REPAIRED","9","","37","1","64","","2","9","3","7","","","","110","2014-05-09 09:36:27","110","2014-05-16 11:34:32","","","","");
INSERT INTO complaint VALUES("1803","Maintenance-0001221","patient cupboard is broken","urgent","9","","37","1","60","","2","9","3","5","","","","103","2014-05-09 09:47:00","37","2014-05-09 10:42:42","","","","");
INSERT INTO complaint VALUES("1804","Maintenance-0001222","aquguard switch is broken","urgent","6","","30","1","60","","2","6","3","2","","","","103","2014-05-09 09:47:46","227","2014-05-09 10:21:38","","","","");
INSERT INTO complaint VALUES("1805","Maintenance-0001223","tap is broken","urgent","6","","30","1","60","285","2","6","3","5","","","","103","2014-05-09 09:48:47","30","2014-05-09 12:01:00","","","","");
INSERT INTO complaint VALUES("1806","Maintenance-0001224","switch is broken","urgent","5","","22","1","60","284","2","5","3","5","","","","103","2014-05-09 09:50:02","22","2014-05-09 16:45:52","","","","");
INSERT INTO complaint VALUES("1807","Maintenance-0001225","Tb room bio safety cabinet which should be with UPS connection is getting switch off when current supply goes off.","Urgent--","7","","28","1","17","151","2","7","3","7","9","","Refereed to company","302","2014-05-09 09:58:17","302","2014-05-16 07:46:03","","","","");
INSERT INTO complaint VALUES("1808","Maintenance-0001226","pc ward  varanda small 2 feet tube light not working
INSERT INTO complaint VALUES("1809","MIS-0000583","MALE SIDE","SYSTEM IS NOT WORKING SAGE ACCPAC NURSING DESKTOP IS NOT OPENING ","2","","112","1","64","","1","2","3","7","","0","","110","2014-05-09 10:07:29","110","2014-05-16 11:34:14","","","","");
INSERT INTO complaint VALUES("1810","MIS-0000584","Desktop file every thing is gone 
INSERT INTO complaint VALUES("1811","MIS-0000585","X-RAY COUNTER SYSTEM IS NOT SWITCHING ON","..........","2","","5","1","90","","1","2","3","5","","0","","70","2014-05-09 10:22:29","5","2014-05-09 10:47:21","","","","");
INSERT INTO complaint VALUES("1812","Maintenance-0001227","Computer LAN not working","Computer LAN not working","8","","33","1","27","","2","8","3","7","","","","16","2014-05-09 10:32:02","16","2014-05-19 15:25:33","","","","");
INSERT INTO complaint VALUES("1813","MIS-0000586","printer is not working","printer is not working","2","","112","1","16","19","1","2","3","7","","0","","132","2014-05-09 10:34:43","132","2014-05-16 10:42:39","","","","");
INSERT INTO complaint VALUES("1814","Maintenance-0001228","we have autoclave in which the manometer is not working properly.","urgent","7","","28","1","17","141","2","7","3","5","","","","300","2014-05-09 10:36:38","28","2014-05-09 15:37:14","","","","");
INSERT INTO complaint VALUES("1815","Maintenance-0001229","\"B\" Toilet Bathroom is making noise while closing door","urgent ","9","","37","1","65","","2","9","3","7","","","","84","2014-05-09 10:36:47","84","2014-05-12 08:05:10","","","","");
INSERT INTO complaint VALUES("1816","Maintenance-0001230","\"E\" Room Bathroom Door to be repaired ","very urgent ","9","","37","1","65","352","2","9","3","7","","","","84","2014-05-09 10:38:39","84","2014-05-13 15:11:20","","","","");
INSERT INTO complaint VALUES("1817","MIS-0000587","EPSON PRINTER not working","high priority","2","","112","1","40","11","1","2","3","7","","0","","65","2014-05-09 11:12:54","65","2014-05-10 08:23:16","","","","");
INSERT INTO complaint VALUES("1818","Maintenance-0001231","Qtrs Dr Rachel House Tolet blocked ","complaint by on call","6","","30","1","2","","2","6","3","7","","","","16","2014-05-09 11:14:04","16","2014-05-10 08:49:36","","","","");
INSERT INTO complaint VALUES("1819","Maintenance-0001232","patient cot foot head is broken","urgent","7","","28","1","60","","2","7","3","5","","","","103","2014-05-09 11:20:41","28","2014-05-09 15:38:12","","","","");
INSERT INTO complaint VALUES("1820","Maintenance-0001233","wheel chair belt to be fixe","urgent","7","","28","1","60","","2","7","3","5","","","","103","2014-05-09 11:21:47","28","2014-05-09 15:37:51","","","","");
INSERT INTO complaint VALUES("1821","Maintenance-0001234","testing dept admin","testing dept admin","12","","386","2","64","","2","12","3","5","","","","391","2014-05-09 11:29:36","227","2014-05-09 11:35:36","","","","");
INSERT INTO complaint VALUES("1822","MIS-0000588","testing dept admin","testing dept admin","3","","6","1","64","","1","3","3","5","","","","391","2014-05-09 11:29:50","6","2014-05-17 08:55:29","","","","");
INSERT INTO complaint VALUES("1823","Maintenance-0001235","K-ROOM BED NO:2 SUCTION IS NOT WORKING","EMERGENCY ","7","","28","1","64","","2","7","3","7","","","","110","2014-05-09 11:40:32","110","2014-05-16 11:33:47","","","","");
INSERT INTO complaint VALUES("1824","MIS-0000589","X-RAY CR ROOM SYSTEM IS GETTING SHUT DOWN ON AND OFF REPEATEDLY FROM MORNING. PLS RECTIFY ","X-RAY CR ROOM SYSTEM IS GETTING SHUT DOWN ON AND OFF REPEATEDLY FROM MORNING. PLS RECTIFY ","2","","112","1","90","","1","2","3","5","","0","","70","2014-05-09 12:04:23","112","2014-05-09 12:42:24","","","","");
INSERT INTO complaint VALUES("1825","Maintenance-0001236","A C not cooling ","the cooling is required to store the drugs below 25 degrees","10","","26","1","18","216","2","10","3","7","","","","64","2014-05-09 12:14:14","64","2014-05-29 08:47:00","","","","");
INSERT INTO complaint VALUES("1826","Maintenance-0001237","patient trolly wheel is broken","rectify urgently","7","","28","1","53","","2","7","3","5","9","","under warranty hence supplier has to service","85","2014-05-09 12:28:34","28","2014-06-07 13:13:34","","","","");
INSERT INTO complaint VALUES("1827","Maintenance-0001238","Bicycle and table screw to be tightened","urgent","9","","37","1","114","","2","9","3","5","","","","73","2014-05-09 14:35:08","37","2014-05-09 15:45:52","","","","");
INSERT INTO complaint VALUES("1828","Maintenance-0001239","Room \'B\' hand wash sink water is not going to be check.","as soon as possible.","6","","31","1","63","","2","6","3","7","","","","87","2014-05-09 14:52:37","87","2014-05-15 14:39:13","","","","");
INSERT INTO complaint VALUES("1829","MIS-0000590","Server down.Not able to access zimbra","Please rectify ASAP","3","","5","1","66","","1","3","3","5","5","","checking               ","366","2014-05-09 15:00:25","5","2014-05-10 10:40:12","","","","");
INSERT INTO complaint VALUES("1830","MIS-0000591","Photography for farewell function on 9th May 2014 for Mrs.Indira . ","URGENT.","2","","8","1","47","","1","2","3","5","","0","","149","2014-05-09 15:34:23","8","2014-05-10 08:51:59","","","","");
INSERT INTO complaint VALUES("1831","MIS-0000592","computer qlt  02 ","re installation of windows","3","","5","1","26","","1","3","3","7","","","","76","2014-05-09 15:46:15","76","2014-05-12 08:17:02","","","","");
INSERT INTO complaint VALUES("1832","Maintenance-0001240","SINK IS BLOCKED","PLEASE RECTIFY SOON","6","","31","1","64","339","2","6","3","7","","","","110","2014-05-09 15:49:40","110","2014-05-16 11:33:30","","","","");
INSERT INTO complaint VALUES("1833","MIS-0000593","user ID is not working
INSERT INTO complaint VALUES("1834","MIS-0000594","CRP-06 unable to print","high priority","2","","112","1","40","12","1","2","3","7","","704","","65","2014-05-10 08:22:30","65","2014-05-14 07:59:58","","","","");
INSERT INTO complaint VALUES("1835","MIS-0000595","Zebra bar code machine is not working in 2 nd floor lab so pls rectifi it soon ","its urgent","2","","5","1","17","34","1","2","3","7","","0","","113","2014-05-10 08:23:27","113","2014-05-10 13:27:51","","","","");
INSERT INTO complaint VALUES("1836","Maintenance-0001241","NOTICE BOARD  TO BE FIX ","NOTICE BOARD  TO BE FIX ","9","","37","1","74","184","2","9","3","5","","","","214","2014-05-10 08:29:37","37","2014-05-10 13:05:56","","","","");
INSERT INTO complaint VALUES("1837","Maintenance-0001242","CryoCan to refill ","its urgent ","7","","26","1","75","","2","7","3","5","","","","207","2014-05-10 08:37:40","26","2014-05-13 16:15:20","","","","");
INSERT INTO complaint VALUES("1838","MIS-0000596","printer not wrkng","printer not wrkng","2","","112","1","44","363","1","2","3","5","","0","","381","2014-05-10 08:40:59","112","2014-05-10 08:45:49","","","","");
INSERT INTO complaint VALUES("1839","Maintenance-0001243","urgently we need to fix one door closer for the labour room entrance door to stop the entry of mosquitoes.","Emergency require","9","","37","1","59","","2","9","3","7","","","","16","2014-05-10 08:47:46","16","2014-06-17 12:20:52","","","","");
INSERT INTO complaint VALUES("1840","MIS-0000597","N-computing system slow","user id: jude","3","","8","1","80","","1","3","3","5","","","","359","2014-05-10 09:03:55","8","2014-05-10 09:25:01","","","","");
INSERT INTO complaint VALUES("1841","MIS-0000598","some of the mails are not received in outlook express","urgent","3","","8","1","54","","1","3","3","5","","","","73","2014-05-10 09:04:31","8","2014-05-10 10:00:04","","","","");
INSERT INTO complaint VALUES("1842","Maintenance-0001244","Qtrs Crest View -1 Thankam Rangala house kitchen tap to be repair","rectify soon","6","","30","3","2","","2","6","3","7","","","","16","2014-05-10 09:31:23","16","2014-05-19 15:25:21","","","","");
INSERT INTO complaint VALUES("1843","Maintenance-0001245","Qtrs Crest View -1 Thankam Rangala house Full length mirror require 2 no","urgent require","9","","37","3","2","","2","9","3","3","9","","It will be delayed ","16","2014-05-10 09:32:25","227","2014-05-10 10:18:53","","","","");
INSERT INTO complaint VALUES("1844","Maintenance-0001246","Near PC Lobby staff room tube light is not working to be replace. 
INSERT INTO complaint VALUES("1845","Maintenance-0001247","1. Patient sitting benches broken to be repaired 
INSERT INTO complaint VALUES("1846","Maintenance-0001248","HIGH RISK LABOUR ROOM WASH BASIN TAP AND
INSERT INTO complaint VALUES("1847","MIS-0000599","This to bring ti your notice that W-IV computer  name.2
INSERT INTO complaint VALUES("1848","Maintenance-0001249","Aidec chair not working","Wire connecting compressor foot switch stuck beneath the chair. Pl attend at the earliest","7","","26","1","78","","2","7","3","5","","","","261","2014-05-10 10:11:39","227","2014-05-10 11:39:18","","","","");
INSERT INTO complaint VALUES("1849","Maintenance-0001250","switch is broken","urgent","5","","22","1","60","284","2","5","3","5","","","","103","2014-05-10 10:17:36","22","2014-05-10 11:34:14","","","","");
INSERT INTO complaint VALUES("1850","Maintenance-0001251","light is not working","urgent
INSERT INTO complaint VALUES("1851","Maintenance-0001252","trolly belt to be fixed","urgent","7","","26","1","60","","2","7","3","5","","","","103","2014-05-10 10:22:04","26","2014-05-17 12:47:29","","","","");
INSERT INTO complaint VALUES("1852","Maintenance-0001253","NURSES STATION OXYGEN CYLINDER IS EMPTY","PLEASE SEND FAST","6","","32","1","64","","2","6","3","7","","","","110","2014-05-10 10:41:56","110","2014-05-16 11:33:16","","","","");
INSERT INTO complaint VALUES("1853","Maintenance-0001254","TAPS ARE LEAKING","PLEASE RECTIFY SOON","6","","30","1","64","331","2","6","3","7","","","","110","2014-05-10 10:42:38","110","2014-05-16 11:32:52","","","","");
INSERT INTO complaint VALUES("1854","Maintenance-0001255","K-ROOM FLUSH IS NOT WORKING","PLEASE RECTIFY SOON","6","","30","1","64","","2","6","3","7","","","","110","2014-05-10 10:43:14","110","2014-05-16 11:31:46","","","","");
INSERT INTO complaint VALUES("1855","Maintenance-0001256","annex floor ","flooring of annex needs repair","12","","386","1","81","","2","12","3","3","8","","outsource to be done","98","2014-05-10 11:13:06","227","2014-05-10 11:18:16","","","","");
INSERT INTO complaint VALUES("1856","Maintenance-0001257","2 Autoclave not working properly.","2 Autoclave not working properly.","7","","26","1","17","141","2","7","1","2","","","","300","2014-05-10 11:29:16","227","2014-06-18 10:55:14","","","","");
INSERT INTO complaint VALUES("1857","MIS-0000600","1.Aerobic culture report showing validated,culture no is displayed,preliminary report is also displayed but Specimen is not displayed in the Delux ward-complaint by Dr Umashanker..
INSERT INTO complaint VALUES("1858","MIS-0000601","INSTALLATION OF NEW BAR CODE PRINTER IN 2ND FLOOR LAB","ITS URGENT","2","","5","1","17","34","1","2","3","7","","0","","113","2014-05-10 13:27:17","113","2014-05-13 17:16:37","","","","");
INSERT INTO complaint VALUES("1859","MIS-0000602","CRP-11  unable to open Z drive","high priority","2","","112","1","40","12","1","2","3","7","","709","","65","2014-05-12 07:51:20","65","2014-06-02 08:11:22","","","","");
INSERT INTO complaint VALUES("1860","Maintenance-0001258","Aqua guard is still making noise while taking water ","very urgent","6","","31","1","65","","2","6","3","7","9","","Informed KENT AMC vendor to service machine ","84","2014-05-12 08:07:15","84","2014-05-19 08:53:20","","","","");
INSERT INTO complaint VALUES("1861","MIS-0000603","\"E-1\" calling is ringing continuously ","very urgent ","","","123","1","65","","1","2","3","7","","","null","84","2014-05-12 08:08:30","84","2014-05-12 08:08:30","","","","");
INSERT INTO complaint VALUES("1862","Maintenance-0001259","\"E-1\" calling is ringing continuously ","very urgent ","8","","33","1","65","","2","8","3","7","","","","84","2014-05-12 08:10:12","84","2014-05-19 08:55:29","","","","");
INSERT INTO complaint VALUES("1863","Maintenance-0001260","calling bell  problem","urgent","8","","33","1","60","284","2","8","3","5","","","","103","2014-05-12 08:18:36","33","2014-05-12 16:13:38","","","","");
INSERT INTO complaint VALUES("1864","MIS-0000604","Sal 03 is not opening","Sal 03 is not opening","2","","112","1","39","","1","2","3","5","","0","","349","2014-05-12 08:19:47","112","2014-05-12 08:30:18","","","","");
INSERT INTO complaint VALUES("1865","MIS-0000605","system is showing error in lab 2 nd floor so pls rectifi it soon","its urgrent","2","","112","1","17","34","1","2","3","7","","0","","113","2014-05-12 08:31:48","113","2014-05-13 17:16:19","","","","");
INSERT INTO complaint VALUES("1866","MIS-0000606","Internet connectivity problem. Outlook and net connectivity failure.","Need urgent intervention","3","","5","1","27","","1","3","3","5","","","","261","2014-05-12 08:33:45","5","2014-05-12 09:48:05","","","","");
INSERT INTO complaint VALUES("1867","Maintenance-0001261","labour room toilet room bulb not working","attend soon","5","","25","1","59","","2","5","3","7","","","","225","2014-05-12 08:37:23","225","2014-05-14 13:36:24","","","","");
INSERT INTO complaint VALUES("1868","Maintenance-0001262","Men\'s hostel Dr.Vinodh room side tube light not working","attend soon","5","","25","2","2","","2","5","3","7","","","","225","2014-05-12 08:38:33","225","2014-05-14 13:35:57","","","","");
INSERT INTO complaint VALUES("1869","Maintenance-0001263","in deluxe room 3205 geyser is not working ","kindly do the needful as soon as possible for patient satisfaction ","6","","31","1","50","","2","6","3","5","","","","126","2014-05-12 08:57:41","31","2014-05-12 10:36:36","","","","");
INSERT INTO complaint VALUES("1870","MIS-0000607","Sage Accpac is not working","please rectify soon","2","","112","1","64","21","1","2","3","7","","0","","110","2014-05-12 09:00:53","110","2014-05-16 11:31:28","","","","");
INSERT INTO complaint VALUES("1871","Maintenance-0001264","K-Room Flush water is not coming","please rectify soon","6","","32","1","64","","2","6","3","7","","","","110","2014-05-12 09:01:40","110","2014-05-16 11:31:09","","","","");
INSERT INTO complaint VALUES("1872","Maintenance-0001265","Linen Room cuboard to be repaired","please rectify soon","9","","37","1","64","","2","9","3","7","","","","110","2014-05-12 09:03:06","110","2014-05-16 09:56:01","","","","");
INSERT INTO complaint VALUES("1873","Maintenance-0001266","Tube light is blinking in CCU Staff rest room.
INSERT INTO complaint VALUES("1874","Maintenance-0001267","In CCU, patient cot side rails and cot wheels are not working properly.","Please rectify it at the earliest.","7","","28","1","52","","2","7","3","3","1","","wheels non stock raised waiting for items ","128","2014-05-12 09:11:17","28","2014-05-12 12:04:02","","","","");
INSERT INTO complaint VALUES("1875","Maintenance-0001268","steam machine is not working to be check.","as soon as possible.","7","","28","1","63","","2","7","3","7","","","","87","2014-05-12 09:30:00","87","2014-05-15 14:34:22","","","","");
INSERT INTO complaint VALUES("1876","MIS-0000608","PRINTER NOT WORKING","PRINTER NOT WORKING","2","","5","1","16","19","1","2","3","7","","0","","132","2014-05-12 10:10:32","132","2014-05-16 10:42:26","","","","");
INSERT INTO complaint VALUES("1877","Maintenance-0001269","Qtrs Q-3 Dr Rachel house kitchne sink blocked ","Qtrs Q-3 Dr Rachel house kitchne sink blocked ","6","","32","3","2","","2","6","3","7","","","","16","2014-05-12 10:14:26","16","2014-05-28 15:11:59","","","","");
INSERT INTO complaint VALUES("1878","Maintenance-0001270","canteen service area switch is broken","attend soon ","5","","24","1","68","","2","5","3","7","","","","225","2014-05-12 10:21:47","225","2014-05-14 13:35:22","","","","");
INSERT INTO complaint VALUES("1879","Maintenance-0001271"," accpac network connection is not working there is some problem in network connection informed by MIS","DO IT AS PER AS POSSIBLE ","8","","33","1","58","199","2","8","3","5","9","","outsource to be done hence complaint  forwarded to Project mushtaq ","124","2014-05-12 10:24:07","33","2014-05-14 16:38:50","","","","");
INSERT INTO complaint VALUES("1880","MIS-0000609","Library printer is not working, and
INSERT INTO complaint VALUES("1881","Maintenance-0001272","TAP IS BROKEN","URGENT","6","","32","1","60","277","2","6","3","5","","","","103","2014-05-12 10:35:59","32","2014-05-12 15:58:16","","","","");
INSERT INTO complaint VALUES("1882","Maintenance-0001273","FAN  IS PROBLEM IT MAKING SOUND","URGENT","5","","24","1","60","277","2","5","3","5","","","","103","2014-05-12 10:39:58","24","2014-05-12 12:15:35","","","","");
INSERT INTO complaint VALUES("1883","Maintenance-0001274","CCU Access door is not working properly.","Please rectify it at the earliest.","5","","24","1","52","","2","5","3","7","","","","128","2014-05-12 10:55:57","128","2014-05-21 08:19:30","","","","");
INSERT INTO complaint VALUES("1884","Maintenance-0001275","door handle to be fixed for high risk labour room ","pls do ASAP","9","","37","1","59","","2","9","3","5","","","","100","2014-05-12 11:06:41","37","2014-05-14 16:33:55","","","","");
INSERT INTO complaint VALUES("1885","Maintenance-0001276","remove pest-o-Flash & Tube-lights to do deep clean in Kitchen","remove pest-o-Flash & Tube-lights to do deep clean in Kitchen","5","","24","1","68","93","2","5","3","7","","","","16","2014-05-12 11:23:57","16","2014-05-19 15:25:13","","","","");
INSERT INTO complaint VALUES("1886","Maintenance-0001277","CRACK  IN THE ENTRANCE OF THE A ROOM WALL","CRACK  IN THE ENTRANCE OF THE A ROOM WALL","12","","386","1","61","306","2","12","3","5","9","","Outsource to be done ","104","2014-05-12 11:41:02","227","2014-06-21 11:30:57","","","","");
INSERT INTO complaint VALUES("1887","MIS-0000610","AA257725 MS Sarala final bill shows the pharmacy bill which need clarification ","please ASAP ","3","","6","1","59","","1","3","3","5","","","","100","2014-05-12 11:45:56","6","2014-05-12 13:19:46","","","","");
INSERT INTO complaint VALUES("1888","MIS-0000611","Accpac is not working, ","in Inventory tab
INSERT INTO complaint VALUES("1889","Maintenance-0001278","1520 Tap is tight,1507 wash basin tap knob is very loose.","plz do it immediately.","6","","32","1","49","240","2","6","3","5","","","","95","2014-05-12 11:48:36","32","2014-05-12 15:57:48","","","","");
INSERT INTO complaint VALUES("1890","Maintenance-0001279","AC is not working","kindly rectify ","10","","26","1","50","84","2","10","3","7","","","","181","2014-05-12 12:10:52","181","2014-05-19 07:20:30","","","","");
INSERT INTO complaint VALUES("1891","Maintenance-0001280","Patient food Trolley plug points to be fixed","Patient food Trolley plug points to be fixed","5","","24","1","68","","2","5","3","7","","","","16","2014-05-12 12:18:38","16","2014-05-19 15:22:44","","","","");
INSERT INTO complaint VALUES("1892","Maintenance-0001281","ECG room top roof light hanging to be fixed ","ECG room top roof light hanging to be fixed ","5","","24","1","14","","2","5","3","7","","","","16","2014-05-12 12:20:09","16","2014-05-19 15:22:34","","","","");
INSERT INTO complaint VALUES("1893","Maintenance-0001282","x-ray 700 room zinc is not working","x-ray 700 room zinc is not working","6","","30","1","90","","2","6","3","5","","","","70","2014-05-12 12:21:27","30","2014-05-12 16:22:17","","","","");
INSERT INTO complaint VALUES("1894","Maintenance-0001283","Phone instrument (383) not working well.","urgent","8","","33","1","68","","2","8","3","5","","","","365","2014-05-12 12:23:11","33","2014-05-12 16:12:58","","","","");
INSERT INTO complaint VALUES("1895","MIS-0000612","We have Professional exams on Wednesday for that we need computers to be fixed in Academic center (above CT Scan room) on Tuesday afternoon by 2.00 Pm","urgent
INSERT INTO complaint VALUES("1896","MIS-0000613","zimbra mail has exceeded the allotted quota. not able to send any mails.","zimbra mail has exceeded the allotted quota. not able to send any mails.","3","","8","1","45","","1","3","3","5","","","","93","2014-05-12 12:44:16","8","2014-05-13 09:02:53","","","","");
INSERT INTO complaint VALUES("1897","Maintenance-0001284","Toilet blocked","Urgent","6","","32","1","47","105","2","6","3","5","","","","149","2014-05-12 13:01:36","32","2014-05-12 13:46:37","","","","");
INSERT INTO complaint VALUES("1898","MIS-0000614","W-5 IP Billing. IPB 03 system is not working and N computing systems r not connecting to IPB 03. Not able to print.","IPB 03 system is not working and N computing systems r not connecting to IPB 03. Not able to print.","3","","5","1","42","","1","3","3","5","","","","371","2014-05-12 13:15:03","5","2014-05-12 17:26:19","","","","");
INSERT INTO complaint VALUES("1899","Maintenance-0001285","no water supply in deluxe ward","kindly do the needful .","6","","32","1","50","","2","6","3","5","","","","126","2014-05-12 13:50:12","32","2014-05-12 15:36:16","","","","");
INSERT INTO complaint VALUES("1900","Maintenance-0001286","Sewing machine to be repaired","urgent","7","","28","1","115","360","2","7","3","5","6","","Out source work","149","2014-05-12 13:54:08","28","2014-05-14 08:41:40","","","","");
INSERT INTO complaint VALUES("1901","Maintenance-0001287","in deluxe room 3204  switch board are not working ","please rectify ","5","","24","1","50","","2","5","3","5","","","","126","2014-05-12 13:56:27","24","2014-05-12 16:18:49","","","","");
INSERT INTO complaint VALUES("1902","Maintenance-0001288","2 patient cots are not working","urgent","7","","28","1","56","","2","7","3","5","","","","73","2014-05-12 13:58:30","28","2014-05-14 13:31:53","","","","");
INSERT INTO complaint VALUES("1903","Maintenance-0001289","water is not coming","urgent","6","","32","1","54","","2","6","3","5","","","","73","2014-05-12 14:19:08","32","2014-05-12 15:35:59","","","","");
INSERT INTO complaint VALUES("1904","Maintenance-0001290","wall cupboard to be fixed.","urgent.","9","","37","1","73","102","2","9","3","3","9","","its new requirement of cupboard hence out source to be done","211","2014-05-12 14:50:00","227","2014-05-12 16:31:18","","","","");
INSERT INTO complaint VALUES("1905","Maintenance-0001291","Room \'H\'  cot wood screw and nurses station drawer wood screw to be fix.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-05-12 15:20:50","87","2014-05-15 14:34:07","","","","");
INSERT INTO complaint VALUES("1906","MIS-0000615","AC in BBK serology not working .","On checking by the Mech.It is found that the project work on the third  floor has broken the pipe and so the gas has leaked . ","","","123","1","17","31","1","2","3","7","","","null","257","2014-05-12 15:25:52","257","2014-05-12 15:25:52","","","","");
INSERT INTO complaint VALUES("1907","MIS-0000616","One system not working.","Operating system corrupted .","3","","112","1","17","34","1","3","3","5","","","","257","2014-05-12 15:26:52","112","2014-05-12 16:14:03","","","","");
INSERT INTO complaint VALUES("1908","Maintenance-0001292","A-2 bed side.","calling Bel is not working.","8","","33","1","62","","2","8","3","5","","","","107","2014-05-12 15:37:35","33","2014-05-12 16:12:39","","","","");
INSERT INTO complaint VALUES("1909","Maintenance-0001293","AC in BBK serology not working .","On checking by the Mech.It is found that the project work on the third  floor has broken the pipe and so the gas has leaked . ","7","","26","1","17","31","2","7","3","5","","","","257","2014-05-12 15:41:26","26","2014-05-13 16:14:09","","","","");
INSERT INTO complaint VALUES("1910","Maintenance-0001294","AC is nit working","Piease do the needful","10","","26","1","50","84","2","10","3","5","","","","176","2014-05-12 15:56:50","26","2014-05-13 16:13:47","","","","");
INSERT INTO complaint VALUES("1911","Maintenance-0001295","Wet grinder covers
INSERT INTO complaint VALUES("1912","Maintenance-0001296","patient cot is repair bed no f-5","urgent","7","","28","1","60","277","2","7","3","5","","","","103","2014-05-12 16:12:29","28","2014-05-14 14:07:12","","","","");
INSERT INTO complaint VALUES("1913","Maintenance-0001297","Fan not working","Urgent","5","","23","1","84","","2","5","3","5","","","","351","2014-05-12 16:40:03","23","2014-05-13 16:09:18","","","","");
INSERT INTO complaint VALUES("1914","MIS-0000617","If we send the mails to the patients or to the devanahalli reports."," Attachment is not opening.","3","","5","1","17","25","1","3","3","5","","","","257","2014-05-12 18:06:41","5","2014-05-12 18:14:57","","","","");
INSERT INTO complaint VALUES("1915","Maintenance-0001298","LAB-OPD main door lock strucked. Not able to open or close.","As soon as possible.","9","","37","1","17","","2","9","3","5","","","","292","2014-05-13 07:31:07","37","2014-05-13 10:33:40","","","","");
INSERT INTO complaint VALUES("1916","Maintenance-0001299","\"G-2\" Calling bell is broken and \"E-1\" calling is continuously ringing ","very urgent ","8","","33","1","65","","2","8","3","7","","","","84","2014-05-13 08:03:45","84","2014-05-19 08:53:37","","","","");
INSERT INTO complaint VALUES("1917","MIS-0000618","in deluxe ward in system -01 keyboard  is not working (unable to operate)","Kindly do the needful","2","","112","1","50","","1","2","3","5","","0","","126","2014-05-13 08:10:00","112","2014-05-13 08:24:11","","","","");
INSERT INTO complaint VALUES("1918","Maintenance-0001300","switch board is not working  ( sending to maintenance) ","do it soon","5","","22","1","58","","2","5","3","5","","","","124","2014-05-13 08:18:23","24","2014-05-13 16:18:56","","","","");
INSERT INTO complaint VALUES("1919","Maintenance-0001301","C- 1 bed side.","Calling Bel panel to be fixed.","9","","37","1","62","","2","9","3","5","","","","107","2014-05-13 08:18:49","37","2014-05-13 10:33:24","","","","");
INSERT INTO complaint VALUES("1920","Maintenance-0001302","In Echo room there is a table which is shaking.","Can you please rectify it at the earliest.","9","","37","1","52","61","2","9","3","7","","","","128","2014-05-13 08:20:01","128","2014-05-21 08:18:50","","","","");
INSERT INTO complaint VALUES("1921","Maintenance-0001303","There is a wiring opening near the TMT machine which needs to be closed.","Please do it ASAP.","5","","24","1","52","61","2","5","3","7","","","","128","2014-05-13 08:21:25","128","2014-05-21 08:18:19","","","","");
INSERT INTO complaint VALUES("1922","Maintenance-0001304","nurses station wheel chair 4nos blow to be put","please rectify soon","7","","28","1","64","","2","7","3","5","","","","109","2014-05-13 08:21:47","28","2014-05-13 11:17:08","","","","");
INSERT INTO complaint VALUES("1923","Maintenance-0001305","D ROOM CALL BELL NOT WORKING","PLEASE RECTIFY SOON","8","","33","1","64","","2","8","3","5","","","","109","2014-05-13 08:23:33","33","2014-05-15 12:48:00","","","","");
INSERT INTO complaint VALUES("1924","Maintenance-0001306","MALE TOILET (INDIAN)DOOR BOLT IS NOT WORKING","PLEASE RECTIFY SOON","9","","37","1","64","","2","9","3","5","","","","109","2014-05-13 08:25:48","37","2014-05-13 15:41:17","","","","");
INSERT INTO complaint VALUES("1925","Maintenance-0001307","Aqua guard water pipe is leaking ","very urgent ","6","","31","1","65","","2","6","3","7","","","","84","2014-05-13 08:54:36","84","2014-05-19 08:53:03","","","","");
INSERT INTO complaint VALUES("1926","Maintenance-0001308","ONE TUBE LIGHT NOT WORKING IN IP BILLING","ONE TUBE LIGHT NOT WORKING IN IP BILLING","5","","22","1","42","","2","5","3","5","","","","118","2014-05-13 09:03:44","22","2014-05-13 09:45:36","","","","");
INSERT INTO complaint VALUES("1927","Maintenance-0001309","oxygen cylinder","flow meter not working","7","","28","1","82","","2","7","3","5","","","","98","2014-05-13 09:14:52","28","2014-05-13 11:17:52","","","","");
INSERT INTO complaint VALUES("1928","MIS-0000619","To operate attendance HRMS the password needs to be changed as Mrs. Indira is retired.","urgent","3","","6","1","47","","1","3","3","5","","","","149","2014-05-13 09:23:51","6","2014-05-14 08:42:41","","","","");
INSERT INTO complaint VALUES("1929","MIS-0000620","in deluxe ward system-01 keyboard is not working","kindly do the needful","2","","5","1","50","","1","2","3","5","","916","","126","2014-05-13 09:30:49","5","2014-05-13 09:37:02","","","","");
INSERT INTO complaint VALUES("1930","Maintenance-0001310","AC leaking in PACS room, to be rectified","......","10","","26","1","104","","2","10","3","5","","","","70","2014-05-13 09:39:56","26","2014-05-14 16:28:48","","","","");
INSERT INTO complaint VALUES("1931","Maintenance-0001311","O2 cylinder is empty ","attend soon","7","","28","1","50","","2","7","3","7","","","","225","2014-05-13 09:40:32","225","2014-05-14 13:35:00","","","","");
INSERT INTO complaint VALUES("1932","Maintenance-0001312","Wheel chair handle is broken in CCU department.","Please do it at the earliest.","7","","28","1","52","","2","7","3","5","","","","128","2014-05-13 09:49:51","28","2014-06-07 13:17:46","","","","");
INSERT INTO complaint VALUES("1933","Maintenance-0001313","key board draw need to be repair","key board draw need to be repair","9","","37","1","16","171","2","9","3","7","","","","132","2014-05-13 09:50:07","132","2014-05-16 10:42:09","","","","");
INSERT INTO complaint VALUES("1934","Maintenance-0001314","Balkan prime to be fixed.","C-4 to C-3 bed.","7","","28","1","62","","2","7","3","5","","","","107","2014-05-13 10:15:08","28","2014-05-13 15:59:06","","","","");
INSERT INTO complaint VALUES("1935","Maintenance-0001315","Electric shock / sparks from electric board in S3.","Very urgent","5","","24","1","72","276","2","5","3","5","","","","219","2014-05-13 10:45:25","24","2014-05-13 16:18:07","","","","");
INSERT INTO complaint VALUES("1936","Maintenance-0001316","Door locker to be fixed.","A&B room entrance .","9","","37","1","62","","2","9","3","5","","","","107","2014-05-13 10:50:01","37","2014-05-13 15:40:12","","","","");
INSERT INTO complaint VALUES("1937","Maintenance-0001317","Key board stand should be fixed ","Key board stand should be fixed ","9","","37","1","43","","2","9","3","5","","","","223","2014-05-13 10:51:50","37","2014-05-13 15:39:26","","","","");
INSERT INTO complaint VALUES("1938","Maintenance-0001318","Suction not working for dental chair.
INSERT INTO complaint VALUES("1939","Maintenance-0001319","Audio not heard in the department","Please do look into the matter","11","","21","1","78","","2","11","3","5","","","","197","2014-05-13 11:02:18","227","2014-06-11 08:41:25","","","","");
INSERT INTO complaint VALUES("1940","Maintenance-0001320","1. SOME CHAIRS IN THE SCHOOL TO BE REPAIRED 
INSERT INTO complaint VALUES("1941","Maintenance-0001321","MIKE SYSTEM IS NOT WORKING PROPERLY. Very much disturbances in between programmes ","very urgent","8","","34","4","107","","2","8","3","7","","","","153","2014-05-13 11:21:36","153","2014-06-05 09:41:19","","","","");
INSERT INTO complaint VALUES("1942","Maintenance-0001322","AUTOCLAVE TROLLY NOT WORKING","URGENT PLEASE","7","","28","1","57","65","2","7","3","5","","","","362","2014-05-13 11:33:43","28","2014-05-13 16:22:18","","","","");
INSERT INTO complaint VALUES("1943","MIS-0000621","n computing system is not working w4 IP billing","n computing system is not working w4 IP billing","2","","112","1","42","","1","2","3","5","","0","","369","2014-05-13 12:37:55","112","2014-05-13 12:56:52","","","","");
INSERT INTO complaint VALUES("1944","MIS-0000622","Unable to access share folder in bbh-eye-01","user id: jude
INSERT INTO complaint VALUES("1945","MIS-0000623","Barcode is not working properly in IP Lab 
INSERT INTO complaint VALUES("1946","Maintenance-0001323","switch board socate has came out it has to be fixed ","do it soon","5","","22","1","58","198","2","5","3","5","","","","124","2014-05-13 14:01:03","22","2014-05-13 16:08:31","","","","");
INSERT INTO complaint VALUES("1947","Maintenance-0001324","Refilling of liquid nitrogen in cryocan 25lit.","Refilling of liquid nitrogen in cryocan 25lit.","7","","26","1","51","261","2","7","3","5","","","","314","2014-05-13 14:48:45","26","2014-05-17 12:47:17","","","","");
INSERT INTO complaint VALUES("1948","Maintenance-0001325","triple gas cylinder to be refilled .","triple gas cylinder to be refilled .","7","","26","1","51","261","2","7","3","5","","","","314","2014-05-13 14:50:36","26","2014-05-17 12:47:06","","","","");
INSERT INTO complaint VALUES("1949","MIS-0000624","Outllok express is not working
INSERT INTO complaint VALUES("1950","Maintenance-0001326","Female general Toilet water is flowing continuously","Urgent ","6","","30","1","65","359","2","6","3","7","","","","84","2014-05-13 15:12:43","84","2014-05-19 08:56:21","","","","");
INSERT INTO complaint VALUES("1951","Maintenance-0001327","Fridge Thermometer temperature is showing high","very urgent ","7","","26","1","65","","2","7","3","7","","","","84","2014-05-13 15:13:47","84","2014-05-19 08:56:42","","","","");
INSERT INTO complaint VALUES("1952","MIS-0000625","BBH OPT 03 - Computer :
INSERT INTO complaint VALUES("1953","MIS-0000626","This is for your kind information that out look express mail not going to be check immediately. ","as soon as possible.","3","","8","1","63","","1","3","3","7","","","","87","2014-05-13 16:07:29","87","2014-05-15 14:33:40","","","","");
INSERT INTO complaint VALUES("1954","MIS-0000627","This is for your kind information that.system name bbh-wg4-01. out look express mail not going to be check immediately. ","as soon as possible.","3","","8","1","63","","1","3","3","7","","","","87","2014-05-13 16:12:49","87","2014-05-14 09:08:39","","","","");
INSERT INTO complaint VALUES("1955","Maintenance-0001328","Fixing of the plug to the other trolley","very  very urgent","5","","23","1","68","","2","5","3","5","","","","365","2014-05-13 16:19:17","23","2014-05-14 16:36:10","","","","");
INSERT INTO complaint VALUES("1956","Maintenance-0001329","tube light not working ","attend soon ","5","","23","1","115","","2","5","3","7","","","","225","2014-05-13 16:20:02","225","2014-05-14 13:34:24","","","","");
INSERT INTO complaint VALUES("1957","Maintenance-0001330","1. Cementing has to be done in Pot wash area of kitchen.
INSERT INTO complaint VALUES("1958","MIS-0000628","Mrs.Shafunniza admitted 10/5/14 to CCU,On 11/5/14 shifted to ICU due to breathlessness. need to conform about credit medicine which shows in periodical bill.","for the clarification ","3","","6","1","53","","1","3","3","5","5","","Provide MRD no. of the patient
INSERT INTO complaint VALUES("1959","Maintenance-0001331","water drops coming inside from the top of the sheet,near registration counter power box
INSERT INTO complaint VALUES("1960","Maintenance-0001332","G- 1 Calling bell repair ","make it fast","8","","33","1","60","281","2","8","3","5","","","","264","2014-05-14 05:37:26","33","2014-05-23 16:05:22","","","","");
INSERT INTO complaint VALUES("1961","MIS-0000629","In all the wards creatinine  reference range is not seen ? eg : Patient in delux ward of Name : Pallavi 
INSERT INTO complaint VALUES("1962","Maintenance-0001333","wooden Cupboard doors are to be removed 
INSERT INTO complaint VALUES("1963","MIS-0000630","CRP-06 - System not updated ( Javed is aware of it)","medium priority","3","","5","1","40","12","1","3","3","7","","","","65","2014-05-14 08:19:33","65","2014-05-15 12:09:43","","","","");
INSERT INTO complaint VALUES("1964","Maintenance-0001334","Drainage is been blocked in the backside of the soxdeo. please to it very urgently.","Very Urgently","6","","32","1","68","","2","6","3","5","","","","365","2014-05-14 08:21:07","32","2014-05-14 16:27:08","","","","");
INSERT INTO complaint VALUES("1965","Maintenance-0001335","The computer table , key board tray is not working","Kindly do immediately","9","","37","1","32","","2","9","3","5","","","","96","2014-05-14 08:21:56","37","2014-05-14 16:33:06","","","","");
INSERT INTO complaint VALUES("1966","Maintenance-0001336","phototherapy plug is broken
INSERT INTO complaint VALUES("1967","Maintenance-0001337","Patient  cot- Unable to raise the head end  -  F5","as early as possible","7","","28","1","60","277","2","7","3","5","","","","263","2014-05-14 08:30:28","28","2014-05-14 13:31:03","","","","");
INSERT INTO complaint VALUES("1968","Maintenance-0001338","female general toilet flush is not working  ( no water)","as soon as possible","6","","32","1","65","359","2","6","3","7","","","","84","2014-05-14 08:34:01","84","2014-05-19 08:55:15","","","","");
INSERT INTO complaint VALUES("1969","Maintenance-0001339","PC ward entrance near grill gate the tiles fixed is slippery and while moving trolley there is no level, ups and noisy. ","please rectify immediately.","12","","386","1","49","242","2","12","3","5","","","","97","2014-05-14 08:43:06","227","2014-05-28 15:28:59","","","","");
INSERT INTO complaint VALUES("1970","MIS-0000631","(MB IP billing)Earlier Luxury tax was displayed only in break up bill of patient responsibility
INSERT INTO complaint VALUES("1971","Maintenance-0001340","Room  \'E\' switch\'s not working to be check. ","as soon as possible.","5","","22","1","63","","2","5","3","7","","","","87","2014-05-14 09:07:37","87","2014-05-15 14:33:14","","","","");
INSERT INTO complaint VALUES("1972","Maintenance-0001341","yesterday spoke to Ms. Praveena regarding a duct which needs to be checked and closed.
INSERT INTO complaint VALUES("1973","Maintenance-0001342","NICU it is mandatory to have pedal tap","VERY URGENT","6","","31","1","55","","2","6","3","2","","","","73","2014-05-14 10:35:24","31","2014-06-12 12:18:12","","","","");
INSERT INTO complaint VALUES("1974","Maintenance-0001343","There is a bed raising lever broken in one of the patient\'s cot in CCU.","Please do the needful at the earliest.","7","","28","1","52","","2","7","3","7","","","","128","2014-05-14 10:36:26","128","2014-05-21 08:16:03","","","","");
INSERT INTO complaint VALUES("1975","Maintenance-0001344","in deluxe 3205 & 3220 cupboard  door to fix ,as screws removed  ","kindly do the needful ","9","","37","1","50","","2","9","3","5","","","","126","2014-05-14 10:40:54","37","2014-05-14 16:33:24","","","","");
INSERT INTO complaint VALUES("1976","MIS-0000632","w1 printer is not working","w1 printer is not working","2","","112","1","42","","1","2","3","5","","0","","369","2014-05-14 10:46:52","112","2014-05-14 10:58:16","","","","");
INSERT INTO complaint VALUES("1977","Maintenance-0001345","1st floor rain water is coming near the Dietary department and the water is standing near the office premise, so please rectify the problem and solve the issue as earliest as possible.","Very Urgent!!!!","12","","386","1","68","","2","12","3","2","","","","392","2014-05-14 11:14:03","227","2014-05-14 11:24:32","","","","");
INSERT INTO complaint VALUES("1978","MIS-0000633","Printing report not coming.........","its urgent ","2","","112","1","112","","1","2","3","5","","0","","72","2014-05-14 11:18:18","112","2014-05-14 11:43:36","","","","");
INSERT INTO complaint VALUES("1979","Maintenance-0001346","TUBE LIGHT NOT WORKING","TO BE CHECKED ","5","","24","1","53","126","2","5","3","5","","","","119","2014-05-14 11:18:27","24","2014-05-14 12:35:30","","","","");
INSERT INTO complaint VALUES("1980","Maintenance-0001347","wing-6 wheel chair to be repaired","as soon as possible","7","","28","1","65","353","2","7","3","7","","","","84","2014-05-14 11:21:49","84","2014-05-19 08:56:33","","","","");
INSERT INTO complaint VALUES("1981","Maintenance-0001348","In deluxe room 3205 tube lights  makes heavy sound on working condition (ceiling)","kindly rectify ","5","","24","4","50","","2","5","3","5","","","","126","2014-05-14 11:50:39","24","2014-05-14 12:33:06","","","","");
INSERT INTO complaint VALUES("1982","Maintenance-0001349","fridge thermometer to be checked (showing - temperature)  ","as soon as possible  ( SECOND REMAINDER)","7","","28","1","65","358","2","7","3","7","","","","84","2014-05-14 11:51:14","84","2014-05-19 08:56:10","","","","");
INSERT INTO complaint VALUES("1983","Maintenance-0001350","Room \'E\' switch\'s not working to be check.","as soon as possible,","5","","24","1","63","","2","5","3","7","","","","87","2014-05-14 12:16:21","87","2014-05-15 14:33:01","","","","");
INSERT INTO complaint VALUES("1984","Maintenance-0001351","Male Doctors room-Handle of flush not working ","Please rectify the issue immediately","6","","32","1","98","","2","6","3","5","","","","151","2014-05-14 12:56:31","32","2014-05-14 16:26:31","","","","");
INSERT INTO complaint VALUES("1985","Maintenance-0001352","wing -6 waiting area  fan is not working ","as soon as possible","5","","23","1","65","","2","5","3","7","","","","84","2014-05-14 12:57:41","84","2014-05-19 08:54:03","","","","");
INSERT INTO complaint VALUES("1986","Maintenance-0001353","the key board chamber of the table ha fallen down","PLs attend to asap.
INSERT INTO complaint VALUES("1987","Maintenance-0001354","Milky bulb to be replaced, got fused in scan room ","............","5","","23","1","104","","2","5","3","5","","","","70","2014-05-14 13:01:37","23","2014-05-14 16:37:21","","","","");
INSERT INTO complaint VALUES("1988","Maintenance-0001355","ladies staff hostel washing area blocked","attend soon ","6","","30","2","47","","2","6","3","7","","","","225","2014-05-14 13:03:32","225","2014-05-20 08:37:37","","","","");
INSERT INTO complaint VALUES("1989","Maintenance-0001356","Chapel cross back light not working","attend soon","5","","24","1","27","","2","5","3","7","","","","225","2014-05-14 13:04:24","225","2014-05-14 13:33:49","","","","");
INSERT INTO complaint VALUES("1990","Maintenance-0001357","SWITCH BOARD NOT WORKING","URGENT","5","","23","1","76","101","2","5","3","5","","","","206","2014-05-14 14:38:19","23","2014-05-14 16:37:49","","","","");
INSERT INTO complaint VALUES("1991","MIS-0000634","unable to discharge patient from the system ","please rectify as early as possible","3","","6","1","64","21","1","3","3","5","","","","109","2014-05-14 14:52:52","6","2014-05-15 15:01:06","","","","");
INSERT INTO complaint VALUES("1992","MIS-0000635","Printer not working","its urgent ","2","","5","1","112","","1","2","3","5","","0","","72","2014-05-14 14:55:00","5","2014-05-14 15:50:23","","","","");
INSERT INTO complaint VALUES("1993","Maintenance-0001358","Taps are not working and sinks are blocked in the B.Sc Hostel. 
INSERT INTO complaint VALUES("1994","Maintenance-0001359","Geyser is not working in the new hostel.","Urgent ","6","","30","4","107","","2","6","3","7","","","","265","2014-05-14 14:58:48","265","2014-05-26 10:09:14","","","","");
INSERT INTO complaint VALUES("1995","Maintenance-0001360","Drainage blocked behind laundry.
INSERT INTO complaint VALUES("1996","Maintenance-0001361","Tube lights not working in laundry.","Urgent.","5","","23","1","84","","2","5","3","5","","","","351","2014-05-14 15:49:04","23","2014-05-15 16:33:36","","","","");
INSERT INTO complaint VALUES("1997","MIS-0000636","CRP-08 System is getting hanged frequently even after repeated complaints. Scanner also is very slow and we hear sounds when we are printing or scanning
INSERT INTO complaint VALUES("1998","Maintenance-0001362","Cash counter bulb is not working please rectify the problem as soon as possible.","Urgent","5","","23","1","68","","2","5","3","5","","","","392","2014-05-14 16:54:12","23","2014-05-15 08:18:29","","","","");
INSERT INTO complaint VALUES("1999","Maintenance-0001363","oxygen cylinder in trolley finished .","oxygen cylinder got over and also replaced.","7","","27","1","54","","2","7","3","5","","","","114","2014-05-15 04:03:22","27","2014-05-15 08:03:59","","","","");
INSERT INTO complaint VALUES("2000","Maintenance-0001364","room no 1507 cot side not properly fixed, room no 1515 cot side rails not proper.","please come immediately","7","","27","1","49","228","2","7","3","5","","","","97","2014-05-15 07:39:14","27","2014-05-15 08:03:37","","","","");
INSERT INTO complaint VALUES("2001","Maintenance-0001365","oxygen to be filled","already filled ","7","","27","1","49","242","2","7","3","5","","","","97","2014-05-15 07:45:02","27","2014-05-15 08:10:02","","","","");
INSERT INTO complaint VALUES("2002","Maintenance-0001366","food table to be repaired","as soon possible","9","","37","1","65","349","2","9","3","7","","","","84","2014-05-15 07:49:35","84","2014-05-19 08:50:31","","","","");
INSERT INTO complaint VALUES("2003","Maintenance-0001367","canteen cash counter side tube light not working","attend soon","5","","23","1","68","","2","5","3","7","","","","225","2014-05-15 08:15:52","225","2014-05-20 08:37:17","","","","");
INSERT INTO complaint VALUES("2004","Maintenance-0001368","CT Console Room Door Handle broken.
INSERT INTO complaint VALUES("2005","Maintenance-0001369","The wood sheet stuck to the wall in MOPD patient waiting area is coming out of fall, please consider it as emergency and rectify it today itself.","its urgent ","9","","37","1","71","","2","9","3","5","9","","out source work to be done ","72","2014-05-15 08:36:07","227","2014-06-05 12:48:41","","","","");
INSERT INTO complaint VALUES("2006","Maintenance-0001370","Idly Steamer is not working. Very urgent.","Very Urgent.","7","","28","1","68","","2","7","3","5","9","","out source to be done","392","2014-05-15 08:38:07","28","2014-06-07 13:15:16","","","","");
INSERT INTO complaint VALUES("2007","Maintenance-0001371","Canteen Front Light is not working","Very urgent.","5","","25","1","68","","2","5","3","5","","","","392","2014-05-15 08:38:59","25","2014-05-15 16:39:24","","","","");
INSERT INTO complaint VALUES("2008","Maintenance-0001372","G-2  Bed calling bell to be repaired 
INSERT INTO complaint VALUES("2009","Maintenance-0001373","I-ROOM BED NO:2 SIDE RAILS TO BE REPAIRED","PLEASE RECTIFY SOON","7","","28","1","64","336","2","7","3","7","","","","110","2014-05-15 08:49:20","110","2014-05-16 09:55:42","","","","");
INSERT INTO complaint VALUES("2010","Maintenance-0001374","cot side rails screw is loose","to be checked","7","","28","1","53","","2","7","3","5","","","","119","2014-05-15 08:49:45","28","2014-05-15 12:15:56","","","","");
INSERT INTO complaint VALUES("2011","Maintenance-0001375","C-ROOM STERILIUM STAND SCREW TO BE FIXED","PLEASE RECTIFY SOON","9","","37","1","64","","2","9","3","7","","","","110","2014-05-15 08:50:06","110","2014-05-16 09:55:21","","","","");
INSERT INTO complaint VALUES("2012","Maintenance-0001376","E-7 PATIENT CALLING BELL NOT ABLE TO OFF","PLEASE RECTIFY SOON","8","","33","1","64","333","2","8","3","7","","","","110","2014-05-15 08:50:56","110","2014-05-16 09:55:05","","","","");
INSERT INTO complaint VALUES("2013","Maintenance-0001377","Ccu glass door is not working properly.","Please rectify it at the earliest.","9","","37","1","52","","2","9","3","7","","","","128","2014-05-15 08:58:45","128","2014-05-21 08:15:30","","","","");
INSERT INTO complaint VALUES("2014","Maintenance-0001378","neuroscience consultation room door can be open even after locking the door..........","its urgent ","9","","37","1","111","","2","9","3","5","","","","209","2014-05-15 08:59:03","37","2014-05-15 16:44:02","","","","");
INSERT INTO complaint VALUES("2015","Maintenance-0001379","Extra light to be fixed in Dish wash area, Pot Wash area, Dish Cutting area. (2 Lights).","Very urgent.","5","","25","1","68","","2","5","3","5","6","","Its new requirements hence it will be delayed ","392","2014-05-15 08:59:45","25","2014-05-24 12:37:58","","","","");
INSERT INTO complaint VALUES("2016","Maintenance-0001380","Balkan frame to be removed from B room and fixed in C-5","URGENT","7","","28","1","62","307","2","7","3","5","","","","106","2014-05-15 09:06:37","28","2014-05-15 12:14:52","","","","");
INSERT INTO complaint VALUES("2017","Maintenance-0001381","Bathroom filter blocked","Bathroom filter blocked","6","","31","1","114","","2","6","3","5","","","","73","2014-05-15 09:07:48","31","2014-05-15 16:31:20","","","","");
INSERT INTO complaint VALUES("2018","MIS-0000637","Draft for Hoarding 
INSERT INTO complaint VALUES("2019","Maintenance-0001382","computer chair repair ","urgent ","7","","28","1","29","","2","7","3","5","","","","356","2014-05-15 09:12:39","227","2014-06-17 12:35:22","","","","");
INSERT INTO complaint VALUES("2020","Maintenance-0001383","patient shifting trolley safety belt one side not there.","please come immediately","7","","28","1","49","242","2","7","3","5","","","","97","2014-05-15 09:14:30","28","2014-05-15 16:35:47","","","","");
INSERT INTO complaint VALUES("2021","Maintenance-0001384","Mob,  webing and dusting in Kitchen area, dietary office, canteen, pantry.","Very urgent.","11","","21","1","68","","2","11","3","5","","","","392","2014-05-15 09:14:51","227","2014-05-15 09:16:41","","","","");
INSERT INTO complaint VALUES("2022","MIS-0000638","Conversion of the matter for plaque - placed in the share folder - adm -o2","urgent","3","","8","1","94","","1","3","3","7","","","","259","2014-05-15 09:15:25","259","2014-06-06 12:36:00","","","","");
INSERT INTO complaint VALUES("2023","Maintenance-0001385","Nurses station Telephone not working frequently disconnecting..","please come immediately","8","","33","1","49","242","2","8","3","5","","","","97","2014-05-15 09:19:57","33","2014-05-15 12:49:48","","","","");
INSERT INTO complaint VALUES("2024","Maintenance-0001386","Metal Drainage cover has to be fixed in the main kitchen. Very urgent","Very Urgent.","12","","386","1","68","","2","12","3","2","","","","392","2014-05-15 09:21:07","227","2014-05-15 09:28:13","","","","");
INSERT INTO complaint VALUES("2025","Maintenance-0001387","Cementing in Pot wash area, Dietary entrances area, ","Very urgent.","12","","386","1","68","","2","12","3","5","","","","392","2014-05-15 09:22:47","227","2014-05-28 15:28:37","","","","");
INSERT INTO complaint VALUES("2026","Maintenance-0001388","High risk labour room door closer to be fixed","AS SOON AS POSSIBLE","9","","37","1","59","","2","9","3","5","","","","116","2014-05-15 09:50:13","37","2014-05-15 16:41:16","","","","");
INSERT INTO complaint VALUES("2027","Maintenance-0001389","waiting area fan is not working ","urgent","5","","25","1","65","","2","5","3","7","","","","84","2014-05-15 09:55:44","84","2014-05-19 08:52:32","","","","");
INSERT INTO complaint VALUES("2028","MIS-0000639","The Web Software not working properly","Unable to view X ray films .","3","","8","1","78","","1","3","3","5","","","","197","2014-05-15 09:56:32","8","2014-05-15 12:59:35","","","","");
INSERT INTO complaint VALUES("2029","MIS-0000640","AccPacc ID for New staff Mrs Jomol coming with Grace ruby\'s name & signature","This should come with Jomol Name & signature which is provided to you. copy attached","3","","6","1","17","28","1","3","3","7","","","","300","2014-05-15 10:15:23","300","2014-05-16 10:08:34","20140515101523_jomol1.pdf","","","");
INSERT INTO complaint VALUES("2030","Maintenance-0001390","Camera need to be fix in front of counter","Camera need to be fix in front of counter","8","","33","1","16","171","2","8","3","7","","","","132","2014-05-15 10:28:04","132","2014-06-09 10:43:04","","","","");
INSERT INTO complaint VALUES("2031","Maintenance-0001391","There is a rain leakage marks in the NICU  dept which needs paint","urgent","11","","21","1","55","","2","11","3","2","","","","73","2014-05-15 10:29:11","21","2014-06-12 12:13:19","","","","");
INSERT INTO complaint VALUES("2032","Maintenance-0001392","A - 2 bed side.","calling belling  not getting cleared after pressing the bell once.","8","","33","1","62","","2","8","3","5","","","","107","2014-05-15 10:33:03","33","2014-05-23 16:05:10","","","","");
INSERT INTO complaint VALUES("2033","Maintenance-0001393","Balkan frame to be fixed.","C- 13 to C-4","7","","28","1","62","","2","7","3","5","","","","107","2014-05-15 10:37:50","28","2014-05-15 12:12:56","","","","");
INSERT INTO complaint VALUES("2034","MIS-0000641","Printer tray is not closing and coming out to put papers and 
INSERT INTO complaint VALUES("2035","MIS-0000642","Printer tray is not closing and ","coming out to put the papers and BBH Form.","2","","5","1","17","32","1","2","3","7","","0","","113","2014-05-15 11:09:47","113","2014-05-15 16:00:22","","","","");
INSERT INTO complaint VALUES("2036","Maintenance-0001394","Ventilate door hook to be fixed. ","Do the need full.............................. ","9","","37","1","71","","2","9","3","5","","","","72","2014-05-15 11:29:57","227","2014-06-05 12:50:17","","","","");
INSERT INTO complaint VALUES("2037","Maintenance-0001395","Qtrs.Dr.Girish house behind chamber is blocked","attend soon","6","","31","3","2","","2","6","3","7","","","","225","2014-05-15 11:35:33","225","2014-05-20 08:36:55","","","","");
INSERT INTO complaint VALUES("2038","Maintenance-0001396","SINK IS BLOCKED","PLEASE RECTIFY SOON","6","","31","1","64","331","2","6","3","7","","","","110","2014-05-15 11:41:47","110","2014-05-16 09:54:45","","","","");
INSERT INTO complaint VALUES("2039","Maintenance-0001397","Balk on perm to be fixed.","C-5 to C-1","7","","28","1","62","","2","7","3","5","","","","107","2014-05-15 11:50:32","28","2014-05-15 14:58:43","","","","");
INSERT INTO complaint VALUES("2040","Maintenance-0001398","Trolly plug has to be changed very urgently, sodexo is facing problems due to this.","Very very urgent.","5","","25","1","68","","2","5","3","5","","","","392","2014-05-15 12:13:27","25","2014-05-15 16:39:00","","","","");
INSERT INTO complaint VALUES("2041","Maintenance-0001399","A duct in the corporate back office is open. Had spoken to Ms.Praveena to kindly send a person for inspection","high priority . Every day rats are biting the wires of the system which is hampering our work","12","","386","1","40","63","2","12","3","2","","","","65","2014-05-15 12:13:39","65","2014-06-07 10:31:45","","","","");
INSERT INTO complaint VALUES("2042","Maintenance-0001400","New aqua grad  to be fixed immediately. ","as soon as possible.","6","","30","1","63","","2","6","3","7","","","","87","2014-05-15 13:05:10","87","2014-05-15 14:32:26","","","","");
INSERT INTO complaint VALUES("2043","Maintenance-0001401","telephone not working properly","the call gets disconnected ","8","","33","1","18","215","2","8","3","7","","","","64","2014-05-15 13:09:11","64","2014-05-29 08:45:48","","","","");
INSERT INTO complaint VALUES("2044","Maintenance-0001402","Aquaquard water in IP lab is having white particulates,cannot be used for drinking purpose.","Aquaquard water in IP lab is having white particulates,cannot be used for drinking purpose.","6","","30","1","17","148","2","6","3","5","","","","300","2014-05-15 13:26:44","30","2014-05-17 12:49:16","","","","");
INSERT INTO complaint VALUES("2045","MIS-0000643","CRP-12 net not working","high priority","3","","5","1","40","12","1","3","3","7","","","","65","2014-05-15 13:51:20","65","2014-05-16 16:39:54","","","","");
INSERT INTO complaint VALUES("2046","Maintenance-0001403","Required  2 numbers of wooden table","for orthopaedics","9","","37","1","58","194","2","9","3","5","","","","122","2014-05-15 14:06:50","37","2014-06-12 11:11:20","","","","");
INSERT INTO complaint VALUES("2047","Maintenance-0001404","room no 1508 tube light not working and 1508,1512,1514 bedside light not working. ","please come immediately","5","","23","1","49","229","2","5","3","5","","","","97","2014-05-15 14:17:28","23","2014-05-15 16:33:08","","","","");
INSERT INTO complaint VALUES("2048","Maintenance-0001405","Room J & H bath room geaser is not working to be check.","as soon as possible.","6","","31","1","63","","2","6","3","7","","","","87","2014-05-15 14:36:31","87","2014-05-20 12:38:48","","","","");
INSERT INTO complaint VALUES("2049","MIS-0000644","phm 01","shutting down automatically. pls rectify asap ","2","","112","1","18","7","1","2","3","7","","0","","64","2014-05-15 14:37:07","64","2014-05-17 11:03:41","","","","");
INSERT INTO complaint VALUES("2050","Maintenance-0001406","02 cylinder to be change immediately. ","as soon as possible.","7","","28","1","63","","2","7","3","7","","","","87","2014-05-15 14:37:52","87","2014-05-20 12:39:18","","","","");
INSERT INTO complaint VALUES("2051","Maintenance-0001407","room no 1517 cot side rails are not proper it is falling","please come immediately","7","","28","1","49","237","2","7","3","5","","","","97","2014-05-15 14:44:04","28","2014-05-15 16:35:23","","","","");
INSERT INTO complaint VALUES("2052","Maintenance-0001408","Rooms B,E,F,C switch board not working to be check. ","as soon as possible.","5","","22","1","63","","2","5","3","7","","","","87","2014-05-15 14:44:50","87","2014-05-20 12:39:06","","","","");
INSERT INTO complaint VALUES("2053","Maintenance-0001409","Rooms HDU & H  d-4 h-1,  suction is not working to be check.","as soon as possible.","7","","28","1","63","","2","7","3","7","","","","87","2014-05-15 14:47:56","87","2014-05-20 12:38:36","","","","");
INSERT INTO complaint VALUES("2054","Maintenance-0001410","bed side plug is not working.","A - 7 & A8 bed side.","5","","25","1","61","292","2","5","3","5","","","","105","2014-05-15 15:02:30","25","2014-05-15 16:38:11","","","","");
INSERT INTO complaint VALUES("2055","Maintenance-0001411","B Room  call bell is not working","B-1 Bed side","8","","33","1","61","293","2","8","3","5","","","","105","2014-05-15 15:31:45","33","2014-05-17 12:50:57","","","","");
INSERT INTO complaint VALUES("2056","Maintenance-0001412","Linen room Tube light is flickring. Please replace it.","Urgent","5","","23","1","47","","2","5","3","5","","","","149","2014-05-15 15:58:12","23","2014-05-16 08:48:19","","","","");
INSERT INTO complaint VALUES("2057","Maintenance-0001413","CHD Tailoring machine teeth to be changed -Cobblers Room","Urgent","7","","28","1","115","360","2","7","3","5","","","","149","2014-05-15 16:18:50","28","2014-06-07 13:15:02","","","","");
INSERT INTO complaint VALUES("2058","MIS-0000645"," computer -3, display not clear WHITE COLOURS, NO WORDS CANT, SEE ","computer -3, display not clear WHITE COLOURS, NO WORDS CANT, SEE ","2","","112","1","16","19","1","2","3","7","","0","","132","2014-05-15 22:18:48","132","2014-06-09 10:42:46","","","","");
INSERT INTO complaint VALUES("2059","MIS-0000646","monitor not working ","monitor not working ","2","","112","1","16","19","1","2","3","7","","0","","132","2014-05-16 07:45:15","132","2014-06-09 10:42:04","","","","");
INSERT INTO complaint VALUES("2060","Maintenance-0001414","K-ROOM SINK IS BLOCKED","PLEASE RECTIFY SOON","6","","31","1","64","","2","6","3","7","","","","110","2014-05-16 08:19:45","110","2014-05-16 11:30:47","","","","");
INSERT INTO complaint VALUES("2061","Maintenance-0001415","FAN SWITCH TO BE REPAIRED","PLEASE RECTIFY SOON","5","","24","1","64","346","2","5","3","7","","","","110","2014-05-16 08:20:20","110","2014-05-16 11:30:22","","","","");
INSERT INTO complaint VALUES("2062","Maintenance-0001416","high risk labour room enterence door is not closed properly.","as soon as possible","9","","37","1","59","","2","9","3","5","","","","116","2014-05-16 08:36:30","37","2014-05-16 16:29:17","","","","");
INSERT INTO complaint VALUES("2063","MIS-0000647","SAL-02 unable to print","high priority","2","","112","1","40","12","1","2","3","7","","0","","65","2014-05-16 08:41:03","65","2014-05-16 16:39:33","","","","");
INSERT INTO complaint VALUES("2064","Maintenance-0001417","Cementing has to be done in pot was area, dish wash area, Dietary entrances area.","very urgent.","12","","386","1","68","","2","12","3","5","","","","392","2014-05-16 08:50:38","227","2014-05-16 09:00:18","","","","");
INSERT INTO complaint VALUES("2065","Maintenance-0001418","Cooler refrigerator in Canteen is not working, repair it as soon as possible.","very urgent.
INSERT INTO complaint VALUES("2066","Maintenance-0001419","Pesto flush has to be fixed in canteen area. ","very urgent.","5","","25","1","68","","2","5","3","5","","","","392","2014-05-16 08:53:15","25","2014-05-17 12:44:50","","","","");
INSERT INTO complaint VALUES("2067","Maintenance-0001420","Staff toilet (gents) urinal sink blocked.","very urgent","6","","31","1","42","133","2","6","3","5","","","","149","2014-05-16 08:58:01","31","2014-05-16 10:58:23","","","","");
INSERT INTO complaint VALUES("2068","Maintenance-0001421","2 O2 cylinders to be replaced ","2 O2 cylinders to be replaced ","7","","28","1","81","","2","7","3","7","","","","16","2014-05-16 09:03:11","16","2014-05-19 15:21:56","","","","");
INSERT INTO complaint VALUES("2069","Maintenance-0001422","portable suction apparatus not working ","please rectify immediately","7","","28","1","49","242","2","7","3","5","","","","97","2014-05-16 09:09:51","28","2014-05-19 15:16:46","","","","");
INSERT INTO complaint VALUES("2070","Maintenance-0001423","gents toilet in pc opd the door handle is remove and kept inside.  Handing over the handle for the repair work.  ","Very urgent .  handle given by Mr. Manjunath G","9","","37","1","47","110","2","9","3","5","","","","149","2014-05-16 09:16:39","37","2014-05-16 16:28:49","","","","");
INSERT INTO complaint VALUES("2071","MIS-0000648","PRINTER NOT WORKING","PRINTER NOT WORKING","2","","112","1","44","361","1","2","3","7","","0","","348","2014-05-16 09:31:22","348","2014-05-29 07:57:00","","","","");
INSERT INTO complaint VALUES("2072","MIS-0000649","Certificate changes to be made","kindly make changes in the certificate required with reference to the mail sent. ","3","","8","1","45","","1","3","3","5","","","","93","2014-05-16 09:40:52","8","2014-05-16 10:46:58","","","","");
INSERT INTO complaint VALUES("2073","Maintenance-0001424","oxygen cylinder flow meter to be fixed ","urgent ","7","","28","1","17","142","2","7","3","5","","","","69","2014-05-16 10:06:42","28","2014-05-16 12:09:36","","","","");
INSERT INTO complaint VALUES("2074","Maintenance-0001425","Lift -1 corridor tube light to be replaced ","replace tube light ","5","","24","1","70","265","2","5","3","5","","","","24","2014-05-16 10:12:35","24","2014-05-16 10:15:48","","","","");
INSERT INTO complaint VALUES("2075","Maintenance-0001426","Bio Gas unit no power supply","Bio Gas unit no power supply
INSERT INTO complaint VALUES("2076","MIS-0000650","Uday Sir, Salika\'s ,Mahalaxmi,signature should be alone with mentioning as intrim report.
INSERT INTO complaint VALUES("2077","Maintenance-0001427","IN DELUXE WARD  PORTABLE SUCTION APPARATUS   IS NOT WORKING ","KINDLY DO THE NEEDFUL AS SOON AS POSSIBLE. ","7","","28","1","50","","2","7","3","5","","","","126","2014-05-16 10:36:22","28","2014-05-16 15:32:06","","","","");
INSERT INTO complaint VALUES("2078","MIS-0000651","w1 printer is not working","w1 printer is not working","2","","5","1","42","","1","2","3","5","","0","","369","2014-05-16 10:38:42","5","2014-05-16 11:21:14","","","","");
INSERT INTO complaint VALUES("2079","MIS-0000652","w-4 ip billing
INSERT INTO complaint VALUES("2080","MIS-0000653","IN DELUXE WARD IN SYSYEM -01 UNDER SIS JACKULINE ID I AM UNABLE TO TAKE THE CONSUMPTION ENTRY OF MARCH -2014  ","KINDLY DO THE NEEDFUL FOR UP-DATING THE DOCUMENT. ","3","","6","1","50","","1","3","3","5","","","","126","2014-05-16 10:57:38","6","2014-05-17 08:54:33","","","","");
INSERT INTO complaint VALUES("2081","Maintenance-0001428","Suction machine not working properly.","Requsted to solve this problem ASAP. Thank you","7","","28","1","91","","2","7","3","5","","","","364","2014-05-16 11:25:07","28","2014-06-07 13:16:54","","","","");
INSERT INTO complaint VALUES("2082","Maintenance-0001429","Kitchen weighing scale not working, kindly come and repair now.","Urgent.","7","","26","1","68","93","2","7","3","5","9","","Outsource to be done ","392","2014-05-16 12:28:48","26","2014-05-17 12:46:33","","","","");
INSERT INTO complaint VALUES("2083","Maintenance-0001430","Hand washing  sink foot  pedal to be repaired near OT -6","As soon as possible","6","","30","1","58","194","2","6","3","5","","","","121","2014-05-16 12:29:07","30","2014-05-28 12:45:51","","","","");
INSERT INTO complaint VALUES("2084","Maintenance-0001431","Male Doctor\'s room- Rest room bulb has been fused.","Please replace it immediately.","5","","23","1","98","","2","5","3","5","","","","151","2014-05-16 12:37:37","23","2014-05-16 16:26:44","","","","");
INSERT INTO complaint VALUES("2085","MIS-0000654","harrisons book is not opening in the common share folder","harrisons book is not opening in the common share folder","3","","112","1","53","","1","3","3","5","","","","119","2014-05-16 12:51:36","112","2014-05-17 08:09:58","","","","");
INSERT INTO complaint VALUES("2086","Maintenance-0001432","Switch board not working, sending to the maintenance dept.","Urgent","5","","25","1","58","","2","5","3","5","","","","121","2014-05-16 12:56:51","25","2014-05-17 12:44:31","","","","");
INSERT INTO complaint VALUES("2087","Maintenance-0001433","1511 EXHAUST FAN NOT WORKING","PLEASE COME IMMEDIATELY","5","","23","1","49","232","2","5","3","5","","","","97","2014-05-16 13:07:24","23","2014-05-17 12:43:58","","","","");
INSERT INTO complaint VALUES("2088","Maintenance-0001434","Tube light ","FLICKERING","5","","25","1","82","","2","5","3","5","","","","98","2014-05-16 13:18:23","25","2014-05-16 16:27:38","","","","");
INSERT INTO complaint VALUES("2089","Maintenance-0001435","FRIDGE THERMOMETER -2
INSERT INTO complaint VALUES("2090","Maintenance-0001436","Pesto Flush is not working in the main kitchen. please do it very urgently","very urgently.....","5","","23","1","68","","2","5","3","5","","","","392","2014-05-16 13:43:38","23","2014-05-17 12:43:38","","","","");
INSERT INTO complaint VALUES("2091","Maintenance-0001437","Weighing machine is not working in the kitchen department. please do it very urgently.","Do it very urgently. This is 2nd time we are informing you. ","7","","26","1","68","","2","7","3","2","","","","392","2014-05-16 13:45:26","26","2014-06-12 11:37:34","","","","");
INSERT INTO complaint VALUES("2092","Maintenance-0001438","Oxygen flow meter is leaking","urgent","7","","28","1","54","","2","7","3","5","","","","73","2014-05-16 13:57:09","28","2014-05-16 14:31:45","","","","");
INSERT INTO complaint VALUES("2093","Maintenance-0001439","New fan to be fixed in the wall","urgent","5","","24","1","56","","2","5","3","5","","","","73","2014-05-16 14:08:39","24","2014-05-23 15:33:49","","","","");
INSERT INTO complaint VALUES("2094","Maintenance-0001440","Key stuck in the lock unable to remove","nursing educators room next to delux ward. key stuck in the room door. kindly rectify","9","","37","1","45","","2","9","3","5","","","","93","2014-05-16 14:32:39","37","2014-05-16 16:28:27","","","","");
INSERT INTO complaint VALUES("2095","MIS-0000655","Dear Mam/Sir,
INSERT INTO complaint VALUES("2096","MIS-0000656","printer is not working","printer is not working","2","","112","1","16","17","1","2","3","7","","0","","132","2014-05-16 14:43:20","132","2014-06-09 10:41:52","","","","");
INSERT INTO complaint VALUES("2097","Maintenance-0001441","PHONE IS NOT RINGING 402 NUMBER","PHONE IS NOT RINGING 402 NUMBER","8","","33","1","42","133","2","8","3","5","","","","374","2014-05-16 14:55:45","33","2014-05-19 16:38:41","","","","");
INSERT INTO complaint VALUES("2098","Maintenance-0001442","FAN TO BE FIXED IN THE RECEPTION  ","AS SOON AS POSSIBLE","5","","24","1","14","243","2","5","3","5","","","","70","2014-05-16 15:13:55","24","2014-05-17 12:42:58","","","","");
INSERT INTO complaint VALUES("2099","Maintenance-0001443","OT -6 AC IS NOT WORKING ","DO IT AS PER AS POSSIBLE ","10","","26","1","58","194","2","10","3","5","","","","124","2014-05-16 16:02:34","26","2014-05-17 12:46:18","","","","");
INSERT INTO complaint VALUES("2100","Maintenance-0001444","Toilet flush is leaking in change room (2nd floor next to the Lab)","urgent ","6","","30","1","89","","2","6","3","5","","","","72","2014-05-16 16:16:03","30","2014-05-24 12:56:03","","","","");
INSERT INTO complaint VALUES("2101","MIS-0000657","Install Open office","need it to open the arrachement received.","3","","5","1","89","42","1","3","3","7","","","","88","2014-05-16 16:32:16","88","2014-05-21 11:34:13","","","","");
INSERT INTO complaint VALUES("2102","Maintenance-0001445","Oxygen is leaking in room no.1504","please do it","5","","22","1","49","225","2","5","3","5","","","","248","2014-05-17 06:57:57","22","2014-05-17 07:47:42","","","","");
INSERT INTO complaint VALUES("2103","Maintenance-0001446","Room no.I  toilet light is not working","as soon as possible","5","","25","1","60","283","2","5","3","5","","","","116","2014-05-17 07:59:43","25","2014-05-17 12:44:18","","","","");
INSERT INTO complaint VALUES("2104","Maintenance-0001447","pc opd waiting area tube light is not working","please come immedeatly","5","","24","1","102","","2","5","3","5","","","","246","2014-05-17 08:16:01","24","2014-05-17 12:42:48","","","","");
INSERT INTO complaint VALUES("2105","Maintenance-0001448","TELEPHONE IS NOT WORKING (390)","RECTIFY ASAP","8","","33","1","30","","2","8","3","7","","","","148","2014-05-17 08:21:39","148","2014-06-05 09:15:33","","","","");
INSERT INTO complaint VALUES("2106","Maintenance-0001449","IN X-RAY TUBE IS NOT WORKING, PLS FIX IT","IN X-RAY TUBE IS NOT WORKING, PLS FIX IT","5","","24","1","90","","2","5","3","5","","","","70","2014-05-17 08:22:50","24","2014-05-17 12:42:38","","","","");
INSERT INTO complaint VALUES("2107","MIS-0000658","Zimbra is not working and not able to receive and send mails.","Thank you for the fast action taken.","3","","5","1","46","","1","3","3","5","","","","258","2014-05-17 08:34:59","5","2014-05-17 12:44:16","","","","");
INSERT INTO complaint VALUES("2108","Maintenance-0001450","camp cot painting to be done.","C - 1 bed side.","9","","37","1","61","294","2","9","3","5","","","","107","2014-05-17 08:44:18","227","2014-06-05 12:51:03","","","","");
INSERT INTO complaint VALUES("2109","Maintenance-0001451","room no 1516 door handle is loose not able to close","please rectify ASAP","9","","37","1","49","236","2","9","3","5","","","","97","2014-05-17 08:47:52","37","2014-05-17 12:49:59","","","","");
INSERT INTO complaint VALUES("2110","Maintenance-0001452","1. The wood sheet stuck to the wall in MOPD patient waiting area is coming out of fall, please consider it as emergency and rectify it today itself.
INSERT INTO complaint VALUES("2111","MIS-0000659","annex system ","not working","3","","5","1","82","","1","3","3","5","4","","standby key board                             ","98","2014-05-17 08:55:01","5","2014-05-19 10:26:02","","","","");
INSERT INTO complaint VALUES("2112","MIS-0000660","X-RAY COUNTER SYSTEM IS NOT WORKING",".....................","2","","5","1","90","","1","2","3","5","","0","","70","2014-05-17 09:01:08","5","2014-05-17 09:17:31","","","","");
INSERT INTO complaint VALUES("2113","Maintenance-0001453","kindly arrange lock and key for the nurse educator room as the previous lock is under repair and a latch is being fixed."," hence to lock the door kindly arrange lock and key medium sized as early as possible.","9","","37","1","50","","2","9","3","5","","","","126","2014-05-17 09:21:02","37","2014-05-17 12:49:47","","","","");
INSERT INTO complaint VALUES("2114","Maintenance-0001454","Cementing has to done in Pot wash area, dish-wash area, entrance of dietary office. very urgent.","very urgent.","12","","386","1","68","","2","12","3","5","","","","392","2014-05-17 09:46:09","227","2014-05-28 15:28:27","","","","");
INSERT INTO complaint VALUES("2115","Maintenance-0001455","IN X-RAY RECEPTION WALL MOUNTED FAN TO BE FIXED.","IN X-RAY RECEPTION WALL MOUNTED FAN TO BE FIXED.","5","","24","1","90","","2","5","3","5","","","","70","2014-05-17 09:47:51","24","2014-05-17 12:42:24","","","","");
INSERT INTO complaint VALUES("2116","Maintenance-0001456","1. Plusto flash is not  working in canteen department.
INSERT INTO complaint VALUES("2117","Maintenance-0001457","Bottom Surface phototheraphy  two tubelights are not working.","please come immediately","7","","29","1","49","242","2","7","3","5","","","","97","2014-05-17 10:06:27","29","2014-05-17 10:45:06","","","","");
INSERT INTO complaint VALUES("2118","Maintenance-0001458","NURSES STATION OXYGEN CYLINDER IS EMPTY","PLEASE SEND FAST","7","","29","1","64","","2","7","3","7","","","","110","2014-05-17 10:28:52","110","2014-05-19 08:23:16","","","","");
INSERT INTO complaint VALUES("2119","Maintenance-0001459","O2 cylinder is empty","attend soon","7","","29","1","58","","2","7","3","7","","","","225","2014-05-17 10:48:05","225","2014-05-20 08:36:35","","","","");
INSERT INTO complaint VALUES("2120","MIS-0000661","ip billing section","ibp-02 accapac is not responding","3","","5","1","42","","1","3","3","5","","","","372","2014-05-17 10:48:13","5","2014-05-17 11:01:31","","","","");
INSERT INTO complaint VALUES("2121","MIS-0000662","ms office 2007 installation","ms office 2007 installation","3","","5","1","94","","1","3","3","5","","","","147","2014-05-17 11:00:47","5","2014-05-17 11:01:20","","","","");
INSERT INTO complaint VALUES("2122","MIS-0000663","SURGICAL SPIRIT CONSUMPTION ENTRY DONE BUT IN THE SYSTEM IT SHOWING NOT DONE.","SURGICAL SPIRIT CONSUMPTION ENTRY DONE BUT IN THE SYSTEM IT SHOWING NOT DONE.","3","","6","1","53","","1","3","3","5","","","","119","2014-05-17 11:12:14","6","2014-05-19 09:01:57","","","","");
INSERT INTO complaint VALUES("2123","Maintenance-0001460","BSNL phone is not working in the Principal.","Urgent","8","","33","4","107","","2","8","3","7","","","","265","2014-05-17 11:57:40","265","2014-06-02 10:41:52","","","","");
INSERT INTO complaint VALUES("2124","Maintenance-0001461","balk on pram to be fixed.","C - 11 to C- 8.","7","","28","1","62","","2","7","3","5","","","","107","2014-05-17 12:02:31","28","2014-05-19 14:45:11","","","","");
INSERT INTO complaint VALUES("2125","Maintenance-0001462","\"C\" Calling bell to be checked ","very urgent ","8","","33","1","65","","2","8","3","7","","","","84","2014-05-17 12:03:49","84","2014-05-21 08:10:30","","","","");
INSERT INTO complaint VALUES("2126","Maintenance-0001463","Screw to be fixed to linen bag ","urgent ","9","","37","1","65","","2","9","3","7","","","","84","2014-05-17 12:04:52","84","2014-06-19 08:17:11","","","","");
INSERT INTO complaint VALUES("2127","Maintenance-0001464","Weighing scale has to be repaired ","Very Urgently.","7","","26","1","68","","2","7","3","5","","","","392","2014-05-17 12:08:06","26","2014-05-19 16:40:56","","","","");
INSERT INTO complaint VALUES("2128","MIS-0000664","crp-02 system hanging from a long time ","high priority","3","","8","1","40","11","1","3","3","7","","","","313","2014-05-17 12:12:32","313","2014-05-22 09:10:04","","","","");
INSERT INTO complaint VALUES("2129","Maintenance-0001465","Labour room vaccu suction is not working","As soon as possible.","7","","28","1","59","155","2","7","3","5","","","","116","2014-05-17 12:20:16","28","2014-05-19 15:16:27","","","","");
INSERT INTO complaint VALUES("2130","Maintenance-0001466","OFFICE ROLLING chair","BACK REST IS NOT WORKING.","9","","37","1","81","","2","9","3","2","","","","98","2014-05-17 12:38:18","227","2014-05-17 12:40:59","","","","");
INSERT INTO complaint VALUES("2131","Maintenance-0001467","PA SYSTEM","NOT AUDIBLE ","8","","33","1","81","","2","8","3","5","","","","98","2014-05-17 12:48:55","33","2014-05-19 16:38:09","","","","");
INSERT INTO complaint VALUES("2132","MIS-0000665","crp-02 system is still hanging","high priority","3","","5","1","40","11","1","3","3","7","","","","313","2014-05-17 12:50:35","313","2014-05-22 09:09:48","","","","");
INSERT INTO complaint VALUES("2133","Maintenance-0001468","NOT WORKING","PLEASE DO THE NEEDFUL","10","","26","1","50","89","2","10","3","7","","","","181","2014-05-19 07:23:04","181","2014-05-23 11:43:25","","","","");
INSERT INTO complaint VALUES("2134","Maintenance-0001469","Gyzer not working","please do the nrrdful","6","","31","1","50","89","2","6","3","7","","","","181","2014-05-19 07:24:28","181","2014-05-23 11:44:19","","","","");
INSERT INTO complaint VALUES("2135","MIS-0000666","printer is not working urgent","printer is not working urgent","2","","8","1","16","17","1","2","3","7","","0","","132","2014-05-19 08:01:25","132","2014-06-09 10:41:42","","","","");
INSERT INTO complaint VALUES("2136","MIS-0000667","OPT -01 SYSTEM OUTLOOK EXPRESS IS NOT GETTING OPEN","DO IT AS PER AS POSSIBLE ","3","","112","1","58","","1","3","3","5","","","","124","2014-05-19 08:04:30","112","2014-05-19 08:12:54","","","","");
INSERT INTO complaint VALUES("2137","Maintenance-0001470","sinck tap is missing in MRD gents toilet so please replace it as soon as possible.","urgent","6","","30","1","47","116","2","6","3","5","","","","149","2014-05-19 08:17:23","30","2014-05-19 14:31:36","","","","");
INSERT INTO complaint VALUES("2138","Maintenance-0001471","D-ROOM PATIENT CALLING BELL TO BE FIXED","PLEASE RECTIIFY SOON","8","","33","1","64","","2","8","3","5","","","","110","2014-05-19 08:21:54","33","2014-05-20 15:37:54","","","","");
INSERT INTO complaint VALUES("2139","Maintenance-0001472","IN DELUXE ROOM 3201 WALL FLESH (ROUND PLATE )  IS REMOVED ","KINDLY DO THE NEEDFUL.","6","","30","1","50","","2","6","3","5","","","","126","2014-05-19 08:22:30","30","2014-05-19 14:30:20","","","","");
INSERT INTO complaint VALUES("2140","Maintenance-0001473","NURSES STATION OXYGEN CYLINDER IS EMPTY","PLEASE SEND FAST","7","","28","1","64","","2","7","3","5","","","","110","2014-05-19 08:22:51","28","2014-05-19 14:44:18","","","","");
INSERT INTO complaint VALUES("2141","Maintenance-0001474","sink water is not draining properly","sink water is not draining properly","6","","30","1","53","","2","6","3","5","","","","119","2014-05-19 08:34:41","30","2014-05-19 14:34:01","","","","");
INSERT INTO complaint VALUES("2142","MIS-0000668","printer not working","urgent","2","","112","1","47","","1","2","3","5","","0","","149","2014-05-19 08:48:22","112","2014-05-19 09:25:02","","","","");
INSERT INTO complaint VALUES("2143","Maintenance-0001475","\"E-2\" patient cot side rails screw to be fixed ","very urgent ","7","","28","1","65","","2","7","3","7","","","","84","2014-05-19 08:52:14","84","2014-05-20 08:35:38","","","","");
INSERT INTO complaint VALUES("2144","MIS-0000669","excel to be installed in W-3 Billing system 
INSERT INTO complaint VALUES("2145","MIS-0000670","Sage Accpac not functioning","user id: jude@bbh.org.in","3","","6","1","80","","1","3","3","5","","","","359","2014-05-19 09:01:01","6","2014-05-19 10:53:54","20140519090101_sage accpac.png","","","");
INSERT INTO complaint VALUES("2146","MIS-0000671","crp-o2 system is hanging","high priority","3","","112","1","40","11","1","3","3","7","6","","This System have to Format for that take all the c drive Backup ","313","2014-05-19 09:07:07","112","2014-05-19 11:26:57","","","","");
INSERT INTO complaint VALUES("2147","Maintenance-0001476","COMPUTER TABLE KEY BOARD STAND IS NOT WORKING","REQUEST YOU TO DO AS QUICKLY AS POSSIBLE","9","","37","1","32","","2","9","3","5","","","","96","2014-05-19 09:10:53","37","2014-05-19 16:47:40","","","","");
INSERT INTO complaint VALUES("2148","Maintenance-0001477","SSPT two tubes are not working.","Urgent","7","","27","1","60","277","2","7","3","5","","","","145","2014-05-19 09:24:51","27","2014-05-20 08:12:19","","","","");
INSERT INTO complaint VALUES("2149","Maintenance-0001478","J-6,   Locker is broken.","uRGENT","9","","37","1","60","284","2","9","3","5","","","","145","2014-05-19 09:26:08","37","2014-05-19 16:49:36","","","","");
INSERT INTO complaint VALUES("2150","Maintenance-0001479","Latch to be fix for the footwear stand.","urgent please.","9","","37","1","57","","2","9","3","5","","","","362","2014-05-19 09:26:28","37","2014-05-19 16:48:19","","","","");
INSERT INTO complaint VALUES("2151","Maintenance-0001480","soft rubber wall bar to fixed in 18 places.","All corner are sharp edges it came hurt small children in our ward.","9","","37","1","61","293","2","9","3","3","9","","Outsource to be done ","104","2014-05-19 09:26:43","227","2014-06-12 13:13:26","","","","");
INSERT INTO complaint VALUES("2152","MIS-0000672","Icons are not coming in the desk top.System name is wing -1-01","Urgent","2","","5","1","60","","1","2","3","5","","0","","145","2014-05-19 09:28:26","5","2014-05-19 10:26:27","","","","");
INSERT INTO complaint VALUES("2153","MIS-0000673","w-1 ip billing cabien","printer is not working","2","","5","1","42","","1","2","3","5","6","0","checking","372","2014-05-19 09:48:38","5","2014-05-20 11:25:29","","","","");
INSERT INTO complaint VALUES("2154","MIS-0000674","WING 1caben  IP billing printer is not working.","urgent.","2","","5","1","42","","1","2","3","5","6","0","checking","374","2014-05-19 09:50:15","5","2014-05-20 11:25:38","","","","");
INSERT INTO complaint VALUES("2155","Maintenance-0001481","\"E\" Bathroom flush water is not working ","urgent ","6","","30","1","65","352","2","6","3","7","","","","84","2014-05-19 09:50:59","84","2014-05-20 08:35:21","","","","");
INSERT INTO complaint VALUES("2156","Maintenance-0001482","\"C\" bathroom sink is smelling badly ","very urgent ","6","","30","1","65","349","2","6","3","7","","","","84","2014-05-19 09:51:49","84","2014-05-20 08:34:10","","","","");
INSERT INTO complaint VALUES("2157","MIS-0000675","In Apollo Excel sheet which had hyperlink the reports is not opening.","If we click on that MRD NO is showing Cannot open the specified file.","3","","5","1","17","32","1","3","3","7","","","","113","2014-05-19 10:02:47","113","2014-05-22 10:12:17","","","","");
INSERT INTO complaint VALUES("2158","Maintenance-0001483","required 2 wooden rack to keep slippers","urgent","9","","37","1","56","","2","9","3","5","9","","Outsource to be done ","73","2014-05-19 10:11:04","227","2014-06-05 12:52:45","","","","");
INSERT INTO complaint VALUES("2159","MIS-0000676","pcw-02 system sage accacpac no license to open and no mozilla or internet.","please come ASAP.","3","","5","1","49","","1","3","3","5","","","","97","2014-05-19 10:14:43","5","2014-05-19 10:47:47","","","","");
INSERT INTO complaint VALUES("2160","MIS-0000677","upload HIC presentation in training module","                                    ","3","","8","1","26","","1","3","3","7","","","","76","2014-05-19 10:18:03","76","2014-06-09 12:08:51","","","","");
INSERT INTO complaint VALUES("2161","MIS-0000678","Upload restraint ppt in training module ","                                   ","3","","8","1","26","","1","3","3","7","","","","76","2014-05-19 10:18:32","76","2014-06-09 12:08:39","","","","");
INSERT INTO complaint VALUES("2162","MIS-0000679","02405 ANITHA CHRISTINAL PASSWORD IS NOT ACCEPTING PLZ RECTIFY IT.","URGENT","3","","6","1","56","","1","3","3","5","","","","73","2014-05-19 10:20:13","6","2014-05-19 10:52:14","","","","");
INSERT INTO complaint VALUES("2163","Maintenance-0001484","drawer  lock  is broken","urgent please","9","","37","1","71","167","2","9","3","5","","","","205","2014-05-19 10:22:32","37","2014-05-19 16:50:01","","","","");
INSERT INTO complaint VALUES("2164","Maintenance-0001485","Dental doctor\'s stool refurbishing","Please attend ","9","","37","1","78","","2","9","3","2","","","","261","2014-05-19 10:25:01","227","2014-05-19 10:28:17","","","","");
INSERT INTO complaint VALUES("2165","MIS-0000680","printer is not working","printer is not working","2","","5","1","16","19","1","2","3","7","","0","","132","2014-05-19 10:31:51","132","2014-06-09 10:41:21","","","","");
INSERT INTO complaint VALUES("2166","MIS-0000681","sytem","key board not working","3","","5","1","82","","1","3","3","5","","","","98","2014-05-19 10:36:51","5","2014-05-19 10:50:49","","","","");
INSERT INTO complaint VALUES("2167","MIS-0000682","MS Office Need To install","MS Office Need To install","3","","112","1","42","","1","3","3","5","","","","369","2014-05-19 10:51:54","112","2014-05-19 10:55:05","","","","");
INSERT INTO complaint VALUES("2168","Maintenance-0001486","trolley wheel is on repair so please send some one to OT ","DO IT SOON ","7","","28","1","58","196","2","7","3","5","","","","124","2014-05-19 10:51:55","28","2014-05-19 14:43:33","","","","");
INSERT INTO complaint VALUES("2169","Maintenance-0001487","OT ORTHO INSTRUMENT ( MAN MAN DRILL WHEEL HAS TO FIXED )","DO IT SOON ","7","","28","1","58","","2","7","3","5","","","","124","2014-05-19 10:53:18","28","2014-05-19 14:43:59","","","","");
INSERT INTO complaint VALUES("2170","Maintenance-0001488","OT -6 DOOR IS NOT CLOSING PROPER ","DO IT AS PER AS POSSIBLE ","9","","37","1","58","194","2","9","3","5","","","","124","2014-05-19 10:56:17","227","2014-06-05 12:52:58","","","","");
INSERT INTO complaint VALUES("2171","Maintenance-0001489","Western toilet commode seat is detached and kept aside. replacement required.
INSERT INTO complaint VALUES("2172","Maintenance-0001490","Drinking water is not coming near the dinning area in the cooler.","very urgently!!!!","6","","30","1","68","","2","6","3","5","","","","392","2014-05-19 11:19:57","30","2014-05-19 14:28:40","","","","");
INSERT INTO complaint VALUES("2173","Maintenance-0001491","Side door is broken in the dinning area.","Very urgent!!!!!.","9","","37","1","68","","2","9","3","5","","","","392","2014-05-19 11:23:54","37","2014-05-21 08:45:48","","","","");
INSERT INTO complaint VALUES("2174","Maintenance-0001492","Side door is broken in the dinning area please come and rectify the problem.","Very urgent","9","","37","1","68","","2","9","3","5","","","","392","2014-05-19 11:24:32","37","2014-05-21 08:46:04","","","","");
INSERT INTO complaint VALUES("2175","Maintenance-0001493","INTEGRATED MEDICINE BATHROOM FLOOR WATER BLOCK","PLEASE RECTIFY IMMEDIATELY","6","","30","1","49","242","2","6","3","5","","","","97","2014-05-19 11:35:49","30","2014-05-19 16:50:34","","","","");
INSERT INTO complaint VALUES("2176","Maintenance-0001494","plywood sheet to be changed infront of labour room  ","do ASAP","9","","37","1","59","","2","9","3","5","","","","270","2014-05-19 11:53:13","37","2014-05-19 16:49:22","","","","");
INSERT INTO complaint VALUES("2177","Maintenance-0001495","Trolly pin has to be changed now .","Very urgent.","5","","24","1","68","93","2","5","3","5","","","","392","2014-05-19 11:55:29","24","2014-05-19 16:46:35","","","","");
INSERT INTO complaint VALUES("2178","Maintenance-0001496","Guest hand Wash area pipe is leaking behind the kitchen and the water is entering in the kitchen.Please retify the problem immediately.","Very urgent.","6","","30","1","68","","2","6","3","5","","","","392","2014-05-19 12:08:47","30","2014-05-19 16:51:13","","","","");
INSERT INTO complaint VALUES("2179","Maintenance-0001497","Weighing Scale is got repaired. Plese repair it as possible as possible.","Very Urgent.","7","","26","1","68","","2","7","3","5","9","","Outsource to be done it will be delayed","392","2014-05-19 12:31:11","26","2014-05-19 16:39:56","","","","");
INSERT INTO complaint VALUES("2180","MIS-0000683","Rectification - make all italics -  in (contributions)Ms. Thankam and Dr.Ajay Shettys plaque. Urgent","matter Urgent.","3","","8","1","94","37","1","3","3","7","","","","259","2014-05-19 12:31:50","259","2014-06-06 12:35:38","","","","");
INSERT INTO complaint VALUES("2181","Maintenance-0001498","Intercom RJ cable to b replaced and instrument to be checked .","The opposite side voice  hearing very narrowly ","8","","33","1","28","","2","8","3","7","","","","117","2014-05-19 12:39:42","117","2014-05-24 08:04:45","","","","");
INSERT INTO complaint VALUES("2182","Maintenance-0001499","SUCTION APPARATUS IS NOT WORKING","PLEASE RECTIFY SOON","7","","27","1","64","24","2","7","3","5","","","","110","2014-05-19 13:19:28","27","2014-05-19 14:19:46","","","","");
INSERT INTO complaint VALUES("2183","MIS-0000684","keyboard not working","keyboard not working","2","","5","1","44","38","1","2","3","7","","0","","348","2014-05-19 14:08:46","348","2014-05-22 09:48:23","","","","");
INSERT INTO complaint VALUES("2184","Maintenance-0001500","Water tank and samp  has to be cleaned, worms are coming out it. please rectify the problem.","Very urgent.","6","","32","1","68","","2","6","3","5","","","","392","2014-05-19 14:27:58","32","2014-05-23 12:21:14","","","","");
INSERT INTO complaint VALUES("2185","Maintenance-0001501","Extra lighting has to be done in Dish wash area, diet setting area, vegetable cutting area. do it very urgently.","Very very urgent..","5","","25","1","68","","2","5","3","5","6","","Its new requirement items no stock non stock raised ","392","2014-05-19 14:29:27","25","2014-06-12 10:25:50","","","","");
INSERT INTO complaint VALUES("2186","Maintenance-0001502","ALL THE ROOMS OXYGEN AND SUCTION CALIBRATION STICKERS TO BE CHANGED","PLEASE DO IMMEDIATELY","7","","28","1","49","242","2","7","3","5","9","","out source vender to be done","97","2014-05-19 14:40:08","28","2014-06-07 13:13:16","","","","");
INSERT INTO complaint VALUES("2187","Maintenance-0001503","Drainage blocked near pot wash area.","very urgent.","6","","30","1","68","","2","6","3","5","","","","392","2014-05-19 15:01:48","30","2014-05-19 16:50:58","","","","");
INSERT INTO complaint VALUES("2188","Maintenance-0001504","Drainage is blocked near pot wash area, please retify the problem immdetialy ","Very urgent.","6","","30","1","68","","2","6","3","5","","","","392","2014-05-19 15:02:59","30","2014-05-19 16:50:47","","","","");
INSERT INTO complaint VALUES("2189","Maintenance-0001505","TUBE LIGHT NOT WORKING","URGENT","5","","25","1","71","163","2","5","3","5","","","","202","2014-05-19 15:16:56","25","2014-05-19 16:42:15","","","","");
INSERT INTO complaint VALUES("2190","Maintenance-0001506","Dusting and cleaning has to be done in Dietary department.","Do it as soon as possible.","11","","21","1","68","","2","11","3","5","","","","392","2014-05-19 15:26:12","227","2014-05-19 15:27:21","","","","");
INSERT INTO complaint VALUES("2191","Maintenance-0001507","Men\'s Hostel 1st floor 1 st room small cupboard lock to be repair","Men\'s Hostel 1st floor 1 st room small cupboard lock to be repair","9","","37","2","27","","2","9","3","7","","","","16","2014-05-19 15:26:33","16","2014-05-28 15:11:49","","","","");
INSERT INTO complaint VALUES("2192","Maintenance-0001508","Room A bed -3 cot said rails bar to be fix.","as soon as possible.","7","","27","1","63","","2","7","3","7","","","","87","2014-05-19 15:32:49","87","2014-05-22 11:49:34","","","","");
INSERT INTO complaint VALUES("2193","Maintenance-0001509","Room  G pt lock wood and pantry side steel bar screw to be fix.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-05-19 15:33:52","87","2014-05-20 12:38:22","","","","");
INSERT INTO complaint VALUES("2194","Maintenance-0001510","1.  Oxygen flow meter taken that due to some problem from RT dept on 2 months back, two times informed to maintenance dept but action not taken.due to this patients are not getting emergency care
INSERT INTO complaint VALUES("2195","Maintenance-0001511","A-ROOM SUCTION APPARATUS IS NOT WORKING","PLEASE SEND FAST","7","","28","1","64","","2","7","3","5","","","","110","2014-05-20 07:49:36","28","2014-05-20 08:34:11","","","","");
INSERT INTO complaint VALUES("2196","Maintenance-0001512","Lock hook broken in TV room","attend soon","9","","37","1","27","","2","9","3","7","","","","225","2014-05-20 08:14:00","225","2014-05-23 15:20:49","","","","");
INSERT INTO complaint VALUES("2197","Maintenance-0001513","Female general toilet flush water is slow ","urgent ","6","","30","1","65","359","2","6","3","7","","","","84","2014-05-20 08:36:48","84","2014-05-21 08:09:35","","","","");
INSERT INTO complaint VALUES("2198","Maintenance-0001514","\"D\" Room Bathroom door is strucked tightly ","urgent ","9","","37","1","65","350","2","9","3","7","","","","84","2014-05-20 08:37:55","84","2014-05-21 08:47:52","","","","");
INSERT INTO complaint VALUES("2199","Maintenance-0001515","\"G\" room Bathroom door plate to be fixed ","urgent ","9","","37","1","65","351","2","9","3","7","","","","84","2014-05-20 08:39:29","84","2014-05-21 08:48:13","","","","");
INSERT INTO complaint VALUES("2200","Maintenance-0001516","pediatric department OPD room no 6 tubelight not working.","kindly do the needful.","5","","24","1","79","","2","5","3","5","","","","216","2014-05-20 08:41:18","24","2014-05-20 16:05:29","","","","");
INSERT INTO complaint VALUES("2201","Maintenance-0001517","Extra Cupboards to be fixed in pantry room","urgent ","9","","37","1","65","356","2","9","3","3","9","","out source work to be done ","84","2014-05-20 08:41:38","37","2014-05-21 08:43:53","","","","");
INSERT INTO complaint VALUES("2202","Maintenance-0001518","Crack to be checked in the waiting area of Wing-6","urgent ","12","","386","1","65","","2","12","3","3","9","","out source work to be done","84","2014-05-20 08:43:32","30","2014-06-02 10:51:15","","","","");
INSERT INTO complaint VALUES("2203","Maintenance-0001519","All Bathroom flush water is in black color to be checked ","urgent ","6","","30","1","65","","2","6","3","7","","","","84","2014-05-20 08:46:34","84","2014-05-21 08:08:43","","","","");
INSERT INTO complaint VALUES("2204","Maintenance-0001520","wash basin to be repair in the nurses changing room","urgent","6","","30","1","54","","2","6","3","5","","","","73","2014-05-20 08:52:17","30","2014-05-20 16:14:26","","","","");
INSERT INTO complaint VALUES("2205","Maintenance-0001521","CHAIR IS BROKEN       CASH COUNTER 4 NEAR CASUALITY","CHAIR IS BROKEN ","7","","28","1","44","57","2","7","3","7","","","","348","2014-05-20 08:57:05","348","2014-06-13 14:27:48","","","","");
INSERT INTO complaint VALUES("2206","MIS-0000685","CRP 014 ","Adobe reader is not working or allowing to download any documents","3","","5","1","40","12","1","3","3","7","","","","65","2014-05-20 08:58:43","65","2014-05-23 12:15:52","","","","");
INSERT INTO complaint VALUES("2207","Maintenance-0001522","Tiles near the dough making(chapati), pot wash area, dish wash area.","Very urgently.","12","","386","1","68","","2","12","3","5","9","","Outsource to be done ","392","2014-05-20 09:11:58","227","2014-05-28 15:27:24","","","","");
INSERT INTO complaint VALUES("2208","MIS-0000686","Key board not working","high priority","2","","5","1","40","12","1","2","3","7","","0","","65","2014-05-20 09:27:06","65","2014-05-23 12:17:32","","","","");
INSERT INTO complaint VALUES("2209","Maintenance-0001523","calling Bel panel to be fixed. D - 1","urgent.","8","","33","1","62","310","2","8","3","5","","","","107","2014-05-20 10:05:10","33","2014-05-23 16:04:50","","","","");
INSERT INTO complaint VALUES("2210","Maintenance-0001524","G& Maternity rest room, flush out not working.","Urgent","6","","30","1","60","281","2","6","3","5","","","","103","2014-05-20 10:08:44","30","2014-05-20 16:14:48","","","","");
INSERT INTO complaint VALUES("2211","Maintenance-0001525","f-6&I-I&J-6 CALLING BELL IS NOT WORKING","URGENT","8","","33","1","60","277","2","8","3","5","","","","103","2014-05-20 10:10:58","33","2014-05-23 16:04:37","","","","");
INSERT INTO complaint VALUES("2212","Maintenance-0001526","Aquaguard switch / button broken to be checked","please come immediately","6","","30","1","49","242","2","6","3","3","9","","Outsource vendor of Eureka forbes person has to replace the switch ","97","2014-05-20 10:38:31","30","2014-06-12 12:21:40","","","","");
INSERT INTO complaint VALUES("2213","MIS-0000687","pt name sukla saha hos no AA123828 pts glycosylated HEAMOGLOBIN  report is not able to validate so pls rectifi it soon","urgent","3","","6","1","17","27","1","3","3","7","","","","113","2014-05-20 10:44:55","113","2014-05-22 10:11:58","","","","");
INSERT INTO complaint VALUES("2214","Maintenance-0001527","spot light fushed","very urgent","5","","25","1","73","104","2","5","3","5","","","","210","2014-05-20 10:49:44","25","2014-05-20 16:04:07","","","","");
INSERT INTO complaint VALUES("2215","Maintenance-0001528","tube light is not working in s4","to be changed immediately","5","","25","1","72","276","2","5","3","5","","","","217","2014-05-20 10:52:11","25","2014-05-20 16:03:50","","","","");
INSERT INTO complaint VALUES("2216","MIS-0000688","printer is not working","urgent","2","","5","1","60","","1","2","3","5","","0","","103","2014-05-20 11:01:09","5","2014-05-20 11:25:19","","","","");
INSERT INTO complaint VALUES("2217","MIS-0000689","ACCPAC is not working in anaesthesia office system","not working","3","","5","1","108","","1","3","3","7","","","","134","2014-05-20 11:05:04","134","2014-06-05 01:04:20","","","","");
INSERT INTO complaint VALUES("2218","Maintenance-0001529","PC ward entrance grill gate tiles fixed has come out, making noise while stepping.","please come immediately. this is a reminder already i have sent on 18.05.2014","12","","386","1","49","242","2","12","3","5","9","","OUT SOURCE WORK TO BE DONE","97","2014-05-20 11:15:56","227","2014-05-28 15:26:32","","","","");
INSERT INTO complaint VALUES("2219","Maintenance-0001530","New Cupboard to be fixed in Pantry Room and treatment Room","urgent ","9","","37","1","65","","2","9","3","3","9","","out source work to be done ","84","2014-05-20 11:19:49","37","2014-05-21 08:43:31","","","","");
INSERT INTO complaint VALUES("2220","Maintenance-0001531","burning smell when fan is switched on.","urgent","5","","25","1","71","166","2","5","3","5","","","","205","2014-05-20 11:20:37","25","2014-05-24 12:31:14","","","","");
INSERT INTO complaint VALUES("2221","Maintenance-0001532","Geriatric room tubelight is not working","urgent","5","","25","1","74","186","2","5","3","5","","","","205","2014-05-20 11:21:29","25","2014-05-24 12:31:23","","","","");
INSERT INTO complaint VALUES("2222","Maintenance-0001533","spot lamp is broken","to be repaired as soon as posible","5","","25","1","72","276","2","5","3","5","","","","217","2014-05-20 11:31:05","25","2014-05-20 16:02:07","","","","");
INSERT INTO complaint VALUES("2223","Maintenance-0001534","pc opd oxygen cylinder to be checked","please come immediatly","7","","29","1","102","","2","7","3","5","","","","246","2014-05-20 11:55:32","29","2014-05-21 11:56:15","","","","");
INSERT INTO complaint VALUES("2224","Maintenance-0001535","PC WARD phototheraphy one top surface and one bottom surface lights are not working .","please come immediately","7","","29","1","49","242","2","7","3","5","","","","97","2014-05-20 11:56:40","29","2014-05-22 07:39:48","","","","");
INSERT INTO complaint VALUES("2225","Maintenance-0001536","gheecer not working in ot-2 sluice room","urgent","6","","32","1","58","197","2","6","3","5","","","","122","2014-05-20 12:06:00","32","2014-05-23 12:20:59","","","","");
INSERT INTO complaint VALUES("2226","MIS-0000690","System not working ","Urgent ","3","","5","1","17","29","1","3","3","5","","","","299","2014-05-20 12:14:08","5","2014-05-20 12:47:08","","","","");
INSERT INTO complaint VALUES("2227","Maintenance-0001537","Room E bath room hand wash sink blacked to be check.
INSERT INTO complaint VALUES("2228","MIS-0000691","Accpac is not opening","Accpac is not opening","3","","5","1","16","17","1","3","3","7","","","","132","2014-05-20 12:57:27","132","2014-05-23 15:18:28","","","","");
INSERT INTO complaint VALUES("2229","Maintenance-0001538","Room B bed - 5 calling bell is not working to be check.","as soon as possible.","8","","33","1","63","","2","8","3","7","","","","87","2014-05-20 13:05:13","87","2014-06-19 10:26:07","","","","");
INSERT INTO complaint VALUES("2230","MIS-0000692","IPB-05 BILLING SECTION","CALL MANAGEMENT NOT WORKING","3","","112","1","42","","1","3","3","5","","","","118","2014-05-20 13:31:18","112","2014-05-20 14:06:57","","","","");
INSERT INTO complaint VALUES("2231","Maintenance-0001539","crp-o2 system is hanging","high priority","","","227","1","40","11","2","","3","7","","","This System have to Format for that take all the c drive Backup ","313","2014-05-20 13:55:10","112","2014-05-20 13:55:10","","","","");
INSERT INTO complaint VALUES("2232","Maintenance-0001540","Phone Not Working","Phone Not Working","8","","34","1","42","133","2","8","3","5","","","","372","2014-05-20 14:10:46","34","2014-05-20 16:19:12","","","","");
INSERT INTO complaint VALUES("2233","MIS-0000693","crp-o2 system is hanging","high priority","3","","112","1","40","11","1","3","3","7","","","This System have to Format for that take all the c drive Backup ","313","2014-05-20 14:28:58","313","2014-05-22 09:09:10","","","","");
INSERT INTO complaint VALUES("2234","Maintenance-0001541","pt wheel chair to be check and air to be fill.","as soon as possible.","7","","29","1","63","","2","7","3","7","","","","87","2014-05-20 14:48:30","87","2014-05-22 11:43:26","","","","");
INSERT INTO complaint VALUES("2235","MIS-0000694","PRINTER NOT WORKING PROPERLY.  NEED ONE MOUSE PAD ","PRINTER NOT WORKING PROPERLY.  NEED ONE MOUSE PAD ","2","","112","1","44","361","1","2","3","7","","0","","384","2014-05-20 15:04:55","384","2014-05-22 14:24:22","","","","");
INSERT INTO complaint VALUES("2236","Maintenance-0001542","Bicycle seat to be fixed.
INSERT INTO complaint VALUES("2237","MIS-0000695","ACCPAC NOT WORKING-IPB -04","ACCPAC NOT WORKING-IPB -04","3","","5","1","42","","1","3","3","5","","","","118","2014-05-20 15:08:26","5","2014-05-20 15:20:36","","","","");
INSERT INTO complaint VALUES("2238","Maintenance-0001543","Female General Toilet Flush Water is flowing continuously","very urgent ","6","","32","1","65","359","2","6","3","7","","","","84","2014-05-20 15:37:30","84","2014-05-21 08:07:30","","","","");
INSERT INTO complaint VALUES("2239","Maintenance-0001544","B-1bed side caling Bel pressing button to be fixed.","urgently.","8","","33","1","61","293","2","8","3","5","","","","107","2014-05-20 15:37:35","33","2014-05-23 16:04:21","","","","");
INSERT INTO complaint VALUES("2240","Maintenance-0001545","Men\'s hostel 1st floor light not working","attend soon","7","","27","2","2","","2","7","3","7","","","","225","2014-05-20 16:20:35","225","2014-05-23 15:20:29","","","","");
INSERT INTO complaint VALUES("2241","MIS-0000696","admission not entering ","admission not entering ","3","","5","1","16","18","1","3","3","7","","","","132","2014-05-20 16:31:14","132","2014-05-23 15:18:07","","","","");
INSERT INTO complaint VALUES("2242","Maintenance-0001546","rain water licking in main mrd registration area","rain water licking in main mrd registration area","6","","31","1","16","171","2","6","3","7","","","","132","2014-05-20 16:33:29","132","2014-06-09 10:41:07","","","","");
INSERT INTO complaint VALUES("2243","Maintenance-0001547","Wash basin is blocked","urgent","6","","31","1","65","354","2","6","3","7","","","","84","2014-05-21 07:22:37","84","2014-05-21 16:28:30","","","","");
INSERT INTO complaint VALUES("2244","Maintenance-0001548","wheel chair to be repaired","urgent","7","","28","1","65","353","2","7","3","7","","","","84","2014-05-21 07:23:29","84","2014-05-26 08:16:13","","","","");
INSERT INTO complaint VALUES("2245","Maintenance-0001549","Wing -6 waiting area wall has creak  near the glass","as soon as possible","12","","386","1","65","","2","12","3","2","","","","84","2014-05-21 07:25:53","227","2014-05-21 08:25:01","","","","");
INSERT INTO complaint VALUES("2246","Maintenance-0001550","room no 1518 bathroom light not working","please rectify immediately","5","","23","3","49","238","2","5","3","5","","","","97","2014-05-21 07:48:53","23","2014-05-22 09:32:51","","","","");
INSERT INTO complaint VALUES("2247","Maintenance-0001551","room no 1507,1508,1509,1510,1511,patient call bell not working ","please rectify immediately","8","","34","1","49","242","2","8","3","5","","","","97","2014-05-21 07:49:58","34","2014-05-22 09:34:41","","","","");
INSERT INTO complaint VALUES("2248","MIS-0000697","recovery telephone is not working ","do it soon","","","123","1","58","","1","3","3","7","","","null","124","2014-05-21 08:14:26","124","2014-05-21 08:14:26","","","","");
INSERT INTO complaint VALUES("2249","MIS-0000698","HIGH RISK LABOUR ROOM PRINT OPTION IS NOT WORKING","AS SOON AS POSSIBLE ","3","","6","1","59","","1","3","3","5","","","","116","2014-05-21 08:17:34","6","2014-05-21 08:20:11","","","","");
INSERT INTO complaint VALUES("2250","Maintenance-0001552","In CCU near Bed #3 the oxygen flow meter has come out.","Please do the needful at the earliest.","7","","28","1","52","","2","7","3","7","","","","128","2014-05-21 08:17:48","128","2014-05-22 09:50:33","","","","");
INSERT INTO complaint VALUES("2251","Maintenance-0001553","female General toilet flush water is flowing continuously","urgent ","6","","31","1","65","359","2","6","3","7","","","","84","2014-05-21 08:18:27","84","2014-05-21 16:27:37","","","","");
INSERT INTO complaint VALUES("2252","Maintenance-0001554","\"A\" room Bathroom flush water is flowing continuously ","urgent ","6","","31","1","65","347","2","6","3","7","","","","84","2014-05-21 08:19:29","84","2014-05-21 16:27:18","","","","");
INSERT INTO complaint VALUES("2253","Maintenance-0001555","\"C\" room cupboards doors to be fixed properly","urgent ","9","","37","1","65","349","2","9","3","7","","","","84","2014-05-21 08:20:09","84","2014-05-24 11:57:35","","","","");
INSERT INTO complaint VALUES("2254","Maintenance-0001556","\"G-2\" room Bed light to be changed ","urgent ","5","","25","1","65","351","2","5","3","7","","","","84","2014-05-21 08:20:53","84","2014-06-16 08:31:16","","","","");
INSERT INTO complaint VALUES("2255","Maintenance-0001557","Utility room sink is blocked ","As soon as possible ","6","","31","1","65","354","2","6","3","7","","","","84","2014-05-21 08:21:30","84","2014-05-21 16:29:10","","","","");
INSERT INTO complaint VALUES("2256","Maintenance-0001558","There is water seepage in the CCU lobby  and corridor of CCU.","Please do rectify it at the earliest.","6","","31","1","52","","2","6","3","5","","","","128","2014-05-21 08:22:02","227","2014-06-11 08:09:46","","","","");
INSERT INTO complaint VALUES("2257","Maintenance-0001559","recovery telephone is not working ","do it soon","8","","34","1","58","","2","8","3","5","","","","124","2014-05-21 08:26:28","34","2014-05-22 09:35:34","","","","");
INSERT INTO complaint VALUES("2258","MIS-0000699","The files are not opening","urgent","3","","112","1","60","","1","3","3","5","","","","103","2014-05-21 08:47:22","112","2014-05-21 09:21:46","","","","");
INSERT INTO complaint VALUES("2259","Maintenance-0001560","\"F-4\" Patient trolley bed screw to be fixed ","very urgent ","7","","29","1","65","353","2","7","3","7","","","","84","2014-05-21 08:53:06","84","2014-05-21 16:29:52","","","","");
INSERT INTO complaint VALUES("2260","MIS-0000700","n computing is not working.","server conection is not happening","2","","112","1","42","","1","2","3","5","","0","","368","2014-05-21 08:59:18","112","2014-05-21 09:43:42","","","","");
INSERT INTO complaint VALUES("2261","Maintenance-0001561","\"F-2\" Patient trolley bed side rails is loose to be checked ","as soon as possible ","7","","29","1","65","353","2","7","3","7","","","","84","2014-05-21 09:18:00","84","2014-05-21 16:30:35","","","","");
INSERT INTO complaint VALUES("2262","Maintenance-0001562","in deluxe 3204, unable to operate the tv","kindly rectify","8","","34","1","50","","2","8","3","5","","","","126","2014-05-21 09:23:02","34","2014-05-22 09:35:00","","","","");
INSERT INTO complaint VALUES("2263","MIS-0000701","Print from the drum is repeating over the forth coming lines. ","Cartridge replaced - complaint persisting.  ","2","","112","1","94","37","1","2","3","7","","0","","259","2014-05-21 09:33:57","259","2014-06-06 12:35:13","","","","");
INSERT INTO complaint VALUES("2264","MIS-0000702","New system ","To be fixed","3","","5","3","81","","1","3","3","5","11","","need information","98","2014-05-21 09:35:39","5","2014-05-22 13:01:38","","","","");
INSERT INTO complaint VALUES("2265","MIS-0000703","system not working","system not working","2","","5","1","104","","1","2","3","5","","0","","395","2014-05-21 09:41:35","112","2014-05-21 10:24:48","","","","");
INSERT INTO complaint VALUES("2266","Maintenance-0001563","Chair repair work.","Wooden chair repair ","9","","37","1","99","","2","9","3","5","2","","out source work","350","2014-05-21 09:49:42","227","2014-06-05 12:53:24","","","","");
INSERT INTO complaint VALUES("2267","MIS-0000704","PRINTER IS NOT CONNECTED TO THE SYSTEM","AFTER RECTIFYING THE SYSTEM","2","","5","1","104","","1","2","3","5","","0","","70","2014-05-21 09:58:10","112","2014-05-21 10:25:06","","","","");
INSERT INTO complaint VALUES("2268","MIS-0000705","system not working ","system not working ","3","","5","1","74","","1","3","3","5","","","","214","2014-05-21 10:01:33","112","2014-05-21 10:27:36","","","","");
INSERT INTO complaint VALUES("2269","Maintenance-0001564","1. bulb is not working at the cold storage room and alarm buzzer not working.","1. bulb is not working at the cold storage room and alarm buzzer not working.","7","","26","1","38","220","2","7","3","3","9","","Prossel engineering to be done","78","2014-05-21 10:09:41","227","2014-05-21 10:21:07","","","","");
INSERT INTO complaint VALUES("2270","Maintenance-0001565","1. II floor - 2 geysers are not working
INSERT INTO complaint VALUES("2271","MIS-0000706","system is hanging","system is hanging","3","","6","1","16","19","1","3","3","7","","","","132","2014-05-21 10:10:55","132","2014-05-23 10:04:17","","","","");
INSERT INTO complaint VALUES("2272","Maintenance-0001566","phone","not working","8","","33","1","81","","2","8","3","5","","","","98","2014-05-21 10:12:45","33","2014-05-22 09:36:41","","","","");
INSERT INTO complaint VALUES("2273","Maintenance-0001567","oxygen cylinder","empty","7","","28","1","99","","2","7","3","5","","","","98","2014-05-21 10:14:42","28","2014-05-21 11:53:18","","","","");
INSERT INTO complaint VALUES("2274","Maintenance-0001568","PC WARD varanda wall mounted cupboard doors not able to close .","please rectify immediately","9","","37","1","49","242","2","9","3","5","","","","97","2014-05-21 10:29:13","37","2014-05-22 09:40:52","","","","");
INSERT INTO complaint VALUES("2275","Maintenance-0001569","Washing area water is leaking ","Urgent","6","","31","1","56","91","2","6","3","3","2","","Major work","191","2014-05-21 10:29:28","31","2014-05-21 13:08:20","","","","");
INSERT INTO complaint VALUES("2276","Maintenance-0001570"," Ladies hostel  , IP Billing & MRD Camera\'s not working. ","Camera\'s not working.","8","","33","1","99","","2","8","3","5","","","","350","2014-05-21 10:29:53","33","2014-05-22 09:37:39","","","","");
INSERT INTO complaint VALUES("2277","Maintenance-0001571","in deluxe room 3221 bathroom door handle lock is not working (unable to lock )  ","kindly do the needful  for patient satisfactory. ","9","","37","1","50","","2","9","3","5","","","","126","2014-05-21 11:07:52","37","2014-05-22 09:41:18","","","","");
INSERT INTO complaint VALUES("2278","Maintenance-0001572","tube light not working,please replace.","urgent requirement (doctors consultation is going on).","5","","25","1","51","260","2","5","3","7","","","","314","2014-05-21 11:08:45","314","2014-05-26 08:50:05","","","","");
INSERT INTO complaint VALUES("2279","Maintenance-0001573","in deluxe room 3208 ac is not working ","kindly rectify","10","","26","1","50","","2","10","3","5","","","","126","2014-05-21 11:08:48","26","2014-05-23 15:11:00","","","","");
INSERT INTO complaint VALUES("2280","Maintenance-0001574","in deluxe room 3221 door hoke to fix , as it is removed from door  ","kindly do the needful","9","","37","1","50","","2","9","3","5","","","","126","2014-05-21 11:11:02","37","2014-05-22 09:41:33","","","","");
INSERT INTO complaint VALUES("2281","MIS-0000707","pl tell me the status of MRD supervisor system","pl tell me the status of MRD supervisor system","3","","9","1","16","19","1","3","3","7","5","","Hard disk got damaged and payment is required for the data recovery(this work can be done by third party). The charges will be depend on the size of the data. Backup of Accpac data is available, Is there any other critical data to be recovered from this disk? If  the back up is availble in any other system/external device will be helpful without spending money.","132","2014-05-21 11:33:53","132","2014-06-09 10:40:49","","","","");
INSERT INTO complaint VALUES("2282","Maintenance-0001575","There are leaks at different points at central OPD during rain.","Need to fix it before monsoon starts","12","","386","1","89","","2","12","3","5","","","","88","2014-05-21 11:36:17","227","2014-06-21 11:33:44","","","","");
INSERT INTO complaint VALUES("2283","Maintenance-0001576","GEEZER IS NOT WORKING IN  SLUICE ROOM  ( WATER IS NOT GETTING HOT )","DO AS PER AS POSSIBLE ","6","","30","1","58","197","2","6","3","5","","","","124","2014-05-21 11:50:37","30","2014-05-23 12:17:58","","","","");
INSERT INTO complaint VALUES("2284","Maintenance-0001577","Commode broken. ","Urgent","6","","30","1","47","111","2","6","3","5","","","","149","2014-05-21 11:56:34","30","2014-05-21 13:09:10","","","","");
INSERT INTO complaint VALUES("2285","Maintenance-0001578","NURSES STATION PA SYSTEM IS NOT WORKING","PLEASE RECTIFY SOON","8","","34","1","64","","2","8","3","5","","","","110","2014-05-21 12:23:24","34","2014-05-22 09:35:21","","","","");
INSERT INTO complaint VALUES("2286","MIS-0000708","WHEN WE TAKE PRINT OUT IS NOT CLEAR . please do the needful","WHEN WE TAKE PRINT OUT IS NOT CLEAR . please do the needful.
INSERT INTO complaint VALUES("2287","Maintenance-0001579","HIGH RISK LABOUR ROOM ENTERANCE DOOR MAKING SOUND","AS SOON AS POSSIBLE","9","","37","1","59","","2","9","3","5","","","","116","2014-05-21 13:28:02","37","2014-05-22 15:26:15","","","","");
INSERT INTO complaint VALUES("2288","MIS-0000709","BUS-04 Stand by VGA cable","high priority","2","","6","1","40","12","1","2","3","5","","0","","65","2014-05-21 14:06:14","6","2014-05-22 13:37:37","","","","");
INSERT INTO complaint VALUES("2289","Maintenance-0001580","flash is not working in gents toilet near IP billing.","urgent","6","","30","1","47","105","2","6","3","5","","","","149","2014-05-21 14:11:37","30","2014-05-23 12:18:30","","","","");
INSERT INTO complaint VALUES("2290","Maintenance-0001581","j-3 cot side rails to be repaired","make it fast","7","","27","1","60","284","2","7","3","5","","","","264","2014-05-21 14:16:01","27","2014-05-22 15:27:16","","","","");
INSERT INTO complaint VALUES("2291","Maintenance-0001582","gyene opd class room fan not working","very urgent","5","","24","1","73","104","2","5","3","5","","","","210","2014-05-21 14:34:56","24","2014-05-22 15:31:28","","","","");
INSERT INTO complaint VALUES("2292","Maintenance-0001583","Door lock to be repaired.","URGENT","9","","37","1","47","112","2","9","3","5","","","","149","2014-05-21 15:25:44","37","2014-05-22 15:25:54","","","","");
INSERT INTO complaint VALUES("2293","Maintenance-0001584","Door lock to be repaired","urgent.","9","","37","1","47","113","2","9","3","5","","","","149","2014-05-21 15:28:08","37","2014-05-22 15:24:48","","","","");
INSERT INTO complaint VALUES("2294","MIS-0000710","Outlook express is not opening in system #1 in CCU.","Can you please rectify it at the earliest.","3","","5","1","52","","1","3","3","7","","","","128","2014-05-21 15:50:50","128","2014-05-22 09:51:28","","","","");
INSERT INTO complaint VALUES("2295","MIS-0000711","please add x-ray training, OT training, MRD training, Lab training in sage accpac under ( user name: cornelia )","please add x-ray training, OT training, MRD training, Lab training in sage accpac under ( user name: cornelia )","3","","6","1","25","","1","3","3","7","","","","152","2014-05-21 16:10:10","152","2014-06-06 08:36:17","","","","");
INSERT INTO complaint VALUES("2296","Maintenance-0001585","3221 CALL BELL IS BROKEN","3221 CALL BELL IS BROKEN","8","","33","1","50","88","2","8","3","5","","","","177","2014-05-21 16:40:04","33","2014-05-23 16:04:09","","","","");
INSERT INTO complaint VALUES("2297","Maintenance-0001586","3201 TV IS NOT WORKING","3201 TV IS NOT WORKING","8","","33","1","50","70","2","8","3","5","","","","177","2014-05-21 16:41:16","33","2014-05-23 16:03:57","","","","");
INSERT INTO complaint VALUES("2298","Maintenance-0001587","drainage block in rest room in cash counter 4","drainage block in rest room in cash counter 4","6","","30","1","44","","2","6","3","5","","","","378","2014-05-22 07:36:30","30","2014-05-23 15:51:35","","","","");
INSERT INTO complaint VALUES("2299","Maintenance-0001588","flash is not working in PC opd ladies toilet make it done.","urgent.","6","","30","1","47","111","2","6","3","5","","","","149","2014-05-22 08:08:10","30","2014-05-23 15:51:25","","","","");
INSERT INTO complaint VALUES("2300","Maintenance-0001589","NTS and IP Billing camera not working.","NTS and IP Billing cameras not working.","8","","33","1","99","","2","8","3","5","","","","350","2014-05-22 08:34:19","33","2014-05-23 16:03:42","","","","");
INSERT INTO complaint VALUES("2301","Maintenance-0001590","OBG Office - Door lock has been broken.
INSERT INTO complaint VALUES("2302","Maintenance-0001591","To change seat cloths of chairs as they very badly stained","high priority","7","","29","1","40","64","2","7","3","2","","","","313","2014-05-22 09:17:14","227","2014-05-22 09:28:50","","","","");
INSERT INTO complaint VALUES("2303","MIS-0000712","computer in peadiatric opd not getting on.in P-4","URGENTLY DO THE NEEDFUL.","2","","112","1","79","","1","2","3","5","","0","","216","2014-05-22 09:45:15","112","2014-05-22 10:06:16","","","","");
INSERT INTO complaint VALUES("2304","Maintenance-0001592","CCU trolleys both are not functioning well. Please look into it at the earliest as we need them for shifting patients.","The wheels of the trolleys are not flexible to push. ","7","","29","1","52","","2","7","3","7","","","","128","2014-05-22 09:49:15","128","2014-05-28 07:55:40","","","","");
INSERT INTO complaint VALUES("2305","Maintenance-0001593","IN DELUXE RMU DOOR BANGS VERY FAST ","KINDLY DO THE NEEDFUL","9","","37","1","50","","2","9","3","5","","","","126","2014-05-22 09:53:01","37","2014-05-22 15:25:15","","","","");
INSERT INTO complaint VALUES("2306","Maintenance-0001594","Trolley is not moving properly","Urgent","7","","29","1","58","190","2","7","3","5","","","","121","2014-05-22 09:54:32","227","2014-05-22 09:58:54","","","","");
INSERT INTO complaint VALUES("2307","Maintenance-0001595","pc opd patient waiting area three seating chair bottom holder are not proper, resting back is moving and loose ","please rectify immediately","7","","28","1","102","","2","7","3","5","8","","Technician cannot be repair at user place hence please send chairs to maintenance","97","2014-05-22 10:00:14","227","2014-06-10 12:41:05","","","","");
INSERT INTO complaint VALUES("2308","Maintenance-0001596","WALL FIXED FAN NOT WORKING","VERY URGENT","5","","24","1","73","104","2","5","3","5","","","","210","2014-05-22 10:13:42","24","2014-05-22 15:28:14","","","","");
INSERT INTO complaint VALUES("2309","Maintenance-0001597","Room No.M-5 mike is not  working "," urgent","8","","33","1","71","","2","8","3","5","","","","72","2014-05-22 10:54:21","33","2014-05-23 16:03:27","","","","");
INSERT INTO complaint VALUES("2310","Maintenance-0001598","Autoclave is not working and water leaking.","urgent please","7","","28","1","57","65","2","7","3","5","","","","362","2014-05-22 11:11:41","28","2014-06-07 13:11:08","","","","");
INSERT INTO complaint VALUES("2311","MIS-0000713","PRINTER IS NOT WORKING","PLEASE SEND FAST","3","","5","1","64","21","1","3","3","5","","","","110","2014-05-22 11:28:53","5","2014-05-22 12:16:34","","","","");
INSERT INTO complaint VALUES("2312","MIS-0000714","in deluxe ward system -01 mouse in unable to operate.","kindly do the needful.","2","","5","1","50","","1","2","3","5","","0","","126","2014-05-22 11:50:06","5","2014-05-22 12:16:23","","","","");
INSERT INTO complaint VALUES("2313","Maintenance-0001599","nurses station wood slap screw to be fix.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-05-22 11:55:44","87","2014-05-24 11:34:02","","","","");
INSERT INTO complaint VALUES("2314","Maintenance-0001600","in deluxe  room 3202 call bell is not working ","kindly do the needful .","8","","33","1","50","","2","8","3","5","","","","126","2014-05-22 11:57:01","33","2014-05-23 16:03:06","","","","");
INSERT INTO complaint VALUES("2315","MIS-0000715","crp-02 Internet is not working hence not able process for insurance approval","high priority","2","","112","1","40","11","1","2","3","5","","0","","313","2014-05-22 11:57:54","112","2014-05-22 12:14:27","","","","");
INSERT INTO complaint VALUES("2316","Maintenance-0001601","Rooms H, E,C, bath room hand wash sink water leakages to be check and nurses station-1,2  hand wash sink water leakages to be check.","as soon as possible.","6","","32","1","63","","2","6","3","7","","","","87","2014-05-22 12:00:38","87","2014-06-12 12:19:21","","","","");
INSERT INTO complaint VALUES("2317","MIS-0000716","system not working","please rectify immediately","2","","112","1","49","","1","2","3","5","","0","","97","2014-05-22 12:06:59","112","2014-05-22 12:11:33","","","","");
INSERT INTO complaint VALUES("2318","Maintenance-0001602","1. Gym -Cycle is not working
INSERT INTO complaint VALUES("2319","MIS-0000717","Install easi hrms  to computer name : bbh-lab 14","As soon as possible.","3","","6","1","17","30","1","3","3","5","","","","257","2014-05-22 13:05:31","6","2014-05-22 14:54:20","","","","");
INSERT INTO complaint VALUES("2320","MIS-0000718","Barcode is not working properly. ","Urgent","2","","5","1","17","34","1","2","3","5","","0","","257","2014-05-22 13:07:12","5","2014-05-22 14:40:45","","","","");
INSERT INTO complaint VALUES("2321","MIS-0000719","BBH connect is not updated properly. 
INSERT INTO complaint VALUES("2322","Maintenance-0001603","Toilet flush is not working  in Nursing changing room.","Urgent.","6","","32","1","17","148","2","6","3","5","","","","257","2014-05-22 13:10:33","32","2014-05-23 12:20:32","","","","");
INSERT INTO complaint VALUES("2323","Maintenance-0001604","Wall fan is not rotating.","As soon as possible","5","","23","1","17","147","2","5","3","5","6","","Oscillation problem","257","2014-05-22 13:12:02","23","2014-06-12 10:23:21","","","","");
INSERT INTO complaint VALUES("2324","Maintenance-0001605","PA system not audible when they announced  for staff retreat","please come immediately","8","","33","1","49","242","2","8","3","5","","","","97","2014-05-22 13:19:53","33","2014-05-28 17:04:07","","","","");
INSERT INTO complaint VALUES("2325","Maintenance-0001606","Tube light to be changed.","urgent","5","","25","1","47","119","2","5","3","5","","","","149","2014-05-22 13:51:20","25","2014-05-22 15:32:43","","","","");
INSERT INTO complaint VALUES("2326","Maintenance-0001607","Door to be repaired","urgent","9","","37","1","47","116","2","9","3","5","","","","149","2014-05-22 13:51:55","37","2014-05-22 15:24:26","","","","");
INSERT INTO complaint VALUES("2327","MIS-0000720","Key board not working","key board not working from afternoon","2","","5","1","31","","1","2","3","5","","0","","262","2014-05-22 14:54:18","5","2014-05-22 15:05:19","","","","");
INSERT INTO complaint VALUES("2328","MIS-0000721","The computer has to be connected to UPS.","Very urgent.","2","","112","1","68","","1","2","3","5","","0","","392","2014-05-22 15:15:43","112","2014-05-22 16:11:47","","","","");
INSERT INTO complaint VALUES("2329","Maintenance-0001608","pc opd wheel chair to be repaired","please repair immedeatly","7","","29","1","102","","2","7","3","5","","","","246","2014-05-22 16:04:56","29","2014-05-23 16:01:02","","","","");
INSERT INTO complaint VALUES("2330","MIS-0000722","ICU SYSTEM 1 MOUSE NOT WORKING","ICU SYSTEM 1 MOUSE NOT WORKING","2","","112","1","53","","1","2","3","5","","0","","119","2014-05-22 16:16:12","112","2014-05-22 16:25:27","","","","");
INSERT INTO complaint VALUES("2331","Maintenance-0001609","water pipe line is blocked no water is coming in gents toilet near IP billing so make it done as soon as possible.","urgent","6","","30","1","47","105","2","6","3","5","","","","149","2014-05-22 16:29:22","30","2014-05-23 15:50:56","","","","");
INSERT INTO complaint VALUES("2332","MIS-0000723","NURSING STATION-2 COMPUTER IS NOT WORKING","PLEASE RECTIFY SOON","2","","112","1","64","21","1","2","3","5","6","0","Checking","110","2014-05-23 08:26:38","112","2014-05-26 08:36:22","","","","");
INSERT INTO complaint VALUES("2333","Maintenance-0001610","LOCK TO BE OPENED","EMERGENCY PLEASE RECTIFY SOON","9","","37","1","64","339","2","9","3","5","","","","110","2014-05-23 08:27:58","37","2014-05-23 15:54:31","","","","");
INSERT INTO complaint VALUES("2334","Maintenance-0001611","AC is leaking in scan room 1","AC is leaking in scan room 1","10","","26","1","104","","2","10","3","5","","","","70","2014-05-23 08:34:47","26","2014-05-24 12:38:18","","","","");
INSERT INTO complaint VALUES("2335","MIS-0000724","The Computer has to be connected to the UPS.","Very Urgent.","3","","5","1","68","","1","3","3","5","","","","392","2014-05-23 08:40:19","5","2014-05-23 10:35:53","","","","");
INSERT INTO complaint VALUES("2336","Maintenance-0001612","room no 1515 bathroom flush not working","please come immediately","6","","30","1","49","235","2","6","3","5","","","","97","2014-05-23 08:50:16","30","2014-05-23 15:50:40","","","","");
INSERT INTO complaint VALUES("2337","Maintenance-0001613","wheel chair belt to be fix.","as soon as possible.","7","","29","1","63","","2","7","3","7","","","","87","2014-05-23 08:50:51","87","2014-05-24 11:33:44","","","","");
INSERT INTO complaint VALUES("2338","Maintenance-0001614","emergency crash cot trolley fiber box  runnier to be check. ","as soon as possible.","9","","37","1","63","","2","9","3","2","","","","87","2014-05-23 08:57:52","227","2014-06-13 11:04:26","","","","");
INSERT INTO complaint VALUES("2339","Maintenance-0001615","toilet door knob is broken.","knob to be removed and plastered","9","","37","1","112","","2","9","3","5","","","","217","2014-05-23 09:06:33","37","2014-05-23 15:54:11","","","","");
INSERT INTO complaint VALUES("2340","Maintenance-0001616","endoscopy recovery room door is very tight ,cant be moved properly.","to be repaired ","9","","37","1","112","","2","9","3","5","","","","217","2014-05-23 09:08:01","37","2014-05-23 15:53:43","","","","");
INSERT INTO complaint VALUES("2341","Maintenance-0001617","GHOOSE NECK SCREW TO BE FIXED","AS SOON AS POSSIBLE","7","","29","1","59","","2","7","3","5","","","","116","2014-05-23 09:13:35","29","2014-05-23 16:00:18","","","","");
INSERT INTO complaint VALUES("2342","Maintenance-0001618","Autoclave is not working water leaking from the pipe connection.                                                    
INSERT INTO complaint VALUES("2343","MIS-0000725","In accpac if we double click on F2 to type FNAC Report.","It is not showing anything is showing Blank.","3","","6","1","17","32","1","3","3","7","5","","","113","2014-05-23 09:42:47","113","2014-05-27 17:20:33","","","","");
INSERT INTO complaint VALUES("2344","MIS-0000726","In accpac if we double click on F2 to type FNAC Report.","It is not showing anything is showing only blank.","3","","6","1","17","32","1","3","3","7","","","","113","2014-05-23 10:01:24","113","2014-05-27 17:20:20","","","","");
INSERT INTO complaint VALUES("2345","MIS-0000727","system mrd 10 is not working","system mrd 10 is not working","2","","112","1","16","19","1","2","3","7","","0","","132","2014-05-23 10:05:34","132","2014-05-23 15:17:25","","","","");
INSERT INTO complaint VALUES("2346","MIS-0000728","ccu printer is not working properly","please rectify  at the earliest.","2","","112","1","52","","1","2","3","5","","886","","160","2014-05-23 10:16:20","112","2014-05-23 10:32:56","","","","");
INSERT INTO complaint VALUES("2347","MIS-0000729","Outlook express not working","Outlook express not working","3","","5","1","2","","1","3","3","5","","","","17","2014-05-23 10:21:25","5","2014-05-23 10:33:55","","","","");
INSERT INTO complaint VALUES("2348","MIS-0000730","In accpac if we double click on F2 to type FNAC Report. Patient Name:Sahiba Malik. MRD No: AA259269.","It is not showing anything to type is showing Blank when we click F2. Show please check waiting to type.","3","","6","1","17","32","1","3","3","7","","","","113","2014-05-23 10:28:35","113","2014-05-27 17:20:09","","","","");
INSERT INTO complaint VALUES("2349","Maintenance-0001619","We required one UPS point for computer","very urgent.","5","","23","1","68","","2","5","3","5","6","","Its new requirement hence","392","2014-05-23 10:31:35","23","2014-06-09 09:03:36","","","","");
INSERT INTO complaint VALUES("2350","Maintenance-0001620","Tap leakage","Tap leakage and exhaust fan cleaning","11","","21","1","45","","2","11","3","5","","","","92","2014-05-23 10:39:26","21","2014-05-23 16:26:05","","","","");
INSERT INTO complaint VALUES("2351","MIS-0000731","printer not working -ip billing","printer not working -ip billing","2","","112","1","42","","1","2","3","5","","0","","118","2014-05-23 10:51:15","112","2014-05-23 11:05:03","","","","");
INSERT INTO complaint VALUES("2352","MIS-0000732","Dear Sir,
INSERT INTO complaint VALUES("2353","MIS-0000733","In accpac if we double click on F2 to type FNAC Report. Patient Name:Sahiba Malik. MRD No: AA259269.","Is not opening anything. Its showing Blank. Waiting for that only to type.","3","","6","1","17","32","1","3","3","7","","","","113","2014-05-23 11:12:12","113","2014-05-27 17:19:44","","","","");
INSERT INTO complaint VALUES("2354","Maintenance-0001621","SPLINTS NEEDED FOR NICU","URGENT","9","","37","1","55","","2","9","3","5","","","","73","2014-05-23 11:35:17","37","2014-05-24 13:08:21","","","","");
INSERT INTO complaint VALUES("2355","Maintenance-0001622","6 Taps are having leakage with the water, the washer are gone. so please replaces the washer with the tap. It is in main kitchen.","very urgent.","6","","30","1","68","93","2","6","3","5","","","","392","2014-05-23 11:36:58","30","2014-05-23 12:16:57","","","","");
INSERT INTO complaint VALUES("2356","Maintenance-0001623","AC is not working","please do the needful help","10","","26","1","50","83","2","10","3","7","","","","181","2014-05-23 11:45:36","181","2014-05-30 08:04:56","","","","");
INSERT INTO complaint VALUES("2357","Maintenance-0001624","Tv is not working","please do the needful","8","","33","1","50","83","2","8","3","7","","","","181","2014-05-23 11:46:43","181","2014-05-30 08:05:27","","","","");
INSERT INTO complaint VALUES("2358","Maintenance-0001625","room no 1505 male rest room door lock not able to lock properly","please rectify ASAP.","9","","37","1","49","226","2","9","3","5","","","","97","2014-05-23 11:48:35","37","2014-05-24 13:08:09","","","","");
INSERT INTO complaint VALUES("2359","Maintenance-0001626","exacter fan making noise","exacter fan making noise","5","","24","1","16","172","2","5","3","3","9","","Outsource to be done ","132","2014-05-23 11:51:54","24","2014-06-17 10:09:52","","","","");
INSERT INTO complaint VALUES("2360","Maintenance-0001627","WATER LEAKING FROM AC","WATER LEAKING FROM AC","10","","26","1","18","215","2","10","3","7","","","","64","2014-05-23 12:04:50","64","2014-05-29 08:45:08","","","","");
INSERT INTO complaint VALUES("2361","MIS-0000734","CRP-03 unable to send mail with attachment, have zipped the attachment but still unable to send.","High priority","3","","5","1","40","12","1","3","3","7","","","","65","2014-05-23 12:14:45","65","2014-05-29 10:17:39","","","","");
INSERT INTO complaint VALUES("2362","Maintenance-0001628","To Be rectified the New FAN installed","Fan making noise as well shaking too much while rotating","5","","24","1","28","","2","5","3","7","","","","117","2014-05-23 12:14:49","117","2014-05-24 07:48:42","","","","");
INSERT INTO complaint VALUES("2363","Maintenance-0001629","Ghooser neck lamp screw to be fixed","as soon as possible","5","","24","1","59","154","2","5","3","5","","","","277","2014-05-23 12:28:29","24","2014-05-23 15:31:43","","","","");
INSERT INTO complaint VALUES("2364","Maintenance-0001630","Machine not working.","URGENT.","7","","29","1","115","360","2","7","3","5","","","","149","2014-05-23 12:36:24","29","2014-05-23 15:59:54","","","","");
INSERT INTO complaint VALUES("2365","MIS-0000735","Please update New EDOS in Medical opd and in pead opd.","As soon as possible.","3","","8","1","17","","1","3","3","4","6","","Please give EOD CD... for installing...","257","2014-05-23 12:43:58","8","2014-05-26 10:07:03","","","","");
INSERT INTO complaint VALUES("2366","Maintenance-0001631","Trolley to be repaired 4 nos.","Trolley to be repaired greasing&minor welding work. ","7","","29","1","84","","2","7","3","5","","","","351","2014-05-23 12:44:06","29","2014-05-23 15:59:03","","","","");
INSERT INTO complaint VALUES("2367","MIS-0000736","new system","outlook express needed in system","3","","5","1","81","","1","3","3","5","","","","98","2014-05-23 12:45:31","5","2014-05-23 14:53:14","","","","");
INSERT INTO complaint VALUES("2368","Maintenance-0001632","CUPBOARD LOCK  U/S","NEW LOCK TO BE FIXED","9","","37","1","37","132","2","9","3","5","","","","150","2014-05-23 14:15:48","37","2014-05-23 15:53:08","","","","");
INSERT INTO complaint VALUES("2369","Maintenance-0001633","lock not closing properly","not urgent","9","","37","1","72","275","2","9","3","5","","","","219","2014-05-23 14:26:44","37","2014-05-23 15:52:48","","","","");
INSERT INTO complaint VALUES("2370","MIS-0000737","COMPUTER RIBBON TO BE INSERTED IN TVS PRINTER (BILLING)","COMPUTER RIBBON TO BE INSERTED IN TVS PRINTER (BILLING)","2","","112","1","104","","1","2","3","5","","0","","395","2014-05-23 14:40:59","112","2014-05-23 14:51:01","","","","");
INSERT INTO complaint VALUES("2371","MIS-0000738","Authority to indent microbiology stock.","Urgent.","3","","6","1","17","28","1","3","3","5","","","","257","2014-05-23 14:54:43","6","2014-05-24 08:33:55","","","","");
INSERT INTO complaint VALUES("2372","MIS-0000739","install the new system in 5th counter","install the new system in 5th counter","2","","112","1","16","19","1","2","3","7","","0","","132","2014-05-23 15:17:00","132","2014-06-09 10:40:13","","","","");
INSERT INTO complaint VALUES("2373","Maintenance-0001634","Student hostel tube light not working","attendsoon","5","","22","2","2","","2","5","3","7","","","","225","2014-05-23 15:20:03","225","2014-05-26 11:45:22","","","","");
INSERT INTO complaint VALUES("2374","MIS-0000740","My  zimbra account is opening but not able to send or receive mails.","Thank you for the quick action taken","3","","5","1","46","","1","3","3","5","","","","258","2014-05-23 15:22:03","5","2014-05-23 15:44:52","","","","");
INSERT INTO complaint VALUES("2375","MIS-0000741","Sal-02 system needs to be link to printer hp1020crp","VERY URGENT","3","","5","1","39","","1","3","3","5","","","","349","2014-05-23 15:26:29","5","2014-05-23 15:33:31","","","","");
INSERT INTO complaint VALUES("2376","Maintenance-0001635","Street light not working near main gate ","Street light not working near main gate ","5","","24","1","2","","2","5","3","5","","","","24","2014-05-23 15:40:41","24","2014-05-23 15:41:00","","","","");
INSERT INTO complaint VALUES("2377","Maintenance-0001636","Qtrs C-4 No power supply","Qtrs C-4 No power supply","5","","24","3","2","","2","5","3","5","","","","24","2014-05-23 15:41:32","24","2014-05-23 15:41:50","","","","");
INSERT INTO complaint VALUES("2378","Maintenance-0001637","Toilet light is not working.","urgent","5","","24","1","60","278","2","5","3","5","","","","107","2014-05-23 15:45:55","24","2014-05-24 09:04:14","","","","");
INSERT INTO complaint VALUES("2379","Maintenance-0001638","Fan is not working.","urgent","5","","24","1","62","316","2","5","3","5","","","","107","2014-05-23 15:57:14","24","2014-05-24 12:30:26","","","","");
INSERT INTO complaint VALUES("2380","MIS-0000742","pls  design HIC Logo badge","4 design logo","3","","8","5","46","","1","3","3","5","","","","94","2014-05-23 16:03:19","8","2014-05-23 16:04:21","","","","");
INSERT INTO complaint VALUES("2381","Maintenance-0001639","CARDIAC TABLE WHEEL TO BE FIXED","PLEASE RECTIFY SOON","7","","27","1","64","24","2","7","3","5","","","","110","2014-05-23 16:21:36","27","2014-05-24 08:47:57","","","","");
INSERT INTO complaint VALUES("2382","Maintenance-0001640","The Fluorescent microscope in PCR room need to be given UPS backup, which is now running in raw power.","Please do it ASAP","5","","24","1","17","137","2","5","3","3","6","","Its new requirement hence it will be delayed ","302","2014-05-23 17:17:09","24","2014-05-24 12:30:14","","","","");
INSERT INTO complaint VALUES("2383","MIS-0000743","TO INSTALL PRINTER FOR COUNTER 5","TO INSTALL PRINTER FOR COUNTER 5","2","","5","1","16","19","1","2","3","7","","0","","132","2014-05-23 17:35:48","132","2014-06-09 10:40:01","","","","");
INSERT INTO complaint VALUES("2384","Maintenance-0001641","HDFC machine telephone line not working. please consider this on priority.","HDFC telephone line not working.","8","","34","1","18","216","2","8","3","7","","","","64","2014-05-24 07:40:27","64","2014-05-29 08:44:05","","","","");
INSERT INTO complaint VALUES("2385","Maintenance-0001642","Reminder  -autoclave is not working water leaking from the pipe connection, and washing area tap to be changed.","urgent please.","6","","30","1","57","65","2","6","3","5","","","","362","2014-05-24 07:57:15","30","2014-06-02 10:52:12","","","","");
INSERT INTO complaint VALUES("2386","Maintenance-0001643","sink pipe is blocked near casualty opposite to gents toilet.","urgent","6","","30","1","47","119","2","6","3","5","","","","149","2014-05-24 08:08:56","30","2014-05-24 12:55:17","","","","");
INSERT INTO complaint VALUES("2387","Maintenance-0001644","toilet is blocked in gents toilet near casulty ","urgent","6","","30","1","47","119","2","6","3","5","","","","149","2014-05-24 08:12:52","227","2014-05-24 08:17:38","","","","");
INSERT INTO complaint VALUES("2388","MIS-0000744","printer is not working","need urgent att","2","","112","1","16","35","1","2","3","7","","0","","132","2014-05-24 08:21:46","132","2014-06-09 10:39:43","","","","");
INSERT INTO complaint VALUES("2389","MIS-0000745","IP BILLING- PRINTER NOT WORKING","IP BILLING- PRINTER NOT WORKING","2","","112","1","42","","1","2","3","5","","0","","118","2014-05-24 08:37:01","112","2014-05-24 08:51:16","","","","");
INSERT INTO complaint VALUES("2390","Maintenance-0001645","Birthing room A  switch board to be fixed","as  soon as possible","5","","24","1","59","","2","5","3","5","","","","116","2014-05-24 08:54:14","24","2014-05-24 12:29:45","","","","");
INSERT INTO complaint VALUES("2391","MIS-0000746","Pediatric  0.P.D.computer in room no 5 not working.","kindly do the needful","3","","112","1","79","","1","3","3","5","","","","216","2014-05-24 08:57:20","112","2014-05-24 10:36:20","","","","");
INSERT INTO complaint VALUES("2392","Maintenance-0001646","w- 2 cared-or tube light is not working.","urgent.","5","","25","1","61","","2","5","3","5","","","","107","2014-05-24 09:07:23","23","2014-05-24 12:28:28","","","","");
INSERT INTO complaint VALUES("2393","MIS-0000747","printer not working","need urgent att","2","","112","1","16","19","1","2","3","7","","0","","132","2014-05-24 09:08:54","132","2014-06-09 10:39:33","","","","");
INSERT INTO complaint VALUES("2394","Maintenance-0001647","f- 2 bed side locker wooden board  to be fixed.","urgent.","9","","37","1","61","297","2","9","3","5","","","","107","2014-05-24 09:09:03","37","2014-05-24 13:07:59","","","","");
INSERT INTO complaint VALUES("2395","MIS-0000748","NURSING STATION-2 MY COMPUTER IS NOT OPENING IT IS SHOWING ERROR, DOCTOR WANTS TO TYPE DISCHARGE SUMMARY","PLEASE RECTIFY SOON","3","","112","1","64","21","1","3","3","5","","","","110","2014-05-24 09:10:11","112","2014-05-24 09:19:17","","","","");
INSERT INTO complaint VALUES("2396","Maintenance-0001648","SINK IS BLOCKED","PLEASE RECTIFY SOON","6","","30","1","64","338","2","6","3","5","","","","110","2014-05-24 09:10:45","30","2014-05-24 12:53:36","","","","");
INSERT INTO complaint VALUES("2397","MIS-0000749","Key board not working","we have raised a non stock for new keyboard, kindly give us a spare keyboard. till we get a new one.","2","","5","1","31","","1","2","3","5","11","0","checking","262","2014-05-24 09:14:48","5","2014-05-26 11:37:17","","","","");
INSERT INTO complaint VALUES("2398","Maintenance-0001649","AQUAGUARD TO BE REPAIRED","PLEASE RECTIFY SOON","6","","30","1","64","344","2","6","3","5","","","","110","2014-05-24 09:21:35","30","2014-05-28 17:03:24","","","","");
INSERT INTO complaint VALUES("2399","Maintenance-0001650","room no 1508 bathroom light not working","please rectify immediately","5","","24","1","49","229","2","5","3","5","","","","97","2014-05-24 09:33:21","24","2014-05-24 12:29:21","","","","");
INSERT INTO complaint VALUES("2400","Maintenance-0001651","Cupboard to be repaired.","urgent","9","","37","1","115","360","2","9","3","5","","","","149","2014-05-24 09:33:54","37","2014-05-24 13:07:49","","","","");
INSERT INTO complaint VALUES("2401","Maintenance-0001652","ped. opd room no. 5 computer wire to be fixed.","kindly do the needful.","5","","24","1","79","","2","5","3","5","","","","216","2014-05-24 09:35:20","24","2014-05-24 12:29:35","","","","");
INSERT INTO complaint VALUES("2402","Maintenance-0001653","High risk labour room door handle to be fixed","as soon as possible","9","","37","1","59","","2","9","3","5","","","","116","2014-05-24 10:32:09","37","2014-05-24 13:07:40","","","","");
INSERT INTO complaint VALUES("2403","Maintenance-0001654","Qtrs Dr Bhargav house geyser & shower to be repair ","Qtrs Dr Bhargav house geyser & shower to be repair ","6","","30","3","2","","2","6","3","3","1","","Geyser element no stock as per sample non stock to be raised ","227","2014-05-24 10:35:28","30","2014-06-12 12:22:29","","","","");
INSERT INTO complaint VALUES("2404","Maintenance-0001655","X-RAY VIEW BOX - 2 IS NOT WORKING","X-RAY VIEW BOX - 2 IS NOT WORKING","5","","24","1","53","","2","5","3","5","","","","119","2014-05-24 10:59:52","24","2014-05-24 12:29:10","","","","");
INSERT INTO complaint VALUES("2405","Maintenance-0001656","In Receptionist room cupboard  door has broken. ","cupboard door has to be fixed","9","","37","1","23","247","2","9","3","5","","","","80","2014-05-24 11:00:13","37","2014-05-24 13:07:32","","","","");
INSERT INTO complaint VALUES("2406","Maintenance-0001657","Water is leaking in the utility room and to check the sink also","urgent ","6","","32","1","65","354","2","6","3","7","","","","84","2014-05-24 11:22:24","84","2014-05-26 08:15:30","","","","");
INSERT INTO complaint VALUES("2407","Maintenance-0001658","O2 CYLINDER IS EMPTY","O2 CYLINDER IS EMPTY","7","","29","1","53","","2","7","3","5","","","","119","2014-05-24 11:29:42","29","2014-05-24 12:57:40","","","","");
INSERT INTO complaint VALUES("2408","Maintenance-0001659","CARDIAC TABLE   NOT  WORKING TO BE CHECK.","AS SOON AS POSSIBLE.","7","","29","1","63","","2","7","3","7","","","","87","2014-05-24 11:32:02","87","2014-06-19 10:25:52","","","","");
INSERT INTO complaint VALUES("2409","Maintenance-0001660","Room D-4,D-3,E-8, side rails not working to be check.","as soon as possible.","7","","29","1","63","","2","7","3","7","","","","87","2014-05-24 11:33:16","87","2014-06-19 10:26:17","","","","");
INSERT INTO complaint VALUES("2410","Maintenance-0001661","OT SCRUB AREA SNICK IS BLOCKED AND FEMALE TOILET SNICK  IS LEAKING ","URGENT ","6","","32","1","58","","2","6","3","5","","","","124","2014-05-24 12:28:33","32","2014-05-26 11:28:30","","","","");
INSERT INTO complaint VALUES("2411","Maintenance-0001662","AC TEMPERATURE READING MONITOR IS HUMIDITY IS SHOWING VERY HIGH PL Z COME AND RECTIFY  ","DO IT SOON","10","","26","1","58","","2","10","3","5","","","","124","2014-05-24 12:30:37","26","2014-05-26 16:07:42","","","","");
INSERT INTO complaint VALUES("2412","Maintenance-0001663","Water leaking in 2nd floor lab gents toilet","Urgent","6","","32","1","47","108","2","6","3","5","","","","149","2014-05-24 12:53:31","32","2014-05-26 11:28:00","","","","");
INSERT INTO complaint VALUES("2413","Maintenance-0001664","sink is blocked and water pipe is leaking do it soon.","even after sending a mail on saturday there is no action so please do it as soon as possible.","6","","32","1","47","108","2","6","3","5","","","","149","2014-05-26 08:01:18","32","2014-05-26 11:25:35","","","","");
INSERT INTO complaint VALUES("2414","Maintenance-0001665","Crack to be checked in the waiting area of  Wing-6","urgent ","12","","386","1","65","","2","12","3","2","","","","84","2014-05-26 08:17:12","227","2014-05-26 08:20:18","","","","");
INSERT INTO complaint VALUES("2415","Maintenance-0001666","Aqua guard water is not tasty to be checked ","urgent","6","","32","1","65","","2","6","3","7","","","","84","2014-05-26 08:22:55","84","2014-06-19 08:17:00","","","","");
INSERT INTO complaint VALUES("2416","Maintenance-0001667","Mortuary camera not working  from yesterday .","Mortuary camera not working .","8","","34","1","99","","2","8","3","5","","","","350","2014-05-26 08:40:13","34","2014-05-26 15:50:12","","","","");
INSERT INTO complaint VALUES("2417","Maintenance-0001668","high risk labour room switch board to be fixed","assoon as possible","5","","25","1","59","","2","5","3","5","","","","116","2014-05-26 08:47:58","25","2014-05-27 15:41:41","","","","");
INSERT INTO complaint VALUES("2418","Maintenance-0001669","fire extinguisher service is due,need your service at the earliest . ","fire extinguisher service is due,need your service at the earliest . ","11","","21","1","51","261","2","11","3","5","","","","314","2014-05-26 08:48:20","21","2014-06-12 12:13:46","","","","");
INSERT INTO complaint VALUES("2419","MIS-0000750","Dear Sir,
INSERT INTO complaint VALUES("2420","Maintenance-0001670","Rest room fluser is broken","urgent","6","","32","1","60","277","2","6","3","5","","","","103","2014-05-26 08:58:17","32","2014-05-26 11:24:43","","","","");
INSERT INTO complaint VALUES("2421","Maintenance-0001671","patient cup board is broken","urgent","9","","37","1","60","279","2","9","3","5","","","","103","2014-05-26 08:59:24","37","2014-05-26 11:43:08","","","","");
INSERT INTO complaint VALUES("2422","Maintenance-0001672","babay credle wheel is broken","urgent","7","","29","1","60","283","2","7","3","5","","","","103","2014-05-26 09:01:23","29","2014-05-26 16:19:36","","","","");
INSERT INTO complaint VALUES("2423","Maintenance-0001673","rest room door lock is broken","urgent","9","","37","1","60","278","2","9","3","5","","","","103","2014-05-26 09:02:56","37","2014-05-26 11:42:58","","","","");
INSERT INTO complaint VALUES("2424","Maintenance-0001674","cupboard is broken","urgent","9","","37","1","60","289","2","9","3","5","","","","103","2014-05-26 09:04:08","37","2014-05-26 11:42:31","","","","");
INSERT INTO complaint VALUES("2425","Maintenance-0001675","cupboard door to be fixed.
INSERT INTO complaint VALUES("2426","Maintenance-0001676","Autoclave machine NO.3 Steam leakage.","very urgent","7","","29","1","57","65","2","7","3","5","9","","out source work to be done","73","2014-05-26 09:12:40","29","2014-06-09 07:53:56","","","","");
INSERT INTO complaint VALUES("2427","MIS-0000751","wing-one-04 computer is not working","urgent","2","","112","1","60","","1","2","3","5","","0","","103","2014-05-26 09:17:35","112","2014-05-26 09:18:14","","","","");
INSERT INTO complaint VALUES("2428","MIS-0000752","TVS PRINTER NOT ABLE TO GIVE PRINT, PLS RECTIFY AS SOON AS POSSIBLE","TVS PRINTER NOT ABLE TO GIVE PRINT, PLS RECTIFY AS SOON AS POSSIBLE","2","","112","1","104","","1","2","3","5","","0","","70","2014-05-26 09:17:42","112","2014-05-26 09:27:04","","","","");
INSERT INTO complaint VALUES("2429","Maintenance-0001677","Junction box, Vaccum machine plug to be fixed","Urgent","5","","25","1","47","","2","5","3","5","","","","149","2014-05-26 09:40:07","25","2014-05-26 11:30:46","","","","");
INSERT INTO complaint VALUES("2430","Maintenance-0001678","Please dis-mantle and mantle the bunker cots from 4th cross vinayaka nagar  and shift to DNB doctors hostel situated at  2nd cross vinayaka nagar","Please execute the task by today afternoon","7","","29","2","98","","2","7","3","5","","","","151","2014-05-26 09:49:20","29","2014-05-26 16:20:53","","","","");
INSERT INTO complaint VALUES("2431","Maintenance-0001679","AC IS LEAKING","PLAESE SEND FAST","10","","26","1","64","333","2","10","3","5","","","","110","2014-05-26 10:04:33","26","2014-05-26 16:07:22","","","","");
INSERT INTO complaint VALUES("2432","Maintenance-0001680","B-ROOM TAP IS LEAKING","PLEASE RECTIFY SOON","6","","32","1","64","","2","6","3","5","","","","110","2014-05-26 10:05:15","32","2014-05-26 15:52:15","","","","");
INSERT INTO complaint VALUES("2433","Maintenance-0001681","Computer Keyboard tray has to be repaired.","Urgent","9","","37","4","107","","2","9","3","7","","","","265","2014-05-26 10:08:14","265","2014-06-02 10:40:00","","","","");
INSERT INTO complaint VALUES("2434","MIS-0000753","Installation of new system. ","Thanks ","2","","5","1","17","26","1","2","3","5","","0","","69","2014-05-26 10:11:30","5","2014-05-26 11:35:24","","","","");
INSERT INTO complaint VALUES("2435","Maintenance-0001682","f-6 calling bell is not working","urgent","8","","34","1","60","277","2","8","3","5","","","","103","2014-05-26 10:49:30","34","2014-05-26 15:50:02","","","","");
INSERT INTO complaint VALUES("2436","Maintenance-0001683","side rails to be fixed","urgent","7","","29","1","60","277","2","7","3","5","","","","103","2014-05-26 10:50:53","29","2014-05-26 16:19:15","","","","");
INSERT INTO complaint VALUES("2437","Maintenance-0001684","E-toilet room bulb is fused","attend soon","7","","27","1","61","","2","7","3","7","","","","225","2014-05-26 11:19:25","225","2014-05-26 11:44:54","","","","");
INSERT INTO complaint VALUES("2438","Maintenance-0001685","Ladies staff hostel G4-room lights are not working ","attend soon","7","","27","2","2","","2","7","3","7","","","","225","2014-05-26 11:20:55","225","2014-05-27 07:53:52","","","","");
INSERT INTO complaint VALUES("2439","Maintenance-0001686","Linen room switch board to be repaired.","Urgent","5","","25","1","115","","2","5","3","5","","","","149","2014-05-26 11:35:42","25","2014-05-27 15:41:07","","","","");
INSERT INTO complaint VALUES("2440","Maintenance-0001687","Switch board broken.","URGENT.","5","","25","1","84","","2","5","3","5","","","","351","2014-05-26 11:38:07","25","2014-05-27 15:41:23","","","","");
INSERT INTO complaint VALUES("2441","Maintenance-0001688","O2 IS NOT SUFFICIENT IN THE TROLLEY","TO BE CHANGED.","7","","27","1","53","","2","7","3","5","","","","119","2014-05-26 12:00:52","27","2014-05-26 16:17:45","","","","");
INSERT INTO complaint VALUES("2442","Maintenance-0001689","need to to fix fan","need to to fix fan","5","","25","1","16","171","2","5","3","5","","","","132","2014-05-26 12:04:07","25","2014-06-09 14:26:38","","","","");
INSERT INTO complaint VALUES("2443","Maintenance-0001690","callbell  not working","please rectify","8","","34","1","50","85","2","8","3","5","","","","177","2014-05-26 12:16:09","34","2014-05-26 15:49:48","","","","");
INSERT INTO complaint VALUES("2444","Maintenance-0001691","Room \'utility \' hand wash sink water is not going to be check. 	","as soon as possible.","6","","32","1","63","327","2","6","3","7","","","","87","2014-05-26 12:28:12","87","2014-05-26 16:04:07","","","","");
INSERT INTO complaint VALUES("2445","MIS-0000754","IP-BILLING PRINTER NOT WORKING","IP-BILLING PRINTER NOT WORKING","2","","112","1","42","","1","2","3","5","","0","","118","2014-05-26 12:35:20","112","2014-05-26 14:24:48","","","","");
INSERT INTO complaint VALUES("2446","Maintenance-0001692","ROOM NO:1509(2) fan is shakking  and not aable to operate the regulator.
INSERT INTO complaint VALUES("2447","MIS-0000755","crp-08 keyboard taken for cleaning and not replaced ","Urgent","2","","112","1","40","11","1","2","3","5","","0","","313","2014-05-26 12:41:42","112","2014-05-30 08:00:39","","","","");
INSERT INTO complaint VALUES("2448","MIS-0000756","Nurses station - 2 
INSERT INTO complaint VALUES("2449","Maintenance-0001693","We required one UPS point for computer. very urgent.","its very urgent.","5","","25","1","68","","2","5","3","5","","","","392","2014-05-26 13:35:27","25","2014-06-09 14:24:37","","","","");
INSERT INTO complaint VALUES("2450","MIS-0000757","In Accpac required a Tax Claus of 5.25% ","required to make PO and GRN","3","","9","1","29","","1","3","3","7","","","","117","2014-05-26 13:54:30","117","2014-06-04 08:55:45","","","","");
INSERT INTO complaint VALUES("2451","MIS-0000758","Pc ward mouse is not working please repair it","repair","2","","5","1","49","","1","2","3","5","","0","","248","2014-05-26 14:05:35","5","2014-05-26 14:11:31","","","","");
INSERT INTO complaint VALUES("2452","Maintenance-0001694","fan is not working ","please repair it","5","","25","1","49","230","2","5","3","3","9","","winding burnt hence outsource to be done ","248","2014-05-26 14:06:56","25","2014-06-13 16:47:46","","","","");
INSERT INTO complaint VALUES("2453","Maintenance-0001695","1.Scrubbing area towel stand to be removed, and extension to be fixed to the tap.
INSERT INTO complaint VALUES("2454","Maintenance-0001696","sink is blocked in near Opthal ladies toilet.","urgent","6","","32","1","47","118","2","6","3","5","","","","149","2014-05-26 14:29:40","32","2014-05-27 13:32:09","","","","");
INSERT INTO complaint VALUES("2455","Maintenance-0001697","Ladies staff hostel Room-10 tube light not working","attend soon","5","","24","2","2","","2","5","3","7","","","","225","2014-05-26 14:56:46","225","2014-06-02 11:57:30","","","","");
INSERT INTO complaint VALUES("2456","MIS-0000759","There is a problem in system #2 in CCU it is not opening.","Please help us out...","2","","112","1","52","","1","2","3","7","","0","","128","2014-05-26 15:15:35","128","2014-05-28 07:54:53","","","","");
INSERT INTO complaint VALUES("2457","Maintenance-0001698","Painting needed","Small portion wall painting is needed in Nursing office toilet","11","","21","1","45","","2","11","3","5","","","","92","2014-05-26 15:22:56","21","2014-06-21 11:33:14","","","","");
INSERT INTO complaint VALUES("2458","MIS-0000760","Printer not working","Printer not working","3","","5","1","2","","1","3","3","5","","","","17","2014-05-26 15:45:21","5","2014-05-26 16:16:14","","","","");
INSERT INTO complaint VALUES("2459","Maintenance-0001699","Fix the the lazer board on the wall  ","urgent ","9","","37","1","75","","2","9","3","5","","","","207","2014-05-26 15:51:56","37","2014-05-27 15:48:20","","","","");
INSERT INTO complaint VALUES("2460","Maintenance-0001700","Room C bed -7 suction not working to be check.","as soon as possible.","7","","29","1","63","","2","7","3","7","","","","87","2014-05-26 16:07:39","87","2014-06-12 12:15:32","","","","");
INSERT INTO complaint VALUES("2461","MIS-0000761","dr mahalakshmi queue numbers not generated properly ","dr mahalakshmi queue numbers not generated properly ","3","","9","1","16","19","1","3","3","7","5","","queue no is not generated at all or not generating in a sequence.Please clarify.","132","2014-05-26 16:30:56","132","2014-06-09 10:39:17","","","","");
INSERT INTO complaint VALUES("2462","Maintenance-0001701","ETP back side tube light not working","attend soon","5","","24","1","2","","2","5","3","7","","","","225","2014-05-27 07:53:17","225","2014-06-02 11:58:16","","","","");
INSERT INTO complaint VALUES("2463","MIS-0000762","System in CCU #2 is not opening. Please help us out not to face this problem again..","Kindly rectify it at the earliest.","2","","112","1","52","","1","2","3","7","","0","","128","2014-05-27 08:02:02","128","2014-05-28 07:54:06","","","","");
INSERT INTO complaint VALUES("2464","Maintenance-0001702","CT Scan Room - The color display of the Projector is not same as that appearing on the system, kindly check with the color resolution.   ","Kindly rectify the problem asap.","8","","33","1","98","","2","8","3","5","","","","151","2014-05-27 08:04:56","33","2014-05-27 15:36:06","","","","");
INSERT INTO complaint VALUES("2465","Maintenance-0001703","pipe leaking","pipe leaking","6","","32","1","74","188","2","6","3","5","","","","214","2014-05-27 08:12:55","32","2014-05-27 13:31:50","","","","");
INSERT INTO complaint VALUES("2466","Maintenance-0001704","room no 1509 fan not working.","please come immediately","5","","25","1","49","230","2","5","3","5","","","","97","2014-05-27 08:16:40","25","2014-05-28 15:58:11","","","","");
INSERT INTO complaint VALUES("2467","Maintenance-0001705","High risk labour room  enterance door  making sound","as soon as possible","9","","37","1","59","154","2","9","3","5","","","","116","2014-05-27 08:28:12","37","2014-05-27 15:46:27","","","","");
INSERT INTO complaint VALUES("2468","MIS-0000763","CRP-03 unable to send mails to gmail and yahoo","high priority","3","","9","1","40","12","1","3","3","7","","","","65","2014-05-27 08:28:55","65","2014-05-29 10:18:09","","","","");
INSERT INTO complaint VALUES("2469","MIS-0000764","Authorisation is not accepting to Pankaja","urgent","3","","6","1","54","","1","3","3","5","5","","Kindly mention the type of authorization and the user name in the accpac","73","2014-05-27 08:32:22","6","2014-05-27 08:49:38","","","","");
INSERT INTO complaint VALUES("2470","Maintenance-0001706","M-5 & M-6 Torch not working.  ","Urgent ","7","","29","1","71","","2","7","3","5","","","","72","2014-05-27 08:33:52","29","2014-05-27 13:36:33","","","","");
INSERT INTO complaint VALUES("2471","Maintenance-0001707","Doctor board to be fixed.","D - 3 bed side.","9","","37","1","62","310","2","9","3","5","","","","107","2014-05-27 08:35:52","37","2014-05-27 15:47:53","","","","");
INSERT INTO complaint VALUES("2472","Maintenance-0001708","\"D\" room wash basin flow of water is slow ","urgent ","6","","32","1","65","350","2","6","3","7","","","","84","2014-05-27 08:45:33","84","2014-05-30 08:42:19","","","","");
INSERT INTO complaint VALUES("2473","Maintenance-0001709","WALL- STAND TO BE FIXED IN 26 PLACES","WALL- STAND TO BE FIXED IN 26 PLACES","9","","37","1","61","","2","9","3","5","","","","104","2014-05-27 08:48:37","37","2014-05-27 15:47:33","","","","");
INSERT INTO complaint VALUES("2474","Maintenance-0001710","room no 1506 exhaust fan not working","please come immediately","5","","23","1","49","227","2","5","3","5","","","","97","2014-05-27 09:03:06","227","2014-06-20 13:03:49","","","","");
INSERT INTO complaint VALUES("2475","Maintenance-0001711","pipe leaking","pipe leaking","6","","32","1","74","188","2","6","3","5","","","","214","2014-05-27 09:11:24","32","2014-05-27 13:30:47","","","","");
INSERT INTO complaint VALUES("2476","Maintenance-0001712","nurses station - 01  doctor hand wash sink water block to be check and room A bath room hand wash sink  water block to be check immediately. ","as soon as possible.","6","","32","1","63","","2","6","3","7","","","","87","2014-05-27 09:25:02","87","2014-06-12 12:15:21","","","","");
INSERT INTO complaint VALUES("2477","Maintenance-0001713","Fan to be repaired in the tailor room.","urgent.","5","","25","1","115","360","2","5","3","5","1","","Capacitor no stock non stock raised ","149","2014-05-27 10:13:30","25","2014-06-09 14:27:58","","","","");
INSERT INTO complaint VALUES("2478","MIS-0000765","SYSTEM TO BE REPAIRED, IT IS BLINKING","PLEASE SEND FAST","2","","112","1","64","21","1","2","3","5","","0","","110","2014-05-27 10:34:03","112","2014-05-27 10:49:45","","","","");
INSERT INTO complaint VALUES("2479","Maintenance-0001714","CARE TROLLEY WHEEL TO BE REPAIRED","ALL READY SENT TO MAINTENANCE","7","","29","1","64","","2","7","3","5","","","","110","2014-05-27 10:35:36","29","2014-05-27 13:33:14","","","","");
INSERT INTO complaint VALUES("2480","Maintenance-0001715","Table fan outer wheel cameout fully.","Table fan outer wheel cameout fully","5","","25","1","110","","2","5","3","5","","","","208","2014-05-27 10:43:04","25","2014-05-27 15:40:38","","","","");
INSERT INTO complaint VALUES("2481","Maintenance-0001716"," Near ICU lobby one chair is broken to be repaired.","urgent","7","","29","1","57","","2","7","3","5","8","","Informed to Sis Lejina to send chair to maintenance for repair ","73","2014-05-27 10:50:59","29","2014-06-12 11:44:18","","","","");
INSERT INTO complaint VALUES("2482","MIS-0000766","1. colour of the badge has to be changed
INSERT INTO complaint VALUES("2483","Maintenance-0001717","name board\'s nail came out to be fixed.","kindly do the needful.","9","","37","1","79","","2","9","3","5","","","","216","2014-05-27 11:33:28","37","2014-05-27 15:48:47","","","","");
INSERT INTO complaint VALUES("2484","Maintenance-0001718","in deluxe room 3205 AC is not working.","kindly rectify .
INSERT INTO complaint VALUES("2485","Maintenance-0001719","ICU LOBBEY LIGHT NOT WORKING","ICU LOBBEY LIGHT NOT WORKING","5","","23","1","53","","2","5","3","5","","","","119","2014-05-27 11:48:49","23","2014-05-27 16:46:04","","","","");
INSERT INTO complaint VALUES("2486","Maintenance-0001720","ICU LOBBEY WOODEN CUPBOARD IS BROKEN  TO BE FIXED","ICU LOBBEY WOODEN CUPBOARD IS BROKEN  TO BE FIXED","9","","37","1","53","","2","9","3","5","","","","119","2014-05-27 11:50:12","37","2014-05-27 15:46:03","","","","");
INSERT INTO complaint VALUES("2487","Maintenance-0001721","Writing pad has to be fixed to chair.  ","Urgent","9","","37","4","107","","2","9","3","7","","","","265","2014-05-27 12:11:26","265","2014-06-21 07:45:14","","","","");
INSERT INTO complaint VALUES("2488","MIS-0000767","In PCW-01 system we are unable to open the word documents.","please do the needful","3","","8","1","49","","1","3","3","5","","","","97","2014-05-27 12:36:10","8","2014-05-27 12:39:46","","","","");
INSERT INTO complaint VALUES("2489","Maintenance-0001722","3205 AC is not working","patient is not satisfied due to AC Pls do the needful as soon as posible","10","","26","1","50","","2","10","3","5","","","","125","2014-05-27 12:42:58","26","2014-05-27 15:37:53","","","","");
INSERT INTO complaint VALUES("2490","Maintenance-0001723","suction apparatus is not working","suction apparatus is not working","7","","29","1","52","61","2","7","3","5","","","","156","2014-05-27 12:44:57","29","2014-05-27 15:38:58","","","","");
INSERT INTO complaint VALUES("2491","Maintenance-0001724","\"B\" room calling bell wire is come out and not working ","very urgent ","8","","33","1","65","348","2","8","3","7","","","","84","2014-05-27 12:50:11","84","2014-05-30 08:41:57","","","","");
INSERT INTO complaint VALUES("2492","Maintenance-0001725","suction apparatus handle broken","urgent","7","","29","1","76","101","2","7","3","5","","","","206","2014-05-27 13:22:40","29","2014-05-27 15:39:14","","","","");
INSERT INTO complaint VALUES("2493","MIS-0000768","Dr.Philip wants the pictures quality to improve and also the fonts. Kindly do the needful","Dr.Philip wants the pictures quality to improve and also the fonts. Kindly do the needful, mail sent to your ID at 1:55pm","3","","8","1","34","","1","3","3","5","","","","173","2014-05-27 13:36:58","8","2014-05-29 10:44:51","","","","");
INSERT INTO complaint VALUES("2494","Maintenance-0001726","in deluxe room 3221,3205,3207 AC SWING IS NOT WORKING ","KINDLY RECTIFY FOR PATIENT SATISFACTION ","10","","26","1","50","","2","10","3","5","","","","126","2014-05-27 14:06:15","26","2014-05-27 15:37:14","","","","");
INSERT INTO complaint VALUES("2495","Maintenance-0001727","IN 3211 CEILING LIGHTS ARE NOT WORKING ","KINDLY RECTIFY ","5","","23","1","50","","2","5","3","5","","","","126","2014-05-27 14:18:42","23","2014-05-27 16:45:17","","","","");
INSERT INTO complaint VALUES("2496","Maintenance-0001728","IN 3220 DOOR HOKES TO FIX , AS IT IS REMOVED. ","DO THE NEED FULL.","9","","37","1","50","","2","9","3","5","","","","126","2014-05-27 14:20:26","37","2014-05-27 15:45:42","","","","");
INSERT INTO complaint VALUES("2497","MIS-0000769","IN DELUXE SYSTEM -01 IS TOO SLOW TO OPERATE , (LATE REACTION )","DO THE NEEDFULL.","3","","5","1","50","","1","3","3","5","","","","126","2014-05-27 14:22:04","5","2014-05-27 14:30:18","","","","");
INSERT INTO complaint VALUES("2498","MIS-0000770","Adobe reader is not working","URGENT","3","","5","1","76","","1","3","3","5","","","","206","2014-05-27 14:26:59","5","2014-05-27 15:04:38","","","","");
INSERT INTO complaint VALUES("2499","MIS-0000771","printer is not working ","please rectify immediately","2","","112","1","102","","1","2","3","5","","0","","249","2014-05-27 14:39:15","112","2014-05-27 14:46:23","","","","");
INSERT INTO complaint VALUES("2500","Maintenance-0001729","in dlx 3205 switch board is broken near wash basin ","kindly do the needfull. ","5","","23","1","50","84","2","5","3","5","","","","126","2014-05-27 14:40:48","23","2014-05-27 16:43:57","","","","");
INSERT INTO complaint VALUES("2501","Maintenance-0001730","1507 top surface Phototheraphy two bulb not working ","please come immediately","7","","29","1","49","228","2","7","3","5","","","","97","2014-05-27 14:56:01","29","2014-05-28 07:58:43","","","","");
INSERT INTO complaint VALUES("2502","MIS-0000772","pl give option for consumption entry for stella m login","pl give option for consumption entry for stella m login","3","","6","1","16","19","1","3","3","7","","","","132","2014-05-27 14:57:19","132","2014-06-09 10:38:53","","","","");
INSERT INTO complaint VALUES("2503","Maintenance-0001731","side rails to be fixed","urgent","7","","29","1","60","281","2","7","3","5","","","","103","2014-05-27 14:58:04","29","2014-05-28 07:58:29","","","","");
INSERT INTO complaint VALUES("2504","Maintenance-0001732","6 washers of the tap has to be replaced in the main kitchen, the water is again leaking too much. so please check and rectify the problem.","very urgent.","6","","30","1","68","","2","6","3","5","","","","392","2014-05-27 14:58:05","30","2014-05-28 08:02:35","","","","");
INSERT INTO complaint VALUES("2505","Maintenance-0001733","Some of the places in wing 3 needs new tiles fixation & the toilet wall needs to be plastered","as soon as possible","12","","386","1","62","315","2","12","3","2","","","","106","2014-05-27 15:02:45","227","2014-06-04 10:48:43","","","","");
INSERT INTO complaint VALUES("2506","MIS-0000773","Printer is not working.","not working.","2","","5","1","94","","1","2","3","5","","0","","136","2014-05-27 15:04:38","5","2014-05-27 15:10:56","","","","");
INSERT INTO complaint VALUES("2507","Maintenance-0001734","pt complaining  room   I- 1, B-4 ,B-5 calling bell is not working to be check immediately.","as soon as possible.","8","","33","1","63","","2","8","3","7","","","","87","2014-05-27 15:34:16","87","2014-06-12 12:09:05","","","","");
INSERT INTO complaint VALUES("2508","Maintenance-0001735","Pneumatic container stand (steel stand)broken,need to weld..","Pneumatic container stand (steel stand)broken,need to weld..","7","","29","1","81","","2","7","3","5","","","","99","2014-05-27 16:29:12","29","2014-05-28 07:57:44","","","","");
INSERT INTO complaint VALUES("2509","Maintenance-0001736","high risk labour room enterance door to be fixed","as soon as possible","9","","37","1","59","","2","9","3","5","","","","116","2014-05-28 07:44:48","17","2014-06-09 12:44:21","","","","");
INSERT INTO complaint VALUES("2510","MIS-0000774","Please rectify the system #2 in CCU at the earliest.","System is not opening, it seems like it is hanged.","2","","112","1","52","","1","2","3","7","","0","","128","2014-05-28 07:52:50","128","2014-06-04 16:03:48","","","","");
INSERT INTO complaint VALUES("2511","Maintenance-0001737","Maternity room light not working","attend soon","5","","24","1","60","","2","5","3","7","","","","225","2014-05-28 07:54:12","225","2014-06-02 11:59:59","","","","");
INSERT INTO complaint VALUES("2512","Maintenance-0001738","annex councelling room","screen rod to fix","9","","37","1","82","","2","9","3","5","","","","98","2014-05-28 08:11:46","37","2014-05-28 16:11:46","","","","");
INSERT INTO complaint VALUES("2513","MIS-0000775","N-COMPUTING SYSTEMS ARE NOT CONNECTING TO MAIN SYSTEM IN W-1 AND W-4 BILLING SYSTEMS..","N-COMPUTING SYSTEMS ARE NOT CONNECTING TO MAIN SYSTEM IN W-1 AND W-4 BILLING SYSTEMS..","3","","112","1","42","","1","3","3","7","","","","370","2014-05-28 08:36:49","370","2014-05-30 08:49:30","","","","");
INSERT INTO complaint VALUES("2514","Maintenance-0001739","CAMP COT TO BE PAINTED IN C ROOM.","CAMP COT TO BE PAINTED IN C ROOM.","9","","37","1","61","","2","9","3","5","","","","104","2014-05-28 08:37:37","37","2014-05-29 16:11:49","","","","");
INSERT INTO complaint VALUES("2515","Maintenance-0001740","ELECTRONIC WEIGHING MACHINE UNDER REPAIR.","ELECTRONIC WEIGHING MACHINE UNDER REPAIR.","7","","29","1","61","","2","7","3","5","","","","104","2014-05-28 08:40:05","29","2014-05-28 17:00:13","","","","");
INSERT INTO complaint VALUES("2516","Maintenance-0001741","switch board is borken","need to be urgent","5","","23","1","60","277","2","5","3","5","","","","103","2014-05-28 08:43:12","23","2014-05-28 16:51:49","","","","");
INSERT INTO complaint VALUES("2517","Maintenance-0001742","f-6 and g-3 calling bell is not working ","urgent","8","","33","1","60","277","2","8","3","5","","","","103","2014-05-28 08:48:05","33","2014-05-28 17:03:49","","","","");
INSERT INTO complaint VALUES("2518","Maintenance-0001743","g-room swith board is broken","urgent","5","","23","1","60","281","2","5","3","5","","","","103","2014-05-28 08:49:13","23","2014-05-28 16:51:37","","","","");
INSERT INTO complaint VALUES("2519","MIS-0000776","Network Problem.Not able to open. 
INSERT INTO complaint VALUES("2520","Maintenance-0001744","Door is locked automatically. water is getting blocked","very urgent","9","","37","1","47","117","2","9","3","5","","","","149","2014-05-28 09:03:15","37","2014-05-28 16:14:28","","","","");
INSERT INTO complaint VALUES("2521","Maintenance-0001745","ortho cupboard
INSERT INTO complaint VALUES("2522","Maintenance-0001746","Computer Key Board Disk is not working","urgent ","9","","37","1","108","","2","9","3","5","","","","133","2014-05-28 09:14:00","37","2014-05-28 12:43:35","","","","");
INSERT INTO complaint VALUES("2523","Maintenance-0001747","AC Not working ","Cooling is not working - Urgent please","10","","26","1","58","194","2","10","3","5","","","","133","2014-05-28 09:16:31","26","2014-05-28 13:39:02","","","","");
INSERT INTO complaint VALUES("2524","Maintenance-0001748","Tube light is fused / blinking.
INSERT INTO complaint VALUES("2525","Maintenance-0001749","in deluxe3214 NOT ABLE TO OPERATE THE TV ","KINDLY RECTIFY ","8","","33","1","50","","2","8","3","5","","","","126","2014-05-28 09:30:17","33","2014-05-28 16:01:03","","","","");
INSERT INTO complaint VALUES("2526","Maintenance-0001750","Required door latch for Class Room no.2","Required door latch for Class Room no.2","9","","37","1","106","","2","9","3","7","","","","152","2014-05-28 10:17:54","152","2014-06-06 08:32:32","","","","");
INSERT INTO complaint VALUES("2527","MIS-0000777","Printer connection to crp -1008 to Sal-02","Printer connection to crp -1008 to Sal-02","3","","5","1","39","","1","3","3","5","","","","349","2014-05-28 10:18:01","5","2014-05-28 10:19:53","","","","");
INSERT INTO complaint VALUES("2528","Maintenance-0001751","NURSES  STATION - 01 ,02 HAND WASH TAP WATER IS NOT COMING TO BE CHECK . ","AS SOON AS POSSIBLE.","6","","32","1","63","","2","6","3","7","","","","87","2014-05-28 10:19:54","87","2014-06-12 12:14:59","","","","");
INSERT INTO complaint VALUES("2529","MIS-0000778","Mouse not working in ENT-E5","URGENT","2","","5","1","76","","1","2","3","5","","0","","206","2014-05-28 10:20:19","5","2014-05-28 10:25:13","","","","");
INSERT INTO complaint VALUES("2530","Maintenance-0001752","light is not working","urgent","5","","23","1","60","289","2","5","3","5","","","","103","2014-05-28 10:34:37","23","2014-05-28 16:46:46","","","","");
INSERT INTO complaint VALUES("2531","Maintenance-0001753","door lock screw to be replaced.","complaint through mail on May 27, 2014 4:39 PM","9","","37","1","101","","2","9","3","7","","","","16","2014-05-28 11:02:52","16","2014-05-28 15:11:40","","","","");
INSERT INTO complaint VALUES("2532","Maintenance-0001754","Emergency patient cot freely moving even the break is applied ","complaint through mail on May 28, 2014 9:16 AM","7","","29","1","81","","2","7","3","7","","","","16","2014-05-28 11:05:38","16","2014-05-29 11:19:41","","","","");
INSERT INTO complaint VALUES("2533","Maintenance-0001755","Kindly arrange for  UV light for this week saturday and sunday. ","Complaint through mail on May 27, 2014 4:58 PM","5","","25","1","51","","2","5","3","7","","","","16","2014-05-28 11:07:38","16","2014-06-17 12:20:44","","","","");
INSERT INTO complaint VALUES("2534","MIS-0000779","Mail box cant be open in Snobi\'s system BUS-06","resolve as soon as possible","3","","112","1","41","","1","3","3","5","","","","63","2014-05-28 11:36:43","112","2014-05-28 12:00:25","","","","");
INSERT INTO complaint VALUES("2535","Maintenance-0001756","sink pipe damaged .
INSERT INTO complaint VALUES("2536","Maintenance-0001757","BED NO.10 FAN IS NOT WORKING","BED NO.10 FAN IS NOT WORKING","5","","25","1","53","","2","5","3","5","","","","119","2014-05-28 12:17:17","25","2014-05-29 16:21:17","","","","");
INSERT INTO complaint VALUES("2537","Maintenance-0001758","BED NO. 11 SUCTION NOT WORKING","BED NO. 11 SUCTION NOT WORKING","7","","29","1","53","","2","7","3","5","","","","119","2014-05-28 12:17:50","29","2014-05-28 15:59:59","","","","");
INSERT INTO complaint VALUES("2538","Maintenance-0001759","IN VIP ROOM AS AC WAS NOT WORKING AND THE TECHNICIAN HAS TAKEN THE AC STABILIZER FOR REPLACEMENT,BUT STILL NOT YET RECTIFIED.","KINDLY DO THE NEEDFUL TO RECEIVE THE PATIENT.","10","","26","1","50","76","2","10","3","5","","","","126","2014-05-28 12:36:19","26","2014-05-28 16:58:12","","","","");
INSERT INTO complaint VALUES("2539","Maintenance-0001760","cupboard is broken","urgent","9","","37","1","60","289","2","9","3","5","","","","103","2014-05-28 12:55:41","37","2014-05-28 16:12:21","","","","");
INSERT INTO complaint VALUES("2540","MIS-0000780","In ortho opd troponin test Reference range is not displayed.","Urgent","3","","9","1","17","","1","3","3","5","5","","what is the patient number? Please provide the proper information so that we can check the issue. Simply you are mentioning the test name will not helpful to solve the issue.","257","2014-05-28 12:57:32","123","2014-05-29 10:00:36","","","","");
INSERT INTO complaint VALUES("2541","MIS-0000781","Net work Problem.
INSERT INTO complaint VALUES("2542","Maintenance-0001761","ROOM NO 1514 FAN NEED TO BE FIXED","PLEASE RECTIFY ASAP","5","","23","1","49","234","2","5","3","5","","","","97","2014-05-28 13:47:43","23","2014-06-12 10:23:44","","","","");
INSERT INTO complaint VALUES("2543","Maintenance-0001762","in deluxe ward photo-therapy tube-light to change as it is not working. ","kindly rectify","7","","29","1","50","","2","7","3","5","","","","126","2014-05-28 13:54:02","29","2014-05-28 15:59:45","","","","");
INSERT INTO complaint VALUES("2544","Maintenance-0001763","in deluxe store room the fan is  not working.","please do the needful ","5","","23","1","50","","2","5","3","5","","","","126","2014-05-28 13:56:33","23","2014-05-28 16:46:09","","","","");
INSERT INTO complaint VALUES("2545","Maintenance-0001764","w- 4 toilet doors are rusted which can injure patient and Attender,  to be rectified immediately  and do the needful","complaint through mail on May 28, 2014 1:07 PM","9","","37","1","63","","2","9","3","3","6","","out source work","16","2014-05-28 14:04:40","37","2014-05-29 16:12:32","","","","");
INSERT INTO complaint VALUES("2546","MIS-0000782","In all the ward and opds troponin I reference range is not displayed. 
INSERT INTO complaint VALUES("2547","Maintenance-0001765","TUBELIGHT IS NOT WORKING","PLEASE RECTIFY SOON","5","","24","1","64","339","2","5","3","5","","","","110","2014-05-28 14:57:12","24","2014-05-28 16:43:57","","","","");
INSERT INTO complaint VALUES("2548","Maintenance-0001766","NAIL TO BE FIXED","PLEASE RECTIFY SOON","9","","37","1","64","339","2","9","3","5","","","","110","2014-05-28 14:57:39","37","2014-05-29 16:10:00","","","","");
INSERT INTO complaint VALUES("2549","MIS-0000783","KEY BOARD IS NOT WORKING","PLEASE SEND FAST","3","","5","1","64","22","1","3","3","5","","","","110","2014-05-28 14:58:22","112","2014-05-28 15:18:48","","","","");
INSERT INTO complaint VALUES("2550","MIS-0000784","In canon printer not working ","in main counter no : 26","3","","5","1","17","25","1","3","3","7","","","","113","2014-05-28 15:02:47","113","2014-05-29 13:46:36","","","","");
INSERT INTO complaint VALUES("2551","MIS-0000785","Wing 3 C 6,  Patient name - Naryanan, MRD NUM: AA260078, was a new admission the diet was entered by the nurses at 1.00pm but new diet advices alert didn\'t show in our system, and hence the food was not sent on time. we received the transfer alter for this patient from W3 c 13 to W3 c6, but we didn\'t receive  this patients  new advices alter.","please reticy the problem.","3","","6","1","68","","1","3","3","5","","","","392","2014-05-28 15:17:22","6","2014-05-28 16:38:51","","","","");
INSERT INTO complaint VALUES("2552","Maintenance-0001767","FUNGUS growth present on the walls of endoscopy room near washing area and entrance.","to be cleared up as soon as possible","11","","21","1","112","","2","11","3","5","","","","217","2014-05-28 15:29:43","21","2014-06-21 11:33:04","","","","");
INSERT INTO complaint VALUES("2553","Maintenance-0001768","floor mat to be fix ","floor mat to be fix ","9","","37","1","74","186","2","9","3","5","9","","outsource to be done","214","2014-05-28 15:36:41","37","2014-06-12 11:12:17","","","","");
INSERT INTO complaint VALUES("2554","Maintenance-0001769","Door lock to be fix","Door lock to be fix","9","","37","1","74","184","2","9","3","5","","","","214","2014-05-28 15:40:08","37","2014-05-29 16:09:04","","","","");
INSERT INTO complaint VALUES("2555","MIS-0000786","ADM-04
INSERT INTO complaint VALUES("2556","Maintenance-0001770","table for repair ","table for repair ","9","","37","1","74","186","2","9","3","5","","","","214","2014-05-28 15:42:17","37","2014-05-29 16:09:18","","","","");
INSERT INTO complaint VALUES("2557","MIS-0000787","Rat bite for lan cable ( Multiple times happend)","Please replace the lan cable","2","","5","1","41","","1","2","3","5","","0","","361","2014-05-28 16:28:27","5","2014-05-28 16:57:49","","","","");
INSERT INTO complaint VALUES("2558","Maintenance-0001771","Men\'s Hostel Room no 3 Dr Abhilash & vinod roo toilet blocked ","Complaint through call ","6","","31","2","2","","2","6","3","5","","","","31","2014-05-28 17:02:12","31","2014-05-28 17:02:37","","","","");
INSERT INTO complaint VALUES("2559","MIS-0000788","IN W1 COMPUTER NOT WORKING","IN W1 COMPUTER NOT WORKING","3","","112","1","42","","1","3","3","5","","","","374","2014-05-29 08:23:49","112","2014-05-29 08:48:57","","","","");
INSERT INTO complaint VALUES("2560","Maintenance-0001772","o2 cylender","o2 cylender empty.","7","","27","1","81","","2","7","3","5","","","","99","2014-05-29 08:30:30","29","2014-05-29 12:27:48","","","","");
INSERT INTO complaint VALUES("2561","Maintenance-0001773","1.Sewage line blocked back of men\'s hostel & 
INSERT INTO complaint VALUES("2562","Maintenance-0001774","High risk labour room delivery cot broken","Please send immediately.","7","","29","1","59","","2","7","3","5","","","","116","2014-05-29 09:14:29","29","2014-05-29 16:17:50","","","","");
INSERT INTO complaint VALUES("2563","MIS-0000789","In outlook we are not receiving the mails","In the Inbox. So Please check it know.","3","","5","1","17","32","1","3","3","7","","","","113","2014-05-29 09:15:36","113","2014-05-29 13:46:26","","","","");
INSERT INTO complaint VALUES("2564","Maintenance-0001775","In lab OPD ","Ladies Toilet Light is not their.","5","","23","1","17","","2","5","3","7","","","","113","2014-05-29 09:25:50","113","2014-06-02 16:34:38","","","","");
INSERT INTO complaint VALUES("2565","MIS-0000790","BBH Connect is not working ","In Lab OPD main counter.","3","","112","1","17","25","1","3","3","7","","","","113","2014-05-29 09:26:29","113","2014-05-29 13:46:16","","","","");
INSERT INTO complaint VALUES("2566","Maintenance-0001776","K-ROOM FLUSH TO BE FIXED","PLEASE SEND FAST","6","","32","1","64","","2","6","3","5","","","","110","2014-05-29 09:39:02","32","2014-05-29 11:02:46","","","","");
INSERT INTO complaint VALUES("2567","Maintenance-0001777","SINK IS BLOCKED","PLEASE RECTIFY SOON","6","","32","1","64","331","2","6","3","5","","","","110","2014-05-29 09:39:29","32","2014-05-29 11:01:34","","","","");
INSERT INTO complaint VALUES("2568","Maintenance-0001778","LIGHT IS NOT WORKING  MEDICAL OPD OPPOSITE ","LIGHT IS NOT WORKING  MEDICAL OPD OPPOSITE","5","","23","1","44","58","2","5","3","7","","","","348","2014-05-29 09:41:36","348","2014-06-13 14:28:59","","","","");
INSERT INTO complaint VALUES("2569","Maintenance-0001779","stock cupboard lock to be placed","to be done immediately","9","","37","1","112","","2","9","3","5","","","","217","2014-05-29 09:52:07","37","2014-05-29 16:07:35","","","","");
INSERT INTO complaint VALUES("2570","Maintenance-0001780","fungus growth on the walls of endoscopy room,in the washing area and near the entrance","to be cleared as soon as possible","11","","21","1","112","","2","11","3","5","","","","217","2014-05-29 09:53:36","21","2014-06-21 11:32:53","","","","");
INSERT INTO complaint VALUES("2571","Maintenance-0001781","ICU 4Th BED O2 FLOW METER TO BE FIXED","ICU 4Th BED O2 FLOW METER TO BE FIXED","7","","27","1","53","","2","7","3","5","","","","119","2014-05-29 09:55:19","27","2014-06-05 15:29:52","","","","");
INSERT INTO complaint VALUES("2572","Maintenance-0001782","cupboard door to be fixed near nursing station","cupboard door to be fixed near nursing station","9","","37","1","53","","2","9","3","5","","","","119","2014-05-29 09:56:26","37","2014-05-29 16:11:14","","","","");
INSERT INTO complaint VALUES("2573","Maintenance-0001783","BATH ROOM IS BLOCKED","URGENT","6","","32","1","60","278","2","6","3","5","","","","103","2014-05-29 10:01:55","32","2014-05-29 11:01:24","","","","");
INSERT INTO complaint VALUES("2574","Maintenance-0001784","Drinking water is not available. 
INSERT INTO complaint VALUES("2575","MIS-0000791","Sharing access for auditors computer","Sharing access for auditors computer","3","","5","1","41","","1","3","3","5","","","","361","2014-05-29 10:17:04","112","2014-05-29 10:17:46","","","","");
INSERT INTO complaint VALUES("2576","MIS-0000792","CRP-06 mouse not working even after repeated complaints by Mrs. Cynthia","high priority","2","","9","1","40","11","1","2","3","7","","704","","65","2014-05-29 10:22:52","65","2014-06-07 11:44:55","","","","");
INSERT INTO complaint VALUES("2577","MIS-0000793","accpack is not working","accpack is not working","2","","6","1","42","","1","2","3","5","","0","","369","2014-05-29 10:24:21","6","2014-05-29 10:26:55","","","","");
INSERT INTO complaint VALUES("2578","MIS-0000794","Pts name- manjunath Hos.num AA260153
INSERT INTO complaint VALUES("2579","Maintenance-0001785","I-ROOM BED NO-10 PATIENT CALLING BELL NOT ABLE TO OFF","PLEASE RECTIFY SOON","8","","33","1","64","336","2","8","3","5","","","","110","2014-05-29 10:53:13","33","2014-05-30 16:03:33","","","","");
INSERT INTO complaint VALUES("2580","Maintenance-0001786","Kitchen\'s window,door mesh to be fixed & Tubelight is blinking,to be changed.","Very urgent","9","","37","1","114","","2","9","3","5","","","","73","2014-05-29 10:53:57","37","2014-05-29 16:06:44","","","","");
INSERT INTO complaint VALUES("2581","MIS-0000795","Shock circuit  of wax bath slide warming table , heater exit fan.","in histopathology lab. emergency","","","123","1","17","32","1","3","3","7","","","null","113","2014-05-29 10:55:12","113","2014-05-29 10:55:12","","","","");
INSERT INTO complaint VALUES("2582","Maintenance-0001787","Shock circuit  of wax bath slide warming table , heater exit fan.","in histopathology lab. emergency","5","","23","1","17","32","2","5","3","7","","","","113","2014-05-29 10:58:30","113","2014-05-29 13:45:50","","","","");
INSERT INTO complaint VALUES("2583","Maintenance-0001788","Emergency exit outside staircase sajja to be cleaned & iron rods to be removed","complaint received through security   ","11","","21","1","60","","2","11","3","7","","","","16","2014-05-29 11:18:31","16","2014-05-31 10:04:04","","","","");
INSERT INTO complaint VALUES("2584","Maintenance-0001789","Fire Hydrant box glass to be fixed ","complaint through Security ","9","","37","1","60","","2","9","3","7","","","","16","2014-05-29 11:19:32","16","2014-05-31 10:03:56","","","","");
INSERT INTO complaint VALUES("2585","Maintenance-0001790","wheel chair.","Wheel chair wheel broken & break need to fix.","7","","29","1","81","","2","7","3","5","","","","99","2014-05-29 11:35:01","29","2014-05-29 16:17:32","","","","");
INSERT INTO complaint VALUES("2586","MIS-0000796","Please install Barha in CUS-06","This is needed for designing & brochure preparations","3","","8","1","32","41","1","3","3","5","","","","88","2014-05-29 11:52:10","8","2014-05-29 12:18:27","","","","");
INSERT INTO complaint VALUES("2587","Maintenance-0001791","Tube light needs to be changed - 2nos","Tube light needs to be changed - 2nos","5","","23","1","25","","2","5","2","7","","","","152","2014-05-29 11:52:18","152","2014-06-06 08:34:51","","","","");
INSERT INTO complaint VALUES("2588","Maintenance-0001792","doctor examination table foot pedal broken,","very urgent.","9","","37","1","73","","2","9","3","5","","","","211","2014-05-29 11:53:23","37","2014-05-29 16:09:39","","","","");
INSERT INTO complaint VALUES("2589","Maintenance-0001793","Aluminum Door to beb removed from the all OT\'s","Urgent","9","","37","1","58","189","2","9","3","5","","","","121","2014-05-29 11:53:48","227","2014-06-05 12:55:27","","","","");
INSERT INTO complaint VALUES("2590","MIS-0000797","Canon LBP2900 printer is not working properly. blank prints are coming and some sounds are coming from the printer","Resolve as soon as possible","2","","112","1","41","","1","2","3","5","","0","","63","2014-05-29 11:54:43","112","2014-05-29 12:17:03","","","","");
INSERT INTO complaint VALUES("2591","Maintenance-0001794","Water Bath and Wax Bath","is not working so we are sending the instruments.
INSERT INTO complaint VALUES("2592","Maintenance-0001795","IN DELUXE 3204 EXHAUST FAN MAKES MORE SOUND ","KINDLY DO THE NEEDFUL","5","","23","1","50","73","2","5","3","5","","","","126","2014-05-29 12:37:14","23","2014-05-31 08:33:09","","","","");
INSERT INTO complaint VALUES("2593","MIS-0000798","network problem","network problem","2","","5","1","29","","1","2","3","5","","0","","356","2014-05-29 12:38:08","6","2014-05-29 12:51:57","","","","");
INSERT INTO complaint VALUES("2594","Maintenance-0001796","network  point not working 
INSERT INTO complaint VALUES("2595","Maintenance-0001797","ECG SCREEN TO BE FIXED","ECG SCREEN TO BE FIXED, ","9","","37","1","104","","2","9","3","5","","","","70","2014-05-29 12:51:11","37","2014-05-29 16:08:18","","","","");
INSERT INTO complaint VALUES("2596","Maintenance-0001798","Nursing Station Oxygen Trolley Raiser to be fixed
INSERT INTO complaint VALUES("2597","Maintenance-0001799","mesh to be fixed and nurses changing room mesh to be fixed","urgent","9","","37","1","60","282","2","9","3","5","","","","103","2014-05-29 13:03:14","37","2014-06-12 11:12:42","","","","");
INSERT INTO complaint VALUES("2598","Maintenance-0001800","Only one AC is working now in the Server room. The second one is not functional duet to lack of gas(as per the AC Technician). Kindly make the availability of gas immediately.","Only one AC is working now in the Server room. The second one is not functional duet to lack of gas(as per the AC Technician). Kindly make the availability of gas immediately.","10","","26","1","3","168","2","10","3","7","","","","6","2014-05-29 13:10:13","6","2014-06-10 08:54:03","","","","");
INSERT INTO complaint VALUES("2599","Maintenance-0001801","Male Doctor\'s Room- Tubelight not working ","please rectify the issue immediately.","5","","24","1","98","","2","5","3","5","","","","151","2014-05-29 13:15:18","24","2014-05-29 16:15:20","","","","");
INSERT INTO complaint VALUES("2600","Maintenance-0001802","tube light","not working","5","","24","1","81","","2","5","3","5","","","","98","2014-05-29 13:25:08","24","2014-05-29 16:14:14","","","","");
INSERT INTO complaint VALUES("2601","Maintenance-0001803","Medical Secretary\'s office - Fixing of the notice board. ","Please fix the notice board immediately .","9","","37","1","98","","2","9","3","5","","","","151","2014-05-29 14:24:20","37","2014-05-29 16:08:36","","","","");
INSERT INTO complaint VALUES("2602","MIS-0000799","Dear Madam,
INSERT INTO complaint VALUES("2603","Maintenance-0001804","There is no water supply in CCU.","Please rectify it at the earliest.","6","","31","1","52","","2","6","3","7","","","","128","2014-05-29 14:55:25","128","2014-06-04 16:02:37","","","","");
INSERT INTO complaint VALUES("2604","Maintenance-0001805","bath room sink taps are leaking in ’B ,C,E,F,rooms and  nurses station -01& 02  kindly check immediately.","compliant through mail to maintenance on May 29, 2014 2:10 PM","6","","31","1","63","","2","6","3","7","","","","16","2014-05-29 15:02:03","16","2014-05-31 10:03:47","","","","");
INSERT INTO complaint VALUES("2605","Maintenance-0001806","To put  the plastic sheet  fully to cover the  roofing of patient waiting area,which is moved away because of wind.","sunlight falling on patient waiting area.","11","","21","1","18","217","2","11","3","7","","","","64","2014-05-29 15:07:43","64","2014-06-02 12:08:53","","","","");
INSERT INTO complaint VALUES("2606","Maintenance-0001807","IN DELUXE ROOM 3212 WATER LEAKAGE IN AC","KINDLY RECTIFY AS SOON AS POSSIBLE.
INSERT INTO complaint VALUES("2607","MIS-0000800","system is hanging ","Qlt 03 system is not working","3","","5","1","26","","1","3","3","7","","","","76","2014-05-29 16:26:59","76","2014-06-09 12:08:27","","","","");
INSERT INTO complaint VALUES("2608","MIS-0000801","CRP-01 EPSON printer not working","high priority","2","","112","1","40","12","1","2","3","7","6","0","today I\'m taking to office for repair.","65","2014-05-29 17:04:11","65","2014-06-18 12:01:02","","","","");
INSERT INTO complaint VALUES("2609","Maintenance-0001808","NOT WORKING","PLEASE DO THE NEEDFUL ","10","","26","1","50","89","2","10","3","7","","","","181","2014-05-30 08:06:13","181","2014-06-06 11:13:17","","","","");
INSERT INTO complaint VALUES("2610","Maintenance-0001809","Tv is not working","please do the needful ","8","","33","1","50","89","2","8","3","7","","","","181","2014-05-30 08:07:59","181","2014-06-06 11:13:57","","","","");
INSERT INTO complaint VALUES("2611","Maintenance-0001810","room no 1508 cot foot end has broken to be repaired,","please come immediately","7","","27","1","49","229","2","7","3","5","","","","97","2014-05-30 08:18:29","27","2014-05-30 13:48:25","","","","");
INSERT INTO complaint VALUES("2612","Maintenance-0001811","IN DELUXE3205 GEYSER IS NOT WORKING AS ITS WIRES ARE BURNT ","KINDLY RECTIFY ","5","","23","1","50","74","2","5","3","5","","","","126","2014-05-30 08:24:02","23","2014-05-30 16:38:16","","","","");
INSERT INTO complaint VALUES("2613","MIS-0000802","current visit problem","current visit problem","3","","6","1","16","16","1","3","3","7","","","","132","2014-05-30 08:26:02","132","2014-06-09 10:38:28","","","","");
INSERT INTO complaint VALUES("2614","Maintenance-0001812","IN DELUXE PANTRY THERE IS NO CURRENT SUPPLY FOR ALL THE ELECTRICAL EQUIPMENT","KINDLY DO THE NEEDFUL","5","","23","1","50","","2","5","3","5","","","","126","2014-05-30 08:26:16","23","2014-05-30 16:22:34","","","","");
INSERT INTO complaint VALUES("2615","Maintenance-0001813","Wall switch board has come out bed NO.2","URGENT","5","","23","1","54","","2","5","3","5","1","","","73","2014-05-30 08:29:27","23","2014-06-09 16:15:53","","","","");
INSERT INTO complaint VALUES("2616","Maintenance-0001814","Female General Toilet flush water is flowing continuously ","urgent ","6","","30","1","65","359","2","6","3","7","","","","84","2014-05-30 08:43:56","84","2014-06-02 08:18:05","","","","");
INSERT INTO complaint VALUES("2617","Maintenance-0001815","Nurses room sink  water is leaking from the pipe ","urgent ","6","","30","1","65","355","2","6","3","7","","","","84","2014-05-30 08:45:06","84","2014-06-02 08:18:30","","","","");
INSERT INTO complaint VALUES("2618","MIS-0000803","W-3 billing system working slowly and getting started vary late..","W-3 billing system working slowly and getting started vary late..","3","","112","1","42","","1","3","3","5","","","","370","2014-05-30 08:47:57","112","2014-05-30 09:09:02","","","","");
INSERT INTO complaint VALUES("2619","Maintenance-0001816","C - 2 bed side calling bell is not working.","urgent.","8","","33","1","62","309","2","8","3","5","","","","107","2014-05-30 08:50:16","33","2014-05-30 16:03:03","","","","");
INSERT INTO complaint VALUES("2620","Maintenance-0001817","in deluxe 3220 there is no current supply ","kindly rectify as soon as possible.","5","","23","1","50","89","2","5","3","5","","","","126","2014-05-30 09:01:22","23","2014-05-30 16:21:12","","","","");
INSERT INTO complaint VALUES("2621","MIS-0000804","wing -3 billing computer very slow, not working properly","wing -3 billing computer very slow, not working properly","3","","112","1","42","","1","3","3","5","","","","118","2014-05-30 09:01:23","112","2014-05-30 09:08:17","","","","");
INSERT INTO complaint VALUES("2622","Maintenance-0001818","N T S,Rear gate and Men\' s hostel camera\'s not visible (Blur) .","NTS ,Rear gate and mens hostel not working.","8","","34","1","99","","2","8","3","5","9","","AMC vendor has to come & rectify informed to vendor","350","2014-05-30 09:20:49","34","2014-06-05 15:39:25","","","","");
INSERT INTO complaint VALUES("2623","MIS-0000805","ACCPAC IS NOT WORKING IN W-1 N-COMPUTING BILLING SYSTEM","ACCPAC IS NOT WORKING IN W-1 N-COMPUTING BILLING SYSTEM","3","","112","1","42","","1","3","3","5","","","","370","2014-05-30 09:30:00","112","2014-05-30 09:50:06","","","","");
INSERT INTO complaint VALUES("2624","MIS-0000806","OUTLOOK EXPRESS WE COULD,NOT ABEL TO SEND MAIL ","OUTLOOK EXPRESS WE COULD,NOT ABEL TO SEND MAIL ","2","","5","1","16","","1","2","3","7","","0","","132","2014-05-30 09:47:24","132","2014-06-09 10:38:13","","","","");
INSERT INTO complaint VALUES("2625","Maintenance-0001819","Rooms A,B,C,E,F, bath room anchor to be fixed.","as soon as possible.","9","","37","1","63","","2","9","3","5","","","","87","2014-05-30 10:05:02","37","2014-06-25 16:06:31","","","","");
INSERT INTO complaint VALUES("2626","MIS-0000807","CRP-02 mouse is not working","urgent","2","","112","1","40","11","1","2","3","5","","0","","313","2014-05-30 10:08:04","112","2014-05-30 10:18:15","","","","");
INSERT INTO complaint VALUES("2627","MIS-0000808","PRINT IS NOT COMING IN W-1 N-COMPUTING BILLNG SYSTEM","PRINT IS NOT COMING IN W-1 N-COMPUTING BILLNG SYSTEM","3","","5","1","42","","1","3","3","5","","","","370","2014-05-30 10:15:39","5","2014-05-30 12:20:11","","","","");
INSERT INTO complaint VALUES("2628","Maintenance-0001820","ROOM NO 1507 BATHROOM COMMODE LEAKAGE, THE WATER LEAKING OUTSIDE THE ROOM NEAR THE MAIN DOOR.","PLEASE COME IMMEDIATELY","6","","30","1","49","228","2","6","3","5","","","","97","2014-05-30 10:16:50","30","2014-05-30 15:56:20","","","","");
INSERT INTO complaint VALUES("2629","Maintenance-0001821","in 3215 there is no supply in bathroom ","kindly do the needful for patient satisfaction ","6","","30","1","50","84","2","6","3","5","","","","126","2014-05-30 10:26:36","30","2014-05-30 15:56:04","","","","");
INSERT INTO complaint VALUES("2630","MIS-0000809","1. Work request, The word file has to be converted to corel drew for the preparation of a official seal .  File as attached 2.5\" X 1\" (inches) i.e. 6.5 cm. X 3 cm.
INSERT INTO complaint VALUES("2631","Maintenance-0001822","geyser is not working ","kindly rectify","5","","23","1","50","84","2","5","3","5","","","","126","2014-05-30 11:35:17","23","2014-05-30 16:37:55","","","","");
INSERT INTO complaint VALUES("2632","MIS-0000810","Doctors no longer associated with BBH to be removed from website.","Have attached the updated Doctors & JMOs List as of May 2014","3","","8","1","94","37","1","3","3","7","2","","Waiting for the updated list..","137","2014-05-30 11:39:43","137","2014-06-24 08:25:12","20140530113943_Doctors_May 2014.xls","","","");
INSERT INTO complaint VALUES("2633","MIS-0000811","To fix and install the cartridge","To fix and install the cartridge","2","","112","1","94","","1","2","3","5","","0","","136","2014-05-30 11:43:47","112","2014-05-30 11:58:32","","","","");
INSERT INTO complaint VALUES("2634","Maintenance-0001823","There is no current in 
INSERT INTO complaint VALUES("2635","MIS-0000812","make changes in the HICC badge design ","HICC badge","3","","8","1","46","","1","3","3","5","","","","94","2014-05-30 12:37:17","8","2014-05-30 12:40:41","","","","");
INSERT INTO complaint VALUES("2636","Maintenance-0001824","OT 6 both the doors are making noise","Urgent","9","","37","1","58","194","2","9","3","5","","","","121","2014-05-30 12:53:19","37","2014-06-05 12:27:56","","","","");
INSERT INTO complaint VALUES("2637","Maintenance-0001825","O2 cylinder is empty","urgent ","7","","27","1","65","","2","7","3","7","","","","84","2014-05-30 13:02:27","84","2014-06-02 08:19:05","","","","");
INSERT INTO complaint VALUES("2638","MIS-0000813","mouse not working in icu system 1","mouse not working in icu system 1","2","","112","1","53","","1","2","3","5","","0","","119","2014-05-30 13:07:24","112","2014-05-30 14:01:30","","","","");
INSERT INTO complaint VALUES("2639","Maintenance-0001826","1. Plug point is not working in main kitchen area.(outside food court area)
INSERT INTO complaint VALUES("2640","Maintenance-0001827","1. Drainage lid at the main kitchen has to be fixed. 
INSERT INTO complaint VALUES("2641","Maintenance-0001828","Mirror is broaken in 2nd floor gents toilet take it out and replace it.","urgent","9","","37","1","47","108","2","9","3","5","","","","149","2014-05-30 15:49:42","37","2014-06-05 12:27:29","","","","");
INSERT INTO complaint VALUES("2642","Maintenance-0001829","Fan regulator is not working in Room No. 4 and Tube lights are not working in the Community lab  ","Urgent ","5","","24","4","107","","2","5","3","5","","","","265","2014-05-30 15:59:13","24","2014-06-12 11:58:41","","","","");
INSERT INTO complaint VALUES("2643","MIS-0000814","COMPUTER (SYSTEM)","Computer not geting on, kindly change the wire and do the needful asap.","2","","5","1","81","","1","2","3","5","11","0","power cable problem","99","2014-05-30 16:03:47","5","2014-06-03 12:30:36","","","","");
INSERT INTO complaint VALUES("2644","Maintenance-0001830","Sink pipe water is liking ","urgent ","6","","31","1","71","164","2","6","3","5","","","","72","2014-05-30 16:09:15","31","2014-06-02 16:38:12","","","","");
INSERT INTO complaint VALUES("2645","MIS-0000815","Lab send out test mail id not opening ","please check know immediately","3","","5","1","17","32","1","3","3","7","","","","113","2014-05-30 16:25:22","113","2014-06-02 16:34:17","","","","");
INSERT INTO complaint VALUES("2646","MIS-0000816","World No Tobacco Day Poster designing and display","Poster to be displayed at PC OP TV, Desktop Monitor and Que-Management TVs  ","3","","8","1","94","37","1","3","3","7","","","","137","2014-05-30 17:08:34","137","2014-06-03 11:46:30","","","","");
INSERT INTO complaint VALUES("2647","MIS-0000817","sage accpac id","user name:sapna
INSERT INTO complaint VALUES("2648","Maintenance-0001831","Door lock is broken ","kindly do the needful","9","","37","1","93","","2","9","3","5","","","","79","2014-05-31 08:25:20","37","2014-05-31 11:58:23","","","","");
INSERT INTO complaint VALUES("2649","MIS-0000818","sage accpac","user id:SAPNA, need order entry not requisition entry.","3","","6","1","81","","1","3","3","5","","","","99","2014-05-31 08:31:51","6","2014-05-31 11:10:02","","","","");
INSERT INTO complaint VALUES("2650","Maintenance-0001832","in deluxe nursing station x-ray view box is not working even the red light is on .","kindly rectify ","5","","23","1","50","","2","5","3","5","","","","126","2014-05-31 08:53:51","23","2014-06-09 09:02:14","","","","");
INSERT INTO complaint VALUES("2651","MIS-0000819","CRP-04,  CRP-12, scan option is not working.
INSERT INTO complaint VALUES("2652","Maintenance-0001833","Room  \'B\'  bed -5 cot side rail bar coming out to be checked.","as early as possible.","7","","28","1","63","","2","7","3","7","","","","87","2014-05-31 10:53:17","87","2014-06-19 10:22:36","","","","");
INSERT INTO complaint VALUES("2653","MIS-0000820","printer is not working and wing-one -04
INSERT INTO complaint VALUES("2654","Maintenance-0001834","ROOM NO 1511 EXHAUST FAN NOT WORKING","PLEASE DO CHECK ASAP.","5","","24","1","49","232","2","5","3","5","","","","97","2014-05-31 11:30:01","24","2014-06-12 10:26:39","","","","");
INSERT INTO complaint VALUES("2655","Maintenance-0001835","ALL THE  ROOM MAIN DOORS ARE NOT ABLE TO CLOSE PROPERLY THE DOOR HANDLE IS NOT PROPER, IT IS NOT CLOSING ","PLEASE DO CHECK ALL THE ROOM DOORS AND DO THE NEEDFUL..","9","","37","1","49","242","2","9","3","5","","","","97","2014-05-31 11:36:41","37","2014-06-02 16:47:24","","","","");
INSERT INTO complaint VALUES("2656","Maintenance-0001836","8 DOOR STOPPER TO BE PUT IN WING -2","8 DOOR STOPPER TO BE PUT IN WING -2","9","","37","1","61","","2","9","3","5","","","","104","2014-05-31 11:57:10","37","2014-06-05 12:27:01","","","","");
INSERT INTO complaint VALUES("2657","MIS-0000821","1. changes in previous badge design
INSERT INTO complaint VALUES("2658","Maintenance-0001837","in mrd in one switch everything wil shot down all computer , camera and tokken system ","in mrd in one switch everything wil shot down all computer , camera and tokken system ","5","","24","1","16","171","2","5","3","7","","","","132","2014-05-31 18:07:52","132","2014-06-09 10:37:51","","","","");
INSERT INTO complaint VALUES("2659","MIS-0000822","mrd transaction list printout not printing","mrd transaction list printout not printing","3","","6","1","16","17","1","3","3","7","","","","132","2014-06-02 07:43:35","132","2014-06-09 10:37:10","","","","");
INSERT INTO complaint VALUES("2660","MIS-0000823","epson prienter not  working ","epson prienter not  working ","2","","112","1","16","19","1","2","3","7","","0","","132","2014-06-02 07:47:27","132","2014-06-09 10:45:31","","","","");
INSERT INTO complaint VALUES("2661","Maintenance-0001838","urinal sink is blocked near IP billing gents toilet.","urgent","6","","30","1","47","105","2","6","3","5","","","","149","2014-06-02 07:51:46","30","2014-06-02 10:52:58","","","","");
INSERT INTO complaint VALUES("2662","Maintenance-0001839","rolling chair broken","rectify immediately","7","","29","1","77","","2","7","3","5","","","","212","2014-06-02 07:56:57","29","2014-06-09 07:43:09","","","","");
INSERT INTO complaint VALUES("2663","MIS-0000824","ip billing  ibp-02 system","please install accapac in this system.","3","","6","1","42","","1","3","3","5","","","","372","2014-06-02 08:10:05","6","2014-06-02 09:46:35","","","","");
INSERT INTO complaint VALUES("2664","Maintenance-0001840","C13 patient cot  the height adjustment rod is broken to be repaired","not working","7","","29","1","62","","2","7","3","5","","","","106","2014-06-02 08:12:26","29","2014-06-03 16:37:18","","","","");
INSERT INTO complaint VALUES("2665","MIS-0000825","Unable to access network.","High priority","3","","112","1","40","11","1","3","3","7","","","","65","2014-06-02 08:12:47","65","2014-06-06 08:18:47","","","","");
INSERT INTO complaint VALUES("2666","Maintenance-0001841","Staff toilet light is not working.","needs to be checked","5","","24","1","62","315","2","5","3","5","","","","106","2014-06-02 08:13:40","24","2014-06-02 11:24:42","","","","");
INSERT INTO complaint VALUES("2667","MIS-0000826","N Computing not getting connected in w1 IP billing
INSERT INTO complaint VALUES("2668","Maintenance-0001842","\"D\" room cupboard are broken to be fixed ","very urgent ","9","","37","1","65","350","2","9","3","7","","","","84","2014-06-02 08:20:11","84","2014-06-03 10:00:50","","","","");
INSERT INTO complaint VALUES("2669","MIS-0000827","computer is not working","urgent","2","","112","1","60","","1","2","3","5","","0","","103","2014-06-02 08:28:57","112","2014-06-02 09:23:36","","","","");
INSERT INTO complaint VALUES("2670","Maintenance-0001843","Emergency out  (Number plate) N TS & Campus rear gate camera\'s not working.","Emergency out  (Number plate) N TS & Campus rear gate camera\'s not working.","8","","34","1","99","","2","8","3","5","","","","350","2014-06-02 08:35:38","34","2014-06-05 15:39:36","","","","");
INSERT INTO complaint VALUES("2671","Maintenance-0001844","\"F\" Room bathroom sink is leaking ","very urgent ","6","","30","1","65","353","2","6","3","7","","","","84","2014-06-02 08:43:51","84","2014-06-03 10:00:23","","","","");
INSERT INTO complaint VALUES("2672","MIS-0000828","accpac is not opening in Reim-02 & 
INSERT INTO complaint VALUES("2673","Maintenance-0001845","AC not cooling.","AC not cooling","10","","26","1","18","215","2","10","3","7","","","","64","2014-06-02 08:47:17","64","2014-06-05 12:51:34","","","","");
INSERT INTO complaint VALUES("2674","MIS-0000829","printer is not working in reimbursement Department","printer is not working in reimbursement Department","2","","112","1","43","","1","2","3","5","","0","","223","2014-06-02 09:04:13","112","2014-06-02 09:17:51","","","","");
INSERT INTO complaint VALUES("2675","Maintenance-0001846","urinal sink pipe - removed and kept aside.  ","urgent","6","","30","1","47","112","2","6","3","5","","","","149","2014-06-02 09:04:40","30","2014-06-02 10:50:26","","","","");
INSERT INTO complaint VALUES("2676","Maintenance-0001847","Doctors room a posit  chair has to be repaired.","urgent","9","","37","1","62","312","2","9","3","5","","","","107","2014-06-02 09:05:19","37","2014-06-03 16:44:44","","","","");
INSERT INTO complaint VALUES("2677","Maintenance-0001848","X-RAY CR ROOM AC LEAKING, PLEASE RECTIFY IMMEDIATELY.","X-RAY CR ROOM AC LEAKING, PLEASE RECTIFY IMMEDIATELY.","10","","26","1","90","","2","10","3","5","","","","70","2014-06-02 09:10:58","26","2014-06-02 16:40:09","","","","");
INSERT INTO complaint VALUES("2678","Maintenance-0001849","IN CT SCAN ROOM, SCREENS TO BE FIXED","IN CT SCAN ROOM, SCREENS TO BE FIXED","9","","37","1","91","","2","9","3","5","","","","70","2014-06-02 09:11:43","37","2014-06-02 16:49:12","","","","");
INSERT INTO complaint VALUES("2679","MIS-0000830","Accpac Report is not coming in proper format. Tax column is showing blank in IP Report.","Resolve as soon as possible","3","","6","1","41","","1","3","3","5","","","","63","2014-06-02 09:17:45","6","2014-06-03 08:02:49","","","","");
INSERT INTO complaint VALUES("2680","Maintenance-0001850","side rails to be fixed ","urgent","7","","29","1","60","282","2","7","3","5","","","","103","2014-06-02 09:36:45","29","2014-06-02 11:27:31","","","","");
INSERT INTO complaint VALUES("2681","MIS-0000831","IPB-07 OP BILL VERIFICATION NOT WORKING","IPB-07 OP BILL VERIFICATION NOT WORKING","3","","6","1","42","","1","3","3","5","","","","374","2014-06-02 09:42:50","6","2014-06-02 09:48:48","","","","");
INSERT INTO complaint VALUES("2682","Maintenance-0001851","BED NO :9 SIDE RAILS TO BE REPAIRED","PLEASE RECTIFY SOON","7","","29","1","64","335","2","7","3","5","","","","110","2014-06-02 09:49:54","29","2014-06-02 11:27:16","","","","");
INSERT INTO complaint VALUES("2683","Maintenance-0001852","\"G-1\" room roof light is blinking  ","very urgent","5","","24","1","65","351","2","5","3","7","","","","84","2014-06-02 10:05:12","84","2014-06-03 10:01:49","","","","");
INSERT INTO complaint VALUES("2684","Maintenance-0001853","NURSES STATION ROLLER TO BE REPAIRED","PLEASE RECTIFY SOON","7","","29","1","64","","2","7","3","5","","","","110","2014-06-02 10:26:17","29","2014-06-03 16:38:27","","","","");
INSERT INTO complaint VALUES("2685","Maintenance-0001854","nurses station flush tank leaking","attend soon","6","","30","1","62","","2","6","3","7","","","","225","2014-06-02 10:29:45","225","2014-06-02 11:59:36","","","","");
INSERT INTO complaint VALUES("2686","Maintenance-0001855","Phone instrument not working","instrument not working since saturday  afternoon. Kindly look into it as soon as possible.","8","","34","1","31","","2","8","3","5","","","","262","2014-06-02 10:33:57","34","2014-06-02 10:35:55","","","","");
INSERT INTO complaint VALUES("2687","Maintenance-0001856","cupboard door to be fixed ","very urgent","9","","37","1","55","","2","9","3","5","","","","73","2014-06-02 10:38:50","37","2014-06-02 16:47:38","","","","");
INSERT INTO complaint VALUES("2689","Maintenance-0001857","1. Curtain rods  are loose in two rooms to be fixed tightly &
INSERT INTO complaint VALUES("2690","Maintenance-0001858","Students Hostel: Tube lights are not working in  the 
INSERT INTO complaint VALUES("2691","Maintenance-0001859","Front side ETP pipe broken","Verbal complaint from Lavanya ","6","","30","1","36","","2","6","3","5","","","","30","2014-06-02 10:54:00","30","2014-06-02 16:50:02","","","","");
INSERT INTO complaint VALUES("2692","Maintenance-0001860","G-room flush not working","attendsoon","6","","32","1","65","","2","6","3","7","","","","225","2014-06-02 11:02:32","225","2014-06-02 11:59:17","","","","");
INSERT INTO complaint VALUES("2693","Maintenance-0001861","All toilet rooms flush water is not coming","attend soon","5","","24","1","65","","2","5","3","7","","","","225","2014-06-02 11:04:06","225","2014-06-02 11:59:05","","","","");
INSERT INTO complaint VALUES("2694","Maintenance-0001862","Room-07 cot raiser is not working","attend soon","5","","24","1","49","","2","5","3","7","","","","225","2014-06-02 11:05:10","225","2014-06-02 11:58:51","","","","");
INSERT INTO complaint VALUES("2695","Maintenance-0001863","Staff room toilet bulb not working","attend soon","5","","24","1","63","","2","5","3","7","","","","225","2014-06-02 11:05:57","225","2014-06-02 11:58:38","","","","");
INSERT INTO complaint VALUES("2696","Maintenance-0001864","PA System is not working in ICU and Wing III and they are not able to hear any announcements made from dial no. 698","Please install the speakers in doctors room in Wing III as well as in ICU, ASAP","8","","33","1","98","","2","8","3","5","","","","151","2014-06-02 11:06:05","33","2014-06-04 16:33:26","","","","");
INSERT INTO complaint VALUES("2697","Maintenance-0001865","Near security grill gate to be repaired","attend soon","7","","29","1","70","","2","7","3","3","9","","Technician Ravikumar checked & cannot be repair hence outsource to be done ","225","2014-06-02 11:08:10","29","2014-06-02 16:45:12","","","","");
INSERT INTO complaint VALUES("2698","Maintenance-0001866","students old and new hostel: Water blockage is there in the bathroom.   
INSERT INTO complaint VALUES("2699","Maintenance-0001867","Dear sir, Our computer chair is broken, please repair it. we have handed over the chair to maintenance dept. If can\'t be repaired please give the contamination certificate to get a new one.","Dear sir, Our computer chair is broken, please repair it. we have handed over the chair to maintenance dept. If can\'t be repaired please give the contamination certificate to get a new one.","7","","29","1","38","","2","7","3","5","","","","78","2014-06-02 11:15:51","227","2014-06-06 14:11:58","","","","");
INSERT INTO complaint VALUES("2700","MIS-0000832","UNABLE TO TAKE LAB REPORTS","URGENT","3","","9","1","55","","1","3","3","5","","","","73","2014-06-02 11:19:20","123","2014-06-02 16:07:59","","","","");
INSERT INTO complaint VALUES("2701","MIS-0000833","Service Tax Report Is Not Opening","Service Tax Report Is Not Opening","3","","6","1","43","","1","3","3","5","","","","223","2014-06-02 11:26:55","6","2014-06-02 12:03:55","","","","");
INSERT INTO complaint VALUES("2702","Maintenance-0001868"," Tube lights are not working in the Room. No. 23 and Geyser is not working in the old students Hostel.
INSERT INTO complaint VALUES("2703","Maintenance-0001869","washing machine base stand welding work","washing machine base stand rust and broken","7","","29","1","84","157","2","7","3","5","9","","Technician Ravikumar checked & cannot be repair hence outsource to be done ","351","2014-06-02 11:28:52","227","2014-06-04 15:03:24","","","","");
INSERT INTO complaint VALUES("2704","Maintenance-0001870","STAFF TOILET","BLOCKED","6","","30","1","81","98","2","6","3","5","","","","98","2014-06-02 11:29:23","30","2014-06-02 16:50:37","","","","");
INSERT INTO complaint VALUES("2705","Maintenance-0001871","old wooden rack repair and modify as a shoe rack","old wooden rack repair and modify as a shoe rack","9","","37","1","84","","2","9","3","5","","","","351","2014-06-02 11:32:07","37","2014-06-03 16:47:01","","","","");
INSERT INTO complaint VALUES("2706","Maintenance-0001872","Writing pad chairs has to be repair .","Urgent","9","","37","4","107","","2","9","3","2","","","","265","2014-06-02 11:38:39","37","2014-06-03 16:47:39","","","","");
INSERT INTO complaint VALUES("2707","Maintenance-0001873","presently dryer coil heat effect is very low, so put coil etc or modify the coil","presently dryer coil heat effect is very low, so put coil etc or modify the coil","7","","29","1","84","158","2","7","3","3","9","","Technician Ravikumar checked & cannot be repair hence outsource to be done ","351","2014-06-02 11:39:18","29","2014-06-02 16:45:36","","","","");
INSERT INTO complaint VALUES("2708","Maintenance-0001874","The door bolt is broken","urgent","9","","37","1","47","113","2","9","3","5","","","","149","2014-06-02 11:40:35","37","2014-06-02 16:46:55","","","","");
INSERT INTO complaint VALUES("2709","Maintenance-0001875","patient cots side rails to be fixed for  8cots","Complaint through mail from Epsy sister on June 02, 2014 10:04 AM","7","","29","1","60","","2","7","3","3","9","","Outsource to be done as per Mr Ravikumar","16","2014-06-02 11:46:17","29","2014-06-02 16:42:11","","","","");
INSERT INTO complaint VALUES("2710","Maintenance-0001876","fixing of fan supporter for ceiling fan and cot extender by fabrication with the existing material.","budgeted under equipment  repairs.
INSERT INTO complaint VALUES("2711","MIS-0000834","Kindly do the need full this system name wg4-03 nursing desktop , order new medicine showing error  to be checked.","as soon as possible.","3","","112","1","63","","1","3","3","7","","","","87","2014-06-02 12:18:06","87","2014-06-02 16:25:21","","","","");
INSERT INTO complaint VALUES("2712","Maintenance-0001877","screw has become loose of hand wash in PC OPD gents toilet so make it tight.","urgent","6","","31","1","47","110","2","6","3","5","","","","149","2014-06-02 12:56:48","31","2014-06-02 16:36:29","","","","");
INSERT INTO complaint VALUES("2713","Maintenance-0001878","tube light is not working in OPD gents toilet.","urgent","5","","22","1","47","114","2","5","3","5","","","","149","2014-06-02 12:59:03","22","2014-06-02 16:35:55","","","","");
INSERT INTO complaint VALUES("2714","Maintenance-0001879","tap is leaking in ENT gents toilet.","urgent","6","","31","1","47","112","2","6","3","5","","","","149","2014-06-02 13:00:20","31","2014-06-03 16:21:35","","","","");
INSERT INTO complaint VALUES("2715","Maintenance-0001880","main door not able to close,too much of sound on closing","to be repaired immediately","9","","37","1","112","","2","9","3","5","","","","217","2014-06-02 13:04:15","37","2014-06-02 16:49:33","","","","");
INSERT INTO complaint VALUES("2716","MIS-0000835","Sage Accpac 9M/L Laboratory report is not working discharge patient lab reports to be given","please rectify soon","3","","9","1","64","21","1","3","3","5","","","","110","2014-06-02 13:23:19","123","2014-06-02 16:06:04","","","","");
INSERT INTO complaint VALUES("2717","Maintenance-0001881","camera connection was wrongly connected with 
INSERT INTO complaint VALUES("2718","Maintenance-0001882","In front of  high risak  labour room  AC water is leaking. Its urgent .","As soon as possible","10","","26","1","59","154","2","10","3","5","","","","116","2014-06-02 13:34:02","26","2014-06-02 16:39:52","","","","");
INSERT INTO complaint VALUES("2719","MIS-0000836","SAGE ACCAC PAC WE ARE NOT ABLE TO GIVE THE LABORATORY REPORTS.","we were giving the in patient lab reports in 9 M/L Laboratory report so please do the needful immediately as patient are for discharge","3","","9","1","49","","1","3","3","5","","","","97","2014-06-02 14:07:27","123","2014-06-02 16:07:10","","","","");
INSERT INTO complaint VALUES("2720","MIS-0000837","Computer is not working.","kindly do the needful.","2","","112","1","79","","1","2","3","5","5","852","Computer was OFF","216","2014-06-02 14:10:03","112","2014-06-03 08:15:45","","","","");
INSERT INTO complaint VALUES("2721","Maintenance-0001883","lab opd ground floor gents toilet tube light is not working so pls rectifiy it soon ","its urgent","5","","22","1","17","153","2","5","3","7","","","","113","2014-06-02 14:18:51","113","2014-06-02 16:35:30","","","","");
INSERT INTO complaint VALUES("2722","Maintenance-0001884","o2 cylender","2 o2 cylender empty.","7","","28","1","81","","2","7","3","5","","","","99","2014-06-02 14:23:46","28","2014-06-02 16:39:14","","","","");
INSERT INTO complaint VALUES("2723","MIS-0000838","epson printer ,s  not working ,  ","epson printer ,s  not working ,  ","2","","112","1","16","","1","2","3","7","","0","","132","2014-06-02 15:17:42","132","2014-06-09 10:46:19","","","","");
INSERT INTO complaint VALUES("2724","Maintenance-0001885","Tube light not working ","Urgent ","5","","22","1","71","167","2","5","3","5","","","","72","2014-06-02 15:18:32","22","2014-06-03 16:20:52","","","","");
INSERT INTO complaint VALUES("2725","Maintenance-0001886","The key board holder is broken ","Kindly do the needful asap.","9","","37","1","32","","2","9","3","3","1","","Keyboard channel no stock non stock raised awaiting parts","96","2014-06-02 15:34:41","37","2014-06-03 16:41:38","","","","");
INSERT INTO complaint VALUES("2726","MIS-0000839","Tube light not working ","Urgent ","","","123","1","71","167","1","","3","7","","","null","72","2014-06-02 15:44:42","227","2014-06-02 15:44:42","","","","");
INSERT INTO complaint VALUES("2727","MIS-0000840","IN DLX SYSTEM -01 UNDER LAB REPORTS - LAB PROVISIONAL REPORT ORDER BY  ARE UNABLE TO OPEARATE  ,AND NOT POSSIBLE TO GIVE OUT PRINT ","KINDLY DO THE NEEDFUL FOR QUICK DISCHARGE ","3","","9","1","50","","1","3","3","5","","","","126","2014-06-02 15:45:30","123","2014-06-02 16:07:34","","","","");
INSERT INTO complaint VALUES("2728","Maintenance-0001887","IN DELUXE 3204 BATHROOM LIGHTS ARE NOT WORKING ","DO THE NEEDFUL AS SOON AS POSSIBLE FOR PATIENT SATISFACTION .","5","","22","1","50","73","2","5","3","5","","","","126","2014-06-02 15:49:16","22","2014-06-03 16:20:43","","","","");
INSERT INTO complaint VALUES("2729","MIS-0000841","Mother insurance is not reflecting on the final bill ","High priority","3","","6","1","40","11","1","3","3","5","5","","kindly provide a bill print or attach a screen shot","313","2014-06-02 15:56:59","6","2014-06-03 15:38:49","","","","");
INSERT INTO complaint VALUES("2730","Maintenance-0001888","Tube light not working ","Urgent ","5","","22","1","71","167","2","5","3","5","","","","72","2014-06-02 16:06:27","227","2014-06-02 16:06:58","","","","");
INSERT INTO complaint VALUES("2731","MIS-0000842","kindly look this patients name mr.philomin raj , hosp no : AA206423   please bed transfer to patient parking area to be changed immediately. ","as soon as possible.","3","","6","1","63","","1","3","3","7","","","","87","2014-06-02 16:24:55","87","2014-06-12 12:14:03","","","","");
INSERT INTO complaint VALUES("2732","MIS-0000843","EPSON printer is not working","Please emergency","3","","5","1","17","34","1","3","3","7","","","","113","2014-06-02 16:35:46","113","2014-06-05 17:53:45","","","","");
INSERT INTO complaint VALUES("2733","Maintenance-0001889","High risk labour room toilet water is coming outside","needs urgent ASAP","6","","32","1","59","","2","6","3","5","","","","116","2014-06-03 07:42:28","32","2014-06-03 16:34:53","","","","");
INSERT INTO complaint VALUES("2734","Maintenance-0001890","rain water leeking inside the counter","rain water leeking inside the counter","12","","386","1","16","171","2","12","3","2","","","","132","2014-06-03 08:02:47","32","2014-06-03 16:31:31","","","","");
INSERT INTO complaint VALUES("2735","MIS-0000844","install the mrd reports & connect the printer to the MRD-08 system","install the mrd reports & connect the printer to the MRD-08 system","3","","6","1","16","19","1","3","3","7","","","","132","2014-06-03 08:03:49","132","2014-06-09 10:46:39","","","","");
INSERT INTO complaint VALUES("2736","MIS-0000845","in deluxe system-01 is unable to operate( unable to start)","kindly do the needful ","2","","112","1","50","","1","2","3","5","","0","","126","2014-06-03 08:06:36","112","2014-06-03 08:27:18","","","","");
INSERT INTO complaint VALUES("2737","Maintenance-0001891","Room C Toilet slab wood door screw coming out and pantry room side steel  bar to be checked.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-06-03 08:09:40","87","2014-06-12 12:13:14","","","","");
INSERT INTO complaint VALUES("2738","Maintenance-0001892","in deluxe ward in corridor the emergency lamp set is not working (no charge)","kindly do the needful for NABH AUDIT","5","","23","1","50","","2","5","3","5","","","","126","2014-06-03 08:09:42","23","2014-06-03 16:25:15","","","","");
INSERT INTO complaint VALUES("2739","Maintenance-0001893","IN DELUXE ROOM 3221 THE HAND FLUSH (HANDLE) IS BROKEN.","KINDLY DO THE NEEDFUL AS PATIENT IS VERY URGENT","6","","32","1","50","","2","6","3","5","","","","126","2014-06-03 08:11:36","32","2014-06-03 16:32:48","","","","");
INSERT INTO complaint VALUES("2740","Maintenance-0001894","Bed No:4 Tubelight is not working","please rectify soon","5","","23","1","64","334","2","5","3","5","","","","110","2014-06-03 08:11:51","23","2014-06-03 16:27:43","","","","");
INSERT INTO complaint VALUES("2741","Maintenance-0001895","C-Room Side Rails to be fixed","Please rectify soon","7","","29","1","64","","2","7","3","5","","","","110","2014-06-03 08:12:38","29","2014-06-03 16:37:58","","","","");
INSERT INTO complaint VALUES("2742","Maintenance-0001896","Bed No:8 and 9 Patient cuboard to be repaired","Please rectify soon","9","","37","1","64","335","2","9","3","5","","","","110","2014-06-03 08:13:42","37","2014-06-03 16:46:40","","","","");
INSERT INTO complaint VALUES("2743","Maintenance-0001897","cardiac table is bend","cardiac table is bend","7","","29","1","53","","2","7","3","5","","","","119","2014-06-03 08:33:45","29","2014-06-03 16:36:57","","","","");
INSERT INTO complaint VALUES("2744","MIS-0000846","MSys RADIOLOGY OPTION IS NOT WORKING IN SAGE ACCPAC","MS RADIOLOGY OPTION IS NOT WORKING IN SAGE ACCPAC","2","","5","1","104","","1","2","3","5","","0","","70","2014-06-03 08:36:29","5","2014-06-04 12:17:07","","","","");
INSERT INTO complaint VALUES("2745","Maintenance-0001898","IN DEXA ROOM HANGER TO BE FIXED","IN DEXA ROOM HANGER TO BE FIXED","9","","37","1","90","","2","9","3","5","","","","70","2014-06-03 08:37:37","37","2014-06-03 16:47:13","","","","");
INSERT INTO complaint VALUES("2746","Maintenance-0001899","Ext 552 unable to operate","high priority","8","","33","1","40","63","2","8","3","7","","","","65","2014-06-03 08:38:39","65","2014-06-06 08:18:25","","","","");
INSERT INTO complaint VALUES("2747","Maintenance-0001900","Wheel to be fixed for bed no.2","very urgent","7","","29","1","54","","2","7","3","2","","","","73","2014-06-03 08:44:21","227","2014-06-03 08:50:05","","","","");
INSERT INTO complaint VALUES("2748","MIS-0000847","HRMS is not working in BBH-PRS-007.bbh.com system ","Pls Rectify ASAP","3","","5","1","30","","1","3","3","7","","","","148","2014-06-03 08:48:22","148","2014-06-05 09:14:27","","","","");
INSERT INTO complaint VALUES("2749","Maintenance-0001901","Men\'s hostel ,NTS gate,Rear gate camera\'s not working.","Camera\'s not working.","8","","33","1","99","","2","8","3","5","","","","350","2014-06-03 08:50:32","33","2014-06-16 16:22:31","","","","");
INSERT INTO complaint VALUES("2750","MIS-0000848","printer","need printer connection.","2","","112","1","81","","1","2","3","5","","0","","99","2014-06-03 08:51:03","112","2014-06-03 09:39:41","","","","");
INSERT INTO complaint VALUES("2751","Maintenance-0001902","AC is not working in PACS room","AC is not working in PACS room","10","","26","1","104","","2","10","3","5","","","","70","2014-06-03 08:54:37","26","2014-06-03 16:35:48","","","","");
INSERT INTO complaint VALUES("2752","MIS-0000849","system not working","system not working","2","","112","1","74","","1","2","3","5","","0","","214","2014-06-03 09:17:46","112","2014-06-03 09:42:59","","","","");
INSERT INTO complaint VALUES("2753","MIS-0000850","Mimsys Reports -Credit Reports-Patient Reports, while opening error is coming","Patient credit report is not opening","3","","6","1","41","","1","3","3","5","","","","361","2014-06-03 09:20:19","6","2014-06-03 09:50:51","","","","");
INSERT INTO complaint VALUES("2754","Maintenance-0001903","Cementing  to be done in delux  guest pantry. ","Urgent....","12","","386","1","68","95","2","12","3","2","","","","392","2014-06-03 09:20:45","227","2014-06-03 10:33:10","","","","");
INSERT INTO complaint VALUES("2755","MIS-0000851","Monitor is not getting ON","Please send fast","2","","112","1","64","21","1","2","3","4","6","0","Given Stand By Monitor ","110","2014-06-03 09:23:42","112","2014-06-03 11:02:58","","","","");
INSERT INTO complaint VALUES("2756","MIS-0000852","CRP-03 unable to send mail to gmail","high priority","3","","8","1","40","12","1","3","3","5","","","","65","2014-06-03 09:29:36","8","2014-06-12 17:14:04","","","","");
INSERT INTO complaint VALUES("2757","Maintenance-0001904","O2 CYLINDER IS EMPTY IN THE TROLLEY","O2 CYLINDER IS EMPTY IN THE TROLLEY","7","","29","1","53","","2","7","3","5","","","","119","2014-06-03 09:34:42","29","2014-06-03 16:36:38","","","","");
INSERT INTO complaint VALUES("2758","Maintenance-0001905","SINK TO BE FIXED, EMERGENCY","SINK TO BE FIXED, EMERGENCY","6","","32","1","53","129","2","6","3","5","","","","119","2014-06-03 09:40:45","32","2014-06-03 16:33:10","","","","");
INSERT INTO complaint VALUES("2759","MIS-0000853","Costing Report  for Bus10, Bus 9, & Sal 2 system","Please give the option for above system","3","","6","1","41","","1","3","3","5","11","","Bus 10 &  bus 09 updated ","361","2014-06-03 09:43:17","6","2014-06-03 12:07:09","","","","");
INSERT INTO complaint VALUES("2760","MIS-0000854","ACCPAC NOT UPDATED IN SAL -02 SYSTEM(BENNY\'S)","ACCPAC NOT UPDATED IN SAL -02 SYSTEM(BENNY\'S)","3","","8","1","39","","1","3","3","5","","","","349","2014-06-03 09:46:01","8","2014-06-03 12:05:02","","","","");
INSERT INTO complaint VALUES("2761","Maintenance-0001906","Suction not working.","This was repaired last week but still it is not working.
INSERT INTO complaint VALUES("2762","Maintenance-0001907","SWITCH BOARD IS NOT WORKING (EMERGENCY)","PLEASE SEND FAST","5","","23","1","64","24","2","5","3","5","","","","110","2014-06-03 09:59:18","23","2014-06-03 16:26:57","","","","");
INSERT INTO complaint VALUES("2763","Maintenance-0001908","Diet prints are not coming in the system to be checked ","urgent ","","","227","1","65","","2","11","3","7","","","null","84","2014-06-03 10:03:22","84","2014-06-03 10:03:22","","","","");
INSERT INTO complaint VALUES("2764","Maintenance-0001909","new pipe  line to be connected","near the chamber","6","","30","1","16","172","2","6","3","5","","","","150","2014-06-03 10:23:18","30","2014-06-05 15:48:14","","","","");
INSERT INTO complaint VALUES("2765","Maintenance-0001910","Aluminum door removed from the old OT side ,but the adjacent area cement work pending.
INSERT INTO complaint VALUES("2766","MIS-0000855","Diet prints are not coming in the system to be checked ","urgent ","3","","6","1","65","","1","3","3","7","","","","84","2014-06-03 10:33:24","84","2014-06-03 16:33:35","","","","");
INSERT INTO complaint VALUES("2767","MIS-0000856","Printer could not connect  with system n computing","Kindly do it urgently ","2","","5","1","28","","1","2","3","7","","0","","117","2014-06-03 10:33:31","117","2014-06-03 12:04:29","","","","");
INSERT INTO complaint VALUES("2768","Maintenance-0001911","door gap to be closed ","URGENT","9","","37","1","58","194","2","9","3","5","","","","122","2014-06-03 10:34:35","37","2014-06-03 16:42:51","","","","");
INSERT INTO complaint VALUES("2769","Maintenance-0001912","LDPR- patient cup board  and ward stock cup board to be painted. High risk labour room cup board door to be fixed.","needs urgent .","9","","37","1","59","","2","9","3","5","","","","116","2014-06-03 10:35:59","37","2014-06-03 16:44:10","","","","");
INSERT INTO complaint VALUES("2770","Maintenance-0001913","exhaust fan is not working.","please kindly repair as soon as possible.","5","","23","1","49","232","2","5","3","5","","","","244","2014-06-03 10:51:59","23","2014-06-09 09:01:47","","","","");
INSERT INTO complaint VALUES("2771","Maintenance-0001914","Tube light is not working","in histopathology.very urgently","5","","23","1","17","140","2","5","3","7","","","","113","2014-06-03 11:05:18","113","2014-06-05 17:53:59","","","","");
INSERT INTO complaint VALUES("2772","MIS-0000857","Dear Sir,
INSERT INTO complaint VALUES("2773","MIS-0000858","Dear Sir,
INSERT INTO complaint VALUES("2774","Maintenance-0001915","Grinder break down.","URGENT......","7","","29","1","68","93","2","7","3","3","9","","Outsource to be done ","392","2014-06-03 11:23:45","29","2014-06-03 16:38:52","","","","");
INSERT INTO complaint VALUES("2775","MIS-0000859","system problem informed to mr. uday at 9;20am","urgent","3","","8","1","77","","1","3","3","5","","","","212","2014-06-03 11:33:59","5","2014-06-03 12:31:02","","","","");
INSERT INTO complaint VALUES("2776","Maintenance-0001916","light is not working","urgent","5","","23","1","60","288","2","5","3","5","","","","103","2014-06-03 11:41:28","23","2014-06-03 16:26:37","","","","");
INSERT INTO complaint VALUES("2777","MIS-0000860","World Environment Day celebrated on 5th June ","Prepare a poster and display on Que Mgt TVs, Desktops, PC OP TVs","3","","8","1","94","37","1","3","3","7","","","","137","2014-06-03 11:47:46","137","2014-06-04 07:52:28","20140603114746_WED Poster.pptx20140603163849_World Environment Day.jpg#","","","");
INSERT INTO complaint VALUES("2778","Maintenance-0001917","UPS connected to Phoenix 100 is not providing backup.","needs attention immediately cause its a routinely used machine.","7","","27","1","17","137","2","7","3","7","","","","302","2014-06-03 11:58:47","302","2014-06-10 16:21:08","","","","");
INSERT INTO complaint VALUES("2779","MIS-0000861","Zebra printer which is using for  asset labeling is not connected with system","Purchase ( BBH-MIS-25 ) systems","2","","5","1","29","","1","2","3","7","","0","","117","2014-06-03 12:03:50","117","2014-06-03 12:26:45","","","","");
INSERT INTO complaint VALUES("2780","Maintenance-0001918","Room HDU crash cot drawer  to be checked.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-06-03 12:14:26","87","2014-06-12 12:13:48","","","","");
INSERT INTO complaint VALUES("2781","Maintenance-0001919","tap handle to be fixed ","very urgent","6","","32","1","54","","2","6","3","5","1","","Tap head spare no stock non stock to be raised  ","73","2014-06-03 12:29:35","32","2014-06-09 16:19:20","","","","");
INSERT INTO complaint VALUES("2782","MIS-0000862","To  share a printer ","Urgent ","2","","5","1","17","27","1","2","3","5","","0","","69","2014-06-03 12:33:32","5","2014-06-03 16:21:12","","","","");
INSERT INTO complaint VALUES("2783","Maintenance-0001920","Primary wash area (tubs) opp. to laundry dept is blocked.","urgent","6","","32","1","47","124","2","6","3","5","","","","149","2014-06-03 12:38:58","32","2014-06-03 16:32:29","","","","");
INSERT INTO complaint VALUES("2784","Maintenance-0001921","Male Doctor\'s Restroom- Tubelight not working ","Please change the tubelight immediately .","5","","23","1","98","","2","5","3","5","","","","151","2014-06-03 12:55:43","23","2014-06-03 16:28:19","","","","");
INSERT INTO complaint VALUES("2785","Maintenance-0001922","to give electrical connection for ceiling fan","To give electrical connection for ceiling fan","5","","23","1","18","216","2","5","3","5","","","","64","2014-06-03 13:34:03","23","2014-06-17 09:28:44","","","","");
INSERT INTO complaint VALUES("2786","MIS-0000863","1. request for installing VLC player on my system
INSERT INTO complaint VALUES("2787","MIS-0000864","personal - request","want to sell my bike, can you pls display the add on bbh connect. thanks,
INSERT INTO complaint VALUES("2788","Maintenance-0001923","In class room 2 projector lamp is not working ","it needs the projector urgently","8","","33","1","105","","2","8","3","5","","","","291","2014-06-03 15:00:37","33","2014-06-04 16:33:09","","","","");
INSERT INTO complaint VALUES("2789","Maintenance-0001924","Toilet in the girls lounge, in the academic center (above CT Scan room) is blocked.","Urgently required","6","","32","1","105","","2","6","3","5","","","","291","2014-06-03 15:03:36","32","2014-06-03 16:35:11","","","","");
INSERT INTO complaint VALUES("2790","MIS-0000865","Accpac not responding since half an hour","Very Urgent","3","","5","1","17","27","1","3","3","5","","","","294","2014-06-03 15:07:34","5","2014-06-03 16:18:37","","","","");
INSERT INTO complaint VALUES("2791","Maintenance-0001925","birthing room light is not working","needs urgent","5","","23","1","59","","2","5","3","5","","","","116","2014-06-03 15:10:26","23","2014-06-03 16:26:13","","","","");
INSERT INTO complaint VALUES("2792","Maintenance-0001926","in deluxe 3221  water   leakage in AC ","kindly do the needful for patient satisfaction  ","10","","26","1","50","","2","10","3","5","","","","126","2014-06-03 15:11:35","26","2014-06-03 16:35:34","","","","");
INSERT INTO complaint VALUES("2793","Maintenance-0001927","bed no 10 fan not working","bed no 10 fan not working","5","","23","1","53","","2","5","3","2","","","","119","2014-06-03 15:13:59","23","2014-06-03 16:25:57","","","","");
INSERT INTO complaint VALUES("2794","Maintenance-0001928","1. In room 3206 -there is no switch in plug board ,as switch is missing  & ceiling lights are not working 
INSERT INTO complaint VALUES("2795","MIS-0000866","SYSTEM AND GE SCAN MACHINE IS GETTING SHUT DOWN WHILE THE POWER IS OFF WITHOUT UPS IN SCAN 3","SYSTEM AND GE SCAN MACHINE IS GETTING SHUT DOWN WHILE THE POWER IS OFF","","","123","1","104","","1","2","3","7","","","null","70","2014-06-03 15:35:13","70","2014-06-03 15:35:13","","","","");
INSERT INTO complaint VALUES("2796","Maintenance-0001929","in 3221 door hokes is fix ,as it is removed.","kindly do the needful ","9","","37","1","50","","2","9","3","5","","","","126","2014-06-03 15:39:14","37","2014-06-05 08:24:40","","","","");
INSERT INTO complaint VALUES("2797","Maintenance-0001930","kindly rectify the water leakage through walls due to rain through project work in (3202,3221,3209)","kindly rectify ","12","","386","1","50","","2","12","3","2","","","","126","2014-06-03 15:42:22","227","2014-06-03 15:52:13","","","","");
INSERT INTO complaint VALUES("2798","Maintenance-0001931","in 3205 soap dish stand to fix as it is broken (fix a new one)","kindly do the needful","9","","37","1","50","74","2","9","3","5","","","","126","2014-06-03 15:44:54","37","2014-06-03 16:42:23","","","","");
INSERT INTO complaint VALUES("2799","Maintenance-0001932","SYSTEM AND GE SCAN MACHINE IS GETTING SHUT DOWN WHILE THE POWER IS OFF WITHOUT UPS IN SCAN 3","SYSTEM AND GE SCAN MACHINE IS GETTING SHUT DOWN WHILE THE POWER IS OFF","7","","28","1","104","","2","7","3","5","","","","70","2014-06-03 16:18:53","28","2014-06-04 16:34:18","","","","");
INSERT INTO complaint VALUES("2800","Maintenance-0001933","Calling bell is broken - \"C\" ","very urgent ","8","","33","1","65","349","2","8","3","7","","","","84","2014-06-03 16:34:14","84","2014-06-05 15:26:06","","","","");
INSERT INTO complaint VALUES("2801","Maintenance-0001934","IN SPW  IN CORRIDOR  THE EMERGENCY SYN-AGE  BOARD  ARROW MARK  DIRECTION TO CHANGE FROM RIGHT SIDE EXIT TO LEFT SIDE EXIT FOR NABH AUDIT , AS PER THE BACK EXIT IS CLOSED FOR CONSTRUCTION WORK.","KINDLY DO THE NEEDFUL AS SOON AS POSSIBLE.","9","","37","1","50","","2","9","3","5","","","","126","2014-06-03 17:26:46","37","2014-06-05 08:24:11","","","","");
INSERT INTO complaint VALUES("2802","Maintenance-0001935","CCU emergency trolley drawer is not closing. ","Please rectify it at the earliest.","9","","37","1","52","","2","9","3","7","","","","128","2014-06-04 07:43:22","128","2014-06-06 08:28:38","","","","");
INSERT INTO complaint VALUES("2803","Maintenance-0001936","AC Not functioning","AC Not functioning","10","","26","1","3","168","2","10","3","7","","","","6","2014-06-04 08:20:59","6","2014-06-10 08:53:32","","","","");
INSERT INTO complaint VALUES("2804","Maintenance-0001937","Cementing work done in 1st floor has to be made level.","URGENT........","12","","386","1","68","97","2","12","3","2","","","","392","2014-06-04 08:35:42","227","2014-06-04 08:51:53","","","","");
INSERT INTO complaint VALUES("2805","Maintenance-0001938","BED NO:8 SIDE RAILS TO BE FIXED","PLEASE RECTIFY SOON","7","","27","1","64","335","2","7","3","5","","","","110","2014-06-04 08:39:59","27","2014-06-04 13:55:12","","","","");
INSERT INTO complaint VALUES("2806","Maintenance-0001939","5 STOOLS TO BE PAINTED","PLEASE RECTIFY SOON","9","","37","1","64","","2","9","3","5","","","","110","2014-06-04 08:41:04","37","2014-06-05 12:26:16","","","","");
INSERT INTO complaint VALUES("2807","Maintenance-0001940","NURSING STATION 4 WHEEL CHAIRS BLOW TO BE FILLED SENDING TO MAINTENANCE DEPT","PLEASE RECTIFY SOON","7","","29","1","64","","2","7","3","5","","","","110","2014-06-04 08:42:33","29","2014-06-05 15:57:47","","","","");
INSERT INTO complaint VALUES("2808","MIS-0000867","Stores N computing  Printer setup is not in organized ","paper setting to be done ","2","","112","1","28","","1","2","3","5","","0","","117","2014-06-04 08:55:02","112","2014-06-04 09:31:06","","","","");
INSERT INTO complaint VALUES("2809","Maintenance-0001941","ISOLATION GRILL GATE NOT ABLE TO OPEN OR CLOSE  IT IS VERY TIGHT .","SINCE IT IS AN EMERGENCY EXIT DOOR PLEASE RECTIFY  IMMEDIATELY","7","","27","1","49","242","2","7","3","3","9","","outsource to be done","97","2014-06-04 09:08:05","27","2014-06-05 15:30:24","","","","");
INSERT INTO complaint VALUES("2810","MIS-0000868","printer setting need to change in all counter emg","printer setting need to change in all counter emg","2","","112","1","16","19","1","2","3","7","","0","","132","2014-06-04 09:17:07","132","2014-06-09 10:47:01","","","","");
INSERT INTO complaint VALUES("2811","Maintenance-0001942","Plate to be fixed to \"G\" room bathroom door","urgent ","9","","37","1","65","351","2","9","3","7","","","","84","2014-06-04 09:23:42","84","2014-06-05 15:25:40","","","","");
INSERT INTO complaint VALUES("2812","Maintenance-0001943","\"C\" room calling bell is broken ","very urgent ","8","","33","1","65","349","2","8","3","7","","","","84","2014-06-04 09:37:21","84","2014-06-05 15:26:16","","","","");
INSERT INTO complaint VALUES("2813","Maintenance-0001944","Finance dept conference room Fan making noise, please rectify the problem","Fan making noise","5","","24","1","41","","2","5","3","5","","","","361","2014-06-04 10:09:21","24","2014-06-17 10:05:28","","","","");
INSERT INTO complaint VALUES("2814","Maintenance-0001945"," Door to be painted.   Already this was informed in person to Mr. Vinod on 02.4.14 and also raised complaint on 11.4.14","Urgent","11","","21","1","47","105","2","11","3","2","","","","149","2014-06-04 10:14:35","37","2014-06-05 12:25:00","","","","");
INSERT INTO complaint VALUES("2815","Maintenance-0001946","A ROOM WINDOW MESH TO BE PUT.","A ROOM WINDOW MESH TO BE PUT","9","","37","1","61","292","2","9","3","5","","","","104","2014-06-04 10:33:46","37","2014-06-05 12:25:16","","","","");
INSERT INTO complaint VALUES("2816","Maintenance-0001947","The 2 autoclaves are not working properly, please repair it ASAP.","The 2 autoclaves are not working properly, please repair it ASAP.","7","","27","1","17","141","2","7","3","7","","","","302","2014-06-04 10:34:37","302","2014-06-10 16:21:31","","","","");
INSERT INTO complaint VALUES("2817","MIS-0000869","PRINTER IS NOT WORKING","PLEASE RECTIFY SOON","3","","5","1","64","21","1","3","3","5","","","","110","2014-06-04 10:42:52","5","2014-06-04 11:42:11","","","","");
INSERT INTO complaint VALUES("2818","Maintenance-0001948","the name plate of the auditorium has fallen down it needs to be fixed,","Complaint received through mail on June 04, 2014 10:15 AM","9","","37","1","27","","2","9","3","3","9","","welding work out source work to be done","16","2014-06-04 10:50:26","37","2014-06-05 08:22:36","","","","");
INSERT INTO complaint VALUES("2819","Maintenance-0001949","1.cot
INSERT INTO complaint VALUES("2820","Maintenance-0001950","Boys hostel main door mesh has torn, it also needs to be fixed","complaint received through mail on June 04, 2014 10:15 AM","9","","37","1","27","","2","9","3","7","","","","16","2014-06-04 10:51:02","16","2014-06-17 12:20:35","","","","");
INSERT INTO complaint VALUES("2821","Maintenance-0001951","aquaguard water leaking in front of opd lab","urgent","6","","31","1","77","","2","6","3","5","9","","company person to be done","212","2014-06-04 10:51:22","31","2014-06-05 15:35:25","","","","");
INSERT INTO complaint VALUES("2822","Maintenance-0001952","Toilet light is not working in our department.","complaint received through mail on June 04, 2014 10:15 AM","5","","22","1","27","","2","5","3","7","","","","16","2014-06-04 10:51:45","16","2014-06-17 12:20:27","","","","");
INSERT INTO complaint VALUES("2823","Maintenance-0001953","Fans  to be fixed in new house for DNB doctors  at Vinayak nagar 2nd corss","complaint received through mail on June 04, 2014 10:15 AM","5","","22","2","27","","2","5","3","7","","","","16","2014-06-04 10:52:34","16","2014-06-17 12:20:19","","","","");
INSERT INTO complaint VALUES("2824","Maintenance-0001954","Their is a leakage of water near the aqua guard which is located in front of the opd lab.","Kindly do the needful as soon as possible.","6","","31","1","17","153","2","6","3","5","9","","company person to be done","96","2014-06-04 10:55:02","31","2014-06-05 16:06:43","","","","");
INSERT INTO complaint VALUES("2825","MIS-0000870","Printer is not working","urgent","2","","112","1","56","","1","2","3","5","","0","","121","2014-06-04 10:55:37","112","2014-06-04 11:02:39","","","","");
INSERT INTO complaint VALUES("2826","Maintenance-0001955","Vegetable cutter is giving shock","urgent","5","","22","1","68","93","2","5","3","7","","","","365","2014-06-04 10:55:53","365","2014-06-11 12:14:01","","","","");
INSERT INTO complaint VALUES("2827","Maintenance-0001956","wheelchair to be repaired","wheelchair to be repaired","7","","27","1","53","","2","7","3","5","","","","119","2014-06-04 11:01:11","27","2014-06-05 15:31:29","","","","");
INSERT INTO complaint VALUES("2828","Maintenance-0001957","install the new plug point in the counter","install the new plug point in the counter","5","","24","1","16","172","2","5","3","7","","","","132","2014-06-04 11:04:10","132","2014-06-09 10:47:13","","","","");
INSERT INTO complaint VALUES("2829","Maintenance-0001958","Nurse call system is making noise ","very urgent ","8","","33","1","65","","2","8","3","7","","","","84","2014-06-04 11:22:35","84","2014-06-05 15:26:42","","","","");
INSERT INTO complaint VALUES("2830","MIS-0000871","kindly rectify in deluxe system-01 finding error in sending a mail to nursing office , general store & nabh  as the mail returns to the sender .","kindly do the needful for nabh work pending ","3","","5","1","50","","1","3","3","5","","","","126","2014-06-04 11:27:00","5","2014-06-04 14:01:56","","","","");
INSERT INTO complaint VALUES("2831","Maintenance-0001959","bathroom is bloked","very urgent","6","","31","1","114","","2","6","3","5","","","","73","2014-06-04 11:44:58","31","2014-06-04 16:28:48","","","","");
INSERT INTO complaint VALUES("2832","Maintenance-0001960","Closed trolley wheels to be repaired.","URGENT.","7","","27","1","84","","2","7","3","5","","","","351","2014-06-04 11:56:00","27","2014-06-04 13:53:52","","","","");
INSERT INTO complaint VALUES("2833","Maintenance-0001961","Flush not working in the toilet (disabled people )","urgent","6","","31","1","47","116","2","6","3","5","","","","149","2014-06-04 12:23:15","31","2014-06-04 13:44:45","","","","");
INSERT INTO complaint VALUES("2834","Maintenance-0001962","room no 1508 cot side rails to be fixed, it has removed","come immediately","7","","29","1","49","229","2","7","3","3","9","","out source work to be done","97","2014-06-04 12:44:18","29","2014-06-05 10:26:03","","","","");
INSERT INTO complaint VALUES("2835","Maintenance-0001963","Phone is not working","Urgent","8","","33","1","60","277","2","8","3","5","","","","263","2014-06-04 12:56:06","33","2014-06-04 16:32:17","","","","");
INSERT INTO complaint VALUES("2836","Maintenance-0001964","in pc counter tube light replace","in pc counter tube light replace","5","","22","1","16","171","2","5","3","5","","","","132","2014-06-04 13:37:15","22","2014-06-04 16:25:23","","","","");
INSERT INTO complaint VALUES("2837","Maintenance-0001965","Qtrs.Dr.Alex house tap is leaking","attend soon","6","","31","3","2","","2","6","3","7","","","","225","2014-06-04 13:39:33","225","2014-06-06 08:50:47","","","","");
INSERT INTO complaint VALUES("2838","Maintenance-0001966","phone  is not working","make it fast","8","","33","1","60","277","2","8","3","5","","","","264","2014-06-04 13:50:46","33","2014-06-04 16:32:02","","","","");
INSERT INTO complaint VALUES("2839","Maintenance-0001967","blokage in washing area.","urgent","6","","30","1","56","","2","6","3","5","9","","Sink to be changed hence outsource to be done ","73","2014-06-04 14:42:33","30","2014-06-23 13:32:43","","","","");
INSERT INTO complaint VALUES("2840","Maintenance-0001968","K-ROOM BED NO :2 BED SIDE RAILS  IS NOT WORKING (EMERGENCY)","PLEASE SEND FAST","7","","27","1","64","","2","7","3","5","","","","110","2014-06-04 15:24:48","27","2014-06-05 10:24:40","","","","");
INSERT INTO complaint VALUES("2841","Maintenance-0001969","2 Autoclave   not  working .","URGENT","7","","27","1","17","137","2","7","3","2","","","","69","2014-06-04 15:57:59","27","2014-06-05 15:32:29","","","","");
INSERT INTO complaint VALUES("2842","Maintenance-0001970","CCU Emergency trolley drawer is broken.Please rectify it at the earliest.","This is the second time i am raising complaint please do it ASAP as it is very important.","7","","28","1","52","","2","7","3","7","","","","128","2014-06-04 16:02:13","128","2014-06-06 08:28:03","","","","");
INSERT INTO complaint VALUES("2843","Maintenance-0001971","Room J,G,C,E,B,F, bath room tap water leakages to be checked and nurses room gazer is is not working to be checked.  ","as soon as possible.","6","","31","1","63","","2","6","3","7","","","","87","2014-06-04 16:31:02","87","2014-06-09 11:36:41","","","","");
INSERT INTO complaint VALUES("2844","Maintenance-0001972","room I -1 calling bell is not working to be checked.","as soon as possible.","8","","34","1","63","","2","8","3","7","","","","87","2014-06-04 16:31:56","87","2014-06-12 12:09:49","","","","");
INSERT INTO complaint VALUES("2845","Maintenance-0001973","room G bed -1 switch is not working and socket to be changed. and treatment room selling tub light is not working to be checked.","as soon as possible.","5","","24","1","63","","2","5","3","7","","","","87","2014-06-04 16:34:35","87","2014-06-12 12:10:02","","","","");
INSERT INTO complaint VALUES("2846","Maintenance-0001974","SEMI K2 SIDERAILS NOT WORKING","DO NEED FULL IME","7","","27","1","64","337","2","7","3","5","","","","322","2014-06-04 18:15:38","27","2014-06-05 10:24:23","","","","");
INSERT INTO complaint VALUES("2847","MIS-0000872","In CCU, System #2 is not working.","Can u pls help us out ASAP...","2","","112","1","52","","1","2","3","7","","0","","128","2014-06-05 07:58:26","128","2014-06-06 08:26:19","","","","");
INSERT INTO complaint VALUES("2848","Maintenance-0001975","PC ISOLATION AREA ROOM NO 1510,1511,1512 DOORS NEED SELF CLOSED DOOR SYSTEM TO BE FIXED FOR HOLDING NEGATIVE PRESSURE,AND IT IS NABH REQUIREMENT","PLEASE DO IT IMMEDIATELY","9","","37","1","49","","2","9","3","2","","","","95","2014-06-05 08:00:57","37","2014-06-05 12:21:51","","","","");
INSERT INTO complaint VALUES("2849","Maintenance-0001976","IN PC ISOLATION AREA ROOM NO1510,1511,1512 NEEDS ONE OF THE SIDE DOORS HAS HOLES NEED TO CLOSE THE HOLES WITH WOODEN PLY WOOD THIS IS ALSO IS NABH REQUIREMENT.","PLEASE DO IT IMMEDIATELY.","9","","37","1","49","","2","9","3","5","","","","95","2014-06-05 08:03:38","227","2014-06-05 08:15:13","","","","");
INSERT INTO complaint VALUES("2850","Maintenance-0001977","There are wires out in the CCU .","Can you please close it as we have audit today.","5","","24","1","52","","2","5","3","7","","","","128","2014-06-05 08:04:22","128","2014-06-06 08:25:56","","","","");
INSERT INTO complaint VALUES("2851","Maintenance-0001978","There is a crack in the wall.","Kindly look in to it & do the needful","12","","386","1","93","","2","12","3","2","","","","79","2014-06-05 08:04:37","227","2014-06-05 08:16:18","","","","");
INSERT INTO complaint VALUES("2852","Maintenance-0001979","IN PC WARD EMERGENCY GRILL GATE IS STUCK,VERY DIFFICULT TO OPEN,DURING EMERGENCY IT IS DIFFICULT,THIS IS NABH NON COMPLIANCE","NEEDED EMERGENCY RESPONSE,SINCE NEED TO CLOSE IT.","12","","386","1","49","","2","12","3","2","","","","95","2014-06-05 08:07:46","227","2014-06-05 08:15:46","","","","");
INSERT INTO complaint VALUES("2853","MIS-0000873","Adobe reader not working","URGENT","3","","112","1","76","","1","3","3","5","","","","206","2014-06-05 08:58:02","112","2014-06-05 11:24:48","","","","");
INSERT INTO complaint VALUES("2854","MIS-0000874","Salary Slip is not generating in the Old HRMS i.e. Special Scholarship ","Pls do ASAP","3","","6","1","30","","1","3","3","5","","","","148","2014-06-05 09:11:27","6","2014-06-05 09:57:30","","","","");
INSERT INTO complaint VALUES("2855","Maintenance-0001980","collapsible door is class room 2 is broken please send somebody to repair it  immediately ","immediately","9","","37","1","105","","2","9","3","5","","","","291","2014-06-05 09:20:17","37","2014-06-05 12:24:00","","","","");
INSERT INTO complaint VALUES("2856","Maintenance-0001981","Kindly do the Wooden Chair wiring ","Pls. do ASAP","9","","37","1","30","","2","9","3","2","","","","148","2014-06-05 09:20:24","227","2014-06-05 09:29:09","","","","");
INSERT INTO complaint VALUES("2857","MIS-0000875","system not working","system not working","2","","5","1","43","","1","2","3","5","6","0","system is working","223","2014-06-05 09:42:52","5","2014-06-05 17:21:15","","","","");
INSERT INTO complaint VALUES("2858","Maintenance-0001982","Library ladies staff toilet hand shower is leaking","urgent","6","","31","4","24","","2","6","3","5","","","","153","2014-06-05 09:45:50","31","2014-06-05 16:04:35","","","","");
INSERT INTO complaint VALUES("2859","Maintenance-0001983","Room \'E\' side emergency exit door tower bold to be fixed.","as soon as possible.","9","","37","1","63","","2","9","3","2","","","","87","2014-06-05 09:51:31","227","2014-06-05 10:03:06","","","","");
INSERT INTO complaint VALUES("2860","Maintenance-0001984","flusher is not working","urgent","6","","31","1","60","277","2","6","3","5","","","","103","2014-06-05 09:51:40","31","2014-06-05 16:02:50","","","","");
INSERT INTO complaint VALUES("2861","Maintenance-0001985","computer key board stand is broken","urgent","9","","37","1","60","289","2","9","3","3","1","","Keyboard channel no stock non stock raised on 04/04/2014 NS no: 80
INSERT INTO complaint VALUES("2862","Maintenance-0001986","nurses station - 1 hand wash gazer is not working to be checked. ","as soon as possible.","6","","31","1","63","","2","6","3","7","","","","87","2014-06-05 09:54:31","87","2014-06-12 12:10:19","","","","");
INSERT INTO complaint VALUES("2863","Maintenance-0001987","wash basin  pipe is broken","urgent","6","","31","1","60","287","2","6","3","5","","","","103","2014-06-05 09:55:11","31","2014-06-05 15:02:08","","","","");
INSERT INTO complaint VALUES("2864","Maintenance-0001988","F-3 & F-9 CALLING BELL IS NOT WORKING ","URGENT","8","","33","1","60","277","2","8","3","5","","","","103","2014-06-05 09:56:23","33","2014-06-10 16:03:06","","","","");
INSERT INTO complaint VALUES("2865","MIS-0000876","there is different time in tag & bill in paed 
INSERT INTO complaint VALUES("2866","Maintenance-0001989","BOILER DIESEL TANK PIPE LEAKAGE","BOILER DIESEL TANK PIPE LEAKAGE","7","","27","1","84","","2","7","3","2","","","","351","2014-06-05 10:21:51","227","2014-06-16 14:23:06","","","","");
INSERT INTO complaint VALUES("2867","Maintenance-0001990","We required one UPS power point in the dietary department, we are logging this complaint for the 3rd time, please do the needful  ","very urgently.","7","","28","1","68","","2","7","3","5","","","","392","2014-06-05 10:42:04","27","2014-06-05 15:34:35","","","","");
INSERT INTO complaint VALUES("2868","MIS-0000877","Printer is not working","Printer is not working.","3","","5","1","54","","1","3","3","5","","","","114","2014-06-05 10:48:30","5","2014-06-05 11:21:29","","","","");
INSERT INTO complaint VALUES("2869","Maintenance-0001991","pin point to be repaired","as soon as possible","5","","24","1","91","","2","5","3","5","","","","70","2014-06-05 10:49:16","24","2014-06-17 10:04:56","","","","");
INSERT INTO complaint VALUES("2870","Maintenance-0001992","wall to be painted ct scan console room","as soon as possible","11","","21","1","91","","2","11","3","2","","","","70","2014-06-05 10:53:34","21","2014-06-21 11:32:30","","","","");
INSERT INTO complaint VALUES("2871","Maintenance-0001993","screen rod to be fixed ","as soon as possible","9","","37","1","91","","2","9","3","5","","","","70","2014-06-05 11:03:04","37","2014-06-05 12:23:29","","","","");
INSERT INTO complaint VALUES("2872","Maintenance-0001994","EMERGENCY LIGHT TO BE FIXED NEAR CHAPEL STAIRCASE AREA","DURING POWER CUTS IT IS DARK","5","","24","1","89","","2","5","3","2","","","","150","2014-06-05 11:09:04","227","2014-06-05 11:53:49","","","","");
INSERT INTO complaint VALUES("2873","MIS-0000878","Update mozilla firefox so that we can receive all mail report in this system.","Urgent","2","","5","1","17","34","1","2","3","5","","0","","257","2014-06-05 11:29:41","112","2014-06-05 12:07:47","","","","");
INSERT INTO complaint VALUES("2874","MIS-0000879","mouse","mouse not working.","2","","5","1","81","","1","2","3","5","","0","","99","2014-06-05 11:37:38","5","2014-06-05 12:21:01","","","","");
INSERT INTO complaint VALUES("2875","MIS-0000880","system restart","system restart  MEDS01","3","","112","1","101","","1","3","3","5","","","","387","2014-06-05 11:49:44","112","2014-06-05 12:22:31","","","","");
INSERT INTO complaint VALUES("2876","Maintenance-0001995","X-RAY 700 MA ROOM WALL PAINTING TO BE DONE. ","X-RAY 700 MA ROOM WALL PAINTING TO BE DONE. ","11","","21","1","90","","2","11","3","5","","","","70","2014-06-05 12:01:58","21","2014-06-21 11:32:16","","","","");
INSERT INTO complaint VALUES("2877","MIS-0000881","X-RAY RECEPTION SYSTEM\'S DESKTOP BRIGHTNESS OR DARKNESS TO BE CORRECTED, PLS RECTIFY, UNABLE TO SEE THE MONITOR. ","X-RAY RECEPTION SYSTEM\'S DESKTOP BRIGHTNESS OR DARKNESS TO BE CORRECTED, PLS RECTIFY, UNABLE TO SEE THE MONITOR. ","3","","5","1","90","","1","3","3","5","","","","70","2014-06-05 12:06:46","5","2014-06-05 12:15:04","","","","");
INSERT INTO complaint VALUES("2878","Maintenance-0001996","Trolley pin has to be changed immediately. very urgent.","Very urgent.","5","","24","1","68","","2","5","3","5","","","","392","2014-06-05 12:08:11","24","2014-06-07 13:06:13","","","","");
INSERT INTO complaint VALUES("2879","Maintenance-0001997"," As informed by Dr.Philip- Please check whether the Code blue announcement is audible in all the wards.","Please do it immediately .","8","","33","1","98","","2","8","3","5","","","","151","2014-06-05 12:33:55","227","2014-06-05 12:58:14","","","","");
INSERT INTO complaint VALUES("2880","Maintenance-0001998","IN IP BILLING SYSTEM IPB-BBH-05.. SCREW IN KEYBOARD STAND HAS FALLEN DOWN","IN IP BILLING SYSTEM IPB-BBH-05.. SCREW IN KEYBOARD STAND HAS FALLEN DOWN","9","","37","1","42","","2","9","3","5","1","","Keyboard channel no stock non stock raised on 04/04/2014 NS no: 80","370","2014-06-05 13:51:33","37","2014-06-05 15:50:55","","","","");
INSERT INTO complaint VALUES("2881","Maintenance-0001999","pc opd toilet is blocked
INSERT INTO complaint VALUES("2882","Maintenance-0002000","ENT toilet (ladies)  tap leakage.","urgent","6","","30","1","76","","2","6","3","5","","","","149","2014-06-05 14:54:58","30","2014-06-05 15:48:35","","","","");
INSERT INTO complaint VALUES("2883","Maintenance-0002001","\"F-4\" bed screw pinpoint is not working ","very urgent ","5","","24","1","65","353","2","5","3","7","","","","84","2014-06-05 15:27:40","84","2014-06-12 08:18:44","","","","");
INSERT INTO complaint VALUES("2884","MIS-0000882","still the problem of tag time it is not corrected","still the problem of tag time it is not corrected","3","","6","1","16","17","1","3","3","5","","","","132","2014-06-05 15:29:15","6","2014-06-06 10:20:18","","","","");
INSERT INTO complaint VALUES("2885","Maintenance-0002002","Title is broken so get the title ready immediately with in tomorrow.","Urgent","12","","386","1","17","135","2","12","3","2","","","","257","2014-06-05 15:40:44","227","2014-06-05 16:17:36","","","","");
INSERT INTO complaint VALUES("2886","MIS-0000883","Sage Accpac is not working in blood bank.","Urgent","3","","5","1","17","31","1","3","3","5","","","","257","2014-06-05 15:41:38","5","2014-06-05 16:13:11","","","","");
INSERT INTO complaint VALUES("2887","MIS-0000884","Bus 01 (Rini) system is not working ,hanged","system hanged","3","","5","1","41","","1","3","3","5","","","","361","2014-06-05 16:06:23","5","2014-06-05 16:13:23","","","","");
INSERT INTO complaint VALUES("2888","Maintenance-0002003","There is water seepage in the CCU at bed #4 and the POP has to be repaired.","Please rectify it at the earliest.","12","","386","1","52","","2","12","3","2","","","","128","2014-06-05 16:39:01","227","2014-06-05 16:53:58","","","","");
INSERT INTO complaint VALUES("2889","MIS-0000885","Heamatology interface is not working so pls rectify it soon","urgent","2","","5","1","17","26","1","2","3","7","","0","","113","2014-06-05 17:50:07","113","2014-06-05 18:08:30","","","","");
INSERT INTO complaint VALUES("2890","Maintenance-0002004","hematology tlies to replaced in lab 2 floor so pls rectify it soon  ","urgent","12","","386","1","17","135","2","12","1","2","","","","113","2014-06-05 17:51:34","113","2014-06-10 17:25:13","","","","");
INSERT INTO complaint VALUES("2891","Maintenance-0002005","blood bank a/c is liking so pls rectify it soon ","urgent","10","","26","1","17","142","2","10","3","7","","","","113","2014-06-05 17:53:20","113","2014-06-06 17:18:19","","","","");
INSERT INTO complaint VALUES("2892","Maintenance-0002006","water  drops leking wallside ","water  drops leking wallside ","6","","31","1","16","171","2","6","3","5","9","","Outsource to be done ","132","2014-06-06 07:57:58","31","2014-06-21 11:30:08","","","","");
INSERT INTO complaint VALUES("2893","Maintenance-0002007","endoscopy room full of rain water ","kindly do the necessary repair","6","","31","1","112","","2","6","3","5","","","","217","2014-06-06 08:07:18","31","2014-06-07 12:41:30","","","","");
INSERT INTO complaint VALUES("2894","Maintenance-0002008","In CCU, there is a drawer to be repaired as it is not getting locked.","Please rectify it at the earliest.","9","","37","1","52","","2","9","3","5","","","","128","2014-06-06 08:18:01","37","2014-06-06 16:34:23","","","","");
INSERT INTO complaint VALUES("2895","Maintenance-0002009","sink tap not working ","sink tap not working ","6","","31","1","53","","2","6","3","5","","","","119","2014-06-06 08:21:35","31","2014-06-06 13:47:10","","","","");
INSERT INTO complaint VALUES("2896","Maintenance-0002010","Please rectify the POP in the CCU at bed #4 it is very bad when it rains.We have mailed and called several times but no response. ","Looking forward for the response .","12","","386","1","52","","2","12","3","2","","","","128","2014-06-06 08:24:44","227","2014-06-06 08:30:55","","","","");
INSERT INTO complaint VALUES("2897","MIS-0000886","NICU-03 SYSTEM PATIENT DIET ADVICE SCREEN NOT SHOWING","NICU-03 SYSTEM PATIENT DIET ADVICE SCREEN NOT SHOWING","3","","6","1","54","","1","3","3","5","","","","114","2014-06-06 08:26:05","6","2014-06-06 09:44:31","","","","");
INSERT INTO complaint VALUES("2898","Maintenance-0002011","one tube light is fluctuating, needs to be changed.","one tube light is fluctuating, needs to be changed.","5","","24","1","25","","2","5","3","7","","","","152","2014-06-06 08:34:23","152","2014-06-09 10:24:09","","","","");
INSERT INTO complaint VALUES("2899","MIS-0000887","Medical library - 4 system, internet is not working.","Medical library - 4 system, internet is not working.","2","","112","1","25","","1","2","3","5","","0","","152","2014-06-06 08:37:49","112","2014-06-06 10:28:11","","","","");
INSERT INTO complaint VALUES("2900","Maintenance-0002012","WATER IS BLOCKED","WATER IS BLOCKED","6","","31","1","53","","2","6","3","5","","","","119","2014-06-06 08:39:39","31","2014-06-06 11:19:40","","","","");
INSERT INTO complaint VALUES("2901","Maintenance-0002013","toilet flush is not working in MRD gents toilet.we are informing you since 4 days but it is not repaired till now,so kindly make it done soon.  ","urgent","6","","31","1","47","116","2","6","3","5","","","","149","2014-06-06 08:47:20","31","2014-06-06 11:19:25","","","","");
INSERT INTO complaint VALUES("2902","Maintenance-0002014","toilet flush is not working in MRD handycaped toilet we are informing from since 4 days.till now it is not repaired os please make it soon . ","urgent","6","","31","1","47","116","2","6","3","5","","","","149","2014-06-06 08:51:11","31","2014-06-06 11:19:14","","","","");
INSERT INTO complaint VALUES("2903","Maintenance-0002015","Fire extinguisher is broken","Urgent","9","","37","1","58","196","2","9","3","2","","","","121","2014-06-06 08:52:39","37","2014-06-07 13:07:18","","","","");
INSERT INTO complaint VALUES("2904","MIS-0000888","HP Printer not working","Thank you","2","","5","1","94","","1","2","3","5","","0","","136","2014-06-06 08:58:41","5","2014-06-06 09:39:04","","","","");
INSERT INTO complaint VALUES("2905","MIS-0000889","The system is not getting on in dietary department.","very urgent.","3","","5","1","68","","1","3","3","5","","","","392","2014-06-06 08:59:18","5","2014-06-06 09:43:07","","","","");
INSERT INTO complaint VALUES("2906","Maintenance-0002016","pROBLEM WITH THE GEASER IN THE WASH ROOM","pROBLEM WITH THE GEASER IN THE WASH ROOM","6","","31","3","108","","2","6","3","5","","","","396","2014-06-06 09:05:30","31","2014-06-07 12:40:07","","","","");
INSERT INTO complaint VALUES("2907","Maintenance-0002017","Switchboard plug pin to be fixed which is sending to the maintenance dept","urgent","5","","24","1","58","195","2","5","3","5","","","","121","2014-06-06 09:18:02","24","2014-06-06 16:28:45","","","","");
INSERT INTO complaint VALUES("2908","Maintenance-0002018","splint","need 100 splint.","9","","37","1","81","","2","9","3","5","","","","99","2014-06-06 09:22:05","37","2014-06-06 16:34:05","","","","");
INSERT INTO complaint VALUES("2909","Maintenance-0002019","BED NO:4 SIDE RAILS IS NOT WORKING","PLEASE RECTIFY SOON","7","","27","1","64","335","2","7","3","5","","","","110","2014-06-06 09:25:55","27","2014-06-07 07:52:58","","","","");
INSERT INTO complaint VALUES("2910","Maintenance-0002020","I-ROOM AND B-ROOM TOILET TAPS ARE LEAKING","PLEASE RECTIFY SOON","6","","31","1","64","336","2","6","3","5","","","","110","2014-06-06 09:26:50","31","2014-06-06 11:22:06","","","","");
INSERT INTO complaint VALUES("2911","Maintenance-0002021","D-ROOM PATIENT CALLING BELL IS NOT WORKING","PLEASE RECTIFY SOON","8","","33","1","64","","2","8","3","5","","","","110","2014-06-06 09:27:44","33","2014-06-10 16:02:50","","","","");
INSERT INTO complaint VALUES("2912","Maintenance-0002022","signage board to be fixed.","as early as possible","9","","37","1","62","310","2","9","3","5","","","","106","2014-06-06 09:55:28","37","2014-06-06 16:33:11","","","","");
INSERT INTO complaint VALUES("2913","Maintenance-0002023","fans and lights are not working in academic center (above CT scan)","students needs it urgently","5","","24","1","105","","2","5","3","5","","","","291","2014-06-06 09:56:30","24","2014-06-06 16:28:24","","","","");
INSERT INTO complaint VALUES("2914","Maintenance-0002024","Lights are not working in Medical school ","urgent
INSERT INTO complaint VALUES("2915","Maintenance-0002025","one of the window mesh to be fixed","it is fallen down","9","","37","1","62","309","2","9","3","3","9","","Major work outsource to be done ","106","2014-06-06 10:11:26","37","2014-06-07 13:08:25","","","","");
INSERT INTO complaint VALUES("2916","Maintenance-0002026","curtain & Rods.","This is regarding safety issues in the wards which has to be immediately rectified by 7th June 2014 following are:-
INSERT INTO complaint VALUES("2917","Maintenance-0002027","patient cot.","all cots need to do servicing & repair.","7","","27","1","81","","2","7","3","3","9","","Outsource vendor to be done hence quotation under progress follow up from Ravi varghese","98","2014-06-06 10:19:39","27","2014-06-07 07:52:43","","","","");
INSERT INTO complaint VALUES("2918","Maintenance-0002028","marvellauv pureit water to be checked.","as soon as possible.","6","","31","1","63","","2","6","3","7","9","","Battery to be replace hence complaint raised to Pure it customer care to come & replace the battery ","87","2014-06-06 10:33:31","87","2014-06-25 13:05:34","","","","");
INSERT INTO complaint VALUES("2919","Maintenance-0002029","\"B\" room bathroom door is not closing properly ","urgent ","9","","37","1","65","348","2","9","3","7","","","","84","2014-06-06 10:41:53","84","2014-06-12 08:18:14","","","","");
INSERT INTO complaint VALUES("2920","MIS-0000890","Receiving quota warning message continuously in spite of deleting 2years mails","Receiving quota warning message continuously in spite of deleting 2years mails","3","","5","1","45","","1","3","3","5","","","","92","2014-06-06 10:42:35","5","2014-06-06 11:33:03","","","","");
INSERT INTO complaint VALUES("2921","Maintenance-0002030","Speaker has been taken from Nursing office but not yet replaced. We are unable to hear any announcement.","Speaker has been taken from Nursing office but not yet replaced. We are unable to hear any announcement.","8","","33","1","45","","2","8","3","5","","","","92","2014-06-06 10:46:47","33","2014-06-24 15:21:10","","","","");
INSERT INTO complaint VALUES("2922","MIS-0000891","In  accpac GRN and other printout setting to be done ","Printout  are landscape with lanes to be rectified","3","","5","1","28","","1","3","3","5","11","","checking","117","2014-06-06 10:56:26","5","2014-06-09 12:15:20","","","","");
INSERT INTO complaint VALUES("2923","MIS-0000892","Nursing Educators room near delux- To install new monitor and printer","Nursing Educators room near delux- To install new monitor and printer","2","","5","1","45","","1","2","3","5","","0","","93","2014-06-06 10:57:40","5","2014-06-06 11:33:45","","","","");
INSERT INTO complaint VALUES("2924","Maintenance-0002031","NURSES STATION -2 SINK IS BLOCKED","CLEARED","6","","31","1","63","","2","6","3","5","","","","110","2014-06-06 11:03:53","31","2014-06-06 13:45:39","","","","");
INSERT INTO complaint VALUES("2925","Maintenance-0002032","TOILET IS BLOCKED","CLEARED","6","","31","1","64","331","2","6","3","5","","","","110","2014-06-06 11:04:18","31","2014-06-06 11:18:42","","","","");
INSERT INTO complaint VALUES("2926","MIS-0000893","Mouse is not working","In haematology urgent.","2","","112","1","17","26","1","2","3","7","","0","","113","2014-06-06 11:04:23","113","2014-06-06 17:18:06","","","","");
INSERT INTO complaint VALUES("2927","Maintenance-0002033","SWITCH BOARD TO BE REPAIRED","PLEASE RECTIFY SOON","5","","24","1","64","335","2","5","3","5","","","","110","2014-06-06 11:04:54","24","2014-06-07 13:05:27","","","","");
INSERT INTO complaint VALUES("2928","MIS-0000894","sage accpac not opening.","sage accpac not opening.","3","","112","1","81","","1","3","3","5","","","","99","2014-06-06 11:06:15","112","2014-06-06 11:39:52","","","","");
INSERT INTO complaint VALUES("2929","MIS-0000895","Consultant\'s details at PC OPD","Needs updating. Delete the names as per the list provided.","3","","8","1","89","42","1","3","3","5","","","","88","2014-06-06 11:13:23","8","2014-06-06 13:20:14","","","","");
INSERT INTO complaint VALUES("2930","Maintenance-0002034","flush is not working","please do the needful","6","","31","1","50","77","2","6","3","7","","","","181","2014-06-06 11:15:36","181","2014-06-11 00:53:16","","","","");
INSERT INTO complaint VALUES("2931","Maintenance-0002035","Male Doctor\'s Rest Room - Tube Light not working ","Please fix a tube immediately ","5","","24","1","98","","2","5","3","5","","","","151","2014-06-06 11:31:57","24","2014-06-06 16:08:08","","","","");
INSERT INTO complaint VALUES("2932","Maintenance-0002036","Permetry UPS not working ","Urgent ","7","","27","1","80","","2","7","3","3","6","","Battery is not charging hence informed to out source vendor Hykon mr Kiran ","72","2014-06-06 11:59:07","27","2014-06-07 07:54:43","","","","");
INSERT INTO complaint VALUES("2933","Maintenance-0002037","Under the System there is water in Histopathology","So Please check know immediately.","6","","31","1","17","140","2","6","3","7","","","","113","2014-06-06 12:08:54","113","2014-06-06 17:17:55","","","","");
INSERT INTO complaint VALUES("2934","Maintenance-0002038","incandescent bulb to be replaced in the wash room - new guest house","Urgent","5","","24","3","113","","2","5","3","5","","","","259","2014-06-06 12:14:22","24","2014-06-06 16:07:33","","","","");
INSERT INTO complaint VALUES("2935","Maintenance-0002039","hinge of the Glass door of the book rack to be fixed / replaced","Urgent","9","","37","3","113","","2","9","3","5","","","","259","2014-06-06 12:17:25","37","2014-06-06 13:54:50","","","","");
INSERT INTO complaint VALUES("2936","Maintenance-0002040","TV Cable connectivity lost / displays lo connection , check with the cable operator. ","Urgent","8","","34","3","113","","2","8","3","5","","","","259","2014-06-06 12:22:13","34","2014-06-10 14:23:31","","","","");
INSERT INTO complaint VALUES("2937","Maintenance-0002041","Wall Hung Board to be removed","At causualty Entrance from MRD","9","","37","1","89","","2","9","3","5","","","","150","2014-06-06 12:38:52","37","2014-06-06 16:32:09","","","","");
INSERT INTO complaint VALUES("2938","Maintenance-0002042","Sink blocked","Urgent ","6","","30","1","17","146","2","6","3","5","","","","69","2014-06-06 12:52:04","30","2014-06-07 13:10:10","","","","");
INSERT INTO complaint VALUES("2939","MIS-0000896","Location permission change to OT from dialysis for the id SUNITAE","URGENT","3","","9","1","58","","1","3","1","5","","","","121","2014-06-06 13:12:48","123","2014-06-06 13:17:56","","","","");
INSERT INTO complaint VALUES("2940","Maintenance-0002043"," Dear Madam,
INSERT INTO complaint VALUES("2941","Maintenance-0002044","Balcon frame to be fixed in bed no 1","Balcon frame to be fixed in bed no 1","7","","27","1","53","","2","7","3","5","","","","119","2014-06-06 13:26:38","27","2014-06-07 07:51:12","","","","");
INSERT INTO complaint VALUES("2942","Maintenance-0002045","please fix  the Smirithi Auditorium broad which is fallen down, I informed this matter on tues morning but still it is not fix, please do the needful ASAP  ","Thank you","9","","37","1","27","364","2","9","3","2","","","","66","2014-06-06 13:28:24","227","2014-06-06 14:05:01","","","","");
INSERT INTO complaint VALUES("2943","Maintenance-0002046","Blood Bank A/C water is leaking. Kindly come to laboratory immediately.","Urgent.","10","","26","1","17","142","2","10","3","5","","","","257","2014-06-06 13:51:54","26","2014-06-06 16:36:29","","","","");
INSERT INTO complaint VALUES("2944","Maintenance-0002047"," In side the Laminor hood light is not working ","kindly do the needful","5","","24","1","93","","2","5","3","5","","","","79","2014-06-06 13:54:01","24","2014-06-07 13:04:53","","","","");
INSERT INTO complaint VALUES("2945","Maintenance-0002048","To have a nails in the bathroom to hang the toilet brush (Rooms-A, B, C, D, E, F, G, Nurses room, Female general toilet and Male general toilet.","urgent ","9","","37","1","65","","2","9","3","2","","","","84","2014-06-06 14:29:51","37","2014-06-07 13:09:11","","","","");
INSERT INTO complaint VALUES("2946","Maintenance-0002049","mesh to be fixed ","As early as possible.","6","","30","1","56","91","2","6","3","5","9","","Major work outsource to be done ","192","2014-06-06 14:31:42","30","2014-06-23 13:29:53","","","","");
INSERT INTO complaint VALUES("2947","Maintenance-0002050","wheel chair to be repaired","sending to maintenance ","7","","27","1","64","","2","7","3","5","","","","110","2014-06-06 15:09:43","27","2014-06-07 07:50:41","","","","");
INSERT INTO complaint VALUES("2948","Maintenance-0002051","Height scale to be fixed ","Urgent ","9","","37","1","71","","2","9","3","5","","","","72","2014-06-06 15:21:43","37","2014-06-07 13:09:24","","","","");
INSERT INTO complaint VALUES("2949","Maintenance-0002052","\"A-1\" TV is not working","very urgent","8","","34","1","65","347","2","8","3","7","","","","84","2014-06-06 16:14:22","84","2014-06-12 08:17:18","","","","");
INSERT INTO complaint VALUES("2950","Maintenance-0002053","Wall seepage near male changing room , water is leaking from top","urgent","12","","386","1","58","","2","12","3","2","","","","121","2014-06-06 17:20:30","227","2014-06-07 07:44:43","","","","");
INSERT INTO complaint VALUES("2951","Maintenance-0002054","Patient shifting trolley.","siderail need to fix.","7","","27","1","81","","2","7","3","5","","","","99","2014-06-07 08:24:38","27","2014-06-07 09:44:27","","","","");
INSERT INTO complaint VALUES("2952","Maintenance-0002055","sink pipe.","water leaking .","6","","32","1","81","","2","6","3","3","1","","Foot operated valve no stock non stock raised awaiting parts ","99","2014-06-07 08:25:31","32","2014-06-07 12:59:49","","","","");
INSERT INTO complaint VALUES("2953","Maintenance-0002056","DOOR HANDLE IS BROKEN","URGENT","9","","37","1","60","278","2","9","3","5","","","","103","2014-06-07 08:26:37","37","2014-06-07 13:08:01","","","","");
INSERT INTO complaint VALUES("2954","MIS-0000897","prescription not loading ","system . phm 07/ patient mrd 261486. prescription  no 622933","3","","6","1","18","8","1","3","3","5","2","","after saving, item has been added to the pre.
INSERT INTO complaint VALUES("2955","Maintenance-0002057","in deluxe corridor ceiling round lights are blinking .(not working ) 
INSERT INTO complaint VALUES("2956","Maintenance-0002058","replacement of new valve  near to fig tree nursing school road.","replacement of new valve  near to fig tree nursing school road.","6","","32","1","99","","2","6","3","5","","","","350","2014-06-07 08:48:44","32","2014-06-07 10:20:24","","","","");
INSERT INTO complaint VALUES("2957","Maintenance-0002059","Main gate  hoarding light is not working.
INSERT INTO complaint VALUES("2958","MIS-0000898","the printer is not working unable to take print","kindly do the needful ","2","","112","1","50","","1","2","3","5","","0","","126","2014-06-07 08:55:17","112","2014-06-07 09:25:53","","","","");
INSERT INTO complaint VALUES("2959","Maintenance-0002060","nurses station - 2 slap wood to be fixed and pantry room side steel bar to be fixed.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-06-07 09:03:56","87","2014-06-09 11:31:41","","","","");
INSERT INTO complaint VALUES("2960","Maintenance-0002061","NURSES STATION-2 SINK IS LEAKING ","PLEASE RECTIFY SOON","6","","32","1","64","331","2","6","3","5","","","","110","2014-06-07 09:14:20","32","2014-06-07 10:19:39","","","","");
INSERT INTO complaint VALUES("2961","Maintenance-0002062","HAND SHOWER TO BE REPAIRED","PLEASE RECTIFY SOON","6","","32","1","64","345","2","6","3","5","","","","110","2014-06-07 09:14:56","32","2014-06-07 10:20:08","","","","");
INSERT INTO complaint VALUES("2962","Maintenance-0002063","UPS backup not working.","UPS backup not working.Please consider this on priority.","7","","27","1","18","215","2","7","3","3","9","","outsource to be done ","64","2014-06-07 09:18:52","27","2014-06-07 13:03:19","","","","");
INSERT INTO complaint VALUES("2963","Maintenance-0002064","WATER IS LEAKING FROM THE AC IN THE COLD ROOM ","PLEASE GET IT CORRECTED AS SOON AS POSSIBLE","10","","26","1","18","216","2","10","3","5","","","","64","2014-06-07 09:38:51","26","2014-06-07 13:00:57","","","","");
INSERT INTO complaint VALUES("2964","Maintenance-0002065","f-6& f-9 calling bell is not working","urgent","8","","33","1","60","277","2","8","3","5","","","","103","2014-06-07 09:47:28","33","2014-06-10 16:02:10","","","","");
INSERT INTO complaint VALUES("2965","Maintenance-0002066","i-2 calling bell is not working","urgent","8","","33","1","60","283","2","8","3","5","","","","103","2014-06-07 09:48:27","33","2014-06-10 16:02:27","","","","");
INSERT INTO complaint VALUES("2966","MIS-0000899","x-ray CR room system getting  shutdown on and off, please rectify.","x-ray CR room system getting  shutdown on and off, please rectify.","2","","112","1","90","","1","2","3","5","","0","","70","2014-06-07 09:50:37","112","2014-06-07 10:09:16","","","","");
INSERT INTO complaint VALUES("2967","Maintenance-0002067","X-RAY RECEPTION PHONE NOT WORKING, EXTENSION NO 575. PLS RECTIFY","X-RAY RECEPTION PHONE NOT WORKING, EXTENSION NO 575. PLS RECTIFY","8","","33","1","90","","2","8","3","5","","","","70","2014-06-07 09:51:49","33","2014-06-07 11:03:49","","","","");
INSERT INTO complaint VALUES("2968","Maintenance-0002068","In pediatric play ground fiber glass pieces,mats are lying down since two months .It is brought to your notice two times .  ","kindly do the needful as it will hurt the children while playing.","11","","21","1","79","","2","11","3","5","","","","216","2014-06-07 09:52:33","227","2014-06-07 10:00:52","","","","");
INSERT INTO complaint VALUES("2969","MIS-0000900","IPB-03, W4 COMPUTER ACCPAC NOT WORKING","IPB-03, W4 COMPUTER ACCPAC NOT WORKING
INSERT INTO complaint VALUES("2970","MIS-0000901","System to be fixed.","Very urgently","2","","9","1","17","26","1","2","3","4","5","0","where is the system?which system?","113","2014-06-07 09:59:27","123","2014-06-07 10:17:01","","","","");
INSERT INTO complaint VALUES("2971","MIS-0000902","X-RAY CR SYSTEM NOT WORKING AGAIN, PLS RECTIFY, NOT ABLE TO TAKE REPORTS","X-RAY CR SYSTEM NOT WORKING AGAIN, PLS RECTIFY, NOT ABLE TO TAKE REPORTS","2","","112","1","90","","1","2","3","5","","0","","70","2014-06-07 10:23:03","112","2014-06-09 11:07:16","","","","");
INSERT INTO complaint VALUES("2972","Maintenance-0002069","Temperature showing wrongly. ","very urgent.","10","","26","1","17","135","2","10","3","7","","","","113","2014-06-07 10:24:12","113","2014-06-10 17:24:39","","","","");
INSERT INTO complaint VALUES("2973","Maintenance-0002070","AC is not working in CCU. ","Please rectify it at the earliest.","10","","26","1","52","","2","10","3","5","","","","128","2014-06-07 10:26:51","26","2014-06-07 13:00:16","","","","");
INSERT INTO complaint VALUES("2974","Maintenance-0002071","The telephone number 418 of Dr.Philip Thomas is not working.","Please fix the issue immediately.","8","","34","1","98","","2","8","3","5","","","","151","2014-06-07 10:31:12","34","2014-06-07 12:56:56","","","","");
INSERT INTO complaint VALUES("2975","Maintenance-0002072","Male doctor\'s restroom - Switch of the tubelight not working.
INSERT INTO complaint VALUES("2976","Maintenance-0002073","hdfc swiping machine is not working","there is some issue with hdfc line","8","","33","1","44","58","2","8","3","5","","","","378","2014-06-07 10:58:48","33","2014-06-07 11:03:30","","","","");
INSERT INTO complaint VALUES("2977","MIS-0000903","kindly look this system wg4-02 .open office .org.03 software not open to be checked immediately ","as soon as possible.","3","","5","1","63","","1","3","3","7","","","","87","2014-06-07 11:27:02","87","2014-06-12 12:09:35","","","","");
INSERT INTO complaint VALUES("2978","MIS-0000904","room class room computer is not working to be checked.","as soon as possible.","2","","112","1","63","","1","2","3","7","","0","","87","2014-06-07 11:31:18","87","2014-06-09 11:31:00","","","","");
INSERT INTO complaint VALUES("2979","Maintenance-0002074","oxygen cylinder pressure low","as soon as possible","7","","27","1","91","","2","7","3","5","","","","70","2014-06-07 11:56:19","27","2014-06-07 13:03:00","","","","");
INSERT INTO complaint VALUES("2980","Maintenance-0002075","AC remote is not working","urgent","10","","26","1","65","347","2","10","3","7","","","","84","2014-06-09 07:25:07","84","2014-06-12 08:16:53","","","","");
INSERT INTO complaint VALUES("2981","MIS-0000905","There is a mail which is not able to open. ","Looks like some settings are changed can you please help us out ASAP.","3","","112","1","52","","1","3","3","5","","","","128","2014-06-09 07:44:39","112","2014-06-09 08:12:59","","","","");
INSERT INTO complaint VALUES("2982","Maintenance-0002076","Electrical Extension connection for Computer. An Extra Switch & Plug box (2 places)","Very very Urgent, Please do the Needful 
INSERT INTO complaint VALUES("2983","Maintenance-0002077","Qtrs.Dr.Rachel house toilet light not working","complaint received on 07/06/2014.2.00pm","7","","28","3","2","","2","7","3","7","","","","225","2014-06-09 08:13:40","225","2014-06-09 12:44:17","","","","");
INSERT INTO complaint VALUES("2984","MIS-0000906","w-5 ip billing cabien","printer is not working","2","","112","1","42","","1","2","3","5","","0","","372","2014-06-09 08:14:44","112","2014-06-09 08:22:56","","","","");
INSERT INTO complaint VALUES("2985","Maintenance-0002078","staff hostel geyser not working","complaint received on 07/06/2014.2.30pm","6","","30","2","2","","2","6","3","7","","","","225","2014-06-09 08:14:50","225","2014-06-09 12:43:50","","","","");
INSERT INTO complaint VALUES("2986","Maintenance-0002079","toilet sink is not working and one of the screw of soap container is loose,it has to be tightened in ENT gents toilet.","same complaint has been repeating since from last week but no action is taken.make it done urgent.","6","","30","1","47","112","2","6","3","5","","","","149","2014-06-09 08:15:05","30","2014-06-10 16:31:47","","","","");
INSERT INTO complaint VALUES("2987","Maintenance-0002080","Dear Sir/Madam,
INSERT INTO complaint VALUES("2988","Maintenance-0002081","O2 cylinder is empty","complaint received on 07/06/2014. 11.45pm","7","","29","1","64","","2","7","3","7","","","","225","2014-06-09 08:18:01","225","2014-06-09 12:40:49","","","","");
INSERT INTO complaint VALUES("2989","Maintenance-0002082","The Telephone number (418) of Dr.Philip Thomas is not working.","Please fix the issue immediately","8","","33","1","98","","2","8","3","5","","","","151","2014-06-09 08:18:03","33","2014-06-09 11:21:53","","","","");
INSERT INTO complaint VALUES("2990","Maintenance-0002083","O2 cylinder is empty","complaint received on 07/06/2014.12.00am","7","","29","1","81","","2","7","3","7","","","","225","2014-06-09 08:19:41","225","2014-06-09 12:40:36","","","","");
INSERT INTO complaint VALUES("2991","Maintenance-0002084","NURSES STATION OXYGEN TROLLEY RAISER TO BE FIXED","PLEASE RECTIFY SOON","7","","28","1","64","","2","7","3","5","","","","110","2014-06-09 08:23:43","28","2014-06-09 15:18:56","","","","");
INSERT INTO complaint VALUES("2992","Maintenance-0002085","5 STOOLS TO BE PAINTED ","SENDING TO MAINTENANCE DEPT","9","","37","1","64","","2","9","3","5","","","","110","2014-06-09 08:24:43","37","2014-06-10 16:35:17","","","","");
INSERT INTO complaint VALUES("2993","Maintenance-0002086","PATIENT CALLING BELL TO BE FIXED","PLEASE RECTIFY SOON","8","","33","1","64","334","2","8","3","5","","","","110","2014-06-09 08:25:20","33","2014-06-10 15:58:29","","","","");
INSERT INTO complaint VALUES("2994","Maintenance-0002087","J-ROOM PATIENT CALLING BELL NOT ABLE TO OFF","PLEASE RECTIFY SOON","8","","33","1","64","","2","8","3","5","","","","110","2014-06-09 08:25:56","33","2014-06-10 15:58:45","","","","");
INSERT INTO complaint VALUES("2995","Maintenance-0002088","in dlx 3204 the entrance door makes heavy and bangs hardly .","kindly rectify as soon as possible.","9","","37","1","50","73","2","9","3","5","","","","126","2014-06-09 08:28:23","37","2014-06-09 16:23:16","","","","");
INSERT INTO complaint VALUES("2996","MIS-0000907","Accpac printer  setup to be modified ","also network too slow","3","","5","1","28","","1","3","3","5","","","","117","2014-06-09 08:28:54","5","2014-06-25 14:15:20","","","","");
INSERT INTO complaint VALUES("2997","Maintenance-0002089","in dlx   unable to open narcotic cupboard","kindly do the needful ","9","","37","1","50","","2","9","3","5","","","","126","2014-06-09 08:34:59","37","2014-06-09 16:23:36","","","","");
INSERT INTO complaint VALUES("2998","Maintenance-0002090","Crash cart is not working properly.","All the drawers are stuck. Please rectify it at the earliest.","9","","37","1","52","","2","9","3","3","6","","cannot be repaired due to fibre","128","2014-06-09 08:38:58","37","2014-06-10 16:36:24","","","","");
INSERT INTO complaint VALUES("2999","MIS-0000908","pediatric O.P.D. P-3 ROOM NO. MOUSE NOT WORKING.","KINDLY DO THE NEEDFUL AS EARLY AS POSSIBLE.","2","","112","1","79","","1","2","3","5","","0","","216","2014-06-09 08:45:05","112","2014-06-09 09:39:54","","","","");
INSERT INTO complaint VALUES("3000","Maintenance-0002091","oxygen cylinder is empty","very urgent","7","","28","1","55","","2","7","3","5","","","","73","2014-06-09 09:00:33","28","2014-06-09 15:18:22","","","","");
INSERT INTO complaint VALUES("3001","Maintenance-0002092","cup board to be fixed in PICU & NICU to keep Hazardous materials","very urgent","9","","37","1","54","","2","9","3","5","","","","73","2014-06-09 09:06:00","227","2014-06-09 09:08:45","","","","");
INSERT INTO complaint VALUES("3002","Maintenance-0002093","ETO sealing machine is not working","urgent","7","","28","1","58","200","2","7","3","3","9","","outsource to be done ","131","2014-06-09 09:12:52","28","2014-06-17 12:50:04","","","","");
INSERT INTO complaint VALUES("3003","MIS-0000909","CRP-03 - Unable to update the system","high priority","3","","8","1","40","12","1","3","3","7","","","","65","2014-06-09 09:18:39","65","2014-06-11 08:38:42","","","","");
INSERT INTO complaint VALUES("3004","Maintenance-0002094","1 Computer chair -unable to raise or lower","high priority","7","","28","1","40","63","2","7","3","7","9","","waiting for AMC","65","2014-06-09 09:21:48","65","2014-06-18 12:01:30","","","","");
INSERT INTO complaint VALUES("3005","MIS-0000910","Internet is not working in medical school ","kindly do at the earliest","3","","5","1","105","","1","3","3","5","","","","291","2014-06-09 09:30:07","5","2014-06-10 12:40:20","","","","");
INSERT INTO complaint VALUES("3006","MIS-0000911","The gross amount is displayed wrong in the summary final bill
INSERT INTO complaint VALUES("3007","Maintenance-0002095","dietary gas pipe leaking","complaint received on.08/06/2014.9.10am","7","","29","1","68","","2","7","3","7","","","","225","2014-06-09 09:36:21","225","2014-06-09 12:43:25","","","","");
INSERT INTO complaint VALUES("3008","Maintenance-0002096","phone not working","complaint received on 08/06/2014 11.15am","6","","32","1","61","","2","6","3","7","","","","225","2014-06-09 09:37:30","225","2014-06-09 12:42:37","","","","");
INSERT INTO complaint VALUES("3009","MIS-0000912","install the printer","install ","3","","112","1","30","","1","3","3","5","","","","241","2014-06-09 09:38:37","112","2014-06-09 09:39:37","","","","");
INSERT INTO complaint VALUES("3010","Maintenance-0002097","Qtrs.Dr.Alex house car parking area light not working","complaint received on 08/06/2014.1.20pm","7","","29","3","2","","2","7","3","7","","","","225","2014-06-09 09:40:31","225","2014-06-09 12:42:02","","","","");
INSERT INTO complaint VALUES("3011","Maintenance-0002098","AC not working ","complaint received on 08/06/2014.4.15pm","6","","31","1","65","","2","6","3","7","","","","225","2014-06-09 09:42:31","225","2014-06-09 12:41:42","","","","");
INSERT INTO complaint VALUES("3012","Maintenance-0002099","R-3221 phone not working","complaint received on 08/06/2014 9.45pm","7","","29","1","50","","2","7","3","7","","","","225","2014-06-09 09:48:27","225","2014-06-09 12:41:15","","","","");
INSERT INTO complaint VALUES("3013","Maintenance-0002100","O2 cylinder is empty","complaint received on 08/06/2014 10.30pm","7","","29","1","52","","2","7","3","7","","","","225","2014-06-09 09:49:20","225","2014-06-09 12:40:18","","","","");
INSERT INTO complaint VALUES("3014","Maintenance-0002101","O2 cylinder is empty","complaint received on 08/06/2014 12.15am","7","","29","1","55","","2","7","3","7","","","","225","2014-06-09 09:50:50","225","2014-06-09 12:39:58","","","","");
INSERT INTO complaint VALUES("3015","MIS-0000913","MY COMPUTER COMMON SHARE FOLDER IS NOT OPENING IT IS SHOWING ERROR","PLEASE RECTIFY SOON","3","","112","1","64","21","1","3","3","5","","","","110","2014-06-09 09:51:07","5","2014-06-09 12:14:33","","","","");
INSERT INTO complaint VALUES("3016","Maintenance-0002102","O2 cylinder is empty","complaint received on 08/06/2014 11.00pm","7","","29","1","53","","2","7","3","7","","","","225","2014-06-09 09:51:39","225","2014-06-09 12:39:45","","","","");
INSERT INTO complaint VALUES("3017","Maintenance-0002103","male side sink blocked ","complaint received on 08/06/2014 10.45pm","7","","29","1","64","","2","7","3","7","","","","225","2014-06-09 09:52:32","225","2014-06-09 12:39:25","","","","");
INSERT INTO complaint VALUES("3018","Maintenance-0002104","store room tube light broken","high priority","5","","23","1","40","63","2","5","3","7","","","","65","2014-06-09 09:53:31","65","2014-06-18 12:06:22","","","","");
INSERT INTO complaint VALUES("3019","Maintenance-0002105","O2 cylinder is empty","complaint received on 08/06/20147.15am","7","","29","1","58","","2","7","3","7","","","","225","2014-06-09 09:59:46","225","2014-06-09 12:38:50","","","","");
INSERT INTO complaint VALUES("3020","Maintenance-0002106","B-room door not working","complaint received on 08/06/2014","7","","29","1","63","","2","7","3","7","","","","225","2014-06-09 10:02:42","225","2014-06-09 12:38:24","","","","");
INSERT INTO complaint VALUES("3021","Maintenance-0002107","exhaust fan not working","fan blades broken needs  to be replaced","5","","22","1","37","132","2","5","3","5","","","","150","2014-06-09 10:05:43","22","2014-06-09 16:02:43","","","","");
INSERT INTO complaint VALUES("3022","MIS-0000914","IN X-RAY CR ROOM SYSTEM IS GETTING ON AND OFF OFTEN, PLS RECTIFY IMMEDIATELY, UNABLE TO TAKE REPORTS.","IN X-RAY CR ROOM SYSTEM IS GETTING ON AND OFF OFTEN, PLS RECTIFY IMMEDIATELY, UNABLE TO TAKE REPORTS.","2","","112","1","90","","1","2","3","5","","0","","70","2014-06-09 10:11:26","112","2014-06-09 11:16:33","","","","");
INSERT INTO complaint VALUES("3023","MIS-0000915","Internet is not working from (08.06.14) yesterday evening, 4 systems.","Internet is not working from (08.06.14) yesterday evening, 4 systems.","3","","8","1","25","","1","3","3","7","","","","152","2014-06-09 10:25:44","152","2014-06-20 09:19:35","","","","");
INSERT INTO complaint VALUES("3024","MIS-0000916","Both printers not working in OPD LAB.","Urgent","2","","112","1","17","25","1","2","3","7","","0","","113","2014-06-09 10:26:49","113","2014-06-10 17:24:28","","","","");
INSERT INTO complaint VALUES("3025","Maintenance-0002108","Arm rests of 3 chairs needs to be repaired in medical school","needs to be done urgently","7","","28","1","105","","2","7","3","5","","","","291","2014-06-09 10:29:55","227","2014-06-10 12:42:27","","","","");
INSERT INTO complaint VALUES("3026","MIS-0000917","mouse is not working ","mouse is not working ","2","","5","1","16","16","1","2","3","5","","0","","132","2014-06-09 10:36:15","5","2014-06-09 11:50:54","","","","");
INSERT INTO complaint VALUES("3027","Maintenance-0002109","balgon frame to be fixed from wing -3","urgent","7","","28","1","65","347","2","7","3","7","","","","84","2014-06-09 10:41:08","84","2014-06-12 09:29:54","","","","");
INSERT INTO complaint VALUES("3028","Maintenance-0002110","phone is not working","urgent","8","","33","1","60","277","2","8","3","5","","","","103","2014-06-09 10:46:29","33","2014-06-09 16:00:49","","","","");
INSERT INTO complaint VALUES("3029","Maintenance-0002111","f-6 and f-9 and i-2 calling bell is not working","urgent","8","","33","1","60","277","2","8","3","5","","","","103","2014-06-09 10:47:23","33","2014-06-09 11:22:34","","","","");
INSERT INTO complaint VALUES("3030","Maintenance-0002112","wash basin is block","urgent","6","","30","1","60","287","2","6","3","5","","","","103","2014-06-09 10:49:02","30","2014-06-10 13:44:59","","","","");
INSERT INTO complaint VALUES("3031","Maintenance-0002113","mikes not working ","plz rectify immediately","8","","33","1","102","","2","8","3","5","","","","243","2014-06-09 10:49:25","33","2014-06-09 16:01:03","","","","");
INSERT INTO complaint VALUES("3032","Maintenance-0002114","UPS problem needs to be rectified in academic center because internet is not working from morning","needs to be done urgerntly","7","","28","1","105","","2","7","3","5","","","","291","2014-06-09 10:57:21","28","2014-06-09 16:34:43","","","","");
INSERT INTO complaint VALUES("3033","Maintenance-0002115","AC problem water leakage.(urgent acquirement)","AC problem water leakage.(urgent acquirement)","10","","26","1","51","259","2","10","3","7","","","","314","2014-06-09 11:13:59","314","2014-06-10 13:46:11","","","","");
INSERT INTO complaint VALUES("3034","MIS-0000918","PRINTER NOT WORKING CASH COUNTER 4","PRINTER NOT WORKING CASH COUNTER 4","2","","112","1","44","362","1","2","3","5","","0","","384","2014-06-09 11:25:35","112","2014-06-09 12:20:47","","","","");
INSERT INTO complaint VALUES("3035","MIS-0000919","unable to operate to open the files in zimbra under g sunitha  Id ( 02739)","kindly rectify as soon as possible ","3","","5","1","50","","1","3","3","5","","","","126","2014-06-09 11:26:47","5","2014-06-09 12:14:00","","","","");
INSERT INTO complaint VALUES("3036","MIS-0000920","NICU  computer -02 is not working.","very very urgent","3","","5","1","55","","1","3","3","5","","","","73","2014-06-09 11:32:49","5","2014-06-09 12:14:10","","","","");
INSERT INTO complaint VALUES("3037","Maintenance-0002116","Suction is not working","To be rectifide","7","","28","1","53","","2","7","3","5","","","","140","2014-06-09 11:36:44","28","2014-06-09 16:33:18","","","","");
INSERT INTO complaint VALUES("3038","Maintenance-0002117","Inside the tube light dust has to be cleaned.","do the needful asap.","5","","22","1","33","","2","5","3","5","","","","96","2014-06-09 11:49:19","22","2014-06-21 11:09:28","","","","");
INSERT INTO complaint VALUES("3039","Maintenance-0002118","Door stopper needs to be put for the doors of classrooms in medical school (front of library 2 class rooms)","needs to be done urgently","9","","37","1","105","","2","9","3","5","","","","291","2014-06-09 11:50:29","37","2014-06-09 16:24:55","","","","");
INSERT INTO complaint VALUES("3040","Maintenance-0002119","nurse call system is not working (all the rooms)","urgent ","8","","34","1","65","353","2","8","3","7","","","","84","2014-06-09 11:50:35","84","2014-06-12 08:16:36","","","","");
INSERT INTO complaint VALUES("3041","Maintenance-0002120","Some of the places the wires are visible needs tob be covered ","not properly covered","5","","23","1","62","316","2","5","3","5","","","","106","2014-06-09 11:58:17","23","2014-06-21 11:03:46","","","","");
INSERT INTO complaint VALUES("3042","Maintenance-0002121","medicine trolley damaged","request to weld ASAP as we need to trolley the medicines","7","","28","1","18","216","2","7","3","5","","","","64","2014-06-09 12:04:53","28","2014-06-10 16:05:15","","","","");
INSERT INTO complaint VALUES("3043","Maintenance-0002122","Toilet near the quality office light is not working ","Pls get the new bulb","5","","23","1","26","","2","5","3","7","","","","76","2014-06-09 12:07:49","76","2014-06-11 10:48:02","","","","");
INSERT INTO complaint VALUES("3044","Maintenance-0002123","All OT\'s A/C Temperature and humidity is showing high Please come and rectify","Urgent","10","","26","1","58","192","2","10","3","5","","","","121","2014-06-09 12:08:59","26","2014-06-09 15:52:16","","","","");
INSERT INTO complaint VALUES("3045","Maintenance-0002124","nurses station - 1 slap wood screw coming out to be fixed.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-06-09 12:13:14","87","2014-06-12 12:09:19","","","","");
INSERT INTO complaint VALUES("3046","Maintenance-0002125","fixing of t.v "," to be fixed in the patient waiting  area in the out patient pharmacy","8","","33","1","18","216","2","8","3","5","","","","64","2014-06-09 12:19:56","33","2014-06-09 16:00:13","","","","");
INSERT INTO complaint VALUES("3047","Maintenance-0002126","CT Scan Class Room -Computer not getting switched on.Please check what is the issue.","Please rectify the issue immediately. ","7","","28","1","98","","2","7","3","5","","","","151","2014-06-09 12:42:39","28","2014-06-09 16:33:54","","","","");
INSERT INTO complaint VALUES("3048","Maintenance-0002127","Unable to fix the paper in the NST machine in the PC OPD.","From 9/6/14 the above problem accrued. ","7","","28","1","102","","2","7","3","5","","","","250","2014-06-09 12:52:57","227","2014-06-09 13:01:21","","","","");
INSERT INTO complaint VALUES("3049","MIS-0000921","Printer is not working","Urgent","2","","5","1","58","","1","2","3","5","","0","","121","2014-06-09 12:53:53","5","2014-06-09 13:02:13","","","","");
INSERT INTO complaint VALUES("3050","Maintenance-0002128","ENT micro debrider foot pedal is not working","Urgent","6","","30","1","58","190","2","6","3","3","1","","Foot operated valve non stock non stock raised awaiting parts ","121","2014-06-09 12:55:13","227","2014-06-09 13:05:43","","","","");
INSERT INTO complaint VALUES("3051","Maintenance-0002129","Internet is not working in Medical Library, MIS informed that maintenance has to check, please rectify the problem.","Internet is not working in Medical Library, MIS informed that maintenance has to check, please rectify the problem.","7","","28","1","25","","2","7","3","7","","","","152","2014-06-09 12:56:16","152","2014-06-20 09:19:15","","","","");
INSERT INTO complaint VALUES("3052","Maintenance-0002130","In the PC OPD  the 4 chairs are loosened and they are badly shaking while sitting in the patients waiting area.   ","Several times Complaint has been raised but still concerned staff has not taken any initiative. ","7","","28","1","102","","2","7","3","5","","","","250","2014-06-09 12:59:46","227","2014-06-10 12:36:48","","","","");
INSERT INTO complaint VALUES("3053","Maintenance-0002131","Electrical wires to be arranged (beading) in the tailoring room.","Very urgent.","5","","23","1","115","360","2","5","3","5","1","","no stock of casing pipe","149","2014-06-09 13:45:50","23","2014-06-21 11:04:18","","","","");
INSERT INTO complaint VALUES("3054","Maintenance-0002132","tube light not working medical opd mics are not working","urgent","5","","23","1","77","","2","5","3","5","","","","212","2014-06-09 13:51:50","23","2014-06-09 16:05:03","","","","");
INSERT INTO complaint VALUES("3055","Maintenance-0002133","IN DELUXE 3213 THE SINK IS BLOCKED ","KINDLY DO THE NEEDFUL AS SOON AS [POSSIBLE TOP RECEIVE THE PATIENT.","6","","32","1","50","","2","6","3","5","","","","126","2014-06-09 14:00:50","32","2014-06-09 16:17:52","","","","");
INSERT INTO complaint VALUES("3056","Maintenance-0002134","fan is not working","urgent","5","","23","1","71","166","2","5","3","5","","","","72","2014-06-09 14:01:24","23","2014-06-09 16:05:25","","","","");
INSERT INTO complaint VALUES("3057","Maintenance-0002135","IN DELUXE ROOM 3205  NEED WHITE PAINT PATCH WORK IN BATHROOM ,ABOVE THE GEYSER  IN 3205 AS THERE IS BLACK PATCH  FORMRED DUE TO   WIRE BURN T","KINDLY DO THE NEEDFUL TO RECEIVE THE PATIENT. ","11","","21","1","50","","2","11","3","2","","","","126","2014-06-09 14:10:56","227","2014-06-09 14:11:57","","","","");
INSERT INTO complaint VALUES("3058","Maintenance-0002136","LDPR-B  &  Birthing Room window glass to be fixed","needs urgent","9","","37","1","59","155","2","9","3","5","","","","116","2014-06-09 14:18:37","37","2014-06-10 16:35:36","","","","");
INSERT INTO complaint VALUES("3059","Maintenance-0002137","Ramp gutter grating rectification to be done ","Fabrication work to be done through outsourced vendor","12","","386","1","2","","2","12","3","5","","","","17","2014-06-09 14:21:52","17","2014-06-09 14:23:36","","","","");
INSERT INTO complaint VALUES("3060","Maintenance-0002138","chair has broken","chair has broken","7","","28","1","16","179","2","7","3","5","9","","waiting for AMC","132","2014-06-09 14:42:26","227","2014-06-17 12:31:54","","","","");
INSERT INTO complaint VALUES("3061","Maintenance-0002139","K-ROOM BED COT SIDE RAILS IS NOT WORKING","PLEASE RECTIFY SOON","7","","28","1","64","","2","7","3","5","","","","110","2014-06-09 14:44:03","28","2014-06-09 16:32:51","","","","");
INSERT INTO complaint VALUES("3062","Maintenance-0002140","K-ROOM PATIENT CALLING BELL IS NOT WORKING","PLEASE RECTIFY SOON","8","","34","1","64","","2","8","3","5","","","","110","2014-06-09 14:44:44","34","2014-06-10 14:23:01","","","","");
INSERT INTO complaint VALUES("3063","Maintenance-0002141","Rotating chair to be repaired as hydraulic system is not working
INSERT INTO complaint VALUES("3064","Maintenance-0002142","Doctors name board to be fixed","only five  small boards","9","","37","1","89","","2","9","3","5","","","","150","2014-06-09 14:49:39","37","2014-06-10 16:34:12","","","","");
INSERT INTO complaint VALUES("3065","Maintenance-0002143","Sinks are blocked in the old students hostel","urgent","6","","32","4","107","","2","6","3","7","","","","265","2014-06-09 15:04:54","265","2014-06-16 09:30:23","","","","");
INSERT INTO complaint VALUES("3066","Maintenance-0002144","There is no water supply.","In cathlab no water suppy in the washing area. Pls rectify it ASAP.","6","","32","1","52","62","2","6","3","5","","","","128","2014-06-09 15:22:09","32","2014-06-09 16:16:58","","","","");
INSERT INTO complaint VALUES("3067","MIS-0000922","keyboard","keyboard not working properly.kindly change the keyboard.","2","","5","1","81","","1","2","3","5","","0","","99","2014-06-09 16:21:11","5","2014-06-09 16:51:34","","","","");
INSERT INTO complaint VALUES("3068","Maintenance-0002145","MOpd.Information centre.ENT opd.MRD  no power supply","MOpd.Information centre.ENT opd.MRD  no power supply","5","","23","1","2","","2","5","3","7","","","","225","2014-06-09 16:28:44","225","2014-06-14 09:09:59","","","","");
INSERT INTO complaint VALUES("3069","Maintenance-0002146","Accpac is not opening ","in lab OPF very urgent","8","","33","1","17","","2","8","3","7","","","","113","2014-06-09 17:58:12","113","2014-06-10 17:24:13","","","","");
INSERT INTO complaint VALUES("3070","Maintenance-0002147","side wooden wall is broken.pls cme immdtly.","side wooden wall is broken","9","","37","1","96","","2","9","3","5","","","","357","2014-06-10 07:48:10","37","2014-06-10 16:33:21","","","","");
INSERT INTO complaint VALUES("3071","Maintenance-0002148","change the rexine sheet of bed.","pls change the rexine sheet of bed
INSERT INTO complaint VALUES("3072","MIS-0000923","Network problem and interface not working 
INSERT INTO complaint VALUES("3073","MIS-0000924","World Blood donors Day is celebrated on 14th June","Design a poster and display on Que Mgt. TVs, PC OP TV and Desktops","3","","8","1","94","37","1","3","3","7","","","","137","2014-06-10 08:21:07","137","2014-06-19 12:39:50","20140610082107_WBDD Poster.pptx","","","");
INSERT INTO complaint VALUES("3074","MIS-0000925","FOR X-RAY CR ROOM SYSTEM, NEEDS A STAND BY, PLEASE REPLACE AS WE ARE UNABLE TO TAKE REPORTS.","FOR X-RAY CR ROOM SYSTEM, NEEDS A STAND BY, PLEASE REPLACE AS WE ARE UNABLE TO TAKE REPORTS.","2","","8","1","90","","1","2","3","5","","0","","70","2014-06-10 08:22:39","8","2014-06-23 09:03:32","","","","");
INSERT INTO complaint VALUES("3075","MIS-0000926","Fathers Day is celebrated on 15th June","Design a poster to be displayed on Que Mgt. TVs, PC OP TV and Desktops ","3","","8","1","94","37","1","3","3","7","","","","137","2014-06-10 08:24:17","137","2014-06-19 12:38:10","20140610082417_father39s-day-source2 (2).jpg","","","");
INSERT INTO complaint VALUES("3076","MIS-0000927","W-4 IPB CABIEN","PRINTER NOT WORKING","2","","112","1","42","","1","2","3","5","","0","","372","2014-06-10 08:28:48","112","2014-06-10 09:13:01","","","","");
INSERT INTO complaint VALUES("3077","MIS-0000928","system -2 mouse is not working due to loose connection .","pls rectify as soon as posible","2","","112","1","50","","1","2","3","5","","0","","125","2014-06-10 08:35:44","112","2014-06-10 09:02:47","","","","");
INSERT INTO complaint VALUES("3078","MIS-0000929","system -1 mouse is not working ","pls rectify as soon as possible. and pls ignore  previous complaint","2","","112","1","50","","1","2","3","5","","0","","125","2014-06-10 08:40:38","112","2014-06-10 09:02:30","","","","");
INSERT INTO complaint VALUES("3079","Maintenance-0002149","Ac is not working ","utgent","10","","26","1","65","347","2","10","3","7","","","","84","2014-06-10 08:45:08","84","2014-06-12 08:08:29","","","","");
INSERT INTO complaint VALUES("3080","Maintenance-0002150","Floor tiles to be re done near the  main gate w -6","as soon as possible","12","","386","1","65","","2","12","3","2","","","","84","2014-06-10 08:48:20","227","2014-06-10 10:06:40","","","","");
INSERT INTO complaint VALUES("3081","Maintenance-0002151","The network Switch located in House Keeping  is not getting power supply. ","Pls rectify fast the entire support services will not have network connection without this","8","","33","1","3","","2","8","3","7","","","","6","2014-06-10 08:56:31","6","2014-06-13 08:57:36","","","","");
INSERT INTO complaint VALUES("3082","Maintenance-0002152","1515 bathroom flush is not working","please do it immediately","6","","30","1","49","","2","6","3","5","","","","95","2014-06-10 08:56:42","30","2014-06-10 13:42:15","","","","");
INSERT INTO complaint VALUES("3083","Maintenance-0002153","fire extinguisher to be fixed ","as soon as possible","9","","37","1","91","","2","9","3","5","","","","70","2014-06-10 08:57:36","37","2014-06-10 16:33:54","","","","");
INSERT INTO complaint VALUES("3084","Maintenance-0002154","wheel chair.","wheel chair pedal broken need to fix.","7","","28","1","81","","2","7","3","5","","","","99","2014-06-10 09:04:51","28","2014-06-10 16:26:35","","","","");
INSERT INTO complaint VALUES("3085","Maintenance-0002155","AC is not working","pls rectify  as soon as posible","10","","26","1","50","74","2","10","3","5","","","","125","2014-06-10 09:05:27","26","2014-06-10 16:29:01","","","","");
INSERT INTO complaint VALUES("3086","Maintenance-0002156","sign board.","sign board need to fix.","9","","37","1","81","","2","9","3","5","","","","99","2014-06-10 09:06:26","37","2014-06-10 16:34:31","","","","");
INSERT INTO complaint VALUES("3087","Maintenance-0002157","3206 -patient cot -wheel break is not working","this is patient safety - please do the needful","7","","28","1","50","75","2","7","3","3","6","","wheel is missing in user department","125","2014-06-10 09:09:11","28","2014-06-10 16:06:59","","","","");
INSERT INTO complaint VALUES("3088","Maintenance-0002158","pin point to be replaced","as soon as possible","5","","24","1","91","","2","5","3","5","","","","70","2014-06-10 09:29:45","24","2014-06-10 16:30:48","","","","");
INSERT INTO complaint VALUES("3089","MIS-0000930","Bar code not working In IP section","Urgent","3","","5","1","17","34","1","3","3","5","","","","257","2014-06-10 09:35:18","5","2014-06-10 11:49:49","","","","");
INSERT INTO complaint VALUES("3090","MIS-0000931","Barcodes are not reading from any of the printers.","Urgent","2","","5","1","17","27","1","2","3","5","","0","","294","2014-06-10 09:44:20","5","2014-06-10 11:50:00","","","","");
INSERT INTO complaint VALUES("3091","MIS-0000932","ACC- PAC report for emergency surgery does not contain bill no, mrd no and name of the patient.","high priority this report is needed for doctors\' PRR","3","","5","1","39","","1","3","3","5","","","","349","2014-06-10 09:48:42","5","2014-06-10 12:40:53","","","","");
INSERT INTO complaint VALUES("3092","Maintenance-0002159","Door swing required for maindoor in out patient pharmacy.","immediately","9","","37","1","18","216","2","9","3","3","1","","door closer no stock","64","2014-06-10 09:58:37","37","2014-06-10 16:36:59","","","","");
INSERT INTO complaint VALUES("3093","MIS-0000933","Labour room  out look express is not working","needs urgent","3","","5","1","59","","1","3","3","5","","","","116","2014-06-10 10:11:40","112","2014-06-10 10:23:37","","","","");
INSERT INTO complaint VALUES("3094","Maintenance-0002160","student hostel drainage blocked","complaint received on 09/06/2014  5.30pm","6","","32","2","2","","2","6","3","7","","","","225","2014-06-10 10:22:03","225","2014-06-14 09:11:59","","","","");
INSERT INTO complaint VALUES("3095","MIS-0000934","Please install Savior attendance software in MRD- 08 system","Please install Savior attendance software in MRD- 08 system","3","","8","1","16","","1","3","3","5","","","","129","2014-06-10 10:23:55","8","2014-06-12 17:16:38","","","","");
INSERT INTO complaint VALUES("3096","Maintenance-0002161","staff hostel light not working","complaint  received on 09/06/2014  6.00pm","5","","25","2","2","","2","5","3","7","","","","225","2014-06-10 10:24:03","225","2014-06-14 09:11:47","","","","");
INSERT INTO complaint VALUES("3097","Maintenance-0002162","Men\'s hostel Dr.Asha room flush not working","complaint received on 09/06/2014   6.45pm","6","","32","2","2","","2","6","3","7","","","","225","2014-06-10 10:26:08","225","2014-06-14 09:11:36","","","","");
INSERT INTO complaint VALUES("3098","Maintenance-0002163","O2 cylinder is empty","complaint received on 09/06/2014","7","","29","1","52","","2","7","3","7","","","","225","2014-06-10 10:27:47","225","2014-06-14 09:09:05","","","","");
INSERT INTO complaint VALUES("3099","Maintenance-0002164","O2 cylinder is empty","complaint received on 09/06/2014","7","","29","1","53","","2","7","3","7","","","","225","2014-06-10 10:28:31","225","2014-06-14 09:08:47","","","","");
INSERT INTO complaint VALUES("3100","Maintenance-0002165","O2 cylinder is empty","complaint received on 09/06/2014","7","","29","1","61","","2","7","3","7","","","","225","2014-06-10 10:29:27","225","2014-06-14 09:08:31","","","","");
INSERT INTO complaint VALUES("3101","Maintenance-0002166","O2 cylinder is empty","complaint received on 09/06/2014","7","","29","1","81","","2","7","3","7","","","","225","2014-06-10 10:30:11","225","2014-06-14 09:08:18","","","","");
INSERT INTO complaint VALUES("3102","MIS-0000935","crp-02 System is hanging","high priority","2","","112","1","40","","1","2","3","5","","0","","313","2014-06-10 10:30:17","112","2014-06-10 11:04:45","","","","");
INSERT INTO complaint VALUES("3103","Maintenance-0002167","Phone hand set  is not working please come and rectify the problem very soon. ","URGENT","8","","33","1","68","","2","8","3","5","","","","392","2014-06-10 10:31:17","33","2014-06-10 16:00:47","","","","");
INSERT INTO complaint VALUES("3104","Maintenance-0002168","Room G bath room hand wash sink blacked to be checked .","as soon as possible.","6","","30","1","63","","2","6","3","7","","","","87","2014-06-10 10:39:26","87","2014-06-12 12:08:31","","","","");
INSERT INTO complaint VALUES("3105","Maintenance-0002169","OT-2 vaccum pressure is low to be checked ","complaint through on call by sis nisha","7","","28","1","58","","2","7","3","7","","","","227","2014-06-10 10:41:30","227","2014-06-17 12:19:53","","","","");
INSERT INTO complaint VALUES("3106","Maintenance-0002170","BSNL  phone is not working","urgent","8","","33","4","107","","2","8","3","7","6","","BSNL company person to be done","265","2014-06-10 10:43:01","265","2014-06-21 07:44:41","","","","");
INSERT INTO complaint VALUES("3107","Maintenance-0002171","Flush water continues flowing to be stopped ","complaint through on call ","6","","30","1","49","229","2","6","3","7","","","","227","2014-06-10 10:43:47","227","2014-06-17 12:19:43","","","","");
INSERT INTO complaint VALUES("3108","Maintenance-0002172","NURSE CALL SYSTEM IS NOT SHOWING THE BED NUMBER","URGENT","8","","33","1","65","","2","8","3","7","9","","out source work to be done","84","2014-06-10 10:46:24","84","2014-06-16 08:30:26","","","","");
INSERT INTO complaint VALUES("3109","Maintenance-0002173","fan regulat0r cap to put all rooms.","urgently.","5","","24","1","73","","2","5","3","3","1","","MK regulator no stock","211","2014-06-10 10:46:47","24","2014-06-11 16:14:38","","","","");
INSERT INTO complaint VALUES("3110","Maintenance-0002174","fan not working ","rectify soon","5","","24","1","44","58","2","5","3","7","","","","227","2014-06-10 10:52:21","227","2014-06-17 12:19:33","","","","");
INSERT INTO complaint VALUES("3111","MIS-0000936","Please give us the following report - Employee list with religion report ","pls do the needful (urgent)","3","","6","1","30","","1","3","3","5","11","","Work in progress","148","2014-06-10 11:03:51","6","2014-06-12 07:58:21","","","","");
INSERT INTO complaint VALUES("3112","Maintenance-0002175","Fused 2 no of tube light","Fused 2 no of tube light","5","","25","3","70","272","2","5","3","5","","","","129","2014-06-10 11:05:59","25","2014-06-11 16:16:09","","","","");
INSERT INTO complaint VALUES("3113","MIS-0000937","printer is not working ","printer is not working ","2","","112","1","16","17","1","2","3","5","","0","","132","2014-06-10 11:07:12","112","2014-06-10 14:36:31","","","","");
INSERT INTO complaint VALUES("3114","Maintenance-0002176","\"D-1\" Calling Bell is not working","very urgent ","8","","33","1","65","","2","8","3","7","","","","84","2014-06-10 11:08:41","84","2014-06-12 08:10:19","","","","");
INSERT INTO complaint VALUES("3115","Maintenance-0002177","W-6 Computer Keyboard plate is broken to be fixed ","urgent ","9","","37","1","65","","2","9","3","7","","","","84","2014-06-10 11:10:19","84","2014-06-12 08:08:08","","","","");
INSERT INTO complaint VALUES("3116","MIS-0000938","W1 Maternity-F12,B/O Lakshmamma  AA261432 .Received  at 11.05am on 09/06/14 from NICU,but still yesterday it is showing,NICU,not in bassinet,for periodric bill it shows NICU,kindly do the needful. ","Urgent","3","","6","1","60","","1","3","3","5","","","","145","2014-06-10 11:11:15","6","2014-06-10 15:37:56","","","","");
INSERT INTO complaint VALUES("3117","Maintenance-0002178","water is leaking","water is leaking","6","","30","1","23","253","2","6","3","5","","","","80","2014-06-10 11:28:40","30","2014-06-10 13:43:31","","","","");
INSERT INTO complaint VALUES("3118","MIS-0000939","Seshadri sir\'s mail to external IDs bounces,,  We receive their mail but cannot reply to them.","We receive undelivered notice, few ids are : vanitha.ramachandran@rcap.co.in, baptistcorporate@gmail.com","3","","8","1","34","","1","3","3","5","","","","173","2014-06-10 11:33:47","8","2014-06-11 16:35:03","","","","");
INSERT INTO complaint VALUES("3119","Maintenance-0002179","no power supply","attend soon","5","","24","1","68","","2","5","3","7","","","","225","2014-06-10 11:35:28","225","2014-06-14 09:11:24","","","","");
INSERT INTO complaint VALUES("3120","MIS-0000940","printer is not working properly","kindly do the needful","3","","5","1","93","","1","3","3","5","","","","79","2014-06-10 11:36:15","5","2014-06-10 12:06:06","","","","");
INSERT INTO complaint VALUES("3121","Maintenance-0002180","fan is not working","needs to be repaired","5","","24","1","62","309","2","5","3","5","","","","106","2014-06-10 11:38:32","24","2014-06-10 16:30:20","","","","");
INSERT INTO complaint VALUES("3122","Maintenance-0002181","Mesh blocked in staff toilet","Urgent","6","","30","1","47","","2","6","3","5","","","","149","2014-06-10 11:41:20","30","2014-06-10 13:48:13","","","","");
INSERT INTO complaint VALUES("3123","Maintenance-0002182","The telephone(315)of the Medical Secretary\'s Office is not working.","Please fix the issue immediately","8","","34","1","98","","2","8","3","5","","","","151","2014-06-10 11:54:13","34","2014-06-10 14:22:49","","","","");
INSERT INTO complaint VALUES("3124","Maintenance-0002183","Ref. token number 2063 which was raised on saturday, 7th june. This has to be done immediately as it will effect the smooth functioning of the IP pharmacy.","UPS backup not working. Each time power goes the whole system is shut down.","7","","28","1","18","215","2","7","3","5","","","","64","2014-06-10 12:09:04","227","2014-06-10 12:24:21","","","","");
INSERT INTO complaint VALUES("3125","Maintenance-0002184","Female General Toilet flush water is not working ","urgent ","6","","32","1","65","359","2","6","3","7","","","","84","2014-06-10 13:36:33","84","2014-06-12 08:08:49","","","","");
INSERT INTO complaint VALUES("3126","MIS-0000941","Text report print is not printing properly. Kindly look into it immediately.
INSERT INTO complaint VALUES("3127","MIS-0000942","unable to take print out ","kindly rectify the issue","2","","112","1","18","7","1","2","3","5","","0","","64","2014-06-10 13:56:47","112","2014-06-10 15:05:51","","","","");
INSERT INTO complaint VALUES("3128","Maintenance-0002185","We have been logged compliant many times  regarding that we required one ups connection in dietary dept "," So do the needful as soon as possible.
INSERT INTO complaint VALUES("3129","MIS-0000943","print not coming in standby printers.","print not coming in standby printers.","2","","112","1","18","7","1","2","3","5","","0","","64","2014-06-10 14:35:47","112","2014-06-10 15:05:26","","","","");
INSERT INTO complaint VALUES("3130","MIS-0000944","Diet system number 4, sage accap is not working.","Very urgent.","3","","5","1","68","","1","3","3","5","","","","392","2014-06-10 14:59:34","5","2014-06-10 15:01:32","","","","");
INSERT INTO complaint VALUES("3131","Maintenance-0002186","screw broken on suction apparatus","urgent","7","","28","1","76","101","2","7","3","5","","","","206","2014-06-10 15:01:46","28","2014-06-11 16:19:21","","","","");
INSERT INTO complaint VALUES("3132","Maintenance-0002187","Urinal sink blocked","urgent","6","","30","1","47","108","2","6","3","5","","","","149","2014-06-10 15:39:46","30","2014-06-11 11:44:14","","","","");
INSERT INTO complaint VALUES("3133","Maintenance-0002188","Total Painting to be done. Dishwash area, potwash area, gas area, cooking area, vegetable cutting area, diet setting area.","Very urgent.","11","","21","1","68","93","2","11","3","2","","","","392","2014-06-10 15:51:49","227","2014-06-11 07:39:00","","","","");
INSERT INTO complaint VALUES("3134","Maintenance-0002189","CCU needs to painted as there are water seepage marks on the walls in the nurses\' station and lobby.","Please rectify it at the earliest.","11","","21","1","52","","2","11","3","2","","","","128","2014-06-10 15:59:13","227","2014-06-11 07:38:20","","","","");
INSERT INTO complaint VALUES("3135","MIS-0000945","sage accpac is not opening in icu system 2","sage accpac is not opening in icu system 2","3","","5","1","53","","1","3","3","5","","","","119","2014-06-10 15:59:24","5","2014-06-10 16:02:52","","","","");
INSERT INTO complaint VALUES("3136","Maintenance-0002190","The toilet door to be repaired.","Very Very urgent","9","","37","1","47","114","2","9","3","5","","","","149","2014-06-10 16:05:37","37","2014-06-12 16:34:17","","","","");
INSERT INTO complaint VALUES("3137","Maintenance-0002191","Total painting to be done.
INSERT INTO complaint VALUES("3138","Maintenance-0002192","1. Dietary Doors has to replaced
INSERT INTO complaint VALUES("3139","Maintenance-0002193","in deluxe 3206 the light is not working near the wash basin ( its  blinking )","kindly do the needful as soon as  possible . ","5","","23","1","50","","2","5","3","5","","","","126","2014-06-10 16:18:51","23","2014-06-11 16:22:11","","","","");
INSERT INTO complaint VALUES("3140","Maintenance-0002194","in deluxe 3216 the vacuum stand screw to fix as it is removed.
INSERT INTO complaint VALUES("3141","Maintenance-0002195","in deluxe room (3202, 3212, 3215, 3216, 3220, 3221)  fungal formation are formed as  water stains on third floor  due to rain and construction work ","kindly rectify and do the needful. ","11","","21","1","50","","2","11","3","2","","","","126","2014-06-10 16:30:40","227","2014-06-11 08:01:40","","","","");
INSERT INTO complaint VALUES("3142","Maintenance-0002196","Manual table to be repaired ","Urgent","7","","28","1","58","193","2","7","3","5","","","","121","2014-06-10 16:35:11","28","2014-06-12 16:20:24","","","","");
INSERT INTO complaint VALUES("3143","Maintenance-0002197","Exhaust fan has to be cleaned.","Very urgent.","5","","22","1","68","93","2","5","3","3","9","","out source work to be done","392","2014-06-10 16:41:30","22","2014-06-11 16:28:45","","","","");
INSERT INTO complaint VALUES("3144","Maintenance-0002198","1. Diet Setting area - Mesh grill has to  be painted.
INSERT INTO complaint VALUES("3145","MIS-0000946","wing 1 E-Room calling bell to be repaied","make it fast","","","123","1","60","","1","3","3","7","","","null","264","2014-06-11 06:52:08","264","2014-06-11 06:52:08","","","","");
INSERT INTO complaint VALUES("3146","MIS-0000947","Printer is not working. Plz come now itself.","Urgent","2","","112","1","17","25","1","2","3","5","","0","","257","2014-06-11 07:41:05","112","2014-06-11 08:43:18","","","","");
INSERT INTO complaint VALUES("3147","Maintenance-0002199","wing -1 semi E-room  calling bell is not working ","Make it fast","8","","33","1","60","","2","8","3","5","","","","264","2014-06-11 07:55:42","33","2014-06-11 16:21:07","","","","");
INSERT INTO complaint VALUES("3148","Maintenance-0002200","IN X-RAY CR ROOM TILES IS BROKEN, PLS RECTIFY","IN X-RAY CR ROOM TILES IS BROKEN, PLS RECTIFY","12","","386","1","90","","2","12","3","2","","","","70","2014-06-11 08:10:05","227","2014-06-11 08:17:51","","","","");
INSERT INTO complaint VALUES("3149","MIS-0000948","IN CT SCAN RECEPTION, KEYBOARD IS NOT WORKING","IN CT SCAN RECEPTION, KEYBOARD IS NOT WORKING","2","","112","1","91","","1","2","3","5","","0","","70","2014-06-11 08:10:39","112","2014-06-11 08:43:00","","","","");
INSERT INTO complaint VALUES("3150","MIS-0000949","kindly look this diet advice entry  printout patient diagnosis not coming to be checked  this system name .1.wg4-01,2. wg4-02, 3.wg4-03, ","as soon as possible.","3","","6","1","63","","1","3","3","7","","","","87","2014-06-11 08:11:36","87","2014-06-19 10:22:08","","","","");
INSERT INTO complaint VALUES("3151","MIS-0000950","Interfacing not working.Bar codes are not read .","Urgent ","3","","5","1","17","27","1","3","3","5","","","","69","2014-06-11 08:11:48","5","2014-06-11 10:02:09","","","","");
INSERT INTO complaint VALUES("3152","MIS-0000951","x-ray reception system often getting shutdown.","x-ray reception system often getting shutdown.","3","","5","1","90","","1","3","3","5","","","","70","2014-06-11 08:24:32","5","2014-06-11 10:01:56","","","","");
INSERT INTO complaint VALUES("3153","Maintenance-0002201","Arm board to be repaired","Urgent","7","","27","1","58","189","2","7","3","5","","","","121","2014-06-11 08:27:33","227","2014-06-11 08:40:53","","","","");
INSERT INTO complaint VALUES("3154","Maintenance-0002202","DOUBLE SURFACE PHOTOTHARAPHY LIGHTS IS NOT WOKING","URGENT","7","","28","1","60","277","2","7","3","5","","","","103","2014-06-11 09:00:34","28","2014-06-11 16:19:41","","","","");
INSERT INTO complaint VALUES("3155","Maintenance-0002203","Torch  light is not working","needs urgent","7","","28","1","59","","2","7","3","5","","","","116","2014-06-11 09:18:10","28","2014-06-17 12:49:44","","","","");
INSERT INTO complaint VALUES("3156","Maintenance-0002204","doctors room door lock repaired","coplaint received on 10/06/2014  11.30pm","7","","29","1","62","","2","7","3","7","","","","225","2014-06-11 09:25:43","225","2014-06-14 09:11:13","","","","");
INSERT INTO complaint VALUES("3157","Maintenance-0002205","campus side one street light not working","complaint received on 10/06/2014  12.30am","7","","29","2","2","","2","7","3","7","","","","225","2014-06-11 09:27:25","225","2014-06-14 09:10:20","","","","");
INSERT INTO complaint VALUES("3158","Maintenance-0002206","wing 1 E-Room calling bell to be repaied","make it fast","8","","33","1","60","","2","8","3","5","","","","264","2014-06-11 09:29:14","33","2014-06-11 16:21:20","","","","");
INSERT INTO complaint VALUES("3159","MIS-0000952","Opt - 3 System\'s internet explorer is not working","Urgent","3","","5","1","58","","1","3","3","5","","","","121","2014-06-11 09:40:48","5","2014-06-11 10:33:41","","","","");
INSERT INTO complaint VALUES("3160","Maintenance-0002207","patient cot.","patient cot broken need to do repair.","7","","28","1","81","","2","7","3","5","","","","99","2014-06-11 09:48:01","28","2014-06-11 16:18:24","","","","");
INSERT INTO complaint VALUES("3161","Maintenance-0002208","Incubator  door rubber to be changed as the door is opening off frequently and the temp not maintained .Urgent ","Very Urgent 
INSERT INTO complaint VALUES("3162","Maintenance-0002209","There is a small hole in the hematology which has to be  closed .      
INSERT INTO complaint VALUES("3163","Maintenance-0002210","laundry box to be repaired","please rectify soon","9","","37","1","64","338","2","9","3","5","","","","110","2014-06-11 10:06:33","37","2014-06-11 16:09:51","","","","");
INSERT INTO complaint VALUES("3164","MIS-0000953","Dear Sir,
INSERT INTO complaint VALUES("3165","MIS-0000954","Outlook express not working","Please rectify it ASAP","3","","112","1","98","","1","3","3","5","","","","151","2014-06-11 10:43:54","112","2014-06-11 10:50:20","","","","");
INSERT INTO complaint VALUES("3166","MIS-0000955","ct console room key board not working","as soon as possible","2","","112","1","91","","1","2","3","5","","0","","70","2014-06-11 10:45:19","112","2014-06-11 10:48:56","","","","");
INSERT INTO complaint VALUES("3167","MIS-0000956","INSTALLATION","Kindly install BBH connect in the CT Scan class room","3","","8","1","26","","1","3","3","7","","","","76","2014-06-11 10:47:35","76","2014-06-17 17:33:49","","","","");
INSERT INTO complaint VALUES("3168","Maintenance-0002211","NURSES STATION 5 STOOLS TO BE PAINTED","SENDING TO MAINTENANCE","9","","37","1","64","","2","9","3","5","","","","110","2014-06-11 11:09:17","37","2014-06-11 16:10:27","","","","");
INSERT INTO complaint VALUES("3169","Maintenance-0002212","Doctor Stool borken","The bottom rest is broken.","7","","28","1","78","","2","7","3","5","","","","197","2014-06-11 11:13:47","28","2014-06-11 16:18:59","","","","");
INSERT INTO complaint VALUES("3170","Maintenance-0002213","AC TEMPERATURE MONITOR IS SHOWING HIGH 
INSERT INTO complaint VALUES("3171","MIS-0000957","computer in p-6 in pediatric opd not working.","kindly do the needful.","2","","112","1","79","","1","2","3","5","","0","","216","2014-06-11 11:49:22","5","2014-06-11 12:08:03","","","","");
INSERT INTO complaint VALUES("3172","Maintenance-0002214","1. Dish wash area 2 tables to be covered with aluminium sheet.
INSERT INTO complaint VALUES("3173","MIS-0000958","CRP-03 unable to login for net
INSERT INTO complaint VALUES("3174","Maintenance-0002215","Greaser not working in pot wash area.","Very urgent.","6","","31","1","68","","2","6","3","3","1","","no stock item","392","2014-06-11 12:11:25","31","2014-06-11 16:23:32","","","","");
INSERT INTO complaint VALUES("3175","MIS-0000959","wire/plug to upload information is broken.","urgent, as no upload was done today.","2","","112","1","68","","1","2","3","5","","0","","365","2014-06-11 12:20:50","5","2014-06-11 13:07:18","","","","");
INSERT INTO complaint VALUES("3176","Maintenance-0002216","patient toilet.","patient toilet blocked ,water not going properly.","6","","31","1","81","","2","6","3","5","","","","99","2014-06-11 12:34:06","31","2014-06-11 16:23:54","","","","");
INSERT INTO complaint VALUES("3177","Maintenance-0002217","Light not working ","very Urgent","5","","24","1","47","113","2","5","3","5","","","","149","2014-06-11 12:36:33","24","2014-06-11 16:13:37","","","","");
INSERT INTO complaint VALUES("3178","MIS-0000960","Internet is not working in Library. Please rectify immediately.","Internet is not working in Library. Please rectify immediately.","3","","8","1","25","","1","3","3","7","","","","152","2014-06-11 12:39:04","152","2014-06-20 09:18:46","","","","");
INSERT INTO complaint VALUES("3179","Maintenance-0002218","ROTATING CHAIR\'S BACK SUPPORT HAD FALLEN","ROTATING CHAIR\'S BACK SUPPORT HAD FALLEN","7","","28","1","104","","2","7","3","5","","","","70","2014-06-11 12:45:48","227","2014-06-12 15:28:08","","","","");
INSERT INTO complaint VALUES("3180","Maintenance-0002219","Greasing to be done for closed trolley wheels.
INSERT INTO complaint VALUES("3181","Maintenance-0002220","Window mesh to be fixed properly(it became loose )
INSERT INTO complaint VALUES("3182","Maintenance-0002221","In pediatric opd room no.7 wall fan\'s wing broken. not working.  ","kindly do the needful.","5","","23","1","79","","2","5","3","5","","","","216","2014-06-11 13:36:44","23","2014-06-12 16:11:11","","","","");
INSERT INTO complaint VALUES("3183","Maintenance-0002222","Tubelight is blinking","Tubelight is blinking","5","","22","1","54","221","2","5","3","5","","","","114","2014-06-11 13:50:05","22","2014-06-12 16:06:34","","","","");
INSERT INTO complaint VALUES("3184","MIS-0000961","Patient name: Kiran Kumar, MRD No: AA261980.
INSERT INTO complaint VALUES("3185","MIS-0000962","to shift the printer from counter to PHM-05","shifting of printer","2","","112","1","18","7","1","2","3","5","","0","","64","2014-06-11 14:25:47","112","2014-06-11 14:57:00","","","","");
INSERT INTO complaint VALUES("3186","Maintenance-0002223","IN PEDIATRIC OPD INJECTION ROOM ROOF FUNGAL INFECTION IS PRESENT .","KINDLY DO THE NEEDFUL.","12","","386","1","79","","2","12","3","5","","","","216","2014-06-11 14:25:52","227","2014-06-18 11:55:59","","","","");
INSERT INTO complaint VALUES("3187","Maintenance-0002224","BED NO:E-1 SWITCH BOARD TO BE REPAIRED","PLEASE RECTIFY SOON","5","","25","1","64","333","2","5","3","5","1","","no stock","321","2014-06-11 14:56:16","25","2014-06-17 09:25:49","","","","");
INSERT INTO complaint VALUES("3188","Maintenance-0002225","B.Sc Hostel: Wash basin has to be fixed 
INSERT INTO complaint VALUES("3189","Maintenance-0002226","In the CCU, the crash cart drawer is broken and able to fix it back.","Please rectify it ASAP as it is URGENT.","7","","28","1","52","","2","7","3","2","","","","128","2014-06-11 15:21:04","227","2014-06-11 15:32:34","","","","");
INSERT INTO complaint VALUES("3190","Maintenance-0002227","AC water leaking from night","Urgent","10","","26","1","17","147","2","10","3","5","","","","257","2014-06-12 07:44:55","26","2014-06-12 16:25:37","","","","");
INSERT INTO complaint VALUES("3191","MIS-0000963","add tax class 3% in accpac ","Urgent","3","","9","1","29","","1","3","1","5","","","","356","2014-06-12 07:52:03","123","2014-06-12 08:15:10","","","","");
INSERT INTO complaint VALUES("3192","Maintenance-0002228","AC water leaking ","night duty complaint given by Ravikumar ","10","","26","1","17","","2","10","3","5","","","","29","2014-06-12 07:54:10","227","2014-06-12 08:02:55","","","","");
INSERT INTO complaint VALUES("3193","Maintenance-0002229","Geyser not working ","complaint given by night duty Ravikumar","6","","30","1","50","71","2","6","3","5","","","","29","2014-06-12 07:54:46","30","2014-06-13 16:57:21","","","","");
INSERT INTO complaint VALUES("3194","Maintenance-0002230","Cupboard lock to be fixed ","complaint given by night duty Mr Ravikumar","9","","37","1","102","","2","9","3","5","","","","29","2014-06-12 07:55:27","37","2014-06-12 09:36:30","","","","");
INSERT INTO complaint VALUES("3195","Maintenance-0002231","Doctors room main door handle to be fixed ","complaint by night duty Mr.Ravikumar","9","","37","1","62","","2","9","3","5","","","","29","2014-06-12 07:56:08","37","2014-06-12 09:36:47","","","","");
INSERT INTO complaint VALUES("3196","Maintenance-0002232","Canteen washing area no power supply","complaint by night duty Mr.Ravikumar","5","","24","1","68","","2","5","3","5","","","","29","2014-06-12 08:01:54","24","2014-06-12 16:28:00","","","","");
INSERT INTO complaint VALUES("3197","Maintenance-0002233","LDPR- I.V.stand  to be fixed.","needs urgent","7","","28","1","59","","2","7","3","5","","","","116","2014-06-12 08:03:42","28","2014-06-13 16:43:05","","","","");
INSERT INTO complaint VALUES("3198","Maintenance-0002234","tube light in the linen store to be changed.","urgent","5","","23","1","115","","2","5","3","5","","","","149","2014-06-12 08:05:25","23","2014-06-12 16:11:45","","","","");
INSERT INTO complaint VALUES("3199","Maintenance-0002235","Nurse Call System is continuously ringing from yesterday ","very urgent ","8","","34","1","65","","2","8","3","7","","","","84","2014-06-12 08:12:46","84","2014-06-16 08:27:49","","","","");
INSERT INTO complaint VALUES("3200","Maintenance-0002236","Wing-VI Loby area Case fire glass is broken near security area.","urgent ","9","","37","1","65","","2","9","3","5","","","","84","2014-06-12 08:15:24","37","2014-06-12 16:33:49","","","","");
INSERT INTO complaint VALUES("3201","Maintenance-0002237","Handrub    stand    to  be  change.","urgent please.","9","","37","1","57","65","2","9","3","5","","","","362","2014-06-12 08:17:49","37","2014-06-12 16:33:25","","","","");
INSERT INTO complaint VALUES("3202","Maintenance-0002238","O2 cylinder is empty","complaint received on 11/06/2014  11.30pm","7","","28","1","52","","2","7","3","7","","","","225","2014-06-12 08:26:22","225","2014-06-14 09:08:05","","","","");
INSERT INTO complaint VALUES("3203","Maintenance-0002239","Nurses Station case fire and alarm Switch to be checked ","urgent ","8","","34","1","65","","2","8","3","7","","","","84","2014-06-12 08:26:54","84","2014-06-19 08:18:41","","","","");
INSERT INTO complaint VALUES("3204","Maintenance-0002240","FOOT PADLE WATER IS LEAKING","FOOT PADLE WATER IS LEAKING","6","","31","1","53","","2","6","3","3","1","","Foot operating valve no stock non stock raised ","119","2014-06-12 08:28:14","31","2014-06-13 16:37:03","","","","");
INSERT INTO complaint VALUES("3205","Maintenance-0002241","BED NO 11 SUCTION NOT WORKING","BED NO 11 SUCTION NOT WORKING","7","","28","1","53","","2","7","3","5","","","","119","2014-06-12 08:32:42","28","2014-06-12 16:17:00","","","","");
INSERT INTO complaint VALUES("3206","MIS-0000964","Respected sister,
INSERT INTO complaint VALUES("3207","Maintenance-0002242","\"F-4\" Bed Roof light is not working ","urgent","5","","25","1","65","353","2","5","3","7","","","","84","2014-06-12 08:39:22","84","2014-06-16 08:27:24","","","","");
INSERT INTO complaint VALUES("3208","Maintenance-0002243","Balcon Frame to be removed and place in Wing-3","as soon as possible","7","","28","1","65","347","2","7","3","7","","","","84","2014-06-12 08:45:34","84","2014-06-13 10:08:18","","","","");
INSERT INTO complaint VALUES("3209","Maintenance-0002244","Nurse Educators room has an inlet to the adjacent exhaust source, which is presently sealed with a mesh. Yet there is pungent offensive odor from the exhaust source. Kindly close it with a ply wood or anything convenient at the earliest.","Nurse Educators room has an inlet to the adjacent exhaust source, which is presently sealed with a mesh. Yet there is pungent offensive odor from the exhaust source. Kindly close it with a ply wood or anything convenient at the earliest.","9","","37","1","45","","2","9","3","2","","","","93","2014-06-12 08:50:16","37","2014-06-13 16:53:16","","","","");
INSERT INTO complaint VALUES("3210","Maintenance-0002245","CHAIR NOT WORKING PROPER.(ITS GOING DONE)
INSERT INTO complaint VALUES("3211","Maintenance-0002246","AC is low and patients are complaining its hot.","There is water leaking from the AC as well.","10","","26","1","52","","2","10","3","7","","","","128","2014-06-12 08:55:11","128","2014-06-16 08:11:57","","","","");
INSERT INTO complaint VALUES("3212","Maintenance-0002247","calling bell is not working","urgent","8","","34","1","60","280","2","8","3","5","","","","103","2014-06-12 08:57:55","34","2014-06-12 12:16:54","","","","");
INSERT INTO complaint VALUES("3213","Maintenance-0002248","\"B-1\" Door handle to be fixed properly","urgent ","9","","37","1","65","348","2","9","3","7","","","","84","2014-06-12 09:30:40","84","2014-06-13 10:07:56","","","","");
INSERT INTO complaint VALUES("3214","Maintenance-0002249","Kindly fix the new washbasin for the B.Sc hostel.","urgent","6","","30","4","107","","2","6","3","7","","","","265","2014-06-12 09:38:53","265","2014-06-16 09:30:00","","","","");
INSERT INTO complaint VALUES("3215","Maintenance-0002250","fly cather machine to be fixed in icu lobbey","fly cather machine to be fixed in icu lobbey","5","","24","1","53","","2","5","3","3","8","","user has to show the place to fix the fly catcher in lobby","119","2014-06-12 10:10:04","24","2014-06-13 16:50:51","","","","");
INSERT INTO complaint VALUES("3216","MIS-0000965","Dear Sir,
INSERT INTO complaint VALUES("3217","Maintenance-0002251","One tube light is not working  ","As soon as possible","5","","23","1","41","54","2","5","3","5","","","","63","2014-06-12 10:49:30","23","2014-06-12 16:12:43","","","","");
INSERT INTO complaint VALUES("3218","MIS-0000966","CD not working in the CD Drive","CD unable to play - can access whtough VNC","2","","112","1","94","37","1","2","3","5","","0","","259","2014-06-12 10:58:23","112","2014-06-12 15:01:16","","","","");
INSERT INTO complaint VALUES("3219","Maintenance-0002252","In sopd outside fan to be fix no.fan.2","urgent","5","","23","1","72","","2","5","3","3","9","","Fan wiring burnt hence outsource to be done ","219","2014-06-12 11:00:02","23","2014-06-13 16:38:37","","","","");
INSERT INTO complaint VALUES("3220","Maintenance-0002253","IN X-RAY  MAMMOGRAM ROOM A CUPBOARD TO BE SHIFTED OR REMOVED. PLS COME AS SOON AS POSSIBLE.","IN X-RAY  MAMMOGRAM ROOM A CUPBOARD TO BE SHIFTED OR REMOVED. PLS COME AS SOON AS POSSIBLE.","9","","37","1","90","","2","9","3","5","","","","70","2014-06-12 11:11:13","37","2014-06-12 16:32:23","","","","");
INSERT INTO complaint VALUES("3221","Maintenance-0002254","IN X-RAY CR ROOM MEMO NOTICE BOARD TO BE NAILED. PLS DO IT AS SOON AS POSSIBLE ","IN X-RAY CR ROOM MEMO NOTICE BOARD TO BE NAILED. PLS DO IT AS SOON AS POSSIBLE ","9","","37","1","90","","2","9","3","5","","","","70","2014-06-12 11:12:44","37","2014-06-12 16:32:10","","","","");
INSERT INTO complaint VALUES("3222","MIS-0000967","RMU Department Brochure Design given by Yorke. Kindly, OPD Timing to include Monday to Friday.Replace Foreign Girl photo with Indian preferably 3 or 4 years old.as  RMU department is 3 or 4 years old.  ","Have included RMU Department Zip given by Yorke to make required changes","3","","8","1","94","37","1","3","3","7","","","","137","2014-06-12 11:24:18","137","2014-06-13 09:06:47","20140612112418_rermudepartmentbrochurephotoupdate.zip","","","");
INSERT INTO complaint VALUES("3223","Maintenance-0002255","wheel chair.","from wheel chair geting sound...","7","","28","1","81","","2","7","3","5","","","","99","2014-06-12 11:25:09","28","2014-06-12 16:17:55","","","","");
INSERT INTO complaint VALUES("3224","Maintenance-0002256","Patient Attender Cot Bush to be placed Total No-20
INSERT INTO complaint VALUES("3225","Maintenance-0002257","Accounts dept tube light is not working","tube light is not working","5","","23","1","41","","2","5","3","5","","","","361","2014-06-12 11:32:44","227","2014-06-12 11:34:36","","","","");
INSERT INTO complaint VALUES("3226","Maintenance-0002258","Cupboard is  broken","not able to close","9","","37","1","62","315","2","9","3","5","","","","106","2014-06-12 11:40:09","37","2014-06-12 16:30:40","","","","");
INSERT INTO complaint VALUES("3227","Maintenance-0002259","One Patient Trolley Foot Peddle handle bush to be placed. Total no-2","urgent","9","","37","1","65","","2","9","3","3","11","","work under progress","84","2014-06-12 11:46:13","37","2014-06-13 16:55:56","","","","");
INSERT INTO complaint VALUES("3228","Maintenance-0002260","door screw to be fixed","to be repaired immediately","9","","37","1","102","","2","9","3","5","","","","243","2014-06-12 11:51:54","37","2014-06-12 16:29:49","","","","");
INSERT INTO complaint VALUES("3229","MIS-0000968","The TV near the staircase in the PC OPD  is not functioning. ","Since long time TV in the PC OPD is not functioning.","","","123","1","102","","1","2","3","7","","","null","243","2014-06-12 12:07:55","243","2014-06-12 12:07:55","","","","");
INSERT INTO complaint VALUES("3230","Maintenance-0002261","Room  pantry room side steel bar to be checked.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-06-12 12:12:11","87","2014-06-19 10:22:49","","","","");
INSERT INTO complaint VALUES("3231","Maintenance-0002262","PICU entrance , bed no:3 and bed no : 4 there is small cracks present in the switch board.","very urgent","5","","23","1","54","","2","5","3","5","","","","73","2014-06-12 12:57:07","23","2014-06-13 16:38:09","","","","");
INSERT INTO complaint VALUES("3232","MIS-0000969","Laptop is not connecting in Smrithi Auditorium","Laptop is not connecting in Smrithi Auditorium","3","","8","1","45","","1","3","3","5","","","","92","2014-06-12 13:02:29","8","2014-06-12 17:16:11","","","","");
INSERT INTO complaint VALUES("3233","Maintenance-0002263","The TV near the staircase in the PC OPD  is not functioning. ","Since long time TV in the PC OPD is not functioning.","8","","33","1","102","","2","8","3","5","","","","243","2014-06-12 13:39:53","33","2014-06-12 16:14:31","","","","");
INSERT INTO complaint VALUES("3234","MIS-0000970","There are two leave details for below mentioned employee contract/regular leave .
INSERT INTO complaint VALUES("3235","Maintenance-0002264","LIFT BUTTON IS NOT WORKING","LIFT BUTTON IS NOT WORKING","7","","28","1","16","177","2","7","3","5","","","","132","2014-06-12 14:23:57","28","2014-06-12 16:18:16","","","","");
INSERT INTO complaint VALUES("3236","Maintenance-0002265","sink is blocked to be repaired","please do as early as posibble","6","","31","1","102","","2","6","3","5","","","","243","2014-06-12 14:26:06","31","2014-06-12 16:10:21","","","","");
INSERT INTO complaint VALUES("3237","MIS-0000971","Printer is not working","urgent","2","","112","1","3","","1","2","3","5","","0","","149","2014-06-12 14:26:17","112","2014-06-12 15:00:54","","","","");
INSERT INTO complaint VALUES("3238","MIS-0000972","Please install windows 2010 in system Sal -02 and Sal - 04.","Please install windows 2010 in system Sal -02 and Sal - 04.","3","","5","1","39","","1","3","3","5","6","","                            ","349","2014-06-12 14:42:14","5","2014-06-23 16:39:53","","","","");
INSERT INTO complaint VALUES("3239","MIS-0000973","baljagruti some pages correction to be done.","please do the needful as early as possible.","2","","8","1","79","","1","2","3","5","","0","","216","2014-06-12 15:09:09","8","2014-06-14 12:31:19","","","","");
INSERT INTO complaint VALUES("3240","Maintenance-0002266","To put electrical connection for TV in OP patient waiting area.","To put electrical connection for TV.","5","","24","1","18","217","2","5","3","5","11","","work under progress","64","2014-06-12 16:10:12","24","2014-06-17 10:08:39","","","","");
INSERT INTO complaint VALUES("3241","Maintenance-0002267","pc ward patient calling bell\'s continusly ringing.","as soon as possible correct the calling bell.","8","","33","1","49","228","2","8","3","5","","","","244","2014-06-12 20:30:50","33","2014-06-13 16:38:57","","","","");
INSERT INTO complaint VALUES("3242","Maintenance-0002268","torch not working","torch not working","7","","28","1","61","303","2","7","3","5","","","","104","2014-06-13 08:55:19","28","2014-06-13 16:43:31","","","","");
INSERT INTO complaint VALUES("3243","Maintenance-0002269","Ac water leaking from night","Urgent","10","","26","1","17","147","2","10","3","5","","","","257","2014-06-13 08:56:54","26","2014-06-13 16:45:46","","","","");
INSERT INTO complaint VALUES("3244","Maintenance-0002270","Painting of IP Billong side entrance grill door; Duct room; Letter box outside HK staff change room; Corridor. Kindly get the said painting task before NABH. 
INSERT INTO complaint VALUES("3245","Maintenance-0002271","14 places steel bar and 4 places sponge bar to be put for safety measure.","Remainder","9","","37","1","61","","2","9","3","5","","","","104","2014-06-13 09:05:51","37","2014-06-13 16:54:09","","","","");
INSERT INTO complaint VALUES("3246","Maintenance-0002272","Cement Floor work at door steps/entrance of Gen Store Room No-3(Dist. water plant). It is broken very badly & quite dangerous  while stepping inside the store. Thanks
INSERT INTO complaint VALUES("3247","Maintenance-0002273","washing area cup board door handle and wall suction to be fixed","needs urgent","9","","37","1","59","","2","9","3","5","","","","116","2014-06-13 09:07:59","37","2014-06-13 16:53:34","","","","");
INSERT INTO complaint VALUES("3248","Maintenance-0002274","Tiles to be fixed in wing-2 entrance and near staff rest room.","Tiles to be fixed in wing-2 entrance and near staff rest room.","12","","386","1","61","306","2","12","3","2","","","","104","2014-06-13 09:09:57","227","2014-06-13 09:19:39","","","","");
INSERT INTO complaint VALUES("3249","Maintenance-0002275","door lock  and  door stopper to put in nurses room and ","oor lock  and  door stopper to put in nurses room and ","9","","37","1","61","","2","9","3","5","","","","104","2014-06-13 09:14:14","37","2014-06-13 16:54:26","","","","");
INSERT INTO complaint VALUES("3250","Maintenance-0002276","crack in A room entrance and B room fungal growth,Window mesh and glass door to be changed.","Remainder.","9","","37","1","61","292","2","9","3","5","","","","104","2014-06-13 09:19:23","37","2014-06-13 16:54:48","","","","");
INSERT INTO complaint VALUES("3251","Maintenance-0002277","Dear Madam,
INSERT INTO complaint VALUES("3252","Maintenance-0002278","All AC\'s temperature and humidity  is showing high please come and rectify. And tell them to sign in our Repair register.","Urgent","10","","26","1","58","189","2","10","3","3","11","","work under progress","121","2014-06-13 09:27:52","26","2014-06-13 16:46:19","","","","");
INSERT INTO complaint VALUES("3253","Maintenance-0002279","SKID FREE MAT TO BE REPAIR  ","SKID FREE MAT TO BE REPAIR  ","12","","386","1","74","186","2","12","3","2","","","","214","2014-06-13 09:31:07","227","2014-06-13 10:46:00","","","","");
INSERT INTO complaint VALUES("3254","Maintenance-0002280","Dear Madam,
INSERT INTO complaint VALUES("3255","Maintenance-0002281","C-5 call bell not working","As soon as possible","8","","33","1","62","309","2","8","3","5","","","","106","2014-06-13 10:02:55","33","2014-06-13 16:39:26","","","","");
INSERT INTO complaint VALUES("3256","MIS-0000974","printer not working","pls ensure its working asap","2","","112","1","95","","1","2","3","5","","0","","393","2014-06-13 10:07:45","112","2014-06-13 10:28:11","","","","");
INSERT INTO complaint VALUES("3257","Maintenance-0002282","Nurse Call System is continuously ringing ","very urgent ","8","","33","1","65","","2","8","3","7","","","","84","2014-06-13 10:09:07","84","2014-06-16 08:27:04","","","","");
INSERT INTO complaint VALUES("3258","Maintenance-0002283","To fix cupboards properly in the Utility room ","urgent ","9","","37","1","65","354","2","9","3","3","9","","Outsource to be done ","84","2014-06-13 10:10:41","37","2014-06-13 16:55:17","","","","");
INSERT INTO complaint VALUES("3259","Maintenance-0002284","wash basin is clogged.","wash basin clogged","6","","31","1","18","216","2","6","3","5","","","","64","2014-06-13 10:30:49","31","2014-06-13 16:36:36","","","","");
INSERT INTO complaint VALUES("3260","MIS-0000975","EMP. No. 06218 unable to credit the new leave
INSERT INTO complaint VALUES("3261","Maintenance-0002285","Requirement for an exhaust fan in the washing area.","complaint through mail June 12, 2014 2:47 PM","5","","24","1","17","","2","5","3","7","2","","Its new requirement it will be delayed ","227","2014-06-13 10:39:48","227","2014-06-24 14:47:34","","","","");
INSERT INTO complaint VALUES("3262","Maintenance-0002286","bath room sink taps are leaking in ’B ,C,E,F,rooms and  nurses station -01& 02  kindly check immediately.","complaint through mail June 12, 2014 12:27 PM","6","","31","1","63","","2","6","3","7","8","","user has to clarify whether to change the whole taps due to tap leaking ","227","2014-06-13 10:40:38","227","2014-06-24 14:47:25","","","","");
INSERT INTO complaint VALUES("3263","Maintenance-0002287","window mesh is torn. Informed by Sr.Epsy","complaint through mail June 12, 2014 1:33 PM","9","","37","1","60","","2","9","3","2","","","","227","2014-06-13 10:41:54","227","2014-06-13 10:47:31","","","","");
INSERT INTO complaint VALUES("3264","MIS-0000976","W-5 IPBILLING CABIEN","PRINTER IS NOT WORKING","2","","112","1","42","","1","2","3","5","","0","","372","2014-06-13 10:45:58","112","2014-06-13 10:53:02","","","","");
INSERT INTO complaint VALUES("3265","Maintenance-0002288","AC not cooking to be checked ","Complaint on call by CCTV operator","10","","26","1","70","271","2","10","3","7","","","","227","2014-06-13 10:52:29","227","2014-06-17 12:19:21","","","","");
INSERT INTO complaint VALUES("3266","MIS-0000977","Patient name : Shobha 
INSERT INTO complaint VALUES("3267","Maintenance-0002289","water is dropping from the ac unit","request you to attend at the earliest","10","","26","1","18","216","2","10","3","5","","","","64","2014-06-13 10:53:43","26","2014-06-13 16:45:57","","","","");
INSERT INTO complaint VALUES("3268","Maintenance-0002290","AC is not cooling to be checked ","complaint through call by cctv operator","10","","26","1","70","271","2","10","3","7","","","","227","2014-06-13 10:53:50","227","2014-06-17 12:19:12","","","","");
INSERT INTO complaint VALUES("3269","Maintenance-0002291","water leaking from AC pipeline","water leaking from AC pipeline.","10","","26","1","18","216","2","10","3","5","","","","64","2014-06-13 10:54:02","227","2014-06-13 10:54:58","","","","");
INSERT INTO complaint VALUES("3270","Maintenance-0002292","In psychiatric room  the call bell wires are too long it needs to be replaced.&  one of the call bell is not getting cleared.","needs to be rectified","8","","33","1","62","307","2","8","3","5","","","","106","2014-06-13 11:09:05","33","2014-06-13 16:39:15","","","","");
INSERT INTO complaint VALUES("3271","Maintenance-0002293","room no.17 fans are not working","please come immediatly","5","","24","1","49","237","2","5","3","5","","","","246","2014-06-13 11:13:30","24","2014-06-13 16:49:44","","","","");
INSERT INTO complaint VALUES("3272","Maintenance-0002294","Server  room AC\'s are not working","Server  room AC\'s are not working","10","","26","1","3","168","2","10","3","3","11","","work under progress by outsource ","6","2014-06-13 11:27:06","26","2014-06-13 16:45:28","","","","");
INSERT INTO complaint VALUES("3273","MIS-0000978","Pharmacy  sales  returns to be taken in the same location where it is purchased -as in  ORDER RETURN ENTRY. ie  location wise sales return.","There is variation in stock as the  returned items are getting mixed in both locations.","3","","9","1","18","","1","3","3","4","5","","kindly explain the requirement.This is to be get it done from \"IDMsys.","64","2014-06-13 11:41:00","123","2014-06-16 16:36:02","","","","");
INSERT INTO complaint VALUES("3274","MIS-0000979","Need to take snaps of all Drape kits recd from amaryllis","Record purpose, urgent","3","","8","1","28","","1","3","3","5","","","","117","2014-06-13 11:52:33","8","2014-06-13 12:05:19","","","","");
INSERT INTO complaint VALUES("3275","Maintenance-0002295","Tube light  to be changed at corridor 
INSERT INTO complaint VALUES("3276","Maintenance-0002296","location- S-OPD (minor OT)
INSERT INTO complaint VALUES("3277","Maintenance-0002297","Sluice room roof is leaking ","Urgent","6","","32","1","58","197","2","6","3","5","","","","121","2014-06-13 12:53:42","227","2014-06-13 15:30:56","","","","");
INSERT INTO complaint VALUES("3278","Maintenance-0002298","CHAIRS ARE NOT WORKING PROPERLY (ITS GOING DOWN) CASH COUNTER-4 NEAR CASUALTY
INSERT INTO complaint VALUES("3279","MIS-0000980","   COMPUTER PRINT IS NOT WORKING","URGENT","2","","112","1","71","","1","2","3","5","","0","","72","2014-06-13 14:25:01","112","2014-06-13 14:40:06","","","","");
INSERT INTO complaint VALUES("3280","Maintenance-0002299","X-ray Mammogram room exhaust fan not working.","X-ray Mammogram room exhaust fan not working.","5","","24","1","90","","2","5","3","2","","","","70","2014-06-13 15:14:01","24","2014-06-17 10:06:23","","","","");
INSERT INTO complaint VALUES("3281","MIS-0000981","Dear Sir / Madam,
INSERT INTO complaint VALUES("3282","MIS-0000982","PRINTER NOT WORKING CASHCOUNTER 4 NEAR CAUSALITY","PRINTER NOT WORKING CASHCOUNTER 4 NEAR CAUSALITY","2","","112","1","44","362","1","2","3","5","","0","","383","2014-06-13 15:38:10","112","2014-06-13 15:58:16","","","","");
INSERT INTO complaint VALUES("3283","MIS-0000983","Diet system 4 is not  getting on. ","VERY URGENT.....","2","","112","1","68","","1","2","3","5","","0","","392","2014-06-13 16:17:59","112","2014-06-14 08:18:59","","","","");
INSERT INTO complaint VALUES("3284","Maintenance-0002300","UPS power plug not working if power goes computer also will be off & our landline intercom telephone not working (loose connection).","Kindly correct as soon as possible.Thanks","7","","28","1","97","","2","7","3","5","","","","399","2014-06-13 16:25:22","28","2014-06-14 12:23:32","","","","");
INSERT INTO complaint VALUES("3285","MIS-0000984"," We are not able to open the BBH mail box in diet system 1 & 4 please rectify the problem.","VERY URGENT.......","3","","112","1","68","","1","3","3","5","","","","392","2014-06-13 17:40:54","112","2014-06-16 11:49:01","","","","");
INSERT INTO complaint VALUES("3286","Maintenance-0002301","near sink its leaking","kindly rectify","6","","31","1","50","73","2","6","3","5","","","","177","2014-06-13 18:12:25","31","2014-06-14 11:33:18","","","","");
INSERT INTO complaint VALUES("3287","Maintenance-0002302","room no 3221 door hook to be fixed","kindly rectify","9","","37","1","50","89","2","9","3","5","","","","177","2014-06-13 18:14:12","37","2014-06-14 12:20:09","","","","");
INSERT INTO complaint VALUES("3288","Maintenance-0002303","Weighing machine is not working","please check and caliberate
INSERT INTO complaint VALUES("3289","MIS-0000985","
INSERT INTO complaint VALUES("3290","Maintenance-0002304","FAN IS NOT WORKING","PLEASE RECTIFY SOON","5","","25","1","64","338","2","5","3","3","1","","capacitor no stock","110","2014-06-14 08:22:30","25","2014-06-14 12:16:36","","","","");
INSERT INTO complaint VALUES("3291","Maintenance-0002305","TUBELIGHT IS NOT WORKING","PLEASE RECTIFY SOON","5","","25","1","64","342","2","5","3","5","","","","110","2014-06-14 08:23:12","25","2014-06-14 12:15:21","","","","");
INSERT INTO complaint VALUES("3292","Maintenance-0002306","The projector in the CT Scan Class Room is not getting switched on.","Please look on to the issue and rectify it immediately","8","","34","1","98","","2","8","3","5","","","","151","2014-06-14 08:31:07","34","2014-06-16 16:21:16","","","","");
INSERT INTO complaint VALUES("3293","Maintenance-0002307","in deluxe pantry the cupboard door is removed apart , need to fix it ,as patient attender is unsatisfied. ","do the needful as soon as possible. ","9","","37","1","50","","2","9","3","5","","","","126","2014-06-14 08:33:46","37","2014-06-14 12:18:50","","","","");
INSERT INTO complaint VALUES("3294","Maintenance-0002308","in deluxe pantry sink blocked ","kindly rectify ","6","","31","1","50","","2","6","3","5","","","","180","2014-06-14 08:35:56","31","2014-06-14 11:33:08","","","","");
INSERT INTO complaint VALUES("3295","Maintenance-0002309","Doctors name boards needs to be re-arranged in central OPD. ","Ladder required.
INSERT INTO complaint VALUES("3296","MIS-0000986","PACS room system is not switching on in scan room","PACS room system is not switching on in scan room","2","","6","1","104","","1","2","3","5","","0","","70","2014-06-14 08:43:30","6","2014-06-16 10:05:31","","","","");
INSERT INTO complaint VALUES("3297","Maintenance-0002310","O2cylinder is empty","complaint received on 13/06/2014  11.45pm","5","","22","1","81","","2","5","3","7","","","","225","2014-06-14 08:51:00","225","2014-06-14 09:07:54","","","","");
INSERT INTO complaint VALUES("3298","Maintenance-0002311","O2 cylinder is empty","complaint received on 13/06/2014  12.00am","5","","22","1","64","","2","5","3","7","","","","225","2014-06-14 08:51:45","225","2014-06-14 09:07:42","","","","");
INSERT INTO complaint VALUES("3299","Maintenance-0002312","O2 cylinder is empty","complaint received on 12.15 am ","5","","22","1","54","","2","5","3","7","","","","225","2014-06-14 08:52:29","225","2014-06-14 09:07:29","","","","");
INSERT INTO complaint VALUES("3300","Maintenance-0002313","O2 cylinder is empty","complaint received on 13/06/2014 12.30am","5","","22","1","53","","2","5","3","7","","","","225","2014-06-14 08:53:12","225","2014-06-14 09:07:16","","","","");
INSERT INTO complaint VALUES("3301","Maintenance-0002314","Rear gate, NTS,Mens hostel camera\'s not working","Rear gate, NTS ,Mens hostel camera\'s not working","8","","34","1","99","","2","8","3","5","","","","350","2014-06-14 09:11:44","34","2014-06-16 16:20:58","","","","");
INSERT INTO complaint VALUES("3302","MIS-0000987","OPt - 3 Systems\' Network is not working","As per as possible","2","","112","1","58","","1","2","3","5","6","0","Switch not getting power ","121","2014-06-14 09:24:05","112","2014-06-16 10:53:01","","","","");
INSERT INTO complaint VALUES("3303","MIS-0000988","pediatric opd room no. 6 computer not working. ","kindly do the needful.","2","","112","1","79","","1","2","3","5","","0","","216","2014-06-14 09:26:33","112","2014-06-14 10:54:27","","","","");
INSERT INTO complaint VALUES("3304","MIS-0000989","sales statement not coming in PHM-05. Shows error Failed to open the connection.","Run time error for sales statement in PHM-05","3","","6","1","18","7","1","3","3","5","","","","64","2014-06-14 10:04:22","6","2014-06-14 12:44:02","","","","");
INSERT INTO complaint VALUES("3305","MIS-0000990","system not working ","system not working ","3","","112","1","74","","1","3","3","5","","","","214","2014-06-14 10:09:49","112","2014-06-14 11:03:28","","","","");
INSERT INTO complaint VALUES("3306","Maintenance-0002315","wash basin blocked","wash basin blocked","6","","31","1","16","175","2","6","3","5","","","","132","2014-06-14 10:20:18","31","2014-06-14 11:32:52","","","","");
INSERT INTO complaint VALUES("3307","Maintenance-0002316","pediatric O.P.D.-waiting area m-chat board to be fixed properly. ","kindly do the needful.","9","","37","1","79","","2","9","3","5","","","","216","2014-06-14 10:22:32","37","2014-06-16 17:13:38","","","","");
INSERT INTO complaint VALUES("3308","Maintenance-0002317","WATER LEAKING  FROM  ROOF","ROOF  SHEET  NEEDS  TO  BE  REPAIRED","12","","386","1","89","","2","12","3","2","","","","150","2014-06-14 10:30:42","227","2014-06-14 10:34:55","","","","");
INSERT INTO complaint VALUES("3309","Maintenance-0002318","WALL  TILE HAS  COME  OUT","NEES  TO BE REPAIRED","12","","386","1","89","","2","12","3","2","","","","150","2014-06-14 10:32:17","227","2014-06-14 10:34:19","","","","");
INSERT INTO complaint VALUES("3310","MIS-0000991","printer not working","printer not working","2","","112","1","44","361","1","2","3","5","","0","","384","2014-06-14 10:35:00","112","2014-06-14 10:52:37","","","","");
INSERT INTO complaint VALUES("3311","Maintenance-0002319","IN X-RAY DR ROOM EMERGENCY LIGHT NOT WORKING. PLS RECTIFY AS SOON AS POSSIBLE","IN X-RAY DR ROOM EMERGENCY LIGHT NOT WORKING. PLS RECTIFY AS SOON AS POSSIBLE","5","","25","1","90","","2","5","3","5","","","","70","2014-06-14 11:08:45","25","2014-06-14 12:17:00","","","","");
INSERT INTO complaint VALUES("3312","Maintenance-0002320","Room No.5 door is locked not able to open.","very Urgent ","9","","37","4","107","","2","9","3","7","","","","265","2014-06-14 11:45:38","265","2014-06-16 09:27:54","","","","");
INSERT INTO complaint VALUES("3313","Maintenance-0002321","Door lock  iron table is broken in the hostel","Urgent ","9","","37","4","107","","2","9","3","5","","","","265","2014-06-14 11:47:13","37","2014-06-14 12:17:47","","","","");
INSERT INTO complaint VALUES("3314","Maintenance-0002322","Leakage of oxygen in the flow meter {patient trolley.}","kindly do the needful.","7","","28","1","52","61","2","7","3","5","","","","156","2014-06-14 11:48:29","28","2014-06-14 12:22:29","","","","");
INSERT INTO complaint VALUES("3315","Maintenance-0002323","No admission board to be fixed in the main door","urgent please","9","","37","1","57","","2","9","3","5","","","","362","2014-06-14 12:07:56","37","2014-06-16 17:08:49","","","","");
INSERT INTO complaint VALUES("3316","Maintenance-0002324","suction not working","please come immedeatly","7","","27","1","49","233","2","7","3","5","","","","246","2014-06-14 12:32:31","27","2014-06-18 07:49:32","","","","");
INSERT INTO complaint VALUES("3317","Maintenance-0002325","Fix Stature meter in Dietary and counselling room","Urgent","9","","37","1","68","96","2","9","3","5","","","","365","2014-06-14 12:47:22","37","2014-06-18 07:53:38","","","","");
INSERT INTO complaint VALUES("3318","Maintenance-0002326","PCROOM NO 2 DOOR TO BE BE CHECKED","PLEASE DO AS EARLY AS POSSIBLE","9","","37","1","102","","2","9","3","5","","","","243","2014-06-14 12:51:06","37","2014-06-16 17:14:23","","","","");
INSERT INTO complaint VALUES("3319","Maintenance-0002327","cupboard drawer to be repaired","as soon as possible","9","","37","1","62","315","2","9","3","5","","","","106","2014-06-14 13:21:37","37","2014-06-16 17:10:45","","","","");
INSERT INTO complaint VALUES("3320","Maintenance-0002328","D-4 fan not working","As soon as possible","5","","23","1","62","310","2","5","3","5","","","","106","2014-06-14 13:26:42","23","2014-06-17 09:29:46","","","","");
INSERT INTO complaint VALUES("3321","Maintenance-0002329","Tube light is not working.","A5 bed side.","5","","23","1","82","","2","5","3","5","","","","107","2014-06-15 12:00:05","23","2014-06-16 13:47:46","","","","");
INSERT INTO complaint VALUES("3322","Maintenance-0002330","wash basin drinagepipe blocked. ","as soon as possible solve the problem.","6","","30","1","49","240","2","6","3","5","","","","244","2014-06-16 02:34:10","30","2014-06-16 17:16:44","","","","");
INSERT INTO complaint VALUES("3323","Maintenance-0002331","cup board to be fixed .","very urgent","9","","37","1","55","","2","9","3","5","","","","73","2014-06-16 08:07:47","37","2014-06-16 17:06:23","","","","");
INSERT INTO complaint VALUES("3324","Maintenance-0002332","Call bell near bed #6 is not working.","Please rectify it at the earliest. Thanks","8","","33","1","52","","2","8","3","5","","","","128","2014-06-16 08:11:28","33","2014-06-16 16:22:03","","","","");
INSERT INTO complaint VALUES("3325","MIS-0000992","Not receiving any mails to nursingoffice@bbh.org.in and vedaleena@bbh.org.in in outlook Express","Not receiving any mails to nursingoffice@bbh.org.in and vedaleena@bbh.org.in in outlook Express","3","","5","1","45","","1","3","3","5","","","","92","2014-06-16 08:25:52","112","2014-06-16 10:27:40","","","","");
INSERT INTO complaint VALUES("3326","Maintenance-0002333","BED NO:5 TUBELIGHT IS NOT WORKING","PLEASE RECTIFY SOON","5","","23","1","64","335","2","5","3","5","","","","110","2014-06-16 08:27:14","23","2014-06-16 13:48:14","","","","");
INSERT INTO complaint VALUES("3327","Maintenance-0002334","TOILET SINK IS BLOCKED","PLEASE RECTIFY SOON","6","","30","1","64","331","2","6","3","5","","","","110","2014-06-16 08:27:46","30","2014-06-16 17:16:57","","","","");
INSERT INTO complaint VALUES("3328","Maintenance-0002335","A-ROOM SINK IS BLOCKED","PLEASE RECTIFY SOON","6","","32","1","64","","2","6","3","5","","","","110","2014-06-16 08:28:14","32","2014-06-17 13:18:15","","","","");
INSERT INTO complaint VALUES("3329","Maintenance-0002336","Please cover the old speaker hole place","Please cover the old speaker hole place","8","","33","1","45","","2","8","3","5","","","","92","2014-06-16 08:28:58","33","2014-06-16 16:21:49","","","","");
INSERT INTO complaint VALUES("3330","Maintenance-0002337","Near Sink pipe - hole should be covered with cement","Near Sink pipe - hole should be covered with cement","6","","30","1","45","","2","6","3","5","","","","92","2014-06-16 08:30:36","30","2014-06-16 17:15:20","","","","");
INSERT INTO complaint VALUES("3331","Maintenance-0002338","Notice Board edges to be fixed ","urgent ","9","","37","1","65","","2","9","3","7","","","","84","2014-06-16 08:32:39","84","2014-06-19 08:16:40","","","","");
INSERT INTO complaint VALUES("3332","Maintenance-0002339","Grinder belt to be replaced. Very Very Urgent.","ITS VERY URGENT!!!!!!!!!!!!","7","","26","1","68","","2","7","3","5","","","","392","2014-06-16 08:34:38","227","2014-06-16 08:38:36","","","","");
INSERT INTO complaint VALUES("3333","Maintenance-0002340","\"F\", \"G\", wing-6 entrance between A and B and wing-6 Loby near the glass wall crack to be done ","urgent ","12","","386","1","65","","2","12","3","2","","","","84","2014-06-16 08:35:47","227","2014-06-16 08:47:18","","","","");
INSERT INTO complaint VALUES("3334","Maintenance-0002341","\"D\" room door is difficult to open and to close ","urgent ","9","","37","1","65","","2","9","3","7","","","","84","2014-06-16 08:36:42","84","2014-06-17 12:10:21","","","","");
INSERT INTO complaint VALUES("3335","Maintenance-0002342","Treatment room Bed side locker cupboard handling to be fixed  ","As soon as possible ","9","","37","1","65","","2","9","3","7","","","","84","2014-06-16 08:37:43","84","2014-06-17 12:09:58","","","","");
INSERT INTO complaint VALUES("3336","MIS-0000993","IP section -  bar code not working ","Urgent","2","","112","1","17","34","1","2","3","5","","0","","257","2014-06-16 08:39:05","112","2014-06-16 09:58:28","","","","");
INSERT INTO complaint VALUES("3337","Maintenance-0002343","Utility room has leakage of water under the cupboard and cupboard is broken to be  fixed properly ","as soon as possible ","9","","37","1","65","354","2","9","3","7","","","","84","2014-06-16 08:40:18","84","2014-06-17 12:10:45","","","","");
INSERT INTO complaint VALUES("3338","Maintenance-0002344","Cupboard handle is broken and lock is strucked inside the handle ","urgent ","9","","37","1","65","","2","9","3","7","","","","84","2014-06-16 08:43:52","84","2014-06-17 12:09:31","","","","");
INSERT INTO complaint VALUES("3339","Maintenance-0002345","Wing-VI ramp side, near the security side stand to be fixed properly it is shaking ","urgent ","9","","37","1","65","","2","9","3","2","","","","84","2014-06-16 08:48:47","227","2014-06-19 09:32:17","","","","");
INSERT INTO complaint VALUES("3340","MIS-0000994","printer not working. cash counter 4","past 1 weak its giving same problem","2","","112","1","44","361","1","2","3","5","","0","","383","2014-06-16 08:53:27","112","2014-06-16 09:02:17","","","","");
INSERT INTO complaint VALUES("3341","MIS-0000995","crp-05 system is not working","High priority","2","","112","1","40","12","1","2","3","5","","0","","313","2014-06-16 08:58:28","112","2014-06-16 09:09:49","","","","");
INSERT INTO complaint VALUES("3342","Maintenance-0002346","FAN ANDFOR NEW SYSTEM  CONNECTION TO INSTALL,TV NOT WORKING","URGENT","5","","24","1","75","","2","5","3","3","1","","TV working fine & FAN & Computer new plug point will be new requirement present we don\'t have stock as soon items received work will be done","207","2014-06-16 09:02:24","227","2014-06-16 10:10:52","","","","");
INSERT INTO complaint VALUES("3343","MIS-0000996","nicu -02 system is not showing any programs","very urgent","3","","5","1","55","","1","3","3","5","","","","73","2014-06-16 09:03:40","112","2014-06-16 10:08:41","","","","");
INSERT INTO complaint VALUES("3344","Maintenance-0002347","Two taps are leaking and one sink is  blocked in the old students hostel.","Urgent ","6","","30","4","107","","2","6","3","7","","","","265","2014-06-16 09:26:08","265","2014-06-24 15:25:27","","","","");
INSERT INTO complaint VALUES("3345","Maintenance-0002348","All room water not coming","complaint received on 15/06/2014 10.30am","7","","27","1","50","","2","7","3","7","","","","225","2014-06-16 09:30:41","225","2014-06-16 12:12:15","","","","");
INSERT INTO complaint VALUES("3346","Maintenance-0002349","Ambulance O2 cylinder is empty","complaint received on 15/06/2014  9.10pm","7","","27","1","99","","2","7","3","7","","","","225","2014-06-16 09:32:00","225","2014-06-16 12:11:59","","","","");
INSERT INTO complaint VALUES("3347","Maintenance-0002350","PROBLEM WITH THE LOCK IN ROOM NO. 3. ONCE IT IS LOCKED WE CANNOT OPEN FROM OUTSIDE EXCEPT WITH THE KEY.","URGENT","9","","37","1","110","","2","9","3","5","","","","224","2014-06-16 09:46:16","37","2014-06-16 17:14:50","","","","");
INSERT INTO complaint VALUES("3348","Maintenance-0002351","Very Urgent-The slab for the sink area to be changed.","The slab for the sink area to be changed as it is damaged","12","","386","1","17","152","2","12","3","2","","","","300","2014-06-16 09:48:00","227","2014-06-16 10:14:19","","","","");
INSERT INTO complaint VALUES("3349","Maintenance-0002352","Room-17 flush not working ","complaint received on 14/06/2014  11.00pm","5","","22","1","49","","2","5","3","7","","","","225","2014-06-16 09:48:57","225","2014-06-16 11:55:28","","","","");
INSERT INTO complaint VALUES("3350","Maintenance-0002353","NTS gate security room light not working","complaint received on 14/06/2014  11.30pm","5","","22","3","2","","2","5","3","7","","","","225","2014-06-16 09:49:54","225","2014-06-16 11:55:06","","","","");
INSERT INTO complaint VALUES("3351","Maintenance-0002354","CO2 cylinder is empty","complaint received on 14/06/20147.15am","5","","22","1","58","","2","5","3","7","","","","225","2014-06-16 09:50:55","225","2014-06-16 11:54:33","","","","");
INSERT INTO complaint VALUES("3352","Maintenance-0002355","Room-10 flush not working","complaint received on 15/06/2014 9.35pm","5","","22","1","49","","2","5","3","7","","","","225","2014-06-16 09:52:03","225","2014-06-16 11:54:17","","","","");
INSERT INTO complaint VALUES("3353","Maintenance-0002356","B-room toilet room light not working ","complaint received on 15/06/2014 10pm","5","","22","1","59","","2","5","3","7","","","","225","2014-06-16 09:53:02","225","2014-06-16 10:03:40","","","","");
INSERT INTO complaint VALUES("3354","Maintenance-0002357","A-room toilet blocked ","complaint received on 15/06/2014","5","","22","1","61","","2","5","3","7","","","","225","2014-06-16 09:53:47","225","2014-06-16 10:03:19","","","","");
INSERT INTO complaint VALUES("3355","Maintenance-0002358","Room-16 flush not working","complaint received on 15/06/2014  11.00pm","5","","22","1","50","","2","5","3","7","","","","225","2014-06-16 09:54:39","225","2014-06-16 10:03:03","","","","");
INSERT INTO complaint VALUES("3356","Maintenance-0002359","O2 cylinder is empty","complaint received on 15/06/2014  1.20am","5","","22","1","53","","2","5","3","7","","","","225","2014-06-16 09:55:49","225","2014-06-16 10:02:48","","","","");
INSERT INTO complaint VALUES("3357","Maintenance-0002360","Security Qtrs.side street light not working","complaint received on 15/06/2014  6015am","5","","22","3","70","","2","5","3","7","","","","225","2014-06-16 09:57:32","225","2014-06-16 10:02:31","","","","");
INSERT INTO complaint VALUES("3358","Maintenance-0002361","pediatric O.P.D.-WAITING AREA  bamboo branches to be cut.","kindly do the needful.","11","","21","1","79","","2","11","3","5","","","","216","2014-06-16 10:00:09","227","2014-06-16 10:13:19","","","","");
INSERT INTO complaint VALUES("3359","Maintenance-0002362","calling bell is not working","urgent","8","","34","1","60","278","2","8","3","5","","","","103","2014-06-16 10:18:59","34","2014-06-16 16:20:39","","","","");
INSERT INTO complaint VALUES("3360","Maintenance-0002363","f-9 calling bell is not woking","urgent","8","","34","1","60","277","2","8","3","5","","","","103","2014-06-16 10:19:50","34","2014-06-16 16:20:06","","","","");
INSERT INTO complaint VALUES("3361","Maintenance-0002364","LDPR- hanger to be fixed for bedpan.","needs uregent.","9","","37","1","59","","2","9","3","5","","","","116","2014-06-16 10:20:10","37","2014-06-16 17:10:08","","","","");
INSERT INTO complaint VALUES("3362","Maintenance-0002365","G-ROOM WASH BASIN IS BLOCKED","URGENT","6","","32","1","60","","2","6","3","5","","","","103","2014-06-16 10:21:03","32","2014-06-17 13:18:34","","","","");
INSERT INTO complaint VALUES("3363","Maintenance-0002366","Bedpan handle to be fixed","needs urgent","9","","37","1","59","","2","9","3","5","","","","116","2014-06-16 10:21:10","37","2014-06-16 17:09:48","","","","");
INSERT INTO complaint VALUES("3364","Maintenance-0002367","painting has to be done in OT (OT-1,OT-2,OT-3,
INSERT INTO complaint VALUES("3365","MIS-0000997","printer is not working.","W- 3 please urgent.","2","","112","1","62","","1","2","3","5","","0","","107","2014-06-16 10:39:44","112","2014-06-16 10:49:57","","","","");
INSERT INTO complaint VALUES("3366","MIS-0000998","IN SUPRIYA SAGE ACC PAC ID, UNABLE TO TAKE CONSUMPTION ENTRY PRINT","IN SUPRIYA SAGE ACC PAC ID, UNABLE TO TAKE CONSUMPTION ENTRY PRINT","3","","6","1","53","","1","3","3","5","","","","119","2014-06-16 10:41:13","6","2014-06-16 15:17:39","","","","");
INSERT INTO complaint VALUES("3367","Maintenance-0002368","OXYGEN CYLINDER IS EMPTY","PLEASE SEND FAST","7","","28","1","64","","2","7","3","5","","","","110","2014-06-16 10:41:51","28","2014-06-17 11:13:41","","","","");
INSERT INTO complaint VALUES("3368","Maintenance-0002369","SUCTION NOT WORKING IN ICU ","TO BE CHECKED IMMEDIATELY ","7","","28","1","53","","2","7","3","5","","","","119","2014-06-16 10:46:39","28","2014-06-17 11:13:21","","","","");
INSERT INTO complaint VALUES("3369","MIS-0000999","Kindly take the desktop (old one) from nursing educators room and issue a letter","Kindly take the desktop (old one) from nursing educators room and issue a letter","2","","5","1","45","","1","2","3","4","6","0","tomorrow we will take the monitor","93","2014-06-16 11:10:55","5","2014-06-16 16:21:24","","","","");
INSERT INTO complaint VALUES("3370","Maintenance-0002370","room no 1512 bathroom elfaucet  water leaking, room no 1514 bathroom commode flush not working.
INSERT INTO complaint VALUES("3371","Maintenance-0002371","in deluxe 3220  door back hokes to fix , as it is removed ","do the needful","9","","37","1","50","","2","9","3","5","","","","126","2014-06-16 11:14:21","37","2014-06-16 17:04:29","","","","");
INSERT INTO complaint VALUES("3372","Maintenance-0002372","in deluxe nursing station the  ceiling lights are not working ( square  Box )","do  the needful as soon as possible.","5","","23","1","50","","2","5","3","5","","","","126","2014-06-16 11:15:38","23","2014-06-16 13:48:49","","","","");
INSERT INTO complaint VALUES("3373","Maintenance-0002373","the tarpaulin on the sky lit area in the out patient pharma has blown off due to wind.","please re lay the same ASAP AS THE PATIENTS ARE SITTING UNDER DIRECT SUNLIGHT","9","","37","1","18","216","2","9","3","3","6","","no stock of new tarpaulin","64","2014-06-16 11:18:00","37","2014-06-18 08:11:02","","","","");
INSERT INTO complaint VALUES("3374","Maintenance-0002374","wheelchair resin cover to be repair.","uregent","7","","28","1","62","","2","7","3","5","","","","107","2014-06-16 11:19:59","28","2014-06-17 11:14:10","","","","");
INSERT INTO complaint VALUES("3375","MIS-0001000","Patient Name : Prashanth B.S.
INSERT INTO complaint VALUES("3376","MIS-0001001","Internet not working bills need to send for insurance approvals","High priority","3","","5","1","40","11","1","3","3","5","","","","313","2014-06-16 11:48:11","5","2014-06-16 14:17:06","","","","");
INSERT INTO complaint VALUES("3377","MIS-0001002","Dear Sir / Madam,
INSERT INTO complaint VALUES("3378","Maintenance-0002375","our ambulance 2nd cupboard not able to close properly","our ambulance 2nd cupboard not able to close properly","9","","37","1","81","","2","9","3","5","","","","99","2014-06-16 12:18:07","37","2014-06-18 07:53:12","","","","");
INSERT INTO complaint VALUES("3379","Maintenance-0002376","A/C. off  button broken.","audit n/c","10","","26","1","58","194","2","10","3","5","","","","122","2014-06-16 12:22:27","26","2014-06-18 16:32:58","","","","");
INSERT INTO complaint VALUES("3380","Maintenance-0002377","OT-1 WALL TILE BROKEN","URGENT","12","","386","1","58","189","2","12","3","2","","","","122","2014-06-16 12:23:16","227","2014-06-16 12:54:24","","","","");
INSERT INTO complaint VALUES("3381","Maintenance-0002378","needs additional plug point outside the  theater for ot-1,3,5","urgent","5","","24","1","58","189","2","5","3","3","9","","out source work to be done ","122","2014-06-16 12:25:00","24","2014-06-16 15:22:53","","","","");
INSERT INTO complaint VALUES("3382","Maintenance-0002379","OT-6 SCRUB AREA MEDICAL GAS BOX KEY BROKEN","URGENT","9","","37","1","58","194","2","9","3","2","","","","122","2014-06-16 12:26:23","37","2014-06-16 17:09:27","","","","");
INSERT INTO complaint VALUES("3383","Maintenance-0002380","painting required","fungal growth","11","","21","1","58","190","2","11","3","2","","","","122","2014-06-16 12:27:05","227","2014-06-16 12:55:01","","","","");
INSERT INTO complaint VALUES("3384","MIS-0001003","TO UPLOAD THE NEW 2014 DRUG FORMULARY ON BBH CONNECT","REQUEST YOU TO KINDLY DO IT ON PRIORITY BASIS ASAP","3","","8","1","18","7","1","3","3","5","","","","64","2014-06-16 13:04:22","8","2014-06-20 12:57:25","","","","");
INSERT INTO complaint VALUES("3385","MIS-0001004","UNABLE TO PRINT FROM PHM-05","AT THE EARLIEST","2","","112","1","18","7","1","2","3","5","","0","","64","2014-06-16 13:06:32","112","2014-06-16 13:15:18","","","","");
INSERT INTO complaint VALUES("3386","MIS-0001005","icu system 2 is unable to use, mouse not working","icu system 2 is unable to use, mouse not working","2","","5","1","53","","1","2","3","5","","0","","119","2014-06-16 13:30:58","5","2014-06-16 14:43:45","","","","");
INSERT INTO complaint VALUES("3387","Maintenance-0002381","Maternity R.no-F,Toilet flush out  not working.","Urgent","6","","31","1","60","","2","6","3","5","","","","145","2014-06-16 13:32:42","31","2014-06-16 16:18:40","","","","");
INSERT INTO complaint VALUES("3388","Maintenance-0002382","goose neck spot light screw to be fixed.","needs urgent","5","","23","1","59","","2","5","3","5","","","","116","2014-06-16 14:03:26","23","2014-06-17 09:29:55","","","","");
INSERT INTO complaint VALUES("3389","Maintenance-0002383","50 kg machine problem.","URGENT.","7","","29","1","84","157","2","7","3","3","9","","out source work to be done","351","2014-06-16 14:25:38","29","2014-06-16 16:24:08","","","","");
INSERT INTO complaint VALUES("3390","Maintenance-0002384","Extractor motor fitting work pending. ","URGENT.","7","","29","1","84","","2","7","3","3","9","","out source work to be done","351","2014-06-16 14:26:59","29","2014-06-16 16:23:32","","","","");
INSERT INTO complaint VALUES("3391","MIS-0001006","Sage Accpac folders are not working properly","urgent","3","","5","1","65","","1","3","3","7","","","","84","2014-06-16 14:27:55","84","2014-06-17 12:09:00","","","","");
INSERT INTO complaint VALUES("3392","Maintenance-0002385","Exhaust fans have been fixed in the additional storage area of pharmacy store.But,for fixing the fans holes have been made,that can cause damages to the additional storage item\'s by squirrels.So,this is a request to fix a mesh to the open area immediately.
INSERT INTO complaint VALUES("3393","Maintenance-0002386","D - 1 bed id switch board panel to be fixed.","urgent.","5","","23","1","62","310","2","5","3","5","","","","107","2014-06-16 14:56:43","23","2014-06-17 09:30:15","","","","");
INSERT INTO complaint VALUES("3394","Maintenance-0002387","TUBE LIGHT IS BLINKING","VERY URGENT","5","","25","1","54","","2","5","3","5","","","","73","2014-06-16 15:10:03","25","2014-06-17 09:26:44","","","","");
INSERT INTO complaint VALUES("3395","MIS-0001007","Dear Madam,
INSERT INTO complaint VALUES("3396","Maintenance-0002388","draw need to fix ","draw need to fix ","9","","37","1","16","172","2","9","3","5","","","","132","2014-06-16 15:47:53","37","2014-06-18 07:54:11","","","","");
INSERT INTO complaint VALUES("3397","MIS-0001008","system is slow","system is slow","3","","8","1","16","18","1","3","3","5","","","","132","2014-06-16 15:48:29","8","2014-06-23 09:08:40","","","","");
INSERT INTO complaint VALUES("3398","Maintenance-0002389","ROOM NO 1504 X-RAY VIEEW BOX SHORT CIRCUIT ","PLEASE COME IMMEDIATELY","7","","29","1","49","225","2","7","3","5","","","","97","2014-06-16 15:51:06","29","2014-06-18 16:31:22","","","","");
INSERT INTO complaint VALUES("3399","Maintenance-0002390","No admission board to be fix in c.s.s.d.","urgent please.","9","","37","1","57","","2","9","3","5","","","","362","2014-06-16 15:55:55","37","2014-06-18 07:56:14","","","","");
INSERT INTO complaint VALUES("3400","MIS-0001009","system hanging","system hanging","3","","5","1","16","18","1","3","3","5","","","","132","2014-06-16 16:14:26","5","2014-06-16 18:00:52","","","","");
INSERT INTO complaint VALUES("3401","Maintenance-0002391","C-6 patient cot foot end rod to be fixed","rod is not present","7","","29","1","62","309","2","7","3","5","","","","106","2014-06-16 16:28:23","29","2014-06-18 16:31:51","","","","");
INSERT INTO complaint VALUES("3402","Maintenance-0002392","near I-3 bed window is broken","urgent","9","","37","1","60","283","2","9","3","5","","","","263","2014-06-16 19:00:11","37","2014-06-18 16:27:29","","","","");
INSERT INTO complaint VALUES("3403","MIS-0001010","Text format is still not updated.
INSERT INTO complaint VALUES("3404","Maintenance-0002393","Temperature is too high in Server Room. Kindly make an immediate action, since it is affecting the life span of our servers. 
INSERT INTO complaint VALUES("3405","Maintenance-0002394","WASH BASE BLOCKED ","WASH BASE BLOCKED ","6","","32","1","74","","2","6","3","5","","","","214","2014-06-17 08:15:48","32","2014-06-17 13:19:12","","","","");
INSERT INTO complaint VALUES("3406","MIS-0001011"," in nicu - 02 lab report are not update for b/o kusum H.No AA256271","VERY URGENT","3","","6","1","55","","1","3","3","5","","","","73","2014-06-17 08:27:07","6","2014-06-17 11:10:29","","","","");
INSERT INTO complaint VALUES("3407","Maintenance-0002395","TUBE LIGHT FUSED","VERY URGENT","5","","25","1","73","104","2","5","3","5","","","","210","2014-06-17 08:56:00","25","2014-06-17 09:27:05","","","","");
INSERT INTO complaint VALUES("3408","Maintenance-0002396","ROOM NO 1518 TUBE LIGHT NOT WORKING","PLEASE COME IMMEDIATELY","5","","25","1","49","238","2","5","3","5","","","","97","2014-06-17 08:59:27","25","2014-06-17 09:27:22","","","","");
INSERT INTO complaint VALUES("3409","Maintenance-0002397","CARDIAC TABLE IS BEND","CARDIAC TABLE IS BEND","7","","28","1","53","","2","7","3","5","","","","119","2014-06-17 09:03:40","28","2014-06-17 12:48:22","","","","");
INSERT INTO complaint VALUES("3410","Maintenance-0002398","Patient Bed Side Cupboard to be repaired ","As soon as possible ","9","","37","1","65","","2","9","3","7","","","","84","2014-06-17 09:09:40","84","2014-06-23 08:29:04","","","","");
INSERT INTO complaint VALUES("3411","Maintenance-0002399","Nurses Station Slab to be fixed ","urgent ","12","","386","1","65","355","2","12","3","2","","","","84","2014-06-17 09:10:31","227","2014-06-17 09:11:41","","","","");
INSERT INTO complaint VALUES("3412","MIS-0001012","ACCPAC is not opening","very urgent","3","","112","1","54","","1","3","3","5","","","","73","2014-06-17 09:13:20","112","2014-06-17 09:28:18","","","","");
INSERT INTO complaint VALUES("3413","Maintenance-0002400","This is to remind - PED O.P.D.Injection room -fungus present to roof top.","kindly do the needful.","12","","386","1","79","","2","12","3","2","","","","216","2014-06-17 09:16:58","227","2014-06-17 10:01:41","","","","");
INSERT INTO complaint VALUES("3414","Maintenance-0002401","Telephone","Exchange one phone from nurses station","8","","33","1","81","","2","8","3","5","","","","98","2014-06-17 09:25:50","33","2014-06-18 16:34:15","","","","");
INSERT INTO complaint VALUES("3415","Maintenance-0002402","Portable suction apparatus
INSERT INTO complaint VALUES("3416","Maintenance-0002403","Painting for the equipment trolly
INSERT INTO complaint VALUES("3417","MIS-0001013","System #1 is very very slow.","Please check it ASAP.","3","","5","1","52","","1","3","3","7","","","","128","2014-06-17 09:34:00","128","2014-06-18 11:24:09","","","","");
INSERT INTO complaint VALUES("3418","Maintenance-0002404","battery . ","4 battery need to recharge..","7","","28","1","81","","2","7","3","5","","","","99","2014-06-17 09:35:49","28","2014-06-18 07:43:09","","","","");
INSERT INTO complaint VALUES("3419","Maintenance-0002405","Room A,C,E, bath room tap water leakages to be check and G,H,I,J,  bath room shower is working to be check and nurses station -1,2, hand wash tap water leakages to be checked immediately  ","as soon as possible,","6","","32","1","63","","2","6","3","5","1","","no stock non stock raised","87","2014-06-17 09:38:35","32","2014-06-19 12:43:03","","","","");
INSERT INTO complaint VALUES("3420","Maintenance-0002406","nurses station varanda right side nail to be fixed and isolation ward nail to be fixed to hang the patient rights forms.","please come immediately","9","","37","1","49","242","2","9","3","5","","","","97","2014-06-17 09:55:32","37","2014-06-18 08:08:43","","","","");
INSERT INTO complaint VALUES("3421","Maintenance-0002407","room no 1505 tube light not working","rectify immediately","5","","24","1","49","226","2","5","3","5","","","","97","2014-06-17 09:56:17","24","2014-06-17 14:39:50","","","","");
INSERT INTO complaint VALUES("3422","Maintenance-0002408","DRYER NOT WORK","DRYER NOT WORK 
INSERT INTO complaint VALUES("3423","Maintenance-0002409","BOILER DIESEL TANK PIPE LEAKAGE","BOILER DIESEL TANK PIPE LEAKAGE","7","","28","1","84","","2","7","3","3","9","","out source work to be done","351","2014-06-17 10:11:59","28","2014-06-18 07:44:12","","","","");
INSERT INTO complaint VALUES("3424","MIS-0001014","PRINTER IS NOT WORKING. URGENT","PRINTER IS NOT WORKING. URGENT","2","","5","1","51","","1","2","3","5","","0","","314","2014-06-17 10:13:56","5","2014-06-17 10:21:21","","","","");
INSERT INTO complaint VALUES("3425","Maintenance-0002410","in deluxe ward in nursing  station the call bell electrical box is not working. ","kindly do the needful  ","5","","24","1","50","","2","5","3","5","","","","126","2014-06-17 10:20:04","24","2014-06-17 14:41:38","","","","");
INSERT INTO complaint VALUES("3426","Maintenance-0002411","in 3220  door hokes to  fix ,as it is already informed ,not yet rectified ","kindly do the needful.","9","","37","1","50","","2","9","3","5","","","","126","2014-06-17 10:22:30","37","2014-06-17 13:20:40","","","","");
INSERT INTO complaint VALUES("3427","Maintenance-0002412","in 3204 door lock is not working .(unable to lock)","do the needful.","9","","37","1","50","","2","9","3","5","","","","126","2014-06-17 10:24:19","37","2014-06-18 07:56:34","","","","");
INSERT INTO complaint VALUES("3428","Maintenance-0002413","in 3208 there is heavy sound while opening ","kindly rectify ","9","","37","1","50","","2","9","3","5","","","","126","2014-06-17 10:28:44","37","2014-06-18 07:56:56","","","","");
INSERT INTO complaint VALUES("3429","Maintenance-0002414","pc opd mobile suction and oxygen cylinder needs calibration","please come immediately","7","","28","1","49","223","2","7","3","3","9","","outsource vendor has to come & calibrate","97","2014-06-17 10:39:10","28","2014-06-17 12:47:56","","","","");
INSERT INTO complaint VALUES("3430","MIS-0001015","INTERNET NOT WORKING, UNABLE TO TAKE REPORTS","INTERNET NOT WORKING, UNABLE TO TAKE REPORTS","3","","5","1","90","","1","3","3","5","","","","70","2014-06-17 10:39:13","5","2014-06-17 11:04:18","","","","");
INSERT INTO complaint VALUES("3431","Maintenance-0002415","Table droyer is not working, locked can\'t open-nuroscince room no-1","Table droyer is not working, locked can\'t open-nuroscince room no1.","9","","37","1","110","","2","9","3","5","","","","208","2014-06-17 10:42:18","37","2014-06-18 07:51:04","","","","");
INSERT INTO complaint VALUES("3432","Maintenance-0002416","Check bain marie connection","Urgent","7","","28","1","68","97","2","7","3","5","","","","365","2014-06-17 11:18:45","28","2014-06-17 12:46:07","","","","");
INSERT INTO complaint VALUES("3433","Maintenance-0002417","1)lab opd ladies toliet  flush is out and water is liking
INSERT INTO complaint VALUES("3434","Maintenance-0002418","O2 cylinder empty to be changed.","as soon as possible.","7","","28","1","63","","2","7","3","7","","","","87","2014-06-17 12:00:55","87","2014-06-19 10:22:22","","","","");
INSERT INTO complaint VALUES("3435","Maintenance-0002419","patient attenter stool to be painted 5 nos.","as soon as possible.","9","","37","1","63","","2","9","3","7","","","","87","2014-06-17 12:02:13","87","2014-06-19 10:21:33","","","","");
INSERT INTO complaint VALUES("3436","MIS-0001016","mrd 1 accpac not opening","mrd 1 accpac not opening","3","","112","1","16","19","1","3","3","5","","","","132","2014-06-17 12:07:07","112","2014-06-17 12:25:32","","","","");
INSERT INTO complaint VALUES("3437","Maintenance-0002420","Medical Gas pipes are not having the stickers to be fixed ","very urgent ","7","","28","1","65","","2","7","3","3","6","","Informed to Vargheese","84","2014-06-17 12:13:06","28","2014-06-18 07:42:39","","","","");
INSERT INTO complaint VALUES("3438","Maintenance-0002421","Plate to be fixed to the \"F\" room Bathroom door ","urgent ","9","","37","1","65","353","2","9","3","7","","","","84","2014-06-17 12:14:07","84","2014-06-19 08:16:24","","","","");
INSERT INTO complaint VALUES("3439","Maintenance-0002422","Fan not working.","Rectify ASAP","5","","23","1","66","","2","5","3","5","","","","366","2014-06-17 12:21:12","23","2014-06-18 07:40:51","","","","");
INSERT INTO complaint VALUES("3440","Maintenance-0002423","Computer chair to be repair ","Ms.Lavanya chair ","7","","28","1","2","161","2","7","3","7","","","","227","2014-06-17 12:34:46","227","2014-06-17 12:39:12","","","","");
INSERT INTO complaint VALUES("3441","MIS-0001017","RV Metropolis Online is not getting open. kindly look into it immediately","Urgent.","3","","5","1","17","25","1","3","3","5","","","","257","2014-06-17 12:43:56","5","2014-06-17 12:55:52","","","","");
INSERT INTO complaint VALUES("3442","Maintenance-0002424","X-RAY ROLLING CHAIR BACK SUPPORT IS NOT STABLE, TO BE FIXED TIGHT.","X-RAY ROLLING CHAIR BACK SUPPORT IS NOT STABLE, TO BE FIXED TIGHT.","7","","28","1","90","","2","7","3","5","","","","70","2014-06-17 13:00:34","227","2014-06-23 09:13:58","","","","");
INSERT INTO complaint VALUES("3443","Maintenance-0002425","Rain water entering inside through the bottom of the glass cabin.","URGENT","12","","386","1","17","139","2","12","3","2","","","","113","2014-06-17 13:19:51","227","2014-06-17 13:38:27","","","","");
INSERT INTO complaint VALUES("3444","Maintenance-0002426","LDPR-B  AC making sound","needs urgent","10","","26","1","59","","2","10","3","5","","","","116","2014-06-17 13:43:12","26","2014-06-18 07:46:37","","","","");
INSERT INTO complaint VALUES("3445","Maintenance-0002427","Room-1514 X-ray view box plug top not working","complaint received on 16/06/2014  5.00pm","7","","29","1","49","","2","7","3","7","","","","225","2014-06-17 13:55:03","225","2014-06-18 13:51:42","","","","");
INSERT INTO complaint VALUES("3446","Maintenance-0002428","C-6 cot end fixed properly","complaint received on 16/06/2014  5.30pm","7","","29","1","62","","2","7","3","7","","","","225","2014-06-17 13:56:21","225","2014-06-18 13:51:59","","","","");
INSERT INTO complaint VALUES("3447","Maintenance-0002429","O2 cylinder is empty","complaint received on 16/06/2014  12.30am ","5","","22","1","49","","2","5","3","7","","","","225","2014-06-17 13:58:53","225","2014-06-18 13:51:20","","","","");
INSERT INTO complaint VALUES("3448","Maintenance-0002430","Male side toilet flush out water is continuesly flowing ","complaint received on 16/06/2014  1.00am ","5","","22","1","64","","2","5","3","7","","","","225","2014-06-17 14:00:33","225","2014-06-18 13:52:16","","","","");
INSERT INTO complaint VALUES("3449","Maintenance-0002431","Co2 cylinder is empty","complaint received on 16/06/2014  7.45am ","5","","22","1","58","","2","5","3","7","","","","225","2014-06-17 14:01:41","225","2014-06-18 13:52:31","","","","");
INSERT INTO complaint VALUES("3450","Maintenance-0002432","Deluxe birthing room Gyzer is rustered needs cleaning.","needs urgent","6","","31","1","59","","2","6","3","3","6","","painting to be done","116","2014-06-17 14:04:34","31","2014-06-25 16:25:34","","","","");
INSERT INTO complaint VALUES("3451","Maintenance-0002433","Tarpaulin in the patient waiting area blown off and hanging down from the roof.Please remove it as early as possible.","tarpaulin hanging from roof top of patient waiting area.","9","","37","1","18","217","2","9","3","5","","","","64","2014-06-17 14:16:11","37","2014-06-18 08:09:41","","","","");
INSERT INTO complaint VALUES("3452","Maintenance-0002434","OT-6 AC is not working to be checked ","complaint given by Prasnya on call ","10","","26","1","58","194","2","10","3","7","","","","227","2014-06-17 14:21:21","227","2014-06-24 14:46:56","","","","");
INSERT INTO complaint VALUES("3453","Maintenance-0002435","CO2 regulator connection not provided from Benaka meditech company","CO2 regulator connection not provided from Benaka meditech company","7","","29","1","51","261","2","7","3","2","","","","317","2014-06-17 14:28:59","227","2014-06-17 14:43:16","","","","");
INSERT INTO complaint VALUES("3454","MIS-0001018","system hanging ","system hanging ","3","","5","1","16","18","1","3","3","5","","","","132","2014-06-17 14:29:58","5","2014-06-17 14:36:47","","","","");
INSERT INTO complaint VALUES("3455","Maintenance-0002436","Wheel chair. ","wheel chair making sound need to check.","7","","29","1","81","","2","7","3","5","","","","99","2014-06-17 14:37:45","29","2014-06-18 07:48:02","","","","");
INSERT INTO complaint VALUES("3456","MIS-0001019","in deluxe ,  unable to operate the  system -01, it takes long time to display. ","kindly rectify","3","","5","1","50","","1","3","3","5","","","","126","2014-06-17 15:16:19","5","2014-06-17 15:53:59","","","","");
INSERT INTO complaint VALUES("3457","Maintenance-0002437","TUBE LIGHT NOT WORKING ","TUBE LIGHT NOT WORKING ","5","","23","1","53","","2","5","3","5","","","","119","2014-06-17 16:27:50","23","2014-06-18 16:36:53","","","","");
INSERT INTO complaint VALUES("3458","Maintenance-0002438","Rest room light is not working","urgent","5","","23","1","60","290","2","5","3","5","","","","103","2014-06-17 16:38:19","23","2014-06-18 13:48:21","","","","");
INSERT INTO complaint VALUES("3459","Maintenance-0002439","Sewing machine to be repaired.","urgent","7","","28","1","115","360","2","7","3","3","9","","work to be done by outside shop by tomorow","149","2014-06-17 16:39:10","28","2014-06-23 14:41:15","","","","");
INSERT INTO complaint VALUES("3460","Maintenance-0002440","The wires in the tailoring room to be arranged neatly.  Already the request has been sent.","urgent.","5","","23","1","115","360","2","5","3","2","","","","149","2014-06-17 16:41:01","227","2014-06-18 08:12:32","","","","");
INSERT INTO complaint VALUES("3461","Maintenance-0002441","Laundry and Transport systems are suddenly off mode whenever power cuts, due to UPS line not working. ","ups line not working  ","7","","28","1","84","","2","7","3","5","","","","351","2014-06-17 16:49:13","28","2014-06-18 13:41:34","","","","");
INSERT INTO complaint VALUES("3462","Maintenance-0002442","Toilet near Quality Office is blocked water flow is coming out ","Please Rectify ASAP","6","","30","1","26","","2","6","3","5","","","","76","2014-06-17 17:35:25","30","2014-06-18 16:20:04","","","","");
INSERT INTO complaint VALUES("3463","Maintenance-0002443","The computer in the CT Scan Room is not getting switched on, there is some cable disconnection.
INSERT INTO complaint VALUES("3464","Maintenance-0002444","room no 1507 geyser not working","please come immediately","6","","30","1","49","228","2","6","3","5","","","","97","2014-06-18 08:10:37","30","2014-06-18 16:18:58","","","","");
INSERT INTO complaint VALUES("3465","Maintenance-0002445","splint need for NICU 100 NOS","VERY URGENT","9","","37","1","55","","2","9","3","2","","","","73","2014-06-18 08:12:07","227","2014-06-18 08:23:12","","","","");
INSERT INTO complaint VALUES("3466","MIS-0001020","system not working.","system not working ..","2","","112","1","81","","1","2","3","5","","0","","99","2014-06-18 08:19:18","112","2014-06-18 08:49:38","","","","");
INSERT INTO complaint VALUES("3467","Maintenance-0002446","sink is blocked","complaint received on 17/06/2014  6.00pm","6","","31","1","81","","2","6","3","7","","","","225","2014-06-18 08:32:04","225","2014-06-18 13:53:28","","","","");
INSERT INTO complaint VALUES("3468","Maintenance-0002447","D-room toilet room light not working","complaint receive on 17/06/2014   6.30pm","7","","29","1","60","","2","7","3","7","","","","225","2014-06-18 08:35:04","225","2014-06-18 13:53:13","","","","");
INSERT INTO complaint VALUES("3469","Maintenance-0002448","Room-A7 Tube light not working","complaint received on 17/06/2014  9.25 pm","7","","29","1","61","","2","7","3","7","","","","225","2014-06-18 08:36:15","225","2014-06-18 13:52:59","","","","");
INSERT INTO complaint VALUES("3470","MIS-0001021","Emp NO. 05905 could not credit COMP off Leave Balance. ","kindly do the needful","3","","6","1","30","","1","3","3","2","","","","226","2014-06-18 08:45:24","6","2014-06-18 09:24:39","","","","");
INSERT INTO complaint VALUES("3471","Maintenance-0002449","female chatram toilet door not able open","complaint received on 17/06/2014   10.45pm","5","","22","1","70","","2","5","3","7","","","","225","2014-06-18 08:59:28","225","2014-06-18 13:52:46","","","","");
INSERT INTO complaint VALUES("3472","Maintenance-0002450","O2 cylinder is empty","cimplaint received on 17/06/2014  12.30am","5","","22","1","81","","2","5","3","7","","","","225","2014-06-18 09:00:55","225","2014-06-18 13:51:05","","","","");
INSERT INTO complaint VALUES("3473","Maintenance-0002451","O2 cylinder is empty","complaint received on 17/06/2014  1.00am","5","","22","1","53","","2","5","3","7","","","","225","2014-06-18 09:01:53","225","2014-06-18 13:50:39","","","","");
INSERT INTO complaint VALUES("3474","Maintenance-0002452","O2 cylinder is empty ","complaint received on 17/06/2014  1.15am ","5","","22","1","64","","2","5","3","7","","","","225","2014-06-18 09:02:32","225","2014-06-18 13:50:26","","","","");
INSERT INTO complaint VALUES("3475","Maintenance-0002453","in deluxe room 3220 door hokes to fix , as it is always remove from door on force. ","kindly do the needful ","9","","37","1","50","","2","9","3","5","","","","126","2014-06-18 09:06:13","37","2014-06-18 16:25:59","","","","");
INSERT INTO complaint VALUES("3476","Maintenance-0002454","in deluxe room in 3214 the call bell is not working.(THE PATIENT IS INCONVENIENCE)","KINDLY RECTIFY ","8","","33","1","50","","2","8","3","5","","","","126","2014-06-18 09:08:26","33","2014-06-18 16:34:37","","","","");
INSERT INTO complaint VALUES("3477","MIS-0001022"," Diet System 1 2 4 are not working","very urgent","","","123","1","68","","1","3","3","7","","","null","392","2014-06-18 09:14:53","392","2014-06-18 09:14:53","","","","");
INSERT INTO complaint VALUES("3478","Maintenance-0002455","All delivery cots to be painted ","complaint through mail June 17, 2014 11:10 AM","9","","37","1","59","","2","9","3","3","9","","out source work to be done","225","2014-06-18 09:15:24","37","2014-06-19 16:10:27","","","","");
INSERT INTO complaint VALUES("3479","Maintenance-0002456"," Diet System 1 2 4 are not working","very urgent","7","","28","1","68","","2","7","3","5","","","","392","2014-06-18 09:15:39","227","2014-06-18 10:13:03","","","","");
INSERT INTO complaint VALUES("3480","Maintenance-0002457","IV stand to be repaired we are sending it to maintenance department","Urgent","7","","28","1","58","196","2","7","3","5","","","","121","2014-06-18 09:23:10","28","2014-06-18 13:38:20","","","","");
INSERT INTO complaint VALUES("3481","Maintenance-0002458","IV stand to be repaired we are sending it to maintenance department","Urgent","7","","28","1","58","196","2","7","3","5","","","","121","2014-06-18 09:25:15","28","2014-06-18 13:37:58","","","","");
INSERT INTO complaint VALUES("3482","Maintenance-0002459","All Ot\'s doors emergency key to be fixed","urgent","9","","37","1","58","189","2","9","3","2","","","","121","2014-06-18 09:33:26","227","2014-06-18 09:54:22","","","","");
INSERT INTO complaint VALUES("3483","Maintenance-0002460","washing area  wash basin is bloked","needs urgent","6","","30","1","59","","2","6","3","5","","","","116","2014-06-18 09:35:07","30","2014-06-19 10:00:40","","","","");
INSERT INTO complaint VALUES("3484","Maintenance-0002461","Birthing room -A  wall suction is not working.
INSERT INTO complaint VALUES("3485","MIS-0001023","could not credit comp off leave for the below mentioned staffs emp.no. 05635, 05631, 05905, 05819, 05816, 05821, 05867 all contracts staffs","kindly do the needful","3","","6","1","30","","1","3","3","2","","","","226","2014-06-18 09:57:01","6","2014-06-18 15:38:22","","","","");
INSERT INTO complaint VALUES("3486","Maintenance-0002462","TUBE LIGHTS IN LIBRARY IS NOT WORKING","URGENT","5","","23","4","24","","2","5","3","5","","","","153","2014-06-18 10:02:05","23","2014-06-18 16:37:32","","","","");
INSERT INTO complaint VALUES("3487","Maintenance-0002463","cryo can emty  to be fill","urgent","7","","26","1","75","","2","7","3","2","","","","207","2014-06-18 10:04:34","227","2014-06-18 10:15:39","","","","");
INSERT INTO complaint VALUES("3488","Maintenance-0002464","painting to be done ","painting to be done ","11","","21","1","74","188","2","11","3","2","","","","214","2014-06-18 10:12:48","227","2014-06-18 10:13:36","","","","");
INSERT INTO complaint VALUES("3489","Maintenance-0002465","painting to be done  on table ","painting to be done  on table ","9","","37","1","74","188","2","9","3","2","","","","214","2014-06-18 10:14:58","227","2014-06-18 11:55:03","","","","");
INSERT INTO complaint VALUES("3490","MIS-0001024","Connect the Printer to the new system 
INSERT INTO complaint VALUES("3491","Maintenance-0002466","PCR room door is not getting closed properly.We have Three large equipments which is very sensitive to temperature which should be below 20 Degree calcius.","PCR room door not working","9","","37","1","17","","2","9","3","5","","","","300","2014-06-18 10:52:53","37","2014-06-18 16:26:56","","","","");
INSERT INTO complaint VALUES("3492","Maintenance-0002467","Suction wall is very tight and not able to open near bed #2.","Please rectify it ASAP.","7","","28","1","52","","2","7","3","5","","","","128","2014-06-18 11:23:26","28","2014-06-18 13:37:22","","","","");
INSERT INTO complaint VALUES("3493","Maintenance-0002468","water tap","tap broken need to fix other one.","6","","30","1","81","","2","6","3","5","","","","99","2014-06-18 11:23:51","30","2014-06-19 12:52:05","","","","");
INSERT INTO complaint VALUES("3494","Maintenance-0002469","pipe water over plowing ","pipe water over plowing ","6","","30","1","74","188","2","6","3","5","","","","214","2014-06-18 11:27:16","30","2014-06-18 16:20:37","","","","");
INSERT INTO complaint VALUES("3495","MIS-0001025","MRD N AA263180 SHOWING PRN  NO NOT POSTED NO 0248800","MRD N AA263180 SHOWING PRN  NO NOT POSTED NO 0248800","3","","6","1","42","","1","3","3","5","","","","374","2014-06-18 11:31:22","6","2014-06-18 15:57:32","","","","");
INSERT INTO complaint VALUES("3496","Maintenance-0002470","mobile suction apparutus calibration .","mobile suction ","7","","28","1","64","","2","7","3","5","9","","out source work to be done","108","2014-06-18 11:37:00","28","2014-06-23 14:41:36","","","","");
INSERT INTO complaint VALUES("3497","MIS-0001026","printer  is not working","as soon as possible","2","","112","1","64","21","1","2","3","5","","0","","108","2014-06-18 11:40:39","112","2014-06-18 12:40:41","","","","");
INSERT INTO complaint VALUES("3498","Maintenance-0002471","curtain  stands to be fixed","as soon a possible","9","","37","1","64","339","2","9","3","3","1","","no stock non stock item","108","2014-06-18 11:46:37","37","2014-06-19 16:09:44","","","","");
INSERT INTO complaint VALUES("3499","Maintenance-0002472","wire need to fix properly.","wire need to fix properly.","5","","25","1","81","98","2","5","3","5","","","","99","2014-06-18 11:49:24","25","2014-06-18 16:30:07","","","","");
INSERT INTO complaint VALUES("3500","Maintenance-0002473","CRP-10 computer key board tray is stuck.","High priority","9","","37","1","40","63","2","9","3","7","","","","65","2014-06-18 12:00:16","65","2014-06-23 12:14:35","","","","");
INSERT INTO complaint VALUES("3501","MIS-0001027","CRP-03 sent mail at 12pm for Gmail which got bounced back","Repeatedly mails are getting bounced for gmail attached for your kind reference","","","123","1","40","12","1","3","3","1","","","null","65","2014-06-18 12:09:42","65","2014-06-18 12:09:42","20140618120942_Undelivered Mail Returned to Sender.eml","","","");
INSERT INTO complaint VALUES("3502","Maintenance-0002474","We are not able to hear any announcement","needs urgent ","8","","33","1","59","","2","8","3","3","6","","new requirement .out source work to be done","116","2014-06-18 12:26:56","33","2014-06-18 16:35:33","","","","");
INSERT INTO complaint VALUES("3503","Maintenance-0002475","western toilet blocked.  ","urgent repair plz","6","","30","1","47","117","2","6","3","5","","","","149","2014-06-18 12:27:58","30","2014-06-18 16:18:38","","","","");
INSERT INTO complaint VALUES("3504","Maintenance-0002476","puva room seperat connection for fan pls arrange","urgant","5","","23","1","75","","2","5","3","5","","","","207","2014-06-18 12:35:51","23","2014-06-18 13:47:41","","","","");
INSERT INTO complaint VALUES("3505","Maintenance-0002477","O2 IS NOT SUFFICIENT TO SHIFT THE PATIENT TO CT
INSERT INTO complaint VALUES("3506","Maintenance-0002478","Open wires are not yet removed from C,D,&E room side.","It was informed earlier also but not yet rectfied","5","","23","1","62","310","2","5","3","5","","","","106","2014-06-18 13:17:14","23","2014-06-21 11:02:43","","","","");
INSERT INTO complaint VALUES("3507","Maintenance-0002479","Hand rub solution stand to be fix in c.s.s.d.","urgent please.","9","","37","1","57","66","2","9","3","5","","","","362","2014-06-18 13:18:01","37","2014-06-18 16:24:30","","","","");
INSERT INTO complaint VALUES("3508","Maintenance-0002480","IN DELUXE WARD IN AQUA GUARD WE FOUND SOME WHITE PARTICLES ,IT IS UNSATISFACTORY TO USE THE WATER BY GENRAL .
INSERT INTO complaint VALUES("3509","Maintenance-0002481","Plastering work for the split AC outlet.","","12","","386","3","108","","2","12","3","2","","","","396","2014-06-18 13:38:54","227","2014-06-18 13:45:15","","","","");
INSERT INTO complaint VALUES("3510","Maintenance-0002482","washing area tap to be changed.","urgent  please.","6","","30","1","57","66","2","6","3","2","","","","362","2014-06-18 14:11:01","30","2014-06-23 13:29:22","","","","");
INSERT INTO complaint VALUES("3511","Maintenance-0002483","3m handrub stand to be fixed in the entrance","urgent","9","","37","1","55","","2","9","3","5","","","","73","2014-06-18 14:17:12","37","2014-06-18 16:24:58","","","","");
INSERT INTO complaint VALUES("3512","MIS-0001028","pc  ward billing system","accapac is not responding","3","","5","1","42","","1","3","3","5","","","","372","2014-06-18 15:01:26","5","2014-06-18 15:06:43","","","","");
INSERT INTO complaint VALUES("3513","Maintenance-0002484","Rain water drain line broken","need to be repaired","6","","31","1","89","","2","6","3","2","","","","88","2014-06-18 16:14:22","227","2014-06-18 16:47:01","","","","");
INSERT INTO complaint VALUES("3514","MIS-0001029","PRN NO.PRN000000248796, NOT POSTED. ","PRN NO.PRN000000248796, NOT POSTED. ","3","","6","1","42","","1","3","3","5","","","","118","2014-06-18 16:30:01","6","2014-06-18 16:33:14","","","","");
INSERT INTO complaint VALUES("3515","MIS-0001030","System #1 keyboard is not working.","Please rectify it ASAP.","2","","112","1","52","","1","2","3","5","","0","","128","2014-06-19 07:54:52","112","2014-06-19 08:52:37","","","","");
INSERT INTO complaint VALUES("3516","Maintenance-0002485","\"C\" bathroom toilet flush is coming bad smell even after cleaning ","urgent ","6","","32","1","65","349","2","6","3","2","","","","84","2014-06-19 08:20:58","32","2014-06-23 13:34:39","","","","");
INSERT INTO complaint VALUES("3517","Maintenance-0002486","Patient trolley safety belt to be placed Total No:1","very urgent ","7","","28","1","65","","2","7","3","2","","","","84","2014-06-19 08:22:22","28","2014-06-23 14:40:51","","","","");
INSERT INTO complaint VALUES("3518","Maintenance-0002487","all the rooms aA,B,C,E,F,G,H,I,J, Hand Rub Antiseptic Solution ( Sterillium ) stand to be fixed.","as soon as possible.","9","","37","1","63","","2","9","3","5","","","","87","2014-06-19 08:24:04","37","2014-06-19 13:43:19","","","","");
INSERT INTO complaint VALUES("3519","Maintenance-0002488","cupboard to be fixed properly in the utility room.","very urgent","9","","37","1","65","354","2","9","3","3","9","","out source work to be done","84","2014-06-19 08:30:10","37","2014-06-19 16:07:48","","","","");
INSERT INTO complaint VALUES("3520","Maintenance-0002489","ladies staff hostel light not working","complaint received on 18/06/2014  4.30pm","7","","29","2","2","","2","7","3","7","","","","225","2014-06-19 08:30:33","225","2014-06-20 09:21:10","","","","");
INSERT INTO complaint VALUES("3521","Maintenance-0002490","Dr.Niranjan house switch board repaired","complaint received on 18/06/2014.   4.45pm","7","","29","3","2","","2","7","3","7","","","","225","2014-06-19 08:31:40","225","2014-06-20 09:20:55","","","","");
INSERT INTO complaint VALUES("3522","Maintenance-0002491","Men\'s hostel geyser not working ","complaint received on 18/06/2014  6.45pm","6","","31","2","2","","2","6","3","7","","","","225","2014-06-19 08:33:06","225","2014-06-20 09:20:41","","","","");
INSERT INTO complaint VALUES("3523","Maintenance-0002492","O2 cylinder is empty","complaint received on 18/06/2014  10.30pm","5","","22","1","61","","2","5","3","7","","","","225","2014-06-19 08:34:13","225","2014-06-20 09:19:56","","","","");
INSERT INTO complaint VALUES("3524","Maintenance-0002493","A2 bed side wall mount fan not working","complaint received on 18/06/2014  11.45pm","5","","22","1","61","","2","5","3","7","","","","225","2014-06-19 08:36:39","225","2014-06-20 09:20:26","","","","");
INSERT INTO complaint VALUES("3525","Maintenance-0002494","A room flush out water continuesly flowing","complaint received on 18/06/2014   5.00am","5","","22","1","61","","2","5","3","7","","","","225","2014-06-19 08:39:08","225","2014-06-20 09:20:13","","","","");
INSERT INTO complaint VALUES("3526","Maintenance-0002495","O2 cylinder is empty","complaint received on 18/06/2014  6.00am","5","","22","1","81","","2","5","3","7","","","","225","2014-06-19 08:39:50","225","2014-06-20 09:19:45","","","","");
INSERT INTO complaint VALUES("3527","Maintenance-0002496","O2 cylinder is empty","complaint received on 18/06/2014  6.10am ","5","","22","1","53","","2","5","3","7","","","","225","2014-06-19 08:40:32","225","2014-06-20 09:19:25","","","","");
INSERT INTO complaint VALUES("3528","Maintenance-0002497","O2 cylinder is empty","complaint received on 18/06/2014  6.20am","5","","22","1","64","","2","5","3","7","","","","225","2014-06-19 08:41:12","225","2014-06-20 09:19:12","","","","");
INSERT INTO complaint VALUES("3529","Maintenance-0002498","bath room tap is leaking","urgent","6","","30","1","60","283","2","6","3","5","","","","103","2014-06-19 08:54:01","30","2014-06-19 12:49:24","","","","");
INSERT INTO complaint VALUES("3530","Maintenance-0002499","I-ROOM  door not be closed properly","urgent","9","","37","1","60","283","2","9","3","5","","","","103","2014-06-19 08:55:28","37","2014-06-19 13:45:02","","","","");
INSERT INTO complaint VALUES("3531","MIS-0001031","medicine name not coming.","medicine name:metronidazole iv not coming in our emergency & er annex system.Kinldy do the needful & rectify asap.","3","","6","1","81","","1","3","3","5","","","","99","2014-06-19 08:57:36","6","2014-06-20 12:31:18","","","","");
INSERT INTO complaint VALUES("3532","Maintenance-0002500","pc ward enterance top the pipe which is paasing on the name board to be removed and visiting hours board to be removed and new one to be replaced.","please do immediately.","9","","37","1","49","224","2","9","3","5","","","","97","2014-06-19 08:58:19","37","2014-06-19 13:46:56","","","","");
INSERT INTO complaint VALUES("3533","MIS-0001032","PC WARD BILLING SYSTEM.","ACCAPAC IS NOT RESPONDING ","3","","5","1","42","","1","3","3","5","","","","372","2014-06-19 09:09:36","5","2014-06-19 09:51:04","","","","");
INSERT INTO complaint VALUES("3534","MIS-0001033","System is Slow and hanging ","Pls do ASAP","3","","5","1","30","","1","3","3","5","","","","148","2014-06-19 09:12:26","5","2014-06-19 16:41:46","","","","");
INSERT INTO complaint VALUES("3535","MIS-0001034","Tally and Accpac both are responding very slow ","Resolve the issue at the earliest","3","","5","1","41","","1","3","3","5","","","","63","2014-06-19 09:15:37","5","2014-06-19 09:38:54","","","","");
INSERT INTO complaint VALUES("3536","Maintenance-0002501","in 3204 bed lamp bulb is not working.","kindly change it ","5","","25","1","50","","2","5","3","5","","","","126","2014-06-19 09:19:23","25","2014-06-21 11:06:39","","","","");
INSERT INTO complaint VALUES("3537","MIS-0001035","KEYBOARD TO BE CHANGED ALPHABETS ARE NOT SEEN","PLEASE RECTIFY SOON","3","","5","1","64","22","1","3","3","5","","","","110","2014-06-19 09:24:31","5","2014-06-19 17:03:49","","","","");
INSERT INTO complaint VALUES("3538","Maintenance-0002502","in 3221,due to water stain on wall near window  fungal are caused heavily.","kindly rectify for patient satisfaction .","12","","386","1","50","","2","12","3","2","","","","126","2014-06-19 09:30:30","227","2014-06-19 09:30:54","","","","");
INSERT INTO complaint VALUES("3539","Maintenance-0002503","PAINTING. ","1.	Demarcation for emergency and ambulance in front of emergency was not clearly visible.
INSERT INTO complaint VALUES("3540","Maintenance-0002504","the whole in the wall need to be sealed","complaint through mail on June 19, 2014 8:18 AM","12","","386","1","60","278","2","12","3","2","","","","227","2014-06-19 09:41:13","24","2014-06-21 11:07:59","","","","");
INSERT INTO complaint VALUES("3541","Maintenance-0002505","-80 refrigirator is not working","Very Urgent","10","","26","1","17","137","2","10","3","2","","","","292","2014-06-19 09:50:21","227","2014-06-19 09:51:42","","","","");
INSERT INTO complaint VALUES("3542","MIS-0001036","Signatures to be updated for all the staffs.
INSERT INTO complaint VALUES("3543","Maintenance-0002506","Hand rub stand t be fixed in A1.","Hand rub stand t be fixed in A1","9","","37","1","61","292","2","9","3","5","","","","104","2014-06-19 10:10:40","37","2014-06-19 13:42:06","","","","");
INSERT INTO complaint VALUES("3544","Maintenance-0002507","A1 FAN MAKING NOISE.","A1 FAN MAKING NOISE.","5","","24","1","61","","2","5","3","5","","","","104","2014-06-19 10:11:49","24","2014-06-19 15:52:48","","","","");
INSERT INTO complaint VALUES("3545","Maintenance-0002508","uneven floor in treatment room .","kindly do the needful.","12","","386","1","79","210","2","12","3","2","","","","216","2014-06-19 10:13:13","227","2014-06-19 10:34:36","","","","");
INSERT INTO complaint VALUES("3546","Maintenance-0002509","Nurses station - 2  suction meter alarm continuous coming to be check immediately. ","as soon as possible.","7","","27","1","63","","2","7","3","5","","","","87","2014-06-19 10:21:10","27","2014-06-19 13:38:45","","","","");
INSERT INTO complaint VALUES("3547","Maintenance-0002510","Curtain rod to be fixed in examination room","kindly do the needful as soon as posible","9","","37","1","23","","2","9","3","3","1","","no stock non stock item","79","2014-06-19 10:22:08","37","2014-06-19 16:12:13","","","","");
INSERT INTO complaint VALUES("3548","MIS-0001037","accpac is not working","accpac is not working","3","","112","1","16","36","1","3","3","5","","","","132","2014-06-19 10:30:46","112","2014-06-19 12:33:48","","","","");
INSERT INTO complaint VALUES("3549","Maintenance-0002511","chairs are shaking","urgent","7","","27","1","80","","2","7","3","5","","","","72","2014-06-19 10:37:32","27","2014-06-19 13:38:22","","","","");
INSERT INTO complaint VALUES("3550","Maintenance-0002512","The key board holder tray is stuck .","Kindly do the needful asap.","9","","37","1","32","","2","9","3","5","","","","96","2014-06-19 10:39:50","37","2014-06-19 16:10:52","","","","");
INSERT INTO complaint VALUES("3551","Maintenance-0002513","Kitchen drainage is blocked and it is over flowing. ","Very urgent","6","","32","1","68","93","2","6","3","5","","","","392","2014-06-19 11:12:07","32","2014-06-19 15:59:36","","","","");
INSERT INTO complaint VALUES("3552","Maintenance-0002514","Rooms A,B,C,E,F, bath room tap water leaking to be checked and nurses station -1,2, hand wash sink tap water leaking to be checked.","as soon as possible.","6","","30","1","63","","2","6","3","3","1","","repeated complaint as per requirement taps non stock raised on 18-06-2014 NS no: 098","87","2014-06-19 11:21:53","227","2014-06-19 11:24:52","","","","");
INSERT INTO complaint VALUES("3553","Maintenance-0002515","The drawer of the filing cabinet is struck and not able to close the drawer.","Please rectify the issue immediately","9","","37","1","98","","2","9","3","5","","","","151","2014-06-19 11:30:31","37","2014-06-19 16:04:34","","","","");
INSERT INTO complaint VALUES("3554","Maintenance-0002516"," PLEASE FIX THE ROD IN NURSES STATION ","URGANT","9","","37","1","75","","2","9","3","5","","","","207","2014-06-19 11:38:49","37","2014-06-19 16:07:02","","","","");
INSERT INTO complaint VALUES("3555","MIS-0001038","Zimbra mail is not accessible ","Have many external mails to reply ASAP","3","","112","1","94","37","1","3","3","7","","","","137","2014-06-19 11:39:04","137","2014-06-19 12:39:06","","","","");
INSERT INTO complaint VALUES("3556","MIS-0001039","Can you give a fresh page for this F/Y Leave Application report as it is difficult to search the leave application number entered from the given list. as requested from bbh staff 
INSERT INTO complaint VALUES("3557","MIS-0001040","BT order is not showing in the system. Already patient paid OP no bil002161138
INSERT INTO complaint VALUES("3558","Maintenance-0002517","deluxe pantry , worms are caused near the sink pipes due to water stangnant  and it smells badly","complaint through mail on June 18, 2014 10:23 AM","12","","386","1","50","","2","12","3","2","","","","227","2014-06-19 12:00:04","227","2014-06-19 12:27:05","","","","");
INSERT INTO complaint VALUES("3559","Maintenance-0002518","ROOM B bed -2 switch board screw coming out to be 
INSERT INTO complaint VALUES("3560","Maintenance-0002519","SINK BLOCKED..","SINK BLOCKED..","6","","32","1","81","","2","6","3","5","","","","99","2014-06-19 12:33:00","32","2014-06-19 12:42:02","","","","");
INSERT INTO complaint VALUES("3561","Maintenance-0002520","phone keypad not working.torchlight not working.no.2","urgent","8","","33","1","72","","2","8","3","5","","","","219","2014-06-19 12:46:14","227","2014-06-20 10:35:46","","","","");
INSERT INTO complaint VALUES("3562","Maintenance-0002521","Extn-411 & Fax line-08023337818 -lots of disturbance in hearing","High priority","8","","33","1","40","64","2","8","3","5","","","","313","2014-06-19 12:52:32","227","2014-06-20 10:36:18","","","","");
INSERT INTO complaint VALUES("3563","MIS-0001041","high risk labour room printer is not working","needs urgent","3","","5","1","59","","1","3","3","5","","","","116","2014-06-19 12:56:21","5","2014-06-19 13:24:28","","","","");
INSERT INTO complaint VALUES("3564","MIS-0001042","Seshadri Sir\'s zimbra desktop- mail could not open since 11:00am","Seshadri Sir\'s zimbra desktop- mail could not open since 11:00am","3","","5","1","34","","1","3","3","5","","","","173","2014-06-19 12:59:43","5","2014-06-19 14:51:23","","","","");
INSERT INTO complaint VALUES("3565","Maintenance-0002522"," Close cup board to be fixed top of the shoe rack to keep nicu  mother\'s belongings.","very urgent","9","","37","1","55","","2","9","3","5","9","","out source work to be done","73","2014-06-19 13:18:45","37","2014-06-20 16:44:16","","","","");
INSERT INTO complaint VALUES("3566","Maintenance-0002523","IN DELUXE 3208 AC IS NOT WORKING AS FILTER IS SMELLING VERY BADLY.The patient is much aware of AC TECHNIC","KINDLY RECTIFY AS EARLIER","10","","26","1","50","77","2","10","3","5","","","","126","2014-06-19 13:38:23","26","2014-06-20 09:37:36","","","","");
INSERT INTO complaint VALUES("3567","Maintenance-0002524","Sluice room door and sterile room door near OT 3 is not fixing properly. Please come and rectify","Urgent","9","","37","1","58","191","2","9","3","2","","","","121","2014-06-19 13:39:18","227","2014-06-19 13:51:03","","","","");
INSERT INTO complaint VALUES("3568","Maintenance-0002525","Floor painting to be done for Ot-3 floor","V. Urgent","11","","21","1","58","191","2","11","3","2","","","","121","2014-06-19 13:45:32","227","2014-06-19 13:50:38","","","","");
INSERT INTO complaint VALUES("3569","Maintenance-0002526","oxygen trolley oxygen cylinder needs calibration","please do ASAP","7","","26","1","49","242","2","7","3","2","","","","97","2014-06-19 14:28:07","227","2014-06-19 15:06:07","","","","");
INSERT INTO complaint VALUES("3570","Maintenance-0002527","AC is leaking in DR room in x-ray department","AC is leaking in DR room in x-ray department","10","","26","1","90","","2","10","3","5","","","","70","2014-06-19 14:46:14","26","2014-06-20 09:37:20","","","","");
INSERT INTO complaint VALUES("3571","Maintenance-0002528","IN 3221 CALL BELL  ARE NOT WORKING ","KINDLY RECTIFY AS  EARLIEST ","8","","33","1","50","","2","8","3","5","","","","126","2014-06-19 15:42:24","33","2014-06-20 16:38:01","","","","");
INSERT INTO complaint VALUES("3572","Maintenance-0002529","IN 3205 GEYSER IS NOT WORKING  ","KINDLY RECTIFY AS SOON  POSSIBLE.","6","","31","1","50","","2","6","3","3","1","","no stock of indicator light ","126","2014-06-19 15:43:51","31","2014-06-20 16:41:38","","","","");
INSERT INTO complaint VALUES("3573","Maintenance-0002530","PA system is very audible in CCU.","Please rectify it at the earliest.
INSERT INTO complaint VALUES("3574","Maintenance-0002531","OXYGEN CYLINDER 2 NO\'S EMPTY","PLEASE SEND FAST","7","","29","1","64","","2","7","3","5","","","","110","2014-06-19 15:55:37","227","2014-06-20 08:45:00","","","","");
INSERT INTO complaint VALUES("3575","Maintenance-0002532","SINK IS BLOCKED","PLEASE RECTIFY SOON","6","","31","1","64","331","2","6","3","5","","","","110","2014-06-19 15:56:26","227","2014-06-20 08:49:12","","","","");
INSERT INTO complaint VALUES("3576","Maintenance-0002533","Sink pipe is broken needs replacement at the earliest. ","VERY URGENT......","6","","31","1","68","93","2","6","3","5","","","","392","2014-06-19 16:16:47","31","2014-06-20 16:36:10","","","","");
INSERT INTO complaint VALUES("3577","Maintenance-0002534","J and K Room Toilet is blocked","Please rectify soon","6","","31","1","64","","2","6","3","5","","","","110","2014-06-19 16:42:36","227","2014-06-20 08:49:32","","","","");
INSERT INTO complaint VALUES("3578","Maintenance-0002535","fixing of existing granite slab ","with proper support","12","","386","1","18","216","2","12","3","2","","","","64","2014-06-19 17:13:47","227","2014-06-20 08:46:36","","","","");
INSERT INTO complaint VALUES("3579","MIS-0001043","SYSTEM 2 SAGE ACCPAC NOT OPENING","PLEASE DO THE NEEDFUL","3","","112","1","50","","1","3","3","7","","","","181","2014-06-19 18:59:01","181","2014-06-21 19:16:27","","","","");
INSERT INTO complaint VALUES("3580","Maintenance-0002536","Delux pantry drainage is blocked and its leaking, the water is coming out of it and its smelling very badly.","very urgent.","6","","30","1","68","","2","6","3","5","","","","392","2014-06-20 08:07:36","30","2014-06-25 16:09:34","","","","");
INSERT INTO complaint VALUES("3581","Maintenance-0002537","in 3208  unable to see the channels in tv (no channels found)","kindly rectify","8","","33","1","50","","2","8","3","5","","","","126","2014-06-20 08:56:31","33","2014-06-20 16:37:41","","","","");
INSERT INTO complaint VALUES("3582","Maintenance-0002538","white board.","white board corner broken.","9","","37","1","81","","2","9","3","5","","","","99","2014-06-20 09:09:28","37","2014-06-20 16:44:33","","","","");
INSERT INTO complaint VALUES("3583","Maintenance-0002539","pneumatic stand.","pneumatic (steel) stand broken need to repair or welding.","9","","37","1","81","","2","9","3","5","","","","99","2014-06-20 09:10:40","37","2014-06-20 16:45:09","","","","");
INSERT INTO complaint VALUES("3584","Maintenance-0002540","Aquaguard to be fixed","complaint received on 19/06/2014   5.15 pm","6","","31","1","18","","2","6","3","7","","","","225","2014-06-20 09:22:46","225","2014-06-20 10:01:12","","","","");
INSERT INTO complaint VALUES("3585","Maintenance-0002541","pharmacy toilet flush out not working","complaint received on 19/06/2014 5.40 pm","6","","31","1","18","","2","6","3","7","","","","225","2014-06-20 09:23:44","225","2014-06-20 10:00:57","","","","");
INSERT INTO complaint VALUES("3586","Maintenance-0002542","G-3& F-9 CALLING BELL IS NOT WORKING","URGENT","8","","33","1","60","277","2","8","3","3","9","","out source work to be done","103","2014-06-20 09:24:05","33","2014-06-24 15:24:17","","","","");
INSERT INTO complaint VALUES("3587","Maintenance-0002543","O2 cylinder is empty","complaint  received on 19/06/2014 6.30pm","6","","31","1","81","","2","6","3","7","","","","225","2014-06-20 09:25:09","225","2014-06-20 10:00:09","","","","");
INSERT INTO complaint VALUES("3588","Maintenance-0002544","E-ROOM & G-ROOM WASH BASIN IS BLOCKED ","URGENT","6","","32","1","60","280","2","6","3","5","","","","103","2014-06-20 09:26:31","32","2014-06-20 16:39:00","","","","");
INSERT INTO complaint VALUES("3589","Maintenance-0002545","CALLING BELL BOARD IS BROKEN","URGENT","8","","33","1","60","279","2","8","3","3","9","","out source work to be done","103","2014-06-20 09:27:13","33","2014-06-24 15:23:59","","","","");
INSERT INTO complaint VALUES("3590","Maintenance-0002546","Library Door - require door stopper ","Library Door - require door stopper ","9","","37","1","25","","2","9","3","7","","","","152","2014-06-20 09:31:26","152","2014-06-24 11:04:35","","","","");
INSERT INTO complaint VALUES("3591","MIS-0001044","The alignment of paper during printing is not appropriate. kindly solve this as soon as possible.","thank u for the spontaneous response.","2","","112","1","46","","1","2","3","5","","0","","258","2014-06-20 09:37:26","112","2014-06-20 09:52:12","","","","");
INSERT INTO complaint VALUES("3592","Maintenance-0002547","A2 bed side fan not working","complaint received on 19/06/2014 9.45pm","5","","22","1","61","","2","5","3","7","","","","225","2014-06-20 09:52:55","225","2014-06-20 10:00:40","","","","");
INSERT INTO complaint VALUES("3593","Maintenance-0002548","I-room cot side rails loose","complaint received on 19/06/2014  10.15 pm","5","","22","1","64","","2","5","3","7","","","","225","2014-06-20 09:53:58","225","2014-06-20 10:00:24","","","","");
INSERT INTO complaint VALUES("3594","Maintenance-0002549","O2 cylinder is empty","complaint received on 19/06/2014  12.00am ","5","","22","1","49","","2","5","3","7","","","","225","2014-06-20 09:55:28","225","2014-06-20 09:59:58","","","","");
INSERT INTO complaint VALUES("3595","Maintenance-0002550","front of ENT Tube light not working","urgent","5","","24","1","76","","2","5","3","5","","","","206","2014-06-20 09:56:41","227","2014-06-20 12:55:56","","","","");
INSERT INTO complaint VALUES("3596","Maintenance-0002551","Qtrs.Sis.Leenaraj house tube light not working","attend soon","5","","24","3","2","","2","5","3","7","","","","225","2014-06-20 09:59:38","225","2014-06-24 13:55:38","","","","");
INSERT INTO complaint VALUES("3597","MIS-0001045","system hanging","system hanging","3","","5","1","16","19","1","3","3","5","","","","132","2014-06-20 10:08:08","5","2014-06-20 16:55:29","","","","");
INSERT INTO complaint VALUES("3598","MIS-0001046","not able to send mail to emergency dept","urgent","3","","6","1","57","","1","3","3","5","","","","73","2014-06-20 10:13:47","6","2014-06-20 10:18:55","","","","");
INSERT INTO complaint VALUES("3599","Maintenance-0002552","Water taps are leaking in kitchen area.  ","Very Urgent!!!!!!!!!!!!!!!!!!!!!!","6","","32","1","68","93","2","6","3","5","","","","392","2014-06-20 10:21:51","32","2014-06-20 16:40:14","","","","");
INSERT INTO complaint VALUES("3600","Maintenance-0002553","Qtrs.Dr.Rachel house tube light & flush out not working","attend soon","5","","23","3","2","","2","5","3","7","","","","225","2014-06-20 10:26:20","225","2014-06-24 13:55:52","","","","");
INSERT INTO complaint VALUES("3601","MIS-0001047","Paediatric  opd room no p5 computer not working","kindly  due the need","2","","112","1","79","","1","2","3","5","","0","","216","2014-06-20 10:34:55","112","2014-06-20 11:35:56","","","","");
INSERT INTO complaint VALUES("3602","MIS-0001048","AA126562 RAJA R
INSERT INTO complaint VALUES("3603","Maintenance-0002554","Tread mil not working need urgent requirement ","Tread mil not working need urgent requirement ","7","","29","3","70","272","2","7","3","2","","","","129","2014-06-20 11:28:25","227","2014-06-23 14:02:12","","","","");
INSERT INTO complaint VALUES("3604","Maintenance-0002555","urinal sink block.","urgent","6","","32","1","47","105","2","6","3","5","","","","149","2014-06-20 11:50:36","32","2014-06-20 16:38:44","","","","");
INSERT INTO complaint VALUES("3605","Maintenance-0002556","Cupboard door broken, door broken.","urgent","9","","37","1","47","121","2","9","3","5","","","","149","2014-06-20 11:51:42","37","2014-06-20 16:42:47","","","","");
INSERT INTO complaint VALUES("3606","Maintenance-0002557","bathroom room exhaust fan not working","please come immediately","5","","23","1","49","239","2","5","3","3","6","","winding burn ","97","2014-06-20 13:43:40","23","2014-06-20 16:37:06","","","","");
INSERT INTO complaint VALUES("3607","MIS-0001049","Report c\'ant able to enter showing pending analysis Hosp no:AA263479 - Christy
INSERT INTO complaint VALUES("3608","Maintenance-0002558","Urinal sink blocked plz rectify at the earliest","very urgent","6","","31","1","47","110","2","6","3","5","","","","149","2014-06-20 15:52:04","31","2014-06-23 13:30:43","","","","");
INSERT INTO complaint VALUES("3609","MIS-0001050","One System has to be connect ","the system which was used by Syeda Madam","2","","112","1","28","","1","2","3","5","6","0","SMPS having problem ","117","2014-06-20 16:10:11","112","2014-06-24 08:10:14","","","","");
INSERT INTO complaint VALUES("3610","MIS-0001051","Mrs. Shilpa Hosp.No; AA263012 plz give to 18/6/2014 medicine report printout","needs urgent","3","","6","1","59","","1","3","3","5","","","","116","2014-06-20 16:15:31","6","2014-06-20 16:45:03","","","","");
INSERT INTO complaint VALUES("3611","Maintenance-0002559","sink is blocked.","urgent","6","","30","1","61","304","2","6","3","5","","","","107","2014-06-20 16:42:39","30","2014-06-23 13:26:12","","","","");
INSERT INTO complaint VALUES("3612","Maintenance-0002560","Shredder machine 10hp to be repaired/serviced.","Shredder machine 10 HP to be repaired/serviced.","7","","28","1","99","","2","7","3","5","","","","350","2014-06-20 16:50:44","28","2014-06-24 15:39:12","","","","");
INSERT INTO complaint VALUES("3613","MIS-0001052","RV Metropolis not opening in Lab OPD.","So please check very soon.","3","","5","1","17","25","1","3","3","5","","","","257","2014-06-20 17:50:53","5","2014-06-20 17:59:50","","","","");
INSERT INTO complaint VALUES("3614","Maintenance-0002561","curtain rod","for new triage area.","9","","37","1","81","","2","9","3","5","","","","98","2014-06-21 08:24:44","37","2014-06-24 08:52:34","","","","");
INSERT INTO complaint VALUES("3615","Maintenance-0002562","LDPR - wash basin is bloked","needs urgent","6","","30","1","59","","2","6","3","5","","","","116","2014-06-21 08:27:44","30","2014-06-23 13:26:03","","","","");
INSERT INTO complaint VALUES("3616","Maintenance-0002563","In toilet room","Water is coming very duty.","6","","30","1","62","312","2","6","3","5","","","","107","2014-06-21 08:53:41","30","2014-06-23 13:25:54","","","","");
INSERT INTO complaint VALUES("3617","Maintenance-0002564","Delivery cot IV stand to be fixed","needs urgent","7","","28","1","59","","2","7","3","3","9","","Outsource to be done ","116","2014-06-21 08:56:11","28","2014-06-23 14:39:57","","","","");
INSERT INTO complaint VALUES("3618","Maintenance-0002565","Doctor room & psychiatry room","door stoper to be fixed.","9","","37","1","62","","2","9","3","3","1","","Door stopper no stock non stock raised on 18/06/2014 NS No:096","107","2014-06-21 08:57:41","37","2014-06-24 08:50:11","","","","");
INSERT INTO complaint VALUES("3619","MIS-0001053","mouse  .","mouse not working...","3","","5","1","81","","1","3","3","5","","","","99","2014-06-21 08:59:03","112","2014-06-21 09:26:37","","","","");
INSERT INTO complaint VALUES("3620","MIS-0001054","in Excel sheet causer is not going up side.","urgent","2","","5","1","62","","1","2","3","5","","0","","107","2014-06-21 09:05:00","112","2014-06-21 09:35:48","","","","");
INSERT INTO complaint VALUES("3621","Maintenance-0002566","Bed no-9 suction not working","complaint received on 20/06/2014  5.30pm","7","","29","1","53","","2","7","3","7","","","","225","2014-06-21 09:05:13","225","2014-06-24 13:56:04","","","","");
INSERT INTO complaint VALUES("3622","Maintenance-0002567","Nurses station sink blocked ","complaint received on 20/06/2014 6.00pm","6","","31","1","61","","2","6","3","7","","","","225","2014-06-21 09:06:03","225","2014-06-24 13:56:19","","","","");
INSERT INTO complaint VALUES("3623","MIS-0001055","my system is showing some active recovery setup on desktop","urgent","3","","5","1","105","","1","3","3","5","","","","291","2014-06-21 09:14:58","112","2014-06-21 09:35:31","","","","");
INSERT INTO complaint VALUES("3624","Maintenance-0002568","PED O.P.D.[SIDE GARDEN ] low line area around the water tank to be made level .if rain comes water will be stagnated and it will be good source of mosquito breed.","kindly and urgently do the needful.
INSERT INTO complaint VALUES("3625","MIS-0001056","CCTV system not able to connect the network some error occurred when view video","kindly come & check immly","2","","5","1","2","","1","2","3","5","6","0","checking     ","227","2014-06-21 09:36:36","5","2014-06-25 16:32:08","","","","");
INSERT INTO complaint VALUES("3626","MIS-0001057","printer not working","system restarting ","2","","5","1","73","","1","2","3","5","","0","","402","2014-06-21 09:50:36","112","2014-06-21 09:52:09","","","","");
INSERT INTO complaint VALUES("3627","MIS-0001058","connect the printer (2 printers)","very urgent ","2","","112","1","29","","1","2","3","5","","0","","356","2014-06-21 10:22:31","112","2014-06-23 15:10:04","","","","");
INSERT INTO complaint VALUES("3628","Maintenance-0002569","pungent smell in ct scan room since morning","as soon as possible","5","","24","1","91","","2","5","3","5","","","","70","2014-06-21 10:28:09","24","2014-06-21 11:07:31","","","","");
INSERT INTO complaint VALUES("3629","MIS-0001059","EXCEL SHEET TO BE  RECTIFIED ","URGENT","2","","112","1","61","","1","2","3","5","","0","","103","2014-06-21 10:37:34","112","2014-06-21 11:02:15","","","","");
INSERT INTO complaint VALUES("3630","MIS-0001060","In purchase Ms. Vanitha\'s system Network to be connected
INSERT INTO complaint VALUES("3631","Maintenance-0002570","Bsc hostel near nursing school 1st floor 2 sinks blocked to be cleared","complaint orally received by technician ","6","","30","2","2","","2","6","3","7","","","","227","2014-06-21 11:00:47","227","2014-06-24 14:46:46","","","","");
INSERT INTO complaint VALUES("3632","MIS-0001061","PRINTER  IS NOT WORKING","URGENT","2","","112","1","60","","1","2","3","5","","0","","263","2014-06-21 11:01:48","112","2014-06-21 11:09:24","","","","");
INSERT INTO complaint VALUES("3633","MIS-0001062","computer not working paed opd room no.5","Kindly due the need.","2","","5","1","79","","1","2","3","5","","0","","216","2014-06-21 11:11:59","5","2014-06-21 12:13:24","","","","");
INSERT INTO complaint VALUES("3634","MIS-0001063","HDU PRINTER IS NOT WORKING","AS SOON AS POSSIBLE","2","","112","1","64","21","1","2","3","5","","0","","108","2014-06-21 11:43:39","5","2014-06-21 12:11:57","","","","");
INSERT INTO complaint VALUES("3635","Maintenance-0002571","in deluxe ward the key  of glass door  back side (emergency exit ) is not working .it is unable to lock ","kindly rectify for nabh .","9","","37","1","50","","2","9","3","2","","","","126","2014-06-21 11:51:54","37","2014-06-24 08:47:29","","","","");
INSERT INTO complaint VALUES("3636","MIS-0001064","Pat Name RAJA R
INSERT INTO complaint VALUES("3637","MIS-0001065","Pat Name :Manjunath .D
INSERT INTO complaint VALUES("3638","Maintenance-0002572","Lab 2 nd floor steel trolly big , wheel is broken so pls rectify  it soon.
INSERT INTO complaint VALUES("3639","Maintenance-0002573","BATHROOM WATER BLOCKING .","AS SOON AS POSSIBLE CLEARE THE PROBLEM.","6","","32","1","49","236","2","6","3","5","","","","244","2014-06-21 17:08:10","227","2014-06-23 08:20:30","","","","");
INSERT INTO complaint VALUES("3640","Maintenance-0002574","water is leaking","clear immediatelly","6","","32","1","64","338","2","6","3","5","","","","322","2014-06-22 00:44:20","32","2014-06-23 13:24:01","","","","");
INSERT INTO complaint VALUES("3641","MIS-0001066","Please put the sharing folder in Biochemistry as the main folder is in opd after 7 in wards they are not able to see the reports.","Urgent.","3","","5","1","17","","1","3","3","5","","","","257","2014-06-23 07:34:04","5","2014-06-23 14:48:44","","","","");
INSERT INTO complaint VALUES("3642","Maintenance-0002575","Exchange of  the Ceiling fan with Wall mounted fan","From General store Ceiling  fan to Purchase Wall mount fan","5","","23","1","29","","2","5","3","3","9","","New requirement out source work to be done","356","2014-06-23 08:27:07","23","2014-06-24 08:13:06","","","","");
INSERT INTO complaint VALUES("3643","Maintenance-0002576","ROOM NO 1507 CALL BELL BEDSIDE CONNECTING SWITCH AND PROBE IS NOT PROPER AND NOT WORKING","PLEASE RECTIFY IMMEDIATELY","8","","33","1","49","228","2","8","3","5","","","","97","2014-06-23 08:28:02","33","2014-06-24 08:17:46","","","","");
INSERT INTO complaint VALUES("3644","MIS-0001067","NURSES STATION PCW-01 SYSTEM MOUSE FREQUENTLY GETS DISCONNECTED AND HANG FOR LONG TIME, MOUSE TO BE CHANGED.","PLEASE DO ASAP","2","","112","1","49","","1","2","3","2","","0","","97","2014-06-23 08:32:57","112","2014-06-23 09:00:44","","","","");
INSERT INTO complaint VALUES("3645","Maintenance-0002577","Manual OT table not coming down","Urgent","7","","28","1","58","193","2","7","3","2","","","","122","2014-06-23 08:37:47","227","2014-06-23 09:29:21","","","","");
INSERT INTO complaint VALUES("3646","Maintenance-0002578","Door stopper to be fixed.back side","bed rail-or handal be fixed. & printer door  to be fixed.","9","","37","1","62","315","2","9","3","3","1","","Door stopper no stock non stock raised on 18/06/2014 NS No:096","107","2014-06-23 08:39:51","37","2014-06-24 08:49:46","","","","");
INSERT INTO complaint VALUES("3647","MIS-0001068","MOUSE IS NOT WORKING, COUNTER 4","MOUSE IS NOT WORKING, COUNTER 4","2","","112","1","16","19","1","2","3","5","","0","","132","2014-06-23 08:42:51","112","2014-06-23 09:00:28","","","","");
INSERT INTO complaint VALUES("3648","Maintenance-0002579","Medical  consultant  room telephone  not  working  some times ","Telephone set  is  very  old .  needs to be  replaced","8","","33","1","37","132","2","8","3","5","","","","150","2014-06-23 08:46:09","33","2014-06-24 08:18:01","","","","");
INSERT INTO complaint VALUES("3649","Maintenance-0002580","in 3213  bath room doom light is not working ","do theneedful","5","","23","1","50","","2","5","3","5","","","","126","2014-06-23 08:50:02","23","2014-06-24 08:11:01","","","","");
INSERT INTO complaint VALUES("3650","Maintenance-0002581","In OPD the water is overflowing kindly look into it immediately","Urgent","6","","32","1","17","","2","6","3","2","","","","257","2014-06-23 08:52:44","32","2014-06-23 13:23:19","","","","");
INSERT INTO complaint VALUES("3651","Maintenance-0002582","in 3206 TV not working   and even  three tv re4motes not working ","kindly rectify","8","","33","1","50","","2","8","3","5","","","","126","2014-06-23 08:52:49","33","2014-06-24 08:18:20","","","","");
INSERT INTO complaint VALUES("3652","Maintenance-0002583","\"F\" room bathroom flush handle is broken ","very urgent","6","","32","1","65","353","2","6","3","5","","","","84","2014-06-23 08:59:20","32","2014-06-23 13:23:36","","","","");
INSERT INTO complaint VALUES("3653","MIS-0001069","We are not able to send any mails to gmail account or yahoo account / rediffmail account.  All the mails are bounced back.  We tried sending from Zimbra and outlook express but in vain","Can you please rectify the problem.","","","123","1","98","","1","3","3","1","","","null","151","2014-06-23 09:13:09","151","2014-06-23 09:13:09","","","","");
INSERT INTO complaint VALUES("3654","Maintenance-0002584","CCU Trolley oxygen is over.","Please send it ASAP.","7","","28","1","52","","2","7","3","5","","","","128","2014-06-23 09:14:33","28","2014-06-23 10:24:39","","","","");
INSERT INTO complaint VALUES("3655","Maintenance-0002585","tube light fused.","very urgent.","5","","25","1","73","104","2","5","3","5","","","","211","2014-06-23 09:14:43","25","2014-06-24 08:24:33","","","","");
INSERT INTO complaint VALUES("3656","Maintenance-0002586","Milky bulb is not working in scan - 1","Milky bulb is not working in scan - 1","5","","25","1","104","","2","5","3","5","","","","70","2014-06-23 09:27:05","25","2014-06-24 08:26:14","","","","");
INSERT INTO complaint VALUES("3657","Maintenance-0002587","Sink blocked in Pantry Room.","urgent.","6","","32","1","61","","2","6","3","5","","","","104","2014-06-23 09:28:16","32","2014-06-23 13:21:47","","","","");
INSERT INTO complaint VALUES("3658","Maintenance-0002588","baby bath room  light is not working","urgent","5","","23","1","60","","2","5","3","5","","","","103","2014-06-23 09:58:38","23","2014-06-24 08:08:30","","","","");
INSERT INTO complaint VALUES("3659","Maintenance-0002589","f-9& g-3calling bell is not working ","urgent","8","","33","1","60","","2","8","3","5","6","","wiring to be done","103","2014-06-23 09:59:27","33","2014-06-24 15:03:47","","","","");
INSERT INTO complaint VALUES("3660","Maintenance-0002590","screw to be fixed to labour room near bed side","needs urgent","9","","37","1","59","","2","9","3","5","","","","116","2014-06-23 10:18:57","37","2014-06-24 08:48:10","","","","");
INSERT INTO complaint VALUES("3661","Maintenance-0002591"," UNLOCK TO BE LOCK IN MINOR OT. SOPD","URGENT","9","","37","1","72","","2","9","3","5","","","","219","2014-06-23 10:33:36","37","2014-06-24 08:50:37","","","","");
INSERT INTO complaint VALUES("3662","Maintenance-0002592","C-ROOM SWITCH BOARD TO BE REPAIRED","PLEASE RECTIFY SOON","5","","23","1","64","","2","5","3","5","","","","110","2014-06-23 10:46:53","23","2014-06-24 15:49:39","","","","");
INSERT INTO complaint VALUES("3663","Maintenance-0002593","BOARD NEED TO FIX.","BOARD NEED TO FIX.","9","","37","1","81","","2","9","3","5","","","","99","2014-06-23 10:53:35","37","2014-06-24 08:50:57","","","","");
INSERT INTO complaint VALUES("3664","MIS-0001070","CRP-14 Monitor is getting switched off","high priority","2","","5","1","40","12","1","2","3","5","","0","","65","2014-06-23 10:54:21","112","2014-06-23 11:22:57","","","","");
INSERT INTO complaint VALUES("3665","Maintenance-0002594","require new intercom connection","urgent","8","","33","1","68","97","2","8","3","5","","","","365","2014-06-23 11:01:55","33","2014-06-24 08:20:36","","","","");
INSERT INTO complaint VALUES("3666","Maintenance-0002595","PAED OPD  ROOM NO 5 COMPUTER CONNECTION
INSERT INTO complaint VALUES("3667","MIS-0001071","N- COMPUTING IS NOT WORKING NEAR WING -4  SYSTEM IPB-03","N- COMPUTING IS NOT WORKING NEAR WING -4  SYSTEM IPB-03","3","","112","1","42","","1","3","3","5","","","","373","2014-06-23 11:17:06","112","2014-06-23 11:39:16","","","","");
INSERT INTO complaint VALUES("3668","Maintenance-0002596","Water is not coming in the wash room( staff ladies Toilet) near mortuary ","Urgent","6","","32","1","115","","2","6","3","5","","","","149","2014-06-23 11:23:54","32","2014-06-23 13:21:12","","","","");
INSERT INTO complaint VALUES("3669","Maintenance-0002597","There is an painting work and wheel changing work in the trolley","Urgent","7","","28","1","115","","2","7","3","3","1","","wheel no stock non to be raised by next indent ","149","2014-06-23 11:26:01","28","2014-06-25 12:29:12","","","","");
INSERT INTO complaint VALUES("3670","Maintenance-0002598","oxygen trolley - oxygen cylinder empty","do ASAP","7","","28","1","49","242","2","7","3","5","","","","97","2014-06-23 11:37:58","28","2014-06-23 14:39:01","","","","");
INSERT INTO complaint VALUES("3671","Maintenance-0002599","The switch board of the male doctor\'s rest room has to be changed, seems there is a loose connection.","Please rectify the issue immediately","5","","25","1","98","","2","5","3","5","","","","151","2014-06-23 11:38:57","25","2014-06-24 08:25:50","","","","");
INSERT INTO complaint VALUES("3672","MIS-0001072","pcw-02 system not working","do rectify iommediately","3","","5","1","49","","1","3","3","5","","","","97","2014-06-23 11:45:38","5","2014-06-23 11:48:55","","","","");
INSERT INTO complaint VALUES("3673","Maintenance-0002600","OBG Office - Water is not flushing out.","Please rectify the issue immediately","6","","32","1","98","","2","6","3","5","","","","151","2014-06-23 11:47:03","32","2014-06-23 13:21:23","","","","");
INSERT INTO complaint VALUES("3674","Maintenance-0002601","TABLE KEY BOARD DRAWER TO BE FIXED","N THE 2 ND WORK STATION","9","","37","1","28","","2","9","3","5","","","","117","2014-06-23 11:56:59","37","2014-06-24 08:46:06","","","","");
INSERT INTO complaint VALUES("3675","Maintenance-0002602","suction pressure is very low","suction pressure is very low","7","","28","1","53","","2","7","3","2","","","","119","2014-06-23 12:29:16","227","2014-06-23 12:29:40","","","","");
INSERT INTO complaint VALUES("3676","Maintenance-0002603","In nurses station  drawer\'s   wooden  piece has come out to be fix ","In nurses station  drawer\'s   wooden  piece has come out to be fix ","9","","37","1","54","221","2","9","3","5","","","","73","2014-06-23 12:51:10","37","2014-06-24 08:47:52","","","","");
INSERT INTO complaint VALUES("3677","MIS-0001073","Unable to send mails from Zimbra Desktop.","This displaying message no such message exists.Attached screenshot.","3","","5","1","69","","1","3","3","5","","","","35","2014-06-23 12:56:38","5","2014-06-23 14:49:05","20140623125638_Zimbra Desktop.bmp","","","");
INSERT INTO complaint VALUES("3678","Maintenance-0002604","To put tarpaulin on the  roof  of patient waiting area.","please consider this on priority.","9","","37","1","18","217","2","9","3","5","","","","64","2014-06-23 13:10:52","37","2014-06-24 08:44:21","","","","");
INSERT INTO complaint VALUES("3679","Maintenance-0002605","door 1/2 gap to be rectified ","as soon as possible","9","","37","1","90","","2","9","3","3","9","","Door gap should be closed by led based wood coz radiation should be avoid hence outsource to be done ","70","2014-06-23 13:38:43","37","2014-06-24 08:53:30","","","","");
INSERT INTO complaint VALUES("3680","Maintenance-0002606","ct scan  door to be rectified","as soon as possible","9","","37","1","91","","2","9","3","3","9","","Door gap should be closed by led based wood coz radiation should be avoid hence outsource to be done ","70","2014-06-23 13:39:42","37","2014-06-24 08:54:05","","","","");
INSERT INTO complaint VALUES("3681","MIS-0001074","MOUSE IS NOT WORKING","PLEASE RECTIFY SOON","3","","5","1","64","22","1","3","3","5","","","","110","2014-06-23 13:41:29","5","2014-06-23 14:35:39","","","","");
INSERT INTO complaint VALUES("3682","Maintenance-0002607","Please do our service maintenance on distal water planet. 
INSERT INTO complaint VALUES("3683","Maintenance-0002608","Needed aluninium stilet","needed urgently","9","","37","1","49","","2","9","3","5","","","","95","2014-06-23 14:24:00","37","2014-06-24 08:46:34","","","","");
INSERT INTO complaint VALUES("3684","MIS-0001075","Patient name : Monika
INSERT INTO complaint VALUES("3685","MIS-0001076","Printer is not working.","urgrnt","2","","112","1","62","","1","2","3","5","","0","","107","2014-06-23 15:06:40","112","2014-06-23 15:18:14","","","","");
INSERT INTO complaint VALUES("3686","Maintenance-0002609","A-ROOM TAP IS LEAKING","PLEASE RECTIFY SOON","6","","30","1","64","","2","6","3","5","","","","110","2014-06-23 15:12:50","30","2014-06-24 08:57:42","","","","");
INSERT INTO complaint VALUES("3687","Maintenance-0002610"," Bath room smells very badly after cleaning & after cleaning with powder by the plumper ","urgent","6","","30","1","65","349","2","6","3","2","","","","84","2014-06-23 15:32:08","30","2014-06-24 08:58:26","","","","");
INSERT INTO complaint VALUES("3688","Maintenance-0002611","New hostel: Sink is blocked
INSERT INTO complaint VALUES("3689","Maintenance-0002612","ROOM NO 1518 COT SIDE RAILS ARE NOT PROPER, WHILE PUSHING TOWARDS DOWN THE FIRST LINE GETS STRUCK AND IT  GETS HURT.","KINDLY DO IMMEDIATELY","7","","28","1","49","238","2","7","3","5","","","","97","2014-06-23 15:34:57","28","2014-06-24 08:22:15","","","","");
INSERT INTO complaint VALUES("3690","Maintenance-0002613","oxygen cylinder 2 No\'s is empty","please send fast","7","","28","1","64","","2","7","3","5","","","","110","2014-06-23 15:48:31","28","2014-06-24 08:22:50","","","","");
INSERT INTO complaint VALUES("3691","MIS-0001077","Sal -02 system is very slow while entering data and taking reports.","Sal -02 system is very slow while entering data and taking reports.","3","","5","1","39","","1","3","3","5","","","","349","2014-06-23 15:54:47","5","2014-06-23 16:40:17","","","","");
INSERT INTO complaint VALUES("3692","Maintenance-0002614"," Recurrent leakage of water from the sink.","URGENT","6","","32","1","56","91","2","6","3","3","6","","major work out source work to be done","192","2014-06-24 08:02:57","32","2014-06-24 15:53:24","","","","");
INSERT INTO complaint VALUES("3693","Maintenance-0002615","high risk labour room nurses calling bell switchboard is broken.","needs urgent","8","","33","1","59","","2","8","3","3","9","","out source work to be done","116","2014-06-24 08:06:27","33","2014-06-24 15:23:17","","","","");
INSERT INTO complaint VALUES("3694","Maintenance-0002616","CCU Bed #3 there is no bell switch.","Please fix it as soon as possible.","8","","33","1","52","","2","8","3","5","","","","128","2014-06-24 08:09:25","33","2014-06-24 15:21:56","","","","");
INSERT INTO complaint VALUES("3695","Maintenance-0002617","CAUTION BOARD TO BE FIXED FOR X-RAY ROOM","CAUTION BOARD TO BE FIXED FOR X-RAY ROOM","9","","37","1","90","","2","9","3","5","","","","70","2014-06-24 08:18:05","37","2014-06-24 16:26:57","","","","");
INSERT INTO complaint VALUES("3696","Maintenance-0002618","1.aluminum door not  closing  in  the preop area.
INSERT INTO complaint VALUES("3697","Maintenance-0002619","Toilet Door Handle to be fixed","please rectify soon","9","","37","1","64","331","2","9","3","5","","","","110","2014-06-24 08:37:46","37","2014-06-24 16:26:10","","","","");
INSERT INTO complaint VALUES("3698","Maintenance-0002620","J-Room Tap is leaking","Please rectify soon","6","","32","1","64","","2","6","3","5","","","","110","2014-06-24 08:38:20","32","2014-06-24 15:45:38","","","","");
INSERT INTO complaint VALUES("3699","Maintenance-0002621","Tubelight is not working","Please rectify soon","5","","25","1","64","339","2","5","3","5","","","","110","2014-06-24 08:39:21","25","2014-06-24 15:51:06","","","","");
INSERT INTO complaint VALUES("3700","Maintenance-0002622","high risk labour room cup board locker to be fixed","needs urgent","9","","37","1","59","","2","9","3","5","","","","116","2014-06-24 08:44:35","37","2014-06-24 16:24:34","","","","");
INSERT INTO complaint VALUES("3701","Maintenance-0002623","ALL ROOMS PATIENT ATTENDER COT AND PATIENT SHIFTING TROLLEY NEEDS PAINTING","DO ASAP","9","","37","1","49","242","2","9","3","3","6","","paint no stock","97","2014-06-24 08:48:19","37","2014-06-24 16:25:16","","","","");
INSERT INTO complaint VALUES("3702","Maintenance-0002624","C-Room Flush To be repaired","Please rectify soon","6","","32","1","64","","2","6","3","5","","","","110","2014-06-24 09:04:32","32","2014-06-24 15:43:13","","","","");
INSERT INTO complaint VALUES("3703","MIS-0001078","PATIENT NO.AA263448, SUDHA NAIR, COMPUTER IS SHOWING DOUBLE DOUBLE VALUE IN THE PROVISIONAL BILL","PATIENT NO.AA263448, SUDHA NAIR, COMPUTER IS SHOWING DOUBLE DOUBLE VALUE IN THE PROVISIONAL BILL","3","","9","1","42","","1","3","3","5","","","","118","2014-06-24 09:09:17","5","2014-06-24 15:55:11","","","","");
INSERT INTO complaint VALUES("3704","MIS-0001079","1. Not able to obtain diagnosis only in W4 and W5.
INSERT INTO complaint VALUES("3705","MIS-0001080","Regarding Niranjan Dev Patient  MRD No AA253194 we need hole pharmacy prescription but in system some of the few  prescription only.Please check this issue patient will come to collect the set of Reimbursement. ","Regarding Niranjan Dev Patient  MRD No AA253194 we need hole pharmacy prescription but in system some of the few  prescription only.Please check this issue patient will come to collect the set of Reimbursement. ","3","","6","1","43","","1","3","3","2","","","","223","2014-06-24 09:16:50","5","2014-06-25 16:30:29","","","","");
INSERT INTO complaint VALUES("3706","MIS-0001081","Opt -o1 Systems Task bar menu is hiding please rectify ","Urgent","3","","5","1","58","","1","3","3","5","","","","121","2014-06-24 09:18:29","5","2014-06-24 09:20:42","","","","");
INSERT INTO complaint VALUES("3707","Maintenance-0002625","NTS,Rear gate &Mens hostel camera\'s not working.","NTS,Rear gate & Mens hostel camera\'s not working.","8","","33","1","70","","2","8","3","5","","","","350","2014-06-24 09:46:24","227","2014-06-24 10:01:10","","","","");
INSERT INTO complaint VALUES("3708","Maintenance-0002626","screw to be fixed for two spotlight","urgent","5","","25","1","60","285","2","5","3","5","","","","263","2014-06-24 09:47:28","25","2014-06-24 15:51:45","","","","");
INSERT INTO complaint VALUES("3709","MIS-0001082","SYSTEM ARE VERY SLOW","SYSTEM ARE VERY SLOW","3","","5","1","16","19","1","3","3","5","","","","132","2014-06-24 10:26:14","5","2014-06-24 16:00:37","","","","");
INSERT INTO complaint VALUES("3710","MIS-0001083","pediatric O.P.D. P- 4[ROOM NO.] computer not working.","urgently do the needful.","3","","5","1","79","","1","3","3","5","","","","216","2014-06-24 10:40:45","5","2014-06-24 11:07:05","","","","");
INSERT INTO complaint VALUES("3711","Maintenance-0002627","E-4 SUCTION APPARATUS IS NOT WORKING","PLEASE SEND FAST","7","","28","1","64","24","2","7","3","5","","","","110","2014-06-24 10:56:06","28","2014-06-24 15:36:45","","","","");
INSERT INTO complaint VALUES("3712","Maintenance-0002628","Delux ward lobby the patient  attender waiting area -chair  screw  to be fix","please do the needful","7","","28","1","50","","2","7","3","2","","","","125","2014-06-24 10:58:11","227","2014-06-24 11:10:15","","","","");
INSERT INTO complaint VALUES("3713","Maintenance-0002629","2 fridge thermometer has to be installed.","very urgent.","7","","28","1","68","","2","7","3","5","","","","392","2014-06-24 11:01:34","28","2014-06-25 12:29:28","","","","");
INSERT INTO complaint VALUES("3714","Maintenance-0002630","Medical Library needs to be painted, (white wash) ","Medical Library needs to be painted, (white wash) ","11","","21","1","25","","2","11","3","2","","","","152","2014-06-24 11:03:55","227","2014-06-24 11:10:44","","","","");
INSERT INTO complaint VALUES("3715","MIS-0001084","CRP-  08 ; CRP- 12 
INSERT INTO complaint VALUES("3716","Maintenance-0002631","flush to be repaired in ENT gents toilet.","urgent","6","","32","1","47","112","2","6","3","5","","","","149","2014-06-24 11:28:51","32","2014-06-24 15:52:43","","","","");
INSERT INTO complaint VALUES("3717","Maintenance-0002632","Main door stopper  to  be  repaired","New door  stopper  to  be fixed","9","","37","1","37","131","2","9","3","5","","","","150","2014-06-24 11:30:28","37","2014-06-24 16:25:44","","","","");
INSERT INTO complaint VALUES("3718","MIS-0001085","Dear madam, please update the following system to windows-7 \\\\bbh-pms-01, \\\\bbh-pms-02, \\\\bbh-pms-03, \\\\bbh-pms-04,  and N-computing also.","Dear madam, please update the following system to windows-7 \\\\bbh-pms-01, \\\\bbh-pms-02, \\\\bbh-pms-03, \\\\bbh-pms-04,  and N-computing also.","3","","5","1","38","","1","3","3","5","","","","78","2014-06-24 11:36:56","5","2014-06-24 12:50:01","","","","");
INSERT INTO complaint VALUES("3719","Maintenance-0002633","GYNEA OPD SINK BLOCKED.","VERY URGENT.","6","","32","1","73","104","2","6","3","5","","","","211","2014-06-24 11:49:01","32","2014-06-24 15:41:56","","","","");
INSERT INTO complaint VALUES("3720","MIS-0001086","printer is not working.","urgent","2","","5","1","62","","1","2","3","5","","0","","107","2014-06-24 11:51:08","5","2014-06-24 12:50:20","","","","");
INSERT INTO complaint VALUES("3721","MIS-0001087","Print from the printer is scattered and non readable. ","Rectified several times from the month of May
INSERT INTO complaint VALUES("3722","Maintenance-0002634","wall oxygen flow meter to be fixed","needs urgent","7","","28","1","59","","2","7","3","5","","","","116","2014-06-24 11:57:57","28","2014-06-25 12:20:58","","","","");
INSERT INTO complaint VALUES("3723","MIS-0001088","Printer  to be connected to the computer in C S S D","Very urgent","2","","112","1","57","","1","2","3","5","","0","","362","2014-06-24 12:13:12","112","2014-06-24 13:14:00","","","","");
INSERT INTO complaint VALUES("3724","Maintenance-0002635","2nd floor lab one fan blade broken","complaint received on 23/06/2014  6.00pm","5","","22","1","17","","2","5","3","7","","","","225","2014-06-24 12:20:12","225","2014-06-24 13:57:16","","","","");
INSERT INTO complaint VALUES("3725","Maintenance-0002636","C-room switch plate broken","complaint received on 23/06/2014  6.30pm","5","","22","1","64","","2","5","3","7","","","","225","2014-06-24 12:21:03","225","2014-06-24 13:57:01","","","","");
INSERT INTO complaint VALUES("3726","Maintenance-0002637","student hostel old building tap leaking ","complaint received on 23/06/2014  7.15pm","6","","31","2","2","","2","6","3","7","","","","225","2014-06-24 12:22:02","225","2014-06-24 13:56:34","","","","");
INSERT INTO complaint VALUES("3727","Maintenance-0002638","O2 cylinder is empty","complaint received on 23/06/2014  9.00pm","5","","22","1","64","","2","5","3","7","","","","225","2014-06-24 12:22:48","225","2014-06-24 13:55:23","","","","");
INSERT INTO complaint VALUES("3728","Maintenance-0002639","Chimney to be fixed for the exhaust in Endoscopy to divert the fumes from the patient area. ","urgent ","12","","386","1","112","","2","12","3","2","","","","205","2014-06-24 12:34:23","227","2014-06-24 13:02:25","","","","");
INSERT INTO complaint VALUES("3729","Maintenance-0002640","Painting to be done at 
INSERT INTO complaint VALUES("3730","Maintenance-0002641","Overall height of the geriatric couch to be reduced as per the markings","urgent","12","","386","1","71","","2","12","3","2","","","","205","2014-06-24 12:45:29","227","2014-06-24 13:02:40","","","","");
INSERT INTO complaint VALUES("3731","Maintenance-0002642","Require to replace bulb in the Bathroom. Guest house park view. ","Urgent","5","","23","3","113","","2","5","3","5","","","","259","2014-06-24 12:51:02","23","2014-06-24 15:50:04","","","","");
INSERT INTO complaint VALUES("3732","MIS-0001089","In Accpac ,when you open  Result view, test details-shows test name along with triple cross.The Cross was not comming along with the test name earlier.","Urgent","3","","6","1","17","","1","3","3","5","","","","300","2014-06-24 12:51:26","5","2014-06-25 15:37:06","20140624125126_mis.doc","","","");
INSERT INTO complaint VALUES("3733","MIS-0001090","ADVT Matter - back full page colour
INSERT INTO complaint VALUES("3734","Maintenance-0002643","One of the light in the PC lobby is blinking near kshema jeevana.","One of the light in the PC lobby is blinking near kshema jeevana. (Light is not glowing)","5","","23","1","102","","2","5","3","5","","","","243","2014-06-24 13:04:39","23","2014-06-24 15:48:37","","","","");
INSERT INTO complaint VALUES("3735","MIS-0001091","SYSTEM IS VERY SLOW","SYSTEM IS VERY SLOW","3","","5","1","16","19","1","3","3","5","","","","132","2014-06-24 13:26:45","5","2014-06-24 14:09:52","","","","");
INSERT INTO complaint VALUES("3736","MIS-0001092","SYSTEM IS VERY SLOW","SYSTEM IS VERY SLOW","3","","5","1","16","18","1","3","3","5","","","","132","2014-06-24 13:35:25","5","2014-06-24 14:10:04","","","","");
INSERT INTO complaint VALUES("3737","Maintenance-0002644","O2 cylinder is empty ","complaint received on 23/06/2014  11.30pm","7","","27","1","62","","2","7","3","7","","","","225","2014-06-24 13:46:32","225","2014-06-24 13:55:12","","","","");
INSERT INTO complaint VALUES("3738","Maintenance-0002645","O2 cylinder is empty","complaint received on 23/062014 11.45pm","7","","27","1","63","","2","7","3","7","","","","225","2014-06-24 13:47:29","225","2014-06-24 13:55:01","","","","");
INSERT INTO complaint VALUES("3798","MIS-0001105","Printer is not working ","urgent











