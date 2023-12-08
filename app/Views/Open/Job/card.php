<article class="card shadow listing mb-4">
    <a href="<?= $controller->router()->hyp('job', ['slug' => $job->slug()]) ?>">
        <div class="card-body">
            <div class="card-text d-flex justify-content-between">
                <nav class="mb-1">
                    <span class="type otto-id-label" otto-urn="Tag:<?= $job->get('category_id') ?>"><?= $job->get('category_id') ?></span>
                    &bull; <span class="categorie mb-2"><?= $job->get('isPaid') ?  $job_payment['job-paid'] : $job_payment['job-free'] ?></span>
                    &bull; <span class="type"><?= $job->get('isOffer') ? $job_proposal['job-offer'] : $job_proposal['job-request']; ?></span>
                </nav>
                <small class="date-casting text-secondary otto-date" otto-format='{"day": "numeric","month": "short","year": "numeric"}'><?= $job->get('starts') ?></small>
            </div>
            <h5 class="card-title"><?= $job ?></h5>
            <p class="card-text text-primary text-end pe-3"><small class="cta">Lire l'annonce</small></p>
        </div>
    </a>
</article>