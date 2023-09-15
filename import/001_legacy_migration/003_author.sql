-- STRUCTURE
DROP TABLE IF EXISTS `author`;

CREATE TABLE `author` (
  `id` int NOT NULL COMMENT 'parsed and cast from legacy id',

  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'leg:datestamp',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(222) DEFAULT NULL COMMENT 'leg:urlparm',
  `rank` smallint UNSIGNED DEFAULT NULL COMMENT 'leg:tri',
  
  `profilePicture` varchar(255) DEFAULT NULL COMMENT 'leg:field04'
  `url` varchar(255) DEFAULT NULL  COMMENT 'leg:field05',

  `label` varchar(24) DEFAULT NULL COMMENT 'leg:field01',

  `isCollaborator` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'displayed on equipe page',
  `professional_slug` varchar(222) DEFAULT NULL,
  
  `legacy_id` varchar(40) DEFAULT NULL,
  `legacy_user` varchar(13) DEFAULT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- PRIMARY
ALTER TABLE `author` ADD PRIMARY KEY (`id`);
ALTER TABLE `author` MODIFY `id` int NOT NULL AUTO_INCREMENT;


-- INDEX
ALTER TABLE `author` ADD UNIQUE `author-slug-unique` (`slug`);
ALTER TABLE `author` ADD INDEX(`label`);


CREATE INDEX idx_active ON `author`(`active`);

-- DATA
TRUNCATE `cinergie`.`author`;

INSERT INTO `cinergie`.`author` (
  `id`,

  `created_on`,
  `active`,
  `slug`,
  `rank`,
  `profilePicture`,
  `url`,

  `label`,

  `isCollaborator`,

  `legacy_id`,
  `legacy_user`
)
SELECT
  CAST(REGEXP_SUBSTR(`id`, '[0-9]+$', 1) as UNSIGNED) as `id`,

  STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s') as `created_on`,
  `active` as `active`,
  `urlparms` as `slug`,
  `tri` as `rank`,
  `field04` as `profilePicture`,
  `field05` as `url`

  TRIM(`field01`) as `label`,

  `active` as `isCollaborator`,

  id as `legacy_id`,
  user as `legacy_user`

FROM `a7_cinergie_beta`.`content_item`

WHERE `area` = 'auteur' AND `category` = 'auteur'
ORDER BY `id`;


UPDATE `cinergie`.`author` SET `url` = null WHERE `url` = '';
UPDATE `cinergie`.`author` SET `professional_slug` = REPLACE(`url`, 'https://www.cinergie.be/personne/', '');