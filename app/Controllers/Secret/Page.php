<?php

namespace App\Controllers\Secret;


class Page extends Krafto
{
    use \App\Controllers\Abilities\HasORM;

    public function activeSection(): string
    {
        return 'Page';
    }

    public function slug()
    {
        $res = $this->modelClassName()::one('slug', $this->router()->params('slug'));
        $this->urlFor('Page', 'edit', $res);
    }

    
    public function conclude(): void
    {
        if(empty($this->viewport('title'))){
            $this->viewport('title', $this->loadModel()->get('label'));
        }
        parent::conclude();
    }
}
