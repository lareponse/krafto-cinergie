<div class="row">
    <div class="col-xl-9 d-flex">


        <div class="card border-0 flex-fill w-100">
            <div class="card-body p-7">
                <div class="row align-items-center h-100">
                    <div class="col-auto d-flex ms-auto ms-md-0">
                        <div class="avatar avatar-circle avatar-xxl">
                            <img src="<?= $controller->loadModel()->profilePicture() ?>" alt="..." class="avatar-img" width="112" height="112">
                        </div>
                    </div>

                    <div class="col-auto me-auto d-flex flex-column">
                        <h3 class="mb-0"><?= $controller->loadModel()->get('label'); ?></h3>
                        <span class="small text-secondary fw-bold d-block mb-4">
                            <?= $this->icon('calendar', 18); ?>
                            <span class="otto-id-label" otto-urn="Tag:<?= $controller->loadModel()->get('type_id'); ?>"><?= $controller->loadModel()->get('type_id') ?? 'sans type'; ?></span>, 
                            publication le <span class="otto-date"><?= $controller->loadModel()->get('publication'); ?></span>
                        </span>
                        <div class="d-flex">
                            <a class="btn btn-secondary btn-sm me-2" href="<?= $controller->url('edit') ?>">Modifier</a>

                            <?= $this->insert('Secret::_partials/orm/action_dropdown'); ?>

                        </div>
                    </div>

                    <div class="col-12 col-md-auto ms-auto text-center mt-8 mt-md-0">
                        <div class="hstack d-inline-flex">

                            <?php
                            $buttons = [
                                [
                                    'field' => 'active',
                                    'true_title' => 'Rendre invisible sur site',
                                    'false_title' => 'Rendre visible sur le site',
                                    'icon' => 'recordIsLive',
                                ],
                                [
                                    'field' => 'isDiaporama',
                                    'true_title' => 'Retirer du diaporama',
                                    'false_title' => 'Ajouter au diaporama',
                                    'icon' => 'slider',
                                ],
                                [
                                    'field' => 'isArchived',
                                    'true_title' => 'Retirer des archives',
                                    'false_title' => 'Ajouter aux archives',
                                    'icon' => 'archive',
                                ],
                            ];

                            foreach ($buttons as $button) {
                                $class = 'mb-0 ';
                                $title = $controller->loadModel()->get($button['field']) ? $button['true_title'] : $button['false_title'];
                                $class .= $controller->loadModel()->get($button['field']) ? 'text-success' : 'text-warning';
                                $icon = $button['icon'];
                                $action = $controller->router()->hyp('dash_record_toggle', [
                                    'nid' => 'Article',
                                    'id' => $controller->loadModel()->id(),
                                    'field' => $button['field'],
                                ]);
                                printf('<form action="%s" method="POST"><button type="submit" class="btn %s" title="%s">%s</button></form>', $action, $class, $title, $this->icon($icon, 24));
                                echo '<div class="vr"></div>';
                            }
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