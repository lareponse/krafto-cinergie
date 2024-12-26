-- STRUCTURE
DROP TABLE IF EXISTS `author`;

CREATE TABLE `author` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'parsed and cast from legacy id',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'leg:datestamp',

  `slug` varchar(222) NOT NULL COMMENT 'leg:urlparm',

  `label` varchar(255) NOT NULL COMMENT 'leg:field01',
  `rank` smallint UNSIGNED DEFAULT NULL COMMENT 'leg:tri',

  `avatar` varchar(255) DEFAULT NULL COMMENT 'leg:field04',
  `content` text DEFAULT NULL,

  `public` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: view in backend only',
  `pick` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: picked for home page',
  `listable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in general listings',
  `searchable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in search results',

  `url` varchar(255) DEFAULT NULL  COMMENT 'leg:field05',

  `isCollaborator` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'displayed on equipe page',
  `professional_slug` varchar(222) DEFAULT NULL,
  
  `legacy_id` varchar(40) DEFAULT NULL,
  `legacy_user` varchar(13) DEFAULT NULL,

  PRIMARY KEY (`id`),
  UNIQUE KEY `author-unique-slug` (`slug`) USING BTREE,
  INDEX(`label`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- DATA
TRUNCATE `cinergie`.`author`;

INSERT INTO `cinergie`.`author` (
  `id`,
  `created`,

  `slug`,
  
  `label`,
  `rank`,
  
  `avatar`,

  `public`,

  `url`,

  `isCollaborator`,

  `legacy_id`,
  `legacy_user`
)
SELECT
  CAST(REGEXP_SUBSTR(`id`, '[0-9]+$', 1) as UNSIGNED) as `id`,
  STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s') as `created`,

  `urlparms` as `slug`,

  TRIM(`field01`) as `label`,
  `tri` as `rank`,

  `field04` as `avatar`,

  `active` as `public`,

  `field05` as `url`,


  `active` as `isCollaborator`,

  id as `legacy_id`,
  user as `legacy_user`

FROM `a7_cinergie_beta`.`content_item`

WHERE `area` = 'auteur' AND `category` = 'auteur'
ORDER BY `id`;

-- nullify empty url, using trim to avoid empty spaces
UPDATE `cinergie`.`author` SET `url` = NULL WHERE TRIM(`url`) = '';

-- update avatar path
UPDATE `cinergie`.`author` SET `avatar` = CONCAT('/public', `avatar`) WHERE avatar IS NOT NULL AND avatar LIKE '/images/%';

-- trimming the fat
UPDATE `cinergie`.`author` SET `professional_slug` = REPLACE(`url`, 'https://www.cinergie.be/personne/', '');