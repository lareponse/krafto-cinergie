<?php
$this->layout('Open::layout', ['title' => $page->get('label')]);

?>

<div id="contact-area">
    <div class="container" id="contact">
        <div class="row bg-white shadow">
            <div class="col-lg-6 contact-wrap">
                <h2>Cinergie.be ASBL</h2>

                <h3><?= $this->bi('geo-alt-fill'); ?>Adresse</h3>
                <p>Maison de la Francité</p>
                <p><?= $cinergie->get('street'); ?></p>
                <p class="mb-4"><?= $cinergie->get('zip'); ?> <?= $cinergie->get('city'); ?></p>

                <h3><?= $this->bi('envelope-fill'); ?>Email</h3>
                <a class="mb-4 d-inline-block" href="mailto:<?= $cinergie->get('email'); ?>"><?= $cinergie->get('email'); ?></a>

                <h3><?= $this->bi('telephone-fill') ?>Téléphone</h3>
                <a class="mb-4 d-inline-block" href="tel:<?= $cinergie->get('tel'); ?>"><?= $cinergie->get('tel'); ?></a>

                <div class="d-flex justify-content-between mt-3">
                    <h3>TVA</h3>
                    <p>BE 448655484</p>
                </div>

                <div class="d-flex justify-content-between">
                    <h3>N° d'entreprise</h3>
                    <p>448655484</p>
                </div>

                <div class="d-flex justify-content-between">
                    <h3>IBAN</h3>
                    <p>BE10 0012 4446 1904</p>
                </div>
            </div>

            <div class="col-lg-6 px-0">
                <a href="https://www.google.com/maps/place/Cinergie/@50.8471385,4.3700846,685m/data=!3m1!1e3!4m6!3m5!1s0x47c3c46473edbda1:0x7b4e6935f3f34fb8!8m2!3d50.8468541!4d4.3699327!16s%2Fg%2F1vd70h48?entry=ttu&g_ep=EgoyMDI1MDQxNC4xIKXMDSoASAFQAw%3D%3D" class="map-wrap"></a>
            </div>
        </div>
    </div>
</div>
</div>