<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;
use HexMakina\kadro\Models\Interfaces\EventInterface;

class Event extends TightModel implements EventInterface
{
    use \HexMakina\kadro\Models\Abilities\Event;
    use Abilities\IsActivable;
    use Abilities\HasSlug;

    public function __toString()
    {
        return $this->get('label') ?? $this->get('id') ?? '';
    }
    
    public function event_field(): string
    {
        return 'starts';
    }

    public function link()
    {
        if(!empty($this->get('url_internal'))){
            return $this->get('url_internal');
        }
        if(!empty($this->get('url_site'))){
            return $this->get('url_site');
        }
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