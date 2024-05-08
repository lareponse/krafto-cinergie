<?php

namespace App\Controllers\Secret;

class Submission extends Krafto
{
    use \App\Controllers\Abilities\HasORM;


    public function view()
    {
        if (is_null($this->loadModel())) {
            $this->router()->hop('dash_submissions');
        }
        $this->loadModel()->record();
    }
}