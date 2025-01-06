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
        $this->viewport('articleCategories',Tag::any(['parent' => 'article_category']));
        $this->viewport('professionalPraxes', Tag::any(['parent' => 'professional_praxis']));
        $this->viewport('organisationPraxes', Tag::any(['parent' => 'organisation_praxis']));

        $this->viewport('movieGenres', Tag::any(['parent' => 'movie_genre']));
        $this->viewport('movieMetrages', Tag::any(['parent' => 'movie_footage']));
        $this->viewport('movieThemes', Tag::any(['parent' => 'movie_theme']));
        
        $movieReleaseYears = Movie::table()
            ->select(['released' => ['DISTINCT(`released`)']])
            ->whereEQ('public', 1)
            ->whereEQ('searchable', 1)
            ->whereNotEmpty('released')
            ->orderBy(['released', 'DESC']);
        $movieReleaseYears = $movieReleaseYears->ret(\PDO::FETCH_COLUMN);
        $this->viewport('movieReleaseYears',array_combine($movieReleaseYears, $movieReleaseYears));

        $this->viewport('messageNoResults', 'Aucun résultat ne correspond à votre recherche');
        parent::conclude();
    }

    private function articles():Paginator
    {
        $query = Article::filter();
        $query->selectAlso(['abstract']);
        
        $this->get('Controllers\Open\Article')->routerParamsAsFilters($query);
        $paginator = new Paginator($this->router()->params('page') ?? 1, $query);
        $paginator->perPage(12);
        $paginator->setClass(Article::class);

        return $paginator;
    }

    private function movies(): Paginator
    {
        $query = Movie::filter();
        $this->get('Controllers\Open\Movie')->routerParamsAsFilters($query);
        
        $paginator = new Paginator($this->router()->params('page') ?? 1, $query);
        $paginator->perPage(12);
        $paginator->setClass(Movie::class);

        return $paginator;
    }

    private function professionals(): Paginator
    {
        $query = Professional::filter();
        $this->get('Controllers\Open\Professional')->routerParamsAsFilters($query);

        $paginator = new Paginator($this->router()->params('page') ?? 1, $query);
        $paginator->perPage(12);
        $paginator->setClass(Professional::class);

        return $paginator;
    }

    private function organisations(): Paginator
    {
        $query = Organisation::filter();
        $this->get('Controllers\Open\Organisation')->routerParamsAsFilters($query);

        $paginator = new Paginator($this->router()->params('page') ?? 1, $query);
        $paginator->perPage(12);
        $paginator->setClass(Organisation::class);

        return $paginator;
    }

}
