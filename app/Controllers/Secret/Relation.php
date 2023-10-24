<?php

namespace App\Controllers\Secret;

use HexMakina\Crudites\Relation\DatabaseRelations;

class Relation extends Krafto
{
    private DatabaseRelations $relations;

    public function prepare(): void
    {
        $this->relations = $this->get('HexMakina\BlackBox\Database\DatabaseInterface')->relations();
    }

    public function link()
    {
        foreach ($this->router()->submitted() as $key => $value) {
            $$key = $value;
        }
        
        if(!isset($parent_id) || !isset($relation)) {
            throw new \InvalidArgumentException('MISSING_ARGUMENTS');
        }

        $relation = $this->relations->getRelation($relation);
        if (!is_null($relation)) {

            if (isset($children_ids)) { // many to many
                $relation->link($parent_id, $children_ids);
            } 
            elseif (isset($qualifier_id)) { // many to many qualified
                $relation->link($parent_id, [['qualified' => $qualified_id, 'qualifier' => $qualifier_id]]);
            }
            elseif (isset($child_id)) { // one to one
                $relation->link($parent_id, $child_id);
            }

        } else {
            dd($this->router()->submitted(), 'NO RELATION FOUND');
        }


        $this->router()->hopBack();
    }

    public function unlink()
    {
        foreach($this->router()->submitted() as $key => $value){
            $$key = $value;
        }

        $relation = $this->relations->getRelation($relation);
        $relation->unlink($source, [$target]);

        if(isset($return_to)){
            $this->router()->hopURL($return_to);
        }
        $this->router()->hopBack();
    }
}
