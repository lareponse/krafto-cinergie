-- STRUCTURE

DROP TABLE IF EXISTS `cinergie`.`movie`;
CREATE TABLE `cinergie`.`movie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

  `slug` varchar(222) DEFAULT NULL COMMENT 'leg:urlparms',

  `label` varchar(255) NOT NULL COMMENT 'leg:nom',
  `rank` smallint UNSIGNED DEFAULT NULL,

  `avatar` varchar(255) DEFAULT NULL COMMENT 'leg:photo',
  `content` text DEFAULT NULL COMMENT 'leg:synopsis',
  
  `public` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: view in backend only',
  `pick` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: picked for home page',
  `listable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in general listings',
  `searchable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in search results',
  
  `original_title` varchar(255) DEFAULT NULL COMMENT 'leg:nomvo',
  `casting` text COMMENT 'TODO parse ?',
  
  `runtime` varchar(255) DEFAULT NULL COMMENT 'leg:duree',
  `released` year DEFAULT NULL COMMENT 'leg:datesortie',
  `url` varchar(255) DEFAULT NULL COMMENT 'leg:site',
  `url_trailer` varchar(255) DEFAULT NULL COMMENT 'leg:bande_annonce',
  `dailymotion` varchar(255) DEFAULT NULL COMMENT 'dailymotion reference string',
  `youtube` varchar(255) DEFAULT NULL COMMENT 'youtube reference string',
  `vimeo` varchar(255) DEFAULT NULL COMMENT 'vimeo reference string',
  
  `genre_id` int DEFAULT NULL COMMENT 'parsed from leg:genre, but where is the source ??',
  `metrage_id` int DEFAULT NULL COMMENT 'parsed from leg:metrage, but where is the source ??',
  `format` varchar(100) DEFAULT NULL COMMENT 'leg:format',

  `prix_cinergie` varchar(255) DEFAULT NULL,
  `comment` text COMMENT 'leg:autre, TODO distinct avalues',
  
  `legacy_origine` varchar(255) DEFAULT NULL COMMENT 'leg:origine, TODO parse to Countries',
  `legacy_maj` char(19) DEFAULT NULL COMMENT 'leg:maj',

  PRIMARY KEY (`id`),
  UNIQUE KEY `movie-unique-slug` (`slug`) USING BTREE,
  INDEX(`label`),
  INDEX(`released`),
  INDEX(`genre_id`),
  INDEX(`metrage_id`),
  INDEX(`public`)
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- INDEX
ALTER TABLE `movie` ADD KEY `movie-hasTagGenre` (`genre_id`);

-- FK
ALTER TABLE `movie`
  ADD CONSTRAINT `movie-hasTagGenre` FOREIGN KEY (`genre_id`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `movie-hasTagMetrage` FOREIGN KEY (`metrage_id`) REFERENCES `tag` (`id`);

-- DATA
TRUNCATE `cinergie`.`movie`;
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug`='movie_footage' AND parent_id IS NULL);
INSERT INTO `cinergie`.`movie` (
  `id`,

  `slug`,

  `label`,

  `avatar`,
  `content`,

  `public`,

  `original_title`,
  `casting`,

  `runtime`,
  `released`,
  `url`,
  `url_trailer`,


  `genre_id`,
  `metrage_id`,
  `format`,

  `comment`,

  `legacy_origine`,
  `legacy_maj`
)
SELECT
  `film`.`id` as `id`,

  `urlparms` as `slug`,

  TRIM(`nom`) as `label`,

  `photo` as `avatar`,
  TRIM(`synopsis`) as `content`,

  1 as `public`,

  TRIM(`nomvo`) as `original_title`,
  TRIM(`casting`) as `casting`,

  TRIM(`duree`) as `runtime`,
  `datesortie` as `released`,
  `site` as `url`,
  `bande_annonce` as `url_trailer`,

  `itm_genre`.`id` as `genre_id`,
  `itm_metrage`.`id` as `metrage_id`,
  `format` as `format`,

  `autre` as `comment`,

  TRIM(`origine`) as `legacy_origine`,
  `maj` as `legacy_maj`
  
FROM `a7_cinergie_beta`.`film`
LEFT OUTER JOIN `cinergie`.`tag` itm_genre ON itm_genre.`slug` = `film`.`genre`
LEFT OUTER JOIN `cinergie`.`tag` itm_metrage ON itm_metrage.`content` = `film`.`metrage` AND `itm_metrage`.`parent_id` = @parent_id;

-- DATA CORRECTION: Countries
UPDATE `cinergie`.`movie` SET legacy_origine = 'Belgique, France'
WHERE legacy_origine IN ('Belgique/France', 'Belgique-France', 'Belgique/ France', 'Belgique France  ', 'Belgique / France');

UPDATE `cinergie`.`movie` SET legacy_origine = 'France, Belgique'
WHERE legacy_origine IN ('France/Belgique', 'France - Belgique', 'Franco-belge', 'France Belgique ', 'France Belgique', 'France /Belgique', 'Français/ Belgique', 'France-Belgique', 'France / Belgique');

UPDATE `cinergie`.`movie` SET legacy_origine = 'Belgique'
WHERE legacy_origine IN ('Belgqiue', 'Belqique', 'Belgique,', 'Belg');


-- DATA CORRECTION: Trailers

-- Youtube
UPDATE movie
SET youtube = SUBSTRING_INDEX(url_trailer, '/', -1), url_trailer = NULL
WHERE url_trailer LIKE '%https://youtu.be%';


UPDATE movie
SET youtube = 
  CASE
    WHEN url_trailer LIKE '%v=%' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(url_trailer, 'v=', -1), '&', 1)
    WHEN url_trailer LIKE '%v=%' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(url_trailer, 'v=', -1), '#', 1)
    ELSE NULL
  END
WHERE TRIM(url_trailer) LIKE 'https://www.youtube.com/watch%';


-- Daily Motion
UPDATE movie
SET dailymotion = SUBSTRING_INDEX(url_trailer, '/', -1), url_trailer = NULL
WHERE url_trailer LIKE '%https://dai.ly%';



UPDATE movie
SET dailymotion = 
CASE
    WHEN url_trailer LIKE '%#%' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(url_trailer, '/', -1), '#', 1)
    ELSE SUBSTRING_INDEX(url_trailer, '/', -1)
END, url_trailer = NULL
WHERE url_trailer LIKE 'https://www.dailymotion.com%';


-- Vimeo

UPDATE movie
SET vimeo =
  CASE 
    WHEN LOCATE('?', url_trailer) > 0 THEN SUBSTRING_INDEX(SUBSTRING_INDEX(url_trailer, '/', -1), '?', 1)
    WHEN LOCATE('#', url_trailer) > 0 THEN SUBSTRING_INDEX(SUBSTRING_INDEX(url_trailer, '/', -1), '#', 1)
    ELSE SUBSTRING_INDEX(url_trailer, '/', -1)
  END,
  url_trailer = NULL
WHERE url_trailer REGEXP '^https://vimeo.com/[0-9]+';

UPDATE movie
SET vimeo = SUBSTRING_INDEX(url_trailer, '/', -1), url_trailer = NULL
WHERE url_trailer REGEXP '^https://player\.vimeo\.com/video/[0-9]+$';