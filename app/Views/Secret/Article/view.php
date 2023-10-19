<?php 

$this->layout('Secret::view', ['relations' => [
        'article-hasAndBelongsToMany-movie' => 'Movie',
        'article-hasAndBelongsToMany-professional' => 'Professional',
        'article-hasAndBelongsToMany-organisation' => 'Organisation',
        'article-hasAndBelongsToMany-author' => 'Author',
    ]
]) ?>