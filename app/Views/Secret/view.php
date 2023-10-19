<?php 
$this->layout('Secret::dashboard');

$urn = $controller->urn();


try{
    $path = 'Secret::'.$urn.'/view/header';
    echo $this->insert($path);
}catch(\Throwable $e){
    echo '<!-- '.$e->getMessage()." ($path) -->";
}

vd($relations);

?>
<ul class="nav nav-tabs">
<?php $this->section('nav-tabs-starts'); ?>
<?php
$menu = [
    'Profile' => 'Fiche',
    'Article' => 'Article',
    'Movie' => 'Film',
    'Professional' => 'Professionnel',
    'Organisation' => 'Organisation',
    'Author' => 'Auteur',
    'images' => 'Images'
];

$records = [
    'Article' => $articles ?? false,
    'Movie' => $movies ?? false,
    'Professional' => $professionals ?? false,
    'Organisation' => $organisations ?? false,
    'Author' => $authors ?? false,
];

// $menu = array_merge($menu, $extras ?? []);

$currentSection ??= 'Profile';

$activeTab = $controller->router()->params('tab') ?? 'Profile';
$activeClasses = 'show active';
foreach($menu as $tab => $title){

    if($tab == $urn) // no self linking
        continue;

    if(isset($records[$tab]) && $records[$tab] === false) // no empty tab
        continue;


    $activeClass = $activeTab == $tab ? 'active' : ''; // first run is active
    ?>
    <li class="nav-item" role="presentation">
        <a href="javascript: void(0);" class="nav-link d-flex align-items-center <?=$activeClass?>" id="<?=$tab?>-tab" data-bs-toggle="tab" data-bs-target="#<?=$tab?>" role="tab" aria-controls="<?=$tab?>" aria-selected="true">
            <?php
            echo $title;
            if (isset($records[$tab]) && is_array($records[$tab])){
                echo $this->DOM()::span(''.count($records[$tab]), ['class' => 'badge text-bg-dark-soft rounded-circle d-inline-flex align-items-center justify-content-center w-20px h-20px ms-1']);
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
    <div class="tab-pane fade <?= $activeTab === 'Profile' ? $activeClasses : ''?>" id="Profile" role="tabpanel" aria-labelledby="Profile-tab">
        <?php $this->insert('Secret::'.$urn.'/view/tab-profile') ?>
    </div>
    
    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
        <?php $this->insert('Secret::_partials/tab-images', ['images' => $images]) ?>
    </div>
    
    <?php 
    foreach($relations as $relation => $tab){
        ?>
            <div class="tab-pane fade <?= $activeTab === $urn ? $activeClasses : ''?>" id="<?=$tab?>" role="tabpanel" aria-labelledby="<?=$tab?>-tab">
                <?php $this->insert('Secret::_partials/otto/otto-link', [
                    'parent' => $controller->loadModel(),
                    'relation' => $relation,

                    'searchEntity' => $tab,

                    'children' => $records[$tab] ?? [],
                    'childrenTemplate' => 'Secret::'.$tab.'/_partials/tab-card'
                ]) ?>
            </div>
        <?php

    }
    ?>
    <?= $this->section('content')?>
</div>

<?php $this->unshift('scripts') ?>
<script type="text/javascript">
    let deleteIcon = '<?= $this->icon('delete') ?>';
</script>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll('.otto-link').forEach(container => {
            new OttoLink(container, []);
        })
    });
</script>
<?php $this->end() ?>
