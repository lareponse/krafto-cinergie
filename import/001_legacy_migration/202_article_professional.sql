
-- RELATION article_professional

DROP TABLE IF EXISTS `cinergie`.`article_professional`;

CREATE TABLE `cinergie`.`article_professional` (
  `article_id` int NOT NULL COMMENT 'FK',
  `professional_id` int NOT NULL COMMENT 'FK'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create an AI id to delete duplicates
ALTER TABLE `article_professional`
  ADD `id` INT NOT NULL AUTO_INCREMENT FIRST,
  ADD PRIMARY KEY (`id`);

-- Data insert
INSERT INTO `cinergie`.`article_professional` (  `article_id`,`professional_id`)
SELECT a.`id` as `article_id`, p.`id` as professional_id
FROM `a7_cinergie_beta`.`link_ci_personne`
INNER JOIN `cinergie`.`professional` p ON `link_ci_personne`.personne = p.id
INNER JOIN `cinergie`.`article` a ON a.legacy_id = `link_ci_personne`.content_item;


-- unique, index & FK
ALTER TABLE `article_professional`
  ADD UNIQUE KEY `article_professional-hasArticle-isUnique` (`article_id`,`professional_id`),
  ADD KEY `article_professional-hasProfessional` (`professional_id`),
  ADD KEY `article_professional-hasArticle` (`article_id`);

ALTER TABLE `article_professional`
  ADD CONSTRAINT `article_professional-hasArticle` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ,
  ADD CONSTRAINT `article_professional-hasProfessional` FOREIGN KEY (`professional_id`) REFERENCES `professional` (`id`) ;
