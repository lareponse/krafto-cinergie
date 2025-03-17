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
        $this->logger()->notice('Vous ne pouvez pas supprimer ce modèle');
        $this->router()->hopBack();
        /*
        $this->router()->validate('urn');

        $model = $this->loadModel();

        if ($model instanceof ModelInterface) {
            $model->delete();
        }

        $this->router()->redirect($this->router()->route('records'));
        */
    }
}