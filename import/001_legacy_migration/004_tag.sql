-- STRUCTURE
DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

  `slug` varchar(222) NOT NULL,

  `label` varchar(255) NOT NULL,
  `rank` smallint UNSIGNED DEFAULT NULL,

  `avatar` varchar(255) DEFAULT NULL COMMENT 'image filename',
  `content` text DEFAULT NULL,

  `public` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: view in backend only',
  `pick` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: picked for home page',
  `listable` tinyint(1) NOT NULL DEFAULT  '1' COMMENT '1: appears in general listings',
  `searchable` tinyint(1) NOT NULL DEFAULT  '1' COMMENT '1: appears in search results',

  `parent_id` int DEFAULT NULL COMMENT 'FK parent tag',
  `legacy_id` varchar(30) DEFAULT NULL,

  PRIMARY KEY (`id`),
  INDEX(`label`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- INDEX

ALTER TABLE `tag` ADD UNIQUE KEY `tag-unique-slug` (`slug`) USING BTREE;
ALTER TABLE `tag` ADD UNIQUE KEY `tag-label-unique-by-parent_id` (`label`,`parent_id`) USING BTREE;
ALTER TABLE `tag` ADD KEY `tag-hasParent` (`parent_id`);
ALTER TABLE `tag`  ADD CONSTRAINT `tag-hasParent` FOREIGN KEY (`parent_id`) REFERENCES `tag` (`id`);



-- DATA
TRUNCATE `cinergie`.`tag`;

-- DATA :: Film :: theme from publisher_fixed_text
INSERT INTO `cinergie`.`tag` (`label`, `slug`) VALUES ('Thème du film', 'movie_theme');

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug`='movie_theme');

-- Insert tag from categoriep
INSERT INTO `tag` (`label`, `slug`, `parent_id`, `legacy_id`)
SELECT
`text` as `label`,
SUBSTR(id, 27) as `slug`,
@parent_id, 
SUBSTR(id, 27) as `legacy_id`

FROM `a7_cinergie_beta`.`publisher_fixed_text`
WHERE `id` LIKE 'publisher_parm_theme_film_%'
ORDER BY `text` ASC;


-- DATA :: Film :: genre from nowhere

-- Insert the parent tag
INSERT INTO `cinergie`.`tag` (`label`, `slug`) VALUES ('Genre du film', 'movie_genre');

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug`='movie_genre');

-- Insert tags
INSERT INTO `cinergie`.`tag` (`slug`, `label`, `parent_id`) VALUES
('animation', 'Animation', @parent_id),
('docu-animation', 'Docu-animation', @parent_id),
('docu-fiction', 'Docu-fiction', @parent_id),
('documentaire', 'Documentaire', @parent_id),
('fiction', 'Fiction', @parent_id);

-- DATA :: Film :: footage from nowhere

-- Insert the parent tag
INSERT INTO `cinergie`.`tag` (`label`, `slug`) VALUES ('Métrage', 'movie_footage');


-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug`='movie_footage');

-- Insert tags
INSERT INTO `cinergie`.`tag` (`slug`, `label`, `content`, `parent_id`) VALUES
('court_metrage', 'Court métrage', '01|Court métrage', @parent_id),
('moyen_metrage', 'Moyen métrage', '02|Moyen métrage', @parent_id),
('long_metrage', 'Long métrage', '03|Long métrage', @parent_id);


-- DATA :: article type from layout_subject
INSERT INTO `cinergie`.`tag` (`label`, `slug`) VALUES ('Catégorie', 'article_category');

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug`='article_category');

-- Insert tag from layout_subject
INSERT INTO `tag` (`parent_id`, `slug`, `label`, `content`, `legacy_id`)
SELECT
  @parent_id,
  CONCAT('article-cat-', `id`) as `slug`,
  `description` as `label`,
  `attr02` as `content`,
  `id` as `legacy_id`

FROM `a7_cinergie_beta`.`layout_subject`
WHERE `area` ='actualite'
ORDER BY `description` ASC;

-- REMOVE unused tags https://github.com/HexMakina/krafto-cinergie/issues/23
DELETE FROM `tag` WHERE `parent_id` = @parent_id AND `slug` IN ('aide_a_la_production', 'musique_de_film');


-- DATA :: Event type theme from layout_subject
INSERT INTO `cinergie`.`tag` (`label`, `slug`) VALUES ('Catégorie', 'event_category');

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug`='event_category');

-- Insert tag from layout_subject
INSERT INTO `tag` (`parent_id`, `slug`, `label`, `content`, `legacy_id`)
SELECT
  @parent_id,
  CONCAT('event-cat-', `id`) as `slug`,
  `description` as `label`,
  `attr02` as `content`,
  `id` as `legacy_id`
FROM `a7_cinergie_beta`.`layout_subject`
WHERE `area` = 'agenda'
ORDER BY `description` ASC;




-- DATA :: Event type theme from layout_subject
INSERT INTO `cinergie`.`tag` (`label`, `slug`) VALUES ('Catégorie', 'job_category');

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug`='job_category');

-- Insert tag from layout_subject
INSERT INTO `tag` (`parent_id`, `slug`, `label`, `content`, `legacy_id`)
SELECT
  @parent_id,
  CONCAT('job-cat-', `id`) as `slug`,
  `description` as `label`,
  `attr02` as `content`,
  `id` as `legacy_id`

FROM `a7_cinergie_beta`.`layout_theme`
WHERE `area` ='annonce'
ORDER BY `description` ASC;



INSERT INTO `tag` (`id`, `parent_id`, `slug`, `label`, `content`, `rank`) 
VALUES (NULL, NULL, 'job_payment', 'Rémunéré ou pas ?', NULL, NULL);

SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug`='job_payment');
-- Insert tag from layout_subject
INSERT INTO `tag` (`parent_id`, `slug`, `label`)
VALUES 
  (@parent_id, 'job-paid', 'Rémunéré'),
  (@parent_id, 'job-free', 'Non rémunéré');


INSERT INTO `tag` (`id`, `parent_id`, `slug`, `label`, `content`, `rank`) 
VALUES (NULL, NULL, 'job_proposal', 'Proposition ou demande ?', NULL, NULL);

SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug`='job_proposal');
-- Insert tag from layout_subject
INSERT INTO `tag` (`parent_id`, `slug`, `label`)
VALUES 
  (@parent_id, 'job-offer', 'Proposition'),
  (@parent_id, 'job-request', 'Demande');