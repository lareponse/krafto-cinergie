-- STRUCTURE
DROP TABLE IF EXISTS `cinergie`.`merchandise`;

CREATE TABLE `merchandise` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

  `slug` varchar(222) DEFAULT NULL,
  
  `rank` smallint UNSIGNED DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,

  `avatar` varchar(255) DEFAULT NULL COMMENT 'image filename',
  `content` text DEFAULT NULL,

  `public` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: view in backend only',
  `pick` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: picked for home page',
  `listable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in general listings',
  `searchable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in search results',

  `people` varchar(222) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `deliveryBe` float DEFAULT NULL,
  `deliveryEu` float DEFAULT NULL,

  `isBook` tinyint(1) NOT NULL DEFAULT '0',

  `legacy_id` varchar(40) DEFAULT NULL,
  `legacy_lien` varchar(80) DEFAULT NULL,

  PRIMARY KEY (`id`),
  UNIQUE KEY `merchandise-unique-slug` (`slug`) USING BTREE,
  INDEX(`label`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- DATA
TRUNCATE `cinergie`.`merchandise`;

-- INSERT BOOKS
INSERT INTO `cinergie`.`merchandise` (
  `id`,
  `created`,

  `slug`,

  `label`,
  `rank`,

  `avatar`,
  `content`,

  `public`,

  `isBook`,

  `people`,
  `price`,

  `legacy_id`,
  `legacy_lien`
)
SELECT
  CAST(REGEXP_SUBSTR(`id`, '[0-9]+$', 1) as UNSIGNED) as `id`,
  STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s') as `created`,

  urlparms as `slug`,

  TRIM(field01) as `label`,
  tri as `rank`,

  field06 as `avatar`,
  TRIM(field03) as `content`,

  `active` as `public`,

  1 as `isBook`,

  TRIM(field02) as `people`,
  field04 as `price`,

  id as `legacy_id`,
  field05 as `legacy_lien`

FROM `a7_cinergie_beta`.`content_item`

WHERE area = 'ventedvd' AND category = 'livre';


-- INSERT DVDs

INSERT INTO `cinergie`.`merchandise` (
  `slug`,
  `label`,
  `public`,
  `price`,
  `isBook`
)
SELECT
  `urlparms`,
  `nom`,
  `ventedvdok`,
  `ventedvdprix`,
  0 as `isBook`
FROM `a7_cinergie_beta`.`film`
WHERE `ventedvdprix` > 0;