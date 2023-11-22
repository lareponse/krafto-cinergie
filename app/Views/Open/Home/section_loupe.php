<section class="my-5" id="cinema-belge-loupe">
    <h2 class="line-left"><span class="text-primary">Le cin&eacute;ma belge</span> sous la loupe</h2>
    
    <div class="row">
    <?php
        foreach ($sousLaLoupe as $article) {
            $href = $controller->router()->hyp('article', ['slug' => $article->slug()]);

        ?>
            <div class="col-lg-4">
                <?= $this->insert('Open::Article/card', ['article' => $article]) ?>
            </div>
        <?php
        }
        ?>
    </div>

    <aside class="my-5 mx-auto text-center call-to-action">
        <p>
            <a class="cta" href="<?= $controller->router()->hyp('articles') ?>">Plus d'actualit&eacute;</a>
        </p>
    </aside>
</section>