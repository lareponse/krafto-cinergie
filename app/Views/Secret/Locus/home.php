<?php $this->layout('Secret::dashboard', ['title' => 'Localités']) ?>

<div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["zip", "locality", "commune", "province", "isSub"], "page": 20}' id="filesTable">
    <div class="card-header border-0">
        <?= isset($filters) ? $this->insert('Secret::_partials/filters/FiltersOnFirstChar', ['count' => count($listing)]) : '' ?>
    </div>
    <div class="table-responsive">
        <table class="table table-clickable align-middle table-hover table-nowrap mb-0">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="zip">
                            Code postal
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="locality">
                            Localité
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="commune">
                            Commune
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="province">
                            Province
                        </a>
                    </th>

                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="isSub">
                            isSub
                        </a>
                    </th>
                </tr>
            </thead>

            <tbody class="list">
                <?php
                foreach ($listing as $model) {
                ?>
                    <tr data-action="<?= $controller->urlFor('Locus', 'edit', $model) ?>">
                    <td class="zip">
                            <strong><?= $model->get('zip'); ?></strong>
                        </td>
                        <td class="locality">
                            <strong><?= $model->get('locality'); ?></strong>
                        </td>
                        <td class="commune">
                            <strong><?= $model->get('commune'); ?></strong>
                        </td>
                        <td class="province">
                            <?= $model->get('province'); ?>
                        </td>
                        <td class="isSub">
                            <strong><?= $model->get('isSub') ? 'Oui' : 'Non'; ?></strong>
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