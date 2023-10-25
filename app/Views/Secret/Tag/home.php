<?php $this->layout('Secret::dashboard', ['title' => 'Qualifiants']) ?>

<div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["label", "reference", "parent", "active"], "page": 20}' id="filesTable">
    <div class="card-header border-0">
        <?= isset($filters) ? $this->insert('Secret::_partials/filters/FiltersOnFirstChar', ['count' => count($listing)]) : '' ?>
    </div>
    <div class="table-responsive">
        <table class="table table-clickable align-middle table-hover table-nowrap mb-0">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="reference">
                            Nom
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="reference">
                            Référence
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="parent">
                            Parent
                        </a>
                    </th>

                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="active">
                            Actif
                        </a>
                    </th>
                </tr>
            </thead>

            <tbody class="list">
                <?php
                foreach ($listing as $model) {

                    // vd($model);
                ?>
                    <tr data-action="<?= $controller->urlFor($controller->urn(), 'edit', $model) ?>">
                        <td class="label">
                            <strong><?= $model; ?></strong>
                        </td>
                        <td class="reference">
                            <?= $model->get('reference'); ?>
                        </td>
                        <td class="parent">
                            <strong><?= $model->get('parent_label'); ?></strong>
                        </td>

                        <td class="active">
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>

    <div class="card-footer">

        <ul class="pagination justify-content-end list-pagination mb-0"></ul>
    </div>
</div>