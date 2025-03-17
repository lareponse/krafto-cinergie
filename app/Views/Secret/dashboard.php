<!DOCTYPE html>
<html lang="fr" data-theme="light" data-sidebar-behaviour="fixed" data-navigation-color="inverted" data-is-fluid="true">

<head>
  <?php $this->insert('Secret::_partials/head') ?>

  <?= $this->section('html_head') ?>
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
    import OttoForm from '/public/assets/js/otto/otto-form.js';

    document.addEventListener("DOMContentLoaded", () => {

      const ottoIdLabel = new OttoIdLabel('.otto-id-label');
      ottoIdLabel.replace();

      OttoLink.urls('.otto-url');
      OttoLink.emails('.otto-email');
      OttoLink.calls('.otto-phone');

      OttoFormatDate.searchAndFormat('.otto-date');
      OttoForm.enforceFormValidations();
      
      initialiseWYSIWYG_editors();
    });

    // Quill.js
    function initialiseWYSIWYG_editors() {
      const options_for_wysiwyg_editor = {
        modules: {
          toolbar: [
            [{
              header: [1, 2, false]
            }],
            ['bold', 'italic', 'underline'],
            ['link', 'code-block'],
          ],
          history: {
            delay: 2000,
            maxStack: 500,
            userOnly: true
          },
        },
        placeholder: 'Votre texte...',
        theme: 'snow', // or 'bubble'
      };

      document.querySelectorAll('.wysiwyg').forEach((el) => {
        console.log('applying quill to', el);
        const quill = new Quill(el, options_for_wysiwyg_editor);
      });

      let editors, input, content;
      document.querySelectorAll('form:has(.wysiwyg)').forEach((el) => {
        el.addEventListener('submit', () => {
          editors = el.querySelectorAll('.wysiwyg');
          editors.forEach((editor) => {

            content = editor.querySelector('.ql-editor').innerHTML;
            if (content.replace(/<(.|\n)*?>/g, '').trim().length === 0) {
              content = '';
            }

            input = document.createElement('input');
            input.type = 'hidden';
            input.name = editor.getAttribute('data-name');
            input.value = content;
            el.appendChild(input);
          });
        });
      });
      // EOF Quill.js
    }
  </script>
</body>

</html>