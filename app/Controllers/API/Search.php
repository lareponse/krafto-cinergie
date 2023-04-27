<?php

namespace App\Controllers\API;

// searchable class
use \App\Models\{Movie, Article, Organisation, Professional};


class Search extends \HexMakina\kadro\Controllers\Kadro
{
    public function requiresOperator() : bool
    {
        return false;
    }

    public function byField(): string
    {
        ['className' => $className, 'term' => $searchTerm, 'fields' => $fields] = array_map('urldecode', $this->router()->params());
        
        $fields = json_decode($fields);

        $res = ('\\App\\Models\\'.$className)::filter(['content' => ['fields' => $fields, 'term' => $searchTerm]], ['select' => ['id', 'label']]);
        header('Content-Type: application/json');
        echo(json_encode(array_values($res)));
        die;
    }


}
