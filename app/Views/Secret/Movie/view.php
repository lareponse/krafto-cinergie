<?php $this->layout('Secret::view', ['relations' => [
        'movie-hasAndBelongsToMany-article' => 'Article',
        'movie-hasAndBelongsToManyQualified-professional' => 'Professional',
        'movie-hasAndBelongsToManyQualified-organisation-withQualifier-tag' => 'Organisation'
    ]
]); ?>

<?php $this->unshift('scripts') ?>
    <script src="/public/assets/js/otto-thesaurus-label.js"></script>
<?php $this->end() ?>

<?php

/*
<div class="tab-content pt-6" id="viewPageContent">
<?php 
    $activeTab = $controller->router()->params('tab') ?? 'profile';
    $activeClasses = 'show active';
?>

    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <?php $this->insert('Secret::Movie/view/tab-profile') ?>
    </div>

    <div class="tab-pane fade" id="articles" role="tabpanel" aria-labelledby="articles-tab">
        <?php //$this->insert('Secret::Article/list', ['listing' => $articles]) ?>
    </div>

    <div class="tab-pane fade <?= $activeTab === 'organisations' ? $activeClasses : ''?>" id="organisations" role="tabpanel" aria-labelledby="organisations-tab">
        <?php $this->insert('Secret::_partials/otto/otto-link-with-praxis', [
            'parent' => $controller->loadModel(),
            'relation' => 'movie-hasAndBelongsToManyQualified-organisation-withQualifier-tag',

            'searchEntity' => 'Organisation',

            'children' => $organisations, 
            'childrenTemplate' => 'Secret::Organisation/_partials/tab-card'
        ]) ?>
    </div>
    
    <div class="tab-pane fade <?= $activeTab === 'professionals' ? $activeClasses : ''?>" id="professionals" role="tabpanel" aria-labelledby="professionals-tab">
        <?php $this->insert('Secret::_partials/otto/otto-link', [
            'parent' => $controller->loadModel(),
            'relation' => 'movie-hasAndBelongsToMany-professional',

            'searchEntity' => 'Professional',
            
            'children' => $professionals,
            'childrenTemplate' => 'Secret::Professional/_partials/tab-card'

        ]) ?>
    </div>

    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
        <?php $this->insert('Secret::_partials/tab-images', ['images' => $images]) ?>
    </div>
</div>

*/