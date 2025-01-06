<?php
if (empty($related_content)) {
    return;
}

?>
<div class="row g-0 mt-5" id="related-posts">
    <h2 class="pb-0 line-left">Nos contenus liés</h2>
    <div class="slide dots single-post-slider">
        <?php
        foreach ($related_content as $type => $related_items) {
            foreach ($related_items as $related) {
                $href = $controller->router()->hyp($related::model_type(), ['slug' => $related->slug()]);
        ?>
                <div class="card paysage mr-4 mb-4">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <a href="<?= $href ?>">
                                <img src="<?= $related->profilePicture() ?>" class="card-img-left img-fluid rounded-start" alt="<?= $related . ''; ?>">
                            </a>
                        </div>

                        <div class="col-md-8">
                            <a href="<?= $href ?>">
                                <div class="card-body">
                                    <?php
                                    if ($related->get('publication')) {
                                        echo '<p class="date otto-date">' . $related->get('publication') . '</p>';
                                    } else if ($related->get('released')) {
                                        echo '<p class="date">' . $related->get('released') . '</p>';
                                    }
                                    ?>
                                    <h5 class="card-title"><?= $related ?></h5>
                                    <a href="<?= $href ?>" class="cta">
                                        <?php
                                        switch (strtolower($related->nid())) {
                                            case 'article':
                                                echo 'Lire l\'article';
                                                break;
                                            case 'event':
                                                echo 'Voir l\'événement';
                                                break;
                                            case 'movie':
                                                echo 'Voir la fiche du film';
                                                break;
                                            case 'organisation':
                                                echo 'Voir l\'organisation';
                                                break;
                                            case 'professional':
                                                echo 'Voir le professionnel';
                                                break;
                                            case 'author':
                                                echo 'Voir l\'auteur';
                                                break;
                                            case 'contest':
                                                echo 'Voir le concours';
                                                break;

                                            default:
                                                echo 'Lire la fiche';
                                        }

                                        ?></a>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>