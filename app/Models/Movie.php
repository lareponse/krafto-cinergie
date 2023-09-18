<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;
use App\Models\{Professional, Organisation};

class Movie extends TightModel
{
    use Abilities\HasCompletion;
    use Abilities\HasSlug;
    use Abilities\HasTags;
    use Abilities\FiltersOnFirstChar;
    use Abilities\HasProfilePicture;

    public function __toString()
    {
        return $this->get('label');
    }


    public static function queryListing(): SelectInterface
    {
        $select = self::table()->select();
        $select->columns([
            'movie.slug', 
            'movie.label', 
            'movie.released', 
            'movie.profilePicture', 
            'movie_genre.label as genre', 
            "GROUP_CONCAT(director.firstname, ' ', director.lastname SEPARATOR ', ') as directors"
        ]);

        $select->join(['tag','movie_genre'], [['movie', 'genre_id', 'movie_genre','id']], 'LEFT OUTER');
        $select->join(['movie_professional', 'withDirectors'], [
            ['withDirectors', 'movie_id', 'movie','id'],
            ['withDirectors', 'praxis_id', Professional::DIRECTOR_TAG_ID]
        ], 'LEFT OUTER');
        $select->join(['professional', 'director'], [['withDirectors', 'professional_id', 'director','id']], 'LEFT OUTER');
        
        $select->whereEQ('active', 1);

        $select->groupBy(['movie', 'slug']);
        $select->groupBy(['movie', 'label']);
        $select->groupBy(['movie','released']);
        $select->groupBy(['movie','profilePicture']);
        $select->groupBy(['movie_genre','label']);

        
        return $select;
    }

    public function fieldsForCompletion(): array
    {
        return [
            'label', 'content', 'original_title', 'runtime', 'released', 'url', 'url_trailer',
            ['unesco_id', 'unesco_bis_id', 'unesco_ter_id'],
            'genre_id', 'metrage_id',
            'comment', 'casting'
        ];
    }

    public function tagIds(): array
    {
        // parent_reference => id or [ids]
        return [
            'movie_genre' => $this->get('genre_id'),
            'movie_footage' => $this->get('metrage_id'),
            'movie_theme' => explode(',', $this->get('movie_theme_ids'))
        ];
    }

    public function thesaurusIds(): array
    {
        return explode(',', $this->get('movie_thesaurus_ids'));
    }

    public static function idsByOrganisationName(string $isLike): array
    {
        $res = Organisation::query_retrieve([
            'active' => '1',
            'fullname' => $isLike
        ], [
            'eager' => false
        ])->columns(['id']);
        $res = $res->retCol();

        return self::idsByOrganisationIds($res);
    }

    public static function idsByProfessionalName(string $isLike, $praxis_id=null): array
    {
        $res = Professional::query_retrieve([
            'active' => '1',
            'fullname' => $isLike
        ], [
            'eager' => false
        ]);
        vd($res);

        $res = $res->columns(['id']);
        dd($res);
        $res = $res->retCol();

        return self::idsByProfessionalIds($res, $praxis_id);
    }

    
    public static function idsByProfessionalIds(array $ids, $praxis_id = null): array
    {
        $query = 'SELECT DISTINCT(`movie_professional`.`movie_id`) FROM `movie_professional`  WHERE `movie_professional`.`professional_id` IN ('.implode(',',$ids).')'; 
        if(!is_null($praxis_id))
            $query .= ' AND `movie_professional`.`praxis_id` = '.$praxis_id;
        $query = self::raw($query);

        return is_null($query) ? [] : $query->fetchAll(\PDO::FETCH_COLUMN);
    }

    public static function idsByOrganisationIds(array $ids): array
    {
        $query = 'SELECT DISTINCT(`movie_organisation`.`movie_id`) FROM `movie_organisation`  WHERE `movie_organisation`.`organisation_id` IN ('.implode(',',$ids).')'; 
        $query = self::raw($query);

        return is_null($query) ? [] : $query->fetchAll(\PDO::FETCH_COLUMN);
    }

    public static function idsByThemeId(int $id): array
    {
        $query = 'SELECT DISTINCT(`movie_tag`.`movie_id`) FROM `movie_tag`  WHERE `movie_tag`.`tag_id` = :tag_id'; 
        $query = self::raw($query, ['tag_id' => $id]);
        return is_null($query) ? [] : $query->fetchAll(\PDO::FETCH_COLUMN);
    }
    
    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        //---- JOIN & FILTER SERVICE
        $Query = parent::query_retrieve($filters, $options);

