<?php

namespace App\Controllers\Secret;

use HexMakina\kadro\Models\Tag;

class Job extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\FiltersOnYearAndMonth;

    public function activeSection(): string
    {
        return 'Event';
    }

    public function view()
    {
        $this->router()->hop('dash_record_edit', ['nid' => $this->nid(), 'id' => $this->router()->params('id')]);
    }

    public function conclude(): void
    {
        $this->viewport('types', Tag::any(['parent' => 'job_category']));
        parent::conclude();
    }
}
