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
            -- Movies directly linked to the article
            (SELECT GROUP_CONCAT(DISTINCT am.movie_id) FROM article_movie am
            WHERE am.article_id = a.id) AS movie_ids,

            -- Professionals directly linked to the article
            (SELECT GROUP_CONCAT(DISTINCT ap.professional_id) FROM article_professional ap
            WHERE ap.article_id = a.id) AS professional_ids,

            -- Organisations directly linked to the article
            (SELECT GROUP_CONCAT(DISTINCT ao.organisation_id) FROM article_organisation ao
            WHERE ao.article_id = a.id) AS organisation_ids,

            -- Other articles linked to the same movies (excluding the current article)
            (SELECT GROUP_CONCAT(DISTINCT ma.article_id) FROM article_movie am
            JOIN article_movie ma ON ma.movie_id = am.movie_id
            WHERE am.article_id = a.id AND ma.article_id <> a.id) AS movie_article_ids,

            -- Professionals linked via movies
            (SELECT GROUP_CONCAT(DISTINCT mp.professional_id) FROM article_movie am
            JOIN movie_professional mp ON mp.movie_id = am.movie_id
            WHERE am.article_id = a.id) AS movie_professional_ids,

            -- Organisations linked via movies
            (SELECT GROUP_CONCAT(DISTINCT mo.organisation_id) FROM article_movie am
            JOIN movie_organisation mo ON mo.movie_id = am.movie_id
            WHERE am.article_id = a.id) AS movie_organisation_ids

            FROM article a
            WHERE a.id = " . $this->id();

        $res = Article::raw($sql)->fetch(\PDO::FETCH_ASSOC);
        return $res ? $res : [];
    }
}
