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