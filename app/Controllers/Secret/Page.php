<?php

namespace App\Controllers\Secret;


class Page extends Krafto
{
    use \App\Controllers\Abilities\HasORM;

    public function activeSection(): string
    {
        return 'Page';
    }

    public function alter()
    {

    }

    public function home()
    {
        $listing = $this->modelClassName()::filter($this->router()->params());
        $this->viewport('listing', $listing);
        $this->viewport('filters', $this->router()->params());
    }


    public function conclude(): void
    {
        if(empty($this->viewport('title')) && $this->loadModel()){
            $this->viewport('title', $this->loadModel()->get('label'));
        }
        parent::conclude();
    }
}
