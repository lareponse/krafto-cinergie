<?php $this->layout('Secret::dashboard', ['title' => 'Localités']) ?>

<div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["zip", "label", "commune", "province", "isSub"], "page": 20}' id="filesTable">
    <div class="card-header border-0">
        <?= isset($filters) ? $this->insert('Secret::_partials/filters/FiltersOnFirstChar', ['count' => count($listing)]) : '' ?>
    </div>
    <div class="table-responsive">
        <table class="table align-middle table-hover table-nowrap mb-0">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="zip">
                            Code postal
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="label">
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
                <?php foreach ($listing as $model): 
                    $url = $controller->urlFor($controller->nid(), 'view', $model);
                ?>
                    <tr>
                        <td class="zip">
                            <?= $this->DOM()::a($url, $model->get('zip') ?? ''); ?>
                        </td>
                        <td class="label">
                            <?= $this->DOM()::a($url, $model->get('label') ?? ''); ?>
                        </td>
                        <td class="commune">
                            <?= $this->DOM()::a($url, $model->get('commune') ?? ''); ?>
                        </td>
                        <td class="province">
                            <?= $this->DOM()::a($url, $model->get('province') ?? ''); ?>
                        </td>
                        <td class="isSub">
                            <?= $this->DOM()::a($url, $model->get('isSub') ? 'Oui' : 'Non'); ?>
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