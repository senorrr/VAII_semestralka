-- Adminer 4.8.1 MySQL 11.6.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `users` (`email`, `password`, `name`, `surname`) VALUES
('admin@gmail.com',	'admin',	'Admin',	'Adminec'),
('marek@gmail.com',	'123',	'Marek',	'Figo');

-- 2024-11-29 17:42:35
