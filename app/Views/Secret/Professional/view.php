<?php 

$relations = [
    'Article' => 'professional-hasAndBelongsToMany-article',
    'Movie' => ['relation' => 'professional-hasAndBelongsToManyQualified-movie', 'data-filter-parent' => 'professional_praxis'],
    'Organisation' => 'professional-hasAndBelongsToMany-organisation'
];

$this->layout('Secret::view', ['relations' => $relations]);

?>
<div class="tab-pane fade" id="declic" role="tabpanel" aria-labelledby="declic-tab">
<?php $this->insert('Secret::Professional/view/tab-declic') ?>
</div>