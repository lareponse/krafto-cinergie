<?php

namespace App\Controllers\Open;

use \HexMakina\BlackBox\Database\SelectInterface;
use \HexMakina\kadro\Models\Tag;

use App\Controllers\Abilities\Paginator;
use App\Models\Organisation as Model;


class Organisation extends Kortex
{
    
    public function organisations()
    {
        $paginator = new Paginator($this->router()->params('page') ?? 1, $this->queryListing());
        $paginator->perPage(12);
        $paginator->setClass(Model::class);

        $this->viewport('paginator', $paginator);
        $this->viewport('praxis', Tag::filter(['parent' => 'organisation_praxis']));

        $this->viewport('form_filters', $this->router()->params());
    }

    public function queryListing(): SelectInterface
    {
        $select = Model::table()->select();
        $select->columns([
            '`organisation`.`slug`',
            "`organisation`.`label`",
            '`organisation`.`profilePicture`',
            "GROUP_CONCAT(praxis.label SEPARATOR ', ') as praxes"
        ]);

        $select->join(['organisation_tag', 'organisation_tag'], [['organisation_tag', 'organisation_id', 'organisation', 'id']], 'LEFT OUTER');
        $select->join(['tag', 'praxis'], [['organisation_tag', 'tag_id', 'praxis', 'id']], 'LEFT OUTER');

        $select->whereEQ('active', 1);
        $select->whereEQ('isListed', 1);

        $select->groupBy(['organisation', 'id']);

        $select->orderBy(['organisation', 'label', 'ASC']);
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
        $this->applyFreeSearch($query, ['`organisation`.`label`', '`organisation`.`content`', '`organisation`.`filmography`']);

        if ($this->router()->params('nom')) {
            $isLike = '%' . $this->router()->params('nom') . '%';
            $bindname = $query->addBinding('fullNameSearch', $isLike);
            $query->whereWithBind('`organisation`.`label` LIKE ' . $bindname);
        }

        
        if($this->router()->params('activites')){
            $ids = Model::idsByPraxis($this->router()->params('activites'));
            $query->whereNumericIn('id', $ids, $query->table());
            
            // $praxis_id = $this->router()->params('activites');
            // $filters['ids'] = Model::idsByPraxis($praxis_id);
        }
        return $query;
    }
}
