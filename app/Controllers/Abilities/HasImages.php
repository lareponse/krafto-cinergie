<?php
namespace App\Controllers\Abilities;

use HexMakina\LocalFS\FileSystem;

trait HasImages
{
    abstract public function loadModel();
    abstract public function get($dependency);
    abstract public function viewport($key, $value);
    abstract public function addError($message, $context = []);

    // abstract public function imagesDirectory(): string;
    
    public function imagesDirectory(): string
    {
        return $this->nid();
    }
    public function HasImages__Traitor_after_save(){
        if($this->loadModel()->slug() !== $this->formModel()->slug()){
   
            $controller = $this->get('Controllers\\Secret\\Image');
            $directory = $controller->buildRelativeLocator($this);
            $fs = new FileSystem($controller->imagesRootPath());

            $old = $this->loadModel()->slug();
            $new = $this->formModel()->slug();
            $new = str_replace($old, $new, $fs->absolutePathFor($directory));
            $res = FileSystem::move($fs->absolutePathFor($directory), $new);
        }
    }

    public function HasImages__Traitor_after_view(){
        $controller = $this->get('Controllers\\Secret\\Image');
        $directory = $controller->buildRelativeLocator($this);
        $fs = new FileSystem($controller->imagesRootPath());

        try{
            $files = $fs->files($directory);
        }
        catch(\Throwable $t){
            $this->addError('INVALID_PATH', ['path' => $directory]);
            $files = [];
        }
        
        // dd($files, $directory);
        // put profile picture first
        if($this->loadModel()->hasProfilePicture()){
            $filename = $this->loadModel()->profilePicturePath();
            $filename = pathinfo($filename, PATHINFO_FILENAME).'.'.pathinfo($filename, PATHINFO_EXTENSION);
            if (($key = array_search($filename, $files)) !== false) {
                unset($files[$key]);
                array_unshift($files, $filename);
            }
        }
        $this->viewport('images', $files);
        $this->viewport('directory', $directory);
        $this->viewport('fs', $fs);

        return $files;
    }
    
    public function setProfilePicture()
    {
        $avatar = $this->loadModel()->profilePictureField();
        
        $this->loadModel()->set($avatar, '/'.$this->router()->params('path'));
        $this->loadModel()->save(0);
        $this->router()->hopBack();
    }

    public function unsetProfilePicture()
    {
        $avatar = $this->loadModel()->profilePictureField();

        $this->loadModel()->set($avatar, null);
        $this->loadModel()->save(0);
        $this->router()->hopBack();
    }

}
