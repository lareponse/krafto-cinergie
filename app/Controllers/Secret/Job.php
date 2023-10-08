<?php

namespace App\Controllers\Secret;

use HexMakina\kadro\Models\Tag;

class Job extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\FiltersOnYearAndMonth;
    use \App\Controllers\Abilities\EditOnly;


    public function activeSection(): string
    {
        return 'Event';
    }



    public function conclude(): void
    {
        $this->viewport('types', Tag::filter(['parent' => 'job_category']));
        parent::conclude();
    }
}
