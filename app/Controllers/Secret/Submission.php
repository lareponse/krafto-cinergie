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

        if(strpos($this->loadModel()->get('urn'), ':') !== false)
        {
            list($class, $id) = explode(':', $this->loadModel()->get('urn'));
            $modified = $this->get('App\\Models\\' . $class);
            $modified->import(json_decode($this->loadModel()->get('submitted'), true));
            $original = get_class($modified)::one($id);
            $this->viewport('original', $original);
            $this->viewport('modified', $modified);
        }
        else
        {
            $this->viewport('submission', $this->loadModel());
        }

    }
}
