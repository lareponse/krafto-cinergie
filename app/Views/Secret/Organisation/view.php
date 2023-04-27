<?php $this->layout('Secret::view') ?>

<?= $this->insert('Secret::_partials/tab/pampoi-nav', ['currentSection' => 'organisations'])?>

<div class="tab-content pt-6" id="viewPageContent">
    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <?php $this->insert('Secret::Organisation/view/tab-profile') ?>
    </div>

    <div class="tab-pane fade" id="articles" role="tabpanel" aria-labelledby="articles-tab">
        <?php $this->insert('Secret::Article/list', ['listing' => $articles]) ?>
    </div>

    <div class="tab-pane fade" id="movies" role="tabpanel" aria-labelledby="movies-tab">
        <?php $this->insert('Secret::_partials/otto/otto-link', [
            'cards' => $movies,
            'className' => 'Movie',
            'parent' => 'organisation',
            'child' => 'movie',
            'fields' => ['label']
        ]) ?>
    </div>

    <div class="tab-pane fade" id="professionals" role="tabpanel" aria-labelledby="professionals-tab">
        <?php $this->insert('Secret::_partials/otto/otto-link', [
            'cards' => $professionals,
            'className' => 'Professional',
            'parent' => 'organisation',
            'child' => 'professional',

            'fields' => ['firstname', 'lastname']
        ]) ?>
    </div>
        
    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
        <?php $this->insert('Secret::_partials/tab-images', ['images' => $images]) ?>
    </div>
</div>
