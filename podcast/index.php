<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Les glaneuses | Cinergie.be</title>
  <meta property="og:title" content="Cinergie.be -Le site du cinéma belge: actualité, agenda, répertoire, jobs …." />
  <meta property="og:description" content="Vous voulez savoir ce qu&#039;il se passe dans le cinéma belge? Intéressé par un métier du cinéma? Tout les infos du cinéma en Belgique sont sur Cinergie.be" />
  <meta property="og:site_name" content="Cinergie.be" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="https://www.cinergie.be/podcast" />
  <meta property="og:locale" content="fr_FR" />
  <meta property="og:image" content="/podcast/logo-cinergie.png" />

  <meta property="twitter:card" content="summary_large_image" />
  <meta property="twitter:title" content="Cinergie.be -Le site du cinéma belge: actualité, agenda, répertoire, jobs …." />
  <meta property="twitter:description" content="Vous voulez savoir ce qu&#039;il se passe dans le cinéma belge? Intéressé par un métier du cinéma? Tout les infos du cinéma en Belgique sont sur Cinergie.be" />
  <meta property="twitter:image" content="/podcast/logo-cinergie.png" />
  <meta property="twitter:site" content="@Cinergie" />
  <meta property="twitter:creator" content="@Cinergie" />
  <meta name="author" content="lareponse.be" />
  <link rel="shortcut icon" href="favicon.ico">
  <link rel="stylesheet" type="text/css" href="/podcast/css/base.css" />
  <link rel="stylesheet" type="text/css" href="/podcast/css/glaneuses.css" />
  <link rel="stylesheet" id="font-awesome-5-all-css" href="/podcast/css/fontawesome/css/all.min.css" type="text/css" media="all">

  <script>
    document.documentElement.className = "js";
    var supportsCssVars = function() {
      var e, t = document.createElement("style");
      return t.innerHTML = "root: { --tmp-var: bold; }", document.head.appendChild(t), e = !!(window.CSS && window.CSS.supports && window.CSS.supports("font-weight", "var(--tmp-var)")), t.parentNode.removeChild(t), e
    };
    supportsCssVars() || alert("Please view this demo in a modern browser that supports CSS Variables.");
  </script>
  <script src="/podcast/js/imagesloaded.pkgd.min.js"></script>
  <script src="/podcast/js/masonry.pkgd.min.js"></script>
  <script src="/podcast/js/charming.min.js"></script>
  <script src="/podcast/js/tweenmax.min.js"></script>
</head>

<body>
  <svg class="hidden">
    <symbol id="icon-arrow" viewBox="0 0 24 24">
      <title>arrow</title>
      <polygon points="6.3,12.8 20.9,12.8 20.9,11.2 6.3,11.2 10.2,7.2 9,6 3.1,12 9,18 10.2,16.8 " />
    </symbol>

    <svg id="icon-caret" viewBox="0 0 32 19">
      <title>caret</title>
      <path d="M31.423 3.976l-14.319 14.32a1.631 1.631 0 0 1-2.306 0L.478 3.976a1.631 1.631 0 0 1 0-2.307L1.63.516a1.631 1.631 0 0 1 2.307 0l12.013 12.013L27.964.516a1.63 1.63 0 0 1 2.306 0l1.154 1.153a1.63 1.63 0 0 1-.001 2.307z"></path>
    </svg>
  </svg>
  <main>
    <div class="frame">
      <header class="codrops-header">
        <div class="codrops-links">
          <a class="codrops-icon codrops-icon--drop" href="https://twitter.com/Cinergie" title="Retrouvez-nous sur Twitter"><img src="/podcast/twitter.png" class="icon" /></a>
          <a class="codrops-icon " href="https://www.facebook.com/cinergie.be" title="Retrouvez-nous sur Facebook"><img src="/podcast/facebook.png" class="icon" /></a>
          <a class="codrops-icon " href="https://www.instagram.com/cinergie.be" target="_blank"><img src="/podcast/instagram.png" width="28" /> </a>
          <a class="codrops-icon " href="https://www.youtube.com/channel/UCyKdwOw0TYnSUL_vZ1BJ7jA" target="_blank"><img src="/podcast/youtube.png" width="28" /> </a>
        </div>
      </header>
      <div class="title">
        <h3 class="title__name"><a href="/"><img src="/podcast/logo-cinergie.png" alt="logo cinergie" width="200" /></a></h3>
        <h4 class="title__sub">2021 <span class="title__sub-works">Les Glaneuses</span></h4>
      </div>
    </div>
    <div class="grid-wrap">
      <div class="grid">

        <?php
        $episodes = require_once('play/S01.php');

        foreach ($episodes as $s_e => $e_data) {
          echo '<a href="/podcast/play/index.php?s=' . $s_e . '" class="grid__item">
        <div class="grid__item-bg"></div>
        <div class="grid__item-wrap">
          <img class="grid__item-img" src="/podcast/play/' . $s_e . '/index.jpeg" alt="Portrait de ' . $e_data['name'] . '" />
        </div>
        <h3 class="grid__item-title">' . $e_data['name'] . '</h3>
        <h4 class="grid__item-number">&nbsp;</h4>
      </a>';
        }
        ?>
      </div>
    </div><!-- /grid-wrap -->

  </main>
  <script src="/podcast/js/demo.js"></script>

  <footer>Une manufacture <a href="https://hexmakina.be">HexMakina</a></footer>
</body>

</html>