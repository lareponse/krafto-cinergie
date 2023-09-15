<?php

namespace App\Controllers\Open;

use \HexMakina\kadro\Models\Tag;
use App\Controllers\Abilities\Paginator;

use App\Models\{Article, Professional, Movie, Organisation};

class Search extends Kortex
{
    public function search()
    {
        $this->viewport('articles', $this->articles());
        $this->viewport('movies', $this->movies());
        $this->viewport('professionals', $this->professionals());
        $this->viewport('organisations', $this->organisations());
    }

    public function conclude(): void
    {
        $this->viewport('articleCategories',Tag::filter(['parent' => 'article_category']));
        $this->viewport('professionalPraxes', Tag::filter(['parent' => 'professional_praxis']));
        $this->viewport('organisationPraxes', Tag::filter(['parent' => 'organisation_praxis']));

        $this->viewport('movieGenres', Tag::filter(['parent' => 'movie_genre']));
        $this->viewport('movieMetrages', Tag::filter(['parent' => 'movie_footage']));
        $this->viewport('movieThemes', Tag::filter(['parent' => 'movie_theme']));
        
        $movieReleaseYears = Movie::raw(
            'SELECT DISTINCT(`released`) FROM `movie` WHERE `active` = 1 AND `released` IS NOT NULL ORDER BY `released` DESC'
        )->fetchAll(\PDO::FETCH_COLUMN);

        $this->viewport('movieReleaseYears',array_combine($movieReleaseYears, $movieReleaseYears));

        $this->viewport('messageNoResults', 'Aucun résultat ne correspond à votre recherche');
        parent::conclude();
    }

    private function articles():Paginator
    {
        $controller = $this->get('Controllers\\Open\\Article');
        $query = $controller->queryListing();
        $query->selectAlso('article.abstract');

        $paginator = new Paginator($this->router()->params('page') ?? 1, $query);
        $paginator->perPage(12);
        $paginator->setClass(Article::class);

        return $paginator;
    }

    private function movies(): Paginator
    {
        $controller = $this->get('Controllers\\Open\\Movie');

        $paginator = new Paginator($this->router()->params('page') ?? 1, $controller->queryListing());
        $paginator->perPage(12);
        $paginator->setClass(Movie::class);

        return $paginator;
    }

    private function professionals(): Paginator
    {
        $controller = $this->get('Controllers\\Open\\Professional');

        $paginator = new Paginator($this->router()->params('page') ?? 1, $controller->queryListing());
        $paginator->perPage(12);
        $paginator->setClass(Professional::class);

        return $paginator;
    }

    private function organisations(): Paginator
    {
        $controller = $this->get('Controllers\\Open\\Organisation');

        $paginator = new Paginator($this->router()->params('page') ?? 1, $controller->queryListing());
        $paginator->perPage(12);
        $paginator->setClass(Organisation::class);

        return $paginator;
    }

}
