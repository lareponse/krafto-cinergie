<?php $this->layout('Secret::view') ?>

<?= $this->insert('Secret::_partials/tab/pampoi-nav', ['currentSection' => 'professionals'])?>

<div class="tab-content pt-6" id="viewPageContent">
    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <?php $this->insert('Secret::Professional/view/tab-profile') ?>
    </div>
    <div class="tab-pane fade" id="declic" role="tabpanel" aria-labelledby="declic-tab">
        <?php $this->insert('Secret::Professional/view/tab-declic') ?>
    </div>

    <div class="tab-pane fade" id="articles" role="tabpanel" aria-labelledby="articles-tab">
        <?php $this->insert('Secret::Article/list', ['listing' => $articles]) ?>
    </div>

    <div class="tab-pane fade" id="movies" role="tabpanel" aria-labelledby="movies-tab">
        <?php $this->insert('Secret::_partials/otto/otto-link-with-praxis', [
            'cards' => $movies,
            'className' => 'Movie',
            'parent' => 'professional',
            'child' => 'movie',
            'fields' => ['label']
        ]) ?>
    </div>

    <div class="tab-pane fade" id="organisations" role="tabpanel" aria-labelledby="organisations-tab">
        <?php $this->insert('Secret::_partials/otto/otto-link', [
            'cards' => $organisations, 
            'className' => 'Organisation', 
            'parent' => 'professional',
            'child' => 'organisation',
            'fields' => ['label']
        ]) ?>
    </div>
    
    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
        <?php $this->insert('Secret::_partials/tab-images', ['images' => $images]) ?>
    </div>
</div>
