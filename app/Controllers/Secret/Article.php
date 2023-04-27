<?php

namespace App\Controllers\Secret;

use App\Models\{Author, Professional, Organisation, Movie};

class Article extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\HasSlug;
    use \App\Controllers\Abilities\HasImages;


    public function home()
    {
        // requires at least a year
        if(empty($this->router()->params('year'))){
          $this->router()->hop($this->defaultHop());
        }

        $filters = $this->router()->params(); 
        $filters['month'] ??= 1;

        // Return an array of records based on filters
        $listing = $this->modelClassName()::filter($filters);

        $this->viewport('listing', $listing);
        $this->viewport('filters', $filters);
    }

    public function defaultHop($model=null): string
    {
        if($model){
            return $this->router()->hyp('dash_record', ['controller' => $this->className(), 'id' => $model->getID()]);
        }

        return $this->router()->hyp('dash_records', ['controller' => $this->className()]).'?year='.date('Y').'&month='.date('m');
    }


    public function view()
    {
        $this->viewport('authors', Author::filter(['article' => $this->loadModel()], ['eager' => false]));
        $this->viewport('professionals', Professional::filter(['article' => $this->loadModel()], ['eager' => false]));
        $this->viewport('movies', Movie::filter(['article' => $this->loadModel()], ['eager' => false]));
        $this->viewport('organisations', Organisation::filter(['article' => $this->loadModel()], ['eager' => false]));
    }
}
