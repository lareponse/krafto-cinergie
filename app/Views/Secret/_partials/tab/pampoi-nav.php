<ul class="nav nav-tabs">
<?php
$menu ??= [
    'profile' => 'Fiche',     
    'articles' => 'Article',
    'movies' => 'Film',
    'professionals' => 'Professionel',
    'organisations' => 'Organisation',
    'images' => 'Images'
];

$currentSection ??= 'articles';

$active = 'active'; // first run is active
foreach($menu as $tab => $title){
    if($tab == $currentSection)
        continue;
    ?>
    <li class="nav-item" role="presentation">
        <a href="javascript: void(0);" class="nav-link d-flex align-items-center <?=$active?>" id="<?=$tab?>-tab" data-bs-toggle="tab" data-bs-target="#<?=$tab?>" role="tab" aria-controls="<?=$tab?>" aria-selected="true">
            <?php
            echo $title;
            $label = '';
            if (isset($$tab)){
                $label .= count($$tab);
                
                echo $this->DOM()::span($label, ['class' => 'badge text-bg-dark-soft rounded-circle d-inline-flex align-items-center justify-content-center w-20px h-20px ms-1']);
            }
            ?>
        </a>
    </li>
    <?php
    $active=null; // only first run is active
}
?>
</ul>