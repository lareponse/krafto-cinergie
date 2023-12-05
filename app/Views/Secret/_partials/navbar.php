<?php

use App\Views\Abilities\Menu;

$menu = [
    [
        'Article' => ['label' => 'Articles', 'icon' => 'text'],
        'Fiche' => [
            'label' => 'Fiches',
            'icon' => 'database',
            'subs' => [
                'Movie' => ['label' => 'Films'],
                'Professional' => ['label' => 'Professionnels'],
                'Organisation' => ['label' => 'Organisations']
            ]
        ],
        'Event' => [
            'label' => 'Evènements',
            'icon' => 'calendar',
            'subs' => [
                'Event' => ['label' => 'Agenda'],
                'Job' => ['label' => 'Annonces'],
                'Contest' => ['label' => 'Concours']
            ]
        ],
        'Shop' => ['label' => 'Boutique', 'icon' => 'euro',
            'subs' => [ 
                'DVD' => ['label' => 'DVDs', 'href' => $controller->router()->hyp('dash_videostore')],
                'Book' => ['label' => 'Livres', 'href' => $controller->router()->hyp('dash_bookshop')]
            ]
        ]
    ],
    [
        'Image' => ['label' => 'Images', 'icon' => 'image'],
        
        'Page' => ['label' => 'Pages', 'icon' => 'page',
            'subs' => [
                'Page' => ['label' => 'Toutes les pages'],
                'authors' => ['label' => 'Nos auteurs', 'href' => $controller->router()->hyp('dash_records', ['nid' => 'Author'])],
                'partners' => ['label' => 'Nos partenaires', 'href' => $controller->router()->hyp('dash_organisations_by_segment', ['segment' => 'partenaires'])],
                'Team' => ['label' => 'Notre équipe'],
            ]
        ]
    ],
    [
        'Message' => ['label' => 'Messages', 'icon' => 'message'],

        'User' => ['label' => 'Utilisateurs', 'icon' => 'image', 
            'subs' => [
                'author' => ['label' => 'Auteurs', 'route' => ['dash_users', ['team' => 'author']]],
                'moderator' => ['label' => 'Modérateurs', 'route' => ['dash_users', ['team' => 'moderator']]],
                'editor' => ['label' => 'Editeurs', 'route' => ['dash_users', ['team' => 'editor']]]
            ]
        ]
    ],
    [
        'Settings' => ['label' => 'Paramètres', 'icon' => 'settings',
            'subs' => [
                'Thesaurus' => ['label' => 'Thesaurus'],
                'Locus' => ['label' => 'Localités'],
                'Tag' => ['label' => 'Qualifiants']
            ]
        ]
    ]
];

$menu = new Menu($controller, $menu, $this);

?>

<nav id="mainNavbar" class="navbar navbar-vertical navbar-expand-lg scrollbar bg-dark navbar-dark">
    <!-- Theme configuration (navbar) -->
    <script>
        let navigationColor = localStorage.getItem('navigationColor'),
            navbar = document.getElementById('mainNavbar');

        if (navigationColor != null && navbar != null) {
            if (navigationColor == 'inverted') {
                navbar.classList.add('bg-dark', 'navbar-dark');
                navbar.classList.remove('bg-white', 'navbar-light');
            } else {
                navbar.classList.add('bg-white', 'navbar-light');
                navbar.classList.remove('bg-dark', 'navbar-dark');
            }
        }
    </script>
    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand" href="<?= $controller->router()->hyp('dashboard'); ?>">
            <img src="/public/assets/dashly/images/logo-small.svg" class="navbar-brand-img logo-light logo-small" alt="..." width="19" height="25">
            <img src="/public/assets/img/logo-cinergie.svg" class="navbar-brand-img logo-light logo-large" alt="..." width="125" height="25">

            <img src="/public/assets/dashly/images/logo-dark-small.svg" class="navbar-brand-img logo-dark logo-small" alt="..." width="19" height="25">
            <img src="/public/assets/img/logo-cinergie.svg" class="navbar-brand-img logo-dark logo-large" alt="..." width="125" height="25">
        </a>

        <!-- Navbar toggler -->
        <a href="javascript: void(0);" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#sidenavCollapse" aria-controls="sidenavCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </a>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenavCollapse">

            <!-- Navigation -->
            <ul class="navbar-nav mb-lg-7">
                <?= $menu ?>
            </ul>
            <!-- End of Navigation -->

        </div>
        <!-- End of Collapse -->
    </div>
</nav>