DROP TABLE IF EXISTS `locus`;

CREATE TABLE `locus` (
  `id` int NOT NULL,
  `zip` smallint UNSIGNED NOT NULL,
  `locality` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `commune` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `province` enum('Anvers','Limbourg','Flandre Orientale','Brabant Flamand','Flandre Occidentale','Brabant Wallon','Hainaut','Liège','Luxembourg','Namur','Bruxelles') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isSub` tinyint DEFAULT NULL COMMENT 'true for child, false for parent, null for special'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `locus`  ADD PRIMARY KEY (`id`);

ALTER TABLE `locus`  MODIFY `id` int NOT NULL AUTO_INCREMENT;
