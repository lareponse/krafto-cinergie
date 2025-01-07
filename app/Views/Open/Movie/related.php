<?php
foreach ($articles as $item) {
        $href = $controller->router()->hyp('article', ['slug' => $item->slug()]);
?>
        <article class="card paysage mr-4 mb-4">
            <div class="row g-0">
                <div class="col-md-4">
                    <a href="<?= $href?>">
                        <img src="<?= $controller->avatarFor($item)?>" class="card-img-left img-fluid rounded-start" alt="...">
                    </a>
                </div>

                <div class="col-md-8">
                    <a href="article-single.php">
                        <div class="card-body">
                            <p class="date otto-date"><?= $item->get('publication') ?></p>
                            <h5 class="card-title"><?= $item; ?></h5>
                            <a href="<?= $href ?>" class="cta">Lire l'article</a>
                        </div>
                    </a>
                </div>

            </div>
        </article>
<?php
}
