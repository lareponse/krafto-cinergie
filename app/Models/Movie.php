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

    public static function queryListing($filters = [], $options = []): SelectInterface
    {
        $fieldForListing = [
            'id',
            'slug',
            'label',
            'released',
            'runtime',
            'profilePicture',
            'genre_id',
            'metrage_id'
        ];
        $select = self::table()->select();
        
        $select->columns($fieldForListing);
        if(($options['withDirectors'] ?? false) !== false){
            $select->join(['movie_professional', 'withDirectors'], [
                ['withDirectors', 'movie_id', 'movie', 'id'],
                ['withDirectors', 'praxis_id', Professional::DIRECTOR_TAG_ID]
            ], 'LEFT OUTER');
            $select->join(['professional', 'director'], [['withDirectors', 'professional_id', 'director', 'id']], 'LEFT OUTER');
            $select->selectAlso(['directors' => ["GROUP_CONCAT(`director`.`firstname`, ' ', `director`.`lastname` SEPARATOR ', ')"]]);
        }
        
        
        $select->whereEQ('active', ($options['isActive'] ?? true) === true ? '1' : '0');

        $select->groupBy(['movie', 'id']);
        // $select->groupBy(['movie', 'slug']);
        // $select->groupBy(['movie', 'label']);
        // $select->groupBy(['movie', 'runtime']);
        // $select->groupBy(['movie', 'profilePicture']);
        // $select->groupBy(['movie', 'genre_id']);
        // $select->groupBy(['movie', 'metrage_id']);

        return $select;
    }

    public static function queryRecord()
    {
        $select = self::queryListing();

        // add movie_theme_ids from thesaurus join

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

    public static function idsByProfessionalName(string $isLike, $praxis_id = null): array
    {
        $res = Professional::query_retrieve([
            'active' => '1',
            'fullname' => $isLike
        ], [
            'eager' => false
        ]);

        $res = $res->columns(['id']);
        $res = $res->retCol();

        return self::idsByProfessionalIds($res, $praxis_id);
    }


    public static function idsByProfessionalIds(array $ids, $praxis_id = null): array
    {
        $query = 'SELECT DISTINCT(`movie_professional`.`movie_id`) FROM `movie_professional`  WHERE `movie_professional`.`professional_id` IN (' . implode(',', $ids) . ')';
        if (!is_null($praxis_id))
            $query .= ' AND `movie_professional`.`praxis_id` = ' . $praxis_id;
        $query = self::raw($query);

        return is_null($query) ? [] : $query->fetchAll(\PDO::FETCH_COLUMN);
    }

    public static function idsByOrganisationIds(array $ids): array
    {
        $query = 'SELECT DISTINCT(`movie_organisation`.`movie_id`) FROM `movie_organisation`  WHERE `movie_organisation`.`organisation_id` IN (' . implode(',', $ids) . ')';
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
        // $Query = self::queryRecord();
  
        // if (isset($options['eager']) && $options['eager'] === true){
        //     if (!isset($options['without_tags'])) {
        //         $Query->join(['movie_tag'], [['movie_tag', 'movie_id', 'movie', 'id']], 'LEFT OUTER');
        //         $Query->groupBy('id');
        //         $Query->selectAlso('GROUP_CONCAT(DISTINCT tag_id) as movie_theme_ids');
        //     }

        //     // if(isset($options['with_director'])){
        //     //     $Query->join(['movie_professional'], [['movie_professional', 'movie_id', 'movie', 'id']], 'LEFT OUTER');
        //     //     $Query->join(['professional'], [['professional', 'id', 'movie_professional', 'movie_id']], 'LEFT OUTER');
        //     //     $Query->whereEQ('praxis_id' , 117, 'movie_professional');
        //     //     $Query->selectAlso("CONCAT(`professional`.`firstname`, ' ',`professional`.`lastname`) as director");
        //     //     vd($Query);
        //     // }

        //     if (!isset($options['without_thesaurus'])) {
        //         $Query->join(['movie_thesaurus'], [['movie_thesaurus', 'movie_id', 'movie', 'id']], 'LEFT OUTER');
        //         $Query->groupBy('id');
        //         $Query->selectAlso('GROUP_CONCAT(DISTINCT thesaurus_id) as movie_thesaurus_ids');
        //     }
        // }

        if (isset($filters['FiltersOnFirstChar'])) {
            self::applyFirstCharFilter($filters['FiltersOnFirstChar'], $Query, 'label');
        }

        if (isset($filters['model'])) {
            $model = $filters['model'];
            $class = get_class($model);

            switch ($class) {
                
                case Merchandise::class:
                    $Query->join(['movie_merchandise', 'merch'], [
                        ['movie', 'id', 'merch', 'movie_id'],
                        ['merch', 'merchandise_id', $model->getID()]
                    ]);
                    break;
    
                case Organisation::class:
                    $Query->join(['movie_organisation', 'actedAs'], [
                        ['movie', 'id', 'actedAs', 'movie_id'],
                        ['actedAs', 'organisation_id', $model->getID()]
                    ]);
                    $Query->selectAlso(['GROUP_CONCAT(actedAs.praxis_id) as actedAs']);

                    break;

                case Professional::class:
                    $Query->join(['movie_professional', 'workedAs'], [
                        ['movie', 'id', 'workedAs', 'movie_id'],
                        ['workedAs', 'professional_id', $model->getID()]
                    ]);
                    $Query->selectAlso(['GROUP_CONCAT(workedAs.praxis_id) as wordedAs']);

                    break;

                case Article::class:
                    $Query->join(['article_movie', 'wroteAbout'], [
                        ['movie', 'id', 'wroteAbout', 'movie_id'],
                        ['wroteAbout', 'article_id',  $model->getID()]
                    ]);
                    break;
            }
        }

        $Query->orderBy(['released', 'DESC']);
        return $Query;
    }
}
