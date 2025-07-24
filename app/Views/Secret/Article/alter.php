<?php
$sidemenu = [
    ['#signaletiqueSection', 'info', 'Signalétique'],
    ['#abstractSection', 'text', 'Chapeau'],
    ['#contentSection', 'text', 'Contenu'],
    ['#videoSection', 'video', 'Video'],
    ['#publicationSection', 'info', 'Publication'],
    ['#commentSection', 'comment', 'Notes internes']
];

$this->layout('Secret::alter', ['sidemenu' => $sidemenu])
?>

<div class="card border-0 scroll-mt-3" id="signaletiqueSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Signalétique</h2>
    </div>

    <div class="card-body">

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="label" class="col-form-label">Titre</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="label" data-kx-counter name="label" required value="<?= $controller->formModel()->get('label') ?>">

                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="publication" class="col-form-label">Date de publication</label>
            </div>
            <?php
            $defaultDate = (new DateTime())->modify('+1 week')->format('Y-m-d');
            $publicationDate = $controller->formModel()->get('publication') ?: $defaultDate;
            ?>

            <div class="col-lg">
                <input type="date" class="form-control" id="publication" name="publication" value="<?= $publicationDate?>">
                <div class="invalid-feedback">Please add the publication date</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="publication" class="col-form-label">Catégorie</label>
            </div>

            <div class="col-lg">
                <?= $this->Form()::select('type_id', $types, $controller->formModel()->get('type_id'), ['class' => 'form-control']); ?>
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <?= $this->submitDashly(); ?>

    </div>
</div>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'abstract', 'title' => 'Chapeau', 'id' => 'abstractSection']) ?>
<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'content', 'title' => 'Contenu', 'id' => 'contentSection']) ?>
<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'embedVideo', 'title' => 'Vidéo', 'id' => 'videoSection', 'wysiwyg' => false]) ?>

<?= $this->insert('Secret::_partials/form/alter-card-publication') ?>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'comment', 'title' => 'Notes internes', 'id' => 'commentSection']) ?>