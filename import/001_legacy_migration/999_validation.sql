-- book
SELECT IF(
(SELECT count(id) FROM cinergie.`merchandise` WHERE isBook = 1) = (SELECT count(id) FROM `a7_cinergie_beta`.content_item WHERE category = 'livre'), 'OK', 'NOK') as book_count_same,
(SELECT count(id) FROM cinergie.`merchandise` WHERE isBook = 1) as count_new,
(SELECT count(id) FROM `a7_cinergie_beta`.content_item WHERE category = 'livre') as count_old;

-- author
SELECT IF(
(SELECT count(id) FROM cinergie.`author`) = (SELECT count(id) FROM `a7_cinergie_beta`.content_item WHERE category = 'auteur'), 'OK', 'NOK') as author_count_same,
(SELECT count(id) FROM cinergie.`author`) as count_new,
(SELECT count(id) FROM `a7_cinergie_beta`.content_item WHERE category = 'auteur') as count_old;

-- contest
SELECT IF(
(SELECT count(id) FROM cinergie.`contest`) = (SELECT count(id) FROM `a7_cinergie_beta`.content_item WHERE category = 'concours'), 'OK', 'NOK') as contest_count_same,
(SELECT count(id) FROM cinergie.`contest`) as count_new,
(SELECT count(id) FROM `a7_cinergie_beta`.content_item WHERE category = 'concours') as count_old;

-- event
SELECT IF(
(SELECT count(id) FROM cinergie.`event`) = (SELECT count(id) FROM `a7_cinergie_beta`.content_item WHERE category = 'agenda'), 'OK', 'NOK') as event_count_same,
(SELECT count(id) FROM cinergie.`event`) as count_new,
(SELECT count(id) FROM `a7_cinergie_beta`.content_item WHERE category = 'agenda') as count_old;

-- job
SELECT IF(
(SELECT count(id) FROM cinergie.`job`) = (SELECT count(id) FROM `a7_cinergie_beta`.content_item WHERE category = 'annonce'), 'OK', 'NOK') as job_count_same,
(SELECT count(id) FROM cinergie.`job`) as count_new,
(SELECT count(id) FROM `a7_cinergie_beta`.content_item WHERE category = 'annonce') as count_old;

-- article
SELECT IF(
(SELECT count(id) FROM cinergie.`article`) = (SELECT count(id) FROM `a7_cinergie_beta`.content_item WHERE category = 'actualite'), 'OK', 'NOK') as article_count_same,
(SELECT count(id) FROM cinergie.`article`) as count_new,
(SELECT count(id) FROM `a7_cinergie_beta`.content_item WHERE category = 'actualite') as count_old;


-- organisation
SELECT IF(
(SELECT count(id) FROM cinergie.`organisation`) = (SELECT (count(id)+7) FROM `a7_cinergie_beta`.organisation), 'OK', 'NOK') as organisation_count_same,
(SELECT count(id) FROM cinergie.`organisation`) as count_new,
(SELECT (count(id)+7) FROM `a7_cinergie_beta`.organisation) as count_old;


-- professional
SELECT IF(
(SELECT count(id) FROM cinergie.`professional`) = (SELECT count(id) FROM `a7_cinergie_beta`.personne), 'OK', 'NOK') as professional_count_same,
(SELECT count(id) FROM cinergie.`professional`) as count_new,
(SELECT count(id) FROM `a7_cinergie_beta`.personne) as count_old;





-- RELATIONS


-- professional & organisation
SELECT
IF(
  (SELECT count(*) FROM cinergie.`organisation_professional`)
  = (
      SELECT count(*) FROM `a7_cinergie_beta`.link_personne_organisation
      JOIN `organisation` ON `organisation`.id = organisation
      JOIN `a7_cinergie_beta`.personne ON personne.id = personne
    ),
  'OK', 'NOK'
) as organisation_professional_count_same,

(SELECT count(*) FROM cinergie.`organisation_professional`) as count_new,
(
    SELECT count(*) FROM `a7_cinergie_beta`.link_personne_organisation
    JOIN `organisation` ON `organisation`.id = organisation
    JOIN `a7_cinergie_beta`.personne ON personne.id = personne
) as count_old;


