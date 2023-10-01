<?php $this->layout('Secret::view') ?>

<?= $this->insert('Secret::_partials/tab/pampoi-nav', ['currentSection' => 'articles'])?>

<div class="tab-content pt-6" id="viewPageContent">

    <?php 
    $activeTab = $controller->router()->params('tab') ?? 'profile';
    $activeClasses = 'show active';
    ?>

    <div class="tab-pane fade <?= $activeTab === 'profile' ? $activeClasses : ''?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <?php $this->insert('Secret::Article/view/tab-profile') ?>
    </div>

    <div class="tab-pane fade <?= $activeTab === 'professionals' ? $activeClasses : ''?>" id="professionals" role="tabpanel" aria-labelledby="professionals-tab">
        <?php $this->insert('Secret::_partials/otto/otto-link', [
            'cards' => $professionals,
            'className' => 'Professional',
            'parent' => 'article',
            'child' => 'professional',

            'fields' => ['firstname', 'lastname']
        ]) ?>
    </div>

    <div class="tab-pane fade <?= $activeTab === 'movies' ? $activeClasses : ''?>" id="movies" role="tabpanel" aria-labelledby="movies-tab">
        <?php $this->insert('Secret::_partials/otto/otto-link', [
            'cards' => $movies,
            'className' => 'Movie',
            'parent' => 'article',
            'child' => 'movie',
            'fields' => ['label']
        ]) ?>
    </div>

    <div class="tab-pane fade <?= $activeTab === 'organisations' ? $activeClasses : ''?>" id="organisations" role="tabpanel" aria-labelledby="organisations-tab">
        <?php $this->insert('Secret::_partials/otto/otto-link', [
            'cards' => $organisations, 
            'className' => 'Organisation', 
            'parent' => 'article',
            'child' => 'organisation',
            'fields' => ['label']
        ]) ?>
    </div>
        
    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
        <?php $this->insert('Secret::_partials/tab-images', ['images' => $images]) ?>
    </div>
</div>