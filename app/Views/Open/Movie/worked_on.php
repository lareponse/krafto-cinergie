<?php

foreach (['professional' => $professionals, 'organisation' => $organisations] as $route_name => $annuaire) {
    foreach ($annuaire as $item) {
        $href = $controller->router()->hyp($route_name, ['slug' => $item->slug()]);
?>
        <div class="row my-5" id="equipe-belge">

            <div class="logo-equipe col-lg-2">
                <a href="<?= $href ?>">
                    <img src="<?= $item->profilePicture() ?>" alt="Photo de profile de <?= $item; ?>" class="img-fluid w-100">
                </a>
            </div>
            <div class="titre-equipe col-lg-7">
                <h4><a href="<?= $href ?>"><?= $item; ?></a></h4>
            </div>
            <div class="distributeur col-lg-3">
                <p>
                    <?php
                    foreach ($item->praxisIds() as $id) {
                        echo '<span class="d-block otto-id-label" otto-urn="Tag:' . $id . '">' . $id . '</span>';
                    }
                    ?>
                </p>
            </div>
        </div>


<?php
    }
}
?>