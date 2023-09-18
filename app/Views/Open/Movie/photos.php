<div class="slide arrow" id="single-post-slider">
    <?php
    foreach ($photos as $url) {
    ?>
        <div class="col-lg-4">
            <a href="<?= $url ?>" data-lightbox="roadtrip">
                <img class="img-galerie img-fluid w-100" src="<?= $url ?>" alt="">
            </a>
        </div>
    <?php
    }
    ?>
</div>