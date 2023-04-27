<?php
namespace App\Models\Abilities;

trait IsActivable
{
    abstract public function get($string);

    public function isActive(): bool
    {
        return !empty($this->get($this->activableField()));
    }
    
    public function activableField(): string
    {
        return 'active';
    }
    
}