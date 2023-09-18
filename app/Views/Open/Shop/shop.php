<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>

<div class="container my-lg-5 pb-5" id="boutique">
    <ul class="nav nav-tabs align-items-end" id="boutiqueTabs">
        <li class="nav-item pb-0">
            <a href="#dvds" class="nav-link active" data-bs-toggle="tab"><i class="bi bi-disc-fill"></i>DVDs</a>
        </li>
        <li class="nav-item pb-0">
            <a href="#livres" class="nav-link" data-bs-toggle="tab"><i class="bi bi-book-fill"></i>Livres</a>
        </li>
        <li id="filtres-boutique" class="ms-lg-auto">
            <section class="row align-items-end">

                <div class="col-lg-6">

                </div>

                <div class="col-lg-6 mt-3 mt-lg-0">
                    <label class="form-label">Trier par</label>
                    <select class="form-select" name="categorie-boutique" id="filtreBoutique">
                        <option value="" selected>Titre</option>
                        <option value="">Réalisateurs</option>
                        <option value="">Sortie</option>
                    </select>
                </div>

            </section>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="dvds">
            <section class="row mt-4">
                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">1962</p>
                                    </div>
                                    <h5 class="card-title mb-3 titre-film">La Croix des vivants</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Yvan Govar</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-nouvelle-commande-dvd" tabindex="-1" aria-labelledby="modal-nouvelle-commande-label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="modal-nouvelle-commande-label">Nouvelle commande</h1>
                                                        <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-5">
                                                        <form action="" class="form-horizontal" id="nouvelle-commande" method="post" role="form">

                                                            <section class="row mb-3">
                                                                <div class="col-sm-10 titre-nouvelle-commande">
                                                                    <h2 id="titrefilm"></h2>
                                                                    <h3 id="prix-film"><span></span></h3>
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="nom-commande" class="col-lg-2 col-form-label">Nom <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="text" id="nom" name="nom-commande" value="" class="form-control" minlength="2" placeholder="votre nom..." required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="prenom-commande" class="col-lg-2 col-form-label">Prénom <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="text" id="prenom" name="prenom-commande" value="" class="form-control" minlength="2" placeholder="votre prénom..." required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="telephone-commande" class="col-lg-2 col-form-label">Téléphone <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="text" id="tel" name="telephone-commande" value="" class="form-control" minlength="2" placeholder="numéro de téléphone de contact..." required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="email-commande" class="col-lg-2 col-form-label">Email <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="email" id="email" name="email-commande" value="" class="form-control" minlength="2" placeholder="adresse mail de contact..." required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="adresse-commande" class="col-lg-2 col-form-label">Adresse <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="text" id="adresse" name="adresse-commande" value="" class="form-control" minlength="2" placeholder="rue, numéro, boîte" required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="cp-commande" class="col-lg-2 col-form-label">Code postal <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="text" id="cp" name="cp-commande" value="" class="form-control" minlength="2" placeholder="code postal..." required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="ville-commande" class="col-lg-2 col-form-label">Ville <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="text" id="ville" name="ville-commande" value="" class="form-control" minlength="2" placeholder="localité" required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="province-commande" class="col-lg-2 col-form-label">Province
                                                                    <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="text" id="province" name="province-commande" value="" class="form-control" minlength="2" placeholder="province..." required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="pays-commande" class="col-lg-2 col-form-label">Pays <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="text" id="pays" name="pays-commande" value="" class="form-control" minlength="2" placeholder="pays..." required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="commentaire-commande" class="col-lg-2 col-form-label">Commentaire
                                                                    <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <textarea name="commentaire-commande" id="commentaire" class="form-control" rows="10" placeholder="commentaire sur votre commande..."></textarea>
                                                                </div>
                                                            </section>

                                                            <section class="row">
                                                                <p class="mb-0">
                                                                    <small>Les champs marqués
                                                                        <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont
                                                                        obligatoires</small>
                                                                </p>
                                                            </section>
                                                            <div class="modal-footer">
                                                                <input class="btn btn-primary" type="submit" name="submit-nouvelle-annonce" value="Commander">
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">2000</p>
                                    </div>
                                    <h5 class="card-title mb-3">Titre 2</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Bouli</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">2001</p>
                                    </div>
                                    <h5 class="card-title mb-3">titre 3</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Auteur 3</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>
                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">1962</p>
                                    </div>
                                    <h5 class="card-title mb-3 titre-film">La Croix des vivants</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Yvan Govar</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">2000</p>
                                    </div>
                                    <h5 class="card-title mb-3">Titre 2</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Bouli</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">2001</p>
                                    </div>
                                    <h5 class="card-title mb-3">titre 3</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Auteur 3</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>
                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">1962</p>
                                    </div>
                                    <h5 class="card-title mb-3 titre-film">La Croix des vivants</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Yvan Govar</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">2000</p>
                                    </div>
                                    <h5 class="card-title mb-3">Titre 2</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Bouli</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">2001</p>
                                    </div>
                                    <h5 class="card-title mb-3">titre 3</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Auteur 3</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>
                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">1962</p>
                                    </div>
                                    <h5 class="card-title mb-3 titre-film">La Croix des vivants</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Yvan Govar</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">2000</p>
                                    </div>
                                    <h5 class="card-title mb-3">Titre 2</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Bouli</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">2001</p>
                                    </div>
                                    <h5 class="card-title mb-3">titre 3</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Auteur 3</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>
                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">1962</p>
                                    </div>
                                    <h5 class="card-title mb-3 titre-film">La Croix des vivants</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Yvan Govar</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">2000</p>
                                    </div>
                                    <h5 class="card-title mb-3">Titre 2</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Bouli</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">2001</p>
                                    </div>
                                    <h5 class="card-title mb-3">titre 3</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Auteur 3</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>
                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">1962</p>
                                    </div>
                                    <h5 class="card-title mb-3 titre-film">La Croix des vivants</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Yvan Govar</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">2000</p>
                                    </div>
                                    <h5 class="card-title mb-3">Titre 2</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Bouli</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="item-boutique col-12 col-md-6 col-lg-4">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/picture/film/600x/images/film/_c/croix-des-vivants-la/cover.jpg" class="img-fluid w-100 rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Fiction</p>
                                        <p class="date">2001</p>
                                    </div>
                                    <h5 class="card-title mb-3">titre 3</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Auteur 3</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-dvd">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">18 &euro;</span>
                                    </aside>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>
            </section>
        </div>
        <div class="tab-pane fade" id="livres">
            <section class="row mt-4 fBi">
                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-nouvelle-commande-livre" tabindex="-1" aria-labelledby="modal-nouvelle-commande-label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="modal-nouvelle-commande-label">Nouvelle commande</h1>
                                                        <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-5">
                                                        <form action="" class="form-horizontal" id="nouvelle-commande" method="post" role="form">

                                                            <section class="row mb-3">
                                                                <div class="col-sm-10 titre-nouvelle-commande">
                                                                    <h2>NOM DU LIVRE</h2>
                                                                    <h3><span>XX,xx€</span></h3>
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="nom-commande" class="col-lg-2 col-form-label">Nom <span>*</span></label>
                                                                <div class="ccol-lg-10">
                                                                    <input type="text" id="nom" name="nom-commande" value="" class="form-control" minlength="2" placeholder="votre nom..." required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="prenom-commande" class="col-lg-2 col-form-label">Prénom <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="text" id="prenom" name="prenom-commande" value="" class="form-control" minlength="2" placeholder="votre prénom..." required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="telephone-commande" class="col-lg-2 col-form-label">Téléphone <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="text" id="tel" name="telephone-commande" value="" class="form-control" minlength="2" placeholder="numéro de téléphone de contact..." required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="email-commande" class="col-lg-2 col-form-label">Email <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="email" id="email" name="email-commande" value="" class="form-control" minlength="2" placeholder="adresse mail de contact..." required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="adresse-commande" class="col-lg-2 col-form-label">Adresse <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="text" id="adresse" name="adresse-commande" value="" class="form-control" minlength="2" placeholder="rue, numéro, boîte" required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="cp-commande" class="col-lg-2 col-form-label">Code postal <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="text" id="cp" name="cp-commande" value="" class="form-control" minlength="2" placeholder="code postal..." required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="ville-commande" class="col-lg-2 col-form-label">Ville <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="text" id="ville" name="ville-commande" value="" class="form-control" minlength="2" placeholder="localité" required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="province-commande" class="col-lg-2 col-form-label">Province
                                                                    <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="text" id="province" name="province-commande" value="" class="form-control" minlength="2" placeholder="province..." required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="pays-commande" class="col-lg-2 col-form-label">Pays <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="text" id="pays" name="pays-commande" value="" class="form-control" minlength="2" placeholder="pays..." required="">
                                                                </div>
                                                            </section>

                                                            <section class="row mb-3">
                                                                <label for="commentaire-commande" class="col-lg-2 col-form-label">Commentaire
                                                                    <span>*</span></label>
                                                                <div class="col-lg-10">
                                                                    <textarea name="commentaire-commande" id="commentaire" class="form-control" rows="10" placeholder="commentaire sur votre commande..."></textarea>
                                                                </div>
                                                            </section>

                                                            <section class="row">
                                                                <p class="mb-0">
                                                                    <small>Les champs marqués
                                                                        <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont
                                                                        obligatoires</small>
                                                                </p>
                                                            </section>
                                                            <div class="modal-footer">
                                                                <input class="btn btn-primary" type="submit" name="submit-nouvelle-annonce" value="Commander">
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>
                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>
                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>
                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>
                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>
                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>

                <div class="col-12 col-md-6">
                    <article class="card shadow paysage boutique mb-4">
                        <div class="row g-0">

                            <div class="col-md-5">
                                <a href="boutique-single.php">
                                    <img src="https://www.cinergie.be/images/ventedvd/5d8e0c753b8e0_large.jpg" class="img-fluid rounded-start" alt="...">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="genre">Livre & Pub</p>
                                        <p class="date">2019</p>
                                    </div>
                                    <h5 class="card-title mb-3">Watermael-Boitsfort fait son cinéma</h5>
                                    <p class="author"><i class="bi bi-person-fill pe-1"></i>Mirko Popovitch</p>
                                    <aside class="input-group" id="commander-boutique">
                                        <button class="form-control" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-commande-livre">
                                            <i class="bi bi-cart-plus-fill"></i> </button>
                                        <span class="input-group-text" id="prix">30 &euro;</span>
                                    </aside>
                                    <small class="mt-3 frais">25€+5€ de frais d'envoi en Belgique ou 10€ en Europe</small>
                                </div>
                            </div>

                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>

</div>
<script>
    const compare = function(ids, asc) {
        return function(row1, row2) {
            const tdValue = function(row, ids) {
                return row.querySelector('.card-title').textContent;
            };

            const tri = function(v1, v2) {
                if (!isNaN(v1) && !isNaN(v2)) {
                    return asc ? v1.localeCompare(v2) : v2.localeCompare(v1);
                } else {
                    return asc ? v1.localeCompare(v2) : v2.localeCompare(v1);
                }
            };

            return tri(tdValue(row1, ids), tdValue(row2, ids));
        };
    };

    const selectElement = document.querySelector('#filtreBoutique');
    selectElement.addEventListener('change', function() {
        const container = document.querySelector('.tab-pane.show.active .row');
        const elementsToSort = Array.from(container.querySelectorAll('.item-boutique'));

        let classe = elementsToSort.sort(compare(0, true)); // Triez par le titre

        classe.forEach(function(element) {
            container.appendChild(element);
        });
    });
</script>