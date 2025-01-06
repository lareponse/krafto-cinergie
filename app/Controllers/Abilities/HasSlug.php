<?php
namespace App\Controllers\Abilities;

trait HasSlug
{

    public function HasSlugTraitor_before_save()
    {
        $this->formModel()->set('slug', $this->formModel()->slug());
    }
}