<div class="card border-0 scroll-mt-3" id="publicationSection">

    <div class="card-header">
        <h2 class="h3 mb-0">Publication</h2>
    </div>


    <div class="card-body">
        <?php
        $name = 'status';
        $label = 'Statut';
        $statuses = [
            'draft'             => 'Brouillon',
            'review_requested'  => 'Demande de révision',
            'in_review'         => 'En révision',
            'revision_requested' => 'Révision demandée',
            'approved'          => 'Approuvé',
            'declined'          => 'Refusé'
        ];
        ?>
        <div class="me-2">
            <label for="publication-form-<?= $name ?>" class="h4 mb-0"><?= $label ?></label>
            <select class="form-select" id="publication-form-<?= $name ?>" name="<?= $name ?>">
                <?php foreach ($statuses as $value => $text): ?>
                    <option value="<?= $value ?>" <?= $controller->formModel()->get($name) === $value ? 'selected' : '' ?>>
                        <?= $text ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <?= $this->submitDashly(); ?>
    </div>

</div>