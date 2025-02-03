<?php

namespace App\Controllers\Secret;


class Page extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\RequiresEditorOrAbove;

    public function activeSection(): string
    {
        return 'Page';
    }

    public function alter()
    {

    }

    public function conclude(): void
    {
        if(empty($this->viewport('title')) && $this->loadModel()){
            $this->viewport('title', $this->loadModel()->get('label'));
        }
        parent::conclude();
    }
}
