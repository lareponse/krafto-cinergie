<?php
if (!empty($movies)) {
?>

    <div class="my-5 filmographie">
        <h2 class="pb-0">Filmothèque</h2>
        <hr />
        <div class="filmotheque">
            <div class="slide dots single-post-slider">
                <?php
                foreach ($movies as $movie) {
                    $href = $controller->router()->hyp('movie', ['slug' => $movie->slug()]);
                ?>
                    <article class="card paysage mr-4 mb-4">
                        <div class="film-item">
                            <?= $this->insert('Open::Movie/card', ['record' => $movie]) ?>
                        </div>
                    </article>

                <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php
}
?>