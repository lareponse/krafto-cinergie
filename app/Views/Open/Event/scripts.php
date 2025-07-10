<script nonce="<?= $CSP_nonce ?>">
  <?php $current ??= new \DateTimeImmutable(); ?>
  document.addEventListener('DOMContentLoaded', function() {

    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: false,
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

      // ───────────────────────────
      // eventClick WITHOUT jQuery
      // ───────────────────────────
      eventClick: function(info) {
        // 1) fill modal title & body
        document.getElementById('modalTitle').textContent = info.event.title;
        document.getElementById('modalBodyDescription').textContent = info.event.title;

        // 2) set up internal link
        const intLink = document.getElementById('eventUrlInternal');
        if (info.event.extendedProps.url_internal) {
          intLink.href = info.event.extendedProps.url_internal;
          intLink.style.display = ''; // show
        } else {
          intLink.style.display = 'none'; // hide
        }

        // 3) set up external link
        const extLink = document.getElementById('eventUrlExternal');
        if (info.event.extendedProps.url_site) {
          extLink.href = info.event.extendedProps.url_site;
          extLink.style.display = '';
        } else {
          extLink.style.display = 'none';
        }

        // 4) launch the Bootstrap 5 modal
        const modalEl = document.getElementById('fullCalModal');
        const bsModal = new bootstrap.Modal(modalEl);
        bsModal.show();

        return false; // prevent default
      }
    });

    calendar.render();

    // ───────────────────────────
    // filtering buttons WITHOUT jQuery
    // ───────────────────────────
    const eventsByCategory = {
      allEvents: []
    };
    calendar.getEvents().forEach(event => {
      const cat = event.extendedProps.categorie || 'uncategorized';
      if (!eventsByCategory[cat]) eventsByCategory[cat] = [];
      eventsByCategory[cat].push(event);
      eventsByCategory.allEvents.push(event);
    });

    document.querySelectorAll('#fullcalendar-filters button')
      .forEach(button => {
        button.addEventListener('click', () => {
          const category = button.id;
          calendar.removeAllEvents();
          calendar.addEventSource(eventsByCategory[category] || []);
        });
      });

  });
</script>