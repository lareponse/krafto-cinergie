<script src='/public/assets/fullcalendar/index.global.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
<script src='/public/assets/fullcalendar/fr.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev, today',
                center: 'title',
                right: 'next',
            },
            locale: 'fr',
            initialDate: '2023-09-01',
            navLinks: true,
            expandRows: true,
            selectable: true,
            selectMirror: true,
            dayMaxEvents: true,
            events: '/api/events/events.json',

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


        var allEventsButton = document.getElementById('allEvents');
        var evtavant_premiereButton = document.getElementById('event-cat-avant_premiere');
        var evtevenement_agendaButton = document.getElementById('event-cat-evenement_agenda');
        var evtcineclubButton = document.getElementById('event-cat-cineclub');
        var evtfestivalButton = document.getElementById('event-cat-festival');
        var evtsortie_en_salleButton = document.getElementById('event-cat-sortie_en_salle');
        var evtprogrammation_tvButton = document.getElementById('event-cat-programmation_tv');
        var evt_autre_agendaButton = document.getElementById('event-cat-_autre_agenda');

        var allEvents = [];
        var evtavant_premiereEvents = [];
        var evtevenement_agendaEvents = [];
        var evtcineclubEvents = [];
        var evtfestivalEvents = [];
        var evtsortie_en_salleEvents = [];
        var evtprogrammation_tvEvents = [];
        var evt_autre_agendaEvents = [];

        
        console.log(calendar.getEvents());

        // Séparez les événements en fonction de la catégorie
        calendar.getEvents().forEach(function(event) {

            allEvents.push(event);

            if (event.extendedProps.categorie === 'event-cat-avant_premiere') {
                evtavant_premiereEvents.push(event);
            } else if (event.extendedProps.categorie === 'event-cat-evenement_agenda') {
                evtevenement_agendaEvents.push(event);
            } else if (event.extendedProps.categorie === 'event-cat-cineclub') {
                evtcineclubEvents.push(event);
            } else if (event.extendedProps.categorie === 'event-cat-festival') {
                evtfestivalEvents.push(event);
            } else if (event.extendedProps.categorie === 'event-cat-sortie_en_salle') {
                evtsortie_en_salleEvents.push(event);
            } else if (event.extendedProps.categorie === 'event-cat-programmation_tv') {
                evtprogrammation_tvEvents.push(event);
            } else if (event.extendedProps.categorie === 'event-cat-_autre_agenda') {
                evt_autre_agendaEvents.push(event);
            }

        });

        allEventsButton.addEventListener('click', function() {
            calendar.removeAllEvents();
            calendar.addEventSource(allEvents);
        });

        evtavant_premiereButton.addEventListener('click', function() {
            calendar.removeAllEvents();
            calendar.addEventSource(evtavant_premiereEvents);
        });

        evtevenement_agendaButton.addEventListener('click', function() {
            calendar.removeAllEvents();
            calendar.addEventSource(evtevenement_agendaEvents);
        });

        evtcineclubButton.addEventListener('click', function() {
            calendar.removeAllEvents();
            calendar.addEventSource(evtcineclubEvents);
        });

        evtfestivalButton.addEventListener('click', function() {
            calendar.removeAllEvents();
            calendar.addEventSource(evtfestivalEvents);
        });

        evtsortie_en_salleButton.addEventListener('click', function() {
            calendar.removeAllEvents();
            calendar.addEventSource(evtsortie_en_salleEvents);
        });

        evtprogrammation_tvButton.addEventListener('click', function() {
            calendar.removeAllEvents();
            calendar.addEventSource(evtprogrammation_tvEvents);
        });

        evt_autre_agendaButton.addEventListener('click', function() {
            calendar.removeAllEvents();
            calendar.addEventSource(evt_autre_agendaEvents);
        });


        calendar.render();

    });
</script>