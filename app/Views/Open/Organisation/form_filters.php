<?php use \HexMakina\Marker\Form; ?>
<form action="<?= $controller->router()->hyp('organisations'); ?>" method="GET">
    <header>
        <h6>Filtres</h6>
        <button href="#" class="clean-filtres">Tout effacer</button>
    </header>

    <hr>

    <label class="form-label">Trier par catégorie</label>
    <select class="form-select" name="activites">
        <option value="">Tout</option>
        <?= Form::options($praxis, $controller->router()->params('activites'));?>
    </select>

    <hr class="my-4 mb-1">

    <label class="form-label mt-3">Rechercher par nom</label>
    <input class="form-control" type="text" name="nom" placeholder="Indiquez le nom" value="<?=$controller->router()->params('nom');?>" />

    <footer>
        <button href="#" class="btn btn-primary submit-filters mt-4">Afficher</button>
    </footer>
</form>