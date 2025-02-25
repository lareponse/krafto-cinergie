<?php

namespace App\Controllers\Abilities;

trait HasNoView
{
    public function view()
    {
        $this->router()->hop('dash_record_edit', ['nid' => $this->nid(), 'id' => $this->loadModel()->id()]);
    }
}