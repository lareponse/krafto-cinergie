<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Merchandise extends TightModel
{
    use Abilities\HasCompletion;
    use Abilities\HasSlug;
    use Abilities\HasProfilePicture;
    use Abilities\IsActivable;
    use Abilities\FiltersOnFirstChar;

    public function __toString()
    {
        return $this->get('label');
    }

    public function fieldsForCompletion()
    {
        return ['label', 'content', 'price', 'isActive', 'deliveryBe', 'deliveryEu'];
    }

    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        $Query = parent::query_retrieve($filters, $options);
        
        if(isset($filters['movie']))
        {
            $Query->join(['movie_merchandise', 'movie_merchandise'], [
                ['movie_merchandise', 'merchandise_id', 'merchandise', 'id'],
                ['movie_merchandise', 'movie_id', $filters['movie']->getID()]
            ]);
        }

        if(isset($filters['FiltersOnFirstChar'])){
            self::applyFirstCharFilter($filters['FiltersOnFirstChar'], $Query, 'label');
        }

        if(isset($filters['segment']))
        {
            switch($filters['segment']){
                case 'dvd':
                    $Query->whereEQ('isBook', 0);
                    $Query->orderBy([$Query->table(), 'rank', 'ASC']);
                break;
                
                case 'book':
                    $Query->whereNotEQ('isBook',1);
                    $Query->orderBy([$Query->table(), 'rank', 'ASC']);
                break;
            }

        }
        return $Query;
    }
}