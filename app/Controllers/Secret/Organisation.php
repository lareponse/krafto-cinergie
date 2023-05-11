<?php

namespace App\Controllers\Secret;

use App\Models\{Professional, Article, Movie};


class Organisation extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\HasImages;
    use \App\Controllers\Abilities\FindBySlug;

    
    public function activeSection(): string
    {
        return 'Fiche';
    }


    public function home()
    {
        if (empty($this->router()->params())) {
            $this->router()->hop($this->urlFor($this->className(), 'list', null, ['FiltersOnFirstChar' => 'A']));
        }

        $filters = $this->router()->params();

        $organisations = $this->modelClassName()::filter($filters);

        $this->viewport('filters', $filters);
        $this->viewport('listing', $organisations);
        $this->viewport('counters', $this->counters());
    }

    private function counters()
    {
        $counting = 'select count(id) FROM organisation';
        $counters = ['organisations' => null, 'partners' => 'isPartner = 1', 'inactives' => 'active = 0', 'unlisted' => 'isListed = 0'];

        return array_map(function ($condition) use ($counting) {
            $query = $counting . ($condition ? ' where ' . $condition : '');
            return $this->modelClassName()::raw($query)->fetchColumn();
        }, $counters);

    }

    public function view()
    {
        if (is_null($this->loadModel())) {
            $this->router()->hop('dash_organisations');
        }

        $this->viewport('articles', Article::filter(['organisation' => $this->loadModel()], ['eager' => false]));
        $this->viewport('professionals', Professional::filter(['organisation' => $this->loadModel()], ['eager' => false]));
        $this->viewport('movies', Movie::filter(['organisation' => $this->loadModel()], ['eager' => false]));
    }

    public function edit(): void
    {
        if (is_null($this->loadModel()))
            $this->router()->hop('dash_organisations');
    }
}
