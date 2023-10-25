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

    public static function queryListing($filters = [], $options = []): SelectInterface
    {
        $select = self::table()->select();
        $select->columns([
                'id', 'slug', 'label', 'publication', 'profilePicture', 'type_id'
            ]
        );

        $select = self::activableQuery($select, $options['isActive'] ?? 1);

        return $select;
    }

    public static function queryRecord(): SelectInterface
    {
        $select = self::queryListing();
        $select->selectAlso(['*']);


        $select->join(['tag', 'tag'], [['article', 'type_id', 'tag', 'id']], 'LEFT OUTER');

        return $select;
    }

    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        //---- JOIN & FILTER SERVICE
        $Query = self::queryRecord();

        $Query->join(['article_author', 'writtenBy'], [['writtenBy', 'article_id', 'article', 'id']], 'LEFT OUTER');
        $Query->join(['author', 'author'], [['writtenBy', 'author_id', 'author', 'id']], 'LEFT OUTER');
        $Query->groupBy(['article', 'id']);
   
        $Query->selectAlso(['writtenBy' => ["GROUP_CONCAT(author.label SEPARATOR ', ')"], 'writtenBySlugs' => ["GROUP_CONCAT(author.slug SEPARATOR ', ')"]]);

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
            $Query->join(['article_professional', 'related'], [
                ['article', 'id', 'related', 'article_id'],
                ['related', 'professional_id', $filters['professional']->getID()]
            ]);
        }

        if (isset($filters['organisation'])) {
            $Query->join(['article_organisation', 'related'], [
                ['article', 'id', 'related', 'article_id'],
                ['related', 'organisation_id', $filters['organisation']->getID()]
            ]);
        }

        if (isset($filters['movie'])) {
            $Query->join(['article_movie', 'related'], [
                ['article', 'id', 'related', 'article_id'],
                ['related', 'movie_id', $filters['movie']->getID()]
            ]);
        }

        if (isset($filters['DVD'])) {
            $Query->join(['article_movie', 'article_movie'], [
                ['article', 'id', 'article_movie', 'article_id']
            ]);

            $Query->join(['movie_dvd', 'related'], [
                ['article_movie', 'movie_id', 'related', 'movie_id'],
                ['related', 'dvd_id', $filters['DVD']->getID()]
            ]);
        }

        if (isset($filters['author'])) {
            $Query->join(['article_author', 'article_author'], [
                ['article', 'id', 'article_author', 'article_id'],
                ['article_author', 'author_id', $filters['author']->getID()],
            ]);
        }

        if (isset($filters['content'])) {
            $Query->whereFilterContent($filters['content']);
        }

        $Query->orderBy('publication DESC');
        return $Query;
    }
}
