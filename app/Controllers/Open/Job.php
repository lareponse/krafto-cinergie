<?php

namespace App\Controllers\Open;

use \HexMakina\BlackBox\Database\SelectInterface;
use \HexMakina\kadro\Models\Tag;

use App\Controllers\Abilities\Paginator;

use App\Models\Job as Model;

class Job extends Kortex
{
    private $categories = [];

    public function prepare(): void
    {
        parent::prepare();
        $this->categories = Tag::filter(['parent' => 'job_category']);
    }

    public function conclude(): void
    {
        $this->viewport('categories', $this->categories);

        $job_payment = [];
        foreach(Tag::filter(['parent' => 'job_payment']) as $tag)
            $job_payment[$tag->reference()] = $tag;
        $this->viewport('job_payment', $job_payment);

        $job_proposal = [];
        foreach(Tag::filter(['parent' => 'job_proposal']) as $tag)
            $job_proposal[$tag->reference()] = $tag;

        $this->viewport('job_proposal', $job_proposal);

        parent::conclude();
    }

    public function jobs()
    {
        $query = $this->routerParamsAsFilters(Model::queryListing());
        $paginator = new Paginator($this->router()->params('page') ?? 1, $query);
        $paginator->perPage(10);
        $paginator->setClass(Model::class);

        $latest = $this->get('Controllers\\Open\\Article')->latest();
        
        $this->viewport('latestArticles', $latest);
        $this->viewport('paginator', $paginator);
    }

    /**
     * Converts router parameters into filters for a database query.
     *
     * @param SelectInterface $query The database query object to apply filters to.
     * @return SelectInterface The modified database query object with filters applied.
     */
    public function routerParamsAsFilters($query): SelectInterface
    {
        // Check if 'remun' router parameter is set and use it to filter by 'isPaid'
        if ($this->router()->params('remun')) {
            $query->whereEQ('isPaid', (int)($this->router()->params('remun') === 'job-paid'));
        }

        // Check if 'types' router parameter is set and contains a single type, then filter by 'isOffer'
        if ($this->router()->params('types') && count($this->router()->params('types')) === 1) {
            $type = $this->router()->params('types');
            $type = array_pop($type);
            $query->whereEQ('isOffer', (int)($type === 'job-offer'));
        }

        // Check if 'categories' router parameter is set and filter by matching category IDs
        if ($this->router()->params('categories')) {
            $ids = [];
            foreach ($this->categories as $category) {
                if (in_array($category->get('reference'), $this->router()->params('categories'))) {
                    $ids[] =  $category->getID();
                }
            }
            $query->whereNumericIn('category_id', $ids);
        }

        return $query;
    }
}
