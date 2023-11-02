<?php

$otto_config = [
    'parent' => $controller->loadModel(),
    'context' => $context,
    'ottoLinkEndPoint' => '/api/tag/'.$context.'/term'
];

switch($context)
{
    case 'professional_praxis':
        $otto_config = array_merge($otto_config, [
            'relation' => 'professional-hasAndBelongsToMany-tag',
            'placeholder' => 'Métier',
            'title' => 'Métiers'
        ]);
    break;

    case 'organisation_praxis':
        $otto_config = array_merge($otto_config, [
            'relation' => 'organisation-hasAndBelongsToMany-tag',
            'placeholder' => 'Activité',
            'title' => 'Activités'
        ]);

    break;

    // case 'movie_theme':
    //     $otto_config = [
    //         'parent' => $controller->loadModel(),
    //         'relation' => 'movie-hasAndBelongsToMany-tag',
    //         'searchEntity' => 'Tag',
    //         'placeholder' => 'Thème',
    //         'qualifierRestriction' => 'movie_theme'
    //     ];
    //     break;

    // case 'movie_thesaurus':
    //     $otto_config = [
    //         'parent' => $controller->loadModel(),
    //         'relation' => 'movie-hasAndBelongsToMany-thesaurus',
    //         'searchEntity' => 'Thesaurus',
    //         'placeholder' => 'Thésaurus',
    //         'qualifierRestriction' => 'movie_thesaurus'
    //     ];
    //     break;

    default:
        throw new \Exception('Partial::'.__FILE__.', unknown $context: '.($context ?? 'isNull'));
} 
?>
<div class="card border-0 pt-3">
    <div class="card-body pt-0">
        <h3 class="h6 small text-secondary text-uppercase mb-3"><?= $otto_config['title'] ?? 'Praxis' ?></h3>
        <?php
            foreach ($praxis_ids ?? [] as $id) {
        ?>
                <form method="POST" class="d-flex mb-2 align-items-center" action="<?= $controller->router()->hyp('dash_relation_unlink') ?>">
                    <input type="hidden" name="relation" value="<?= $otto_config['relation'] ?>" />
                    <input type="hidden" name="source" value="<?= $controller->loadModel()->getID() ?>" />
                    <input type="hidden" name="target" value="<?= $id ?>" />

                    <span class="otto-id-label" otto-urn="Tag:<?= $id ?>"><?= $id ?></span>
                    <button type="submit" class="btn btn-sm text-danger ms-auto pe-0">
                        <?= $this->icon('delete', 14) ?>
                    </button>
                </form>
        <?php
            }

        $this->insert('Secret::_partials/otto/otto-complete/OneToMany', $otto_config)
        ?>

    </div>
</div>