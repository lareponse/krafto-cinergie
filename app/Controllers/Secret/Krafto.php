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

    public function editBySlug()
    {
        $res = $this->modelClassName()::exists(['slug' => $this->router()->params('slug')]);
        if(!is_null($res)){
            $this->router()->hop('dash_record_edit', ['controller' => $this->className(), 'id' => $res->getID()]);
        }
    }

    public function conclude(): void
    {
        parent::conclude();

        if(is_null($this->template)) {
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
            case 'alter':
                if($this->loadModel()){
                    $action_label = 'Modification';
                }
                else{
                    $action_label = 'Création';
                }
                break;
        }
        if (!is_null($action_label))
            $bc[] = $action_label;

        if (is_array($suffix)) {
            $bc = array_merge($bc, $suffix);
        }

        return implode('<span class="separator">\\</span>', $bc);
    }

    public function home()
    {
        $listing = $this->modelClassName()::filter($this->router()->params());
        $this->viewport('listing', $listing);
        $this->viewport('filters', $this->router()->params());
    }

    public function actionFor($action, $model, $extras = [])
    {
        
        return $this->urlFor($model->className(), $model, $extras);
    }

    public function urlFor(string $class, string $action, $model=null, $extras = [])
    {
        $prefix = 'dash_record';
        $name = '';

        switch ($action) {
            case 'view':
                $name = $prefix;
                break;

            case 'list':
                $name = $prefix . 's';
                break;

            default:
                $name = $prefix . '_' . $action;
                break;
        }

        $params = ['controller' => $class];
        if ($model) {
            $params['id'] = $model->getID();
        }

        $route_as_href = $this->router()->hyp($name, $params);
        if (!empty($extras)) {

            $extras = implode('&', array_map(function ($key, $value) {
                return "$key=$value";
            }, array_keys($extras), array_values($extras)));

            $route_as_href .= '?' . $extras;
        }

        return $route_as_href;
    }


    public function url(string $action, $extras = []): string
    {
        return $this->urlFor($this->className(), $action, $this->loadModel(), $extras);

    }
}
