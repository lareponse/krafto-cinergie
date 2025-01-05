<a class="prorg" href="<?= $href ?>" title="Page de <?= $item; ?>" arial-label="Page de <?= $item; ?>">
    <img src="<?= $item->profilePicture() ?>" alt="Photo de profile de <?= $item; ?>" class="avatar">
    <strong><?= $item; ?></strong>
    <div class="meta">
        <?php
        foreach (explode(',', $item->get('workedAs')) as $id) {
            echo '<span class="comma otto-id-label" kx-gender="' . $item->get('gender') . '" otto-urn="Tag:' . trim($id) . '">' . $id . '</span>';
        }
        ?>
    </div>
</a>