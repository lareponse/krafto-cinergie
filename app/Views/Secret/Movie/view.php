<?php $this->layout('Secret::view') ?>

<?php $this->unshift('scripts') ?>
    <script src="/public/assets/js/otto-thesaurus-label.js"></script>
<?php $this->end() ?>

<?= $this->insert('Secret::_partials/tab/pampoi-nav', ['currentSection' => 'movies'])?>

<div class="tab-content pt-6" id="viewPageContent">
    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <?php $this->insert('Secret::Movie/view/tab-profile') ?>
    </div>

    <div class="tab-pane fade" id="articles" role="tabpanel" aria-labelledby="articles-tab">
        <?php $this->insert('Secret::Article/list', ['listing' => $articles]) ?>
    </div>

    <div class="tab-pane fade" id="organisations" role="tabpanel" aria-labelledby="organisations-tab">
        <?php $this->insert('Secret::_partials/otto/otto-link', [
            'cards' => $organisations,
            'className' => 'Organisation', 
            'parent' => 'movie',
            'child' => 'organisation',
            'fields' => ['label']
        ]) ?>
    </div>
    <div class="tab-pane fade" id="professionals" role="tabpanel" aria-labelledby="professionals-tab">
        <?php $this->insert('Secret::_partials/otto/otto-link', [
            'cards' => $professionals,
            'className' => 'Professional',
            'parent' => 'movie',
            'child' => 'professional',

            'fields' => ['firstname', 'lastname']
        ]) ?>
    </div>

    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
        <?php $this->insert('Secret::_partials/tab-images', ['images' => $images]) ?>
    </div>
</div>