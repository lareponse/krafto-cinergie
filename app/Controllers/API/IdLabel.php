<?php

namespace App\Controllers\API;

// searchable class
use \App\Models\{Professional};

class IdLabel extends \HexMakina\kadro\Controllers\Kadro
{
    public function requiresOperator(): bool
    {
        return false;
    }
    
    public function byIds()
    {
        $ids = json_decode($this->router()->params('ids'));
        // filter out empty ids
        $ids = array_filter($ids, function($id){
            return is_numeric($id);
        });

        if(empty($ids)){
            header('Content-Type: application/json');
            echo(json_encode([]));
            die;
        }
        $class = $this->router()->params('handle');
        $class = $this->get('App\\Models\\'.$class); 


        $select = $class::filter();
        switch($this->router()->params('handle')){
            case 'Professional':
                $select->columns(['id', 'label' => ["CONCAT(professional.firstname, ' ', professional.lastname)"]]);
            break;

            default: // Movie, Article, Organisation, Author
                $select->columns(['id', 'label']);
                break;
            }
        
        $select->whereNumericIn('id', $ids);
        $res = $select->retObj();
        header('Content-Type: application/json');
        echo(json_encode(array_values($res)));
        die;   
    }

    public function byTerm()
    {
        $term = $this->router()->params('term');
        $class = $this->router()->params('handle');
        $class = $this->get('App\\Models\\'.$class);

        $select = $class::filter();
        switch($this->router()->params('handle')){
            case 'Professional':
                $select->columns(['id', 'label']);

                $bindname = $select->addBinding('labelSearch', '%'.$term.'%');
                $orConditions = [];
                foreach(['firstname', 'lastname', 'label'] as $searchField){
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