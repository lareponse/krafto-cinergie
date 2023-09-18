<?php 
$this->layout('Open::layout', ['title' => $page->get('label')]) 
?>

<div class="container my-5 pb-5" id="prix">

    <div class="row">
        <section class="row g-0 mb-5 col-lg-8 order-1 align-items-start">
            <div class="col-lg bg-light p-4 p-lg-5 text-justify">
                <?= $page->get('abstract'); ?>
            </div>
        </section>

        <aside id="meta" class="col-lg-3 mb-5 order-3 order-sm-3 order-md-3 order-lg-2 offset-lg-1 shadow">
    <ul class="meta-list">

        <div class="share" id="share">
            <span class="d-block">Partager sur</span>
            <span>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?=urlencode($controller->router()->url());?>&t=<?=urlencode($page->label())?>">
                    <i class="bi bi-facebook icon"></i></a>
                <a target="_blank" href="https://twitter.com/intent/tweet?url=<?=urlencode($controller->router()->url());?>&text=<?=urlencode($page->label())?>">
                    <img class="twitter" src="/public/assets/wejune/img/icons/twitter-r.svg">
                </a>
                <a href="mailto:email@example.com?subject=<?=urlencode($page->label())?>&body=<?=urlencode($controller->router()->url());?>">
                    <i class="bi bi-envelope-fill icon"></i></a>

                <a href="#"><i class="bi bi-instagram icon"></i></a>
            </span>
        </div>
        <div class="mt-4" id="print">
            <a onclick="window.print()" class="print"><i class="bi bi-printer-fill me-1"></i>Imprimer</a>
        </div>
    </ul>
</aside>

        <section class="w-75 mb-5 order-2 order-sm-2 order-md-2 order-lg-3 mx-auto text-justify">

            <?php echo $page->get('content'); ?>
            <?= $this->insert('Open::_partials/share_bottom', ['label' => $page->get('label')]); ?>

        </section>
    </div>
</div>