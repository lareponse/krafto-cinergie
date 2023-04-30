<?php

namespace App\Controllers\Secret;

class Work extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\FiltersOnYearAndMonth;

    public function activeSection(): string
    {
        return 'Event';
    }
}
