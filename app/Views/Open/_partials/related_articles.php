<?php

if (!empty($related_articles)) {
?>
    <section class="my-5" id="related-posts">
        <h2 class="pb-0">Nos articles liés</h2>
        <hr />
        <div class="slide dots" id="single-post-slider">
            <?php
            foreach ($related_articles as $article) {
                $href = $controller->router()->hyp('article', ['slug' => $article->slug()]);
            ?>
                <article class="card paysage mr-4 mb-4">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <a href="<?= $href ?>">
                                <img src="<?= $article->profilePicture() ?>" class="card-img-left img-fluid rounded-start" alt="...">
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
    </section>
<?php
}
