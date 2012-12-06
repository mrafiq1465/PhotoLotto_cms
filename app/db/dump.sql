# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: academicearthdb.cwnf7l7s0tqx.us-west-2.rds.amazonaws.com (MySQL 5.5.20-log)
# Database: photolotto
# Generation Time: 2012-12-06 05:14:22 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table companies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `postcode` varchar(4) DEFAULT NULL,
  `state` varchar(3) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;

INSERT INTO `companies` (`id`, `name`, `address1`, `address2`, `phone`, `postcode`, `state`, `updated_by`, `created`, `updated`, `status`)
VALUES
	(1,'FlyDigital','Sydney, Australia','','4054645645','1111',NULL,0,'0000-00-00 00:00:00','2012-12-03 23:51:12',NULL),
	(2,'Photo Lotto','Sydney, Australia','','22222222','2222',NULL,0,'2012-12-03 23:51:59','2012-12-03 23:51:59',NULL);

/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table event_actions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `event_actions`;

CREATE TABLE `event_actions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `phone_id` varchar(64) DEFAULT NULL,
  `action_name` varchar(64) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table events
# ------------------------------------------------------------

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `shortdescription` varchar(255) DEFAULT NULL,
  `eventtype` varchar(32) DEFAULT NULL,
  `gpslat` varchar(50) DEFAULT NULL,
  `gpslong` varchar(50) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `filter` tinyint(1) DEFAULT NULL,
  `facebook_msg` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `twitter_msg` varchar(255) DEFAULT NULL,
  `html_before` text,
  `html_after` text,
  `stage` varchar(10) DEFAULT NULL,
  `img_thumb` varchar(30) DEFAULT NULL,
  `img_overlay_1` varchar(30) DEFAULT NULL,
  `img_overlay_2` varchar(30) DEFAULT NULL,
  `img_overlay_3` varchar(30) DEFAULT NULL,
  `img_overlay_4` varchar(30) DEFAULT NULL,
  `img_overlay_5` varchar(30) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;

INSERT INTO `events` (`id`, `name`, `company_id`, `shortdescription`, `eventtype`, `gpslat`, `gpslong`, `date_start`, `date_end`, `updated_by`, `filter`, `facebook_msg`, `facebook_url`, `twitter_msg`, `html_before`, `html_after`, `stage`, `img_thumb`, `img_overlay_1`, `img_overlay_2`, `img_overlay_3`, `img_overlay_4`, `img_overlay_5`, `status`, `created`, `updated`)
VALUES
	(1,'test 1',1,'test ','location-based','1','1','2012-12-14 00:00:00','2012-12-31 00:00:00',1,1,'test','test','test','test','test','test','/img/events/1_thumb.jpg','/img/events/1_overlay1.jpg',NULL,NULL,NULL,NULL,1,'2012-01-01 00:00:00','2012-12-03 22:20:58'),
	(2,'test 2',2,'test',NULL,'100','120','2012-01-01 00:00:00','2012-01-01 00:00:00',1,1,'test','test','test','test','tes','prod','test.jpg','test.jpg','test.jpg','test.jpg',NULL,NULL,1,'2012-01-01 00:00:00','2012-01-01 00:00:00'),
	(3,'Event test 1',1,'test description','generic','100','110','2012-12-06 00:00:00','2013-01-10 00:00:00',NULL,1,'facebook message','http://fb.','twitter message','HTML Before\r\n','HTML After\r\n','prod','/img/events/3_thumb.jpg','/img/events/3_overlay1.jpg',NULL,NULL,NULL,NULL,1,'2012-12-03 23:55:16','2012-12-03 23:55:17');

/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`)
VALUES
	(1,'admin'),
	(2,'user');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `password`, `status`, `created`, `updated`)
VALUES
	(1,1,'Rafiqul Islam','mrafiq1465@yahoo.com','password',1,NULL,NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
