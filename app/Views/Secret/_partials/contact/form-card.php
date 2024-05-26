<div class="card border-0 scroll-mt-3" id="ContactSection">
    <header class="card-header">
        <h2 class="h3 mb-0">Contact</h2>
    </header>

    <div class="card-body">
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="tel" class="col-form-label">Téléphone</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" name="tel" id="tel" value="<?= $model->get('tel') ?>">
                <div class="invalid-feedback">Please add your phone number</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="fax" class="col-form-label">Fax</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" name="fax" id="fax" value="<?= $model->get('fax') ?>">
                <div class="invalid-feedback">Please add your phone number</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="gsm" class="col-form-label">GSM</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" name="gsm" id="gsm" value="<?= $model->get('gsm') ?>">
                <div class="invalid-feedback">Please add your phone number</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="email" class="col-form-label">e-mail</label>
            </div>

            <div class="col-lg">
                <input type="email" class="form-control" name="email" id="email" value="<?= $model->get('email') ?>">
                <div class="invalid-feedback">Please add your email address</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="site" class="col-form-label">Site</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" name="site" id="site" value="<?= $model->get('url') ?>">
                <div class="invalid-feedback">Please add your site address</div>
            </div>
        </div>
    </div>

    <footer class="card-footer">
        <?= $this->submitDashly(); ?>
    </footer>
</div>