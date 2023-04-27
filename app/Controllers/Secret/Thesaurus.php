<?php

namespace App\Controllers\Secret;


class Thesaurus extends Krafto
{
    use \App\Controllers\Abilities\HasORM;

    public function activeSection(): string
    {
        return 'Settings';
    }

}