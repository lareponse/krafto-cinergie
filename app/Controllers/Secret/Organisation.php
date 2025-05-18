<?php

namespace App\Controllers\Secret;

use App\Models\{Professional, Article, Movie};


class Organisation extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\HasImages;

    
    public function activeSection(): string
    {
        return 'Fiche';
    }


    public function home()
    {
        if (empty($this->router()->params())) {
            $this->router()->hop($this->urlFor($this->nid(), 'list', null, ['FiltersOnFirstChar' => '*']));
        }

        parent::home();

        $this->viewport('counters', $this->counters());
    }

    private function counters()
    {
        $counting = 'select count(id) FROM organisation';
        $counters = [
            'organisations' => null, 
            'partners' => '`isPartner` = 1', 
            'inactives' => '`public` = 0',
            'unlisted' => '`listable` = 0',
            'withoutProfilePicture' => "(TRIM(avatar) = '' OR avatar IS NULL)",
            'withoutContent' => "(TRIM(content) = '' OR content IS NULL)"
        ];

        foreach ($counters as $key => $condition) {
            $query = $counting . ($condition ? ' where ' . $condition : '');
            $query = $this->modelClassName()::raw($query);

            $counters[$key] = $query->fetchColumn();
        }
        return $counters;
    }

    private function praxisIds(){
        $relation = $this->databaseRelations()->getRelation('organisation-hasAndBelongsToMany-tag');
        return $relation->getIds($this->loadModel()->id());
    }

    public function view()
    {
        if (is_null($this->loadModel())) {
            $this->router()->hop('dash_organisations');
        }

        $this->viewport('praxis_ids', $this->praxisIds());

        $this->viewport('articles', Article::any(['organisation' => $this->loadModel()], ['eager' => false]));
        $this->viewport('professionals', Professional::any(['organisation' => $this->loadModel()], ['eager' => false]));
        $this->viewport('movies', Movie::any(['model' => $this->loadModel()], ['eager' => false]));
    }

    public function imagesDirectory(){
        return 'organisation';
    }
}
