<?php $this->layout('Open::layout') ?>

<div class="container pt-4 pb-5" id="auteur-single">
   <article class="w-75 mx-auto">

      <h1><?= $author->fullName()?></h1>
      <hr class="my-4">

      <div class="share" id="share">
         <span>Partager sur</span>
         <span class="socials">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="mx-1 bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-envelope-fill"></i></a>
         </span>
      </div>


      <section class="row g-0 mt-4">

         <div class="col-lg-5">
            <img class="img-fluid w-100" src="<?= $author->profilePicture()?>" alt="professionnel">
         </div>
         <?php
         if(isset($professional)){
            ?>
         <div class="col-lg-7 ps-lg-5" id="infos">
            <p class="text-primary"><strong><?= implode(', ', $professional->praxis());?></strong></p>
            <?= $this->insert('Open::_partials/contact_info', ['contact' => $professional]);?>
         </div>
            <?php
         }
         ?>

      </section>
   </article>

   <section class="my-5" id="related-posts">
      <h3 class="line-center articles-auteur my-4"><?= count($articles)?> articles rédigés par cet auteur</h3>

      <section class="row">
         <?php
         foreach($articles as $article){
            ?>
         <div class="col-lg-6">
            <article class="card shadow paysage mb-4">
               <a href="<?=$controller->router()->hyp('article', ['slug' => $article->slug()])?>">
                  <div class="row g-0">
                     <div class="col-md-4">
                        <img src="https://www.cinergie.be/<?=$article->get('legacy_photo_illu');?>" class="card-img-left img-fluid rounded-start" alt="...">
                     </div>
                     <div class="col-md-8">
                        <div class="card-body">
                           <p class="date otto-date"><?= $article->get('publication');?></p>
                           <h5 class="card-title"><?= $article->get('label');?></h5>
                           <p class="cta">Lire l'article</p>
                        </div>
                     </div>
                  </div>
               </a>
            </article>
         </div>
            <?php
         }
         ?>
         
      </section>
   </section>

</div>