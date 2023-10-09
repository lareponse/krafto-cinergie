<footer id="footer" class="text-center text-lg-start px-3 px-lg-0">
    <div class="container">

        <section class="row">
            <div class="col-lg-3">
                <p>
                    <a href="<?=$controller->router()->hyp('home');?>">
                        <img src="/public/assets/img/logo-cinergie.svg" alt="Logo CINERGIE" id="logo">
                    </a>
                </p>
                <h6 class="text-uppercase">
                    Le site du cin&eacute;ma belge
                </h6>

                <hr>

                <p>
                    <a target="_blank" href="https://www.facebook.com/cinergie.be/">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a target="_blank" href="https://twitter.com/cinergie">
                        <img class="twitter" src="/public/assets/img/twitter.svg">
                    </a>
                    <a target="_blank" href="https://www.youtube.com/channel/UCyKdwOw0TYnSUL_vZ1BJ7jA/videos">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a target="_blank" href="https://www.instagram.com/cinergie.be/?hl=fr">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a onclick="window.print()" class="print">
                        <i class="bi bi-printer-fill me-1"></i>
                    </a>
                </p>
            </div>

            <div class="col-lg-5">
                <section class="row" id="liens-utiles">
                    <div class="col-lg-6">
                        <nav class="navigation-footer">
                            <ul>
                                <li><a href="<?=$controller->router()->hyp('home');?>">Accueil</a></li>
                                <li><a href="<?=$controller->router()->hyp('articles');?>">Articles</a></li>
                                <li><a href="<?=$controller->router()->hyp('events');?>">Agenda</a></li>
                                <li><a href="<?=$controller->router()->hyp('movies');?>">Filmoth&egrave;que</a></li>
                                <li><a href="<?=$controller->router()->hyp('professionals');?>">Professionnels</a></li>
                                <li><a href="<?=$controller->router()->hyp('organisations');?>">Organisations</a></li>
                                <li><a href="<?=$controller->router()->hyp('jobs');?>">Castings & Jobs</a></li>
                                <li><a href="<?=$controller->router()->hyp('shop');?>">Boutique</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-6">
                        <nav class="navigation-footer">
                            <ul>
                                <li><a href="https://www.cinergie.be/podcast">Podcast</a></li>
                                <li><a href="<?=$controller->router()->hyp('contests');?>">Les concours</a></li>
                                <li><a href="<?=$controller->router()->hyp('authors');?>">Nos auteurs</a></li>
                                <li><a href="<?=$controller->router()->hyp('history');?>">Notre histoire</a></li>
                                <li><a href="<?=$controller->router()->hyp('price');?>"">Prix Cinergie</a></li>
                                <li><a href="<?=$controller->router()->hyp('team');?>"">L'&eacute;quipe</a></li>
                                <li><a href="<?=$controller->router()->hyp('contact');?>"">Contactez-nous</a></li>
                            </ul>
                        </nav>
                    </div>
                </section>
            </div>

            <div class="col-lg-4">
                <?= $this->insert('Open::_partials/form_brevo')?>

                <h5 class="text-center text-lg-end mt-5 text-uppercase">
                    Nos partenaires
                </h5>
                <section id="partenaires">
                    <a class="partenaire-item" href="https://www.maisondelafrancite.be/">
                        <img src="/public/assets/img/partenaires/logo_maison_de_la_francite.png" alt="Maison de la Francité" />
                    </a>
                    <a class="partenaire-item" href="https://be.brussels/">
                        <img src="/public/assets/img/partenaires/iris_bruxelles.jpeg" alt="Région de Bruxelles-Capitale - Administration Economie et Emploi" />
                    </a>
                    <a class="partenaire-item" href="https://ccf.brussels/wp-signup.php?new=www.spfb.brussels">
                        <img src="/public/assets/img/partenaires/bruxelles-francophone.gif" alt="Service public francophone bruxellois" />
                    </a>
                    <a class="partenaire-item" href="https://audiovisuel.cfwb.be/">
                        <img src="/public/assets/img/partenaires/logofwb.jpeg" alt="Centre du Cinéma et de l'Audiovisuel de la Communauté Française" />
                    </a>
        <?php
        /*            <a class="partenaire-item" href="https://lareponse.be">
                        <img src="https://avatars.githubusercontent.com/u/20891495?v=4" alt="La Réponse" />
                    </a>
                    */?>
                </section>
            </div>
        </section>

        <section id="copyright" class="w-75 mx-auto">
            <span class="mt-2">&copy; <?= date('Y')?> Cinergie &nbsp; | &nbsp; <a href="<?= $controller->router()->hyp('legal')?>">Mentions légales</a></span>
        </section>

    </div>




</footer>