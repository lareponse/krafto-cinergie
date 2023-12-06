<?php

namespace App\Models;

use \HexMakina\kadro\Models\Tag;

class Praxis 
{
    public static function forOrganisation($organisation): array{

        $query = Tag::table()->select();
        $query->join(['organisation_praxis', 'hasPraxis'], [['hasPraxis', 'tag_id', 'tag', 'id']]);
        $query->whereEQ('organisation_id', $organisation->id(), 'hasPraxis');
        $res = $query->retObj(Tag::class);

        return is_array($res) ? $res : [];
    }

    public static function forProfessional($professional): array{

        $query = Tag::table()->select();
        $query->join(['professional_praxis', 'hasPraxis'], [['hasPraxis', 'tag_id', 'tag', 'id']]);
        $query->whereEQ('professional_id', $professional->id(), 'hasPraxis');
        $res = $query->retObj(Tag::class);

        return is_array($res) ? $res : [];
    }

    public static function director(): Tag
    {
        return Tag::one('slug', Professional::PRAXIS_DIRECTOR_SLUG);
    }
}