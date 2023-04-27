<?php

namespace App\Controllers\Abilities;

trait HasORM
{
    protected $load_model = null;
    protected $form_model;

    // return the controller's class short name
    abstract public function className();
    abstract public function router();

    public function HasORMTraitor_prepare(): void
    {
        // handles POST requests
        if ($this->router()->submits()) {
            $datass = $this->fixMissingBooleans($this->router()->submitted());
            $this->formModel()->import($datass);

            $pk_values = $this->modelClassName()::table()->primaryKeysMatch($this->router()->submitted());
            $this->load_model = $this->modelClassName()::exists($pk_values);

            if (is_null($this->load_model)) {
                $pk_values = $this->modelClassName()::table()->primaryKeysMatch($this->router()->params());
                $this->load_model = $this->modelClassName()::exists($pk_values);
            }
        } elseif ($this->router()->requests()) {
            $pk_values = $this->modelClassName()::table()->primaryKeysMatch($this->router()->params());
            $this->load_model = $this->modelClassName()::exists($pk_values);

            if (!is_null($this->loadModel())) {
                $this->formModel(clone $this->loadModel());
            }
        }
    }

    public function HasORMTraitor_conclude(): void
    {
        ddt('here');
        $this->viewport('model_type', $this->modelClassName()::model_type());
    }

    public function modelClassName(): string
    {
        return '\\App\\Models\\' . $this->className();
    }

    public function formModel($model = null)
    {
        if (!is_null($model)) {
            $this->form_model = $model;
        } elseif (is_null($this->form_model)) {
            $reflectionClass = new \ReflectionClass($this->modelClassName());
            $this->form_model = $reflectionClass->newInstanceWithoutConstructor(); //That's it!
        }

        return $this->form_model;
    }

    public function loadModel()
    {
        return $this->load_model;
    }

    // this is weirdly out of place. needed but out of place
    private function fixMissingBooleans($post_data = [])
    {
        foreach ($this->modelClassName()::table()->columns() as $col) {
            if ($col->type()->isBoolean()) {
                $post_data[$col->name()] = !empty($post_data[$col->name()]);
            }
        }

        return $post_data;
    }

    public function save()
    {
        $model = $this->persist_model($this->formModel());
        if (empty($this->errors())) {
            $this->router()->hop('dash_' . get_class($model)::model_type(), ['id' => $model->getID()]);
        } else {
            dd($this->errors());
            // should go back to edit $this->edit();
        }
    }

    public function persist_model($model)
    {
        $this->errors = $model->save($this->operator()->getId()); // returns [errors]
        if (empty($this->errors())) {
            $this->logger()->notice(json_encode(['CRUDITES_INSTANCE_ALTERED', ['MODEL_' . get_class($model)::model_type() . '_INSTANCE']]));
            return $model;
        }

        foreach ($this->errors() as $field => $error_msg) {
            $this->logger()->warning(json_encode([$error_msg, [$field]]));
        }

        return null;
    }

    public function urlFor(string $class, string $action, $model=null, $extras = [])
    {
        $prefix = 'dash_record';
        $name = '';
        $params = [];

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

        if(empty($params))
        {
            $params = ['controller' => $class];
            if ($model) {
                $params['id'] = $model->getID();
            }
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
