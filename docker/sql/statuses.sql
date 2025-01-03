-- Adminer 4.8.1 MySQL 11.5.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `statuses`;
CREATE TABLE `statuses` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `popis` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `statuses` (`id`, `popis`) VALUES
       (1,	'Odoslaná'),
       (2,	'Prebiehajúca'),
       (3,	'Zrušená'),
       (4,	'Zamietnutá'),
       (5,	'Dokončená');

-- 2025-01-02 21:30:32