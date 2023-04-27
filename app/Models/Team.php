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

    public function profilePicture(): string
    {
        return empty($this->get('photo')) ? '' : 'https://www.cinergie.be/images/' . $this->get('photo');
    }
    
    public function contactPoint(): string
    {
        return $this->get('email');
    }

}