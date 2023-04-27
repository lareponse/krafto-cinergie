-- STRUCTURE

DROP TABLE IF EXISTS  `cinergie`.`dvd`;

CREATE TABLE `dvd` (
  `id` int NOT NULL,

  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'leg:film:ventedvdok',

  `slug` varchar(222) DEFAULT NULL COMMENT 'leg:film:urlparms',

  `label` varchar(255) DEFAULT NULL COMMENT 'leg:film:nom',
  `content` text COMMENT 'leg:film:ventedvd',

  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- INDEX
ALTER TABLE `dvd` ADD PRIMARY KEY (`id`);
ALTER TABLE `dvd` MODIFY `id` int NOT NULL AUTO_INCREMENT;


-- DATA : 72 active=1 || 85 price > 0
TRUNCATE `cinergie`.`dvd`;
INSERT INTO `cinergie`.`dvd` (
  `active`,
  `slug`,
  `label`,
  `price`
)
SELECT
  `ventedvdok`,
  `urlparms`,
  `nom`,
  `ventedvdprix`
FROM `a7_cinergie_beta`.`film`
WHERE `ventedvdprix` > 0;



DROP TABLE IF EXISTS  `cinergie`.`movie_dvd`;
CREATE TABLE `cinergie`.`movie_dvd` (
  `movie_id` int NOT NULL COMMENT 'FK',
  `dvd_id` int NOT NULL COMMENT 'FK'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cinergie`.`movie_dvd` (`movie_id`, `dvd_id`)
SELECT `movie`.`id`, `dvd`.`id`
FROM `cinergie`.dvd
JOIN `cinergie`.movie ON `movie`.`slug` = `dvd`.`slug`;


ALTER TABLE `movie_dvd`
  ADD CONSTRAINT `movie_dvd-hasMovie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ,
  ADD CONSTRAINT `movie_dvd-hasDVD` FOREIGN KEY (`dvd_id`) REFERENCES `dvd` (`id`);
