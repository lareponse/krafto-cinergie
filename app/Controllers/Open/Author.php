<?php

namespace App\Controllers\Open;

use App\Models\Author as Model;
use App\Models\{Professional, Article};

class Author extends Kortex
{
    public function authors()
    {
        $this->pageSlug = 'authors';

        $authors = Model::filter(['active' => '1', ['order_by' => [['author', 'label', 'ASC']]]]);
        $this->viewport('authors', $authors);
    }

    public function author()
    {
        $slug = $this->router()->params('slug');
        $author = Model::exists(['slug' => $slug]);
        
        if(is_null($author))
            $this->router()->hopBack();
        
        if($author->get('professional_slug')){
            $professional = Professional::exists(['slug' => $author->get('professional_slug')]);
            $this->viewport('professional', $professional);
        }
        $articles = Article::filter(['active' => '1', 'author' => $author], ['order_by' => ['article', 'publication', 'DESC']]);

        $this->viewport('author', $author);
        $this->viewport('articles', $articles);
    }
}

