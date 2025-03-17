<?php

namespace App\Controllers\Secret;

use App\Models\Event;

class Sanitize extends \HexMakina\kadro\Controllers\Kadro
{
    public function requiresOperator(): bool
    {
        return false;
    }


    public function agenda()
    {
        $twoMonthsAgo = date('Y-m-d', strtotime('-12 months'));
        $purge = 'DELETE FROM `event` WHERE stops < :twoMonthsAgo;';
        $res = Event::raw($purge, ['twoMonthsAgo' => $twoMonthsAgo]);

        http_response_code(200);
        die('PURGED');
    }
}