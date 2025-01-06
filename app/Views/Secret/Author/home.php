<?php $this->layout('Secret::dashboard') ?>



<div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["label","URL", "isCollaborator","hasProfilePicture", "active"], "page": 10}' id="filesTable">
    <div class="card-header border-0">
        <?= isset($filters) ? $this->insert('Secret::_partials/filters/FiltersOnFirstChar', ['count' => count($listing)]) : '' ?>

    </div>

    <div class="table-responsive">
        <table class="table table-clickable align-middle table-hover table-nowrap mb-0">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="label">
                            Nom
                        </a>
                    </th>

                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="URL">
                            URL
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="hasProfilePicture">
                            Photo?
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="isCollaborator">
                            Collaborateur
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
                ?>
                    <tr data-action="<?= $controller->urlFor('Author', 'edit', $model) ?>">
                        <td class="fullName">
                            <strong><?= $model->get('label'); ?></strong>
                        </td>

                        <td class="URL">
                            <?= $model->get('url')  ?>
                        </td>

                        <td class="email">
                            <?= $model->get('isCollaborator') ? 'Oui' : 'Non'; ?>
                        </td>

                        <td class="hasProfilePicture">
                            <?= $model->hasProfilePicture() ? 'Oui' : 'Non'; ?>
                        </td>

                        <td class="active">
                            <?= $model->get('public') ? 'Oui' : 'Non'; ?>
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