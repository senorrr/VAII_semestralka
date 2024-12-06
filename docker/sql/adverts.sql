-- Adminer 4.8.1 MySQL 11.6.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `adverts`;
CREATE TABLE `adverts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateOfCreate` date NOT NULL,
  `timeOfLastEdit` datetime NOT NULL,
  `text` varchar(1000) NOT NULL,
  `title` varchar(100) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK category` (`categoryId`),
  KEY `FK user` (`owner`),
  CONSTRAINT `adverts_email_user` FOREIGN KEY (`owner`) REFERENCES `users` (`email`),
  CONSTRAINT `adverts_id_category` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


-- 2024-12-06 17:27:59
