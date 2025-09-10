<?php $this->layout('Secret::dashboard') ?>

<div class="card border-0 flex-fill w-100">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Exports prédéfinis</h5>
                <p class="text-muted small">Exports complets avec relations</p>

                <?php foreach ($presets as $key => $preset): ?>
                    <form method="post" action="<?= $controller->router()->hyp('dash_export_csv') ?>" class="mb-2">
                        <input type="hidden" name="preset" value="<?= $key ?>">
                        <button type="submit" class="btn btn-outline-primary btn-sm w-100">
                            <?= htmlspecialchars($preset['name']) ?>
                        </button>
                    </form>
                <?php endforeach; ?>
            </div>

            <div class="col-md-6">
                <h5>Tables brutes</h5>
                <p class="text-muted small">Exports de tables individuelles</p>

                <form method="post" action="<?= $controller->router()->hyp('dash_export_csv') ?>">
                    <div class="mb-3">
                        <select class="form-select" name="table" id="table-select">
                            <option value="">Choisir une table...</option>
                            <?php foreach ($tables as $table): ?>
                                <option value="<?= htmlspecialchars($table) ?>"><?= htmlspecialchars($table) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-secondary btn-sm">Télécharger CSV brut</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('table-select').addEventListener('change', function() {
        if (this.value) {
            this.closest('form').submit();
        }
    });
</script>