<div id="listing-actu">
    <h2 class="h4 mb-4">Les dernières actualités</h2>
    <?php foreach ($articles as $article) {
    ?>
        <article class="card shadow paysage mb-4">
            <a href="<?= $controller->router()->hyp('article', ['slug' => $article->slug()]); ?>">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= $article->profilePicture(); ?>" class="card-img-left img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="date otto-date"><?= $article->get('publication'); ?></p>
                            <h5 class="card-title"><?= $article->get('label'); ?></h5>
                            <p class="cta">Lire notre <span class="otto-id-label" otto-urn="Tag:<?= $article->get('type_id') ?>"> article</span></p>
                        </div>
                    </div>
                </div>
            </a>
        </article>
    <?php
    }
    ?>

</div>