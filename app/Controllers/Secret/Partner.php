<?php

namespace App\Controllers\Secret;


class Partner extends Krafto
{
    use \App\Controllers\Abilities\HasORM;

    public function activeSection(): string
    {
        return 'Page';
    }
    
}