<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Organisation extends TightModel
{
    use Abilities\HasCompletion;
    use Abilities\HasAddress;
    use Abilities\HasSlug;
    use Abilities\IsActivable;
    use Abilities\HasTags;
    use Abilities\HasPraxis;

    public function tagIds(): array{
        return [];
    }
    public function fieldsForCompletion():array
    {
        return [
            'label', 'content', 'abbrev', 'filmography',
            ['tel','gsm', 'fax'], 'email', 'url','country','province','zip', 'city', 'street'];
    }

    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        //---- JOIN & FILTER SERVICE
        $Query = parent::query_retrieve($filters, $options);

        if(!isset($options['without_tags'])){
            $Query->join(['organisation_tag', 'praxis'], [['organisation', 'id', 'praxis', 'organisation_id']], 'LEFT OUTER');
            $Query->join(['tag', 'tag'], [['tag', 'id', 'praxis', 'tag_id'], ['tag', 'parent_id', 219]], 'LEFT OUTER');
            $Query->groupBy(['organisation', 'id']);
            $Query->selectAlso(["GROUP_CONCAT(DISTINCT tag.id) as praxis_ids"]);
        }

        if(isset($filters['letter']))
        {
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

        if(isset($filters['segment']))
        {
            switch($filters['segment']){
                case 'partenaires':
                    $Query->whereEQ('isPartner', 1);
                    $Query->orderBy([$Query->table(), 'rank', 'ASC']);
                break;
                case 'inactives':
                    $Query->whereNotEQ('active',1);
                    $Query->orderBy([$Query->table(), 'rank', 'ASC']);
                break;
                case 'unlisted':
                    $Query->whereNotEQ('isListed', 1);
                    $Query->orderBy([$Query->table(), 'rank', 'ASC']);
                break;
            }

        }
        // all professionals linked to a movie
        if(isset($filters['professional']))
        {
            $Query->join(['organisation_professional', 'organisation_professional'], [
                ['organisation', 'id', 'organisation_professional', 'organisation_id'],
                ['organisation_professional', 'professional_id', $filters['professional']->getID()]
            ]);
        }

        // all organisations linked to a movie
        if(isset($filters['movie']))
        {
            $Query->join(['movie_organisation', 'movie_organisation'], [
                ['organisation', 'id', 'movie_organisation', 'organisation_id'],
                ['movie_organisation', 'movie_id', $filters['movie']->getID()],

            ]);
            $Query->selectAlso('GROUP_CONCAT(praxis_id) as worked_as');
        }

        if(isset($filters['article']))
        {
            $Query->join(['article_organisation', 'article_organisation'], [
                ['organisation', 'id', 'article_organisation', 'organisation_id'],
                ['article_organisation', 'article_id', $filters['article']->getID()]
            ]);
        }


        return $Query;
    }
}
