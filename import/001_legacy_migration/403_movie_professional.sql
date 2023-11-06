DROP TABLE IF EXISTS  `cinergie`.`movie_professional`;

CREATE TABLE `movie_professional` (
  `movie_id` int NOT NULL COMMENT 'FK',
  `professional_id` int NOT NULL COMMENT 'FK',
  `praxis_id` int NOT NULL COMMENT 'FK tag'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `movie_professional`
  ADD KEY `movie_professional-hasProfessional` (`professional_id`),
  ADD KEY `movie_professional-hasMovie` (`movie_id`),
  ADD KEY `movie_professional-hasPraxis` (`praxis_id`);

ALTER TABLE `movie_professional`
  ADD CONSTRAINT `movie_professional-hasMovie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`),
  ADD CONSTRAINT `movie_professional-hasPraxis` FOREIGN KEY (`praxis_id`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `movie_professional-hasProfessional` FOREIGN KEY (`professional_id`) REFERENCES `professional` (`id`);


INSERT INTO `cinergie`.`movie_professional` (`movie_id`, `professional_id`, `praxis_id`)
SELECT
  `link_film_personne`.`film` as `movie_id`,
  `link_film_personne`.`personne` as `professional_id`,
  `tag`.`id` as `praxis_id`
FROM `a7_cinergie_beta`.`link_film_personne`
JOIN `a7_cinergie_beta`.`categoriep` ON `link_film_personne`.`categorie` = `categoriep`.`id`
JOIN `cinergie`.`tag` ON `tag`.`slug` = CONCAT('pro_praxis_', `categoriep`.`id`)
JOIN `cinergie`.`movie` ON `movie`.`id` = `link_film_personne`.`film`
JOIN `cinergie`.`professional` ON `professional`.`id` = `link_film_personne`.`personne`;
