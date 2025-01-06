<footer>

    <div id="branding">
        <a class="home" href="<?= $controller->router()->hyp('home'); ?>">
            <img src="/public/assets/img/logo-cinergie.svg" alt="Logo de Cinergie.be" class="logo" width="225" height="48">
        </a>
        <h6 class="text-uppercase">
            Le site du cin&eacute;ma belge
        </h6>

        <hr>

        <nav>
            <a target="_blank" href="https://www.facebook.com/cinergie.be/">
                <?= $this->bi('facebook') ?>
            </a>

            <a target="_blank" href="https://twitter.com/cinergie">
                <?= $this->bi('twitter') ?>
            </a>

            <a target="_blank" href="https://www.youtube.com/channel/UCyKdwOw0TYnSUL_vZ1BJ7jA/videos">
                <?= $this->bi('youtube') ?>
            </a>

            <a target="_blank" href="https://www.instagram.com/cinergie.be/?hl=fr">
                <?= $this->bi('instagram') ?>
            </a>

            <span class="print">
                <?= $this->bi('printer-fill') ?>
            </span>
        </nav>
    </div>

    <nav id="sitemap" role="navigation">
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

        <ul>
            <li><a href="<?= $controller->router()->hyp('glaneuses'); ?>">Podcast</a></li>
            <li><a href="<?= $controller->router()->hyp('contests'); ?>">Les concours</a></li>
            <li><a href="<?= $controller->router()->hyp('authors'); ?>">Nos auteurs</a></li>
            <li><a href="<?= $controller->router()->hyp('history'); ?>">Notre histoire</a></li>
            <li><a href="<?= $controller->router()->hyp('price'); ?>"">Prix Cinergie</a></li>
                            <li><a href=" <?= $controller->router()->hyp('team'); ?>"">L'&eacute;quipe</a></li>
            <li><a href="<?= $controller->router()->hyp('contact'); ?>"">Contactez-nous</a></li>
        </ul>
    </nav>

    <?= $this->insert('Open::_partials/form_brevo') ?>

    <section id=" partenaires">
                    <h5 class="text-uppercase">Nos partenaires</h5>
                    <nav>
                        <a class="partenaire-item francite" href="https://www.maisondelafrancite.be/" title="Maison de la Francité" arial-label="Maison de la Francité">
                            <span>Maison de la Francité</span>
                        </a>

                        <a class="partenaire-item iris" href="https://be.brussels/" title="Région de Bruxelles-Capitale - Administration Economie et Emploi" arial-label="Région de Bruxelles-Capitale - Administration Economie et Emploi">
                            <span>Région de Bruxelles-Capitale - Administration Economie et Emploi</span>
                        </a>

                        <a class="partenaire-item spfb" href="https://ccf.brussels/wp-signup.php?new=www.spfb.brussels" title="Service public francophone bruxellois" arial-label="Service public francophone bruxellois">
                            <span>Service public francophone bruxellois</span>
                        </a>

                        <a class="partenaire-item cfwb" href="https://audiovisuel.cfwb.be/" title="Centre du Cinéma et de l'Audiovisuel de la Communauté Française" arial-label="Centre du Cinéma et de l'Audiovisuel de la Communauté Française">
                            <span>Centre du Cinéma et de l'Audiovisuel de la Communauté Française</span>
                        </a>
                    </nav>
                    </section>

                    <section id="copyright">
                        &copy; <?= date('Y') ?> Cinergie &nbsp; | &nbsp; <a href="<?= $controller->router()->hyp('legal') ?>">Mentions légales</a> &nbsp; | &nbsp; <span class="text-primary cookie-preferences">Préférences cookies</span>
                    </section>
</footer>