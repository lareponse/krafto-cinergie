
DROP TABLE IF EXISTS `kadro_acl`;
DROP TABLE IF EXISTS `kadro_operator`;
DROP TABLE IF EXISTS `kadro_permission`;
-- --------------------------------------------------------
--
-- Table structure for table `kadro_operator`
--

CREATE TABLE `kadro_operator` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'dont delete operators',
  `name` varchar(255) NOT NULL,
  `home` varchar(255) DEFAULT NULL COMMENT 'route after checkin',
  `email` varchar(255),
  `phone` varchar(30) DEFAULT NULL,
  `language_code` varchar(3) NOT NULL DEFAULT 'fra' COMMENT 'iso-639-3 code',
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for table `kadro_operator`
--
ALTER TABLE `kadro_operator`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `MODEL_operator_USAGE_IS_UNIQUE_username` (`username`) USING BTREE;

--
-- AUTO_INCREMENT for table `kadro_operator`
--
ALTER TABLE `kadro_operator`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;
-- --------------------------------------------------------

--
-- Table structure for table `kadro_permission`
--

CREATE TABLE `kadro_permission` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for table `kadro_permission`
--
ALTER TABLE `kadro_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `MODEL_permission_USAGE_IS_UNIQUE_name` (`name`) USING BTREE;
--
-- AUTO_INCREMENT for table `kadro_permission`
--
ALTER TABLE `kadro_permission`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;


-- --------------------------------------------------------
--
-- Table structure for table `kadro_acl`
--
CREATE TABLE `kadro_acl` (
  `operator_id` int UNSIGNED NOT NULL,
  `permission_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for table `kadro_acl`
--
ALTER TABLE `kadro_acl`
  ADD PRIMARY KEY (`operator_id`,`permission_id`),
  ADD KEY `kadro_acl-has-kadro_permission.id` (`permission_id`);

--
-- Constraints for table `kadro_acl`
--
ALTER TABLE `kadro_acl`
  ADD CONSTRAINT `kadro_acl-has-kadro_operator.id` FOREIGN KEY (`operator_id`) REFERENCES `kadro_operator` (`id`),
  ADD CONSTRAINT `kadro_acl-has-kadro_permission.id` FOREIGN KEY (`permission_id`) REFERENCES `kadro_permission` (`id`);



START TRANSACTION;
    INSERT INTO `cinergie`.`kadro_operator` (`id`, `username`, `name`, `password`) VALUES (1, 'krafto','krafto','krafto');
    INSERT INTO `cinergie`.`kadro_permission` (`id`, `name`) VALUES (1, 'root'),(2, 'admin'),(3, 'user');
    INSERT INTO `cinergie`.`kadro_acl` (`operator_id`, `permission_id`) VALUES (1, 1);
COMMIT;

INSERT INTO `cinergie`.`kadro_operator` (`username`, `email`, `password`, `name`)
SELECT `user`, `email`, `password`, `description`
FROM `a7_cinergie_beta`.`content_user`
WHERE `email` NOT LIKE '%@argon7.be' ;

INSERT INTO `cinergie`.`kadro_acl` (`operator_id`, `permission_id`) 
SELECT `id`, 3 
FROM `cinergie`.`kadro_operator`
WHERE `id` <> 1 
ORDER BY `id` ASC;


-- RUN the php file 
