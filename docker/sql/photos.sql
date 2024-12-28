-- Adminer 4.8.1 MySQL 11.6.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `vaiicko_db`;
CREATE DATABASE `vaiicko_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;
USE `vaiicko_db`;

DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `advert` int(11) NOT NULL,
  `url` varchar(500) NOT NULL,
  PRIMARY KEY (`url`),
  KEY `advert` (`advert`),
  CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`advert`) REFERENCES `adverts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


-- 2024-12-28 15:08:08
