<?php

namespace App\Controllers\Secret;

use App\Models\{DVD, Book};

class Merchandise extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\HasImages;

    public function imagesDirectory(): string
    {
        return 'film';
    }

    public function activeSection(): string
    {
      return 'Shop';
    }

    public function books()
    {
        $this->viewport('listing', Book::any());
        $this->setTemplate('Secret::Merchandise/home');
        parent::home();
    }

    public function dvds()
    {
        $this->viewport('listing', DVD::any());
        $this->setTemplate('Secret::Merchandise/home');
        parent::home();

    }
}
