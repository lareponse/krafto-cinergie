<?php

namespace App\Controllers\Open;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\Crudites\Crudites;
use HexMakina\kadro\Models\Tag;
use HexMakina\LocalFS\FileSystem;

use App\Controllers\Abilities\Paginator;

use App\Models\Movie as Model;
use App\Models\{Professional, Organisation, DVD, Article};

class Movie extends Kortex
{
    protected $pageSlug = 'movies';

    public function movies()
    {
        $query = $this->routerParamsAsFilters(Model::queryListing());
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
        $professionals = Professional::byMovie($this->record());
        $organisations = Organisation::byMovie($this->record());
        $this->viewport('dvd', DVD::filter(['movie' => $this->record()]));
        $this->viewport('tags', $this->record()->tags()); // TODO: only themes
        $this->viewport('professionals', $professionals);
        $this->viewport('organisations', $organisations);

        $this->viewport('articles', $this->relatedArticles($professionals, $organisations));
        $this->viewport('photos', $this->relatedPhotos($professionals, $organisations));
    }


    // TODO improve related articles spread over different org and pro
    public function relatedArticles($professionals, $organisations): array
    {
        $ret = [];
        
        $articleIds = [];
        
        $res = Crudites::inspect('article_movie')->select(['article_id'])->whereEQ('movie_id', $this->record()->getID())->retCol();
        $articleIds = array_merge($articleIds, $res);

        if(!empty($professionals)){
            $ids = array_map(function($item) { return $item->getID(); }, $professionals);
            $res = Crudites::inspect('article_professional')->select(['DISTINCT(article_id)'])->whereNumericIn('professional_id', $ids)->limit(7)->retCol();
            $articleIds = array_merge($articleIds, $res);
        }

        if(!empty($organisations)) {
            $ids = array_map(function ($item) { return $item->getID(); }, $organisations);
            $res = Crudites::inspect('article_organisation')->select(['DISTINCT(article_id)'])->whereNumericIn('organisation_id', $ids)->limit(7)->retCol();

            $articleIds = array_merge($articleIds, $res);
        }

        $query = Article::queryListing();
        $res = $query->whereNumericIn('id', array_unique($articleIds))->retObj(Article::class);
        
        if($res)
            $ret = $res;

        return $ret;
    }

    public function relatedPhotos(): array
    {
        $slug = $this->record()->slug();
        $letter = $slug[0];
        $directory = sprintf('film/_%s/%s',  $letter, $slug);
        $path = sprintf('%s/%s', $this->get('settings.folders.images'), $directory);

        $urls = [];

        if(FileSystem::exists($path)){
            $fs = new FileSystem($path);
            foreach($fs->filenames() as $filename){
                if($filename === '.' || $filename == '..')
                    continue;
        
                // $names []= sprintf('%s/%s/%s', $this->get('settings.urls.images'), $directory, $filename);
                $urls []= sprintf('%s/%s/%s', 'https://www.cinergie.be/images', $directory, $filename);
            }

        }
        return $urls;
    }

   
    /**
     * Converts router parameters into filters for a database query.
     *
     * @param SelectInterface $query The database query object to apply filters to.
     * @return SelectInterface The modified database query object with filters applied.
     */
    private function routerParamsAsFilters($query): SelectInterface
    {
        $this->applyFreeSearch($query, ['`movie`.`label`', '`movie`.`content`', '`movie`.`comment`', '`movie`.`casting`']);

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

        // dd($query);
        return $query;

    }


}
