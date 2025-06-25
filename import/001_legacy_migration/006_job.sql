-- STRUCTURE
DROP TABLE IF EXISTS `cinergie`.`job`;

CREATE TABLE `job` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'parsed and cast from legacy id',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

  `slug` varchar(222) NOT NULL COMMENT 'leg:urlparm',

  `label` varchar(255) DEFAULT NULL COMMENT 'leg:field01',
  `rank` smallint UNSIGNED DEFAULT NULL COMMENT 'leg:tri',


  `avatar` varchar(255) DEFAULT NULL COMMENT 'image filename',
  `content` text COMMENT 'leg:field02',

  `public` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: view in backend only',
  `pick` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: picked for home page',
  `listable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in general listings',
  `searchable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in search results',


  `isOffer` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'parsed: subject=demande',
  `isPaid` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'leg:field09',
  `starts` date DEFAULT NULL COMMENT 'leg:field03',
  `stops` date DEFAULT NULL COMMENT 'leg:field04',

  `identity` varchar(255) DEFAULT NULL COMMENT 'leg:field05',
  `phone` varchar(255) DEFAULT NULL COMMENT 'leg:field06',
  `email` varchar(255) DEFAULT NULL COMMENT 'leg:field07',
  `url` varchar(255) DEFAULT NULL COMMENT 'leg:field08',

  `job_ip` varchar(255) DEFAULT NULL COMMENT 'leg:field10',
  `job_timestamp` timestamp NULL DEFAULT NULL COMMENT 'leg:field11',

  `category_id` int DEFAULT NULL COMMENT 'FK tag',

  `legacy_id` varchar(40) DEFAULT NULL,
  `legacy_title` varchar(190) DEFAULT NULL,
  `legacy_user` varchar(13) DEFAULT NULL,
  `legacy_theme` varchar(17) DEFAULT NULL COMMENT 'process into category_id',

  PRIMARY KEY (`id`),
  UNIQUE KEY `job-unique-slug` (`slug`) USING BTREE,
  INDEX(`label`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- FK
ALTER TABLE `job` ADD CONSTRAINT `job-hasCategoryTag` FOREIGN KEY (`category_id`) REFERENCES `tag` (`id`);

-- DATA

TRUNCATE `cinergie`.`job`;

INSERT INTO `cinergie`.`job` (
  `id`,
  `created`,

  `slug`,

  `label`,
  `rank`,

  `content`,

  `public`,

  `isOffer`,
  `isPaid`,

  `starts`,
  `stops`,

  `identity`,
  `phone`,
  `email`,
  `url`,

  `job_ip`,
  `job_timestamp`,

  `category_id`,

  `legacy_id`,
  `legacy_title`,
  `legacy_user`,
  `legacy_theme`
)
SELECT
  CAST( REGEXP_REPLACE(content_item.id, '^.*?([0-9]+)$', '\\1') AS UNSIGNED) as `id`,
  STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s') as `created`,
  IF(`urlparms` IS NULL OR TRIM(`urlparms`) = '', `content_item`.`id`, `urlparms`) as `slug`,

  TRIM(`field01`) as `label`,
  `tri` as `rank`,

  TRIM(`field02`) as `content`,

  `active` as `public`,

  IF(`subject` = 'demande', 0, 1) as `isOffer`,
  `field09` as `isPaid`,

  IF(`field03` IS NULL or `field03` = '', null, STR_TO_DATE(`field03`,'%Y-%m-%d')) as `starts`,
  IF(`field04` IS NULL or `field04` = '', null, STR_TO_DATE(`field04`,'%Y-%m-%d')) as `stops`,

  TRIM(`field05`) as `identity`,
  TRIM(`field06`) as `phone`,
  TRIM(`field07`) as `email`,
  TRIM(`field08`) as `url`,

  TRIM(`field10`) as `job_ip`,
  `field11` as `job_timestamp`,

  `tag`.`id` as `category_id`,

  `content_item`.`id` as `legacy_id`,
  `title` as `legacy_title`,
  `user` as `legacy_user`,
  `theme` as `legacy_theme`

FROM `a7_cinergie_beta`.`content_item`
LEFT OUTER JOIN `tag` ON `tag`.`slug` = CONCAT('job-cat-',`content_item`.`theme`)
WHERE area = 'annonce' AND category = 'annonce';
