<?php $this->layout('Secret::dashboard') ?>


<div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["fullName","price","active"], "page": 10}' id="filesTable">
    <div class="card-header border-0">

        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-end">
            
            <h2 class="card-header-title h4 text-uppercase">
                Produits <?= $filters['letter'] !== 'AZ' ? 'commençant par '.$filters['letter'] : '';?> (<?= count($listing) ?>)
            </h2>

            <input class="form-control list-search mw-md-300px ms-md-auto mt-5 mt-md-0 mb-3 mb-md-0" type="search" placeholder="Chercher">

        
            <a href="<?=$controller->url('new') ?>" class="btn btn-primary ms-md-4">
                Nouveau
            </a>
        </div>
        <nav class="mt-5" aria-label="filter by letter">
            <?php
                $link_template = '<a href="%s" class="btn btn-sm %s m-1 p-1 px-2">%s</a>';
                foreach(array_merge(['09'], range('A', 'Z'), ['AZ']) as $letter){
                    $href = $controller->router()->hyp('dash_records', ['controller' => 'DVD']).'?letter='.$letter;
                    $class = ($filters['letter'] == $letter) ? 'btn-secondary' : 'btn-outline-secondary';

                    echo sprintf($link_template, $href, $class, $letter);
                }
            ?>
      </nav>
    </div>
    
    <div class="table-responsive">
        <table class="table table-clickable align-middle table-hover table-nowrap mb-0">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="fullName">
                            Titre
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="price">
                            Prix
                        </a>
                    </th>
                    <th>
                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="active">
                            En vente
                        </a>
                    </th>
                </tr>
            </thead>

            <tbody class="list">
            <?php
            foreach($listing as $model){
                ?>
                <tr data-action="<?= $controller->urlFor('DVD', 'view', $model)?>">

                    <td class="fullName">
                        <strong><?= $model->get('label');?></strong>
                    </td>
                    <td class="price">
                        <?= $model->get('price');?> &euro;
                    </td>
                    <td class="active">
                        <?php
                        if($model->get('active')){
                            echo '<img src="/public/assets/dashly/icons/check-double.svg" class="nav-link-icon" height="18" width="18" />';
                        }
                        else{
                            echo '<img src="/public/assets/dashly/icons/disable.svg" class="nav-link-icon" height="18" width="18" />';
                        }

                        ?>
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
