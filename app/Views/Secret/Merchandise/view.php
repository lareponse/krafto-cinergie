<?php 

$relations = [
    'Movie' => 'merchandise-hasAndBelongsToMany-movie'
];

$this->layout('Secret::view', ['relations' => $relations]);

?>