<?php

namespace App\Controllers\Secret;

use App\Models\Thesaurus as Model;

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
            $this->router()->hop($this->urlFor($this->urn(), 'list', null, ['FiltersOnFirstChar' => 'A']));
        }
        
        parent::home();
    }
}