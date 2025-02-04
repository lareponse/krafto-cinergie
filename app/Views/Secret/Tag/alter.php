<?php 
$sidemenu = [
    ['#signaletiqueSection', 'info', 'Signalétique'],
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
                <label for="slug" class="col-form-label">Slug</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="slug" name="slug" value="<?= $this->e($controller->formModel()->get('slug')) ?>">
                <div class="invalid-feedback">Please add a slug</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="label" class="col-form-label">Titre</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="label" name="label" value="<?= $this->e($controller->formModel()->get('label')) ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="parent_id" class="col-form-label">Parent</label>
            </div>

            <div class="col-lg">
                <?= $this->Form()::select('parent_id', $root_tags, $controller->formModel()->get('parent_id'), ['class'=>"form-select"]) ?>
                <div class="invalid-feedback">Please add a parent ID</div>
            </div>
        </div>

        <?= $this->submitDashly(); ?>

    </div>
</div>
