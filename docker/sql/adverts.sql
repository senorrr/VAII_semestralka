-- Adminer 4.8.1 MySQL 11.6.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `vaiicko_db`;
CREATE DATABASE `vaiicko_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;
USE `vaiicko_db`;

DROP TABLE IF EXISTS `adverts`;
CREATE TABLE `adverts` (
  `views` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateOfCreate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `timeOfLastEdit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `text` varchar(1000) NOT NULL,
  `title` varchar(100) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `villageId` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK category` (`categoryId`),
  KEY `FK user` (`owner`),
  KEY `villageId` (`villageId`),
  CONSTRAINT `adverts_email_user` FOREIGN KEY (`owner`) REFERENCES `users` (`email`),
  CONSTRAINT `adverts_ibfk_1` FOREIGN KEY (`villageId`) REFERENCES `villages` (`id`),
  CONSTRAINT `adverts_id_category` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `adverts` (`views`, `id`, `dateOfCreate`, `timeOfLastEdit`, `text`, `title`, `owner`, `categoryId`, `villageId`, `price`) VALUES
(0,	1,	'2024-12-07 10:33:15',	'2024-12-07 10:33:15',	'Toto je auticko',	'Auticko',	'marek@gmail.com',	4,	11,	1222),
(0,	2,	'2024-12-07 11:55:57',	'2024-12-07 11:55:57',	'Vŕtačka 1100W -  den/10e',	'Miešačka',	'marek@gmail.com',	3,	110,	10),
(1,	4,	'2024-12-07 11:56:07',	'2024-12-07 11:56:07',	'Repraky 5.2 -  den/15e',	'Reproduktory',	'marek@gmail.com',	4,	690,	15);

DELIMITER ;;

CREATE TRIGGER `nastaviCas` BEFORE INSERT ON `adverts` FOR EACH ROW
BEGIN
  SET NEW.dateOfCreate = NOW();
  SET NEW.timeOfLastEdit = NOW();
END;;

DELIMITER ;

-- 2024-12-07 14:07:16
