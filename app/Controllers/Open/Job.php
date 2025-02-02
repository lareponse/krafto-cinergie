<?php

namespace App\Controllers\Open;

use \HexMakina\BlackBox\Database\SelectInterface;
use \HexMakina\kadro\Models\Tag;

use App\Controllers\Abilities\Paginator;

use App\Models\Job as Model;

class Job extends Kortex
{
    private $categories = [];
    public const TAG_PARENTS = ['job_payment', 'job_proposal', 'job_category'];

    public function prepare(): void
    {
        parent::prepare();
    }

    public function categories(): array
    {   
        if(empty($this->categories))
            $this->categories = Tag::any(['parent' => 'job_category']);
        
        return $this->categories;
    }

    public function conclude(): void
    {
        $this->viewport('categories', $this->categories());
        $this->viewportTagLists(['job_payment', 'job_proposal']);
        parent::conclude();
    }

    public function jobs()
    {
        $query = $this->routerParamsAsFilters(Model::filter());
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
        if (empty($this->operator()->permissions())) {
            $query->whereEQ('public', 1);
        }
        // Check if 'remun' router parameter is set and use it to filter by 'isPaid'
        if ($this->router()->params('isPaid')) {
            if(is_array($this->router()->params('isPaid')))
                $query->whereNumericIn('isPaid', $this->router()->params('isPaid'));
            else
                $query->whereEQ('isPaid', (int)($this->router()->params('isPaid')));
        }

        // Check if 'types' router parameter is set and contains a single type, then filter by 'isOffer'
        if ($this->router()->params('isOffer')) {
            if(is_array($this->router()->params('isOffer')))
                $query->whereNumericIn('isOffer', $this->router()->params('isOffer'));
            else
                $query->whereEQ('isOffer', (int)($this->router()->params('isOffer')));
        }

        // Check if 'categories' router parameter is set and filter by matching category IDs
        if ($this->router()->params('categories')) {
            $ids = [];
            foreach ($this->categories() as $category) {
                if (in_array($category->get('slug'), $this->router()->params('categories')) || in_array($category->id(), $this->router()->params('categories'))) {
                    $ids[] =  $category->id();
                }
            }
            $query->whereNumericIn('category_id', $ids);
        }

        return $query;
    }

    public function viewportTagLists($parents = null): array
    {
        $parents = is_null($parents) ? self::TAG_PARENTS : $parents;
        foreach($parents as $slug){

            if($slug == 'job_category')
                $tags = $this->categories();
            else
                $tags = Tag::any(['parent' => $slug]);

            if(empty($tags)){
                $this->logger()->debug('TAGS_NOT_FOUND', ['parent' => $slug]);
                continue;
            }

            $tags_by_slug = [];
            foreach($tags as $tag)
                $tags_by_slug[$tag->slug()] = "$tag";
            
            $this->viewport($slug, $tags_by_slug);
        }

        return $this->viewport();
    }
}
