<?php

namespace App\Controllers\Open;

use DateTimeImmutable;
use \HexMakina\kadro\Models\Tag;
use \App\Models\Event as Model;

class Event extends Kortex
{

    protected $pageSlug = 'events';

    public function events()
    {
        $currentDate = new DateTimeImmutable();

        $filters = [
            'year' => $this->router()->params('year') ?? $currentDate->format('Y'), 
            'month' => $this->router()->params('month') ?? $currentDate->format('m')
        ];
        
        // $formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::NONE, \IntlDateFormatter::NONE, null, null, 'MMMM');
        
        if($this->router()->params('year') && $this->router()->params('month')){
            $currentDate = $currentDate->setDate($filters['year'], $filters['month'], 1);
        }

        $previousMonth = $currentDate->modify('-1 month');
        $nextMonth = $currentDate->modify('+1 month');

        $this->viewport('currentDate', $currentDate);
        $this->viewport('previousMonth', $previousMonth);
        $this->viewport('nextMonth', $nextMonth);

        
        $events = Model::any(['public' => 1, 'year' => $currentDate->format('Y'), 'month' => $currentDate->format('m')]);
        $this->viewport('events', $events);
        $this->viewport('events_json', $this->loadEvent($currentDate));

    }

    private function loadEvent($referenceDate): string
    {
        $res = Tag::any(['parent' => 'event_category']);
        foreach($res as $t)
            $tags[$t->id()] = $t->slug();

        $start = $referenceDate->modify('-1 month');
        $end = $referenceDate->modify('+3 month');
        
        $res = Model::any(['date_start' => $start->format('Y-m-d')]);

        $events = [];
        foreach($res as $event){
            $category = $event->get('type_id');
            $events[]= [
                'categorie' => $tags[$category] ?? 'categorie1',
                'className' => $tags[$category] ?? 'categorie1',
                'title' => $event->__toString(),
                'start' => $event->get('starts'),
                'end' => $event->get('stops'),
                'url_site' => $event->get('url_site'),
                'url_internal' => $event->get('url_internal')
            ];
        }
        return json_encode($events);
    }
}
