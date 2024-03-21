<?php

namespace App\Controllers\Open;

use \HexMakina\BlackBox\Database\SelectInterface;
use \HexMakina\kadro\Models\Tag;

use App\Controllers\Abilities\Paginator;
use App\Models\Organisation as Model;
use App\Models\{Movie, Praxis, Submission};

class Organisation extends Kortex
{
    public function organisations()
    {
        $query = $this->routerParamsAsFilters(Model::filter());
        $paginator = new Paginator($this->router()->params('page') ?? 1, $query);
        $paginator->perPage(12);
        $paginator->setClass(Model::class);

        $this->viewport('paginator', $paginator);
        $this->viewport('praxis', Tag::any(['parent' => 'organisation_praxis']));

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

        $this->viewport('praxes', Praxis::forProfessional($this->record()));
        $this->viewport('related_movies', $related_movies ?? []);
        $this->viewport('related_photos', $this->relatedPhotos('organisation'));
    }

    public function alter()
    {

        // deny the request if the slug is not in the GET parameters
        if (!$this->router()->params('slug')) {
            $this->router()->hopBack();
        }

        $slug = $this->router()->params('slug');

        // deny the request if the slug is not in the referer
        if (mb_strpos($_SERVER['HTTP_REFERER'], $slug) === false) {
            $this->router()->hopBack();
        }

        // deny the request if the record is not found through the slug
        if (!$this->record()) {
            $this->router()->hopBack();
        }

        vd($this->record());

        // now we have a verified slug and a record, we can proceed with the form
        $suggestion = new Submission();
        $suggestion->set('urn', $this->record()->urn());
        $suggestion->set('submitted', json_encode($this->router()->submitted()));
        $suggestion->save(0);
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
            $ids = Model::idsByPraxis($this->router()->params('activites'));
            $query->whereNumericIn('id', $ids, $query->table());
        }

        return $query;
    }
}
