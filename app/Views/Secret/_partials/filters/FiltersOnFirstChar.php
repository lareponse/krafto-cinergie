<?php
$filter = $filters['FiltersOnFirstChar'] ?? 'null';

$menu = range('A', 'Z');
$menu = array_combine($menu, $menu);
$menu = array_merge(['.' => '#!.', '09' => '0-9'], $menu, ['*' => 'Tous']);
?>
<nav class="mb-3 mx-auto" aria-label="filter by letter">
    <?php
    $link_template = '<a href="%s" class="btn btn-sm %s m-1 p-1 px-2">%s</a>';

    foreach ($menu as $letter => $label) {
        $href = $controller->url('list', ['FiltersOnFirstChar' => $letter]);
        $class = ($filter == $letter) ? 'btn-secondary' : 'btn-outline-secondary';

        echo sprintf($link_template, $href, $class, $label);
    }
    ?>

    <a href="<?= $controller->url('new') ?>" class="btn btn-primary btn-sm ms-md-4">Nouveau</a>
</nav>


<?php

$labels = ['09' => 'un chiffre', '.' => 'un caractère analphabétique'];

$heading = '';

if (is_null($filter) || $filter == '*') {
    $heading = 'Tous';
}
else{
    $what = $labels[$filter] ?? $filter;
    $heading = 'Commençant par ';
    $heading .= $this->DOM()::span($what, ['class' => 'text-primary mx-2']);
}
$heading .= $this->DOM()::span('(' . ($count ?? '?') . ')', ['class' => 'mx-2']);
?>

<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-end">
    <h2 class="card-header-title h4 text-uppercase"><?= $heading ?></h2>
    <input class="form-control list-search mw-md-300px ms-md-auto mt-5 mt-md-0 mb-3 mb-md-0" type="search" placeholder="Chercher">
</div>