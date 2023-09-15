<?php

namespace App\Controllers\Open;

use HexMakina\LeMarchand\Configuration;
use League\Plates\Template\Template;

use App\Models\Page;

abstract class Kortex extends \HexMakina\kadro\Controllers\Kadro
{
    protected $template = null;
    protected $pageSlug = null;

    public function requiresOperator(): bool
    {
        return false;
    }

    public function hasPage(): ?string
    {
        return isset($this->pageSlug);
    }

    public function applyFreeSearch($query, $fields)
    {
        if ($this->router()->params('s')) {
            $isLike = '%'.$this->router()->params('s').'%';
    
            $bindname = $query->addBinding('labelSearch', $isLike);
            $orConditions = [];
            foreach($fields as $searchField){
                $orConditions[]= "$searchField LIKE $bindname";
            }
            $query->whereWithBind(implode(' OR ', $orConditions));
        }
        return $query;
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

    public function home()
    {
    }

    public function conclude(): void
    {

        
        if($this->hasPage()){
            $page = Page::one(['slug' => $this->pageSlug]);
            $this->viewport('page', $page);
        }
        
        if (is_null($this->template)) {
            $fallback = 'Open::' . $this->className() . '/' . $this->router()->targetMethod();
            $this->template = $fallback;
        }
        
        // $title = $this->breadcrumb();
        // $this->viewport('title', $title);
        echo $this->display($this->template);

        parent::conclude();
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
