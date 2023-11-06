-- Insert the parent tag
INSERT INTO `cinergie`.`tag` (`label`, `slug`) VALUES ('Activités', 'organisation_praxis');

-- Get parent tag ID
SET @parent_id = (SELECT id FROM `cinergie`.`tag` WHERE `slug`='organisation_praxis' AND parent_id IS NULL);

-- Insert tag from categorieo
INSERT INTO `cinergie`.`tag` (`slug`, `label`, `content`, `parent_id`)
SELECT
  CONCAT('org_praxis_', `categorieo`.`id`) as `slug`,

  TRIM(`nom`) as `label`,
  TRIM(`description`) as `content`,

  @parent_id
FROM `a7_cinergie_beta`.`categorieo`
ORDER BY `nom`;



-- Create the join table
DROP TABLE IF EXISTS `organisation_tag`;
CREATE TABLE `organisation_tag` (
  `tag_id` int NOT NULL COMMENT 'FK',
  `organisation_id` int DEFAULT NULL COMMENT 'FK'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create an AI id to delete duplicates
ALTER TABLE `organisation_tag`
  ADD `id` INT NOT NULL AUTO_INCREMENT FIRST,
  ADD PRIMARY KEY (`id`);

-- Insert relation data from link_organisation_categorie, categorieo, praxis, tag
INSERT INTO `organisation_tag` (`tag_id`, `organisation_id`)
SELECT `tag`.`id` as `tag_id`, `link_organisation_categorie`.`organisation` as `organisation_id`
FROM `a7_cinergie_beta`.`link_organisation_categorie`
JOIN `a7_cinergie_beta`.`categorieo` ON `categorieo`.id = `link_organisation_categorie`.`categorie`
JOIN `cinergie`.`tag` ON `tag`.`label` = `categorieo`.`nom` AND `tag`.`parent_id` = @parent_id;

-- remove duplicates
DELETE FROM `organisation_tag`
USING `organisation_tag`,
    `organisation_tag` `dupe`
WHERE `organisation_tag`.`id` > `dupe`.`id`
    AND `organisation_tag`.`tag_id` = `dupe`.`tag_id`
    AND `organisation_tag`.`organisation_id` = `dupe`.`organisation_id`;

-- remove dead relations
DELETE FROM `organisation_tag`
WHERE `organisation_id` NOT IN (select `id` from `organisation`);


ALTER TABLE `organisation_tag`
  ADD UNIQUE KEY `organisation_tag-UNIQUE` (`tag_id`,`organisation_id`),
  ADD KEY `organisation_tag-hasOrganisation` (`organisation_id`);

ALTER TABLE `organisation_tag`
  ADD CONSTRAINT `organisation_tag-hasTag` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `organisation_tag-hasOrganisation` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`);


  -- VERIFICATION
  SELECT substring(p.nom, 1,1) as letter, count(*) as counter
  FROM `a7_cinergie_beta`.organisation p
  JOIN `a7_cinergie_beta`.`link_organisation_categorie` ip on p.id = ip.organisation
    JOIN `a7_cinergie_beta`.categorieo on categorieo.id = ip.categorie
  GROUP BY letter
  ORDER BY letter
  LIMIT 0, 50;

  SELECT substring(o.label, 1,1) as letter, count(*) as counter
  FROM `cinergie`.organisation o
  JOIN `cinergie`.`organisation_tag` ip on o.id = ip.organisation_id
  JOIN `cinergie`.`tag` on ip.tag_id = `tag`.id
  GROUP BY letter
  ORDER BY letter
  LIMIT 0, 50;
