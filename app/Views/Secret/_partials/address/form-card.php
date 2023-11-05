<div class="card border-0 scroll-mt-3" id="<?= $idSection ?? 'AdresseSection' ?>">
    <div class="card-header">
        <h2 class="h3 mb-0">Adresse</h2>
    </div>

    <div class="card-body">
    <div class="row mb-4">
            <div class="col-lg-3">
                <label for="addressLine1" class="col-form-label">Rue</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="addressLine1" value="<?= $model->get('street') ?>">
                <div class="invalid-feedback">Please add an address</div>
            </div>
        </div> 

        <div class="row mb-4">
            <div class="col-md-3">
                <label for="zip" class="col-form-label">Code postal & Ville</label>
            </div>

            <div class="col-md-3">
                <input type="number" class="form-control" name="zip" id="zip" value="<?= $model->get('zip') ?>">
                <div class="invalid-feedback">Please add your city</div>
            </div>

            <div class="col-md-6">
                <input type="text" class="form-control" name="city" id="city" value="<?= $model->get('city') ?>">
                <div class="invalid-feedback">Please add your city</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="province" class="col-form-label">Province</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" name="province" id="province" value="<?= $model->get('province') ?>">
                <div class="invalid-feedback">Please add your province</div>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="country" class="col-form-label">Pays</label>
            </div>

            <div class="col-lg">
                <div class="mb-4">

                    <select class="form-select" name="country" id="country" required autocomplete="off" data-select='{
                    "placeholder": "Pays"
                }' data-option-template='<span class="d-flex align-items-center py-2"><span class="text-truncate ms-2">[[text]]</span></span>' data-item-template='<span class="d-flex align-items-center"><span class="text-truncate ms-2">[[text]]</span></span>'>
                        <?php $this->insert('Secret::_partials/form/options-country', ['selected' => $model->get('country')]) ?>
                    </select>
                    <div class="invalid-feedback">Please select a country</div>
                </div>

            </div>
        </div> 

        <?= $this->submitDashly(); ?>
    </div>
</div>