<?php

namespace App\Controllers\Secret;

use HexMakina\kadro\Models\Tag;
use App\Models\Article;

class Event extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\FiltersOnYear;

    public function activeSection(): string
    {
        return 'Event';
    }

    public function view()
    {
        $this->router()->hop('dash_record_edit', ['nid' => $this->nid(), 'id' => $this->router()->params('id')]);
    }
    
    public function alter()
    {
        if($this->loadModel()){
            $query = Article::filter();
            $query->join(['article_event', 'article_event'],  [['article_event', 'article_id', 'article', 'id']], 'LEFT OUTER');
            $query->whereEQ('event_id', $this->loadModel()->id(), 'article_event');
            
            $articles = $query->retObj(Article::class);
        }

        $this->viewport('articles', $articles ?? []);
    }

    public function conclude(): void
    {
        $this->viewport('types', Tag::any(['parent' => 'event_category']));
        parent::conclude();
    }
}
