<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Locus extends TightModel
{
    use Abilities\FiltersOnFirstChar;

    public function __toString()
    {
        return $this->get('commune');
    }
    

    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        $Query = parent::query_retrieve($filters, $options);

        if(isset($filters['FiltersOnFirstChar'])){
            self::applyFirstCharFilter($filters['FiltersOnFirstChar'], $Query, 'locality');
        }

        $Query->orderBy(['zip', 'ASC']);
        return $Query;
    }
}