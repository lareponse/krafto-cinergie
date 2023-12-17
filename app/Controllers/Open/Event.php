<?php

namespace App\Controllers\Open;

use DateTimeImmutable;
use DateTimeZone;

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
        
        $formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::NONE, \IntlDateFormatter::NONE, null, null, 'MMMM');
        
        if($this->router()->params('year') && $this->router()->params('month')){
            $currentDate = $currentDate->setDate($filters['year'], $filters['month'], 1);
        }

        $current = [
            'month_string' => $formatter->format($currentDate),
            'month' => $currentDate->format('m'),
            'year' => $currentDate->format('Y')
        ];
        
        $previousMonth = $currentDate->modify('-1 month');
        $previous = [
            'month_string' => $formatter->format($previousMonth),
            'month' => $previousMonth->format('m'),
            'year' => $previousMonth->format('Y')
        ];

        $nextMonth = $currentDate->modify('+1 month');
        $next = [
            'month_string' => $formatter->format($nextMonth),
            'month' => $nextMonth->format('m'),
            'year' => $nextMonth->format('Y')
        ];


        $this->viewport('current', $current);
        $this->viewport('previous', $previous);
        $this->viewport('next', $next);

        
        $events = Model::any($filters);
        $this->viewport('events', $events);

    }
}
