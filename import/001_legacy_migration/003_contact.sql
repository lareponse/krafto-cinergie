-- STRUCTURE
DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,

    `organisation_id` INT DEFAULT NULL,
    `professional_id` INT DEFAULT NULL,

    `reference` VARCHAR(10) NOT NULL,
    `label` VARCHAR(255) NOT NULL,

    `public` TINYINT DEFAULT 0,

    FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`),
    FOREIGN KEY (`professional_id`) REFERENCES `professional` (`id`),

    INDEX (`reference`),
    INDEX (`public`),
    INDEX (`organisation_id`),
    INDEX (`professional_id`)
);


-- DATA COMES FROM organisation.sql & professional.sql
SELECT `id` as `organisation_id`, 'tel' as `reference`, TRIM(`tel`) as `label`, FIND_IN_SET('tel', REPLACE(`confidentiel`, ';', ',')) IS NOT NULL <> 1 as `public`
FROM  `a7_cinergie_beta`.`organisation` 
WHERE `tel` IS NOT NULL AND `tel` <> '';

SELECT `id` as `organisation_id`, 'fax' as `reference`, TRIM(`fax`) as `label`, FIND_IN_SET('fax', REPLACE(`confidentiel`, ';', ',')) IS NOT NULL <> 1 as `public`
FROM  `a7_cinergie_beta`.`organisation` 
WHERE `fax` IS NOT NULL AND `fax` <> '';

SELECT `id` as `organisation_id`, 'gsm' as `reference`, TRIM(`mobile`) as `label`, FIND_IN_SET('mobile', REPLACE(`confidentiel`, ';', ',')) IS NOT NULL <> 1 as `public`
FROM  `a7_cinergie_beta`.`organisation` 
WHERE `mobile` IS NOT NULL AND `mobile` <> '';

SELECT `id` as `organisation_id`, 'url' as `reference`, TRIM(`site`) as `label`, FIND_IN_SET('site', REPLACE(`confidentiel`, ';', ',')) IS NOT NULL <> 1 as `public`
FROM  `a7_cinergie_beta`.`organisation` 
WHERE `site` IS NOT NULL AND `site` <> '';

SELECT `id` as `organisation_id`, 'email' as `reference`, TRIM(`email`) as `label`, FIND_IN_SET('email', REPLACE(`confidentiel`, ';', ',')) IS NOT NULL <> 1 as `public`
FROM  `a7_cinergie_beta`.`organisation` 
WHERE `email` IS NOT NULL AND `email` <> '';

SELECT `id` as `organisation_id`, 'country' as `reference`, TRIM(`pays`) as `label`, FIND_IN_SET('pays', REPLACE(`confidentiel`, ';', ',')) IS NOT NULL <> 1 as `public`
FROM  `a7_cinergie_beta`.`organisation` 
WHERE `pays` IS NOT NULL AND `pays` <> '';

SELECT `id` as `organisation_id`, 'province' as `reference`, TRIM(`region`) as `label`, FIND_IN_SET('region', REPLACE(`confidentiel`, ';', ',')) IS NOT NULL <> 1 as `public`
FROM  `a7_cinergie_beta`.`organisation` 
WHERE `region` IS NOT NULL AND `region` <> '';

SELECT `id` as `organisation_id`, 'zip' as `reference`, TRIM(`cp`) as `label`, FIND_IN_SET('cp', REPLACE(`confidentiel`, ';', ',')) IS NOT NULL <> 1 as `public`
FROM  `a7_cinergie_beta`.`organisation` 
WHERE `cp` IS NOT NULL AND `cp` <> '';

SELECT `id` as `organisation_id`, 'city' as `reference`, TRIM(`ville`) as `label`, FIND_IN_SET('ville', REPLACE(`confidentiel`, ';', ',')) IS NOT NULL <> 1 as `public`
FROM  `a7_cinergie_beta`.`organisation` 
WHERE `ville` IS NOT NULL AND `ville` <> '';

SELECT `id` as `organisation_id`, 'street' as `reference`, TRIM(`adresse`) as `label`, FIND_IN_SET('adresse', REPLACE(`confidentiel`, ';', ',')) IS NOT NULL <> 1 as `public`
FROM  `a7_cinergie_beta`.`organisation` 
WHERE `adresse` IS NOT NULL AND `adresse` <> '';