<?php

namespace App\Controllers\Secret;

use HexMakina\kadro\Models\Tag;
use App\Models\Article;

class Work extends Krafto
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
        $this->viewport('types', Tag::filter(['parent' => 'work_category']));
        parent::conclude();
    }
}
