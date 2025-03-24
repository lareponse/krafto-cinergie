<?php

namespace App\Controllers\Secret;

use HexMakina\kadro\Models\Tag;
use HexMakina\Crudites\Relation\OneToMany;

class Article extends Krafto 
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\HasImages;
    use \App\Controllers\Abilities\FiltersOnYearAndMonth;

    public function conclude(): void
    {
        $this->viewport('types', Tag::any(['parent' => 'article_category']));
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
