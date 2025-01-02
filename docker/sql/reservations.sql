-- Adminer 4.8.1 MySQL 11.5.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `advertId` int(11) NOT NULL,
        `from` date NOT NULL,
        `to` date NOT NULL,
        `reservedBy` int(11) NOT NULL,
        `message` varchar(200) NOT NULL,
        `stav` tinyint(4) NOT NULL COMMENT 'reprezentuje rozne stavy poziadane o sluzbu, rezervovane, zrusene, vratene',
        `totalCost` double NOT NULL,
        PRIMARY KEY (`id`),
        KEY `advertId` (`advertId`),
        KEY `reservedBy` (`reservedBy`),
        CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`advertId`) REFERENCES `adverts` (`id`),
        CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`reservedBy`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci ;


-- 2025-01-02 11:33:56