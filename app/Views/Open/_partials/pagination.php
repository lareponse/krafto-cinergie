<div class="mt-5">
    <?php
    if ($paginator->last() > 1) {
        $params = $controller->router()->params();
    ?>
        <section class="mt-5" id="pagination">
            <div class="precedent call-to-action">
                <a class="cta" href="<?= $controller->router()->hyp($route) . '?' . http_build_query(array_merge($params, ['page' => $paginator->previous()])); ?>">Précédent</a>
            </div>

            <div class="pages-numbers text-center">
                <p>
                    <?php
                    if ($paginator->hasFirstSpacer()) {
                    ?>
                        <a class="page-btn" href="<?= $controller->router()->hyp($route) . '?' . http_build_query(array_merge($params, ['page' => 1])); ?>">1</a>
                        <span class="page-btn">...</span>
                    <?php
                    }

                    foreach ($paginator->range() as $number) {
                        $class = $paginator->current() == $number ? 'active' : '';
                        printf('<a class="page-btn %s" href="%s">%d</a>', $class, $controller->router()->hyp($route) . '?' . http_build_query(array_merge($params, ['page' => $number])), $number);
                    }

                    if ($paginator->hasLastSpacer()) {
                    ?>
                        <span class="page-btn">...</span>
                        <a class="page-btn" href="<?= $controller->router()->hyp($route) . '?' . http_build_query(array_merge($params, ['page' => $paginator->last()])); ?>"><?= $paginator->last() ?></a>
                    <?php
                    }
                    ?>
                </p>

            </div>
            <div class="suivant call-to-action">

                <a class="cta" href="<?= $controller->router()->hyp($route) . '?' . http_build_query(array_merge($params, ['page' => $paginator->next()])); ?>">Suivant</a>
            </div>
        </section><?php
                }
                    ?>
    <small class="d-block text-center text-secondary text-small">
        <?php
        list($first, $last, $total) = $paginator->nowShowing();
        printf('%d-%d sur %d', $first, $last, $total);
        ?>

    </small>
</div>