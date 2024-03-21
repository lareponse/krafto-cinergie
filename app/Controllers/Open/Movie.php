<?php

namespace App\Controllers\Open;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\kadro\Models\Tag;

use App\Controllers\Abilities\Paginator;
use App\Models\Movie as Model;
use App\Models\{Professional, Organisation, DVD, Praxis, Thesaurus};

class Movie extends Kortex
{
    protected $pageSlug = 'movies';

    public function movies()
    {
        $query = $this->routerParamsAsFilters(Model::filter([], ['withDirectors' => true]));
        $paginator = new Paginator($this->router()->params('page') ?? 1, $query);
        $paginator->perPage(12);
        $paginator->setClass(Model::class);

        $this->viewport('genres', Tag::any(['parent' => 'movie_genre']));
        $this->viewport('metrages', Tag::any(['parent' => 'movie_footage']));
        $this->viewport('themes', Tag::any(['parent' => 'movie_theme']));
        $this->viewport('order_by', ['released' => 'Date de sortie', 'label' => 'Titre']);
        $this->viewport('paginator', $paginator);

        $this->viewport('form_filters', $this->router()->params());
    }

    public function movie()
    {
        
        $professionals = Professional::filter([], ['withMoviePraxis' => $this->record()])->retObj(Professional::class);
        
        $director_tag = Praxis::director();
        $directors = [];
        foreach($professionals as $professional){
            if (in_array($director_tag->id(), $professional->praxisIds())) {
                $directors[$professional->id()]= $professional;
            }
        }
        $this->viewport('professionals', $professionals);
        $this->viewport('directors', $directors);

        $query = Tag::filter();
        $query->join(['movie_theme', 'hasThemes'], [['hasThemes', 'tag_id', 'tag', 'id']]);
        $query->whereEQ('movie_id', $this->record()->id(), 'hasThemes');

        $themes = $query->retObj(Tag::class) ?? [];
        $this->viewport('themes', $themes);


        $query = Thesaurus::filter();
        $query->join(['movie_thesaurus', 'hasThesaurus'], [['hasThesaurus', 'thesaurus_id', 'thesaurus', 'id']]);
        $query->whereEQ('movie_id', $this->record()->id(), 'hasThesaurus');
        $thesaurus = $query->retObj(Thesaurus::class) ?? [];
        $this->viewport('thesaurus', $thesaurus);

        $organisations = Organisation::filter([], ['withMoviePraxis' => $this->record()])->retObj(Organisation::class);
        $this->viewport('organisations', $organisations);

        $this->viewport('merchandises', DVD::any(['Movie' => $this->record()]));

        $this->viewport('articles', $this->record()->relatedArticles($professionals, $organisations));
        $this->viewport('related_photos', $this->relatedPhotos('film'));
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
                ['label', 'content', 'comment', 'casting'],
                $query
            );
        }
        
        $idFilters = [];
        if ($this->router()->params('label')) {
            $isLike = '%'.$this->router()->params('label').'%';
            $query->whereLike('label', $isLike);
        }
        
        if ($this->router()->params('released')) {
            $query->whereEQ('released', $this->router()->params('released'));
        }

        if ($this->router()->params('metrage')) {
            $query->whereEQ('metrage_id', $this->router()->params('metrage'));
        }

        if ($this->router()->params('type')) {
            $query->whereEQ('genre_id', $this->router()->params('type'));
        }

        if ($this->router()->params('director')) {
            $director_tag = Praxis::director();
            $idFilters['director'] = Model::idsByProfessionalName($this->router()->params('director'), $director_tag->id());
        }

        if ($this->router()->params('organisation')) {
            $idFilters['organisation'] = Model::idsByOrganisationName($this->router()->params('organisation'));
        }
        
        if ($this->router()->params('professional')) {
            $idFilters['professional'] = Model::idsByProfessionalName($this->router()->params('professional'));
        }

        if ($this->router()->params('theme')) {
            $idFilters['theme'] = Model::idsByThemeId($this->router()->params('theme'));
        }

        if(!empty($idFilters)){
            $idPool = array_shift($idFilters);
            while(!empty($idFilters)){
                $idPool = array_intersect($idPool, array_shift($idFilters));
            }
           
            if (!empty($idPool)){
                $query->whereNumericIn('id', $idPool, $query->table());
            }
            else{ // intersection is empty, return no records
                $query->where('1=0');
            }
        }
        $order_by = $this->router()->params('order_by') ?? 'released';
        $direction = ($order_by == 'released') ? 'DESC' : 'ASC';
        $query->orderBy([$order_by, $direction]);


        return $query;
    }


}
