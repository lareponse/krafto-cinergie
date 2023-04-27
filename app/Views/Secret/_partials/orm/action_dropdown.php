<!-- Dropdown -->

<div class="dropdown">
    <a href="javascript: void(0);" class="dropdown-toggle no-arrow d-flex align-items-center justify-content-center btn-light rounded-circle ms-2 text-body w-30px h-30px" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="16" width="16">
            <g>
                <circle cx="3.25" cy="12" r="3.25" style="fill: currentColor" />
                <circle cx="12" cy="12" r="3.25" style="fill: currentColor" />
                <circle cx="20.75" cy="12" r="3.25" style="fill: currentColor" />
            </g>
        </svg>
    </a>
    <ul class="dropdown-menu">
        <li>
            <span class="dropdown-header">Actions</span>
        </li>

        <li>
            <a class="dropdown-item" href="<?= $controller->url('edit') ?>">
                <svg viewBox="0 0 24 24" height="14" width="14" class="me-2" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.001 3.75L12.001 15.75" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                    <path d="M7.501 11.25L12.001 15.75 16.501 11.25" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                    <path d="M23.251,15.75v1.5a3,3,0,0,1-3,3H3.751a3,3,0,0,1-3-3v-1.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                </svg>
                Modifier
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="<?= $controller->url('preview') ?>">
                <svg viewBox="0 0 24 24" height="14" width="14" class="me-2" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12,5.251C7.969,5.183,3.8,8,1.179,10.885a1.663,1.663,0,0,0,0,2.226C3.743,15.935,7.9,18.817,12,18.748c4.1.069,8.258-2.813,10.824-5.637a1.663,1.663,0,0,0,0-2.226C20.2,8,16.031,5.183,12,5.251Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                    <path d="M15.75,12A3.75,3.75,0,1,1,12,8.249,3.749,3.749,0,0,1,15.75,12Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                </svg>
                Voir en ligne
            </a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <a class="dropdown-item" href="<?= $controller->url('toggle') ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="12" width="14" class="me-2">
                    <g>
                        <line x1="1" y1="5" x2="23" y2="5" style="fill: none;stroke: currentColor;stroke-linecap: round;stroke-linejoin: round;stroke-width: 1.5" />
                        <path d="M14.25,1H9.75a1.5,1.5,0,0,0-1.5,1.5V5h7.5V2.5A1.5,1.5,0,0,0,14.25,1Z" style="fill: none;stroke: currentColor;stroke-linecap: round;stroke-linejoin: round;stroke-width: 1.5" />
                        <line x1="9.75" y1="17.75" x2="9.75" y2="10.25" style="fill: none;stroke: currentColor;stroke-linecap: round;stroke-linejoin: round;stroke-width: 1.5" />
                        <line x1="14.25" y1="17.75" x2="14.25" y2="10.25" style="fill: none;stroke: currentColor;stroke-linecap: round;stroke-linejoin: round;stroke-width: 1.5" />
                        <path d="M18.86,21.62A1.49,1.49,0,0,1,17.37,23H6.63a1.49,1.49,0,0,1-1.49-1.38L3.75,5h16.5Z" style="fill: none;stroke: currentColor;stroke-linecap: round;stroke-linejoin: round;stroke-width: 1.5px" />
                    </g>
                </svg>
                Désactiver
            </a>
        </li>
    </ul>

</div>