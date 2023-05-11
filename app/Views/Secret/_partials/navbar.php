<?php

function makeMenu($controller, $items){
    foreach($items as $param => $label){
        echo makeMenuItem($controller, $param, $label);
    }
}

function makeMenuItem($controller, $param, $label){
    $item_pattern = '<li class="nav-item"><a href="%s" class="nav-link %s"><span>%s</span></a></li>';
    $route = $controller->urlFor($param, 'list');
    $class = $controller->activeLink() == $param ? 'active' : '';
    return sprintf($item_pattern, $route, $class, $label);
}
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
            <img src="/public/assets/dashly/images/logo.svg" class="navbar-brand-img logo-light logo-large" alt="..." width="125" height="25">

            <img src="/public/assets/dashly/images/logo-dark-small.svg" class="navbar-brand-img logo-dark logo-small" alt="..." width="19" height="25">
            <img src="/public/assets/dashly/images/logo-dark.svg" class="navbar-brand-img logo-dark logo-large" alt="..." width="125" height="25">
        </a>

        <!-- Navbar toggler -->
        <a href="javascript: void(0);" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#sidenavCollapse" aria-controls="sidenavCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </a>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenavCollapse">

            <!-- Navigation -->
            <ul class="navbar-nav mb-lg-7">
                <li class="nav-item">
                    <a class="nav-link <?= $controller->activeSection() == 'Article' ? 'active' : ''; ?>" href="<?= $controller->urlFor('Article', 'list') ?>">
                        <?= $this->icon('text', 18, ['class' => 'nav-link-icon']); ?>
                        <span>Articles</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link <?= $controller->activeSection() == 'Fiche' ? 'active' : ''; ?>" href="#fichesCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="fichesCollapse">
                        <?= $this->icon('database', 18, ['class' => 'nav-link-icon']); ?>
                        <span>Fiches</span>
                    </a>
                    <div class="collapse <?= $controller->activeSection() == 'Fiche' ? 'show' : ''; ?>" id="fichesCollapse">
                        <ul class="nav flex-column">
                        <?= makeMenu($controller, ['Movie' => 'Films', 'Professional' => 'Professionels', 'Organisation' => 'Organisation']);?>
                        </ul>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link <?= $controller->activeSection() == 'Event' ? 'active' : ''; ?>" href="#eventsCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="eventsCollapse">
                        <?= $this->icon('calendar', 18, ['class' => 'nav-link-icon']); ?>
                        <span>Evènements</span>
                    </a>
                    <div class="collapse <?= $controller->activeSection() == 'Event' ? 'show' : ''; ?>" id="eventsCollapse">
                        <ul class="nav flex-column">
                            <?= makeMenu($controller, ['Event' => 'Agenda', 'Work' => 'Annonces', 'Contest' => 'Concours']);?>
                        </ul>
                    </div>
                </li>

                <li class="nav-item w-100">
                    <hr>
                </li>

                <li class="nav-item">
                    <a class="nav-link  <?= $controller->activeSection() == 'Image' ? 'active' : ''; ?>" href="./file-manager.html">
                        <?= $this->icon('image', 18, ['class' => 'nav-link-icon']); ?>
                        <span>Images</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link <?= $controller->activeSection() == 'Page' ? 'active' : ''; ?>" href="#pagesCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="pagesCollapse">
                        <?= $this->icon('page', 18, ['class' => 'nav-link-icon']); ?>
                        <span>Pages</span>
                    </a>
                    <div class="collapse <?= $controller->activeSection() == 'Page' ? 'show' : ''; ?>" id="pagesCollapse">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="<?php echo $controller->router()->hyp('dash_authors'); ?>" class="nav-link">
                                    <span>Nos auteurs</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo $controller->router()->hyp('dash_organisations_by_segment', ['segment' => 'partenaires']); ?>" class="nav-link">
                                    <span>Partenaires</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo $controller->router()->hyp('dash_teams'); ?>" class="nav-link">
                                    <span>L'équipe</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo $controller->router()->hyp('dash_page_slug', ['slug' => 'notre-histoire']); ?>" class="nav-link">
                                    <span>Notre histoire</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo $controller->router()->hyp('dash_page_slug', ['slug' => 'mentions-legales']); ?>" class="nav-link">
                                    <span>Mentions légales</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo $controller->router()->hyp('dash_page_cinergie_award'); ?>" class="nav-link">
                                    <span>Le Prix Cinergie</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo $controller->router()->hyp('dash_organisation_edit_by_slug', ['slug' => 'cinergie-be']); ?>" class="nav-link">
                                    <span>Contactez-nous</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>



                <li class="nav-item dropdown">
                    <a class="nav-link <?= $controller->activeSection() == 'Boutique' ? 'active' : ''; ?>" href="#shopCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="shopCollapse">
                        <?= $this->icon('euro', 18, ['class' => 'nav-link-icon']); ?>
                        <span>Boutique</span>
                    </a>
                    <div class="collapse <?= $controller->activeSection() == 'Boutique' ? 'show' : ''; ?>" id="shopCollapse">
                        <ul class="nav flex-column">
                        <?= makeMenu($controller, ['DVD' => 'DVDs', 'Book' => 'Livres']);?>
                        </ul>
                    </div>
                </li>

                <li class="nav-item w-100">
                    <hr>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link " href="#emailCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="emailCollapse">
                        <?= $this->icon('message', 18, ['class' => 'nav-link-icon']); ?>
                        <span>Messages</span>
                    </a>
                    <div class="collapse  <?= $controller->activeSection() == 'Message' ? 'show' : ''; ?>" id="emailCollapse">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="./inbox.html" class="nav-link">
                                    <span>Inbox</span>
                                    <span class="badge text-bg-primary badge-circle ms-3">7</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./read-email.html" class="nav-link">
                                    <span>Read Email</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link  <?= $controller->activeSection() == 'User' ? 'active' : ''; ?>" href="#userCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="userCollapse">
                        <?= $this->icon('users', 18, ['class' => 'nav-link-icon']); ?>
                        <span>Utilisateurs</span>
                    </a>
                    <div class="collapse <?= $controller->activeSection() == 'User' ? 'show' : ''; ?>" id="userCollapse">
                        <ul class="nav flex-column">

                            <li class="nav-item">
                                <a href="<?php echo $controller->router()->hyp('dash_users', ['team' => 'author']); ?>" class="nav-link">
                                    <span>Auteurs</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo $controller->router()->hyp('dash_users', ['team' => 'moderator']); ?>" class="nav-link">
                                    <span>Modérateurs</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo $controller->router()->hyp('dash_users', ['team' => 'editor']); ?>" class="nav-link">
                                    <span>Editeurs</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item w-100">
                    <hr>
                </li>




                <li class="nav-item dropdown">
                    <a class="nav-link <?= $controller->activeSection() == 'Settings' ? 'active' : ''; ?>" href="#settingsCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="settingsCollapse">
                        <?= $this->icon('settings', 18, ['class' => 'nav-link-icon']); ?>
                        <span>Paramètres</span>
                    </a>
                    <div class="collapse <?= $controller->activeSection() == 'Settings' ? 'show' : ''; ?>" id="settingsCollapse">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="<?php echo $controller->router()->hyp('dash_thesauruss'); ?>" class="nav-link">
                                    <span>Thesaurus</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo $controller->router()->hyp('dash_locuss'); ?>" class="nav-link">
                                    <span>Localités</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
            <!-- End of Navigation -->

        </div>
        <!-- End of Collapse -->
    </div>
</nav>