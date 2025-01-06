<?php

namespace App\Controllers\Secret;

use App\Controllers\Secret\Krafto;

class Delete extends Krafto
{
    use \App\Controllers\Abilities\HasORM;

    public function activeSection(): string
    {
      return 'Delete';
    }

    public function delete()
    {
        dd($this->router()->requests());
        $this->router()->validate('urn');

        $model = $this->loadModel();

        if ($model instanceof ModelInterface) {
            $model->delete();
        }

        $this->router()->redirect($this->router()->route('records'));
    }
}