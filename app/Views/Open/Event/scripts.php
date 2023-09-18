<script src='/public/assets/fullcalendar/index.global.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
<script src='/public/assets/fullcalendar/fr.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listWeek',
            },
            locale: 'fr',
            initialDate: '2023-09-18',
            navLinks: true, // can click day/week names to navigate views
            selectMirror: true,
            dayMaxEvents: true, // allow "more" link when too many events

            events: '/api/events/events.json',
        
        });

        calendar.render();

        var allEventsButton = document.getElementById('allEvents');
        var category1Button = document.getElementById('category1');
        var category2Button = document.getElementById('category2');
        var category3Button = document.getElementById('category3');
        var category4Button = document.getElementById('category4');
        var category5Button = document.getElementById('category5');
        var category6Button = document.getElementById('category6');
        var category7Button = document.getElementById('category7');

        var allEvents = [];
        var category1Events = [];
        var category2Events = [];
        var category3Events = [];
        var category4Events = [];
        var category5Events = [];
        var category6Events = [];
        var category7Events = [];

        // Séparez les événements en fonction de la catégorie
        calendar.getEvents().forEach(function(event) {
            allEvents.push(event);

        console.log(event.extendedProps.className)

        if (event.extendedProps.className === 'evt-avant_premiere') {
            category1Events.push(event);
            } else if (event.extendedProps.className === 'categorie2') {
            category2Events.push(event);
            } else if (event.extendedProps.className === 'categorie3') {
            category3Events.push(event);
            } else if (event.extendedProps.className === 'categorie4') {
            category4Events.push(event);
            } else if (event.extendedProps.className === 'categorie5') {
            category5Events.push(event);
            } else if (event.extendedProps.className === 'categorie6') {
            category6Events.push(event);
            } else if (event.extendedProps.className === 'categorie7') {
            category7Events.push(event);
            }

        });

        allEventsButton.addEventListener('click', function() {
            calendar.removeAllEvents();
        calendar.addEventSource(allEvents);
        });

        category1Button.addEventListener('click', function() {
            calendar.removeAllEvents();
        calendar.addEventSource(category1Events);
        });

        category2Button.addEventListener('click', function() {
            calendar.removeAllEvents();
        calendar.addEventSource(category2Events);
        });

        category3Button.addEventListener('click', function() {
            calendar.removeAllEvents();
        calendar.addEventSource(category3Events);
        });

        category4Button.addEventListener('click', function() {
            calendar.removeAllEvents();
        calendar.addEventSource(category4Events);
        });

        category5Button.addEventListener('click', function() {
            calendar.removeAllEvents();
        calendar.addEventSource(category5Events);
        });

        category6Button.addEventListener('click', function() {
            calendar.removeAllEvents();
        calendar.addEventSource(category6Events);
        });

        category7Button.addEventListener('click', function() {
            calendar.removeAllEvents();
        calendar.addEventSource(category7Events);
        });

    });
    </script>