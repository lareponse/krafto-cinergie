<?php $this->layout('Open::layout') ?>

<div class="container my-5 pb-5" id="article-single">
  <div class="row">
    <img class="img-fluid mb-5" src="<?= $article->profilePicture(); ?>" alt="Photo de l'article <?= $article->get('label'); ?>" />

    <h2><?= $article->get('label'); ?></h2>

    <section class="row g-0 mb-5 col-lg-8 order-1 align-items-start">

      <div class="col-lg bg-light p-4 p-lg-5 text-justify">
        <?= $article->get('abstract'); ?>
      </div>

    </section>

    <aside id="meta" class="col-lg-3 mb-5 order-3 order-sm-3 order-md-3 order-lg-2 offset-lg-1 shadow">
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
            <a href="<?=$controller->router()->hyp('author', ['slug' => $article->get('author_slug')])?>"><?= $article->get('author_label'); ?></a>
          </li>
        <?php
        }
        ?>
        <li class=""><i class="bi bi-calendar4 icon"></i></i><span class="otto-date"><?= $article->get('publication'); ?></span></li>
        <hr>
        <div class="share" id="share">
          <span>Partager sur</span>
          <span class="socials">
            <a href="#"><i class="bi bi-facebook icon"></i></a>
            <a target="_blank" href="#">
              <img class="twitter" src="./assets/img/icons/twitter-r.svg">
            </a>
            <a href="#"><i class="bi bi-envelope-fill icon"></i></a>
            <a href="#"><i class="bi bi-instagram icon"></i></a>
            <a onclick="window.print()" class="print"><i class="bi bi-printer-fill me-1"></i>Imprimer</a>
          </span>
        </div>
      </ul>
    </aside>

    <section class="w-75 mb-5 order-2 order-sm-2 order-md-2 order-lg-3 mx-auto text-justify">
      <?= $article->get('content'); ?>

      <?= $this->insert('Open::_partials/share_print', ['label' => $article->get('label')]); ?>
    </section>


    <?= $this->insert('Open::_partials/related_articles', ['related_articles' => $related_articles ?? []]) ?>

  </div>


</div>