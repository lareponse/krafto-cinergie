-- RELATION article & org

DROP TABLE IF EXISTS `cinergie`.`article_organisation`;

CREATE TABLE `cinergie`.`article_organisation` (
  `article_id` int NOT NULL COMMENT 'FK',
  `organisation_id` int NOT NULL COMMENT 'FK'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `cinergie`.`article_organisation` (  `article_id`,`organisation_id`)
SELECT a.`id` as `article_id`, o.`id` as organisation_id
FROM `a7_cinergie_beta`.`link_ci_organisation`
INNER JOIN `cinergie`.`organisation` o ON `link_ci_organisation`.organisation = o.id
INNER JOIN `cinergie`.`article` a ON a.legacy_id = `link_ci_organisation`.content_item;


ALTER TABLE `article_organisation`
  ADD KEY `article_organisation-hasOrganisation` (`organisation_id`),
  ADD KEY `article_organisation-hasArticle` (`article_id`);

ALTER TABLE `article_organisation`
  ADD CONSTRAINT `article_organisation-hasArticle` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ,
  ADD CONSTRAINT `article_organisation-hasOrganisation` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`);
