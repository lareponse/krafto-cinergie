<?php

namespace App\Controllers\Secret;

use HexMakina\Crudites\Relation\DatabaseRelations;

class Relation extends Krafto
{
    private DatabaseRelations $relations;
    private $relation;
    private $source;

    public function modelClassName(): string
    {
        // Return the appropriate model class name
        return 'YourModelClassName';
    }
    public function prepare(): void
    {
        if (!$this->router()->submits()) {
            throw new \Exception('HTTP_POST_REQUIRED');
        }

        if (!$this->router()->submitted('source')) {
            throw new \Exception('MISSING_SOURCE_IDENTIFIER');
        }
        $this->source = $this->router()->submitted('source');


        if (!$this->router()->submitted('relation')) {
            throw new \Exception('MISSING_RELATION_IDENTIFIER');
        }
        $this->relations = $this->get('HexMakina\BlackBox\Database\DatabaseInterface')->relations();
        $this->relation = $this->relations->getRelation($this->router()->submitted('relation'));

        if (is_null($this->relation)) {
            throw new \InvalidArgumentException('INVALID_RELATION');
        }
    }

    public function link()
    {
        foreach ($this->router()->submitted() as $key => $value) {
            $$key = $value;
        }

        $errors = [];

        if (isset($child_id)) { // one to one
            $errors = $this->relation->link($this->source, $child_id);
        } elseif (isset($children_ids)) { // many to many
            $errors = $this->relation->link($this->source, $children_ids);
        } elseif (isset($qualifiers)) { // many to many qualified
            foreach ($qualifiers as $qualified_id => $qualifier_id) {
                $error = $this->relation->link($this->source, [[$qualified_id, $qualifier_id]]);
                if (!empty($error)) {
                    $errors[] = $error;
                }
            }
        }


        if (!empty($errors)) {
            // TODO message back to the user
        }

        $this->router()->hopBack();
    }

    public function unlink()
    {
        if (!$this->router()->submitted('source')) {
            throw new \Exception('MISSING_SOURCE_IDENTIFIER');
        }
        $this->source = $this->router()->submitted('source');

        if (!$this->router()->submitted('target')) {
            throw new \Exception('MISSING_TARGET_IDENTIFIER');
        }
        $target = $this->router()->submitted('target');


        $ids = [$target];

        if ($this->relation instanceof \HexMakina\Crudites\Relation\OneToManyQualified) {
            
            if (!$this->router()->submitted('qualifier')) {
                throw new \Exception('MISSING_QUALIFIER_IDENTIFIER');
            }
            array_push($ids, $this->router()->submitted('qualifier'));
        }
        $errors = $this->relation->unlink($this->source, $ids);
        
        if (!empty($errors)) {
            vd($errors);
            die(__FUNCTION__ . ' ce ne doit pas arriver, copier lerreur dans un mail a un admin');
            // TODO message back to the user
        }
    }

    public function conclude(): void
    {
        parent::conclude();

        if ($this->router()->submitted('return_to')) {
            $this->router()->hopURL($this->router()->submitted('return_to'));
        }

        $this->router()->hopBack();
    }
}
