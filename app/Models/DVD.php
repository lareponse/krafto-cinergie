<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;

class DVD extends Merchandise
{
    const TABLE_NAME="merchandise";
    
    use Abilities\HasCompletion;
    use Abilities\HasSlug;
    use Abilities\HasProfilePicture;
    use Abilities\IsActivable;

    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        $Query = parent::query_retrieve($filters, $options);
        
        $Query->whereEQ('isBook', '0');
        
        if(isset($filters['Movie']))
        {
            $Query->join(['movie_dvd', 'movie_dvd'], [
                ['dvd', 'id', 'movie_dvd', 'dvd_id'],
                ['movie_dvd', 'movie_id', $filters['Movie']->id()]
            ]);
        }

        return $Query;
    }
}