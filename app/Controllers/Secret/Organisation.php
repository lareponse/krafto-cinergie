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
        $filters = $this->router()->params();
        $organisations = $this->modelClassName()::filter($filters);
        $this->viewport('organisations', $organisations);
        $this->viewport('count_organisations', $this->modelClassName()::raw('select count(id) FROM organisation')->fetchColumn());
        $this->viewport('count_partners', $this->modelClassName()::raw('select count(id) FROM organisation where isPartner = 1')->fetchColumn());
        $this->viewport('count_inactives', $this->modelClassName()::raw('select count(id) FROM organisation where active = 0')->fetchColumn());
        $this->viewport('count_unlisted', $this->modelClassName()::raw('select count(id) FROM organisation where isListed = 0')->fetchColumn());
        $this->viewport('filters', $filters);
    }

    public function view()
    {
        if(is_null($this->loadModel())){
            $this->router()->hop('dash_organisations');
        }

        $this->viewport('articles', Article::filter(['organisation' => $this->loadModel()], ['eager' => false]));
        $this->viewport('professionals', Professional::filter(['organisation' => $this->loadModel()], ['eager' => false]));
        $this->viewport('movies', Movie::filter(['organisation' => $this->loadModel()], ['eager' => false]));
    }

    public function edit():void
    {
        if(is_null($this->loadModel()))
            $this->router()->hop('dash_organisations');
    }
}
