<?php

namespace App\Controllers\Secret;

class Contest extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\FiltersOnYearAndMonth;

    public function activeSection(): string
    {
        return 'Event';
    }
}
