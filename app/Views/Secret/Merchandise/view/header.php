<div class="row">
    <div class="col-xl-9 d-flex">


        <div class="card border-0 flex-fill w-100">
            <div class="card-body p-7">
                <div class="row align-items-center h-100">
                    <div class="col-auto d-flex ms-auto ms-md-0">
                        <div class="avatar avatar-circle avatar-xxl"><?= $this->DOM()::img($controller->avatarFor($controller->loadModel()), 'photo organisation', ['class' => 'avatar-img', 'width' => 112, 'height' => 112]); ?></div>

                    </div>

                    <div class="col-auto me-auto d-flex flex-column">
                        <h3 class="mb-0"><?= $controller->formModel()->get('label'); ?></h3>
                        <span class="small text-secondary fw-bold d-block mb-4"><?= $controller->formModel()->get('original_title'); ?></span>
                        <div class="d-flex">

                            <a class="btn btn-primary btn-sm me-2" href="<?= $controller->url('edit') ?>">Modifier</a>
                            <a class="btn btn-secondary btn-sm me-2" target="_blank" href="/<?= $controller->loadModel()->isBook() ? 'livre' : 'film'?>/<?= $controller->loadModel()->slug() ?>">Voir en ligne</a>


                            <?= $this->insert('Secret::_partials/orm/action_dropdown'); ?>

                        </div>
                    </div>

                    <div class="col-12 col-md-auto ms-auto text-center mt-8 mt-md-0">
                        <div class="hstack d-inline-flex gap-6">
                            <div>
                                <h4 class="h2 mb-0"><img src="/public/assets/dashly/icons/tag-euro.svg" height="18" width="18" /></h4>
                                <p class="text-secondary mb-0"> <?= $controller->formModel()->get('price') ?? '&mdash;'; ?></p>
                            </div>

                            <div class="vr"></div>

                            <div>
                                <h4 class="h2 mb-0">

                                    <?php
                                    if ($controller->formModel()->get('public')) {
                                        echo '<img src="/public/assets/dashly/icons/check-double.svg" class="nav-link-icon" height="18" width="18" />';
                                    } else {
                                        echo '<img src="/public/assets/dashly/icons/disable.svg" class="nav-link-icon" height="18" width="18" />';
                                    }

                                    ?>
                                </h4>
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
                                <h3 class="mb-0"><?= $controller->formModel()->profileCompletion(); ?>%</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>