DROP TABLE IF EXISTS `cinergie`.`article`;

CREATE TABLE `cinergie`.`article` (
  `id` int NOT NULL COMMENT '**NOT** parsed from legacy ID',

  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'leg:datestamp',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(222) NOT NULL COMMENT 'leg:urlparm',
  `label` varchar(190) NOT NULL COMMENT 'leg:field01',
  
  `content` mediumtext COMMENT 'leg:field06',

  `type_id` int DEFAULT NULL COMMENT 'FK tag, parse from legacy_subject',

  `abstract` text COMMENT 'leg:field05',
  `publication` date NOT NULL COMMENT 'leg:field02',
  `embedVideo` text COMMENT 'leg:field07',
  `isArchived` tinyint(1) DEFAULT NULL COMMENT 'leg:field11',
  `isDiaporama` tinyint(1) DEFAULT NULL COMMENT 'leg:field10',
  `rank` smallint UNSIGNED DEFAULT NULL,

  `profilePicture` varchar(255) DEFAULT NULL COMMENT 'leg:field04',

  `legacy_id` varchar(40) DEFAULT NULL,
  `legacy_title` varchar(190) DEFAULT NULL,
  `legacy_authors` varchar(84) DEFAULT NULL COMMENT 'leg:field03',
  `legacy_author_ids` varchar(45) DEFAULT NULL COMMENT 'leg:field09',
  `legacy_user` varchar(13) DEFAULT NULL,
  `legacy_theme` varchar(17) DEFAULT NULL,
  `legacy_subject` varchar(17) DEFAULT NULL,
  `legacy_field13` varchar(23) DEFAULT NULL,
  `legacy_field14` varchar(14) DEFAULT NULL,
  `legacy_field18` varchar(10) DEFAULT NULL,
  `legacy_field19` varchar(14) DEFAULT NULL,
  `legacy_field20` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- PRIMARY

ALTER TABLE `cinergie`.`article` ADD PRIMARY KEY (`id`);
ALTER TABLE `cinergie`.`article` MODIFY `id` int NOT NULL AUTO_INCREMENT;


-- INDEX

ALTER TABLE `cinergie`.`article` ADD UNIQUE `article-slug-unique` (`slug`);
ALTER TABLE `cinergie`.`article` ADD CONSTRAINT `article-hasType` FOREIGN KEY (`type_id`) REFERENCES `tag` (`id`);

CREATE INDEX idx_active ON `article`(`active`);

-- DATA

TRUNCATE `cinergie`.`article`;

INSERT INTO `cinergie`.`article` (
  `created_on`,
  `active`,
  `slug`,
  `rank`,

  `label`,
  `content`,

  `publication`,
  `abstract`,
  `embedVideo`,
  `isDiaporama`,
  `isArchived`,

  `type_id`,

  `profilePicture`,

  `legacy_id`,
  `legacy_theme`,
  `legacy_subject`,
  `legacy_user`,
  `legacy_title`,
  `legacy_author_ids`,
  `legacy_authors`,
  `legacy_field13`,
  `legacy_field14`,
  `legacy_field18`,
  `legacy_field19`,
  `legacy_field20`
)
SELECT
  STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s') as `created_on`,
  `active` as `active`,
  urlparms as `slug`,
  tri as `rank`,

  TRIM(field01) as `label`,
  TRIM(field06) as `content`,

  STR_TO_DATE(field02, '%Y-%m-%d') as `publication`,
  TRIM(field05) as `abstract`,
  field07 as `embedVideo`,
  field10 = '1' as `isDiaporama`,
  field11 = '1' as `isArchived`,

  `tag`.`id` as `type_id`,

  field04 as `profilePicture`,

  `content_item`.id as legacy_id,
  theme as legacy_theme,
  subject as legacy_subject,
  user as legacy_user,
  title as legacy_title,
  field09 as legacy_author_ids,
  field03 as legacy_authors,
  field13 as legacy_field13,
  field14 as legacy_field14,
  field18 as legacy_field18,
  field19 as legacy_field19,
  field20 as legacy_field20
FROM `a7_cinergie_beta`.`content_item`
LEFT OUTER JOIN `tag` ON `tag`.`slug` = `content_item`.`subject`
WHERE area = 'actualite' AND category = 'actualite'
ORDER BY `legacy_subject`  DESC;



-- PROCESS datestamp format 2022-11-26 11:31:47 -> %Y-%m-%d %H:%i:%s
-- PROCESS title and field01 are similar, title is the reference, field01 is the displayed title
-- PROCESS field03 and field09 are similar, 3 stores the string:names, 9 stores |id|id| from author
-- PROCESS field04 is a filepath


-- urlparms
  -- null:3626
  -- double: 'accessoiristes', 'cascadeurs',' emile-degelin'

    --   $content_item = array(
    --   array('id' => 'organisation_html_meta_011','lang' => 'fr','category' => 'html_meta','area' => 'organisation','theme' => '33','subject' => '_global','datestamp' => '2017-10-31 00:00:00','tri' => '0','user' => 'webteam','status' => 'accepted','comment' => '','urlparms' => 'cascadeurs','title' => 'Cascadeurs','active' => '1','field01' => 'Les sociétés de cascadeurs actives dans le cinéma belge','field02' => 'Vous cherchez une société de cascadeurs active dans le cinéma belge? C\'est simple et facile avec le répertoire tenu à jour par Cinergie.be','field03' => NULL,'field04' => 'Les sociétés de cascadeurs actives dans le cinéma belge par Cinergie.be','field05' => 'Société de cascadeurs','field06' => NULL,'field07' => NULL,'field08' => NULL,'field09' => NULL,'field10' => NULL,'field11' => NULL,'field12' => NULL,'field13' => NULL,'field14' => NULL,'field15' => NULL,'field16' => NULL,'field17' => NULL,'field18' => NULL,'field19' => NULL,'field20' => NULL),
    --   array('id' => 'personne_html_meta_002','lang' => 'fr','category' => 'html_meta','area' => 'personne','theme' => '18','subject' => '_global','datestamp' => '2017-10-31 00:00:00','tri' => '0','user' => 'webteam','status' => 'accepted','comment' => ' ','urlparms' => 'accessoiristes','title' => 'Accessoiriste','active' => '1','field01' => 'Les accessoiristes actifs dans le cinéma belge','field02' => 'Les  accessoiristes du cinéma belges sont répertoriés dans le site de Cinergie.be','field03' => NULL,'field04' => 'Accessoiristes dans le cinéma - Répertoire Cinergie.be','field05' => 'Accessoiristes','field06' => 'Accessoiriste dans le cinéma - Répertoire Cinergie.be','field07' => NULL,'field08' => NULL,'field09' => NULL,'field10' => NULL,'field11' => NULL,'field12' => NULL,'field13' => NULL,'field14' => NULL,'field15' => NULL,'field16' => NULL,'field17' => NULL,'field18' => NULL,'field19' => NULL,'field20' => NULL),
    --   array('id' => 'personne_html_meta_016','lang' => 'fr','category' => 'html_meta','area' => 'personne','theme' => '26','subject' => '_global','datestamp' => '2017-10-31 00:00:00','tri' => '0','user' => 'webteam','status' => 'accepted','comment' => ' ','urlparms' => 'cascadeurs','title' => 'Cascadeur(-euse)','active' => '1','field01' => 'Les cascadeuses & cascadeurs actifs dans le cinéma belge','field02' => 'A la recherche d\'un cascadeur ou cascadeuses ou doublure d\'un acteur, Cinergie vous présente tous les cascadeurs/ses actifs en Belgique.','field03' => NULL,'field04' => 'Cascadeuses & cascadeurs - Répertoire de Cinergie.be','field05' => 'Cascadeuses & cascadeurs','field06' => 'Le cascadeur peut être employé en tant que doublure d\'un acteur','field07' => NULL,'field08' => NULL,'field09' => NULL,'field10' => NULL,'field11' => NULL,'field12' => NULL,'field13' => NULL,'field14' => NULL,'field15' => NULL,'field16' => NULL,'field17' => NULL,'field18' => NULL,'field19' => NULL,'field20' => NULL),
    --   array('id' => 'personne_html_meta_9002','lang' => 'fr','category' => 'html_meta','area' => 'personne','theme' => '18','subject' => '_global','datestamp' => '2017-09-12 16:04:51','tri' => '2','user' => 'pat','status' => 'accepted','comment' => '','urlparms' => 'accessoiristes','title' => 'Accessoiristes','active' => '1','field01' => 'Les accessoiristes actifs dans le cinéma belge','field02' => 'Vous cherchez un accessoiriste? Retrouvez tous les accessoiristes sur Cinergie.be','field03' => '','field04' => 'Accessoiristes dans le cinéma - Répertoire Cinergie.be','field05' => '','field06' => '','field07' => '','field08' => '','field09' => '','field10' => '','field11' => '','field12' => '','field13' => '','field14' => '','field15' => '','field16' => '','field17' => '','field18' => '','field19' => '','field20' => '')
    -- );
