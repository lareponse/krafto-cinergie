<?php 
$sidemenu = [
    ['#signaletiqueSection', 'info', 'Signalétique'],
    ['#contentSection', 'text', 'Contenu'],
    ['#publicationSection', 'info', 'Publication']
];
$this->layout('Secret::alter', ['sidemenu' => $sidemenu]) 
?>

<div class="card border-0 scroll-mt-3" id="SignalétiqueSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Signalétique</h2>
    </div>

    <div class="card-body">
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="lastname" class="col-form-label">Nom</label>
            </div>
            <div class="col-lg">
                <input type="text" class="form-control" id="label" name="label" value="<?= $controller->formModel()->get('label') ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="legacy_lien" class="col-form-label">URL</label>
            </div>
            <div class="col-lg">
                <input type="text" class="form-control" id="legacy_lien" name="legacy_lien" value="<?= $controller->formModel()->get('legacy_lien') ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-2 col-lg-3">
                <label for="people" class="col-form-label">Auteurs</label>
            </div>

            <div class="col">
                <input type="text" class="form-control" id="people" name="people" value="<?= $controller->formModel()->get('people') ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-2 col-lg-3">
                <label for="price" class="col-form-label">Prix</label>
            </div>

            <div class="col-md-2">
                <input type="number" class="form-control" id="price" name="price" value="<?= $controller->formModel()->get('price') ?>">
            </div>

            <div class="col-md-2 col-lg-2">
                <label for="deliveryBe" class="col-form-label">Frais Belgique</label>
            </div>

            <div class="col-md-2 col-lg-1">
                <input type="number" class="form-control" id="deliveryBe" name="deliveryBe" value="<?= $controller->formModel()->get('deliveryBe') ?>">
            </div>

            <div class="col-md-2">
                <label for="deliveryEu" class="col-form-label">Frais Europe</label>
            </div>
            <div class="col-md-2 col-lg-1">
                <input type="number" class="form-control" id="deliveryEu" name="deliveryEu" value="<?= $controller->formModel()->get('deliveryEu') ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="profilePicture" class="col-form-label">Photo principale</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="profilePicture" name="profilePicture" value="<?= $controller->formModel()->get($controller->formModel()->profilePictureField()) ?>">
            </div>
        </div>

        <?= $this->submitDashly(); ?>

    </div>
</div>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'content', 'title' => 'Contenu', 'id' => 'contentSection']) ?>

<?= $this->insert('Secret::_partials/form/alter-card-publication', [
    'add' => [
        'isBook' => ['Livre', 'Est un livre, pas un DVD ?']
        ]
    ]) ?>
