-- RELATION movie_tag
DROP TABLE IF EXISTS `cinergie`.`movie_tag`;

CREATE TABLE `cinergie`.`movie_tag` (
  `movie_id` int NOT NULL,
  `tag_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create an AI id to delete duplicates
ALTER TABLE `movie_tag`
  ADD `id` INT NOT NULL AUTO_INCREMENT FIRST,
  ADD PRIMARY KEY (`id`);


-- Data insert
INSERT INTO `cinergie`.`movie_tag` (`movie_id`,`tag_id`)
SELECT `film`.`id` as `movie_id`, `itm_theme`.`id` as `tag_id`
FROM `a7_cinergie_beta`.`film`
INNER JOIN `cinergie`.`tag` `itm_theme` ON `itm_theme`.`reference` = `film`.`theme`;

INSERT INTO `cinergie`.`movie_tag` (`movie_id`,`tag_id`)
SELECT `film`.`id` as `movie_id`, `itm_theme`.`id` as `tag_id`
FROM `a7_cinergie_beta`.`film`
INNER JOIN `cinergie`.`tag` `itm_theme` ON `itm_theme`.`reference` = `film`.`theme_bis`;

INSERT INTO `cinergie`.`movie_tag` (`movie_id`,`tag_id`)
SELECT `film`.`id` as `movie_id`, `itm_theme`.`id` as `tag_id`
FROM `a7_cinergie_beta`.`film`
INNER JOIN `cinergie`.`tag` `itm_theme` ON `itm_theme`.`reference` = `film`.`theme_ter`;


-- Cleanup double theme
DELETE FROM `cinergie`.`movie_tag`
WHERE `movie_id` IN (
  SELECT `movie_id`
  FROM (
    SELECT `movie_id`, `tag_id`
    FROM `cinergie`.`movie_tag`
    GROUP BY `movie_id`, `tag_id`
    HAVING COUNT(*) > 1
  ) AS `duplicates`
)
AND `tag_id` IN (
  SELECT `tag_id`
  FROM (
    SELECT `movie_id`, `tag_id`
    FROM `cinergie`.`movie_tag`
    GROUP BY `movie_id`, `tag_id`
    HAVING COUNT(*) > 1
  ) AS `duplicates`
);



-- unique, index & FK
ALTER TABLE `movie_tag`
  ADD UNIQUE KEY `movie_tag-isUnique` (`movie_id`, `tag_id`),
  ADD KEY `movie_tag-hasMovie` (`movie_id`),
  ADD KEY `movie_tag-hasTag` (`tag_id`);

ALTER TABLE `movie_tag`
  ADD CONSTRAINT `movie_tag-hasMovie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`),
  ADD CONSTRAINT `movie_tag-hasTag` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);
