<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Organisation extends TightModel
{
    use Abilities\HasCompletion;
    use Abilities\HasAddress;
    use Abilities\HasSlug;
    use Abilities\IsActivable;
    use Abilities\HasTags;
    use Abilities\HasPraxis;
    use Abilities\HasProfilePicture;
    use Abilities\HasSecrets;


    use Abilities\FiltersOnFirstChar;

    public function __toString()
    {
        return $this->get('label');
    }

    public function tagIds(): array
    {
        return [];
    }

    public function fieldsForCompletion(): array
    {
        return [
            'label', 'content', 'abbrev', 'filmography',
            ['tel', 'gsm', 'fax'], 'email', 'url', 'country', 'province', 'zip', 'city', 'street'
        ];
    }

    public static function filter($filters = [], $options = []): SelectInterface
    {
        //---- JOIN & FILTER SERVICE
        $Query = parent::filter($filters, $options);



        if (isset($filters['FiltersOnFirstChar'])) {
            self::applyFirstCharFilter($filters['FiltersOnFirstChar'], $Query, 'label');
        }


        if (isset($filters['fullname'])) {
            $Query->whereLike('label', '%' . $filters['fullname'] . '%', $Query->table());
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

                case 'unlisted':
                    $Query->whereNotEQ('listable', 1);
                    $Query->orderBy(['rank', 'ASC']);
                    break;

                case 'withoutContent':
                    $Query->whereEmpty('content');
                    break;

                case 'withoutProfilePicture':
                    $Query->whereEmpty('avatar');
                    break;
            }
        }
        // all professionals linked to a movie
        if (isset($filters['professional'])) {
            $Query->join(['organisation_professional', 'organisation_professional'], [
                ['organisation', 'id', 'organisation_professional', 'organisation_id'],
                ['organisation_professional', 'professional_id', $filters['professional']->id()]
            ]);
        }
        $Query->groupBy(['organisation', 'id']);


        // all organisations linked to a movie
        if (isset($filters['movie'])) {
            $Query->join(['movie_organisation', 'movie_organisation'], [
                ['organisation', 'id', 'movie_organisation', 'organisation_id'],
                ['movie_organisation', 'movie_id', $filters['movie']->id()],

            ]);
            $Query->selectAlso(['workedAs' => 'GROUP_CONCAT(praxis_id)']);
            $Query->groupBy(['organisation', 'id']);

        } else if (isset($options['withPraxis'])) {
            $Query->join(['organisation_praxis', 'organisation_praxis'], [['organisation_praxis', 'organisation_id', 'organisation', 'id']], 'LEFT OUTER');
            $Query->selectAlso(['praxis_ids' => ["GROUP_CONCAT(DISTINCT organisation_praxis.tag_id SEPARATOR ', ')"]]);
            
        } elseif (isset($options['withMoviePraxis'])) {
            $movie = $options['withMoviePraxis'];
            $Query->join(['movie_organisation', 'workedOn'], [['workedOn', 'organisation_id', 'organisation', 'id'], ['workedOn', 'movie_id', $movie->id()]], 'INNER');
            $Query->selectAlso(['praxis_ids' => ["GROUP_CONCAT(DISTINCT workedOn.praxis_id SEPARATOR ', ')"]]);
            $Query->groupBy(['organisation', 'id']);

        }

        if (isset($filters['article'])) {
            $Query->join(['article_organisation', 'article_organisation'], [
                ['organisation', 'id', 'article_organisation', 'organisation_id'],
                ['article_organisation', 'article_id', $filters['article']->id()]
            ]);
            $Query->groupBy(['organisation', 'id']);

        }

        $Query->orderBy(['label', 'asc']);

        return $Query;
    }


    public static function idsByPraxis(int $praxis_id): array
    {
        $query = 'SELECT `organisation_praxis`.`organisation_id` FROM `organisation_praxis`  WHERE `organisation_praxis`.`tag_id` = :tag_id';
        $query = self::raw($query, ['tag_id' => $praxis_id]);

        return $query->fetchAll(\PDO::FETCH_COLUMN);
    }
}
