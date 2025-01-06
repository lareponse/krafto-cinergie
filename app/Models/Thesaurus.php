<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Thesaurus extends TightModel
{
    use Abilities\HasSlug;
    use Abilities\IsActivable;

    use Abilities\FiltersOnFirstChar;


    public function __toString()
    {
        return $this->get('label');
    }

    public static function filter($filters = [], $options = []): SelectInterface
    {
        $Query = parent::filter($filters, $options);

        if(isset($filters['FiltersOnFirstChar'])){
            self::applyFirstCharFilter($filters['FiltersOnFirstChar'], $Query, 'label');
        }

        $Query->orderBy(['label', 'ASC']);
        return $Query;
    }
}