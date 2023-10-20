<?php
$parentType = $parent::model_type();
$childrenType = $childrenType ?? 'tag';

$existing = json_encode(
    array_map(
        function ($child) {
            return ['id' => $child->getID(), 'label' => $child->__toString()];
        },
        array_values($praxis ?? [])
    )
);

?>
       
<form id="otto-praxis" method="POST" data-filter-parent="professional_praxis" action="<?= $controller->router()->hyp('dash_relation_link') ?>">

    <input type="hidden" name="relation" value="<?= $relation ?>" />
    <input type="hidden" name="parent_id" value="<?= $parent->getID() ?>" />


    <ul class="list-group list-group-flush list-group-compact mb-3 otto-list "></ul>
    <ul class="list-group list-group-flush list-group-compact mb-3 otto-selected "></ul>
    <input class="otto-search form-control" type="search" placeholder="Ajouter" />
    <ul class="list-group otto-suggestions"></ul>

    <div class="my-3 d-flex align-items-center justify-content-between">
        <span class="fs-5 text-secondary text-truncate">Confirmer pour enregistrer</span>
        <button type="submit" class="btn btn-primary btn-sm">Confirmer</button>
    </div>

</form>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", () => {
        const container = document.getElementById("otto-praxis");
        const existingPraxis = <?= $existing ?>;
        new OttoTagList(container, existingPraxis);
    });
</script>
         