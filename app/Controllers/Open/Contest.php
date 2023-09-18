<?php

namespace App\Controllers\Open;

use \HexMakina\BlackBox\Database\SelectInterface;
use App\Models\Contest as Model;

class Contest extends Kortex
{

    public function contests()
    {
        $this->pageSlug = 'contests';

        $contests = Model::filter(['active' => '1', ['order_by' => [['contest', 'starts', 'ASC']]]]);
        $this->viewport('contests', $contests);
    }


    /**
     * Converts router parameters into filters for a database query.
     *
     * @param SelectInterface $query The database query object to apply filters to.
     * @return SelectInterface The modified database query object with filters applied.
     */
    private function routerParamsAsFilters($query): SelectInterface
    {

        return $query;
    }
}
