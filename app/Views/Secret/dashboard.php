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
      OttoForm.caracterCounter('[data-kx-counter]');

      initialiseWYSIWYG_editors();
      // const API_JSConnect_EstPresent = document.getElementById('antidoteapi_jsconnect_actif') !== null;
      // if (API_JSConnect_EstPresent) {
      //   console.log("Antidote API JS-Connect activée !");
      // } else {
      //   console.warn("Antidote API JS-Connect absente ou désactivée.");
      // }

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
      document.querySelectorAll('form').forEach((el) => {
        if (el.querySelector('.wysiwyg')) {
          el.addEventListener('submit', () => {
            editors = el.querySelectorAll('.wysiwyg');

            editors.forEach((editor) => {
              content = editor.querySelector('.ql-editor').innerHTML;

              // Strip tags and check if empty
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
        }
      });

      // EOF Quill.js
    }
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const check = setInterval(() => {
        if (window.Dropzone && window.Dropzone.instances && window.Dropzone.instances.length) {
          clearInterval(check);

          window.Dropzone.instances.forEach(dz => {
            // ✅ SUCCESS HANDLER
            dz.on("success", (file, response) => {
              console.log("📁 File uploaded:", response);

              if (response && response.status === "success") {
                // refresh logic
                location.href = window.location.pathname + '#images';
                window.location.reload();
              } else if (response && response.status === "error") {
                console.error(`❌ Erreur : ${response.message}`);
                console.error("Upload error:", response.message);
              }
            });

            // ✅ SERVER ERROR RESPONSE (non-JSON or 4xx/5xx)
            dz.on("error", (file, errorMessage, xhr) => {
              console.error("🚨 Dropzone error:", errorMessage);

              if (xhr && xhr.responseText) {
                try {
                  const json = JSON.parse(xhr.responseText);
                  console.error(`❌ Erreur serveur : ${json.message || 'Erreur inconnue.'}`);
                } catch (e) {
                  console.error("❌ Erreur serveur : réponse invalide.");
                }
              } else {
                console.error(`❌ Erreur : ${errorMessage}`);
              }
            });

            // OPTIONAL: upload progress
            dz.on("uploadprogress", (file, progress) => {
              console.log(`⬆️ Uploading ${file.name}: ${progress.toFixed(0)}%`);
            });
          });
        }
      }, 300);
    });
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const hash = window.location.hash;
      if (!hash) return;
      const tabLink = document.querySelector(`[data-bs-target="${hash}"]`);
      if (!tabLink) return;

      console.log("Found tab link for hash:", tabLink);

      // Try several possible bootstrap contexts
      const Bs =
        window.bootstrap || // global bootstrap
        (window.Tab ? {
          Tab: window.Tab
        } : null) || // legacy global Tab
        (window.jQuery && window.jQuery.fn.tab ? {
          Tab: function(el) {
            jQuery(el).tab('show');
          }
        } : null);

      // Fallback: manually trigger tab if no bootstrap JS is found
      if (!Bs || !Bs.Tab) {
        console.warn('⚠️ Bootstrap Tab not found — falling back to manual tab activation.');
        const target = document.querySelector(hash);
        if (target) {
          document.querySelectorAll('.tab-pane.active').forEach(el => el.classList.remove('active', 'show'));
          target.classList.add('active', 'show');
          document.querySelectorAll('.nav-link.active').forEach(el => el.classList.remove('active'));
          tabLink.classList.add('active');
        }
        return;
      }

      // If we have bootstrap.Tab, use it
      try {
        console.log("Bootstrap context:", Bs);
        console.log(new Bs.Tab(tabLink));
        new Bs.Tab(tabLink).show();

      } catch (e) {
        console.warn('⚠️ Bootstrap.Tab failed — falling back to manual activation.', e);
        const target = document.querySelector(hash);
        if (target) {
          document.querySelectorAll('.tab-pane.active').forEach(el => el.classList.remove('active', 'show'));
          target.classList.add('active', 'show');
          document.querySelectorAll('.nav-link.active').forEach(el => el.classList.remove('active'));
          tabLink.classList.add('active');
        }
      }

      // Clean the hash from URL
      history.replaceState(null, null, window.location.pathname);
    });
  </script>

</body>

</html>