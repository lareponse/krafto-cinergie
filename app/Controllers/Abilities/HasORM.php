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
            // quickly fixes booleans/checkboxes
            $datass = $this->fixMissingBooleans($this->router()->submitted());
            
            // imports all data into model
            $this->formModel()->import($datass);

        } elseif ($this->router()->requests()) {
            if (!is_null($this->loadModel())) {
                $this->formModel(clone $this->loadModel());
            }
        }
    }


    public function HasORMTraitor_conclude(): void
    {
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
        if(is_null($this->load_model))
        {
            // identify and load a hypothetical record using POST data
            if($this->router()->submits())
                $this->load_model = $this->modelClassName()::fatch($this->router()->submitted());
            // if no POST data, try to load a record using the router's params
            if(is_null($this->load_model))
                $this->load_model = $this->modelClassName()::fatch($this->router()->params());
        }

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

    public function alter()
    {
    }

    public function save()
    {
        $model = $this->persist_model($this->formModel());
        if (empty($this->errors())) {
            $this->router()->hop('dash_record', ['controller' => $this->className(), 'id' => $model->getID()]);

        } else {
            $this->setTemplate('alter');
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

}
