<div class="row">
    <div class="col-xl-9 d-flex">

        
        <div class="card border-0 flex-fill w-100">
            <div class="card-body p-7">
                <div class="row align-items-center h-100">
                    <div class="col-auto d-flex ms-auto ms-md-0">
                        <div class="avatar avatar-circle avatar-xxl">
                            <img src="<?= $controller->loadModel()->get('legacy_photo_illu')?>" alt="..." class="avatar-img" width="112" height="112">
                        </div>
                    </div>

                    <div class="col-auto me-auto d-flex flex-column">
                        <h3 class="mb-0"><?= $controller->loadModel()->get('label');?></h3>
                        <span class="small text-secondary fw-bold d-block mb-4">
                            <?= $this->icon('calendar', 18);?>
                            <?= $controller->loadModel()->get('type_label') ?? 'sans type'; ?>, publication le <span class="otto-date"><?= $controller->loadModel()->get('publication'); ?></span>
                        </span>
                        <div class="d-flex">
                        
                            <a class="btn btn-primary btn-sm me-2" href="<?= $controller->url('edit') ?>">Modifier</a>

                            <?= $this->insert('Secret::_partials/orm/action_dropdown');?>

                        </div>
                    </div>

                    <div class="col-12 col-md-auto ms-auto text-center mt-8 mt-md-0">
                        <div class="hstack d-inline-flex gap-6">
                            <div>
                                
                                <h4 class="h2 mb-0"><?= $this->icon('slider', 18);?></h4>
                                <p class="text-secondary mb-0"><?= $controller->loadModel()->get('isDiaporama') ? 'Oui' : 'Non' ?></p>
                            </div>

                            <div class="vr"></div>

                            <div>
                                <h4 class="h2 mb-0"><?= $this->icon('archive', 18);?></h4>
                                <p class="text-secondary mb-0"><?= $controller->loadModel()->get('isArchived') ? 'Oui' : 'Non' ?></p>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div class="col-xl-3 d-none d-xl-flex">

        
        <div class="card border-0 flex-fill w-100">
            <div class="card-body text-center">
                <div class="row align-items-center h-100">
                    <div class="col">
                        <small class="text-secondary">Profile completion</small>

                        <!-- Chart -->
                        <div class="chart-container w-100px h-100px mx-auto mt-3">
                            <canvas id="profileCompletionChart"></canvas>

                            <!-- Labels -->
                            <div class="position-absolute top-50 start-50 translate-middle text-center">
                                <h3 class="mb-0">?%</h3>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div> 
