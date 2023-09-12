<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout') ?>

<div class="container my-5 pb-5" id="casting-single">

    <section class="row">

        <div class="col-lg-7">

            <span class="prefix">Annonce</span>
            <h2><?= $work; ?></h2>
            <?= $work->get('content'); ?>
        </div>

        <div class="offset-lg-1 col-lg-4">
            <div class="row">
                <button type="button" class="btn btn-outline-primary add-btn order-2 order-sm-2 order-md-1 my-5" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-annonce">
                    <i class="bi bi-plus-circle"></i>Ajoutez votre annonce
                </button>
                <!-- Modal -->
                <?= $this->insert('Open::Work/modal_new'); ?>

                <aside id="meta" class="shadow order-1 order-sm-1 order-md-2">

                    <ul class="meta-list">
                        <li class="meta-head">
                            <span><i class="bi bi-bookmarks-fill icon"></i>Catégorie :</span>
                            <span><a href="<?= $controller->router()->hyp('works')?>?types%5B%5D=demande">Demande</a></span>
                        </li>
                        <li class="meta-head">
                            <span><i class="bi bi-bookmarks-fill icon"></i>Type :</span>
                            <span><a href="#"><?= $work->get('type_label') ?></a></span>
                        </li>
                        <li class="meta-head">
                            <span><i class="bi bi-bookmarks-fill icon"></i>Rémunéré :</span>
                            <span><a href="#"><?= empty($work->get('isPaid')) ? 'Non rémunéré' : 'Rémunéré'; ?></a></span>
                        </li>
                        <li class="meta-head-date "><i class="bi bi-calendar-event icon"></i><span class="otto-date"><?= $work->get('starts') ?></span></li>
                        <hr>

                        <?php if (!empty($work->get('ends'))) { ?>
                        <li class="meta-el">
                            <span><i class="bi bi-calendar-check icon"></i>Date de fin :</span>
                            <strong class="otto-date"><?= $work->get('ends') ?></strong>
                        </li>
                        <?php
                        }
                        ?>

                        <?php if (!empty($work->get('identity'))) { ?>
                            <li class="meta-el"><span><i class="bi bi-megaphone-fill icon"></i>Annonceur :</span>
                                <strong><?= $work->get('identity') ?></strong>
                            </li>
                        <?php
                        }
                        ?>
                        <?php if (!empty($work->get('phone'))) {?>
                            <li class="meta-el"><span><i class="bi bi-telephone-fill icon"></i>Téléphone :</span>
                                <strong><?= $work->get('phone') ?></strong>
                            </li>
                        <?php
                        }
                        ?>
                        <?php if (!empty($work->get('email'))) {?>
                            <li class="meta-el"><span><i class="bi bi-envelope icon"></i>Email :</span>
                                <strong><?= $work->get('email') ?></strong>
                            </li>

                        <?php
                        }
                        ?>

                        <?php if (!empty($work->get('url'))) {?>
                            <li class="meta-el"><span><i class="bi bi-globe icon"></i>Site web :</span>
                                <strong><?= $work->get('url') ?></strong>
                            </li>
                        <?php
                        }
                        ?>
                        <hr>

                        <div class="share" id="share">
                            <span>Partager sur</span>
                            <span class="socials">
                                <a href="#"><i class="bi bi-facebook icon"></i></a>
                                <a target="_blank" href="#">
                                    <img class="twitter" src="/public/assets/wejune/img/icons/twitter-r.svg">
                                </a>
                                <a href="#"><i class="bi bi-envelope-fill icon"></i></a>
                                <a href="#"><i class="bi bi-instagram icon"></i></a>
                            </span>
                        </div>
                        <div class="mt-2" id="print">
                            <a onclick="window.print()" class="print"><i class="bi bi-printer-fill me-1"></i>Imprimer</a>
                        </div>
                    </ul>

                </aside>
            </div>
        </div>

    </section>


</div>