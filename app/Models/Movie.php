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
            'movie_theme' => $this->get('movie_theme_ids') ? explode(',', $this->get('movie_theme_ids')) : []
        ];
    }

    public function thesaurusIds(): array
    {
        return explode(',', $this->get('movie_thesaurus_ids') ?? '');
    }

    public static function idsByOrganisationName(string $isLike): array
    {
        $res = Organisation::filter([
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
        $res = Professional::filter([
            'public' => '1',
            'fullname' => $isLike
        ], [
            'eager' => false
        ]);
        
        $res->columns(['id']);
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

    public static function filter($filters = [], $options = []): SelectInterface
    {
        //---- JOIN & FILTER SERVICE
        $Query = parent::filter($filters, $options);

        if (isset($filters['FiltersOnFirstChar'])) {
            self::applyFirstCharFilter($filters['FiltersOnFirstChar'], $Query, 'label');
        }

        // written as part of refactoring, must be rewritten as a join using the PRAXIS_DIRECTOR_SLUG constant
        if(($options['withDirectors'] ?? false) !== false){
            $director_tag = Praxis::director();
            $Query->join(['movie_professional', 'withDirectors'], [
                ['withDirectors', 'movie_id', 'movie', 'id'],
                ['withDirectors', 'praxis_id', $director_tag->id()]
            ], 'LEFT OUTER');
            $Query->join(['professional', 'director'], [['withDirectors', 'professional_id', 'director', 'id']], 'LEFT OUTER');
            $Query->selectAlso(['directors' => ["GROUP_CONCAT(`director`.`firstname`, ' ', `director`.`lastname` SEPARATOR ', ')"]]);
            $Query->groupBy(['movie', 'id']);

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
                    $Query->selectAlso(['GROUP_CONCAT(merch.merchandise_id) as merchandise_ids']);
                    $Query->groupBy(['movie', 'id']);
                    break;
    
                case Organisation::class:
                    $Query->join(['movie_organisation', 'actedAs'], [
                        ['movie', 'id', 'actedAs', 'movie_id'],
                        ['actedAs', 'organisation_id', $model->id()]
                    ]);
                    $Query->selectAlso(['GROUP_CONCAT(actedAs.praxis_id) as actedAs']);
                    $Query->groupBy(['movie', 'id']);

                    break;

                case Professional::class:
                    $Query->join(['movie_professional', 'workedAs'], [
                        ['movie', 'id', 'workedAs', 'movie_id'],
                        ['workedAs', 'professional_id', $model->id()]
                    ]);
                    $Query->selectAlso(['workedAs' => ["GROUP_CONCAT(workedAs.praxis_id)"]]);

                    $Query->groupBy(['movie', 'id']);
                   
                    break;

                case Article::class:
                    $Query->join(['article_movie', 'wroteAbout'], [
                        ['movie', 'id', 'wroteAbout', 'movie_id'],
                        ['wroteAbout', 'article_id',  $model->id()]
                    ]);
                    $Query->selectAlso(['GROUP_CONCAT(wroteAbout.article_id) as writtenAbout']);
                    $Query->groupBy(['movie', 'id']);
                    break;
            }
        }

        return $Query;
    }


    // TODO improve related articles spread over different org and pro
    public function relatedArticles($professionals, $organisations): array
    {
        $ret = [];
        
        $articleIds = [];

        $res = self::database()->table('article_movie')->select(['article_id'])->whereEQ('movie_id', $this->id())->retCol();
        $articleIds = array_merge($articleIds, $res);

        if(!empty($professionals)){
            $ids = array_map(function($item) { return $item->id(); }, $professionals);
            $res = self::database()->table('article_professional')->select(['articleIds' => ['DISTINCT(article_id)']])->whereNumericIn('professional_id', $ids)->limit(7);
            $res = $res->retCol();
            $articleIds = array_merge($articleIds, $res);
        }

        if(!empty($organisations)) {
            $ids = array_map(function ($item) { return $item->id(); }, $organisations);
            $res = self::database()->table('article_organisation')->select(['articleIds' => ['DISTINCT(article_id)']])->whereNumericIn('organisation_id', $ids)->limit(7)->retCol();

            $articleIds = array_merge($articleIds, $res);
        }

        $articleIds = array_unique($articleIds);
        if(empty($articleIds)){
            return [];
        }

        $query = Article::filter();
        $query = $query->whereNumericIn('id', $articleIds);
        $res = $query->retObj(Article::class);

        return $res ? $res : $ret;
    }
}
