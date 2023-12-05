<?php

namespace App\Controllers\Secret;

use \HexMakina\Crudites\Relation\OneToMany;


abstract class Krafto extends \HexMakina\kadro\Controllers\Kadro
{
    protected $template = null;

    public function requiresOperator(): bool
    {
        return true;
    }

    // by default
    public function activeSection(): string
    {
        return $this->nid();
    }

    // by default
    public function activeLink(): string
    {
        return $this->nid();
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
            $this->router()->hop('dash_record_edit', ['nid' => $this->nid(), 'id' => $res->id()]);
        }
    }

    public function toggle()
    {
        $field = $this->router()->params('field');
        $res = $this->modelClassName()::toggleBoolean($this->modelClassName()::table(), $field, $this->loadModel()->id());
        $this->router()->hopBack();
    }

    public function conclude(): void
    {
        parent::conclude();

        if(is_null($this->template)) {
            $fallback = 'Secret::' . $this->nid() . '/' . $this->router()->targetMethod();
            $this->template = $fallback;
        }

        $title = $this->breadcrumb();
        $this->viewport('title', $title);
        // return $this->template;
        // echo $this->display($this->template);
        
    }

    public function view()
    {
        $table = $this->modelClassName()::table();
        $relations = $this->get('HexMakina\BlackBox\Database\DatabaseInterface')->relations();
        foreach($relations->relationsBySource($table->name()) as $urn => $relation){
            if($relation instanceof OneToMany){
                $records = $relation->getTargets($this->loadModel()->id());
                $this->viewport($urn, $records);
            }
        }
    }

    protected function find_template($engine, $template_name): string
    {
        return parent::find_template($engine, $this->template);
   }

    protected function breadcrumb($prefix = [], $suffix = []): string
    {
        $bc = is_array($prefix) ? $prefix : [];

        $category = $this->nid();
        switch ($category) {
            case 'home':
                $category = null;
                break;
            case 'Movie':
                $category = 'Films';
                break;
            case 'Professional':
                $category = 'Professionnels';
                break;
            case 'Organisation':
                $category = 'Organisations';
                break;
            case 'Event':
            case 'Job':
            case 'Contest':
                $category = 'Evénements';
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
                $action_label = 'Consulter';
                break;
            case 'edit':
            case 'alter':
                if($this->loadModel()){
                    $action_label = 'Altérer';
                }
                else{
                    $action_label = 'Créer';
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



    public function url(string $action, $extras = []): string
    {
        return $this->urlFor($this->nid(), $action, $this->loadModel(), $extras);

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
        
        $params = ['nid' => $class];
        if ($model) {
            $params['id'] = $model->id();
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

}
