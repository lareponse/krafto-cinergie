<a href="<?= htmlspecialchars($event->link(), ENT_QUOTES, 'UTF-8') ?>">
    <article class="event shadow p-0 listing mb-3 px-lg-0">
        <div class="date-item">
            <span><?= htmlspecialchars(substr($event->get('starts'), -2, 2), ENT_QUOTES, 'UTF-8') ?></span>
            <span class="otto-date text-uppercase" otto-format='{"month":"short"}'><?= htmlspecialchars($event->get('starts'), ENT_QUOTES, 'UTF-8') ?></span>
        </div>

        <div>
            <strong class="otto-id-label" otto-urn="Tag:<?= htmlspecialchars($event->get('type_id'), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($event->get('type_id'), ENT_QUOTES, 'UTF-8') ?></strong>
            <h5><?= htmlspecialchars($event, ENT_QUOTES, 'UTF-8') ?></h5>
            <div class="details">
                <small>jusqu'au <span class="otto-date" otto-format='{"day": "numeric","month": "long","year": "numeric"}'><?= htmlspecialchars($event->get('stops') ?? '', ENT_QUOTES, 'UTF-8') ?></span></small>
                <small class="cta">En savoir plus</small>
            </div>
        </div>
    </article>
</a>