<?php
namespace App\Models\Abilities;

use HexMakina\BlackBox\Database\SelectInterface;

trait IsFilterable
{
    abstract public function get($string);

    public static function filterableQuery(SelectInterface $select, array $filter): SelectInterface
    {
        dd($filter);
    }
    
}