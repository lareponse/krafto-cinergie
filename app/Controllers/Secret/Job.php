<?php

namespace App\Controllers\Secret;

use HexMakina\kadro\Models\Tag;

class Job extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\FiltersOnYear;
    use \App\Controllers\Abilities\HasNoView;

    public function activeSection(): string
    {
        return 'Event';
    }

    public function conclude(): void
    {
        $this->viewport('types', Tag::any(['parent' => 'job_category']));
        parent::conclude();
    }
}
