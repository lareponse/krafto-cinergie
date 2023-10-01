<div class="row">
    <div class="col-xl-9 d-flex">


        <div class="card border-0 flex-fill w-100">
            <div class="card-body p-7">
                <div class="row align-items-center h-100">
                    <div class="col-auto d-flex ms-auto ms-md-0">
                        <div class="avatar avatar-circle avatar-xxl">
                            <img src="/images/<?= $controller->loadModel()->profilePicture() ?>" alt="..." class="avatar-img" width="112" height="112">
                        </div>
                    </div>

                    <div class="col-auto me-auto d-flex flex-column">
                        <h3 class="mb-0"><?= $controller->loadModel()->get('label'); ?></h3>
                        <span class="small text-secondary fw-bold d-block mb-4">
                            <?= $this->icon('calendar', 18); ?>
                            <?= $controller->loadModel()->get('type_label') ?? 'sans type'; ?>, publication le <span class="otto-date"><?= $controller->loadModel()->get('publication'); ?></span>
                        </span>
                        <div class="d-flex">

                            <a class="btn btn-secondary btn-sm me-2" href="<?= $controller->url('edit') ?>">Modifier</a>

                            <?= $this->insert('Secret::_partials/orm/action_dropdown'); ?>

                        </div>
                    </div>

                    <div class="col-12 col-md-auto ms-auto text-center mt-8 mt-md-0">
                        <div class="hstack d-inline-flex">
                            
                            <?php
                                $class = 'mb-0 ';
                                if($controller->loadModel()->get('isActive')){
                                    $title = 'Rendre invisible sur site';
                                    $class .= 'text-success';
                                }
                                else
                                {
                                    $title = "Rendre visible sur le site";
                                    $class .= 'text-warning';
                                }
                                $icon = $this->icon('recordIsLive', 24, ['title' => $title]);
                                $action = $controller->router()->hyp('dash_record_toggle', [
                                    'controller' => 'Article',
                                    'id' => $controller->loadModel()->getID(),
                                    'field' => 'active'
                                ]);
                                printf('<form action="%s" method="POST"><button type="submit" class="btn %s">%s</button></form>', $action, $class, $icon);

                            ?>


                            <div class="vr"></div>
                            
                            <?php
                                $class = 'mb-0 ';
                                if($controller->loadModel()->get('isDiaporama')){
                                    $title = 'Retirer du diaporama';
                                    $class .= 'text-success';
                                }
                                else
                                {
                                    $title = "Ajouter au diaporama";
                                    $class .= 'text-warning';
                                }
                                $icon = $this->icon('slider', 24, ['title' => $title]);
                                $action = $controller->router()->hyp('dash_record_toggle', [
                                    'controller' => 'Article',
                                    'id' => $controller->loadModel()->getID(),
                                    'field' => 'isDiaporama'
                                ]);
                                printf('<form action="%s" method="POST"><button type="submit" class="btn %s">%s</button></form>', $action, $class, $icon);

                            ?>

                            <div class="vr"></div>
                            
                            <?php
                                $class = 'mb-0 ';
                                if($controller->loadModel()->get('isArchived')){
                                    $title = 'Retirer des archives';
                                    $class .= 'text-success';
                                }
                                else
                                {
                                    $title = "Ajouter aux archives";
                                    $class .= 'text-warning';
                                }
                                $icon = $this->icon('archive', 24, ['title' => $title]);
                                $action = $controller->router()->hyp('dash_record_toggle', [
                                    'controller' => 'Article',
                                    'id' => $controller->loadModel()->getID(),
                                    'field' => 'isArchived'
                                ]);

                                printf('<form action="%s" method="POST"><button type="submit" class="btn %s">%s</button></form>', $action, $class, $icon);
                            ?>
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