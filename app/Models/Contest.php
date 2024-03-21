<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;
use HexMakina\kadro\Models\Interfaces\EventInterface;

class Contest extends TightModel implements EventInterface
{
    use \HexMakina\kadro\Models\Abilities\Event;

    use Abilities\IsActivable;
    use Abilities\HasSlug;
    use Abilities\HasProfilePicture;


    public function __toString()
    {
        return $this->get('label');
    }
    
    public function event_field(): string
    {
        return 'starts';
    }

    public function isRunning(): bool
    {
        return empty($this->get('stops')) || (date('Y-m-d') <= $this->get('stops'));
    }

    public function canShowForm(): bool
    {
        return !empty($this->get('canShowForm')) && $this->isRunning();
    }
    
    public static function filter($filters = [], $options = []): SelectInterface
    {
        $Query = parent::filter($filters, $options);

        if(isset($filters['year']))
        {
            $bindname = $Query->addBinding('filters_year', $filters['year']);
            $Query->whereWithBind('YEAR(`starts`) = '.$bindname);
        }

        if(isset($filters['month']))
        {
            $bindname = $Query->addBinding('filters_month', $filters['month']);
            $Query->whereWithBind('MONTH(`starts`) = '.$bindname);
        }

        $Query->orderBy(['starts', 'ASC']);

        return $Query;
    }
}