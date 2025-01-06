<article>
    <a class="d-none d-md-flex" href="<?= $href ?>">
        <img src="<?= $item->profilePicture() ?>" alt="Photo de profile de <?= $item; ?>" class="avatar">
    </a>
    <h4><a href="<?= $href ?>"><?= $item; ?></a></h4>
    <?php
    foreach (explode(',', $item->get('workedAs')) as $id) {
        echo '<span class="d-block otto-id-label" kx-gender="' . $item->get('gender') . '" otto-urn="Tag:' . $id . '">' . $id . '</span>';
    }
    ?>
</article>