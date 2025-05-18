<?php

namespace App\Controllers\Secret;

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
        if (empty($this->router()->params())) {
            $this->router()->hop($this->urlFor($this->nid(), 'list', null, ['FiltersOnFirstChar' => '*']));
        }

        $this->viewport('counters', $this->counters());

        parent::home();
    }

    private function counters()
    {
        $counting = 'select count(id) FROM professional';
        $counters = [
            'professionals' => null,
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

    private function praxisIds()
    {
        $relation = $this->databaseRelations()->getRelation('professional-hasAndBelongsToMany-tag');
        return $relation->getIds($this->loadModel()->id());
    }

    public function view()
    {
        if (is_null($this->loadModel())) {
            $this->router()->hop('dash_professionals');
        }

        $relations = $this->get('HexMakina\BlackBox\Database\DatabaseInterface')->relations();
        foreach ($relations->relationsBySource('professional') as $urn => $relation) {
            if ($relation instanceof OneToMany) {
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
