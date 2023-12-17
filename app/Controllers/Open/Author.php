<?php

namespace App\Controllers\Open;

use App\Models\Author as Model;
use App\Models\{Professional, Article};

class Author extends Kortex
{
    public function authors()
    {
        $this->pageSlug = 'authors';

        $authors = Model::any(['public' => '1', ['order_by' => [['author', 'label', 'ASC']]]]);
        $this->viewport('authors', $authors);
    }

    public function author()
    {
        if(is_null($this->record()))
            $this->router()->hopBack();
        
        
        if($this->record()->get('professional_slug')){
            $professional = Professional::exists(['slug' => $this->record()->get('professional_slug')], ['withPraxis' => true]);
            $this->viewport('professional', $professional);
        }
        $articles = Article::any(['public' => '1', 'author' => $this->record()], ['order_by' => ['article', 'publication', 'DESC']]);

        $this->viewport('articles', $articles);
    }
}

