<?php
$activeSection = $actionSection ?? $controller->activeSection();

$menu = [
    [
        'section' => 'Article',
        'href' => $controller->router()->hyp('articles'),
        'label' => 'Articles'
    ],
    [
        'section' => 'Event',
        'href' => $controller->router()->hyp('events'),
        'label' => 'Agenda'
    ],
    [
        'section' => 'Movie',
        'href' => $controller->router()->hyp('movies'),
        'label' => 'Filmoth&egrave;que'
    ],
    [
        'section' => 'Professional',
        'href' => $controller->router()->hyp('professionals'),
        'label' => 'Professionnel&middot;le&middot;s'
    ],
    [
        'section' => 'Organisation',
        'href' => $controller->router()->hyp('organisations'),
        'label' => 'Organisations'
    ],
    [
        'section' => 'Job',
        'href' => $controller->router()->hyp('jobs'),
        'label' => 'Castings & Jobs'
    ],
    [
        'section' => 'Shop',
        'href' => $controller->router()->hyp('shop'),
        'label' => 'Boutique'
    ],
    [
        'section' => 'Podcast',
        'href' => '/podcast',
        'label' => 'Podcast'
    ]
];
?>
<nav class="collapse navbar-collapse" id="navigation">
    <ul class="navbar-nav mx-auto">
        <?php
        foreach ($menu as $item) {
            printf(
                '<li class="nav-item"><a class="nav-link %s" href="%s">%s</a></li>',
                $activeSection == $item['section'] ? 'active' : '',
                $item['href'],
                $item['label']
            );
        }
        ?>
    </ul>
    <div class="socials d-none d-xl-block">
        <button type="button" data-bs-toggle="collapse" data-bs-target="#searchBAR" aria-controls="searchBAR" aria-expanded="false" aria-label="Toggle navigation" class="mx-1 btn-search">
            <img src="/public/assets/wejune/img/icons/search.svg" alt="Search bar toggler"></button>
    </div>
</nav>