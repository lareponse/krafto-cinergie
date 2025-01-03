<?php
$this->layout('Open::layout');

$mail_message = "Bonjour,<br><br>Je suis intéressé(e) par votre annonce et je souhaite en savoir plus. <br>Pourriez-vous me donner plus de détails ?<br><br>Cordialement,<br>[Votre Nom]";
?>

<div class="container" id="casting-single">

    <section>
        <h2 class="line-left">Annonce</h2>
        <h3 class="text-primary"><?= $record; ?></h3>
        <pre class="bg-light p-4 p-lg-5 text-justify" style="white-space: pre-line;"><?= ($record->get('content')); ?></pre>
    </section>

    <aside class="meta">
        <button type="button" class="btn btn-outline-primary shadow-box-trigger add-btn" data-shadow-template="template_add_job">
            <?= $this->bi('plus-circle') ?>
            <span><span class="d-none d-sm-inline">Ajoutez</span> votre annonce</span>
        </button>

        <div class="shadow meta-list">

            <ul class="meta-head">
                <?php
                $tag_slug = $record->isOffer() ? 'job-offer' : 'job-request';
                $tag_label = $job_proposal[$tag_slug];
                ?>
                <li>
                    <span><?= $this->bi('bookmarks-fill') ?> Type :</span>
                    <a href="<?= $controller->router()->hyp('jobs') ?>?types%5B%5D=<?= $tag_slug ?>"><?= $tag_label ?></a>
                </li>

                <?php
                $tag_slug = $record->isOffer() ? 'job-paid' : 'job-free';
                $tag_label = $job_payment[$tag_slug];
                ?>
                <li>
                    <span><?= $this->bi('bookmarks-fill') ?> Rémunéré :</span>
                    <a href="<?= $controller->router()->hyp('jobs') ?>?isPaid=<?= intval($tag_slug == 'job-offer') ?>"><?= $tag_label ?></a>
                </li>

                <?php $tag = $categories[$record->get('category_id')]; ?>
                <li>
                    <span><?= $this->bi('bookmarks-fill') ?> Catégorie :</span>
                    <a href="<?= $controller->router()->hyp('jobs') ?>?categories%5B%5D=<?= $tag->slug() ?>"><?= $tag ?></a>
                </li>

                <li>
                    <span>
                        <?= $this->bi('calendar4-week') ?> <span class="otto-date"><?= $record->get('starts') ?></span>
                    </span>
                </li>
            </ul>
            <hr>
            <ul>
                <?php if (!empty($record->get('ends'))) { ?>
                    <li class="meta-el">
                        <span><?= $this->bi('calendar-check') ?>Date de fin :</span>
                        <span><strong class="otto-date"><?= $record->get('ends') ?></strong></span>
                    </li>
                <?php } ?>

                <?php if (!empty($record->get('identity'))) { ?>
                    <li class="meta-el">
                        <span><?= $this->bi('megaphone-fill') ?> Annonceur :</span>
                        <span><strong><?= $record->get('identity') ?></strong></span>
                    </li>
                <?php } ?>

                <?php if (!empty($record->get('phone'))) { ?>
                    <li class="meta-el">
                        <span><?= $this->bi('telephone-fill') ?> Téléphone :</span>
                        <span> <strong class="otto-phone"><?= $record->get('phone') ?></strong></span>
                    </li>
                <?php } ?>

                <?php if (!empty($record->get('email'))) { ?>
                    <li class="meta-el">
                        <span><?= $this->bi('envelope') ?> Email :</span>
                        <span><strong class="otto-email" otto-subject="Votre annonce sur cinergie.be: <?= $record; ?>" otto-content="<?= $mail_message ?>"><?= $record->get('email') ?></strong></span>
                    </li>
                <?php } ?>

                <?php if (!empty($record->get('url'))) { ?>
                    <li>
                        <span><?= $this->bi('globe') ?> Site web :</span>
                        <strong class="d-block otto-url"><?= $record->get('url') ?></strong>
                    </li>
                <?php } ?>

            </ul>
            <hr>
            <?= $this->insert('Open::_partials/share_print', ['class' => 'compact', 'label' => $record->get('label')]); ?>
        </div>

    </aside>

</div>