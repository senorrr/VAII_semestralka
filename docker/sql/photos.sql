-- Adminer 4.8.1 MySQL 11.6.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `advertId` int(11) NOT NULL,
  `url` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `advertId` (`advertId`),
  CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`advertId`) REFERENCES `adverts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


INSERT INTO `photos` (`id`, `advertId`, `url`) VALUES
       (1,	1,	'https://www.klokocka.cz/temp/cache/carPics/img1100x825e/787072/1O15701.jpg'),
       (2,	1,	'https://cdn.jdpower.com/JDP_2023%20Audi%20A6%20Allroad%20Interior%20Dashboard.jpg');
-- 2024-12-28 15:08:08
