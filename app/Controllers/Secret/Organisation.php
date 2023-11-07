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
            $this->router()->hop($this->urlFor($this->nid(), 'list', null, ['FiltersOnFirstChar' => 'A']));
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

        return array_map(function ($condition) use ($counting) {
            $query = $counting . ($condition ? ' where ' . $condition : '');
            $query = $this->modelClassName()::raw($query);

            return $query->fetchColumn();
        }, $counters);

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

        $this->viewport('articles', Article::filter(['organisation' => $this->loadModel()], ['eager' => false]));
        $this->viewport('professionals', Professional::filter(['organisation' => $this->loadModel()], ['eager' => false]));
        $this->viewport('movies', Movie::filter(['model' => $this->loadModel()], ['eager' => false]));
    }

    public function alter(): void
    {
        // if (is_null($this->loadModel()))
        //     $this->router()->hopURL($this->url('list'));
    }

    public function imagesDirectory(){
        return 'organisation';
    }
}
