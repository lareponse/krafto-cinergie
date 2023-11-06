-- STRUCTURE
DROP TABLE IF EXISTS `cinergie`.`event`;

CREATE TABLE `event` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'parsed and cast from legacy id',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

  `slug` varchar(222) NOT NULL COMMENT 'leg:urlparm',

  `label` varchar(900) NOT NULL COMMENT 'leg:field01',
  `rank` smallint UNSIGNED DEFAULT NULL COMMENT 'leg:tri',

  `avatar` varchar(255) DEFAULT NULL COMMENT 'image filename',
  `content` text DEFAULT NULL,

  `public` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: view in backend only',
  `pick` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: picked for home page',
  `listable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in general listings',
  `searchable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in search results',

  `starts` date NOT NULL COMMENT 'leg:field02',
  `stops` date NOT NULL COMMENT 'leg:field03',

  `url_site` varchar(552) DEFAULT NULL COMMENT 'leg:field05',
  `url_internal` varchar(255) DEFAULT NULL COMMENT 'leg:field06',

  `type_id` int DEFAULT NULL COMMENT 'FK tag',

  `legacy_user` varchar(13) DEFAULT NULL,
  `legacy_title` varchar(190) DEFAULT NULL,

  PRIMARY KEY (`id`),
  UNIQUE KEY `event-unique-slug` (`slug`) USING BTREE
  -- no index on label, too long

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- INDEX
ALTER TABLE `event` ADD KEY `event-hasTagType` (`type_id`);

-- FK
ALTER TABLE `event`
  ADD CONSTRAINT `event-hasTagType` FOREIGN KEY (`type_id`) REFERENCES `tag` (`id`);


-- DATA

TRUNCATE `cinergie`.`event`;

INSERT INTO `cinergie`.`event` (
  `id`,
  `created`,

  `slug`,
  
  `label`,
  `rank`,

  `public`,
  

  `starts`,
  `stops`,
  
  `url_site`,
  `url_internal`,

  `type_id`,

  `legacy_user`,
  `legacy_title`
)
SELECT
  CAST(REGEXP_SUBSTR(`content_item`.`id`, '[0-9]+$', 1) as UNSIGNED) as `id`,
  STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s') as `created`,

  `urlparms` as `slug`,

  IF(`field01` IS NULL or TRIM(`field01`) = '', title, TRIM(`field01`)) as `label`,
  `tri` as `rank`,

  `active` as `public`,


  IF(`field02` IS NULL or `field02` = '', STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s'), STR_TO_DATE(`field02`,'%Y-%m-%d')) as `starts`,
  IF(`field03` IS NULL or `field03` = '', STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s'), STR_TO_DATE(`field03`,'%Y-%m-%d')) as `stops`,

  TRIM(`field05`) as `url_site`,
  TRIM(`field06`) as `url_internal`,

  `tag`.`id` as `type_id`,

  TRIM(`user`) as `legacy_user`,
  TRIM(`title`) as `legacy_title`


FROM `a7_cinergie_beta`.`content_item`
LEFT OUTER JOIN `tag` ON `tag`.`slug` = CONCAT('event-cat-',`content_item`.`subject`)
WHERE area = 'agenda' AND category = 'agenda';
