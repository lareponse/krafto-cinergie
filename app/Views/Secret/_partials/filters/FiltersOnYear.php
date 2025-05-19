<div class="mt-4 text-left">
    <?php
    $firstYear ??= 1989;
    $lastYear ??= intval(date('Y'));
    $selectedYear = $filters['year'] ?? null;
    
    $lastDecade =  intval($lastYear / 10) * 10;
    $firstDecade =  intval($firstYear / 10) * 10;

    foreach (range($lastYear, $lastDecade, 1) as $year) {
        $href = $controller->url('list', ['year' => $year]);
        $class = ($selectedYear) == $year ? 'btn' : 'btn-outline';
        printf('<a href="%s" class="btn %s-primary mx-1">%d</a>', $href, $class, $year);
    }

    foreach (range($lastDecade, $firstDecade, 10) as $decade) {
        $startYear = $decade - 10;

        $class = 'btn-outline';
        $label = $startYear;

        if ($selectedYear >= $startYear && $selectedYear < $decade) {
            $class = 'btn';
            $label = $selectedYear;
        }

        printf('<a type="button" class="btn %s-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">%s</a>', $class, $label);
        echo '<ul class="dropdown-menu">';
        foreach (range($decade - 1, $startYear, 1) as $year) {
            $href = $controller->url('list', ['year' => $year]);
            $class = $selectedYear == $year ? 'bg-primary text-light fw-bold' : '';
            printf('<li><a class="dropdown-item justify-content-center %s" href="%s">%d</a></li>', $class, $href, $year);
        }
        echo '</ul>';
    }
    ?>
</div>