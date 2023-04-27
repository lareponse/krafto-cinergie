<?php

namespace App\Controllers\Secret;

use HexMakina\LeMarchand\Configuration;
use League\Plates\Template\Template;

abstract class Krafto extends \HexMakina\kadro\Controllers\Kadro
{
    protected $template = null;

    public function requiresOperator(): bool
    {
        return true;
    }

    public function activeSection(): string
    {
        return $this->className();
    }

    public function activeLink(): string
    {
        return $this->className();
    }


    public function setTemplate($template): void
    {
        $this->template = $template;
    }

    public function new()
    {
        $this->setTemplate('new');
    }

    public function conclude(): void
    {
        parent::conclude();

        if (is_null($this->template)) {
            $fallback = 'Secret::' . $this->className() . '/' . $this->router()->targetMethod();
            $this->template = $fallback;
        }

        $title = $this->breadcrumb();
        $this->viewport('title', $title);
        echo $this->display($this->template);
        die;
    }

    protected function breadcrumb($prefix = [], $suffix = []): string
    {
        $bc = is_array($prefix) ? $prefix : [];

        $category = $this->className();
        switch ($category) {
            case 'home':
                $category = null;
                break;
            case 'Movie':
                $category = 'Films';
                break;
            case 'Professional':
                $category = 'Professionels';
                break;
            case 'Organisation':
                $category = 'Organisations';
                break;
        }
        if (!is_null($category))
            $bc[] = $category;


        $action_label = $this->router()->targetMethod();
        switch ($action_label) {
            case 'home':
                $action_label = null;
                break;
            case 'view':
                $action_label = 'consulter';
                break;
            case 'edit':
                $action_label = 'modifier';
                break;
        }
        if (!is_null($action_label))
            $bc[] = $action_label;

        if (is_array($suffix)) {
            $bc = array_merge($bc, $suffix);
        }

        return implode('<span class="separator">\\</span>', $bc);
    }
}
