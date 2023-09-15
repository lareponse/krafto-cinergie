  DROP TABLE IF EXISTS `cinergie`.`professional`;

  CREATE TABLE `cinergie`.`professional` (
    `id` int NOT NULL,

    `slug` varchar(222) NOT NULL,

    `lastname` varchar(30) NOT NULL COMMENT 'leg:nom',
    `firstname` varchar(30) DEFAULT NULL,

    `content` text DEFAULT NULL COMMENT 'leg:presentation',

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

    `isListed` tinyint(1) DEFAULT NULL COMMENT 'leg:inAnnuaire',

    `declic_image` varchar(80) DEFAULT NULL,
    `declic_texte` text,
    `declic_signature` varchar(30) DEFAULT NULL,

    `updated_on` datetime NOT NULL COMMENT 'leg:maj',

    `profilePicture` varchar(255) DEFAULT NULL COMMENT 'leg:legacy_photo'

  ) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

  -- PRIMARY
  ALTER TABLE `cinergie`.`professional` ADD PRIMARY KEY (`id`);
  ALTER TABLE `cinergie`.`professional` MODIFY `id` int NOT NULL AUTO_INCREMENT;

  -- INDEX
  ALTER TABLE `cinergie`.`professional` ADD UNIQUE `professional-slug-unique` (`slug`);
  ALTER TABLE `cinergie`.`professional` ADD INDEX(`lastname`);
  ALTER TABLE `cinergie`.`professional` ADD INDEX(`firstname`);
  ALTER TABLE `cinergie`.`professional` ADD INDEX(`birth`);
  ALTER TABLE `cinergie`.`professional` ADD INDEX(`isListed`);
  -- DATA
  TRUNCATE `cinergie`.`professional`;

  INSERT INTO `cinergie`.`professional` (
    `id`,
    `slug`,

    `lastname`,
    `firstname`,

    `content`,

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

    `isListed`,

    `declic_image`,
    `declic_texte`,
    `declic_signature`,

    `profilePicture`,
    `updated_on`
  )
  SELECT
   `id` as `id`,
   `urlparms` as `slug`,

   TRIM(`nom`) as `lastname`,
   TRIM(`prenom`) as `firstname`,
   `information` as `content`,

   `filmographie` as `filmography`,

   IF(TRIM(`genre`)='', null, `genre`) as `gender`,
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

   `inAnnuaire` as `isListed`,

   `declic_image`,
   `declic_texte`,
   `declic_signature`,

   `photo`as `profilePicture`,
   `maj`as `updated_on`

  FROM `a7_cinergie_beta`.`personne`
