<?php

namespace App\Controllers\Open;

use App\Models\{Article, Contest, Event, Job};

class Home extends Kortex
{

    protected $pageSlug = 'home';
        
    public function home()
    {
        $articlesDiaporama = Article::queryListing()
            ->whereEQ('public', '1')
            ->whereEQ('pick', '1')
            ->limit(7);
        
        $articlesDiaporama = $articlesDiaporama->retObj(Article::class);


        $entrevues = Article::queryListing()
            ->whereEQ('public', '1')
            ->whereEQ('pick', '1')
            ->whereEQ('type_id', '50')
            ->whereNotEmpty('embedVideo')
            ->limit(3);

        $entrevues = $entrevues->retObj(Article::class);


        $sousLaLoupe = Article::queryListing()
            ->whereEQ('public', '1')
            ->whereEQ('pick', '1')
            ->whereEmpty('embedVideo')
            ->limit(3);
        $sousLaLoupe = $sousLaLoupe->retObj(Article::class);
            

        $contests = Contest::queryListing()
            ->whereEQ('public', '1')
            ->whereEQ('pick', '1')
            ->limit(1);

        $contests = $contests->retObj(Contest::class);

        $events = Event::queryListing()
            ->whereEQ('public', '1')
            ->whereEQ('pick', '1')
            ->limit(3)
            ->orderBy(['starts', 'ASC']);

        $events = $events->retObj(Event::class);
        

        $window = [new \DateTimeImmutable('-1 month'), new \DateTimeImmutable('+2 month')];
        $jobs = Job::queryListingWithEvent(
            Job::queryListing()->whereEQ('public', '1')->limit(5)->orderBy(['starts', 'DESC']),
            $window[0], $window[1]);
        $jobs = $jobs->retObj(Job::class);
            
        $this->viewport('articlesDiaporama', $articlesDiaporama);
        $this->viewport('entrevues', $entrevues);
        $this->viewport('sousLaLoupe', $sousLaLoupe);

        $this->viewport('contests', $contests);
        $this->viewport('events', $events);
        $this->viewport('jobs', $jobs);
    }
}
