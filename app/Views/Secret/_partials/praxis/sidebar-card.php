<div class="card border-0 pt-3">
    <div class="card-body pt-0">

    <h3 class="h6 small text-secondary text-uppercase mb-3">Métier(s)</h3>
  

    <?php $list_item = '<li class="py-2">%s %s</li>'; ?>
        <?= $this->insert('Secret::_partials/otto/otto-praxis', [
            'parent' => $controller->loadModel(),
            'relation' => 'article-hasAndBelongsToMany-movie',

            'childrenType' => 'tag',
            'children' => $praxis,
            'data-filter-parent' => 'professional_praxis',

        ]); ?>

    </div>
</div>