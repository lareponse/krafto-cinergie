<?php $this->layout('Secret::dashboard') ?>


<div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["fullName","created_on","approved", "reviewed_by", "reviewed_on"], "page": 20}' id="filesTable">

    <div class="table-responsive">
        <table class="table table-clickable align-middle table-hover table-nowrap mb-0">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="fullName">
                            Nom
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="email">
                            Date

                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="approved">
                            Apprové
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="reviewed_on">
                            Revu le
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="reviewed_by">
                            Revu par
                        </a>
                    </th>
                </tr>
            </thead>

            <tbody class="list">
                <?php
                foreach ($listing as $model) {
                ?>
                    <tr data-action="<?= $controller->urlFor('Submission', 'view', $model) ?>">
                        <td class="fullName">
                            <strong><?= $model; ?></strong>
                        </td>
                        <td class="created_on">
                            <?= $model->get('created_on'); ?>
                        </td>
                        <td class="approved">
                            <?= empty($model->get('approved')) ? 'Non' : 'Oui'; ?>
                        </td>
                        <td class="reviewed_by">
                            <?= empty($model->get('reviewed_by')) ? 'Non' : $model->get('reviewed_by'); ?>
                        </td>
                        <td class="approved">
                            <?= empty($model->get('reviewed_on')) ? 'Non' : $model->get('reviewed_on'); ?>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>

    <div class="card-footer">

        <ul class="pagination justify-content-end list-pagination mb-0"></ul>
    </div>
</div>