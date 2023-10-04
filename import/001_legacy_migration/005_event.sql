-- STRUCTURE
DROP TABLE IF EXISTS `cinergie`.`event`;

CREATE TABLE `event` (
  `id` int NOT NULL COMMENT 'parsed and cast from legacy id',

  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(222) NOT NULL COMMENT 'leg:urlparm',
  `label` varchar(890) NOT NULL COMMENT 'leg:field01',

  `content` text COMMENT 'new column',

  `starts` date DEFAULT NULL COMMENT 'leg:field02',
  `stops` date DEFAULT NULL COMMENT 'leg:field03',
  `rank` smallint UNSIGNED DEFAULT NULL COMMENT 'leg:tri',

  `url_site` varchar(552) DEFAULT NULL COMMENT 'leg:field05',
  `url_internal` varchar(255) DEFAULT NULL COMMENT 'leg:field06',

  `type_id` int DEFAULT NULL COMMENT 'FK tag',

  `legacy_user` varchar(13) DEFAULT NULL,
  `legacy_title` varchar(190) DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- PRIMARY
ALTER TABLE `event` ADD PRIMARY KEY (`id`);
ALTER TABLE `event` MODIFY `id` int NOT NULL AUTO_INCREMENT;

-- INDEX
ALTER TABLE `event` ADD KEY `event-hasTagType` (`type_id`);
ALTER TABLE `event` ADD UNIQUE `event-slug-unique` (`slug`);

-- FK
ALTER TABLE `event`
  ADD CONSTRAINT `event-hasTagType` FOREIGN KEY (`type_id`) REFERENCES `tag` (`id`);


-- DATA

TRUNCATE `cinergie`.`event`;

INSERT INTO `cinergie`.`event` (
  `id`,

  `created_on`,
  `active`,
  `slug`,
  `label`,

  `starts`,
  `stops`,
  `rank`,
  
  `url_site`,
  `url_internal`,

  `type_id`,

  `legacy_user`,
  `legacy_title`
)
SELECT
  CAST(REGEXP_SUBSTR(`content_item`.`id`, '[0-9]+$', 1) as UNSIGNED) as `id`,

  STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s') as `created_on`,
  `active` as `active`,
  `urlparms` as `slug`,
  IF(`field01` IS NULL or TRIM(`field01`) = '', title, TRIM(`field01`)) as `label`,


  IF(`field02` IS NULL or `field02` = '', null, STR_TO_DATE(`field02`,'%Y-%m-%d')) as `starts`,
  IF(`field03` IS NULL or `field03` = '', null, STR_TO_DATE(`field03`,'%Y-%m-%d')) as `stops`,
  `tri` as `rank`,

  TRIM(`field05`) as `url_site`,
  TRIM(`field06`) as `url_internal`,

  `tag`.`id` as `type_id`,

  TRIM(`user`) as `legacy_user`,
  TRIM(`title`) as `legacy_title`


FROM `a7_cinergie_beta`.`content_item`
LEFT OUTER JOIN `tag` ON `tag`.`reference` = `content_item`.`subject`
WHERE area = 'agenda' AND category = 'agenda';
