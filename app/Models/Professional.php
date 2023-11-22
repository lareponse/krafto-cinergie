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
    use Abilities\HasProfilePicture;
    use Abilities\HasSecrets;

    use Abilities\FiltersOnFirstChar;


    public const DIRECTOR_TAG_ID = 151;


    public function __toString(){
        return $this->fullName();
    }

    public static function queryListing($filter=[], $options=[]): SelectInterface
    {
        $select = self::table()->select();
        $select->columns([
            'id',
            'slug',
            'label' => ["CONCAT(professional.firstname, ' ', professional.lastname)"],
            'avatar'
        ]);

        if(isset($options['withPraxis'])){
            $select->join(['professional_praxis', 'professional_praxis'], [['professional_praxis', 'professional_id', 'professional', 'id']], 'LEFT OUTER');
            $select->selectAlso(['praxis_ids' => ["GROUP_CONCAT(DISTINCT professional_praxis.tag_id SEPARATOR ', ')"]]);    
        }
        elseif(isset($options['withMoviePraxis'])){
            $movie = $options['withMoviePraxis'];
            $select->join(['movie_professional', 'workedOn'], [['workedOn','professional_id', 'professional', 'id'],['workedOn', 'movie_id', $movie->id()]], 'INNER');
            $select->selectAlso(['praxis_ids' => ["GROUP_CONCAT(DISTINCT workedOn.praxis_id SEPARATOR ', ')"]]);
        }
        
        if(!isset($options['listAll']) || $options['listAll'] !== true){
            $select->whereEQ('listable', 1);
        }
        $select->groupBy(['professional', 'id']);
        $select->orderBy(['lastname', 'ASC']);
        $select->orderBy(['firstname', 'ASC']);

        return $select;
    }

    public function tagIds(): array{
        return [];
    }

    
    public static function idsByPraxis(int $praxis_id): array
    {
        $query = 'SELECT `professional_praxis`.`professional_id` FROM `professional_praxis`  WHERE `professional_praxis`.`tag_id` = :tag_id'; 
        $query = self::raw($query, ['tag_id' => $praxis_id]);

        return $query->fetchAll(\PDO::FETCH_COLUMN);
    }
    
    public function fieldsForCompletion():array
    {
        return ['firstname','lastname', 'content', 'gender','birth', ['tel','gsm', 'fax'], 'email', 'url','country','province','zip', 'city', 'street'];
    }


    public function fullName() : string
    {
        return empty($this->get('label')) ? $this->get('lastname').' '.$this->get('firstname') : $this->get('label');
    }
    
    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        //---- JOIN & FILTER SERVICE
        $Query = parent::query_retrieve($filters, $options);
        $Query->selectAlso(['label' => "CONCAT(firstname,' ', lastname)"]);

        $Query->join(['professional_praxis', 'praxis'], [['praxis', 'professional_id', 'professional', 'id']], 'LEFT OUTER');
        $Query->join(['tag', 'tag'], [['tag', 'id', 'praxis', 'tag_id'], ['tag', 'parent_id', 97]], 'LEFT OUTER');
        $Query->groupBy(['professional', 'id']);
        $Query->selectAlso(['praxis_ids' => "GROUP_CONCAT(DISTINCT tag.id)"]);

        if(isset($filters['praxis_id'])){
            $Query->whereEQ('tag_id', ((int)$filters['praxis_id']), 'praxis');
        }

        if(isset($filters['FiltersOnFirstChar'])){
            self::applyFirstCharFilter($filters['FiltersOnFirstChar'], $Query, 'lastname');
        }

        if(isset($filters['movie']))
        {
            $Query->join(['movie_professional', 'movie_professional'], [
                ['professional', 'id', 'movie_professional', 'professional_id'],
                ['movie_professional', 'movie_id', $filters['movie']->id()]
            ]);
            $Query->selectAlso(['worked_as' => 'praxis_id']);
        }

        if(isset($filters['fullname'])){
            
            $isLike = '%' . $filters['fullname'] . '%';
            $bindname = $Query->addBinding('fullNameSearch', $isLike);
            $Query->whereWithBind('CONCAT(`professional`.`firstname`, \' \',`professional`.`lastname`) LIKE ' . $bindname);
        }

        if(isset($filters['organisation']))
        {
            $Query->join(['organisation_professional', 'organisation_professional'], [
                ['professional', 'id', 'organisation_professional', 'professional_id'],
                ['organisation_professional', 'organisation_id', $filters['organisation']->id()]
            ]);
        }

        if(isset($filters['article']))
        {
            $Query->join(['article_professional', 'article_professional'], [
                ['professional', 'id', 'article_professional', 'professional_id'],
                ['article_professional', 'article_id', $filters['article']->id()]
            ]);
        }
        
        if(!isset($options['eager']) || $options['eager'] !== false){


        }

        $Query->orderBy(['lastname', 'asc']);
        return $Query;
    }
}
