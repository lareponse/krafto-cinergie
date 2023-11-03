<?php

namespace App\Controllers\Abilities;

trait HasORM
{
    protected $load_model = null;
    protected $form_model;

    // return the controller's class short name
    abstract public function nid();
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
    
    public function modelClassName(): string
    {
        return $this->get('\\App\\Models\\' . $this->nid() .'::class');
    }

    public function formModel($model = null)
    {
        if (!is_null($model)) {
            $this->form_model = $model;
        } 
        elseif(is_null($this->form_model)){
            if ($this->router()->requests() && !is_null($this->loadModel())) {
                $this->formModel(clone $this->loadModel());
            }
            else {
                $reflectionClass = new \ReflectionClass($this->modelClassName());
                $this->form_model = $reflectionClass->newInstanceWithoutConstructor(); //That's it!
            }

            if ($this->router()->submits()) {
                // quickly fixes booleans/checkboxes
                $datass = $this->fixMissingBooleans($this->router()->submitted());
                
                // imports all data into model
                $this->form_model->import($datass);
            }
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
            $this->router()->hop('dash_record', ['nid' => $this->nid(), 'id' => $model->id()]);

        } else {
            $StateAgent = $this->get('HexMakina\BlackBox\StateAgentInterface');

            foreach($this->errors() as $err){
                $StateAgent->addMessage('warning', $err);
            }
            $this->setTemplate('alter');
        }
    }

    public function persist_model($model)
    {
        $this->errors = $model->save($this->operator()->id()); // returns [errors]

        if (empty($this->errors())) {
            $this->logger()->notice('CRUDITES_INSTANCE_ALTERED');
            return $model;
        }

        foreach ($this->errors() as $cruditeError) {
            $this->logger()->warning($cruditeError->__toString());
        }

        return null;
    }

    public function databaseRelations()
    {
        return $this->modelClassName()::database()->relations();
    }

}
