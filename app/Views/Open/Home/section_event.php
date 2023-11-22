<h3 class="line-left overflow h4">
    <span class="text-primary">Vos rendez-vous</span>
    <br>avec le cin&eacute;ma belge
</h3>
<?php
foreach ($events as $event) {
?>
    <article class="card listing mb-3">
        <a href="#">
            <div class="row g-0">
                <div class="col-md-4 date-item">
                    <span><?= substr($event->get('starts'), -2, 2) ?></span>
                    <span>MMM</span>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $event->get('label') ?></h5>
                        <p class="card-text">jusqu'au <span class="text-primary otto-date"><?= $event->get('stops') ?></span></p>
                    </div>
                </div>
            </div>
        </a>
    </article>
<?php
}
?>
<aside class="my-5" id="call-to-action">
    <a class="cta" href="<?= $controller->router()->hyp('events') ?>">Consulter l'agenda</a>
</aside>