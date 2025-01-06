DROP TABLE IF EXISTS  `cinergie`.`movie_merchandise`;

CREATE TABLE `cinergie`.`movie_merchandise` (
  `movie_id` int NOT NULL COMMENT 'FK',
  `merchandise_id` int NOT NULL COMMENT 'FK'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cinergie`.`movie_merchandise` (`movie_id`, `merchandise_id`)
SELECT `movie`.`id`, `merchandise`.`id`
FROM `cinergie`.`merchandise`
JOIN `cinergie`.`movie` ON `movie`.`slug` = `merchandise`.`slug`
WHERE `merchandise`.`isBook` = 0;


ALTER TABLE `movie_merchandise`
  ADD CONSTRAINT `movie_merchandise-hasMovie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ,
  ADD CONSTRAINT `movie_merchandise-hasProduct` FOREIGN KEY (`merchandise_id`) REFERENCES `merchandise` (`id`);
