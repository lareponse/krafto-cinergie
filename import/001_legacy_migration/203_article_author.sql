-- RELATION article & authors

-- FORMAT field09:
  --  |auteur_183|auteur_182|
  --  |auteur_184|

-- FORMAT field03:
  --  Zahra Benasri
--  Yvon Toussaint

DROP TABLE IF EXISTS `cinergie`.`article_author`;

CREATE TABLE `cinergie`.`article_author` (
  `article_id` int NOT NULL COMMENT 'FK',
  `author_id` int NOT NULL COMMENT 'FK'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- parsing legacy_author_ids
  -- 5017 at least 1 author
  -- 649 at least 2 authors
  -- 34 at least 3 authors
  -- 1 at least 4 authors
-- author 1
INSERT INTO `cinergie`.`article_author` (`article_id`, `author_id`)
SELECT a.`id` as `article_id`, auth.`id` as `author_id`
FROM article a
JOIN author auth ON auth.`legacy_id` = TRIM('|' FROM SUBSTRING_INDEX(SUBSTRING_INDEX(a.legacy_author_ids, '|', 2), '|', -1))
WHERE a.legacy_author_ids IS NOT NULL AND a.legacy_author_ids != '';

-- author 2
INSERT INTO `cinergie`.`article_author` (`article_id`, `author_id`)
SELECT a.`id` as `article_id`, auth.`id` as `author_id`
FROM article a
JOIN author auth ON auth.`legacy_id` = TRIM('|' FROM SUBSTRING_INDEX(SUBSTRING_INDEX(a.legacy_author_ids, '|', 3), '|', -1))
WHERE a.legacy_author_ids LIKE '%|%|%';

-- author 3
INSERT INTO `cinergie`.`article_author` (`article_id`, `author_id`)
SELECT a.`id` as `article_id`, auth.`id` as `author_id`
FROM article a
JOIN author auth ON auth.`legacy_id` = TRIM('|' FROM SUBSTRING_INDEX(SUBSTRING_INDEX(a.legacy_author_ids, '|', 4), '|', -1))
WHERE a.legacy_author_ids LIKE '%|%|%|%';

-- author 4
INSERT INTO `cinergie`.`article_author` (`article_id`, `author_id`)
SELECT a.`id` as `article_id`, auth.`id` as `author_id`
FROM article a
JOIN author auth ON auth.`legacy_id` = TRIM('|' FROM SUBSTRING_INDEX(SUBSTRING_INDEX(a.legacy_author_ids, '|', 5), '|', -1))
WHERE a.legacy_author_ids LIKE '%|%|%|%|%';


ALTER TABLE `article_author`
  ADD UNIQUE KEY `article_id` (`article_id`,`author_id`),
  ADD KEY `article_author-hasArticle` (`article_id`),
  ADD KEY `article_author-hasAuthor` (`author_id`);


ALTER TABLE `article_author`
  ADD CONSTRAINT `article_author-hasArticle` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `article_author-hasAuthor` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`);
