<?php
namespace App\Controllers\Abilities;


trait FiltersOnYearAndMonth
{
    public function home()
    {
        // requires at least a year
        if (!$this->router()->params('year')) {
            $this->router()->hop($this->urlFor($this->className(), 'list', null, ['year' => date('Y'), 'month' => date('m')]));
        }
        
        $filters = $this->router()->params();
        $filters['month'] ??= 1;

        // Return an array of records based on filters
        $listing = $this->modelClassName()::filter($filters);

        $this->viewport('listing', $listing);
        $this->viewport('filters', $filters);
    }
}
