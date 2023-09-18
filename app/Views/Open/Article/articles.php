<?php $this->layout('Open::layout', ['title' => "Toute l'actualité du cinéma belge"]) ?>


<div class="container">

    <div class="mx-auto my-5 w-75">
        <form class="search-form" action="<?=$controller->router()->hyp('articles')?>">
            <div class="input-group mb-3">
                <input type="search" autocomplete="off" placeholder="Votre recherche..." name="s" value="<?= $controller->router()->params('s') ?>" class="form-control">
                <button class="btn btn-primary" type="submit" title="Rechercher">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>

    <section class="row my-5" id="articles">
        <?php
        foreach ($paginator->records() as $article) {
        ?>
            <div class="col-lg-4 article-item" id="">
                <article class="card mb-4 shadow">
                    <a href="<?= $controller->router()->hyp('article', ['slug' => $article->slug()]);?>">
                        <img src="<?= $article->profilePicture(); ?>" class="card-img-top" alt="Photo pour l'article <?=$article->get('label')?>">

                    </a>
                    <div class="card-body">
                        <?php
                        if(!empty($article->get('type_label'))){
                            ?>
                            <a href="<?= $controller->router()->hyp('article', ['slug' => $article->slug()]);?>" class="btn btn-sm btn-primary taxo-cat"><?= $article->get('type_label')?></a>
                            <?php
                        }
                        ?>
                        <a href="<?= $controller->router()->hyp('article', ['slug' => $article->slug()]);?>">
                            <p class="date otto-date"><?=$article->get('publication')?></p>
                            <h5 class="card-title"><?=$article->get('label')?></h5>
                            <span class="cta cta-card">Lire l'article</span>
                        </a>
                    </div>
                </article>
            </div>
        <?php
        }
        ?>
    </section>

    <?= $this->insert('Open::_partials/pagination', ['route' => 'articles', 'paginator' => $paginator]);?>
</div>