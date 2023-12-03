<article class="card concours mx-1">
    <a href="<?= $controller->router()->hyp('contest', ['slug' => $contest->slug()]) ?>">
        <img src="/public/<?= $contest->profilePicture() ?>" class="card-img-top" alt="Photo du concours <?= $contest->get('label') ?>" />
    </a>
    <div class="card-body px-4 py-3">
        <p class="date otto-date"><?= $contest->get('starts') ?></p>
        <h5 class="card-title"><?= $contest->get('label') ?></h5>
        <a href="<?= $controller->router()->hyp('contest', ['slug' => $contest->slug()]) ?>" class="cta">Consulter</a>
    </div>
</article>