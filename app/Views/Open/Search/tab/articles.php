<?php

use \HexMakina\Marker\Form; ?>

<section class="row mt-4 mb-2 recherche-page">
    <section id="filtres-checkbox">
        <form action="<?= $controller->router()->hyp('search'); ?> class=" mt-3">
            <?= Form::hidden('tab', 'art'); ?>

            <div class="row control-group justify-content-md-center mb-3">
                <input class="form-control border-primary" type="text" name="s" value="<?= $controller->router()->params('s') ?>">
            </div>

            <div class="row control-group justify-content-md-center my-3">
                <?php
                foreach ($articleCategories as $category) {
                    $checked = in_array($category->get('id'), $controller->router()->params('ac') ?? []) ? 'checked="checked"' : '';
                ?>
                    <label class="col-md-4 col-lg-2 control control-checkbox">
                        <?= $category; ?>
                        <input type="checkbox" <?= $checked; ?> id="cat_<?= $category->get('id'); ?>" name="ac[]" value="<?= $category->get('id'); ?>" />
                        <div class="control_indicator"></div>
                    </label>
                <?php
                }
                ?>
            </div>

            <div id="btn-affiner" class="col-md-12 col-lg-2 mb-3  mt-3  ms-lg-auto">
                <button href="#" class="btn btn-primary submit-filters mb-2">Affiner la recherche</button>
            </div>
        </form>

    </section>
    <?php

    foreach ($articles->records() as $record) {
    ?>
        <article class="card shadow p-0 listing mb-3 px-lg-0">
            <div class="row g-0">
                <div class="col-2 d-flex justify-content-center align-items-center">
                    <i class="bi bi-newspaper"></i>
                </div>
                <div class="col-10">
                    <a href="<?=$controller->router()->hyp('article', ['slug' => $record->slug()])?>">
                        <div class="row card-body">
                            <div class="col-12 col-sm-6 col-md-8">
                                <h5 class="card-title mb-0"><?= $record->get('label')?></h5>
                            </div>
                            <div class="col-6 col-md-4">
                                <p class="text-right otto-date"><?= $record->get('publication')?></p>
                            </div>
                            <div class="details">
                                <p class="card-text text-secondary"><small><?=substr(strip_tags($record->get('abstract')),0,400)?>....</small></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </article>
    <?php
    }
    ?>
    <?= $this->insert('Open::_partials/pagination', ['route' => 'search', 'paginator' => $articles]);?>
</section>