<?php $this->layout('Open::layout') ?>


<div class="container">
    <?php
    if (!empty($entrevues)) {
        $this->insert('Open::Home/section_entrevue', ['entrevues' => $entrevues]);
    }

    if (!empty($contests)) {
        $this->insert('Open::Home/section_contest', ['contests' => $contests]);
    }

    if (!empty($sousLaLoupe)) {
        $this->insert('Open::Home/section_loupe', ['sousLaLoupe' => $sousLaLoupe]);
    }
    ?>
</div>
</div>

<div class="d-lg-block bg-light py-5 mt-5" id="home-rdv-annonce">
    <div class="container">
        <section class="row">
            <div class="col-lg-5">
                <h3 class="line-left overflow h4"><span class="text-primary">Vos rendez-vous</span><br>avec le cin&eacute;ma belge</h3>
                <?php
                foreach ($events as $event) {
                    echo $this->insert('Open/Event/card', ['event' => $event]);
                }
                ?>
                <aside class="my-5 call-to-action">
                    <a class="cta" href="<?= $controller->router()->hyp('events') ?>">Consulter l'agenda</a>
                </aside>
            </div>

            <div class="offset-lg-1 col-lg-5">
                <h3 class="line-left overflow h4"><span class="text-primary">Les petites annonces</span><br>du cin&eacute;ma belge</h3>
                <?php
                foreach ($jobs as $job) {
                    $this->insert('Open/Job/card', ['job' => $job]);
                }
                ?>
                <aside class="my-5 call-to-action">
                    <a class="cta" href="<?= $controller->router()->hyp('jobs') ?>">Plus d'annonces</a>
                </aside>
            </div>
        </section>
    </div>
</div>