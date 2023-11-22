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
    
    /**
     * Constructs a database query for listing contests with specific columns and filters.
     *
     * @return SelectInterface The constructed database query object.
     */
    public static function queryListing(): SelectInterface
    {
        $select = self::table()->select(['slug','label','starts','stops'], 'contest');

        $now = date('Y-m-d');
        $startsAfter = $select->addBinding('startsAfter', $now);
        $stopsBefore = $select->addBinding('stopsBefore', $now);
        $select->whereWithBind(sprintf('starts <= %s AND stops IS NOT NULL AND (stops >= %s)', $startsAfter, $stopsBefore));

        $select->whereEQ('public', 1);

        $select->orderBy(['starts', 'ASC']);

        return $select;
    }

    public static function query_retrieve($filters = [], $options = []): SelectInterface
    {
        $Query = parent::query_retrieve($filters, $options);
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
        return $Query;
    }
}