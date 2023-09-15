<?php

namespace App\Controllers\Open;

use DateTimeImmutable;
use DateTimeZone;

class Event extends Kortex
{

    public function agenda()
    {
        $current = new \DateTimeImmutable();
        // $date = new \DateTimeImmutable();
        // $date->setDate($current->format('Y'), $current->format('m'), 1);
        $formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::NONE, \IntlDateFormatter::NONE, null, null, 'MMMM');
        // Format the date
        $month = $formatter->format($current);
        $this->viewport('current', $current);
        $this->viewport('current_month', ucfirst($month));
        $this->viewport('current_year', $current->format('Y'));
    }
}
