<article class="card mb-4 shadow">

    <a href="article-single.php">
        <img src="<?= $article->profilePicture() ?>" class="card-img-top" alt="<?= $article->get('label'); ?> - <?= $article->get('author_label'); ?>"" />
        <div class="card-body">
            <p class="btn btn-sm btn-primary taxo-cat">Catégorie</p>
            <p class="date otto-date"><?= $article->get('publication'); ?></p>
            <h5 class="card-title"><?= $article->get('label'); ?></h5>
            <span class="cta cta-card">Lire l'article</span>
        </div>
    </a>
</article>