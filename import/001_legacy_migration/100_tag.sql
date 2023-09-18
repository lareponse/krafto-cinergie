-- STRUCTURE
DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag` (
  `id` int NOT NULL,
  `parent_id` int DEFAULT NULL COMMENT 'FK tag',
  `reference` varchar(30) NOT NULL,

  `label` varchar(255) NOT NULL,
  `content` text COLLATE utf8mb4_general_ci,

  `rank` smallint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- PRIMARY
ALTER TABLE `tag` ADD PRIMARY KEY (`id`);
ALTER TABLE `tag`  MODIFY `id` int NOT NULL AUTO_INCREMENT;
-- INDEX

ALTER TABLE `tag` ADD UNIQUE KEY `unique-reference` (`reference`) USING BTREE;
ALTER TABLE `tag` ADD UNIQUE KEY `unique-label-by-parent_id` (`label`,`parent_id`) USING BTREE;
ALTER TABLE `tag` ADD KEY `tag-hasParent` (`parent_id`);

ALTER TABLE `tag`  ADD CONSTRAINT `tag-hasParent` FOREIGN KEY (`parent_id`) REFERENCES `tag` (`id`);



-- DATA
TRUNCATE `cinergie`.`tag`;

-- DATA :: Film :: theme from publisher_fixed_text
INSERT INTO `cinergie`.`tag` (`label`, `reference`) VALUES ('Thème du film', 'movie_theme');

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE reference='movie_theme');

-- Insert tag from categoriep
INSERT INTO `tag` (`label`, `reference`, `parent_id`)
SELECT
`text` as `label`,
SUBSTR(id, 27) as `reference`,
@parent_id
FROM `a7_cinergie_beta`.`publisher_fixed_text`
WHERE `id` LIKE 'publisher_parm_theme_film_%'
ORDER BY `text` ASC;


-- DATA :: Film :: genre from nowhere

-- Insert the parent tag
INSERT INTO `cinergie`.`tag` (`label`, `reference`) VALUES ('Genre du film', 'movie_genre');

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE reference='movie_genre');

-- Insert tags
INSERT INTO `cinergie`.`tag` (`reference`, `label`, `parent_id`) VALUES
('animation', 'Animation', @parent_id),
('docu-animation', 'Docu-animation', @parent_id),
('docu-fiction', 'Docu-fiction', @parent_id),
('documentaire', 'Documentaire', @parent_id),
('fiction', 'Fiction', @parent_id);

-- DATA :: Film :: footage from nowhere

-- Insert the parent tag
INSERT INTO `cinergie`.`tag` (`label`, `reference`) VALUES ('Métrage', 'movie_footage');


-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE reference='movie_footage');

-- Insert tags
INSERT INTO `cinergie`.`tag` (`reference`, `label`, `content`, `parent_id`) VALUES
('court_metrage', 'Court métrage', '01|Court métrage', @parent_id),
('moyen_metrage', 'Moyen métrage', '02|Moyen métrage', @parent_id),
('long_metrage', 'Long métrage', '03|Long métrage', @parent_id);


-- DATA :: article type from layout_subject
INSERT INTO `cinergie`.`tag` (`label`, `reference`) VALUES ('Catégorie', 'article_category');

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE reference='article_category');

-- Insert tag from layout_subject
INSERT INTO `tag` (`parent_id`, `reference`, `label`, `content`)
SELECT
  @parent_id,
  `id` as `reference`,
  `description` as `label`,
  `attr02` as `content`
FROM `a7_cinergie_beta`.`layout_subject`
WHERE `area` ='actualite'
ORDER BY `description` ASC;



-- DATA :: Event type theme from layout_subject
INSERT INTO `cinergie`.`tag` (`label`, `reference`) VALUES ('Catégorie', 'event_category');

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE reference='event_category');

-- Insert tag from layout_subject
INSERT INTO `tag` (`parent_id`, `reference`, `label`, `content`)
SELECT
  @parent_id,
  `id` as `reference`,
  `description` as `label`,
`attr02` as `content`
FROM `a7_cinergie_beta`.`layout_subject`
WHERE `area` ='agenda'
ORDER BY `description` ASC;




-- DATA :: Event type theme from layout_subject
INSERT INTO `cinergie`.`tag` (`label`, `reference`) VALUES ('Catégorie', 'work_category');

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE reference='work_category');

-- Insert tag from layout_subject
INSERT INTO `tag` (`parent_id`, `reference`, `label`, `content`)
SELECT
  @parent_id,
  `id` as `reference`,
  `description` as `label`,
  `attr02` as `content`
FROM `a7_cinergie_beta`.`layout_theme`
WHERE `area` ='annonce'
ORDER BY `description` ASC;



INSERT INTO `tag` (`id`, `parent_id`, `reference`, `label`, `content`, `rank`) 
VALUES (NULL, NULL, 'work_payment', 'Rémunéré ou pas ?', NULL, NULL);

SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE reference='work_payment');
-- Insert tag from layout_subject
INSERT INTO `tag` (`parent_id`, `reference`, `label`)
VALUES 
  (@parent_id, 'work_paid', 'Rémunéré'),
  (@parent_id, 'work_free', 'Non rémunéré');


INSERT INTO `tag` (`id`, `parent_id`, `reference`, `label`, `content`, `rank`) 
VALUES (NULL, NULL, 'work_proposal', 'Proposition ou demande ?', NULL, NULL);

SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE reference='work_proposal');
-- Insert tag from layout_subject
INSERT INTO `tag` (`parent_id`, `reference`, `label`)
VALUES 
  (@parent_id, 'work_offer', 'Proposition'),
  (@parent_id, 'work_request', 'Demande');