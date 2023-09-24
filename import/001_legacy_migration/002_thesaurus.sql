-- STRUCTURE
DROP TABLE IF EXISTS `thesaurus`;

CREATE TABLE `thesaurus` (
  `id` int NOT NULL,
  
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(222) DEFAULT NULL COMMENT 'leg:urlparm',

  `label` varchar(255) NOT NULL,

  `legacy_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='UNESCO';

-- PRIMARY
ALTER TABLE `thesaurus` ADD PRIMARY KEY (`id`);
ALTER TABLE `thesaurus` MODIFY `id` int NOT NULL AUTO_INCREMENT;

-- INDEX
ALTER TABLE `thesaurus` ADD UNIQUE `thesaurus-slug-unique` (`slug`);
ALTER TABLE `thesaurus` ADD INDEX(`label`);

-- DATA
TRUNCATE `thesaurus`;

INSERT INTO `cinergie`.`thesaurus` (
  `created_on`,
  `active`,
  `slug`,

  `label`,

  `legacy_id`
)
SELECT
  STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s') as `created_on`,
  `active` as `active`,
  IF(urlparms='', null, urlparms) as `slug`,

  title as `label`,

  id as `legacy_id`
FROM `a7_cinergie_beta`.`content_item`
WHERE area = 'autorite' AND category = 'autorite'
ORDER BY title ASC;
