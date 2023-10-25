<?php
$this->layout('Secret::dashboard');

$urn = $controller->urn();


try {
    $path = 'Secret::' . $urn . '/view/header';
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
        'images' => 'Images'
    ];
    // $menu = array_merge($menu, $extras ?? []);

    $currentSection ??= 'Profile';

    $activeTab = $controller->router()->params('tab') ?? 'Profile';

    $activeClasses = 'show active';
    foreach ($menu as $tab => $title) {

        if ($tab == $urn) // no self linking
            continue;

        $relation_config = $relations[$tab] ?? null;

        $records = null;
        $relation = null;
        $context = null;

        if ($relation_config) {
            ['relation' => $relation, 'data-filter-parent' => $qualifierRestriction] = is_array($relation_config) ? $relation_config : ['relation' => $relation_config, 'data-filter-parent' => null];
            $records = $controller->viewport($relation);
        }


        $activeClass = $activeTab == $tab ? 'active' : ''; // first run is active
    ?>
        <li class="nav-item" role="presentation">
            <a href="javascript: void(0);" class="nav-link d-flex align-items-center <?= $activeClass ?>" id="<?= $tab ?>-tab" data-bs-toggle="tab" data-bs-target="#<?= $tab ?>" role="tab" aria-controls="<?= $tab ?>" aria-selected="true">
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
        <?php $this->insert('Secret::' . $urn . '/view/tab-profile') ?>
    </div>

    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
        <?php $this->insert('Secret::_partials/tab-images', ['images' => $images]) ?>
    </div>

    <?php
    foreach ($relations as $tab => $relation) {
    ?>
        <div class="tab-pane fade <?= $activeTab === $tab ? $activeClasses : '' ?>" id="<?= $tab ?>" role="tabpanel" aria-labelledby="<?= $tab ?>-tab">

            <?php
            $ottoTemplate = is_array($relation) ? 'Secret::_partials/otto/otto-link-qualified' : 'Secret::_partials/otto/otto-link';
            ['relation' => $relation, 'data-filter-parent' => $qualifierRestriction] = is_array($relation) ? $relation : ['relation' => $relation, 'data-filter-parent' => null];
            $records = $controller->viewport($relation);

            ?>
            <div class="row">
                <div class="col-md-6 col-xl-4 col-xxl-3">
                    <div class="card border-0">
                        <div class="card-body p-3">
                            <?php
                            $this->insert($ottoTemplate, [
                                'parent' => $controller->loadModel(),
                                'relation' => $relation,
                                'searchEntity' => $tab,
                                'placeholder' => 'Qualifié',
                                'qualifierRestriction' => $qualifierRestriction,
                                'childrenTemplate' => 'Secret::' . $tab . '/_partials/tab-card'
                            ])
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                foreach ($records as $target) {
                    echo '<div class="col-md-6 col-xl-4 col-xxl-3">';
                    $this->insert('Secret::' . $tab . '/_partials/tab-card', ['source' => $controller->loadModel(), 'target' => $target, 'relation' => $relation]);
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

<script type="module" src="/public/assets/js/otto-complete/otto-complete.js"></script>
<script type="module">
    import {OttoLink, OttoLinkWithQualifier} from '/public/assets/js/otto-complete/otto-complete.js';

    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll('.otto-link').forEach(container => {
            new OttoLink(container, []);
        })

        document.querySelectorAll('.otto-link-with-qualifier').forEach(container => {
            new OttoLinkWithQualifier(container, []);
        })
    });
</script>
<?php $this->end() ?>