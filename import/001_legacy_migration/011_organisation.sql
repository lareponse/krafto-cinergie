-- Migrating organisation
  -- keep existing AIPK
  -- trim text
  -- make slug unique

-- STRUCTURE
DROP TABLE IF EXISTS `cinergie`.`organisation`;

CREATE TABLE `cinergie`.`organisation` (
  `id` int NOT NULL,

  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(222) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rank` smallint UNSIGNED DEFAULT NULL COMMENT 'leg:tri',

  `label` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,

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
  `isLink` tinyint(1) DEFAULT NULL,
  `isListed` tinyint(1) DEFAULT NULL COMMENT 'dans annuaire ?',

  `updated_on` datetime NULL COMMENT 'leg:maj',

  `legacy_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- PRIMARY
ALTER TABLE `cinergie`.`organisation` ADD PRIMARY KEY (`id`);
ALTER TABLE `cinergie`.`organisation` MODIFY `id` int NOT NULL AUTO_INCREMENT;

-- INDEX
ALTER TABLE `cinergie`.`organisation` ADD UNIQUE `organisation-slug-unique` (`slug`);
ALTER TABLE `cinergie`.`organisation` ADD INDEX(`label`);

-- DATA
TRUNCATE `cinergie`.`organisation`;

INSERT INTO `cinergie`.`organisation` (
  `id`,
  `active`,
  `slug`,
  `rank`,

  `label`,
  `content`,

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
  `isLink`,
  `isListed`,

  `updated_on`,

  `legacy_photo`
)
SELECT
 `id` as `id`,
 '1' as `active`,
 `urlparms` as `slug`,
 null as `rank`,

 TRIM(`nom`) as `label`,
 TRIM(`presentation`) as `content`,

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
 `lien` as `isLink`,
 `inAnnuaire` as `isListed`,

 `maj` as `updated_on`,
 TRIM(`photo`) as `legacy_photo`

FROM `a7_cinergie_beta`.`organisation`;


-- Cinergie details for contact & legal page
UPDATE `organisation` SET
  `IBAN` = 'BE10 0012 4446 1904',
  `TVA` = 'BE 448655484',
  `numero_entreprise` = '448655484'
WHERE `slug` = 'cinergie-be';

-- SPF-BO recorded as an organisation and a partner, changing slug before importint partners
UPDATE `organisation` SET `slug` = 'service-public-francophone-bruxellois-organisation' WHERE `slug` = 'service-public-francophone-bruxellois';


INSERT INTO `cinergie`.`organisation` (
  `active`,
  `slug`,
  `rank`,

  `label`,
  `url`,

  `isPartner` ,
  `created_on`,

  `legacy_photo`
)
SELECT
  `active` as `active`,
  urlparms as `slug`,
  tri as `rank`,

  title as `label`,
  field03 as `url`,

  1 as `isPartner`,
  STR_TO_DATE(datestamp,'%Y-%m-%d %H:%i:%s') as `created_on`,

  field01 as `legacy_photo`

FROM `a7_cinergie_beta`.`content_item`
WHERE area = 'partenaire' AND category = 'partenaire'
ORDER BY `content_item`.`id`;
