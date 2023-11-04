<?php

namespace App\Controllers\Secret;

class Merchandise extends Krafto
{
    use \App\Controllers\Abilities\HasORM;


    public function activeSection(): string
    {
      return 'Shop';
    }

    public function view()
    {
        $this->router()->hop('dash_record_edit', ['nid' => $this->nid(), 'id' => $this->router()->params('id')]);
    }
    
    public function home()
    {
        if (!$this->router()->params('FiltersOnFirstChar')) {
            $this->router()->hop($this->urlFor($this->nid(), 'list', null, ['FiltersOnFirstChar' => '*']));
        }
        parent::home();
    }

}
