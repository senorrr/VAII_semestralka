-- Adminer 4.8.1 MySQL 11.6.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idAdvert` int(11) unsigned NOT NULL,
  `stars` int(1) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `reviewedBy` varchar(100) NOT NULL,
  `lastEdit` datetime NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reviewedBy` (`reviewedBy`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`reviewedBy`) REFERENCES `users` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


-- 2024-12-07 14:08:15
