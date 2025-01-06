<?php

namespace App\Controllers\Secret;

use HexMakina\kadro\Models\Tag;
use App\Models\{Organisation, Article, Movie};
use \HexMakina\Crudites\Relation\OneToMany;

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
            $this->router()->hop($this->urlFor($this->nid(), 'list', null, ['FiltersOnFirstChar' => 'A']));
        }
        
        parent::home();
    }

    private function praxisIds(){
        $relation = $this->databaseRelations()->getRelation('professional-hasAndBelongsToMany-tag');
        return $relation->getIds($this->loadModel()->id());
    }

    public function view()
    {
        if (is_null($this->loadModel())) {
            $this->router()->hop('dash_professionals');
        }

        $relations = $this->get('HexMakina\BlackBox\Database\DatabaseInterface')->relations();
        foreach($relations->relationsBySource('professional') as $urn => $relation){
            if($relation instanceof OneToMany){
                $records = $relation->getTargets($this->loadModel()->id());
                $this->viewport($urn, $records);
            }
        }

        $this->viewport('praxis_ids', $this->praxisIds());

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
