DROP TABLE IF EXISTS `adverts`;
CREATE TABLE `adverts` (
                          `id` int(11) NOT NULL AUTO_INCREMENT,
                          `dateOfCreate` date NOT NULL,
                          `timeOfLastEdit` datetime NOT NULL,
                          `text` varchar(1000) NOT NULL,
                          `title` varchar(100) NOT NULL,
                          `owner` varchar(100) NOT NULL,
                          `categoryId` int(11) NOT NULL,
                          `categoryName` varchar(100) NOT NULL,
                          `city` varchar(100) NOT NULL,
                          `reviewId` int(11) NOT NULL,
                          `availabilityId` int(11) NOT NULL,
                          `price` double NOT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci COMMENT='cudzie kluce: caregoryId, reviewId, availibilityId';

