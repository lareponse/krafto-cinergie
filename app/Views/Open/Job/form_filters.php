<div id="filtre-mobile" class="d-block">
    <button id="filtreBtn" class="btn btn-black" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtre-sidebar">
        <i class="bi bi-sliders me-2"></i>Filtrer
    </button>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="filtre-sidebar">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="offcanvasExampleLabel">Annonces</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="filtres-checkbox">

                <div class="mb-3 pe-lg-4">
                    <p class="h5 mb-3">Rémunéré</p>
                    <div class="control-group form-check ps-5">
                        <?php
                        foreach (['job-paid' => 'Oui', 'job-free' => 'Non'] as $key => $value) 
                        {
                            $reference = 'isPaid_'.$key;
                            $checked = $key === $controller->router()->params('remun') ? 'checked="checked"' : '';
                            echo $this->Form()::radio('isPaid', $key, ['id' => $reference, 'class' => 'control_indicator form-check-input', 'checked' => $checked]);
                            echo $this->Form()::label($reference, $value, ['class' => 'control form-check-label']);
                        }
                        ?>
                    </div>
                </div>

                <div class="mb-3 pe-lg-4">
                    <p class="h5 mb-3">Types</p>
                    <div class="control-group form-check ps-5">
                    <?php
                        foreach ($job_proposal as $key => $value) 
                        {
                            $reference = 'type_'.$key;
                            $checked = in_array($key, $controller->router()->params('types') ?? []) ? 'checked="checked"' : '';
                            echo $this->Form()::radio('isOffer', $key, ['id' => $reference, 'class' => 'control_indicator form-check-input', 'checked' => $checked]);
                            echo $this->Form()::label($reference, $value, ['class' => 'control form-check-label', 'for' => $reference]);
                        }
                    ?>
      
                    </div>
                </div>

                <div class="mb-3  mt-3 mt-lg-0">
                    <p class="h5 mb-3">Catégories</p>
                    <div class="control-group form-check ps-5">
                        <?php
                            foreach ($categories as $category)
                            {
                                $reference = 'category_'.$category->slug();
                                $checked = in_array($category->slug(), $controller->router()->params('categories') ?? []) ? 'checked="checked"' : '';
                                echo $this->Form()::checkbox('categories[]', $category->slug(), ['id' => $reference, 'class' => 'control_indicator form-check-input', 'checked' => $checked]);
                                echo $this->Form()::label($reference, $category, ['class' => 'control form-check-label', 'for' => $reference]);
                            }
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <button class="btn btn-primary submit-filters">Rechercher</button>
                    </div>
                    <div class="col-md-6">
                        <button type="reset" class="btn btn-outline-primary white-btn">Vider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>