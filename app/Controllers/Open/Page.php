<?php

namespace App\Controllers\Open;

use \App\Models\Page as Model;
use \App\Models\{Organisation,Team, Author};

class Page extends Kortex
{

    public function requiresOperator(): bool
    {
        return false;
    }

    public function home()
    {
        vd(__FUNCTION__, __CLASS__);
    }

    public function history()
    {
        $this->pageSlug = 'notre-histoire';

    }

    public function price()
    {
        $this->pageSlug = 'price';
    }

    public function contact()
    {
        $this->pageSlug = 'contact';
        
        $this->viewport('cinergie', Organisation::one(['slug' => 'cinergie-be']));
    }

    public function team()
    {
        $this->pageSlug = 'l-equipe';

        $everyone = Team::filter(['active' => '1'], ['order_by' => [['team', 'group','ASC'], ['team', 'rank', 'ASC']]]);
        $team = [];
        foreach($everyone as $person){
            $team[$person->get('group')][] = $person;
        }

        $team['collaborateur'] = Author::filter(['active' => '1', 'isCollaborator' => '1'], ['order_by' => [['author', 'rank', 'ASC']]]);
        $this->viewport('team', $team);
    }

    public function legal()
    {
        $this->pageSlug = 'mentions-legales';
    }
}
