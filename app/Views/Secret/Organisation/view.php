<?php 

$relations = [
    'Article' => 'organisation-hasAndBelongsToMany-article',
    'Movie' => ['relation' => 'organisation-hasAndBelongsToManyQualified-movie', 'data-filter-parent' => 'organisation_praxis'],
    'Professional' => 'organisation-hasAndBelongsToMany-professional'
];

$this->layout('Secret::view', ['relations' => $relations]);

