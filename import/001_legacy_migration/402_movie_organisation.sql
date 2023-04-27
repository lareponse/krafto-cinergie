DROP TABLE IF EXISTS  `cinergie`.`movie_organisation`;

CREATE TABLE `cinergie`.`movie_organisation` (
  `movie_id` int NOT NULL COMMENT 'FK',
  `organisation_id` int NOT NULL COMMENT 'FK',
  `praxis_id` int NOT NULL COMMENT 'FK tag'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `cinergie`.`movie_organisation`
  ADD KEY `movie_organisation-hasOrganisation` (`organisation_id`),
  ADD KEY `movie_organisation-hasMovie` (`movie_id`),
  ADD KEY `movie_organisation-hasPraxis` (`praxis_id`);

ALTER TABLE `cinergie`.`movie_organisation`
  ADD CONSTRAINT `movie_organisation-hasMovie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`);
ALTER TABLE `cinergie`.`movie_organisation`
  ADD CONSTRAINT `movie_organisation-hasOrganisation` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`);
ALTER TABLE `cinergie`.`movie_organisation`
  ADD CONSTRAINT `movie_organisation-hasPraxis` FOREIGN KEY (`praxis_id`) REFERENCES `tag` (`id`);


INSERT INTO `cinergie`.`movie_organisation` (`movie_id`, `organisation_id`, `praxis_id`)
SELECT
  `link_film_organisation`.`film` as `movie_id`,
  `link_film_organisation`.`organisation` as `organisation_id`,
  `tag`.`id` as `praxis_id`
FROM `a7_cinergie_beta`.`link_film_organisation`
JOIN `a7_cinergie_beta`.`categorieo` ON `link_film_organisation`.`categorie` = `categorieo`.`id`
JOIN `cinergie`.`tag` ON `tag`.`reference` = CONCAT('org_praxis_', `categorieo`.`id`)
JOIN `cinergie`.`movie` ON `movie`.`id` = `link_film_organisation`.`film`
JOIN `cinergie`.`organisation` ON `organisation`.`id` = `link_film_organisation`.`organisation`
