<?php
header("Access-Control-Allow-Origin: https://cinergie.lareponse.be");
$data = require_once('S01.php');


if (!isset($_GET['s']) || !isset($data[$_GET['s']]))
header('Location: ../');

$url_data = [];
preg_match('/^S([0-9]+)E([0-9]+)$/', $_GET['s'], $url_data);

list($show, $season, $episode) = $url_data;

$show_data = $data[$_GET['s']];

$related_default_links = [
  'personne' => 'https://www.cinergie.be/personne',
  'film' => 'https://www.cinergie.be/film'
];

$related_labels = [
  'personne' => 'Répertoire',
  'film' => 'Filmothèque'
];


require_once('skeleton.php');
