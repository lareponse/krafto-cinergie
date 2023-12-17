-- Migrating organisation
  -- keep existing AIPK
  -- trim text
  -- make slug unique

-- STRUCTURE
DROP TABLE IF EXISTS `cinergie`.`organisation`;

CREATE TABLE `cinergie`.`organisation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  `slug` varchar(222) NOT NULL,

  `label` varchar(255) NOT NULL,
  `rank` smallint UNSIGNED DEFAULT NULL COMMENT 'leg:tri',

  `avatar` varchar(255) DEFAULT NULL COMMENT 'leg:legacy_photo',
  `content` text DEFAULT NULL,

  `public` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: view in backend only',
  `pick` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: picked for home page',
  `listable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in general listings',
  `searchable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: appears in search results',

  `abbrev` varchar(70) DEFAULT NULL,

  `filmography` text DEFAULT NULL,

  `tel` varchar(90) DEFAULT NULL,
  `fax` varchar(90) DEFAULT NULL,
  `gsm` varchar(90) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `secret` varchar(55) DEFAULT NULL,

  `country` varchar(30) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `zip` varchar(33) DEFAULT NULL,
  `city` varchar(44) DEFAULT NULL,
  `street` varchar(111) DEFAULT NULL,

  `BIC` varchar(8) DEFAULT NULL COMMENT 'ISO 9362',
  `IBAN` varchar(34) DEFAULT NULL,
  `TVA` varchar(20) DEFAULT NULL,
  `numero_entreprise` varchar(30) DEFAULT NULL,

  `isPartner` tinyint(1) DEFAULT NULL,

  `legacy_lien` tinyint(1) DEFAULT NULL,
  `legacy_maj` datetime NULL,

  PRIMARY KEY (`id`),
  UNIQUE KEY `organisation-unique-slug` (`slug`) USING BTREE,
  INDEX(`label`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- DATA
TRUNCATE `cinergie`.`organisation`;

INSERT INTO `cinergie`.`organisation` (
  `id`,

  `slug`,
  
  `label`,

  `avatar`,
  `content`,

  `public`,
  `listable`,

  `abbrev`,
  `filmography`,

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

  `isPartner` ,

  `legacy_maj`,
  `legacy_lien`
)
SELECT
 `id` as `id`,

 `urlparms` as `slug`,

 TRIM(`nom`) as `label`,
 
 TRIM(`photo`) as `avatar`,
 TRIM(`presentation`) as `content`,

'1' as `public`,
 `inAnnuaire` as `listable`,

 TRIM(`abreviation`) as `abbrev`,
 TRIM(`filmographie`) as `filmography`,

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

 `partenaire`  as `isPartner`,

 `maj` as `legacy_maj`,
 `lien` as `legacy_lien`

FROM `a7_cinergie_beta`.`organisation`;


-- Cinergie details for contact & legal page
UPDATE `organisation` SET
  `IBAN` = 'BE10 0012 4446 1904',
  `TVA` = 'BE 448655484',
  `numero_entreprise` = '448655484'
WHERE `slug` = 'cinergie-be';

-- SPF-BO recorded as an organisation and a partner, changing slug before importint partners
UPDATE `organisation` SET `slug` = 'service-public-francophone-bruxellois-organisation' WHERE `slug` = 'service-public-francophone-bruxellois';
UPDATE `organisation` SET `url` = 'https://www.maisondelafrancite.be/' WHERE `slug` = 'maison-de-la-francite';

INSERT INTO `cinergie`.`organisation` (
  `created`,

  `slug`,

  `label`,
  `rank`,

  `avatar`,
  `public`,
  `url`,

  `isPartner`
)
SELECT
  STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s') as `created`,

  `urlparms` as `slug`,

  TRIM(`title`) as `label`,
  `tri` as `rank`,

  `field01` as `avatar`,

  `active` as `public`,

  `field03` as `url`,
  1 as `isPartner`


FROM `a7_cinergie_beta`.`content_item`
WHERE area = 'partenaire' AND category = 'partenaire'
ORDER BY `content_item`.`id`;
