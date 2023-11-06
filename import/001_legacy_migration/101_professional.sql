  DROP TABLE IF EXISTS `cinergie`.`professional`;

  CREATE TABLE `cinergie`.`professional` (
    `id` int NOT NULL AUTO_INCREMENT,
    `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

    `slug` varchar(222) NOT NULL,

    `label` varchar(255) NOT NULL COMMENT 'concat lastname and firstname',
    `rank` smallint UNSIGNED DEFAULT NULL COMMENT 'leg:tri',
    
    `avatar` varchar(255) DEFAULT NULL COMMENT 'leg:legacy_photo',
    `content` text DEFAULT NULL COMMENT 'leg:presentation',

    `public` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: view in backend only',
    `pick` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: picked for home page',
    `listable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in general listings',
    `searchable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in search results',

    `lastname` varchar(30) NOT NULL COMMENT 'leg:nom',
    `firstname` varchar(30) DEFAULT NULL COMMENT 'leg:prenom',

    `filmography` text DEFAULT NULL,

    `gender` char(1) DEFAULT NULL COMMENT 'leg:genre',
    `birth` date DEFAULT NULL COMMENT 'leg:datenaiss',
    `death` date DEFAULT NULL COMMENT 'leg:datedeces',


    `tel` varchar(50) DEFAULT NULL,
    `fax` varchar(33) DEFAULT NULL,
    `gsm` varchar(90) DEFAULT NULL COMMENT 'leg:mobile',
    `url` varchar(200) DEFAULT NULL,
    `email` varchar(70) DEFAULT NULL,
    `secret` varchar(55) DEFAULT NULL COMMENT 'leg:confidentiel',

    `country` varchar(30) DEFAULT NULL COMMENT 'leg:pays',
    `province` varchar(40) DEFAULT NULL COMMENT 'leg:region',
    `zip` varchar(20) DEFAULT NULL COMMENT 'leg:cp',
    `city` varchar(40) DEFAULT NULL COMMENT 'leg:ville',
    `street` varchar(100) DEFAULT NULL COMMENT 'leg:adresse',


    `declic_image` varchar(80) DEFAULT NULL,
    `declic_texte` text,
    `declic_signature` varchar(30) DEFAULT NULL,

    `leg_maj` datetime NOT NULL COMMENT 'updated on',

    PRIMARY KEY (`id`),
    UNIQUE KEY `professional-unique-slug` (`slug`) USING BTREE,
    INDEX(`label`)

  ) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;


  -- INDEX
  ALTER TABLE `cinergie`.`professional` ADD INDEX(`lastname`);
  ALTER TABLE `cinergie`.`professional` ADD INDEX(`firstname`);
  ALTER TABLE `cinergie`.`professional` ADD INDEX(`birth`);
  -- DATA
  TRUNCATE `cinergie`.`professional`;

  INSERT INTO `cinergie`.`professional` (
    `id`,

    `slug`,
    
    `label`,

    `avatar`,
    `content`,

    `listable`,

    `firstname`,
    `lastname`,

    `filmography`,

    `gender`,
    `birth`,
    `death`,

    `tel`,
    `fax`,
    `gsm`,
    `url`,
    `email`,
    `secret`,

    `country`,
    `province`,
    `zip`,
    `city`,
    `street`,

    `declic_image`,
    `declic_texte`,
    `declic_signature`,

    `leg_maj`
  )
  SELECT
   `id` as `id`,

   `urlparms` as `slug`,
   CONCAT(TRIM(`prenom`), ' ', TRIM(`nom`)) as `label`,

   TRIM(`photo`) as `avatar`,
   TRIM(`information`) as `content`,

   `inAnnuaire` as `listable`,

   TRIM(`prenom`) as `firstname`,
   TRIM(`nom`) as `lastname`,

   TRIM(`filmographie`) as `filmography`,

   IF(TRIM(`genre`)='', null, TRIM(`genre`)) as `gender`,
   IF(DATE(`datenaiss`) IS NULL or `datenaiss` LIKE '%-00', null, `datenaiss`) as `birth`,
   IF(DATE(`datedeces`) IS NULL or `datedeces` LIKE '%-00', null, `datedeces`) as `death`,

   TRIM(`tel`),
   TRIM(`fax`),
   TRIM(`mobile`) as `gsm`,
   TRIM(`site`) as `url`,
   TRIM(`email`),
   TRIM(`confidentiel`) as  `secret`,

   TRIM(`pays`) as `country`,
   TRIM(`region`) as `province`,
   TRIM(`cp`) as `zip`,
   TRIM(`ville`) as `city`,
   TRIM(`adresse`) as `street`,


   TRIM(`declic_image`),
   TRIM(`declic_texte`),
   TRIM(`declic_signature`),

   `maj`as `leg_maj`

  FROM `a7_cinergie_beta`.`personne`
