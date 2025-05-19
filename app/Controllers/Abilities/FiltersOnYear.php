<?php
namespace App\Controllers\Abilities;

trait FiltersOnYear
{
    abstract public function nid();
    abstract public function router();
    abstract public function urlFor(string $class, string $action, $model=null, $extras = []);

    abstract public function modelClassName();
    abstract public function viewport();

    public function home()
    {
        if (!$this->router()->params('year') && !$this->router()->params('segment')) {
            $this->router()->hop($this->urlFor($this->nid(), 'list', null, ['year' => date('Y')]));
        }
        
        $filters = $this->router()->params();
        // Return an array of records based on filters
        $listing = $this->modelClassName()::any($filters);

        $this->viewport('listing', $listing);
        $this->viewport('filters', $filters);
    }
}
