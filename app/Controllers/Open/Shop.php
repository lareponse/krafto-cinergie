<?php

namespace App\Controllers\Open;

use App\Models\{DVD, Book, Movie};

class Shop extends Kortex
{
    public function shop()
    {
        // $dvds = DVD::any(['public' => 1]);
        $dvds = DVD::query_retrieve(['public' => 1]);
        $dvds->join(['movie_merchandise', 'hasMerch'], [[$dvds->tableLabel(), 'id', 'hasMerch', 'merchandise_id']]);
        $dvds->join(['movie', 'movie'], [['movie', 'id', 'hasMerch', 'movie_id']]);
        $dvds->selectAlso([
            'movie_label' => ['movie', 'label'], 
            'movie_slug' => ['movie' ,'slug'], 
            'movie_genre_id' => ['movie' ,'genre_id'], 
            'movie_avatar' => ['movie', 'avatar']
        ]);
        $dvds = $dvds->retObj(DVD::class);
        $this->viewport('dvds',$dvds);
        $this->viewport('books', Book::any(['public' => 1]));
    }
}
