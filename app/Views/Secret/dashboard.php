<!DOCTYPE html>
<html lang="fr" data-theme="light" data-sidebar-behaviour="fixed" data-navigation-color="inverted" data-is-fluid="true">

<head>
  <?php $this->insert('Secret::_partials/head') ?>

  // section onLoaded
  <?= $this->section('html_head') ?>
  // EOF section onLoaded
</head>

<body>
  <?php $this->insert('Secret::_partials/theme_configuration') ?>
  <?php $this->insert('Secret::_partials/navbar') ?>
  <main>
    <?php $this->insert('Secret::_partials/header', ['title' => $title]) ?>


    <div class="container-fluid">
      <?= $this->insert('Secret::_partials/messages') ?>

      <?= $this->section('content') ?>
    </div>

    <?php $this->insert('Secret::_partials/footer') ?>
  </main>

  <script type="text/javascript" src="/public/assets/dashly/js/theme.bundle.js"></script>

  <?= $this->section('scripts') ?>
  <script type="module">
    import OttoIdLabel from '/public/assets/js/otto/otto-id-label.js';
    import OttoLink from '/public/assets/js/otto/otto-link.js';
    import OttoFormatDate from '/public/assets/js/otto/otto-format-date.js';

    document.addEventListener("DOMContentLoaded", () => {

      const ottoIdLabel = new OttoIdLabel('.otto-id-label');
      ottoIdLabel.replace();

      OttoLink.urls('.otto-url');
      OttoLink.emails('.otto-email');
      OttoLink.calls('.otto-phone');

      OttoFormatDate.searchAndFormat('.otto-date');


      // select all data-kx-href and make them clickable links
      document.querySelectorAll('[data-kx-href]').forEach(row => {
        row.setAttribute('role', 'link');
        row.setAttribute('tabindex', '0');

        row.addEventListener('click', () => {
          const action = row.getAttribute('data-kx-href');
          if (action) {
            window.location.href = action;
          }
        });

        row.addEventListener('keypress', (e) => {
          if (e.key === 'Enter') {
            const action = row.getAttribute('data-kx-href');
            if (action) {
              window.location.href = action;
            }
          }
        });
      });
      console.log('ok');

      // section onLoaded
      <?= $this->section('onLoaded') ?>
      // EOF section onLoaded

      console.log(options_for_wysiwyg_editor);
      console.log(document.querySelectorAll('.wysiwyg'));

    });
  </script>
</body>

</html>