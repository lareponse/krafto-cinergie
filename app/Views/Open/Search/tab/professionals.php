<?php
use \HexMakina\Marker\{Marker,Form}; 
?>
<section class="row mt-4 mb-2 recherche-page">

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
    </section>

    <?php
    if (empty($professionals->records())) {
        echo Marker::strong($messageNoResults);
    } 
    else {

        foreach ($professionals->records() as $record) {
            ?>
                <article class="card shadow p-0 listing mb-3 px-lg-0">
                    <div class="row g-0">
                        <div class="col-2 d-flex justify-content-center align-items-center">
                            <img src="<?= $record->profilePicture(); ?>" class="img-fluid" style="height:200px" alt="Photo de <?= $record->fullName(); ?>">
                        </div>
                        <div class="col-10">
                        <a href="<?=$controller->router()->hyp('professional', ['slug' => $record->slug()])?>">
                                <div class="row card-body">
                                    <div class="col-12 col-sm-6 col-md-8">
                                        <h5 class="card-title mb-0"><?= $record->fullName();?></h5>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <p class="text-right">20 juillet 2023</p>
                                    </div>
                                    <div class="details">
                                        <p class="card-text text-secondary"><small><?= mb_substr(strip_tags($record->get('content')), 0, 400)?>....</small></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </article>
        <?php
        }
        
        echo $this->insert('Open::_partials/pagination', ['route' => 'search', 'paginator' => $professionals]);
    }
    ?>
</section>