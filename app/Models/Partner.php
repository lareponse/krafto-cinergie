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

    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        $Query = parent::query_retrieve($filters, $options);

        return $Query;
    }
}