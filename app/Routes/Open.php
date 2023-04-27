<?php

$routes = [
  // legacy redirections
  ['GET', 'accueil', 'Home::home', 'home_legacy'],
  ['GET', 'actualites', 'Article::home', 'article_legacy'],


  // articles
  ['GET', 'articles', 'Article::home', 'articles'],
  ['GET', 'articles/[*:slug]', 'Article::article', 'article'],

  // author
  ['GET', 'auteurs', 'Author::home', 'authors'],
  ['GET', 'auteurs/[*:slug]', 'Author::author', 'author'],

  // contests
  ['GET', 'concours', 'Contest::home', 'contests'],
  ['GET', 'concours/[*:slug]', 'Contest::contest', 'contest'],

  // events
  ['GET', 'agenda', 'Event::home', 'agenda'],
  ['GET', 'agenda/mois-[i:year][i:month]', 'Event::home', 'agenda_month'],

  // Glaneuses
  ['GET', 'podcast', 'Glaneuses::home', 'glaneuses'],
  ['GET', 'podcast/play/index.php?s=S[a:season]R[a:episode]', 'Glaneuses::episode', 'glaneuses_episode_legacy'],
  ['GET', 'podcast/play/S[a:season]/R[a:episode]', 'Glaneuses::episode', 'glaneuses_episode'],

  // movies
  ['GET', 'film', 'Movie::home', 'movies'],
  ['GET', 'film/recherche/[*:params]', 'Movie::search', 'movie_search'],
  ['GET', 'film/sortie-[i:year]/[i:page]?', 'Movie::movie', 'movie_by_year'],
  ['GET', 'film/sortie-annees-[i:year]/[i:page]?', 'Movie::movie', 'movie_by_years'],
  ['GET', 'film/sortie-avant-[i:year]/[i:page]?', 'Movie::movie', 'movie_before_year'],
  ['GET', 'film/[*:slug]', 'Movie::movie', 'movie'],

  // organisations
  ['GET', 'organisation', 'Organisation::home', 'organisations'],
  ['GET|POST', 'organisation/ajout', 'Organisation::add', 'organisation_add'],
  ['GET|POST', 'organisation/modifier/[*:slug]', 'Organisation::edit', 'organisation_edit'],
  ['GET', 'organisation/activite/[*:praxis]', 'Organisation::search', 'organisation_by_praxis'],
  ['GET', 'organisation/recherche/[*:params]', 'Organisation::search', 'organisation_search'],
  ['GET', 'organisation/[*:slug]', 'Organisation::organisation', 'organisation'],

  // pages
  ['GET', 'a-propos/notre-histoire', 'Page::history', 'history'],
  ['GET', 'a-propos/prix-cinergie', 'Page::price', 'price'],
  ['GET', 'a-propos/contact', 'Page::contact', 'contact'],
  ['GET', 'mentions-legales', 'Page::legal', 'legal'],

  // partners
  ['GET', 'partenaires', 'Partner::home', 'partners'],

  // professional
  ['GET', 'personne', 'Professional::home', 'professionals'],
  ['GET|POST', 'personne/ajout', 'Professional::add', 'professional_add'],
  ['GET|POST', 'personne/modifier/[*:slug]', 'Professional::edit', 'professional_edit'],
  ['GET', 'personne/metier/[*:praxis]', 'Professional::search', 'professional_by_praxis'],
  ['GET', 'personne/recherche/[*:params]', 'Professional::search', 'professional_search'],
  ['GET', 'personne/[*:slug]', 'Professional::professional', 'professional'],

  // shop
  ['GET', 'boutique', 'Shop::home', 'shop'],
  ['GET|POST', 'boutique/commander', 'Shop::order', 'shop_order'],

  // works
  ['GET', 'annonces', 'Work::home', 'works'],
  ['GET', 'annonces/categorie/[*:category]', 'Work::search', 'work_by_category'],
  ['GET', 'annonces/recherche/[*:params]', 'Work::search', 'work_search'],
  ['GET', 'annonces/[*:slug]', 'Work::work', 'work'],

  // search engine
  ['GET', 'recherche/[*:params]?', 'Search::search', 'search'],


];

array_walk($routes, function(&$v, $k){
  $v[2] = 'Open\\'.$v[2];
});

return $routes;
