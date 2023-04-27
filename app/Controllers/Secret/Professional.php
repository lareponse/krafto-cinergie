<?php

namespace App\Controllers\Secret;

use App\Models\{Organisation, Article, Movie};

class Professional extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\HasImages;

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


    public function view()
    {
        if(is_null($this->loadModel())){
            $this->router()->hop($this->defaultHop());
        }
        $this->viewport('articles', Article::filter(['professional' => $this->loadModel()], ['eager' => false]));
        $this->viewport('movies', Movie::filter(['professional' => $this->loadModel()], ['eager' => false]));
        $this->viewport('organisations', Organisation::filter(['professional' => $this->loadModel()], ['eager' => false]));
    }

    public function edit():void
    {
        if(is_null($this->loadModel()))
            $this->router()->hop('dash_professionals');

    }
    
    // trait HasImages
    public function imagesClassPath()
    {
        return 'personne';
    }
    
    public function defaultHop($model=null): string
    {
        if($model){
            return $this->router()->hyp('dash_record', ['controller' => $this->className(), 'id' => $model->getID()]);
        }

        return $this->router()->hyp('dash_records', ['controller' => $this->className()]).'?letter=A';
    }

}
