-- STRUCTURE

DROP TABLE IF EXISTS  `cinergie`.`movie`;
CREATE TABLE `cinergie`.`movie` (
  `id` int NOT NULL,

  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(222) DEFAULT NULL COMMENT 'leg:urlparms',

  `label` varchar(255) DEFAULT NOT NULL COMMENT 'leg:nom',
  `content` text COMMENT 'leg:synopsis',

  `original_title` varchar(255) DEFAULT NULL COMMENT 'leg:nomvo',
  `runtime` varchar(255) DEFAULT NULL COMMENT 'leg:duree',
  `released` year DEFAULT NULL COMMENT 'leg:datesortie',

  `genre_id` int DEFAULT NULL COMMENT 'parsed from leg:genre, but where is the source ??',
  `metrage_id` int DEFAULT NULL COMMENT 'parsed from leg:metrage, but where is the source ??',

  `url` varchar(255) DEFAULT NULL COMMENT 'leg:site',
  `format` varchar(100) DEFAULT NULL COMMENT 'leg:format',
  `comment` text COMMENT 'leg:autre, TODO distinct avalues',
  `casting` text COMMENT 'TODO parse ?',
  `url_trailer` varchar(255) DEFAULT NULL COMMENT 'leg:bande_annonce',
  `profilePicture` varchar(255) DEFAULT NULL COMMENT 'leg:photo',

  `legacy_origine` varchar(255) DEFAULT NULL COMMENT 'leg:origine, TODO parse to Countries',
  `legacy_maj` char(19) DEFAULT NULL COMMENT 'leg:maj'

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- PRIMARY
ALTER TABLE `movie` ADD PRIMARY KEY (`id`);
ALTER TABLE `movie` MODIFY `id` int NOT NULL AUTO_INCREMENT;

-- INDEX
ALTER TABLE `movie` ADD UNIQUE(`slug`);
ALTER TABLE `movie` ADD KEY `movie-hasTagGenre` (`genre_id`);

CREATE INDEX idx_active ON `movie`(`active`);
CREATE INDEX idx_released ON `movie`(`released`);


-- FK
ALTER TABLE `movie`
  ADD CONSTRAINT `movie-hasTagGenre` FOREIGN KEY (`genre_id`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `movie-hasTagMetrage` FOREIGN KEY (`metrage_id`) REFERENCES `tag` (`id`);

-- DATA

TRUNCATE `cinergie`.`movie`;

SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `reference`='movie_footage' AND parent_id IS NULL);

INSERT INTO `cinergie`.`movie` (
  `id`,

  `slug`,
  `active`,

  `label`,
  `content`,

  `original_title`,
  `runtime`,
  `released`,

  `url`,
  `format`,
  `comment`,
  `casting`,
  `url_trailer`,
  `profilePicture`,

  `genre_id`,
  `metrage_id`,

  `unesco_id`,
  `unesco_bis_id`,
  `unesco_ter_id`,

  `legacy_origine`,
  `legacy_photo`,
  `legacy_maj`
)
SELECT
    `film`.`id` as `id`,

    `urlparms` as `slug`,
    1 as `active`,
    TRIM(`nom`) as `label`,
    TRIM(`synopsis`) as `content`,

    TRIM(`nomvo`) as `original_title`,
    TRIM(`duree`) as `runtime`,
    `datesortie` as `released`,

    `site` as `url`,
    `format` as `format`,
    `autre` as `comment`,
    `casting` as `casting`,
    `bande_annonce` as `url_trailer`,
    `photo` as `profilePicture`,

    `itm_genre`.`id` as `genre_id`,
    `itm_metrage`.`id` as `metrage_id`,

    TRIM(`origine`) as `legacy_origine`,
    `maj` as `legacy_maj`

FROM `a7_cinergie_beta`.`film`
LEFT OUTER JOIN `cinergie`.`tag` itm_genre ON itm_genre.`reference` = `film`.`genre`
LEFT OUTER JOIN `cinergie`.`tag` itm_metrage ON itm_metrage.`content` = `film`.`metrage` AND `itm_metrage`.`parent_id` = @parent_id;


-- DATA CORRECTION
UPDATE `cinergie`.`movie` SET legacy_origine = 'Belgique, France'
WHERE legacy_origine IN ('Belgique/France', 'Belgique-France', 'Belgique/ France', 'Belgique France  ', 'Belgique / France');

UPDATE `cinergie`.`movie` SET legacy_origine = 'France, Belgique'
WHERE legacy_origine IN ('France/Belgique', 'France - Belgique', 'Franco-belge', 'France Belgique ', 'France Belgique', 'France /Belgique', 'Français/ Belgique', 'France-Belgique', 'France / Belgique');

UPDATE `cinergie`.`movie` SET legacy_origine = 'Belgique'
WHERE legacy_origine IN ('Belgqiue', 'Belqique', 'Belgique,', 'Belg');
