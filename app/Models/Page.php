<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Page extends TightModel
{
    use Abilities\HasSlug;
    use Abilities\IsActivable;

    public function __toString()
    {
        return $this->label();
    }

    public function label(): string
    {
        return $this->get('label') ?? '';
    }

    public function abstract(): string
    {
        return $this->get('abstract') ?? '';

    }

    public function content(): string
    {
        return $this->get('labecontentl') ?? '';

    }

}