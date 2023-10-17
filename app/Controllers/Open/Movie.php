<?php

namespace App\Controllers\Open;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\Crudites\Crudites;
use HexMakina\kadro\Models\Tag;
use HexMakina\LocalFS\FileSystem;

use App\Controllers\Abilities\Paginator;

use App\Models\Movie as Model;
use App\Models\{Professional, Organisation, DVD, Article, Merchandise};

class Movie extends Kortex
{
    protected $pageSlug = 'movies';

    public function movies()
    {
        $query = $this->routerParamsAsFilters(Model::queryListing([], ['withDirectors' => true]));
        $paginator = new Paginator($this->router()->params('page') ?? 1, $query);
        $paginator->perPage(12);
        $paginator->setClass(Model::class);

        $this->viewport('genres', Tag::filter(['parent' => 'movie_genre']));
        $this->viewport('metrages', Tag::filter(['parent' => 'movie_footage']));
        $this->viewport('themes', Tag::filter(['parent' => 'movie_theme']));
        $this->viewport('order_by', ['released' => 'Date de sortie', 'label' => 'Titre']);
        $this->viewport('paginator', $paginator);

        $this->viewport('form_filters', $this->router()->params());
    }

    public function movie()
    {
        $professionals = Professional::queryListing([], ['withMoviePraxis' => $this->record()])->retObj(Professional::class);
        $organisations = Organisation::queryListing([], ['withMoviePraxis' => $this->record()])->retObj(Organisation::class);
        $merchandise = Merchandise::filter(['movie' => $this->record()]);
        
        $this->viewport('tags', $this->record()->tags()); // TODO: only themes
        $this->viewport('professionals', $professionals);
        $this->viewport('organisations', $organisations);
        $this->viewport('merchandise', $merchandise);

        $this->viewport('articles', $this->relatedArticles($professionals, $organisations));
        $this->viewport('related_photos', $this->relatedPhotos('film'));
    }


    // TODO improve related articles spread over different org and pro
    public function relatedArticles($professionals, $organisations): array
    {
        $ret = [];
        
        $articleIds = [];

        $res = self::database()->inspect('article_movie')->select(['article_id'])->whereEQ('movie_id', $this->record()->getID())->retCol();
        $articleIds = array_merge($articleIds, $res);

        if(!empty($professionals)){
            $ids = array_map(function($item) { return $item->getID(); }, $professionals);
            $res = self::database()->inspect('article_professional')->select(['articleIds' => ['DISTINCT(article_id)']])->whereNumericIn('professional_id', $ids)->limit(7);
            $res = $res->retCol();
            $articleIds = array_merge($articleIds, $res);
        }

        if(!empty($organisations)) {
            $ids = array_map(function ($item) { return $item->getID(); }, $organisations);
            $res = self::database()->inspect('article_organisation')->select(['articleIds' => ['DISTINCT(article_id)']])->whereNumericIn('organisation_id', $ids)->limit(7)->retCol();

            $articleIds = array_merge($articleIds, $res);
        }

        $articleIds = array_unique($articleIds);
        if(empty($articleIds)){
            return [];
        }

        $query = Article::queryListing();
        $query = $query->whereNumericIn('id', $articleIds);
        $res = $query->retObj(Article::class);

        return $res ? $res : $ret;
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
                ['`movie`.`label`', '`movie`.`content`', '`movie`.`comment`', '`movie`.`casting`'],
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
            $idFilters['director'] = Model::idsByProfessionalName($this->router()->params('director'), Professional::DIRECTOR_TAG_ID);
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
