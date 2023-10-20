<?php

namespace App\Controllers\Secret;

use App\Models\{Author, Professional, Organisation, Movie};
use HexMakina\kadro\Models\Tag;


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
        $this->viewport('authors', Author::filter(['article' => $this->loadModel()], ['eager' => false]));
        $this->viewport('professionals', Professional::filter(['article' => $this->loadModel()], ['eager' => false]));
        $this->viewport('movies', Movie::filter(['model' => $this->loadModel()], ['eager' => false]));
        $this->viewport('organisations', Organisation::filter(['article' => $this->loadModel()], ['eager' => false]));
    }

    public function imagesDirectory(){
        return 'article';
    }
}
