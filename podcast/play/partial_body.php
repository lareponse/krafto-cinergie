<body>
  <header><?php require_once('partial_header.php'); ?></header>
  <header><?php require_once('partial_header_mobile.html'); ?></header>

  <div>

    <div style="background-image: url('/podcast/play/<?php echo $show . '/banner.jpg'; ?>'); background-color:black;" class="qodef-page-title qodef-m qodef-title--standard qodef-alignment--center qodef-vertical-alignment--window-top qodef--has-image">
      <div class="qodef-m-inner">

      </div>
    </div>
    <?php echo $show_data['ausha_player']; ?>
    <script src="https://player.ausha.co/ausha-player.js"></script>
    <?php require_once('./' . $show . '/content.html'); ?>

    <div>
      <p>Les Glaneuses est un podcast qui s’immisce au creux de la vie de réalisatrices. À travers leur parcours, leurs souvenirs, leur intimité, nous partons à la découverte de noms de femmes, de combats inspirants, de paroles politiques.</p>
      <br /><strong>Retrouvez Les Glaneuses sur</strong>
      <div class="glaneuses-diffusions">
        <a href="https://podcast.ausha.co/les-glaneuses" title="Les glaneuses sur Apple Podcast"><img src="/podcast/play/assets/platforms/apple-podcast.svg" alt="Les glaneuses sur Apple Podcast" /></a>
        <a href="https://podcastaddict.com/podcast/3696978" title="Les glaneuses sur podcastaddict"><img src="/podcast/play/assets/platforms/podcastaddict.svg" alt="Les glaneuses sur podcastaddict" /></a>
        <a href="https://music.amazon.com/podcasts/2ca9e1ee-7520-4393-9643-917dc2516771" title="Les glaneuses sur Amazon Music"><img src="/podcast/play/assets/platforms/amazon-music.svg" alt="Les glaneuses sur Amazon Music" /></a>
        <a href="https://open.spotify.com/show/6gTlFnDHPCh3Nns3kjvBc0" title="Les glaneuses sur Spotify"><img src="/podcast/play/assets/platforms/spotify.svg" alt="Les glaneuses sur Spotify" /></a>
        <a href="https://www.deezer.com/show/3134642" title="Les glaneuses sur Deezer"><img src="/podcast/play/assets/platforms/deezer.svg" alt="Les glaneuses sur Deezer" /></a>
        <a href="https://soundcloud.com/user-40361272" title="Les glaneuses sur SoundCloud"><img src="/podcast/play/assets/platforms/soundcloud.svg" alt="Les glaneuses sur SoundCloud" /></a>
        <a href="https://www.mixcloud.com/cinergie/" title="Les glaneuses sur MixCloud"><img src="/podcast/play/assets/platforms/mixcloud.svg"" alt=" Les glaneuses sur MixCloud" /></a>
      </div>

      <div style="margin-top:2em;"><strong>Crédits : </strong></div>
      <div>Enregistrement et réalisation : <span style="float:right">Sarah Semana</span></div>
      <div>Montage : <span style="float:right">Constance Pasquier et Sarah Semana</span></div>
      <div>Mixage et création sonore : <span style="float:right">Alexia Baltsavias</span></div>
      <div>Illustration : <span style="float:right">Rocio Alvarez</span></div>
      <div>Auteur des textes : <span style="float:right">Bertrand Gevart</span></div>
      <div>Coordinatrice et productrice : <span style="float:right">Dimitra Bouras</span></div>
      <?php

      if (isset($show_data['additionnal_credits'])) {
        foreach ($show_data['additionnal_credits'] as $k => $v) {
          echo '<div>' . $k . ' : <span style="float:right">' . $v . '</span></div>';
        }
      }
      ?>
    </div>
    <div style="padding-left:3em">
      Les Glaneuses est une production de Cinergie avec l'aide de la Cinémathèque de la Fédération Wallonie-Bruxelles, de la COCOF, de la Ville de Bruxelles-Egalité des chances, et en partenariat avec Radio Campus.
      <br />
      <br />
      <img style="width:23%" src="/podcast/play/assets/logo_cinematheque_fwb.jpg" />
      <img style="width:23%" src="/podcast/play/assets/logo_FrancophonesBruxellesGRIS.png" />
      <img style="width:23%" src="/podcast/play/assets/logo_FWBBLANC_CULT_black.png" />
      <img style="width:23%" src="/podcast/play/assets/logo_vbx.png" />
    </div>



    <?php
    if (isset($show_data['related'])) {
      require_once('partial_related.php');
    }

    if (isset($show_data['youtube'])) {
      require_once('partial_youtube.php');
    }
    ?>
    <div class="qodef-header-logo" style="text-align:center; margin:3em;">
      <a itemprop="url" class="qodef-header-logo-link qodef-height--set" href="../" style="height:200px" rel="home">
        <img width="290" height="44" src="/podcast/logo-cinergie.png" class="qodef-header-logo-image qodef--main" alt="logo main" itemprop="image"></a>
    </div>
  </div><!-- close #qodef-page-outer div from header.php -->



  <div id="qodef-side-area" class="qodef-alignment--left ps">
    <?php include_once('partial_side_area.html'); ?>
  </div>

  <div id="qodef-fullscreen-area">
    <?php include_once('partial_fullscreen-area.html'); ?>
  </div>
  </div><!-- close #qodef-page-wrapper div from header.php -->

</body>

</html>