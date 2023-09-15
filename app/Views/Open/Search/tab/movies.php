<?php

use \HexMakina\Marker\Form; ?>

<section class="row mt-4 mb-2 recherche-page">

    <section id="filtres-checkbox">

        <form action="<?= $controller->router()->hyp('search'); ?> class=" mt-3">

            <?= Form::hidden('tab', 'mov'); ?>

            <div class="row control-group justify-content-md-center mb-3">
                <div class="col">
                    <input class="form-control border-primary" type="text" name="s" value="<?= $controller->router()->params('s') ?>">
                </div>
            </div>
            <div class="row control-group justify-content-md-center mb-3">
                <div class="col-lg-4 mt-3">
                    <label class="form-label">Type</label>
                    <select class="form-select" name="genre">
                        <option value="">Tout</option>
                        <?= Form::options($movieGenres, $controller->router()->params('genre')); ?>
                    </select>
                </div>

                <div class="col-lg-4 mt-3">
                    <label class="form-label">Durée</label>
                    <select class="form-select" name="metrage">
                        <option value="">Tout</option>
                        <?= Form::options($movieMetrages, $controller->router()->params('metrage')); ?>
                    </select>
                </div>

                <div class="col-lg-4 mt-3">
                    <label class="form-label">Date de sortie</label>
                    <select class="form-select" name="released">
                        <option value="">Tout</option>
                        <?= Form::options($movieReleaseYears, $controller->router()->params('released')); ?>
                    </select>
                </div>
            </div>
            <div class="col">
                <label class="form-label">Thème</label>
                <select class="form-select" name="theme">
                    <option value="">Tout</option>
                    <?= Form::options($movieThemes, $controller->router()->params('theme')); ?>

                </select>
            </div>
            <div id="btn-affiner" class="col-md-12 col-lg-2 mb-3 mt-3  ms-lg-auto">
                <button href="#" class="btn btn-primary submit-filters mt-2 mb-2">Affiner la recherche</button>
            </div>
        </form>

    </section>
    <?php
    foreach ($movies->records() as $result) {
    ?>
        <article class="card shadow p-0 listing mb-3 px-lg-0">
            <div class="row g-0">
                <div class="col-2 d-flex justify-content-center align-items-center">
                    <i class="bi bi-film"></i>
                </div>
                <div class="col-10">
                    <a href="#">
                        <div class="row card-body">
                            <div class="col-12 col-sm-6 col-md-8">
                                <h5 class="card-title mb-0">Bouli Lanners dans Une affaire de principe d’Antoine Raimbault</h5>
                            </div>
                            <div class="col-6 col-md-4">
                                <p class="text-right otto-date"><?= $result->get('publication'); ?></p>
                            </div>
                            <div class="details">
                                <p class="card-text text-secondary"><small>Bouli Lanners, Thomas VDB et Céleste Brunnquell au casting du second long du réalisateur de Une intime conviction. Une production Agat Films et Memento qui sera vendue par Charades....</small></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </article>
    <?php
    }
    ?>

</section>