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
                <label for="label" class="col-form-label">Label</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="label" name="label" value="<?= $this->e($controller->formModel()->get('label')) ?>">
                <div class="invalid-feedback">Please add a label</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="zip" class="col-form-label">Code Postal</label>
            </div>

            <div class="col-lg">
                <input type="number" class="form-control" id="zip" name="zip" value="<?= $this->e($controller->formModel()->get('zip')) ?>">
                <div class="invalid-feedback">Please add a valid postal code</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="commune" class="col-form-label">Commune</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="commune" name="commune" value="<?= $this->e($controller->formModel()->get('commune')) ?>">
                <div class="invalid-feedback">Please add a commune</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="province" class="col-form-label">Province</label>
            </div>

            <div class="col-lg">
                <select class="form-select" id="province" name="province">
                    <option value="" <?= $controller->formModel()->get('province') === null ? 'selected' : '' ?>>Sélectionnez une province</option>
                    <option value="Anvers" <?= $controller->formModel()->get('province') === 'Anvers' ? 'selected' : '' ?>>Anvers</option>
                    <option value="Brabant Flamand" <?= $controller->formModel()->get('province') === 'Brabant Flamand' ? 'selected' : '' ?>>Brabant Flamand</option>
                    <option value="Brabant Wallon" <?= $controller->formModel()->get('province') === 'Brabant Wallon' ? 'selected' : '' ?>>Brabant Wallon</option>
                    <option value="Bruxelles" <?= $controller->formModel()->get('province') === 'Bruxelles' ? 'selected' : '' ?>>Bruxelles</option>
                    <option value="Flandre Occidentale" <?= $controller->formModel()->get('province') === 'Flandre Occidentale' ? 'selected' : '' ?>>Flandre Occidentale</option>
                    <option value="Flandre Orientale" <?= $controller->formModel()->get('province') === 'Flandre Orientale' ? 'selected' : '' ?>>Flandre Orientale</option>
                    <option value="Hainaut" <?= $controller->formModel()->get('province') === 'Hainaut' ? 'selected' : '' ?>>Hainaut</option>
                    <option value="Liège" <?= $controller->formModel()->get('province') === 'Liège' ? 'selected' : '' ?>>Liège</option>
                    <option value="Limbourg" <?= $controller->formModel()->get('province') === 'Limbourg' ? 'selected' : '' ?>>Limbourg</option>
                    <option value="Luxembourg" <?= $controller->formModel()->get('province') === 'Luxembourg' ? 'selected' : '' ?>>Luxembourg</option>
                    <option value="Namur" <?= $controller->formModel()->get('province') === 'Namur' ? 'selected' : '' ?>>Namur</option>
                </select>
                <div class="invalid-feedback">Please select a province</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="isSub" class="col-form-label">Type</label>
            </div>

            <div class="col-lg">
                <select class="form-select" id="isSub" name="isSub">
                    <option value="" <?= $controller->formModel()->get('isSub') === null ? 'selected' : '' ?>>Spécial</option>
                    <option value="0" <?= empty($controller->formModel()->get('isSub')) ? 'selected' : '' ?>>Parent</option>
                    <option value="1" <?= !empty($controller->formModel()->get('isSub')) ? 'selected' : '' ?>>Enfant</option>
                </select>
                <div class="invalid-feedback">Please select a type</div>
            </div>
        </div>

        <?= $this->submitDashly(); ?>
    </div>
</div>