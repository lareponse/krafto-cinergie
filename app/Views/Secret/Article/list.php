<div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["label", {"name": "publication", "attr": "data-publication"}, "type", "public"],"page": 100}' id="articleTable">

    <div class="card-header border-0">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-end">
            <?php
            if (isset($filters)) {
            ?>
                <h2 class="card-header-title h4 text-uppercase">
                    Articles publiés en
                    <span class="otto-date" otto-format="<?= urlencode(json_encode(['month' => 'long', 'year' => 'numeric'])) ?>"><?= $filters['year'] ?? '' ?>-<?= $filters['month'] ?? '' ?></span>
                    (<?= count($listing) ?>)
                </h2>
            <?php
            }
            ?>
            <input class="form-control list-search mw-md-300px ms-md-auto mt-5 mt-md-0 mb-3 mb-md-0" type="search" placeholder="Chercher">
            <a href="<?= $controller->url('new'); ?>" class="btn btn-primary ms-md-4">Nouveau</a>
        </div>

        <?php
        if (isset($filters)) {
            $this->insert('Secret::_partials/filters/FiltersOnYearAndMonth', ['filters' => $filters, 'firstYear' => 1996, 'modelType' => $controller->modelClassName()::model_type()]);
        }
        ?>
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-hover table-nowrap mb-0">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="label">
                            Titre
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="publication">
                            Publication
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="type">
                            Type
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

                        <td class="label"><a href="<?= $url ?>"><?= $model->get('label'); ?></a></td>

                        <td class="publication" data-publication="<?= $model->get('publication'); ?>">
                            <a href="<?= $url ?>" class="otto-date"><?= $model->get('publication'); ?></a>
                        </td>

                        <td class="type" data-type="<?= $model->get('type_id'); ?>">
                            <a href="<?= $url ?>" class="otto-id-label" otto-urn="Tag:<?= $model->get('type_id'); ?>"><?= $model->get('type_id'); ?></a>
                        </td>
                        <td class="active" data-active="<?= $model->get('public') ? 'Oui' : 'Non'; ?>">
                            <a href=" <?= $url ?>"><?= $model->get('public') ? 'Oui' : 'Non'; ?></a>
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