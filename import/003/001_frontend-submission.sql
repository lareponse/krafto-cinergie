-- Dropping the table if it exists
DROP TABLE IF EXISTS `submission`;
-- Creating the table
CREATE TABLE `submission` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `created_on` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `urn` VARCHAR(100) DEFAULT NULL COMMENT 'Unique Reference Number',
  `submitted` LONGTEXT NOT NULL COMMENT 'JSON string of the submitted data',
  `submitted_by` TEXT NOT NULL COMMENT 'HTTP client information',
  `approved` INT DEFAULT NULL COMMENT 'NULL for pending, 1 for approved, 0 for rejected',
  `reviewed_by` INT DEFAULT NULL COMMENT 'Operator ID of the reviewer',
  `reviewed_on` DATETIME DEFAULT NULL COMMENT 'Date and time of review',
  `comments` TEXT DEFAULT NULL COMMENT 'Comments from the reviewer'
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;


ALTER TABLE `submission` CHANGE `reviewed_on` `reviewed_on` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Date and time of review';