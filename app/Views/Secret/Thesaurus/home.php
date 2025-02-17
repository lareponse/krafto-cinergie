<?php $this->layout('Secret::dashboard', ['title' => 'UNESCO']) ?>

<div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["slug", "label", "active"], "page": 20}' id="filesTable">
    <div class="card-header border-0">
        <?= isset($filters) ? $this->insert('Secret::_partials/filters/FiltersOnFirstChar', ['count' => count($listing)]) : '' ?>
    </div>
    <div class="table-responsive">
        <table class="table align-middle table-hover table-nowrap mb-0">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="slug">
                            Slug
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="slug">
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
                    $url = $controller->urlFor($controller->nid(), 'view', $model);

                ?>
                    <tr>
                        <td class="slug">
                            <?= $this->DOM()::a($url, $model->slug()); ?>

                        </td>
                        <td class="label">
                            <?= $this->DOM()::a($url, $model); ?>
                        </td>

                        <td class="active">
                            <?= $this->DOM()::a($url, $model->isActive() ? 'Oui' : 'Non'); ?>
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