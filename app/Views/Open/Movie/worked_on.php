<?php

foreach (['professional' => $professionals, 'organisation' => $organisations] as $route_name => $annuaire) {
    foreach ($annuaire as $item) {
        $href = $controller->router()->hyp($route_name, ['slug' => $item->slug()]);
?>
        <div class="row pb-5">

            <div class="logo-equipe col-lg-2">
                <a href="<?= $href ?>">
                    <img src="<?= $item->profilePicture() ?>" alt="Belfilm" class="img-fluid w-100">
                </a>
            </div>

            <div class="titre-equipe col-lg-7">
                <h4><a href="<?= $href ?>"><?= $item; ?></a></h4>
            </div>
            <div class="distributeur col-lg-3">
                <p><?= str_replace(', ', '<br>', $item->get('praxes')); ?></p>
            </div>
        </div>
<?php
    }
}
?>