<?php

namespace App\Controllers\Secret;

use HexMakina\kadro\Models\Tag;
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
        if (!$this->router()->params('FiltersOnFirstChar')) {
            $this->router()->hop($this->urlFor($this->urn(), 'list', null, ['FiltersOnFirstChar' => 'A']));
        }
        
        parent::home();
    }


    public function view()
    {
        if (is_null($this->loadModel())) {
            $this->router()->hop('dash_professionals');
        }
        $relation = get_class($this->loadModel())::database()->relations()->getRelation('professional-hasAndBelongsToMany-tag');
        $praxis = $relation->getIds($this->loadModel()->getID());
        $this->viewport('praxis', Tag::filter(['ids' => $praxis], ['eager' => false]));
        $this->viewport('articles', Article::filter(['professional' => $this->loadModel()], ['eager' => false]));
        $this->viewport('movies', Movie::filter(['model' => $this->loadModel()], ['eager' => false]));
        $this->viewport('organisations', Organisation::filter(['professional' => $this->loadModel()], ['eager' => false]));
    }

    public function edit(): void
    {
        if (is_null($this->loadModel()))
            $this->router()->hop('dash_professionals');
    }

    // trait HasImages
    public function imagesDirectory()
    {
        return 'personne';
    }
}
