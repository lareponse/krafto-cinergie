<?php

namespace App\Controllers\Open;

use HexMakina\BlackBox\Database\SelectInterface;
use App\Controllers\Abilities\Paginator;

use App\Models\Article as Model;

class Article extends Kortex
{
    protected $pageSlug = 'articles';

    public function articles()
    {
        $query = $this->routerParamsAsFilters(Model::filter(['public' => 1]));
        $paginator = new Paginator($this->router()->params('page') ?? 1, $query);
        $paginator->perPage(12);
        $paginator->setClass(Model::class);

        $this->viewport('paginator', $paginator);
    }

    public function article()
    {
        $article = Model::exists('slug', $this->router()->params('slug'));
        $this->viewport('article', $article);
        $this->viewport('related_articles', [$article]);
    }

    public function latest()
    {
        return Model::any(['public' => '1'], ['limit' => 5, 'order_by' => ['publication', 'DESC']]);
    }

    public function routerParamsAsFilters($query): SelectInterface
    {
        if(!empty($this->router()->params('s'))){

            $this->freeSearchFor(
                $this->router()->params('s'), 
                ['label', 'content', 'abstract'],
                $query
            );
        }

        if ($this->router()->params('ac')) {
            $query->whereNumericIn('type_id', $this->router()->params('ac'));
        }

        $query->orderBy(['publication', 'DESC']);

        return $query;
    }
}
