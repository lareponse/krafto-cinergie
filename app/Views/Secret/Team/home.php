<?php $this->layout('Secret::dashboard') ?>



<ul class="nav nav-tabs" id="userTab">


    <li class="nav-item" role="presentation">
        <a href="javascript: void(0);" class="nav-link active" id="equipe-tab" data-bs-toggle="tab" data-bs-target="#equipe" role="tab" aria-controls="equipe" aria-selected="true">
            L'Equipe
            <span class="badge text-bg-dark-soft rounded-circle d-inline-flex align-items-center justify-content-center w-20px h-20px ms-1"><?= count($team['equipe']);?></span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="javascript: void(0);" class="nav-link d-flex align-items-center" id="collaborateurs-tab" data-bs-toggle="tab" data-bs-target="#collaborateurs" role="tab" aria-controls="collaborateurs" aria-selected="false">
            Collaborateurs réguliers
            <span class="badge text-bg-dark-soft rounded-circle d-inline-flex align-items-center justify-content-center w-20px h-20px ms-1"><?= count($team['collaborateur']);?></span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="javascript: void(0);" class="nav-link" id="CA-tab" data-bs-toggle="tab" data-bs-target="#CA" role="tab" aria-controls="CA" aria-selected="false">
            Conseil d'administration
            <span class="badge text-bg-dark-soft rounded-circle d-inline-flex align-items-center justify-content-center w-20px h-20px ms-1"><?= count($team['CA']);?></span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="javascript: void(0);" class="nav-link" id="member-tab" data-bs-toggle="tab" data-bs-target="#member" role="tab" aria-controls="member" aria-selected="false">
            Membres
            <span class="badge text-bg-dark-soft rounded-circle d-inline-flex align-items-center justify-content-center w-20px h-20px ms-1"><?= count($team['membre']);?></span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="javascript: void(0);" class="nav-link" id="observateurs-tab" data-bs-toggle="tab" data-bs-target="#observateurs" role="tab" aria-controls="observateurs" aria-selected="false">
            Observateurs
            <span class="badge text-bg-dark-soft rounded-circle d-inline-flex align-items-center justify-content-center w-20px h-20px ms-1"><?= count($team['observateur']);?></span>
        </a>
    </li>

</ul>

<div class="tab-content pt-6" id="userTabContent">

    <div class="tab-pane fade show active" id="equipe" role="tabpanel" aria-labelledby="equipe-tab">
        <?php $this->insert('Secret::Team/_partials/tab-people', ['people' => $team['equipe']]) ?>
    </div>

    <div class="tab-pane fade" id="collaborateurs" role="tabpanel" aria-labelledby="collaborateurs-tab">
        <?php $this->insert('Secret::Team/_partials/tab-people', ['people' => $team['collaborateur']]) ?>
    </div>

    <div class="tab-pane fade" id="CA" role="tabpanel" aria-labelledby="CA-tab">
        <?php $this->insert('Secret::Team/_partials/tab-people', ['people' => $team['CA']]) ?>
    </div>

    <div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab">
        <?php $this->insert('Secret::Team/_partials/tab-people', ['people' => $team['membre']]) ?>
    </div>

    <div class="tab-pane fade" id="observateurs" role="tabpanel" aria-labelledby="observateurs-tab">
        <?php $this->insert('Secret::Team/_partials/tab-people', ['people' => $team['observateur']]) ?>
    </div>

</div>