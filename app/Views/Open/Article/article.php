<?php $this->layout('Open::layout'); ?>

<div class="container my-5 pb-5" id="article-single">

    <header <?= empty($article->get('embedVideo')) ? '' : 'class="thirdPartyContent" data-consent-template="primaryEmbedVideo"'; ?>>
        <img src="<?= $controller->bannerFor($article); ?>" alt="Couverture de l'article <?= $article; ?>" />
    </header>

    <h2><?= $article->get('label'); ?></h2>

    <div class="row">
        <div class="row g-0 mb-5 col-lg-8 align-items-start">
            <?php if (!empty($article->get('type_label'))) :?>

            <div class="bg-light p-4 p-lg-5 text-justify">
                <?= $article->get('abstract'); ?>
            </div>

            <?php endif;?>
        </div>



        <aside id="meta" class="col-lg-4 mb-5">
            <ul class="meta-list">
                <?php if (!empty($article->get('type_label'))) {
                ?>
                    <li class="type"><?= $this->bi('file-text'); ?> <?= $article->get('type_label') ?></li>
                <?php
                }
                ?>
                <?php if (!empty($article->get('writtenBy'))) {
                    // explode into arrays
                    $authors     = explode(',', $article->get('writtenBy'));
                    $authorSlugs = explode(',', $article->get('writtenBySlugs'));

                    // trim in case GROUP_CONCAT leaves spaces
                    $authors     = array_map('trim', $authors);
                    $authorSlugs = array_map('trim', $authorSlugs);
                ?>
                    <?php foreach ($authors as $i => $author): ?>
                        <li class="">
                            <?= $this->bi('person-fill'); ?>
                            <a href="<?= $controller->router()->hyp('author', ['slug' => $authorSlugs[$i]]) ?>">
                                <?= htmlspecialchars($author) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php } ?>

                <li class=""><?= $this->bi('calendar4', ['class' => 'me-2']); ?><span class="otto-date"><?= $article->get('publication'); ?></span></li>
            </ul>
            <hr>
            <?= $this->insert('Open::_partials/share_print', ['class' => 'compact', 'label' => $article->get('label')]); ?>

        </aside>

        <div class="w-75 mb-5 mx-auto text-justify">

            <article><?= $article->get('content'); ?></article>
            <hr>
            <?= $this->insert('Open::_partials/share_print', ['label' => $article->get('label')]); ?>

            <?= $this->insert('Open::_partials/related_content', ['related_content' => $related_content ?? []]) ?>

        </div>
    </div>
</div>


<script nonce="<?= $CSP_nonce ?>">
    //vanilla js to set the header background image to the article's profile picture
    // document.querySelector('#article-single header').style.backgroundImage = 'url("<?= $controller->avatarFor($article); ?>")';
</script>

<template id="primaryEmbedVideo">
    <div class="embedVideo"><?= $article->get('embedVideo'); ?></div>
</template>