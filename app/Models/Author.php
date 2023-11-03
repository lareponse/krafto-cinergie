<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Author extends TightModel
{
    use Abilities\HasSlug;
    use Abilities\HasProfilePicture;
    use Abilities\HasSecrets;
    use Abilities\IsActivable;
    
    use Abilities\FiltersOnFirstChar;

    public function __toString()
    {
        return $this->get('label');
    }

    public function fullName() : string
    {
        return $this->get('label');
    }

    
    public function contactPoint(): string
    {
        return $this->get('email');
    }

    public static function queryListing($filters = [], $options = []): SelectInterface
    {
        return self::query_retrieve($filters, $options);
    }

    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {

         //---- JOIN & FILTER SERVICE
         $Query = parent::query_retrieve($filters, $options);


        if(isset($filters['FiltersOnFirstChar'])){
            self::applyFirstCharFilter($filters['FiltersOnFirstChar'], $Query, 'label');
        }

        if(isset($filters['article']))
        {
            $Query->join(['article_author', 'article_author'], [
                ['author', 'id', 'article_author', 'author_id'],
                ['article_author', 'article_id', $filters['article']->id()]
            ]);
        }
        
        if(isset($filters['isCollaborator']))
        {
            $Query->whereEQ('isCollaborator', 1);
            $Query->orderBy('`rank`', 'ASC');
        }
        return $Query;
    }
}