<div class="card border-0 scroll-mt-3" id="signaletiqueSection">
    <header class="card-header">
        <h2 class="h3 mb-0">Signalétique</h2>
    </header>

    <div class="card-body">
        <!-- <div class="row mb-4">
            <div class="col-lg-3">
                <label for="lastname" class="col-form-label">Nom</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="lastname" value="<?= $model->get('lastname') ?>">
                <div class="invalid-feedback">Vous n'avez pas précisé cette information</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="firstname" class="col-form-label">Prénom</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="firstname" value="<?= $model->get('firstname') ?>">
                <div class="invalid-feedback">Vous n'avez pas précisé cette information</div>
            </div>
        </div> -->

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="label" class="col-form-label">Prénom</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="label" value="<?= $model->get('label') ?>">
                <div class="invalid-feedback">Vous n'avez pas précisé cette information</div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="gender" class="col-form-label">Genre</label>
            </div>

            <div class="col-lg">
                <select class="form-select" name="gender" id="gender">
                    <?php $this->insert('Secret::_partials/form/options-gender', ['selected' => $model->get('gender')]) ?>
                </select>
                <div class="invalid-feedback">Vous n'avez pas précisé cette information</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="birth" class="col-form-label">Naissance</label>
            </div>

            <div class="col-lg-3">
                <input type="date" class="form-control" id="birth" name="birth" value="<?= $model->get('birth') ?>">
                <div class="invalid-feedback">Vous n'avez pas précisé cette information</div>
            </div>

            <div class="col-lg-3">
                <label for="death" class="col-form-label">Décès</label>
            </div>

            <div class="col-lg-3">
                <input type="date" class="form-control" id="death" name="death" value="<?= $model->get('death') ?>">
                <div class="invalid-feedback">Vous n'avez pas précisé cette information</div>
            </div>
        </div>
    </div>
    
    <footer class="card-footer">
        <?= $this->submitDashly(); ?>
    </footer>
</div>