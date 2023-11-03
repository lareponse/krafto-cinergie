<?php

namespace App\Controllers\API;

use \App\Models\Thesaurus as Model;


class Thesaurus extends \HexMakina\kadro\Controllers\Kadro
{
    public function requiresOperator() : bool
    {
        return false;
    }

    public function filter()
    {
        $res = Model::filter(['content' => ['fields' => [$this->router()->params('field')], 'term' => $this->router()->params('term')]]);
        header('Content-Type: application/json');
        
        echo(json_encode(array_values($res)));
        die;
    }


    public function labelsForIds()
    {
        $ids = json_decode($this->router()->params('ids'));
        $res = Model::filter(['ids' => $ids]);
        $res = array_map(function($tag){return ['id' => $tag->id(), 'label' => $tag->__toString()];}, array_values($res));
        
        header('Content-Type: application/json');
        echo(json_encode($res));
        die;
    }

}