-- article & organisation
SELECT
IF(
  (SELECT count(*) FROM cinergie.`article_organisation`)
  = (
    SELECT count(*)
    FROM `a7_cinergie_beta`.`link_ci_organisation`
    JOIN `a7_cinergie_beta`.`organisation` ON `link_ci_organisation`.organisation = organisation.id
    JOIN `a7_cinergie_beta`.`content_item` ON `link_ci_organisation`.content_item = `content_item`.id
  ),
  'OK', 'NOK'
) as article_organisation_count_same,
(SELECT count(*) FROM cinergie.`article_organisation`) as count_new,
(
  SELECT count(*)
  FROM `a7_cinergie_beta`.`link_ci_organisation`
  JOIN `a7_cinergie_beta`.`organisation` ON `link_ci_organisation`.organisation = organisation.id
  JOIN `a7_cinergie_beta`.`content_item` ON `link_ci_organisation`.content_item = `content_item`.id
) as count_old;


-- article & professional
SELECT
IF(
  (SELECT count(*) FROM cinergie.`article_professional`)
  = (
    SELECT count(*)
    FROM `a7_cinergie_beta`.`link_ci_personne`
    JOIN `a7_cinergie_beta`.`personne` ON `link_ci_personne`.personne = personne.id
    JOIN `a7_cinergie_beta`.`content_item` ON `link_ci_personne`.content_item = `content_item`.id
  ),
  'OK', 'NOK'
) as article_professional_count_same,
(SELECT count(*) FROM cinergie.`article_professional`) as count_new,
(
  SELECT count(*)
  FROM `a7_cinergie_beta`.`link_ci_personne`
  JOIN `a7_cinergie_beta`.`personne` ON `link_ci_personne`.personne = personne.id
  JOIN `a7_cinergie_beta`.`content_item` ON `link_ci_personne`.content_item = `content_item`.id
) as count_old;


-- movie & org
SELECT
IF(
  (SELECT count(*) FROM cinergie.`movie_organisation`)
  = (
    SELECT count(*)
    FROM `a7_cinergie_beta`.`link_film_organisation`
    JOIN `a7_cinergie_beta`.`film` ON `link_film_organisation`.film = film.id
    JOIN `a7_cinergie_beta`.`organisation` ON `link_film_organisation`.organisation = `organisation`.id
    JOIN `a7_cinergie_beta`.`categorieo` ON `link_film_organisation`.categorie = `categorieo`.id

  ),
  'OK', 'NOK'
) as movie_organisation_count_same,
(SELECT count(*) FROM cinergie.`movie_organisation`) as count_new,
(
  SELECT count(*)
  FROM `a7_cinergie_beta`.`link_film_organisation`
  JOIN `a7_cinergie_beta`.`film` ON `link_film_organisation`.film = film.id
  JOIN `a7_cinergie_beta`.`organisation` ON `link_film_organisation`.organisation = `organisation`.id
  JOIN `a7_cinergie_beta`.`categorieo` ON `link_film_organisation`.categorie = `categorieo`.id

) as count_old;



-- movie & pro
SELECT
IF(
  (SELECT count(*) FROM cinergie.`movie_professional`)
  = (
    SELECT count(*)
    FROM `a7_cinergie_beta`.`link_film_personne`
    JOIN `a7_cinergie_beta`.`film` ON `link_film_personne`.film = film.id
    JOIN `a7_cinergie_beta`.`personne` ON `link_film_personne`.personne = `personne`.id
    JOIN `a7_cinergie_beta`.`categoriep` ON `link_film_personne`.categorie = `categoriep`.id
  ),
  'OK', 'NOK'
) as movie_professional_count_same,
(SELECT count(*) FROM cinergie.`movie_professional`) as count_new,
(
  SELECT count(*)
  FROM `a7_cinergie_beta`.`link_film_personne`
  JOIN `a7_cinergie_beta`.`film` ON `link_film_personne`.film = film.id
  JOIN `a7_cinergie_beta`.`personne` ON `link_film_personne`.personne = `personne`.id
  JOIN `a7_cinergie_beta`.`categoriep` ON `link_film_personne`.categorie = `categoriep`.id
) as count_old;
