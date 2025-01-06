<?php

namespace App\Controllers\Open;

use \HexMakina\BlackBox\Database\SelectInterface;
use \HexMakina\kadro\Models\Tag;

use App\Controllers\Abilities\Paginator;
use App\Models\Organisation as Model;
use App\Models\{Movie, Praxis, Professional, Article};

class Organisation extends Kortex
{
    public function organisations()
    {
        $query = $this->routerParamsAsFilters(Model::filter([], ['withPraxis' => true]));
        $paginator = new Paginator($this->router()->params('page') ?? 1, $query);
        $paginator->perPage(23);
        $paginator->setClass(Model::class);

        $this->viewport('paginator', $paginator);
        $this->viewport('praxis', Praxis::forOrganisation());

        $this->viewport('form_filters', $this->router()->params());
    }

    public function organisation()
    {
        $movieIds = Movie::idsByOrganisationIds([$this->record()->id()]);

        if (!empty($movieIds)) {
            $query = Movie::filter();
            $query->whereNumericIn('id', $movieIds, $query->table());
            $related_movies = $query->retObj(Movie::class);
        }

        $this->viewport('praxes', Praxis::forOrganisation($this->record()));
        $this->viewport('related_movies', $related_movies ?? []);
        $this->viewport('related_photos', $this->relatedPhotos('organisation'));
        $this->viewport('related_articles', Article::retrieve(Article::filter(['organisation' => $this->record()])));
        $this->viewport('related_professionals', Professional::retrieve(Professional::filter(['organisation' => $this->record()])));

    }

     /**
     * Converts router parameters into filters for a database query.
     *
     * @param SelectInterface $query The database query object to apply filters to.
     * @return SelectInterface The modified database query object with filters applied.
     */
    public function routerParamsAsFilters($query): SelectInterface
    {
        if (!empty($this->router()->params('s'))) {
            $this->freeSearchFor(
                $this->router()->params('s'),
                ['label', 'content', 'filmography'],
                $query
            );
        }

        if ($this->router()->params('nom')) {
            $isLike = '%' . $this->router()->params('nom') . '%';
            $bindname = $query->addBinding('fullNameSearch', $isLike);
            $query->whereWithBind('`organisation`.`label` LIKE ' . $bindname);
        }


        if ($this->router()->params('activites')) {
            // vd($this->router()->params('activites'));
            $ids = Praxis::organisationByPraxisId($this->router()->params('activites'));
            // $ids = Model::idsByPraxis($this->router()->params('activites'));
            // dd($ids);
            $query->whereNumericIn('id', $ids, $query->table());
        }

        return $query;
    }
}
