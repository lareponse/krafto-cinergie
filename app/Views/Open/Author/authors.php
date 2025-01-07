<?php $this->layout('Open::layout', ['title' => $page->get('label')]) ?>
<div class="container">
    <div class="row my-5 pb-5 auteurs">
        <?php foreach ($authors as $author) { ?>
            <div class="col-lg-3 col-md-6 auteur-item">
                <article class="card mb-4 shadow">
                    <a href="<?= $controller->router()->hyp('author', ['slug' => $author->slug()]); ?>">
                        <div class="card-body">
                            <img src="<?= $controller->avatarFor($author); ?>" class="card-img-top mb-3" alt="Photo de <?= $author->fullName() ?>" />
                            <div class="p-3">
                                <h5 class="card-title text-center"><?= $author->fullName(); ?></h5>
                            </div>
                        </div>
                    </a>
                </article>
            </div>
        <?php } ?>
    </div>
</div>