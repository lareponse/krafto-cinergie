<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Professional extends TightModel
{
    use Abilities\HasCompletion;
    use Abilities\HasAddress;
    use Abilities\HasSlug;
    use Abilities\HasTags;
    use Abilities\HasPraxis;

    use Abilities\FiltersOnFirstChar;


    public function tagIds(): array{
        return [];
    }
    
    public function fieldsForCompletion():array
    {
        return ['firstname','lastname', 'content', 'gender','birth', ['tel','gsm', 'fax'], 'email', 'url','country','province','zip', 'city', 'street'];
    }


    public function fullName() : string
    {
        return $this->get('lastname').' '.$this->get('firstname');
    }

    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        //---- JOIN & FILTER SERVICE
        $Query = parent::query_retrieve($filters, $options);

        if(isset($filters['FiltersOnFirstChar'])){
            self::applyFirstCharFilter($filters['FiltersOnFirstChar'], $Query, 'lastname');
        }

        if(isset($filters['movie']))
        {
            $Query->join(['movie_professional', 'movie_professional'], [
                ['professional', 'id', 'movie_professional', 'professional_id'],
                ['movie_professional', 'movie_id', $filters['movie']->getID()]
            ]);
            $Query->selectAlso('praxis_id as worked_as');

        }
        if(isset($filters['organisation']))
        {
            $Query->join(['organisation_professional', 'organisation_professional'], [
                ['professional', 'id', 'organisation_professional', 'professional_id'],
                ['organisation_professional', 'organisation_id', $filters['organisation']->getID()]
            ]);
        }

        if(isset($filters['article']))
        {
            $Query->join(['article_professional', 'article_professional'], [
                ['professional', 'id', 'article_professional', 'professional_id'],
                ['article_professional', 'article_id', $filters['article']->getID()]
            ]);
        }

        $Query->join(['professional_tag', 'praxis'], [['professional', 'id', 'praxis', 'professional_id']], 'LEFT OUTER');
        $Query->join(['tag', 'tag'], [['tag', 'id', 'praxis', 'tag_id'], ['tag', 'parent_id', 91]], 'LEFT OUTER');
        $Query->groupBy(['professional', 'id']);
        $Query->selectAlso(["GROUP_CONCAT(DISTINCT tag.id) as praxis_ids"]);
        $Query->selectAlso(["CONCAT(firstname,' ', lastname) as label"]);
        $Query->orderBy(['lastname', 'asc']);

        return $Query;
    }
}
