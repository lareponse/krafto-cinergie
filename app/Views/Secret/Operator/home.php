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
                <?php foreach ($listing as $model):
                    $url = $controller->urlFor($controller->nid(), 'view', $model);
                ?>
                    <tr>
                        <td class="username">
                            <?= $this->DOM()::a($url, $model->get('username') ?? ''); ?>

                        </td>


                        <td class="permission_names">
                            <?= $this->DOM()::a($url, $model->get('permission_names') ?? ''); ?>

                        </td>
                        <td class="email">
                            <?= $this->DOM()::a($url, $model->get('email') ?? ''); ?>

                        </td>
                        <td class="active">
                            <?= $this->DOM()::a($url, $model->get('active')  ? 'Oui' : 'Non'); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
    </div>

    <div class="card-footer">

        <ul class="pagination justify-content-end list-pagination mb-0"></ul>
    </div>
</div>