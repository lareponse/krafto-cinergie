<?php

namespace App\Controllers\Open;

use \HexMakina\BlackBox\Database\SelectInterface;
use \HexMakina\kadro\Models\Tag;
use App\Controllers\Abilities\Paginator;

use App\Models\Professional as Model;
use App\Models\{Movie,Praxis};

class Professional extends Kortex
{
    public const ALLOWED_GENDERS = [
        'h' => 'Hommes',
        'f' => 'Femmes',
        'nb' => 'Autres'
    ];

    public const AGE_RANGES = [
        '-20' => '&lt; 20 ans',
        '20-30' => '20 &rarr; 30 ans',
        '30-40' => '30 &rarr; 40 ans',
        '40-50' => '40 &rarr; 50 ans',
        '50-60' => '50 &rarr; 60 ans',
        '60-' => '&gt; 60 ans'
    ];

    public function professionals()
    {
        $query = $this->routerParamsAsFilters(Model::filter([], ['withPraxis' => true]));
        $paginator = new Paginator($this->router()->params('page') ?? 1, $query);
        $paginator->perPage(12);
        $paginator->setClass(Model::class);

        $this->viewport('paginator', $paginator);
        $this->viewport('praxis', Tag::any(['parent' => 'professional_praxis']));

        $this->viewport('form_filters', $this->router()->params());
    }

    public function professional()
    {
        $movieIds = Movie::idsByProfessionalIds([$this->record()->id()]);
        if(!empty($movieIds)){
            $query = Movie::filter([], ['withDirectors' => true]);
            $query->whereNumericIn('id', $movieIds, $query->table());
            $related_movies = $query->retObj(Movie::class);
        }

        $this->viewport('related_movies', $related_movies ?? []);
        $this->viewport('related_photos', $this->relatedPhotos('personne'));

        $this->viewport('praxes', Praxis::forProfessional($this->record()));
    }



    /**
     * Converts router parameters into filters for a database query.
     *
     * @param SelectInterface $query The database query object to apply filters to.
     * @return SelectInterface The modified database query object with filters applied.
     */
    public function routerParamsAsFilters($query): SelectInterface
    {
        if(!empty($this->router()->params('s'))){

            $this->freeSearchFor(
                $this->router()->params('s'), 
                ['firstname', 'lastname', 'content'],
                $query
            );
        }
        if ($this->router()->params('nom')) {
            $isLike = '%' . $this->router()->params('nom') . '%';
            $bindname = $query->addBinding('fullNameSearch', $isLike);
            $query->whereWithBind('CONCAT(`professional`.`firstname`, \' \',`professional`.`lastname`) LIKE ' . $bindname);
        }

        if ($this->hasAllowedGender()) {
            $query->whereEQ('gender', $this->router()->params('genre'));
        }

        if ($this->hasAllowedAgeRange()) {
            $currentYear = (int)date('Y');
            list($min, $max) = explode('-', $this->router()->params('tranche-age'));
            if (!empty($min)) {
                $birthYearMin = $query->addBinding('filters_birthYearMin', $currentYear - abs($min));
                $query->whereWithBind("YEAR(`birth`) <= $birthYearMin");
            }
    
            if (!empty($max)) {
                $birthYearMax = $query->addBinding('filters_birthYearMax', $currentYear - abs($max));
                $query->whereWithBind("YEAR(`birth`) >= $birthYearMax");
            }
        }

        if ($this->router()->params('metier')) {
            $ids = Model::idsByPraxis($this->router()->params('metier'));
            $query->whereNumericIn('id', $ids, $query->table());
        }

        return $query;
    }

    private function hasAllowedGender(): bool
    {
        return !empty($this->router()->params('genre')) && isset(self::ALLOWED_GENDERS[$this->router()->params('genre')]);
    }

    private function hasAllowedAgeRange(): bool
    {
        return !empty($this->router()->params('tranche-age')) && isset(self::AGE_RANGES[$this->router()->params('tranche-age')]);
    }

}
