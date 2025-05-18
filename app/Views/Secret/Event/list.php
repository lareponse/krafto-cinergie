<div class="card border-0 flex-fill w-100">

    <div class="card-header border-0">

        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-end">
            <?php
            if (isset($filters)) {
            ?>
                <h2 class="card-header-title h4 text-uppercase">
                    Pour <span><?= $filters['year'] ?? '' ?></span> (<?= count($listing) ?>)
                </h2>
            <?php
            }
            ?>
            <input class="form-control list-search mw-md-300px ms-md-auto mt-5 mt-md-0 mb-3 mb-md-0" type="search" placeholder="Chercher">

            <a href="<?= $controller->url('new'); ?>" class="btn btn-primary ms-md-4">Nouveau</a>
        </div>

        <?php
        if (isset($filters)) {
            $this->insert('Secret::_partials/filters/FiltersOnYear', ['filters' => $filters, 'firstYear' => 2010, 'modelType' => $controller->modelClassName()::model_type()]);
        }
        ?>
    </div>

    <div id="eventTable" class="table-responsive" data-list='{"valueNames": ["title", {"name": "starts", "attr": "data-starts"}, {"name": "stops", "attr": "data-stops"}], "page": 20}'>
        <table class="table align-middle table-hover table-nowrap mb-0">
            <thead class="thead-light">
                <tr>

                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="title">
                            Titre
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="starts">
                            Du
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="stops">
                            Au
                        </a>
                    </th>
                </tr>
            </thead>

            <tbody class="list">
                <?php foreach ($listing as $model):
                    $url = $controller->urlFor($controller->nid(), 'view', $model);
                ?>
                    <tr>
                        <td class="title">
                            <?= $this->DOM()::a($url, substr($model->get('label') ?? '', 0, 40) . '..'); ?>
                        </td>
                        <td class="publication " data-starts="<?= $model->get('starts'); ?>">
                            <a class="otto-format otto-date" href="<?= $url ?>"><?= $model->get('starts'); ?></a>
                        </td>
                        <td class="publication" data-stops="<?= $model->get('stops'); ?>">
                            <a class="otto-format otto-date" href="<?= $url ?>"><?= $model->get('stops'); ?></a>
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