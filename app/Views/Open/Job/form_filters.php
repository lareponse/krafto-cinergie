<form class="filtres-checkbox">
    <div class="mb-3 pe-lg-4">
        <p class="h5 mb-3">Rémunéré</p>
        <div class="control-group form-check ps-5">
            <?php
            foreach ([1 => 'Oui', 0 => 'Non'] as $key => $label) {

                $reference = 'isPaid_' . $key;
                $checked = ($controller->router()->params('isPaid') !== null && $controller->router()->params('isPaid') == $key) ? 'checked="checked"' : '';

                echo $this->Form()::radio('isPaid', $key, ['id' => $reference, 'class' => 'control_indicator form-check-input', 'checked' => $checked]);
                echo $this->Form()::label($reference, $label, ['class' => 'control form-check-label', 'for' => $reference]);
            }
            ?>
        </div>
    </div>

    <div class="mb-3 pe-lg-4">
        <p class="h5 mb-3">Types</p>
        <div class="control-group form-check ps-5">
            <?php

            
            foreach ($job_proposal as $key => $value) {
                $reference = 'isOffer_' . $key;
                $value_int = (int)($key == 'job-offer');
                $checked = ($controller->router()->params('isOffer') !== null && $controller->router()->params('isOffer') == $value_int) ? 'checked="checked"' : '';

                echo $this->Form()::radio('isOffer', $value_int, ['id' => $reference, 'class' => 'control_indicator form-check-input', 'checked' => $checked]);
                echo $this->Form()::label($reference, $value, ['class' => 'control form-check-label', 'for' => $reference]);
            }
            ?>

        </div>
    </div>

    <div class="mb-3 mt-3 mt-lg-0">
        <p class="h5 mb-3">Catégories</p>
        <div class="control-group form-check ps-5">
            <?php

            foreach ($categories as $category) {
                $reference = 'category_' . $category->slug();
                $checked = in_array($category->slug(), $controller->router()->params('categories') ?? []) ? 'checked="checked"' : '';

                echo $this->Form()::checkbox('categories[]', $category->slug(), ['id' => $reference, 'class' => 'control_indicator form-check-input', 'checked' => $checked]);
                echo $this->Form()::label($reference, $category, ['class' => 'control form-check-label', 'for' => $reference]);
            }
            ?>
        </div>
    </div>

    <div class="d-flex gap-2">
        <input type="submit" class="btn btn-primary submit-filters" value="Rechercher" />
        <input type="reset" class="btn btn-outline-primary white-btn" value="Annuler" />
    </div>
</form>