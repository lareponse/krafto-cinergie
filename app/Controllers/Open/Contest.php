<?php

namespace App\Controllers\Open;

use \HexMakina\BlackBox\Database\SelectInterface;
use App\Models\Contest as Model;

class Contest extends Kortex
{

    public function contests()
    {
        $this->pageSlug = 'contests';

        $contests = Model::filter(['public' => '1', ['order_by' => [['contest', 'starts', 'ASC']]]]);
        $this->viewport('contests', $contests);
    }

}
