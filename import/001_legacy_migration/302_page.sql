-- STRUCTURE
DROP TABLE IF EXISTS `cinergie`.`page`;

CREATE TABLE `page` (
  `id` int NOT NULL,

  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(222) DEFAULT NULL,

  `label` varchar(255) DEFAULT NULL COMMENT 'leg:field01',
  `content` text COMMENT 'leg:field03',

  `abstract` text COMMENT 'leg:field02',

  `legacy_id` varchar(40) DEFAULT NULL,
  `legacy_title` varchar(190) DEFAULT NULL,
  `legacy_user` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- PRIMARY
ALTER TABLE `page` ADD PRIMARY KEY (`id`);
ALTER TABLE `page` MODIFY `id` int NOT NULL AUTO_INCREMENT;

-- INDEX
ALTER TABLE `page` ADD UNIQUE `page-slug-unique` (`slug`);

-- DATA
TRUNCATE `cinergie`.`page`;

-- notre histoire
INSERT INTO `cinergie`.`page` (
  `created_on`,
  `active`,
  `slug`,

  `label`,
  `content`,

  `abstract`,

  `legacy_id`,
  `legacy_title`,
  `legacy_user`
)
SELECT
  STR_TO_DATE(`datestamp`,'%Y-%m-%d %H:%i:%s') as `created_on`,
  `active` as `active`,
  `urlparms` as `slug`,

  `field01` as `label`,
  `field03` as `content`,

  `field02` as `abstract`,

  `id` as `legacy_id`,
  `title` as `legacy_title`,
  `user` as `legacy_user`

FROM `a7_cinergie_beta`.`content_item`
WHERE `area` = 'contact' AND `category` = 'page'
AND `id` = 'contact_page_002';

-- legal info
INSERT INTO `cinergie`.`page` (
  `created_on`,
  `active`,
  `slug`,

  `label`,
  `content`,

  `legacy_id`,
  `legacy_title`,
  `legacy_user`
)
SELECT
  STR_TO_DATE(`datestamp`,'%Y-%m-%d %H:%i:%s') as `created_on`,
  `active` as `active`,
  `urlparms` as `slug`,

  `field01` as `label`,
  `field02` as `content`,

  `id` as `legacy_id`,
  `title` as `legacy_title`,
  `user` as `legacy_user`

FROM `a7_cinergie_beta`.`content_item`
WHERE `category` = 'texte'
AND `id` IN ('legal_texte_001', 'erreur404_texte_001');
