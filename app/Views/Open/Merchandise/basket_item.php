<?php
$avatar = $record->get('avatar') ?? $record->get('movie_avatar');
$href = $controller->router()->hyp('movie', ['slug' => $record->get('movie_slug')]);

?>
<article class="card shadow paysage boutique mb-4">
    <div class="row g-0">

        <div class="col-md-4">
            <a href="<?= $href ?>">
                <img src="<?= $record->defaultProfilePicture(); ?>" loading="lazy" data-src="<?= $avatar ?>" class="img-fluid w-100 rounded-start" alt="DVD du film <?= $record ?>">
            </a>
        </div>

        <div class="col-md-8">
            <div class="card-body">
                <?php
                if (!$record->isBook()) {
                ?>
                    <div class="d-flex justify-content-between">
                        <?php
                        $attr = ['class' => 'genre'];
                        if (!empty($record->get('movie_genre_id'))) {
                            $attr['class'] .= ' otto-id-label';
                            $attr['otto-urn'] = 'Tag:' . $record->get('movie_genre_id');
                        }
                        echo $this->DOM()::p('Genre', $attr);
                        ?>
                    </div>
                <?php
                }
                echo $this->DOM()::h5("$record", ['class' => 'card-title mb-3 titre-film']);

                $people = null;
                if ($record->isBook()) {
                    $people = $record->get('people');
                } else {
                    $people = $record->get('directors');
                }

                if (!empty($people)) { ?>
                    <p class="author"><?= $this->bi('person-fill', ['class' => 'pe-1']); ?><?= $people; ?></p>
                <?php } ?>

                <aside class="input-group commander-boutique">
                    <button class="form-control add_to_cart btn-commander" data-titre="<?= $record; ?>" data-prix="<?= $record->get('price'); ?>" data-delivery-be="<?= $record->get('deliveryBe'); ?>" data-delivery-eu="<?= $record->get('deliveryEu'); ?>" data-id="<?= $record->get('id'); ?>"><?= $this->bi('cart-plus-fill') ?> </button>
                    <span class="input-group-text prix"><?= number_format($record->get('price'), 2) ?> &euro;</span>
                </aside>
                <small class="mt-3 frais"><?= $record->get('price'); ?>&euro; + <?= $record->get('deliveryBe') ?>&euro; de frais d'envoi en Belgique ou <?= $record->get('deliveryEu') ?>&euro; en Europe</small>
            </div>
        </div>
    </div>
</article>