<?php

namespace App\Controllers\API;

use \App\Models\{Contest, Job, Event};

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
                'id' => $event->id(),
                'url' => $this->router()->hyp('professional', ['id' => $event->id()]),
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

    public function events()
    {

        $res = Event::filter(['date_start' => $this->router()->params('start'), 'date_stop' => $this->router()->params('end')]);
        // dd($res);
        $events = [];
        foreach($res as $event){
            $events[]= [
                'categorie' => 'evt-'.$event->get('type_slug'),
                'className' => 'evt-'.$event->get('type_slug'),
                'title' => $event->__toString(),
                'start' => $event->get('starts'),
                'end' => $event->get('ends'),
                'url_site' => $event->get('url_site'),
                'url_internal' => $event->get('url_internal')
            ];
        }
        echo(json_encode($events));
        die;
    }
/*
{
          categorie: 'categorie2',
          title: 'Business Lunch',
          start: '2023-01-03T13:00:00',
          constraint: 'businessHours',
          color: '#ea9909'
        }
        */

}
