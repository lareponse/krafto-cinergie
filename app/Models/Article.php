<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Article extends TightModel
{
    use Abilities\HasSlug;
    use Abilities\IsActivable;

    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        //---- JOIN & FILTER SERVICE
        $Query = parent::query_retrieve($filters, $options);

        if(isset($filters['year']))
        {
            $bindname = $Query->addBinding('filters_year', $filters['year']);
            $Query->whereWithBind('YEAR(`publication`) = '.$bindname, $filters['year']);
        }

        if(isset($filters['month']))
        {
            $bindname = $Query->addBinding('filters_month', $filters['month']);
            $Query->whereWithBind('MONTH(`publication`) = '.$bindname, $filters['month']);
        }

        if(isset($filters['professional']))
        {
            $Query->join(['article_professional', 'article_professional'], [
                ['article', 'id', 'article_professional', 'article_id'],
                ['article_professional', 'article_id', $filters['professional']->getID()]
            ]);
        }

        if(isset($filters['movie']))
        {
            $Query->join(['article_movie', 'article_movie'], [
                ['article', 'id', 'article_movie', 'article_id'],
                ['article_movie', 'movie_id', $filters['movie']->getID()]
            ]);
        }

        if(isset($filters['DVD']))
        {
            $Query->join(['article_movie', 'article_movie'], [
                ['article', 'id', 'article_movie', 'article_id']
            ]);
            
            $Query->join(['movie_dvd', 'movie_dvd'], [
                ['article_movie', 'movie_id', 'movie_dvd', 'movie_id'],
                ['movie_dvd', 'dvd_id', $filters['DVD']->getID()]
            ]);
        }

        if(isset($filters['author']))
        {
            $Query->join(['article_author', 'article_author'], [
                ['article', 'id', 'article_author', 'article_id'],
                ['article_author', 'author_id', $filters['author']->getID()],
            ]);
        }

        if(isset($filters['organisation']))
        {
            $Query->join(['article_organisation', 'article_organisation'], [
                ['article', 'id', 'article_organisation', 'article_id'],
                ['article_organisation', 'organisation_id', $filters['organisation']->getID()]
            ]);
        }

        $Query->orderBy('publication DESC');
        return $Query;
    }
}
