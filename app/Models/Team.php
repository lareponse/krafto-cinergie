<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Team extends TightModel
{

    public function fullName() : string
    {
        return $this->get('label');
    }

    public function profilePicturePath(): string
    {
        return empty($this->get('avatar')) ? '' : '/images/'.$this->get('avatar');
    }
    
    public function contactPoint(): string
    {
        return $this->get('email');
    }

}