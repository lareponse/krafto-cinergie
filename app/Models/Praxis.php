<?php

namespace App\Models;

use \HexMakina\kadro\Models\Tag;

class Praxis
{
    public static function forOrganisation($organisation = null): array
    {

        $query = Tag::table()->select(['id', 'label', 'slug']);
        $query->join(['organisation_praxis', 'hasPraxis'], [['hasPraxis', 'tag_id', 'tag', 'id']], 'INNER');
        if ($organisation)
            $query->whereEQ('organisation_id', $organisation->id(), 'hasPraxis');

        $query->groupBy(['id']);
        $res = Tag::retrieve($query);

        

        return is_array($res) ? $res : [];
    }


    public static function organisationByPraxisId(int $praxis_id): array
    {
        $query = 'SELECT `organisation_praxis`.`organisation_id` FROM `organisation_praxis`  WHERE `organisation_praxis`.`tag_id` = :tag_id';
        $query = Tag::raw($query, ['tag_id' => $praxis_id]);

        return $query->fetchAll(\PDO::FETCH_COLUMN);
    }

    public static function forProfessional($professional = null): array
    {

        $query = Tag::table()->select();
        $query->join(['professional_praxis', 'hasPraxis'], [['hasPraxis', 'tag_id', 'tag', 'id']], 'INNER');
        if ($professional)
            $query->whereEQ('professional_id', $professional->id(), 'hasPraxis');

        $res = Tag::retrieve($query);

        return is_array($res) ? $res : [];
    }

    public static function director(): Tag
    {
        return Tag::one('slug', Professional::PRAXIS_DIRECTOR_SLUG);
    }
}
