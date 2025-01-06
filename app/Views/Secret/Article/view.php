<?php 

$relations = [
    'Movie' => 'article-hasAndBelongsToMany-movie',
    'Professional' => 'article-hasAndBelongsToMany-professional',
    'Organisation' => 'article-hasAndBelongsToMany-organisation',
    'Author' => 'article-hasAndBelongsToMany-author'
];

$this->layout('Secret::view', ['relations' => $relations]);

?>