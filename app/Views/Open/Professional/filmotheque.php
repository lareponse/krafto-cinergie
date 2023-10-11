<?php
if (!empty($movies)) {
?>
    <section class="my-5" id="filmographie">
        <h2 class="pb-0">Filmothèque</h2>
        <hr />
        <div id="filmotheque">
            <div class="slide arrow" id="single-post-slider">
                <?php
                foreach ($movies as $movie) {
                    $href = $controller->router()->hyp('movie', ['slug' => $movie->slug()]);
                ?>
                    <div class="col-lg-4" id="film-item">
                        <article class="card shadow">
                            <div class="card-body">
                                <a href="<?= $href ?>">
                                    <img src="<?= $movie->profilePicture() ?>" class="card-img-top mb-3" alt="...">
                                </a>
                                <div class="p-3">
                                    <a href="<?= $href ?>">
                                        <div class="meta">
                                            <p class="date"><small class="text-secondary"><?= $movie->get('released') ?></small></p>
                                            <p class="categorie"><small class="text-primary" otto-tag-id="<?= $movie->get('genre_id')?>"><?= $movie->get('genre_id')?></small></p>
                                        </div>
                                        <h5 class="card-title"><?= $movie ?></h5>
                                        <p class="auteur"><?= $movie->get('directors') ?></p>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
<?php
}
?>