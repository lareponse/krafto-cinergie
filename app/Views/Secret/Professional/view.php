<?php 

$this->layout('Secret::view', ['relations' => [
        'professional-hasAndBelongsToMany-article' => 'Article',
        'professional-hasAndBelongsToMany-movie' => 'Movie',
        'professional-hasAndBelongsToMany-organisation' => 'Organisation'
    ]
]);

?>
<div class="tab-pane fade" id="declic" role="tabpanel" aria-labelledby="declic-tab">
<?php $this->insert('Secret::Professional/view/tab-declic') ?>
</div>