<?php

use \HexMakina\Marker\{Marker, Form};
?>
<section class="row mt-4 mb-2 recherche-page search articles">
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
                        <input type="checkbox" <?= $checked; ?> id="cat_<?= $category->get('id'); ?>" name="ac[]" value="<?= $category->get('id'); ?>" />
                        <?= $category; ?>
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
    if (empty($articles->records())) {
        echo Marker::strong($messageNoResults);
    } else {
        foreach ($articles->records() as $record) {
    ?>

            <a href="<?= $controller->router()->hyp('article', ['slug' => $record->slug()]) ?>" class="result shadow listing">

                <span>
                    <?= $this->bi('newspaper'); ?>
                </span>
                <span class="details">
                    <strong><?= $record ?></strong>
                    <span class="otto-date"><?= $record->get('publication') ?></span>
                    <small class="card-text text-secondary"><?= mb_substr(strip_tags($record->get('abstract') ?? ''), 0, 400) ?>....</small>
                </span>
            </a>
    <?php
        }

        echo $this->insert('Open::_partials/pagination', ['route' => 'search', 'paginator' => $articles]);
    }
    ?>
</section>