<?php

namespace App\Models;

use DateTimeImmutable;
use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;
use HexMakina\kadro\Models\Interfaces\EventInterface;

class Work extends TightModel implements EventInterface
{
    use \HexMakina\kadro\Models\Abilities\Event;
    use Abilities\HasSlug;


    public function __toString()
    {
        return $this->get('label');
    }
    
    public function event_field(): string
    {
        return 'starts';
    }

    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        $Query = parent::query_retrieve($filters, $options);

        if(isset($filters['isOffer']))
        {
            $Query->whereEQ('isOffer', $filters['isOffer']);
        }

        if(isset($filters['isPaid']))
        {
            $Query->whereEQ('isPaid', $filters['isPaid']);
        }

        if(isset($filters['ongoing']) && $filters['ongoing'] === true)
        {
            $now = new \DateTimeImmutable();
            $now = $now->format('Y-m-d');

            $startsAfter = $Query->addBinding('startsAfter', $now);
            $endsBefore = $Query->addBinding('endsBefore', $now);
            $Query->whereWithBind(sprintf('starts >= %s AND ends IS NOT NULL AND ends >= %s', $startsAfter, $endsBefore));
        }

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

        $Query->orderBy(['starts', 'asc']);

        return $Query;
    }
}