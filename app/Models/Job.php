<?php

namespace App\Models;

use DateTimeImmutable;
use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;
use HexMakina\kadro\Models\Interfaces\EventInterface;

class Job extends TightModel implements EventInterface
{
    use \HexMakina\kadro\Models\Abilities\Event;
    use Abilities\IsActivable;
    use Abilities\HasProfilePicture;
    use Abilities\HasSlug;


    public function __toString()
    {
        return $this->get('label');
    }
    
    public function event_field(): string
    {
        return 'starts';
    }

    public function isOffer(): bool
    {
        return (bool)$this->get('isOffer');
    }
    
    public function isPaid(): bool
    {
        return (bool)$this->get('isPaid');
    }
    
    public static function filter($filters = [], $options = []): SelectInterface
    {
        $Query = parent::filter($filters, $options);

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
            $stopsBefore = $Query->addBinding('stopsBefore', $now);
            $Query->whereWithBind(sprintf('starts >= %s AND stops IS NOT NULL AND stops >= %s', $startsAfter, $stopsBefore));
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

        if(isset($filters['window'])){
            [$starts, $stops] = $filters['window'];
            $starts = $Query->addBinding('starts', $starts->format('Y-m-d'));
            $stops = $Query->addBinding('stops', $stops->format('Y-m-d'));
            $clauses = [
                'startsBetween' => "starts BETWEEN $starts AND $stops",
                'stopsBetween' => "stops BETWEEN $starts AND $stops",
                'ongoing' => "starts < $starts AND stops > $starts"
            ];
            $Query->whereWithBind(sprintf('(%s)', implode(') OR (', $clauses)));
        }

        $Query->orderBy(['starts', 'asc']);

        return $Query;
    }
}