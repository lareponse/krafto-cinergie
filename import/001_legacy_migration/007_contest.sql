-- STRUCTURE
DROP TABLE IF EXISTS `contest`;

CREATE TABLE `contest` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'parsed and cast from legacy id',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'leg:datestamp',

  `slug` varchar(222) NOT NULL COMMENT 'leg:urlparm',

  `label` varchar(255) NOT NULL COMMENT 'leg:field01',
  `rank` smallint UNSIGNED DEFAULT NULL COMMENT 'leg:tri',

  `avatar` varchar(255) DEFAULT NULL COMMENT 'leg:field04',
  `content` text DEFAULT NULL COMMENT 'leg:field06',

  `public` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: view in backend only',
  `pick` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: picked for home page',
  `listable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in general listings',
  `searchable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in search results',

  `starts` date DEFAULT NULL COMMENT 'leg:field02',
  `stops` date DEFAULT NULL COMMENT 'leg:field03',

  `abstract` text COMMENT 'leg:field05',
  `question` varchar(255) DEFAULT NULL COMMENT 'leg:field07',
  `email` varchar(100) DEFAULT NULL COMMENT 'leg:field08',

  `canShowForm` tinyint(1) DEFAULT '1' COMMENT 'leg:field09',
  `legacy_user` varchar(13) DEFAULT NULL,

  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `contest` ADD UNIQUE KEY `contest-unique-slug` (`slug`) USING BTREE;

-- INDEX
ALTER TABLE `contest` ADD INDEX(`label`);


-- DATA
TRUNCATE `cinergie`.`contest`;

INSERT INTO `cinergie`.`contest` (
  `id`,
  `created`,
  
  `slug`,
  
  `label`,
  `rank`,

  `avatar`,
  `content`,

  `public`,

  `abstract`,
  `question`,
  `email`,

  `starts`,
  `stops`,
  `canShowForm`,

  `legacy_user`
)
SELECT
  CAST(REGEXP_SUBSTR(`id`, '[0-9]+$', 1) as UNSIGNED) as `id`,
  IF(`datestamp` IS NULL or TRIM(`datestamp`) = '' or `datestamp` LIKE '0000-00-00 00:00:00', STR_TO_DATE('2022-11-21 01:01:01','%Y-%m-%d %H:%i:%s'), STR_TO_DATE(`datestamp`,'%Y-%m-%d %H:%i:%s')) as `created`,

  `urlparms` as `slug`,

  TRIM(`field01`) as `label`,
  `tri` as `rank`,


  TRIM(`field04`) as `avatar`,
  TRIM(`field06`) as `content`,

  `active` as `public`,

  TRIM(`field05`) as `abstract`,
  TRIM(`field07`) as `question`,
  TRIM(`field08`) as `email`,

  IF(`field02` IS NULL or `field02` = '' or `field02` LIKE '0000-00-00', null, STR_TO_DATE(`field02`,'%Y-%m-%d')) as `starts`,
  IF(`field03` IS NULL or `field03` = '' or `field03` LIKE '0000-00-00', null, STR_TO_DATE(`field03`,'%Y-%m-%d')) as `stops`,
  IF(`field09` IS NULL or `field09` = '' or `field09` <> 1 , 0, 1) as `canShowForm`,

  TRIM(`user`) as `legacy_user`

FROM `a7_cinergie_beta`.`content_item`

WHERE `area` = 'concours' AND `category` = 'concours';
