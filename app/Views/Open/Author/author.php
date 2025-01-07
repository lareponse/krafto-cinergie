<?php $this->layout('Open::layout') ?>

<div class="container my-5 pb-5" id="auteur-single">
    <div class="w-75 my-5 pb-5 mx-auto">

        <div class="row">
            <div class="col-lg-4">
                <img class="img-fluid w-100" src="<?= $controller->avatarFor($record) ?>" alt="auteur" />
            </div>

            <div class="col-lg-8 ps-lg-5 mt-5 mt-lg-0">
                <h2 class="line-left"><?= $record->fullName() ?></h2>

                <?php if (isset($professional)) { ?>
                    <p class="role">
                        <?= implode(', ', $professional->praxis()); ?>
                    </p>
                <?php } ?>

                <p><?= $record->get('content'); ?></p>

                <?= $this->insert('Open::_partials/share_print', ['class' => 'compact', 'label' => $record]); ?>

            </div>
        </div>

    </div>

    <h3 class="articles-auteur my-4"><?= count($articles) ?> articles rédigés par cet auteur</h3>

    <div class="catalog">
        <?php

        foreach($articles as $article){
            $href = $controller->router()->hyp('article', ['slug' => $article->slug()]);
                    ?>
            <article class="card paysage mr-4 mb-4">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <a href="<?= $href ?>">
                                <img src="<?= $controller->avatarFor($article) ?>" class="card-img-left img-fluid rounded-start" alt="...">
                            </a>
                        </div>

                        <div class="col-md-8">
                            <a href="<?= $href ?>">
                                <div class="card-body">
                                    <p class="date otto-date"><?= $article->get('publication') ?></p>
                                    <h5 class="card-title"><?= $article ?></h5>
                                    <a href="" class="cta">Lire l'article</a>
                                </div>
                            </a>
                        </div>

                    </div>
                </article>
                <?php

        }
        ?>
    </div>
</div>
