<?php

namespace App\Models;

use HexMakina\TightORM\TightModel;

class Contact extends TightModel
{
    public function __toString()
    {
        return $this->get('label');
    }
}