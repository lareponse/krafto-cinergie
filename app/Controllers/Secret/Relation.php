<?php

namespace App\Controllers\Secret;

use HexMakina\BlackBox\Database\TableInterface;
use HexMakina\Crudites\{Crudites, CruditesException};

class Relation extends Krafto
{

    public function link()
    {
        $database = $this->get('HexMakina\BlackBox\Database\DatabaseInterface');

        foreach ($this->router()->submitted() as $key => $value) {
            $$key = $value;
        }
        
        if(!isset($parent_id) || !isset($relation)) {
            throw new \InvalidArgumentException('MISSING_ARGUMENTS');
        }

        $relation = $database->relations()->getRelation($relation);
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
        $qualifiers = $this->router()->submitted();

        [$table, $table_b] = array_keys($qualifiers);
        $relation_table = $this->findRelationalTable($table, $table_b);
        //errors
        if (is_array($relation_table)) {
            return $relation_table;
        }

        $relations = $relation_table->foreignKeysByTable();

        if (!isset($relations[$table]) || count($relations[$table]) !== 1) {
            throw new \InvalidArgumentException('MISSING_IMPLEMENTATION');
        }

        if (!isset($relations[$table_b]) || count($relations[$table_b]) !== 1) {
            throw new \InvalidArgumentException('MISSING_IMPLEMENTATION');
        }

        $column = array_pop(($relations[$table]));
        $column_b = array_pop(($relations[$table_b]));

        $dat_ass = [
            $column->name() => $this->router()->submitted($table),
            $column_b->name() => $this->router()->submitted($table_b)
        ];
        $res = $relation_table->select()->whereFieldsEQ($dat_ass)->retAss();
        if (!is_array($res) || count($res) !== 1) {
            throw new \InvalidArgumentException('TOO_MANY_RESULTS_FOR_DELETION');
        }

        $relation_table->delete($dat_ass)->run();

        $this->router()->hopBack();
    }

    private function findRelationalTable($parent, $child): TableInterface
    {
        $table_names = [$parent . '_' . $child, $child . '_' . $parent];
        foreach ($table_names as $table_name) {
            try {
                $relation_table = Crudites::database()->inspect($table_name);
                return $relation_table;
            } catch (CruditesException $e) {
            }
        }

        throw new CruditesException('FAILED_TO_GUESS_RELATIONAL_TABLE');
    }
}
