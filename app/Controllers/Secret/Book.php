<?php

namespace App\Controllers\Secret;

class Book extends Uber\ShopProduct
{
    use \App\Controllers\Abilities\HasORM;

    public function view()
    {
        if(is_null($this->loadModel())){
            $this->router()->hop('dash_movies');
        }

        $this->viewport('articles', $this->loadModel()->articles());
        $this->viewport('organisations', $this->loadModel()->organisations());
        $this->viewport('professionals', $this->loadModel()->professionals());
    }

    public function edit():void
    {
        if(is_null($this->loadModel()))
            $this->router()->hop('dash_movies');

    }
}
