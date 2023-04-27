<?php
namespace App\Models\Abilities;

trait HasPraxis
{
    private $praxis = [];

    abstract public function tags($ids = []) : array;
    
    public function praxis() : array
    {
        if(empty($this->praxis)){
            $this->praxis = $this->tags(explode(',',$this->get('praxis_ids')));
        }

        return $this->praxis;
    }

}
