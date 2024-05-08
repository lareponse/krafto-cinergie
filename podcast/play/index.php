<?php
header("Access-Control-Allow-Origin: https://cinergie.lareponse.be");
$data = require_once('S01.php');
$url_data = null;


if(!isset($_GET['s']) || !isset($data[$_GET['s']]) || preg_match('/^S([0-9]+)E([0-9]+)$/', $_GET['s'], $url_data) !== 1)
  header('Location: ../');

$show = $_GET['s'];

$show_data = $data[$show];

$season = $url_data[1];
$episode = $url_data[2];


$related_default_links = [
  'personne' => 'https://www.cinergie.be/personne',
  'film' => 'https://www.cinergie.be/film'
];

$related_labels = [
  'personne' => 'Répertoire',
  'film' => 'Filmothèque'
];




require_once('partial_head.html');
require_once('partial_body.php');

?>
