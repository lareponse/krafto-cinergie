DROP TABLE IF EXISTS `cinergie`.`organisation_professional`;

CREATE TABLE `cinergie`.`organisation_professional` (
  `organisation_id` int NOT NULL COMMENT 'FK',
  `professional_id` int NOT NULL COMMENT 'FK'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create an AI id to delete duplicates
ALTER TABLE `organisation_professional`
  ADD `id` INT NOT NULL AUTO_INCREMENT FIRST,
  ADD PRIMARY KEY (`id`);

-- indexes
ALTER TABLE `organisation_professional`
  ADD KEY `organisation_professional-hasOrganisation` (`organisation_id`),
  ADD KEY `organisation_professional-hasProfessional` (`professional_id`);


-- insert data
INSERT INTO `cinergie`.`organisation_professional` (`organisation_id`, `professional_id`)
SELECT organisation, personne
FROM `a7_cinergie_beta`.`link_personne_organisation`;


-- remove duplicates
DELETE FROM `cinergie`.`organisation_professional`
USING `cinergie`.`organisation_professional`,
    `cinergie`.`organisation_professional` `dupe`
WHERE `organisation_professional`.`id` > `dupe`.`id`
    AND `organisation_professional`.`organisation_id` = `dupe`.`organisation_id`
    AND `organisation_professional`.`professional_id` = `dupe`.`professional_id`;

-- remove dead relations
DELETE FROM `organisation_professional`
WHERE `professional_id` NOT IN (select `id` from `professional`)
OR `organisation_id` NOT IN (select `id` from `organisation`);

-- set foreign keys
ALTER TABLE `organisation_professional`
  ADD CONSTRAINT `organisation_professional-hasOrganisation` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`),
  ADD CONSTRAINT `organisation_professional-hasProfessional` FOREIGN KEY (`professional_id`) REFERENCES `professional` (`id`);
