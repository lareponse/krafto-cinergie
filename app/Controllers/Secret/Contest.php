<?php

namespace App\Controllers\Secret;

class Contest extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\FiltersOnYear;

    public function activeSection(): string
    {
        return 'Event';
    }

    public function view()
    {
        $this->router()->hop('dash_record_edit', ['nid' => $this->nid(), 'id' => $this->router()->params('id')]);
    }
}
