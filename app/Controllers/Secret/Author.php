<?php

namespace App\Controllers\Secret;

use App\Models\{Organisation, Article, Movie};

class Author extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\HasImages;
    use \App\Controllers\Abilities\HasNoView {
        \App\Controllers\Abilities\HasNoView::view insteadof \App\Controllers\Abilities\HasORM;
    }
    public function activeSection(): string
    {
      return 'Page';
    }

    public function activeLink(): string
    {
        return 'authors';
    }
    
    public function home()
    {
        if (!$this->router()->params('FiltersOnFirstChar')) {
            $this->router()->hop($this->urlFor($this->nid(), 'list', null, ['FiltersOnFirstChar' => 'A']));
        }

        $listing = $this->modelClassName()::any($this->router()->params());
        $this->viewport('listing', $listing);
        $this->viewport('filters', $this->router()->params());
        $this->viewport('counters', $this->counters());

    }

    private function counters()
    {
        $counting = 'select count(id) FROM author';
        $counters = ['collaborateur' => 'isCollaborator = 1', 'inactives' => 'public <> 1'];

        return array_map(function ($condition) use ($counting) {
            $query = $counting . ($condition ? ' where ' . $condition : '');
            return $this->modelClassName()::raw($query)->fetchColumn();
        }, $counters);

    }

    public function edit():void
    {
        if(is_null($this->loadModel()))
            $this->router()->hop('records', ['nid' => 'Author']);

    }
    
    // trait HasImages
    public function imagesDirectory()
    {
        return 'personne';
    }
    

}
