<div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["title", {"name": "publication", "attr": "data-publication"}, "type"]}' id="articleTable">

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
            <a href="<?= $controller->url('new');?>" class="btn btn-primary ms-md-4">Nouveau</a>
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
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="title">
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
                </tr>
            </thead>

            <tbody class="list">
                <?php
                foreach ($listing as $model) {
                ?>
                    <tr data-kx-href="<?= $controller->urlFor('Article', 'view', $model) ?>">

                        <td class="title">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold d-block"><?= $model->get('label'); ?></span>
                                </div>
                            </div>
                        </td>
                        <td class="publication otto-date" data-publication="<?= $model->get('publication'); ?>">
                            <?= $model->get('publication'); ?>
                        </td>
                        <td class="type" data-type="<?= $model->get('type_id'); ?>">
                            <span class="otto-id-label" otto-urn="Tag:<?= $model->get('type_id'); ?>" ><?= $model->get('type_id'); ?></span>
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