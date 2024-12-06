-- Adminer 4.8.1 MySQL 11.6.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idAdvert` int(11) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `reservedBy` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idAdvert` (`idAdvert`),
  KEY `reservedBy` (`reservedBy`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`idAdvert`) REFERENCES `adverts` (`id`),
  CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`reservedBy`) REFERENCES `users` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


-- 2024-12-06 17:29:23
