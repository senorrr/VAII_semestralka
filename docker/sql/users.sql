-- Adminer 4.8.1 MySQL 11.5.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `email` varchar(100) NOT NULL,
                         `password` varchar(50) NOT NULL,
                         `name` varchar(30) NOT NULL,
                         `surname` varchar(30) NOT NULL,
                         `permissions` tinyint(1) NOT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `users` (`id`, `email`, `password`, `name`, `surname`, `permissions`) VALUES
                                                                                      (1,	'admin@gmail.com',	'admin',	'Admin',	'Adminec',	1),
                                                                                      (2,	'marek@gmail.com',	'123',	'Marek',	'Figo',	0);

-- 2025-01-02 22:07:31