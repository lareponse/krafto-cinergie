<?php

namespace App\Controllers\Open;

use HexMakina\BlackBox\Database\SelectInterface;
use \HexMakina\kadro\Models\Tag;
use App\Controllers\Abilities\Paginator;

use App\Models\Movie as Model;
use App\Models\{Professional, Organisation, DVD};

class Movie extends Kortex
{
    public function movies()
    {
        $paginator = new Paginator($this->router()->params('page') ?? 1, $this->queryListing());
        $paginator->perPage(12);
        $paginator->setClass(Model::class);

        $this->viewport('genres', Tag::filter(['parent' => 'movie_genre']));
        $this->viewport('metrages', Tag::filter(['parent' => 'movie_footage']));
        $this->viewport('themes', Tag::filter(['parent' => 'movie_theme']));
        $this->viewport('paginator', $paginator);

        $this->viewport('form_filters', $this->router()->params());
    }

    public function movie()
    {
        $movie = Model::exists('slug', $this->router()->params('slug'));
        $dvd = DVD::filter(['movie' => $movie]);

        $this->viewport('movie', $movie);
        $this->viewport('dvd', $dvd);
    }

    public function queryListing(): SelectInterface
    {
        $select = Model::table()->select();
        $select->columns([
            'movie.slug', 
            'movie.label', 
            'movie.released', 
            'movie.profilePicture', 
            'movie_genre.label as genre', 
            "GROUP_CONCAT(professional.firstname, ' ', professional.lastname SEPARATOR ', ') as directors"
        ]);

        $select->join(['tag','movie_genre'], [['movie', 'genre_id', 'movie_genre','id']], 'LEFT OUTER');
        $select->join(['movie_professional', 'movie_professional'], [
            ['movie_professional', 'movie_id', 'movie','id'],
            ['movie_professional', 'praxis_id', 151]
        ], 'LEFT OUTER');
        $select->join(['professional'], [['movie_professional', 'professional_id', 'professional','id']], 'LEFT OUTER');
        
        $select->whereEQ('active', 1);

        $select->groupBy(['movie', 'slug']);
        $select->groupBy(['movie', 'label']);
        $select->groupBy(['movie','released']);
        $select->groupBy(['movie','profilePicture']);
        $select->groupBy(['movie_genre','label']);

        
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
            $idFilters['director'] = Model::idsByProfessionalName($this->router()->params('director'), 151);
        }

        if ($this->router()->params('organisation')) {
            $idFilters['organisation'] = Model::idsByOrganisationName($this->router()->params('organisation'));
        }
        
        if ($this->router()->params('professional')) {
            $idFilters['professional'] = Model::idsByProfessionalName($this->router()->params('professional'));
        }

        if ($this->router()->params('theme')) {
            $idFilters['professional'] = Model::idsByThemeId($this->router()->params('theme'));
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
