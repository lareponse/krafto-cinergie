<?php
$name = 'status';
$label = 'Statut';

?>
<div class="me-2">
    <label for="publication-form-<?= $name ?>" class="h4 mb-0"><?= $label ?></label>
    <select class="form-select" id="publication-form-<?= $name ?>" name="<?= $name ?>">
        <?php foreach ($publicationStatuses as $value => $text): ?>
            <option value="<?= $value ?>" <?= $controller->formModel()->get($name) === $value ? 'selected' : '' ?>>
                <?= $text ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>