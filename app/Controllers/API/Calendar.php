<?php

namespace App\Controllers\API;

use \App\Models\{Contest, Work, Event};

class Calendar extends \HexMakina\kadro\Controllers\Kadro
{
    public function requiresOperator() : bool
    {
        return false;
    }

    public function contests()
    {
        $start = $_GET['start'];
        $end = $_GET['end'];
        $res = Contest::filter(['date_start' => $start, 'date_stop' => $end]);
        $events = [];
        foreach($res as $event){
            $events[] = [
                'id' => $event->getID(),
                'url' => $this->router()->hyp('professional', ['id' => $event->getID()]),
                'title' => $event->event_label(),
                'start' => $event->get($event->event_field()),
                'end' => $event->get('ends'),
                'description' => $event->get('abstract')
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($events);
        die;

    }


}
