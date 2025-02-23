<?php 
$sidemenu = [
    ['#signaletiqueSection', 'info', 'Signalétique'],
    ['#contentSection', 'text', 'Contenu'],
    ['#abstractSection', 'text', 'Abstract'],
    ['#publicationSection', 'info', 'Publication'],
];

$this->layout('Secret::alter', ['sidemenu' => $sidemenu]) 
?>

<form action="" method="POST">
    <div class="card border-0 scroll-mt-3" id="signaletiqueSection">
        <div class="card-header">
            <h2 class="h3 mb-0">Signalétique</h2>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-lg-3">
                    <label for="lastname" class="col-form-label">Titre</label>
                </div>
                <div class="col-lg">
                    <input type="text" class="form-control" id="label" name="label" value="<?= $controller->formModel()->get('label') ?>">
                </div>
            </div>
        </div>
    </div>

    <?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'content', 'title' => 'Contenu', 'id' => 'contentSection']) ?>
    <?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'abstract', 'title' => 'Abstract', 'id' => 'abstractSection']) ?>

    <div class="card border-0 scroll-mt-3" id="publicationSection">
        <div class="card-header">
            <h2 class="h3 mb-0">Publication</h2>
        </div>

        <div class="card-body">
            <label for="slug" class="col-form-label">Slug</label>
            <input disabled type="text" class="form-control" id="slug" name="slug" value="<?= $controller->formModel()->get('slug') ?>">

            <?= $this->submitDashly(); ?>
        </div>
    </div>
</form>