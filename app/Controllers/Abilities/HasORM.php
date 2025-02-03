<?php

namespace App\Controllers\Abilities;

trait HasORM
{
    protected $load_model = null;
    protected $form_model;

    // return the controller's class short name
    abstract public function nid();
    abstract public function router();
    abstract public function logger();
        
    public function modelClassName(): string
    {
        return '\\App\\Models\\' . $this->nid();
    }

    public function formModel($model = null): ? \HexMakina\BlackBox\ORM\ModelInterface
    {
        // setter call ?
        if (!is_null($model)) 
            $this->form_model = $model;
        
        elseif(is_null($this->form_model))
            $this->form_model = $this->HasORM_autoFormModel();
        

        return $this->form_model;
    }

    public function loadModel(): ? \HexMakina\BlackBox\ORM\ModelInterface
    {
        if(is_null($this->load_model))
            $this->load_model = $this->HasORM_autoLoadModel();

        return $this->load_model;
    }

    public function view()
    {
        $table = $this->modelClassName()::table();
        $relations = $this->get('HexMakina\BlackBox\Database\DatabaseInterface')->relations();
        foreach ($relations->relationsBySource($table->name()) as $urn => $relation) {
            if ($relation instanceof OneToMany) {
                $records = $relation->getTargets($this->loadModel()->id());
                $this->viewport($urn, $records);
            }
        }
    }

    public function alter()
    {
        if ($this->operator()->hasPermission('author')) {
            $this->logger()->warning('Cette section est réservée aux administrateurs');
            $this->router()->hopBack();
        }
    }

    public function save()
    {
        $errors = $this->formModel()->save($this->operator()->id()); // returns [errors]

        if (empty($errors)) {
            $this->logger()->notice('CRUDITES_INSTANCE_ALTERED');
            $this->router()->hop('dash_record', ['nid' => $this->nid(), 'id' => $this->formModel()->id()]);
        } 
        else {
            $this->errors = $errors;

            foreach($this->errors() as $err){
                $this->logger()->warning($err);
            }
            $this->setTemplate($this->nid().'/alter');
        }
    }

    public function databaseRelations()
    {
        return $this->modelClassName()::database()->relations();
    }


    private function HasORM_autoFormModel()
    {
        // if GET request, and a model is loaded, clone it
        if ($this->router()->requests() && !is_null($this->loadModel()))
            return clone $this->loadModel();

        $reflectionClass = new \ReflectionClass($this->modelClassName());
        $fresh = $reflectionClass->newInstanceWithoutConstructor(); //That's it!

        if ($this->router()->submits()) {
            
            $post_data = $this->router()->submitted();

            // quickly fixes booleans/checkboxes
            foreach ($this->modelClassName()::table()->columns() as $col) {
                if ($col->type()->isBoolean()) {
                    $post_data[$col->name()] = !empty($post_data[$col->name()]);
                }
            }
            
            // imports all data into model
            $fresh->import($post_data);
        }

        return $fresh;
    }

    private function HasORM_autoLoadModel()
    {
        $load = null;
        
        // identify and load a hypothetical record using POST data
        if($this->router()->submits())
            $load = $this->modelClassName()::exists($this->router()->submitted());

        // if not POST or no POST data matched, try to load a record using the router's params
        if(is_null($load))
            $load = $this->modelClassName()::exists($this->router()->params());

        return $load;
    }

}
