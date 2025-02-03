<?php

namespace App\Controllers\Secret;

class Operator extends Krafto
{
    use \App\Controllers\Abilities\HasORM;
    use \App\Controllers\Abilities\HasNoView;
    use \App\Controllers\Abilities\RequiresEditorOrAbove;


    public function home()
    {
        $listing = $this->modelClassName()::any($this->router()->params(), ['withPermissions' => true]);
        $this->viewport('listing', $listing);
        $this->viewport('filters', $this->router()->params());
        $this->viewport('counters', $this->counters());
    }
    public function before_save(): array
    {
        if (!empty($this->formModel()->get('password'))) {
            $this->formModel()->passwordChange($this->formModel()->get('password'));
        } else if ($this->loadModel()) {
            $this->formModel()->set('password', $this->loadModel()->get('password'));
        }

        $this->formModel()->set('active', (int) $this->formModel()->get('active'));

        return [];
    }

    private function counters()
    {
        $res = $this->modelClassName()::any();
        $counters = [
            'operators' => count($res),
            'authors' => 0,
            'editors' => 0,
            'inactives' => 0,
        ];
        foreach ($res as $id => $m) {
            if (in_array('author', $m->permission_names())) {
                ++$counters['authors'];
            }
            if (in_array('editor', $m->permission_names())) {
                ++$counters['editors'];
            }
            if (!$m->get('active')) {
                ++$counters['inactives'];
            }
        }


        return $counters;
    }
}
