<!DOCTYPE html>
<html lang="fr-FR" class="no-touchevents">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Les Glaneuses – Podcast Cinergie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <meta name="robots" content="max-image-preview:large">

    <link rel="canonical" href="https://www.cinergie.be" />
    <link rel="alternate" type="application/rss+xml" title="Podcast Cinergie » Flux" href="https://feed.ausha.co/oRR8aix947Xp">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
    <link rel="stylesheet" href="/podcast/css/glaneuses.css" type="text/css" media="all">

    <meta name="msapplication-TileImage" content="../favicon-1.png">
    <link rel="icon" href="../favicon-1.png" sizes="32x32">
    <link rel="icon" href="../favicon-1.png" sizes="192x192">
    <link rel="apple-touch-icon" href="../favicon-1.png">
</head>

<body>

    <header>
        <img src="/podcast/play/<?php echo $show . '/banner.jpg'; ?>" />
    </header>
    <?php echo $show_data['ausha_player']; ?>
    <script src="https://player.ausha.co/ausha-player.js"></script>
    <main>

        <section>
            <?php require_once('./' . $show . '/content.html'); ?>
        </section>

        <div class="g-2">
            <p>Les Glaneuses est un podcast qui s’immisce au creux de la vie de réalisatrices. À travers leur parcours, leurs souvenirs, leur intimité, nous partons à la découverte de noms de femmes, de combats inspirants, de paroles politiques.</p>
            <p>Les Glaneuses est une production de Cinergie avec l'aide de la Cinémathèque de la Fédération Wallonie-Bruxelles, de la COCOF, de la Ville de Bruxelles-Egalité des chances, et en partenariat avec Radio Campus.</p>
            <section>
                <h4>Retrouvez Les Glaneuses sur</h4>
                <nav class="glaneuses-diffusions">
                    <a href="https://podcast.ausha.co/les-glaneuses" title="Les glaneuses sur Apple Podcast"><img src="/podcast/play/assets/platforms/apple-podcast.svg" alt="Les glaneuses sur Apple Podcast" /></a>
                    <a href="https://podcastaddict.com/podcast/3696978" title="Les glaneuses sur podcastaddict"><img src="/podcast/play/assets/platforms/podcastaddict.svg" alt="Les glaneuses sur podcastaddict" /></a>
                    <a href="https://music.amazon.com/podcasts/2ca9e1ee-7520-4393-9643-917dc2516771" title="Les glaneuses sur Amazon Music"><img src="/podcast/play/assets/platforms/amazon-music.svg" alt="Les glaneuses sur Amazon Music" /></a>
                    <a href="https://open.spotify.com/show/6gTlFnDHPCh3Nns3kjvBc0" title="Les glaneuses sur Spotify"><img src="/podcast/play/assets/platforms/spotify.svg" alt="Les glaneuses sur Spotify" /></a>
                    <a href="https://www.deezer.com/show/3134642" title="Les glaneuses sur Deezer"><img src="/podcast/play/assets/platforms/deezer.svg" alt="Les glaneuses sur Deezer" /></a>
                    <a href="https://soundcloud.com/user-40361272" title="Les glaneuses sur SoundCloud"><img src="/podcast/play/assets/platforms/soundcloud.svg" alt="Les glaneuses sur SoundCloud" /></a>
                    <a href="https://www.mixcloud.com/cinergie/" title="Les glaneuses sur MixCloud"><img src="/podcast/play/assets/platforms/mixcloud.svg"" alt=" Les glaneuses sur MixCloud" /></a>
                </nav>
            </section>
            <nav>
                <img style="width:23%" src="/podcast/play/assets/logo_cinematheque_fwb.jpg" />
                <img style="width:23%" src="/podcast/play/assets/logo_FrancophonesBruxellesGRIS.png" />
                <img style="width:23%" src="/podcast/play/assets/logo_FWBBLANC_CULT_black.png" />
                <img style="width:23%" src="/podcast/play/assets/logo_vbx.png" />
            </nav>
            <section>
                <h4>Crédits : </h4>
                <div class="g-2">
                    <strong>Enregistrement et réalisation :</strong><span>Sarah Semana</span>
                    <strong>Montage :</strong><span>Constance Pasquier et Sarah Semana</span>
                    <strong>Mixage et création sonore :</strong><span>Alexia Baltsavias</span>
                    <strong>Illustration :</strong><span>Rocio Alvarez</span>
                    <strong>Auteur des textes :</strong><span>Bertrand Gevart</span>
                    <strong>Coordinatrice et productrice :</strong><span>Dimitra Bouras</span>
                    <?php

                    if (isset($show_data['additionnal_credits'])) {
                        foreach ($show_data['additionnal_credits'] as $k => $v) {
                            echo '<strong>' . $k . ' :</strong><span>' . $v . '</span>';
                        }
                    }
                    ?>
                </div>

            </section>
        </div>
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
    <footer class="qodef-header-logo" style="text-align:center; margin:3em;">
        <a itemprop="url" class="qodef-header-logo-link qodef-height--set" href="../" style="height:200px" rel="home">
            <img width="290" height="44" src="/podcast/logo-cinergie.png" class="qodef-header-logo-image qodef--main" alt="logo main" itemprop="image"></a>
    </footer>
</body>

</html>