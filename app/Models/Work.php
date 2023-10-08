<?php

namespace App\Models;

use DateTimeImmutable;
use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;
use HexMakina\kadro\Models\Interfaces\EventInterface;

class Work extends TightModel implements EventInterface
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
    
         
    /**
     * Constructs a database query for listing advertisements with specific columns and filters.
     *
     * @return SelectInterface The constructed database query object.
     */
    public static function queryListing(): SelectInterface
    {
        $select = self::table()->select([
            'slug',
            'label',
            'starts',
            'isOffer',
            'isPaid',
            'category_label' => ['tag', 'label']
        ]);

        $now = date('Y-m-d');
        $startsAfter = $select->addBinding('startsAfter', $now);
        $stopsBefore = $select->addBinding('stopsBefore', $now);
        $select->whereWithBind(sprintf('starts >= %s AND stops IS NOT NULL AND (stops >= %s)', $startsAfter, $stopsBefore));
        

        $select->join(['tag', 'tag'], [[$select->table(), 'category_id', 'tag', 'id']], 'LEFT OUTER');

        $select->orderBy(['starts', 'ASC']);

        return $select;
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

        $Query->orderBy(['starts', 'asc']);

        return $Query;
    }
}