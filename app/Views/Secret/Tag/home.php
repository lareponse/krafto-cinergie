<?php $this->layout('Secret::dashboard', ['title' => 'Qualifiants']) ?>

<div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["label", "content", "slug", "parent", "active"], "page": 20}' id="filesTable">
    <div class="card-header border-0">
        <?= isset($filters) ? $this->insert('Secret::_partials/filters/FiltersOnFirstChar', ['count' => count($listing)]) : '' ?>
    </div>
    <div class="table-responsive">
        <table class="table align-middle table-hover table-nowrap mb-0">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="parent">
                            Parent
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="label">
                            Nom
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="content">
                            Description
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="slug">
                            Référence
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
                        <td class="parent">
                            <?= $this->DOM()::a($url, substr($model->get('parent_label') ?? '', 0, 40)); ?>
                        </td>

                        <td class="label"> <?= $this->DOM()::a($url, substr($model->get('label') ?? '', 0, 40)); ?>
                        </td>
                        <td class="content">
                            <?= $this->DOM()::a($url, substr($model->get('content') ?? '', 0, 40)); ?>
                        </td>
                        <td class="slug">
                            <?= $model->slug(); ?>
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