<?php

$routes = [
  // legacy redirections
  ['GET', 'accueil', 'Home::home', 'legacy_home'],
  ['GET', 'actualites', 'Article::home', 'legacy_article'],
  ['GET', 'images/actualite/[*:path]', 'Image::legacy', 'legacy_image_actualite'],
  ['GET', 'images/[*:path]', 'Image::legacy', 'legacy_image_path'],
  
  // articles
  ['GET', 'articles/[*:params]?', 'Article::articles', 'articles'],
  ['GET', 'article/[*:slug]', 'Article::article', 'article'],

  // author
  ['GET', 'auteurs', 'Author::authors', 'authors'],
  ['GET', 'auteur/[*:slug]', 'Author::author', 'author'],

  // contests
  ['GET', 'concours', 'Contest::contests', 'contests'],
  ['GET', 'concours/[*:slug]', 'Contest::contest', 'contest'],

  // events
  ['GET', 'agenda', 'Event::events', 'events'],
  ['GET', 'agenda/[i:year]/[i:month]', 'Event::events', 'events_month'],

  // Glaneuses
  ['GET', 'podcast', 'Glaneuses::home', 'glaneuses'],
  ['GET', 'podcast/play/index.php?s=S[a:season]R[a:episode]', 'Glaneuses::episode', 'glaneuses_episode_legacy'],
  ['GET', 'podcast/play/S[a:season]/R[a:episode]', 'Glaneuses::episode', 'glaneuses_episode'],

  // movies
  ['GET', 'films/[*:params]?', 'Movie::movies', 'movies'],
  ['GET', 'film/sortie-[i:year]/[i:page]?', 'Movie::movie', 'movie_by_year'],
  ['GET', 'film/sortie-annees-[i:year]/[i:page]?', 'Movie::movie', 'movie_by_years'],
  ['GET', 'film/sortie-avant-[i:year]/[i:page]?', 'Movie::movie', 'movie_before_year'],
  ['GET', 'film/[*:slug]', 'Movie::movie', 'movie'],

  // professional
  ['GET', 'personne/metier/[*:praxis]', 'Professional::search', 'professional_by_praxis'],
  ['GET', 'personnes/[*:params]?', 'Professional::professionals', 'professionals'],
  ['GET', 'personne/[*:slug]', 'Professional::professional', 'professional'],

  // organisations
  ['GET', 'organisations/[*:params]?', 'Organisation::organisations', 'organisations'],
  ['GET', 'organisation/[*:slug]', 'Organisation::organisation', 'organisation'],

  // pages
  
  ['GET', 'a-propos/notre-histoire', 'Page::history', 'history'],
  ['GET', 'a-propos/prix-cinergie', 'Page::price', 'price'],
  ['GET', 'a-propos/l-equipe', 'Page::team', 'team'],
  ['GET', 'a-propos/contact', 'Page::contact', 'contact'],
  ['GET', 'mentions-legales', 'Page::legal', 'legal'],


  // shop
  ['GET', 'boutique', 'Shop::shop', 'shop'],
  
  // jobs
  ['GET', 'annonces', 'Job::jobs', 'jobs'],
  ['GET', 'annonces/categorie/[*:category]', 'Job::search', 'job_by_category'],
  ['GET', 'annonces/recherche/[*:params]', 'Job::search', 'job_search'],
  ['GET', 'annonce/[*:slug]', 'Job::job', 'job'],

  // search engine
  ['GET', 'recherche/[*:params]?', 'Search::search', 'search'],


  // submissions
  ['POST', 'soumettre', 'Submission::submit', 'submission_submit'],

];

array_walk($routes, function(&$v, $k){
  $v[2] = 'Open\\'.$v[2];
});

return $routes;
