<?php

namespace App\Controllers\Secret;

use HexMakina\kadro\Models\Tag;
use HexMakina\Crudites\Relation\OneToMany;

class Article extends Krafto 
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\HasSlug;
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
            dd('CHECK PERMISSIONS FOR AUTHOR OWN ARTICLE');
            dd($this->loadModel(), $this->operator()->id());
        }
    }

    public function after_save()
    {
        dd('AFTER SAVE RELATION TO AUTHOR');
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
