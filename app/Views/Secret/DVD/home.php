<?php $this->layout('Secret::dashboard') ?>


<div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["fullName","price","active"], "page": 10}' id="filesTable">
    <div class="card-header border-0">
        <?= isset($filters) ? $this->insert('Secret::_partials/filters/FiltersOnFirstChar', ['count' => count($listing)]) : '' ?>
    </div>

    <div class="table-responsive">
        <table class="table table-clickable align-middle table-hover table-nowrap mb-0">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="fullName">
                            Titre
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="price">
                            Prix
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="active">
                            En vente
                        </a>
                    </th>
                </tr>
            </thead>

            <tbody class="list">
                <?php
                foreach ($listing as $model) {
                ?>
                    <tr data-action="<?= $controller->urlFor('DVD', 'view', $model) ?>">

                        <td class="fullName">
                            <strong><?= $model->get('label'); ?></strong>
                        </td>
                        <td class="price">
                            <?= $model->get('price'); ?> &euro;
                        </td>
                        <td class="active">
                            <?php
                            if ($model->get('active')) {
                                echo '<img src="/public/assets/dashly/icons/check-double.svg" class="nav-link-icon" height="18" width="18" />';
                            } else {
                                echo '<img src="/public/assets/dashly/icons/disable.svg" class="nav-link-icon" height="18" width="18" />';
                            }

                            ?>
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