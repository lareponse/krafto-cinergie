<?php

use \HexMakina\Marker\Marker; ?>

<?php
$this->layout('Open::layout', ['title' => "L'agenda du cinéma belge " . Marker::span($current_month . ' ' . $current_year)]) ?>

<div class="container">

  <section class="row my-5 d-none d-sm-none d-md-none d-lg-block" id="agenda-widget">
    <div class="p-5 text-center">
      <div class="mb-5">
        <button class="btn text-agenda-1" id="allEvents">Tous</button>
        <button class="btn text-agenda-2" id="category1">Avant-première</button>
        <button class="btn text-agenda-3" id="category2">Évènement</button>
        <button class="btn text-agenda-4" id="category3">Ciné-club</button>
        <button class="btn text-agenda-5" id="category4">Festival</button>
        <button class="btn text-agenda-6" id="category5">Sortie</button>
        <button class="btn text-agenda-7" id="category6">Programmation TV</button>
        <button class="btn text-agenda-8" id="category7">Séances</button>
      </div>
      <div id='calendar'></div>
    </div>
  </section>

  <section class="row my-5" id="listing-agenda">
    <div class="title-agenda">
      <h3 class="h5"><span class="text-primary"><?=$current_month?></span> <?=$current_year?></h3>
    <p class="ms-auto"><a href="#"><span class="icone">< D&eacute;cembre 2022</a>
      </p>
      <p class="ms-5"><a href="#">Février 2023 <span class="icone">></span></a></p>
    </div>
    <hr class="mt-3 mb-5">
    <?
    <article class="card shadow p-0 listing mb-3 px-lg-0">
      <a href="#">
        <div class="row g-0">
          <div class="col-2" id="date">
            <span>03</span>
            <span>NOV</span>
          </div>
          <div class="col-10">
            <div class="card-body">
              <h6 class="card-title">Festival</h6>
              <h5 class="card-title mb-0">Festival International du Film de Comédie de Liège</h5>
              <div class="details">
                <p class="card-text text-secondary"><small>jusqu'au 10 Novembre 2022</small></p>
                <p class="card-text cta"><small>En savoir plus</small></p>
              </div>
            </div>
          </div>
        </div>
      </a>
    </article>
    <article class="card shadow p-0 listing mb-3 px-lg-0">
      <a href="#">
        <div class="row g-0">
          <div class="col-2" id="date">
            <span>03</span>
            <span>NOV</span>
          </div>
          <div class="col-10">
            <div class="card-body">
              <h6 class="card-title">Festival</h6>
              <h5 class="card-title mb-0">Festival International du Film de Comédie de Liège</h5>
              <div class="details">
                <p class="card-text text-secondary"><small>jusqu'au 10 Novembre 2022</small></p>
                <p class="card-text cta"><small>En savoir plus</small></p>
              </div>
            </div>
          </div>
        </div>
      </a>
    </article>
    <article class="card shadow p-0 listing mb-3 px-lg-0">
      <a href="#">
        <div class="row g-0">
          <div class="col-2" id="date">
            <span>03</span>
            <span>NOV</span>
          </div>
          <div class="col-10">
            <div class="card-body">
              <h6 class="card-title">Festival</h6>
              <h5 class="card-title mb-0">Festival International du Film de Comédie de Liège</h5>
              <div class="details">
                <p class="card-text text-secondary"><small>jusqu'au 10 Novembre 2022</small></p>
                <p class="card-text cta"><small>En savoir plus</small></p>
              </div>
            </div>
          </div>
        </div>
      </a>
    </article>
  </section>

</div>

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
      eventClick: function(event, jsEvent, view) {
        $('#modalBodyDescription').html(event.title);
        $('#eventUrlInternal').hide();
        $('#eventUrlExternal').hide();

        $('#eventUrlInternal').attr('href', event.url_internal);
        if (event.url_internal.length > 0)
          $('#eventUrlInternal').show();

        $('#eventUrlExternal').attr('href', event.url);
        if (event.url.length > 0)
          $('#eventUrlExternal').show();

        $('#fullCalModal').modal();
        return false;
      },

      // [{
      //     categorie: 'categorie2',
      //     title: 'Business Lunch',
      //     start: '2023-01-03T13:00:00',
      //     constraint: 'businessHours',
      //     color: '#ea9909'
      //   },
      //   {
      //     categorie: 'categorie1',
      //     title: 'Meeting',
      //     start: '2023-01-13T11:00:00',
      //     constraint: 'availableForMeeting', // defined below
      //     color: '#000000'
      //   },
      //   {
      //     categorie: 'categorie2',
      //     title: 'Conference',
      //     start: '2023-01-18',
      //     end: '2023-01-20',
      //     color: '#ea9909'
      //   },
      //   {
      //     title: 'Party',
      //     start: '2023-01-29T20:00:00'
      //   },
      //   {
      //     categorie: 'categorie1',
      //     start: '2023-01-11T10:00:00',
      //     end: '2023-01-11T16:00:00',
      //     color: '#000000'
      //   },
      //   {
      //     categorie: 'categorie1',
      //     start: '2023-01-13T10:00:00',
      //     end: '2023-01-13T16:00:00',
      //     color: '#000000'
      //   },
      // ]
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