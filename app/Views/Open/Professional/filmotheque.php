<?php
if (!empty($movies)) {
?>

    <div class="my-5 filmographie">
        <h2 class="pb-0">Filmothèque</h2>
        <hr />
        <div class="filmotheque">
            <div class="slide arrow single-post-slider">
            <?php
                foreach ($movies as $movie) {
                    $href = $controller->router()->hyp('movie', ['slug' => $movie->slug()]);
            ?>

                <div class="col-lg-4 film-item">
                    
                <?= $this->insert('Open::Movie/card', ['record' => $movie]) ?>

                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php
}
?>