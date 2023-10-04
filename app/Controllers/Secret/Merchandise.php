<?php

namespace App\Controllers\Secret;

class Merchandise extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\EditOnly;

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

}
