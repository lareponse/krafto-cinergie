<?php $this->layout('Secret::dashboard') ?>

<div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["fullName","price","deliveryBe", "deliveryEu","active"], "page": 100}' id="filesTable">
    <div class="card-header border-0">
        <?= isset($filters) ? $this->insert('Secret::_partials/filters/FiltersOnFirstChar', ['count' => count($listing)]) : '' ?>
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-hover table-nowrap mb-0">
            <thead class="thead-light">
                <tr>
                    <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="fullName">Titre</a></th>
                    <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="price">Prix</a></th>
                    <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="deliveryBe">BE</a></th>
                    <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="deliveryEu">EU</a></th>
                    <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="active">En vente</a></th>
                </tr>
            </thead>

            <tbody class="list">
                <?php foreach ($listing as $model):
                    $url = $controller->urlFor($controller->nid(), 'view', $model);
                ?>
                    <tr>
                        <td class="fullName"><?= $this->DOM()::a($url, $model->get('label') ?? '', ['class' => '']); ?></td>
                        <td class="price"><?= $this->DOM()::a($url, $model->get('price') ?? '', ['class' => 'currency']); ?></td>
                        <td class="deliveryBe"><?= $this->DOM()::a($url, $model->get('deliveryBe') ?? '', ['class' => 'currency']); ?></td>
                        <td class="deliveryEu"><?= $this->DOM()::a($url, $model->get('deliveryEu') ?? '', ['class' => 'currency']); ?></td>
                        <td class="active"><?= $this->DOM()::a($url, $model->get('public') ? 'Oui' : 'Non'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <ul class="pagination justify-content-end list-pagination mb-0"></ul>
    </div>
</div>