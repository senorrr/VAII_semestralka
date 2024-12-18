-- Adminer 4.8.1 MySQL 11.5.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `adverts`;
CREATE TABLE `adverts` (
  `views` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateOfCreate` date NOT NULL DEFAULT '0000-00-00',
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
(0,	1,	'2024-12-07',	'2024-12-07 10:33:15',	'Toto je auticko',	'Auticko',	'marek@gmail.com',	4,	11,	1222),
(1,	2,	'2024-12-07',	'2024-12-07 11:55:57',	'Vŕtačka 1100W -  den/10e',	'Miešačka',	'marek@gmail.com',	3,	110,	10),
(26,	3,	'2024-12-07',	'2024-12-07 14:55:06',	'Kompaktný a prenosný dizajn: JBL Go 3 je malý a ľahký, takže ho môžeš ľahko vziať kamkoľvek. Má rozmery 9 x 7 x 4 cm a váži len 211 gramov. Vodoodolnosť a prachuvzdornosť: S certifikáciou IP67 je reproduktor odolný voči vode a prachu, čo ho robí ideálnym pre vonkajšie použitie. Výdrž batérie: Batéria vydrží približne 5 hodín prehrávania na jedno nabitie. Zvuková kvalita: Napriek svojej veľkosti ponúka JBL Go 3 čistý a relatívne silný zvuk s bohatými basmi. Bluetooth 5.1: Spoľahlivé a rýchle pripojenie cez Bluetooth 5.1, čo zaručuje stabilné prehrávanie hudby. Dizajn a farby: Dostupný v rôznych farebných prevedeniach, takže si môžeš vybrať ten, ktorý ti najviac vyhovuje.',	'Reproduktory',	'marek@gmail.com',	4,	690,	15);

DELIMITER ;;

CREATE TRIGGER `nastaviCas` BEFORE INSERT ON `adverts` FOR EACH ROW
BEGIN
  SET NEW.dateOfCreate = NOW();
  SET NEW.timeOfLastEdit = NOW();
END;;

DELIMITER ;

-- 2024-12-07 15:20:25
