<?php
namespace App\Controllers\Abilities;

trait HasImages
{
    abstract public function loadModel();
    abstract public function get($dependency);
    abstract public function viewport($key, $value);
    abstract public function errors(): array;
    abstract public function addError($message, $context = []);

    public function HasImages__Traitor_after_view()
    {
        $this->viewport('images', $this->imagesFor());
    }


    // returns an array of image file names (filtered on allowed extensions), or empty array
    public function imagesFor(): array
    {
        $directory = $this->buildRelativeLocator();
        
        $filer = new FileManager($this->imagesRootPath());
        $filer->setRootURL($this->imagesRootURL());
        $files = $filer->listFiles($directory);
        
        // put profile picture first
        if($this->loadModel()->hasProfilePicture()){
            $filename = $this->loadModel()->profilePicture();
            $filename = pathinfo($filename, PATHINFO_FILENAME).'.'.pathinfo($filename, PATHINFO_EXTENSION);
            if (($key = array_search($filename, $files)) !== false) {
                unset($files[$key]);
                array_unshift($files, $filename);
            }
        }
        $this->viewport('images', $files);
        $this->viewport('fileManager', $filer);
        return $files;
    }

    public function imageUnlink()
    {
        try{
            $src_path = $this->router()->submitted('filename');
            $filer = new FileManager($this->imagesRootPath());
            $filer->removeFile($this->buildRelativeLocator($src_path));
        }catch(\Throwable $t){
            dd($t);
            // TODO add message to user
        }
        $this->router()->hopBack();
    }

    public function dropzoneUpload()
    {
        $filer = new FileManager($this->imagesRootPath());
        
        $targetDir = $filer->absolutePathFor($this->buildRelativeLocator());
        $uploader = new FileUploader($targetDir, $this->get('settings.images.allowedMIMETypes'));
        $uploader->handleUpload($_FILES);

        $response = [];

        // dd($uploader->errors());

        header('Content-Type: application/json');

        if(empty($uploader->errors()))
        {
            http_response_code(200);
            $response = ["status" => "success", "message" => "Tous les fichiers ont été téléversés"];
        }
        else
        {
            http_response_code(400);
            foreach($uploader->errors() as $message){
                $response[] = ["status" => "error", "message" => $message];
            }
        }

        echo json_encode($response);
        die;
    }

    
    public function setProfilePicture()
    {
        $this->loadModel()->set('profilePicture', $this->router()->params('path'));
        $this->loadModel()->save(0);
        $this->router()->hopBack();
    }

    public function unsetProfilePicture()
    {
        $this->loadModel()->set('profilePicture', null);
        $this->loadModel()->save(0);
        $this->router()->hopBack();
    }
    public function imagesRootPath(): string
    {
        return $this->get('settings.folders.images');
    }

    public function imagesRootURL(): string
    {
        return $this->get('settings.urls.images');
    }

    public function buildRelativeLocator(string $file=null): string
    {
        $slug = $this->loadModel()->slug();

        $pathComponents = [];
        $pathComponents []= get_class($this->loadModel())::model_type();
        $pathComponents []= sprintf('_%s', (is_numeric($prefix = substr($slug, 0, 1)) ? 0 : $prefix));
        $pathComponents []= $slug;

        if(!is_null($file))
            $pathComponents[] = $file;

        return implode('/', $pathComponents);
    }

}
