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
        if (is_null($this->loadModel())) {
            $this->router()->hop('dash_professionals');
        }

        $relations = $this->get('HexMakina\BlackBox\Database\DatabaseInterface')->relations();

        foreach($relations->relationsBySource('article') as $urn => $relation){
            if($relation instanceof ManyToMany){
                $records = $relation->getTargets($this->loadModel()->id());
                $this->viewport($urn, $records);
            }
        }
    }

    public function imagesDirectory(){
        return 'article';
    }
}
