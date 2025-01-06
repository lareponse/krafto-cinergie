-- RUN kadro/src/BaseData/database_auth.sql

START TRANSACTION;
TRUNCATE TABLE `kadro_operator`;
TRUNCATE TABLE `kadro_permission`;
TRUNCATE TABLE `kadro_acl`;

INSERT INTO `kadro_operator` (`id`, `username`, `name`, `password`) VALUES (1, 'krafto','krafto','krafto');
INSERT INTO `kadro_permission` (`id`, `name`) VALUES (1, 'root'),(2, 'editor'),(3, 'author');
INSERT INTO `kadro_acl` (`operator_id`, `permission_id`) VALUES (1, 1);

-- INSERT the team as editors
INSERT INTO `kadro_operator`(`username`, `password`, `active`, `name`, `home`, `email`, `language_code`) 
SELECT LOWER(slug), LOWER(slug), 0, label, '/dash' as home, email, 'fra' as language_code
FROM `team` WHERE `group` = 'equipe';

INSERT INTO `kadro_acl` (`operator_id`, `permission_id`)
SELECT id, 2 FROM kadro_operator WHERE id > 1;

SET @editor_last_id = (SELECT max(id) FROM `cinergie`.`kadro_operator`);

-- INSERT the authors as authors
INSERT INTO `kadro_operator`(`username`, `password`, `active`, `name`, `home`, `language_code`)
SELECT LOWER(slug), LOWER(slug), 0, label, '/dash' as home, 'fra' as language_code
FROM author WHERE isCollaborator = 1 AND slug NOT IN (SELECT username FROM kadro_operator);

INSERT INTO `kadro_acl` (`operator_id`, `permission_id`)
SELECT id, 3 FROM kadro_operator WHERE id > @editor_last_id;
COMMIT;


-- RUN php ./002_operators_password_hash.php to generate the password hashes


