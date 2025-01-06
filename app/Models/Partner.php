<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Partner extends TightModel
{
    use Abilities\HasSlug;
    use Abilities\IsActivable;

    public function __toString()
    {
        
    }
}