DROP TABLE IF EXISTS `cinergie`.`article_event`;

CREATE TABLE `cinergie`.`article_event` (
  `article_id` int NOT NULL COMMENT 'FK',
  `event_id` int NOT NULL COMMENT 'FK'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `article_event`
  ADD UNIQUE KEY `article_id` (`article_id`,`event_id`),
  ADD KEY `article_event-hasArticle` (`article_id`),
  ADD KEY `article_event-hasEvent` (`event_id`);


ALTER TABLE `article_event`
  ADD CONSTRAINT `article_event-hasArticle` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `article_event-hasEvent` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);