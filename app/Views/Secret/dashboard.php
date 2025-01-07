<!DOCTYPE html>
<html lang="fr" data-theme="light" data-sidebar-behaviour="fixed" data-navigation-color="inverted" data-is-fluid="true">

<head>
  <?php $this->insert('Secret::_partials/head') ?>
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


      // select all .table-clickable rows and make them clickable using their data-action attribute
      document.querySelectorAll('.table-clickable [data-action]').forEach(row => {
        row.addEventListener('click', () => {
          const action = row.getAttribute('data-action');
          if (action) {
            window.location.href = action;
          }
        });
      });

      // section onLoaded
      <?= $this->section('onLoaded') ?>
      // EOF section onLoaded
    });
  </script>
</body>

</html>