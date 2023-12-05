<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;

class Book extends Merchandise
{
    const TABLE_NAME="merchandise";
    
    use Abilities\HasCompletion;
    use Abilities\HasSlug;
    use Abilities\HasProfilePicture;
    use Abilities\IsActivable;

    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        return parent::query_retrieve($filters, $options)->whereEQ('isBook', '1');
    }
}