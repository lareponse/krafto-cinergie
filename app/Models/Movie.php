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
            'avatar',
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
        
        
        $select->whereEQ('public', ($options['isActive'] ?? true) === true ? '1' : '0');

        $select->groupBy(['movie', 'id']);
  

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
            'public' => '1',
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
            'public' => '1',
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
        $query = 'SELECT DISTINCT(`movie_theme`.`movie_id`) FROM `movie_theme`  WHERE `movie_theme`.`tag_id` = :tag_id';
        $query = self::raw($query, ['tag_id' => $id]);
        return is_null($query) ? [] : $query->fetchAll(\PDO::FETCH_COLUMN);
    }

    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        //---- JOIN & FILTER SERVICE
        $Query = parent::query_retrieve($filters, $options);

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
                        ['merch', 'merchandise_id', $model->id()]
                    ]);
                    break;
    
                case Organisation::class:
                    $Query->join(['movie_organisation', 'actedAs'], [
                        ['movie', 'id', 'actedAs', 'movie_id'],
                        ['actedAs', 'organisation_id', $model->id()]
                    ]);
                    $Query->selectAlso(['GROUP_CONCAT(actedAs.praxis_id) as actedAs']);

                    break;

                case Professional::class:
                    $Query->join(['movie_professional', 'workedAs'], [
                        ['movie', 'id', 'workedAs', 'movie_id'],
                        ['workedAs', 'professional_id', $model->id()]
                    ]);
                    $Query->selectAlso(['GROUP_CONCAT(workedAs.praxis_id) as wordedAs']);

                    break;

                case Article::class:
                    $Query->join(['article_movie', 'wroteAbout'], [
                        ['movie', 'id', 'wroteAbout', 'movie_id'],
                        ['wroteAbout', 'article_id',  $model->id()]
                    ]);
                    break;
            }
        }

        $Query->orderBy(['released', 'DESC']);
        return $Query;
    }


    // TODO improve related articles spread over different org and pro
    public function relatedArticles($professionals, $organisations): array
    {
        $ret = [];
        
        $articleIds = [];

        $res = self::database()->inspect('article_movie')->select(['article_id'])->whereEQ('movie_id', $this->id())->retCol();
        $articleIds = array_merge($articleIds, $res);

        if(!empty($professionals)){
            $ids = array_map(function($item) { return $item->id(); }, $professionals);
            $res = self::database()->inspect('article_professional')->select(['articleIds' => ['DISTINCT(article_id)']])->whereNumericIn('professional_id', $ids)->limit(7);
            $res = $res->retCol();
            $articleIds = array_merge($articleIds, $res);
        }

        if(!empty($organisations)) {
            $ids = array_map(function ($item) { return $item->id(); }, $organisations);
            $res = self::database()->inspect('article_organisation')->select(['articleIds' => ['DISTINCT(article_id)']])->whereNumericIn('organisation_id', $ids)->limit(7)->retCol();

            $articleIds = array_merge($articleIds, $res);
        }

        $articleIds = array_unique($articleIds);
        if(empty($articleIds)){
            return [];
        }

        $query = Article::queryListing();
        $query = $query->whereNumericIn('id', $articleIds);
        $res = $query->retObj(Article::class);

        return $res ? $res : $ret;
    }
}
