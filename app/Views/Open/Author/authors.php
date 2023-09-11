<?php $this->layout('Open::layout', ['title' => $page->get('label')]) ?>


<div class="container my-5">
    <section class="row">

        <div class="col-lg-8 offset-lg-2">
            <section class="row my-5 pb-5" id="auteurs">
                <?php foreach ($authors as $author) {
                ?>
                    <div class="col-lg-3 col-md-6" id="auteur-item">
                        <article class="card mb-4 shadow">
                            <a href="<?= $controller->router()->hyp('author', ['slug' => $author->slug()]);?>">
                                <div class="card-body">
                                <img src="<?= $author->profilePicture();?>" class="card-img-top mb-3" alt="Photo de <?= $author->fullName()?>">
                                    <div class="p-3">
                                        <h5 class="card-title"><?=$author->fullName();?></h5>
                                        <p class="card-text"><small class="text-secondary">Réalisatrice</small></p>
                                    </div>
                                </div>
                            </a>
                        </article>
                    </div>
                <?php
                }
                ?>
            </section>
        </div>
    </section>
</div>