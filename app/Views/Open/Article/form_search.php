<form class="search-form" action="<?= $action ?>">
    <div class="input-group mb-3">
        <input type="search" autocomplete="off" placeholder="<?= $placeholder ?? 'Votre recherche...' ?>" name="s" value="<?= $value ?? '' ?>" class="form-control">
        <button class="btn btn-primary" type="submit" title="Rechercher">
            <?= $this->bi('search'); ?>
        </button>
    </div>
</form>