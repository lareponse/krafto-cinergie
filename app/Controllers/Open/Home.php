<?php

namespace App\Controllers\Open;

use App\Models\{Article, Contest, Event, Work};

class Home extends Kortex
{

    protected $pageSlug = 'home';
        
    public function home()
    {
        $query = Article::queryListing();
        $query->whereEQ('isDiaporama', '1');
        $this->viewport('articlesDiaporama', $query->retObj(Article::class));
        
        $query = Article::queryListing();
        $query->whereEQ('isDiaporama', '0');
        $query->whereEQ('type_id', '50');
        $query->whereNotEmpty('embedVideo');
        $query->limit(3);
        $this->viewport('entrevuesFilmees', $query->retObj(Article::class));

        $query = Article::queryListing();
        $query->whereEQ('isDiaporama', '0');
        $query->whereEmpty('embedVideo');
        $query->limit(3);
        $this->viewport('sousLaLoupe', $query->retObj(Article::class));

        $contests = Contest::filter(['active' => '1', ['order_by' => [['contest', 'starts', 'ASC']]]]);
        $this->viewport('contests', $contests);

        $events = Event::filter(['active' => '1'], ['limit' => '3', 'order_by' => [['event', 'starts', 'ASC']]]);
        $this->viewport('events', $events);

        $works = Work::filter(['active' => '1'], ['limit' => '5', 'order_by' => [['work', 'starts', 'ASC']]]);
        $this->viewport('works', $works);
    }
}
