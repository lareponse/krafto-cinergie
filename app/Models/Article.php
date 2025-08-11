<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Article extends TightModel
{
    use Abilities\HasSlug;
    use Abilities\IsActivable;
    use Abilities\HasProfilePicture;

    public function __toString()
    {
        return $this->get('label');
    }

    public function related(): array
    {
        $related_ids = $this->related_ids();


        $ret = [];
        $type_to_class = [
            'movie_ids' => Movie::class,
            'professional_ids' => Professional::class,
            'organisation_ids' => Organisation::class,
            'movie_article_ids' => Article::class,
            'movie_professional_ids' => Professional::class,
            'movie_organisation_ids' => Organisation::class
        ];

        foreach ($related_ids as $type => $ids) {
            if (!isset($type_to_class[$type])) {
                dd('Cannot handle type ' . $type);
            }
            $ret[$type] = [];

            if (empty($ids)) {
                continue;
            }
            $ids = explode(',', $ids);
            $ret[$type] = $type_to_class[$type]::any(['ids' => $ids]);
        }
        return $ret;
    }


    public static function filter($filters = [], $options = []): SelectInterface
    {
        //---- JOIN & FILTER SERVICE
        $Query = parent::filter($filters, $options);
        $Query->join(['article_author', 'writtenBy'], [['writtenBy', 'article_id', 'article', 'id']], 'LEFT OUTER');
        $Query->join(['author', 'author'], [['writtenBy', 'author_id', 'author', 'id']], 'LEFT OUTER');
        $Query->groupBy(['article', 'id']);

        $Query->selectAlso(['writtenBy' => ["GROUP_CONCAT(author.label SEPARATOR ', ')"], 'writtenBySlugs' => ["GROUP_CONCAT(author.slug SEPARATOR ', ')"]]);

        if (isset($filters['hasEmbedVideo'])) {
            $Query->whereNotEmpty('embedVideo');
        }


        if (isset($filters['segment'])) {
            switch ($filters['segment']) {
                case 'partenaires':
                    $Query->whereEQ('isPartner', 1);
                    $Query->orderBy(['rank', 'ASC']);
                    break;

                case 'inactives':
                    $Query->whereNotEQ('public', 1);
                    $Query->orderBy(['rank', 'ASC']);
                    break;

                case 'withoutContent':
                    $Query->whereEmpty('content');
                    break;
                case 'withoutAbstract':
                    $Query->whereEmpty('abstract');
                    break;

                case 'withoutProfilePicture':
                    $Query->whereEmpty('avatar');
                    break;
            }
        }

        if (isset($filters['year'])) {
            $bindname = $Query->addBinding('filters_year', $filters['year']);
            $Query->whereWithBind('YEAR(`publication`) = ' . $bindname);
        }

        if (isset($filters['type_id'])) {
            $bindname = $Query->addBinding('filters_type_id', $filters['type_id']);
            $Query->whereWithBind('`type_id` = ' . $bindname);
        }

        if (isset($filters['month'])) {
            $bindname = $Query->addBinding('filters_month', $filters['month']);
            $Query->whereWithBind('MONTH(`publication`) = ' . $bindname);
        }

        if (isset($filters['professional'])) {
            $Query->join(['article_professional', 'related'], [
                ['article', 'id', 'related', 'article_id'],
                ['related', 'professional_id', $filters['professional']->id()]
            ]);
        }

        if (isset($filters['organisation'])) {
            $Query->join(['article_organisation', 'related'], [
                ['article', 'id', 'related', 'article_id'],
                ['related', 'organisation_id', $filters['organisation']->id()]
            ]);
        }

        if (isset($filters['movie'])) {
            if (isset($filters['movie_id']))
                throw new \Exception('Article::filter() : movie and movie_id are mutually exclusive');

            $filters['movie_id'] = $filters['movie']->id();
        }

        if (isset($filters['movie_id'])) {
            $Query->join(['article_movie', 'related'], [
                ['article', 'id', 'related', 'article_id'],
                ['related', 'movie_id', $filters['movie_id']]
            ]);
        }

        if (isset($filters['DVD'])) {
            $Query->join(['article_movie', 'article_movie'], [
                ['article', 'id', 'article_movie', 'article_id']
            ]);

            $Query->join(['movie_dvd', 'related'], [
                ['article_movie', 'movie_id', 'related', 'movie_id'],
                ['related', 'dvd_id', $filters['DVD']->id()]
            ]);
        }

        if (isset($filters['author'])) {
            $Query->join(['article_author', 'article_author'], [
                ['article', 'id', 'article_author', 'article_id'],
                ['article_author', 'author_id', $filters['author']->id()],
            ]);
        }

        if (isset($filters['content'])) {
            $Query->whereFilterContent($filters['content']);
        }

        $Query->orderBy(['publication', 'DESC']);

        return $Query;
    }

    private function related_ids(): array
    {
        $sql = "
            SELECT
                GROUP_CONCAT(DISTINCT article_movie.movie_id SEPARATOR ',') AS movie_ids,
                GROUP_CONCAT(DISTINCT article_professional.professional_id SEPARATOR ',') as professional_ids,
                GROUP_CONCAT(DISTINCT article_organisation.organisation_id SEPARATOR ',') as organisation_ids,
                GROUP_CONCAT(DISTINCT movie_article.article_id SEPARATOR ',') AS movie_article_ids,
                GROUP_CONCAT(DISTINCT movie_professional.professional_id SEPARATOR ',') AS movie_professional_ids,
                GROUP_CONCAT(DISTINCT movie_organisation.organisation_id SEPARATOR ',') AS movie_organisation_ids

            FROM `article`

            LEFT JOIN `article_movie` ON `article_movie`.`article_id` = `article`.`id`

            LEFT JOIN `article_professional` ON `article_professional`.`article_id` = `article`.`id`

            LEFT JOIN `article_organisation` ON `article_organisation`.`article_id` = `article`.`id`

            LEFT JOIN `article_movie` `movie_article` 
                ON `movie_article`.`movie_id` = `article_movie`.`movie_id`

            LEFT JOIN `movie_professional` 
                ON `movie_professional`.`movie_id` = `article_movie`.`movie_id`

            LEFT JOIN `movie_organisation` 
                ON `movie_organisation`.`movie_id` = `article_movie`.`movie_id`

            WHERE `article`.`id` = " . $this->id() . "
            AND `movie_article`.`article_id` <> " . $this->id() . "
            
            GROUP BY
                `article`.`id`
        ";

        $res = Article::raw($sql)->fetch(\PDO::FETCH_ASSOC);
        return $res ? $res : [];
    }
}
