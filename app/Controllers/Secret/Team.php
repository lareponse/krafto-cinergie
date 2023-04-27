<?php

namespace App\Controllers\Secret;

use App\Models\Author;

class Team extends Krafto
{
    use \App\Controllers\Abilities\HasORM;

    public function activeSection(): string
    {
        return 'Page';
    }
    
    public function home()
    {
        $this->viewport('title', 'L\'équipe');
        $people = $this->modelClassName()::filter([], ['order_by' => '`rank` ASC']);
        $team = [
            'equipe' => [],
            'collaborateurs' => [],
            'CA' => [],
            'member' => [],
            'observateurs' => []
        ];

        foreach($people as $person){
            $team[$person->get('group')][$person->getID()]= $person;
        }

        $team['collaborateurs'] = Author::filter(['isCollaborator' => 1]);
        $this->viewport('team', $team);
    }
}
