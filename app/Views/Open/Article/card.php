<article class="article-item card mb-4 shadow ">
    <a href="<?= $controller->router()->hyp('article', ['slug' => $article->slug()]); ?>">
        <img src="<?= $controller->defaultAvatar();?>" loading="lazy" data-src="<?= $controller->avatarFor($article, 'thumbnail') ?>" class="card-img-top" alt="<?= $article->get('label'); ?> - <?= $article->get('author_label'); ?>"" />
        <div class=" card-body">
        <?php if (!isset($showCategory) || $showCategory === true) { ?>
            <p class="btn btn-sm btn-primary taxo-cat otto-id-label" otto-urn="Tag:<?= $article->get('type_id'); ?>">Tag:<?= $article->get('type_id'); ?></p>
        <?php } ?>
        <p class="date otto-date"><?= $article->get('publication'); ?></p>
        <h5 class="card-title"><?= $article->get('label'); ?></h5>
        <span class="cta cta-card">Lire l'article</span>
        </div>
    </a>
</article>
