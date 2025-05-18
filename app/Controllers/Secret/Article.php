<?php

namespace App\Controllers\Secret;

use HexMakina\kadro\Models\Tag;
use HexMakina\Crudites\Relation\OneToMany;

class Article extends Krafto 
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\HasImages;
    use \App\Controllers\Abilities\FiltersOnYear;

    public function conclude(): void
    {
        $this->viewport('types', Tag::any(['parent' => 'article_category']));
        // this is wrong, just a quick fix because FiltersOnYear is preventing from creating home(), so 1.30 AM, 85% bugs corrected, trading optimisation for sleep time
        $this->viewport('counters', $this->counters());

        parent::conclude();
    }



    public function alter()
    {
        if ($this->operator()->hasPermission('author')) {
            $isAuthor = explode(',', $this->loadModel()->get('writtenBySlugs') ?? '');
            $isAuthor = in_array($this->operator()->get("username"), $isAuthor);
            if(!$isAuthor)
            {
                $this->logger()->warning('Cette action est réservée aux auteurs du contenu');
                $this->router()->hopBack();
            }
        }
    }

    private function counters()
    {
        $counting = 'select count(id) FROM article';
        $counters = [
            'articles' => null,
            'inactives' => '`public` = 0',
            'withoutProfilePicture' => "(TRIM(avatar) = '' OR avatar IS NULL)",
            'withoutAbstract' => "(TRIM(abstract) = '' OR abstract IS NULL)",
            'withoutContent' => "(TRIM(content) = '' OR content IS NULL)"
        ];

        return array_map(function ($condition) use ($counting) {
            $query = $counting . ($condition ? ' where ' . $condition : '');
            $query = $this->modelClassName()::raw($query);

            return $query->fetchColumn();
        }, $counters);
    }

    public function after_save()
    {
        // dd($this->loadModel());
        // TODO relation to authors

        // TODO publication status
        
    }

    public function view()
    {
        if (is_null($this->loadModel())) {
            $this->router()->hop('dash_professionals');
        }

        $relations = $this->get('HexMakina\BlackBox\Database\DatabaseInterface')->relations();

        foreach($relations->relationsBySource('article') as $urn => $relation){
            if($relation instanceof OneToMany){
                $records = $relation->getTargets($this->loadModel()->id());
                $this->viewport($urn, $records);
            }
        }
    }

    public function imagesDirectory(){
        return 'article';
    }
}
