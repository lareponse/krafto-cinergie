UPDATE article 
SET content = REPLACE(content, '/images/actualite/webzine/film/', '/public/images/film/')
WHERE content LIKE '%/images/actualite/webzine/film/%';

UPDATE article 
SET content = REPLACE(content, '/images/webzine/film/', '/public/images/film/')
WHERE content LIKE '%/images/webzine/film/%';


UPDATE article 
SET content = REPLACE(content, '/images/actualite/film/', '/public/images/film/')
WHERE content LIKE '%/images/actualite/film/%';


UPDATE article 
SET content = REPLACE(content, 'src="/images/film/_', 'src="/public/images/film/_')
WHERE content LIKE '%src="/images/film/_%';


UPDATE article 
SET content = REPLACE(content, '/public/images/', '/images/')
WHERE content LIKE '%public/images/%';




UPDATE article
SET legacy_photo_illu = REPLACE(legacy_photo_illu, '/images/webzine/personne/', '/images/personne/')
WHERE legacy_photo_illu LIKE '%/images/webzine/personne/%';

UPDATE article
SET legacy_photo_illu = REPLACE(legacy_photo_illu, '/images/webzine/organisation/', '/images/organisation/')
WHERE legacy_photo_illu LIKE '%/images/webzine/organisation/%';

UPDATE article
SET legacy_photo_illu = REPLACE(legacy_photo_illu, '/images/webzine/film/', '/images/film/')
WHERE legacy_photo_illu LIKE '%/images/webzine/film/%';


UPDATE article
SET legacy_photo_illu = REPLACE(legacy_photo_illu, '/images/actualite/personne/', '/images/personne/')
WHERE legacy_photo_illu LIKE '%/images/actualite/personne/%';

UPDATE article
SET legacy_photo_illu = REPLACE(legacy_photo_illu, '/images/actualite/organisation/', '/images/organisation/')
WHERE legacy_photo_illu LIKE '%/images/actualite/organisation/%';

UPDATE article
SET legacy_photo_illu = REPLACE(legacy_photo_illu, '/images/actualite/film/', '/images/film/')
WHERE legacy_photo_illu LIKE '%/images/actualite/film/%';



