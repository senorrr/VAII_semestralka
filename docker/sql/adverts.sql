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
                           `ownerId` int(11) NOT NULL,
                           `categoryId` int(11) NOT NULL,
                           `villageId` int(11) NOT NULL,
                           `price` double NOT NULL,
                           `monday` tinyint(4) NOT NULL,
                           `tuesday` tinyint(4) NOT NULL,
                           `wednesday` tinyint(4) NOT NULL,
                           `thursday` tinyint(4) NOT NULL,
                           `friday` tinyint(4) NOT NULL,
                           `saturday` tinyint(4) NOT NULL,
                           `sunday` tinyint(4) NOT NULL,
                           PRIMARY KEY (`id`),
                           KEY `FK category` (`categoryId`),
                           KEY `FK user` (`ownerId`),
                           KEY `villageId` (`villageId`),
                           CONSTRAINT `adverts_ibfk_1` FOREIGN KEY (`villageId`) REFERENCES `villages` (`id`),
                           CONSTRAINT `adverts_id_category` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`),
                           CONSTRAINT `adverts_id_user` FOREIGN KEY (`ownerId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `adverts` (`views`, `id`, `dateOfCreate`, `timeOfLastEdit`, `text`, `title`, `ownerId`, `categoryId`, `villageId`, `price`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`) VALUES
                                                                                                                                                                                                                          (3,	1,	'2024-12-07',	'2024-12-07 10:33:15',	'Toto je auticko',	'Auticko',	2,	1,	11,	1222,	0,	0,	0,	0,	0,	0,	0),
                                                                                                                                                                                                                          (1,	2,	'2024-12-07',	'2024-12-31 00:28:25',	'Vŕtačka 1100W -  den/10e',	'Vrtacka',	1,	3,	110,	10,	0,	0,	0,	0,	0,	0,	0),
                                                                                                                                                                                                                          (27,	3,	'2024-12-07',	'2024-12-07 14:55:06',	'Kompaktný a prenosný dizajn: JBL Go 3 je malý a ľahký, takže ho môžeš ľahko vziať kamkoľvek. Má rozmery 9 x 7 x 4 cm a váži len 211 gramov. Vodoodolnosť a prachuvzdornosť: S certifikáciou IP67 je reproduktor odolný voči vode a prachu, čo ho robí ideálnym pre vonkajšie použitie. Výdrž batérie: Batéria vydrží približne 5 hodín prehrávania na jedno nabitie. Zvuková kvalita: Napriek svojej veľkosti ponúka JBL Go 3 čistý a relatívne silný zvuk s bohatými basmi. Bluetooth 5.1: Spoľahlivé a rýchle pripojenie cez Bluetooth 5.1, čo zaručuje stabilné prehrávanie hudby. Dizajn a farby: Dostupný v rôznych farebných prevedeniach, takže si môžeš vybrať ten, ktorý ti najviac vyhovuje.',	'Reproduktory',	1,	4,	690,	15,	0,	0,	0,	0,	0,	0,	0);

DELIMITER ;;

CREATE TRIGGER `nastaviCas` BEFORE INSERT ON `adverts` FOR EACH ROW
BEGIN
    SET NEW.dateOfCreate = NOW();
  SET NEW.timeOfLastEdit = NOW();
END;;

DELIMITER ;

-- 2025-01-02 09:28:59