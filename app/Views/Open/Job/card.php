<article class="card shadow listing mb-4">
    <div class="card-body">
        <div class="card-text d-flex justify-content-between">
            <nav class="mb-1">
                <a href="<?= $controller->router()->hyp('jobs') . '?' . http_build_query(['categories[]' => $job->get('category_id')]) ?>" class="type otto-id-label" otto-urn="Tag:<?= $job->get('category_id') ?>"><?= $job->get('category_id') ?></a>
                &bull; <a href="<?= $controller->router()->hyp('jobs') ?>?isPaid=<?= intval($job->get('isPaid') ) ?>" class="categorie mb-2"><?= $job_payment[$job->get('isPaid') ?  'job-paid' : 'job-free'] ?></a>
                &bull; <a href="<?= $controller->router()->hyp('jobs') ?>?isOffer=<?= intval($job->get('isOffer')) ?>" class="type"><?= $job_proposal[$job->get('isOffer') ? 'job-offer' : 'job-request']; ?></a>
            </nav>
            <small class="date-casting text-secondary otto-date" otto-format='{"day": "numeric","month": "short","year": "numeric"}'><?= $job->get('starts') ?></small>
        </div>
        <a href="<?= $controller->router()->hyp('job', ['slug' => $job->slug()]) ?>">
            <h5 class="card-title"><?= $job ?></h5>
            <p class="card-text text-primary text-end pe-3"><small class="cta">Lire l'annonce</small></p>
        </a>
    </div>
</article>