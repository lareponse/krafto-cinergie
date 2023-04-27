-- STRUCTURE
DROP TABLE IF EXISTS `book`;

CREATE TABLE `book` (
  `id` int NOT NULL COMMENT 'parsed and cast from legacy id',

  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(222) DEFAULT NULL COMMENT 'leg:urlparm',
  `rank` smallint UNSIGNED DEFAULT NULL COMMENT 'leg:tri',

  `label` varchar(255) DEFAULT NULL COMMENT 'leg:field01',
  `content` text COMMENT 'leg:field03',

  `authors` varchar(22) DEFAULT NULL COMMENT 'leg:field02',
  `price` float DEFAULT NULL COMMENT 'leg:field04',

  `legacy_id` varchar(40) DEFAULT NULL,
  `legacy_lien` varchar(80) DEFAULT NULL COMMENT 'leg:field05',
  `legacy_photo_illu` varchar(40) DEFAULT NULL COMMENT 'leg:field06'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- PRIMARY
ALTER TABLE `book` ADD PRIMARY KEY (`id`);
ALTER TABLE `book` MODIFY `id` int NOT NULL AUTO_INCREMENT;


-- INDEX
ALTER TABLE `book` ADD UNIQUE `book-slug-unique` (`slug`);
ALTER TABLE `book` ADD INDEX(`label`);


-- DATA
TRUNCATE `cinergie`.`book`;

INSERT INTO `cinergie`.`book` (
  `id`,

  `created_on`,
  `slug`,
  `rank`,
  `active`,

  `label`,
  `content`,

  `authors`,
  `price`,

  `legacy_id`,
  `legacy_lien`,
  `legacy_photo_illu`
)
SELECT
  CAST(REGEXP_SUBSTR(`id`, '[0-9]+$', 1) as UNSIGNED) as `id`,

  STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s') as `created_on`,
  urlparms as `slug`,
  tri as `rank`,
  `active` as `active`,

  field01 as `label`,
  field03 as `content`,

  field02 as `authors`,
  field04 as `price`,

  id as `legacy_id`,
  field05 as `legacy_lien`,
  field06 as `legacy_photo_illu`

FROM `a7_cinergie_beta`.`content_item`

WHERE area = 'ventedvd' AND category = 'livre'
