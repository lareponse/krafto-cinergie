<?php

namespace App\Controllers\Open;

use \HexMakina\kadro\Models\Tag;

use App\Models\Work as Model;
use App\Controllers\Abilities\Paginator;

class Work extends Kortex
{
    private $categories = [];

    public function prepare(): void
    {
        parent::prepare();

        $this->categories = Tag::filter(['parent' => 'work_category']);
    }
    
    public function conclude(): void
    {
        $this->viewport('categories', $this->categories);
        parent::conclude();
    }

    public function works()
    {
        $filters = array_merge($this->routerParamsAsFilters(), ['active' => '1', 'ongoing' => true]);

        $paginator = new Paginator($this->router()->params('page'), $filters);
        $paginator->perPage(10);
        $paginator->setClass(Model::class);

        $latest = $this->get('Controllers\\Open\\Article')->latest();
        $this->viewport('latestArticles', $latest);

        $this->viewport('paginator', $paginator);
    }

    public function work()
    {
        $slug = $this->router()->params('slug');
        $work = Model::exists('slug', $slug);
        $this->viewport('work', $work);
    }

    private function routerParamsAsFilters()
    {
        $filters = [];

        if($this->router()->params('remun')){
            $filters['isPaid'] = (int)($this->router()->params('remun') === 'oui');
        }

        if($this->router()->params('types') && count($this->router()->params('types')) === 1){
            $type = $this->router()->params('types');
            $type = array_pop($type);
            $filters['isOffer'] = (int)($type === 'proposition');
        }

        if($this->router()->params('categories')){
            foreach($this->categories as $category){
                if(in_array($category->get('reference'), $this->router()->params('categories'))){
                    $filters['type_ids'] []=  $category->getID();
                }
            }

        }
        
        return $filters;
    }
}
