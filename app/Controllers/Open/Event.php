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

        $formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::NONE, \IntlDateFormatter::NONE, null, null, 'MMMM');

        $currentDate = new DateTimeImmutable();

        if($this->router()->params('year') && $this->router()->params('month')){
            $currentDate = $currentDate->setDate($this->router()->params('year'), $this->router()->params('month'), 1);
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

        $events = Model::filter($this->router()->params());

        $this->viewport('events', $events);

    }
}
