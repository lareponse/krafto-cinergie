<?php
$this->layout('Secret::dashboard');


try {
    $path = 'Secret::' . $controller->nid() . '/view/header';
    echo $this->insert($path);
} catch (\Throwable $e) {
    echo '<!-- ' . $e->getMessage() . " ($path) -->";
}

?>
<ul class="nav nav-tabs">
    <?php $this->section('nav-tabs-starts'); ?>
    <?php
    $menu = [
        'Profile' => 'Fiche',
        'Article' => 'Articles',
        'Movie' => 'Films',
        'Professional' => 'Professionnels',
        'Organisation' => 'Organisations',
        'Author' => 'Auteurs',
        'Merchandise' => 'Boutique',
        'images' => 'Images'
    ];
    // $menu = array_merge($menu, $extras ?? []);

    $currentSection ??= 'Profile';

    $activeTab = $controller->router()->params('tab') ?? 'Profile';

    $activeClasses = 'show active';
    foreach ($menu as $linked_urn => $title) {

        if ($linked_urn == $controller->nid()) // no self linking
            continue;

        if(!in_array($linked_urn, ['Profile', 'images']) && !isset($relations[$linked_urn]))
            continue;

        $relation_config = $relations[$linked_urn] ?? null;

        $records = null;
        $relation = null;
        $context = null;

        if ($relation_config) {
            ['relation' => $relation, 'context' => $context] = is_array($relation_config) ? $relation_config : ['relation' => $relation_config, 'context' => null];
            $records = $controller->viewport($relation);
        }


        $activeClass = $activeTab == $linked_urn ? 'active' : ''; // first run is active
    ?>
        <li class="nav-item" role="presentation">
            <a href="javascript: void(0);" class="nav-link d-flex align-items-center <?= $activeClass ?>" id="<?= $linked_urn ?>-tab" data-bs-toggle="tab" data-bs-target="#<?= $linked_urn ?>" role="tab" aria-controls="<?= $linked_urn ?>" aria-selected="true">
                <?php
                echo $title;
                if (isset($records) && is_array($records)) {
                    echo $this->DOM()::span('' . count($records), ['class' => 'badge text-bg-dark-soft rounded-circle d-inline-flex align-items-center justify-content-center w-20px h-20px ms-1']);
                }
                ?>
            </a>
        </li>
    <?php
    }
    ?>
    <?php $this->section('nav-tabs-stops'); ?>
</ul>

<div class="tab-content pt-6" id="viewPageContent">
    <div class="tab-pane fade <?= $activeTab === 'Profile' ? $activeClasses : '' ?>" id="Profile" role="tabpanel" aria-labelledby="Profile-tab">
        <?php $this->insert('Secret::' . $controller->nid() . '/view/tab-profile') ?>
    </div>

    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
        <?php $this->insert('Secret::_partials/tab-images', ['images' => $images ?? []]) ?>
    </div>

    <?php
    foreach ($relations as $linked_urn => $relation) {
    ?>
        <div class="tab-pane fade <?= $activeTab === $linked_urn ? $activeClasses : '' ?>" id="<?= $linked_urn ?>" role="tabpanel" aria-labelledby="<?= $linked_urn ?>-tab">

            <?php
            $qualifiedRelation = is_array($relation);
            
            if ($qualifiedRelation) {
                ['relation' => $relationName, 'context' => $context] = $relation;
                $ottoTemplate = 'Secret::_partials/otto/otto-complete/OneToManyQualified';
            } else {
                $relationName = $relation;
                $context = $linked_urn;
                $ottoTemplate = 'Secret::_partials/otto/otto-complete/OneToMany';
            }

            $records = $controller->viewport($relationName) ?? [];
            ?>
            <div class="row">
                <div class="col-md-6 col-xl-4 col-xxl-3">
                    <div class="card border-0">
                        <div class="card-body p-3">
                            <?php
                            $this->insert($ottoTemplate, [
                                'parent' => $controller->loadModel(),
                                'relation' => $relationName,
                                'context' => $linked_urn,
                                'ottoLinkEndPoint' => '/api/id-label/' . $linked_urn . '/term/',
                                'placeholder' => 'Qualifié',
                                'qualifierContext' => $context,
                                'childrenTemplate' => 'Secret::' . $linked_urn . '/_partials/tab-card'
                            ])
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                foreach ($records as $target) {
                    echo '<div class="col-md-6 col-xl-4 col-xxl-3">';
                    $this->insert('Secret::' . $linked_urn . '/_partials/tab-card', ['source' => $controller->loadModel(), 'target' => $target, 'relation' => $relationName, 'relationIsQualified' => $qualifiedRelation]);
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    <?php

    }
    ?>
    <?= $this->section('content') ?>
</div>

<?php $this->unshift('scripts') ?>
    <script type="text/javascript">
        let deleteIcon = '<?= $this->icon('delete') ?>';
    </script>

    <script type="module">
        import OneToMany from '/public/assets/js/otto/otto-complete/OneToMany.js';
        import OneToManyQualified from '/public/assets/js/otto/otto-complete/OneToManyQualified.js';

        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.otto-OneToMany').forEach(container => {
                new OneToMany(container);
            })

            document.querySelectorAll('.otto-OneToManyQualified').forEach(container => {
                new OneToManyQualified(container);
            })
        });
    </script>
<?php $this->end() ?>