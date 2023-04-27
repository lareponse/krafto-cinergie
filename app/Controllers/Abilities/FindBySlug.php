<?php
namespace App\Controllers\Abilities;


trait FindBySlug
{
    public function editBySlug()
    {
        $res = $this->modelClassName()::exists(['slug' => $this->router()->params('slug')]);
        if(!is_null($res)){
            $this->router()->hop('dash_' . $res->model_type() . '_edit', ['id' => $res->getID()]);
        }
    }
}