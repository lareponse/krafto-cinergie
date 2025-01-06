-- RELATION movie_thesaurus
DROP TABLE IF EXISTS `cinergie`.`movie_thesaurus`;

CREATE TABLE `cinergie`.`movie_thesaurus` (
  `movie_id` int NOT NULL,
  `thesaurus_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create an AI id to delete duplicates
ALTER TABLE `movie_thesaurus`
  ADD `id` INT NOT NULL AUTO_INCREMENT FIRST,
  ADD PRIMARY KEY (`id`);

-- Data insert
INSERT INTO `cinergie`.`movie_thesaurus` (`movie_id`,`thesaurus_id`)
SELECT `movie`.`id` as `movie_id`, `thesaurus`.`id` as `thesaurus_id`
FROM `a7_cinergie_beta`.`link_film_notice`
INNER JOIN `cinergie`.`movie` ON `link_film_notice`.`film` = `movie`.`id`
INNER JOIN `cinergie`.`thesaurus` ON `thesaurus`.`legacy_id` = `link_film_notice`.`notice`;


-- unique, index & FK
ALTER TABLE `movie_thesaurus`
  ADD UNIQUE KEY `movie_thesaurus-hasArticle-isUnique` (`movie_id`, `thesaurus_id`),
  ADD KEY `movie_thesaurus-hasMovie` (`movie_id`),
  ADD KEY `movie_thesaurus-hasThesaurus` (`thesaurus_id`);

ALTER TABLE `movie_thesaurus`
  ADD CONSTRAINT `movie_thesaurus-hasMovie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`),
  ADD CONSTRAINT `movie_thesaurus-hasThesaurus` FOREIGN KEY (`thesaurus_id`) REFERENCES `thesaurus` (`id`);
