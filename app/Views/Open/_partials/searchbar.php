<div class="collapse" id="searchBAR">
    <div class="bg-dark p-4 d-print-none">
        <div class="container">
            <div class="mx-auto col-lg-6">
                <form class="search-form ms-2" action="<?= $controller->router()->hyp('search') ?>">
                    <div class="input-group mb-3">
                        <input type="search" value="" autocomplete="off" placeholder="Rechercher" name="s" value="<?= $controller->router()->params('s') ?>" class="form-control">
                        <button class="btn btn-primary" type="submit" title="Rechercher">
                            <?= $this->bi('search'); ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>