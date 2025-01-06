<section class="my-5" id="entrevues-filmees">
    <h2 class="line-left"><span class="text-primary">Entrevues</span> filmées</h2>
    <div class="row">
    <?php
        foreach ($entrevues as $article) {
            $href = $controller->router()->hyp('article', ['slug' => $article->slug()]);
        ?>
            <div class="col-lg-4">
                <?= $this->insert('Open::Article/card', ['article' => $article, 'showCategory' => false]) ?>
            </div>
        <?php
        }
        ?>
    </div>
    <aside class="my-5 mx-auto text-center call-to-action">
        <a class="cta" href="<?= $controller->router()->hyp('articles') ?>?<?= http_build_query(['ac[]' => '50']) ?>">Plus d'entrevues</a>
    </aside>
</section>