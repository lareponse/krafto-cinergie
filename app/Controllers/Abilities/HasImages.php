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
        $this->viewport('images', $this->imagesFor($this->loadModel()->get('slug')));
    }

    // returns an array of image file names (filtered on allowed extensions), or empty array
    public function imagesFor($directory): array
    {
        $dir_path = $this->buildPathTo($directory);
        if(!is_dir($dir_path))
            return [];

        $files = scandir($dir_path);

        if(is_array($files)){
            return array_filter($files, function($file){ 
                return $this->allowedExtension(pathinfo($file, PATHINFO_EXTENSION)); 
            });
        }

        return [];
    }

    public function imageUnlink()
    {
        $src_path = $this->router()->submitted('filename');
        $src_path = $this->buildPathTo($this->loadModel()->slug(), $src_path);
        // vd($src_path);        

        // check for permission
        // dd('IMPLEMENT OPERATOR PERMISSION CHECK');
        // check for path pertinence (no deletion outside /public/image/xxx/_A/Alainterieur/)

        // dd('IMPLEMENT PATH PERTINENCE CHECK');
        $res = file_exists($src_path);
        // vd($res);      
        $res =  is_file($src_path);
        // vd($res);      
        $res =  unlink($src_path);
        // dd($res);
        $this->router()->hopBack();
    }

    // returns error string or true
    private function validTargetDirector($targetDir)
    {
        // Create the folder if it doesn't exist
        if (!file_exists($targetDir) && mkdir($targetDir, 0777, true) === false) {
            return 'UNABLE_TO_CREATE_MISSING_TARGET_DIRECTORY';
        }

        if(!is_dir($targetDir)){
            return 'TARGET_DIRECTORY_NOT_A_DIRECTORY';
        }

        if(!is_writable($targetDir)){
            return 'TARGET_DIRECTORY_NOT_WRITABLE';
        }

        return true;
    }

    public function imageUpload()
    {
        $context = [];

        $targetDir = $this->buildPathTo($this->loadModel()->slug());
        $context['targetDir'] = $targetDir;
    
        if($this->validTargetDirector($targetDir, $context))
        {
            foreach($_FILES['file']['name'] as $i => $filename)
            {
                $temporary_filename = $_FILES['file']['tmp_name'][$i];

                $targetFile = $this->buildPathTo($this->loadModel()->slug(),basename($filename));
                
                // Move the uploaded file to the target directory
                vd($temporary_filename, $targetFile);
                if(move_uploaded_file($temporary_filename, $targetFile) === false){
                    $context = [
                        'failed-for-filename' => $filename, 
                        'target' => $targetFile,
                        '$_FILES' => $_FILES,
                    ];
                    $this->addError('UPLOAD_FAILURE', $context);
                }
            }
        }

        vd($this->errors(), 'errors');

        return $this->errors();
    }

    public function allowedExtension($extension): bool
    {
        return in_array(strtolower($extension), $this->allowedExtensions());
    }

    public function allowedExtensions(): array
    {
        return $this->get('settings.images.allowedExtensions');
    }

    public function imagesRootPath(): string
    {
        return $this->get('settings.folders.images');
    }

    public function imagesClassPath(): string
    {
        return get_class($this->loadModel())::model_type();
    }

    public function imagesModelPath($directory): string
    {
        $prefix = substr($directory, 0, 1);
        
        if(is_numeric($prefix))
            $prefix = 0;
        
        return sprintf('_%s/%s', $prefix, $directory);
    }

    public function imagesRootURL(): string
    {
        return $this->get('settings.urls.images');
    }

    public function imagesClassURL(): string
    {
        return $this->imagesClassPath();
    }

    public function imagesModelURL($directory): string
    {
        return $this->imagesModelPath($directory);
    }

    public function buildPathTo($directory, $file='')
    {
        return implode('/', [
                $this->imagesRootPath(), 
                $this->imagesClassPath(),
                $this->imagesModelPath($directory),
                $file
            ]
        );
    }

    public function buildURLTo($directory, $file)
    {
        return implode('/', [
                $this->imagesRootURL(), 
                $this->imagesClassURL(),
                $this->imagesModelURL($directory),
                $file
            ]
        );
    }

}
