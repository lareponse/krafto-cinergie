<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->get('label')]) ?>

<div class="container mb-5">
    <section class="row " id="concours">
        <?php 
        if(empty($contests)){
            echo Marker::strong($page->get('content'), ['class' => 'text-center text-primary my-5']);
        }
        else{

            foreach ($contests as $contest) {
                ?>
            <div class="col-lg-4 col-md-6 my-5" id="concours-item">
                <article class="card concours mx-1">
                    <a href="<?=$controller->router()->hyp('contest', ['slug' => $contest->slug()])?>">
                        <img src="<?=$contest->profilePicture()?>" class="card-img-top" alt="Photo du concours <?=$contest->get('label')?>" />
                    </a>
                    <div class="card-body px-4 py-3">
                        <p class="date otto-date"><?=$contest->get('starts')?></p>
                        <h5 class="card-title"><?=$contest->get('label')?></h5>
                        <a href="<?=$controller->router()->hyp('contest', ['slug' => $contest->slug()])?>" class="cta">Consulter</a>
                    </div>
                </article>
            </div>
            <?php
            }
        }
        ?>
    </section>
</div>