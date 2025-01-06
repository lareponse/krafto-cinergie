<?php 
$model = $model ?? $controller->loadModel() ?? $controller->formModel();
$route = $route ?? 'dash_'.$model->model_type().'_delete';

if(empty($model->id())){
    throw new \Exception('Cannot delete a model without an ID');
}

?>

<form method="POST" action="<?= $controller->router()->hyp($route)?>">
<input type="hidden" name="urn" value="<?= $model->nid();?>" />
<input type="hidden" name="id" value="<?= $model->id();?>" />


<div class="card border-0 scroll-mt-3" id="deleteSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Supprimer</h2>
    </div>

    <div class="card-body">
        <div class="alert text-bg-danger-soft d-flex align-items-center" role="alert">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="32" width="32" class="me-3"><path d="M23.39,10.53,13.46.6a2.07,2.07,0,0,0-2.92,0L.61,10.54a2.06,2.06,0,0,0,0,2.92h0l9.93,9.92A2,2,0,0,0,12,24a2.07,2.07,0,0,0,1.47-.61l9.92-9.92A2.08,2.08,0,0,0,23.39,10.53ZM11,6.42a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Zm1.05,11.51h0a1.54,1.54,0,0,1-1.52-1.47A1.47,1.47,0,0,1,12,14.93h0A1.53,1.53,0,0,1,13.5,16.4,1.48,1.48,0,0,1,12.05,17.93Z" style="fill: currentColor"/></svg>
            </div>
            <div>
                <h4 class="mb-1">Vous allez supprimer "<?=$model->get('label')?>".</h4>
                Vous ne pourrez plus retrouver ou modifier cet enregistrement. 
                <br/>Tous les liens avec les autres éléments du site seront supprimés et ils n'apparaiteront plus sur le site.
            </div>
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="confirmed" id="deleteAccount">
                <label class="form-check-label" for="deleteAccount">
                    J'ai bien compris les conséquences
                </label>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-5">
            <button type="button" class="btn btn-danger">Supprimer</button>
        </div>
    </div>
</div>
</form>