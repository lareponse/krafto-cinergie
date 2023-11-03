<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class DVD extends TightModel
{
    use Abilities\HasCompletion;
    use Abilities\HasSlug;

    use Abilities\FiltersOnFirstChar;

    public function __toString()
    {
        
    }

    public function fieldsForCompletion()
    {
        return ['label', 'content', 'price', 'active'];
    }

    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        $Query = parent::query_retrieve($filters, $options);
        
        if(isset($filters['movie']))
        {
            $Query->join(['movie_dvd', 'movie_dvd'], [
                ['dvd', 'id', 'movie_dvd', 'dvd_id'],
                ['movie_dvd', 'movie_id', $filters['movie']->id()]
            ]);
        }

        if(isset($filters['FiltersOnFirstChar'])){
            self::applyFirstCharFilter($filters['FiltersOnFirstChar'], $Query, 'label');
        }


        return $Query;
    }
}