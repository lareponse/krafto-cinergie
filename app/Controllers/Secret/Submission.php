<?php

namespace App\Controllers\Secret;

use \App\Models\Article;

class Submission extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\RequiresEditorOrAbove;
    public function home()
    {
        parent::home();
        $articles = Article::any(['status' => 'review_requested']);
        $this->viewport('articles_for_review', $articles);
        $this->viewport('articleController', $this->get('Controllers\\Secret\\Article') );
    }
    public function view()
    {
        if (is_null($this->loadModel())) {
            $this->router()->hop('dash_submissions');
        }

        // if urn has : its about a specfic record
        if(strpos($this->loadModel()->get('urn'), ':') !== false)
        {
            list($class, $id) = explode(':', $this->loadModel()->get('urn'));
            $modified = $this->get('App\\Models\\' . $class);
            $modified->import(json_decode($this->loadModel()->get('submitted'), true));
            $original = get_class($modified)::one($id);
            $this->viewport('original', $original);
            $this->viewport('modified', $modified);
        }
        else
        {
            $this->viewport('submission', $this->loadModel());
        }

    }

    public function approve()
    {
        $this->loadModel()->set('approved', 1);
        $this->loadModel()->set('reviewed_by', $this->operator()->id());
        $this->loadModel()->save($this->operator()->id());

        if($this->loadModel()->get('urn') === 'annonces'){
            $annonce = $this->get('App\\Models\\Job');
            $annonce->import(json_decode($this->loadModel()->get('submitted'), true));
            $annonce->set('public', 0);
            $annonce->save($this->operator()->id());
        }
        $this->router()->hop('dash_submissions');
    }

    public function reject()
    {
        $this->loadModel()->set('approved', 0);
        $this->loadModel()->set('reviewed_by', $this->operator()->id());

        $this->loadModel()->save($this->operator()->id());
        $this->router()->hop('dash_submissions');
    }
}
