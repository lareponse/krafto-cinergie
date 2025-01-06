-- RELATION article_movie

DROP TABLE IF EXISTS `cinergie`.`article_movie`;

CREATE TABLE `cinergie`.`article_movie` (
  `article_id` int NOT NULL COMMENT 'FK',
  `movie_id` int NOT NULL COMMENT 'FK'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create an AI id to delete duplicates
ALTER TABLE `article_movie`
  ADD `id` INT NOT NULL AUTO_INCREMENT FIRST,
  ADD PRIMARY KEY (`id`);


-- Data insert
INSERT INTO `cinergie`.`article_movie` (`article_id`,`movie_id`)
SELECT `article`.`id` as `article_id`, `movie`.`id` as movie_id
FROM `a7_cinergie_beta`.`link_ci_film`
INNER JOIN `cinergie`.`movie` ON `link_ci_film`.`film` = `movie`.`id`
INNER JOIN `cinergie`.`article` ON `article`.`legacy_id` = `link_ci_film`.`content_item`;


-- unique, index & FK
ALTER TABLE `article_movie`
  ADD UNIQUE KEY `article_movie-hasArticle-isUnique` (`article_id`,`movie_id`),
  ADD KEY `article_movie-hasMovie` (`movie_id`),
  ADD KEY `article_movie-hasArticle` (`article_id`);

ALTER TABLE `article_movie`
  ADD CONSTRAINT `article_movie-hasArticle` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ,
  ADD CONSTRAINT `article_movie-hasMovie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ;
