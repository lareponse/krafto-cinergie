-- STRUCTURE
DROP TABLE IF EXISTS `cinergie`.`merchandise`;

CREATE TABLE `merchandise` (
  `id` int NOT NULL,

  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(222) DEFAULT NULL,
  `rank` smallint UNSIGNED DEFAULT NULL,

  `label` varchar(255) DEFAULT NULL,
  `content` text,

  `people` varchar(222) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `deliveryBe` float DEFAULT NULL,
  `deliveryEu` float DEFAULT NULL,

  `profilePicture` varchar(255) DEFAULT NULL,

  `isBook` tinyint(1) NOT NULL DEFAULT '0',

  `legacy_id` varchar(40) DEFAULT NULL,
  `legacy_lien` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- PRIMARY
ALTER TABLE `merchandise` ADD PRIMARY KEY (`id`);
ALTER TABLE `merchandise` MODIFY `id` int NOT NULL AUTO_INCREMENT;


-- INDEX
ALTER TABLE `merchandise` ADD UNIQUE `merchandise-slug-unique` (`slug`);
ALTER TABLE `merchandise` ADD INDEX(`label`);


-- DATA
TRUNCATE `cinergie`.`merchandise`;

-- INSERT BOOKS
INSERT INTO `cinergie`.`merchandise` (
  `id`,

  `created_on`,
  `slug`,
  `rank`,
  `isActive`,

  `label`,
  `content`,

  `people`,
  `price`,

  `profilePicture`,
    
  `isBook`,

  `legacy_id`,
  `legacy_lien`
)
SELECT
  CAST(REGEXP_SUBSTR(`id`, '[0-9]+$', 1) as UNSIGNED) as `id`,

  STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s') as `created_on`,
  urlparms as `slug`,
  tri as `rank`,
  `active` as `isActive`,

  field01 as `label`,
  field03 as `content`,

  field02 as `people`,
  field04 as `price`,

  field06 as `profilePicture`,

  1 as `isBook`,

  id as `legacy_id`,
  field05 as `legacy_lien`

FROM `a7_cinergie_beta`.`content_item`

WHERE area = 'ventedvd' AND category = 'livre';


-- INSERT DVDs

INSERT INTO `cinergie`.`merchandise` (
  `isActive`,
  `slug`,
  `label`,
  `price`,
  `isBook`
)
SELECT
  `ventedvdok`,
  `urlparms`,
  `nom`,
  `ventedvdprix`,
  0 as `isBook`
FROM `a7_cinergie_beta`.`film`
WHERE `ventedvdprix` > 0;