-- STRUCTURE
DROP TABLE IF EXISTS `cinergie`.`page`;

CREATE TABLE `page` (
  `id` int NOT NULL,

  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(222) DEFAULT NULL,

  `label` varchar(255) DEFAULT NULL COMMENT 'leg:field01',
  `content` text COMMENT 'leg:field03',

  `abstract` text COMMENT 'leg:field02',

  `legacy_id` varchar(40) DEFAULT NULL,
  `legacy_title` varchar(190) DEFAULT NULL,
  `legacy_user` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- PRIMARY
ALTER TABLE `page` ADD PRIMARY KEY (`id`);
ALTER TABLE `page` MODIFY `id` int NOT NULL AUTO_INCREMENT;

-- INDEX
ALTER TABLE `page` ADD UNIQUE `page-slug-unique` (`slug`);

-- DATA
TRUNCATE `cinergie`.`page`;

-- notre histoire
INSERT INTO `cinergie`.`page` (
  `created_on`,
  `active`,
  `slug`,

  `label`,
  `content`,

  `abstract`,

  `legacy_id`,
  `legacy_title`,
  `legacy_user`
)
SELECT
  STR_TO_DATE(`datestamp`,'%Y-%m-%d %H:%i:%s') as `created_on`,
  `active` as `active`,
  `urlparms` as `slug`,

  `field01` as `label`,
  `field03` as `content`,

  `field02` as `abstract`,

  `id` as `legacy_id`,
  `title` as `legacy_title`,
  `user` as `legacy_user`

FROM `a7_cinergie_beta`.`content_item`
WHERE `area` = 'contact' AND `category` = 'page'
AND `id` = 'contact_page_002';

-- legal info
INSERT INTO `cinergie`.`page` (
  `created_on`,
  `active`,
  `slug`,

  `label`,
  `content`,

  `legacy_id`,
  `legacy_title`,
  `legacy_user`
)
SELECT
  STR_TO_DATE(`datestamp`,'%Y-%m-%d %H:%i:%s') as `created_on`,
  `active` as `active`,
  `urlparms` as `slug`,

  `field01` as `label`,
  `field02` as `content`,

  `id` as `legacy_id`,
  `title` as `legacy_title`,
  `user` as `legacy_user`

FROM `a7_cinergie_beta`.`content_item`
WHERE `category` = 'texte'
AND `id` IN ('legal_texte_001', 'erreur404_texte_001');




INSERT INTO `page` (`id`, `created_on`, `active`, `slug`, `label`, `content`, `abstract`, `legacy_id`, `legacy_title`, `legacy_user`) VALUES (NULL, CURRENT_TIMESTAMP, '1', 'l-equipe', 'L\'équipe', 'Depuis 1996, mois après mois, ils prennent soin de Cinergie.be ! Retrouvez ici le portrait de celles et ceux sans qui vous n\'auriez plus rien de consistant à lire sur le cinéma belge !!', NULL, NULL, NULL, NULL);

INSERT INTO `page` (`id`, `created_on`, `active`, `slug`, `label`, `content`, `abstract`, `legacy_id`, `legacy_title`, `legacy_user`) VALUES (NULL, CURRENT_TIMESTAMP, '1', 'contact', 'Contactez-nous', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `page` (`id`, `created_on`, `active`, `slug`, `label`, `content`, `abstract`, `legacy_id`, `legacy_title`, `legacy_user`) VALUES (NULL, CURRENT_TIMESTAMP, '1', 'authors', 'Nos auteurs', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `page` (`id`, `created_on`, `active`, `slug`, `label`, `content`, `abstract`, `legacy_id`, `legacy_title`, `legacy_user`) VALUES (NULL, CURRENT_TIMESTAMP, '1', 'price', 'Le prix Cinergie', '<h2>Graine de cinéaste 2023</h2>\r\n<p><strong>Newcomers</strong> de Camille Ghequiere</p>\r\n<p><a href=\"https://www.cinergie.be/actualites/newcomers-de-camille-ghekiere\" target=\"_blank\" rel=\"noopener noreferrer\">Critique</a> &amp; Rencontre filmée</p>\r\n\r\n<h2>Millenium 2023 -&nbsp;Prix des Jeunes talents belges</h2>\r\n<p style=\"text-align: left;\"><strong>Journal d’une solitude sexuelle</strong> de Nina Alexandraki</p>\r\n<p style=\"text-align: left;\"><a href=\"https://www.cinergie.be/actualites/a-diary-of-sexual-solitude-de-nina-alexandraki\" target=\"_blank\" rel=\"noopener noreferrer\">Critique</a> &amp; <a href=\"https://www.cinergie.be/actualites/rencontre-avec-nina-alexandraki-journal-d-une-solitude-sexuelle\" target=\"_blank\" rel=\"noopener noreferrer\">Rencontre filmée</a></p>\r\n\r\n<h2>Anima 2023</h2>\r\n<p><strong>Les Marrons glacés</strong> de Delphine Hermans et Michel Vandam</p>\r\n<p><a href=\"https://www.cinergie.be/actualites/les-marrons-glaces-de-delphine-hermans-et-michel-vandam\" target=\"_blank\" rel=\"noopener noreferrer\">Critique</a> &amp; <a href=\"https://www.cinergie.be/actualites/delphine-hermans-co-realisatrice-des-marrons-glaces\" target=\"_blank\" rel=\"noopener noreferrer\">Rencontre filmée</a></p>\r\n<h2>Millenium 2022 -&nbsp;Prix des Jeunes talents belges</h2>\r\n<p><strong>Le Constat de la crevette grise&nbsp;</strong>de&nbsp;Rémi Murez</p>\r\n<p><a href=\"https://www.cinergie.be/actualites/le-constat-de-la-crevette-grise\" target=\"_blank\" rel=\"noopener noreferrer\">Critique</a>&nbsp;</p>\r\n\r\n<h2>Anima 2022</h2>\r\n<p><strong>Balaclava</strong> de Youri Orekhoff</p>\r\n<p><a href=\"https://beta.cinergie.be/actualites/youri-orekhoff\" target=\"_blank\" rel=\"noopener noreferrer\">Entretien avec le réalisateur</a> - <a href=\"https://beta.cinergie.be/actualites/balaclava-de-youri-orekhoff\" target=\"_blank\" rel=\"noopener noreferrer\">Critique</a>&nbsp;&nbsp;</p>\r\n<h2>En Ville! 2022</h2>\r\n<p><strong>By the Throat</strong> de Effi et Amir</p>\r\n<p><a href=\"https://www.cinergie.be/actualites/by-the-throat-d-effi-et-amir\" target=\"_blank\" rel=\"noopener noreferrer\">Critique </a>&amp; <a href=\"https://www.cinergie.be/actualites/by-the-throat-d-effi-et-amir-20211124162947\" target=\"_blank\" rel=\"noopener noreferrer\">Rencontre filmée</a></p>\r\n<p>&nbsp;</p>\r\n<h2>Millenium 2021 -&nbsp;Prix du Jeune espoir</h2>\r\n<p><strong>Que no me roben los suenos</strong> de&nbsp;Zoé Brichau</p>\r\n<p><a href=\"https://www.cinergie.be/actualites/que-no-me-roben-los-suenos-de-zoe-brichau\" target=\"_blank\" rel=\"noopener noreferrer\">Critique&nbsp; </a>&amp;&nbsp; <a href=\"https://www.cinergie.be/actualites/zoe-brichau-realisatrice-de-que-no-me-roben-los-suenos\" target=\"_blank\" rel=\"noopener noreferrer\">Rencontre filmée</a></p>\r\n<p>&nbsp;</p>\r\n<h2>Anima 2021</h2>\r\n<p><strong>Monachopsis</strong> de Liesbet van Loon</p>\r\n<p><a href=\"https://www.cinergie.be/actualites/monachopsis-de-liesbet-van-loon\" target=\"_blank\" rel=\"noopener noreferrer\">Critique&nbsp; </a>&amp;&nbsp; <a href=\"https://www.cinergie.be/actualites/liesbet-van-loon-realisatrice-de-monachopsis\" target=\"_blank\" rel=\"noopener noreferrer\">Rencontre filmée</a></p>\r\n<p>&nbsp;</p>\r\n<h2>Millenium 2020 - Prix du Jeune espoir</h2>\r\n<p><strong>La Musique de Soline&nbsp;</strong>d\'Aurélie Maestre Vicario</p>\r\n<p><a href=\"https://www.cinergie.be/actualites/la-musique-de-soline-d-aurelie-maestre-vicario\" target=\"_blank\" rel=\"noopener noreferrer\">Critique</a> &amp;&nbsp;<a href=\"https://www.cinergie.be/actualites/rencontre-avec-aurelie-maestre-vicario-pour-la-musique-de-soline\" target=\"_blank\" rel=\"noopener noreferrer\">&nbsp;Rencontre filmée</a></p>\r\n<p>&nbsp;</p>\r\n<h2>Anima 2020</h2>\r\n<p><strong>Tête de Linotte</strong> de Gaspar Chabaud</p>\r\n<p><a href=\"https://www.cinergie.be/actualites/tete-de-linotte-de-gaspar-chabaud\" target=\"_blank\" rel=\"noopener noreferrer\">Critique</a> &amp;<a href=\"https://www.cinergie.be/actualites/rencontre-avec-gaspar-chabaud-pour-tete-de-linotte\" target=\"_blank\" rel=\"noopener noreferrer\"> Rencontre filmée</a></p>\r\n<p>&nbsp;</p>\r\n<h2>Millenium 2019 - Prix du Jeune espoir</h2>\r\n<p><strong>Le Veilleur</strong> de Lou du Pontavice</p>\r\n<p><a href=\"https://www.cinergie.be/actualites/rencontre-avec-lou-du-pontavice-le-veilleur\" target=\"_blank\" rel=\"noopener noreferrer\">La Rencontre filmée</a>&nbsp;</p>\r\n<p><a href=\"https://www.cinergie.be/actualites/le-veilleur\" target=\"_blank\" rel=\"noopener noreferrer\">la critique&nbsp;</a></p>\r\n<h2>Anima 2019</h2>\r\n<p><strong>Robo</strong> de Léo Becker</p>\r\n<p><a href=\"https://www.cinergie.be/actualites/robo-de-leo-becker\" target=\"_blank\" rel=\"noopener noreferrer\">La critique</a></p>\r\n<p>&nbsp;</p>\r\n<h2>Anima 2018</h2>\r\n<p><strong>Simbiosis Carnal</strong> de Rocio Alvarez</p>\r\n<p><a href=\"https://www.cinergie.be/actualites/entretien-roc-o-alvarez-pour-simbiosis-carnal\" target=\"_blank\" rel=\"noopener noreferrer\">La rencontre filmée</a></p>\r\n<p><a href=\"https://www.cinergie.be/actualites/simbiosis-carnal-de-roc-o-alvarez\" target=\"_blank\" rel=\"noopener noreferrer\">la critique</a>&nbsp;</p>\r\n<h2>Filmer à Tout Prix 2017</h2>\r\n<p><strong>Angelika</strong> de Léopold Legrand</p>\r\n<p><a href=\"https://www.cinergie.be/actualites/rencontre-avec-leopold-legrand-pour-la-sortie-d-angelika\" target=\"_blank\" rel=\"noopener noreferrer\">La rencontre filmée</a></p>\r\n<p><a href=\"https://www.cinergie.be/actualites/angelika\" target=\"_blank\" rel=\"noopener noreferrer\">la critique&nbsp;</a></p>\r\n<h2>Festival du Film d\'Amour de Mons 2017</h2>\r\n<p><strong>Tout Moka</strong> de Christine Grulois</p>\r\n<p><a href=\"/webzine/christine_grulois_laureate_du_prix_de_la_critique_2017_au_festival_du_film_d_amour_de_mons_pour_son_court_metrage_tout_moka\" target=\"_blank\" rel=\"noopener noreferrer\">La rencontre filmée</a></p>\r\n<p>&nbsp;</p>\r\n<h2>Anima 2017</h2>\r\n<p><strong>69 sec.</strong> de Laura Nicolas</p>\r\n<p><a href=\"/webzine/festival_anima_le_prix_cinergie_2017_une_rencontre_avec_laura_nicolas_en_un_peu_plus_de_69_secondes\" target=\"_blank\" rel=\"noopener noreferrer\">La rencontre filmée</a></p>\r\n<p>&nbsp;</p>\r\n<h2>Festival du film d\'Amour de Mons 2016</h2>\r\n<p><strong>Nelson</strong> de Juliette Klinke et Thomas Xhignesse&nbsp;</p>\r\n<p><a href=\"/webzine/rencontre_avec_juliette_klinke_et_thomas_xhignesse\" target=\"_blank\" rel=\"noopener noreferrer\">La rencontre filmée</a> - <a href=\"/webzine/nelson_de_juliette_klinke_et_thomas_xhignesse\" target=\"_blank\" rel=\"noopener noreferrer\">La critique</a></p>\r\n<p>&nbsp;</p>\r\n<h2>Anima 2016</h2>\r\n<p><strong>Toutes nuancées</strong> de Chloé Alliez</p>\r\n<p><a href=\"/webzine/rencontre_avec_chloe_alliez_toutes_nuancees\">La rencontre filmée</a> -&nbsp;<a href=\"/webzine/toutes_nuancees_de_chloe_alliez\">La critique</a></p>\r\n<p>&nbsp;</p>\r\n<h2>Anima 2015</h2>\r\n<p><strong>Deep Space</strong> de Bruno Tondeur</p>\r\n<p><a href=\"/webzine/rencontre_avec_bruno_tondeur\">La rencontre filmée</a> -&nbsp;<a href=\"/webzine/deep_space_de_bruno_tondeur\">La critique</a></p>\r\n<p>&nbsp;</p>\r\n<h2>Anima 2014</h2>\r\n<p><strong>Rêves de brume</strong> de Sophie Racine</p>\r\n<p><a href=\"/webzine/reves_de_brume__sophie_racine\" target=\"_blank\" rel=\"noopener noreferrer\">La vidéo</a> - <a href=\"/webzine/sophie_racine_prix_cinergie_anima\" target=\"_blank\" rel=\"noopener noreferrer\">L\'entretien</a> -&nbsp;<a href=\"/webzine/reves_de_brume_de_sophie_racine\" target=\"_blank\" rel=\"noopener noreferrer\">La critique</a></p>\r\n<p>&nbsp;</p>\r\n<h2>Anima 2013</h2>\r\n<p><strong>Oh Willy d\'Emma</strong> De Swaef et Marc Roels<br><a href=\"/webzine/oh_willy_d_emma_de_swaef_et_marc_roels\">La critique</a>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<h2>Anima 2012</h2>\r\n<p style=\"margin-bottom: 0cm;\"><strong>Dans le cochon tout est bon </strong>de<strong> <span style=\"font-weight: normal;\">Iris Alexandre<br><a href=\"/webzine/iris_alexandre_tout_est_bon_dans_le_cochon\">La vidéo</a>&nbsp;- <a href=\"/webzine/dans_le_cochon_tout_est_bon_d_iris_alexandre_2012_06_05_155955\">L\'entretien</a> - <a href=\"/webzine/dans_le_cochon_tout_est_bon_d_iris_alexandre\">La critique</a> &nbsp;</span></strong></p>\r\n<p style=\"margin-bottom: 0cm;\">&nbsp;</p>\r\n<h2>Anima 2011</h2>\r\n<p><strong>Les Arbres naissent sous terre</strong> de Manon et Sarah Brûlé<br><a href=\"/webzine/sarah_et_manon_brule_les_arbres_naissent_sous_terre\">La vidéo</a> - <a href=\"/webzine/manon_et_sarah_brule_les_arbres_naissent_sous_terre\">L\'entretien</a> - <a href=\"/webzine/les_arbres_naissent_sous_terre_de_manon_et_sarah_brule\">La critique</a></p>\r\n<p>&nbsp;</p>\r\n<h2>Anima 2010</h2>\r\n<p><strong>Ruis</strong> de Marike Verbiest<br>Voir <a href=\"/webzine/ruis_de_marike_verbiest_2010_05_18\">l\'entrevue filmée</a> - Lire <a href=\"/webzine/entretien_avec_marike_verbiest_a_propos_de_ruis\">l\'entretien</a> - Lire <a href=\"/webzine/ruis_de_marike_verbiest_2010_05_07\">la critique</a></p>\r\n<p><strong>Grise Mine</strong> de Rémi Vandenitte<br>Voir <a href=\"/webzine/remi_vandenitte_grise_mine\">l\'entrevue filmée</a> - Lire <a href=\"/webzine/remi_vandenitte_a_propos_de_grise_mine\">l\'entretien</a> - Lire <a href=\"/webzine/grise_mine_de_remi_vandenitte_2010_05_11\">la critique</a></p>\r\n<p>&nbsp;</p>\r\n<h2>Anima 2009</h2>\r\n<p><strong>Paola poule pondeuse</strong> sous la direction de Louise-Marie Colon</p>\r\n<p>Lire <a href=\"https://www.cinergie.be/actualites/louise-marie-colon-a-propos-de-paola-la-poule-pondeuse\" target=\"_blank\" rel=\"noopener noreferrer\">l\'entretien avec le réalisateur</a> - Lire <a href=\"https://www.cinergie.be/actualites/paola-poule-pondeuse-de-louise-marie-colon\" target=\"_blank\" rel=\"noopener noreferrer\">la critique</a>&nbsp;</p>\r\n<p><br><strong>Jazzed</strong> d\'Anton Setola<br>Voir <a href=\"/webzine/jazzed_d_anton_setola\">l\'entrevue filmée</a> - <a href=\"/webzine/anton_setola_realisateur_de_jazzed\">Lire l\'entretien</a>&nbsp;</p>\r\n<h2>Anima 2008</h2>\r\n<p><strong>Le Voyageur</strong> de Johan Pollefoort<br>Lire <a href=\"https://www.cinergie.be/actualites/johan-pollefoort-realisateur-du-voyageur\" target=\"_blank\" rel=\"noopener noreferrer\">l\'entretien avec le réalisateur</a> - Lire <a href=\"https://www.cinergie.be/actualites/le-voyageur-de-johan-pollefort\" target=\"_blank\" rel=\"noopener noreferrer\">la critique</a></p>\r\n<h2>Anima 2007</h2>\r\n<p><strong>Death\'s Job</strong> de Johan Pollefoort</p>\r\n<p>Lire <a href=\"https://www.cinergie.be/actualites/johan-pollefoort\">l\'entretien avec le réalisateur</a> - Lire&nbsp;<a href=\"https://www.cinergie.be/actualites/death-s-job-de-johan-pollefoort\" target=\"_blank\" rel=\"noopener noreferrer\">la critique</a>&nbsp;</p>\r\n<h2>Anima 2006</h2>\r\n<p><strong>Le Môme fait mouche</strong> d\'Alain Sace&nbsp;</p>\r\n<p><a href=\"https://www.cinergie.be/actualites/la-mome-fait-mouche-d-alain-sace\" target=\"_blank\" rel=\"noopener noreferrer\">Lire la critique</a>&nbsp;</p>\r\n<h2>Anima 2005</h2>\r\n<p><strong>Home sweet Gnome</strong> de Marie-Laure Guisset</p>\r\n<p>Lire <a href=\"https://www.cinergie.be/actualites/marie-laure-guisset-a-propos-de-home-sweet-gnome\" target=\"_blank\" rel=\"noopener noreferrer\">l\'entretien avec le réalisateur</a> - <a href=\"https://www.cinergie.be/actualites/home-sweet-gnome-de-marie-laure-guisset\" target=\"_blank\" rel=\"noopener noreferrer\">Lire la critique</a>&nbsp;&nbsp;</p>\r\n<h2>Anima 2004</h2>\r\n<p><strong>Mr. J. Russel</strong> de Wouter Sel</p>\r\n<p>Lire <a href=\"https://www.cinergie.be/actualites/mr-j-russel-de-wouter-sel\" target=\"_blank\" rel=\"noopener noreferrer\">la critique</a>&nbsp;</p>\r\n<h2>Anima 2003</h2>\r\n<p><strong>Un monde pour Tom</strong> de l\'Atelier Caméra Enfants Admis</p>\r\n<p>Lire <a href=\"https://www.cinergie.be/actualites/un-monde-pour-tom-de-jean-luc-slock-2003-04-01\" target=\"_blank\" rel=\"noopener noreferrer\">la critique</a>&nbsp;</p>\r\n<h2>Anima 2002</h2>\r\n<p><strong>Il ne faut pas vendre la peau de l\'ours...non, non, il ne faut pas</strong> d\'Alexis Vokaer</p>\r\n<p>Lire <a href=\"https://www.cinergie.be/actualites/entrevue-avec-alexis-vokaer\" target=\"_blank\" rel=\"noopener noreferrer\">l\'entretien avec le réalisateur</a>&nbsp;-&nbsp;Lire <a href=\"https://www.cinergie.be/actualites/il-ne-faut-pas-vendre-la-peau-de-l-ours-non-non-il-ne-faut-pas-d-alexis-vokaer\" target=\"_blank\" rel=\"noopener noreferrer\">la critique</a></p>\r\n<h2>Anima 2001</h2>\r\n<p><strong>Inasmuch</strong> de Wim Vandekeybus</p>\r\n<p>Lire <a href=\"https://www.cinergie.be/actualites/inasmuch-de-wim-vandekeybus\" target=\"_blank\" rel=\"noopener noreferrer\">la critique</a>&nbsp;</p>\r\n<p><strong>Barbe Bleue</strong> de L\'Atelier Zorobabel</p>\r\n<p>Lire <a href=\"https://www.cinergie.be/actualites/barbe-bleue-de-l-atelier-zorobabel\" target=\"_blank\" rel=\"noopener noreferrer\">la critique</a>&nbsp;</p>\r\n<h2>Anima 2000</h2>\r\n<p><strong>Walking on the Wild Side</strong> de Fiona Gordon et Dominique Abel</p>\r\n<p>Lire <a href=\"https://www.cinergie.be/actualites/walking-on-the-wild-side-d-abel-et-gordon\" target=\"_blank\" rel=\"noopener noreferrer\">la critique</a></p>\r\n<h2>Anima 1999</h2>\r\n<p><strong>Pic&nbsp;<strong>Pic André Shoow, Quatre moins un</strong> de Vincent Patar et Stéphane Aubier</strong></p>\r\n<p>&nbsp;</p>\r\n<h2>Festival International du film de Bruxelles</h2>\r\n<p><strong>Mort à Vignole </strong>d\'Olivier Smolders&nbsp;</p>\r\n<p>Lire <a href=\"https://www.cinergie.be/actualites/mort-a-vignole-d-olivier-smolders\" target=\"_blank\" rel=\"noopener noreferrer\">l\'entretien avec le réalisateur</a>&nbsp;- <a href=\"https://www.cinergie.be/actualites/mort-a-vignole\" target=\"_blank\" rel=\"noopener noreferrer\">le tournage</a>&nbsp;</p>\r\n<p><strong>21 études à danser</strong> de Thierry De Mey</p>\r\n<p>Lire <a href=\"https://www.cinergie.be/actualites/21-etudes-a-danser-de-thierry-de-mey\" target=\"_blank\" rel=\"noopener noreferrer\">la critique</a>&nbsp;</p>\r\n<h2>Media 10/10 1999</h2>\r\n<p><strong>Rachid et Martha</strong> de Mathias Gokalp</p>\r\n<p>Lire <a href=\"https://www.cinergie.be/actualites/mathias-gokalp-professeur-a-l-insas-2012-06-07-115252\" target=\"_blank\" rel=\"noopener noreferrer\">l\'entretien avec le réalisateur</a> - Lire <a href=\"https://www.cinergie.be/actualites/rachid-et-martha-de-mathias-gokalp\" target=\"_blank\" rel=\"noopener noreferrer\">la critique</a></p>\r\n', '<p>Chaque année, lors du festival \"Anima\", Cinergie sélectionne un lauréat pour le \"Prix Cinergie\" récompensant une oeuvre d\'animation.</p>\r\n<p>Depuis 2019, les rédacteurs donnent leur Prix à un court métrage documentaire étudiant du Festival Millenium.</p>\r\n<p>Depuis 2023, les rédacteur.rice.s donnent un Prix à une Graine de cinéastes - Festival Elles tournent-Dames Draaien</p>\r\n<p>L\'équipe de journalistes octroie et a octroyé également son Prix lors d\'autres festivals anciens ou toujours d\'actualité.</p>', NULL, NULL, NULL);



UPDATE `page` SET `label`= 'Mentions légales et Copyright', `content` = '  <h3>Editeur</h3>\r\n\r\n        <p>Maison de la Francité<br>\r\n        19F, avenue des Arts<br>\r\n        1000 Bruxelles</p>\r\n\r\n        <p>Tél. : <a href=\"tel:+3222190484\">+32.2.219.04.84</a></p> \r\n\r\n        <h3>Création et Hébergement</h3>\r\n\r\n        <p><a href="https://lareponse.be" title="La Réponse">La Réponse</a></p>\r\n\r\n        <p>Rue Verboeckhaven 64<br>\r\n1210 Saint-Josse-ten-Noode<br>\r\n        Belgique</p>\r\n\r\n        <h3>Directrice de la publication</h3>\r\n\r\n        <p>Dimitra Bouras</p>\r\n\r\n        <h3>Données personnelles</h3>\r\n\r\n        <p>Les données personnelles collectées sont uniquement destinées à un usage interne. En aucun cas ces données ne seront cédées ou vendues à des tiers.</p>\r\n\r\n        <h3>Cookies</h3>\r\n\r\n        <p>Les \"cookies\" sont des petits fichiers que l\'administrateur d\'un serveur installe sur votre ordinateur et qui permettent de mémoriser des données relatives à l\'internaute lorsque celui-ci se connecte au site. Nous utilisons le système des \"cookies\" uniquement afin de mémoriser des informations destinées à faciliter votre navigation. Il ne s\'agit en aucun cas de mémoriser des données personnelles vous concernant. Il vous est par ailleurs possible à tout moment de refuser l\'installation de ces \"cookies\" voire de les supprimer. Dans ce cas, nous veillons à ce que votre navigation n\'en soit nullement empêchée. La durée de vie des cookies utilisés est de 30 jours (langue du site) ou de 12 mois (fréquentation du site).</p>\r\n\r\n        <h3>Liens</h3>\r\n\r\n        <p>Les sites reliés directement ou indirectement au site Cinergie ne sont pas sous son contrôle. En conséquence, nous n\'assumons aucune responsabilité quant aux informations publiées sur ces sites. Les liens avec des sites extérieurs ne sont fournis qu\'à titre de commodité et n\'impliquent aucune caution quant à leur contenu.</p>\r\n\r\n        <h3>Contenu et outils</h3>\r\n\r\n        <p>Nous ne proposons aucune garantie quand à la fiabilité ou au fonctionnement de ce site. Nous ne pouvons en aucun cas être tenu pour responsable de tous dommages quels qu\'ils soient, y compris mais non de façon limitative, des dommages directs, indirects, accessoires ou incidents, des pertes de bénéfices ou de l\'interruption d\'activité, résultant de l\'utilisation ou de l\'impossibilité d\'utilisation de ce site.</p>\r\n' WHERE `page`.`id` = 3;