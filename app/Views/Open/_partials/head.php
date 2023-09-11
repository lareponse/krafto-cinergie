<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-print-css/css/bootstrap-print.min.css" media="print">
<link rel="stylesheet" href="/public/assets/wejune/css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<!--<link rel="stylesheet" href="assets/css/lightbox.min.css">-->
<link rel="stylesheet" href="/public/assets/wejune/css/style.css">
<script src='/public/assets/fullcalendar/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialDate: '2023-01-12',
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectMirror: true,
            select: function(arg) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.addEvent({
                        title: title,
                        start: arg.start,
                        end: arg.end,
                        allDay: arg.allDay
                    })
                }
                calendar.unselect()
            },
            eventClick: function(arg) {
                if (confirm('Are you sure you want to delete this event?')) {
                    arg.event.remove()
                }
            },
            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: [{
                    title: 'All Day Event',
                    start: '2023-01-01'
                },
                {
                    title: 'Long Event',
                    start: '2023-01-07',
                    end: '2023-01-10'
                },
                {
                    groupId: 999,
                    title: 'Repeating Event',
                    start: '2023-01-09T16:00:00'
                },
                {
                    groupId: 999,
                    title: 'Repeating Event',
                    start: '2023-01-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2023-01-11',
                    end: '2023-01-13'
                },
                {
                    title: 'Meeting',
                    start: '2023-01-12T10:30:00',
                    end: '2023-01-12T12:30:00'
                },
                {
                    title: 'Lunch',
                    start: '2023-01-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2023-01-12T14:30:00'
                },
                {
                    title: 'Happy Hour',
                    start: '2023-01-12T17:30:00'
                },
                {
                    title: 'Dinner',
                    start: '2023-01-12T20:00:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2023-01-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2023-01-28'
                }
            ]
        });

        calendar.render();
    });
</script>