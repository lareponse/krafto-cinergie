<?php

namespace App\Controllers\Secret;

use HexMakina\Crudites\{Crudites, CruditesException};

class Relation extends Krafto
{
    public function link()
    {
        ['parent' => $parent, 'child' => $child] = $this->router()->params();
        [$parent_key, $child_key] = [$parent . '_id', $child . '_id'];
        [$parent_key => $parent_id, $child_key . 's' => $child_ids] = $this->router()->submitted();


        $res = $this->findRelationalTable($parent, $child);
        if (is_array($res)) {
            return $res; //errors
        }

        $relation_table = $res;
        $dat_ass = [];

        // $relation_table->delete([$parent_key => $parent_id])->run();
        foreach ($child_ids as $c_id) {
            $dat_ass = [$parent_key => $parent_id, $child_key => $c_id];
            $res = $relation_table->insert($dat_ass)->run();
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

    private function findRelationalTable($parent, $child)
    {
        $table_names = [$parent . '_' . $child, $child . '_' . $parent];
        foreach ($table_names as $table_name) {
            try {
                $relation_table = Crudites::inspect($table_name);
                return $relation_table;
            } catch (CruditesException $e) {
                $errors[$table_name] =  $e->getMessage();
            }
        }

        return $errors;
    }
}
