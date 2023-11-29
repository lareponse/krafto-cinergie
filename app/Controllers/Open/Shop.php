<?php

namespace App\Controllers\Open;

use App\Models\Merchandise;

class Shop extends Kortex
{
    public function shop()
    {
        $dvds = Merchandise::filter(['segment' => 'dvd']);
        $books = Merchandise::filter(['segment' => 'book']);
        $this->viewport('dvds', $dvds);
        $this->viewport('books', $books);
    }
}
