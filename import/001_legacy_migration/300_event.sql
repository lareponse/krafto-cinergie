-- STRUCTURE
DROP TABLE IF EXISTS `cinergie`.`event`;

CREATE TABLE `event` (
  `id` int NOT NULL COMMENT 'parsed and cast from legacy id',

  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(222) DEFAULT NULL COMMENT 'leg:urlparm',
  `rank` smallint UNSIGNED DEFAULT NULL COMMENT 'leg:tri',

  `label` varchar(890) DEFAULT NULL COMMENT 'leg:field01',
  `content` text COMMENT 'new column',

  `starts` date DEFAULT NULL COMMENT 'leg:field02',
  `stops` date DEFAULT NULL COMMENT 'leg:field03',
  `url_site` varchar(552) DEFAULT NULL COMMENT 'leg:field05',
  `url_internal` varchar(255) DEFAULT NULL COMMENT 'leg:field06',

  `type_id` int DEFAULT NULL COMMENT 'FK tag',

  `legacy_id` varchar(40) DEFAULT NULL,
  `legacy_title` varchar(190) DEFAULT NULL,
  `legacy_category` varchar(12) DEFAULT NULL,
  `legacy_theme` varchar(17) DEFAULT NULL,
  `legacy_subject` varchar(17) DEFAULT NULL,
  `legacy_user` varchar(13) DEFAULT NULL,
  `legacy_parm_cat_event` varchar(14) DEFAULT NULL COMMENT 'leg:field04'
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
  `rank`,

  `label`,

  `starts`,
  `stops`,
  `url_site`,
  `url_internal`,

  `type_id`,

  `legacy_id`,
  `legacy_title`,
  `legacy_category`,
  `legacy_theme`,
  `legacy_subject`,
  `legacy_user`,

  `legacy_parm_cat_event`
)
SELECT
  CAST(REGEXP_SUBSTR(`content_item`.`id`, '[0-9]+$', 1) as UNSIGNED) as `id`,

  STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s') as `created_on`,
  `active` as `active`,
  `urlparms` as `slug`,
  `tri` as `rank`,

  `field01` as `label`,

  IF(`field02` IS NULL or `field02` = '', null, STR_TO_DATE(`field02`,'%Y-%m-%d')) as `starts`,
  IF(`field03` IS NULL or `field03` = '', null, STR_TO_DATE(`field03`,'%Y-%m-%d')) as `stops`,
  `field05` as `url_site`,
  `field06` as `url_internal`,

  `tag`.`id` as `type_id`,

  `content_item`.`id` as `legacy_id`,
  `title` as `legacy_title`,
  `category` as `legacy_category`,
  `theme` as `legacy_theme`,
  `subject` as `legacy_subject`,
  `user` as `legacy_user`,

  `field04` as `legacy_parm_cat_event`

FROM `a7_cinergie_beta`.`content_item`
LEFT OUTER JOIN `tag` ON `tag`.`reference` = `content_item`.`subject`
WHERE area = 'agenda' AND category = 'agenda';
