<div class="row" data-sortable>

    <div class="col-md-6 col-xl-3">
        <div class="dropzone text-center px-4 py-6 dz-clickable" data-dropzone style="height:200px; background:white">
            <div class="dz-message w-100 d-flex align-items-center justify-content-center">
                <div>
                    <?= $this->icon('upload', 20) ?>
                    <strong class="d-block mt-4">Ajouter</strong>
                </div>
            </div>
        </div>
    </div>

    <?php
    foreach ($images as $image) {
        $path = $directory . '/'.$image;
        $url = $controller->get('settings.urls.images');
    ?>
        <div class="col-md-6 col-xl-3">
            
            <!-- Card -->
            <div class="card border-0">
  
                <div href="<?= '@' ?>" class="card-body card-image-background  cursor-move" style="background-image:url('<?= $url.'/'.$path; ?>');">
                </div>

                <div class="controls">
                    <?php 
                    $route_params = [
                        'externalController' => $controller->nid(), 
                        'slug' => $controller->loadModel()->slug(), 
                        'filename' => $image
                    ];
                    $route = $controller->router()->hyp('dash_image_delete', $route_params); 
                    ?>
                    <form action="<?= $route ?>" method="POST" class="control">
                        <input type="hidden" name="filename" value="<?= $image?>" />
                        <button type="submit" class="icon text-primary p-1"><?= $this->icon('delete', 18);?></button>
                    </form>
                    <?php
                    
                    if($controller->loadModel()->hasProfilePicture() && $controller->loadModel()->profilePicturePath() === $path){
                        $class = 'text-success';
                        $href = $controller->router()->hyp('dash_record_unset_profile_picture', ['nid' => $controller->nid(), 'id' => $controller->loadModel()->id()]);
                        $title = 'Ne plus utiliser comme photo principale';
                    }
                    else{
                        $class ='text-secondary';
                        $href = $controller->router()->hyp('dash_record_set_profile_picture', ['nid' => $controller->nid(), 'id' => $controller->loadModel()->id(), 'path' => $path]);
                        $title = 'Définir comme photo principale';

                    }
                    ?>
                    <a href="<?= $href?>" class="control <?= $class ?> p-1"><?= $this->icon('avatar', 18, ['title' => $title]);?></a>
                    <?php
                    $route_params = [
                        'nid' => $controller->nid(), 
                        'slug' => $controller->loadModel()->slug(),
                        'filename' => $image
                    ];
                    ?>
                    <a href="<?=$controller->router()->hyp('dash_image_details', $route_params)?>" class="control text-secondary p-1"><?= $this->icon('eye', 18);?></a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>