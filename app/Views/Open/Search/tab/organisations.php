<?php

use \HexMakina\Marker\Form; ?>

<section class="row mt-4 mb-2 recherche-page">

    <section id="filtres-checkbox">
        <form action="<?= $controller->router()->hyp('search'); ?> class=" mt-3">
            <?= Form::hidden('tab', 'org'); ?>

            <div class="row control-group justify-content-md-center mb-3">
                <div class="col">
                    <input class="form-control border-primary" type="text" name="s" value="<?= $controller->router()->params('s') ?>">
                </div>
                <div class="col">
                    <select class="form-select" name="activite">
                        <option value="">Toute activité</option>
                        <?= Form::options($organisationPraxes, $controller->router()->params('activite')); ?>
                    </select>
                </div>
            </div>
            <div id="btn-affiner" class="col-md-12 col-lg-2 mb-3  mt-3  ms-lg-auto">
                <button href="#" class="btn btn-primary submit-filters mb-2">Affiner la recherche</button>
            </div>
        </form>

    </section>


    <p><?= $messageNoResults?></p>

</section>