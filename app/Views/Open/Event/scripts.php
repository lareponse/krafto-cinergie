<script nonce="<?= $CSP_nonce ?>">
  <?php
  echo '// START lib fullcalendar/index.global.min.js, fullcalendar/fr.global.min.js moment.min.js'.PHP_EOL;
  echo file_get_contents(DOCUMENT_ROOT . '/public/assets/js/fullcalendar/index.global.min.js');
  echo file_get_contents(DOCUMENT_ROOT . '/public/assets/js/fullcalendar/fr.global.min.js');
  echo file_get_contents(DOCUMENT_ROOT . '/public/assets/js/moment.min.js');
  echo '// EOF fullcalendar/index.global.min.js, fullcalendar/fr.global.min.js moment.min.js' . PHP_EOL;
  $current = $current ?? new \DateTimeImmutable();
  ?>
  document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {

      headerToolbar: false,
      // {
      // left: 'prev,today',
      // center: 'title',
      // right: 'next'
      // },
      locale: 'fr',
      initialDate: '<?= $current->format('Y-m-d'); ?>',
      navLinks: true,
      expandRows: true,
      selectable: true,
      selectMirror: true,
      dayMaxEvents: true,
      fixedWeekCount: false,
      events: <?= $events_json; ?>,
      themeSystem: 'bootstrap5',

      eventClick: function(info) {
        $('#modalTitle').html(info.event.title); // Le titre de l'événement
        $('#modalBodyDescription').html(info.event.title); // Le titre de l'événement dans la modal
        $('#eventUrlInternal').hide();
        $('#eventUrlExternal').hide();

        $('#eventUrlInternal').attr('href', info.event.extendedProps.url_internal);
        if (info.event.extendedProps.url_internal.length > 0)
          $('#eventUrlInternal').show();

        $('#eventUrlExternal').attr('href', info.event.extendedProps.url_site);
        if (info.event.extendedProps.url_site.length > 0)
          $('#eventUrlExternal').show();

        $('#fullCalModal').modal('show');
        return false;
      },

    });

    calendar.render();

    let eventsByCategory = {
      'allEvents': []
    }

    calendar.getEvents().forEach(function(event) {

      if (eventsByCategory[event.extendedProps.categorie] === undefined) {
        eventsByCategory[event.extendedProps.categorie] = []
      }
      eventsByCategory[event.extendedProps.categorie].push(event)
      eventsByCategory['allEvents'].push(event)
    })


    let buttons = document.querySelectorAll('#fullcalendar-filters button')
    buttons.forEach(button => {
      button.addEventListener('click', function() {
        let category = button.getAttribute('id')
        calendar.removeAllEvents();
        calendar.addEventSource(eventsByCategory[category]);
      })
    })
  });
</script>