<?php

namespace App\Controllers\Open;

use App\Models\{Article, Contest, Event, Job};
use \HexMakina\kadro\Models\Tag;

class Home extends Kortex
{

    protected $pageSlug = 'home';
        
    public function home()
    {
        $baseFilters = ['public' => 1, 'pick' => 1];
        $select = Article::filter($baseFilters)
            ->limit(7);
        $articlesDiaporama = $select->retObj(Article::class);

        $entrevue_tag = Tag::one('slug', 'article-cat-entrevue');
        $select = Article::filter($baseFilters)
            ->whereEQ('type_id', $entrevue_tag->id())
            ->whereNotEmpty('embedVideo')
            ->orderBy(['publication', 'DESC'])
            ->limit(3);

        $entrevues = $select->retObj(Article::class);

        $select = Article::filter($baseFilters)
            ->whereEmpty('embedVideo')
            ->limit(3);
        $sousLaLoupe = $select->retObj(Article::class);
            
        $select = Contest::filter($baseFilters)
            ->limit(1);

        $contests = $select->retObj(Contest::class);

        $select = Event::filter($baseFilters)
            ->limit(3)
            ->orderBy(['starts', 'ASC']);

        $events = $select->retObj(Event::class);
        
        $select = Job::filter(['window' => [new \DateTimeImmutable('-1 month'), new \DateTimeImmutable('+2 month')]]);
        $select->whereEQ('public', '1')
               ->limit(5)
               ->orderBy(['starts', 'DESC']);

        $jobs = $select->retObj(Job::class);

        $this->viewport('articlesDiaporama', $articlesDiaporama);
        $this->viewport('entrevues', $entrevues);
        $this->viewport('sousLaLoupe', $sousLaLoupe);
        
        $this->viewport('contests', $contests);
        $this->viewport('events', $events);
        $this->viewport('jobs', $jobs);

        $job_controller = $this->get('Controllers\\Open\\Job');
        foreach($job_controller->viewportTagLists() as $key => $tags)
            $this->viewport($key, $tags);
    }
}
