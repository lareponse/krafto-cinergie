<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Movie extends TightModel
{
    use Abilities\HasCompletion;
    use Abilities\HasSlug;
    use Abilities\HasTags;

    public function fieldsForCompletion():array
    {
        return [
            'label', 'content', 'original_title', 'runtime', 'released', 'url', 'url_trailer',
            ['unesco_id', 'unesco_bis_id', 'unesco_ter_id'],
            'genre_id', 'metrage_id',
            'comment', 'casting'];
    }

    public function tagIds(): array
    {
        // parent_reference => id or [ids]
        return [
            'movie_genre' => $this->get('genre_id'), 
            'movie_footage' => $this->get('metrage_id'), 
            'movie_theme' => explode(',',$this->get('movie_theme_ids'))
        ];
    }

    public function thesaurusIds(): array
    {
        return explode(',', $this->get('movie_thesaurus_ids'));
    }

    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        //---- JOIN & FILTER SERVICE
        $Query = parent::query_retrieve($filters, $options);

        if(!isset($options['without_tags'])){
            $Query->join(['movie_tag'], [['movie_tag', 'movie_id', 'movie', 'id']], 'LEFT OUTER');
            $Query->groupBy('id');
            $Query->selectAlso('GROUP_CONCAT(DISTINCT tag_id) as movie_theme_ids');
        }

        if(!isset($options['without_thesaurus'])){
            $Query->join(['movie_thesaurus'], [['movie_thesaurus', 'movie_id', 'movie', 'id']], 'LEFT OUTER');
            $Query->groupBy('id');
            $Query->selectAlso('GROUP_CONCAT(DISTINCT thesaurus_id) as movie_thesaurus_ids');
        }

        if(isset($filters['letter'])){
            if($filters['letter'] == '09')
            {
                $Query->whereBindField($Query->table(), 'label', 'REGEXP', "^[0-9]+");
            }
            elseif($filters['letter'] !== 'AZ')
            {
                $Query->whereLike('label', $filters['letter'].'%', $Query->table());
            }
            $Query->orderBy([$Query->table(), 'label', 'ASC']);
        }

        if(isset($filters['professional']))
        {
            $Query->join(['movie_professional', 'movie_professional'], [
                ['movie', 'id', 'movie_professional', 'movie_id'],
                ['movie_professional', 'professional_id', $filters['professional']->getID()]
            ]);
            $Query->selectAlso('praxis_id as worked_as');
        }

        if(isset($filters['organisation']))
        {
            $Query->join(['movie_organisation', 'movie_organisation'], [
                ['movie', 'id', 'movie_organisation', 'movie_id'],
                ['movie_organisation', 'organisation_id', $filters['organisation']->getID()]
            ]);
        }

        if(isset($filters['article']))
        {
            $Query->join(['article_movie', 'article_movie'], [
                ['movie', 'id', 'article_movie', 'movie_id'],
                ['article_movie', 'article_id', $filters['article']->getID()]
            ]);
        }


        if(isset($filters['DVD']))
        {
            $Query->join(['movie_dvd', 'movie_dvd'], [
                ['movie', 'id', 'movie_dvd', 'movie_id'],
                ['movie_dvd', 'dvd_id', $filters['DVD']->getID()]
            ]);
        }

        $Query->orderBy([$Query->table(), 'released', 'DESC']);

        // vd($Query);
        return $Query;
    }


}
