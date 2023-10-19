<?php

namespace App\Controllers\Secret\Uber;

use App\Controllers\Secret\Krafto;

abstract class ShopProduct extends Krafto
{
    use \App\Controllers\Abilities\HasORM;

    public function activeSection(): string
    {
      return 'Shop';
    }

    public function home()
    {
        if (!$this->router()->params('FiltersOnFirstChar')) {
            $this->router()->hop($this->urlFor($this->urn(), 'list', null, ['FiltersOnFirstChar' => '*']));
        }
        parent::home();
    }

}
