<?php
namespace App\Models\Abilities;

trait HasPraxis
{
    private $praxis = [];

    abstract public function tags($ids = []) : array;
    
    public function praxis() : array
    {
        if(empty($this->praxis)){
            $this->praxis = $this->tags($this->praxisIds());
        }

        return $this->praxis;
    }
    
    public function praxisIds(): array
    {
        if(!empty($this->get('praxis_ids')))
            return explode(',',$this->get('praxis_ids'));
            
        return [];
    }

}
