# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: syntaxperfect.cmgtpxgnqaqn.us-west-1.rds.amazonaws.com (MySQL 5.5.27-log)
# Database: photolotto
# Generation Time: 2013-02-12 08:34:24 +0000
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
	(30,5,'f0ceb72e6743a0d812fb6e74ed0b3af8aef28f3d',0,'IOS','save_to_album','i_20130131170721.jpg','2013-01-31 17:07:35'),
	(31,5,'f0ceb72e6743a0d812fb6e74ed0b3af8aef28f3d',0,'IOS','post_to_facebook','i_20130131171927.jpg','2013-01-31 17:19:39'),
	(32,5,'f0ceb72e6743a0d812fb6e74ed0b3af8aef28f3d',0,'IOS','save_to_album','i_20130131183640.jpg','2013-01-31 18:36:51'),
	(33,5,'f0ceb72e6743a0d812fb6e74ed0b3af8aef28f3d',0,'IOS','save_to_album','i_20130131184824.jpg','2013-01-31 18:48:34'),
	(34,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',0,'IOS','save_to_album','i_20130201103453.jpg','2013-01-31 20:35:18'),
	(35,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',0,'IOS','post_to_twitter','i_20130201103916.jpg','2013-01-31 20:39:34'),
	(36,1,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',0,'IOS','post_to_twitter','i_20130201105236.jpg','2013-01-31 20:52:47'),
	(37,1,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',0,'IOS','post_to_facebook','i_20130201105239.jpg','2013-01-31 20:52:47'),
	(38,1,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',0,'IOS','post_to_facebook','i_20130201105239.jpg','2013-01-31 20:52:48'),
	(39,5,'63e41e59e235bd8dc690a355a2432bef576ea88c',0,'IOS','post_to_facebook','i_20130201155857.jpg','2013-01-31 20:59:07'),
	(40,5,'63e41e59e235bd8dc690a355a2432bef576ea88c',0,'IOS','save_to_album','i_20130201155911.jpg','2013-01-31 20:59:20'),
	(41,5,'b424300557f83c540e8aae18576921fa1a2a9c23',0,'IOS','post_to_facebook','i_20130201160414.jpg','2013-01-31 21:04:25'),
	(42,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',1,'IOS','post_to_facebook','i_20130201163602.jpg','2013-01-31 21:35:33'),
	(43,5,'63e41e59e235bd8dc690a355a2432bef576ea88c',0,'IOS','post_to_facebook','i_20130201165224.jpg','2013-01-31 21:52:35'),
	(44,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',1,'IOS','post_to_facebook','i_20130201231707.jpg','2013-02-01 04:16:16'),
	(45,5,'b424300557f83c540e8aae18576921fa1a2a9c23',0,'IOS','save_to_album','i_20130202092245.jpg','2013-02-01 14:22:52'),
	(46,5,'b424300557f83c540e8aae18576921fa1a2a9c23',0,'IOS','save_to_album','i_20130204103640.jpg','2013-02-03 15:36:51'),
	(47,4,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','post_to_facebook','i_20130204104051.jpg','2013-02-03 15:41:03'),
	(48,4,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','post_to_twitter','i_20130204104155.jpg','2013-02-03 15:42:05'),
	(49,1,'b424300557f83c540e8aae18576921fa1a2a9c23',0,'IOS','save_to_album','i_20130204104405.jpg','2013-02-03 15:44:16'),
	(50,5,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','post_to_facebook','i_20130204112317.jpg','2013-02-03 16:23:38'),
	(51,5,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','save_to_album','i_20130204112443.jpg','2013-02-03 16:25:00'),
	(52,5,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','post_to_twitter','i_20130204112632.jpg','2013-02-03 16:26:48'),
	(53,4,'63e41e59e235bd8dc690a355a2432bef576ea88c',1,'IOS','post_to_facebook','i_20130204131444.jpg','2013-02-03 18:14:51'),
	(54,4,'63e41e59e235bd8dc690a355a2432bef576ea88c',1,'IOS','post_to_twitter','i_20130204131440.jpg','2013-02-03 18:14:51'),
	(55,6,'63e41e59e235bd8dc690a355a2432bef576ea88c',0,'IOS','post_to_facebook','i_20130204142955.jpg','2013-02-03 19:30:08'),
	(56,6,'63e41e59e235bd8dc690a355a2432bef576ea88c',0,'IOS','post_to_facebook','i_20130204143957.jpg','2013-02-03 19:40:26'),
	(57,6,'63e41e59e235bd8dc690a355a2432bef576ea88c',0,'IOS','save_to_album','i_20130204144218.jpg','2013-02-03 19:42:34'),
	(58,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130205233321.jpg','2013-02-05 09:34:10'),
	(59,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130206234649.jpg','2013-02-06 09:47:13'),
	(60,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130206234914.jpg','2013-02-06 09:49:38'),
	(61,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130206234914.jpg','2013-02-06 09:49:39'),
	(62,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_twitter','i_20130206234937.jpg','2013-02-06 09:49:43'),
	(63,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_twitter','i_20130206234943.jpg','2013-02-06 09:49:52'),
	(64,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_twitter','i_20130206234943.jpg','2013-02-06 09:49:59'),
	(65,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130207224236.jpg','2013-02-07 08:42:58'),
	(66,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130207224408.jpg','2013-02-07 08:44:25'),
	(67,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130207224408.jpg','2013-02-07 08:44:27'),
	(68,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130207224408.jpg','2013-02-07 08:44:41'),
	(69,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130207224408.jpg','2013-02-07 08:44:48'),
	(70,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130207224453.jpg','2013-02-07 08:45:14'),
	(71,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130207224453.jpg','2013-02-07 08:45:21'),
	(72,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130207225234.jpg','2013-02-07 08:52:51'),
	(73,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130207225236.jpg','2013-02-07 08:53:11'),
	(74,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130207225236.jpg','2013-02-07 08:53:11'),
	(75,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130207225236.jpg','2013-02-07 08:53:11'),
	(76,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130207225236.jpg','2013-02-07 08:53:11'),
	(77,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130207225315.jpg','2013-02-07 08:53:38'),
	(78,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130208000623.jpg','2013-02-07 10:06:34'),
	(79,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130208000625.jpg','2013-02-07 10:06:38'),
	(80,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130208000625.jpg','2013-02-07 10:06:54'),
	(81,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130208000625.jpg','2013-02-07 10:06:59'),
	(82,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130208163643.jpg','2013-02-08 02:37:11'),
	(83,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130209215457.jpg','2013-02-09 07:56:18'),
	(84,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130209220150.jpg','2013-02-09 08:02:42'),
	(85,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130209221559.jpg','2013-02-09 08:16:37'),
	(86,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130209222146.jpg','2013-02-09 08:22:09'),
	(87,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130209222300.jpg','2013-02-09 08:23:27'),
	(88,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130210125343.jpg','2013-02-09 22:55:04'),
	(89,4,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130210125421.jpg','2013-02-09 22:55:57'),
	(90,6,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130210131838.jpg','2013-02-09 23:19:14'),
	(91,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130210132450.jpg','2013-02-09 23:25:16'),
	(92,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_twitter','i_20130210133158.jpg','2013-02-09 23:34:01'),
	(93,4,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_twitter','i_20130210133350.jpg','2013-02-09 23:34:17'),
	(94,4,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130210133457.jpg','2013-02-09 23:35:45'),
	(95,4,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130210133820.jpg','2013-02-09 23:39:12'),
	(96,4,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130210134123.jpg','2013-02-09 23:41:54'),
	(97,5,'63e41e59e235bd8dc690a355a2432bef576ea88c',1,'IOS','post_to_facebook','i_20130210200856.jpg','2013-02-10 01:09:09'),
	(98,6,'63e41e59e235bd8dc690a355a2432bef576ea88c',1,'IOS','post_to_facebook','i_20130210201006.jpg','2013-02-10 01:10:18'),
	(99,6,'63e41e59e235bd8dc690a355a2432bef576ea88c',1,'IOS','post_to_facebook','i_20130210201010.jpg','2013-02-10 01:10:18'),
	(100,6,'63e41e59e235bd8dc690a355a2432bef576ea88c',1,'IOS','save_to_album','i_20130210203531.jpg','2013-02-10 01:35:43'),
	(101,5,'f0ceb72e6743a0d812fb6e74ed0b3af8aef28f3d',1,'IOS','post_to_facebook','i_20130210014842.jpg','2013-02-10 01:49:04'),
	(102,6,'f0ceb72e6743a0d812fb6e74ed0b3af8aef28f3d',1,'IOS','post_to_facebook','i_20130210122314.jpg','2013-02-10 12:23:24'),
	(103,5,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','post_to_facebook','i_20130211091351.jpg','2013-02-10 14:14:07'),
	(104,5,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','post_to_facebook','i_20130211091359.jpg','2013-02-10 14:14:26'),
	(105,5,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','save_to_album','i_20130211092039.jpg','2013-02-10 14:20:54'),
	(106,5,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','save_to_album','i_20130211092039.jpg','2013-02-10 14:20:55'),
	(107,5,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','save_to_album','i_20130211092039.jpg','2013-02-10 14:20:55'),
	(108,5,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','save_to_album','i_20130211092039.jpg','2013-02-10 14:20:55'),
	(109,5,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','save_to_album','i_20130211092039.jpg','2013-02-10 14:20:59'),
	(110,5,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','post_to_facebook','i_20130211092540.jpg','2013-02-10 14:26:04'),
	(111,5,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','post_to_facebook','i_20130211092540.jpg','2013-02-10 14:26:04'),
	(112,5,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','post_to_facebook','i_20130211092540.jpg','2013-02-10 14:26:05'),
	(113,5,'63e41e59e235bd8dc690a355a2432bef576ea88c',1,'IOS','post_to_facebook','i_20130211101850.jpg','2013-02-10 15:19:09'),
	(114,6,'63e41e59e235bd8dc690a355a2432bef576ea88c',1,'IOS','post_to_facebook','i_20130211101917.jpg','2013-02-10 15:19:26'),
	(115,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',1,'IOS','save_to_album','i_20130211110226.jpg','2013-02-10 16:02:01'),
	(116,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',1,'IOS','post_to_twitter','i_20130211110234.jpg','2013-02-10 16:02:01'),
	(117,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',1,'IOS','post_to_twitter','i_20130211110234.jpg','2013-02-10 16:02:02'),
	(118,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',1,'IOS','post_to_facebook','i_20130211124119.jpg','2013-02-10 17:41:28'),
	(119,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',1,'IOS','post_to_twitter','i_20130211124142.jpg','2013-02-10 17:41:29'),
	(120,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',1,'IOS','save_to_album','i_20130211124139.jpg','2013-02-10 17:41:29'),
	(121,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',1,'IOS','post_to_facebook','i_20130211124119.jpg','2013-02-10 17:41:29'),
	(122,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',1,'IOS','post_to_facebook','i_20130211124119.jpg','2013-02-10 17:41:29'),
	(123,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',1,'IOS','save_to_album','i_20130212131818.jpg','2013-02-11 18:18:21'),
	(124,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',1,'IOS','save_to_album','i_20130212131820.jpg','2013-02-11 18:18:21'),
	(125,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',1,'IOS','save_to_album','i_20130212131815.jpg','2013-02-11 18:18:21'),
	(126,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',1,'IOS','save_to_album','i_20130212131820.jpg','2013-02-11 18:18:22'),
	(127,5,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','save_to_album','i_20130212131954.jpg','2013-02-11 18:20:08'),
	(128,5,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','save_to_album','i_20130212131958.jpg','2013-02-11 18:20:09'),
	(129,5,'b424300557f83c540e8aae18576921fa1a2a9c23',1,'IOS','save_to_album','i_20130212131958.jpg','2013-02-11 18:20:31'),
	(130,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',1,'IOS','save_to_album','i_20130212154726.jpg','2013-02-11 20:47:47'),
	(131,4,'c73a6680bd3661481a8b3ccf497fdae7f5abd9c0',1,'IOS','save_to_album','i_20130212161521.jpg','2013-02-11 21:10:21'),
	(132,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130212132657.jpg','2013-02-11 23:27:15'),
	(133,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130212132706.jpg','2013-02-11 23:27:15'),
	(134,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_twitter','i_20130212132703.jpg','2013-02-11 23:27:15'),
	(135,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130212132710.jpg','2013-02-11 23:27:16'),
	(136,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130212132713.jpg','2013-02-11 23:27:17'),
	(137,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','save_to_album','i_20130212132714.jpg','2013-02-11 23:27:18'),
	(138,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_twitter','i_20130212132715.jpg','2013-02-11 23:27:20'),
	(139,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_twitter','i_20130212132715.jpg','2013-02-11 23:27:20'),
	(140,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130212132715.jpg','2013-02-11 23:27:21'),
	(141,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130212132715.jpg','2013-02-11 23:27:36'),
	(142,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130212132715.jpg','2013-02-11 23:27:36'),
	(143,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130212132715.jpg','2013-02-11 23:27:36'),
	(144,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130212132725.jpg','2013-02-11 23:27:36'),
	(145,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130212132715.jpg','2013-02-11 23:27:36'),
	(146,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130212132715.jpg','2013-02-11 23:27:38'),
	(147,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130212132725.jpg','2013-02-11 23:27:39'),
	(148,5,'83381ca3dcd17b4ca3ccd0a07b5036de00447ae1',1,'IOS','post_to_facebook','i_20130212132725.jpg','2013-02-11 23:27:39');

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
	(4,'JOSH TEST',1,'','','generic','','',NULL,NULL,2,1,'Welcome to PIXTA','','','',0,'<!DOCTYPE html>\r\n<html>\r\n<body>\r\n\r\n<form name=\"input\" action=\"html_form_action.asp\" method=\"get\">\r\n<input type=\"checkbox\" name=\"vehicle\" value=\"Bike\">I have a bike<br>\r\n<input type=\"checkbox\" name=\"vehicle\" value=\"Car\">I have a car \r\n<br><br>\r\n<input type=\"submit\" value=\"Submit\">\r\n</form> \r\n\r\n<p>If you click the \"Submit\" button, the form-data will be sent to a page called \"html_form_action.asp\".</p>\r\n\r\n</body>\r\n</html>\r\n\r\n',1,'',1,'Draft','/img/events/4-POLITElogo.png','/img/events/4-1-Chinese.png','/img/events/4-2-HOMEBAKE.png','/img/events/4-3-JIMBEAM.png','/img/events/4-4-THEGROUNDS.png','/img/events/4-5-garden-floral.png',NULL,'','','','','',1,'2012-12-10 10:14:42','2013-02-11 20:30:07'),
	(5,'I\'m at the Grounds of Alexandria',7,'#thegrounds\r\nCoffee!!!',NULL,'location-based','-33.911063','151.19359','2013-02-04 00:00:00','2013-02-04 00:00:00',2,1,'Eat this!','http://groundsroasters.com/','#thegrounds','http://stage01.degreeamerica.com/index.html',NULL,'http://www.google.com.au',NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mauris ligula, varius et malesuada sed, adipiscing id arcu. Aliquam tincidunt tincidunt nisl, eu tincidunt neque ornare vitae. Proin lacinia pellentesque cursus. Sed fermentum lacus ac dolor fringilla tempus nec at odio. Nullam congue aliquam nisi quis hendrerit. Morbi neque magna, hendrerit a congue ut, molestie vitae eros. Sed ultrices dolor consectetur nisl lacinia et adipiscing lectus euismod. Vestibulum congue sagittis est, et adipiscing leo egestas at. Fusce sagittis quam vitae metus dictum in commodo dui consequat. Duis non pellentesque turpis. Nullam luctus placerat purus, nec congue nibh ullamcorper quis.\r\n\r\nSed tempor metus ac ipsum blandit luctus et eget massa. Aenean venenatis turpis eu urna molestie non sollicitudin lectus facilisis. Duis tincidunt quam sit amet leo sagittis accumsan. Donec erat sapien, facilisis at porta at, mollis at sapien. Vestibulum sem nulla, tempus a facilisis eget, ullamcorper sagittis urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris condimentum magna sed eros ultrices nec consequat ante facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed a velit at erat egestas mattis non ut urna. Quisque ullamcorper tempor est id tempor. Cras ornare auctor sem quis adipiscing. Nullam sed massa at libero aliquet blandit ut ac orci. In feugiat, risus sit amet adipiscing pretium, dolor neque posuere risus, ut luctus eros risus ut ante. Ut dapibus, ante id ornare pharetra, magna turpis tincidunt nisi, et dapibus purus elit at nibh.',NULL,'Scheduled','/img/events/5-Untitled-1.png','/img/events/5-1-image-1-1y7ed.png','/img/events/5-2-image-2-cda0j.png','/img/events/5-3-image-5gd0m.png',NULL,NULL,'/img/events/5-5-Untitled-8.png',NULL,'Made with Skill & Precision',NULL,NULL,'',0,'2012-12-17 16:54:27','2013-02-03 16:56:33'),
	(6,'Fly Digital Test Event',1,'Fly Digital first line','Fly Digital second line','location-based','-33.879537','151.105957','2013-03-22 00:00:00','2013-03-22 00:00:00',2,1,'Facebook message from the admin suite here','http://www.flydigital.com.au','Twitter message from the admin suite here','http://www.flydigital.com.au',1,'http://www.flydigital.com.au',1,'These are our terms and conditions',1,'Scheduled','/img/events/6-7.jpg','/img/events/6-1-overlay1.png',NULL,NULL,NULL,NULL,'/img/events/6-facebook.png','Custom Event Name','Welcome to our public event page','','','',1,'2013-02-03 19:28:41','2013-02-04 00:56:25');

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
