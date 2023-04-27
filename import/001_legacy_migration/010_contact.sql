DROP TABLE IF EXISTS `cinergie`.`contact`;

CREATE TABLE `cinergie`.`contact` (
  `id` int NOT NULL,

  `type` enum('tel','fax','gsm','email','site') NOT NULL,
  `value` varchar(255) NOT NULL,
  `private` tinyint(1) DEFAULT NULL,

  `pro_id` int DEFAULT NULL COMMENT 'drop field after import',
  `org_id` int DEFAULT NULL COMMENT 'drop field after import'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `contact` ADD PRIMARY KEY (`id`);
ALTER TABLE `contact` MODIFY `id` int NOT NULL AUTO_INCREMENT;
