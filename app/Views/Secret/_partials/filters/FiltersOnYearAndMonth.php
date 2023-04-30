<nav class="mt-5" aria-label="filter by year">
    <?php

    $lastYear ??= intval(date('Y'));
    $firstYear ??= $lastYear-10;

    $filters['year'] ??= $lastYear;
    $filters['month'] ??= intval(date('m'));

    $link_template = '<a href="%s" class="btn btn-sm %s m-1 p-1 px-2">%s</a>';
    foreach (array_reverse(range($firstYear, $lastYear)) as $year) {
        $href = $controller->url('list', ['year' => $year]);

        $class = $filters['year'] == $year ? 'btn-secondary' : 'btn-outline-secondary';

        echo sprintf($link_template, $href, $class, $year);
    }

    if (isset($filters['year'])) {
        echo '</nav><nav class="mt-1" aria-label="filter by month">';

        foreach (range(1, 12) as $month) {
            $href = $controller->url('list', ['year' => $filters['year'], 'month' => $month]);

            $class = $filters['month'] == $month ? 'btn-secondary' : 'btn-outline-secondary';

            echo sprintf($link_template, $href, $class, $month);
        }
    }
    ?>
</nav>