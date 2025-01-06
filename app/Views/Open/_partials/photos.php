<?php if (count($photos) > 1) { ?>
    <div class="row galerie">
        <h2 class="pb-0 line-left">Galerie photos</h2>
        <div class="slide dots single-post-slider">
            <?php
            foreach ($photos as $url) {
            ?>
                    <a class="mx-3" href="<?= $url ?>" data-lightbox="roadtrip">
                        <img class="img-galerie img-fluid w-100" src="<?= $url ?>" alt="">
                    </a>
            <?php
            }
            ?>
        </div>
    </div>
<?php
}
?>