<article class="card shadow p-0 listing mb-3 px-lg-0 event-item">
    <a href="<?= $event->link() ?>">
        <div class="row g-0">
            <div class="col-2 date-item">
                <span><?= substr($event->get('starts'), -2, 2) ?></span>
                <span class="otto-date" otto-format='{"month":"short"}'><?= $event->get('starts') ?></span>
            </div>
            <div class="col-10">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span class="card-title otto-id-label" otto-urn="Tag:<?= $event->get('type_id'); ?>"><?= $event->get('type_id') ?></span>
                        <small class="card-text text-secondary">jusqu'au <span class="otto-date" otto-format='{"day": "numeric","month": "short","year": "numeric"}'><?= $event->get('stops'); ?></span></small>
                    </div>
                    <h5 class="card-title mb-2"><?= $event ?></h5>
                    <p class="card-text text-primary text-end pe-3"><small class="cta">En savoir plus</small></p>
                </div>
            </div>
        </div>
    </a>
</article>