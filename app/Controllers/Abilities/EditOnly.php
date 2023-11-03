<?php

namespace App\Controllers\Abilities;

trait EditOnly
{
    // return the controller's class short name
    abstract public function nid();
    abstract public function router();


    public function view()
    {
        $this->router()->hop('dash_record_edit', ['nid' => $this->nid(), 'id' => $this->router()->params('id')]);
    }
    
}