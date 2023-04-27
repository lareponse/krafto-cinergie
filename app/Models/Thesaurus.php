<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Thesaurus extends TightModel
{
    use Abilities\HasSlug;

    public function __toString()
    {
        return $this->get('label');
    }
}