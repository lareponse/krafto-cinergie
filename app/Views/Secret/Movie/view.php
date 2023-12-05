<?php 

$relations = [
    'Article' => 'movie-hasAndBelongsToMany-article',
    'Professional' => ['relation' => 'movie-hasAndBelongsToManyQualified-professional', 'context' => 'professional_praxis'],
    'Organisation' => ['relation' => 'movie-hasAndBelongsToManyQualified-organisation', 'context' => 'organisation_praxis'],
    'Merchandise' => 'movie-hasAndBelongsToMany-merchandise'
];

$this->layout('Secret::view', ['relations' => $relations]);

?>
