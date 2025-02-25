<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;

class Operator extends \HexMakina\kadro\Auth\Operator
{
    use Abilities\FiltersOnFirstChar;


    public function __toString()
    {
        return $this->get('username');
    }

    public static function filter($filters = [], $options = []): SelectInterface 
    {
        
        $options['withPermissions'] ??= true;

        $query = parent::filter($filters, $options);
        // remove root from general listings
        $query->whereNotLike('name', '%root%', 'kadro_permission');

        if (isset($filters['FiltersOnFirstChar'])) {
            self::applyFirstCharFilter($filters['FiltersOnFirstChar'], $query, 'username');
        }

        if (isset($filters['segment'])) {
            if($filters['segment'] === 'inactives'){
                $query->whereEQ('active', 0, 'operator', ':operator_active_filter');
            }
            else{
                $query->whereEQ('name', $filters['segment'], 'kadro_permission', ':operator_segment_filter');
            }
        }

        return $query;
    }
}
