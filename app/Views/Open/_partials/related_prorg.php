<a class="prorg" href="<?= $href ?>" title="Page de <?= $item; ?>" arial-label="Page de <?= $item; ?>">
    <img src="<?= $controller->avatarFor($item) ?>" alt="Photo de profile de <?= $item; ?>" class="avatar">
    <strong><?= $item; ?></strong>
    <div class="meta">
        <?php
        if($item->get('workedAs')){
            foreach (explode(',', $item->get('workedAs')) as $id) {
                echo '<span class="comma otto-id-label" kx-gender="' . $item->get('gender') . '" otto-urn="Tag:' . trim($id) . '">' . $id . '</span>';
            }
        }
        ?>
    </div>
</a>