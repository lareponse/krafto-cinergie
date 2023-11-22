<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cinergie | <?= $controller->meta('title')?></title>
<!-- Standard OG meta tags -->
<meta property="og:title" content="<?= $controller->meta('title')?>">
<meta property="og:description" content="<?= $controller->meta('description')?>">
<meta property="og:url" content="<?= $controller->meta('url')?>">
<meta property="og:type" content="<?= $controller->meta('type')?>">
<meta property="og:image" content="<?= $controller->meta('image')?>">

<!-- Optional OG tags -->
<meta property="og:site_name" content="Cinergie.be">
<meta property="og:locale" content="fr_FR">

<!-- Twitter Card (optional) -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:title" content="<?= $controller->meta('title')?>" />
<meta property="twitter:description" content="<?= $controller->meta('description')?>" />
<meta property="twitter:image" content="<?= $controller->meta('image')?>" />
<meta property="twitter:site" content="@Cinergie" />
<meta property="twitter:creator" content="@Cinergie" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-print-css/css/bootstrap-print.min.css" media="print">
<link rel="stylesheet" href="/public/assets/wejune/css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="stylesheet" href="/public/assets/wejune/css/lightbox.min.css">
<link rel="stylesheet" href="/public/assets/wejune/css/style.css">

<!-- Begin Brevo Form -->
<!-- START - We recommend to place the below code in head tag of your website html  -->
<style>
  @font-face {
    font-display: block;
    font-family: Roboto;
    src: url(https://assets.brevo.com/font/Roboto/Latin/normal/normal/7529907e9eaf8ebb5220c5f9850e3811.woff2) format("woff2"), url(https://assets.brevo.com/font/Roboto/Latin/normal/normal/25c678feafdc175a70922a116c9be3e7.woff) format("woff")
  }

  @font-face {
    font-display: fallback;
    font-family: Roboto;
    font-weight: 600;
    src: url(https://assets.brevo.com/font/Roboto/Latin/medium/normal/6e9caeeafb1f3491be3e32744bc30440.woff2) format("woff2"), url(https://assets.brevo.com/font/Roboto/Latin/medium/normal/71501f0d8d5aa95960f6475d5487d4c2.woff) format("woff")
  }

  @font-face {
    font-display: fallback;
    font-family: Roboto;
    font-weight: 700;
    src: url(https://assets.brevo.com/font/Roboto/Latin/bold/normal/3ef7cf158f310cf752d5ad08cd0e7e60.woff2) format("woff2"), url(https://assets.brevo.com/font/Roboto/Latin/bold/normal/ece3a1d82f18b60bcce0211725c476aa.woff) format("woff")
  }

  #sib-container input:-ms-input-placeholder {
    text-align: left;
    font-family: "Helvetica", sans-serif;
    color: #c0ccda;
  }

  #sib-container input::placeholder {
    text-align: left;
    font-family: "Helvetica", sans-serif;
    color: #c0ccda;
  }
</style>
<link rel="stylesheet" href="https://sibforms.com/forms/end-form/build/sib-styles.css">

<link rel="stylesheet" href="/public/assets/wejune/css/fixes.css">
