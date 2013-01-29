# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.9)
# Database: photolotto
# Generation Time: 2013-01-29 05:27:11 +0000
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
  `client_name` varchar(255) DEFAULT NULL,
  `client_contact` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `postcode` varchar(4) DEFAULT NULL,
  `state` varchar(3) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;

INSERT INTO `companies` (`id`, `name`, `client_name`, `client_contact`, `email`, `address1`, `address2`, `phone`, `postcode`, `state`, `updated_by`, `created`, `updated`, `status`)
VALUES
	(1,'FlyDigital','FlyDigital','1234','test@yahoo.','Sydney, Australia','','4054645645','1111','1',0,'0000-00-00 00:00:00','2012-12-14 22:47:06',1),
	(2,'Photo Lotto',NULL,NULL,NULL,'Sydney, Australia','','22222222','2222','1',0,'2012-12-03 23:51:59','2012-12-03 23:51:59',1),
	(3,'AA Compay',NULL,NULL,NULL,'1','3','4','2','1',0,'2012-12-14 06:24:40','2012-12-14 06:24:40',1),
	(4,'AA Company','','','','Address1','Address2','1234','3168','1',0,'2012-12-14 06:25:40','2013-01-10 10:54:28',1),
	(5,'BB Company','BB','bb','bb','bb','bb','bb','bb','1',0,'2012-12-16 06:25:15','2012-12-16 06:25:15',1),
	(6,'CC Company','CC Company','123','test@yahoo.','dd','','1234','3168',NULL,0,'2012-12-16 23:41:04','2012-12-16 23:41:04',1),
	(7,'The Grounds!','The Grounds ','Jason James','jason@groun','','','','',NULL,0,'2012-12-17 16:48:19','2012-12-17 16:48:19',1);

/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table event_actions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `event_actions`;

CREATE TABLE `event_actions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `phone_id` varchar(64) DEFAULT NULL,
  `blacklist` tinyint(1) DEFAULT NULL,
  `phone_type` varchar(32) DEFAULT NULL,
  `action_name` varchar(64) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `event_actions` WRITE;
/*!40000 ALTER TABLE `event_actions` DISABLE KEYS */;

INSERT INTO `event_actions` (`id`, `event_id`, `phone_id`, `blacklist`, `phone_type`, `action_name`, `photo`, `created`)
VALUES
	(1,1,'1231231',1,'IOS','album','i_20121217181812.jpg','2012-12-08 12:56:33'),
	(2,2,'9711db979907e2b6ee6870e9ca54207e3471d082',1,'IOS','save_to_album','i_20121217181812.jpg','2012-12-17 04:20:33'),
	(3,1,'twertwertw',0,'IOS','album','i_20130121140209.jpg','2013-01-21 15:38:50'),
	(4,1,'',1,'IOS','','','2013-01-28 18:53:39'),
	(5,5,'1234123',1,'IOS','album','test.jpg','2013-01-28 19:01:43'),
	(6,6,'1234123',0,'IOS','album','test.jpg','2013-01-28 19:02:25'),
	(7,6,'1234123',0,'IOS','album','test.jpg','2013-01-28 19:36:35'),
	(8,6,'1234123',0,'IOS','album','test.jpg','2013-01-28 19:36:38');

/*!40000 ALTER TABLE `event_actions` ENABLE KEYS */;
UNLOCK TABLES;


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
  `auto_moderate` tinyint(1) DEFAULT NULL,
  `facebook_msg` varchar(420) DEFAULT NULL,
  `facebook_url` varchar(500) DEFAULT NULL,
  `twitter_msg` varchar(120) DEFAULT NULL,
  `html_before` text,
  `html_after` text,
  `stage` varchar(10) DEFAULT NULL,
  `img_thumb` varchar(100) DEFAULT NULL,
  `img_overlay_1` varchar(100) DEFAULT NULL,
  `img_overlay_2` varchar(100) DEFAULT NULL,
  `img_overlay_3` varchar(100) DEFAULT NULL,
  `img_overlay_4` varchar(100) DEFAULT NULL,
  `img_overlay_5` varchar(100) DEFAULT NULL,
  `public_logo` varchar(100) DEFAULT NULL,
  `public_description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;

