<article class="card shadow p-0 listing mb-3 px-lg-0">
    <a href="<?= $event->link() ?>">
        <div class="row g-0">
            <div class="col-2 date-item">
                <span><?= substr($event->get('starts'), -2, 2) ?></span>
                <span class="otto-date text-uppercase" otto-format='{"month":"short"}'><?= $event->get('starts') ?></span>
            </div>

            <div class="col-10">
                <div class="card-body">
                    <h6 class="card-title otto-id-label" otto-urn="Tag:<?= $event->get('type_id'); ?>"><?= $event->get('type_id') ?></span>
                        <h5 class="card-title mb-0"><?= $event ?></h5>
                        <div class="details">
                            <p class="card-text text-secondary"><small>jusqu'au <span class="otto-date" otto-format='{"day": "numeric","month": "long","year": "numeric"}'><?= $event->get('stops'); ?></span></small></p>
                            <p class="card-text cta"><small>En savoir plus</small></p>
                        </div>
                </div>
            </div>
        </div>
    </a>
</article>