<h3 class="line-left overflow h4">
    <span class="text-primary">Les petites annonces</span>
    <br>du cin&eacute;ma belge
</h3>
<?php
foreach ($jobs as $job) {
?>
    <article class="card listing mb-3">
        <a href="#">
            <div class="card-body">
                <h5 class="card-title"><?= $job ?></h5>
                <p class="card-text d-flex justify-content-between">
                    <span class="type"><?= $job->get('category_label'); ?></span>
                    <span class="text-primary otto-date"><?= $job->get('starts') ?></span>
                </p>
            </div>
        </a>
    </article>
<?php
}
?>

<aside class="my-5" id="call-to-action">
    <a class="cta" href="<?= $controller->router()->hyp('jobs') ?>">Plus d'annonces</a>
</aside>