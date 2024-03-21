<?php
namespace App\Models\Abilities;

use App\Models\Contact;

class ContactInfo
{

    private int $id;
    private array $contacts;

    public function __construct(int $id)
    {
        $this->id = $id;
    
    }

    public function contacts(): array
    {
        if(empty($this->contacts)){
            $this->contacts = Contact::any(['parent_id' => $this->id]);
        }

        return $this->contacts;
    }   


    public function address() : array
    {
        $ret = [];
        $i = 0;
        if(!empty($this->get('street')))
            $ret[$i++] = $this->get('street');

        if(!empty($this->get('zip'))){
            $ret[$i] = $this->get('zip');
            if(!empty($this->get('city'))){
                $ret[$i++] .= ' '.$this->get('city');
            }
        }
        elseif(!empty($this->get('city'))){
            $ret[$i++] = $this->get('city');
        }

        if(!empty($this->get('province'))){
            $ret[$i] = $this->get('province');
            if(!empty($this->get('country'))){
                $ret[$i++] .= ' '.$this->get('country');
            }
        }
        elseif(!empty($this->get('country'))){
            $ret[$i++] = $this->get('country');
        }

        return $ret;
    }
}