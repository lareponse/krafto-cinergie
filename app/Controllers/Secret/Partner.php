<?php

namespace App\Controllers\Secret;


class Partner extends Krafto
{
    use \App\Controllers\Abilities\HasORM;

    public function activeSection(): string
    {
        return 'Page';
    }
    
    public function home()
    {
        $filters = empty($this->router()->params()) ? [] : $this->router()->params();
        $this->viewport('partners', $this->modelClassName()::filter($filters));
        $this->viewport('filters', $filters);
    }
}