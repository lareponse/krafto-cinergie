<?php

namespace App\Controllers\Secret;

class Merchandise extends Krafto
{
    use \App\Controllers\Abilities\HasORM;

    public function activeSection(): string
    {
      return 'Shop';
    }

    public function home()
    {
        if (!$this->router()->params('FiltersOnFirstChar')) {
            $this->router()->hop($this->urlFor($this->className(), 'list', null, ['FiltersOnFirstChar' => '*']));
        }
        parent::home();
    }

    public function view()
    {
        $this->router()->hop('dash_record_edit', ['controller' => $this->className(), 'id' => $this->router()->params('id')]);
    }


}
