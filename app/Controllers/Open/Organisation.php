<?php

namespace App\Controllers\Open;

use \HexMakina\BlackBox\Database\SelectInterface;
use \HexMakina\kadro\Models\Tag;

use App\Controllers\Abilities\Paginator;
use App\Models\Organisation as Model;
use App\Models\{Movie, Praxis};


class Organisation extends Kortex
{
    
    public function organisations()
    {
        $query = $this->routerParamsAsFilters(Model::queryListing());
        $paginator = new Paginator($this->router()->params('page') ?? 1, $query);
        $paginator->perPage(12);
        $paginator->setClass(Model::class);

        $this->viewport('paginator', $paginator);
        $this->viewport('praxis', Tag::filter(['parent' => 'organisation_praxis']));

        $this->viewport('form_filters', $this->router()->params());
    }

    public function organisation()
    {

        $movieIds = Movie::idsByOrganisationIds([$this->record()->getID()]);
        if(!empty($movieIds)){
            $query = Movie::queryListing();
            $query->whereNumericIn('id', $movieIds, $query->table());
            $related_movies = $query->retObj(Movie::class);
        }

        $this->viewport('praxes', Praxis::forProfessional($this->record()));
        $this->viewport('related_movies', $related_movies ?? []);
        $this->viewport('related_photos', $this->relatedPhotos('organisation'));

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
