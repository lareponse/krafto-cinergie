-- STRUCTURE
DROP TABLE IF EXISTS `author`;

CREATE TABLE `author` (
  `id` int NOT NULL COMMENT 'parsed and cast from legacy id',

  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'leg:datestamp',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(222) DEFAULT NULL COMMENT 'leg:urlparm',
  `rank` smallint UNSIGNED DEFAULT NULL COMMENT 'leg:tri',

  `label` varchar(24) DEFAULT NULL COMMENT 'leg:field01',

  `isCollaborator` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'displayed on equipe page',

  `legacy_id` varchar(40) DEFAULT NULL,
  `legacy_user` varchar(13) DEFAULT NULL,
  `legacy_photo_illu` varchar(54) DEFAULT NULL COMMENT 'leg:field04',
  `legacy_url_repertoire` varchar(55) DEFAULT NULL COMMENT 'leg:field05'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- PRIMARY
ALTER TABLE `author` ADD PRIMARY KEY (`id`);
ALTER TABLE `author` MODIFY `id` int NOT NULL AUTO_INCREMENT;


-- INDEX
ALTER TABLE `author` ADD UNIQUE `author-slug-unique` (`slug`);
ALTER TABLE `author` ADD INDEX(`label`);


-- DATA
TRUNCATE `cinergie`.`author`;

INSERT INTO `cinergie`.`author` (
  `id`,

  `created_on`,
  `active`,
  `slug`,
  `rank`,

  `label`,

  `isCollaborator`,

  `legacy_id`,
  `legacy_user`,
  `legacy_photo_illu`,
  `legacy_url_repertoire`
)
SELECT
  CAST(REGEXP_SUBSTR(`id`, '[0-9]+$', 1) as UNSIGNED) as `id`,

  STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s') as `created_on`,
  `active` as `active`,
  urlparms as `slug`,
  tri as `rank`,

  field01 as `label`,

  `active` as `isCollaborator`,

  id as `legacy_id`,
  user as `legacy_user`,
  field04 as `legacy_photo_illu`,
  field05 as `legacy_url_repertoire`

FROM `a7_cinergie_beta`.`content_item`

WHERE area = 'auteur' AND category = 'auteur'
ORDER BY id;
