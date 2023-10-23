<?php 

$relations = [
    'Article' => 'movie-hasAndBelongsToMany-article',
    'Professional' => ['relation' => 'movie-hasAndBelongsToManyQualified-professional', 'data-filter-parent' => 'professional_praxis'],
    'Organisation' => ['relation' => 'movie-hasAndBelongsToManyQualified-organisation', 'data-filter-parent' => 'organisation_praxis'],
];

$this->layout('Secret::view', ['relations' => $relations]);

?>

<?php $this->unshift('scripts') ?>
    <script src="/public/assets/js/otto-thesaurus-label.js"></script>
<?php $this->end() ?>
