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

    public static function queryListing(): SelectInterface
    {
        $select = self::table()->select();
        $select->columns([
            'id',
            'slug',
            'fullname' => ["CONCAT(professional.firstname, ' ', professional.lastname)"],
            'profilePicture',
            'praxes' => ["GROUP_CONCAT(praxis.label SEPARATOR ', ')"]
        ]);

        $select->join(['professional_tag', 'professional_tag'], [['professional_tag', 'professional_id', 'professional', 'id']], 'LEFT OUTER');
        $select->join(['tag', 'praxis'], [['professional_tag', 'tag_id', 'praxis', 'id']], 'LEFT OUTER');

        $select->whereEQ('isListed', 1);

        $select->groupBy(['professional', 'id']);
        $select->orderBy(['professional', 'lastname', 'ASC']);
        $select->orderBy(['professional', 'firstname', 'ASC']);

        return $select;
    }

    public static function byMovie(Movie $movie) : array
    {
        $ret = [];
        // $select = self::table()->select();
        $select = self::queryListing();
        $select->join(['movie_professional', 'workedOn'], [['workedOn','professional_id', 'professional', 'id'],['workedOn', 'movie_id', $movie->getID()]], 'INNER');
        $select->join(['tag', 'workedOnAs'], [['workedOn','praxis_id', 'workedOnAs', 'id']], 'INNER');

        $select->groupBy(['professional', 'id']);
        $ret = $select->retObj(self::class);

        return $ret;
    }

    public function tagIds(): array{
        return [];
    }

    
    public static function idsByPraxis(int $praxis_id): array
    {
        $query = 'SELECT `professional_tag`.`professional_id` FROM `professional_tag`  WHERE `professional_tag`.`tag_id` = :tag_id'; 
        $query = self::raw($query, ['tag_id' => $praxis_id]);

        return $query->fetchAll(\PDO::FETCH_COLUMN);
    }
    
    public function fieldsForCompletion():array
    {
        return ['firstname','lastname', 'content', 'gender','birth', ['tel','gsm', 'fax'], 'email', 'url','country','province','zip', 'city', 'street'];
    }


    public function fullName() : string
    {
        return empty($this->get('fullname')) ? $this->get('lastname').' '.$this->get('firstname') : $this->get('fullname');
    }
    
    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        //---- JOIN & FILTER SERVICE
        $Query = parent::query_retrieve($filters, $options);

        $Query->selectAlso(["CONCAT(firstname,' ', lastname) as label"]);

        $Query->join(['professional_tag', 'praxis'], [['praxis', 'professional_id', 'professional', 'id']], 'LEFT OUTER');
        $Query->join(['tag', 'tag'], [['tag', 'id', 'praxis', 'tag_id'], ['tag', 'parent_id', 97]], 'LEFT OUTER');
        $Query->groupBy(['professional', 'id']);
        $Query->selectAlso(["GROUP_CONCAT(DISTINCT tag.id) as praxis_ids"]);

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
                ['movie_professional', 'movie_id', $filters['movie']->getID()]
            ]);
            $Query->selectAlso('praxis_id as worked_as');
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
        
        if(!isset($options['eager']) || $options['eager'] !== false){


        }

        $Query->orderBy(['lastname', 'asc']);
        return $Query;
    }
}
