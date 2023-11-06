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
  UNIQUE KEY `tag-unique-slug` (`slug`) USING BTREE,
  UNIQUE KEY `tag-label-unique-by-parent_id` (`label`,`parent_id`) USING BTREE,

  INDEX(`label`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- INDEX
ALTER TABLE `tag` ADD KEY `tag-hasParent` (`parent_id`);
ALTER TABLE `tag` ADD CONSTRAINT `tag-hasParent` FOREIGN KEY (`parent_id`) REFERENCES `tag` (`id`);




-- DATA

TRUNCATE `cinergie`.`tag`;

-- DATA :: Film :: theme from publisher_fixed_text
SET @parent = 'movie_theme' COLLATE utf8mb4_general_ci;
INSERT INTO `cinergie`.`tag` (`label`, `slug`) VALUES ('Thème du film', @parent);

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug` = @parent);

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


-- DATA :: Film :: genre, extracted from legacy data using DISTINCT

-- Insert the parent tag
SET @parent = 'movie_genre' COLLATE utf8mb4_general_ci;
INSERT INTO `cinergie`.`tag` (`label`, `slug`) VALUES ('Genre du film', @parent);

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug` = @parent);

-- Insert tags
INSERT INTO `cinergie`.`tag` (`slug`, `label`, `parent_id`) VALUES
('animation', 'Animation', @parent_id),
('docu-animation', 'Docu-animation', @parent_id),
('docu-fiction', 'Docu-fiction', @parent_id),
('documentaire', 'Documentaire', @parent_id),
('fiction', 'Fiction', @parent_id);


-- DATA :: Film :: footage, extracted from legacy data using DISTINCT

-- Insert the parent tag
SET @parent = 'movie_footage' COLLATE utf8mb4_general_ci;
INSERT INTO `cinergie`.`tag` (`label`, `slug`) VALUES ('Métrage', @parent);

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug` = @parent);

-- Insert tags
INSERT INTO `cinergie`.`tag` (`slug`, `label`, `content`, `parent_id`) VALUES
('court_metrage', 'Court métrage', '01|Court métrage', @parent_id),
('moyen_metrage', 'Moyen métrage', '02|Moyen métrage', @parent_id),
('long_metrage', 'Long métrage', '03|Long métrage', @parent_id);


-- DATA :: article type from layout_subject
SET @parent = 'article_category' COLLATE utf8mb4_general_ci;
INSERT INTO `cinergie`.`tag` (`label`, `slug`) VALUES ('Catégorie', @parent);

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug` = @parent);

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
SET @parent = 'event_category' COLLATE utf8mb4_general_ci;

INSERT INTO `cinergie`.`tag` (`label`, `slug`) VALUES ('Catégorie', @parent);

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug` = @parent);

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
SET @parent = 'job_category' COLLATE utf8mb4_general_ci;

INSERT INTO `cinergie`.`tag` (`label`, `slug`) VALUES ('Catégorie', @parent);

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug` = @parent);

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



-- DATA :: Used as labels
SET @parent = 'job_payment' COLLATE utf8mb4_general_ci;
INSERT INTO `tag` (`label`, `slug`)  VALUES ('Rémunéré ou pas ?', @parent);

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug` = @parent);
-- Insert tag from layout_subject
INSERT INTO `tag` (`parent_id`, `slug`, `label`)
VALUES 
  (@parent_id, 'job-paid', 'Rémunéré'),
  (@parent_id, 'job-free', 'Non rémunéré');


-- DATA :: Used as labels
SET @parent = 'job_proposal' COLLATE utf8mb4_general_ci;
INSERT INTO `tag` (`label`, `slug`) VALUES ('Proposition ou demande ?', @parent);

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug` = @parent);

-- Insert tag from layout_subject
INSERT INTO `tag` (`parent_id`, `slug`, `label`)
VALUES 
  (@parent_id, 'job-offer', 'Proposition'),
  (@parent_id, 'job-request', 'Demande');