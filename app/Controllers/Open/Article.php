<?php

namespace App\Controllers\Open;

use HexMakina\BlackBox\Database\SelectInterface;
use \HexMakina\kadro\Models\Tag;
use App\Controllers\Abilities\Paginator;

use App\Models\Article as Model;

class Article extends Kortex
{
    protected $pageSlug = 'articles';


    public function articles()
    {
        $paginator = new Paginator($this->router()->params('page') ?? 1, $this->queryListing());
        $paginator->perPage(12);
        $paginator->setClass(Model::class);

        $this->viewport('paginator', $paginator);
    }

    public function article()
    {
        $article = Model::exists('slug', $this->router()->params('slug'));
        $this->viewport('article', $article);
    }

    public function latest()
    {
        return Model::filter(['active' => '1'], ['limit' => 5, 'order_by' => ['article', 'publication', 'desc']]);
    }

    public function queryListing(): SelectInterface
    {
        $select = Model::table()->select();
        $select->columns([
            'article.slug', 
            'article.label', 
            'article.publication', 
            'article.profilePicture',
            'tag.`label` as type_label'

        ]);

        $select->whereEQ('active', 1);

        $select->join(['tag', 'tag'], [['article', 'type_id', 'tag', 'id']], 'LEFT OUTER');
        $select->orderBy(['publication', 'DESC']);

        return $this->routerParamsAsFilters($select);
    }

    private function routerParamsAsFilters($query): SelectInterface
    {
        $this->applyFreeSearch($query, ['`article`.`label`', '`article`.`content`', '`article`.`abstract`']);

        if ($this->router()->params('ac')) {
            $query->whereNumericIn('type_id', $this->router()->params('ac'));
        }

        return $query;
    }
}
