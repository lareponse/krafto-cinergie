<?php

namespace App\Controllers\Secret;

use App\Models\{Article, Professional, Organisation, Thesaurus};

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
    }

    public function activeSection(): string
    {
      return 'Fiche';
    }
    

    public function home()
    {
        if(!$this->router()->params('letter')){
            $this->router()->hop($this->defaultHop());
        }

        $listing = $this->modelClassName()::filter($this->router()->params());
        $this->viewport('listing', $listing);
        $this->viewport('filters', $this->router()->params());
    }

    public function defaultHop($model=null): string
    {
        if($model){
            return $this->router()->hyp('dash_record', ['controller' => $this->className(), 'id' => $model->getID()]);
        }

        return $this->router()->hyp('dash_records', ['controller' => $this->className()]).'?letter=A';
    }


    public function view()
    {
        if(is_null($this->loadModel())){
            $this->router()->hop('dash_movies');
        }

            // dd($this->loadModel()->tagIds());
        $this->viewport('articles', Article::filter(['movie' => $this->loadModel()], ['eager' => false]));
        $this->viewport('professionals', Professional::filter(['movie' => $this->loadModel()], ['eager' => false]));
        $this->viewport('organisations', Organisation::filter(['movie' => $this->loadModel()], ['eager' => false]));
    }

    public function edit():void
    {
        if(is_null($this->loadModel()))
            $this->router()->hop('dash_movies');

    }
    
    // trait HasImages
    public function imagesClassPath(){
        return 'film';
    }

}
