<?php 

$relations = [
    'Article' => 'organisation-hasAndBelongsToMany-article',
    'Movie' => ['relation' => 'organisation-hasAndBelongsToManyQualified-movie', 'context' => 'organisation_praxis'],
    'Professional' => 'organisation-hasAndBelongsToMany-professional'
];

$this->layout('Secret::view', ['relations' => $relations]);

