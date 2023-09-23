<?php $this->layout('Secret::dashboard') ?>


<div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["slug", "label", "active"], "page": 20}' id="filesTable">


    <div class="table-responsive">
        <table class="table table-clickable align-middle table-hover table-nowrap mb-0">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="slug">
                            Slug
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="label">
                            Nom
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
                    <tr data-action="<?= $controller->urlFor('Page', 'edit', $model) ?>">
                        <td class="slug">
                            <strong><?= $model->slug(); ?></strong>
                        </td>
                        <td class="label">
                            <strong><?= $model; ?></strong>
                        </td>

                        <td class="active">
                            <?= $model->isActive() ? 'Oui' : 'Non'; ?>
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