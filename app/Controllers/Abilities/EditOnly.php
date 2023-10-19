<?php

namespace App\Controllers\Abilities;

trait EditOnly
{
    // return the controller's class short name
    abstract public function urn();
    abstract public function router();


    public function view()
    {
        $this->router()->hop('dash_record_edit', ['controller' => $this->urn(), 'id' => $this->router()->params('id')]);
    }
    
}