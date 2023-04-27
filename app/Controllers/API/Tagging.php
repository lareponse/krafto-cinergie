<?php

namespace App\Controllers\API;

use \HexMakina\kadro\Models\Tag;


class Tagging extends \HexMakina\kadro\Controllers\Kadro
{
    public function requiresOperator() : bool
    {
        return false;
    }

    public function parentReference()
    {

        if($this->router()->params('context') === 'parent'){
            $parent_reference = $this->router()->params('context_value');
            $term = $this->router()->params('term');
            $res = Tag::filter([
                'parent' => $parent_reference, 
                'content' => ['fields' => ['label'], 'term' => $term]]
            );
            header('Content-Type: application/json');
            echo(json_encode(array_values($res)));
        }

        die;
    }

    public function labelsForIds()
    {
        $ids = json_decode($this->router()->params('ids'));
        $res = Tag::filter(['ids' => $ids]);
        $res = array_map(function($tag){return ['id' => $tag->getID(), 'label' => $tag->__toString()];}, array_values($res));
        
        header('Content-Type: application/json');
        echo(json_encode($res));
        die;
    }


}
