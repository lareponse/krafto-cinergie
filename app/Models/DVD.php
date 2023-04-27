<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class DVD extends TightModel
{
    use Abilities\HasCompletion;
    use Abilities\HasSlug;

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
                ['movie_dvd', 'movie_id', $filters['movie']->getID()]
            ]);
        }

        if(isset($filters['letter'])){
            if($filters['letter'] == '09')
            {
                $Query->whereBindField($Query->table(), 'label', 'REGEXP', "^[0-9]+");
            }
            elseif($filters['letter'] !== 'AZ')
            {
                $Query->whereLike('label', $filters['letter'].'%', $Query->table());
            }
            $Query->orderBy([$Query->table(), 'label', 'ASC']);
        }

        return $Query;
    }
}