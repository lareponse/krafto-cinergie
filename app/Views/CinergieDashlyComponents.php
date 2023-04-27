<?php

namespace App\Views;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class CinergieDashlyComponents implements ExtensionInterface
{
    public function register(Engine $engine)
    {
        $engine->registerFunction('submitDashly', [$this, 'submit']);
    }

    public function submit()
    {
        return '<div class="d-flex justify-content-end mt-5">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>';
    }
}
