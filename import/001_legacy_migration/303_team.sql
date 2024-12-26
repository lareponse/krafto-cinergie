-- STRUCTURE
DROP TABLE IF EXISTS `cinergie`.`team`;

CREATE TABLE `team` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

  `slug` varchar(222) NOT NULL,

  `label` varchar(255) DEFAULT NULL,
  `rank` smallint UNSIGNED DEFAULT NULL,

  `avatar` varchar(255) DEFAULT NULL COMMENT 'image filename',
  `content` text DEFAULT NULL,
  -- this public column is set to 1, the data came from the old site public HTML
  `public` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: view in backend only',
  `pick` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: picked for home page',
  `listable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in general listings',
  `searchable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in search results',

  `group` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,

  `email` varchar(255) DEFAULT NULL,
  
  PRIMARY KEY (`id`),
  UNIQUE KEY `team-unique-slug` (`slug`) USING BTREE,
  INDEX(`label`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- DATA from https://www.cinergie.be/a-propos/l-equipe
TRUNCATE `cinergie`.`team`;

INSERT INTO `cinergie`.`team` (`rank`, `slug`, `label`, `group`, `title`, `email`, `avatar`)
VALUES
(1, 'Dimitra-Bouras', 'Dimitra Bouras', 'equipe', 'Directrice, Rédactrice en chef & Responsable du site', 'dimitra.bouras@cinergie.be', 'contact/dimitra_s.jpg'),
(2, 'Samira-Nefari', 'Samira Nefari', 'equipe', 'Assistante de rédaction', 'samira.nefari@cinergie.be', 'contact/profil_samira.jpg'),
(3, 'Vinnie-Ky-Maka', 'Vinnie Ky-Maka', 'equipe', 'Cadreur/monteur', 'kimaka20cent@gmail.com', 'contact/vinnie-s.jpg'),
(4, 'Josue-Lejeune', 'Josué Lejeune', 'equipe', 'Cadreur/monteur', 'josuel770@hotmail.com', 'contact/josue.jpg');

INSERT INTO `cinergie`.`team` (`rank`, `slug`,  `label`, `group`, `title`)
VALUES
(1, 'Jose-Luis-Penafuerte', 'José-Luis Peñafuerte', 'CA', 'Président'),
(2, 'Thierry-Zamparutti', 'Thierry Zamparutti', 'CA', 'Secrétaire');

INSERT INTO `cinergie`.`team` (`rank`, `slug`,  `label`, `group`)
VALUES
(1, 'Martine-Barbe',  'Martine Barbé', 'membre'),
(2, 'Jean-Jacques-Bastien', 'Jean-Jacques Bastien', 'membre'),
(3, 'Juliette-Duret', 'Juliette Duret', 'membre'),
(4, 'Julie-Freres', 'Julie Frères', 'membre'),
(5, 'Jasna-Krajinovic', 'Jasna Krajinovic', 'membre'),
(6, 'Francois-Lebovy', 'François Lebovy', 'membre'),
(7, 'Marie-Helene-Massin', 'Marie-Hélène Massin', 'membre'),
(8, 'Philippe-Van-Kerk', 'Philippe Van Kerk', 'membre');

INSERT INTO `cinergie`.`team` (`rank`, `slug`,  `label`, `group`, `title`)
VALUES
(1, 'Laura-Nanchino', 'Laura Nanchino', 'observateur', 'Observatrice du Centre du cinéma de la fédération Wallonie-Bruxelles'),
(2, 'Patrick-Matthys', 'Patrick Matthys', 'observateur', 'Observateur de la COCOF');
