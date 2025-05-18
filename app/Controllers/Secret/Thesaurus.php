<?php

namespace App\Controllers\Secret;

class Thesaurus extends Krafto
{
    use \App\Controllers\Abilities\HasORM;

    public function activeSection(): string
    {
        return 'Settings';
    }

    public function home()
    {
        if (!$this->router()->params('FiltersOnFirstChar')) {
            $this->router()->hop($this->urlFor($this->nid(), 'list', null, ['FiltersOnFirstChar' => '*']));
        }
        
        parent::home();
    }
}