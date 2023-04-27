<?php $this->layout('Secret::view') ?>


<ul class="nav nav-tabs" id="viewPage">

    <li class="nav-item" role="presentation">
        <a href="javascript: void(0);" class="nav-link active" id="movies-tab" data-bs-toggle="tab" data-bs-target="#movies" role="tab" aria-controls="movies" aria-selected="false">
            Movies
            <span class="badge text-bg-dark-soft rounded-circle d-inline-flex align-items-center justify-content-center w-20px h-20px ms-1"><?= count($movies);?></span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="javascript: void(0);" class="nav-link" id="articles-tab" data-bs-toggle="tab" data-bs-target="#articles" role="tab" aria-controls="articles" aria-selected="false">
            Articles
            <span class="badge text-bg-dark-soft rounded-circle d-inline-flex align-items-center justify-content-center w-20px h-20px ms-1"><?= count($articles);?></span>
        </a>
    </li>
   

</ul>

<div class="tab-content pt-6" id="viewPageContent">
    <div class="tab-pane fade show active" id="movies" role="tabpanel" aria-labelledby="movies-tab">
        <?php $this->insert('Secret::Movie/_partials/tab-movies', ['movies' => $movies]) ?>
    </div>

    <div class="tab-pane fade" id="articles" role="tabpanel" aria-labelledby="articles-tab">
        <?php $this->insert('Secret::Article/list', ['listing' => $articles]) ?>
    </div>
</div>
