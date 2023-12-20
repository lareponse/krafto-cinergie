<div class="p-5 text-center">
    <div class="mb-5"  id="fullcalendar-filters">
        <button class="btn event-cat-all" id="allEvents">Tous</button>
        <button class="btn event-cat-avant_premiere" id="event-cat-avant_premiere">Avant-première</button>
        <button class="btn event-cat-evenement_agenda" id="event-cat-evenement_agenda">Évènement</button>
        <button class="btn event-cat-cineclub" id="event-cat-cineclub">Ciné-club</button>
        <button class="btn event-cat-festival" id="event-cat-festival">Festival</button>
        <button class="btn event-cat-sortie_en_salle" id="event-cat-sortie_en_salle">Sortie</button>
        <button class="btn event-cat-programmation_tv" id="event-cat-programmation_tv">Programmation TV</button>
        <button class="btn event-cat-_autre_agenda" id="event-cat-_autre_agenda">Séances</button>
    </div>
    <div id='calendar'></div>
</div>

<!-- Modal -->
<div class="modal fade" id="fullCalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modalBody" class="modal-body">
                <strong id="modalBodyDescription"></strong><br><br>
                <a id="eventUrlInternal" class="btn btn-primary" target="_blank" style="margin-right: 1em; display: inline-block;" href="">Infos Cinergie</a>
                <a id="eventUrlExternal" class="btn btn-primary" target="_blank" href="" style="display: inline-block;">Infos pratiques</a>
            </div>
        </div>
    </div>
</div>