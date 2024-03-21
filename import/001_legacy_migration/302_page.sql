-- STRUCTURE
DROP TABLE IF EXISTS `cinergie`.`page`;

CREATE TABLE `page` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

  `slug` varchar(222) DEFAULT NULL,
  
  `label` varchar(255) NOT NULL COMMENT 'leg:field01',
  `content` text DEFAULT NULL COMMENT 'leg:field03',

  `public` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: view in backend only',

  `abstract` text COMMENT 'leg:field02',

  `legacy_id` varchar(40) DEFAULT NULL,
  `legacy_title` varchar(190) DEFAULT NULL,
  `legacy_user` varchar(13) DEFAULT NULL,

  PRIMARY KEY (`id`),
  UNIQUE KEY `contest-unique-slug` (`slug`) USING BTREE,
  INDEX(`label`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- DATA
TRUNCATE `cinergie`.`page`;

-- contact, l-equipe, notre-histoire, prix-cinergie
INSERT INTO `cinergie`.`page` (
  `created`,
  `slug`,

  `label`,
  `content`,

  `public`,

  `abstract`,

  `legacy_id`,
  `legacy_title`,
  `legacy_user`
)
SELECT
  STR_TO_DATE(`datestamp`,'%Y-%m-%d %H:%i:%s') as `created`,
  `urlparms` as `slug`,

  REPLACE(TRIM(`field01`), '&#039;', "'") as  `label`,
  REPLACE(TRIM(`field03`), '&#039;', "'") as `content`,

  `active` as `public`,

  REPLACE(TRIM(`field02`), '&#039;', "'") as `abstract`,

  `id` as `legacy_id`,
  `title` as `legacy_title`,
  `user` as `legacy_user`

FROM `a7_cinergie_beta`.`content_item`
WHERE `area` = 'contact' AND `category` = 'page';

-- legal info
INSERT INTO `cinergie`.`page` (
  `created`,
  `public`,
  `slug`,

  `label`,
  `content`,

  `legacy_id`,
  `legacy_title`,
  `legacy_user`
)
SELECT
  STR_TO_DATE(`datestamp`,'%Y-%m-%d %H:%i:%s') as `created`,
  
  `active` as `public`,
  `urlparms` as `slug`,

  REPLACE(TRIM(`field01`), '&#039;', "'") as  `label`,
  REPLACE(TRIM(`field02`), '&#039;', "'") as  `content`,

  `id` as `legacy_id`,
  `title` as `legacy_title`,
  `user` as `legacy_user`

FROM `a7_cinergie_beta`.`content_item`
WHERE `category` = 'texte'
AND `id` IN ('legal_texte_001', 'erreur404_texte_001');



INSERT INTO `page` (`id`, `created`, `public`, `slug`, `label`, `content`, `abstract`, `legacy_id`, `legacy_title`, `legacy_user`) 
VALUES (NULL, CURRENT_TIMESTAMP, '1', 'events', 'L\'agenda du cinéma belge en Belgique', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `page` (`id`, `created`, `public`, `slug`, `label`, `content`, `abstract`, `legacy_id`, `legacy_title`, `legacy_user`) 
VALUES (NULL, CURRENT_TIMESTAMP, '1', 'shop', 'La boutique Cinergie.be', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `page` (`id`, `created`, `public`, `slug`, `label`, `content`, `abstract`, `legacy_id`, `legacy_title`, `legacy_user`) 
VALUES (NULL, CURRENT_TIMESTAMP, '1', 'organisations', 'Le répertoire des organisations belges de cinéma', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `page` (`id`, `created`, `public`, `slug`, `label`, `content`, `abstract`, `legacy_id`, `legacy_title`, `legacy_user`) 
VALUES (NULL, CURRENT_TIMESTAMP, '1', 'professionals', 'Le répertoire des professionnels du cinéma belge', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `page` (`id`, `created`, `public`, `slug`, `label`, `content`, `abstract`, `legacy_id`, `legacy_title`, `legacy_user`)
VALUES (NULL, CURRENT_TIMESTAMP, '1', 'contests', 'Les concours organisés par Cinergie !', 'Aucun concours n\'est organisé pour le moment, mais revenez prochainement …', NULL, NULL, NULL, NULL);

INSERT INTO `page` (`id`, `created`, `public`, `slug`, `label`, `content`, `abstract`, `legacy_id`, `legacy_title`, `legacy_user`) 
VALUES (NULL, CURRENT_TIMESTAMP, '1', 'home', 'Cinergie.be -Le site du cinéma belge: actualité, agenda, répertoire, jobs..', 'Vous voulez savoir ce qu\'il se passe dans le cinéma belge? Intéressé par un métier du cinéma? Toutes les infos du cinéma en Belgique sont sur Cinergie.be', NULL, NULL, NULL, NULL);

INSERT INTO `page` (`id`, `created`, `public`, `slug`, `label`, `content`, `abstract`, `legacy_id`, `legacy_title`, `legacy_user`) 
VALUES (NULL, CURRENT_TIMESTAMP, '1', 'movies', 'Tous les films du cinéma belge', 'Aucun film ne correspond à votre recherche', NULL, NULL, NULL, NULL);

INSERT INTO `page` (`id`, `created`, `public`, `slug`, `label`, `content`, `abstract`, `legacy_id`, `legacy_title`, `legacy_user`) 
VALUES (NULL, CURRENT_TIMESTAMP, '1', 'articles', 'Toute l\'actualité du cinéma belge', 'Aucun article ne correspond à votre recherche', NULL, NULL, NULL, NULL);

-- INSERT INTO `page` (`id`, `created`, `public`, `slug`, `label`, `content`, `abstract`, `legacy_id`, `legacy_title`, `legacy_user`) 
-- VALUES (NULL, CURRENT_TIMESTAMP, '1', 'l-equipe', 'L\'équipe', 'Depuis 1996, mois après mois, ils prennent soin de Cinergie.be ! Retrouvez ici le portrait de celles et ceux sans qui vous n\'auriez plus rien de consistant à lire sur le cinéma belge !!', NULL, NULL, NULL, NULL);

-- INSERT INTO `page` (`id`, `created`, `public`, `slug`, `label`, `content`, `abstract`, `legacy_id`, `legacy_title`, `legacy_user`) 
-- VALUES (NULL, CURRENT_TIMESTAMP, '1', 'contact', 'Contactez-nous', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `page` (`id`, `created`, `public`, `slug`, `label`, `content`, `abstract`, `legacy_id`, `legacy_title`, `legacy_user`) 
VALUES (NULL, CURRENT_TIMESTAMP, '1', 'authors', 'Nos auteurs', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `page` (`id`, `created`, `public`, `slug`, `label`, `content`, `abstract`, `legacy_id`, `legacy_title`, `legacy_user`) 
VALUES (NULL, CURRENT_TIMESTAMP, '1', 'jobs', 'Les petites annonces Cinergie.be', NULL, NULL, NULL, NULL, NULL);


UPDATE `page` SET  `content` = `abstract` WHERE `slug` = 'l-equipe';
UPDATE `page` SET  `abstract` = NULL WHERE `slug` = 'l-equipe';