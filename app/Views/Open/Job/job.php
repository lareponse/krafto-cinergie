<?php 
$this->layout('Open::layout');

$mail_message = "Bonjour,<br><br>Je suis intéressé(e) par votre annonce et je souhaite en savoir plus. <br>Pourriez-vous me donner plus de détails ?<br><br>Cordialement,<br>[Votre Nom]";

?>

<div class="container" id="casting-single">

    <div class="row">
        <div class="col-lg-7">

            <h2 class="line-left">Annonce</h2>
            <h3 class="text-primary"><?= $record; ?></h3>
            <pre class="bg-light p-4 p-lg-5 text-justify" style="white-space: pre-line;">
            <?= ($record->get('content')); ?>
            </pre>
        </div>

        <div class="offset-lg-1 col-lg-4">
            <div class="row">
                <button type="button" class="btn btn-outline-primary add-btn order-2 order-sm-2 order-md-1 my-5 d-print-none" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-annonce">
                    <i class="bi bi-plus-circle"></i>Ajoutez votre annonce
                </button>
                <?= $this->insert('Open::Job/modal_new'); ?>

                <aside id="meta" class="shadow order-1 order-sm-1 order-md-2">
                    <ul class="meta-list">

                        <?php $tag = $categories[$record->get('category_id')];?>
                        <li class="meta-head">
                            <span><i class="bi bi-bookmarks-fill icon"></i>Catégorie :</span>
                            <span><a href="<?= $controller->router()->hyp('jobs') ?>?categories%5B%5D=<?= $tag->slug() ?>"><?= $tag ?></a></span>
                        </li>

                        <?php
                         $tag_slug = $record->isOffer() ? 'job-offer' : 'job-request'; 
                         $tag_label = $job_proposal[$tag_slug]; 
                        ?>
                        <li class="meta-head">
                            <span><i class="bi bi-bookmarks-fill icon"></i>Type :</span>
                            <span><a href="<?= $controller->router()->hyp('jobs') ?>?types%5B%5D=<?= $tag_slug ?>"><?= $tag_label ?></a></span>
                        </li>

                        <?php
                         $tag_slug = $record->isOffer() ? 'job-paid' : 'job-free'; 
                         $tag_label = $job_payment[$tag_slug];
                        ?>
                        <li class="meta-head">
                            <span><i class="bi bi-bookmarks-fill icon"></i>Rémunéré :</span>
                            <span><a href="<?= $controller->router()->hyp('jobs') ?>?remun=<?= $tag_slug ?>"><?= $tag_label ?></a></span>
                        </li>

                        <li class="meta-head-date"><i class="bi bi-calendar-event icon"></i><span class="otto-date"><?= $record->get('starts') ?></span></li>
                    </ul>
                    <hr>
                    <ul class="meta-list">
                        <?php if (!empty($record->get('ends'))) { ?>
                            <li class="meta-el">
                                <span><i class="bi bi-calendar-check icon"></i>Date de fin :</span>
                                <span><strong class="otto-date"><?= $record->get('ends') ?></strong></span>
                            </li>
                        <?php } ?>

                        <?php if (!empty($record->get('identity'))) { ?>
                            <li class="meta-el">
                                <span><i class="bi bi-megaphone-fill icon"></i>Annonceur :</span>
                                <span><strong><?= $record->get('identity') ?></strong></span>
                            </li>
                        <?php } ?>

                        <?php if (!empty($record->get('phone'))) { ?>
                            <li class="meta-el">
                                <span><i class="bi bi-telephone-fill icon"></i>Téléphone :</span>
                                <span> <strong class="otto-phone"><?= $record->get('phone') ?></strong></span>
                            </li>
                        <?php } ?>

                        <?php if (!empty($record->get('email'))) { ?>
                            <li class="meta-el">
                                <span><i class="bi bi-envelope icon"></i>Email :</span>
                                <span><strong class="otto-email" otto-subject="Votre annonce sur cinergie.be: <?= $record; ?>" otto-content="<?= $mail_message ?>"><?= $record->get('email') ?></strong></span>
                            </li>
                        <?php } ?>

                        <?php if (!empty($record->get('url'))) { ?>
                            <li>
                                <span><i class="bi bi-globe icon"></i>Site web :</span>
                                <strong class="d-block otto-url"><?= $record->get('url') ?></strong>
                            </li>
                        <?php } ?>

                    </ul>
                    <hr>

                    <div class="share">
                        <span>Partager sur</span>
                        <span class="socials">
                            <a href="#"><i class="bi bi-facebook icon"></i></a>
                            <a href="#"><i class="bi bi-twitter-x icon"></i></a>
                            <a href="#"><i class="bi bi-envelope-fill icon"></i></a>
                            <a href="#"><i class="bi bi-instagram icon"></i></a>
                            <a onclick="window.print()" class="print"><i class="bi bi-printer-fill me-1"></i></a>
                        </span>
                    </div>
                </aside>
            </div>
        </div>

    </div>

</div>