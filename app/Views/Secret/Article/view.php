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

    <div class="tab-pane fade <?= $activeTab === 'movies' ? $activeClasses : ''?>" id="movies" role="tabpanel" aria-labelledby="movies-tab">
        <?php $this->insert('Secret::_partials/otto/otto-link', [
            'parent' => $controller->loadModel(),
            'relation' => 'article-hasAndBelongsToMany-movie',

            'searchEntity' => 'App\Models\Movie',
            'searchFields' => ['label'],

            'children' => $movies,
            'childrenTemplate' => 'Secret::Movie/_partials/tab-card'
        ]) ?>
    </div>

    <div class="tab-pane fade <?= $activeTab === 'professionals' ? $activeClasses : ''?>" id="professionals" role="tabpanel" aria-labelledby="professionals-tab">
        <?php $this->insert('Secret::_partials/otto/otto-link', [
            'parent' => $controller->loadModel(),
            'relation' => 'article-hasAndBelongsToMany-professional',

            'searchEntity' => 'App\Models\Professional',
            'searchFields' => ['firstname', 'lastname'],
            
            'children' => $professionals,
            'childrenTemplate' => 'Secret::Professional/_partials/tab-card'

        ]) ?>
    </div>


    <div class="tab-pane fade <?= $activeTab === 'organisations' ? $activeClasses : ''?>" id="organisations" role="tabpanel" aria-labelledby="organisations-tab">
        <?php $this->insert('Secret::_partials/otto/otto-link', [
            'parent' => $controller->loadModel(),
            'relation' => 'article-hasAndBelongsToMany-organisation',

            'searchEntity' => 'App\Models\Organisation',
            'searchFields' => ['label'],

            'children' => $organisations, 
            'childrenTemplate' => 'Secret::Organisation/_partials/tab-card'
        ]) ?>
    </div>
        
    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
        <?php $this->insert('Secret::_partials/tab-images', ['images' => $images]) ?>
    </div>
</div>