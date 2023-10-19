<?php
namespace App\Controllers\Abilities;


trait FiltersOnYearAndMonth
{
    abstract public function urn();
    abstract public function router();
    abstract public function urlFor(string $class, string $action, $model=null, $extras = []);

    abstract public function modelClassName();
    abstract public function viewport();

    public function home()
    {
        // requires at least a year
        if (!$this->router()->params('year')) {
            $this->router()->hop($this->urlFor($this->urn(), 'list', null, ['year' => date('Y'), 'month' => date('m')]));
        }
        
        $filters = $this->router()->params();
        $filters['month'] ??= 1;

        // Return an array of records based on filters
        $listing = $this->modelClassName()::filter($filters);

        $this->viewport('listing', $listing);
        $this->viewport('filters', $filters);
    }
}
