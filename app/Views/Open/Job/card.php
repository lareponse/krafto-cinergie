<article class="card shadow listing mb-4">
    <a href="<?= $controller->router()->hyp('job', ['slug' => $work->slug()]) ?>">
        <div class="card-body">
            <div class="card-text d-flex justify-content-between">
                <p>
                    <span class="type"><?= $work->get('category_label') ?></span>
                    <span class="categorie mb-2">&bull; <?= $work->get('isPaid') ? 'Rémunéré' : 'Non rémunéré' ?></span> 
                    <span class="type"> &bull;  <?= $work->get('isOffer') ? $job_proposal['job-offer'] : $job_proposal['job-request']; ?></span></p>
            </p>

                <p><span class="date-casting text-primary otto-date"><?= $work->get('starts') ?></span></p>
            </div>
            <h5 class="card-title"><?= $work->get('label'); ?></h5>
            <p class="cta">Lire l'annonce</p>
        </div>
    </a>
</article>