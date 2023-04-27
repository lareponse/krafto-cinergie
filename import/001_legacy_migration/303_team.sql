-- STRUCTURE
DROP TABLE IF EXISTS `cinergie`.`team`;

CREATE TABLE `team` (
  `id` int NOT NULL,

  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `rank` smallint UNSIGNED DEFAULT NULL,

  `label` varchar(255) DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,

  `photo` varchar(255) DEFAULT NULL,

  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- PRIMARY
ALTER TABLE `team` ADD PRIMARY KEY (`id`);
ALTER TABLE `team` MODIFY `id` int NOT NULL AUTO_INCREMENT;

-- DATA from https://www.cinergie.be/a-propos/l-equipe
TRUNCATE `cinergie`.`team`;

INSERT INTO `cinergie`.`team` (`rank`, `label`, `group`, `title`, `email`, `photo`)
VALUES
(1, 'Dimitra Bouras', 'equipe', 'Directrice, Rédactrice en chef & Responsable du site', 'dimitra.bouras@cinergie.be', 'contact/dimitra_s.jpg'),
(2, 'Samira Nefari', 'equipe', 'Assistante de rédaction', 'samira.nefari@cinergie.be', 'contact/profil_samira.jpg'),
(3, 'Vinnie Ky-Maka', 'equipe', 'Cadreur/monteur', 'kimaka20cent@gmail.com', 'contact/vinnie-s.jpg'),
(4, 'Josué Lejeune', 'equipe', 'Cadreur/monteur', 'josuel770@hotmail.com', 'contact/josue.jpg');

INSERT INTO `cinergie`.`team` (`rank`, `label`, `group`, `title`)
VALUES
(1, 'José-Luis Peñafuerte', 'CA', 'Président'),
(2, 'Thierry Zamparutti', 'CA', 'Secrétaire');

INSERT INTO `cinergie`.`team` (`rank`, `label`, `group`)
VALUES
(1, 'Martine Barbé', 'member'),
(2, 'Jean-Jacques Bastien', 'member'),
(3, 'Juliette Duret', 'member'),
(4, 'Julie Frères', 'member'),
(5, 'Jasna Krajinovic', 'member'),
(6, 'François Lebovy', 'member'),
(7, 'Marie-Hélène Massin', 'member'),
(8, 'Philippe Van Kerk', 'member');

INSERT INTO `cinergie`.`team` (`rank`, `label`, `group`, `comment`)
VALUES
(1, 'Laura Nanchino', 'observateurs', 'Centre du cinéma de la fédération Wallonie-Bruxelles'),
(2, 'Patrick Matthys', 'observateurs', 'SPFB');
