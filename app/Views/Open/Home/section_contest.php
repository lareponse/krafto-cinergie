<section class="my-5" id="concours">
    <h2 class="line-left"><span class="text-primary">Concours</span> du moment</h2>
    <div class="container">
        <div id="concoursdm">
        <?php
        foreach ($contests as $contest) {
        ?>
            <div class="slide concours-item">
                <article class="card slide concours mx-1">
                    <a href="article-single.php">
                        <img src="<?= $controller->avatarFor($contest) ?>" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body px-4 py-3">
                        <p class="date">3 octobre 2022</p>
                        <h5 class="card-title"><?= $contest?></h5>
                        <a href="article-single.php" class="cta">Consulter</a>
                    </div>
                </article>
            </div>
        <?php
        }
        ?>
        </div>
    </div>
    <aside class="my-5 mx-auto text-center call-to-action">
        <p>
            <a class="cta" href="<?= $controller->router()->hyp('contests') ?>">Tous les concours</a>
        </p>
    </aside>
</section>