        $Query->join(['movie_professional', 'withDirectors'], [
            ['withDirectors', 'movie_id', 'movie','id'],
            ['withDirectors', 'praxis_id', Professional::DIRECTOR_TAG_ID]
        ], 'LEFT OUTER');

        $Query->join(['professional', 'director'], [['withDirectors', 'professional_id', 'director','id']], 'LEFT OUTER');

        if (isset($options['eager']) && $options['eager'] === true){
            if (!isset($options['without_tags'])) {
                $Query->join(['movie_tag'], [['movie_tag', 'movie_id', 'movie', 'id']], 'LEFT OUTER');
                $Query->groupBy('id');
                $Query->selectAlso('GROUP_CONCAT(DISTINCT tag_id) as movie_theme_ids');
            }
    
            // if(isset($options['with_director'])){
            //     $Query->join(['movie_professional'], [['movie_professional', 'movie_id', 'movie', 'id']], 'LEFT OUTER');
            //     $Query->join(['professional'], [['professional', 'id', 'movie_professional', 'movie_id']], 'LEFT OUTER');
            //     $Query->whereEQ('praxis_id' , 117, 'movie_professional');
            //     $Query->selectAlso("CONCAT(`professional`.`firstname`, ' ',`professional`.`lastname`) as director");
            //     vd($Query);
            // }
    
            if (!isset($options['without_thesaurus'])) {
                $Query->join(['movie_thesaurus'], [['movie_thesaurus', 'movie_id', 'movie', 'id']], 'LEFT OUTER');
                $Query->groupBy('id');
                $Query->selectAlso('GROUP_CONCAT(DISTINCT thesaurus_id) as movie_thesaurus_ids');
            }
        }

        if(isset($filters['FiltersOnFirstChar'])){
            self::applyFirstCharFilter($filters['FiltersOnFirstChar'], $Query, 'label');
        }

        if (isset($filters['professional'])) {
            $Query->join(['movie_professional', 'movie_professional'], [
                ['movie', 'id', 'movie_professional', 'movie_id'],
                ['movie_professional', 'professional_id', $filters['professional']->getID()]
            ]);
            $Query->selectAlso('praxis_id as worked_as');
        }

        // if (isset($filters['professional_label'])) {
        //     $labelLike = '%'.$filters['professional_label'].'%';
        //     $Query->join(['movie_professional', 'movie_professional'], [['movie', 'id', 'movie_professional', 'movie_id']]);
        //     $Query->join(['professional', 'professional'], [['professional', 'id', 'movie_professional', 'professional_id']]);
        //     $Query->selectAlso('CONCAT(`professional`.`firstname`, \' \',`professional`.`lastname`) as professional_label');

        //     $bindname = $Query->addBinding('professional_fullname', $labelLike);
        //     $Query->whereWithBind('CONCAT(`professional`.`firstname`, \' \',`professional`.`lastname`) LIKE '.$bindname);
        // }


        // if (isset($filters['organisation_label'])) {
        //     $labelLike = '%'.$filters['organisation_label'].'%';
        //     $Query->join(['movie_organisation', 'movie_organisation'], [['movie', 'id', 'movie_organisation', 'movie_id']]);
        //     $Query->join(['organisation', 'organisation'], [['organisation', 'id', 'movie_organisation', 'organisation_id']]);
        //     // $Query->selectAlso('organisation.label as organisation_label');
        //     $Query->whereLike('label', $labelLike, 'organisation');
        // }

        if (isset($filters['article'])) {
            $Query->join(['article_movie', 'article_movie'], [
                ['movie', 'id', 'article_movie', 'movie_id'],
                ['article_movie', 'article_id', $filters['article']->getID()]
            ]);
        }


        if (isset($filters['DVD'])) {
            $Query->join(['movie_dvd', 'movie_dvd'], [
                ['movie', 'id', 'movie_dvd', 'movie_id'],
                ['movie_dvd', 'dvd_id', $filters['DVD']->getID()]
            ]);
        }

        $Query->orderBy([$Query->table(), 'released', 'DESC']);
        return $Query;
    }



}
