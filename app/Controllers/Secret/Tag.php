<?php

namespace App\Controllers\Secret;

class Tag extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\HasNoView {
        \App\Controllers\Abilities\HasNoView::view insteadof \App\Controllers\Abilities\HasORM;
    }

    
    public function activeSection(): string
    {
        return 'Settings';
    }

    public function modelClassName(): string
    {
        return '\\HexMakina\\kadro\\Models\\' . $this->nid();
    }

    public function before_alter()
    {
        $roots = [];
        $res = $this->modelClassName()::any(['parent' => null], ['withParentLabel' => true, 'order_by' => ['content', 'ASC']]);
        foreach($res as $root){
            $roots[$root->id()] = $root->get('content');
        }
        $this->viewport('root_tags', $roots);
    }

    public function home()
    {
        if (!$this->router()->params('FiltersOnFirstChar')) {
            $this->router()->hop($this->urlFor($this->nid(), 'list', null, ['FiltersOnFirstChar' => '*']));
        }
        
        $parents = $this->modelClassName()::any(['parent' => null]);
        $this->viewport('parents', $parents);

        parent::home();
    }
}