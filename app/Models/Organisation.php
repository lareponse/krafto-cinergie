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
    use Abilities\HasProfilePicture;
    use Abilities\HasSecrets;


    use Abilities\FiltersOnFirstChar;

    public function __toString(){
        return $this->get('label');
    }

    public function tagIds(): array{
        return [];
    }

    public static function queryListing($filters=[], $options=[]): SelectInterface
    {
        $select = self::table()->select();
        $select->columns(['id', 'slug', 'label', 'profilePicture']);
    
        if(isset($options['withPraxis'])) {
            $select->join(['organisation_tag', 'organisation_tag'], [['organisation_tag', 'organisation_id', 'organisation', 'id']], 'LEFT OUTER');
            $select->selectAlso(['praxis_ids' => ["GROUP_CONCAT(DISTINCT organisation_tag.tag_id SEPARATOR ', ')"]]);    
        }
        elseif(isset($options['withMoviePraxis'])){
            $movie = $options['withMoviePraxis'];
            $select->join(['movie_organisation', 'workedOn'], [['workedOn','organisation_id', 'organisation', 'id'],['workedOn', 'movie_id', $movie->getID()]], 'INNER');
            $select->selectAlso(['praxis_ids' => ["GROUP_CONCAT(DISTINCT workedOn.praxis_id SEPARATOR ', ')"]]);
        }

        if(!isset($options['listAll']) || $options['listAll'] !== true){
            $select->whereEQ('active', 1);
            $select->whereEQ('isListed', 1);
        }

        $select->groupBy(['organisation', 'id']);
        $select->orderBy(['label', 'ASC']);
        return $select;
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



        if(isset($filters['FiltersOnFirstChar'])){
            self::applyFirstCharFilter($filters['FiltersOnFirstChar'], $Query, 'label');
        }

        
        if(isset($filters['fullname'])){
            $Query->whereLike('label','%'.$filters['fullname'] . '%', $Query->table());
        }

        if(isset($filters['segment']))
        {
            switch($filters['segment']){
                case 'partenaires':
                    $Query->whereEQ('isPartner', 1);
                    $Query->orderBy(['rank', 'ASC']);
                break;
                
                case 'inactives':
                    $Query->whereNotEQ('active',1);
                    $Query->orderBy(['rank', 'ASC']);
                break;

                case 'unlisted':
                    $Query->whereNotEQ('isListed', 1);
                    $Query->orderBy(['rank', 'ASC']);
                break;

                case 'withoutContent':
                    $Query->whereEmpty('content');
                break;

                case 'withoutProfilePicture':
                    $Query->whereEmpty('profilePicture');
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

        if(!isset($options['eager']) || $options['eager'] !== false){
            $Query->join(['organisation_tag', 'praxis'], [['organisation', 'id', 'praxis', 'organisation_id']], 'LEFT OUTER');
            $Query->join(['tag', 'tag'], [['tag', 'id', 'praxis', 'tag_id'], ['tag', 'parent_id', 219]], 'LEFT OUTER');
            $Query->groupBy(['organisation', 'id']);
            $Query->selectAlso(["GROUP_CONCAT(DISTINCT tag.id) as praxis_ids"]);

            if(isset($filters['praxis_id'])){
                $Query->whereEQ('tag_id', ((int)$filters['praxis_id']), 'praxis');
            }
        }

        $Query->orderBy(['label', 'asc']);

        return $Query;
    }


    public static function idsByPraxis(int $praxis_id): array
    {
        $query = 'SELECT `organisation_tag`.`organisation_id` FROM `organisation_tag`  WHERE `organisation_tag`.`tag_id` = :tag_id'; 
        $query = self::raw($query, ['tag_id' => $praxis_id]);

        return $query->fetchAll(\PDO::FETCH_COLUMN);
    }
}
