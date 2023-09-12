<?php

namespace App\Controllers\Open;

use App\Models\Article as Model;
use App\Controllers\Abilities\Paginator;

class Article extends Kortex
{

    public function articles()
    {
        $filters = ['active' => 1];
        $options = ['order_by' => [['article', 'publication', 'DESC']]];

        $paginator = new Paginator($this->router()->params('page'), $filters, $options);
        $paginator->perPage(12);
        $paginator->setClass(Model::class);

        $this->viewport('paginator', $paginator);
    }

    public function article()
    {

    }

    public function latest()
    {
        return Model::filter(['active' => '1'], ['limit' => 5, 'order_by' => ['article', 'publication', 'desc']]);
    }
}

