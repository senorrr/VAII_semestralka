-- Adminer 4.8.1 MySQL 11.6.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `destinationOfPicture` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `categories` (`id`, `name`, `destinationOfPicture`) VALUES
(1,	'Auto',	'public/images/auto.png'),
(2,	'Domácnosť',	'public/images/domacnost.png'),
(3,	'Náradie',	'public/images/naradie.png'),
(4,	'Elektronika',	'public/images/elektronika.png'),
(5,	'Šport',	'public/images/sport.png'),
(6,	'Pre deti',	'public/images/predeti.png'),
(7,	'Oslavy',	'public/images/oslavy.png'),
(8,	'Oblečenie',	'public/images/oblecenie.png'),
(9,	'Služby',	'public/images/sluzby.png'),
(10,	'Ostatné',	'public/images/ostatne.png');

-- 2024-12-07 14:07:49
