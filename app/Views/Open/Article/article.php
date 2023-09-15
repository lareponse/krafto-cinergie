<?php $this->layout('Open::layout') ?>

<div class="container my-5 pb-5" id="article-single">
<div class="row">
    <img class="img-fluid mb-5" src="<?= $article->profilePicture();?>" alt="Photo de l'article <?= $article->get('label');?>" />

    <h2><?= $article->get('label');?></h2>

    <section class="row g-0 mb-5 col-lg-8 order-1 align-items-start">

        <div class="col-lg bg-light p-4 p-lg-5 text-justify">
            <?= $article->get('abstract');?>
        </div>

    </section>
    
    <aside id="meta" class="col-lg-3 mb-5 order-3 order-sm-3 order-md-3 order-lg-2 offset-lg-1 shadow">
        <ul class="meta-list">
            <?php if(!empty($article->get('type_label'))){
                ?>
                    <li class="type"><i class="bi bi-file-text icon"></i><?=$article->get('type_label')?></li>
                <?php
            }
            ?>
            <?php if(!empty($article->get('author_label'))){
                ?>
                    <li class=""><i class="bi bi-person-fill icon"></i></i>
                        <a href="#auteur-link"><?= $article->get('author_label');?></a>
                    </li>
                <?php
            }
            ?>
            <li class=""><i class="bi bi-calendar4 icon"></i></i><span class="otto-date"><?= $article->get('publication');?></span></li>
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
        <?= $article->get('content');?>

        <?= $this->insert('Open::_partials/share_bottom', ['label' => $article->get('label')]); ?>
    </section>
    

    <section class="row order-4 g-0 mt-5" id="related-posts">
    <div class="slide dots" id="single-post-slider">
        <article class="card paysage mr-4 mb-4">
  <div class="row g-0">
    <div class="col-md-4">
      <a href="article-single.php">
      <img src="https://www.cinergie.be/images/actualite/film/_0/1985/1985--4-.jpg"
        class="card-img-left img-fluid rounded-start" alt="...">
        </a>
    </div>

    <div class="col-md-8">
    <a href="article-single.php">
      <div class="card-body">
        <p class="date">16 janvier 2023</p>
        <h5 class="card-title">L'ambitieuse série 1985</h5>
        <a href="" class="cta">Lire l'article</a>
      </div>
    </a>
    </div>

  </div>
</article>

<article class="card paysage mr-4 mb-4">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="https://www.cinergie.be/images/actualite/film/_0/1985/1985--4-.jpg"
        class="card-img-left img-fluid rounded-start" alt="...">
    </div>

    <div class="col-md-8">
      <a href="article-single.php">
      <div class="card-body">
        <p class="date">16 janvier 2023</p>
        <h5 class="card-title">L'ambitieuse série 1985</h5>
        <a href="" class="cta">Lire l'article</a>
      </div>
      </a>
    </div>

  </div>
</article>

<article class="card paysage mr-4 mb-4">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="https://www.cinergie.be/images/actualite/film/_0/1985/1985--4-.jpg"
        class="card-img-left img-fluid rounded-start" alt="...">
    </div>

    <div class="col-md-8">
      <a href="article-single.php">
      <div class="card-body">
        <p class="date">16 janvier 2023</p>
        <h5 class="card-title">L'ambitieuse série 1985</h5>
        <a href="" class="cta">Lire l'article</a>
      </div>
      </a>
    </div>

  </div>
</article>

<article class="card paysage mr-4 mb-4">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="https://www.cinergie.be/images/actualite/film/_0/1985/1985--4-.jpg"
        class="card-img-left img-fluid rounded-start" alt="...">
    </div>

    <div class="col-md-8">
      <a href="article-single.php">
      <div class="card-body">
        <p class="date">16 janvier 2023</p>
        <h5 class="card-title">L'ambitieuse série 1985</h5>
        <a href="" class="cta">Lire l'article</a>
      </div>
      </a>
    </div>

  </div>
</article>

<article class="card paysage mr-4 mb-4">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="https://www.cinergie.be/images/actualite/film/_0/1985/1985--4-.jpg"
        class="card-img-left img-fluid rounded-start" alt="...">
    </div>

    <div class="col-md-8">
      <a href="article-single.php">
      <div class="card-body">
        <p class="date">16 janvier 2023</p>
        <h5 class="card-title">L'ambitieuse série 1985</h5>
        <a href="" class="cta">Lire l'article</a>
      </div>
      </a>
    </div>

  </div>
</article>    </div>
    </section>

</div>


</div>