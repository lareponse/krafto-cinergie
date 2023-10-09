<?php

namespace App\Controllers\Open;

use App\Models\{Article, Contest, Event, Job};

class Home extends Kortex
{

    protected $pageSlug = 'home';
        
    public function home()
    {
        $articlesDiaporama = Article::queryListing()
            ->whereEQ('isDiaporama', '1')
            ->limit(7);
        
        $entrevuesFilmees = Article::queryListing()
            ->whereEQ('isDiaporama', '0')
            ->whereEQ('type_id', '50')
            ->whereNotEmpty('embedVideo')
            ->limit(3);

        $sousLaLoupe = Article::queryListing()
            ->whereEQ('isDiaporama', '0')
            ->whereEmpty('embedVideo')
            ->limit(3);
            
            
        $events = Event::queryListing()
            ->whereEQ('active', '1')
            ->limit(3)
            ->orderBy(['starts', 'ASC']);
        
        
        $jobs = Job::queryListingWithEvent(
            Job::queryListing()->whereEQ('active', '1')->limit(5)->orderBy(['starts', 'DESC']),
            new \DateTimeImmutable('-1 month'), new \DateTimeImmutable('+2 month')
        );
        $jobs = $jobs->retObj(Job::class);
            
        $this->viewport('articlesDiaporama', $articlesDiaporama->retObj(Article::class));
        $this->viewport('entrevuesFilmees', $entrevuesFilmees->retObj(Article::class));
        $this->viewport('sousLaLoupe', $sousLaLoupe->retObj(Article::class));

        $this->viewport('contests', Contest::queryListing()->retObj(Contest::class));
        $this->viewport('events', $events->retObj(Event::class));
        $this->viewport('jobs', $jobs);
    }
}
