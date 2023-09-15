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
     * Constructs a database query for listing contests with specific columns and filters.
     *
     * @return SelectInterface The constructed database query object.
     */
    public function queryListing(): SelectInterface
    {
        $select = Model::table()->select([
            'contest.`slug`',
            'contest.`label`',
            'contest.`starts`',
            'contest.`stops`'
        ], 'contest');

        $now = date('Y-m-d');
        $startsAfter = $select->addBinding('startsAfter', $now);
        $stopsBefore = $select->addBinding('stopsBefore', $now);
        $select->whereWithBind(sprintf('starts >= %s AND stops IS NOT NULL AND (stops >= %s)', $startsAfter, $stopsBefore));


        $select->whereEQ('active', 1);


        $select->orderBy(['starts', 'ASC']);

        return $this->routerParamsAsFilters($select);
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