INSERT INTO `events` (`id`, `name`, `company_id`, `shortdescription`, `eventtype`, `gpslat`, `gpslong`, `date_start`, `date_end`, `updated_by`, `auto_moderate`, `facebook_msg`, `facebook_url`, `twitter_msg`, `html_before`, `html_after`, `stage`, `img_thumb`, `img_overlay_1`, `img_overlay_2`, `img_overlay_3`, `img_overlay_4`, `img_overlay_5`, `public_logo`, `public_description`, `status`, `created`, `updated`)
VALUES
	(1,'Test Event 1',2,'Event Description','generic','-30','155','2013-01-10 00:00:00','2013-01-30 00:00:00',1,0,'Fb message','http://facebook.com','TW message','http://sheldonbrown.com/web_sample1.html','http://sheldonbrown.com/web_sample1.htmlHTML After','Scheduled','/img/events/1_thumb.jpg','','/img/events/1_overlay2.jpg','','','','Test Event 1 logo','Test Event 1 description',1,'2012-12-08 12:43:09','2013-01-10 10:40:53'),
	(2,'Test Event 2',1,'Test Desc','generic','-30','150','2012-12-29 00:00:00','2013-01-26 00:00:00',2,1,'Fb message','http://facebook.com','TW message','test','test','Running','/img/events/2_thumb.jpg','/img/events/2_overlay1.jpg','/img/events/2_overlay2.jpg',NULL,NULL,NULL,'Test Event 1 logo','Test Event 1 description',1,'2012-12-08 12:45:06','2012-12-08 12:45:06'),
	(3,'Test Event 3',1,'Test Description','generic','-30','150','2012-12-10 00:00:00','2012-12-29 00:00:00',1,1,'Fb message','http://facebook.com','TW message','<html>\r\n<title>Page title</title>\r\n<body>\r\n This is a test page Before HTML\r\n</body>\r\n</htm>','<html>\r\n<title>Page title</title>\r\n<body>\r\n This is a test page After HTML\r\n</body>\r\n</htm>','Scheduled','/img/events/3_thumb.jpg','/img/events/3_overlay1.jpg','/img/events/3_overlay2.jpg','/img/events/3_overlay3.jpg','/img/events/3_overlay4.jpg','/img/events/3_overlay5.jpg',NULL,NULL,1,'2012-12-09 23:39:28','2012-12-10 23:26:27'),
	(4,'test 8',1,'','generic','','',NULL,NULL,1,1,'','','','','','Draft','/img/events/4-image-1-1y7ed.png','/img/events/4-1-image-1-1y7ed.png','/img/events/4-2-image-2-cda0j.png','/img/events/4-3-image-5gd0m.png',NULL,NULL,NULL,NULL,1,'2012-12-10 10:14:42','2013-01-13 22:11:18'),
	(5,'I\'m at the Grounds of Alexandria',7,'#thegrounds','location-based','-33.911063','151.19359','2013-01-13 00:00:00','2013-01-30 00:00:00',1,1,'Eat this!','www.thegrounds.com.au','#thegrounds','','','Scheduled','/img/events/5-Untitled-1.png','/img/events/5-1-image-1-1y7ed.png','/img/events/5-2-image-2-cda0j.png','/img/events/5-3-image-5gd0m.png',NULL,NULL,NULL,NULL,1,'2012-12-17 16:54:27','2013-01-13 22:06:03'),
	(6,'Test Raf',6,'wertwert','location-based','105','106','2013-01-31 00:00:00','2013-02-27 00:00:00',1,0,'asfdasdf','werqw','sadfasdfa','dfssdfg','fsdfasd','Scheduled','/Applications/MAMP/htdocs/PhotoLotto_cms/app/webroot//img/events/6-eye3.png','/Applications/MAMP/htdocs/PhotoLotto_cms/app/webroot//img/events/6-1-eye1.png','/Applications/MAMP/htdocs/PhotoLotto_cms/app/webroot//img/events/6-2-eye2-31nwl.png','/Applications/MAMP/htdocs/PhotoLotto_cms/app/webroot//img/events/6-3-eye3.png',NULL,NULL,'','asdfasdfa',1,'2013-01-28 18:31:19','2013-01-28 18:31:19');

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
  `company_id` int(11) DEFAULT NULL,
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

INSERT INTO `users` (`id`, `role_id`, `company_id`, `name`, `email`, `password`, `status`, `created`, `updated`)
VALUES
	(1,1,1,'Rafiqul Islam','mrafiq1465@yahoo.com','password',1,NULL,NULL),
	(2,1,1,'Stefan Drury','stefan@flydigital.com.au','password',1,NULL,'2012-12-09 23:50:50'),
	(3,1,1,'Test user','test@yahoo.com','test',1,'2012-12-09 23:53:52','2012-12-09 23:53:52');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
