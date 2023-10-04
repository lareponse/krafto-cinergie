-- Insert the parent tag
INSERT INTO `cinergie`.`tag` (`label`, `reference`) VALUES ('Métiers', 'professional_praxis');

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `reference`='professional_praxis' AND parent_id IS NULL);

-- Insert tag from categoriep
INSERT INTO `cinergie`.`tag` (`reference`,`label`, `content`, `parent_id`)
SELECT
 CONCAT('pro_praxis_', `categoriep`.`id`) as `reference`,
 `nom` as `label`,
 `description` as `content`,
 @parent_id
FROM `a7_cinergie_beta`.`categoriep`
ORDER BY `nom`;


-- Create the join table
DROP TABLE IF EXISTS `professional_tag`;
CREATE TABLE `professional_tag` (
  `tag_id` int NOT NULL COMMENT 'FK',
  `professional_id` int DEFAULT NULL COMMENT 'FK'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create an AI id to delete duplicates
ALTER TABLE `professional_tag`
  ADD `id` INT NOT NULL AUTO_INCREMENT FIRST,
  ADD PRIMARY KEY (`id`);

-- Insert relation data from link_personne_categorie, categoriep, praxis, tag
INSERT INTO `professional_tag` (`tag_id`, `professional_id`)
SELECT `tag`.`id` as `tag_id`, `link_personne_categorie`.`personne` as `professional_id`
FROM `a7_cinergie_beta`.`link_personne_categorie`
JOIN `a7_cinergie_beta`.`categoriep` ON `categoriep`.id = `link_personne_categorie`.`categorie`
JOIN `cinergie`.`tag` ON `tag`.`label` = `categoriep`.`nom` AND `tag`.`parent_id` = @parent_id;

-- remove duplicates
DELETE FROM `professional_tag`
USING `professional_tag`,
    `professional_tag` `dupe`
WHERE `professional_tag`.`id` > `dupe`.`id`
    AND `professional_tag`.`tag_id` = `dupe`.`tag_id`
    AND `professional_tag`.`professional_id` = `dupe`.`professional_id`;

-- remove dead relations
DELETE FROM `professional_tag`
WHERE `professional_id` NOT IN (select `id` from `professional`);

-- prevent duplicates
ALTER TABLE `professional_tag`
  ADD UNIQUE KEY `professional_tag-UNIQUE` (`tag_id`,`professional_id`),
  ADD KEY `professional_tag-hasProfessional` (`professional_id`);

-- foreign keys
ALTER TABLE `professional_tag` ADD CONSTRAINT `professional_tag-hasTag` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);
ALTER TABLE `professional_tag` ADD CONSTRAINT `professional_tag-hasProfessional` FOREIGN KEY (`professional_id`) REFERENCES `professional` (`id`);


-- VERIFICATION
SELECT substring(p.nom, 1,1) as letter, count(*) as counter
FROM `a7_cinergie_beta`.personne p
JOIN `a7_cinergie_beta`.`link_personne_categorie` ip on p.id = ip.personne
JOIN `a7_cinergie_beta`.categoriep on categoriep.id = ip.categorie
GROUP BY letter
ORDER BY letter
LIMIT 0, 130;

SELECT substring(p.lastname, 1,1) as letter, count(*) as counter
FROM `cinergie`.professional p
JOIN `cinergie`.`professional_tag` ip on p.id = ip.professional_id
JOIN `cinergie`.`tag` on ip.tag_id = `tag`.id
GROUP BY letter
ORDER BY letter
LIMIT 0, 130;
