<?php

namespace App\Controllers\Abilities;

trait RequiresEditorOrAbove
{
    abstract public function operator();
    abstract public function logger();
    abstract public function router();

    public function RequiresEditorOrAbove_Traitor_prepare(): void
    {
        if ($this->operator()->hasPermission('author')) {
            $this->logger()->warning('Cette section est réservée aux administrateurs');
            $this->router()->hopBack();
        }
    }
}
