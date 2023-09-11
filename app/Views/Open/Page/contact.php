<?php $this->layout('Open::layout', ['title' => $page->get('label')]) ?>

<main id="contact-area">
    <div class="container" id="contact">
        <section class="row bg-white shadow">
            <div class="col-lg-6 contact-wrap">
                <h2>Cinergie.be ASBL</h2>

                <h3><i class="bi bi-geo-alt-fill"></i>Adresse</h3>
                <p>Maison de la Francité</p>
                <p><?= $cinergie->get('street'); ?></p>
                <p class="mb-4"><?= $cinergie->get('zip'); ?> <?= $cinergie->get('city'); ?></p>

                <h3><i class="bi bi-envelope-fill"></i>Email</h3>
                <a class="mb-4 d-inline-block" href="mailto:<?= $cinergie->get('email'); ?>"><?= $cinergie->get('email'); ?></a>

                <h3><i class="bi bi-telephone-fill"></i>Téléphone</h3>
                <a class="mb-4 d-inline-block" href="tel:<?= $cinergie->get('tel'); ?>"><?= $cinergie->get('tel'); ?></a>

                <h3>TVA</h3>
                <p class="mb-4"><?= $cinergie->get('TVA'); ?></p>

                <h3>N° d'entreprise</h3>
                <p class="mb-4"><?= $cinergie->get('numero_entreprise'); ?></p>

                <h3>IBAN</h3>
                <p><?= $cinergie->get('IBAN'); ?></p>
            </div>

            <div class="col-lg-6 px-0">
                <div class="map-wrap">
                    <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2519.1815057838608!2d4.368381215736397!3d50.84632307953197!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3c482b3ed252b%3A0x55f1f2ac34267037!2sMaison%20de%20la%20Francit%C3%A9%20ASBL!5e0!3m2!1sfr!2sbe!4v1676372527065!5m2!1sfr!2sbe" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>

    </div>
</main>