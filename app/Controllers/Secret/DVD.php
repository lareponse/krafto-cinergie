<?php

namespace App\Controllers\Secret;

use App\Models\{Article, Movie};

class DVD extends Uber\ShopProduct
{
    use \App\Controllers\Abilities\HasORM;

    public function view()
    {
        if(is_null($this->loadModel())){
            $this->router()->hop('dash_movies');
        }

        $this->viewport('articles', Article::filter(['DVD' => $this->loadModel()], ['eager' => false]));
        $this->viewport('movies', Movie::filter(['DVD' => $this->loadModel()], ['eager' => false]));
    }

    public function edit():void
    {
        if(is_null($this->loadModel()))
            $this->router()->hop('dash_movies');

    }
}
