<!DOCTYPE html>
<html lang="fr-FR" class="no-touchevents">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Les Glaneuses – Podcast Cinergie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <meta name="robots" content="max-image-preview:large">

    <link rel="canonical" href="https://www.cinergie.be" />
    <link rel="alternate" type="application/rss+xml" title="Podcast Cinergie » Flux" href="https://feed.ausha.co/oRR8aix947Xp">


    <link rel="stylesheet" href="/public/assets/wejune/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/wejune/css/slick-theme.css">
    <link rel="stylesheet" href="/public/assets/wejune/css/slick.min.css">
    <link rel="stylesheet" href="/public/assets/wejune/css/style.css"><!-- original custom css -->
    <link rel="stylesheet" href="/public/assets/css/lareponse.css"><!-- fixes to the custom css -->

    <link rel="stylesheet" href="/podcast/css/glaneuses.css" type="text/css" media="all">


    <meta name="msapplication-TileImage" content="../favicon-1.png">
    <link rel="icon" href="../favicon-1.png" sizes="32x32">
    <link rel="icon" href="../favicon-1.png" sizes="192x192">
    <link rel="apple-touch-icon" href="../favicon-1.png">
</head>

<body id="podcast">

    <header style="background-image: url('/podcast/play/<?php echo $show . '/banner.jpg'; ?>');">
        <h1>
            <?= $show_data['name']; ?>

        </h1>
        <!-- <img src="/podcast/play/<?php echo $show . '/banner.jpg'; ?>" /> -->
    </header>
    <main>

        <section>
            <?php echo $show_data['ausha_player']; ?>
            <script src="https://player.ausha.co/ausha-player.js"></script>
            <?php require_once('./' . $show . '/content.html'); ?>
        </section>

        <hr>

        <aside>
            <div>
                <p>Les Glaneuses est un podcast qui s’immisce au creux de la vie de réalisatrices. À travers leur parcours, leurs souvenirs, leur intimité, nous partons à la découverte de noms de femmes, de combats inspirants, de paroles politiques.</p>
                <article>
                    <h4>Retrouvez Les Glaneuses sur</h4>
                    <nav class="glaneuses-diffusions mt-5">
                        <a href="https://podcast.ausha.co/les-glaneuses" title="Les glaneuses sur Apple Podcast"><img src="/podcast/play/assets/platforms/apple-podcast.svg" alt="Les glaneuses sur Apple Podcast" /></a>
                        <a href="https://podcastaddict.com/podcast/3696978" title="Les glaneuses sur podcastaddict"><img src="/podcast/play/assets/platforms/podcastaddict.svg" alt="Les glaneuses sur podcastaddict" /></a>
                        <a href="https://music.amazon.com/podcasts/2ca9e1ee-7520-4393-9643-917dc2516771" title="Les glaneuses sur Amazon Music"><img src="/podcast/play/assets/platforms/amazon-music.svg" alt="Les glaneuses sur Amazon Music" /></a>
                        <a href="https://open.spotify.com/show/6gTlFnDHPCh3Nns3kjvBc0" title="Les glaneuses sur Spotify"><img src="/podcast/play/assets/platforms/spotify.svg" alt="Les glaneuses sur Spotify" /></a>
                        <a href="https://www.deezer.com/show/3134642" title="Les glaneuses sur Deezer"><img src="/podcast/play/assets/platforms/deezer.svg" alt="Les glaneuses sur Deezer" /></a>
                        <a href="https://soundcloud.com/user-40361272" title="Les glaneuses sur SoundCloud"><img src="/podcast/play/assets/platforms/soundcloud.svg" alt="Les glaneuses sur SoundCloud" /></a>
                        <a href="https://www.mixcloud.com/cinergie/" title="Les glaneuses sur MixCloud"><img src="/podcast/play/assets/platforms/mixcloud.svg"" alt=" Les glaneuses sur MixCloud" /></a>
                    </nav>
                </article>
                <article>
                    <h4>Crédits : </h4>
                    <div class="g-2">
                        <span>Enregistrement et réalisation :</span><span>Sarah Semana</span>
                        <span>Montage :</span><span>Constance Pasquier et Sarah Semana</span>
                        <span>Mixage et création sonore :</span><span>Alexia Baltsavias</span>
                        <span>Illustration :</span><span>Rocio Alvarez</span>
                        <span>Auteur des textes :</span><span>Bertrand Gevart</span>
                        <span>Coordinatrice et productrice :</span><span>Dimitra Bouras</span>
                        <?php

                        if (isset($show_data['additionnal_credits'])) {
                            foreach ($show_data['additionnal_credits'] as $k => $v) {
                                echo '<span>' . $k . ' :</span><span>' . $v . '</span>';
                            }
                        }
                        ?>
                    </div>
                </article>

            </div>

            <section>
                <p>Les Glaneuses est une production de Cinergie avec l'aide de la Cinémathèque de la Fédération Wallonie-Bruxelles, de la COCOF, de la Ville de Bruxelles-Egalité des chances, et en partenariat avec Radio Campus.</p>
                <nav class="glaneuses-partners">
                    <img style="width:23%" src="/podcast/play/assets/logo_cinematheque_fwb.jpg" />
                    <img style="width:23%" src="/podcast/play/assets/logo_FrancophonesBruxellesGRIS.png" />
                    <img style="width:23%" src="/podcast/play/assets/logo_FWBBLANC_CULT_black.png" />
                    <img style="width:23%" src="/podcast/play/assets/logo_vbx.png" />
                </nav>
            </section>
        </aside>

    </main>

    <?php
    if (isset($show_data['related'])) {
        require_once('partial_related.php');
    }

    if (isset($show_data['youtube'])) {
        require_once('partial_youtube.php');
    }
    ?>

    </section>

    <footer>
        <a itemprop="url" class="qodef-header-logo-link qodef-height--set" href="../" style="height:200px" rel="home">
            <img width="290" height="44" src="/podcast/logo-cinergie.png" class="qodef-header-logo-image qodef--main" alt="logo main" itemprop="image"></a>
    </footer>
    <script src="/public/assets/wejune/js/jquery.min.js"></script>
    <script src="/public/assets/wejune/js/slick.min.js"></script>
    <script>
        $('.single-post-slider.slide.dots').slick({
            dots: true,
            arrows: false,

            centerMode: false,
            centerPadding: '60px',
            autoplay: true,
            autoplaySpeed: 3500,
            infinite: false,
            speed: 1000,
            slidesToShow: 2,
            slidesToScroll: 2,
            responsive: [{
                    breakpoint: 480,
                    settings: {
                        centerMode: false,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        centerMode: false,
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ]
        });
    </script>
</body>

</html>