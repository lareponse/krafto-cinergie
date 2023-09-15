-- STRUCTURE
DROP TABLE IF EXISTS `cinergie`.`work`;

CREATE TABLE `work` (
  `id` int NOT NULL COMMENT 'parsed and cast from legacy id',

  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(222) DEFAULT NULL COMMENT 'leg:urlparm',
  `rank` smallint UNSIGNED DEFAULT NULL COMMENT 'leg:tri',

  `label` varchar(255) DEFAULT NULL COMMENT 'leg:field01',
  `content` text COMMENT 'leg:field02',

  `isOffer` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'parsed: subject=demande',
  `isPaid` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'leg:field09',
  `starts` date DEFAULT NULL COMMENT 'leg:field03',
  `ends` date DEFAULT NULL COMMENT 'leg:field04',

  `identity` varchar(255) DEFAULT NULL COMMENT 'leg:field05',
  `phone` varchar(255) DEFAULT NULL COMMENT 'leg:field06',
  `email` varchar(255) DEFAULT NULL COMMENT 'leg:field07',
  `url` varchar(255) DEFAULT NULL COMMENT 'leg:field08',

  `work_ip` varchar(255) DEFAULT NULL COMMENT 'leg:field10',
  `work_timestamp` timestamp NULL DEFAULT NULL COMMENT 'leg:field11',

  `category_id` int DEFAULT NULL COMMENT 'FK tag',

  `legacy_id` varchar(40) DEFAULT NULL,
  `legacy_title` varchar(190) DEFAULT NULL,
  `legacy_user` varchar(13) DEFAULT NULL,
  `legacy_theme` varchar(17) DEFAULT NULL COMMENT 'process into category_id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- PRIMARY
ALTER TABLE `work` ADD PRIMARY KEY (`id`);
ALTER TABLE `work` MODIFY `id` int NOT NULL AUTO_INCREMENT;

-- INDEX
ALTER TABLE `work` ADD UNIQUE `work-slug-unique` (`slug`);

-- FK

ALTER TABLE `work` ADD CONSTRAINT `work-hasCategoryTag` FOREIGN KEY (`category_id`) REFERENCES `tag` (`id`);

-- DATA

TRUNCATE `cinergie`.`work`;

INSERT INTO `cinergie`.`work` (
  `id`,

  `created_on`,
  `active`,
  `slug`,
  `rank`,

  `label`,
  `content`,

  `isOffer`,
  `isPaid`,

  `starts`,
  `ends`,

  `identity`,
  `phone`,
  `email`,
  `url`,

  `work_ip`,
  `work_timestamp`,

  `category_id`,

  `legacy_id`,
  `legacy_title`,
  `legacy_user`,
  `legacy_theme`
)
SELECT
  CAST(REGEXP_SUBSTR(`content_item`.`id`, '[0-9]+$', 1) as UNSIGNED) as `id`,

  STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s') as `created_on`,
  `active` as `active`,
  `urlparms` as `slug`,
  `tri` as `rank`,

  `field01` as `label`,
  `field02` as `content`,

  IF(`subject` = 'demande', 0, 1) as `isOffer`,
  `field09` as `isPaid`,

  IF(`field03` IS NULL or `field03` = '', null, STR_TO_DATE(`field03`,'%Y-%m-%d')) as `starts`,
  IF(`field04` IS NULL or `field04` = '', null, STR_TO_DATE(`field04`,'%Y-%m-%d')) as `ends`,

  `field05` as `identity`,
  `field06` as `phone`,
  `field07` as `email`,
  `field08` as `url`,

  `field10` as `work_ip`,
  `field11` as `work_timestamp`,

  `tag`.`id` as `category_id`,

  `content_item`.`id` as `legacy_id`,
  `title` as `legacy_title`,
  `user` as `legacy_user`,
  `theme` as `legacy_theme`

FROM `a7_cinergie_beta`.`content_item`
LEFT OUTER JOIN `tag` ON `tag`.`reference` = `content_item`.`theme`
WHERE area = 'annonce' AND category = 'annonce';
