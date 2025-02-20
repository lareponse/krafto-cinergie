<?php

namespace App\Controllers\Secret;

class Movie extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\HasImages;

    public function prepare():void
    {
        parent::prepare();
        if(!is_null($this->loadModel())){
            
            $this->viewport('tagIdsByCategory', $this->loadModel()->tagIds());
            $this->viewport('tags', $this->loadModel()->tags());
        }

        $this->viewport('genres', $this->modelClassName()::genres());
        $this->viewport('metrages', $this->modelClassName()::metrages());
    }

    public function activeSection(): string
    {
      return 'Fiche';
    }
    

    public function home()
    {
        if (!$this->router()->params('FiltersOnFirstChar')) {
            $this->router()->hop($this->urlFor($this->nid(), 'list', null, ['FiltersOnFirstChar' => 'A']));
        }

        parent::home();
    }

    public function before_alter()
    {   

    }

    public function view()
    {
        if(is_null($this->loadModel())){
            $this->router()->hop('dash_movies');
        }
    }

    public function imagesDirectory(){
        return 'film';
    }

}
