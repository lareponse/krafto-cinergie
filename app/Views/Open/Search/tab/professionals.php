<?php

use \HexMakina\Marker\{Marker, Form};
?>
<section class="mt-4 mb-2 recherche-page">
    <div id="filtres-checkbox">
        <form action="<?= $controller->router()->hyp('search'); ?> class=" mt-3">
            <?= Form::hidden('tab', 'pro'); ?>

            <div class="row control-group justify-content-md-center mb-3">
                <div class="col">
                    <input class="form-control border-primary" type="text" name="s" value="<?= $controller->router()->params('s') ?>">
                </div>
                <div class="col">
                    <select class="form-select" name="metier">
                        <option value="">Tout métier</option>
                        <?= Form::options($professionalPraxes, $controller->router()->params('metier')); ?>
                    </select>
                </div>
            </div>
            <div id="btn-affiner" class="col-md-12 col-lg-2 mb-3  mt-3  ms-lg-auto">
                <button href="#" class="btn btn-primary submit-filters mb-2">Affiner la recherche</button>
            </div>
        </form>
    </div>
</section>

<?php
if (empty($professionals->records())) {
    echo '<section class="search-no-results">';
    echo Marker::strong($messageNoResults);
    echo '<section>';

} else {
    echo '<section class="search-results">';
    foreach ($professionals->records() as $record) {

?>
        <a href="<?= $controller->router()->hyp('professional', ['slug' => $record->slug()]) ?>" class="card-search shadow">
            <img src="<?= $record->profilePicture(); ?>" alt="Photo de <?= $record->fullName(); ?>">
            <h5 class="card-heading"><?= $record->fullName(); ?></h5>
            <span class="card-meta">
                <?php
                foreach ($record->praxisIds() as $id) {
                    printf('<small class="comma text-secondary otto-id-label" kx-gender="%s" otto-urn="Tag:%d">Tag:%d</small>', $record->get('gender'), $id, $id);
                }
                ?>
            </span>
            <small class="card-description text-secondary">
                <?php
                $content = strip_tags($record->get('content'));
                if (mb_strlen($content) > 400) {
                    $content = mb_substr($content, 0, 400) . '...';
                }
                echo $content;
                ?>
            </small>
        </a>

<?php
    }
    echo '</section>';

    echo $this->insert('Open::_partials/pagination', ['route' => 'search', 'paginator' => $professionals]);
}
?>
</section>