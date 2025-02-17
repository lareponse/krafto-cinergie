<?php $this->layout('Secret::dashboard') ?>


<div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["fullName","released","runtime"], "page": 10}' id="filesTable">
    <div class="card-header border-0">
        <?= isset($filters) ? $this->insert('Secret::_partials/filters/FiltersOnFirstChar', ['count' => count($listing)]) : '' ?>
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-hover table-nowrap mb-0">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="fullName">
                            Nom
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="released">
                            Sortie
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="runtime">
                            Durée
                        </a>
                    </th>
                </tr>
            </thead>

            <tbody class="list">
                <?php foreach ($listing as $model):
                    $url = $controller->urlFor($controller->nid(), 'view', $model);
                ?>
                    <tr>
                        <td class="fullName">
                            <?= $this->DOM()::a($url, $model); ?>

                        </td>
                        <td class="released">
                            <?= $this->DOM()::a($url, $model->get('released') ?? ''); ?>
                        </td>
                        <td class="runtime">
                            <?= $this->DOM()::a($url, $model->get('runtime') ?? ''); ?>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>

    <div class="card-footer">

        <ul class="pagination justify-content-end list-pagination mb-0"></ul>
    </div>
</div>