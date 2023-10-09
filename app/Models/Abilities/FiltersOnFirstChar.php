<?php

namespace App\Models\Abilities;

trait FiltersOnFirstChar
{
    
    protected static function applyFirstCharFilter($filter, $Query, $column='label'): void
    {
        if ($filter === '*')
            return;

        switch ($filter) {

            case '09':
                $Query->whereBindField($Query->table(), $column, 'REGEXP', "^[0-9]+");
                break;

            case '.':
                $Query->whereBindField($Query->table(), $column, 'REGEXP', "^[^\p{L}\p{N}]+");
                break;

            default: // A to Z
                $Query->whereLike($column, $filter . '%', $Query->table());
                break;
        }

        $Query->orderBy([$column, 'ASC']);
    }
}
