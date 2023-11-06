<?php
namespace App\Models\Abilities;

use HexMakina\BlackBox\Database\SelectInterface;

trait IsActivable
{
    abstract public function get($string);

    public function isActive(): bool
    {
        return !empty($this->get(self::activableField()));
    }
    
    public static function activableField(): string
    {
        return 'public';
    }

    public static function activableQuery(SelectInterface $select, $type): SelectInterface
    {
        if($type === 0 || $type === 1){
            return $select->whereEQ(self::activableField(), $type);
        }
    }
    
}