<div class="mt-4 text-left">
    <?php
    $firstYear ??= 1989;
    $lastYear ??= intval(date('Y'));

    $lastDecade =  intval($lastYear / 10) * 10;
    $firstDecade =  intval($firstYear / 10) * 10;

    foreach (range($lastYear, $lastDecade, 1) as $year) {
        $href = $controller->url('list', ['year' => $year]);
        $class = $filters['year'] == $year ? 'btn-primary' : 'btn-outline-primary';
        echo '<a href="' . $href . '" class="btn btn mx-1 ' . $class . '">' . $year . '</a>';
    }

    foreach (range($lastDecade, $firstDecade, 10) as $decade) {
        $startYear = $decade - 10;

        $class = 'btn-outline-primary';
        $label = $startYear;

        if ($filters['year'] >= $startYear && $filters['year'] < $decade) {
            $class = 'btn-primary';
            $label = $filters['year'];
        }

        echo '<a type="button" class="btn ' . $class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">' . $label . '</a>';
        echo '<ul class="dropdown-menu">';
        foreach (range($decade - 1, $startYear, 1) as $year) {
            $href = $controller->url('list', ['year' => $year]);
            $class = $filters['year'] == $year ? 'bg-primary text-light fw-bold' : '';
            echo '<li><a class="dropdown-item justify-content-center ' . $class . '" href="' . $href . '">' . $year . '</a></li>';
        }
        echo '</ul>';
    }

    ?>
</div>


<div class="mt-3 text-left" role="group" aria-label="Button group with nested dropdown">
    <?php

    foreach (range(1, 12) as $month) {
        $href = $controller->url('list', ['year' => $filters['year'], 'month' => $month]);
        $class = $filters['month'] == $month ? 'btn-secondary' : 'btn-outline-secondary';
        echo '<a href="' . $href . '" class="btn btn-sm mx-1 ' . $class . '">' . $month . '</a>';
    }

    ?>
</div>