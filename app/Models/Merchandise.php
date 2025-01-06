<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Merchandise extends TightModel
{
    use Abilities\HasCompletion;
    use Abilities\HasSlug;
    use Abilities\HasProfilePicture;
    use Abilities\IsActivable;
    use Abilities\FiltersOnFirstChar;

    public function __toString()
    {
        return $this->get('label');
    }

    public function fieldsForCompletion(): array
    {
        return ['label', 'content', 'price', 'isActive', 'deliveryBe', 'deliveryEu'];
    }

    public function isBook(): bool
    {
        return !empty($this->get('isBook'));
    }
    

    public static function filter($filters = [], $options = []): SelectInterface
    {
        $Query = parent::filter($filters, $options);

        if(isset($filters['FiltersOnFirstChar'])){
            self::applyFirstCharFilter($filters['FiltersOnFirstChar'], $Query, 'label');
        }
        
        return $Query;
    }
}