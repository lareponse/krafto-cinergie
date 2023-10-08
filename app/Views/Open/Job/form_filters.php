<form class="" id="casting-filtre">
    <section class="row" id="filtres-checkbox">
        <div class="col-md-4 pe-lg-4">
            <p class="h5 mb-3">Rémunéré</p>
            <div class="control-group">
            <?php
                foreach (['job_paid' => 'Oui', 'job_free' => 'Non'] as $key => $value) {
                    $checked = $key === $controller->router()->params('remun') ? 'checked="checked"' : '';
                ?>
                    <label class="control control-checkbox">
                        <?= $value ?>
                        <input type="radio" <?= $checked ?> id="remun_<?= $key ?>" name="remun" value="<?= $key ?>">
                        <div class="control_indicator"></div>
                    </label>
                <?php

                }
                ?>
            </div>
        </div>

        <div class="col-md-4 pe-lg-4">
            <p class="h5 mb-3">Types</p>
            <div class="control-group">
                <?php
                foreach ($job_proposal as $key => $value) {
                    $checked = in_array($key, $controller->router()->params('types') ?? []) ? 'checked="checked"' : '';
                ?>

                    <label class="control control-checkbox">
                        <?= $value ?>
                        <input type="checkbox" <?= $checked ?> id="type_<?= $key ?>" name="types[]" value="<?= $key ?>">
                        <div class="control_indicator"></div>
                    </label>
                <?php

                }
                ?>
            </div>
        </div>

        <div class="col-md-4 ps-lg-4 mt-3 mt-lg-0">
            <p class="h5 mb-3">Catégories</p>
            <div class="control-group">
                <?php
                foreach ($categories as $category) {
                    $checked = in_array($category->get('reference'), $controller->router()->params('categories') ?? []) ? 'checked="checked"' : '';
                ?>
                    <label class="control control-checkbox">
                        <?= $category ?>
                        <input type="checkbox" <?= $checked ?> id="category_<?= $category->get('reference') ?>" name="categories[]" value="<?= $category->get('reference') ?>">
                        <div class="control_indicator"></div>
                    </label>
                <?php
                }
                ?>
            </div>
        </div>

    </section>
    <button type="submit">GO</button>
</form>