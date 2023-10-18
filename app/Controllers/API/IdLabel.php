<?php

namespace App\Controllers\API;

// searchable class
use \App\Models\{Professional};

class IdLabel extends \HexMakina\kadro\Controllers\Kadro
{
    public function byTerm()
    {
        $term = $this->router()->params('term');
        
        $class = $this->router()->params('handle');
        $class = $this->get('App\\Models\\'.$class);

        $select = $class::queryListing();

        switch($this->router()->params('handle')){
            case 'Professional':
                $select->columns(['id', 'label' => ["CONCAT(professional.firstname, ' ', professional.lastname)"]]);

                $bindname = $select->addBinding('labelSearch', '%'.$term.'%');
                $orConditions = [];
                foreach(['firstname', 'lastname'] as $searchField){
                    $orConditions[]= "$searchField LIKE $bindname";
                }
                $select->whereWithBind(implode(' OR ', $orConditions));

            break;

            default: // Movie, Article, Organisation, Author
            $select->columns(['id', 'label']);
            
            $select->whereLike('label', "%$term%");
            break;
        }

        $res = $select->retObj();
        header('Content-Type: application/json');
        echo(json_encode(array_values($res)));
        die;        
    }
}