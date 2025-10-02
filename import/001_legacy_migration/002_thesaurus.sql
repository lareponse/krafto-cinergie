-- STRUCTURE
DROP TABLE IF EXISTS `thesaurus`;

CREATE TABLE `thesaurus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(222) DEFAULT NULL COMMENT 'leg:urlparms',

  `legacy_id` varchar(255) DEFAULT NULL,

  PRIMARY KEY (`id`),
  INDEX(`label`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='UNESCO';

ALTER TABLE `thesaurus` ADD UNIQUE KEY `thesaurus-unique-slug` (`slug`) USING BTREE;


-- DATA
TRUNCATE `thesaurus`;

INSERT INTO `cinergie`.`thesaurus` (
  `label`,

  `active`,
  `slug`,

  `legacy_id`
)
SELECT
  title as `label`,

  `active` as `active`,
  IF(urlparms='', null, urlparms) as `slug`,

  id as `legacy_id`

FROM `a7_cinergie_beta`.`content_item`
WHERE area = 'autorite' AND category = 'autorite'
ORDER BY title ASC;


UPDATE `thesaurus` SET `label` = 'Irak' WHERE `label` = 'Iraq';
UPDATE `thesaurus` SET `label` = 'LGBTQIA +' WHERE `label` = 'LGTBQIA +';
INSERT INTO `thesaurus` (`label`, `active`, `slug`) VALUES ('Syrie', '1', 'thesaurus_syrie');