-- STRUCTURE
DROP TABLE IF EXISTS `submission`;

CREATE TABLE `submission` (
  `id` int NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `urn` varchar(100) NOT NULL,
  `submitted` longtext NOT NULL,
  `emitted` text NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
