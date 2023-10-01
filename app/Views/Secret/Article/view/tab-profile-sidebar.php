<?php

$parent = 'article';
$child = 'author';
$className = 'Author';
$fields = ['label'];
?>
<input type="hidden" name="<?= $controller->modelClassName()::model_type(); ?>_id" value="<?= $controller->loadModel()->getID() ?>">

<div class="card border-0 pt-2">
    <div class="card-body">
        <h3 class="h6 small text-secondary text-uppercase mb-4">Auteur(s)</h3>
        <?php
        if (empty($authors)) {
            echo $this->DOM()::strong("Pas d'auteurs");
        } else {
            echo '<ul class="list-unstyled mb-7">';
            foreach ($authors as $author) {
        ?>
                <li class="mt-2">
                    <form class="otto-form-listing d-flex" method="POST" action="<?= $controller->router()->hyp('dash_relation_unlink') ?>">
                        <input type="hidden" name="<?= $parent ?>_id" value="<?= $controller->loadModel()->getID() ?>">
                        <input type="hidden" name="<?= $child ?>_id" value="<?= $author->getID() ?>">
                        <div class="input-group">
                            <a href="" class="form-control"><?= $author ?></a>
                            <button class="input-group-text"><?= $this->icon('delete', 18) ?></button>
                        </div>
                    </form>
                </li>
        <?php
            }
            echo '</ul>';
        }
        ?>

    </div>
    <form method="POST" action="<?= $controller->router()->hyp('dash_relation_link', ['parent' => $parent, 'child' => $child]) ?>">
        <input type="hidden" name="<?= $controller->modelClassName()::model_type(); ?>_id" value="<?= $controller->loadModel()->getID() ?>">

        <div class="card-body">
            <div class="w-100 otto-link">
                <ul class="list-group otto-list mb-3" otto-ids="<?= strtolower($className); ?>_ids[]"></ul>
                <input class="form-control list-search ms-md-auto mb-md-0 otto-search" type="search" placeholder="Ajouter" otto-search-fields="<?= implode(',', $fields) ?>" otto-entity="<?= $className; ?>">
                <ul class="list-group list-group-flush otto-suggestions"></ul>
            </div>

        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <span class="fs-5 text-secondary text-truncate">Confirmer pour enregistrer</span>
            <button type="submit" class="btn btn-primary btn-sm">Confirmer</a>
        </div>
    </form>

</div>


<div class="card border-0 pt-3">
    <div class="card-body pt-0">
        <?php $this->insert('Secret::_partials/legacy_view', ['model' => $controller->loadModel()]) ?>
    </div>
</div>