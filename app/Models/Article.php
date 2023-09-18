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

    public static function queryListing(): SelectInterface
    {
        $select = self::table()->select();
        $select->columns([
            'article.slug', 
            'article.label', 
            'article.publication', 
            'article.profilePicture',
            'tag.`label` as type_label'

        ]);

        $select->whereEQ('active', 1);

        $select->join(['tag', 'tag'], [['article', 'type_id', 'tag', 'id']], 'LEFT OUTER');

        return $select;
    }

    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        //---- JOIN & FILTER SERVICE
        $Query = parent::query_retrieve($filters, $options);
        $Query->join(['article_author', 'hasWriten'], [['hasWriten', 'article_id', 'article', 'id']], 'LEFT OUTER');
        $Query->join(['author', 'author'], [['hasWriten', 'author_id', 'author', 'id']], 'LEFT OUTER');
        $Query->selectAlso('author.label as author_label');

        if (isset($filters['hasEmbedVideo'])) {
            $Query->whereNotEmpty('embedVideo');
        }

        if (isset($filters['year'])) {
            $bindname = $Query->addBinding('filters_year', $filters['year']);
            $Query->whereWithBind('YEAR(`publication`) = ' . $bindname);
        }

        if (isset($filters['month'])) {
            $bindname = $Query->addBinding('filters_month', $filters['month']);
            $Query->whereWithBind('MONTH(`publication`) = ' . $bindname);
        }

        if (isset($filters['professional'])) {
            $Query->join(['article_professional', 'article_professional'], [
                ['article', 'id', 'article_professional', 'article_id'],
                ['article_professional', 'article_id', $filters['professional']->getID()]
            ]);
        }

        if (isset($filters['organisation'])) {
            $Query->join(['article_organisation', 'article_organisation'], [
                ['article', 'id', 'article_organisation', 'article_id'],
                ['article_organisation', 'organisation_id', $filters['organisation']->getID()]
            ]);
        }

        if (isset($filters['movie'])) {
            $Query->join(['article_movie', 'article_movie'], [
                ['article', 'id', 'article_movie', 'article_id'],
                ['article_movie', 'movie_id', $filters['movie']->getID()]
            ]);
        }

        if (isset($filters['DVD'])) {
            $Query->join(['article_movie', 'article_movie'], [
                ['article', 'id', 'article_movie', 'article_id']
            ]);

            $Query->join(['movie_dvd', 'movie_dvd'], [
                ['article_movie', 'movie_id', 'movie_dvd', 'movie_id'],
                ['movie_dvd', 'dvd_id', $filters['DVD']->getID()]
            ]);
        }

        if (isset($filters['author'])) {
            $Query->join(['article_author', 'article_author'], [
                ['article', 'id', 'article_author', 'article_id'],
                ['article_author', 'author_id', $filters['author']->getID()],
            ]);
        }


        $Query->orderBy('publication DESC');

        return $Query;
    }
}
