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
            $this->router()->hop($this->urlFor($this->className(), 'list', null, ['FiltersOnFirstChar' => '*']));
        }

        $listing = $this->modelClassName()::filter($this->router()->params());
        $this->viewport('listing', $listing);
        $this->viewport('filters', $this->router()->params());
    }

}
