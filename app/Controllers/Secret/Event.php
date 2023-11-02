<?php

namespace App\Controllers\Secret;

use HexMakina\kadro\Models\Tag;
use App\Models\Article;

class Event extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\FiltersOnYearAndMonth;
    use \App\Controllers\Abilities\EditOnly;
    

    public function activeSection(): string
    {
        return 'Event';
    }

    public function alter()
    {
        if($this->loadModel()){
            $query = Article::queryListing();
            $query->join(['article_event', 'article_event'],  [['article_event', 'article_id', 'article', 'id']], 'LEFT OUTER');
            $query->whereEQ('event_id', $this->loadModel()->getID(), 'article_event');
            
            $articles = $query->retObj(Article::class);
        }

        $this->viewport('articles', $articles ?? []);
    }

    public function conclude(): void
    {
        $this->viewport('types', Tag::filter(['parent' => 'event_category']));
        parent::conclude();
    }
}
