<?php

namespace App\Controllers\Secret;

use App\Models\{Author, Professional, Organisation, Movie};
use HexMakina\kadro\Models\Tag;
use \HexMakina\Crudites\Relation\ManyToMany;

class Article extends Krafto 
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\HasSlug;
    use \App\Controllers\Abilities\HasImages;
    use \App\Controllers\Abilities\FiltersOnYearAndMonth;

    public function conclude(): void
    {
        $this->viewport('types', Tag::filter(['parent' => 'article_category']));
        parent::conclude();
    }

    public function view()
    {
        $relations = $this->get('HexMakina\BlackBox\Database\DatabaseInterface')->relations();

        // $article_relations = [];

        foreach($relations->relationsBySource('article') as $urn => $relation){
            if($relation instanceof ManyToMany){
                $records = $relation->getTargets($this->loadModel()->getID());
                $this->viewport($urn, $records);
            }
        }   
    }

    public function imagesDirectory(){
        return 'article';
    }
}
