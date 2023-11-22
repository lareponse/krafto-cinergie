DROP TABLE IF EXISTS `locus`;

CREATE TABLE `locus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(55) NOT NULL,

  `zip` smallint UNSIGNED NOT NULL,
  `commune` varchar(55) NOT NULL,
  `province` enum('Anvers','Limbourg','Flandre Orientale','Brabant Flamand','Flandre Occidentale','Brabant Wallon','Hainaut','Liège','Luxembourg','Namur','Bruxelles') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  
  `isSub` tinyint DEFAULT NULL COMMENT 'true for child, false for parent, null for special',

  PRIMARY KEY (`id`),
  INDEX(`label`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
