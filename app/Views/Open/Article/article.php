<?php $this->layout('Open::layout') ?>

<div class="container my-5 pb-5" id="article-single">
    <div class="row">
        <img class="img-fluid mb-5" src="<?= $article->profilePicture(); ?>" alt="Couverture de l'article <?= $article; ?>" />

        <h2><?= $article->get('label'); ?></h2>

        <div class="row g-0 mb-5 col-lg-8 align-items-start">

            <div class="bg-light p-4 p-lg-5 text-justify">
                <?= $article->get('abstract'); ?>
            </div>

        </div>

        <aside id="meta" class="col-lg-4 mb-5">
            <ul class="meta-list">
                <?php if (!empty($article->get('type_label'))) {
                ?>
                    <li class="type"><i class="bi bi-file-text icon"></i><?= $article->get('type_label') ?></li>
                <?php
                }
                ?>
                <?php if (!empty($article->get('author_label'))) {
                ?>
                    <li class=""><i class="bi bi-person-fill icon"></i></i>
                        <a href="<?= $controller->router()->hyp('author', ['slug' => $article->get('author_slug')]) ?>"><?= $article->get('author_label'); ?></a>
                    </li>
                <?php
                }
                ?>
                <li class=""><i class="bi bi-calendar4 icon"></i></i><span class="otto-date"><?= $article->get('publication'); ?></span></li>
            </ul>
            <hr>
            <?= $this->insert('Open::_partials/share_print', ['class' => 'compact', 'label' => $article->get('label')]); ?>

        </aside>

        <div class="w-75 mb-5 mx-auto text-justify">
            <?= $article->get('content'); ?>

            <?= $this->insert('Open::_partials/share_print', ['label' => $article->get('label')]); ?>
            </section>


            <?= $this->insert('Open::_partials/related_articles', ['related_articles' => $related_articles ?? []]) ?>

        </div>


    </div>
</div>