<!DOCTYPE html>
<html lang="fr" data-theme="light"  data-sidebar-behaviour="fixed" data-navigation-color="inverted" data-is-fluid="true">
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

        <?= $this->section('content')?>
        </div>

        <?php $this->insert('Secret::_partials/footer') ?>
    </main>

    <script src="/public/assets/dashly/js/theme.bundle.js"></script>
    <script src="/public/assets/js/cinergie.js"></script>
    <script src="/public/assets/js/otto-format.js"></script>
    <script src="/public/assets/js/otto-complete-merge.js"></script>
    <script src="/public/assets/js/otto-tag-label.js"></script>
    <?= $this->section('scripts')?>
    <script type="text/javascript">
      document.addEventListener("DOMContentLoaded", () => {
        <?= $this->section('onLoaded')?>
      });
    </script>
</body>
</html>
