SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `vaiicko_db`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `email` varchar(100) NOT NULL,
                         `password` varchar(50) NOT NULL,
                         `name` varchar(30) NOT NULL,
                         `surname` varchar(30) NOT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `users` (`id`, `email`, `password`, `name`, `surname`) VALUES
                                                                       (1,	'admin@gmail.com',	'admin',	'Admin',	'Adminec'),
                                                                       (2,	'marek@gmail.com',	'123',	'Marek',	'Figo');
