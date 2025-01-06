<?php $this->layout('Open::layout', ['title' => "Toute l'actualité du cinéma belge"]) ?>
<div class="container">
    <div class="mx-auto my-5 w-75">
        <?= $this->insert('Open::Article/form_search', [
                'action' => $controller->router()->hyp('articles'),
                'value' => $controller->router()->params('s')
        ]) ?>
    </div>

    <div class="row my-5" id="articles">
        <?php
        foreach ($paginator->records() as $article) {
        ?>
            <div class="col-lg-4">
                <?= $this->insert('Open::Article/card', ['article' => $article]) ?>
            </div>
        <?php
        }
        ?>
    </div>
<?= $this->insert('Open::_partials/pagination', ['route' => 'articles', 'paginator' => $paginator]); ?>
</div>
