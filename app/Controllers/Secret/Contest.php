<?php

namespace App\Controllers\Secret;

class Contest extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\FiltersOnYearAndMonth;
    use \App\Controllers\Abilities\EditOnly;


    public function activeSection(): string
    {
        return 'Event';
    }
}
