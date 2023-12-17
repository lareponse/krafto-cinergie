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
        $parent_slug = $this->router()->params('context_value');
        $term = $this->router()->params('term');
        $res = Tag::any([
            'parent' => $parent_slug, 
            'content' => ['fields' => ['label'], 'term' => $term]]
        );
        header('Content-Type: application/json');
        echo(json_encode(array_values($res)));

        die;
    }

    public function labelsForIds()
    {
        $ids = json_decode($this->router()->params('ids'));
        $res = Tag::any(['ids' => $ids]);
        $res = array_map(function($tag){return ['id' => $tag->id(), 'label' => $tag->__toString()];}, array_values($res));
        
        header('Content-Type: application/json');
        echo(json_encode($res));
        die;
    }


}
