<?php

namespace App\Models;

use HexMakina\TightORM\TightModel;
use HexMakina\BlackBox\Database\SelectInterface;

class Image extends TightModel
{

    public static function filter($filters = [], $options = []): SelectInterface
    {
        $filters['deleted'] = 0;
        $query = parent::filter($filters);
        $query->whereLike('mime', 'image/%');
        return $query;
    }
}
