<?php $this->layout('Secret::dashboard') ?>

<div class="card border-0 flex-fill w-100">
    <div class="card-header">
        <h5>Export Tables to CSV</h5>
    </div>

    <div class="card-body">
        <form method="post" action="<?= $controller->router()->hyp('dash_export_csv') ?>">
            <div class="mb-3">
                <label for="table-select" class="form-label">Select Table</label>
                <select class="form-select" name="table" id="table-select" required>
                    <option value="">Choose a table...</option>
                    <?php foreach ($tables as $table): ?>
                        <option value="<?= htmlspecialchars($table) ?>"><?= htmlspecialchars($table) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Download CSV</button>
        </form>
    </div>
</div>
