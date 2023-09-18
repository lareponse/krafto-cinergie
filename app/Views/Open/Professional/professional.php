<?php $this->layout('Open::layout') ?>


<div class="container my-5 pb-5" id="professionnel-single">
    <article class="w-75 mx-auto">

        <h1>Faustine Cros</h1>
        <hr class="my-4">

        <div class="share" id="share">
            <span>Partager sur</span>
            <span class="socials">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="mx-1 bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-envelope-fill"></i></a>
            </span>
        </div>

        <section class="row g-0 mt-4">

            <div class="col-lg-5">
                <img class="img-fluid w-100" src="https://www.cinergie.be/picture/personne/original/images/personne/_c/cros-faustine/photo.jpg" alt="professionnel">
            </div>

            <div class="col-lg-7 ps-lg-5" id="infos">
                <p class="text-primary"><b><span class="text-dark">Métier :</span> Monteuse image, Réalisatrice</b></p>
                <p><b>Ville :</b> 3000 Leuven</p>
                <p><b>Province :</b> Région flamande</p>
                <p><b>Pays :</b> Belgique</p>
                <p><b>Email :</b> faustine.cros2@gmail.com</p>
                <p><b>Date de naissance :</b> 17/12/1988</p>
                <p>
                    <a class="cta" href="https://www.youtube.com/watch?time_continue=1&amp;v=YhIgHXCJ7E8" target="_blank">
                        <b>Site web</b>
                    </a>
                </p>
            </div>
        </section>

        <section id="bio" class="my-5">
            <h2 class="pb-0">Biographie</h2>
            <hr>
            <p>
                Faustine Cros est une jeune monteuse et réalisatrice française établie en
                Belgique. Elle étudie le montage à l'INSAS. Dans son travail, elle joue
                avec des formes hybrides entre documentaire, fiction, expérimental,
                questionnant ainsi les genres et leur limites. Elle travaille comme
                monteuse sur de nombreux projets de court métrages, long métrages et clip.
                Son court métrage "La Détesteuse" fait avec ses films de famille, à fait
                le tour du monde dans de nombreux festivals. Actuellement elle développe
                son premier long métrage "La belle vie" inspiré de son film de fin
                d'étude, avec Julie Frère chez Dérives.
            </p>
        </section>

        <section class="row" id="galerie">
            <?= $this->insert('Open::_partials/slider_photo'); ?>
        </section>

        <section class="my-5" id="filmographie">
            <h2 class="pb-0">Filmographie</h2>
            <hr>
            <div id="filmotheque">
                <div class="slide arrow slick-initialized slick-slider" id="single-post-slider"><button class="slick-prev slick-arrow" aria-label="Previous" type="button" aria-disabled="false" style="">Previous</button>
                    <div class="slick-list draggable">
                        <div class="slick-track" style="opacity: 1; width: 1566px; transform: translate3d(-1044px, 0px, 0px); transition: transform 1000ms ease 0s;">
                            <div class="col-lg-4 slick-slide" id="film-item" data-slick-index="0" aria-hidden="true" tabindex="-1" style="width: 144px;">
                                <article class="card shadow">
                                    <div class="card-body">
                                        <a href="boutique-single.php" tabindex="-1">
                                            <img src="https://www.cinergie.be/images/film/_a/algorithms-of-beauty/algorithms-still-2.jpg" class="card-img-top mb-3" alt="...">
                                        </a>
                                        <div class="p-3">
                                            <a href="boutique-single.php" tabindex="-1">
                                                <div class="meta">
                                                    <p class="date"><small class="text-secondary">2022</small></p>
                                                    <p class="categorie"><small class="text-primary">Documentaire</small></p>
                                                </div>
                                                <h5 class="card-title">Algorithms of Beauty</h5>
                                                <p class="auteur">Milena Trivier</p>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="col-lg-4 slick-slide" id="film-item" data-slick-index="1" aria-hidden="true" tabindex="-1" style="width: 144px;">
                                <article class="card shadow">
                                    <div class="card-body">
                                        <a href="" tabindex="-1">
                                            <img src="https://www.cinergie.be/images/film/_i/interdit-aux-chiens-et-aux-italiens/luigi_et_cesira.jpg" class="card-img-top mb-3" alt="...">
                                        </a>
                                        <div class="p-3">
                                            <a href="boutique-single.php" tabindex="-1">
                                                <div class="meta">
                                                    <p class="date"><small class="text-secondary">2022</small></p>
                                                    <p class="categorie"><small class="text-primary">Animation</small></p>
                                                </div>
                                                <h5 class="card-title">Interdit aux chiens et aux italiens</h5>
                                                <p class="auteur">alain Ughetto</p>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="col-lg-4 slick-slide" id="film-item" data-slick-index="2" aria-hidden="true" tabindex="-1" style="width: 144px;">
                                <article class="card shadow">
                                    <div class="card-body">
                                        <a href="" tabindex="-1">
                                            <img src="https://www.cinergie.be/images/film/_b/bleu-du-caftan-le/le-bleu-du-caftan_02.jpg" class="card-img-top mb-3" alt="...">
                                        </a>
                                        <div class="p-3">
                                            <a href="boutique-single.php" tabindex="-1">
                                                <div class="meta">
                                                    <p class="date"><small class="text-secondary">2022</small></p>
                                                    <p class="categorie"><small class="text-primary">Fiction</small></p>
                                                </div>
                                                <h5 class="card-title">Le Bleu du caftan</h5>
                                                <p class="auteur">Maryam Touzani</p>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="col-lg-4 slick-slide" id="film-item" data-slick-index="3" aria-hidden="true" tabindex="0" style="width: 144px;">
                                <article class="card shadow">
                                    <div class="card-body">
                                        <a href="" tabindex="0">
                                            <img src="https://www.cinergie.be/images/film/_a/algorithms-of-beauty/algorithms-still-2.jpg" class="card-img-top mb-3" alt="...">
                                        </a>
                                        <div class="p-3">
                                            <a href="boutique-single.php" tabindex="0">
                                                <div class="meta">
                                                    <p class="date"><small class="text-secondary">2022</small></p>
                                                    <p class="categorie"><small class="text-primary">Documentaire</small></p>
                                                </div>
                                                <h5 class="card-title">Algorithms of Beauty</h5>
                                                <p class="auteur">Milena Trivier</p>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="col-lg-4 slick-slide" id="film-item" data-slick-index="4" aria-hidden="true" tabindex="0" style="width: 144px;">
                                <article class="card shadow">
                                    <div class="card-body">
                                        <a href="" tabindex="0">
                                            <img src="https://www.cinergie.be/images/film/_i/interdit-aux-chiens-et-aux-italiens/luigi_et_cesira.jpg" class="card-img-top mb-3" alt="...">
                                        </a>
                                        <div class="p-3">
                                            <a href="boutique-single.php" tabindex="0">
                                                <div class="meta">
                                                    <p class="date"><small class="text-secondary">2022</small></p>
                                                    <p class="categorie"><small class="text-primary">Animation</small></p>
                                                </div>
                                                <h5 class="card-title">Interdit aux chiens et aux italiens</h5>
                                                <p class="auteur">alain Ughetto</p>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="col-lg-4 slick-slide" id="film-item" data-slick-index="5" aria-hidden="true" tabindex="0" style="width: 144px;">
                                <article class="card shadow">
                                    <div class="card-body">
                                        <a href="" tabindex="0">
                                            <img src="https://www.cinergie.be/images/film/_b/bleu-du-caftan-le/le-bleu-du-caftan_02.jpg" class="card-img-top mb-3" alt="...">
                                        </a>
                                        <div class="p-3">
                                            <a href="boutique-single.php" tabindex="0">
                                                <div class="meta">
                                                    <p class="date"><small class="text-secondary">2022</small></p>
                                                    <p class="categorie"><small class="text-primary">Fiction</small></p>
                                                </div>
                                                <h5 class="card-title">Le Bleu du caftan</h5>
                                                <p class="auteur">Maryam Touzani</p>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="col-lg-4 slick-slide slick-current slick-active" id="film-item" data-slick-index="6" aria-hidden="false" tabindex="-1" style="width: 144px;">
                                <article class="card shadow">
                                    <div class="card-body">
                                        <a href="" tabindex="-1">
                                            <img src="https://www.cinergie.be/images/film/_a/algorithms-of-beauty/algorithms-still-2.jpg" class="card-img-top mb-3" alt="...">
                                        </a>
                                        <div class="p-3">
                                            <a href="boutique-single.php" tabindex="-1">
                                                <div class="meta">
                                                    <p class="date"><small class="text-secondary">2022</small></p>
                                                    <p class="categorie"><small class="text-primary">Documentaire</small></p>
                                                </div>
                                                <h5 class="card-title">Algorithms of Beauty</h5>
                                                <p class="auteur">Milena Trivier</p>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="col-lg-4 slick-slide slick-active" id="film-item" data-slick-index="7" aria-hidden="false" tabindex="-1" style="width: 144px;">
                                <article class="card shadow">
                                    <div class="card-body">
                                        <a href="" tabindex="-1">
                                            <img src="https://www.cinergie.be/images/film/_i/interdit-aux-chiens-et-aux-italiens/luigi_et_cesira.jpg" class="card-img-top mb-3" alt="...">
                                        </a>
                                        <div class="p-3">
                                            <a href="boutique-single.php" tabindex="-1">
                                                <div class="meta">
                                                    <p class="date"><small class="text-secondary">2022</small></p>
                                                    <p class="categorie"><small class="text-primary">Animation</small></p>
                                                </div>
                                                <h5 class="card-title">Interdit aux chiens et aux italiens</h5>
                                                <p class="auteur">alain Ughetto</p>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="col-lg-4 slick-slide slick-active" id="film-item" data-slick-index="8" aria-hidden="false" tabindex="-1" style="width: 144px;">
                                <article class="card shadow">
                                    <div class="card-body">
                                        <a href="" tabindex="-1">
                                            <img src="https://www.cinergie.be/images/film/_b/bleu-du-caftan-le/le-bleu-du-caftan_02.jpg" class="card-img-top mb-3" alt="...">
                                        </a>
                                        <div class="p-3">
                                            <a href="boutique-single.php" tabindex="-1">
                                                <div class="meta">
                                                    <p class="date"><small class="text-secondary">2022</small></p>
                                                    <p class="categorie"><small class="text-primary">Fiction</small></p>
                                                </div>
                                                <h5 class="card-title">Le Bleu du caftan</h5>
                                                <p class="auteur">Maryam Touzani</p>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>









                    <button class="slick-next slick-arrow slick-disabled" aria-label="Next" type="button" style="" aria-disabled="true">Next</button>
                </div>
            </div>
        </section>

        <div class="text-center">
            <a class="cta" data-bs-toggle="modal" data-bs-target="#modal-update-fiche-professionnel">
                Une erreur, une modification? Dites-le nous !
            </a>
            <!-- Modal -->
            <div class="modal fade" id="modal-update-fiche-professionnel" tabindex="-1" aria-labelledby="modal-update-fiche-professionnel-label" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modal-update-fiche-professionnel-label">Mise à jour de la fiche
                                professionnel</h1>
                            <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-5  text-start">
                            <p>

                                → Veuillez compléter les données
                                <br>
                                → Envoyez-nous votre photo par email à l'adresse <a href="mailto:info@cinergie.be">info@cinergie.be</a>
                                <br>
                                <strong>Cinergie vous remercie de votre collaboration!</strong>
                            </p>
                            <hr>
                            <form action="" class="form-horizontal" id="update-fiche-professionnel" method="post" role="form">

                                <section class="row mb-3">
                                    <label for="nom-fiche-professionnel" class="col-sm-2 col-form-label">Nom <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="nom" name="db-nom-fiche-professionnel" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="nom officiel de votre organisation" disabled="">
                                        <input type="text" id="nom" name="nom-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="nom officiel de votre organisation" required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="date-naiss-fiche-professionnel" class="col-sm-2 col-form-label">Date de naissance
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="date" id="date-naiss" name="db-date-naiss-fiche-professionnel" value="Ancienne valeur DB" class="form-control" disabled="">
                                        <input type="date" id="date-naiss" name="date-naiss-fiche-professionnel" value="" class="form-control" required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="adresse-fiche-professionnel" class="col-sm-2 col-form-label">Adresse
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="adresse" name="db-adresse-fiche-professionnel" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="rue, numéro, boîte" disabled="">
                                        <input type="text" id="adresse" name="adresse-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="rue, numéro, boîte" required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="cp-fiche-professionnel" class="col-sm-2 col-form-label">Code postal
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="cp" name="db-cp-fiche-professionnel" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="code postal..." disabled="">
                                        <input type="text" id="cp" name="cp-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="code postal..." required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="ville-fiche-professionnel" class="col-sm-2 col-form-label">Ville
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="ville" name="db-ville-fiche-professionnel" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="localité" disabled="">
                                        <input type="text" id="ville" name="ville-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="localité" required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="province-fiche-professionnel" class="col-sm-2 col-form-label">Province
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="province" name="db-province-fiche-professionnel" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="province..." disabled="">
                                        <input type="text" id="province" name="province-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="province..." required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="pays-fiche-professionnel" class="col-sm-2 col-form-label">Pays
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="pays" name="db-pays-fiche-professionnel" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="pays..." disabled="">
                                        <input type="text" id="pays" name="pays-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="pays..." required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="telephone-fiche-professionnel" class="col-sm-2 col-form-label">Téléphone
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="telephone" name="db-telephone-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="téléphone" disabled="">
                                        <input type="text" id="telephone" name="telephone-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="téléphone" required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="fax-fiche-professionnel" class="col-sm-2 col-form-label">Fax <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="fax" name="db-fax-fiche-professionnel" value="ancienne valeur DB" class="form-control" minlength="2" placeholder="fax..." disabled="">
                                        <input type="text" id="fax" name="fax-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="fax..." required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="gsm-fiche-professionnel" class="col-sm-2 col-form-label">Gsm <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="gsm" name="db-gsm-fiche-professionnel" value="ancienne valeur DB" class="form-control" minlength="2" placeholder="numéro de gsm" disabled="">
                                        <input type="text" id="gsm" name="gsm-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="numéro de gsm" required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="email-fiche-professionnel" class="col-sm-2 col-form-label">E-mail
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="email" id="email" name="db-email-fiche-professionnel" value="ancienne valeur DB" class="form-control" minlength="2" placeholder="adresse e-mail..." disabled="">
                                        <input type="email" id="email" name="email-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="adresse e-mail..." required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="site-fiche-professionnel" class="col-sm-2 col-form-label">Site
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="site" name="db-site-fiche-professionnel" value="ancienne valeur DB" class="form-control" minlength="2" placeholder="site web..." disabled="">
                                        <input type="text" id="site" name="site-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="site web..." required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="commentaire-fiche-professionnel" class="col-sm-2 col-form-label">Commentaire
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <textarea name="db-commentaire-fiche-professionnel" id="commentaire" class="form-control" rows="3" placeholder="Ancienne valeur DB" disabled=""></textarea>
                                        <textarea name="commentaire-fiche-professionnel" id="commentaire" class="form-control" rows="10" placeholder="détaillez vos métiers ici! indiquez une remarque et/ou demande que vous auriez concernant votre fiche professionnelle sur notre site..."></textarea>
                                    </div>
                                </section>


                                <section class="row">
                                    <p class="mb-0">
                                        <small>Les champs marqués
                                            <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont
                                            obligatoires</small>
                                    </p>
                                </section>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-primary" type="submit" name="submit-update-fiche-professionnel" value="Envoyer">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </article>
</div>