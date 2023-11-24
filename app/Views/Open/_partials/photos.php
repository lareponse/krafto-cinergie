<?php if (count($photos) > 1) { ?>
<div class="row" id="galerie">
    <h2 class="pb-0">Galerie photos</h2>
    <hr />
    <div class="slide arrow single-post-slider">
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
</div>
<?php
}
?>