-- STRUCTURE
DROP TABLE IF EXISTS `contest`;

CREATE TABLE `contest` (
  `id` int NOT NULL COMMENT 'parsed and cast from legacy id',

  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'leg:datestamp',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(222) DEFAULT NULL COMMENT 'leg:urlparm',
  `rank` smallint UNSIGNED DEFAULT NULL COMMENT 'leg:tri',

  `label` varchar(100) DEFAULT NULL COMMENT 'leg:field01',
  `content` text COMMENT 'leg:field06',

  `abstract` text COMMENT 'leg:field05',
  `question` varchar(255) DEFAULT NULL COMMENT 'leg:field07',
  `email` varchar(100) DEFAULT NULL COMMENT 'leg:field08',

  `starts` date DEFAULT NULL COMMENT 'leg:field02',
  `stops` date DEFAULT NULL COMMENT 'leg:field03',

  `legacy_id` varchar(40) DEFAULT NULL,
  `legacy_photo` varchar(255) DEFAULT NULL COMMENT 'leg:field04',
  `legacy_dicho_formulaire` tinyint(1) DEFAULT NULL COMMENT 'leg:field09',
  `legacy_field19` varchar(255) DEFAULT NULL,
  `legacy_field20` varchar(255) DEFAULT NULL


) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- PRIMARY
ALTER TABLE `contest` ADD PRIMARY KEY (`id`);
ALTER TABLE `contest` MODIFY `id` int NOT NULL AUTO_INCREMENT;


-- INDEX
ALTER TABLE `contest` ADD UNIQUE `contest-slug-unique` (`slug`);
ALTER TABLE `contest` ADD INDEX(`label`);


-- DATA
TRUNCATE `cinergie`.`contest`;

INSERT INTO `cinergie`.`contest` (
  `id`,
  `created_on`,
  `active`,
  `slug`,
  `rank`,

  `label`,
  `content`,

  `abstract`,
  `question`,
  `email`,

  `starts`,
  `stops`,

  `legacy_id`,
  `legacy_photo`,
  `legacy_dicho_formulaire`,
  `legacy_field19`,
  `legacy_field20`

)
SELECT
  CAST(REGEXP_SUBSTR(`id`, '[0-9]+$', 1) as UNSIGNED) as `id`,

  IF(`datestamp` IS NULL or TRIM(`datestamp`) = '' or `datestamp` LIKE '0000-00-00 00:00:00', STR_TO_DATE('2022-11-21 01:01:01','%Y-%m-%d %H:%i:%s'), STR_TO_DATE(`datestamp`,'%Y-%m-%d %H:%i:%s')) as `created_on`,
  `active` as `active`,
  `urlparms` as `slug`,
  `tri` as `rank`,

  `field01` as `label`,
  `field06` as `content`,

  `field05` as `abstract`,
  `field07` as `question`,
  `field08` as `email`,

  IF(`field02` IS NULL or `field02` = '' or `field02` LIKE '0000-00-00', null, STR_TO_DATE(`field02`,'%Y-%m-%d')) as `starts`,
  IF(`field03` IS NULL or `field03` = '' or `field03` LIKE '0000-00-00', null, STR_TO_DATE(`field03`,'%Y-%m-%d')) as `stops`,

  `id` as `legacy_id`,
  `field04` as `legacy_photo`,
  IF(`field09`='', null, `field09`) as `legacy_dicho_formulaire`,
  `field19` as `legacy_field19`,
  `field20` as `legacy_field20`

FROM `a7_cinergie_beta`.`content_item`

WHERE `area` = 'concours' AND `category` = 'concours';
