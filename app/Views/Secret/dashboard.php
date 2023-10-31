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

    <script type="text/javascript" src="/public/assets/dashly/js/theme.bundle.js"></script>
    <script type="text/javascript" src="/public/assets/js/cinergie.js"></script>
    
    <?= $this->section('scripts')?>
    <script type="module">
      
      import OttoTagLabel from '/public/assets/js/otto/otto-tag-label.js';
      import OttoLink from '/public/assets/js/otto/otto-link.js';
      import OttoFormatDate from '/public/assets/js/otto/otto-format-date.js';
      import OttoThesaurusLabel from '/public/assets/js/otto/otto-thesaurus-label.js';

      document.addEventListener("DOMContentLoaded", () => {
        
        const ottoThesaurusLabel = new OttoThesaurusLabel();
        ottoThesaurusLabel.fetchLabels();

        const ottoTagLabel = new OttoTagLabel()
        ottoTagLabel.init()

        OttoLink.urlLinks()
        OttoLink.emailLinks()
        OttoLink.callLinks()

        OttoFormatDate.searchAndFormat('.otto-date');
        
        <?= $this->section('onLoaded')?>
      });
    </script>
</body>
</html>
