
-- Need content to differentiate root tag with same label (for dropwdowns f.i.)
UPDATE `tag` SET `content` = 'Annonce: catégorie' WHERE `tag`.`slug` = 'job_category';
UPDATE `tag` SET `content` = 'Annonce: offre, demande' WHERE `tag`.`slug` = 'job_proposal';
UPDATE `tag` SET `content` = 'Annonce: rémunération' WHERE `tag`.`slug` = 'job_payment';
UPDATE `tag` SET `content` = 'Article: catégorie' WHERE `tag`.`slug` = 'article_category';
UPDATE `tag` SET `content` = 'Evènement: catégorie' WHERE `tag`.`slug` = 'event_category';
UPDATE `tag` SET `content` = 'Organisation: activités' WHERE `tag`.`slug` = 'organisation_praxis';
UPDATE `tag` SET `content` = 'Professionel: métiers' WHERE `tag`.`slug` = 'professional_praxis';
UPDATE `tag` SET `content` = 'Film: genre' WHERE `tag`.`slug` = 'movie_genre';
UPDATE `tag` SET `content` = 'Film: métrage' WHERE `tag`.`slug` = 'movie_footage';
UPDATE `tag` SET `content` = 'Film: thème' WHERE `tag`.`slug` = 'movie_theme';