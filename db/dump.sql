# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: syntaxperfect.cmgtpxgnqaqn.us-west-1.rds.amazonaws.com (MySQL 5.5.27-log)
# Database: photolotto
# Generation Time: 2013-02-18 04:51:10 +0000
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
	(165,5,'f0ceb72e6743a0d812fb6e74ed0b3af8aef28f3d',0,'IOS','post_to_facebook','i_20130217112628.jpg','2013-02-17 11:26:47'),
	(166,6,'63e41e59e235bd8dc690a355a2432bef576ea88c',0,'IOS','(null)','i_20130218083920.jpg','2013-02-17 13:39:36'),
	(167,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',0,'IOS','(null)','i_20130218085346.jpg','2013-02-17 13:53:57'),
	(168,5,'b424300557f83c540e8aae18576921fa1a2a9c23',0,'IOS','(null)','i_20130218115224.jpg','2013-02-17 16:52:37'),
	(169,6,'f0ceb72e6743a0d812fb6e74ed0b3af8aef28f3d',0,'IOS','(null)','i_20130217173322.jpg','2013-02-17 17:33:35'),
	(170,5,'f0ceb72e6743a0d812fb6e74ed0b3af8aef28f3d',0,'IOS','(null)','i_20130217173459.jpg','2013-02-17 17:35:11'),
	(171,5,'f0ceb72e6743a0d812fb6e74ed0b3af8aef28f3d',0,'IOS','(null)','i_20130217173816.jpg','2013-02-17 17:38:30'),
	(172,6,'63e41e59e235bd8dc690a355a2432bef576ea88c',0,'IOS','(null)','i_20130218124744.jpg','2013-02-17 17:48:00'),
	(173,5,'b424300557f83c540e8aae18576921fa1a2a9c23',0,'IOS','(null)','i_20130218125945.jpg','2013-02-17 17:59:54'),
	(174,4,'b424300557f83c540e8aae18576921fa1a2a9c23',0,'IOS','(null)','i_20130218130435.jpg','2013-02-17 18:04:44'),
	(175,5,'b424300557f83c540e8aae18576921fa1a2a9c23',0,'IOS','post_to_facebook','i_20130218131055.jpg','2013-02-17 18:15:04'),
	(176,6,'f0ceb72e6743a0d812fb6e74ed0b3af8aef28f3d',0,'IOS','(null)','i_20130217185111.jpg','2013-02-17 18:51:23'),
	(177,6,'f0ceb72e6743a0d812fb6e74ed0b3af8aef28f3d',0,'IOS','(null)','i_20130217185552.jpg','2013-02-17 18:56:06'),
	(178,6,'63e41e59e235bd8dc690a355a2432bef576ea88c',0,'IOS','save_to_album','i_20130218135608.jpg','2013-02-17 18:56:22');

/*!40000 ALTER TABLE `event_actions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table events
# ------------------------------------------------------------

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `shortdescription_line_1` varchar(60) DEFAULT NULL,
  `shortdescription_line_2` varchar(60) DEFAULT NULL,
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
  `html_before_on` tinyint(1) DEFAULT NULL,
  `html_after` text,
  `html_after_on` tinyint(1) DEFAULT NULL,
  `t_c` text,
  `t_c_on` tinyint(1) DEFAULT NULL,
  `stage` varchar(10) DEFAULT NULL,
  `img_thumb` varchar(100) DEFAULT NULL,
  `img_overlay_1` varchar(100) DEFAULT NULL,
  `img_overlay_2` varchar(100) DEFAULT NULL,
  `img_overlay_3` varchar(100) DEFAULT NULL,
  `img_overlay_4` varchar(100) DEFAULT NULL,
  `img_overlay_5` varchar(100) DEFAULT NULL,
  `public_logo` varchar(100) DEFAULT NULL,
  `public_event_name` varchar(200) DEFAULT NULL,
  `public_description` text,
  `public_phone_number` varchar(32) DEFAULT NULL,
  `public_email` varchar(64) DEFAULT NULL,
  `public_address` varchar(200) DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;

INSERT INTO `events` (`id`, `name`, `company_id`, `shortdescription_line_1`, `shortdescription_line_2`, `eventtype`, `gpslat`, `gpslong`, `date_start`, `date_end`, `updated_by`, `auto_moderate`, `facebook_msg`, `facebook_url`, `twitter_msg`, `html_before`, `html_before_on`, `html_after`, `html_after_on`, `t_c`, `t_c_on`, `stage`, `img_thumb`, `img_overlay_1`, `img_overlay_2`, `img_overlay_3`, `img_overlay_4`, `img_overlay_5`, `public_logo`, `public_event_name`, `public_description`, `public_phone_number`, `public_email`, `public_address`, `status`, `created`, `updated`)
VALUES
	(4,'JOSH TEST',1,'','','generic','','',NULL,'2013-02-04 00:00:00',2,1,'Welcome to PIXTA','','','',0,'<!DOCTYPE html>\r\n<html>\r\n<body>\r\n\r\n<form name=\"input\" action=\"html_form_action.asp\" method=\"get\">\r\n<input type=\"checkbox\" name=\"vehicle\" value=\"Bike\">I have a bike<br>\r\n<input type=\"checkbox\" name=\"vehicle\" value=\"Car\">I have a car \r\n<br><br>\r\n<input type=\"submit\" value=\"Submit\">\r\n</form> \r\n\r\n<p>If you click the \"Submit\" button, the form-data will be sent to a page called \"html_form_action.asp\".</p>\r\n\r\n</body>\r\n</html>\r\n\r\n',1,'',1,'Draft','/img/events/4-POLITElogo.png','/img/events/4-1-Chinese.png','/img/events/4-2-HOMEBAKE.png','/img/events/4-3-JIMBEAM.png','/img/events/4-4-THEGROUNDS.png','/img/events/4-5-garden-floral.png',NULL,'','','','','',1,'2012-12-10 10:14:42','2013-02-11 20:30:07'),
	(5,'I\'m at the Grounds of Alexandria',7,'#thegrounds\r\nCoffee!!!',NULL,'location-based','-33.911063','151.19359','2013-02-04 00:00:00','2013-02-04 00:00:00',2,1,'Eat this!','http://groundsroasters.com/','#thegrounds','http://stage01.degreeamerica.com/index.html',NULL,'http://www.google.com.au',NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mauris ligula, varius et malesuada sed, adipiscing id arcu. Aliquam tincidunt tincidunt nisl, eu tincidunt neque ornare vitae. Proin lacinia pellentesque cursus. Sed fermentum lacus ac dolor fringilla tempus nec at odio. Nullam congue aliquam nisi quis hendrerit. Morbi neque magna, hendrerit a congue ut, molestie vitae eros. Sed ultrices dolor consectetur nisl lacinia et adipiscing lectus euismod. Vestibulum congue sagittis est, et adipiscing leo egestas at. Fusce sagittis quam vitae metus dictum in commodo dui consequat. Duis non pellentesque turpis. Nullam luctus placerat purus, nec congue nibh ullamcorper quis.\r\n\r\nSed tempor metus ac ipsum blandit luctus et eget massa. Aenean venenatis turpis eu urna molestie non sollicitudin lectus facilisis. Duis tincidunt quam sit amet leo sagittis accumsan. Donec erat sapien, facilisis at porta at, mollis at sapien. Vestibulum sem nulla, tempus a facilisis eget, ullamcorper sagittis urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris condimentum magna sed eros ultrices nec consequat ante facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed a velit at erat egestas mattis non ut urna. Quisque ullamcorper tempor est id tempor. Cras ornare auctor sem quis adipiscing. Nullam sed massa at libero aliquet blandit ut ac orci. In feugiat, risus sit amet adipiscing pretium, dolor neque posuere risus, ut luctus eros risus ut ante. Ut dapibus, ante id ornare pharetra, magna turpis tincidunt nisi, et dapibus purus elit at nibh.',NULL,'Scheduled','/img/events/5-Untitled-1.png','/img/events/5-1-image-1-1y7ed.png','/img/events/5-2-image-2-cda0j.png','/img/events/5-3-image-5gd0m.png',NULL,NULL,'/img/events/5-5-Untitled-8.png','I\'m at the Grounds of Alexandria','Made with Skill & Precision','12345678','raf@flydigital.com.au','Surryhills, Sydney',0,'2012-12-17 16:54:27','2013-02-03 16:56:33'),
	(6,'Fly Digital Test Event',1,'Fly Digital first line','Fly Digital second line','location-based','-33.879537','151.105957','2013-02-18 00:00:00','2013-02-18 00:00:00',2,1,'Facebook message from the admin suite here','http://www.flydigital.com.au','Twitter message from the admin suite here','http://www.flydigital.com.au',1,'http://www.flydigital.com.au',1,'These are our terms and conditions',1,'Scheduled','/img/events/6-7.jpg','/img/events/6-1-overlay1.png',NULL,NULL,NULL,NULL,'/img/events/6-facebook.png','Custom Event Name','Welcome to our public event page','','','',1,'2013-02-03 19:28:41','2013-02-17 19:03:38');

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
