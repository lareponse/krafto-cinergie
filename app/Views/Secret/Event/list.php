<div class="card border-0 flex-fill w-100">

    <div class="card-header border-0">

        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-end">
            <?php
            if (isset($filters)) {
            ?>
                <h2 class="card-header-title h4 text-uppercase">
                    Pour  
                    <span class="otto-date" otto-format="<?= urlencode(json_encode(['month' => 'long', 'year' => 'numeric']))?>"><?= $filters['year'] ?? '' ?>-<?= $filters['month'] ?? '' ?>-01</span>
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
            $this->insert('Secret::_partials/filters/FiltersOnYearAndMonth', ['filters' => $filters, 'firstYear' => 2010, 'modelType' => $controller->modelClassName()::model_type()]);
        }
        ?>
    </div>

    <div id="eventTable" class="table-responsive" data-list='{"valueNames": ["title", {"name": "starts", "attr": "data-starts"}, {"name": "stops", "attr": "data-stops"}], "page": 20}'>
        <table class="table table-clickable align-middle table-hover table-nowrap mb-0">
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
                <?php
                foreach ($listing as $model) {

                ?>
                <tr data-action="<?= $controller->urlFor($controller->className(), 'edit', $model)?>">


                        <td class="title">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold d-block"><?= $model->get('label'); ?></span>
                                </div>
                            </div>
                        </td>
                        <td class="publication otto-format otto-date" data-starts="<?= $model->get('starts'); ?>">
                            <?= $model->get('starts'); ?>
                        </td>
                        <td class="publication otto-format otto-date" data-stops="<?= $model->get('stops'); ?>">
                            <?= $model->get('stops'); ?>
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