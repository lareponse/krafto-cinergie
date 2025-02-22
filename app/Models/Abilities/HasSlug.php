<?php

namespace App\Models\Abilities;

trait HasSlug
{
    public function slug(): string
    {
        if (empty($this->get('slug')))
            $this->set('slug', (string)(new Slug((string)$this)));

        return $this->get('slug');
    }

    // TODO this should also handle the alterations of the slug
    public function HasSlug_Traitor_before_save(): array
    {
        try {
            do {
                $res = self::any(['slug' => $this->slug()]);
                if (!empty($res)) {
                    $this->set('slug', $this->slug() . '-' . time());
                }
            } while (!empty($res));
        } catch (\Exception $e) {
            return [$e->getMessage()];
        }

        return [];
    }
}
