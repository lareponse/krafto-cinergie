<?php $this->layout('Secret::dashboard') ?>

<?= $this->insert('Secret::Operator/_partials/dashboard-cards'); ?>


<div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["username","permission_names", "email", "active"], "page": 100}' id="filesTable">
    <div class="card-header border-0">
        <?= isset($filters) ? $this->insert('Secret::_partials/filters/FiltersOnFirstChar', ['count' => count($listing)]) : '' ?>

    </div>

    <div class="table-responsive">
        <table class="table align-middle table-hover table-nowrap mb-0">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="username">
                            login
                        </a>
                    </th>

                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="permission_names">
                            groupe
                        </a>
                    </th>

                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="email">
                            email
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
                    <tr data-kx-href="<?= $controller->urlFor($controller->nid(), 'edit', $model) ?>">
                        <td class="username">
                            <strong><?= $model->get('username'); ?></strong>
                        </td>


                        <td class="permission_names">
                            <?= $model->get('permission_names')  ?>
                        </td>
                        <td class="email">
                            <?= $model->get('email')  ?>
                        </td>
                        <td class="active">
                            <?= $model->get('active') ? 'Oui' : 'Non'; ?>
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