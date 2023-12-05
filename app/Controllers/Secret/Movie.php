<?php

namespace App\Controllers\Secret;

use App\Models\{Article, Professional, Organisation, Thesaurus};
use \HexMakina\Crudites\Relation\OneToMany;

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
        if (!$this->router()->params('FiltersOnFirstChar')) {
            $this->router()->hop($this->urlFor($this->nid(), 'list', null, ['FiltersOnFirstChar' => 'A']));
        }

        parent::home();
    }

    public function view()
    {
        if(is_null($this->loadModel())){
            $this->router()->hop('dash_movies');
        }
        
        $relations = $this->get('HexMakina\BlackBox\Database\DatabaseInterface')->relations();

        $relation = $relations->getRelation('movie-hasAndBelongsToMany-tag');
        $themes = $relation->getIds($this->loadModel()->id());
        $this->viewport('themes', $themes);

        $relation = $relations->getRelation('movie-hasAndBelongsToMany-thesaurus');
        $thesaurus = $relation->getIds($this->loadModel()->id());
        $this->viewport('thesaurus', $thesaurus);

        parent::view();
    }

    public function imagesDirectory(){
        return 'film';
    }

}
