<footer>

    <div id="socials">
        <a class="home" href="<?= $controller->router()->hyp('home'); ?>">
            <img src="/public/assets/img/logo-cinergie.svg" alt="Logo CINERGIE" id="logo">
        </a>
        <h6 class="text-uppercase">
            Le site du cin&eacute;ma belge
        </h6>

        <hr>

        <nav>
            <a target="_blank" href="https://www.facebook.com/cinergie.be/">
                <i class="bi bi-facebook"></i>
            </a>

            <a target="_blank" href="https://twitter.com/cinergie">
                <i class="bi bi-twitter-x"></i>
            </a>

            <a target="_blank" href="https://www.youtube.com/channel/UCyKdwOw0TYnSUL_vZ1BJ7jA/videos">
                <i class="bi bi-youtube"></i>
            </a>
            <a target="_blank" href="https://www.instagram.com/cinergie.be/?hl=fr">
                <i class="bi bi-instagram"></i>
            </a>
            <a class="print">
                <i class="bi bi-printer-fill me-1"></i>
            </a>
        </nav>
    </div>

    <div id="sitemap">
        <nav>
            <ul>
                <li><a href="<?= $controller->router()->hyp('home'); ?>">Accueil</a></li>
                <li><a href="<?= $controller->router()->hyp('articles'); ?>">Articles</a></li>
                <li><a href="<?= $controller->router()->hyp('events'); ?>">Agenda</a></li>
                <li><a href="<?= $controller->router()->hyp('movies'); ?>">Filmoth&egrave;que</a></li>
                <li><a href="<?= $controller->router()->hyp('professionals'); ?>">Professionnels</a></li>
                <li><a href="<?= $controller->router()->hyp('organisations'); ?>">Organisations</a></li>
                <li><a href="<?= $controller->router()->hyp('jobs'); ?>">Castings & Jobs</a></li>
                <li><a href="<?= $controller->router()->hyp('shop'); ?>">Boutique</a></li>
            </ul>
        </nav>
        <nav>
            <ul>
                <li><a href="https://www.cinergie.be/podcast">Podcast</a></li>
                <li><a href="<?= $controller->router()->hyp('contests'); ?>">Les concours</a></li>
                <li><a href="<?= $controller->router()->hyp('authors'); ?>">Nos auteurs</a></li>
                <li><a href="<?= $controller->router()->hyp('history'); ?>">Notre histoire</a></li>
                <li><a href="<?= $controller->router()->hyp('price'); ?>"">Prix Cinergie</a></li>
                                <li><a href=" <?= $controller->router()->hyp('team'); ?>"">L'&eacute;quipe</a></li>
                <li><a href="<?= $controller->router()->hyp('contact'); ?>"">Contactez-nous</a></li>
            </ul>
        </nav>
    </div>

    <div>
        <?= $this->insert('Open::_partials/form_brevo') ?>

        <section>

            <h5 class=" text-left text-xl-end mt-5 text-uppercase">Nos partenaires</h5>
            <div id="partenaires">
                <a class="partenaire-item" href="https://www.maisondelafrancite.be/">
                    <img src="/public/assets/img/partenaires/logo_maison_de_la_francite.png" alt="Maison de la Francité" />
                </a>

                <a class="partenaire-item" href="https://be.brussels/">
                    <img src="/public/assets/img/partenaires/iris_bruxelles.png" alt="Région de Bruxelles-Capitale - Administration Economie et Emploi" />
                </a>

                <a class="partenaire-item" href="https://ccf.brussels/wp-signup.php?new=www.spfb.brussels">
                    <img src="/public/assets/img/partenaires/bruxelles-francophone.png" alt="Service public francophone bruxellois" />
                </a>

                <a class="partenaire-item" href="https://audiovisuel.cfwb.be/">
                    <img src="/public/assets/img/partenaires/logofwb.png" alt="Centre du Cinéma et de l'Audiovisuel de la Communauté Française" />
                </a>

                <a class="partenaire-item" href="https://lareponse.be">
                    <img src="/public/assets/img/partenaires/lareponse.png" alt="La Réponse" />
                </a>
            </div>
        </section>
    </div>
</footer>

<section id="copyright">
    <span class="mt-2">&copy; <?= date('Y') ?> Cinergie &nbsp; | &nbsp; <a href="<?= $controller->router()->hyp('legal') ?>">Mentions légales</a></span>
</section>