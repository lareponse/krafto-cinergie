<?php $this->layout('Secret::dashboard', ['title' => 'Images']) ?>

<form action="/dash/Article/8192/upload" method="post" enctype="multipart/form-data">
    <label for="file">Select a file:</label>
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    <input type="file" name="files[]" id="files">
    <input type="file" name="files[]" id="files">
    <input type="file" name="anothfiles[]" id="files">
    <input type="file" name="afile" id="files">
    <br><br>
    <input type="submit" value="Upload File">
</form>

<div class="row">

    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_images_deadlinks', ['controller' => 'Article']); ?>" class="card border-0 flex-fill w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Images perdues</h5>
                        <h2 class="mb-0">Articles</h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('relations', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">

        <a href="<?= $controller->router()->hyp('dash_images_deadlinks', ['controller' => 'Organisation']); ?>" class="card border-0 flex-fill w-100">

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Images perdues</h5>
                        <h2 class="mb-0">Films</h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('relations', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>

    </div>
    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">

        <a href="<?= $controller->router()->hyp('dash_images_deadlinks', ['controller' => 'Professional']); ?>" class="card border-0 flex-fill w-100">

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Images perdues</h5>
                        <h2 class="mb-0">Personne</h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('relations', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>

    </div>

</div>

</div>